 <?php

	class VsmovbanModel extends Mysql
	{
        public $intSec_id;
		public $strMovtip;
        public $intMov_no;
        public $intBan_no;
        public $intDep_no;
        public $intChe_no;
		public $strRemark;
		public $datFecreg;
		public $intValors;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE DIARIOS
		public function selectVsmovban()
		{
            $sql = "SELECT	a.SEC_ID,
                            a.FECREG,
							a.MOVTIP,
                            t.TAB_NM,
                            a.MOV_NO,
                            a.VALORS,
                            a.REMARK,
							a.REVERS,
                            b.BAN_NM,
							b.CTANUM
            		FROM vsmovban a
                    INNER JOIN vstabhea t ON t.TAB_NO = a.MOVTIP
            		INNER JOIN vsbanker b ON b.BAN_NO = a.BAN_NO
					WHERE a.MOVBAN = 1
            		ORDER BY a.FECREG DESC, a.SEC_ID DESC";
            $request = $this->select_all($sql);
            return $request;
        }


		// QUERY PARA IMPRIMIR TRANSACCION BANCARIA
		public function prnMovBan(int $secID)
		{
			$request = array();
			$sql 			= "SELECT * FROM vsdefaul";
			$request_empresa = $this->select($sql);

            $sql = "SELECT	a.SEC_ID,
                            a.FECREG,
                            t.TAB_NM,
                            a.MOV_NO,
                            a.VALORS,
                            a.REMARK,
							a.REVERS,
                            b.BAN_NM
            		FROM vsmovban a
                    INNER JOIN vstabhea t ON t.TAB_NO = a.MOVTIP
            		INNER JOIN vsbanker b ON b.BAN_NO = a.BAN_NO
					WHERE a.SEC_ID = $secID";
            $request_vsmovban = $this->select($sql);

            $request = array('empresa' => $request_empresa,'movban' => $request_vsmovban);
			return $request; 
		}


		// EXTRAE UN DIARIO
		public function oneVsmovban(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "SELECT * FROM vsmovban WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}


		// QUERY INFORMES BANCARIOS
		public function getVsPrnBan(int $ban_no, int $reptyp, int $abotyp, string $fecdes, string $fechas)
		{
			$request = array();
			$this->intBan_no = $ban_no;
			$this->intReptyp = $reptyp;
			$this->intAbotyp = $abotyp;
			$this->datFecdes = $fecdes;
			$this->datFechas = $fechas;

			switch($this->intReptyp)
			{
				// Saldo Bancos
				case 1:
					if($this->intBan_no == 0)
					{
						$where = "WHERE v.MOVBAN = 1 AND v.FECREG <= '{$this->datFechas}' GROUP BY v.BAN_NO ORDER BY b.BAN_NM";
					}else{
						$where = "WHERE v.MOVBAN = 1 AND v.BAN_NO = {$this->intBan_no} AND v.FECREG <= '{$this->datFechas}'";
					}
		
					$sql = "SELECT 	v.BAN_NO,SUM(v.VALORS * v.MOVSIG) AS SALDO,b.BAN_NM,b.CTANUM
							FROM vsmovban v
							INNER JOIN vsbanker b ON b.BAN_NO = v.BAN_NO ".$where;

					$request_detail = $this->select_all($sql);
					break;

				// Estado de Cuenta
				case 2:
					if($this->intBan_no == 0)
					{
						$where = "WHERE v.MOVBAN = 1 AND v.FECREG BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' ORDER BY b.BAN_NM, v.FECREG";
					}else{
						$where = "WHERE v.MOVBAN = 1 AND v.BAN_NO = {$this->intBan_no} AND v.FECREG BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' ORDER BY v.FECREG";
					}
		
					$sql = "SELECT 	v.MOVTIP,v.MOV_NO,v.FECREG,v.BAN_NO,v.DEP_NO,v.CHE_NO,v.BENEFI,v.DOCAPL,v.DOCNUM,v.VALORS,v.MOVSIG,v.REMARK,b.BAN_NM,b.CTANUM
							FROM vsmovban v
							INNER JOIN vsbanker b ON b.BAN_NO = v.BAN_NO ".$where;

					$request_detail = $this->select_all($sql);
					break;
			}

			// Prepara la respuesta para el controlador
			$request = array('detalle' => $request_detail,'reptyp' => $this->intReptyp);
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


		// CONTABILIZA TRANSACCIONES BANCARIAS
		public function vsmovbancon(int $tables, string $movtip, string $movpto, int $mov_no)
		{
            $return = "";
		    $this->intTables_ = $tables; 
		    $this->strMovtip_ = $movtip; 
		    $this->strMovpto_ = $movpto;
		    $this->intMov_no_ = $mov_no; 

			if($this->intTables_ == 1)
			{
				$sql = "SELECT * FROM vsmovcxp WHERE MOVTIP = '{$this->strMovtip_}' AND MOV_NO = {$this->intMov_no_}";
			}else{
				$sql = "SELECT * FROM vsmovban WHERE MOVTIP = '{$this->strMovtip_}' AND MOV_NO = {$this->intMov_no_}";
			}
			$request_vsmov 	= $this->select_all($sql);
			if(!empty($request_vsmov))
			{
				$sql 				= "SELECT * FROM vsmovacc WHERE MOVTIP = '{$this->strMovtip_}' AND MOVPTO = '{$this->strMovpto_}' AND MOV_NO = {$this->intMov_no_}";
				$request_vsmovacc 	= $this->select_all($sql);
				if(empty($request_vsmovacc))
				{
					for ($j = 0; $j < count($request_vsmov); $j++) 
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
								$this->intDocval_ = $request_vsmov[$j][$this->strValors_]; 

								// DEBE
								$this->strCta_no_ = '';
								if($this->strMovtip_ == 'TR')
								{
									$this->intSignos_ 	= $request_vsmov[$j]['MOVSIG']; 
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
												$this->strCta_no_ = $request_vsmov[$j]['CTA_NO'];
											}else{
												$this->strCta_no_ = $request_vsmov[$j]['GAS_NO'];
											}
										}else{
											$this->strCta_no_ = $this->vsgetacount($this->strEntity_,$request_vsmov[$j][$this->strEntity_]);
										}
									}else if($this->intFactor_ == 0 or $this->intFactor_ == $request_vsmov[$j][$this->strEntity_]){
										$this->strCta_no_ = $request_vsctatip[$i]['CTADEB'];
									}
									if(!empty($this->strCta_no_))
									{
										$sql 		= "SELECT * FROM vsmovacc WHERE MOVTIP = '{$this->strMovtip_}' AND MOVPTO = '{$this->strMovpto_}' AND MOV_NO = {$this->intMov_no_} AND CTA_NO = '{$this->strCta_no_}'";
										$request 	= $this->select($sql);
										if(empty($request))
										{
											$insert         = "INSERT INTO vsmovacc(movtip,movpto,mov_no,docapl,docpto,docnum,fecreg,valors,cta_no,signos,remark) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
											$arrData        = array($this->strMovtip_,$this->strMovpto_,$this->intMov_no_,'','',0,$request_vsmov[$j]['FECREG'],$this->intDocval_,$this->strCta_no_,$this->intSignos_,$request_vsmov[$j]['REMARK']);
											$request_insert = $this->insert($insert,$arrData);
											$return         = $request_insert;
										}
									}
								}

								// HABER
								$this->strCta_no_ = '';
								if($this->strMovtip_ == 'TR')
								{
									$this->intSignos_ 	= $request_vsmov[$j]['MOVSIG']; 
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
												$this->strCta_no_ = $request_vsmov[$j]['CTA_NO'];
											}else{
												$this->strCta_no_ = $request_vsmov[$j]['GAS_NO'];
											}
										}else{
											$this->strCta_no_ = $this->vsgetacount($this->strEntity_,$request_vsmov[$j][$this->strEntity_]);
										}
									}else if($this->intFactor_ == 0 or $this->intFactor_ == $request_vsmov[$j][$this->strEntity_]){
										$this->strCta_no_ = $request_vsctatip[$i]['CTACRE'];
									}
									if(!empty($this->strCta_no_))
									{
										$sql 		= "SELECT * FROM vsmovacc WHERE MOVTIP = '{$this->strMovtip_}' AND MOVPTO = '{$this->strMovpto_}' AND MOV_NO = {$this->intMov_no_} AND CTA_NO = '{$this->strCta_no_}'";
										$request 	= $this->select($sql);
										if(empty($request))
										{
											$insert         = "INSERT INTO vsmovacc(movtip,movpto,mov_no,docapl,docpto,docnum,fecreg,valors,cta_no,signos,remark) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
											$arrData        = array($this->strMovtip_,$this->strMovpto_,$this->intMov_no_,'','',0,$request_vsmov[$j]['FECREG'],$this->intDocval_,$this->strCta_no_,$this->intSignos_,$request_vsmov[$j]['REMARK']);
											$request_insert = $this->insert($insert,$arrData);
											$return         = $request_insert;
										}
									}
								}
							}
						}
					}
				}
			}
			return $return;
		}


		// ANULA UNA TRANSACCION BANCARIA
		public function deleteVsmovban(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 			= "SELECT * FROM vsmovban WHERE SEC_ID = {$this->intSec_id}";
			$request_vsmov 	= $this->select($sql);
		   	if(!empty($request_vsmov))
			{
				$this->strMovtip = $request_vsmov['MOVTIP'];
				$this->intMov_no = $request_vsmov['MOV_NO'];

				// ANULA TRANSACCION EN LIBRO BANCO
				$update		= "UPDATE vsmovban SET valors = ?, revers = ? WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
				$arrData	= array(0,1);
				$request	= $this->update($update,$arrData);

				// ANULA TRANSACCION EN CUENTAS POR PAGAR
				$update     = "UPDATE vsmovcxp SET valors = ?, revers = ? WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
				$arrData    = array(0,1);
				$request	= $this->update($update,$arrData);

				// ANULA TRANSACCION EN CONTABILIDAD
				$sql 		= "DELETE FROM vsmovacc WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
				$request	= $this->delete($sql);
				$request	= 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}


		// INSERTA UNA TRANSACCION BANCARIA
		public function insertVsmovban(string $movtip, int $mov_no, int $ban_no, int $dep_no, int $che_no, string $remark, string $cta_no, string $fecreg, float $valors)
		{
            $return = "";
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->intBan_no = $ban_no;
			$this->intDep_no = $dep_no;
			$this->intChe_no = $che_no;
			$this->strRemark = $remark;
			$this->strCta_no = $cta_no;
			$this->datFecreg = $fecreg;
			$this->intValors = $valors;
			$this->intMovban = 1;
			$this->intSuc_no = '';
            
			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -4;
				return $return;
			}

			// IMPIDE REGISTRAR SI LA CUENTA DEL BANCO ES LA MISMA QUE LA DOBLE PARTIDA
			$sql 				= "SELECT CTA_NO FROM vsbanker WHERE BAN_NO = {$this->intBan_no}";
			$request_vsbanker 	= $this->select($sql);
			if(!empty($request_vsbanker))
			{
				if($this->strCta_no == $request_vsbanker['CTA_NO'])
				{
					// CUENTA INVALIDA
					$return = -4;
					return $return;	
				}
			}


			switch($this->strMovtip)
            {
                // DEPOSITO
                case 'DE':
                    $this->intMovsig = 1;
                    break; 

                // NOTA DE DEBITO
                case 'DB':
                    $this->intMovsig = -1;
                    break; 

                // NOTA DE CREDITO
                case 'CB':
                    $this->intMovsig = 1;
                    break; 

				// PAGO EN CHEQUE
                case 'PC':
                    $this->intMovsig = -1;
                    break; 
            }

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

	    	$sql 		= "SELECT * FROM vsmovban WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
		    $request 	= $this->select($sql);
   			if(empty($request))
    		{
	    		$insert         = "INSERT INTO vsmovban(movtip,mov_no,ban_no,dep_no,che_no,remark,cta_no,fecreg,valors,movsig,movban) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		    	$arrData        = array($this->strMovtip,$this->intMov_no,$this->intBan_no,$this->intDep_no,$this->intChe_no,$this->strRemark,$this->strCta_no,$this->datFecreg,$this->intValors,$this->intMovsig,$this->intMovban);
			    $request_insert = $this->insert($insert,$arrData);
			    $return         = $request_insert;

				// CONTABILIZACION
				$contab			= $this->vsmovbancon(2,$this->strMovtip,$this->strMovpto,$this->intMov_no);
   			}else{
				// EXISTE
    			$return = -1;
	    	}
		    return $return;
        }


		// ACTUALIZA UNA TRANSACCION BANCARIA
		public function updateVsmovban(int $sec_id, string $movtip, int $mov_no, int $ban_no, int $dep_no, int $che_no, string $remark, string $cta_no, string $fecreg, float $valors)
		{
            $return = "";
			$this->intSec_id = $sec_id;
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->intBan_no = $ban_no;
			$this->intDep_no = $dep_no;
			$this->intChe_no = $che_no;
			$this->strRemark = $remark;
			$this->strCta_no = $cta_no;
			$this->datFecreg = $fecreg;
			$this->intValors = $valors;
			$this->intMovban = 1;
			$this->intSuc_no = '';

			// IMPIDE ACTUALIZAR SI EL DOCUMENTO ES ANULADO
			$sql 		= "SELECT * FROM vsmovban WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			if(!empty($request))
			{
				if($request['REVERS'] == 1)
				{
					// ANULADO
					$return = -3;
					return $return;	
				}
			}

			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -4;
				return $return;
			}

			// IMPIDE ACTUALIZAR SI LA CUENTA DEL BANCO ES LA MISMA QUE LA DOBLE PARTIDA
			$sql 				= "SELECT CTA_NO FROM vsbanker WHERE BAN_NO = {$this->intBan_no}";
			$request_vsbanker 	= $this->select($sql);
			if(!empty($request_vsbanker))
			{
				if($this->strCta_no == $request_vsbanker['CTA_NO'])
				{
					// CUENTA INVALIDA
					$return = -4;
					return $return;	
				}
			}


			$sql 		= "SELECT * FROM vsmovban WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no} AND SEC_ID != {$this->intSec_id}";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsmovban SET dep_no = ?, che_no = ?, remark = ?, cta_no = ?, fecreg = ?, valors = ? WHERE SEC_ID = {$this->intSec_id}";
		    	$arrData        = array($this->intDep_no,$this->intChe_no,$this->strRemark,$this->strCta_no,$this->datFecreg,$this->intValors);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;

				// CONTABILIZACION
				$contab			= $this->vsmovbancon(2,$this->strMovtip,$this->strMovpto,$this->intMov_no);
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}


		// INSERTA UNA TRANSFERENCIA BANCARIA
		public function insertVsmovtrf(string $movtip, int $mov_no, int $ban_n3, int $ban_n4, string $remark, string $fecreg, float $valors)
		{
            $return = "";
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->intBan_n3 = $ban_n3;
			$this->intBan_n4 = $ban_n4;
			$this->strRemark = $remark;
			$this->datFecreg = $fecreg;
			$this->intValors = $valors;
			$this->intMovban = 1;
			$this->intSuc_no = '';


			// IMPIDE REGISTRAR SI LA CUENTA SALIENTE ES LA MISMA ENTRANTE
			if($this->intBan_n3 == $this->intBan_n4)
			{
				// CUENTA INCORRECTA
				$return = -4;
				return $return;	
			}

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

	    	$sql 		= "SELECT * FROM vsmovban WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
		    $request 	= $this->select($sql);
   			if(empty($request))
    		{
				// NOTA DE DEBITO ENTIDAD SALIENTE
				$this->intMovsig = -1;
	    		$insert         = "INSERT INTO vsmovban(movtip,mov_no,ban_no,remark,fecreg,valors,movsig,movban) VALUES(?,?,?,?,?,?,?,?)";
		    	$arrData        = array($this->strMovtip,$this->intMov_no,$this->intBan_n3,$this->strRemark,$this->datFecreg,$this->intValors,$this->intMovsig,$this->intMovban);
			    $request_insert = $this->insert($insert,$arrData);
			    $return         = $request_insert;

				// NOTA DE CREDITO ENTIDAD ENTRANTE
				$this->intMovsig = 1;
	    		$insert         = "INSERT INTO vsmovban(movtip,mov_no,ban_no,remark,fecreg,valors,movsig,movban) VALUES(?,?,?,?,?,?,?,?)";
		    	$arrData        = array($this->strMovtip,$this->intMov_no,$this->intBan_n4,$this->strRemark,$this->datFecreg,$this->intValors,$this->intMovsig,$this->intMovban);
			    $request_insert = $this->insert($insert,$arrData);
			    $return         = $request_insert;

				// CONTABILIZACION
				$contab			= $this->vsmovbancon(2,$this->strMovtip,$this->strMovpto,$this->intMov_no);
   			}else{
				// EXISTE
    			$return = -1;
	    	}
		    return $return;
        }


		// ACTUALIZA UNA TRANSFERENCIA BANCARIA
		public function updateVsmovtrf(int $sec_id, string $movtip, int $mov_no, int $ban_n3, int $ban_n4, string $remark, string $fecreg, float $valors)
		{
            $return = "";
			$this->intSec_id = $sec_id;
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->intBan_n3 = $ban_n3;
			$this->intBan_n4 = $ban_n4;
			$this->strRemark = $remark;
			$this->datFecreg = $fecreg;
			$this->intValors = $valors;
			$this->intSuc_no = '';


			// IMPIDE ACTUALIZAR SI EL DOCUMENTO ES ANULADO
			$sql 		= "SELECT * FROM vsmovban WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			if(!empty($request))
			{
				if($request['REVERS'] == 1)
				{
					// ANULADO
					$return = -3;
					return $return;	
				}
			}

			$insert         = "UPDATE vsmovban SET remark = ?  WHERE SEC_ID = {$this->intSec_id}";
	    	$arrData        = array($this->strRemark);
			$request_insert = $this->update($insert,$arrData);
			$return         = $request_insert;

			// CONTABILIZACION
			$contab			= $this->vsmovbancon(2,$this->strMovtip,$this->strMovpto,$this->intMov_no);
			return $return; 
		}
	}
