<?php

	// Heredamos la clase: Controllers
	class Vschedul extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();

			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(8);
		}


		public function Vschedul()
		{
			$data['page_id'] 	= 8;
			$data['page_tag'] 	= 'Aula Virtual';
			$data['page_name'] 	= 'aula_virtual';
			$data['page_title'] = 'Aula Virtual';
			$this->views->getView($this,"vschedul",$data);
		}

		
		// Obtiene unn registro de la tabla: VSCHEDUL
		public function getVschedul(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVschedul($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Actividad no encontrada.');
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
				$arrData = $this->model->viewSchedul($intSec);
				$arrData['secId'] = $intSec;

				switch($arrData['actividad']['PARCIAL'])
				{
					case "Q1P1":
						$arrData['actividad']['PARCIAL'] = '1º Quimestre - 1º Parcial';
						break;
				    case "Q1P2":
				    	$arrData['actividad']['PARCIAL'] = '1º Quimestre - 2º Parcial';
				    	break;
				    case "Q1P3":
				    	$arrData['actividad']['PARCIAL'] = '1º Quimestre - 3º Parcial';
						break;
				    case "Q1P4":
				    	$arrData['actividad']['PARCIAL'] = '1º Quimestre - Exámen';
				    	break;
				    case "Q2P1":
				    	$arrData['actividad']['PARCIAL'] = '2º Quimestre - 1º Parcial';
						break;
				    case "Q2P2":
				    	$arrData['actividad']['PARCIAL'] = '2º Quimestre - 2º Parcial';
				    	break;
				    case "Q2P3":
				    	$arrData['actividad']['PARCIAL'] = '2º Quimestre - 3º Parcial';
						break;
				    case "Q2P4":
				    	$arrData['actividad']['PARCIAL'] = '2º Quimestre - Exámen';
				    	break;
					case "SUPL":
						$arrData['actividad']['PARCIAL'] = 'Supletorio';
						break;
				}

				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Registro de Actividad no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getVscheduls()
		{
			$arrData = $this->model->selectVschedul();
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
      			
				switch($arrData[$i]['PARCIA'])
				{
				case 'Q1P1I1':
					$arrData[$i]['PARCIA'] = '1ºQUI 1ºPAR I1';
					break;
				case 'Q1P1I2':
					$arrData[$i]['PARCIA'] = '1ºQUI 1ºPAR I2';
					break;
				case 'Q1P1I3':
					$arrData[$i]['PARCIA'] = '1ºQUI 1ºPAR I3';
					break;
				case 'Q1P1I4':
					$arrData[$i]['PARCIA'] = '1ºQUI 1ºPAR I4';
					break;
				case 'Q1P1I5':
					$arrData[$i]['PARCIA'] = '1ºQUI 1ºPAR I5';
					break;
				case 'Q1P2I1':
					$arrData[$i]['PARCIA'] = '1ºQUI 2ºPAR I1';
					break;
				case 'Q1P2I2':
					$arrData[$i]['PARCIA'] = '1ºQUI 2ºPAR I2';
					break;
				case 'Q1P2I3':
					$arrData[$i]['PARCIA'] = '1ºQUI 2ºPAR I3';
					break;
				case 'Q1P2I4':
					$arrData[$i]['PARCIA'] = '1ºQUI 2ºPAR I4';
					break;
				case 'Q1P2I5':
					$arrData[$i]['PARCIA'] = '1ºQUI 2ºPAR I5';
					break;
				case 'Q1P3I1':
					$arrData[$i]['PARCIA'] = '1ºQUI 3ºPAR I1';
					break;
				case 'Q1P3I2':
					$arrData[$i]['PARCIA'] = '1ºQUI 3ºPAR I2';
					break;
				case 'Q1P3I3':
					$arrData[$i]['PARCIA'] = '1ºQUI 3ºPAR I3';
					break;
				case 'Q1P3I4':
					$arrData[$i]['PARCIA'] = '1ºQUI 3ºPAR I4';
					break;
				case 'Q1P3I5':
					$arrData[$i]['PARCIA'] = '1ºQUI 3ºPAR I5';
					break;
				case 'Q1P4I1':
					$arrData[$i]['PARCIA'] = '1ºQUI 4ºPAR I1';
					break;
				case 'Q1P4I2':
					$arrData[$i]['PARCIA'] = '1ºQUI 4ºPAR I2';
					break;
				case 'Q1P4I3':
					$arrData[$i]['PARCIA'] = '1ºQUI 4ºPAR I3';
					break;
				case 'Q1P4I4':
					$arrData[$i]['PARCIA'] = '1ºQUI 4ºPAR I4';
					break;
				case 'Q1P4I5':
					$arrData[$i]['PARCIA'] = '1ºQUI 4ºPAR I5';
					break;
				case 'Q2P1I1':
					$arrData[$i]['PARCIA'] = '2ºQUI 1ºPAR I1';
					break;
				case 'Q2P1I2':
					$arrData[$i]['PARCIA'] = '2ºQUI 1ºPAR I2';
					break;
				case 'Q2P1I3':
					$arrData[$i]['PARCIA'] = '2ºQUI 1ºPAR I3';
					break;
				case 'Q2P1I4':
					$arrData[$i]['PARCIA'] = '2ºQUI 1ºPAR I4';
					break;
				case 'Q2P1I5':
					$arrData[$i]['PARCIA'] = '2ºQUI 1ºPAR I5';
					break;
				case 'Q2P2I1':
					$arrData[$i]['PARCIA'] = '2ºQUI 2ºPAR I1';
					break;
				case 'Q2P2I2':
					$arrData[$i]['PARCIA'] = '2ºQUI 2ºPAR I2';
					break;
				case 'Q2P2I3':
					$arrData[$i]['PARCIA'] = '2ºQUI 2ºPAR I3';
					break;
				case 'Q2P2I4':
					$arrData[$i]['PARCIA'] = '2ºQUI 2ºPAR I4';
					break;
				case 'Q2P2I5':
					$arrData[$i]['PARCIA'] = '2ºQUI 2ºPAR I5';
					break;
				case 'Q2P3I1':
					$arrData[$i]['PARCIA'] = '2ºQUI 3ºPAR I1';
					break;
				case 'Q2P3I2':
					$arrData[$i]['PARCIA'] = '2ºQUI 3ºPAR I2';
					break;
				case 'Q2P3I3':
					$arrData[$i]['PARCIA'] = '2ºQUI 3ºPAR I3';
					break;
				case 'Q2P3I4':
					$arrData[$i]['PARCIA'] = '2ºQUI 3ºPAR I4';
					break;
				case 'Q2P3I5':
					$arrData[$i]['PARCIA'] = '2ºQUI 3ºPAR I5';
					break;
				case 'Q2P4I1':
					$arrData[$i]['PARCIA'] = '2ºQUI 4ºPAR I1';
					break;
				case 'Q2P4I2':
					$arrData[$i]['PARCIA'] = '2ºQUI 4ºPAR I2';
					break;
				case 'Q2P4I3':
					$arrData[$i]['PARCIA'] = '2ºQUI 4ºPAR I3';
					break;
				case 'Q2P4I4':
					$arrData[$i]['PARCIA'] = '2ºQUI 4ºPAR I4';
					break;
				case 'Q2P4I5':
					$arrData[$i]['PARCIA'] = '2ºQUI 4ºPAR I5';
					break;
				case 'SUPLET':
					$arrData[$i]['PARCIA'] = 'SUPLETORIO';
					break;
				}

				$btnEdiVschedul  	= "";
				$btnDelVschedul  	= "";
				$btnPrnVschedul  	= "";
				$btnVieVschedul  	= "";
				$color_boton_puntaj = 'class="btn btn-outline-secondary btn-sm"';
				$color_boton_task	= 'class="btn btn-outline-secondary btn-sm btnEditVschedul"';
				$color_boton_tstd	= 'class="btn btn-outline-secondary btn-sm btnViewSchedul"';

				$rol = $_SESSION['userData']['rol_id'];

				if($arrData[$i]['FLNAME'] != "" OR $arrData[$i]['FLTASK'] != "")
				{
					$color_boton_task = 'class="btn btn-outline-info btn-sm btnEditVschedul"';
					$color_boton_tstd = 'class="btn btn-outline-warning btn-sm btnViewSchedul"';
				}

				if($arrData[$i]['FLTASK'] != "" AND $arrData[$i]['FLNAME'] != "")
				{
					$color_boton_task = 'class="btn btn-info btn-sm btnEditVschedul"';
					$color_boton_tstd = 'class="btn btn-warning btn-sm btnViewSchedul"';
				}

				if($arrData[$i]['PUNTAJ'] != 0)  
				{
					$color_boton_puntaj = 'class="btn btn-success btn-sm"';
					if($rol == 5)  // Bloquea al Docente una vez calificada la actividad ..
					{
						$color_boton_task = 'class="btn btn-info btn-sm disabled"';
					}
				}

				
				if($rol != 7)
				{
					$btnPrnVschedul = '<a '.$color_boton_puntaj.' title= "Imprimir" href="'.base_url().'Vschedul/notasActividad/'.$arrData[$i]['SEC_ID'].'"><i class="fas fa-print"></i></a>';
				}else{
					$btnPrnVschedul = '<a href="#" '.$color_boton_puntaj.' ><i class="fas fa-print"></i></a>';
				}

				// Boton para Visualizar la actividad del estudiante
				if($_SESSION['permisosMod']['r'])
				{
					if($rol == 1 || $rol == 7)
					{
						$btnVieVschedul = '<button '.$color_boton_tstd.' onClick="fntViewSchedul('.$arrData[$i]['SEC_ID'].')" title="Consultar"><i class="fas fa-eye"></i></button>';
					}
				}
			
				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVschedul = '<button '.$color_boton_task.' onClick="fntEditVschedul('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				if($_SESSION['permisosMod']['d'] AND $arrData[$i]['PUNTAJ'] == 0)
				{
					$btnDelVschedul = '<button class="btn btn-danger btn-sm btnDelVschedul" onClick="fntDelVschedul('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnVieVschedul.' '.$btnEdiVschedul.' '.$btnDelVschedul.'</div>';
				$arrData[$i]['SEC_NM'] 	= $arrData[$i]['SEC_NM'].' - '.$arrData[$i]['PARALE'];
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
							$periodo 		= $datosEmpresa['PERIOS'];
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


		// ELIMINA UNA ACTIVIDAD
		public function delVschedul()
		{
			$intSec 	= intval($_POST['idSec']);
			$request 	= $this->model->deleteVschedul($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function setVschedul()
		{
			if($_POST)
			{
				if(empty($_POST['listSec_no']) || empty($_POST['listMat_no']) || empty($_POST['datFecmax']) || empty($_POST['datFecreg']) || empty($_POST['listInsumo']))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos Incorrectos.');
				}else{
					$intSec_id  = intval($_POST['idSec_id']);
					$intPerios  = intval($_POST['listPerios']);
					$strFecreg  = strClean($_POST['datFecreg']);
					$strHorreg  = strClean($_POST['txtHorreg']);
					$intSec_no  = $_POST['listSec_no'];
					$intMat_no  = intval($_POST['listMat_no']);
					$intStd_no  = intval($_POST['listStd_no']);
					$intEmp_no  = intval($_POST['listEmp_no']);
					$strFecmax  = strClean($_POST['datFecmax']);
					$strParcia  = strClean($_POST['listParcia']);
					$strInsumo  = strClean($_POST['listInsumo']);
					$intPuntaj  = strClean($_POST['txtPuntaj']);
					$strSchedu  = strClean($_POST['txtSchedu']);
					$strVdlink  = strClean($_POST['txtVdlink']);
					$strMessag  = strClean($_POST['txtMessag']);
					
					if($strParcia == 'SUPL')
					{
						$strParcia  = 'SUPLET';
					}else{
						$strParcia  = $strParcia.$strInsumo;
					}

					// Archivo a Subir .....
					$strFile  	= $_FILES['flActividad']; 
					$strFlname  = "";
					$typeFlname = "";
					$pathFlname = "";
					if($strFile['name'] != "")
					{
						$strFlname	= $strFile['name'];
						$typeFlname = $strFile['type'];
						$pathFlname = $strFile['tmp_name'];
					}elseif($_POST['txtNameTask'] != ""){
						$strFlname	= $_POST['txtNameTask'];
					}
					
					// Campo para Tarea de Estudiante, siempre sera NULO;
					// ya que solo el estudiante lo actualiza .....
					$strFltask = "";

					if($intSec_id == 0)
					{
						// Crea una Actividad
						$request_Vschedul = $this->model->insertVschedul($intPerios, $strFecreg, $strHorreg, $intSec_no, $intMat_no, $intStd_no, $intEmp_no, $strFecmax, $strParcia, $strInsumo, $intPuntaj, $strSchedu, $strVdlink, $strFlname, $strFltask, $strMessag);
						$opcion = 1;
					}else{
						$request_Vschedul = $this->model->updateVschedul($intSec_id, $intPerios, $strFecreg, $strHorreg, $intSec_no, $intMat_no, $intStd_no, $intEmp_no, $strFecmax, $strParcia, $strInsumo, $intPuntaj, $strSchedu, $strVdlink, $strFlname, $strMessag);
						$opcion = 2;
					}

					if($request_Vschedul > 0)
					{
						switch($opcion)
						{
							case 1:
								$arrResponse = array('status' => true, 'msg' => 'Actividad guardada con éxito.');
								if($strFile['error'] != 4)
								{
									$datosEmpresa 	= datos_empresa();
									$periodo 		= $intPerios;
									$opcion 		= 1;
									uploadFILE($strFile,$strFlname,$datosEmpresa['AMI_ID'],$periodo,$opcion);
								}
								break;
							case 2:
								$arrResponse = array('status' => true, 'msg' => 'Actividad actualizada con éxito.');
								if($strFile['error'] != 4)
								{
									$datosEmpresa 	= datos_empresa();
									$periodo 		= $intPerios;
									$opcion 		= 1;
									uploadFILE($strFile,$strFlname,$datosEmpresa['AMI_ID'],$periodo,$opcion);
								}
								break;
						}
					}else if($request_Vschedul == -1){
						$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Actividad ya existe.');
					}else if($request_Vschedul == -2){
						$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Calificación no debe ser mayor al parámetro permitido.');
					}else if($request_Vschedul == -3){
						$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Asignatura no pertenece a Sección escogida.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Información escogida para almacenar no es coincidente.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die(); 
		}
	}
