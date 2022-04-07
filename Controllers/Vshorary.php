<?php

	// Heredamos la clase: Controllers
	class Vshorary extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(23);
		}


		public function Vshorary()
		{
			$data['page_id'] 	= 23;
			$data['page_tag'] 	= 'Horarios';
			$data['page_name'] 	= 'horarios';
			$data['page_title'] = 'Horarios';
			$this->views->getView($this,"vshorary",$data);
		}


		public function getVshorarys()
		{
			$arrData = $this->model->selectVshorary();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				switch($arrData[$i]['DAYNUM'])
				{
					case 1:
						$arrData[$i]['DAYNUM'] = '<span class="badge badge-success">Lunes</span>';
						break;
					case 2:
						$arrData[$i]['DAYNUM'] = '<span class="badge badge-success">Martes</span>';
						break;
					case 3:
						$arrData[$i]['DAYNUM'] = '<span class="badge badge-success">Miercoles</span>';
						break;
					case 4:
						$arrData[$i]['DAYNUM'] = '<span class="badge badge-success">Jueves</span>';
						break;
					case 5:
						$arrData[$i]['DAYNUM'] = '<span class="badge badge-success">Viernes</span>';
						break;
                }

				$btnEdiVshorary  = "";
				$btnDelVshorary  = "";
			
				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVshorary = '<button class="btn btn-info btn-sm btnEditVshorary" onClick="fntEditVshorary('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

                if($_SESSION['permisosMod']['d'])
				{
					$btnDelVshorary = '<button class="btn btn-danger btn-sm btnDelVshorary" onClick="fntDelVshorary('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}
			
				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVshorary.' '.$btnDelVshorary.'</div>';
				$arrData[$i]['SEC_NM'] 	= $arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'];
				$arrData[$i]['LAS_NM'] 	= $arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// EXTRAE UN HORARIO
        public function getVshorary(int $secID)
        {
         	$intSec_id = intval(strClean($secID));
			if($intSec_id > 0)
			{
				$arrData = $this->model->oneVshorary($intSec_id);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Registro de Horario no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
        }  


		public function delVshorary()
		{
			$intSec 	= intval($_POST['idSec']);
			$request 	= $this->model->deleteVshorary($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function setVshorary()
		{
			$intSec_id   = intval($_POST['idSec_id']);
			$intSec_no   = intval($_POST['listSec_no']);
			$intMat_no   = intval($_POST['listMat_no']);
			$intEmp_no   = intval($_POST['listEmp_no']);
			$intPerios   = intval($_POST['listPerios']);
			$intDaynum   = intval($_POST['listDaynum']);
			$intHornum   = intval($_POST['listHornum']);
			
			if($intSec_id == 0)
			{
				// Crea un Horario
				$request_Vshorary = $this->model->insertVshorary($intSec_no,$intMat_no,$intEmp_no,$intPerios,$intDaynum,$intHornum);
				$opcion = 1;
			}else{
				$request_Vshorary = $this->model->updateVshorary($intSec_id,$intSec_no,$intMat_no,$intEmp_no,$intPerios,$intDaynum,$intHornum);
				$opcion = 2;
			}

			if($request_Vshorary > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Horario guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Horario actualizado con éxito.');
						break;
				}
			}else if($request_Vshorary == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Horario ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
