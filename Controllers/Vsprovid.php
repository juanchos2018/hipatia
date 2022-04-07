<?php

	// Heredamos la clase: Controllers
	class Vsprovid extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(40);
		}


		public function Vsprovid()
		{
			$data['page_id'] 	= 40;
			$data['page_tag'] 	= 'Ficha Proveedores';
			$data['page_name'] 	= 'proveedores';
			$data['page_title'] = 'Ficha Proveedores';
			$this->views->getView($this,"vsprovid",$data);
		}


		public function getSelectProvid()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Proveedor'.'</option>';
			
			$arrData = $this->model->selectVsprovid();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['PRV_NO'].'">'.$arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'].' - '.$arrData[$i]['IDE_NO'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		public function getVsprovids()
		{
			$arrData = $this->model->selectVsprovid();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				if($arrData[$i]['ESTATU'] == 1) 
				{
					$arrData[$i]['ESTATU'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				switch($arrData[$i]['IDTYPE'])
				{
					case "01":
						$arrData[$i]['IDTYPE'] = '<span class="badge badge-warning">R.U.C.</span>';
						break;
					case "02":
						$arrData[$i]['IDTYPE'] = '<span class="badge badge-success">Cédula</span>';
						break;
					case "03":
						$arrData[$i]['IDTYPE'] = '<span class="badge badge-danger">Pasaporte</span>';
						break;
				}

				$btnEdiVsprovid  		= "";
				$btnDelVsprovid  		= "";

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsprovid = '<button class="btn btn-info btn-sm btnEditVsprovid" onClick="fntEditVsprovid('.$arrData[$i]['PRV_NO'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVsprovid = '<button class="btn btn-danger btn-sm btnDelVsprovid" onClick="fntDelVsprovid('.$arrData[$i]['PRV_NO'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVsprovid.' '.$btnDelVsprovid.'</div>';
			}			
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getVsprovid(int $idPrv)
		{
			$idPrv_no = intval(strClean($idPrv));
			if($idPrv_no > 0)
			{
				$arrData = $this->model->oneVsprovid($idPrv_no);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Proveedor no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		// ELIMINA UN PROVEEDOR
		public function delVsprovid()
		{
			$intSec 	= intval($_POST['idSec']);
			$request 	= $this->model->deleteVsprovid($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No puede eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function setVsprovid()
		{
			$intPrv_no        = intval($_POST['idPrv_no']);
			$strLas_nm        = strClean($_POST['txtLas_nm']);
			$strFir_nm        = strClean($_POST['txtFir_nm']);
			$strAddres        = strClean($_POST['txtAddres']);
			$strTphone        = strClean($_POST['txtTphone']);
			$strIdtype        = strClean($_POST['listIdtype']);
			$strIde_no        = strClean($_POST['txtIde_no']);
			$strEmails        = $_POST['txtEmails'];
			$strBenefi        = strClean($_POST['txtBenefi']);
			$intAut_no        = intval($_POST['txtAut_no']);
			$datFecaut        = strClean($_POST['datFecaut']);
			$strAnt_no        = strClean($_POST['listAnt_no']);
			$strCta_no        = strClean($_POST['listCta_no']);
			$strGas_no        = ''; //strClean($_POST['listGas_no']);
			$intEstatu        = intval($_POST['listStatus']);

			if($intPrv_no == 0)
			{
				// Crea un Proveedor
				$request_Vsprovid = $this->model->insertVsprovid($strLas_nm, $strFir_nm, $strAddres, $strTphone, $strIdtype, $strIde_no, $strEmails, $strBenefi, $intAut_no, $datFecaut, $strAnt_no, $strCta_no, $strGas_no, $intEstatu);
				$opcion = 1;
			}else{
				$request_Vsprovid = $this->model->updateVsprovid($intPrv_no, $strLas_nm, $strFir_nm, $strAddres, $strTphone, $strIdtype, $strIde_no, $strEmails, $strBenefi, $intAut_no, $datFecaut, $strAnt_no, $strCta_no, $strGas_no, $intEstatu);
				$opcion = 2;
			}

			if($request_Vsprovid > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Proveedor guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Proveedor actualizado con éxito.');
						break;
				}
			}else if($request_Vsprovid == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Proveedor ya existe.');
			}else if($request_Vsprovid == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta Contable asignada debe ser AUXILIAR.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
