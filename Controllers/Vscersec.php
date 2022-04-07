<?php

	// Heredamos la clase: Controllers
	class Vscersec extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(22);
		}


		public function Vscersec()
		{
			$data['page_id'] 	= 22;
			$data['page_tag'] 	= 'Certificados por Sección';
			$data['page_name'] 	= 'certificados_por_seccion';
			$data['page_title'] = 'Certificados por Sección';
			$this->views->getView($this,"vscersec",$data);
		}


		// GESTIONA CERTIFICADO POR SECCION
		public function prnCerSec()
		{
			$prnSec_no = intval($_POST['listSec_no']);
			$prnPerios = intval($_POST['listPerios']);
			$prnCertip = $_POST['listCertip'];
			$prnFecreg = $_POST['datFecreg'];

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getCerDetalle($prnSec_no,$prnPerios,$prnCertip,$prnFecreg);
			$estudiante 	= $maestroDetalle['estudiante'];

			for($i = 0; $i < count($estudiante); $i++)
			{
				// Descomentar las siguientes 4 lineas para el resto de instituciones educativas ...
				// SWICTH por codigo AMI ...
				
				// $nota = explode(".",$estudiante[$i]['PROFIN']);
				// $notaint = $nota[0]; //parte entera de la calificacion
				// $notadec = intval($nota[1]); //parte decimal de la calificacion
				// $maestroDetalle['estudiante'][$i]['PROFINLETTER'] = numtoletter($notaint).' COMA '.numtoletter($notadec);

				// Esta conversion solo aplica a JAIME MOLA .....
				$maestroDetalle['estudiante'][$i]['PROFINLETTER'] = $this->model->getScale($estudiante[$i]['PROFIN']);
			}

			$proStd = $maestroDetalle['proStd'];
			if(empty($proStd))
			{
				$notaint = 0;
				$notadec = 0;
				$maestroDetalle['proStd'][0]['proStdLetter'] = '';
			}else{
				$nota = explode(".",$proStd[0]['proStd']);
				$notaint = $nota[0]; //parte entera de la calificacion
				$notadec = $notaint != 0 ? intval($nota[1]) : 0; //parte decimal de la calificacion 
				$maestroDetalle['proStd'][0]['proStdLetter'] = $this->model->getScale($proStd[0]['proStd']);
			}

			
			//$maestroDetalle['proStd'][0]['proStdLetter'] = numtoletter($notaint);
			//if($notadec != 0)
			//{
			//	$maestroDetalle['proStd'][0]['proStdLetter'] = numtoletter($notaint).' COMA '.numtoletter($notadec);	
			//}

			$data['page_tag']   		= 'Certificado Estudiantil';
			$data['page_title'] 		= 'CERTIFICADO <small>Estudiantil</small>';
			$data['page_name']  		= 'Certificado';
			$data['maestro_detalle'] 	= $maestroDetalle;
			$data['condicionREP'] 		= $prnCertip;
			$this->views->getView($this,"vscesone",$data);	
		}


		public function getVscersecs()
		{
			$arrData = $this->model->selectVscersec();
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
				<button class="btn btn-success btn-sm btnEditVscersec" onClick="fntEditVscersec('.$arrData[$i]['SEC_NO'].')" title="Certificado"><i class="fas fa-print"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// EXTRAE UNA SECCION
		public function getVscersec(int $idSec)
		{
			$intSec_no = intval(strClean($idSec));
			if($intSec_no > 0)
			{
				$arrData = $this->model->oneVscersec($intSec_no);
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
