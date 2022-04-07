<?php

	// Heredamos la clase: Controllers
	class Vssocial extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(15);
		}


		public function Vssocial()
		{
			$data['page_id'] 	= 15;
			$data['page_tag'] 	= 'Historia Social';
			$data['page_name'] 	= 'historia_social';
			$data['page_title'] = 'Historia Social';
			$this->views->getView($this,"vssocial",$data);
		}

		
		// Obtiene unn registro de la tabla: Vssocial
		public function getVssocial(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVssocial($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Historia no encontrada.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getVssocials()
		{
			$arrData = $this->model->selectVssocial();
			for ($i=0; $i < count($arrData); $i++) 
			{
				switch($arrData[$i]['CAS_NO'])
				{
					case 1: $arrData[$i]['CAS_NO'] = 'Acta Compromiso';
							break;
					case 2: $arrData[$i]['CAS_NO'] = 'Adaptación Curricular';
							break;
					case 3: $arrData[$i]['CAS_NO'] = 'Aprendizaje';
							break;
					case 4: $arrData[$i]['CAS_NO'] = 'Citación';
							break;
					case 5: $arrData[$i]['CAS_NO'] = 'Comportamiento';
							break;
					case 6: $arrData[$i]['CAS_NO'] = 'Derivación';
							break;
					case 7: $arrData[$i]['CAS_NO'] = 'Emotivo';
							break;
					case 8: $arrData[$i]['CAS_NO'] = 'Familiar';
							break;
					case 9: $arrData[$i]['CAS_NO'] = 'Orientación';
							break;
				}

				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-info btn-sm btnEditVssocial" onClick="fntEditVssocial('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btnDelVssocial" onClick="fntDelVssocial('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function setVssocial()
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$intStd_no        = intval($_POST['listStd_no']);
			$intCas_no        = intval($_POST['listCas_no']);
			$strFecreg        = strClean($_POST['datFecreg']);
			$strFecnex        = strClean($_POST['datFecnex']);
			$strWeighs        = "";
			$strHeighs        = "";
			$strPresur        = "";
			$strTemper        = "";
			$strProble        = strClean($_POST['txtProble']);
			$strExplor        = strClean($_POST['txtExplor']);
			$strTratam        = strClean($_POST['txtTratam']);
			$strRemark        = strClean($_POST['txtRemark']);
			$strHiscod        = "SOC";

			if($intSec_id == 0)
			{
				// Crea una Historia Social
				$request_Vssocial = $this->model->insertVssocial($intStd_no, $intCas_no, $strFecreg, $strFecnex, $strWeighs, $strHeighs, $strPresur, $strTemper, $strProble, $strExplor, $strTratam, $strRemark, $strHiscod);
				$opcion = 1;
			}else{
				$request_Vssocial = $this->model->updateVssocial($intSec_id, $intStd_no, $intCas_no, $strFecreg, $strFecnex, $strWeighs, $strHeighs, $strPresur, $strTemper, $strProble, $strExplor, $strTratam, $strRemark, $strHiscod);
				$opcion = 2;
			}

			if($request_Vssocial > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Historia Social guardada con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Historia Social actualizada con éxito.');
						break;
				}
			}else if($request_Vssocial == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Historia Social ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
