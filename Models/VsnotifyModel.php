 <?php

	class VsnotifyModel extends Mysql
	{
		public $intSec_id;
		public $intPerios;
		public $strFecreg;
		public $intSec_no;
		public $intMat_no;
		public $intStd_no;
		public $intEmp_no;
		public $strSchedu;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVsnotify()
		{
			$usu = $_SESSION['userData']['USU_NO']; //Codigo Registro en Vsexplox o Vstudent ...
			$rol = $_SESSION['userData']['rol_id'];
			$ced = $_SESSION['idUser']; //cedula en vsaccess .....

			// SWITCH de Opciones:
			switch($rol)
			{
				case 5:  // Docente
						$sql = "SELECT	a.SEC_ID,
						               	a.PERIOS,
							           	a.FECREG,
										a.HORREG,
										a.CLAIMS,
		 					            s.SEC_NM,
						               	s.PARALE,
		    				           	m.MAT_NM,
		    				           	v.LAS_NM,
						              	v.FIR_NM
				        FROM vsnotify a
				        INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
				        INNER JOIN vsmatter m ON a.MAT_NO = m.MAT_NO
				        INNER JOIN vstudent v ON v.STD_NO = a.STD_NO
			    	    WHERE a.EMP_NO = $usu
						ORDER BY a.SEC_ID DESC";
						break;
				case 7:  // Estudiante
						$sql = "SELECT a.SEC_ID,
						               a.PERIOS,
				    			       a.FECREG,
									   a.HORREG,
									   a.CLAIMS,
						               s.SEC_NM,
			            			   s.PARALE,
						               m.MAT_NM,
			            			   v.LAS_NM,
						               v.FIR_NM
				        FROM vsnotify a
			    	    INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
			        	INNER JOIN vsmatter m ON a.MAT_NO = m.MAT_NO
			        	INNER JOIN vstudent v ON v.STD_NO = a.STD_NO
			        	WHERE a.STD_NO = $usu
						ORDER BY a.SEC_ID DESC";
						break;
				case 8:  // Representante
						$sql = "SELECT a.SEC_ID,
									   a.PERIOS,
									   a.FECREG,
									   a.HORREG,
									   a.CLAIMS,
									   s.SEC_NM,
									   s.PARALE,
									   m.MAT_NM,
									   v.LAS_NM,
									   v.FIR_NM
						FROM vsnotify a
						INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
						INNER JOIN vsmatter m ON a.MAT_NO = m.MAT_NO
						INNER JOIN vstudent v ON v.STD_NO = a.STD_NO
						WHERE a.STD_NO = $usu
						ORDER BY a.SEC_ID DESC";
						break;
				default:
						$sql = "SELECT	a.SEC_ID,
						               	a.PERIOS,
							           	a.FECREG,
										a.HORREG,
										a.CLAIMS,
				               			s.SEC_NM,
						               	s.PARALE,
					    	           	m.MAT_NM,
			    		        	   	v.LAS_NM,
				        		       	v.FIR_NM
				        FROM vsnotify a
				        INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
		        		INNER JOIN vsmatter m ON a.MAT_NO = m.MAT_NO
		    		    INNER JOIN vstudent v ON v.STD_NO = a.STD_NO
						ORDER BY a.SEC_ID DESC";
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// VISUALIZA NOTIFICACION
		public function viewVsnotify(int $idSec)
		{
			$request = array();
			$sql = "SELECT a.PERIOS,
						   a.FECREG,
						   s.SEC_NM,
						   s.PARALE,
						   m.MAT_NM,
						   v.LAS_NM,
						   v.FIR_NM,
						   a.SCHEDU
					FROM vsnotify a
					INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
					INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO
					INNER JOIN vstudent v ON v.STD_NO = a.STD_NO
					WHERE a.SEC_ID = $idSec";
			$request_vsnotify = $this->select($sql);

			$request = array('actividad' => $request_vsnotify);
			return $request;
		}


		// EXTRAE UNA NOTIFICACION
		public function oneVsnotify(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "SELECT * FROM vsnotify WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}


		// INSERTA UNA NOTIFICACION
		public function insertVsnotify(int $perios, string $fecreg, string $horreg, int $sec_no, int $mat_no, int $std_no, int $emp_no, string $schedu)
		{
   			$return = "";
            $this->intPerios = $perios;
            $this->datFecreg = $fecreg;
			$this->strHorreg = date("H:i:s");
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intStd_no = $std_no;
			$this->intEmp_no = $emp_no;
			$this->strSchedu = $schedu;

			// Valida en VSSECMAT si existe la malla escogida
			$sql              = "SELECT EMP_NO FROM vssecmat WHERE SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no}";
			$request_vssecmat = $this->select($sql);
			if(empty($request_vssecmat))
			{
				// NO EXISTE MALLA
				$return = -2;
				return $return;
			}
			$this->intEmp_no = $request_vssecmat['EMP_NO'];

			if($this->intStd_no == 0)
			{
				$sql 				= "SELECT * FROM vsnotify WHERE PERIOS = $this->intPerios AND FECREG = '{$this->datFecreg}' AND HORREG = '{$this->strHorreg}' AND SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no}";
				$request_vsnotify 	= $this->select_all($sql);
				if(empty($request_vsnotify))
				{
					// Busca en VSTUDENT los estudiantes que coinciden con PERIOS y SEC_NO
					$sql = "SELECT STD_NO,LAS_NM,FIR_NM FROM vstudent WHERE PERIOS = $this->intPerios AND SEC_NO = {$this->intSec_no}";
					$arrSTD = $this->select_all($sql);

					for ($i = 0; $i < count($arrSTD); $i++) 
					{
						$insert         = "INSERT INTO vsnotify(perios,fecreg,horreg,sec_no,mat_no,std_no,emp_no,schedu,claims) VALUES(?,?,?,?,?,?,?,?,?)";
						$arrData        = array($this->intPerios,$this->datFecreg,$this->strHorreg,$this->intSec_no,$this->intMat_no,$arrSTD[$i]['STD_NO'],$this->intEmp_no,$this->strSchedu,0);
						$request_insert = $this->insert($insert,$arrData);
					}
					$return         = $request_insert;
				}else{
					// EXISTE
					$return = -1;
				}
			}else{
				$sql 				= "SELECT * FROM vsnotify WHERE PERIOS = {$this->intPerios} AND FECREG = '{$this->datFecreg}' AND HORREG = '{$this->strHorreg}' AND SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no} AND STD_NO = {$this->intStd_no}";
				$request_vsnotify 	= $this->select_all($sql);
				if(empty($request_vsnotify))
				{
					$insert          = "INSERT INTO vsnotify(perios,fecreg,horreg,sec_no,mat_no,std_no,emp_no,schedu,claims) VALUES(?,?,?,?,?,?,?,?,?)";
					$arrData         = array($this->intPerios,$this->datFecreg,$this->strHorreg,$this->intSec_no,$this->intMat_no,$this->intStd_no,$this->intEmp_no,$this->strSchedu,0);
					$request_insert  = $this->insert($insert,$arrData);
					$return          = $request_insert;
				}else{
					// EXISTE
					$return = -1;
				}
			}
			return $return;
		}


		// ACTUALIZA UNA NOTIFICACION
		public function updateVsnotify(int $sec_id, int $perios, string $fecreg, string $horreg, int $sec_no, int $mat_no, int $std_no, int $emp_no, string $schedu)
		{
   			$return = "";
  		    $this->intSec_id = $sec_id;
		    $this->intPerios = $perios;
			$this->datFecreg = $fecreg;
			$this->strHorreg = $horreg;
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intStd_no = $std_no;
			$this->intEmp_no = $emp_no;
			$this->strSchedu = $schedu;

			$sql 				= "SELECT * FROM vsnotify WHERE PERIOS = {$this->intPerios} AND FECREG = '{$this->datFecreg}' AND HORREG = '{$this->strHorreg}' AND SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no} AND STD_NO = {$this->intStd_no} AND SEC_ID != {$this->intSec_id}";
			$request_vsnotify 	= $this->select_all($sql);
			if(empty($request_vsnotify))
			{
				$insert         = "UPDATE vsnotify SET schedu = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->strSchedu);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}


		// INSERTA UN RECLAMO
		public function insertVsnotstd(int $perios, string $fecreg, string $horreg, int $std_no, int $mat_no, string $schedu)
		{
   			$return = "";
            $this->intPerios = $perios;
            $this->datFecreg = $fecreg;
			$this->strHorreg = date("H:i:s");
			$this->intStd_no = $std_no;
			$this->intMat_no = $mat_no;
			$this->strSchedu = $schedu;

			// EXTRAE LA SECCION DEL ESTUDIANTE
			$sql              	= "SELECT SEC_NO FROM vstudent WHERE STD_NO = {$this->intStd_no}";
			$request_vstudent 	= $this->select($sql);
			$this->intSec_no 	= $request_vstudent['SEC_NO'];

			// Valida en VSSECMAT si existe la malla escogida
			$sql              = "SELECT EMP_NO FROM vssecmat WHERE SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no}";
			$request_vssecmat = $this->select($sql);
			if(empty($request_vssecmat))
			{
				// NO EXISTE MALLA
				$return = -2;
				return $return;
			}
			$this->intEmp_no = $request_vssecmat['EMP_NO'];

			$sql 				= "SELECT * FROM vsnotify WHERE PERIOS = {$this->intPerios} AND FECREG = '{$this->datFecreg}' AND HORREG = '{$this->strHorreg}' AND MAT_NO = {$this->intMat_no} AND STD_NO = {$this->intStd_no}";
			$request_vsnotstd 	= $this->select_all($sql);
			if(empty($request_vsnotstd))
			{
				$insert          = "INSERT INTO vsnotify(perios,fecreg,horreg,sec_no,mat_no,std_no,emp_no,schedu,claims) VALUES(?,?,?,?,?,?,?,?,?)";
				$arrData         = array($this->intPerios,$this->datFecreg,$this->strHorreg,$this->intSec_no,$this->intMat_no,$this->intStd_no,$this->intEmp_no,$this->strSchedu,1);
				$request_insert  = $this->insert($insert,$arrData);
				$return          = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		// ACTUALIZA UN RECLAMO
		public function updateVsnotstd(int $sec_id, int $perios, string $fecreg, string $horreg, int $std_no, int $mat_no, string $schedu)
		{
   			$return = "";
  		    $this->intSec_id = $sec_id;
		    $this->intPerios = $perios;
			$this->datFecreg = $fecreg;
			$this->strHorreg = $horreg;
			$this->intStd_no = $std_no;
			$this->intMat_no = $mat_no;
			$this->strSchedu = $schedu;

			$sql 				= "SELECT * FROM vsnotify WHERE PERIOS = {$this->intPerios} AND FECREG = '{$this->datFecreg}' AND HORREG = '{$this->strHorreg}' AND MAT_NO = {$this->intMat_no} AND STD_NO = {$this->intStd_no} AND SEC_ID != {$this->intSec_id}";
			$request_vsnotstd 	= $this->select_all($sql);
			if(empty($request_vsnotstd))
			{
				$insert         = "UPDATE vsnotify SET schedu = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->strSchedu);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}
	}
