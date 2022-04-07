 <?php

	class VsempcreModel extends Mysql
	{
		public $intSec_id;
		public $datFecreg;
		public $strHorreg;
		public $intEmp_no;
		public $intRub_no;
		public $strRemark;
		public $intValors;
		public $intPlazos;
		public $intCuotas;
		public $intForpag;
		public $intBan_no;
		public $intChe_no;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE CREDITOS PERSONALES
		public function selectVsempcre()
		{
            $sql = "SELECT	a.SEC_ID,
							a.MOV_NO,
                            a.FECREG,
                            a.REMARK,
							a.PERDES,
							a.CUOTAS,
                            s.LAS_NM,
                            s.FIR_NM,
							v.RUB_NM
            		FROM vsempcre a
            		INNER JOIN vsemplox s ON s.EMP_NO = a.EMP_NO
            		INNER JOIN vsrolrub v ON v.RUB_NO = a.RUB_NO
            		ORDER BY a.SEC_ID DESC";
            $request = $this->select_all($sql);
            return $request;
        }


		// EXTRAE UN CREDITO
		public function oneVsempcre(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "SELECT * FROM vsempcre WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}


		// OBTIENE CUENTA CONTABLE DE UN ELEMENTO
		public function vsgetacount(string $entity, int $codid)
		{
		    $this->strEntity = $entity; 
		    $this->intCodId  = $codid; 

			switch($this->strEntity)
			{
				case 'BAN_NO':
					$sql = "SELECT CTA_NO FROM vsbanker WHERE BAN_NO = '{$this->intCodId}'";
					break;
				case 'PRV_NO':
					$sql = "SELECT CTA_NO FROM vsprovid WHERE PRV_NO = '{$this->intCodId}'";
					break;
			}

            $request = $this->select($sql);
            $request = $request['CTA_NO'];
            return $request;
        }


		// CONTABILIZA CREDITOS PERSONALES
		public function vsmovcrecon( int $forpag, string $movpto, int $mov_no)
		{
            $return = "";
		    $this->intForpag_ = $forpag; 
			$this->strMovpto_ = $movpto;
		    $this->intMov_no_ = $mov_no; 

			switch($this->intForpag_)
			{
				case 1: // EFECTIVO
					$this->strMovtip_ = 'PE'; 
					break;
				case 2: // CHEQUE
					$this->strMovtip_ = 'PC'; 
					break;
				case 3: // DEBITO BANCARIO
					$this->strMovtip_ = 'PD'; 
					break;
			}

			$sql 			= "SELECT * FROM vsmovban WHERE MOVTIP = '{$this->strMovtip_}' AND MOV_NO = {$this->intMov_no_}";
			$request_vsmov 	= $this->select($sql);
			if(!empty($request_vsmov))
			{
				$sql 				= "SELECT * FROM vsmovacc WHERE MOVTIP = '{$this->strMovtip_}' AND MOVPTO = '{$this->strMovpto_}' AND MOV_NO = {$this->intMov_no_}";
				$request_vsmovacc 	= $this->select_all($sql);
				if(empty($request_vsmovacc))
				{
					$sql				= "SELECT * FROM vsctatip WHERE TAB_NO = '{$this->strMovtip_}' ORDER BY CTAMOV";
					$request_vsctatip 	= $this->select_all($sql);
					if(!empty($request_vsctatip))
					{
						for ($i = 0; $i < count($request_vsctatip); $i++) 
						{
							$this->intCtamov_ = $request_vsctatip[$i]['CTAMOV']; 
							$this->intCtafil_ = $request_vsctatip[$i]['CTAFIL']; 
							$this->strEntity_ = $request_vsctatip[$i]['ENTITY']; 
							$this->intFactor_ = $request_vsctatip[$i]['FACTOR']; 
							$this->strValors_ = $request_vsctatip[$i]['VALORS']; 
							$this->intDocval_ = $request_vsmov[$this->strValors_]; 

							// DEBE
							$this->strCta_no_ = '';
							if($this->strMovtip_ == 'TR')
							{
								$this->intSignos_ 	= $request_vsmov['MOVSIG']; 
							}else{
								$this->intSignos_ 	= 1; 
							}
							if($this->intCtamov_ == 1 AND ($this->intCtamov_ == $this->intSignos_))
							{
								if($this->intCtafil_ == 1)
								{
									if(empty($this->strEntity_))
									{
										if($this->intFactor_ == 0)
										{
											$this->strCta_no_ = $request_vsmov['CTA_NO'];
										}else{
											$this->strCta_no_ = $request_vsmov['GAS_NO'];
										}
									}else{
										$this->strCta_no_ = $this->vsgetacount($this->strEntity_,$request_vsmov[$this->strEntity_]);
									}
								}else if($this->intFactor_ == $request_vsmov[$this->strEntity_]){
									$this->strCta_no_ = $request_vsctatip[$i]['CTADEB'];
								}
								if(!empty($this->strCta_no_))
								{
									$sql 		= "SELECT * FROM vsmovacc WHERE MOVTIP = '{$this->strMovtip_}' AND MOVPTO = '{$this->strMovpto_}' AND MOV_NO = {$this->intMov_no_} AND CTA_NO = '{$this->strCta_no_}'";
									$request 	= $this->select($sql);
									if(empty($request))
									{
										$insert         = "INSERT INTO vsmovacc(movtip,movpto,mov_no,docapl,docpto,docnum,fecreg,valors,cta_no,signos,remark) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
										$arrData        = array($this->strMovtip_,$this->strMovpto_,$this->intMov_no_,'','',0,$request_vsmov['FECREG'],$this->intDocval_,$this->strCta_no_,$this->intSignos_,$request_vsmov['REMARK']);
										$request_insert = $this->insert($insert,$arrData);
										$return         = $request_insert;
									}
								}
							}

							// HABER
							$this->strCta_no_ = '';
							if($this->strMovtip_ == 'TR')
							{
								$this->intSignos_ 	= $request_vsmov['MOVSIG']; 
							}else{
								$this->intSignos_ 	= -1; 
							}
							if($this->intCtamov_ == -1 AND ($this->intCtamov_ == $this->intSignos_))
							{
								if($this->intCtafil_ == 1)
								{
									if(empty($this->strEntity_))
									{
										if($this->intFactor_ == 0)
										{
											$this->strCta_no_ = $request_vsmov['CTA_NO'];
										}else{
											$this->strCta_no_ = $request_vsmov['GAS_NO'];
										}
									}else{
										$this->strCta_no_ = $this->vsgetacount($this->strEntity_,$request_vsmov[$this->strEntity_]);
									}
								}else if($this->intFactor_ == $request_vsmov[$this->strEntity_]){
									$this->strCta_no_ = $request_vsctatip[$i]['CTACRE'];
								}
								if(!empty($this->strCta_no_))
								{
									$sql 		= "SELECT * FROM vsmovacc WHERE MOVTIP = '{$this->strMovtip_}' AND MOVPTO = '{$this->strMovpto_}' AND MOV_NO = {$this->intMov_no_} AND CTA_NO = '{$this->strCta_no_}'";
									$request 	= $this->select($sql);
									if(empty($request))
									{
										$insert         = "INSERT INTO vsmovacc(movtip,movpto,mov_no,docapl,docpto,docnum,fecreg,valors,cta_no,signos,remark) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
										$arrData        = array($this->strMovtip_,$this->strMovpto_,$this->intMov_no_,'','',0,$request_vsmov['FECREG'],$this->intDocval_,$this->strCta_no_,$this->intSignos_,$request_vsmov['REMARK']);
										$request_insert = $this->insert($insert,$arrData);
										$return         = $request_insert;
									}
								}
							}
						}
					}
				}
			}
			return $return;
		}


		// INSERTA CREDITO PERSONAL
		public function insertVsempcre(string $fecreg, string $horreg, int $emp_no, int $rub_no, string $remark, float $valors, int $plazos, int $forpag, string $mondes, int $perios, int $ban_no, int $che_no)
		{
   			$return = "";
			$this->datFecreg = $fecreg;
			$this->strHorreg = date("H:i:s");
			$this->intEmp_no = $emp_no;
			$this->intRub_no = $rub_no;
			$this->strRemark = $remark;
			$this->intValors = $valors;
			$this->intPlazos = $plazos;
			$this->intCuotas = $this->intValors / $this->intPlazos;
			$this->intForpag = $forpag;
			$this->strMondes = $mondes;
			$this->intPerios = $perios;
			$this->intBan_no = $ban_no;
			$this->intChe_no = $che_no;
			$this->intQuince = 2;
			$this->intMovsig = -1;
			$this->intMovprv = 0;
			$this->strDoctip = 'CE';
			$this->strMovtip = ''; 
			$this->strMovpto = '';

			switch($this->intForpag)
			{
				case 1: // EFECTIVO
					$this->strMovtip = 'PE'; 
					$this->intMovban = 0;
					break;
				case 2: // CHEQUE
					$this->strMovtip = 'PC'; 
					$this->intMovban = 1;
					break;
				case 3: // DEBITO BANCARIO
					$this->strMovtip = 'PD'; 
					$this->intMovban = 1;
					break;
			}

			$sql     			= "SELECT LAS_NM,FIR_NM,CAT_NO FROM vsemplox WHERE EMP_NO = {$this->intEmp_no}";
			$request_vsemplox 	= $this->select($sql);
			$this->intCat_no	= $request_vsemplox['CAT_NO'];
			$this->strBenefi    = $request_vsemplox['LAS_NM'].' '.$request_vsemplox['FIR_NM'];
			$this->strRemark    = $this->strRemark.' - '.$this->strBenefi;
			

			// EXTRAE SECUENCIAL DE CREDITO
			$sql     = "SELECT * FROM vssecuen WHERE MOVTIP = '{$this->strDoctip}'";
			$request = $this->select($sql);
			if(empty($request))
			{
				$insert          = "INSERT INTO vssecuen(movtip,pto_no) VALUES(?,?)";
				$arrData         = array($this->strDoctip,$this->strPto_no);
				$request_insert  = $this->insert($insert,$arrData);
				$this->intMov_no = 1;
			}else{
				$this->intMov_no = $request['MOV_NO'] + 1;
			}

			$insert         = "UPDATE vssecuen SET mov_no = ? WHERE MOVTIP = '{$this->strDoctip}'";
			$arrData        = array($this->intMov_no);
			$request_insert = $this->update($insert,$arrData);

			for ($i = 0; $i < $this->intPlazos; $i++) 
			{
				$this->strPerdes 	= $this->intPerios.$this->strMondes;
				$insert         	= "INSERT INTO vsempcre(mov_no,fecreg,horreg,emp_no,rub_no,remark,valors,plazos,cuotas,forpag,perdes,ban_no,che_no,descon) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData        	= array($this->intMov_no,$this->datFecreg,$this->strHorreg,$this->intEmp_no,$this->intRub_no,$this->strRemark,$this->intValors,$this->intPlazos,$this->intCuotas,$this->intForpag,$this->strPerdes,$this->intBan_no,$this->intChe_no,0);
				$request_insert 	= $this->insert($insert,$arrData);
				$return         	= $request_insert;

				// ACTUALIZA ROL DE PAGOS
				$sql 				= "SELECT SUM(CUOTAS) AS CUOTA FROM vsempcre WHERE PERDES = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
				$request_vsempcre 	= $this->select($sql);
				if($request_vsempcre['CUOTA'] > 0)
				{
					$this->intEgress 	= $request_vsempcre['CUOTA'];
				}else{
					$this->intEgress	= 0;
				}

				$sql 				= "SELECT * FROM vsrolpay WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
				$request_vsrolpay 	= $this->select($sql);
				if(empty($request_vsrolpay))
				{
					$insert         	= "INSERT INTO vsrolpay(perios,quince,fecreg,emp_no,cat_no,rub_no,income,egress) VALUES(?,?,?,?,?,?,?,?)";
					$arrData        	= array($this->strPerdes,$this->intQuince,$this->datFecreg,$this->intEmp_no,$this->intCat_no,$this->intRub_no,0,$this->intEgress);
					$request_insert 	= $this->insert($insert,$arrData);
				}else{
					$insert         	= "UPDATE vsrolpay set egress = ? WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
					$arrData        	= array($this->intEgress);
					$request_insert 	= $this->update($insert,$arrData);
				}

				$this->strMondes = str_pad(intval($this->strMondes) + 1, 2, "0", STR_PAD_LEFT);
				if($this->strMondes > '12')
				{
					$this->intPerios = $this->intPerios + 1;
					$this->strMondes = '01';
				}
			}

			// INSERTA TRANSACCION BANCARIA
			if(!empty($this->strMovtip))
			{
	            // EXTRAE SECUENCIAL DE DIARIO CONTABLE
    	        $sql 		= "SELECT * FROM vssecuen WHERE MOVTIP = '{$this->strMovtip}'";
				$request 	= $this->select($sql);
				if(empty($request))
				{
    	            $this->intMov_no = 1;
        	        $insert          = "INSERT INTO vssecuen(movtip,mov_no,suc_no) VALUES(?,?,?)";
					$arrData         = array($this->strMovtip,$this->intMov_no,$this->intSuc_no);
					$request_insert  = $this->insert($insert,$arrData);
	            }else{
					$this->intMov_no = $request['MOV_NO'] + 1;
					$insert          = "UPDATE vssecuen SET mov_no = ? WHERE MOVTIP = '{$this->strMovtip}'";
					$arrData         = array($this->intMov_no);
					$request_insert  = $this->insert($insert,$arrData);
				}

				$sql 				= "SELECT * FROM vsmovban WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
				$request_vsmovban 	= $this->select($sql);
				if(empty($request_vsmovban))
				{
					$insert         = "INSERT INTO vsmovban(movtip,mov_no,emp_no,ban_no,dep_no,che_no,benefi,remark,cta_no,fecreg,valors,movsig,movban,forpag) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$arrData        = array($this->strMovtip,$this->intMov_no,$this->intEmp_no,$this->intBan_no,0,$this->intChe_no,$this->strBenefi,$this->strRemark,'',$this->datFecreg,$this->intValors,$this->intMovsig,$this->intMovban,$this->intForpag);
					$request_insert = $this->insert($insert,$arrData);
					$return         = $request_insert;
	
					// CONTABILIZACION
					$contab			= $this->vsmovcrecon($this->intForpag,$this->strMovpto,$this->intMov_no);
				}	
			}
			return $return;
		}


		// ACTUALIZA CREDITO PERSONAL
		public function updateVsempcre(int $sec_id, string $fecreg, string $horreg, int $emp_no, int $rub_no, string $remark, float $valors, int $plazos, float $cuotas, int $forpag, string $mondes, int $perios, int $ban_no, int $che_no)
		{
   			$return = "";
            $this->intSec_id = $sec_id;
            $this->datFecreg = $fecreg;
			$this->strHorreg = $horreg;
			$this->intEmp_no = $emp_no;
			$this->intRub_no = $rub_no;
			$this->strRemark = $remark;
			$this->intValors = $valors;
			$this->intPlazos = $plazos;
			$this->intCuotas = $cuotas;
			$this->intForpag = $forpag;
			$this->strMondes = $mondes;
			$this->intPerios = $perios;
			$this->intBan_no = $ban_no;
			$this->intChe_no = $che_no;
			$this->intQuince = 2;
			$this->strPerdes = $this->intPerios.$this->strMondes;

			$sql     			= "SELECT LAS_NM,FIR_NM,CAT_NO FROM vsemplox WHERE EMP_NO = {$this->intEmp_no}";
			$request_vsemplox 	= $this->select($sql);
			$this->intCat_no	= $request_vsemplox['CAT_NO'];

			$insert         	= "UPDATE vsempcre SET cuotas = ?, remark = ?, forpag = ?, ban_no = ?, che_no = ? WHERE SEC_ID = {$this->intSec_id}";
            $arrData        	= array($this->intCuotas,$this->strRemark,$this->intForpag,$this->intBan_no,$this->intChe_no);
			$request_insert 	= $this->update($insert,$arrData);
			$return         	= $request_insert;

			// ACTUALIZA ROL DE PAGOS
			$sql 				= "SELECT SUM(CUOTAS) AS CUOTA FROM vsempcre WHERE PERDES = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
			$request_vsempcre 	= $this->select($sql);
			if($request_vsempcre['CUOTA'] > 0)
			{
				$this->intEgress 	= $request_vsempcre['CUOTA'];
			}else{
				$this->intEgress	= 0;
			}

			$sql 				= "SELECT * FROM vsrolpay WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
			$request_vsrolpay 	= $this->select($sql);
			if(empty($request_vsrolpay))
			{
				$insert         	= "INSERT INTO vsrolpay(perios,quince,fecreg,emp_no,cat_no,rub_no,income,egress) VALUES(?,?,?,?,?,?,?,?)";
				$arrData        	= array($this->strPerdes,$this->intQuince,$this->datFecreg,$this->intEmp_no,$this->intCat_no,$this->intRub_no,0,$this->intEgress);
				$request_insert 	= $this->insert($insert,$arrData);
			}else{
				$insert         	= "UPDATE vsrolpay set egress = ? WHERE PERIOS = '{$this->strPerdes}' AND EMP_NO = {$this->intEmp_no} AND RUB_NO = {$this->intRub_no}";
				$arrData        	= array($this->intEgress);
				$request_insert 	= $this->update($insert,$arrData);
			}
			return $return; 
		}
	}
