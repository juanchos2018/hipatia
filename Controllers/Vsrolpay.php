<?php

	// Heredamos la clase: Controllers
	class Vsrolpay extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(37);
		}


		public function Vsrolpay()
		{
			$data['page_id'] 	= 37;
			$data['page_tag'] 	= 'Rol de Pago';
			$data['page_name'] 	= 'rol_de_pago';
			$data['page_title'] = 'Rol de Pago';
			$this->views->getView($this,"vsrolpay",$data);
		}


		// GESTIONA INFORME ROLES DE PAGO
		public function prnRolPay()
		{
			$prnEmp_no = $_POST['listEmp_n2'];
			if($_POST['listEmp_n2'] == '')
			{
				$prnEmp_no = intval($_POST['listEmp_n2']);
			}
			$prnReptyp = $_POST['listReptyp'];
			$prnMondes = $_POST['listMondes'];
			$prnPerios = $_POST['listPerio2'];
			$prnQuince = 2; //$_POST['listQuince'];

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getVsPrnRol($prnEmp_no,$prnReptyp,$prnMondes,$prnPerios,$prnQuince);

			$data['page_tag']   	= 'Informe Rol de Pago';
			$data['page_title'] 	= 'INFORME <small>Rol de Pago</small>';
			$data['page_name']  	= 'Informe';
			$data['reptyp'] 		= $prnReptyp;
			$data['datosEmpresa'] 	= $datosEmpresa;
			$data['maestroDetalle'] = $maestroDetalle;
			$data['mondes'] 		= $prnMondes;
			$data['perios'] 		= $prnPerios;
			$data['quinces'] 		= $prnQuince;
			$this->views->getView($this,"vsrolrep",$data);
		}


		public function getVsrolpays()
		{
			$arrData = $this->model->selectVsrolpay();	
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$btnEdiVsrolpay  	= "";

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsrolpay = '<button class="btn btn-info btn-sm btnEditVsrolpay" onClick="fntEditVsrolpay('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVsrolpay.'</div>';
				$arrData[$i]['PERIOS']	= substr($arrData[$i]['PERIOS'],0,4).'-'.substr($arrData[$i]['PERIOS'],4,2);
				$arrData[$i]['LAS_NM'] 	= $arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		

		public function getVsrolpay(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsrolpay($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Rol no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function setVsrolpay()
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$intPerios        = intval($_POST['listPerios']);
			$strMondes        = strClean($_POST['listMondes']);
			$intQuince        = 2; //intval($_POST['listQuince']);
			$intEmp_no        = intval($_POST['listEmp_no']);
			$intRub_no        = intval($_POST['listRub_no']);
			$intIncome        = $_POST['txtIncome'];
			$intEgress        = $_POST['txtEgress'];

			if($intSec_id == 0)
			{
				// Crea un Rol
				$request_Vsrolpay = $this->model->insertVsrolpay($intPerios, $strMondes, $intQuince, $intEmp_no, $intRub_no, $intIncome, $intEgress);
				$opcion = 1;
			}else{
				$request_Vsrolpay = $this->model->updateVsrolpay($intSec_id, $intPerios, $strMondes, $intQuince, $intEmp_no, $intRub_no, $intIncome, $intEgress);
				$opcion = 2;
			}

			if($request_Vsrolpay > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Rol guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Rol actualizado con éxito.');
						break;
				}
			}else if($request_Vsrolpay == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Rol ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
