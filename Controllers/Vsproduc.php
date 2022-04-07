<?php

	// Heredamos la clase: Controllers
	class Vsproduc extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(30);
		}


		public function Vsproduc()
		{
			$data['page_id'] 	= 30;
			$data['page_tag'] 	= 'Portafolio de Servicios';
			$data['page_name'] 	= 'portafolio';
			$data['page_title'] = 'Portafolio de Servicios';
			$this->views->getView($this,"vsproduc",$data);
		}


		// Obtiene la Lista de Articulos
		public function getSelectProduc()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Artículo'.'</option>';
			$arrData = $this->model->selectVsproduc(); 	

			if(count($arrData) > 0)
			{
				for($i = 0 ; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['ART_NO'].'">'.$arrData[$i]['ART_NM'].'</option>';
				}
			}
			echo $htmlOptions;
			exit;
			die();
		}


		public function getVsproducs()
		{
			$arrData = $this->model->selectVsproduc();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				// SWITCH de Opciones:
				$opcion = $arrData[$i]['ESTADO'];
				switch($opcion)
				{
					case 1:  // 
						$arrData[$i]['ESTADO'] = '<span class="badge badge-success">Activo</span>';
						break;
					case 0:  // 
						$arrData[$i]['ESTADO'] = '<span class="badge badge-warning">Inactivo</span>';
						break;
				}

				$btnEdiVsproduc  = "";

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsproduc = '<button class="btn btn-info btn-sm btnEditVsproduc" onClick="fntEditVsproduc('.$arrData[$i]['ART_NO'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVsproduc.'</div>';					
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// Extrae la informacion de un Artículo
		public function getVsproduc(int $idArt)
		{
			$intArt_no = intval(strClean($idArt));
			if($intArt_no > 0)
			{
				$arrData = $this->model->oneVsproduc($intArt_no);
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

		
		public function setVsproduc()
		{
			$intArt_no        = intval($_POST['idArt_no']);
			$strArt_nm        = strClean($_POST['txtArt_nm']);
			$intEstado        = intval($_POST['listEstado']);
			$intTip_no        = intval($_POST['listTip_no']);
			$intDesiva        = intval($_POST['listDesiva']);
			$intPropay        = intval($_POST['listPropay']);
			$intPer000        = strClean($_POST['listPer000']);
			$intPer001        = strClean($_POST['listPer001']);
			$intPer002        = strClean($_POST['listPer002']);
			$intPer003        = strClean($_POST['listPer003']);
			$intPer004        = strClean($_POST['listPer004']);
			$intPer005        = strClean($_POST['listPer005']);
			$intPer006        = strClean($_POST['listPer006']);
			$intPer007        = strClean($_POST['listPer007']);
			$intPer008        = strClean($_POST['listPer008']);
			$intPer009        = strClean($_POST['listPer009']);
			$intPer010        = strClean($_POST['listPer010']);
			$intPer011        = strClean($_POST['listPer011']);
			$intPer012        = strClean($_POST['listPer012']);
			$intPer013        = strClean($_POST['listPer013']);
            $strCta_no        = strClean($_POST['listCta_no']);

  
			if($intArt_no == 0)
			{
				// Crea un Artículo
				$request_Vsproduc = $this->model->insertVsproduc($strArt_nm, $intEstado, $intTip_no, $intDesiva, $intPropay, $intPer000, $intPer001, $intPer002, $intPer003, $intPer004, $intPer005, $intPer006, $intPer007, $intPer008, $intPer009, $intPer010, $intPer011, $intPer012, $intPer013, $strCta_no);
				$opcion = 1;
			}else{
				$request_Vsproduc = $this->model->updateVsproduc($intArt_no, $strArt_nm, $intEstado, $intTip_no, $intDesiva, $intPropay, $intPer000, $intPer001, $intPer002, $intPer003, $intPer004, $intPer005, $intPer006, $intPer007, $intPer008, $intPer009, $intPer010, $intPer011, $intPer012, $intPer013, $strCta_no);
				$opcion = 2;
			}

			if($request_Vsproduc > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Artículo guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Artículo actualizado con éxito.');
						break;
				}
			}else if($request_Vsproduc == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Artículo ya existe.');
			}else if($request_Vsproduc == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta asignada debe ser AUXILIAR.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
