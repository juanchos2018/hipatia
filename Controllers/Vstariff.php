<?php

	// Heredamos la clase: Controllers
	class Vstariff extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(32);
		}


		public function Vstariff()
		{
			$data['page_id'] 	= 32;
			$data['page_tag'] 	= 'Convenios de Pago';
			$data['page_name'] 	= 'convenio';
			$data['page_title'] = 'Convenios';
			$this->views->getView($this,"vstariff",$data);
		}


		// GESTIONA ESTADO DE CUENTA
		public function	prnEstadoCuenta(int $secID)
		{
			$datosEmpresa 	= datos_empresa();
			$dataTarifa 	= $this->model->oneVstariff($secID);
			$maestroDetalle = $this->model->getVsEstadoCuenta($dataTarifa['PERIOS'],$dataTarifa['STD_NO']);

			$data['page_tag'] 		= 'Estado de Cuenta';
			$data['page_title'] 	= 'Estado de Cuenta';
			$data['page_name'] 		= 'Estado_de_Cuenta';
			$data['datosEmpresa'] 	= $datosEmpresa;
			$data['maestroDetalle'] = $maestroDetalle;
			$this->views->getView($this,"vsstdcta",$data);
		}


		// GESTIONA GENERAR CUENTAS POR COBRAR
		public function prnGenCxc()
		{
			$prnPerios = $_POST['listPerio2'];
			$prnStd_no = $_POST['listStd_n3'];
			if($_POST['listStd_n3'] == '')
			{
				$prnStd_no = intval($_POST['listStd_n3']);
			}

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getVsgenCxc($prnPerios,$prnStd_no);
			if(empty($maestroDetalle))
			{
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Cuenta x Cobrar no tiene valores por actualizar.');
			}else{
				$arrResponse = array('status' => true, 'msg' => 'Cuenta x Cobrar generada con éxito.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		// GESTIONA INFORME CUENTAS POR COBRAR
		public function prnStdCxc()
		{
			$prnPerios = $_POST['listPerio3'];
			$prnStd_no = $_POST['listStd_n4'];
			if($_POST['listStd_n4'] == '')
			{
				$prnStd_no = intval($_POST['listStd_n4']);
			}
			$prnPer_no = $_POST['listMon_no'];
			$prnAbotyp = $_POST['listAbotyp'];
			$prnReptyp = $_POST['listReptyp'];

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getVsstdCxc($prnPerios,$prnStd_no,$prnPer_no,$prnAbotyp,$prnReptyp);
				
			$data['page_tag']   	= 'Informe Cuenta por Cobrar';
			$data['page_title'] 	= 'INFORME <small>Cuenta por Cobrar</small>';
			$data['page_name']  	= 'Informe';
			$data['perios'] 		= $prnPerios;
			$data['reptyp'] 		= $prnReptyp;
			$data['datosEmpresa'] 	= $datosEmpresa;
			$data['maestroDetalle'] = $maestroDetalle;
			$this->views->getView($this,"vsstdcxc",$data);
		}


		public function getVstariffs()
		{
			$arrData = $this->model->selectVstariff();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$btnPrnVstariff  = '';
				$btnEditVstariff = '';
				$color_boton_Prn = 'class="btn btn-success btn-sm"';

				$btnPrnVstariff = '<a '.$color_boton_Prn.' title= "Estado de Cuenta" href="'.base_url().'Vstariff/prnEstadoCuenta/'.$arrData[$i]['SEC_ID'].'"><i class="fas fa-print"></i></a>';
				if($_SESSION['permisosMod']['u'])
				{
					$btnEditVstariff = '<button class="btn btn-info btn-sm btnEditVstariff" onClick="fntEditVstariff('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnPrnVstariff.' '.$btnEditVstariff.' '.'</div>';
				$arrData[$i]['LAS_NM'] 	= $arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE UN REGISTRO
		public function getVstariff(int $idSTD)
		{
			$intSTD 	= intval(strClean($idSTD));
			$arrData 	= $this->model->oneVstariff($intSTD);
			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function setVstariff()
		{
			$intSec_id    = intval($_POST['idSec_id']);
			$intPerios    = intval($_POST['listPerios']);
			$intStd_no    = intval($_POST['listStd_no']);
			$strPer_no    = strclean($_POST['listPer_no']);
			$intArt_no    = intval($_POST['listArt_no']);
			$strRemark    = strclean($_POST['txtRemark']);
			$intDocval    = $_POST['txtDocval'];
			$intFacval    = $_POST['txtFacval'];
			$intAboval    = intval($_POST['txtAboval']);
			$intReplic    = strClean($_POST['listReplic']);

			if($intSec_id == 0)
			{
				// Crea un Convenio
                $request_Vstariff = $this->model->insertVstariff($intPerios, $intStd_no, $strPer_no, $intArt_no, $strRemark, $intDocval, $intFacval, $intAboval);
				$opcion = 1;
			}else{
				$request_Vstariff = $this->model->updateVstariff($intSec_id, $intPerios, $intStd_no, $strPer_no, $intArt_no, $strRemark, $intDocval, $intFacval, $intAboval, $intReplic);
				$opcion = 2;
			}
			
			if($request_Vstariff > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Convenio guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Convenio actualizado con éxito.');
						break;
				}
			}else{
				switch($request_Vstariff)
				{
					case -1:
							$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Convenio ya existe.');
							break;
					case -2:
							$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. TARIFA posee valor Incorrecto.');
							break;
					default:
							$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
							break;
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
