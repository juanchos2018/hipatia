<?php

	// Heredamos la clase: Controllers
	class Vssecuen extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(17);
		}


		public function Vssecuen()
		{
			$data['page_id'] 	= 17;
			$data['page_tag'] 	= 'Parámetros Financieros';
			$data['page_name'] 	= 'parametros_financieros';
			$data['page_title'] = 'Parámetros Financieros';
			$this->views->getView($this,"vssecuen",$data);
		}


        // EXTRAE SECUENCIALES
		public function getVssecuens()
		{
			$arrData = $this->model->selectVssecuen();
			for ($i = 0; $i < count($arrData); $i++) 
			{			
				$btnEdiVssecuen  = "";

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVssecuen = '<button class="btn btn-info btn-sm btnEditVssecuen" onClick="fntEditVssecuen('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVssecuen.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// EXTRAE UN SECUENCIAL
		public function getVssecuen(int $idSec)
		{
			$intSec_no = intval(strClean($idSec));
			if($intSec_no > 0)
			{
				$arrData = $this->model->oneVssecuen($intSec_no);
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


		// SECUENCIALES
		public function setVssecuen()
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$strMovtip		  = strClean($_POST['listTab_no']);
			$strPto_no		  = strClean($_POST['txtPto_no']);
			$intMov_no		  = intval($_POST['txtMov_no']);
			$intPar_no		  = $_POST['txtPar_no'];

			if($intSec_id == 0)
			{
				// Crea un Secuencial
				$request_Vssecuen = $this->model->insertVssecuen($strMovtip, $strPto_no, $intMov_no, $intPar_no);
				$opcion = 1;
			}else{
				$request_Vssecuen = $this->model->updateVssecuen($intSec_id, $strMovtip, $strPto_no, $intMov_no, $intPar_no);
				$opcion = 2;
			}

			if($request_Vssecuen > 0)
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
			}else if($request_Vssecuen == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Parámetro ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
