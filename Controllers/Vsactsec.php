<?php

	// Heredamos la clase: Controllers
	class Vsactsec extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(12);
		}


		public function Vsactsec()
		{
			$data['page_id'] 	= 12;
			$data['page_tag'] 	= 'Cuadros de Calificaciones';
			$data['page_name'] 	= 'cuadros';
			$data['page_title'] = 'Cuadros de Calificaciones';
			$this->views->getView($this,"vsactsec",$data);
		}


		public function getSelectVactsec()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Sección'.'</option>';

			$arrData = $this->model->selectVsactsec();
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


		public function prnActSec()
		{
			$prnSec_no = $_POST['listSec_no'];
			$prnPerios = $_POST['listPerios'];
			$prnParcia = $_POST['listParci2'];	

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getVssecdet($prnSec_no,$prnPerios,$prnParcia);

			$data['page_tag']   		= 'Cuadro Calificaciones';
			$data['page_title'] 		= 'CUADRO <small>Calificaciones</small>';
			$data['page_name']  		= 'Cuadro';
			$data['maestro_detalle'] 	= $maestroDetalle;			
			$this->views->getView($this,"vssecone",$data);			
		}


		public function getVsactsecs()
		{
			$arrData = $this->model->selectVsactsec();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				// SWITCH de Opciones:
				$opcion = $arrData[$i]['JOR_NO'];
				switch($opcion)
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

				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-success btn-sm btnEditVsactsec" onClick="fntEditVsactsec('.$arrData[$i]['SEC_NO'].')" title="Cuadros"><i class="fas fa-print"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE UN REGISTRO
		public function getVsactsec(int $idSec)
		{
			$intSec_no = intval(strClean($idSec));
			if($intSec_no > 0)
			{
				$arrData = $this->model->oneVsactsec($intSec_no);
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


		public function setVsactsec()
		{
		}
	}
