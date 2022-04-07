 <?php

	class VslibsecModel extends Mysql
	{

		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE SECCIONES
		public function selectVslibsec()
		{
			$usu = $_SESSION['userData']['USU_NO'];
			$rol = $_SESSION['userData']['rol_id'];
			switch($rol)
			{
				case 5:  // Docente
						$sql = "SELECT 	a.SEC_NO,
										s.SEC_NM,
										s.NIV_NO,
										s.PARALE,
										s.JOR_NO
						FROM vssecmat a
						INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
						INNER JOIN vsemplox e ON a.EMP_NO = e.EMP_NO
						WHERE a.EMP_NO = $usu
						ORDER BY s.NIV_NO,s.PARALE";
						break;
				default: 
						// Extrae Secciones
						$sql  = "SELECT * FROM vsection ORDER BY NIV_NO,PARALE";
						break;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE BOLETIN POR SECCION
		public function getLibDetail(int $sec_no, int $perios, string $parcia)
		{
			$request 		 = array();
			$this->intSec_no = $sec_no;
			$this->intPerios = $perios;
			$this->strParcia = substr($parcia,0,4);

			// DATA EMPRESA
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			// DATA TABLAS INSUMOS
			$sql 				= "SELECT SUB_NO,SUB_NM FROM vstables WHERE TAB_NO = 'INS' AND ESTATU = 1";
			$request_insumos 	= $this->select_all($sql);

			// Prepara sentencia SQL para obtener campos del boletin
			switch($this->strParcia)
			{
				case 'Q1P1': 
					$QPI = 'v.Q1P1I1,v.Q1P1I2,v.Q1P1I3,v.Q1P1I4,v.Q1P1I5,v.Q1P1DI,v.Q1P1MD,v.Q1P1PR,';
					break;
				case 'Q1P2':
				 	$QPI = 'v.Q1P2I1,v.Q1P2I2,v.Q1P2I3,v.Q1P2I4,v.Q1P2I5,v.Q1P2DI,v.Q1P2MD,v.Q1P2PR,';
				 	break;
				case 'Q1P3':
					$QPI = 'v.Q1P3I1,v.Q1P3I2,v.Q1P3I3,v.Q1P3I4,v.Q1P3I5,v.Q1P3DI,v.Q1P3MD,v.Q1P3PR,';
					break;
				case 'Q1_P':
					$QPI = 'v.Q1P1PR,v.Q1P2PR,v.Q1P3PR,v.Q1P4PR,';
					break;
				case 'Q2P1': 
					$QPI = 'v.Q2P1I1,v.Q2P1I2,v.Q2P1I3,v.Q2P1I4,v.Q2P1I5,v.Q2P1DI,v.Q2P1MD,v.Q2P1PR,';
					break;
				case 'Q2P2':
					$QPI = 'v.Q2P2I1,v.Q2P2I2,v.Q2P2I3,v.Q2P2I4,v.Q2P2I5,v.Q2P2DI,v.Q2P2MD,v.Q2P2PR,';
					break;
				case 'Q2P3':
					$QPI = 'v.Q2P3I1,v.Q2P3I2,v.Q2P3I3,v.Q2P3I4,v.Q2P3I5,v.Q2P3DI,v.Q2P3MD,v.Q2P3PR,';
					break;
				case 'Q2_P':
					$QPI = 'v.Q2P1PR,v.Q2P2PR,v.Q2P3PR,v.Q2P4PR,';
					break;
				case 'PROF':
					$QPI = 'v.Q1_PRO,v.Q2_PRO,v.SUPLET,v.REMEDI,v.GRACIA,v.PROFIN,';
					break;
			}

			// QUERY SQL sobre la tabla VSMATSTD
			$sql = "SELECT e.LAS_NM,e.FIR_NM,s.SEC_NM,s.PARALE,s.JOR_NO,m.MAT_NM,m.CALIFI,
			               m.CUAL01,m.CUAL02,m.CUAL03,m.CUAL04,m.CUAL05,m.CUAL06,m.CUAL07,m.CUAL08,m.CUAL09,m.CUAL10,
						   m.CUAN01,m.CUAN02,m.CUAN03,m.CUAN04,m.CUAN05,m.CUAN06,m.CUAN07,m.CUAN08,m.CUAN09,m.CUAN10,"."$QPI"."
			               v.STD_NO,v.Q1_PRO,v.Q2_PRO 
			        FROM vsmatstd v 
			        INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
			        INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO
			        INNER JOIN vsmatter m ON m.MAT_NO = v.MAT_NO
					INNER JOIN vssecmat t ON t.SEC_NO = v.SEC_NO AND t.MAT_NO = v.MAT_NO AND t.PERIOS = v.PERIOS
			        WHERE v.PERIOS = {$this->intPerios} AND v.SEC_NO = {$this->intSec_no} 
					ORDER BY e.LAS_NM,e.FIR_NM,t.ORDERS";
					$request_vstudent = $this->select_all($sql);

			// Prepara la respuesta para el controlador
			$request = array('empresa' => $request_empresa,
							 'insumos' => $request_insumos,
            	             'estudiante' => $request_vstudent,
            	             'parcial' => $parcia,
           					);
			return $request; 
		}


		// EXTRAE UNA SECCION
		public function oneVslibsec(int $idSec)
		{
			$this->intSec_no = $idSec;
			$sql 		= "SELECT * FROM vsection WHERE SEC_NO = {$this->intSec_no}";
			$request 	= $this->select($sql);
			return $request;
		}
	}
