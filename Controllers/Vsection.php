<?php

	// Heredamos la clase: Controllers
	class Vsection extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(3);
		}


		public function Vsection()
		{
			$data['page_id'] 	= 3;
			$data['page_tag'] 	= 'Secciones';
			$data['page_name'] 	= 'secciones';
			$data['page_title'] = 'Secciones';
			$this->views->getView($this,"vsection",$data);
		}

		
		public function getSelectSection()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="">'.'Seleccione Sección'.'</option>';

			$arrData = $this->model->selectVsection();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['SEC_NO'].'">'.$arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		public function getSelectSectio2()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="0">'.'Seleccione Sección'.'</option>';

			$arrData = $this->model->selectVsection();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['SEC_NO'].'">'.$arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		public function getVsections()
		{
			$arrData = $this->model->selectVsection();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				switch($arrData[$i]['REGIME'])
				{
					case 1:  // Sierra
						$arrData[$i]['REGIME'] = '<span class="badge badge-success">Sierra</span>';
						break;
					case 2:  // Costa
						$arrData[$i]['REGIME'] = '<span class="badge badge-warning">Costa</span>';
						break;
				}

				switch($arrData[$i]['JOR_NO'])
				{
					case 1:  // Matutina
						$arrData[$i]['JOR_NO'] = '<span class="badge badge-success">Matutina</span>';
						break;
					case 2:  // Vespertina
						$arrData[$i]['JOR_NO'] = '<span class="badge badge-warning">Vespertina</span>';
						break;
					case 3:  // Nocturna
						$arrData[$i]['JOR_NO'] = '<span class="badge badge-danger">Nocturna</span>';
						break;
				}

				$btnEdiVsection  = "";

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsection = '<button class="btn btn-info btn-sm btnEditVsection" onClick="fntEditVsection('.$arrData[$i]['SEC_NO'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVsection.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE UN REGISTRO
		public function getVsection (int $idSec)
		{
			$intSec_no = intval(strClean($idSec));
			if($intSec_no > 0)
			{
				$arrData = $this->model->oneVsection($intSec_no);
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


		public function setVsection()
		{
			$intSec_no        = intval($_POST['idSec_no']);
			$intNiv_no        = intval($_POST['listNiv_no']);
			$strParale        = strClean($_POST['txtParale']);
			$strSec_nm        = strClean($_POST['txtSec_nm']);
			$intPabell        = intval($_POST['listPabell']);
			$intModoes        = intval($_POST['listModoes']);
			$intRegime        = intval($_POST['listRegime']);
			$intJor_no        = intval($_POST['listJor_no']);
			$intSec_n2        = intval($_POST['listSec_n2']);

			if($intSec_no == 0)
			{
				// Crea una Sección
				$request_Vsection = $this->model->insertVsection($intNiv_no, $strParale, $strSec_nm, $intPabell, $intModoes, $intRegime, $intJor_no, $intSec_n2);
				$opcion = 1;
			}else{
				$request_Vsection = $this->model->updateVsection($intSec_no, $intNiv_no, $strParale, $strSec_nm, $intPabell, $intModoes, $intRegime, $intJor_no, $intSec_n2);
				$opcion = 2;
			}

			if($request_Vsection > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Sección guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Sección actualizado con éxito.');
						break;
				}
			}else if($request_Vsection == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Sección ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
