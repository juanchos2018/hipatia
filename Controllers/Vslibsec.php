<?php

	// Heredamos la clase: Controllers
	class Vslibsec extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(21);
		}


		public function Vslibsec()
		{
			$data['page_id'] 	= 21;
			$data['page_tag'] 	= 'Boletines por Sección';
			$data['page_name'] 	= 'boletines_por_seccion';
			$data['page_title'] = 'Boletines por Sección';
			$this->views->getView($this,"vslibsec",$data);
		}


		// GESTIONA BOLETIN POR SECCION
		public function prnLibSec()
		{
			$prnSec_no = intval($_POST['listSec_no']);
			$prnPerios = intval($_POST['listPerios']);
			$prnParcia = strClean($_POST['listParci2']);

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getLibDetail($prnSec_no,$prnPerios,$prnParcia);
		
			$data['page_tag']   		= 'Boletin Estudiantil';
			$data['page_title'] 		= 'BOLETIN <small>Estudiantil</small>';
			$data['page_name']  		= 'Boletín';
			$data['maestro_detalle'] 	= $maestroDetalle;
			$this->views->getView($this,"vslisone",$data);	
		}


		public function getVslibsecs()
		{
			$arrData = $this->model->selectVslibsec();
			for ($i = 0; $i < count($arrData); $i++) 
			{
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

				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-success btn-sm btnEditVslibsec" onClick="fntEditVslibsec('.$arrData[$i]['SEC_NO'].')" title="Boletín"><i class="fas fa-print"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// EXTRAE UNA SECCION
		public function getVslibsec(int $idSec)
		{
			$intSec_no = $idSec;
			if($intSec_no > 0)
			{
				$arrData = $this->model->oneVslibsec($intSec_no);
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
    }
