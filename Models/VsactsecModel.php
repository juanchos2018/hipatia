 <?php

	class VsactsecModel extends Mysql
	{
		public $intSec_no;
		public $intNiv_no;
		public $strParale;
		public $strSec_nm;
		public $intPabell;
		public $intModoes;
		public $intRegime;
		public $intJor_no;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// Obtiene promedio de pase de año lectivo por Estudiante
		public function getVsstdpro(int $std_no, int $perios, int $condition)
		{
			$this->intStd_no    = $std_no;
			$this->intPerios    = $perios;
			$this->intCondition = $condition;

			switch ($condition)
			{
				case 1:
						// Primer Quimestre
						$sql = "SELECT STD_NO as codeStd,truncate(avg(a.Q1_PRO),2) as promedio
						        FROM vsmatstd a
    	    		            INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO
								WHERE a.PERIOS = {$this->intPerios} AND a.STD_NO = {$this->intStd_no}
            	        		AND m.REGIME = 1
        	        	    	AND m.CALIFI = 1";
						$arrPuntajes 	 = $this->select($sql);
						$this->intProptj = 0;
					
						if($arrPuntajes['promedio'] != "")
						{
							$this->intProptj = $arrPuntajes['promedio'];			
						}
						return $this->intProptj;
						break;
				case 2:
						// Segundo Quimestre
						$sql = "SELECT STD_NO as codeStd,truncate(avg(a.Q2_PRO),2) as promedio
								FROM vsmatstd a
								INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO
								WHERE a.PERIOS = {$this->intPerios} AND a.STD_NO = {$this->intStd_no}
								AND m.REGIME = 1
								AND m.CALIFI = 1";
						$arrPuntajes 	 = $this->select($sql);
						$this->intProptj = 0;
						
						if($arrPuntajes['promedio'] != "")
						{
							$this->intProptj = $arrPuntajes['promedio'];			
						}
						return $this->intProptj;
						break;
				default:
						// Determina si el estudiante esta en Supletorio
						$sql = "SELECT a.PROFIN
						        FROM vsmatstd a
                			    INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO
								WHERE a.PERIOS = {$this->intPerios} AND a.STD_NO = {$this->intStd_no}
			                    AND m.REGIME = 1
            			        AND m.CALIFI = 1
								AND a.PROFIN > 0
								AND a.PROFIN < 7";
						$request = $this->select_all($sql);
						if(empty($request))
						{
							// Estudiante aprueba año lectivo
							$sql = "SELECT a.PERIOS,a.STD_NO as codeStd,truncate(avg(a.PROFIN),2) as promedio,m.REGIME,m.CALIFI
				        			FROM vsmatstd a
			    	                INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO
									WHERE a.PERIOS = {$this->intPerios} AND a.STD_NO = {$this->intStd_no}
			            	        AND m.REGIME = 1
            			    	    AND m.CALIFI = 1
									AND a.PROFIN >= 7";
							$arrPuntajes 	 = $this->select($sql);
							if(empty($arrPuntajes))
							{
								return 0;
							}else{
								$this->intProptj = 0;
								if($arrPuntajes['promedio'] != "")
								{
									$this->intProptj = $arrPuntajes['promedio'];			
								} 	
								return $this->intProptj;
							}
						}else{
							return 0;
						}
						break;
			}
		}


		public function getVssecdet(int $sec_no, int $perios, string $parcia)
		{
			$request = array();
			$this->intPerios  = $perios;
			$this->intSec_no  = intval($sec_no);
			$this->strParcia  = strClean($parcia);

			// DATA EMPRESA
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			// Extrae nombres de las materias en la tabla: VSMATSTD
			$sql = "SELECT DISTINCT m.MAT_NM, s.SEC_NM, s.PARALE, s.JOR_NO, t.ORDERS
					FROM vsmatstd v
				    INNER JOIN vsmatter m ON m.MAT_NO = v.MAT_NO
				    INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO
			        INNER JOIN vssecmat t ON t.SEC_NO = v.SEC_NO AND t.MAT_NO = v.MAT_NO AND t.PERIOS = v.PERIOS
					WHERE v.PERIOS = {$this->intPerios} AND v.SEC_NO = {$this->intSec_no} AND (m.REGIME = 1 OR m.MAT_NM = 'COMPORTAMIENTO')
					ORDER BY t.ORDERS";
			$request_vsmatter = $this->select_all($sql);


			// QUERY sobre la tabla VSMATSTD para obtener listado de estudiantes y sus promedios por materia
			$CALIFICACION = "m.CUAL01,m.CUAL02,m.CUAL03,m.CUAL04,m.CUAL05,m.CUAL06,m.CUAL07,m.CUAL08,m.CUAL09,m.CUAL10,
							 m.CUAN01,m.CUAN02,m.CUAN03,m.CUAN04,m.CUAN05,m.CUAN06,m.CUAN07,m.CUAN08,m.CUAN09,m.CUAN10 ";
			$consulta = "FROM vsmatstd v 
						 INNER JOIN vsmatter m ON m.MAT_NO = v.MAT_NO 
						 INNER JOIN vstudent e ON e.STD_NO = v.STD_NO 
						 INNER JOIN vsstdhis h ON h.STD_NO = v.STD_NO AND h.PERIOS = v.PERIOS
						 INNER JOIN vssecmat t ON t.SEC_NO = v.SEC_NO AND t.MAT_NO = v.MAT_NO AND t.PERIOS = v.PERIOS
						 WHERE v.PERIOS = {$this->intPerios} AND h.ESTATU = 2 AND v.SEC_NO = {$this->intSec_no} AND (m.REGIME = 1 OR m.MAT_NM = 'COMPORTAMIENTO')
						 ORDER BY nombre,t.ORDERS";

			$sql = "";
			switch ($this->strParcia)
			{
				case 'PROMED':
					$sql = "SELECT CONCAT(e.LAS_NM,' ',e.FIR_NM) as nombre, 
							m.MAT_NM as materia, 
							m.CALIFI as calificacion,
							v.STD_NO as codeStd,
							v.Q1_PRO as Q1PR,
							v.Q2_PRO as Q2PR,
							TRUNCATE((v.Q1_PRO + v.Q2_PRO)/2,2) as PRGN, 
							v.SUPLET as SUPL, 
							v.REMEDI as RMDL, 
							v.GRACIA as GRCI, 
							TRUNCATE(v.PROFIN,2) as PRFN, ".$CALIFICACION.$consulta;
					break;
				case 'SUPLET':
					$sql = "SELECT CONCAT(e.LAS_NM,' ',e.FIR_NM) as nombre, 
							m.MAT_NM as materia, 
							m.CALIFI as calificacion,
							v.STD_NO as codeStd,
							v.Q1_PRO as Q1PR,
							v.Q2_PRO as Q2PR,
							TRUNCATE((v.Q1_PRO + v.Q2_PRO)/2,2) as PRGN, 
							v.SUPLET as SUPL, 
							v.REMEDI as RMDL, 
							v.GRACIA as GRCI, 
							TRUNCATE(v.PROFIN,2) as PRFN, ".$CALIFICACION.$consulta;
					break;
				case 'REMEDI':
					$sql = "SELECT CONCAT(e.LAS_NM,' ',e.FIR_NM) as nombre, 
							m.MAT_NM as materia, 
							m.CALIFI as calificacion,
							v.STD_NO as codeStd,
							v.Q1_PRO as Q1PR,
							v.Q2_PRO as Q2PR,
							TRUNCATE((v.Q1_PRO + v.Q2_PRO)/2,2) as PRGN, 
							v.SUPLET as SUPL, 
							v.REMEDI as RMDL, 
							v.GRACIA as GRCI, 
							TRUNCATE(v.PROFIN,2) as PRFN, ".$CALIFICACION.$consulta;
					break;
				case 'GRACIA':
					$sql = "SELECT CONCAT(e.LAS_NM,' ',e.FIR_NM) as nombre, 
							m.MAT_NM as materia, 
							m.CALIFI as calificacion,
							v.STD_NO as codeStd,
							v.Q1_PRO as Q1PR,
							v.Q2_PRO as Q2PR,
							TRUNCATE((v.Q1_PRO + v.Q2_PRO)/2,2) as PRGN, 
							v.SUPLET as SUPL, 
							v.REMEDI as RMDL, 
							v.GRACIA as GRCI, 
							TRUNCATE(v.PROFIN,2) as PRFN, ".$CALIFICACION.$consulta;
					break;
				default:
					$sql = "SELECT CONCAT(e.LAS_NM,' ',e.FIR_NM) as nombre, m.MAT_NM as materia, m.CALIFI as calificacion,
					        TRUNCATE(v.$parcia,2) as nota, ".$CALIFICACION.$consulta;
					break;
			}
			$request_vsmatstd = $this->select_all($sql);

			// Calcula Promedio Final por Estudiante
			$sql = "SELECT DISTINCT a.STD_NO,s.LAS_NM,s.FIR_NM
				    FROM vsmatstd a
				    INNER JOIN vstudent s ON s.STD_NO = a.STD_NO
			        WHERE a.PERIOS = {$this->intPerios} AND a.SEC_NO = {$this->intSec_no}
			        ORDER BY s.LAS_NM,s.FIR_NM";
			$request_proStd = $this->select_all($sql);


			$arrproStd = array();
			$arrpro_01 = array();
			$arrpro_02 = array();

			if(!empty($request_proStd))
			{
	            foreach($request_proStd as $proStd)
	            {
	             	$res_pro 	= $this->getVsstdpro($proStd['STD_NO'],$perios,1);
	             	$arrpro_01[] = array('codeStd' => $proStd['STD_NO'], 'pro_01' => $res_pro);

	             	$res_pro 	= $this->getVsstdpro($proStd['STD_NO'],$perios,2);
	             	$arrpro_02[] = array('codeStd' => $proStd['STD_NO'], 'pro_02' => $res_pro);

					$res_pro 	= $this->getVsstdpro($proStd['STD_NO'],$perios,3);
	             	$arrproStd[] = array('codeStd' => $proStd['STD_NO'], 'proStd' => $res_pro);
				}
        	}

			// Se prepara la respuesta para el controlador
			$request = array('empresa' => $request_empresa,
							 'materias' => $request_vsmatter,
            	             'matxstd' => $request_vsmatstd,
            	             'pro_01' => $arrpro_01,
            	             'pro_02' => $arrpro_02,
            	             'proStd' => $arrproStd,
            	             'parcial' => $parcia,
            	             'periodo' => $perios
           					);
			return $request; 
		}


		public function selectVsactsec()
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
					$sql  = 'SELECT * FROM vsection ORDER BY NIV_NO,PARALE';
					break;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		public function oneVsactsec(int $idSec)
		{
			$this->intSec_no = $idSec;
			$sql 		= "SELECT * FROM vsection WHERE SEC_NO = {$this->intSec_no}";
			$request 	= $this->select($sql);
			return $request;
		}
	}
