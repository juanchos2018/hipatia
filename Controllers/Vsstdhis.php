<?php

	// Heredamos la clase: Controllers
	class Vsstdhis extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
		}

		public function Vsstdhis()
		{
			// Se incluye el arreglo DATA, que tiene informacion de la pagina ...
			$data['page_id'] 	= 9;
			$data['page_tag'] 	= 'Registro';
			$data['page_name'] 	= 'registro';
			$data['page_title'] = 'Registro';
			$this->views->getView($this,"vsstdhis",$data);
		}


		// OBTIENE UN REGISTRO
		public function getVsstdhis(int $secId) 
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsstdhis($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Registro no encontrado.');
				}else {
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getVsstdhiss()
		{
			$arrData = $this->model->selectVsstdhis();
		
			// Se barre todo el array $arrData ..
			for ($i=0; $i < count($arrData); $i++) 
			{
				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-info btn-sm btnEditVsstdhis" onClick="fntEditVsstdhis('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		
		public function setVsstdhis()
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$intPerios        = intval($_POST['listPerios']);
			$strFecreg        = strClean($_POST['datFecreg']);
			$intStd_no        = intval($_POST['listStd_no']);
			$intRetain        = $_POST['txtRetain'];

			if($intSec_id == 0)
			{
				// Crea un Registro
				$request_Vsstdhis = $this->model->insertVsstdhis($intPerios, $strFecreg, $intStd_no, $intRetain);
				$opcion = 1;
			}else{
				$request_Vsstdhis = $this->model->updateVsstdhis($intSec_id, $intPerios, $strFecreg, $intStd_no, $intRetain);
				$opcion = 2;
			}

			if($request_Vsstdhis > 0)
			{
				switch($opcion){
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Registro guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Registro actualizado con éxito.');
						break;
				}
			}else if($request_Vsstdhis == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Registro ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
