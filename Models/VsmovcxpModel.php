 <?php

	class VsmovcxpModel extends Mysql
	{
		public $intSec_id;
		public $strMovtip;
		public $intMov_no;
		public $strSustri;
		public $strDocapl;
		public $strDocpto;
        public $intDocnum;
		public $strDocaut;
		public $strRemark;
		public $strFecreg;
		public $strFecemi;
		public $intBasiva;
		public $intMoniva;
		public $intBasiv0;
		public $intBasniv;
		public $strReb_no;
		public $strRes_no;
		public $strRib_no;
		public $strRis_no;
		public $intMonrf1;
		public $intMonrf2;
		public $intMonri1;
		public $intMonri2;
		public $strRetpto;
		public $intRetnum;
		public $strRetaut;
		public $intValdes;
		public $intValors;
		public $strAdvanc;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// OBTIENE DATA DE COMBO PROVEEDOR EN PROVISION
		public function getDatPrv(int $codPrv_no)
		{
		    $sql 		= "SELECT * FROM vsprovid WHERE PRV_NO = ".$codPrv_no;
			$request 	= $this->select($sql);	
			return $request;
		}


		// OBTIENE DATA DE COMBO BANCO EN PAGO PROVEEDORES
		public function getDatBan(int $codBan_no)
		{
		    $sql 		= "SELECT * FROM vsbanker WHERE BAN_NO = ".$codBan_no;
			$request 	= $this->select($sql);
			return $request;
		}


		// OBTIENE DATA DE PROVISION APLICADA EN NOTA DE CREDITO PROVEEDOR
		public function getDatCrp(string $codDocapl, int $codDocnum)
		{
			$this->strDocapl = $codDocapl;
			$this->intDocnum = $codDocnum;

			$sql 		= "SELECT PRV_NO,GAS_NO,SUM(VALORS * MOVSIG) AS SALDO FROM vsmovcxp WHERE MOVAPL = '{$this->strDocapl}' AND MOVNUM = {$this->intDocnum}";
			$request 	= $this->select($sql);	
			return $request;
		}


		// OBTIENE DATA FACTURAS PENDIENTES DE COMBO PROVEEDOR EN PAGO
		public function getDatPen(string $codAdvanc, int $codPrv_no)
		{
			$this->strAdvanc = $codAdvanc;
			switch($this->strAdvanc)
			{
				case "1":
					$sql 	= "SELECT 	p.ANT_NO AS CTA_NO,
										c.CTA_NM
								FROM vsprovid p
								INNER JOIN vsacount c ON c.CTA_NO = p.ANT_NO
								WHERE PRV_NO = {$codPrv_no}";
					$request_cta 	= $this->select($sql);
					break;

				case "2":
					$sql 	= "SELECT 	p.CTA_NO,
										c.CTA_NM
								FROM vsprovid p
								INNER JOIN vsacount c ON c.CTA_NO = p.CTA_NO
								WHERE PRV_NO = {$codPrv_no}";
					$request_cta	= $this->select($sql);
					break;
			}

		    $sql 			= "SELECT BENEFI FROM vsprovid WHERE PRV_NO = {$codPrv_no}";
			$request_prv	= $this->select($sql);

			if(empty($this->strAdvanc) or $this->strAdvanc == "1")
			{
				$request_saldo 	= array();
			}else{
				$sql 			= "SELECT MOVAPL,MOVNUM,SUM(VALORS * MOVSIG) AS SALDO FROM vsmovcxp WHERE PRV_NO = {$codPrv_no} GROUP BY MOVAPL,MOVNUM";
				$request_saldo 	= $this->select_all($sql);	
			}
			$request = array('cta_no' => $request_cta,'benefi' => $request_prv,'saldos' => $request_saldo);
			return $request;
		}


		// SUMA FACTURAS PENDIENTES DE COMBO PROVEEDOR EN PAGO
		public function getDatVal(int $codPrv_no, array $codFap_no)
		{
			$this->intValsum = 0;
			foreach($codFap_no as $fap)
			{
				if($fap != 0)
				{
					$sql 				= "SELECT SUM(VALORS * MOVSIG) AS SALDO FROM vsmovcxp WHERE MOVAPL = 'PF' AND MOVNUM = {$fap} GROUP BY MOVAPL,MOVNUM";
					$request 			= $this->select($sql);
					$this->intValsum 	= $this->intValsum + $request['SALDO'];	
				}
			}
			return $this->intValsum;
		}


		// OBTIENE PARAMETROS TIPOS RETENCIONES
		public function getDatRet(string $codRetf1, string $codRetf2, string $codReti1, string $codReti2)
		{
			// PARAMETRO I.V.A.
		    $sql 		 = "SELECT PAR_NO FROM vssecuen WHERE MOVTIP = 'IV'";
			$request	 = $this->select($sql);	
			$request_iva = $request['MOV_NO'];

			if(empty($codRetf1))
			{
				$request_rf1 = 0;
			}else{
				$sql 			= "SELECT VALORS FROM vstables WHERE TAB_NO = 'REF' AND SUB_NO = ".$codRetf1;
				$request	 	= $this->select($sql);	
				$request_rf1 	= $request['VALORS'];
			}

			if(empty($codRetf2))
			{
				$request_rf2 = 0;
			}else{
			    $sql 			= "SELECT VALORS FROM vstables WHERE TAB_NO = 'REF' AND SUB_NO = ".$codRetf2;
				$request	 	= $this->select($sql);	
				$request_rf2 	= $request['VALORS'];
			}

			if(empty($codReti1))
			{
				$request_ri1 = 0;
			}else{
			    $sql 			= "SELECT VALORS FROM vstables WHERE TAB_NO = 'REI' AND SUB_NO = ".$codReti1;
				$request	 	= $this->select($sql);	
				$request_ri1 	= $request['VALORS'];
			}

			if(empty($codReti2))
			{
				$request_ri2 = 0;
			}else{
			    $sql 			= "SELECT VALORS FROM vstables WHERE TAB_NO = 'REI' AND SUB_NO = ".$codReti2;
				$request	 	= $this->select($sql);	
				$request_ri2 	= $request['VALORS'];
			}
			
			$request = array('porciva' => $request_iva,'monretf1' => $request_rf1,'monretf2' => $request_rf2,'monreti1' => $request_ri1,'monreti2' => $request_ri2);
			return $request;
		}


		// EXTRAE DIARIOS
		public function selectVsmovcxp()
		{
            $sql = "SELECT	a.SEC_ID,
                            a.FECREG,
                            t.TAB_NM,
							a.MOVTIP,
                            a.MOV_NO,
							a.MOVAPL,
							a.MOVNUM,
                            a.REMARK,
							a.REVERS,
							a.VALORS,
							a.RETPTO,
							a.RETNUM,
							a.LOGFIL,
                            p.LAS_NM,
							p.FIR_NM
            		FROM vsmovcxp a
                    INNER JOIN vstabhea t ON t.TAB_NO = a.MOVTIP
            		INNER JOIN vsprovid p ON p.PRV_NO = a.PRV_NO
					WHERE a.MOVPRV = 1
            		ORDER BY a.FECREG DESC, a.SEC_ID DESC";
            $request = $this->select_all($sql);
            return $request;
        }


		// EXTRAE UN DIARIO
		public function oneVsmovcxp(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "SELECT * FROM vsmovcxp WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}


		// CREA UN DOCUMENTO RETENCION EN XML
        public function vsXMLCreate(string $movtip, int $mov_no)
		{
            $return = "";
		    $this->strMovtip_ = $movtip; 
		    $this->intMov_no_ = $mov_no; 

			// DATA EMPRESA
            $sql        		= "SELECT * FROM vsdefaul";
            $request_vsdefaul   = $this->select($sql);
			$this->strAmi_id 	= $request_vsdefaul['AMI_ID']; 
			$this->strRuc_no 	= $request_vsdefaul['RUC_NO']; 
			$this->strRazons 	= $request_vsdefaul['RAZONS']; 
			$this->strAddres 	= $request_vsdefaul['ADDRES']; 
			$this->strTphone	= $request_vsdefaul['TPHONE']; 
			$this->strEmails 	= $request_vsdefaul['EMAILS']; 

            $sql_retencion      = "SELECT v.SUSTRI,p.IDTYPE,p.IDE_NO,p.LAS_NM,p.FIR_NM,v.RETPTO,v.RETNUM,v.RETAUT,v.FECEMI,v.FECREG,
                                          v.BASNIV,v.BASIV0,v.BASIVA,v.MONIVA,
                                          v.CODRF1,v.MONRF1,v.PORRF1,
                                          v.CODRF2,v.MONRF2,v.PORRF2,
                                          v.CODRI1,v.MONRI1,v.PORRI1,
                                          v.CODRI2,v.MONRI2,v.PORRI2
                                    FROM vsmovcxp v
                                    INNER JOIN vsprovid p ON p.PRV_NO = v.PRV_NO
									WHERE v.MOVTIP = '{$this->strMovtip_}' AND v.MOV_NO = {$this->intMov_no_} AND v.RETNUM > 0 AND v.VALORS > 0";
            $request_retencion  = $this->select($sql_retencion);
			if(empty($request_retencion))
			{
                $request_ats  = 'error';
            }else{
                $request_ats  = 'ok';
                $xml          = new DomDocument('1.0','UTF-8');

				$this->intYeaper 				= date('Y', strtotime($request_retencion['FECREG']));
				$this->intMonper 				= date('m', strtotime($request_retencion['FECREG']));
				$request_retencion['FECREG'] 	= substr($request_retencion['FECREG'],8,2).'/'.substr($request_retencion['FECREG'],5,2).'/'.substr($request_retencion['FECREG'],0,4);
				$this->strRetpto 				= $request_retencion['RETPTO'];

				$comprobanteRetencion 	= $xml->createElement('comprobanteRetencion');
                $comprobanteRetencion 	= $xml->appendChild($comprobanteRetencion);

				$infoTributaria 		= $xml->createElement('infoTributaria');
				$infoTributaria 		= $comprobanteRetencion->appendChild($infoTributaria);

				$nodo01         		= $xml->createElement('ambiente',1);
				$nodo01         		= $infoTributaria->appendChild($nodo01);
				$nodo02         		= $xml->createElement('tipoEmision',1);
				$nodo02         		= $infoTributaria->appendChild($nodo02);
				$nodo03         		= $xml->createElement('razonSocial',$this->strRazons);
				$nodo03         		= $infoTributaria->appendChild($nodo03);
				$nodo05         		= $xml->createElement('ruc',$this->strRuc_no);
				$nodo05         		= $infoTributaria->appendChild($nodo05);
				$nodo06         		= $xml->createElement('claveAcceso',$request_retencion['RETAUT']);
				$nodo06         		= $infoTributaria->appendChild($nodo06);
				$nodo07         		= $xml->createElement('codDoc','01');
				$nodo07         		= $infoTributaria->appendChild($nodo07);
				$nodo08         		= $xml->createElement('estab',substr($request_retencion['RETPTO'],0,3));
				$nodo08         		= $infoTributaria->appendChild($nodo08);
				$nodo09         		= $xml->createElement('ptoEmi',substr($request_retencion['RETPTO'],3,3));
				$nodo09         		= $infoTributaria->appendChild($nodo09);
				$nodo10         		= $xml->createElement('secuencial',str_pad($request_retencion['RETNUM'], 9, "0", STR_PAD_LEFT));
				$nodo10         		= $infoTributaria->appendChild($nodo10);
				$nodo11         		= $xml->createElement('dirMatriz',$this->strAddres);
				$nodo11         		= $infoTributaria->appendChild($nodo11);

				$infoCompRetencion		= $xml->createElement('infoCompRetencion');
				$infoCompRetencion 		= $comprobanteRetencion->appendChild($infoCompRetencion);

				$nodo12         		= $xml->createElement('fechaEmision',$request_retencion['FECREG']);
                $nodo12         		= $infoCompRetencion->appendChild($nodo12);
				$nodo15         		= $xml->createElement('tipoIdentificacionSujetoRetenido',$request_retencion['IDTYPE']);
                $nodo15         		= $infoCompRetencion->appendChild($nodo15);
				$nodo16         		= $xml->createElement('razonSocialSujetoRetenido',$request_retencion['LAS_NM'].' '.$request_retencion['FIR_NM']);
                $nodo16         		= $infoCompRetencion->appendChild($nodo16);
				$nodo17         		= $xml->createElement('identificacionSujetoRetenido',$request_retencion['IDE_NO']);
                $nodo17         		= $infoCompRetencion->appendChild($nodo17);
				$nodo18         		= $xml->createElement('periodoFiscal',$this->intMonper.'/'.$this->intYeaper);
                $nodo18         		= $infoCompRetencion->appendChild($nodo18);

                $impuestos         		= $xml->createElement('impuestos');
                $impuestos         		= $comprobanteRetencion->appendChild($impuestos);

                $impuesto         		= $xml->createElement('impuesto');
                $impuesto         		= $impuestos->appendChild($impuesto);

                $nodo19         		= $xml->createElement('codigo',0);
                $nodo19         		= $impuesto->appendChild($nodo19);
                $nodo20         		= $xml->createElement('codigoRetencion',$request_retencion['CODRF1']);
                $nodo20         		= $impuesto->appendChild($nodo20);
                $nodo21         		= $xml->createElement('baseImponible',$request_retencion['BASIVA']);
                $nodo21         		= $impuesto->appendChild($nodo21);
                $nodo22         		= $xml->createElement('porcentajeRetener',$request_retencion['PORRF1']);
                $nodo22         		= $impuesto->appendChild($nodo22);
                $nodo23         		= $xml->createElement('valorRetenido',$request_retencion['MONRF1']);
                $nodo23         		= $impuesto->appendChild($nodo23);

                $impuesto         		= $xml->createElement('impuesto');
                $impuesto         		= $impuestos->appendChild($impuesto);

				$nodo24         		= $xml->createElement('codigo',0);
                $nodo24         		= $impuesto->appendChild($nodo24);
                $nodo25         		= $xml->createElement('codigoRetencion',$request_retencion['CODRF2']);
                $nodo25         		= $impuesto->appendChild($nodo25);
                $nodo26         		= $xml->createElement('baseImponible',$request_retencion['BASIVA']);
                $nodo26         		= $impuesto->appendChild($nodo26);
                $nodo27         		= $xml->createElement('porcentajeRetener',$request_retencion['PORRF2']);
                $nodo27         		= $impuesto->appendChild($nodo27);
                $nodo28         		= $xml->createElement('valorRetenido',$request_retencion['MONRF2']);
                $nodo28         		= $impuesto->appendChild($nodo28);

				$ruta               = 'Xml/'.$this->strAmi_id.'/'.$this->strRuc_no.$this->strRetpto.str_pad($this->intMov_no_, 9, "0", STR_PAD_LEFT).'.xml';
                $xml->formatOutput  = true;
                $el_xml             = $xml->saveXML();
                $xml->save($ruta);
            }
            return $request_ats;
        }


		// QUERY INFORME CUENTAS POR PAGAR
		public function getVsPrnCxp(int $prv_no, int $reptyp, int $abotyp, string $fecdes, string $fechas)
		{
			$request = array();
			$this->intPrv_no = $prv_no;
			$this->intReptyp = $reptyp;
			$this->intAbotyp = $abotyp;
			$this->datFecdes = $fecdes;
			$this->datFechas = $fechas;

			switch($this->intReptyp)
			{
				// Saldo Proveedores
				case 1:
					if($this->intPrv_no == 0)
					{
						$where = "WHERE v.MOVPRV = 1 AND v.FECREG <= '{$this->datFechas}' GROUP BY v.PRV_NO ORDER BY p.LAS_NM, p.FIR_NM";
					}else{
						$where = "WHERE v.MOVPRV = 1 AND v.PRV_NO = {$this->intPrv_no} AND v.FECREG <= '{$this->datFechas}'";
					}
		
					$sql = "SELECT 	v.PRV_NO,
								   	SUM(v.VALORS * v.MOVSIG) AS SALDO,
								   	p.LAS_NM,
								   	p.FIR_NM,
									p.IDE_NO
							FROM vsmovcxp v
							INNER JOIN vsprovid p ON p.PRV_NO = v.PRV_NO ".$where;

					$request_detail = $this->select_all($sql);
					break;

				// Estado de Cuenta
				case 2:
					if($this->intPrv_no == 0)
					{
						$where = "WHERE v.MOVPRV = 1 AND v.FECREG BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' ORDER BY p.LAS_NM,p.FIR_NM,v.FECREG,v.MOVAPL,v.MOVNUM,v.MOVSIG DESC";
					}else{
						$where = "WHERE v.MOVPRV = 1 AND v.PRV_NO = {$this->intPrv_no} AND v.FECREG BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' ORDER BY v.FECREG, v.MOVAPL, v.MOVNUM";
					}
		
					$sql = "SELECT 	v.MOVTIP,
									t.TAB_NM,
									v.MOV_NO,
									v.MOVAPL,
									v.MOVNUM,
									v.FECREG,
									v.PRV_NO,
									v.CHE_NO,
								   	v.DOCAPL,
								   	v.DOCNUM,
								   	v.VALORS,
								   	v.MOVSIG,
									v.REMARK,
								   	p.LAS_NM,
								   	p.FIR_NM
							FROM vsmovcxp v
							INNER JOIN vsprovid p ON p.PRV_NO = v.PRV_NO 
							INNER JOIN vstabhea t ON t.TAB_NO = v.MOVTIP ".$where;

					$request_detail = $this->select_all($sql);
					break;			}

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
				case 'ART_NO':
					$sql = "SELECT CTA_NO FROM vsproduc WHERE ART_NO = '{$this->intCodId}'";
					break;
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


		// CONTABILIZA DOCUMENTOS CUENTAS POR PAGAR
		public function vsmovcxpcon(int $tables, string $movtip, string $movpto, int $mov_no)
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


		// ANULA UN DOCUMENTO CUENTA POR PAGAR
		public function deleteVsmovcxp(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 			= "SELECT * FROM vsmovcxp WHERE SEC_ID = {$this->intSec_id}";
			$request_vsmov 	= $this->select($sql);
		   	if(!empty($request_vsmov))
			{
				$this->strMovtip = $request_vsmov['MOVTIP'];
				$this->intMov_no = $request_vsmov['MOV_NO'];

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


		// INSERTA DOCUMENTO CUENTAS POR PAGAR
		public function insertVsmovcxp(string $movtip, int $mov_no, string $sustri, int $prv_no, string $cta_no, string $gas_no, string $docapl, string $docpto, int $docnum, string $docaut, string $remark, string $fecreg, string $fecemi, float $basiva, float $moniva, float $basiv0, float $basniv, string $reb_no, string $res_no, string $rib_no, string $ris_no, float $monrf1, float $monrf2, float $monri1, float $monri2, string $retpto, int $retnum, string $retaut, float $valdes, float $valors)
		{
            $return = "";
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->strSustri = $sustri;
			$this->intPrv_no = $prv_no;
			$this->strCta_no = $cta_no;
			$this->strGas_no = $gas_no;
			$this->strDocapl = $docapl;
			$this->strDocpto = $docpto;
			$this->intDocnum = $docnum;
			$this->strDocaut = $docaut;
			$this->strRemark = $remark;
			$this->datFecreg = $fecreg;
			$this->datFecemi = $fecemi;
			$this->intBasiva = $basiva;
			$this->intMoniva = $moniva;
			$this->intBasiv0 = $basiv0;
			$this->intBasniv = $basniv;
			$this->strReb_no = $reb_no;
			$this->strRes_no = $res_no;
			$this->strRib_no = $rib_no;
			$this->strRis_no = $ris_no;
			$this->intMonrf1 = $monrf1;
			$this->intMonrf2 = $monrf2;
			$this->intMonri1 = $monri1;
			$this->intMonri2 = $monri2;
			$this->strRetpto = $_SESSION['userData']['PTO_NO'];
			$this->intRetnum = $retnum;
			$this->strRetaut = $retaut;
			$this->intValdes = $valdes;
			$this->intValors = $valors;
			$this->intMovsig = 1;
			$this->intMovprv = 1;
			$this->intPorrf1 = 0;
			$this->intPorrf2 = 0;
			$this->intPorri1 = 0;
			$this->intPorri2 = 0;
			$this->strLogfil = " ";

			
			if(empty($this->strRetpto))
			{
				// PUNTO EMISION INVALIDO
				$return = -7;
				return $return;
			}

			if($this->datFecreg < $this->datFecemi)
			{
				// FECHA INVALIDA
				$return = -2;
				return $return;
			}

			if(empty($this->strReb_no) and empty($this->strRes_no))
			{
			}else{
				if($this->strReb_no == $this->strRes_no)
				{
					// RETENCION INVALIDA
					$return = -4;
					return $return;
				}

				$sql 		= "SELECT VALORS FROM vstables WHERE TAB_NO = 'RF' AND SUB_NO = '{$this->strReb_no}'";
				$request 	= $this->select($sql);
				if(!empty($request))
				{
					$this->intPorrf1 = $request['VALORS'];
				}

				$sql 		= "SELECT VALORS FROM vstables WHERE TAB_NO = 'RF' AND SUB_NO = '{$this->strRes_no}'";
				$request 	= $this->select($sql);
				if(!empty($request))
				{
					$this->intPorrf2 = $request['VALORS'];
				}
			}

			if(empty($this->strRib_no) and empty($this->strRis_no))
			{
			}else{
				if($this->strRib_no == $this->strRis_no)
				{
					// RETENCION INVALIDA
					$return = -4;
					return $return;
				}

				$sql 		= "SELECT VALORS FROM vstables WHERE TAB_NO = 'RI' AND SUB_NO = '{$this->strRib_no}'";
				$request 	= $this->select($sql);
				if(!empty($request))
				{
					$this->intPorri1 = $request['VALORS'];
				}

				$sql 		= "SELECT VALORS FROM vstables WHERE TAB_NO = 'RI' AND SUB_NO = '{$this->strRis_no}'";
				$request 	= $this->select($sql);
				if(!empty($request))
				{
					$this->intPorri2 = $request['VALORS'];
				}
			}

			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -5;
				return $return;
			}	

			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strGas_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -5;
				return $return;
			}	

			$sql 		= "SELECT * FROM vsmovcxp WHERE PRV_NO = {$this->intPrv_no} AND DOCNUM = {$this->intDocnum}";
		    $request 	= $this->select($sql);
   			if(!empty($request))
    		{
				// DOCUMENTO APLICADO YA EXISTE
				$return = -6;
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


			// EXTRAE SECUENCIAL DE RETENCION
			if(empty($this->strReb_no) and empty($this->strRes_no) and empty($this->strRib_no) and empty($this->strRis_no))
			{
			}else if($this->intRetnum == 0){
				$sql     = "SELECT * FROM vssecuen WHERE MOVTIP = 'RF' AND PTO_NO = '{$this->strRetpto}'";
				$request = $this->select($sql);
				if(empty($request))
				{
					$insert          = "INSERT INTO vssecuen(movtip,pto_no) VALUES(?,?)";
					$arrData         = array('RF',$this->strRetpto);
					$request_insert  = $this->insert($insert,$arrData);
					$this->intRetnum = 1;
				}else{
					$this->intRetnum = $request['MOV_NO'] + 1;
				}
		
				$insert         = "UPDATE vssecuen SET mov_no = ? WHERE MOVTIP = 'RF' AND PTO_NO = '{$this->strRetpto}'";
				$arrData        = array($this->intRetnum);
				$request_insert = $this->update($insert,$arrData);

	            // DATA EMPRESA
    	        $sql        		= "SELECT * FROM vsdefaul";
        	    $request_vsdefaul   = $this->select($sql);
				$this->strAmi_id 	= $request_vsdefaul['AMI_ID']; 
				$this->strRuc_id 	= $request_vsdefaul['RUC_NO']; 
	            $this->strLogfil    = 'Xml/'.$this->strAmi_id.'/'.$this->strRuc_id.$this->strRetpto.str_pad($this->intRetnum, 9, "0", STR_PAD_LEFT).'.xml';

				// OBTIENE NUMERO DE AUTORIZACION RETENCION
				$yearBilling 		= substr($this->datFecreg,0,4);
				$monthBilling 		= substr($this->datFecreg,5,2);
				$dayBilling 		= substr($this->datFecreg,8,2);
				$this->strRetaut 	= numAut($dayBilling.$monthBilling.$yearBilling.'07'.$this->strRuc_id.'2'.$this->strRetpto.$this->intRetnum.'12345678'.'1');
			}


			$this->strMovapl = $this->strMovtip;
			$this->intMovnum = $this->intMov_no;

			$sql 		= "SELECT * FROM vsmovcxp WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
		    $request 	= $this->select($sql);
   			if(empty($request))
    		{
				$insert         = "INSERT INTO vsmovcxp(movtip,mov_no,movapl,movnum,sustri,prv_no,cta_no,gas_no,docapl,docpto,docnum,docaut,remark,fecreg,fecemi,basiva,moniva,basiv0,basniv,codrf1,codrf2,codri1,codri2,monrf1,monrf2,monri1,monri2,retpto,retnum,retaut,valdes,valors,movsig,movprv,porrf1,porrf2,porri1,porri2,logfil) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		    	$arrData        = array($this->strMovtip,$this->intMov_no,$this->strMovapl,$this->intMovnum,$this->strSustri,$this->intPrv_no,$this->strCta_no,$this->strGas_no,$this->strDocapl,$this->strDocpto,$this->intDocnum,$this->strDocaut,$this->strRemark,$this->datFecreg,$this->datFecemi,$this->intBasiva,$this->intMoniva,$this->intBasiv0,$this->intBasniv,$this->strReb_no,$this->strRes_no,$this->strRib_no,$this->strRis_no,$this->intMonrf1,$this->intMonrf2,$this->intMonri1,$this->intMonri2,$this->strRetpto,$this->intRetnum,$this->strRetaut,$this->intValdes,$this->intValors,$this->intMovsig,$this->intMovprv,$this->intPorrf1,$this->intPorrf2,$this->intPorri1,$this->intPorri2,$this->strLogfil);
			    $request_insert = $this->insert($insert,$arrData);
			    $return         = $request_insert;

				// CONTABILIZACION
				$contab			= $this->vsmovcxpcon(1,$this->strMovtip,$this->strMovpto,$this->intMov_no);

				// GENERA XML RETENCION ELECTRONICA
				if($this->strMovtip == 'PF')
				{
					$xml			= $this->vsXMLCreate($this->strMovtip,$this->intMov_no);
				}
   			}else{
				// EXISTE
    			$return = -1;
	    	}
		    return $return;
        }


		// ACTUALIZA DOCUMENTO CUENTAS POR PAGAR
		public function updateVsmovcxp(int $sec_id, string $movtip, int $mov_no, string $sustri, int $prv_no, string $cta_no, string $gas_no, string $docapl, string $docpto, int $docnum, string $docaut, string $remark, string $fecreg, string $fecemi, float $basiva, float $moniva, float $basiv0, float $basniv, string $reb_no, string $res_no, string $rib_no, string $ris_no, float $monrf1, float $monrf2, float $monri1, float $monri2, string $retpto, int $retnum, string $retaut, float $valdes, float $valors)
		{
            $return = "";
			$this->intSec_id = $sec_id;
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->strSustri = $sustri;
			$this->intPrv_no = $prv_no;
			$this->strCta_no = $cta_no;
			$this->strGas_no = $gas_no;
			$this->strDocapl = $docapl;
			$this->strDocpto = $docpto;
			$this->intDocnum = $docnum;
			$this->strDocaut = $docaut;
			$this->strRemark = $remark;
			$this->datFecreg = $fecreg;
			$this->datFecemi = $fecemi;
			$this->intBasiva = $basiva;
			$this->intMoniva = $moniva;
			$this->intBasiv0 = $basiv0;
			$this->intBasniv = $basniv;
			$this->strReb_no = $reb_no;
			$this->strRes_no = $res_no;
			$this->strRib_no = $rib_no;
			$this->strRis_no = $ris_no;
			$this->intMonrf1 = $monrf1;
			$this->intMonrf2 = $monrf2;
			$this->intMonri1 = $monri1;
			$this->intMonri2 = $monri2;
			$this->strRetpto = $retpto;
			$this->intRetnum = $retnum;
			$this->strRetaut = $retaut;
			$this->intValdes = $valdes;
			$this->intValors = $valors;
			$this->intMovprv = 1;
			$this->intPorrf1 = 0;
			$this->intPorrf2 = 0;
			$this->intPorri1 = 0;
			$this->intPorri2 = 0;
			$this->strLogfil = " ";
	
			if($this->datFecreg < $this->datFecemi)
			{
				// FECHA INVALIDA
				$return = -2;
				return $return;
			}

			$sql 		= "SELECT * FROM vsmovcxp WHERE SEC_ID = {$this->intSec_id}";
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

			if(empty($this->strReb_no) and empty($this->strRes_no))
			{
			}else{
				if($this->strReb_no == $this->strRes_no)
				{
					// RETENCION INVALIDA
					$return = -4;
					return $return;
				}

				$sql 		= "SELECT VALORS FROM vstables WHERE TAB_NO = 'RF' AND SUB_NO = '{$this->strReb_no}'";
				$request 	= $this->select($sql);
				if(!empty($request))
				{
					$this->intPorrf1 = $request['VALORS'];
				}

				$sql 		= "SELECT VALORS FROM vstables WHERE TAB_NO = 'RF' AND SUB_NO = '{$this->strRes_no}'";
				$request 	= $this->select($sql);
				if(!empty($request))
				{
					$this->intPorrf2 = $request['VALORS'];
				}
			}

			if(empty($this->strRib_no) and empty($this->strRis_no))
			{
			}else{
				if($this->strRib_no == $this->strRis_no)
				{
					// RETENCION INVALIDA
					$return = -4;
					return $return;
				}

				$sql 		= "SELECT VALORS FROM vstables WHERE TAB_NO = 'RI' AND SUB_NO = '{$this->strRib_no}'";
				$request 	= $this->select($sql);
				if(!empty($request))
				{
					$this->intPorri1 = $request['VALORS'];
				}

				$sql 		= "SELECT VALORS FROM vstables WHERE TAB_NO = 'RI' AND SUB_NO = '{$this->strRis_no}'";
				$request 	= $this->select($sql);
				if(!empty($request))
				{
					$this->intPorri2 = $request['VALORS'];
				}
			}

			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -5;
				return $return;
			}	

			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strGas_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -5;
				return $return;
			}	

            // DATA EMPRESA
   	        $sql        		= "SELECT * FROM vsdefaul";
       	    $request_vsdefaul   = $this->select($sql);
			$this->strAmi_id 	= $request_vsdefaul['AMI_ID']; 
			$this->strRuc_id 	= $request_vsdefaul['RUC_NO']; 

			// EXTRAE SECUENCIAL DE RETENCION
			if(empty($this->strReb_no) and empty($this->strRes_no) and empty($this->strRib_no) and empty($this->strRis_no))
			{
			}else if($this->intRetnum == 0){
				$sql     = "SELECT * FROM vssecuen WHERE MOVTIP = 'RF' AND PTO_NO = '{$this->strRetpto}'";
				$request = $this->select($sql);
				if(empty($request))
				{
					$insert          = "INSERT INTO vssecuen(movtip,pto_no) VALUES(?,?)";
					$arrData         = array('RF',$this->strRetpto);
					$request_insert  = $this->insert($insert,$arrData);
					$this->intRetnum = 1;
				}else{
					$this->intRetnum = $request['MOV_NO'] + 1;
				}
		
				$insert         = "UPDATE vssecuen SET mov_no = ? WHERE MOVTIP = 'RF' AND PTO_NO = '{$this->strRetpto}'";
				$arrData        = array($this->intRetnum);
				$request_insert = $this->update($insert,$arrData);
		
				// OBTIENE NUMERO DE AUTORIZACION RETENCION
				$yearBilling 		= substr($this->datFecreg,0,4);
				$monthBilling 		= substr($this->datFecreg,5,2);
				$dayBilling 		= substr($this->datFecreg,8,2);
				$this->strRetaut 	= numAut($dayBilling.$monthBilling.$yearBilling.'07'.$this->strRuc_id.'2'.$this->strRetpto.$this->intRetnum.'12345678'.'1');
			}

            $this->strLogfil    = 'Xml/'.$this->strAmi_id.'/'.$this->strRuc_id.$this->strRetpto.str_pad($this->intRetnum, 9, "0", STR_PAD_LEFT).'.xml';
			$sql 				= "SELECT * FROM vsmovcxp WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no} AND SEC_ID != {$this->intSec_id}";
			$request 			= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsmovcxp SET sustri = ?, docapl = ?, docpto = ?, docnum = ?, docaut = ?, remark = ?, fecreg = ?, fecemi = ?, basiva = ?, moniva = ?, basiv0 = ?, basniv = ?, codrf1 = ?, codrf2 = ?, codri1 = ?, codri2 = ?, monrf1 = ?, monrf2 = ?, monri1 = ?, monri2 = ?, retpto = ?, retnum = ?, retaut = ?, valdes = ?, valors = ?, porrf1 = ?, porrf2 = ?, porri1 = ?, porri2 = ?, logfil = ? WHERE SEC_ID = {$this->intSec_id}";
		    	$arrData        = array($this->strSustri,$this->strDocapl,$this->strDocpto,$this->intDocnum,$this->strDocaut,$this->strRemark,$this->datFecreg,$this->datFecemi,$this->intBasiva,$this->intMoniva,$this->intBasiv0,$this->intBasniv,$this->strReb_no,$this->strRes_no,$this->strRib_no,$this->strRis_no,$this->intMonrf1,$this->intMonrf2,$this->intMonri1,$this->intMonri2,$this->strRetpto,$this->intRetnum,$this->strRetaut,$this->intValdes,$this->intValors,$this->intPorrf1,$this->intPorrf2,$this->intPorri1,$this->intPorri2,$this->strLogfil);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;

				// CONTABILIZACION
				$contab			= $this->vsmovcxpcon(1,$this->strMovtip,$this->strMovpto,$this->intMov_no);

				// GENERA XML RETENCION ELECTRONICA
				if($this->strMovtip == 'PF')
				{
					$xml			= $this->vsXMLCreate($this->strMovtip,$this->intMov_no);
				}
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}


		// INSERTA NOTA DE CREDITO / DEBITO PROVEEDOR
		public function insertVsmovcrp(string $movtip, int $mov_no, int $prv_no, string $docapl, int $docnum, string $remark, string $fecreg, float $valors, string $gas_no)
		{
            $return = "";
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->strDocapl = $docapl;
			$this->intDocnum = $docnum;
			$this->intPrv_no = $prv_no;
			$this->strRemark = $remark;
			$this->datFecreg = $fecreg;
			$this->intValors = $valors;
			$this->strGas_no = $gas_no;
			$this->intMovprv = 1;
			$this->intSuc_no = '';
            

			if($this->strMovtip == 'CP')
			{
				// IMPIDE REGISTRAR NOTA DE CREDITO SI PROVISION APLICADA NO EXISTE O VALOR ES MAYOR AL SALDO DE FACTURA
				$sql 		= "SELECT SUM(VALORS * MOVSIG) AS SALDO FROM vsmovcxp WHERE MOVAPL = 'PF' AND MOVNUM = {$this->intDocnum}";
				$request 	= $this->select($sql);
				if(!empty($request))
				{
					if($this->intValors > $request['SALDO'])
					{
						// VALOR INCORRECTO
						$return = -2;
						return $return;
					}
				}

				// IMPIDE REGISTRAR NOTA DE CREDITO SI DOCUMENTO APLICADO ES NOTA DE DEBITO
				if($this->strDocapl == 'DP')
				{
					// DOCUMENTO APLICADO
					$return = -4;
					return $return;
				}
			}

			// VALIDA CUENTA CONTABLE
			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strGas_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -3;
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

			switch($this->strMovtip)
			{
				case 'CP':
					$this->strDocapl = $docapl;
					$this->intDocnum = $docnum;
					$this->intMovsig = -1;
					break;
				case 'DP':
					$this->strDocapl = $this->strMovtip;
					$this->intDocnum = $this->intMov_no;
					$this->intMovsig = 1;
					break;
			}

			$sql 		= "SELECT * FROM vsmovcxp WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
		    $request 	= $this->select($sql);
   			if(empty($request))
    		{
	    		$insert         = "INSERT INTO vsmovcxp(movtip,mov_no,prv_no,movapl,movnum,retnum,remark,fecreg,valors,gas_no,movsig,movprv) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
		    	$arrData        = array($this->strMovtip,$this->intMov_no,$this->intPrv_no,$this->strDocapl,$this->intDocnum,0,$this->strRemark,$this->datFecreg,$this->intValors,$this->strGas_no,$this->intMovsig,$this->intMovprv);
			    $request_insert = $this->insert($insert,$arrData);
			    $return         = $request_insert;

				// CONTABILIZACION
				$contab			= $this->vsmovcxpcon(1,$this->strMovtip,$this->strMovpto,$this->intMov_no);
   			}else{
				// EXISTE
    			$return = -1;
	    	}
		    return $return;
        }


		// ACTUALIZA NOTA DE CREDITO / DEBITO PROVEEDOR
		public function updateVsmovcrp(int $sec_id, string $movtip, int $mov_no, int $prv_no, string $docapl, int $docnum, string $remark, string $fecreg, float $valors, string $gas_no)
		{
			$return = "";
			$this->intSec_id = $sec_id;
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->strDocapl = $docapl;
			$this->intDocnum = $docnum;
			$this->intPrv_no = $prv_no;
			$this->strRemark = $remark;
			$this->datFecreg = $fecreg;
			$this->intValors = $valors;
			$this->strGas_no = $gas_no;
			
			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strGas_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -3;
				return $return;
			}

			$sql 		= "SELECT * FROM vsmovcxp WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no} AND SEC_ID != {$this->intSec_id}";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsmovcxp SET remark = ?, gas_no = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->strRemark,$this->strGas_no);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;

				// CONTABILIZACION
				$contab			= $this->vsmovcxpcon(1,$this->strMovtip,$this->strMovpto,$this->intMov_no);
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		// INSERTA PAGO A PROVEEDOR
		public function insertVsmovpay(string $movtip, int $mov_no, string $movapl, array $movnum, int $prv_no, string $benefi, int $ban_no, int $che_no, string $remark, float $valors, string $fecreg, string $advanc, string $cta_no)
		{
            $return = "";
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->strMovapl = $movapl;
			$this->intMovnum = $movnum;
			$this->intPrv_no = $prv_no;
			$this->strBenefi = $benefi;
			$this->intBan_no = $ban_no;
			$this->intChe_no = $che_no;
			$this->strRemark = $remark;
			$this->intValors = $valors;
			$this->datFecreg = $fecreg;
			$this->strAdvanc = $advanc;
			$this->strCta_no = $cta_no;
			$this->intMovsig = -1;
			$this->intMovprv = 1;
			$this->intSuc_no = '';

            
            switch($this->strMovtip)
            {
				// PAGO EFECTIVO
                case 'PE':
					$this->intMovban = 0;
                    break; 

                // PAGO CHEQUE
                case 'PC':
					$this->intMovban = 1;
                    break; 

				// PAGO DEBITO BANCARIO
                case 'PD':
					$this->intMovban = 1;
                    break; 
            }

			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -3;
				return $return;
			}

			// VALIDA SI VALOR DEL PAGO COINCIDE CON LAS FACTURAS
			if($this->strAdvanc == "2")
			{
				$this->intMovsum = 0;
				foreach ($movnum as $fap) 
				{
					$sql 			= "SELECT SUM(VALORS * MOVSIG) AS SALDO FROM vsmovcxp WHERE MOVAPL = 'PF' AND MOVNUM = {$fap}";
					$request_valor 	= $this->select($sql);
					if(!empty($request_valor))
					{
						$this->intMovsum = $this->intMovsum + $request_valor['SALDO'];
					}
				}
				if($this->intValors > $this->intMovsum)
				{
					// VALOR INCORRECTO
					$return = -4;
					return $return;
				}	
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

			// ACTUALIZA NUMERO DE CHEQUE
			$sql 				= "SELECT * FROM vsbanker WHERE BAN_NO = {$this->intBan_no}";
			$request_vsbanker 	= $this->select($sql);
			if(!empty($request_vsbanker))
			{
				$insert         = "UPDATE vsbanker SET CHE_NO = ? WHERE BAN_NO = {$this->intBan_no}";
				$arrData        = array($this->intChe_no);
				$request_insert = $this->update($insert,$arrData);
			}

			$sql 		= "SELECT * FROM vsmovcxp WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
		    $request 	= $this->select($sql);
   			if(empty($request))
    		{
				if($this->strAdvanc == "2")
				{
					$this->intMovsum = 0;
					foreach ($movnum as $fap) 
					{
						if($fap > 0)
						{
							$sql 				= "SELECT SUM(VALORS * MOVSIG) AS SALDO FROM vsmovcxp WHERE MOVAPL = 'PF' AND MOVNUM = {$fap}";
							$request_valor 		= $this->select($sql);
							if(!empty($request_valor))
							{
								$this->intFapsal = $request_valor['SALDO'];
								$this->intMovsum = $this->intMovsum + $this->intFapsal;
				
								if($this->intMovsum > $this->intValors)
								{
									$this->intFapval = $this->intFapsal - ($this->intMovsum - $this->intValors);
								}else{
									$this->intFapval = $this->intFapsal;
								}
		
								$insert         = "INSERT INTO vsmovcxp(movtip,mov_no,movapl,movnum,retnum,prv_no,benefi,ban_no,che_no,remark,valors,fecreg,advanc,cta_no,movsig,movprv,movban) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
								$arrData        = array($this->strMovtip,$this->intMov_no,$this->strMovapl,$fap,0,$this->intPrv_no,$this->strBenefi,$this->intBan_no,$this->intChe_no,$this->strRemark,$this->intFapval,$this->datFecreg,$this->strAdvanc,$this->strCta_no,$this->intMovsig,$this->intMovprv,$this->intMovban);
								$request_insert = $this->insert($insert,$arrData);
								$return         = $request_insert;
							}
						}
					}	
				}else{
					$insert         = "INSERT INTO vsmovcxp(movtip,mov_no,movapl,movnum,retnum,prv_no,benefi,ban_no,che_no,remark,valors,fecreg,advanc,cta_no,movsig,movprv,movban) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$arrData        = array($this->strMovtip,$this->intMov_no,$this->strMovapl,0,0,$this->intPrv_no,$this->strBenefi,$this->intBan_no,$this->intChe_no,$this->strRemark,$this->intValors,$this->datFecreg,$this->strAdvanc,$this->strCta_no,$this->intMovsig,$this->intMovprv,$this->intMovban);
					$request_insert = $this->insert($insert,$arrData);
					$return         = $request_insert;
				}

				// INSERTA PAGO EN TRANSACCION BANCARIA
				$sql 		= "SELECT * FROM vsmovban WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
				$request 	= $this->select($sql);
			   	if(empty($request))
				{
					$insert         = "INSERT INTO vsmovban(movtip,mov_no,ban_no,che_no,remark,fecreg,valors,cta_no,movsig,movban) VALUES(?,?,?,?,?,?,?,?,?,?)";
					$arrData        = array($this->strMovtip,$this->intMov_no,$this->intBan_no,$this->intChe_no,$this->strRemark,$this->datFecreg,$this->intValors,$this->strCta_no,$this->intMovsig,$this->intMovban);
					$request_insert = $this->insert($insert,$arrData);
					$return         = $request_insert;
	
					// CONTABILIZACION
					$contab			= $this->vsmovcxpcon(2,$this->strMovtip,$this->strMovpto,$this->intMov_no);
				}
		   	}else{
				// EXISTE
    			$return = -1;
	    	}
		    return $return;
        }


		// ACTUALIZA PAGO A PROVEEDORES
		public function updateVsmovpay(int $sec_id, string $movtip, int $mov_no, string $movapl, array $movnum, int $fap_no, int $prv_no, string $benefi, int $ban_no, int $che_no, string $remark, float $valors, string $fecreg, string $advanc, string $cta_no)
		{
            $return = 2;
			$this->intSec_id = $sec_id;
			$this->strMovtip = $movtip;
			$this->strMovpto = '';
			$this->intMov_no = $mov_no;
			$this->strMovapl = $movapl;
			$this->intMovnum = $movnum;
			$this->intFap_no = $fap_no;
			$this->intPrv_no = $prv_no;
			$this->strBenefi = $benefi;
			$this->intBan_no = $ban_no;
			$this->intChe_no = $che_no;
			$this->strRemark = $remark;
			$this->intValors = $valors;
			$this->datFecreg = $fecreg;
			$this->strAdvanc = $advanc;
			$this->strCta_no = $cta_no;
			$this->intMovsig = -1;
			$this->intMovprv = 1;
			$this->intSuc_no = '';

			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -3;
				return $return;
			}

			if($this->intFap_no > 0)
			{
				$sql 				= "SELECT SUM(VALORS * MOVSIG) AS SALDO FROM vsmovcxp WHERE MOVAPL = 'PF' AND MOVNUM = {$this->intFap_no}";
				$request_valor 		= $this->select($sql);
				if($this->intValors > $request_valor['SALDO'] or $request_valor['SALDO'] == 0)
				{
					// FACTURA COMPENSADA
					$return = -6;
					return $return;
				}

				$sql 		= "SELECT * FROM vsmovcxp WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no} AND SEC_ID != {$this->intSec_id}";
				$request 	= $this->select($sql);
				if(empty($request))
				{
					$insert         = "UPDATE vsmovcxp SET movnum = ? WHERE SEC_ID = {$this->intSec_id}";
					$arrData        = array($this->intFap_no);
					$request_insert = $this->update($insert,$arrData);
					$return         = $request_insert;
				}else{
					// EXISTE
					$return = -1;
				}
			}
			return $return;
		}
	}
