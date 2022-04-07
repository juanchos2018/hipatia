<?php

	// Heredamos la clase: Controllers
	class Vsabsent extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(7);
		}


		public function Vsabsent()
		{
			$data['page_id'] 	= 7;
			$data['page_tag'] 	= 'Asistencia';
			$data['page_name'] 	= 'asistencia';
			$data['page_title'] = 'Asistencia';
			$this->views->getView($this,"vsabsent",$data);
		}


		// Obtiene Estudiantes en base a codigos de Sección y Asignatura 
		public function fntStdList()
		{
			$codSec = $_POST['codSection'];
			$codMat = $_POST['codMatter'];
			$codPer = $_POST['codPerios'];
			$arrData = $this->model->fntStdList($codSec,$codMat,$codPer);
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Estudiantes'.'</option>';
	
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['STD_NO'].'">'.$arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		// Obtiene Estudiantes en base a codigos de Sección y Asignatura 
		public function fntStdList2()
		{
			$codSec 	= $_POST['codSection'];
			$codMat 	= $_POST['codMatter'];
			$codPer 	= $_POST['codPerios'];
			$arrData 	= $this->model->fntStdList($codSec,$codMat,$codPer);
			$htmlOptions = "";
			
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['STD_NO'].'">'.$arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		// OBTIENE UN REGISTRO
		public function getVsabsent(int $secId) 
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsabsent($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Asistencia no encontrada.');
				}else{
					$arrData['HTMLOptions'] = '';
					$arrData['HTMLOptions'] .= '<option value="'.$arrData['STD_NO'].'" selected>'.$arrData['LAS_NM'].' '.$arrData['FIR_NM'].'</option>';
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getVsabsents()
		{
			$arrData = $this->model->selectVsabsent();
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

				switch($arrData[$i]['ABSTIP'])
				{
					case 1:
						$arrData[$i]['ABSTIP'] = '<span class="badge badge-danger">Injustificada</span>';
						break;
					case 2:
						$arrData[$i]['ABSTIP'] = '<span class="badge badge-success">Justificada</span>';
						break;
					case 3:
						$arrData[$i]['ABSTIP'] = '<span class="badge badge-warning">Atraso</span>';
						break;
					}

				$btnEdiVsabsent  	= "";
				$btnDelVsabsent  	= "";
				$color_boton_task	= 'class="btn btn-info btn-sm btnEditVsabsent"';

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsabsent = '<button '.$color_boton_task.' onClick="fntEditVsabsent('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVsabsent = '<button class="btn btn-danger btn-sm btnDelVsabsent" onClick="fntDelVsabsent('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdiVsabsent.' '.$btnDelVsabsent.'</div>';
				$arrData[$i]['SEC_NM'] 	= $arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'];
				$arrData[$i]['LAS_NM'] 	= $arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		
		public function delVsabsent()
		{
			$intSec 	= intval($_POST['idSec']);
			$request 	= $this->model->deleteVsabsent($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function setVsabsent()
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$intPerios        = intval($_POST['listPerios']);
			$strFecreg        = strClean($_POST['datFecreg']);
			$intSec_no        = intval($_POST['listSec_no']);
			$intMat_no        = intval($_POST['listMat_no']);
			$intStd_no        = $_POST['listStd_n2'];
			$strParcia        = strClean($_POST['listParcia']);
			$intAbstip        = intval($_POST['listAbstip']);
			$strSchedu        = strClean($_POST['txtSchedu']);

			if($intSec_id == 0)
			{
				// Crea una Asistencia
				$request_Vsabsent = $this->model->insertVsabsent($intPerios, $strFecreg, $intSec_no, $intMat_no, $intStd_no, $strParcia, $intAbstip, $strSchedu);
				$opcion = 1;
			}else{
				$request_Vsabsent = $this->model->updateVsabsent($intSec_id, $intPerios, $strFecreg, $intSec_no, $intMat_no, $intStd_no, $strParcia, $intAbstip, $strSchedu);
				$opcion = 2;
			}

			if($request_Vsabsent > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Asistencia guardada con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Asistencia actualizada con éxito.');
						break;
				}
			}else if($request_Vsabsent == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Reparto: Sección Asignatura es incorrecto.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
