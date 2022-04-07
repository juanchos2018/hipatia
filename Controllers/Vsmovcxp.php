<?php

	// Hereda la clase: Controllers
	class Vsmovcxp extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(41);
		}


		public function Vsmovcxp()
		{
			$data['page_id'] 	= 41;
			$data['page_tag'] 	= 'Compras';
			$data['page_name'] 	= 'compras';
			$data['page_title'] = 'Compras';
			$this->views->getView($this,"vsmovcxp",$data);
		}


		// OBTIENE DATA DE UN PROVEEDOR
		public function getDatPrv()
		{
			$codPrv_no = $_POST['codPrv_no'];
			$arrData = $this->model->getDatPrv($codPrv_no);

			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrData['codPrv_no'] = $codPrv_no;
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE DATA DE UN BANCO
		public function getDatBan()
		{
			$codBan_no 	= $_POST['codBan_no'];
			$arrData 	= $this->model->getDatBan($codBan_no);

			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrData['codBan_no'] = $codBan_no;
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE DATA DE UNA PROVISION EN UNA NOTA DE CREDITO
		public function getDatCrp()
		{
			$codDocapl 	= $_POST['codDocapl'];
			$codDocnum 	= $_POST['codDocnum'];
			$arrData 	= $this->model->getDatCrp($codDocapl,$codDocnum);

			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrData['codDocnum'] = $codDocnum;
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE FACTURAS PENDIENTES DE UN PROVEEDOR
		public function getDatPen()
		{
			$codAdvanc 	= $_POST['codAdvanc'];
			$codPrv_no 	= $_POST['codPrv_no'];
			$arrData 	= $this->model->getDatPen($codAdvanc,$codPrv_no);
			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrData['acount'] = '';
				$arrData['acount'] .= '<option value="'.$arrData['cta_no']['CTA_NO'].'">'.$arrData['cta_no']['CTA_NM'].'</option>';

				$arrData['saldo'] = '';
				if(count($arrData['saldos']) > 0)
				{
					for($i = 0; $i < count($arrData['saldos']); $i++)
					{
						if($arrData['saldos'][$i]['SALDO'] > 0)
						{
							$arrData['saldo'] .= '<option value="'.$arrData['saldos'][$i]['MOVNUM'].'"> '.$arrData['saldos'][$i]['MOVAPL'].'-'.str_pad($arrData['saldos'][$i]['MOVNUM'], 9, "0", STR_PAD_LEFT).' = '.$arrData['saldos'][$i]['SALDO'].'</option>';
						}
					}
				}
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		// SUMA VALORES DE FACTURAS PENDIENTES DE UN PROVEEDOR
		public function getDatVal()
		{
			$codPrv_no 	= $_POST['listPrv_n3'];
			$codFap_no 	= $_POST['listFap_no'];
			$arrData 	= $this->model->getDatVal($codPrv_no,$codFap_no);

			if($arrData == 0)
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE DATA DE RETENCIONES EN UNA COMPRA
		public function getDatRet()
		{
			$codRetf1 	= $_POST['codRetf1'];
			$codRetf2 	= $_POST['codRetf2'];
			$codReti1 	= $_POST['codReti1'];
			$codReti2 	= $_POST['codReti2'];
			$arrData 	= $this->model->getDatRet($codRetf1,$codRetf2,$codReti1,$codReti2);

			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrData['codRetf1'] = $codRetf1;
				$arrData['codRetf2'] = $codRetf2;
				$arrData['codReti1'] = $codReti1;
				$arrData['codReti2'] = $codReti2;
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		// GESTIONA INFORME CUENTAS POR PAGAR
		public function prnRepCxp()
		{
			$prnPrv_no = $_POST['listPrv_n4'];
			if($_POST['listPrv_n4'] == '')
			{
				$prnPrv_no = intval($_POST['listPrv_n4']);
			}
			$prnReptyp = $_POST['listReptyp'];
			$prnAbotyp = $_POST['listAbotyp'];
			$prnFecdes = $_POST['datFecdes'];
			$prnFechas = $_POST['datFechas'];

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getVsPrnCxp($prnPrv_no,$prnReptyp,$prnAbotyp,$prnFecdes,$prnFechas);

			$data['page_tag']   	= 'Informe Cuenta por Pagar';
			$data['page_title'] 	= 'INFORME <small>Cuenta por Pagar</small>';
			$data['page_name']  	= 'Informe';
			$data['reptyp'] 		= $prnReptyp;
			$data['datosEmpresa'] 	= $datosEmpresa;
			$data['maestroDetalle'] = $maestroDetalle;
			$data['fechaDesde'] 	= $prnFecdes;
			$data['fechaHasta'] 	= $prnFechas;
			$this->views->getView($this,"vsrepcxp",$data);
		}


		// OBTIENE UN REGISTRO DE CUENTA POR PAGAR
		public function getVsmovcxp(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsmovcxp($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Diario no encontrado.');
				}else{
					$arrData['HTMLOptions'] = '';
					$arrData['HTMLOptions'] .= '<option value="'.$arrData['MOVNUM'].'" selected>'.$arrData['MOVAPL'].'-'.str_pad($arrData['MOVNUM'], 9, "0", STR_PAD_LEFT).' = '.$arrData['VALORS'].'</option>';
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		// OBTIENE DATA DE CUENTAS POR PAGAR
		public function getVsmovcxps()
		{
			$arrData = $this->model->selectVsmovcxp();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$btnXmlVsmovcxp  	= "";
				$btnPrnVsmovcxp  	= "";
				$btnEdiVsmovcxp  	= "";
				$btnDelVsmovcxp  	= "";
				$color_boton     	= 'class="btn btn-success btn-sm"';
				$color_boton_XML 	= 'class="btn btn-outline-success btn-sm"';
				$color_boton_task	= 'class="btn btn-info btn-sm btnEditVsmovcxp"';

				switch($arrData[$i]['REVERS'])
				{
					case 0:
						$arrData[$i]['REVERS'] = '<span class="badge badge-primary">Activo</span>';
						break;
					case 1:
						$arrData[$i]['REVERS'] = '<span class="badge badge-danger">Anulado</span>';
						break;
				}

				if($_SESSION['permisosMod']['r'])
				{
					$btnPrnVsmovcxp = '<a '.$color_boton.' title= "Imprimir Comprobante" href="'.base_url().'Vstudent/getActStd/'.$arrData[$i]['SEC_ID'].'"><i class="fas fa-print"></i></a>';
				}

				switch($arrData[$i]['MOVTIP'])
				{
					case 'CP':
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovcxp = '<button '.$color_boton_task.' onClick="fntEditVsmovcrp('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
						if($_SESSION['permisosMod']['d'])
						{
							$btnDelVsmovcxp = '<button class="btn btn-danger btn-sm btnDelVsmovcxp" onClick="fntDelVsmovcxp('.$arrData[$i]['SEC_ID'].')" title="Anular"><i class="fas fa-trash-alt"></i></button>';
						}
						break;

					case 'DP':
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovcxp = '<button '.$color_boton_task.' onClick="fntEditVsmovcrp('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
						if($_SESSION['permisosMod']['d'])
						{
							$btnDelVsmovcxp = '<button class="btn btn-danger btn-sm btnDelVsmovcxp" onClick="fntDelVsmovcxp('.$arrData[$i]['SEC_ID'].')" title="Anular"><i class="fas fa-trash-alt"></i></button>';
						}
						break;

					case 'PC':
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovcxp = '<button '.$color_boton_task.' onClick="fntEditVsmovpay('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
						break;

					case 'PD':
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovcxp = '<button '.$color_boton_task.' onClick="fntEditVsmovpay('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
						break;

					case 'PF':
						$btnXmlVsmovcxp		= '<a '.$color_boton_XML.' title="Descargar XML" href="'.$arrData[$i]['LOGFIL'].'" download="RF-'.$arrData[$i]['RETPTO'].'-'.$arrData[$i]['RETNUM'].'.xml"><i class="fas fa-code"></i></a>';
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovcxp = '<button '.$color_boton_task.' onClick="fntEditVsmovcxp('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
						if($_SESSION['permisosMod']['d'])
						{
							$btnDelVsmovcxp = '<button class="btn btn-danger btn-sm btnDelVsmovcxp" onClick="fntDelVsmovcxp('.$arrData[$i]['SEC_ID'].')" title="Anular"><i class="fas fa-trash-alt"></i></button>';
						}
						break;
	
					default:
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovcxp = '<button '.$color_boton_task.' onClick="fntEditVsmovcxp('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
						if($_SESSION['permisosMod']['d'])
						{
							$btnDelVsmovcxp = '<button class="btn btn-danger btn-sm btnDelVsmovcxp" onClick="fntDelVsmovcxp('.$arrData[$i]['SEC_ID'].')" title="Anular"><i class="fas fa-trash-alt"></i></button>';
						}
						break;
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnXmlVsmovcxp.' '.$btnPrnVsmovcxp.' '.$btnEdiVsmovcxp.' '.$btnDelVsmovcxp.'</div>';
				$arrData[$i]['MOV_NO'] 	= str_pad($arrData[$i]['MOV_NO'], 9, "0", STR_PAD_LEFT);

				if($arrData[$i]['MOVNUM'] > 0)
				{
					$arrData[$i]['MOVNUM'] 	= $arrData[$i]['MOVAPL'].'-'.str_pad($arrData[$i]['MOVNUM'], 9, "0", STR_PAD_LEFT);
				}

				if($arrData[$i]['RETNUM'] > 0)
				{
					$arrData[$i]['RETNUM'] 	= str_pad($arrData[$i]['RETNUM'], 9, "0", STR_PAD_LEFT);
				}else{
					$arrData[$i]['RETNUM'] 	= '';
				}
				$arrData[$i]['LAS_NM'] 	= $arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'];
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// ANULA REGISTRO CUENTAS POR PAGAR
		public function delVsmovcxp()
		{
			$intSec 	= intval($_POST['idSec']);
			$request 	= $this->model->deleteVsmovcxp($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha anulado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al anular el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		// PROVISION DE FACTURA PROVEEDOR
		public function setVsmovcxp()
		{
            $intSec_id   = intval($_POST['idSec_id']);
			$strMovtip   = strClean($_POST['listMovtip']);
            $intMov_no   = intval($_POST['txtMov_no']);
			$strSustri   = strClean($_POST['txtSustri']);
            $intPrv_no   = intval($_POST['listPrv_no']);
            $strCta_no   = strClean($_POST['listCta_no']);
            $strGas_no   = strClean($_POST['listAnt_no']);
			$strDocapl   = strClean($_POST['listDocapl']);
			$strDocpto   = strClean($_POST['txtDocpto']);
			$intDocnum   = intval($_POST['txtDocnum']);
			$strDocaut   = strClean($_POST['txtDocaut']);
			$strRemark   = strClean($_POST['txtRemark']);
			$datFecreg   = strClean($_POST['datFecreg']);
			$datFecemi   = strClean($_POST['datFecemi']);
			$intBasiva   = $_POST['txtBasiva'];
			$intMoniva   = $_POST['txtMoniva'];
			$intBasiv0   = $_POST['txtBasiv0'];
			$intBasniv   = $_POST['txtBasniv'];
			$strReb_no   = strClean($_POST['listReb_no']);
			$strRes_no   = strClean($_POST['listRes_no']);
			$strRib_no   = strClean($_POST['listRib_no']);
			$strRis_no   = strClean($_POST['listRis_no']);
			$intMonrf1   = $_POST['txtMonrf1'];
			$intMonrf2   = $_POST['txtMonrf2'];
			$intMonri1   = $_POST['txtMonri1'];
			$intMonri2   = $_POST['txtMonri2'];
			$strRetpto   = strClean($_POST['txtRetpto']);
			$intRetnum   = intval($_POST['txtRetnum']);
			$strRetaut   = strClean($_POST['txtRetaut']);
			$intValdes   = $_POST['txtValdes'];
			$intValors   = $_POST['txtValors'];

			if($intSec_id == 0)
			{
				// Crea un Diario
				$request_Vsmovcxp = $this->model->insertVsmovcxp($strMovtip, $intMov_no, $strSustri, $intPrv_no, $strCta_no, $strGas_no, $strDocapl, $strDocpto, $intDocnum, $strDocaut, $strRemark, $datFecreg, $datFecemi, $intBasiva, $intMoniva, $intBasiv0, $intBasniv, $strReb_no, $strRes_no, $strRib_no, $strRis_no, $intMonrf1, $intMonrf2, $intMonri1, $intMonri2, $strRetpto, $intRetnum, $strRetaut, $intValdes, $intValors);
				$opcion = 1;
			}else{
				$request_Vsmovcxp = $this->model->updateVsmovcxp($intSec_id, $strMovtip, $intMov_no, $strSustri, $intPrv_no, $strCta_no, $strGas_no, $strDocapl, $strDocpto, $intDocnum, $strDocaut, $strRemark, $datFecreg, $datFecemi, $intBasiva, $intMoniva, $intBasiv0, $intBasniv, $strReb_no, $strRes_no, $strRib_no, $strRis_no, $intMonrf1, $intMonrf2, $intMonri1, $intMonri2, $strRetpto, $intRetnum, $strRetaut, $intValdes, $intValors);
				$opcion = 2;
			}

			if($request_Vsmovcxp > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Diario guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Diario actualizado con éxito.');
						break;
				}
			}else if($request_Vsmovcxp == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Diario ya existe.');
			}else if($request_Vsmovcxp == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. FECHA EMISION no puede ser mayor a FECHA CONTABLE.');
			}else if($request_Vsmovcxp == -3){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. No puede actualizar un Diario ANULADO.');
			}else if($request_Vsmovcxp == -4){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Retención Bienes no puede ser igual a Retención Servicios.');
			}else if($request_Vsmovcxp == -5){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta asignada debe ser AUXILIAR.');
			}else if($request_Vsmovcxp == -6){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Documento aplicado ya existe.');
			}else if($request_Vsmovcxp == -7){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Punto de Emisión es requerido.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Información escogida para almacenar no es coincidente.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}


		// NOTA DE CREDITO / DEBITO PROVEEDOR
		public function setVsmovcrp()
		{
            $intSec_id    = intval($_POST['idSec_i2']);
			$strMovtip    = strClean($_POST['listMovti2']);
            $intMov_no    = intval($_POST['txtMov_n2']);
            $intPrv_no    = intval($_POST['listPrv_n2']);
			$strDocapl    = strClean($_POST['listMovapl']);
			$intDocnum    = intval($_POST['txtFap_no']);
			$intValors    = $_POST['txtDocva2'];
			$datFecreg    = strClean($_POST['datFecre2']);
			$strRemark    = strClean($_POST['txtRemar2']);
			$strGas_no    = strClean($_POST['listCdp_no']);

			if($intSec_id == 0)
			{
				// Crea un Crédito Proveedor
				$request_Vsmovcrp = $this->model->insertVsmovcrp($strMovtip, $intMov_no, $intPrv_no, $strDocapl, $intDocnum, $strRemark, $datFecreg, $intValors, $strGas_no);
				$opcion = 1;
			}else{
				$request_Vsmovcrp = $this->model->updateVsmovcrp($intSec_id, $strMovtip, $intMov_no, $intPrv_no, $strDocapl, $intDocnum, $strRemark, $datFecreg, $intValors, $strGas_no);
				$opcion = 2;
			}
			
			if($request_Vsmovcrp > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Documento guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Documento actualizado con éxito.');
						break;
				}
			}else if($request_Vsmovcrp == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Documento ya existe.');
			}else if($request_Vsmovcrp == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. No. Documento Aplicado no existe o el Valor está incorrecto.');
			}else if($request_Vsmovcrp == -3){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta asignada debe ser AUXILIAR.');
			}else if($request_Vsmovcrp == -4){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Tipo Documento Aplicado es Incorrecto.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}


		// PAGO PROVEEDOR
		public function setVsmovpay()
		{
            $intSec_id    = intval($_POST['idSec_i3']);
			$strMovtip    = strClean($_POST['listMovti3']);
            $intMov_no    = intval($_POST['txtMov_n3']);
			$strMovapl    = 'PF';
			$intMovnum    = $_POST['listFap_no'];
            $intFap_no    = intval($_POST['txtFap_no']);
            $intPrv_no    = intval($_POST['listPrv_n3']);
			$strBenefi    = strClean($_POST['txtBenefi']);
            $intBan_no    = intval($_POST['listBan_n2']);
            $intChe_no    = intval($_POST['txtChe_no']);
			$strRemark    = strClean($_POST['txtRemar3']);
			$intValors    = $_POST['txtDocva3'];
			$datFecreg    = strClean($_POST['datFecre3']);
			$strAdvanc    = strClean($_POST['listAdvanc']);
			$strCta_no    = strClean($_POST['listGas_no']);

			if($intSec_id == 0)
			{
				// Crea un Pago
				$request_Vsmovpay = $this->model->insertVsmovpay($strMovtip, $intMov_no, $strMovapl, $intMovnum, $intPrv_no, $strBenefi, $intBan_no, $intChe_no, $strRemark, $intValors, $datFecreg, $strAdvanc, $strCta_no);
				$opcion = 1;
			}else{
				$request_Vsmovpay = $this->model->updateVsmovpay($intSec_id, $strMovtip, $intMov_no, $strMovapl, $intMovnum, $intFap_no, $intPrv_no, $strBenefi, $intBan_no, $intChe_no, $strRemark, $intValors, $datFecreg, $strAdvanc, $strCta_no);
				$opcion = 2;
			}
			
			if($request_Vsmovpay > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Documento guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Documento actualizado con éxito.');
						break;
				}
			}else if($request_Vsmovpay == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Documento ya existe.');
			}else if($request_Vsmovpay == -2){
				$arrResponse = array('status' => false, 'msg' => 'VALOR está Incorrecto.');
			}else if($request_Vsmovpay == -3){
				$arrResponse = array('status' => false, 'msg' => 'No. Provisión aplicada no existe.');
			}else if($request_Vsmovpay == -4){
				$arrResponse = array('status' => false, 'msg' => 'Valor del Pago es incorrecto.');
			}else if($request_Vsmovpay == -5){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta asignada debe ser AUXILIAR.');
			}else if($request_Vsmovpay == -6){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Valor del Pago es mayor que saldo de Factura.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
