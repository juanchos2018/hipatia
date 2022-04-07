<?php

	// Heredamos la clase: Controllers
	class Vsbillin extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(33);
		}


		public function Vsbillin()
		{
			$data['page_id'] 	= 33;
			$data['page_tag'] 	= 'Facturación';
			$data['page_name'] 	= 'facturacion';
			$data['page_title'] = 'Facturación';
			$this->views->getView($this,"vsbillin",$data);
		}


		// GESTIONA EL INFORME DIARIO DE VENTAS
		public function prnDiaVen()
		{
			$prnPerios = $_POST['listPerio2'];
			$prnDatdes = $_POST['datFecdes'];
			$prnDathas = $_POST['datFechas'];
			$prnReptyp = $_POST['listReptyp'];

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getVsdiaVen($prnPerios,$prnDatdes,$prnDathas,$prnReptyp);
				
			$data['page_tag']   		= 'Informe Diario de Ventas';
			$data['page_title'] 		= 'INFORME <small>Diario de Ventas</small>';
			$data['page_name']  		= 'Informe';
			$data['perios'] 			= $prnPerios;
			$data['reptyp'] 			= $prnReptyp;
			$data['maestro_detalle'] 	= $maestroDetalle;
			$data['datosEmpresa'] 		= $datosEmpresa;
			$this->views->getView($this,"vsdiaven",$data);
		}


		// OBTIENE DATA DE VALOR A PAGAR EN UNA FACTURA CLIENTE
		public function getDatVal()
		{
			$codPerios 	= $_POST['codPerios'];
			$codStd_no 	= $_POST['codStd_no'];
			$codPer_no 	= $_POST['codPer_no'];
			$codAbotyp 	= $_POST['codAbotyp'];
			$codOpcion 	= 1;
			$arrData 	= $this->model->getVsgetVal($codPerios,$codStd_no,$codPer_no,$codAbotyp,$codOpcion);

			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCION. No existen Valores para Facturar.');
			}else{
				$arrData['codPerios'] = $codPerios;
				$arrData['codStd_no'] = $codStd_no;
				$arrData['codPer_no'] = $codPer_no;
				$arrData['codAbotyp'] = $codAbotyp;
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getDatVal2()
		{
			$codPerios 	= $_POST['codPerios'];
			$codStd_no 	= $_POST['codStd_no'];
			$codPer_no 	= '';
			$codAbotyp 	= $_POST['codAbotyp'];
			$codOpcion 	= 2;
			$arrData 	= $this->model->getVsgetVal($codPerios,$codStd_no,$codPer_no,$codAbotyp,$codOpcion);

			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCION. No existen Valores para Facturar.');
			}else{
				$arrData['codPerios'] = $codPerios;
				$arrData['codStd_no'] = $codStd_no;
				$arrData['codPer_no'] = $codPer_no;
				$arrData['codAbotyp'] = $codAbotyp;
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		
		public function getDatFac()
		{
			$codPerios 	= $_POST['codPerios'];
			$codStd_no 	= $_POST['codStd_no'];
			$codFac_no 	= $_POST['codFac_no'];
			$arrData 	= $this->model->getDatFac($codPerios,$codStd_no,$codFac_no);

			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCION. No existen Valores para Facturar.');
			}else{
				$arrData['codFac_no'] = $codFac_no;
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getVsbillin()
		{
			$arrData = $this->model->selectVsbillin();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$arrData[$i]['DOCNUM'] 	= str_pad($arrData[$i]['DOCNUM'], 9, "0", STR_PAD_LEFT);

				$btnXmlVsbillin			= "";
				$btnPdfVsbillin 		= "";
				$color_boton_XML 		= 'class="btn btn-outline-success btn-sm"';
				$color_boton_PDF 		= 'class="btn btn-outline-danger btn-sm"';

				$btnXmlVsbillin			= '<a '.$color_boton_XML.' title="Descargar XML" href="'.$arrData[$i]['LOGFIL'].'" download="FA-'.$arrData[$i]['DOCPTO'].'-'.$arrData[$i]['DOCNUM'].'.xml"><i class="fas fa-code"></i></a>';
				$btnPdfVsbillin 		= '<a '.$color_boton_PDF.' title= "Visualizar PDF" href="'.base_url().'Vsbillin/previewPDF/'.$arrData[$i]['SEC_ID'].'"><i class="fas fa-file-pdf"></i></a>';
				$arrData[$i]['options'] = '<div class="text-center"> '.$btnXmlVsbillin.' '.$btnPdfVsbillin.' '.'</div>';

				switch($arrData[$i]['DOCTIP'])
				{
					case 'FA':
						$arrData[$i]['DOCTIP'] = '<span class="badge badge-success">Factura de Cliente</span>';
						break;
					case 'RC':
						$arrData[$i]['DOCTIP'] = '<span class="badge badge-danger">Recibo</span>';
						break;
					case 'NC':
						$arrData[$i]['DOCTIP'] = '<span class="badge badge-warning">Nota de Crédito Cliente</span>';
						break;
				}
				$arrData[$i]['DOCPTO'] 	= substr($arrData[$i]['DOCPTO'],0,3).'-'.substr($arrData[$i]['DOCPTO'],3,3);
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// FACTURA PREVIEW
		public function previewPDF(int $secID)
		{
			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->previewPDF($secID);

			$data['page_tag'] 		= 'Previsualizar Documento';
			$data['page_title'] 	= 'Previsualizar Documento';
			$data['page_name'] 		= 'Previsualizar Documento';
			$data['datosEmpresa'] 	= $datosEmpresa;
			$data['maestroDetalle'] = $maestroDetalle;
			$this->views->getView($this,"previewPDF",$data);	
		}


		// DESCARGAR XML
		public function downloadXML(int $secID)
		{
			$maestroDetalle 		= $this->model->downloadXML($secID);
			$data['page_tag'] 		= 'Descargar Documento XML';
			$data['page_title'] 	= 'Descargar Documento XML';
			$data['page_name'] 		= 'Descargar_Documento_XML';
			$data['maestroDetalle'] = $maestroDetalle;
		}


		public function setVsbillin()
		{
			$intPerios    = intval($_POST['listPerios']);
			$intStd_no    = intval($_POST['listStd_no']);
			$strPer_no    = strClean($_POST['listPer_no']);
			$strCltype    = strClean($_POST['listCltype']);
			$strRuc_no    = strClean($_POST['txtRuc_no']);
			$strRazons    = strClean($_POST['txtRazons']);
			$strDirecc    = strClean($_POST['txtDirecc']);
			$strTlf_no    = strClean($_POST['txtTlf_no']);
			$strEmails    = $_POST['txtEmails'];
			$intAbotyp    = 1;
			$strDoctip    = strClean($_POST['listDoctip']);
			$intDocval    = $_POST['txtDocval'];
			$intDocabo    = $_POST['txtDocabo'];
			$datFecemi    = strClean($_POST['datFecemi']);
			$strPayfor    = strClean($_POST['listPayfor']);
			$intDocnum    = intval($_POST['txtDocnum']);
			$strBan_no    = strClean($_POST['listBan_no']);
			$strChenum    = strClean($_POST['txtChenum']);
			$strDepnum    = strClean($_POST['txtDepnum']);
			$strTar_no    = strClean($_POST['listTar_no']);
			$strTarnum    = strClean($_POST['txtTarnum']);
			$strVounum    = strClean($_POST['txtVounum']);


			$request_Vsbillin 	= $this->model->insertVsbillin($intPerios, $intStd_no, $strPer_no, $strCltype, $strRuc_no, $strRazons, $strDirecc, $strTlf_no, $strEmails, $intAbotyp, $strDoctip, $intDocval, $intDocabo, $datFecemi, $strPayfor, $intDocnum, $strBan_no, $strChenum, $strDepnum, $strTar_no, $strTarnum, $strVounum);
			
			if($request_Vsbillin > 0)
			{
				$arrResponse = array('status' => true, 'msg' => 'Documento guardado con éxito.');
			}else if($request_Vsbillin == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCION. Documento ya existe.');
			}else if($request_Vsbillin == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCION. ABONO está Incorrecto.');
			}else if($request_Vsbillin == -3){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCION. Punto de Emisión es obligatorio.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}


		public function setVsnotcre()
		{
			$strPto_no    = strClean($_POST['txtPto_no']);
			$intFacnum    = intval($_POST['txtFacnum']);
			$intDocval    = $_POST['txtDocval'];
			$datFecemi    = strClean($_POST['datFecreg']);
//			$strCre_no    = strClean($_POST['listCre_no']);

			$request_Vsnotcre = $this->model->insertVsnotcre($strPto_no,$intFacnum,$intDocval,$datFecemi);
			
			if($request_Vsnotcre > 0){
				$arrResponse = array('status' => true, 'msg' => 'Documento guardado con éxito.');
			}else if($request_Vsnotcre == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Documento ya existe.');
			}else if($request_Vsnotcre == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCION. VALOR está Incorrecto.');
			}else if($request_Vsnotcre == -3){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCION. Punto de Emisión es obligatorio.');
			}else if($request_Vsnotcre == -4){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCION. No. Factura aplicada no existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
