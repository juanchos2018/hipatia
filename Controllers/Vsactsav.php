<?php

	// Heredamos la clase: Controllers
	class Vsactsav extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(14);
		}


		public function Vsactsav()
		{
			$data['page_id'] 	= 14;
			$data['page_tag'] 	= 'Registrar Calificaciones';
			$data['page_name'] 	= 'actas';
			$data['page_title'] = 'Registrar Calificaciones';
			$this->views->getView($this,"vsactsav",$data);
		}


		// GESTIONA EL REGISTRO DE CALIFICACIONES GENERALES
		public function getSavOne()
		{
			$prnSec_id  = $_POST['codSec_id'];
			$prnParcia  = $_POST['codParcia'];	
			$prnCalifi  = $_POST['codCalifi'];
			$arrData    = $this->model->getSavOne($prnSec_id,$prnParcia,$prnCalifi);
            if($arrData > 0)
            {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }else{
                $arrResponse = array('status' => false, 'msg' => 'Calificación posee rango Incorrecto.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
        }


		// GESTIONA EL REGISTRO DE CALIFICACIONES ACTIVIDADES
		public function getSavAct()
		{
			$prnSec_id  = $_POST['codSec_id'];
			$prnParcia  = $_POST['codParcia'];
			$prnCalifi  = $_POST['codCalifi'];
			$arrData    = $this->model->getSavAct($prnSec_id,$prnParcia,$prnCalifi);
            if($arrData > 0)
            {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }else{
                $arrResponse = array('status' => false, 'msg' => 'Calificación posee rango Incorrecto.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
        }


		// GESTIONA MOSTRAR REGISTRO DE CALIFICACIONES
		public function prnActSav()
		{
			$prnPerios = $_POST['listPerios'];
			$prnSec_no = $_POST['listSec_no'];
			$prnMat_no = $_POST['listMat_no'];
			$prnCaltyp = $_POST['listCaltyp'];	
			$prnParcia = $_POST['listParci0'];

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getVsactdet($prnPerios,$prnSec_no,$prnMat_no,$prnCaltyp,$prnParcia);
			
			$data['page_tag']   		= 'Acta Calificaciones';
			$data['page_title'] 		= 'ACTA <small>Calificaciones</small>';
			$data['page_name']  		= 'Acta';
			$data['maestro_detalle'] 	= $maestroDetalle;
			$this->views->getView($this,"vssavone",$data);
		}


		public function getVsactsavs()
		{
			$arrData = $this->model->selectVsactsav();
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

				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-success btn-sm btnEditVsactsav" onClick="fntEditVsactsav('.$arrData[$i]['SEC_ID'].')" title="Actas"><i class="fas fa-print"></i></button>
				</div>';  
				$arrData[$i]['SEC_NM'] 	= $arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'];
				$arrData[$i]['LAS_NM'] 	= $arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE UN REGISTRO
        public function getVsactsav(int $secID)
        {
         	$intSec_id = intval(strClean($secID));
			if($intSec_id > 0)
			{
				$arrData = $this->model->oneVsactsav($intSec_id);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Reparto no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
        }             
	}
