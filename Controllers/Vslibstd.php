<?php

	// Heredamos la clase: Controllers
	class Vslibstd extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(9);
		}


		public function Vslibstd()
		{
			$data['page_id'] 	= 9;
			$data['page_tag'] 	= 'Boletín por Estudiante';
			$data['page_name'] 	= 'boletin_por_estudiante';
			$data['page_title'] = 'Boletín por Estudiante';
			$this->views->getView($this,"vslibstd",$data);
		}


		// GESTIONA BOLETIN POR ESTUDIANTE
		public function prnLibStd()
		{
			$prnStd_no = $_POST['listStd_no'];
			$prnPerios = $_POST['listPerios'];
			$prnParcia = $_POST['listParci2'];	

			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->getLibDetalle($prnStd_no,$prnPerios,$prnParcia);
		
			$data['page_tag']   		= 'Boletin Estudiantil';
			$data['page_title'] 		= 'BOLETIN <small>Estudiantil</small>';
			$data['page_name']  		= 'Boletín';
			$data['maestro_detalle'] 	= $maestroDetalle;
			$this->views->getView($this,"vslibone",$data);	
		}


		public function getVslibstd()
		{
			$arrData = $this->model->selectVslibstd();
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
				<button class="btn btn-success btn-sm btnEditVslibstd" onClick="fntEditVslibstd('.$arrData[$i]['STD_NO'].')" title="Boletín"><i class="fas fa-print"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
    }
