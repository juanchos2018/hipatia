 <?php

	class VscersecModel extends Mysql
	{

		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE SECCIONES
		public function selectVscersec()
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


		// EXTRAE DATA CERTIFICADO POR SECCION
		public function getCerDetalle(int $sec_no, int $perios, string $certip, string $fecreg)
		{
			$request 	= array();
			$arrproStd 	= array();
			$arrproDis 	= array();

			$this->intSec_no = $sec_no;
			$this->intPerios = $perios;
			$fecha = $fecreg;

			// DATA EMPRESA
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			// QUERY SQL VSMATSTD
			$sql = "SELECT e.LAS_NM,e.FIR_NM,s.SEC_NM,s.PARALE,s.JOR_NO,s.SEC_N2,m.MAT_NM,v.PERIOS,TRUNCATE(v.PROFIN,2) as PROFIN
			        FROM vsmatstd v 
			        INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
			        INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO
			        INNER JOIN vsmatter m ON m.MAT_NO = v.MAT_NO
					INNER JOIN vssecmat t ON t.SEC_NO = v.SEC_NO AND t.MAT_NO = v.MAT_NO AND t.PERIOS = v.PERIOS
			        WHERE v.PERIOS = {$this->intPerios} AND v.SEC_NO = {$this->intSec_no} AND m.REGIME = 1
			        ORDER BY t.ORDERS";
			$request_vstudent = $this->select_all($sql);

			$proSup = '';
			if(empty($request_vstudent))
			{
			}else{
				// SECCION INMEDIATO SUPERIOR
				if($request_vstudent[0]['SEC_N2'] != 0)
				{
					$request_promovido 	= $request_vstudent[0]['SEC_N2'];
					$sql 				= "SELECT SEC_NM FROM vsection WHERE SEC_NO = ".$request_promovido;
					$request_proSup 	= $this->select($sql);
					$proSup 			= $request_proSup['SEC_NM'];
				}
			}


			// INFORMACION HISTORICO MATRICULA Y FOLIO
			$sql 				= "SELECT STD_NO,MATNUM,FOLNUM,FECMAT FROM vsstdhis WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no}";
			$request_vsstdhis 	= $this->select($sql);


			// OBTIENE PROMEDIO ACADEMICO
			require_once ("VsactsecModel.php");
			$objPromedio = new VsactsecModel();
           	$res_pro 		= $objPromedio->getVsstdpro($this->intStd_no,$this->intPerios,3);
           	$arrproStd[] 	= array('codeStd' => $this->intStd_no, 'proStd' => $res_pro);

			// OBTIENE PROMEDIO DE COMPORTAMIENTO
			$sql = "SELECT ROUND(a.PROFIN) as PROFIN,m.MAT_NM,m.CALIFI,
			               m.CUAL01,m.CUAL02,m.CUAL03,m.CUAL04,m.CUAL05,m.CUAL06,m.CUAL07,m.CUAL08,m.CUAL09,m.CUAL10,
						   m.CUAN01,m.CUAN02,m.CUAN03,m.CUAN04,m.CUAN05,m.CUAN06,m.CUAN07,m.CUAN08,m.CUAN09,m.CUAN10
				    FROM vsmatstd a
				    INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO
			        WHERE a.PERIOS = {$this->intPerios} AND a.STD_NO = {$this->intStd_no} AND m.MAT_NM = 'COMPORTAMIENTO'";
 			$arrproDis = $this->select($sql);

			$proDis = 0;
			$proTab = '-----';

			if(!empty($arrproDis))
			{
				if($arrproDis['PROFIN'] != "")
				{
					$proDis = $arrproDis['PROFIN'];

					// OBTIENE TABLA DE COMPORTAMIENTO
					$sql 		= "SELECT SUB_NM FROM vstables WHERE TAB_NO = 'DIS' AND SUB_NO = ".$proDis;
					$arrTabDis 	= $this->select($sql);
					if(empty($arrTabDis))
					{
						$proTab 	= '-----';
					}else{
						$proTab 	= $arrTabDis['SUB_NM'];
					}
				}
			}

			// Se prepara la respuesta para el controlador
			$request = array('empresa' => $request_empresa,
            	             'estudiante' => $request_vstudent,
            	             'matricula' => $request_vsstdhis,
            	             'proStd' => $arrproStd,
            	             'proDis' => $arrproDis,
            	             'proTab' => $proTab,
            	             'proSup' => $proSup,
            	             'certip' => $certip,
            	             'fecha' => $fecreg
           					);
			return $request; 
		}


		// EXTRAE UNA SECCION
		public function oneVscersec(int $idSec)
		{
			$this->intSec_no = $idSec;
			$sql 		= "SELECT * FROM vsection WHERE SEC_NO = {$this->intSec_no}";
			$request 	= $this->select($sql);
			return $request;
		}
	}
