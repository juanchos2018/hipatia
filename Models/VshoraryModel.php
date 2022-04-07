 <?php

	class VshoraryModel extends Mysql
	{
		public $intSec_no;
		public $intMat_no;
		public $intEmp_no;
		public $intPerios;
		public $intDaynum;
		public $intHornum;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVshorary()
		{
			$usu = $_SESSION['userData']['USU_NO'];
			$rol = $_SESSION['userData']['rol_id'];
			switch($rol)
			{
				case 5:  // Docente
						$sql = "SELECT 	a.SEC_ID,
										s.SEC_NM,
										s.PARALE,
										m.MAT_NM,
										e.LAS_NM,
										e.FIR_NM,
										a.PERIOS,
										a.DAYNUM,
										a.HORNUM
						FROM vshorary a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
						INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
						WHERE a.EMP_NO = $usu
						ORDER BY a.PERIOS DESC";
						break;
				case 7:  // Estudiante
						$query_sec = "SELECT SEC_NO FROM vstudent WHERE STD_NO = ".$usu;

						$res = $this->select($query_sec)['SEC_NO'];

						$sql = "SELECT 	a.SEC_ID,
										s.SEC_NM,
										s.PARALE,
										m.MAT_NM,
										e.LAS_NM,
										e.FIR_NM,
										a.PERIOS,
										a.DAYNUM,
										a.HORNUM
						FROM vshorary a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
						INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
						WHERE a.SEC_NO = $res
						ORDER BY a.PERIOS DESC";
						break;
				default: 
						$sql = "SELECT 	a.SEC_ID,
						               	s.SEC_NM,
						               	s.PARALE,
			        			       	m.MAT_NM,
									   	e.LAS_NM,
									   	e.FIR_NM,
									   	a.PERIOS,
										a.DAYNUM,
										a.HORNUM
					    FROM vshorary a
					    INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
			    		INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
					    INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
					    ORDER BY a.PERIOS DESC";
						break;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE UN HORARIO
		public function oneVshorary(int $secID)
		{
			$this->intSec_id = $secID;
			$sql        = "SELECT * FROM vshorary WHERE SEC_ID = {$this->intSec_id}";
			$request    = $this->select($sql);
			return $request;
		}


		public function deleteVshorary(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql        = "DELETE FROM vshorary WHERE SEC_ID = {$this->intSec_id}";
			$request    = $this->delete($sql);
			if($request)
			{
				$request = 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}


		public function insertVshorary(int $sec_no, int $mat_no, int $emp_no, int $perios, int $daynum, int $hornum)
		{
   			$return = "";
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intEmp_no = $emp_no;
			$this->intPerios = $perios;
			$this->intDaynum = $daynum;
			$this->intHornum = $hornum;

			$sql        = "SELECT * FROM vshorary WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no} AND DAYNUM = {$this->intDaynum} AND HORNUM = {$this->intHornum}";
			$request    = $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vshorary(sec_no,mat_no,emp_no,perios,daynum,hornum) VALUES(?,?,?,?,?,?)";
				$arrData        = array($this->intSec_no,$this->intMat_no,$this->intEmp_no,$this->intPerios,$this->intDaynum,$this->intHornum);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}

		
		public function updateVshorary(int $sec_id, int $sec_no, int $mat_no, int $emp_no, int $perios, int $daynum, int $hornum)
		{
   			$return = "";
			$this->intSec_id = $sec_id;
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intEmp_no = $emp_no;
			$this->intPerios = $perios;
			$this->intDaynum = $daynum;
			$this->intHornum = $hornum;

			$sql        = "SELECT * FROM vshorary WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no} AND DAYNUM = {$this->intDaynum} AND HORNUM = {$this->intHornum} AND SEC_ID != {$this->intSec_id}";
			$request    = $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vshorary SET sec_no = ?, mat_no = ?, emp_no = ?, perios = ?, daynum = ?, hornum = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->intSec_no,$this->intMat_no,$this->intEmp_no,$this->intPerios,$this->intDaynum,$this->intHornum);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
