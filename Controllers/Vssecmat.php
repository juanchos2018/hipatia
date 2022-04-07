<?php

	// Heredamos la clase: Controllers
	class Vssecmat extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(6);
		}


		public function Vssecmat()
		{
			$data['page_id'] 	= 6;
			$data['page_tag'] 	= 'Malla Curricular';
			$data['page_name'] 	= 'malla_curricular';
			$data['page_title'] = 'Malla Curricular';
			$this->views->getView($this,"vssecmat",$data);
		}


		public function getVssecmats()
		{
			$arrData = $this->model->selectVssecmat();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				switch($arrData[$i]['REGIME'])
				{
					case 1:  // Malla
						$arrData[$i]['REGIME'] = '<span class="badge badge-success">Malla</span>';
						break;
					case 2:  // Interno
						$arrData[$i]['REGIME'] = '<span class="badge badge-warning">Interno</span>';
						break;
				}

				$btnEdiVssecmat  = "";
				$btnDelVssecmat  = "";
				$btLinkVssecmat  = "";
			
				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVssecmat = '<button class="btn btn-info btn-sm btnEditVssecmat" onClick="fntEditVssecmat('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVssecmat = '<button class="btn btn-danger btn-sm btnDelVssecmat" onClick="fntDelVssecmat('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}
				if($arrData[$i]['CLINKS'] != "")
				{
					$btLinkVssecmat = '<a class="btn btn-success btn-sm" title= "Link Clase Virtual" href="'.$arrData[$i]['CLINKS'].'" target="_blank"><i class="fas fa-wifi"></i></a>';	
				}
			
				$arrData[$i]['options'] = '<div class="text-center"> '.$btLinkVssecmat.' '.$btnEdiVssecmat.' '.$btnDelVssecmat.'</div>';
				$arrData[$i]['SEC_NM'] 	= $arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'];
				$arrData[$i]['LAS_NM'] 	= $arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// Extrae informacion de un Reparto
        public function getVssecmat(int $secID)
        {
         	$intSec_id = intval(strClean($secID));
			if($intSec_id > 0)
			{
				$arrData = $this->model->oneVssecmat($intSec_id);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Registro de Reparto no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
        }  


		public function delVssecmat()
		{
			if($_POST){
				$intSec 	= intval($_POST['idSec']);
				$request 	= $this->model->deleteVssecmat($intSec);
				if($request == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Registro.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();	
		}

		public function setVssecmat()
		{
			$intSec_id   = intval($_POST['idSec_id']);
			$intSec_no   = intval($_POST['listSec_no']);
			$intMat_no   = intval($_POST['listMat_no']);
			$intEmp_no   = intval($_POST['listEmp_no']);
			$intPerios   = intval($_POST['listPerios']);
			$strClinks   = strClean($_POST['txtClinks']);
			$intOrders   = intval($_POST['txtOrders']);
			
			if($intSec_id == 0)
			{
				// Crea un Reparto
				$request_Vssecmat = $this->model->insertVssecmat($intSec_no,$intMat_no,$intEmp_no,$intPerios,$strClinks,$intOrders);
				$opcion = 1;
			}else{
				$request_Vssecmat = $this->model->updateVssecmat($intSec_id,$intSec_no,$intMat_no,$intEmp_no,$intPerios,$strClinks,$intOrders);
				$opcion = 2;
			}

			if($request_Vssecmat > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Reparto guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Reparto actualizado con éxito.');
						break;
				}
			}else if($request_Vssecmat == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Reparto ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
