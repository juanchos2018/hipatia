<?php

	// Heredamos la clase: Controllers
	class Vsempcre extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(36);
		}


		public function Vsempcre()
		{
			$data['page_id'] 	= 36;
			$data['page_tag'] 	= 'Créditos Personales';
			$data['page_name'] 	= 'credito_personal';
			$data['page_title'] = 'Créditos Personales';
			$this->views->getView($this,"vsempcre",$data);
		}


		public function getVsempcres()
		{
			$arrData = $this->model->selectVsempcre();		
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-info btn-sm btnEditVsempcre" onClick="fntEditVsempcre('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
			   	</div>';  

				$arrData[$i]['MOV_NO'] 	= str_pad($arrData[$i]['MOV_NO'], 9, "0", STR_PAD_LEFT);
				$arrData[$i]['LAS_NM'] 	= $arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'];
				$arrData[$i]['PERDES']	= substr($arrData[$i]['PERDES'],0,4).'-'.substr($arrData[$i]['PERDES'],4,2);
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		

		public function getVsempcre(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsempcre($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Crédito no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function setVsempcre()
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$datFecreg        = strClean($_POST['datFecreg']);
			$strHorreg        = strClean($_POST['txtHorreg']);
			$intEmp_no        = intval($_POST['listEmp_no']);
			$intRub_no        = intval($_POST['listRubcre']);
			$strRemark        = strClean($_POST['txtRemark']);
			$intValors        = $_POST['txtValors'];
			$intPlazos        = intval($_POST['txtPlazos']);
			$intCuotas        = $_POST['txtCuotas'];
			$intForpag        = intval($_POST['listForpag']);
			$strMondes        = strClean($_POST['listMondes']);
			$intPerios        = intval($_POST['listPerios']);
			$intBan_no        = intval($_POST['listBan_n2']);
            $intChe_no        = intval($_POST['txtChe_no']);

			if($intSec_id == 0)
			{
				// Crea un Crédito
				$request_Vsempcre = $this->model->insertVsempcre($datFecreg, $strHorreg, $intEmp_no, $intRub_no, $strRemark, $intValors, $intPlazos, $intForpag, $strMondes, $intPerios, $intBan_no, $intChe_no);
				$opcion = 1;
			}else{
				$request_Vsempcre = $this->model->updateVsempcre($intSec_id, $datFecreg, $strHorreg, $intEmp_no, $intRub_no, $strRemark, $intValors, $intPlazos, $intCuotas, $intForpag, $strMondes, $intPerios, $intBan_no, $intChe_no);
				$opcion = 2;
			}

			if($request_Vsempcre > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Crédito guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Crédito actualizado con éxito.');
						break;
				}
			}else if($request_Vsempcre == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Crédito ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Información escogida para almacenar no es coincidente.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
