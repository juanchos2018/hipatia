 <?php

	class VsrolpayModel extends Mysql
	{
		public $intSec_id;
		public $intPerios;
		public $strMondes;
		public $intQuince;
		public $intEmp_no;
		public $intRub_no;
		public $intIncome;
		public $intEgress;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE ROL DE PAGOS
		public function selectVsrolpay()
		{
            $sql = "SELECT	a.SEC_ID,
                            a.FECREG,
							a.PERIOS,
							a.INCOME,
                            a.EGRESS,
                            s.LAS_NM,
                            s.FIR_NM,
							a.RUB_NO,
							v.RUBTIP,
							v.RUB_NM
            		FROM vsrolpay a
            		INNER JOIN vsemplox s ON s.EMP_NO = a.EMP_NO
            		INNER JOIN vsrolrub v ON v.RUB_NO = a.RUB_NO
            		ORDER BY a.PERIOS DESC, s.LAS_NM, s.FIR_NM, v.RUBTIP, a.SEC_ID";
            $request = $this->select_all($sql);
            return $request;
        }


		// EXTRAE UN ROL DE PAGOS
		public function oneVsrolpay(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "SELECT * FROM vsrolpay WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}


		// QUERY INFORME ROL DE PAGOS
		public function getVsPrnRol(int $emp_no, int $reptyp, string $mondes, int $perios, int $quince)
		{
			$request = array();
			$this->intEmp_no = $emp_no;
			$this->intReptyp = $reptyp;
			$this->intQuince = $quince;
			$this->intPerios = $perios * 100 + $mondes;

			// OBTIENE NOMBRES DE RUBROS EN CABECERA
			$sql 			= "SELECT * FROM vsrolrub WHERE ESTATU = 1 ORDER BY RUBTIP,RUB_NO";
			$request_head 	= $this->select_all($sql);

			switch($this->intReptyp)
			{
				// NOMINA DE ROL DE PAGOS
				case 1:
					$where 	= "WHERE v.PERIOS = {$this->intPerios} AND t.TAB_NO = 'CAT' ORDER BY v.CAT_NO,e.LAS_NM,e.FIR_NM,r.RUBTIP,r.RUB_NO";
					$sql 	= "SELECT v.PERIOS,v.EMP_NO,v.CAT_NO,v.RUB_NO,v.QUINCE,e.LAS_NM,e.FIR_NM,v.INCOME,v.EGRESS,r.RUBTIP,t.SUB_NM
								FROM vsrolpay v
								INNER JOIN vstables t ON t.SUB_NO = v.CAT_NO
								INNER JOIN vsemplox e ON e.EMP_NO = v.EMP_NO
								INNER JOIN vsrolrub r ON r.RUB_NO = v.RUB_NO ".$where;
					$request_detail = $this->select_all($sql);
					break;

				// ROL DE PAGOS INDIVIDUAL
				case 2:
					if($this->intEmp_no == 0)
					{ 
						$where 	= "WHERE v.PERIOS = {$this->intPerios} AND t.TAB_NO = 'CAT' ORDER BY v.CAT_NO,e.LAS_NM,e.FIR_NM,r.RUBTIP,r.RUB_NO";
					}else{
						$where 	= "WHERE v.PERIOS = {$this->intPerios} AND v.EMP_NO = {$this->intEmp_no} ORDER BY e.LAS_NM,e.FIR_NM,r.RUBTIP,r.RUB_NO";
					}

					$sql 	= "SELECT v.PERIOS,v.EMP_NO,v.RUB_NO,v.CAT_NO,v.QUINCE,e.LAS_NM,e.FIR_NM,e.IDE_NO,v.INCOME,v.EGRESS,r.RUBTIP,r.RUB_NM,t.SUB_NM
								FROM vsrolpay v
								INNER JOIN vstables t ON t.SUB_NO = v.CAT_NO
								INNER JOIN vsemplox e ON e.EMP_NO = v.EMP_NO
								INNER JOIN vsrolrub r ON r.RUB_NO = v.RUB_NO ".$where;
					$request_detail = $this->select_all($sql);
					break;

				// ACREDITACION BANCARIA
				case 3:
					$where 	= "WHERE v.PERIOS = {$this->intPerios} GROUP BY v.EMP_NO ORDER BY e.LAS_NM,e.FIR_NM";
					$sql 	= "SELECT SUM(v.INCOME - v.EGRESS) AS VALOR,v.PERIOS,v.EMP_NO,v.QUINCE,e.LAS_NM,e.FIR_NM,e.IDTYPE,e.IDE_NO
								FROM vsrolpay v
								INNER JOIN vsemplox e ON e.EMP_NO = v.EMP_NO ".$where;
					$request_detail = $this->select_all($sql);
					break;

				// LISTADO CREDITOS PERSONALES
				case 4:		
					if($this->intEmp_no == 0)
					{ 
						$where 	= "WHERE v.PERDES = {$this->intPerios} ORDER BY e.LAS_NM,e.FIR_NM,r.RUB_NO";
					}else{
						$where 	= "WHERE v.PERDES = {$this->intPerios} AND v.EMP_NO = {$this->intEmp_no} ORDER BY e.LAS_NM,e.FIR_NM,r.RUB_NO";
					}

					$sql 	= "SELECT v.PERDES,v.EMP_NO,v.RUB_NO,e.LAS_NM,e.FIR_NM,e.IDE_NO,v.VALORS,v.CUOTAS,v.PLAZOS,v.REMARK,r.RUB_NM
								FROM vsempcre v
								INNER JOIN vsemplox e ON e.EMP_NO = v.EMP_NO
								INNER JOIN vsrolrub r ON r.RUB_NO = v.RUB_NO ".$where;
					$request_detail = $this->select_all($sql);
					break;

				// ESTADO DE CUENTA PERSONAL
				case 5:	
					if($this->intEmp_no == 0)
					{ 
						$where 	= "WHERE v.PERDES <= {$this->intPerios} ORDER BY e.LAS_NM,e.FIR_NM,v.PERDES,r.RUB_NO";
					}else{
						$where 	= "WHERE v.PERDES <= {$this->intPerios} AND v.EMP_NO = {$this->intEmp_no} ORDER BY e.LAS_NM,e.FIR_NM,v.PERDES,r.RUB_NO";
					}

					$sql 	= "SELECT v.PERDES,v.EMP_NO,v.RUB_NO,e.LAS_NM,e.FIR_NM,e.IDE_NO,v.VALORS,v.CUOTAS,v.PLAZOS,v.REMARK,v.DESCON,r.RUB_NM
								FROM vsempcre v
								INNER JOIN vsemplox e ON e.EMP_NO = v.EMP_NO
								INNER JOIN vsrolrub r ON r.RUB_NO = v.RUB_NO ".$where;
					$request_detail = $this->select_all($sql);
					break;

				// BENEFICIOS SOCIALES
				case 6:
					break;

				// LIQUIDACION 13
				case 7:
					break;
			}

			// Prepara la respuesta para el controlador
			$request = array('producto' => $request_head,'detalle' => $request_detail,'reptyp' => $this->intReptyp);
			return $request;
		}


		// GENERA UN ROL DE PAGOS
		public function insertVsrolpay(int $perios, string $mondes, int $quince, int $emp_no, int $rub_no, float $income, float $egress)
		{
   			$return = "";
		    $this->intPerios = $perios;
		    $this->strMondes = $mondes;
		    $this->intQuince = $quince;
			$this->intEmp_no = $emp_no;
			$this->intRub_no = $rub_no;
			$this->intIncome = $income;
			$this->intEgress = $egress;
			$this->strPerdes = $this->intPerios.$this->strMondes;

			// PARAMETRO APORTE INDIVIDUAL
			$sql 				= "SELECT PAR_NO FROM vssecuen WHERE MOVTIP = 'AI'";
			$request_vsdefaul 	= $this->select($sql);	

			$sql 				= "SELECT EMP_NO,CAT_NO,SALARY FROM vsemplox WHERE ESTATU = 1";
			$request_vsemplox 	= $this->select_all($sql);	

			for ($i = 0; $i < count($request_vsemplox); $i++) 
			{
				$this->intEmp_no	= $request_vsemplox[$i]['EMP_NO'];
				$this->intCat_no	= $request_vsemplox[$i]['CAT_NO'];
				$Sueldo				= $request_vsemplox[$i]['SALARY'];
				$Aporte				= 0;

				for ($times = 0; $times < 2; $times++)
				{
					$sql 				= "SELECT * FROM vsrolrub WHERE ESTATU = 1";
					$request_vsrolrub 	= $this->select_all($sql);	

					for ($r = 0; $r < count($request_vsrolrub); $r++) 
					{
						$this->intIncome = 0;
						$this->intEgress = 0;
						$this->intRub_no = $request_vsrolrub[$r]['RUB_NO'];

						if($request_vsrolrub[$r]['RUBTIP'] == 1)
						{
							// INGRESO
							if(empty($request_vsrolrub[$r]['FORMUL']))
							{
								$this->intIncome = 0;
							}else{
								$Formul				= $request_vsrolrub[$r]['FORMUL'];
								$this->intIncome 	= $$Formul;
							}

							// SUMA APORTE SEGURO SOCIAL
							if($request_vsrolrub[$r]['APORTE'] == 1)
							{
								if($times == 0)
								{
									$Aporte = $Aporte + $this->intIncome;
								}else{
									$Aporte = $Aporte * $request_vsdefaul['MOV_NO'] / 100;
								}
							}
						}else{
							// EGRESO
							if($request_vsrolrub[$r]['RUBCRE'] == 1)
							{
								$sql 				= "SELECT SUM(CUOTAS) AS CUOTA FROM vsempcre WHERE PERDES = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
								$request_vsempcre 	= $this->select($sql);
								if($request_vsempcre['CUOTA'] > 0)
								{
									$this->intEgress 	= $request_vsempcre['CUOTA'];
								}else{
									$this->intEgress	= 0;
								}
							}else if(empty($request_vsrolrub[$r]['FORMUL'])){
								$this->intEgress = 0;
							}else{
								$Formul				= $request_vsrolrub[$r]['FORMUL'];
								$this->intEgress	= $$Formul;
							}
						}

						if($times > 0)
						{
							$sql 				= "SELECT * FROM vsrolpay WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
							$request_vsrolpay 	= $this->select($sql);
							if(empty($request_vsrolpay))
							{
								$insert         	= "INSERT INTO vsrolpay(perios,quince,emp_no,cat_no,rub_no,income,egress) VALUES(?,?,?,?,?,?,?)";
								$arrData        	= array($this->strPerdes,$this->intQuince,$this->intEmp_no,$this->intCat_no,$this->intRub_no,$this->intIncome,$this->intEgress);
								$request_insert 	= $this->insert($insert,$arrData);
								$return  			= $request_insert;
							}
						}
					}
				}
			}
			return $return;
		}


		public function updateVsrolpay(int $sec_id, int $perios, string $mondes, int $quince, int $emp_no, int $rub_no, float $income, float $egress)
		{
   			$return = "";
		    $this->intSec_id = $sec_id;
		    $this->intPerios = $perios;
		    $this->strMondes = $mondes;
		    $this->intQuince = $quince;
			$this->intEmp_no = $emp_no;
			$this->intRub_no = $rub_no;
			$this->intIncome = $income;
			$this->intEgress = $egress;
			$this->strPerdes = $this->intPerios.$this->strMondes;

			// PARAMETRO APORTE INDIVIDUAL
			$sql 				= "SELECT PAR_NO FROM vssecuen WHERE MOVTIP = 'AI'";
			$request_vsdefaul 	= $this->select($sql);	

			// ACTUALIZA RUBRO EDITADO
			$sql 				= "SELECT * FROM vsrolrub WHERE RUB_NO = {$this->intRub_no}";
			$request_vsrolrub 	= $this->select($sql);	
			if($request_vsrolrub['RUBTIP'] == 1)
			{
				// INGRESO
				$insert         	= "UPDATE vsrolpay set income = ? WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
				$arrData        	= array($this->intIncome);
				$request_insert 	= $this->update($insert,$arrData);
				$return  			= $request_insert;
			}else{
				// EGRESO
				$insert         	= "UPDATE vsrolpay set egress = ? WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
				$arrData        	= array($this->intEgress);
				$request_insert 	= $this->update($insert,$arrData);
				$return  			= $request_insert;
			}


			// ACTUALIZA RESTO DE ROL DEL EMPLEADO
			if($request_vsrolrub['RUBCRE'] == 2)
			{
				$sql 				= "SELECT EMP_NO,SALARY FROM vsemplox WHERE EMP_NO = {$this->intEmp_no}";
				$request_vsemplox 	= $this->select($sql);

				for ($i = 0; $i < count($request_vsemplox); $i++) 
				{
					$Sueldo		= $request_vsemplox['SALARY'];
					$Aporte		= 0;
					for ($times = 0; $times < 2; $times++) 
					{
						$sql 				= "SELECT * FROM vsrolrub WHERE ESTATU = 1";
						$request_vsrolrub 	= $this->select_all($sql);	

						for ($r = 0; $r < count($request_vsrolrub); $r++) 
						{
							$this->intIncome = 0;
							$this->intEgress = 0;
							$this->intRub_no = $request_vsrolrub[$r]['RUB_NO'];

							if($request_vsrolrub[$r]['RUBTIP'] == 1)
							{
								// INGRESO
								if(empty($request_vsrolrub[$r]['FORMUL']))
								{
									$sql 				= "SELECT INCOME FROM vsrolpay WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
									$request_vsrolpay 	= $this->select($sql);
									$this->intIncome 	= $request_vsrolpay['INCOME'];
								}else{
									$Formul				= $request_vsrolrub[$r]['FORMUL'];
									$this->intIncome 	= $$Formul;
								}

								// SUMA APORTE SEGURO SOCIAL
								if($request_vsrolrub[$r]['APORTE'] == 1)
								{
									if($times == 0)
									{
										$Aporte = $Aporte + $this->intIncome;
									}else{
										$Aporte = $Aporte * $request_vsdefaul['MOV_NO'] / 100;
									}
								}
							}else{
								// EGRESO
								if($request_vsrolrub[$r]['RUBCRE'] == 1)
								{
									$sql 				= "SELECT SUM(CUOTAS) AS CUOTA FROM vsempcre WHERE PERDES = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
									$request_vsempcre 	= $this->select($sql);
									if($request_vsempcre['CUOTA'] > 0)
									{
										$this->intEgress 	= $request_vsempcre['CUOTA'];
									}else{
										$this->intEgress	= 0;
									}
								}else{
									if(empty($request_vsrolrub[$r]['FORMUL']))
									{
										$sql 				= "SELECT EGRESS FROM vsrolpay WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
										$request_vsrolpay 	= $this->select($sql);
										$this->intEgress 	= $request_vsrolpay['EGRESS'];
									}else{
										$Formul				= $request_vsrolrub[$r]['FORMUL'];
										$this->intEgress 	= $$Formul;
									}
								}
							}

							if($times > 0)
							{
								$sql 				= "SELECT * FROM vsrolpay WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
								$request_vsrolpay 	= $this->select($sql);
								if(!empty($request_vsrolpay))
								{
									$insert         	= "UPDATE vsrolpay set income = ?, egress = ? WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
									$arrData        	= array($this->intIncome,$this->intEgress);
									$request_insert 	= $this->update($insert,$arrData);
									$return  			= $request_insert;
								}
							}
						}
					}
				}
			}
			return $return;
		}
	}
