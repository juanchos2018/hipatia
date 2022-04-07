 <?php

	class VschedulModel extends Mysql
	{
		public $intSec_id;
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


		public function selectVschedul()
		{
			$usu = $_SESSION['userData']['USU_NO']; // Codigo Registro en Vsexplox o Vstudent
			$ced = $_SESSION['idUser']; 			// Cedula en vsaccess
			$rol = $_SESSION['userData']['rol_id'];

			$sql     = "SELECT PERIOS FROM vsdefaul";
			$request = $this->select($sql);
			$perios  = $request['PERIOS'];

			$sql = "";
			$fieldSelect = 'a.SEC_ID, a.PERIOS, a.FECREG, a.HORREG, s.SEC_NM, s.PARALE,
			    	        m.MAT_NM, m.REGIME, a.SCHEDU, a.PARCIA, a.INSUMO, a.PUNTAJ,
							v.LAS_NM, v.FIR_NM, e.LAS_NM as ELAS_NM, e.FIR_NM as EFIR_NM,a.FLNAME,a.FLTASK
							FROM vschedul a
		        			INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
		        			INNER JOIN vsmatter m ON a.MAT_NO = m.MAT_NO
		        			INNER JOIN vstudent v ON a.STD_NO = v.STD_NO
		        			INNER JOIN vsemplox e ON a.EMP_NO = e.EMP_NO ';

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
							           	a.HORREG,
			        			       	s.SEC_NM,
			            	   			s.PARALE,
				    	    	       	m.MAT_NM,
				        	    	   	m.REGIME,
										a.SCHEDU,
										a.PARCIA,
										a.INSUMO,
										a.PUNTAJ,
										v.LAS_NM,
						              	v.FIR_NM,
										e.LAS_NM as ELAS_NM,
			            	  			e.FIR_NM as EFIR_NM
				        FROM vschedul a
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


		// TRUNCAR A X DECIMALES
		public function truncateFloat($number, $digitos)
		{
		    $raiz = 10;
    		$multiplicador = pow($raiz,$digitos);
    		$resultado = ((int)($number * $multiplicador)) / $multiplicador;
		    return number_format($resultado, $digitos);
		}


		// OBTIENE DATA PARA IMPRIMIR ACTIVIDADES
		public function selectDetalle(int $secID)
		{
			$request = array();
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			$secActividad = intval($secID);
			$sql = "SELECT a.PERIOS,
						   a.FECREG,
						   a.HORREG,
						   s.SEC_NO,
						   s.SEC_NM,
						   s.PARALE,
						   m.MAT_NO,
						   m.MAT_NM,
						   a.EMP_NO,
						   e.LAS_NM,
						   e.FIR_NM,
						   a.PARCIA,
						   a.INSUMO
					FROM vschedul a
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
			        FROM vschedul a
                    INNER JOIN vstudent v ON v.STD_NO = a.STD_NO
                    WHERE a.EMP_NO = $request_actividad[EMP_NO]
                    AND   a.PERIOS = $request_actividad[PERIOS]
                    AND   a.FECREG = '$request_actividad[FECREG]'
                    AND   a.HORREG = '$request_actividad[HORREG]'
                    AND   a.SEC_NO = $request_actividad[SEC_NO]
                    AND   a.MAT_NO = $request_actividad[MAT_NO]";
            $request_alumnos = $this->select_all($sql);

            $request = array('empresa' => $request_empresa,
            	             'actividad' => $request_actividad,
            	             'alumnos' => $request_alumnos
           					);
			return $request; 
		}


		public function oneVschedul(int $idSec)
		{
			$sql              	= "SELECT AMI_ID FROM vsdefaul";
			$request_vsdefaul 	= $this->select($sql);

			$this->intSec_id 	= $idSec;
			$sql 				= "SELECT * FROM vschedul WHERE SEC_ID = {$this->intSec_id}";
			$request_vschedul 	= $this->select($sql);

			$request = array('actividad' => $request_vschedul,'empresa' => $request_vsdefaul);
			return $request;
		}

		
		// EXTRAE ACTIVIDAD PARA MOSTRAR EN VIEW
		public function viewSchedul(int $idSec)
		{
			$request 			= array();
			$sql              	= "SELECT AMI_ID FROM vsdefaul";
			$request_vsdefaul 	= $this->select($sql);

			// Se obtiene la actividad por el secuencial enviado
			$sql = "SELECT a.PERIOS,
						   a.FECREG,
						   a.HORREG,
						   s.SEC_NM,
						   s.PARALE,
						   m.MAT_NM,
						   v.LAS_NM,
						   v.FIR_NM,
						   a.FECMAX,
						   substring(a.PARCIA,1,4) as PARCIAL,
						   a.INSUMO,
						   a.PUNTAJ,
						   a.SCHEDU,
						   a.VDLINK,
						   a.FLNAME,
						   a.FLTASK
					FROM vschedul a
					INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
					INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO
					INNER JOIN vstudent v ON v.STD_NO = a.STD_NO
					WHERE a.SEC_ID = $idSec";
			$request_schedul = $this->select($sql);

			// Se obtiene el nombre del insumo
			$sql 			= "SELECT SUB_NM as insumo FROM vstables WHERE TAB_NO = 'INS' AND SUB_NO = '$request_schedul[INSUMO]' AND ESTATU = 1";
			$request_insumo = $this->select($sql);

			$request = array('actividad' => $request_schedul,
							 'insumo' => $request_insumo,
							 'empresa' => $request_vsdefaul
							);
			return $request;
		}


		// ACTUALIZA TAREA DEL ESTUDIANTE
		public function	updateTaskStd(int $sec_id, string $flname)
		{
			$this->intSec_id = $sec_id;
			$this->strFlname = $flname;

			$sql   	  = "UPDATE vschedul SET FLTASK = ? WHERE SEC_ID = {$this->intSec_id}";
			$arrData  = array($this->strFlname);
			$request  = $this->update($sql,$arrData);
			return	$request;
		}


		// ELIMINA UNA ACTIVIDAD
		public function deleteVschedul(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "DELETE FROM vschedul WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->delete($sql);
			if($request)
			{
				$request = 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}

		
		// INSERTA UNA ACTIVIDAD
		public function insertVschedul(int $perios, string $fecreg, string $horreg, array $sec_no, int $mat_no, int $std_no, int $emp_no, string $fecmax, string $parcia, string $insumo, float $puntaj, string $schedu, string $vdlink, string $flname, string $fltask, string $messag)
		{
   			$return = "";
			$this->intPerios = $perios;
			$this->strFecreg = $fecreg;
			$this->strHorreg = date("H:i:s");
			$this->intSec_no = $sec_no;
			$this->intMat_no = $mat_no;
			$this->intStd_no = $std_no;
			$this->intEmp_no = $emp_no;
			$this->strFecmax = $fecmax;
			$this->strParcia = $parcia;
			$this->strInsumo = $insumo;
			$this->intPuntaj = $puntaj;
			$this->strSchedu = $schedu;
			$this->strVdlink = $vdlink;
			$this->strFlname = $flname;
			$this->strFltask = $fltask;
			$this->strMessag = $messag;

			if(substr($this->strParcia,0,4) == 'Q1P4' OR substr($this->strParcia,0,4) == 'Q2P4')
			{
				// Valida en VSDEFAUL que la calificación no sobrepase el valor de la tabla
				$sql              = "SELECT BASCAL FROM vsdefaul";
				$request_vsdefaul = $this->select($sql);
				if(!empty($request_vsdefaul))
				{
					if($this->intPuntaj > $request_vsdefaul['BASCAL'])
					{
						// PUNTAJE MAYOR
						$return = -2;
						return $return;
					}
				}
			}else{
				// Valida en VSTABLES que la calificación no sobrepase el valor de la tabla
				$sql              = "SELECT VALORS FROM vstables WHERE TAB_NO = 'INS' AND SUB_NO = '{$this->strInsumo}'";
				$request_vstables = $this->select($sql);
				if(!empty($request_vstables))
				{
					if($this->intPuntaj > $request_vstables['VALORS'])
					{
						// PUNTAJE MAYOR
						$return = -2;
					return $return;
					}
				}
			}


			// Valida en VSSECMAT si existe las mallas escogidas
			$arrSEC = $this->intSec_no;
			foreach ($arrSEC as $sec)
			{
				$this->intSec = $sec;
				$sql              = "SELECT EMP_NO FROM vssecmat WHERE SEC_NO = {$this->intSec} AND MAT_NO = {$this->intMat_no}";
				$request_vssecmat = $this->select($sql);
				if(empty($request_vssecmat))
				{
					// REPARTO INCORRECTO
					$return = -3;
					return $return;
				}
			}

			$arrSEC = $this->intSec_no;
			foreach ($arrSEC as $sec)
			{
				$this->intSec 		= $sec;
				$sql              	= "SELECT EMP_NO FROM vssecmat WHERE SEC_NO = {$this->intSec} AND MAT_NO = {$this->intMat_no}";
				$request_vssecmat 	= $this->select($sql);
				$this->intEmp_no 	= $request_vssecmat['EMP_NO'];

				$sql 				= "SELECT * FROM vschedul WHERE PERIOS = {$this->intPerios} AND FECREG = '{$this->strFecreg}' AND HORREG = '{$this->strHorreg}' AND SEC_NO = {$this->intSec} AND MAT_NO = {$this->intMat_no}";
				$request_vschedul 	= $this->select_all($sql);
				if(empty($request_vschedul))
				{
					// Si array ESTUDIANTES viene vacio seleccionamos todos los ESTUDIANTES
					if($this->intStd_no == 0)
					{
						// Busca en VSTUDENT los estudiantes que coinciden con PERIOS y SEC_NO
						$sql    = "SELECT STD_NO FROM vstudent WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec}";
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
						$insert          	= "INSERT INTO vschedul(perios,fecreg,horreg,sec_no,mat_no,std_no,emp_no,fecmax,parcia,insumo,puntaj,schedu,vdlink,flname,fltask) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
						$arrData         	= array($this->intPerios,$this->strFecreg,$this->strHorreg,$this->intSec,$this->intMat_no,$this->intStd,$this->intEmp_no,$this->strFecmax,$this->strParcia,$this->strInsumo,$this->intPuntaj,$this->strSchedu,$this->strVdlink,$this->strFlname,$this->strFltask);
						$request_insert  	= $this->insert($insert,$arrData);
						$return  			= $request_insert;

						// Actualiza VSNOTIFY mensaje enviado a ESTUDIANTES
						if($this->strMessag != "")
						{
							$insert     = "INSERT INTO vsnotify(perios,fecreg,horreg,sec_no,mat_no,std_no,emp_no,schedu) VALUES(?,?,?,?,?,?,?,?)";
							$arrData    = array($this->intPerios,$this->strFecreg,$this->strHorreg,$this->intSec,$this->intMat_no,$this->intStd,$this->intEmp_no,$this->strMessag);
							$request 	= $this->insert($insert,$arrData);
						}

						// Actualiza VSMATSTD
						if($this->intPuntaj >= 0)
						{
							// Suma todos los puntajes del Estudiante en la Asinatura el Parcial e Insumo y agrupa en VSMATSTD
							$sql    		 = "SELECT truncate(avg(PUNTAJ),2) as promedio FROM vschedul WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd} AND MAT_NO = {$this->intMat_no} AND PARCIA = '{$this->strParcia}' AND PUNTAJ > 0";
							$arrPuntajes 	 = $this->select($sql);
							$this->intProptj = 0;
					
							if($arrPuntajes['promedio'] != "")
							{
					   			$this->intProptj = $arrPuntajes['promedio'];			
							} 	

							// Examina si existe registro en VSMATSTD por Año Estudiante y Asignatura
							$sql     			= "SELECT * FROM vsmatstd WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd} AND MAT_NO = {$this->intMat_no}";
							$request_vsmatstd 	= $this->select($sql);
							if(empty($request_vsmatstd))
							{
								// Inserta VSMATSTD
								$insert   = "INSERT INTO vsmatstd(perios,std_no,mat_no,sec_no,emp_no) VALUES(?,?,?,?,?)";
								$arrData  = array($this->intPerios,$this->intStd,$this->intMat_no,$this->intSec,$this->intEmp_no);
								$request  = $this->insert($insert,$arrData);
							}

							// Busca en VSMATTER el TIPO DE CALCULO DE INSUMOS
							$sql              = "SELECT MAT_NM,PROMED FROM vsmatter WHERE MAT_NO = {$this->intMat_no}";
							$request_vsmatter = $this->select($sql);
							if(!empty($request_vsmatter))
							{
								$this->strMat_nm = $request_vsmatter['MAT_NM'];
								$this->intCaltyp = $request_vsmatter['PROMED'];

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
									$mSuplet = $this->intProptj;
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
													$califi = $this->intProptj;
												}else{
													$califi = $request_vsmatstd[$campo];
												}

												if($califi > 0)
												{
													$instot = $instot + 1;
													if($this->intProces == 1)
													{
														$numsum = $numsum + 1;
														$inssum = $inssum + $this->intPorcen * $califi / 100;
													}else{
														$numpro = $numpro + 1;
														$inspro = $inspro + $this->intPorcen * $califi / 100;
													}
												}
											}
										}
		
										$proyec = 0;
										switch($this->strParcia)
										{
											case $prydi:
												$proyec  = $this->truncateFloat(($this->intProptj + $request_vsmatstd[$prymd]) / 2,2);
												break;
											case $prymd:
												$proyec  = $this->truncateFloat(($this->intProptj + $request_vsmatstd[$prydi]) / 2,2);
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
								$insert   = "UPDATE vsmatstd SET {$this->strParcia} = ?, Q1P1PR = ?, Q1P2PR = ?, Q1P3PR = ?, Q1P4PR = ?, Q1_PRO = ?, Q2P1PR = ?, Q2P2PR = ?, Q2P3PR = ?, Q2P4PR = ?, Q2_PRO = ?, PROFIN = ? WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd} AND MAT_NO = {$this->intMat_no}";
								$arrData  = array($this->intProptj,$mQ1p1pr,$mQ1p2pr,$mQ1p3pr,$mQ1p4pr,$mQ1_pro,$mQ2p1pr,$mQ2p2pr,$mQ2p3pr,$mQ2p4pr,$mQ2_pro,$mProfin);
								$request  = $this->update($insert,$arrData);
							}
						}
					}
				}
			}
			return $return;
		}


		// ACTUALIZA UNA ACTIVIDAD
		public function updateVschedul(int $sec_id, int $perios, string $fecreg, string $horreg, array $sec_no, int $mat_no, int $std_no, int $emp_no, string $fecmax, string $parcia, string $insumo, float $puntaj, string $schedu, string $vdlink, string $flname, string $messag)
		{
   			$return = "";
  		    $this->intSec_id = $sec_id;
		    $this->intPerios = $perios;
			$this->strFecreg = $fecreg;
			$this->strHorreg = $horreg;
			$this->intSec_no = $sec_no[0];
			$this->intMat_no = $mat_no;
			$this->intStd_no = $std_no;
			$this->intEmp_no = $emp_no;
			$this->strFecmax = $fecmax;
			$this->strParcia = $parcia;
			$this->strInsumo = $insumo;
			$this->intPuntaj = $puntaj;
			$this->strSchedu = $schedu;
			$this->strVdlink = $vdlink;
			$this->strFlname = $flname;
			$this->strMessag = $messag;

			if(substr($this->strParcia,0,4) == 'Q1P4' OR substr($this->strParcia,0,4) == 'Q2P4')
			{
				// Valida en VSDEFAUL que la calificación no sobrepase el valor de la tabla
				$sql              = "SELECT BASCAL FROM vsdefaul";
				$request_vsdefaul = $this->select($sql);
				if(!empty($request_vsdefaul))
				{
					if($this->intPuntaj > $request_vsdefaul['BASCAL'])
					{
						// PUNTAJE MAYOR
						$return = -2;
						return $return;
					}
				}
			}else{
				// Valida en VSTABLES que la calificación no sobrepase el valor de la tabla
				$sql              = "SELECT VALORS FROM vstables WHERE TAB_NO = 'INS' AND SUB_NO = '{$this->strInsumo}'";
				$request_vstables = $this->select($sql);
				if(!empty($request_vstables))
				{
					if($this->intPuntaj > $request_vstables['VALORS'])
					{
						// PUNTAJE MAYOR
						$return = -2;
						return $return;
					}
				}
			}

			// Valida en VSSECMAT si existe la malla escogida
			$sql              = "SELECT EMP_NO FROM vssecmat WHERE SEC_NO = {$this->intSec_no} AND MAT_NO = {$this->intMat_no}";
			$request_vssecmat = $this->select($sql);
			if(empty($request_vssecmat))
			{
				// REPARTO INCORRECTO
				$return = -3;
				return $return;
			}

			$sql              = "SELECT * FROM vschedul WHERE PERIOS = {$this->intPerios} AND FECREG = '{$this->strFecreg}' AND HORREG = '{$this->strHorreg}' AND MAT_NO = {$this->intMat_no} AND STD_NO = {$this->intStd_no} AND SEC_ID != {$this->intSec_id}";
			$request_vschedul = $this->select_all($sql);
			if(empty($request_vschedul))
			{
				$insert         = "UPDATE vschedul SET puntaj = ?, schedu = ?, vdlink = ?, flname = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->intPuntaj,$this->strSchedu,$this->strVdlink,$this->strFlname);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;

				// Actualiza VSNOTIFY
				if($this->strMessag != "")
				{
					$insert          = "INSERT INTO vsnotify(perios,fecreg,horreg,sec_no,mat_no,std_no,emp_no,schedu) VALUES(?,?,?,?,?,?,?,?)";
					$arrData         = array($this->intPerios,$this->strFecreg,$this->strHorreg,$this->intSec_no,$this->intMat_no,$this->intStd_no,$this->intEmp_no,$this->strMessag);
					$request_insert  = $this->insert($insert,$arrData);
				}

				// Actualiza VSMATSTD
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
				if(empty($request_vsmatstd))
				{
					$insert   = "INSERT INTO vsmatstd(perios,std_no,mat_no,sec_no,emp_no) VALUES(?,?,?,?,?)";
					$arrData  = array($this->intPerios,$this->intStd_no,$this->intMat_no,$this->intSec_no,$this->intEmp_no);
					$request  = $this->insert($insert,$arrData);
				}

				// Busca en VSMATTER el NOMBRE DE ASIGNATURA
				$sql 				= "SELECT MAT_NM FROM vsmatter WHERE MAT_NO = {$this->intMat_no}";
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
						$mSuplet = $this->intProptj;
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
										$califi = $this->intProptj;
									}else{
										$califi = $request_vsmatstd[$campo];
									}

									if($califi > 0)
									{
										$instot = $instot + 1;
										if($this->intProces == 1)
										{
											$numsum = $numsum + 1;
											$inssum = $inssum + $this->intPorcen * $califi / 100;
										}else{
											$numpro = $numpro + 1;
											$inspro = $inspro + $this->intPorcen * $califi / 100;
										}
									}
								}
							}

							$proyec = 0;
							switch($this->strParcia)
							{
								case $prydi:
									$proyec  = $this->truncateFloat(($this->intProptj + $request_vsmatstd[$prymd]) / 2,2);
									break;
								case $prymd:
									$proyec  = $this->truncateFloat(($this->intProptj + $request_vsmatstd[$prydi]) / 2,2);
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
					$insert   = "UPDATE vsmatstd SET {$this->strParcia} = ?, Q1P1PR = ?, Q1P2PR = ?, Q1P3PR = ?, Q1P4PR = ?, Q1_PRO = ?, Q2P1PR = ?, Q2P2PR = ?, Q2P3PR = ?, Q2P4PR = ?, Q2_PRO = ?, PROFIN = ? WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND MAT_NO = {$this->intMat_no}";
					$arrData  = array($this->intProptj,$mQ1p1pr,$mQ1p2pr,$mQ1p3pr,$mQ1p4pr,$mQ1_pro,$mQ2p1pr,$mQ2p2pr,$mQ2p3pr,$mQ2p4pr,$mQ2_pro,$mProfin);
					$request  = $this->update($insert,$arrData);
				}
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}
	}
