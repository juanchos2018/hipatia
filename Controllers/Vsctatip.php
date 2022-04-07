<?php

	// Heredamos la clase: Controllers
	class Vsctatip extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(43);
		}


		public function Vsctatip()
		{
			$data['page_id'] 	= 43;
			$data['page_tag'] 	= 'Parámetros Contables';
			$data['page_name'] 	= 'parametro_contable';
			$data['page_title'] = 'Parámetros Contables';
			$this->views->getView($this,"vsctatip",$data);
		}


		public function getVsctatips()
		{
			$arrData = $this->model->selectVsctatips();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				// SWITCH de Opciones:
				switch($arrData[$i]['CTAMOV'])
				{
					case 1:
						$arrData[$i]['CTAMOV'] = '<span class="badge badge-success">Deudor</span>';
						break;
					case -1:
						$arrData[$i]['CTAMOV'] = '<span class="badge badge-danger">Acreedor</span>';
						break;
					case 3:
						$arrData[$i]['CTAMOV'] = '<span class="badge badge-warning">Ambos</span>';
						break;
				}

				$btnEdiVsctatip  	= "";
				$btnDelVsctatip  	= "";
				$color_boton_task	= 'class="btn btn-info btn-sm btnEditVsctatip"';

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsctatip = '<button '.$color_boton_task.' onClick="fntEditVsctatip('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVsctatip = '<button class="btn btn-danger btn-sm btnDelVsctatip" onClick="fntDelVsctatip('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVsctatip.' '.$btnDelVsctatip.'</div>';
				$arrData[$i]['CTADEB'] 	= $this->model->selectVsctatip($arrData[$i]['CTADEB']);
				$arrData[$i]['CTACRE'] 	= $this->model->selectVsctatip($arrData[$i]['CTACRE']);
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getVsctatip(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsctatip($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Parámetro no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function delVsctatip()
		{
			$intSec 	= intval($_POST['idSec']);
			$request 	= $this->model->deleteVsctatip($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function setVsctatip()
		{
            $intSec_id   = intval($_POST['idSec_id']);
			$strTab_no   = strClean($_POST['listTab_no']);
			$strCtadeb   = strClean($_POST['listAnt_no']);
			$strCtacre   = strClean($_POST['listCta_no']);
			$strValors   = strClean($_POST['listValors']);
			$strEntity   = strClean($_POST['listEntity']);
            $intCtafil   = intval($_POST['listCtafil']);
            $intCtamov   = intval($_POST['listCtamov']);
            $intFactor   = $_POST['txtFactor'];

			if($intSec_id == 0)
			{
				// Crea un Parámetro
				$request_Vsctatip = $this->model->insertVsctatip($strTab_no, $strCtadeb, $strCtacre, $strValors, $strEntity, $intCtafil, $intCtamov, $intFactor);
				$opcion = 1;
			}else{
				$request_Vsctatip = $this->model->updateVsctatip($intSec_id, $strTab_no, $strCtadeb, $strCtacre, $strValors, $strEntity, $intCtafil, $intCtamov, $intFactor);
				$opcion = 2;
			}

			if($request_Vsctatip > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Parámetro guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Parámetro actualizado con éxito.');
						break;
				}
			}else if($request_Vsctatip == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Parámetro ya existe.');
			}else if($request_Vsctatip == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta asignada debe ser AUXILIAR.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Información escogida para almacenar no es coincidente.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
