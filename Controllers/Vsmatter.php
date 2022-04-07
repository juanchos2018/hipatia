<?php

	// Heredamos la clase: Controllers
	class Vsmatter extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(4);
		}


		public function Vsmatter()
		{
			$data['page_id'] 	= 4;
			$data['page_tag'] 	= 'Asignaturas';
			$data['page_name'] 	= 'asignaturas';
			$data['page_title'] = 'Asignaturas';
			$this->views->getView($this,"vsmatter",$data);
		}


		public function getSelectMatter()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Asignatura'.'</option>';
			
			$arrData = $this->model->selectVsmatter();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					switch($arrData[$i]['REGIME'])
					{
						case 1:  // Malla
							$arrData[$i]['REGIME'] = 'Malla';
							break;
						case 2:  // Interno
							$arrData[$i]['REGIME'] = 'Interno';
							break;
					}

					$rol = $_SESSION['userData']['rol_id'];
					if($rol == 5)
					{
						$htmlOptions .= '<option value="'.$arrData[$i]['MAT_NO'].'">'.$arrData[$i]['MAT_NM'].' - '.$arrData[$i]['REGIME'].' - '.$arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'].'</option>';
					}else{
						$htmlOptions .= '<option value="'.$arrData[$i]['MAT_NO'].'">'.$arrData[$i]['MAT_NM'].' - '.$arrData[$i]['REGIME'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}


		public function getSelectMatte2()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="0" selected>'.'Seleccione Asignatura'.'</option>';
			
			$arrData = $this->model->selectVsmatter();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					switch($arrData[$i]['REGIME'])
					{
						case 1:  // Malla
							$arrData[$i]['REGIME'] = 'Malla';
							break;
						case 2:  // Interno
							$arrData[$i]['REGIME'] = 'Interno';
							break;
					}

					$rol = $_SESSION['userData']['rol_id'];
					if($rol == 5)
					{
						$htmlOptions .= '<option value="'.$arrData[$i]['MAT_NO'].'">'.$arrData[$i]['MAT_NM'].' - '.$arrData[$i]['REGIME'].' - '.$arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'].'</option>';
					}else{
						$htmlOptions .= '<option value="'.$arrData[$i]['MAT_NO'].'">'.$arrData[$i]['MAT_NM'].' - '.$arrData[$i]['REGIME'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}


		// OBTIENE UN REGISTRO
		public function getVsmatter(int $idMAT)
		{
			$idMAT_no = intval(strClean($idMAT));
			if($idMAT_no > 0)
			{
				$arrData = $this->model->oneVsmatter($idMAT_no);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Asignatura no encontrada.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		// ELIMINA UNA ASIGNATURA
		public function delVsmatter()
		{
			$intSec 	= intval($_POST['idSec']);
			$request 	= $this->model->deleteVsmatter($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No puede eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function getVsmatters()
		{
			$arrData = $this->model->selectVsmatter();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				switch($arrData[$i]['REGIME'])
				{
					case 1:  // Malla
						$arrData[$i]['REGIME'] = '<span class="badge badge-success">Malla</span>';
						break;
					case 2:  // Interno
						$arrData[$i]['REGIME'] = '<span class="badge badge-danger">Interno</span>';
						break;
				}

				switch($arrData[$i]['CALIFI'])
				{
					case 1:  // Cuantitativa
						$arrData[$i]['CALIFI'] = '<span class="badge badge-success">Cuantitativa</span>';
						break;
					case 2:  // Cualitativa
						$arrData[$i]['CALIFI'] = '<span class="badge badge-danger">Cualitativa</span>';
						break;
				}

				$btnEdiVsmatter  = "";
				$btnDelVsmatter  = "";

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsmatter = '<button class="btn btn-info btn-sm btnEditVsmatter" onClick="fntEditVsmatter('.$arrData[$i]['MAT_NO'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVsmatter = '<button class="btn btn-danger btn-sm btnDelVsmatter" onClick="fntDelVsmatter('.$arrData[$i]['MAT_NO'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVsmatter.' '.$btnDelVsmatter.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function setVsmatter()
		{
			$intMat_no        = intval($_POST['idMat_no']);
			$strMat_nm        = strClean($_POST['txtMat_nm']);
			$intRegime        = intval($_POST['listRegime']);
			$intCalifi        = intval($_POST['listCalifi']);
			$intPromed        = intval($_POST['listPromed']);
			$strEbooks        = strClean($_POST['txtEbooks']);
			$intCuan01        = intval($_POST['intCuan01']);
			$intCuan02        = intval($_POST['intCuan02']);
			$intCuan03        = intval($_POST['intCuan03']);
			$intCuan04        = intval($_POST['intCuan04']);
			$intCuan05        = intval($_POST['intCuan05']);
			$intCuan06        = intval($_POST['intCuan06']);
			$intCuan07        = intval($_POST['intCuan07']);
			$intCuan08        = intval($_POST['intCuan08']);
			$intCuan09        = intval($_POST['intCuan09']);
			$intCuan10        = intval($_POST['intCuan10']);
			$strCual01        = strClean($_POST['txtCual01']);
			$strCual02        = strClean($_POST['txtCual02']);
			$strCual03        = strClean($_POST['txtCual03']);
			$strCual04        = strClean($_POST['txtCual04']);
			$strCual05        = strClean($_POST['txtCual05']);
			$strCual06        = strClean($_POST['txtCual06']);
			$strCual07        = strClean($_POST['txtCual07']);
			$strCual08        = strClean($_POST['txtCual08']);
			$strCual09        = strClean($_POST['txtCual09']);
			$strCual10        = strClean($_POST['txtCual10']);
			$intGru_no        = intval($_POST['listMat_n2']);

			if($intMat_no == 0)
			{
				// Crea una Asignatura
				$request_Vsmatter = $this->model->insertVsmatter($strMat_nm, $intRegime, $intCalifi, $intPromed, $strEbooks, $intCuan01, $intCuan02, $intCuan03, $intCuan04, $intCuan05, $intCuan06, $intCuan07, $intCuan08, $intCuan09, $intCuan10, $strCual01, $strCual02, $strCual03, $strCual04, $strCual05, $strCual06, $strCual07, $strCual08, $strCual09, $strCual10, $intGru_no);
				$opcion = 1;
			}else{
				$request_Vsmatter = $this->model->updateVsmatter($intMat_no, $strMat_nm, $intRegime, $intCalifi, $intPromed, $strEbooks, $intCuan01, $intCuan02, $intCuan03, $intCuan04, $intCuan05, $intCuan06, $intCuan07, $intCuan08, $intCuan09, $intCuan10, $strCual01, $strCual02, $strCual03, $strCual04, $strCual05, $strCual06, $strCual07, $strCual08, $strCual09, $strCual10, $intGru_no);
				$opcion = 2;
			}

			if($request_Vsmatter > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Asignatura guardada con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Asignatura actualizada con éxito.');
						break;
				}
			}else if($request_Vsmatter == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Asignatura ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
