<?php

	// Heredamos la clase: Controllers
	class Vsrolrub extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(34);
		}


		public function Vsrolrub()
		{
			$data['page_id'] 	= 34;
			$data['page_tag'] 	= 'Rubros Nómina';
			$data['page_name'] 	= 'rubros';
			$data['page_title'] = 'Rubros Nómina';
			$this->views->getView($this,"vsrolrub",$data);
		}


		// Obtiene la lista de Rubros de Nomina
		public function getSelectRolrub()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Rubro'.'</option>';

			$arrData = $this->model->selectVsrolrub();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['RUB_NO'].'">'.$arrData[$i]['RUB_NM'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		// Obtiene la lista de Rubros de Nomina para Creditos Personales
		public function getSelectRolcre()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Rubro'.'</option>';

			$arrData = $this->model->selectVsrolcre();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['RUB_NO'].'">'.$arrData[$i]['RUB_NM'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		public function getVsrolrubs()
		{
			$arrData = $this->model->selectVsrolrub();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				if($arrData[$i]['RUBTIP'] == 1) 
				{
					$arrData[$i]['RUBTIP'] = '<span class="badge badge-success">Ingreso</span>';
				}else{
					$arrData[$i]['RUBTIP'] = '<span class="badge badge-danger">Descuento</span>';
				}

                if($arrData[$i]['ESTATU'] == 1) 
				{
					$arrData[$i]['ESTATU'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-info btn-sm btnEditVsrolrub" onClick="fntEditVsrolrub('.$arrData[$i]['RUB_NO'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// Extrae la informacion
		public function getVsrolrub (int $idRub)
		{
			$intRub_no = intval(strClean($idRub));
			if($intRub_no > 0)
			{
				$arrData = $this->model->oneVsrolrub($intRub_no);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else {
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function setVsrolrub()
		{
			$intRub_no        = intval($_POST['idRub_no']);
			$strRub_nm        = strClean($_POST['txtRub_nm']);
			$intRubtip        = intval($_POST['listRubtip']);
			$intEncera        = intval($_POST['listEncera']);
			$intHidens        = intval($_POST['listHidens']);
			$intRubcre        = intval($_POST['listPercre']);
			$intAporte        = intval($_POST['listAporte']);
			$strFormul        = trim($_POST['txtFormul']);
			$intEstatu        = intval($_POST['listStatus']);

			if($intRub_no == 0)
			{
				// Crea un Rubro
				$request_Vsrolrub = $this->model->insertVsrolrub($strRub_nm, $intRubtip, $intEncera, $intHidens, $intRubcre, $intAporte, $strFormul, $intEstatu);
				$opcion = 1;
			}else{
				$request_Vsrolrub = $this->model->updateVsrolrub($intRub_no, $strRub_nm, $intRubtip, $intEncera, $intHidens, $intRubcre, $intAporte, $strFormul, $intEstatu);
				$opcion = 2;
			}

			if($request_Vsrolrub > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Rubro guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Rubro actualizado con éxito.');
						break;
				}
			}else if($request_Vsrolrub == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Rubro ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
