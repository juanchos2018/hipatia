<?php

	// Heredamos la clase: Controllers
	class Vsexamen extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();

			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(13);
		}


		public function Vsexamen()
		{
			$data['page_id'] 	= 13;
			$data['page_tag'] 	= 'Examenes';
			$data['page_name'] 	= 'examenes';
			$data['page_title'] = 'Examenes';
			$this->views->getView($this,"vsexamen",$data);
		}

		
		// Obtiene unn registro de la tabla: VSCHEDUL
		public function getVsexamen(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsexamen($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Examen no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function	getActivity(int $secId)
		{
			$intSec = intval($secId);
			if($intSec > 0)
			{
				$arrData            = $this->model->viewVsexamen($intSec);
				$arrData['secId']   = $intSec;

                switch($arrData['actividad']['PARCIA'])
				{
					case "Q1P1":
						$arrData['actividad']['PARCIA'] = '1º Quimestre - 1º Parcial';
						break;
				    case "Q1P2":
				    	$arrData['actividad']['PARCIA'] = '1º Quimestre - 2º Parcial';
				    	break;
				    case "Q1P3":
				    	$arrData['actividad']['PARCIA'] = '1º Quimestre - 3º Parcial';
						break;
				    case "Q1P4":
				    	$arrData['actividad']['PARCIA'] = '1º Quimestre - Exámen';
				    	break;
				    case "Q2P1":
				    	$arrData['actividad']['PARCIA'] = '2º Quimestre - 1º Parcial';
						break;
				    case "Q2P2":
				    	$arrData['actividad']['PARCIA'] = '2º Quimestre - 2º Parcial';
				    	break;
				    case "Q2P3":
				    	$arrData['actividad']['PARCIA'] = '2º Quimestre - 3º Parcial';
						break;
				    case "Q2P4":
				    	$arrData['actividad']['PARCIA'] = '2º Quimestre - Exámen';
				    	break;
					case "SUPL":
						$arrData['actividad']['PARCIA'] = 'Supletorio';
						break;
				}

				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Registro de Examen no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getVsexamens()
		{
			$arrData = $this->model->selectVsexamen();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				switch($arrData[$i]['PARCIA'])
				{
    				case 'Q1P1I4':
	    				$arrData[$i]['PARCIA'] = '1ºQUI 1ºPAR I4';
		    			break;
			    	case 'Q1P2I4':
				    	$arrData[$i]['PARCIA'] = '1ºQUI 2ºPAR I4';
					    break;
    				case 'Q1P3I4':
	    				$arrData[$i]['PARCIA'] = '1ºQUI 3ºPAR I4';
		    			break;
			    	case 'Q1P4I4':
				    	$arrData[$i]['PARCIA'] = '1ºQUI 4ºPAR I4';
					    break;
    				case 'Q2P1I4':
	    				$arrData[$i]['PARCIA'] = '2ºQUI 1ºPAR I4';
		    			break;
			    	case 'Q2P2I4':
				    	$arrData[$i]['PARCIA'] = '2ºQUI 2ºPAR I4';
					    break;
    				case 'Q2P3I4':
	    				$arrData[$i]['PARCIA'] = '2ºQUI 3ºPAR I4';
		    			break;
			    	case 'Q2P4I4':
				    	$arrData[$i]['PARCIA'] = '2ºQUI 4ºPAR I4';
					    break;
    				case 'SUPLET':
	    				$arrData[$i]['PARCIA'] = 'SUPLETORIO';
		    			break;
				}

				$btnVieVsexamen  	= "";
				$btnEdiVsexamen  	= "";
				$btnDelVsexamen  	= "";
		
				if($_SESSION['permisosMod']['r'])
				{
    				$btnVieVsexamen = '<button class="btn btn-warning btn-sm btnVieVsexamen" onClick="fntVieVsexamen('.$arrData[$i]['SEC_ID'].')" title="Consultar"><i class="fas fa-eye"></i></button>';
                }
			
				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsexamen = '<button class="btn btn-info btn-sm btnEdiVsexamen" onClick="fntEdiVsexamen('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVsexamen = '<button class="btn btn-danger btn-sm btnDelVsexamen" onClick="fntDelVsexamen('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnVieVsexamen.' '.$btnEdiVsexamen.' '.$btnDelVsexamen.'</div>';
				$arrData[$i]['LAS_NM'] 	= $arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'];
				$arrData[$i]['ELAS_NM'] = $arrData[$i]['ELAS_NM'].' '.$arrData[$i]['EFIR_NM'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// Funcion para la Calificacion de Actividades
		public function notasActividad(int $secID)
		{
			$datosEmpresa 	= datos_empresa();
			$maestroDetalle = $this->model->selectDetalle($secID,$datosEmpresa['AMI_ID']);

			$data['page_tag'] 		= 'Calificación de Actividades';
			$data['page_title'] 	= 'CALIFICACION <small>de Actividades</small>';
			$data['page_name'] 		= 'Calificacion';
			$data['maestro_detalle'] = $maestroDetalle;
			$this->views->getView($this,"calificaActividad",$data);	
		}


		// Funcion para Subir la Tarea del Estudiante
		public function setTaskStd()
		{
			if($_POST)
			{
				$secTaskStd = $_POST['secTaskStd'];
				
				if($_FILES)
				{
					$strFile  	= $_FILES['flTaskStd'];
					$strFlname	= $strFile['name'];
					
				    // Se hace el Update a la Tabla Vschedul ....
					$request_upTaskStd = $this->model->updateTaskStd($secTaskStd, $strFlname);
					
					if($request_upTaskStd)
					{
						$arrResponse = array('status' => true, 'msg' => 'Tarea subida correctamente.');
						if($strFile['error'] != 4)
						{
							$datosEmpresa 	= datos_empresa();
							$codigoAMIE 	= $datosEmpresa['AMI_ID'];
							$periodo 		= 2021;
							$opcion 		= 2;
							uploadFILE($strFile,$strFlname,$codigoAMIE,$periodo,$opcion);
						}
					}else{
						$arrResponse = array('status' => false, 'msg' => 'No se ha podido actualizar la tarea.');
					}
				}
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Ha ocurrido un error inesperado.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();			
		}


		public function delVsexamen()
		{
			$intSec     = intval($_POST['idSec']);
			$request    = $this->model->deleteVsexamen($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function setVsexamen()
		{
			$intSec_id  = intval($_POST['idSec_id']);
			$intPerios  = intval($_POST['listPerios']);
			$strFecreg  = strClean($_POST['datFecreg']);
			$strFecini  = strClean($_POST['datFecini']);
			$strHorini  = strClean($_POST['txtHorini']);
			$intSec_no  = intval($_POST['listSec_no']);
			$intMat_no  = intval($_POST['listMat_no']);
			$intStd_no  = intval($_POST['listStd_no']);
			$intEmp_no  = intval($_POST['listEmp_no']);
			$strParcia  = strClean($_POST['listParcia']);
			$strSchedu  = strClean($_POST['txtSchedu']);
					
			if($strParcia == 'SUPL')
			{
				$strParcia  = 'SUPLET';
			}

   			if($intSec_id == 0)
			{
				// Crea un Examen
				$request_Vsexamen = $this->model->insertVsexamen($intPerios, $strFecreg, $strFecini, $strHorini, $intSec_no, $intMat_no, $intStd_no, $intEmp_no, $strParcia, $strSchedu);
				$opcion = 1;
			}else{
				$request_Vsexamen = $this->model->updateVsexamen($intSec_id, $intPerios, $strFecreg, $strFecini, $strHorini, $intSec_no, $intMat_no, $intStd_no, $intEmp_no, $strParcia, $strSchedu);
				$opcion = 2;
			}

			if($request_Vsexamen > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Examen guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Examen actualizado con éxito.');
						break;
				}
			}else if($request_Vsexamen == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Examen ya existe.');
			}else if($request_Vsexamen == -3){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Asignatura no pertenece a Sección escogida.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Información escogida para almacenar no es coincidente.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
