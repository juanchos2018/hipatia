 <?php

	class VsatssriModel extends Mysql
	{
        public $intSec_id;
        public $intPerios;
		public $strLogfil;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE ATS
		public function selectVsatssris()
		{
            $sql        = "SELECT * FROM vsatssri ORDER BY SEC_ID DESC";
            $request    = $this->select_all($sql);
            return $request;
        }


        // CREA UN ARCHIVO XML
        public function vsXMLCreate(string $fecdes, string $fechas)
        {
			$this->datFecdes = $fecdes;
			$this->datFechas = $fechas;
            $this->intYeaper = date('Y', strtotime($this->datFecdes));
            $this->intMonper = date('m', strtotime($this->datFecdes));
            $this->strPerios = strClean($this->intMonper) + strClean($this->intYeaper);

            // DATA EMPRESA
            $sql_vsdefaul  		= "SELECT * FROM vsdefaul";
            $request_vsdefaul   = $this->select($sql_vsdefaul);
			$this->strAmi_id 	= $request_vsdefaul['AMI_ID']; 

            $sql_ventas         = "SELECT SUM(DOCVAL) AS VENTAS
                                    FROM vsbillin
                                    WHERE FECEMI BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' AND DOCTIP = 'FA' AND DOCVAL > 0";
            $request_ventas     = $this->select($sql_ventas);
			if(empty($request_ventas))
			{
                $this->intVentas = 0;
            }else{
                $this->intVentas = $request_ventas['VENTAS'];
            }

            $sql_compras        = "SELECT v.SUSTRI,p.IDTYPE,p.IDE_NO,v.DOCAPL,v.DOCPTO,v.DOCNUM,v.DOCAUT,v.FECEMI,v.FECREG,
                                          v.BASNIV,v.BASIV0,v.BASIVA,v.MONIVA,
                                          v.CODRF1,v.MONRF1,v.PORRF1,
                                          v.CODRF2,v.MONRF2,v.PORRF2,
                                          v.CODRI1,v.MONRI1,v.PORRI1,
                                          v.CODRI2,v.MONRI2,v.PORRI2
                                    FROM vsmovcxp v
                                    INNER JOIN vsprovid p ON p.PRV_NO = v.PRV_NO
                                    WHERE v.FECREG BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' AND v.RETNUM > 0 AND v.VALORS > 0";
            $request_compras    = $this->select_all($sql_compras);
			if(empty($request_compras))
			{
                $request_ats  = 'error';
            }else{
                $request_ats  = 'ok';
                $xml          = new DomDocument('1.0','UTF-8');

                $iva          = $xml->createElement('iva');
                $iva          = $xml->appendChild($iva);
                $nodo01       = $xml->createElement('TipoIDInformante','R');
                $nodo01       = $iva->appendChild($nodo01);
                $nodo02       = $xml->createElement('IdInformante',$request_vsdefaul['RUC_NO']);
                $nodo02       = $iva->appendChild($nodo02);
                $nodo04       = $xml->createElement('razonSocial',$request_vsdefaul['RAZONS']);
                $nodo04       = $iva->appendChild($nodo04);
                $nodo05       = $xml->createElement('Anio',$this->intYeaper);
                $nodo05       = $iva->appendChild($nodo05);
                $nodo06       = $xml->createElement('Mes',$this->intMonper);
                $nodo06       = $iva->appendChild($nodo06);
                $nodo07       = $xml->createElement('numEstabRuc','001');
                $nodo07       = $iva->appendChild($nodo07);
                $nodo08       = $xml->createElement('totalVentas',$this->intVentas);
                $nodo08       = $iva->appendChild($nodo08);
                $nodo09       = $xml->createElement('codigoOperativo','IVA');
                $nodo09       = $iva->appendChild($nodo09);
                    
                $compras      = $xml->createElement('compras');
                $compras      = $iva->appendChild($compras);
        
                for($i = 0; $i < count($request_compras); $i++)
                {
                    $request_compras[$i]['FECREG'] = substr($request_compras[$i]['FECREG'],8,2).'/'.substr($request_compras[$i]['FECREG'],5,2).'/'.substr($request_compras[$i]['FECREG'],0,4);
                    $request_compras[$i]['FECEMI'] = substr($request_compras[$i]['FECEMI'],8,2).'/'.substr($request_compras[$i]['FECEMI'],5,2).'/'.substr($request_compras[$i]['FECEMI'],0,4);

                    $detail         = $xml->createElement('detalleCompras');
                    $detail         = $compras->appendChild($detail);

                    $nodo10         = $xml->createElement('codSustento',$request_compras[$i]['SUSTRI']);
                    $nodo10         = $detail->appendChild($nodo10);
                    $nodo11         = $xml->createElement('tpIdProv',$request_compras[$i]['IDTYPE']);
                    $nodo11         = $detail->appendChild($nodo11);
                    $nodo12         = $xml->createElement('idProv',$request_compras[$i]['IDE_NO']);
                    $nodo12         = $detail->appendChild($nodo12);
                    $nodo13         = $xml->createElement('tipoComprobante',$request_compras[$i]['DOCAPL']);
                    $nodo13         = $detail->appendChild($nodo13);
                    $nodo14         = $xml->createElement('fechaRegistro',$request_compras[$i]['FECREG']);
                    $nodo14         = $detail->appendChild($nodo14);
                    $nodo15         = $xml->createElement('establecimiento',substr($request_compras[$i]['DOCPTO'],0,3));
                    $nodo15         = $detail->appendChild($nodo15);
                    $nodo16         = $xml->createElement('puntoEmision',substr($request_compras[$i]['DOCPTO'],3,3));
                    $nodo16         = $detail->appendChild($nodo16);
                    $nodo17         = $xml->createElement('secuencial',$request_compras[$i]['DOCNUM']);
                    $nodo17         = $detail->appendChild($nodo17);
                    $nodo18         = $xml->createElement('fechaEmision',$request_compras[$i]['FECEMI']);
                    $nodo18         = $detail->appendChild($nodo18);
                    $nodo19         = $xml->createElement('autorizacion',$request_compras[$i]['DOCAUT']);
                    $nodo19         = $detail->appendChild($nodo19);
                    $nodo20         = $xml->createElement('baseNoGraIva',$request_compras[$i]['BASNIV']);
                    $nodo20         = $detail->appendChild($nodo20);
                    $nodo21         = $xml->createElement('baseImponible',$request_compras[$i]['BASIV0']);
                    $nodo21         = $detail->appendChild($nodo21);
                    $nodo22         = $xml->createElement('baseImpGrav',$request_compras[$i]['BASIVA']);
                    $nodo22         = $detail->appendChild($nodo22);
                    $nodo23         = $xml->createElement('baseImpExe',0.00);
                    $nodo23         = $detail->appendChild($nodo23);
                    $nodo24         = $xml->createElement('montoIce',0.00);
                    $nodo24         = $detail->appendChild($nodo24);
                    $nodo25         = $xml->createElement('montoIva',$request_compras[$i]['MONIVA']);
                    $nodo25         = $detail->appendChild($nodo25);
                    $nodo26         = $xml->createElement('valRetBien10',0.00);
                    $nodo26         = $detail->appendChild($nodo26);
                    $nodo27         = $xml->createElement('valRetServ20',0.00);
                    $nodo27         = $detail->appendChild($nodo27);
                    $nodo28         = $xml->createElement('valorRetBienes',$request_compras[$i]['MONRI1']);
                    $nodo28         = $detail->appendChild($nodo28);
                    $nodo29         = $xml->createElement('valRetServ50',0.00);
                    $nodo29         = $detail->appendChild($nodo29);
                    $nodo30         = $xml->createElement('valorRetServicios',$request_compras[$i]['MONRI2']);
                    $nodo30         = $detail->appendChild($nodo30);
                    $nodo31         = $xml->createElement('valRetServ100',0.00);
                    $nodo31         = $detail->appendChild($nodo31);
                    $nodo32         = $xml->createElement('totbasesImpReemb',0.00);
                    $nodo32         = $detail->appendChild($nodo32);

                    $pagoExterior   = $xml->createElement('pagoExterior');
                    $pagoExterior   = $detail->appendChild($pagoExterior);
                    $nodo33         = $xml->createElement('pagoLocExt','01');
                    $nodo33         = $pagoExterior->appendChild($nodo33);
                    $nodo34         = $xml->createElement('paisEfecPago','NA');
                    $nodo34         = $pagoExterior->appendChild($nodo34);
                    $nodo35         = $xml->createElement('aplicConvDobTrib','NA');
                    $nodo35         = $pagoExterior->appendChild($nodo35);
                    $nodo36         = $xml->createElement('pagExtSujRetNorLeg','NA');
                    $nodo36         = $pagoExterior->appendChild($nodo36);

                    $air            = $xml->createElement('air');
                    $air            = $detail->appendChild($air);
                    $detalleair     = $xml->createElement('detalleAir');
                    $detalleair     = $air->appendChild($detalleair);
                    $nodo37         = $xml->createElement('codRetAir',$request_compras[$i]['CODRF1']);
                    $nodo37         = $detalleair->appendChild($nodo37);
                    $nodo38         = $xml->createElement('baseImpAir',$request_compras[$i]['BASIVA']);
                    $nodo38         = $detalleair->appendChild($nodo38);
                    $nodo39         = $xml->createElement('porcentajeAir',$request_compras[$i]['PORRF1']);
                    $nodo39         = $detalleair->appendChild($nodo39);
                    $nodo40         = $xml->createElement('valRetAir',$request_compras[$i]['MONRF1']);
                    $nodo40         = $detalleair->appendChild($nodo40);
                }

                $ruta               = 'Xml/'.$this->strAmi_id.'/ATS-'.$this->intMonper.$this->intYeaper.'.xml';
                $xml->formatOutput  = true;
                $el_xml             = $xml->saveXML();
                $xml->save($ruta);
            }
            return $request_ats;
        }


		// ELIMINA UN ATS
		public function deleteVsatssri(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "DELETE FROM vsatssri WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->delete($sql);
			if($request)
			{
				$request = 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}


		// INSERTA UN ATS
		public function insertVsatssri(string $fecdes, string $fechas)
		{
            $return = "";
            $this->datFecdes = $fecdes;
            $this->datFechas = $fechas;
            $this->intYeaper = date('Y', strtotime($this->datFecdes));
            $this->intMonper = date('m', strtotime($this->datFecdes));
            $this->strPerios = strClean($this->intMonper) . strClean($this->intYeaper);

            // DATA EMPRESA
            $sql        		= "SELECT * FROM vsdefaul";
            $request_vsdefaul   = $this->select($sql);
			$this->strAmi_id 	= $request_vsdefaul['AMI_ID']; 
            $this->strLogfil    = 'Xml/'.$this->strAmi_id.'/ATS-'.$this->intMonper.$this->intYeaper.'.xml';

            $sql        = "SELECT * FROM vsatssri WHERE PERIOS = '{$this->strPerios}'";
			$request    = $this->select($sql);
			if(empty($request))
			{
    			$insert         = "INSERT INTO vsatssri(perios,fecdes,fechas,logfil) VALUES(?,?,?,?)";
	        	$arrData        = array($this->strPerios,$this->datFecdes,$this->datFechas,$this->strLogfil);
		        $request_insert = $this->insert($insert,$arrData);
		        $return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
		    return $return;
        }
	}
