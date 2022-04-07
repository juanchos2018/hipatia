<?php

	// Heredamos la clase: Controllers
	class Vsnewstd extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(2);
		}


		public function Vsnewstd()
		{
			$data['page_id'] 	= 2;
			$data['page_tag'] 	= 'Ficha Aspirantes';
			$data['page_name'] 	= 'ficha_aspirantes';
			$data['page_title'] = 'Ficha Aspirantes';
			$this->views->getView($this,"vsnewstd",$data);
		}


		public function getVsnewstds()
		{
			$arrData = $this->model->selectVsnewstd();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-warning btn-sm btnQueryVsnewstd" onClick="fntQueryVsnewstd('.$arrData[$i]['STD_NO'].')" title="Consultar"><i class="fas fa-eye"></i></button>
				<button class="btn btn-info btn-sm btnEditVsnewstd" onClick="fntEditVsnewstd('.$arrData[$i]['STD_NO'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// Obtiene un Estudiante especifico
		public function getVsnewstd(int $idSTD)
		{
			$intSTD = intval(strClean($idSTD));
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsnewstd($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Aspirante no encontrado.');
				}else {
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		// Funcion para llenar combo de estudiantes
		public function getComboSnewstd()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Aspirante'.'</option>';

			$arrData = $this->model->selectVsnewstd();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['STD_NO'].'">'.$arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		public function setVsnewstd()
		{
			$intStd_no 		  = intval($_POST['idStd_no']);
			$strLas_nm        = strClean($_POST['txtLas_nm']);
			$strFir_nm        = strClean($_POST['txtFir_nm']);
			$strIdtype        = strClean($_POST['listIdtype']);
			$strIde_no        = strClean($_POST['txtIde_no']);
			$strAddres        = strClean($_POST['txtAddres']);
			$strTphone        = strClean($_POST['txtTphone']);
			$intStdgen        = intval($_POST['listStdgen']);
			$datFecbir        = strClean($_POST['datFecbir']);
			$strStdmai        = $_POST['txtStdmai'];
			$intTt_who        = intval($_POST['listTt_who']);
			$strFatlas        = strClean($_POST['txtFatlas']);
			$strFatnam        = strClean($_POST['txtFatnam']);
			$strFatadr        = strClean($_POST['txtFatadr']);
			$strFatfon        = strClean($_POST['txtFatfon']);
			$strFatype        = strClean($_POST['listFatype']);
			$strFatced        = strClean($_POST['txtFatced']);
			$strFatjob        = strClean($_POST['txtFatjob']);
			$datFatbir        = strClean($_POST['datFatbir']);
			$strFatmai        = $_POST['txtFatmai'];
			$strMotlas        = strClean($_POST['txtMotlas']);
			$strMotnam        = strClean($_POST['txtMotnam']);
			$strMotadr        = strClean($_POST['txtMotadr']);
			$strMotfon        = strClean($_POST['txtMotfon']);
			$strMotype        = strClean($_POST['listMotype']);
			$strMotced        = strClean($_POST['txtMotced']);
			$strMotjob        = strClean($_POST['txtMotjob']);
			$datMotbir        = strClean($_POST['datMotbir']);
			$strMotmai        = $_POST['txtMotmai'];
			$strReplas        = strClean($_POST['txtReplas']);
			$strRepnam        = strClean($_POST['txtRepnam']);
			$strRepadr        = strClean($_POST['txtRepadr']);
			$strRepfon        = strClean($_POST['txtRepfon']);
			$strRetype        = strClean($_POST['listRetype']);
			$strRepced        = strClean($_POST['txtRepced']);
			$strRepjob        = strClean($_POST['txtRepjob']);
			$datRepbir        = strClean($_POST['datRepbir']);
			$strRepmai        = $_POST['txtRepmai'];
			$strLassch        = strClean($_POST['txtLassch']);
			$intSec_no        = intval($_POST['listSec_no']);
			$intPerios        = intval($_POST['listPerios']);
			$intReceiv        = intval($_POST['listReceiv']);

			if($intStd_no == 0)
			{
				// Crea un Aspirante
				$request_Vsnewstd = $this->model->insertVsnewstd($strLas_nm, $strFir_nm, $strAddres, $strTphone, $strIdtype, $strIde_no, $intStdgen, $datFecbir, $strStdmai, $intTt_who, $strFatlas, $strFatnam, $strFatadr, $strFatfon, $strFatype, $strFatced, $strFatjob, $datFatbir, $strFatmai, $strMotlas, $strMotnam, $strMotadr, $strMotfon, $strMotype, $strMotced, $strMotjob, $datMotbir, $strMotmai, $strReplas, $strRepnam, $strRepadr, $strRepfon, $strRetype, $strRepced, $strRepjob, $datRepbir, $strRepmai, $strLassch, $intSec_no, $intPerios, $intReceiv);
				$opcion = 1;
			}else {
				$request_Vsnewstd = $this->model->updateVsnewstd($intStd_no,$strLas_nm, $strFir_nm, $strAddres, $strTphone, $strIdtype, $strIde_no, $intStdgen, $datFecbir, $strStdmai, $intTt_who, $strFatlas, $strFatnam, $strFatadr, $strFatfon, $strFatype, $strFatced, $strFatjob, $datFatbir, $strFatmai, $strMotlas, $strMotnam, $strMotadr, $strMotfon, $strMotype, $strMotced, $strMotjob, $datMotbir, $strMotmai, $strReplas, $strRepnam, $strRepadr, $strRepfon, $strRetype, $strRepced, $strRepjob, $datRepbir, $strRepmai, $strLassch, $intSec_no, $intPerios, $intReceiv);
				$opcion = 2;
			}
		
			if($request_Vsnewstd > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Aspirante guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Aspirante actualizado con éxito.');
						break;
				}
			}else if($request_Vsnewstd == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Aspirante ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
