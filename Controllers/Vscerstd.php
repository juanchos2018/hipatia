<?php

	// Heredamos la clase: Controllers
	class Vscerstd extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(10);
		}


		public function Vscerstd()
		{
			$data['page_id'] 	= 10;
			$data['page_tag'] 	= 'Certificado por Estudiante';
			$data['page_name'] 	= 'certificado_por_estudiante';
			$data['page_title'] = 'Certificado por Estudiante';
			$this->views->getView($this,"vscerstd",$data);
		}

		
		// GESTIONA CERTIFICADO POR ESTUDIANTE
		public function prnCerStd()
		{
			$prnStd_no = $_POST['listStd_no'];
			$prnPerios = $_POST['listPerios'];
			$prnCertip = $_POST['listCertip'];	
			$prnFecreg = $_POST['datFecreg'];	

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getCerDetalle($prnStd_no,$prnPerios,$prnCertip,$prnFecreg);
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
			$this->views->getView($this,"vscerone",$data);	
		}


		public function getVscerstds()
		{
			$arrData = $this->model->selectVscerstd();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				switch($arrData[$i]['ESTATU'])
				{
					case 0:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Aspirante</span>';
						break;
					case 1:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-warning">Admitido</span>';
						break;
					case 2:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-success">Matriculado</span>';
						break;
					case 3:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Retirado</span>';
						break;
					case 4:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-success">Viene con Pase</span>';
						break;
					case 5:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Egresado</span>';
						break;
					case 6:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Desertor</span>';
						break;
					case 7:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">NEE Fiscapacitado</span>';
						break;
					case 8:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">NEE No discapactitado</span>';
						break;
					case 9:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Sin documentos</span>';
						break;
					case 10:
						$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">No matriculado</span>';
						break;
				}
				
				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-success btn-sm btnEditVscerstd" onClick="fntEditVscerstd('.$arrData[$i]['STD_NO'].')" title="Certificado"><i class="fas fa-print"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
    }
