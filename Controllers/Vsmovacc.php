<?php

	// Heredamos la clase: Controllers
	class Vsmovacc extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(44);
		}


		public function Vsmovacc()
		{
			$data['page_id'] 	= 44;
			$data['page_tag'] 	= 'Diarios Contables';
			$data['page_name'] 	= 'diario';
			$data['page_title'] = 'Diarios Contables';
			$this->views->getView($this,"vsmovacc",$data);
		}


		// GESTIONA INFORME BALANCES CONTABLES
		public function prnRepAcc()
		{
			$prnCta_no = $_POST['listAnt_no'];
			if($_POST['listAnt_no'] == '')
			{
				$prnCta_no = intval($_POST['listAnt_no']);
			}
			$prnReptyp = $_POST['listReptyp'];
			$prnAbotyp = $_POST['listAbotyp'];
			$prnFecdes = $_POST['datFecdes'];
			$prnFechas = $_POST['datFechas'];

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getVsPrnAcc($prnCta_no,$prnReptyp,$prnAbotyp,$prnFecdes,$prnFechas);

			$data['page_tag']   	= 'Informes Contables';
			$data['page_title'] 	= 'INFORME <small>Contabilidad</small>';
			$data['page_name']  	= 'Informe';
			$data['reptyp'] 		= $prnReptyp;
			$data['datosEmpresa'] 	= $datosEmpresa;
			$data['maestroDetalle'] = $maestroDetalle;
			$data['fechaDesde']		= $prnFecdes;
        	$data['fechaHasta']		= $prnFechas;
			$this->views->getView($this,"vsrepacc",$data);
		}


		// OBTIENE DATA DE DIARIOS CONTABLES
		public function getVsmovaccs()
		{
			$arrData = $this->model->selectVsmovacc();		
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$btnPrnVsmovacc  	= "";
				$btnEdiVsmovacc  	= "";
				$btnDelVsmovacc  	= "";
				$color_boton     	= 'class="btn btn-success btn-sm"';
				$color_boton_task	= 'class="btn btn-info btn-sm btnEditVsmovcxp"';

				switch($arrData[$i]['MOVTIP'])
				{
					case 'CD':
						if($_SESSION['permisosMod']['r'])
						{
							$btnPrnVsmovacc = '<a '.$color_boton.' title= "Imprimir Comprobante" href="'.base_url().'Vstudent/getActStd/'.$arrData[$i]['SEC_ID'].'"><i class="fas fa-print"></i></a>';
						}
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovacc = '<button '.$color_boton_task.' onClick="fntEditVsmovacc('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
						if($_SESSION['permisosMod']['d'])
						{
							$btnDelVsmovacc = '<button class="btn btn-danger btn-sm btnDelVsmovcxp" onClick="fntDelVsmovacc('.$arrData[$i]['SEC_ID'].')" title="Anular"><i class="fas fa-trash-alt"></i></button>';
						}

					default:
						if($_SESSION['permisosMod']['r'])
						{
							$btnPrnVsmovacc = '<a '.$color_boton.' title= "Imprimir Comprobante" href="'.base_url().'Vstudent/getActStd/'.$arrData[$i]['SEC_ID'].'"><i class="fas fa-print"></i></a>';
						}
						if($_SESSION['permisosMod']['u'])
						{
							$btnEdiVsmovacc = '<button '.$color_boton_task.' onClick="fntEditVsmovacc('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
						}
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnPrnVsmovacc.' '.$btnEdiVsmovacc.' '.$btnDelVsmovacc.'</div>';

				if(empty($arrData[$i]['MOVPTO']))
				{
					$arrData[$i]['MOV_NO'] 	= str_pad($arrData[$i]['MOV_NO'], 9, "0", STR_PAD_LEFT);
				}else{
					$arrData[$i]['MOVPTO'] 	= substr($arrData[$i]['MOVPTO'],0,3) .'-'.substr($arrData[$i]['MOVPTO'],3,3);
					$arrData[$i]['MOV_NO'] 	= $arrData[$i]['MOVPTO'].' '.str_pad($arrData[$i]['MOV_NO'], 9, "0", STR_PAD_LEFT);
				}
				$arrData[$i]['CTA_NO'] 	= $arrData[$i]['CTA_NO'].' - '.$arrData[$i]['CTA_NM'];
				if($arrData[$i]['SIGNOS'] == 1)
				{
					$arrData[$i]['DEB_NO'] 	= $arrData[$i]['VALORS'];
					$arrData[$i]['HAB_NO'] 	= 0;
				}else{
					$arrData[$i]['DEB_NO'] 	= 0;
					$arrData[$i]['HAB_NO'] 	= $arrData[$i]['VALORS'];
				}

				switch($arrData[$i]['SIGNOS'])
				{
					case 1:
						$arrData[$i]['SIGNOS'] = '<span class="badge badge-success">Deudor</span>';
						break;
					case -1:
						$arrData[$i]['SIGNOS'] = '<span class="badge badge-danger">Acreedor</span>';
						break;
				}
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE UN DIARIO CONTABLE
		public function getVsmovacc(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsmovacc($intSTD);
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


		// ELIMINAR DIARIO
		public function delVsmovacc()
		{
			if($_POST)
			{
				$intSec = intval($_POST['idSec']);
				$request = $this->model->deleteVsmovacc($intSec);
				if($request == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Diario.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Diario.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();	
		}


		public function setVsmovacc()
		{
            $intSec_id        = intval($_POST['idSec_id']);
			$strMovtip        = strClean($_POST['listTab_no']);
			$strMovpto        = strClean($_POST['txtMovpto']);
            $intMov_no        = intval($_POST['txtMov_no']);
			$strCta_no        = strClean($_POST['listCta_no']);
			$intDocval        = intval($_POST['txtValors']);
			$datFecreg        = strClean($_POST['datFecreg']);
			$strRemark        = strClean($_POST['txtRemark']);

			if($intSec_id == 0)
			{
				// Crea un Diario
				$request_Vsmovacc = $this->model->insertVsmovacc($strMovtip, $strMovpto, $intMov_no, $strCta_no, $intDocval, $datFecreg, $strRemark);
				$opcion = 1;
			}else{
				$request_Vsmovacc = $this->model->updateVsmovacc($intSec_id, $strMovtip, $strMovpto, $intMov_no, $strCta_no, $intDocval, $datFecreg, $strRemark);
				$opcion = 2;
			}

			if($request_Vsmovacc > 0)
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
			}else if($request_Vsmovacc == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Diario ya existe.');
			}else if($request_Vsmovacc == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Tipo de Diario solo es automático.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Información escogida para almacenar no es coincidente.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
