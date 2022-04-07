 <?php

	class VsactmatModel extends Mysql
	{
		public $intSec_no;
		public $intMat_no;
		public $intEmp_no;
		public $strClinks;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVsactmat()
		{
			$usu = $_SESSION['userData']['USU_NO'];
			$rol = $_SESSION['userData']['rol_id'];
			switch($rol)
			{
				case 5:  // Docente
					$sql = "SELECT 	a.SEC_ID,
									a.PERIOS,
									s.SEC_NM,
									s.PARALE,
									m.MAT_NM,
									m.REGIME,
									e.LAS_NM,
									e.FIR_NM,
									a.CLINKS,
									a.ORDERS
					FROM vssecmat a
					INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
					INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
					INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
					WHERE a.EMP_NO = $usu
					ORDER BY a.PERIOS DESC,s.NIV_NO,s.PARALE,a.ORDERS";
					break;
				default: 
					$sql = "SELECT 	a.SEC_ID,
									a.PERIOS,
					               	s.SEC_NM,
					               	s.PARALE,
			        		       	m.MAT_NM,
				    	           	m.REGIME,
								   	e.LAS_NM,
								   	e.FIR_NM,
									a.CLINKS
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


		public function getVsactdet(int $perios, int $sec_no, int $mat_no, string $parcia)
		{
			$request = array();
			$this->intPerios = $perios;
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->strParcia = $parcia;

			// DATA EMPRESA
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			// DATA INSUMOS VSTABLES
			$sql 				= "SELECT SUB_NO,SUB_NM FROM vstables WHERE TAB_NO = 'INS' AND ESTATU = 1";
			$request_insumos 	= $this->select_all($sql);			

			// QUERY ACTA DE CALIFICACIONES
			switch($this->strParcia)
			{
				case 'Q1P1PR': $QPI = 'v.Q1P1I1,v.Q1P1I2,v.Q1P1I3,v.Q1P1I4,v.Q1P1I5,v.Q1P1DI,v.Q1P1MD,v.Q1P1PR,';
							break;
				case 'Q1P2PR': $QPI = 'v.Q1P2I1,v.Q1P2I2,v.Q1P2I3,v.Q1P2I4,v.Q1P2I5,v.Q1P2DI,v.Q1P2MD,v.Q1P2PR,';
							break;
				case 'Q1P3PR': $QPI = 'v.Q1P3I1,v.Q1P3I2,v.Q1P3I3,v.Q1P3I4,v.Q1P3I5,v.Q1P3DI,v.Q1P3MD,v.Q1P3PR,';
							break;
				case 'Q1P1PY': $QPI = 'v.Q1P1DI,v.Q1P1MD,v.Q1P1PR,';
							break;
				case 'Q1P2PY': $QPI = 'v.Q1P2DI,v.Q1P2MD,v.Q1P2PR,';
							break;
				case 'Q1_PRO': $QPI = 'v.Q1P1PR,v.Q1P2PR,v.Q1P4PR,';
							break;
				case 'Q2P1PR': $QPI = 'v.Q2P1I1,v.Q2P1I2,v.Q2P1I3,v.Q2P1I4,v.Q2P1I5,v.Q2P1DI,v.Q2P1MD,v.Q2P1PR,';
							break;
				case 'Q2P2PR': $QPI = 'v.Q2P2I1,v.Q2P2I2,v.Q2P2I3,v.Q2P2I4,v.Q2P2I5,v.Q2P2DI,v.Q2P2MD,v.Q2P2PR,';
							break;
				case 'Q2P3PR': $QPI = 'v.Q2P3I1,v.Q2P3I2,v.Q2P3I3,v.Q2P3I4,v.Q2P3I5,v.Q2P3DI,v.Q2P3MD,v.Q2P3PR,';
							break;
				case 'Q2P1PY': $QPI = 'v.Q2P1DI,v.Q2P1MD,v.Q2P1PR,';
							break;
				case 'Q2P2PY': $QPI = 'v.Q2P2DI,v.Q2P2MD,v.Q2P2PR,';
							break;
				case 'Q2_PRO': $QPI = 'v.Q2P1PR,v.Q2P2PR,v.Q2P4PR,';
							break;
				case 'SUPLET': $QPI = 'v.SUPLET,v.REMEDI,v.GRACIA,v.PROFIN,';
							break;
				case 'REMEDI': $QPI = 'v.SUPLET,v.REMEDI,v.GRACIA,v.PROFIN,';
							break;
				case 'GRACIA': $QPI = 'v.SUPLET,v.REMEDI,v.GRACIA,v.PROFIN,';
							break;
			}

			$sql = "SELECT e.LAS_NM,e.FIR_NM,s.SEC_NM,s.PARALE,s.JOR_NO,m.MAT_NM,m.CALIFI,
			               m.CUAL01,m.CUAL02,m.CUAL03,m.CUAL04,m.CUAL05,m.CUAL06,m.CUAL07,m.CUAL08,m.CUAL09,m.CUAL10,
						   m.CUAN01,m.CUAN02,m.CUAN03,m.CUAN04,m.CUAN05,m.CUAN06,m.CUAN07,m.CUAN08,m.CUAN09,m.CUAN10,"."$QPI"."
			               v.SEC_ID,v.PERIOS,v.STD_NO,v.MAT_NO,v.Q1_PRO,v.Q2_PRO
			        FROM vsmatstd v 
			        INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
			        INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO
			        INNER JOIN vsmatter m ON m.MAT_NO = v.MAT_NO
			        WHERE v.PERIOS = {$this->intPerios}
			        AND   v.SEC_NO = {$this->intSec_no}
			        AND   v.MAT_NO = {$this->intMat_no}
					ORDER BY e.LAS_NM,e.FIR_NM";
			$request_vsactmat = $this->select_all($sql);

			$request = array('empresa' => $request_empresa,'insumos' => $request_insumos,'acta' => $request_vsactmat,'parcial' => $parcia);
			return $request; 
		}


		// EXTRAE INFORMACION PARA LISTA ESTUDIANTES POR REPARTO
		public function prnActLis(int $sec_id)
		{
			$request = array();
			$this->intSec_id = $sec_id;

			// DATA EMPRESA
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			$sql 				= "SELECT PERIOS,SEC_NO,MAT_NO FROM vssecmat WHERE SEC_ID = {$this->intSec_id}";
			$request_vssecmat 	= $this->select($sql);
			$this->intPerios 	= $request_vssecmat['PERIOS'];
			$this->intSec_no 	= $request_vssecmat['SEC_NO'];
			$this->intMat_no 	= $request_vssecmat['MAT_NO'];


			$sql = "SELECT e.LAS_NM,e.FIR_NM,s.SEC_NM,s.PARALE,s.JOR_NO,m.MAT_NM,
			               v.SEC_ID,v.PERIOS,v.STD_NO,v.MAT_NO
			        FROM vsmatstd v 
			        INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
			        INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO
			        INNER JOIN vsmatter m ON m.MAT_NO = v.MAT_NO
			        WHERE v.PERIOS = {$this->intPerios}
			        AND   v.SEC_NO = {$this->intSec_no}
			        AND   v.MAT_NO = {$this->intMat_no}
					ORDER BY e.LAS_NM,e.FIR_NM";
			$request_vsactmat = $this->select_all($sql);

			$request = array('empresa' => $request_empresa,'acta' => $request_vsactmat);
			return $request; 
		}


		// EXTRAE UN REPARTO
		public function oneVsactmat(int $secID)
		{
			$this->intSec_id = $secID;
			$sql 		= "SELECT * FROM vssecmat WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}
	}
