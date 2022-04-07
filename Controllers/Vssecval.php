<?php

	// Heredamos la clase: Controllers
	class Vssecval extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(31);
		}


		public function Vssecval()
		{
			$data['page_id'] 	= 31;
			$data['page_tag'] 	= 'Valores por Servicios';
			$data['page_name'] 	= 'valores';
			$data['page_title'] = 'Valores por Servicios';
			$this->views->getView($this,"vssecval",$data);
		}


		public function getDatPrice()
		{
			$intPer = $_POST['codPer'];
			$codSec = $_POST['codSec'];
			$codArt = $_POST['codArt'];
			$arrData = $this->model->getVssecPrice($intPer,$codSec,$codArt);

			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrData['codSec'] = $codSec;
				$arrData['codArt'] = $codArt;
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getSecPerios()
		{
			$codStd = $_POST['codStd'];
			$arrData = $this->model->getSecPerios($codStd);

			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrResponse = array('status' => true, 'data' => $arrData);
			}				
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getVssecvals()
		{
			$arrData = $this->model->selectVssecval();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				if($_SESSION['permisosMod']['u'])
				{
					$arrData[$i]['options'] = '<div class="text-center"><button class="btn btn-info btn-sm btnEditVssecval" onClick="fntEditVssecval('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button></div>';
				}
				$arrData[$i]['SEC_NM'] 	= $arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getVssecval(int $secID)
        {
         	$intSec_id = intval(strClean($secID));
			if($intSec_id > 0)
			{
				$arrData = $this->model->oneVssecval($intSec_id);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Valor no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
        }  


		public function setVssecval() 
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$intPerios        = intval($_POST['listPerios']);
			$intSec_no        = intval($_POST['listSec_no']);
			$intArt_no        = intval($_POST['listArt_no']);
			$intValors        = $_POST['txtValors'];
//			$intPordes        = $_POST['txtPordes'];
					
			if($intSec_id == 0)
			{
				// Crea un Valor
				$request_Vssecval = $this->model->insertVssecval($intPerios,$intSec_no,$intArt_no,$intValors);
				$opcion = 1;
			}else{
				$request_Vssecval = $this->model->updateVssecval($intSec_id,$intPerios,$intSec_no,$intArt_no,$intValors);
				$opcion = 2;
			}

			if($request_Vssecval > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Valor guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Valor actualizado con éxito.');
						break;
				}
			}else if($request_Vssecval == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Valor ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}		
	}
