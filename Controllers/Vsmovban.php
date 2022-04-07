<?php

	// Heredamos la clase: Controllers
	class Vsmovban extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(39);
		}


		public function Vsmovban()
		{
			$data['page_id'] 	= 39;
			$data['page_tag'] 	= 'Libro Banco';
			$data['page_name'] 	= 'libro_banco';
			$data['page_title'] = 'Libro Banco';
			$this->views->getView($this,"vsmovban",$data);
		}


		// OBTIENE DATA TRANSACCIONES BANCARIAS
		public function getVsmovbans()
		{
			$arrData = $this->model->selectVsmovban();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$btnPrnVsmovban  	= "";
				$btnEdiVsmovban  	= "";
				$btnDelVsmovban  	= "";
				$color_boton     	= 'class="btn btn-success btn-sm"';
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

				switch($arrData[$i]['MOVTIP'])
				{
					case 'TR':
						if($_SESSION['permisosMod']['r'])
						{
							$btnPrnVsmovban = '<a '.$color_boton.' title= "Imprimir Comprobante" href="'.base_url().'Vsmovban/prnMovBan/'.$arrData[$i]['SEC_ID'].'"><i class="fas fa-print"></i></a>';
						}
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovban = '<button '.$color_boton_task.' onClick="fntEditVsmovtrf('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
						break;
					default:
						if($_SESSION['permisosMod']['r'])
						{
							$btnPrnVsmovban = '<a '.$color_boton.' title= "Imprimir Comprobante" href="'.base_url().'Vsmovban/prnMovBan/'.$arrData[$i]['SEC_ID'].'"><i class="fas fa-print"></i></a>';
						}
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovban = '<button '.$color_boton_task.' onClick="fntEditVsmovban('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
						break;
				}

				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVsmovban = '<button class="btn btn-danger btn-sm btnDelVsmovban" onClick="fntDelVsmovban('.$arrData[$i]['SEC_ID'].')" title="Anular"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnPrnVsmovban.' '.$btnEdiVsmovban.' '.$btnDelVsmovban.'</div>';
				$arrData[$i]['MOV_NO'] 	= str_pad($arrData[$i]['MOV_NO'], 9, "0", STR_PAD_LEFT);
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// GESTIONA INFORME BANCARIO
		public function prnRepBan()
		{
			$prnBan_no = $_POST['listBan_n5'];
			if($_POST['listBan_n5'] == '')
			{
				$prnBan_no = intval($_POST['listBan_n5']);
			}
			$prnReptyp = $_POST['listReptyp'];
			$prnAbotyp = $_POST['listAbotyp'];
			$prnFecdes = $_POST['datFecdes'];
			$prnFechas = $_POST['datFechas'];

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getVsPrnBan($prnBan_no,$prnReptyp,$prnAbotyp,$prnFecdes,$prnFechas);

			$data['page_tag']   	= 'Informe Bancos';
			$data['page_title'] 	= 'INFORME <small>Bancos</small>';
			$data['page_name']  	= 'Informe';
			$data['reptyp'] 		= $prnReptyp;
			$data['datosEmpresa'] 	= $datosEmpresa;
			$data['maestroDetalle'] = $maestroDetalle;
			$data['fechaDesde']		= $prnFecdes;
            $data['fechaHasta']		= $prnFechas;
			$this->views->getView($this,"vsrepban",$data);
		}

		// IMPRIME TRANSACCION BANCARIA
		public function prnMovBan(int $secID)
		{	
			$datosEmpresa  	= datos_empresa();
			$maestroDetalle = $this->model->prnMovBan($secID);

			$data['page_tag'] 		= 'Transacción Bancaria';
			$data['page_title'] 	= 'Transacción <small>Bancaria</small>';
			$data['page_name'] 		= 'transaccion';
			$data['maestro_detalle'] = $maestroDetalle;
			$this->views->getView($this,"vsmvbprn",$data);	
		}


		public function getVsmovban(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsmovban($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Diario no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		// ANULA TRANSACCION BANCARIA
		public function delVsmovban()
		{
			if($_POST)
			{
				$intSec = intval($_POST['idSec']);
				$request = $this->model->deleteVsmovban($intSec);
				if($request == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha anulado el Registro.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al anular el Registro.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();	
		}


		// TRANSACCIONES BANCARIAS
		public function setVsmovban()
		{
            $intSec_id        = intval($_POST['idSec_id']);
			$strMovtip        = strClean($_POST['listMovtip']);
            $intMov_no        = intval($_POST['txtMov_no']);
            $intBan_no        = intval($_POST['listBan_n2']);
            $intDep_no        = intval($_POST['txtDep_no']);
            $intChe_no        = intval($_POST['txtChe_no']);
			$strRemark        = strClean($_POST['txtRemark']);
			$strCta_no        = strClean($_POST['listCta_no']);
			$datFecreg        = strClean($_POST['datFecreg']);
			$intValors        = $_POST['txtValors'];

			if($intSec_id == 0)
			{
				// Crea un Diario
				$request_Vsmovban = $this->model->insertVsmovban($strMovtip, $intMov_no, $intBan_no, $intDep_no, $intChe_no, $strRemark, $strCta_no, $datFecreg, $intValors);
				$opcion = 1;
			}else{
				$request_Vsmovban = $this->model->updateVsmovban($intSec_id, $strMovtip, $intMov_no, $intBan_no, $intDep_no, $intChe_no, $strRemark, $strCta_no, $datFecreg, $intValors);
				$opcion = 2;
			}

			if($request_Vsmovban > 0)
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
			}else if($request_Vsmovban == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Diario ya existe.');
			}else if($request_Vsmovban == -3){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. No puede actualizar un Diario ANULADO.');
			}else if($request_Vsmovban == -4){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta Contable es incorrecta.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Información escogida para almacenar no es coincidente.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}


		// TRANSFERENCIAS BANCARIAS
		public function setVsmovtrf()
		{
            $intSec_id        = intval($_POST['idSec_i2']);
			$strMovtip        = strClean($_POST['listMovtip']);
            $intMov_no        = intval($_POST['txtMov_n2']);
            $intBan_n3        = intval($_POST['listBan_n3']);
            $intBan_n4        = intval($_POST['listBan_n4']);
			$strRemark        = strClean($_POST['txtRemar2']);
			$datFecreg        = strClean($_POST['datFecre2']);
			$intValors        = $_POST['txtDocval'];

			if($intSec_id == 0)
			{
				// Crea un Diario
				$request_Vsmovtrf = $this->model->insertVsmovtrf($strMovtip, $intMov_no, $intBan_n3, $intBan_n4, $strRemark, $datFecreg, $intValors);
				$opcion = 1;
			}else{
				$request_Vsmovtrf = $this->model->updateVsmovtrf($intSec_id, $strMovtip, $intMov_no, $intBan_n3, $intBan_n4, $strRemark, $datFecreg, $intValors);
				$opcion = 2;
			}

			if($request_Vsmovtrf > 0)
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
			}else if($request_Vsmovtrf == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Diario ya existe.');
			}else if($request_Vsmovtrf == -3){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. No puede actualizar un Diario ANULADO.');
			}else if($request_Vsmovtrf == -4){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Entidades Financieras deben ser distintas.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Información escogida para almacenar no es coincidente.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
