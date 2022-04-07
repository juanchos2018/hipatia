 <?php

	class VssecmatModel extends Mysql
	{
		public $intSec_no;
		public $intMat_no;
		public $intEmp_no;
		public $intPerios;
		public $strClinks;
		public $intOrders;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVssecmat()
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
										m.REGIME,
										e.LAS_NM,
										e.FIR_NM,
										a.PERIOS,
										a.CLINKS,
										a.ORDERS
						FROM vssecmat a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
						INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
						WHERE a.EMP_NO = $usu
						ORDER BY a.PERIOS DESC,s.NIV_NO,s.PARALE,a.ORDERS";
						break;
				case 7:  // Estudiante
						$query_sec = "SELECT SEC_NO FROM vstudent WHERE STD_NO = ".$usu;

						$res = $this->select($query_sec)['SEC_NO'];

						$sql = "SELECT 	a.SEC_ID,
										s.SEC_NM,
										s.PARALE,
										m.MAT_NM,
										m.REGIME,
										e.LAS_NM,
										e.FIR_NM,
										a.PERIOS,
										a.CLINKS,
										a.ORDERS
						FROM vssecmat a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
						INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
						WHERE a.SEC_NO = $res
						ORDER BY a.PERIOS DESC,s.NIV_NO,s.PARALE,a.ORDERS";
						break;
				default: 
						$sql = "SELECT 	a.SEC_ID,
						               	s.SEC_NM,
						               	s.PARALE,
			        			       	m.MAT_NM,
				    		           	m.REGIME,
									   	e.LAS_NM,
									   	e.FIR_NM,
									   	a.PERIOS,
										a.CLINKS,
										a.ORDERS
					    FROM vssecmat a
					    INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
			    		INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
					    INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
					    ORDER BY a.PERIOS DESC,s.NIV_NO,s.PARALE,a.ORDERS";
						break;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// Extrae el registro de un reparto 
		public function oneVssecmat(int $secID)
		{
			$this->intSec_id = $secID;
			$sql = "SELECT * FROM vssecmat WHERE SEC_ID = {$this->intSec_id}";
			$request = $this->select($sql);
			return $request;
		}


		public function deleteVssecmat(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql = "DELETE FROM vssecmat WHERE SEC_ID = {$this->intSec_id}";
			$request = $this->delete($sql);
			if($request)
			{
				$request = 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}


		public function insertVssecmat(int $sec_no, int $mat_no, int $emp_no, int $perios, string $clinks, int $orders)
		{
   			$return = "";
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intEmp_no = $emp_no;
			$this->intPerios = $perios;
			$this->strClinks = $clinks;
			$this->intOrders = $orders;

			$sql = "SELECT * FROM vssecmat WHERE SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert = 'INSERT INTO vssecmat(sec_no,mat_no,emp_no,perios,clinks,orders) VALUES(?,?,?,?,?,?)';
				$arrData = array($this->intSec_no,$this->intMat_no,$this->intEmp_no,$this->intPerios,$this->strClinks,$this->intOrders);
				$request_insert = $this->insert($insert,$arrData);
				$return = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}

		
		public function updateVssecmat(int $sec_id, int $sec_no, int $mat_no, int $emp_no, int $perios, string $clinks, int $orders)
		{
   			$return = "";
			$this->intSec_id = $sec_id;
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intEmp_no = $emp_no;
			$this->intPerios = $perios;
			$this->strClinks = $clinks;
			$this->intOrders = $orders;

			$sql = "SELECT * FROM vssecmat WHERE SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no} AND SEC_ID != {$this->intSec_id}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert = "UPDATE vssecmat SET sec_no = ?, mat_no = ?, emp_no = ?, perios = ?, clinks = ?, orders = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData = array($this->intSec_no,$this->intMat_no,$this->intEmp_no,$this->intPerios,$this->strClinks,$this->intOrders);
				$request_insert = $this->update($insert,$arrData);
				$return = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
