 <?php

	class VsbillinModel extends Mysql
	{
		public $intPerios;
		public $intStd_no;
		public $strPer_no;
		public $strRuc_no;
		public $strRazons;
		public $strDirecc;
		public $strTlf_no;
		public $strEmails;
		public $strDoctip;
		public $intDocabo;
		public $intDocval;
		public $strPto_no;
		public $datFecemi;
		public $intAbotyp;
		public $strAut_no;
		public $intDocnum;
		public $strPayfor;
		public $strBan_no;
		public $strChenum;
		public $strDepnum;
		public $strTar_no;
		public $strTarnum;
		public $strVounum;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVsbillin()
		{
			$sql 		= "SELECT * FROM vsbillin ORDER BY SEC_ID DESC";
			$request 	= $this->select_all($sql);
			return $request;
		}


		// QUERY PARA DIARIO DE VENTAS
		public function getVsdiaVen(int $perios, string $datdes, string $dathas, int $reptyp)
		{
			$this->intPerios = $perios;
			$this->datFecdes = $datdes;
			$this->datFechas = $dathas;
			$this->intReptyp = $reptyp;

			if($this->intReptyp == 1)
			{
				$where = "WHERE v.PERIOS = {$this->intPerios} AND (v.FECEMI BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}') AND t.TAB_NO = 'MON' ORDER BY v.FECEMI,v.DOCTIP,v.DOCNUM,v.PER_NO";
				$sql = "SELECT 	v.PERIOS,
				               	v.STD_NO,
							   	v.PER_NO,
							   	t.SUB_NM,
							   	v.ART_NO,
							   	v.ABOVAL,
								v.DOCTIP,
								v.DOCSIG,
							   	v.DOCPTO,
							   	v.DOCNUM,
							   	v.FECEMI,
							   	v.PAYFOR,
				    		   	e.LAS_NM,
			    			   	e.FIR_NM,
			    			   	s.SEC_NM,
			    			   	s.PARALE,
								s.NIV_NO
				        FROM vsbildet v
						INNER JOIN vstables t ON t.SUB_NO = v.PER_NO
						INNER JOIN vsstdhis h ON h.STD_NO = v.STD_NO AND h.PERIOS = v.PERIOS
						INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
						INNER JOIN vsection s ON s.SEC_NO = h.SEC_NO ".$where;
			}else{
				$where = "WHERE v.PERIOS = {$this->intPerios} AND (v.FECEMI BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}') AND t.TAB_NO = 'MON' ORDER BY v.PERIOS,v.PER_NO,v.ART_NO";
				$sql = "SELECT 	v.PERIOS,
				               	v.STD_NO,
							   	v.PER_NO,
							   	t.SUB_NM,
							   	v.ART_NO,
								v.DOCTIP,
							    v.DOCSIG,
							   	v.ABOVAL,
							   	v.FECEMI,
							   	v.PAYFOR
			        	FROM vsbildet v
			        	INNER JOIN vstables t ON t.SUB_NO = v.PER_NO ".$where;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// OBTIENE DATA PARA FACTURA PREVIEW
		public function previewPDF(int $secID)
		{
			$request = array();

			// CABECERA FACTURA
			$where = "WHERE SEC_ID = ".$secID;
			$sql = "SELECT PERIOS,STD_NO,RUC_NO,RAZONS,DIRECC,TLF_NO,EMAILS,DOCTIP,DOCPTO,DOCNUM,FECEMI,AUT_NO,DOCVAL 
					FROM vsbillin ".$where;
			$req_headBillin = $this->select($sql);

			// DETALLE FACTURA
			$where = "WHERE v.DOCTIP = '".$req_headBillin['DOCTIP']."' AND v.DOCPTO = ".$req_headBillin['DOCPTO']." AND v.DOCNUM = ".$req_headBillin['DOCNUM']." AND t.TAB_NO = 'MON'";
			$sql = "SELECT t.SUB_NM,p.ART_NO,p.ART_NM,p.DESIVA,v.DOCVAL,v.FACVAL,v.ABOVAL,v.RETVAL,v.DOCTIP,v.DOCPTO,v.DOCNUM,v.FECEMI 
					FROM vsbildet v
					INNER JOIN vsproduc p ON p.ART_NO = v.ART_NO 
					INNER JOIN vstables t ON t.SUB_NO = v.PER_NO ".$where;
			$req_detailBill = $this->select_all($sql);

			$request = array('headBillin' => $req_headBillin,'detailBill' => $req_detailBill);
			return $request;
		}


		// OBTIENE SALDO DE CUENTA POR COBRAR DE UN ESTUDIANTE
		public function getVsgetVal(int $perios, int $codStd, string $codPer, int $codAbotyp, int $codOpcion)
		{
			$this->codAbotyp = $codAbotyp;
			$this->codOpcion = $codOpcion;

			if ($this->codOpcion == 1)
			{
				// Corte Acumulado
				if ($this->codAbotyp == 1)
				{
					$where = "WHERE PERIOS = ".$perios." AND STD_NO = ".$codStd." AND PER_NO <= '".$codPer."'";
				}else{
				// Corte Corriente
					$where = "WHERE PERIOS = ".$perios." AND STD_NO = ".$codStd." AND PER_NO = '".$codPer."'";
				}
			    $sql = "SELECT SUM(FACVAL - ABOVAL) AS FACVAL FROM vstariff ".$where;
			}else{
				$where = "WHERE PERIOS = ".$perios." AND STD_NO = ".$codStd." AND (FACVAL - ABOVAL) >0";
			    $sql = "SELECT PER_NO,(FACVAL - ABOVAL) AS FACVAL FROM vstariff ".$where;
			}

			$request = $this->select($sql);	
			return $request;
		}


		// OBTIENE INFORMACION DE QUIEN FACTURA DE UN CLIENTE
		public function getDatFac(int $codPerios, int $codStd_no, int $codFac_no)
		{
		    $sql = "SELECT STD_NO,FACWHO,RAZONS,DIRECC,TLF_NO,CLTYPE,RUC_NO,EMAILS,SEC_NO FROM vstudent WHERE STD_NO = ".$codStd_no;

			if($codFac_no != 0)
			{
				switch($codFac_no)
				{
					case 1:
						$sql = "SELECT STD_NO,FACWHO,FATLAS,FATNAM,FATADR,FATFON,FATYPE,FATCED,FATMAI,SEC_NO FROM vstudent WHERE STD_NO = ".$codStd_no;
						break;
					case 2:
						$sql = "SELECT STD_NO,FACWHO,MOTLAS,MOTNAM,MOTADR,MOTFON,MOTYPE,MOTCED,MOTMAI,SEC_NO FROM vstudent WHERE STD_NO = ".$codStd_no;
						break;
					case 3:
						$sql = "SELECT STD_NO,FACWHO,REPLAS,REPNAM,REPADR,REPFON,RETYPE,REPCED,REPMAI,SEC_NO FROM vstudent WHERE STD_NO = ".$codStd_no;
						break;
				}
			}
			$request = $this->select($sql);	
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


		// CREA UN DOCUMENTO FACTURA / NOTA DE CREDITO EN XML
        public function vsXMLCreate(string $movtip, string $movpto, int $mov_no)
		{
            $return = "";
		    $this->strMovtip_ = $movtip; 
		    $this->strMovpto_ = $movpto;
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

            $sql        = "SELECT c.CLTYPE,c.RUC_NO,c.RAZONS,c.DIRECC,c.TLF_NO,c.EMAILS,c.DOCVAL,c.AUT_NO,
								  c.DOCPTO,c.DOCNUM,c.FECEMI,p.ART_NM,d.ART_NO,d.ABOVAL
                            FROM vsbildet d
                            INNER JOIN vsbillin c ON c.DOCTIP = d.DOCTIP AND c.DOCPTO = d.DOCPTO AND c.DOCNUM = d.DOCNUM
							INNER JOIN vsproduc p ON p.ART_NO = d.ART_NO
							WHERE d.DOCTIP = '{$this->strMovtip_}' AND d.DOCPTO = '{$this->strMovpto_}' AND d.DOCNUM = {$this->intMov_no_}";
            $request    = $this->select_all($sql);

			if(empty($request))
			{
                $request_xml = 'error';
            }else{
				$request[0]['FECEMI'] = substr($request[0]['FECEMI'],8,2).'/'.substr($request[0]['FECEMI'],5,2).'/'.substr($request[0]['FECEMI'],0,4);

				$request_xml 		= 'ok';
                $xml         		= new DomDocument('1.0','UTF-8');

                $factura      		= $xml->createElement('factura');
                $factura	  		= $xml->appendChild($factura);

				$infoTributaria 	= $xml->createElement('infoTributaria');
				$infoTributaria 	= $factura->appendChild($infoTributaria);

				$nodo01         	= $xml->createElement('ambiente',1);
				$nodo01         	= $infoTributaria->appendChild($nodo01);
				$nodo02         	= $xml->createElement('tipoEmision',1);
				$nodo02         	= $infoTributaria->appendChild($nodo02);
				$nodo03         	= $xml->createElement('razonSocial',$this->strRazons);
				$nodo03         	= $infoTributaria->appendChild($nodo03);
				$nodo04         	= $xml->createElement('nombreComercial',$this->strRazons);
				$nodo04         	= $infoTributaria->appendChild($nodo04);
				$nodo05         	= $xml->createElement('ruc',$this->strRuc_no);
				$nodo05         	= $infoTributaria->appendChild($nodo05);
				$nodo06         	= $xml->createElement('claveAcceso',$request[0]['AUT_NO']);
				$nodo06         	= $infoTributaria->appendChild($nodo06);
				$nodo07         	= $xml->createElement('codDoc','01');
				$nodo07         	= $infoTributaria->appendChild($nodo07);
				$nodo08         	= $xml->createElement('estab',substr($request[0]['DOCPTO'],0,3));
				$nodo08         	= $infoTributaria->appendChild($nodo08);
				$nodo09         	= $xml->createElement('ptoEmi',substr($request[0]['DOCPTO'],3,3));
				$nodo09         	= $infoTributaria->appendChild($nodo09);
				$nodo10         	= $xml->createElement('secuencial',str_pad($request[0]['DOCNUM'], 9, "0", STR_PAD_LEFT));
				$nodo10         	= $infoTributaria->appendChild($nodo10);
				$nodo11         	= $xml->createElement('dirMatriz',$this->strAddres);
				$nodo11         	= $infoTributaria->appendChild($nodo11);

				$infoFactura 		= $xml->createElement('infoFactura');
				$infoFactura 		= $factura->appendChild($infoFactura);

				$nodo12         	= $xml->createElement('fechaEmision',$request[0]['FECEMI']);
                $nodo12         	= $infoFactura->appendChild($nodo12);
				$nodo13         	= $xml->createElement('dirEstablecimiento',$this->strAddres);
                $nodo13         	= $infoFactura->appendChild($nodo13);
				$nodo14         	= $xml->createElement('obligadoContabilidad','SI');
                $nodo14         	= $infoFactura->appendChild($nodo14);
				$nodo15         	= $xml->createElement('tipoIdentificacionComprador',$request[0]['CLTYPE']);
                $nodo15         	= $infoFactura->appendChild($nodo15);
				$nodo16         	= $xml->createElement('razonSocialComprador',$request[0]['RAZONS']);
                $nodo16         	= $infoFactura->appendChild($nodo16);
				$nodo17         	= $xml->createElement('identificacionComprador',$request[0]['RUC_NO']);
                $nodo17         	= $infoFactura->appendChild($nodo17);
				$nodo18         	= $xml->createElement('totalSinImpuestos',$request[0]['DOCVAL']);
                $nodo18         	= $infoFactura->appendChild($nodo18);
				$nodo19         	= $xml->createElement('totalDescuento',$request[0]['DOCVAL']);
                $nodo19         	= $infoFactura->appendChild($nodo19);

				$totalConImpuestos 	= $xml->createElement('totalConImpuestos');
				$totalConImpuestos	= $infoFactura->appendChild($totalConImpuestos);

				$totalImpuesto 		= $xml->createElement('totalImpuesto');
				$totalImpuesto		= $totalConImpuestos->appendChild($totalImpuesto);

				$nodo20         	= $xml->createElement('codigo',2);
                $nodo20         	= $totalImpuesto->appendChild($nodo20);
				$nodo21         	= $xml->createElement('codigoPorcentaje',2);
                $nodo21         	= $totalImpuesto->appendChild($nodo21);
				$nodo22         	= $xml->createElement('baseImponible',$request[0]['DOCVAL']);
                $nodo22         	= $totalImpuesto->appendChild($nodo22);
				$nodo23         	= $xml->createElement('valor',0);
                $nodo23         	= $totalImpuesto->appendChild($nodo23);
				$nodo24         	= $xml->createElement('propina',0);
                $nodo24         	= $totalConImpuestos->appendChild($nodo24);
				$nodo25         	= $xml->createElement('importeTotal',$request[0]['DOCVAL']);
                $nodo25         	= $totalConImpuestos->appendChild($nodo25);
				$nodo26         	= $xml->createElement('moneda','DOLAR');
                $nodo26         	= $totalConImpuestos->appendChild($nodo26);

				$detalles	 		= $xml->createElement('detalles');
				$detalles			= $factura->appendChild($detalles);

				for($i = 0; $i < count($request); $i++)
				{
					$detalle	 		= $xml->createElement('detalle');
					$detalle			= $detalles->appendChild($detalle);

					$nodo27         	= $xml->createElement('codigoPrincipal',str_pad($request[$i]['ART_NO'], 3, "0", STR_PAD_LEFT));
					$nodo27         	= $detalle->appendChild($nodo27);
					$nodo28         	= $xml->createElement('codigoAuxiliar',str_pad($request[$i]['ART_NO'], 3, "0", STR_PAD_LEFT));
					$nodo28         	= $detalle->appendChild($nodo28);
					$nodo29         	= $xml->createElement('descripcion',$request[$i]['ART_NM']);
					$nodo29         	= $detalle->appendChild($nodo29);
					$nodo30         	= $xml->createElement('cantidad',1);
					$nodo30         	= $detalle->appendChild($nodo30);
					$nodo31         	= $xml->createElement('precioUnitario',$request[$i]['ABOVAL']);
					$nodo31         	= $detalle->appendChild($nodo31);
					$nodo32         	= $xml->createElement('descuento',0);
					$nodo32         	= $detalle->appendChild($nodo32);
					$nodo33         	= $xml->createElement('precioTotalSinImpuesto',$request[$i]['ABOVAL']);
					$nodo33         	= $detalle->appendChild($nodo33);

					$detallesAdicionales = $xml->createElement('detallesAdicionales');
					$detallesAdicionales = $detalle->appendChild($detallesAdicionales);

					$impuestos 			= $xml->createElement('impuestos');
					$impuestos 			= $detalle->appendChild($impuestos);

					$impuesto 			= $xml->createElement('impuesto');
					$impuesto 			= $impuestos->appendChild($impuesto);

					$nodo34         	= $xml->createElement('codigo',2);
					$nodo34         	= $impuesto->appendChild($nodo34);
					$nodo35         	= $xml->createElement('codigoPorcentaje',2);
					$nodo35         	= $impuesto->appendChild($nodo35);
					$nodo36         	= $xml->createElement('tarifa',12);
					$nodo36         	= $impuesto->appendChild($nodo36);
					$nodo37         	= $xml->createElement('baseImponible',$request[0]['ABOVAL']);
					$nodo37         	= $impuesto->appendChild($nodo37);
					$nodo38         	= $xml->createElement('valor',0);
					$nodo38         	= $impuesto->appendChild($nodo38);
				}

                $ruta               = '../Xml/'.$this->strAmi_id.'/'.$this->strRuc_no.$this->strMovtip_.$this->strMovpto_.str_pad($this->intMov_no_, 9, "0", STR_PAD_LEFT).'.xml';
                $xml->formatOutput  = true;
                $el_xml             = $xml->saveXML();
                $xml->save($ruta);
            }
            return $request_xml;
        }


		// CONTABILIZA DOCUMENTOS FACTURACION
		public function vsbillincon(int $tables, string $movtip, string $movpto, int $mov_no)
		{
            $return = "";
		    $this->intTables_ = $tables; 
		    $this->strMovtip_ = $movtip; 
		    $this->strMovpto_ = $movpto;
		    $this->intMov_no_ = $mov_no; 

			if($this->intTables_ == 1)
			{
				$sql = "SELECT * FROM vsbildet WHERE DOCTIP = '{$this->strMovtip_}' AND DOCPTO = '{$this->strMovpto_}' AND DOCNUM = {$this->intMov_no_}";
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
										$insert         = "INSERT INTO vsmovacc(movtip,movpto,mov_no,docapl,docpto,docnum,fecreg,valors,cta_no,signos) VALUES(?,?,?,?,?,?,?,?,?,?)";
										$arrData        = array($this->strMovtip_,$this->strMovpto_,$this->intMov_no_,'','',0,$request_vsmov[$j]['FECEMI'],$this->intDocval_,$this->strCta_no_,$this->intSignos_);
										$request_insert = $this->insert($insert,$arrData);
										$return         = $request_insert;
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
										$insert         = "INSERT INTO vsmovacc(movtip,movpto,mov_no,docapl,docpto,docnum,fecreg,valors,cta_no,signos) VALUES(?,?,?,?,?,?,?,?,?,?)";
										$arrData        = array($this->strMovtip_,$this->strMovpto_,$this->intMov_no_,'','',0,$request_vsmov[$j]['FECEMI'],$this->intDocval_,$this->strCta_no_,$this->intSignos_);
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


		// INSERTA UNA FACTURA
		public function insertVsbillin(int $perios, int $std_no, string $per_no, string $cltype, string $ruc_no, string $razons, string $direcc, string $tlf_no, string $emails, int $abotyp, string $doctip, float $docval, float $docabo, string $fecemi, string $payfor, int $docnum, string $ban_no, string $chenum, string $depnum, string $tar_no, string $tarnum, string $vounum)
		{
   			$return = "";
		    $this->intPerios = $perios; 
		    $this->intStd_no = $std_no;
			$this->strPer_no = $per_no;
			$this->strCltype = $cltype;
			$this->strRuc_no = $ruc_no;
			$this->strRazons = $razons;
			$this->strDirecc = $direcc;
			$this->strTlf_no = $tlf_no;
			$this->strEmails = $emails;
			$this->intAbotyp = $abotyp;
			$this->strDoctip = $doctip;
			$this->intDocsig = 1;
			$this->intDocval = $docval;
			$this->intDocabo = $docabo;
			$this->strPto_no = $_SESSION['userData']['PTO_NO'];
			$this->datFecemi = $fecemi;
			$this->strPayfor = $payfor;
			$this->intDocnum = $docnum;
			$this->strBan_no = $ban_no;
			$this->strChenum = $chenum;
			$this->strDepnum = $depnum;
			$this->strTar_no = $tar_no;
			$this->strTarnum = $tarnum;
			$this->strVounum = $vounum;

			if(empty($this->strPto_no))
			{
				// PUNTO EMISION INVALIDO
				$return = -3;
				return $return;
			}

			// Valida que el ABONO no sea MAYOR al VALOR A FACTURAR
			if($this->intDocabo > $this->intDocval or $this->intDocabo < 0)
			{
				// VALOR INCORRECTO
				$return = -2;
				return $return;
			}


			// SI NUMERO DE DOCUMENTO ES CERO EXTRAE SECUENCIAL POR TIPO DOCUMENTO Y PUNTO EMISION
			if($this->intDocnum == 0)
			{
				$sql     = "SELECT * FROM vssecuen WHERE MOVTIP = '{$this->strDoctip}' AND PTO_NO = '{$this->strPto_no}'";
				$request = $this->select($sql);
				if(empty($request))
				{
					$insert          = "INSERT INTO vssecuen(movtip,pto_no) VALUES(?,?)";
					$arrData         = array($this->strDoctip,$this->strPto_no);
					$request_insert  = $this->insert($insert,$arrData);
					$this->intDocnum = 1;
				}else{
					$this->intDocnum = $request['MOV_NO'] + 1;
				}	

				$insert         = "UPDATE vssecuen SET mov_no = ? WHERE MOVTIP = '{$this->strDoctip}' AND PTO_NO = '{$this->strPto_no}'";
				$arrData        = array($this->intDocnum);
				$request_insert = $this->update($insert,$arrData);
			}


            // DATA EMPRESA
            $sql        		= "SELECT * FROM vsdefaul";
            $request_vsdefaul   = $this->select($sql);
			$this->strAmi_id 	= $request_vsdefaul['AMI_ID']; 
			$this->strRuc_id 	= $request_vsdefaul['RUC_NO']; 
            $this->strLogfil    = '../Xml/'.$this->strAmi_id.'/'.$this->strRuc_id.$this->strDoctip.$this->strPto_no.str_pad($this->intDocnum, 9, "0", STR_PAD_LEFT).'.xml';

			// TIPO IDENTIFICACION
			if(substr($this->strRuc_no,0,10) == '9999999999')
			{
				// CONSUMIDOR FINAL
				$this->strCltype = '07';
			}

			// DATA ESTUDIANTE
			$sql     			= "SELECT LAS_NM,FIR_NM FROM vstudent WHERE STD_NO = {$this->intStd_no}";
			$request_vstudent 	= $this->select($sql);
			if(empty($request_vstudent))
			{
				$this->strRemark = '';
			}else{
				$this->strRemark = $request_vstudent['LAS_NM'].' '.$request_vstudent['FIR_NM'];
			}


			// OBTIENE NUMERO DE AUTORIZACION FACTURA
			$yearBilling 		= substr($this->datFecemi,0,4);
			$monthBilling 		= substr($this->datFecemi,5,2);
			$dayBilling 		= substr($this->datFecemi,8,2);
			$this->strAut_no 	= numAut($dayBilling.$monthBilling.$yearBilling.'01'.$this->strRuc_id.'2'.$this->strPto_no.$this->intDocnum.'12345678'.'1');

			// Registra CABECERA VSBILLIN Factura para SRI
			$sql 				= "SELECT * FROM vsbillin WHERE DOCTIP = '{$this->strDoctip}' AND DOCPTO = '{$this->strPto_no}' AND DOCNUM = {$this->intDocnum}";
			$request_vsbillin 	= $this->select($sql);
			if(empty($request_vsbillin))
			{
				$insert         = "INSERT INTO vsbillin(perios,std_no,cltype,ruc_no,razons,direcc,tlf_no,emails,doctip,docval,docpto,docnum,fecemi,aut_no,ptoapl,docapl,docsig,remark,logfil) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData        = array($this->intPerios,$this->intStd_no,$this->strCltype,$this->strRuc_no,$this->strRazons,$this->strDirecc,$this->strTlf_no,$this->strEmails,$this->strDoctip,$this->intDocabo,$this->strPto_no,$this->intDocnum,$this->datFecemi,$this->strAut_no,'',0,$this->intDocsig,$this->strRemark,$this->strLogfil);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
				return $return;
			}


			// OBTIENE REGISTROS A FACTURAR
			if ($this->intAbotyp == 1)
			{
				$sql = "SELECT * FROM vstariff WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO <= '{$this->strPer_no}' AND (FACVAL - ABOVAL) > 0 ORDER BY SEC_ID";
			}else{
				$sql = "SELECT * FROM vstariff WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}'  AND (FACVAL - ABOVAL) > 0 ORDER BY SEC_ID";
			}
			$request_vstariff = $this->select_all($sql);
			if(!empty($request_vstariff))
			{
				$this->intAbosum = 0;
				for ($i = 0; $i < count($request_vstariff); $i++) 
				{
					$this->intSec_id = $request_vstariff[$i]['SEC_ID'];
					$this->intDocval = $request_vstariff[$i]['DOCVAL'];
					$this->intFacval = $request_vstariff[$i]['FACVAL'] - $request_vstariff[$i]['ABOVAL'];
					$this->strPer_no = $request_vstariff[$i]['PER_NO'];
					$this->intArt_no = $request_vstariff[$i]['ART_NO'];
					$this->intAbosum = $this->intAbosum + $this->intFacval;

					if($this->intAbosum > $this->intDocabo)
					{
						$this->intAboval = $this->intFacval - ($this->intAbosum - $this->intDocabo);
					}else{
						$this->intAboval = $this->intFacval;
					}
				  
					// Registra DETALLE Factura / Recibo
					$insert         = "INSERT INTO vsbildet(perios,std_no,per_no,art_no,ban_no,remark,docval,facval,aboval,retval,doctip,docsig,docpto,docnum,fecemi,fecche,horcob,payfor,ctenum,chenum,depnum,tar_no,tarnum,vounum,aut_no) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$arrData        = array($this->intPerios,$this->intStd_no,$this->strPer_no,$this->intArt_no,$this->strBan_no,'',$this->intDocval,$this->intFacval,$this->intAboval,0,$this->strDoctip,$this->intDocsig,$this->strPto_no,$this->intDocnum,$this->datFecemi,$this->datFecemi,'',$this->strPayfor,'',$this->strChenum,$this->strDepnum,$this->strTar_no,$this->strTarnum,$this->strVounum,$this->strAut_no);
					$request_insert = $this->insert($insert,$arrData);

					// Sumariza registros por Año, Estudiante, Periodo, Articulo y actualiza VSTARIFF
					$this->intAboval = 0;
					$sql 				= "SELECT SUM(ABOVAL * DOCSIG) as ABOPRO FROM vsbildet WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}' AND ART_NO = {$this->intArt_no}";
					$request_vsbildet 	= $this->select($sql);
					if(!empty($request_vsbildet))
					{
						if($request_vsbildet['ABOPRO'] != "")
						{
						   $this->intAboval = $request_vsbildet['ABOPRO'];			
						} 
						$insert         = "UPDATE vstariff SET aboval = ?, doctip = ?, docsig = ?, docpto = ?, docnum = ?, fecemi = ? WHERE SEC_ID = {$this->intSec_id}";
						$arrData        = array($this->intAboval,$this->strDoctip,$this->intDocsig,$this->strPto_no,$this->intDocnum,$this->datFecemi);
						$request_insert = $this->update($insert,$arrData);
					}
				}
				// CONTABILIZA FACTURA
				$contab			= $this->vsbillincon(1,$this->strDoctip,$this->strPto_no,$this->intDocnum);

				// GENERA XML FACTURA ELECTRONICA
				$xml			= $this->vsXMLCreate($this->strDoctip,$this->strPto_no,$this->intDocnum);
			}
			return $return;
		}


		// INSERTA NOTA DE CREDITO CLIENTE
		public function insertVsnotcre(string $pto_no, int $facnum, float $docval, string $fecemi)
		{
   			$return = "";
		    $this->strPtoapl = $pto_no;
			$this->intFacnum = $facnum;
			$this->intDocval = $docval;
			$this->datFecemi = $fecemi;
//		    $this->strCre_no = $cre_no;
			$this->strDoctip = 'NC';
			$this->intDocsig = -1;
			$this->strRemark = '';
			$this->strPto_no = $_SESSION['userData']['PTO_NO'];

			if(empty($this->strPto_no))
			{
				// PUNTO EMISION INVALIDO
				$return = -3;
				return $return;
			}

			// Obtiene información de la Factura
			$sql 				= "SELECT * FROM  vsbillin WHERE DOCTIP = 'FA' AND DOCPTO = '{$this->strPtoapl}' AND DOCNUM = {$this->intFacnum}";
			$request_vsbillin 	= $this->select($sql);
			if(empty($request_vsbillin))
			{
				// DOCUMENTO APLICADO NO EXISTE
				$return = -4;
				return $return;
			}

			$this->intPerios = $request_vsbillin['PERIOS']; 
			$this->intStd_no = $request_vsbillin['STD_NO'];
			$this->strRuc_no = $request_vsbillin['RUC_NO'];
			$this->strRazons = $request_vsbillin['RAZONS'];
			$this->strDirecc = $request_vsbillin['DIRECC'];
			$this->strTlf_no = $request_vsbillin['TLF_NO'];
			$this->strEmails = $request_vsbillin['EMAILS'];	
			$this->intFacval = $request_vsbillin['DOCVAL'];	

			// Valida que el VALOR no sea MAYOR al VALOR DE FACTURA
			if($this->intDocval < 0 or $this->intDocval > $this->intFacval)
			{
				// VALOR INCORRECTO
				$return = -2;
				return $return;
			}

			// EXTRAE SECUENCIAL POR TIPO DOCUMENTO Y PUNTO EMISION
			$sql     = "SELECT * FROM vssecuen WHERE MOVTIP = '{$this->strDoctip}' AND PTO_NO = '{$this->strPto_no}'";
			$request = $this->select($sql);
			if(empty($request))
			{
				$insert          = "INSERT INTO vssecuen(movtip,pto_no) VALUES(?,?)";
				$arrData         = array($this->strDoctip,$this->strPto_no);
				$request_insert  = $this->insert($insert,$arrData);
				$this->intDocnum = 1;
			}else{
				$this->intDocnum = $request['MOV_NO'] + 1;
			}

			$insert         = "UPDATE vssecuen SET mov_no = ? WHERE MOVTIP = '{$this->strDoctip}' AND PTO_NO = '{$this->strPto_no}'";
			$arrData        = array($this->intDocnum);
			$request_insert = $this->update($insert,$arrData);

			
			// RUC DE LA INSTITUCION
			$sql     = "SELECT RUC_NO FROM vsdefaul";
			$request = $this->select($sql);
			if(empty($request))
			{
				$this->strRuc_id = '';
			}else{
				$this->strRuc_id = $request['RUC_NO'];
			}

			// OBTIENE NUMERO AUTORIZACION
			$yearBilling 		= substr($this->datFecemi,0,4);
			$monthBilling 		= substr($this->datFecemi,5,2);
			$dayBilling 		= substr($this->datFecemi,8,2);
			$this->strAut_no 	= numAut($dayBilling.$monthBilling.$yearBilling.'04'.$this->strRuc_id.'2'.$this->strPto_no.$this->intDocnum.'12345678'.'1');


			// Registra CABECERA VSBILLIN NOTA DE CREDITO para SRI
			$sql 				= "SELECT * FROM vsbillin WHERE DOCTIP = '{$this->strDoctip}' AND DOCPTO = '{$this->strPto_no}' AND DOCNUM = {$this->intDocnum}";
			$request_Vsbillin 	= $this->select($sql);
			if(empty($request_Vsbillin))
			{
				$insert         = "INSERT INTO vsbillin(perios,std_no,ruc_no,razons,direcc,tlf_no,emails,doctip,docval,docpto,docnum,fecemi,aut_no,ptoapl,docapl,docsig) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData        = array($this->intPerios,$this->intStd_no,$this->strRuc_no,$this->strRazons,$this->strDirecc,$this->strTlf_no,$this->strEmails,$this->strDoctip,$this->intDocval,$this->strPto_no,$this->intDocnum,$this->datFecemi,$this->strAut_no,$this->strPtoapl,$this->intFacnum,$this->intDocsig);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
				return $return;
			}

			$sql 				= "SELECT * FROM vsbildet WHERE DOCTIP = 'FA' AND DOCPTO = '{$this->strPtoapl}' AND DOCNUM = {$this->intFacnum} ORDER BY ART_NO";
			$request_vsbildet 	= $this->select_all($sql);
			if(!empty($request_vsbildet))
			{
				$this->intAbosum = 0;
				for ($i = 0; $i < count($request_vsbildet); $i++) 
				{
					$this->strPer_no = $request_vsbildet[$i]['PER_NO'];
					$this->intArt_no = $request_vsbildet[$i]['ART_NO'];
					$this->intFacval = $request_vsbildet[$i]['FACVAL'];
					$this->intAboval = $request_vsbildet[$i]['ABOVAL'];

					$this->intAbosum = $this->intAbosum + $this->intAboval;

					if($this->intAbosum > $this->intDocval)
					{
						$this->intAbodet = $this->intAboval - ($this->intAbosum - $this->intDocval);
					}else{
						$this->intAbodet = $this->intAboval;
					}

					// Registra VSBILDET NOTA DE CREDITO
					$insert         = "INSERT INTO vsbildet(perios,std_no,per_no,art_no,ban_no,remark,docval,facval,aboval,retval,doctip,docsig,docpto,docnum,fecemi,fecche,horcob,payfor,ctenum,chenum,depnum,tar_no,tarnum,vounum,aut_no) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$arrData        = array($this->intPerios,$this->intStd_no,$this->strPer_no,$this->intArt_no,'',$this->strRemark,$request_vsbildet[$i]['DOCVAL'],$this->intFacval,$this->intAbodet,0,$this->strDoctip,$this->intDocsig,$this->strPto_no,$this->intDocnum,$this->datFecemi,$this->datFecemi,'','EFE','','','','','','',$this->strAut_no);
					$request_insert = $this->insert($insert,$arrData);

					// Registra VSTARIFF NOTA DE CREDITO
					$sql 				= "SELECT * FROM vstariff WHERE DOCTIP = '{$this->strDoctip}' AND DOCPTO = '{$this->strPto_no}' AND DOCNUM = {$this->intDocnum} AND ART_NO = {$this->intArt_no}";
					$request_vstariff 	= $this->select($sql);
					if(empty($request_vstariff))
					{
						$insert         = "INSERT INTO vstariff(perios,std_no,per_no,art_no,remark,docval,facval,aboval,doctip,docpto,docnum,ptoapl,docapl,docsig,fecemi) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
						$arrData        = array($this->intPerios,$this->intStd_no,$this->strPer_no,$this->intArt_no,$this->strRemark,$this->intDocval,$this->intDocval,$this->intDocval,$this->strDoctip,$this->strPto_no,$this->intDocnum,'',0,$this->intDocsig,$this->datFecemi);
						$request_insert = $this->insert($insert,$arrData);
					}

					// Sumariza registros por Año, Estudiante, Periodo, Articulo y actualiza VSTARIFF
					$this->intAboval = 0;
					$sql 				= "SELECT SUM(ABOVAL * DOCSIG) as ABOPRO FROM vsbildet WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}' AND ART_NO = {$this->intArt_no}";
					$request_vssumdet 	= $this->select($sql);
					if(!empty($request_vssumdet))
					{
						if($request_vssumdet['ABOPRO'] != "")
						{
						   $this->intAboval = $request_vssumdet['ABOPRO'];			
						} 
						$insert         = "UPDATE vstariff SET aboval = ? WHERE DOCTIP != 'NC' AND PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}' AND ART_NO = {$this->intArt_no}";
						$arrData        = array($this->intAboval);
						$request_insert = $this->update($insert,$arrData);
					}
				}

				// CONTABILIZACION
				$contab			= $this->vsbillincon(1,$this->strDoctip,$this->strPto_no,$this->intDocnum);
			}
			return $return;
		}
	}
