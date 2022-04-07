 <?php

	class VsactsavModel extends Mysql
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


		public function selectVsactsav()
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
									e.FIR_NM
					FROM vssecmat a
					INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
					INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
					INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
					WHERE a.EMP_NO = $usu
					ORDER BY s.NIV_NO,s.PARALE,a.ORDERS";
					break;
				default: 
					$sql = "SELECT 	a.SEC_ID,
					               	s.SEC_NM,
					               	s.PARALE,
			        		       	m.MAT_NM,
				    	           	m.REGIME,
								   	e.LAS_NM,
								   	e.FIR_NM
				    FROM vssecmat a
				    INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
		    		INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
				    INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
					ORDER BY s.NIV_NO,s.PARALE,a.ORDERS";
					break;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// TRUNCAR A n DECIMALES
		public function truncateFloat($number, $digitos)
		{
		    $raiz = 10;
    		$multiplicador = pow($raiz,$digitos);
    		$resultado = ((int)($number * $multiplicador)) / $multiplicador;
		    return number_format($resultado, $digitos);
		}


		// GUARDA CALIFICACION GENERAL
		public function getSavOne(int $sec_id, string $parcia, float $califi)
		{
			$return          = "";
			$this->intSec_id = $sec_id;
			$this->strParcia = $parcia;
			$this->intCalifi = $califi;
			$this->strParcod = substr($this->strParcia,0,4);
			$this->strInsumo = substr($this->strParcia,4,2);

			if($this->strInsumo == 'I1' OR $this->strInsumo == 'I2' OR $this->strInsumo == 'I3' OR $this->strInsumo == 'I4')
			{
				// Valida en VSTABLES que la calificación no sobrepase el valor de la tabla
				$sql              = "SELECT VALORS FROM vstables WHERE TAB_NO = 'INS' AND SUB_NO = '{$this->strInsumo}'";
				$request_vstables = $this->select($sql);
				if(!empty($request_vstables))
				{
					if($this->intCalifi > $request_vstables['VALORS'])
					{
						// PUNTAJE MAYOR
						$return = -1;
						return $return;
					}
				}
			}else{
				// Valida en VSDEFAUL que la calificación no sobrepase el valor de la tabla
				$sql              = "SELECT BASCAL FROM vsdefaul";
				$request_vsdefaul = $this->select($sql);
				if(!empty($request_vsdefaul))
				{
					if($this->intCalifi > $request_vsdefaul['BASCAL'])
					{
						// PUNTAJE MAYOR
						$return = -1;
						return $return;
					}
				}
			}

			$sql     			= "SELECT * FROM vsmatstd WHERE SEC_ID = {$this->intSec_id}";
			$request_vsmatstd 	= $this->select($sql);
			if(!empty($request_vsmatstd))
			{
				// Busca en VSMATTER el NOMBRE DE ASIGNATURA
				$this->intMat_no 	= $request_vsmatstd['MAT_NO'];
				$sql              	= "SELECT MAT_NM FROM vsmatter WHERE MAT_NO = {$this->intMat_no}";
				$request_vsmatter 	= $this->select($sql);
				if(!empty($request_vsmatter))
				{
					$this->strMat_nm = $request_vsmatter['MAT_NM'];

					// Busca en VSDEFAUL el parametro de Ponderación
					$sql              = "SELECT INSNUM,PARPOR,EXAPOR FROM vsdefaul";
					$request_vsdefaul = $this->select($sql);
					if(!empty($request_vsdefaul))
					{
						$this->intInsnum = $request_vsdefaul['INSNUM'];
						$this->intParpor = $request_vsdefaul['PARPOR'];
						$this->intExapor = $request_vsdefaul['EXAPOR'];
					}
				
					$mQ1p1pr = 0;
					$mQ1p2pr = 0;
					$mQ1p3pr = 0;
					$mQ1p4pr = 0;
					$mQ1_pro = 0;
					$mQ2p1pr = 0;
					$mQ2p2pr = 0;
					$mQ2p3pr = 0;
					$mQ2p4pr = 0;
					$mQ2_pro = 0;
					$mProfin = 0;

					if($this->strParcia == 'SUPLET')
					{
						$mSuplet = $this->intCalifi;
					}else{
						$mSuplet = $request_vsmatstd['SUPLET'];
					}
	
					// QUIMESTRE
					for ($q = 1; $q <= 2; $q++) 
					{
						// PARCIAL
						$parnum = 0;
						$parsum = 0;
						$exasum = 0;
						for ($p = 1; $p <= 4; $p++) 
						{
							// INSUMO
							$instot = 0;
							$numpro = 0;
							$inspro = 0;
							$numsum = 0;
							$inssum = 0;
							for ($ins = 1; $ins <= $this->intInsnum; $ins++) 
							{
								// Busca en VSTABLES el TIPO DE CALCULO DE INSUMOS
								$insumo  			= "I".$ins;
								$sql 				= "SELECT PROCES,VALOR2 FROM vstables WHERE TAB_NO = 'INS' AND SUB_NO = '{$insumo}'";
								$request_vstables 	= $this->select($sql);
								if(!empty($request_vstables))
								{
									$this->intProces = $request_vstables['PROCES'];
									$this->intPorcen = $request_vstables['VALOR2'];

									$campo  = "Q".$q."P".$p."I".$ins;
									$prydi  = "Q".$q."P".$p."DI";
									$prymd  = "Q".$q."P".$p."MD";

									if($this->strParcia == $campo)
									{
										$this->intPuntaj = $this->intCalifi;
									}else{
										$this->intPuntaj = $request_vsmatstd[$campo];
									}

									if($this->intPuntaj > 0)
									{
										$instot = $instot + 1;
										if($this->intProces == 1)
										{
											$numsum = $numsum + 1;
											$inssum = $inssum + $this->intPorcen * $this->intPuntaj / 100;
										}else{
											$numpro = $numpro + 1;
											$inspro = $inspro + $this->intPorcen * $this->intPuntaj / 100;
										}
									}
								}
							}

							$proyec  = 0;
							switch($this->strParcia)
							{
								case $prydi:
									$proyec  = $this->truncateFloat(($this->intCalifi + $request_vsmatstd[$prymd]) / 2,2);
									break;
								case $prymd:
									$proyec  = $this->truncateFloat(($this->intCalifi + $request_vsmatstd[$prydi]) / 2,2);
									break;
								default:
									$proyec  = $this->truncateFloat(($request_vsmatstd[$prydi] + $request_vsmatstd[$prymd]) / 2,2);
									break;
							}
	
							if($numsum == 0 and $numpro == 0)
							{
								$inscal = 0;
							}else if($numsum == 0){
								$inscal  = $this->truncateFloat($inspro / $numpro,2);
							}else if($numpro == 0){
								$inscal  = $this->truncateFloat($inssum / $numsum,2);
							}else{
								$inscal  = $this->truncateFloat($inssum / $numsum,2) + $this->truncateFloat($inspro / $numpro,2);
							}

							if($inscal > 0 and $proyec > 0)
							{
								$inscal  = $this->truncateFloat(($inscal + $proyec) / 2,2);
							}

							$karpro  = "Q".$q."P".$p."PR";
							$parpro  = "mQ".$q."p".$p."pr";
							if($inscal > 0)
							{
								// NUMERO DE INSUMOS NECESARIOS
								if($this->intInsnum > $instot)
								{
									$$parpro = 0;
								}else{
									$$parpro = $inscal;
								}
							}else if($this->strParcia == $karpro){
								$$parpro = $this->intCalifi;
							}else{
								$$parpro = $request_vsmatstd[$karpro];
							}

							if($p < 4)
							{
								$parsum = $parsum + $$parpro;
								if($$parpro > 0)
								{
									$parnum = $parnum + 1;
								}
							}else{
								$exasum = $$parpro;
							}
						}

						$quipro  = "mQ".$q."_pro";
						if($parnum == 0)
						{
							$$quipro = 0;
						}else{
							if($this->strMat_nm == 'COMPORTAMIENTO')
							{
								$$quipro = round(($parsum / $parnum), 2, PHP_ROUND_HALF_DOWN);
							}else{
								$$quipro = $this->truncateFloat($parsum / $parnum * $this->intParpor / 100,2) + $this->truncateFloat($exasum * $this->intExapor / 100,2);
							}
						}
					}

					if($mQ1_pro == 0 or $mQ2_pro == 0)
					{
						$mProfin = 0;
					}else{
						$mProfin = $this->truncateFloat(($mQ1_pro + $mQ2_pro) / 2,2);
						if($mProfin < 4 AND $this->strMat_nm != 'COMPORTAMIENTO')
						{
							$mProfin = 0;
						}else{
							if($mProfin < 7 AND $this->strMat_nm != 'COMPORTAMIENTO')
							{
								if($mSuplet >= 7)
								{
									$mProfin = 7;
								}else{
									$mProfin = 0;
								}
							}else{
								$mProfin = $this->truncateFloat(($mQ1_pro + $mQ2_pro) / 2,2);
							}
						}
					}
			
					// Actualiza VSMATSTD
					$update			= "UPDATE vsmatstd SET {$this->strParcia} = ?, Q1P1PR = ?, Q1P2PR = ?, Q1P3PR = ?, Q1P4PR = ?, Q1_PRO = ?, Q2P1PR = ?, Q2P2PR = ?, Q2P3PR = ?, Q2P4PR = ?, Q2_PRO = ?, PROFIN = ? WHERE SEC_ID = {$this->intSec_id}";
					$arrData  		= array($this->intCalifi,$mQ1p1pr,$mQ1p2pr,$mQ1p3pr,$mQ1p4pr,$mQ1_pro,$mQ2p1pr,$mQ2p2pr,$mQ2p3pr,$mQ2p4pr,$mQ2_pro,$mProfin);
					$request_update = $this->update($update,$arrData);
					$return         = $request_update;
				}
			}
			return $return;
		}


		// GUARDA CALIFICACION ACTIVIDADES
		public function getSavAct(int $sec_id, string $parcia, float $califi)
		{
			$return          = "";
			$this->intSec_id = $sec_id;
			$this->strParcia = $parcia;
			$this->intCalifi = $califi;
			$this->strParcod = substr($this->strParcia,0,4);
			$this->strInsumo = substr($this->strParcia,4,2);

			if($this->strInsumo == 'I1' OR $this->strInsumo == 'I2' OR $this->strInsumo == 'I3' OR $this->strInsumo == 'I4')
			{
				// Valida en VSTABLES que la calificación no sobrepase el valor de la tabla
				$sql              = "SELECT VALORS FROM vstables WHERE TAB_NO = 'INS' AND SUB_NO = '{$this->strInsumo}'";
				$request_vstables = $this->select($sql);
				if(!empty($request_vstables))
				{
					if($this->intCalifi > $request_vstables['VALORS'])
					{
						// PUNTAJE MAYOR
						$return = -1;
						return $return;
					}
				}
			}else{
				// Valida en VSDEFAUL que la calificación no sobrepase el valor de la tabla
				$sql              = "SELECT BASCAL FROM vsdefaul";
				$request_vsdefaul = $this->select($sql);
				if(!empty($request_vsdefaul))
				{
					if($this->intCalifi > $request_vsdefaul['BASCAL'])
					{
						// PUNTAJE MAYOR
						$return = -1;
						return $return;
					}
				}
			}

			$sql     			= "SELECT * FROM vschedul WHERE SEC_ID = {$this->intSec_id}";
			$request_vschedul 	= $this->select($sql);
			if(!empty($request_vschedul))
			{
				$this->intPerios 	= $request_vschedul['PERIOS'];
				$this->intStd_no 	= $request_vschedul['STD_NO'];
				$this->intMat_no 	= $request_vschedul['MAT_NO'];

				$insert         	= "UPDATE vschedul SET puntaj = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        	= array($this->intCalifi);
				$request_insert 	= $this->update($insert,$arrData);
				$return         	= $request_insert;

				// Suma todos los puntajes del Estudiante en la Asinatura el Parcial e Insumo y agrupa en VSMATSTD
				$sql    		 = "SELECT truncate(avg(PUNTAJ),2) as promedio FROM vschedul WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND MAT_NO = {$this->intMat_no} AND PARCIA = '{$this->strParcia}' AND PUNTAJ > 0";
				$arrPuntajes 	 = $this->select($sql);
				$this->intProptj = 0;
					
				if($arrPuntajes['promedio'] != "")
				{
				   $this->intProptj = $arrPuntajes['promedio'];			
				} 

				// Examina si existe el registro en VSMATSTD por Año Estudiante y Asignatura
				$sql     		  = "SELECT * FROM vsmatstd WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND MAT_NO = {$this->intMat_no}";
				$request_vsmatstd = $this->select($sql);
				if(!empty($request_vsmatstd))
				{
					// Busca en VSMATTER el NOMBRE DE ASIGNATURA
					$sql              	= "SELECT MAT_NM FROM vsmatter WHERE MAT_NO = {$this->intMat_no}";
					$request_vsmatter 	= $this->select($sql);
					if(!empty($request_vsmatter))
					{
						$this->strMat_nm = $request_vsmatter['MAT_NM'];

						// Busca en VSDEFAUL el parametro de Ponderación
						$sql              = "SELECT INSNUM,PARPOR,EXAPOR FROM vsdefaul";
						$request_vsdefaul = $this->select($sql);
						if(!empty($request_vsdefaul))
						{
							$this->intInsnum = $request_vsdefaul['INSNUM'];
							$this->intParpor = $request_vsdefaul['PARPOR'];
							$this->intExapor = $request_vsdefaul['EXAPOR'];
						}
				
						$mQ1p1pr = 0;
						$mQ1p2pr = 0;
						$mQ1p3pr = 0;
						$mQ1p4pr = 0;
						$mQ1_pro = 0;
						$mQ2p1pr = 0;
						$mQ2p2pr = 0;
						$mQ2p3pr = 0;
						$mQ2p4pr = 0;
						$mQ2_pro = 0;
						$mProfin = 0;

						if($this->strParcia == 'SUPLET')
						{
							$mSuplet = $this->intCalifi;
						}else{
							$mSuplet = $request_vsmatstd['SUPLET'];
						}
	
						// QUIMESTRE
						for ($q = 1; $q <= 2; $q++) 
						{
							// PARCIAL
							$parnum = 0;
							$parsum = 0;
							$exasum = 0;
							for ($p = 1; $p <= 4; $p++) 
							{
								// INSUMO
								$instot = 0;
								$numpro = 0;
								$inspro = 0;
								$numsum = 0;
								$inssum = 0;
								for ($ins = 1; $ins <= $this->intInsnum; $ins++) 
								{
									// Busca en VSTABLES el TIPO DE CALCULO DE INSUMOS
									$insumo  			= "I".$ins;
									$sql 				= "SELECT PROCES,VALOR2 FROM vstables WHERE TAB_NO = 'INS' AND SUB_NO = '{$insumo}'";
									$request_vstables 	= $this->select($sql);
									if(!empty($request_vstables))
									{
										$this->intProces = $request_vstables['PROCES'];
										$this->intPorcen = $request_vstables['VALOR2'];

										$campo  = "Q".$q."P".$p."I".$ins;
										$prydi  = "Q".$q."P".$p."DI";
										$prymd  = "Q".$q."P".$p."MD";

										if($this->strParcia == $campo)
										{
											$this->intPuntaj = $this->intCalifi;
										}else{
											$this->intPuntaj = $request_vsmatstd[$campo];
										}

										if($this->intPuntaj > 0)
										{
											$instot = $instot + 1;
											if($this->intProces == 1)
											{
												$numsum = $numsum + 1;
												$inssum = $inssum + $this->intPorcen * $this->intPuntaj / 100;
											}else{
												$numpro = $numpro + 1;
												$inspro = $inspro + $this->intPorcen * $this->intPuntaj / 100;
											}
										}
									}
								}

								$proyec  = 0;
								switch($this->strParcia)
								{
									case $prydi:
										$proyec  = $this->truncateFloat(($this->intCalifi + $request_vsmatstd[$prymd]) / 2,2);
										break;
									case $prymd:
										$proyec  = $this->truncateFloat(($this->intCalifi + $request_vsmatstd[$prydi]) / 2,2);
										break;
									default:
										$proyec  = $this->truncateFloat(($request_vsmatstd[$prydi] + $request_vsmatstd[$prymd]) / 2,2);
										break;
								}
	
								if($numsum == 0 and $numpro == 0)
								{
									$inscal = 0;
								}else if($numsum == 0){
									$inscal  = $this->truncateFloat($inspro / $numpro,2);
								}else if($numpro == 0){
									$inscal  = $this->truncateFloat($inssum / $numsum,2);
								}else{
									$inscal  = $this->truncateFloat($inssum / $numsum,2) + $this->truncateFloat($inspro / $numpro,2);
								}

								if($inscal > 0 and $proyec > 0)
								{
									$inscal  = $this->truncateFloat(($inscal + $proyec) / 2,2);
								}

								$karpro  = "Q".$q."P".$p."PR";
								$parpro  = "mQ".$q."p".$p."pr";
								if($inscal > 0)
								{
									// NUMERO DE INSUMOS NECESARIOS
									if($this->intInsnum > $instot)
									{
										$$parpro = 0;
									}else{
										$$parpro = $inscal;
									}
								}else if($this->strParcia == $karpro){
									$$parpro = $this->intCalifi;
								}else{
									$$parpro = $request_vsmatstd[$karpro];
								}

								if($p < 4)
								{
									$parsum = $parsum + $$parpro;
									if($$parpro > 0)
									{
										$parnum = $parnum + 1;
									}
								}else{
									$exasum = $$parpro;
								}
							}

							$quipro  = "mQ".$q."_pro";
							if($parnum == 0)
							{
								$$quipro = 0;
							}else{
								if($this->strMat_nm == 'COMPORTAMIENTO')
								{
									$$quipro = round(($parsum / $parnum), 2, PHP_ROUND_HALF_DOWN);
								}else{
									$$quipro = $this->truncateFloat($parsum / $parnum * $this->intParpor / 100,2) + $this->truncateFloat($exasum * $this->intExapor / 100,2);
								}
							}
						}

						if($mQ1_pro == 0 or $mQ2_pro == 0)
						{
							$mProfin = 0;
						}else{
							$mProfin = $this->truncateFloat(($mQ1_pro + $mQ2_pro) / 2,2);
							if($mProfin < 4 AND $this->strMat_nm != 'COMPORTAMIENTO')
							{
								$mProfin = 0;
							}else{
								if($mProfin < 7 AND $this->strMat_nm != 'COMPORTAMIENTO')
								{
									if($mSuplet >= 7)
									{
										$mProfin = 7;
									}else{
										$mProfin = 0;
									}
								}else{
									$mProfin = $this->truncateFloat(($mQ1_pro + $mQ2_pro) / 2,2);
								}
							}
						}
			
						// Actualiza VSMATSTD
						$update			= "UPDATE vsmatstd SET {$this->strParcia} = ?, Q1P1PR = ?, Q1P2PR = ?, Q1P3PR = ?, Q1P4PR = ?, Q1_PRO = ?, Q2P1PR = ?, Q2P2PR = ?, Q2P3PR = ?, Q2P4PR = ?, Q2_PRO = ?, PROFIN = ? WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND MAT_NO = {$this->intMat_no}";
						$arrData  		= array($this->intProptj,$mQ1p1pr,$mQ1p2pr,$mQ1p3pr,$mQ1p4pr,$mQ1_pro,$mQ2p1pr,$mQ2p2pr,$mQ2p3pr,$mQ2p4pr,$mQ2_pro,$mProfin);
						$request_update = $this->update($update,$arrData);
						$return         = $request_update;
					}
				}
			}
			return $return;
		}


		// OBTIENE DATA ACTA DE CALIFICACIONES
		public function getVsactdet(int $perios, int $sec_no, int $mat_no, int $caltyp, string $parcia)
		{
			$request = array();
			$this->intPerios = $perios;
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intCaltyp = $caltyp;
			$this->strParcia = $parcia;
			$this->strParcil = substr($parcia,0,4);

			// DATA EMPRESA
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			// DATA INSUMOS DE VSTABLES
			$sql 				= "SELECT SUB_NO,SUB_NM FROM vstables WHERE TAB_NO = 'INS' AND ESTATU = 1";
			$request_insumos 	= $this->select_all($sql);			

			// QUERY ACTA DE CALIFICACIONES
			if($this->intCaltyp == 1)
			{
				$sql = "SELECT e.LAS_NM,e.FIR_NM,s.SEC_NM,s.PARALE,s.JOR_NO,m.MAT_NM,v.SEC_ID,v.PERIOS,v.STD_NO,v.MAT_NO,v.PUNTAJ,v.SCHEDU,v.PARCIA,v.INSUMO,t.SUB_NM,v.FECREG
						FROM vschedul v 
		 				INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
		 				INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO
		 				INNER JOIN vsmatter m ON m.MAT_NO = v.MAT_NO
						INNER JOIN vstables t ON t.SUB_NO = v.INSUMO
		 				WHERE v.PERIOS = {$this->intPerios}
		 				AND   v.SEC_NO = {$this->intSec_no}
		 				AND   v.MAT_NO = {$this->intMat_no}
						AND   SUBSTRING(v.PARCIA,1,4) = '{$this->strParcil}'
						AND   v.PUNTAJ = 0
		 				ORDER BY v.FECREG DESC,e.LAS_NM,e.FIR_NM";
 				$request_vsactsav = $this->select_all($sql);
			}else{
				switch($this->strParcia)
				{
					case 'Q1P1PR': $QPI = 'v.Q1P1I1,v.Q1P1I2,v.Q1P1I3,v.Q1P1I4,v.Q1P1I5,v.Q1P1PR,';
								break;
					case 'Q1P2PR': $QPI = 'v.Q1P2I1,v.Q1P2I2,v.Q1P2I3,v.Q1P2I4,v.Q1P2I5,v.Q1P2PR,';
								break;
					case 'Q1P3PR': $QPI = 'v.Q1P3I1,v.Q1P3I2,v.Q1P3I3,v.Q1P3I4,v.Q1P3I5,v.Q1P3PR,';
								break;
					case 'Q1P1PY': $QPI = 'v.Q1P1DI,v.Q1P1MD,v.Q1P1PR,';
								break;
					case 'Q1P2PY': $QPI = 'v.Q1P2DI,v.Q1P2MD,v.Q1P2PR,';
								break;
					case 'Q1_PRO': $QPI = 'v.Q1P1PR,v.Q1P2PR,v.Q1P4PR,';
								break;
					case 'Q2P1PR': $QPI = 'v.Q2P1I1,v.Q2P1I2,v.Q2P1I3,v.Q2P1I4,v.Q2P1I5,v.Q2P1PR,';
								break;
					case 'Q2P2PR': $QPI = 'v.Q2P2I1,v.Q2P2I2,v.Q2P2I3,v.Q2P2I4,v.Q2P2I5,v.Q2P2PR,';
								break;
					case 'Q2P3PR': $QPI = 'v.Q2P3I1,v.Q2P3I2,v.Q2P3I3,v.Q2P3I4,v.Q2P3I5,v.Q2P3PR,';
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

				$sql = "SELECT 	e.LAS_NM,e.FIR_NM,s.SEC_NM,s.PARALE,s.JOR_NO,m.MAT_NM,m.CALIFI,
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
 				$request_vsactsav = $this->select_all($sql);
 			}

			$request = array('empresa' => $request_empresa,'caltyp' => $caltyp,'insumos' => $request_insumos,'acta' => $request_vsactsav,'parcial' => $parcia);
			return $request; 
		}

		
		// EXTRAE UN REPARTO
		public function oneVsactsav(int $secID)
		{
			$this->intSec_id = $secID;
			$sql 		= "SELECT * FROM vssecmat WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}
	}
