 <?php

	class VsexamenModel extends Mysql
	{
		public $intSec_id;
		public $intStd_id;
		public $intPerios;
		public $strFecreg;
		public $intSec_no;
		public $intMat_no;
		public $intStd_no;
		public $intEmp_no;
		public $strFecmax;
		public $strParcia;
		public $intPuntaj;
		public $strSchedu;
		public $strVdlink;
		public $strFlname;
		public $strFltask;
		public $intProptj;
		public $strMessag;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVsexamen()
		{
			$usu = $_SESSION['userData']['USU_NO']; // Codigo Registro en Vsexplox o Vstudent ...
			$ced = $_SESSION['idUser']; 			// cedula en vsaccess .....
			$rol = $_SESSION['userData']['rol_id'];

			$sql     = "SELECT PERIOS FROM vsdefaul";
			$request = $this->select($sql);
			$perios  = $request['PERIOS'];

			$sql = "";
			$fieldSelect = 'a.SEC_ID, a.PERIOS, a.FECREG, s.SEC_NM, s.PARALE,
			    	        m.MAT_NM, m.REGIME, a.SCHEDU, a.PARCIA,
							v.LAS_NM, v.FIR_NM, e.LAS_NM as ELAS_NM, e.FIR_NM as EFIR_NM,a.FLNAME,a.FLTASK
							FROM vsexamen a
		        			INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
		        			INNER JOIN vsmatter m ON a.MAT_NO = m.MAT_NO
		        			INNER JOIN vstudent v ON a.STD_NO = v.STD_NO
		        			INNER JOIN vsemplox e ON a.EMP_NO = e.EMP_NO ';

			// SWITCH de Opciones:
			switch($rol)
			{
				case 5:  // Docente
						$sql = "SELECT ".$fieldSelect."WHERE a.EMP_NO = $usu AND a.PERIOS = $perios ORDER BY a.FECREG DESC";
						break;
				case 7:  // Estudiante
						$sql = "SELECT ".$fieldSelect."WHERE a.STD_NO = $usu AND a.PERIOS = $perios ORDER BY a.FECREG DESC";
						break;
				case 8:  // Representante
						$sql = "SELECT 	a.SEC_ID,
						               	a.PERIOS,
							           	a.FECREG,
							           	a.FECINI,
			        			       	s.SEC_NM,
			            	   			s.PARALE,
				    	    	       	m.MAT_NM,
				        	    	   	m.REGIME,
										a.SCHEDU,
										a.PARCIA,
										v.LAS_NM,
						              	v.FIR_NM,
										e.LAS_NM as ELAS_NM,
			            	  			e.FIR_NM as EFIR_NM
				        FROM vsexamen a
				        INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
				        INNER JOIN vsmatter m ON a.MAT_NO = m.MAT_NO
				        INNER JOIN vstudent v ON a.STD_NO = v.STD_NO
			    	    INNER JOIN vsemplox e ON a.EMP_NO = e.EMP_NO
						WHERE a.STD_NO = $usu
						ORDER BY a.FECREG DESC";
						break;
				default:
						$sql = "SELECT ".$fieldSelect."ORDER BY a.FECREG DESC";
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// Obtiene Data para la Impresion de Actividades
		public function selectDetalle(int $secID)
		{
			$request = array();

			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			// Aqui se extrae el registro de Actividad con el secID enviado
			$secActividad = intval($secID);
			$sql = "SELECT a.PERIOS,
						   a.FECREG,
                           a.FECINI,
						   s.SEC_NO,
						   s.SEC_NM,
						   s.PARALE,
						   m.MAT_NO,
						   m.MAT_NM,
						   a.EMP_NO,
						   e.LAS_NM,
						   e.FIR_NM,
						   a.PARCIA
					FROM vsexamen a
					INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
					INNER JOIN vsmatter m ON a.MAT_NO = m.MAT_NO
					INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
					WHERE a.SEC_ID = $secActividad";
			$request_actividad = $this->select($sql);

			// Aqui se extrae todos los estudiantes por Docente, Seccion y Materia
			$sql = "SELECT a.STD_NO,
			               v.LAS_NM,
						   v.FIR_NM,
						   a.PUNTAJ,
						   a.SCHEDU
			        FROM vsexamen a
                    INNER JOIN vstudent v ON v.STD_NO = a.STD_NO
                    WHERE a.EMP_NO = $request_actividad[EMP_NO]
                    AND   a.PERIOS = $request_actividad[PERIOS]
                    AND   a.FECREG = '$request_actividad[FECREG]'
                    AND   a.SEC_NO = $request_actividad[SEC_NO]
                    AND   a.MAT_NO = $request_actividad[MAT_NO]";
            $request_alumnos = $this->select_all($sql);

            $request = array('empresa' => $request_empresa,
            	             'actividad' => $request_actividad,
            	             'alumnos' => $request_alumnos
           					);
			return $request; 
		}


		public function oneVsexamen(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "SELECT * FROM vsexamen WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}

		
		// Extrae registro individual de Actividad a mostrar en el Modal: ViewActivity
		public function viewVsexamen(int $idSec)
		{
			$request = array();
			
			// Se obtiene la actividad por el secuencial enviado ...
			$sql = "SELECT a.PERIOS,
						   a.FECREG,
                           a.FECINI,
						   s.SEC_NM,
						   s.PARALE,
						   m.MAT_NM,
						   v.LAS_NM,
						   v.FIR_NM,
						   a.PARCIA,
						   a.SCHEDU
					FROM vsexamen a
					INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
					INNER JOIN vsmatter m ON a.MAT_NO = m.MAT_NO
					INNER JOIN vstudent v ON a.STD_NO = v.STD_NO
					WHERE a.SEC_ID = $idSec";
			$request_schedul = $this->select($sql);

			$request = array('actividad' => $request_schedul);
			return $request;
		}


		// Actualiza la Tarea del Estudiante
		public function	updateTaskStd(int $secTaskStd, string $strFlname)
		{
			$this->intSec_id = $secTaskStd;
			$this->strFlname = $strFlname;

			$sql   	  = "UPDATE vsexamen SET FLTASK = ? WHERE SEC_ID = {$this->intSec_id}";
			$arrData  = array($this->strFlname);
			$request  = $this->update($sql,$arrData);
			return	$request;
		}


		public function deleteVsexamen(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "DELETE FROM vsexamen WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->delete($sql);
			if($request)
			{
				$request = 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}

		
		public function insertVsexamen(int $perios, string $fecreg, string $fecini, string $horini, int $sec_no, int $mat_no, int $std_no, int $emp_no, string $parcia, string $schedu)
		{
   			$return = "";
			$this->intPerios = $perios;
			$this->strFecreg = $fecreg;
			$this->strFecini = $fecini;
			$this->strHorini = date("H:i:s");
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intStd_no = $std_no;
			$this->intEmp_no = $emp_no;
			$this->strParcia = $parcia;
			$this->strSchedu = $schedu;


			// Valida en VSSECMAT si existe la malla escogida
			$sql              = "SELECT EMP_NO FROM vssecmat WHERE SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no}";
			$request_vssecmat = $this->select($sql);
			if(empty($request_vssecmat))
			{
				// REPARTO INCORRECTO
				$return = -3;
				return $return;
			}
			$this->intEmp_no = $request_vssecmat['EMP_NO'];


			$sql 				= "SELECT * FROM vsexamen WHERE PERIOS = {$this->intPerios} AND FECREG = '{$this->strFecreg}' AND SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no}";
			$request_vsexamen 	= $this->select_all($sql);
			if(empty($request_vsexamen))
			{
				// Si array ESTUDIANTES viene vacio seleccionamos todos los ESTUDIANTES
				if($this->intStd_no == 0)
				{
					// Busca en VSTUDENT los estudiantes que coinciden con PERIOS y SEC_NO
					$sql    = "SELECT STD_NO FROM vstudent WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no}";
					$arrSTD = $this->select_all($sql);
				}else{
					// Busca en VSTUDENT los estudiantes que coinciden con escogido
					$sql    = "SELECT STD_NO FROM vstudent WHERE STD_NO = {$this->intStd_no}";
					$arrSTD = $this->select($sql);
				}

				foreach ($arrSTD as $std)
				{
					if($this->intStd_no == 0)
					{
						$this->intStd = $std['STD_NO'];
					}else{
						$this->intStd = $std;
					}
					$insert             = "INSERT INTO vsexamen(perios,fecreg,fecini,horini,sec_no,mat_no,std_no,emp_no,parcia,schedu) VALUES(?,?,?,?,?,?,?,?,?,?)";
					$arrData            = array($this->intPerios,$this->strFecreg,$this->strFecini,$this->strHorini,$this->intSec_no,$this->intMat_no,$this->intStd,$this->intEmp_no,$this->strParcia,$this->strSchedu);
					$request_insert     = $this->insert($insert,$arrData);
					$return             = $request_insert;
				}
			}
			return $return;
		}


		public function updateVsexamen(int $sec_id, int $perios, string $fecreg, string $fecini, string $horini, int $sec_no, int $mat_no, int $std_no, int $emp_no, string $parcia, string $schedu)
		{
   			$return = "";
  		    $this->intSec_id = $sec_id;
		    $this->intPerios = $perios;
			$this->strFecreg = $fecreg;
			$this->strFecini = $fecini;
			$this->strHorini = $horini;
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intStd_no = $std_no;
			$this->intEmp_no = $emp_no;
			$this->strParcia = $parcia;
			$this->strSchedu = $schedu;

			// Valida en VSSECMAT si existe la malla escogida
			$sql              = "SELECT EMP_NO FROM vssecmat WHERE SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no}";
			$request_vssecmat = $this->select($sql);
			if(empty($request_vssecmat))
			{
				// REPARTO INCORRECTO
				$return = -3;
				return $return;
			}

			$sql              = "SELECT * FROM vsexamen WHERE PERIOS = {$this->intPerios} AND FECREG = '{$this->strFecreg}' AND MAT_NO = {$this->intMat_no} AND STD_NO = {$this->intStd_no} AND SEC_ID != {$this->intSec_id}";
			$request_vsexamen = $this->select($sql);
			if(empty($request_vsexamen))
			{
				$insert         = "UPDATE vsexamen SET fecini = ?, parcia = ?, schedu = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->strFecini,$this->strParcia,$this->strSchedu);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}
	}
