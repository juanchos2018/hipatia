<?php

	// Heredamos la clase: Controllers
	class Vsacount extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(42);
		}


		public function Vsacount()
		{
			$data['page_id'] 	= 42;
			$data['page_tag'] 	= 'Plan de Cuentas';
			$data['page_name'] 	= 'plan_de_cuentas';
			$data['page_title'] = 'Plan de Cuentas';
			$this->views->getView($this,"vsacount",$data);
		}


		// OBTIENE PLAN DE CUENTAS
		public function getSelectAcount()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Cuenta Contable'.'</option>';
			$arrData = $this->model->selectVsacount();

			if(count($arrData) > 0)
			{
				for($i = 0 ; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['CTA_NO'].'">'.$arrData[$i]['CTA_NO'].' - '.$arrData[$i]['CTA_NM'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		public function getVsacounts()
		{
			$arrData = $this->model->selectVsacount();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				if($arrData[$i]['CTATIP'] == 1) 
				{
					$arrData[$i]['CTATIP'] = '<span class="badge badge-warning">Mayor</span>';
				}else{
					$arrData[$i]['CTATIP'] = '<span class="badge badge-success">Auxiliar</span>';
				}

				if($arrData[$i]['SIGNOS'] == 1) 
				{
					$arrData[$i]['SIGNOS'] = '<span class="badge badge-success">Deudora</span>';
				}else{
					$arrData[$i]['SIGNOS'] = '<span class="badge badge-danger">Acreedora</span>';
				}

				$btnEdiVsacount  		= "";
				$btnDelVsacount  		= "";

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsacount = '<button class="btn btn-info btn-sm btnEditVsacount" onClick="fntEditVsacount('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVsacount = '<button class="btn btn-danger btn-sm btnDelVsacount" onClick="fntDelVsacount('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVsacount.' '.$btnDelVsacount.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// EXTRAE UNA CUENTA CONTABLE
		public function getVsacount (int $idCta)
		{
			$intSec_id = intval(strClean($idCta));
			if($intSec_id > 0)
			{
				$arrData = $this->model->oneVsacount($intSec_id);
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


		// ELIMINA UNA CUENTA CONTABLE
		public function delVsacount()
		{
			$intSec 	= intval($_POST['idSec']);
			$request 	= $this->model->deleteVsacount($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No puede eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function setVsacount()
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$strCta_no        = strClean($_POST['txtCta_no']);
			$strCta_nm        = strClean($_POST['txtCta_nm']);
			$intCtatip        = intval($_POST['listCtatip']);
			$intSignos        = intval($_POST['listSignos']);
			$strCtasup        = strClean($_POST['listCta_no']);

			if($intSec_id == 0)
			{
				// Crea una Cuenta Contable
				$request_Vsacount = $this->model->insertVsacount($strCta_no, $strCta_nm, $intCtatip, $intSignos, $strCtasup);
				$opcion = 1;
			}else{
				$request_Vsacount = $this->model->updateVsacount($intSec_id, $strCta_no, $strCta_nm, $intCtatip, $intSignos, $strCtasup);
				$opcion = 2;
			}

			if($request_Vsacount > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Cuenta guardada con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Cuenta actualizada con éxito.');
						break;
				}
			}else if($request_Vsacount == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
