<?php

	// Heredamos la clase: Controllers
	class Vsbanker extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(38);
		}


		public function Vsbanker()
		{
			$data['page_id'] 	= 38;
			$data['page_tag'] 	= 'Ficha Entidades Financieras';
			$data['page_name'] 	= 'entidad_financiera';
			$data['page_title'] = 'Ficha Entidades Financieras';
			$this->views->getView($this,"vsbanker",$data);
		}



		public function getVsbankers()
		{
			$arrData = $this->model->selectVsbanker();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$btnEdiVsbanker  		= "";
				$btnDelVsbanker  		= "";

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsbanker = '<button class="btn btn-info btn-sm btnEditVsbanker" onClick="fntEditVsbanker('.$arrData[$i]['BAN_NO'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVsbanker = '<button class="btn btn-danger btn-sm btnDelVsbanker" onClick="fntDelVsbanker('.$arrData[$i]['BAN_NO'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVsbanker.' '.$btnDelVsbanker.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// EXTRAE UN BANCO
		public function getVsbanker(int $idBan)
		{
			$intBan_no = intval(strClean($idBan));
			if($intBan_no > 0)
			{
				$arrData = $this->model->oneVsbanker($intBan_no);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		// ELIMINA UN BANCO
		public function delVsbanker()
		{
			$intSec 	= intval($_POST['idSec']);
			$request 	= $this->model->deleteVsbanker($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No puede eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function setVsbanker()
		{
			$intBan_no        = intval($_POST['idBan_no']);
			$strBan_nm        = strClean($_POST['txtBan_nm']);
			$strCtanum        = strClean($_POST['txtCtanum']);
			$intChe_no        = intval($_POST['txtChe_no']);
			$intUltccl        = intval($_POST['txtUltccl']);
			$strCta_no        = strClean($_POST['listCta_no']);

			if($intBan_no == 0)
			{
				// Crea un Banco
				$request_Vsbanker = $this->model->insertVsbanker($strBan_nm, $strCtanum, $intChe_no, $intUltccl, $strCta_no);
				$opcion = 1;
			}else{
				$request_Vsbanker = $this->model->updateVsbanker($intBan_no, $strBan_nm, $strCtanum, $intChe_no, $intUltccl, $strCta_no);
				$opcion = 2;
			}

			if($request_Vsbanker > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Entidad Financiera guardada con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Entidad Financiera actualizada con éxito.');
						break;
				}
			}else if($request_Vsbanker == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Banco ya existe.');
			}else if($request_Vsbanker == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta Contable asignada debe ser AUXILIAR.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
