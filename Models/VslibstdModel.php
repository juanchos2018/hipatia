 <?php

	class VslibstdModel extends Mysql
	{		

		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVslibstd()
		{
			$usu = $_SESSION['userData']['USU_NO'];
			$rol = $_SESSION['userData']['rol_id'];
			$ide = $_SESSION['idUser'];
			switch($rol)
			{
				case 5:  // Docente
						$sql = "SELECT a.STD_NO,
									   a.SEC_NO,
									   a.PERIOS,
									   a.LAS_NM,
								   	   a.FIR_NM,
								   	   a.ESTATU,
								       s.SEC_NM,
								   	   s.PARALE
						FROM vstudent a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						INNER JOIN vssecmat t ON t.SEC_NO = a.SEC_NO AND t.EMP_NO = $usu
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
				case 7:  // Estudiante
						$sql = "SELECT a.STD_NO,
						               a.PERIOS,
				    			       a.LAS_NM,
			    				       a.FIR_NM,
						               a.ESTATU,
		            				   s.SEC_NM,
									   s.PARALE
				        FROM vstudent a
			    	    INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
			        	WHERE a.STD_NO = $usu
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
				case 8:  // Representante
						$sql = "SELECT a.STD_NO,
									   a.PERIOS,
									   a.LAS_NM,
									   a.FIR_NM,
									   a.ESTATU,
									   s.SEC_NM,
									   s.PARALE
						FROM vstudent a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						WHERE a.REPCED = $ide
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
				default:
						$sql = "SELECT  a.STD_NO,
										a.PERIOS,
										a.LAS_NM,
										a.FIR_NM,
										a.ESTATU,
										s.SEC_NM,
										s.PARALE
						FROM vstudent a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						WHERE a.ESTATU != 11
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
			}

			$request = $this->select_all($sql);
			return $request;
		}


		// OBTIENE BOLETIN POR ESTUDIANTE
		public function getLibDetalle(int $secStd, int $perios, string $parcia)
		{
			$request 		 = array();
			$this->intStd_no = intval($secStd);
			$this->intPerios = $perios;
			$this->strParcia = substr($parcia,0,4);

			// DATA EMPRESA
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			// DEFINICION TABLAS INSUMOS
			$sql 				= "SELECT SUB_NO,SUB_NM FROM vstables WHERE TAB_NO = 'INS' AND ESTATU = 1";
			$request_insumos 	= $this->select_all($sql);

			// DETERMINA DEUDA DEL ESTUDIANTE EN DICHO PARCIAL
			$sql 				= "SELECT SUB_NO,SUB_NM,VALORS FROM vstables WHERE TAB_NO = 'PAR' AND SUB_NO = '{$this->strParcia}'";
			$request_parcial 	= $this->select($sql);
			if(empty($request_parcial))
			{
				$request_debts  	= '';
			}else{
				$this->strPer_no 	= str_pad(intval($request_parcial['VALORS']), 3, "0", STR_PAD_LEFT);
				$sql 				= "SELECT * FROM vstariff WHERE PERIOS = {$this->intPerios} AND PER_NO = '{$this->strPer_no}' AND STD_NO = {$this->intStd_no} AND (FACVAL - ABOVAL) > 0";
				$request_debts  	= $this->select($sql);
			}


			// Prepara sentencia SQL para obtener diferentes campos del boletin
			switch(substr($parcia,0,4))
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

			// Se genera la instruccion SQL sobre la tabla VSMATSTD
			$sql = "SELECT e.LAS_NM,e.FIR_NM,s.SEC_NM,s.PARALE,s.JOR_NO,m.MAT_NM,m.CALIFI,
			               m.CUAL01,m.CUAL02,m.CUAL03,m.CUAL04,m.CUAL05,m.CUAL06,m.CUAL07,m.CUAL08,m.CUAL09,m.CUAL10,
						   m.CUAN01,m.CUAN02,m.CUAN03,m.CUAN04,m.CUAN05,m.CUAN06,m.CUAN07,m.CUAN08,m.CUAN09,m.CUAN10,"."$QPI"."
			               v.Q1_PRO,v.Q2_PRO 
			        FROM vsmatstd v 
			        INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
			        INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO
			        INNER JOIN vsmatter m ON m.MAT_NO = v.MAT_NO
					INNER JOIN vssecmat t ON t.SEC_NO = v.SEC_NO AND t.MAT_NO = v.MAT_NO AND t.PERIOS = v.PERIOS
			        WHERE v.PERIOS = {$this->intPerios} AND v.STD_NO = {$this->intStd_no}
					ORDER BY t.ORDERS";
					$request_student = $this->select_all($sql);

			// Prepara la respuesta para el controlador
			$request = array('empresa' => $request_empresa,
							 'insumos' => $request_insumos,
            	             'estudiante' => $request_student,
            	             'parcial' => $parcia,
							 'debstd' => $request_debts,
           					);
			return $request; 
		}
	}
