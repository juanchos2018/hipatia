<?php

	// Heredamos la clase: Controllers
	class Vsclinic extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(16);
		}


		public function Vsclinic()
		{
			$data['page_id'] 	= 16;
			$data['page_tag'] 	= 'Historia Clínica';
			$data['page_name'] 	= 'historia_clinica';
			$data['page_title'] = 'Historia Clínica';
			$this->views->getView($this,"vsclinic",$data);
		}

		
		// OBTIENE UN REGISTRO
		public function getVsclinic(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsclinic($intSTD);
			
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


		public function getVsclinics()
		{
			$arrData = $this->model->selectVsclinic();	
			for ($i=0; $i < count($arrData); $i++) 
			{
				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-info btn-sm btnEditVsclinic" onClick="fntEditVsclinic('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btnDelVsclinic" onClick="fntDelVsclinic('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function setVsclinic()
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$intStd_no        = intval($_POST['listStd_no']);
			$intCas_no        = intval($_POST['listCas_no']);
			$strFecreg        = strClean($_POST['datFecreg']);
			$strFecnex        = strClean($_POST['datFecnex']);
			$strWeighs        = strClean($_POST['txtWeighs']);
			$strHeighs        = strClean($_POST['txtHeighs']);
			$strPresur        = strClean($_POST['txtPresur']);
			$strTemper        = strClean($_POST['txtTemper']);
			$strProble        = strClean($_POST['txtProble']);
			$strExplor        = strClean($_POST['txtExplor']);
			$strTratam        = strClean($_POST['txtTratam']);
			$strRemark        = strClean($_POST['txtRemark']);
			$strHiscod        = "MED";

			if($intSec_id == 0)
			{
				// Crea una Historia
				$request_Vsclinic = $this->model->insertVsclinic($intStd_no, $intCas_no, $strFecreg, $strFecnex, $strWeighs, $strHeighs, $strPresur, $strTemper, $strProble, $strExplor, $strTratam, $strRemark, $strHiscod);
				$opcion = 1;
			}else{
				$request_Vsclinic = $this->model->updateVsclinic($intSec_id, $intStd_no, $intCas_no, $strFecreg, $strFecnex, $strWeighs, $strHeighs, $strPresur, $strTemper, $strProble, $strExplor, $strTratam, $strRemark, $strHiscod);
				$opcion = 2;
			}

			if($request_Vsclinic > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Historia guardada con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Historia actualizada con éxito.');
						break;
				}
			}else if($request_Vsclinic == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Historia ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
