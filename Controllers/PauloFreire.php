<?php

	// Heredamos la clase: Controllers
	class PauloFreire extends Controllers
	{

		public function __construct()
		{
			session_start();
			if(isset($_SESSION['login']))
			{
				header('Location: '.base_url().'Dashboard');
			}
			parent::__construct();

		}


		public function login()
		{
			// Se incluye el arreglo DATA, que tiene informacion de la pagina ...
			$data['page_tag'] = 'Vschool';
			$data['page_title'] = 'Virtual School';
			$data['page_name'] = 'login';
			$data['page_functions_js'] = 'functions_login.js';
			$this->views->getView($this,"login",$data);
		}


		public function loginUser()
		{
			if($_POST)
			{
				if(empty($_POST['txtUsuario']) || empty($_POST['txtClave']))
				{
					$arrResponse = array('status' => false, 'msg' => 'Error de Datos');
				}else{
					$strUsuario = strtolower(strClean($_POST['txtUsuario']));
					$strClave = hash("SHA256",$_POST['txtClave']);
					//$strClave = strtolower(strClean($_POST['txtClave']));
					$requestUser = $this->model->loginUser($strUsuario, $strClave);
					if(empty($requestUser))
					{
						$arrResponse = array('status' => false, 'msg' => 'El usuario o clave son incorrectas');

					}else{
						$arrData = $requestUser;
						// creaccion de variables de sesion .....
						if($arrData['ESTADO'] == 1){
							$_SESSION['idUser'] = $arrData['USU_ID'];
							$_SESSION['login'] = true;

							$arrData = $this->model->sessionLogin($_SESSION['idUser']);
							$_SESSION['userData'] = $arrData;

							$arrResponse = array('status' => true, 'msg' => 'OK');
						}else{
							$arrResponse = array('status' => false, 'msg' => 'Usuario Inactivo');
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function regstd()
		{
			// Se incluye el arreglo DATA, que tiene informacion de la pagina ...
			$data['page_tag'] = 'Registro Aspirante';
			$data['page_name'] = 'registro_aspirante';
			$data['page_title'] = '';
			$data['page_functions_js'] = 'functions_regstd.js';
			$this->views->getView($this,"regstd",$data);
		}


		// Rutina para grabar data del Formulario ONLINE .......
		public function Newstd()
		{
			if($_POST)
			{
				$intStd_no 		  = intval($_POST['idStd_no']);
				$strLas_nm        = strClean($_POST['txtLas_nm']);
				$strFir_nm        = strClean($_POST['txtFir_nm']);
				$intIdtype        = intval($_POST['listIdtype']);
				$strIde_no        = strClean($_POST['txtIde_no']);
				$strAddres        = strClean($_POST['txtAddres']);
				$strTphone        = strClean($_POST['txtTphone']);
				$intStdgen        = intval($_POST['listStdgen']);
				$datFecbir        = strClean($_POST['datFecbir']);
				$strStdmai        = strClean($_POST['txtStdmai']);

				$intTt_who        = intval($_POST['listTt_who']);

				$strFatlas        = strClean($_POST['txtFatlas']);
				$strFatnam        = strClean($_POST['txtFatnam']);
				$strFatadr        = strClean($_POST['txtFatadr']);
				$strFatfon        = strClean($_POST['txtFatfon']);
				$intFatype        = intval($_POST['listFatype']);
				$strFatced        = strClean($_POST['txtFatced']);
				$strFatjob        = strClean($_POST['txtFatjob']);
				$datFatbir        = strClean($_POST['datFatbir']);
				$strFatmai        = strClean($_POST['txtFatmai']);

				$strMotlas        = strClean($_POST['txtMotlas']);
				$strMotnam        = strClean($_POST['txtMotnam']);
				$strMotadr        = strClean($_POST['txtMotadr']);
				$strMotfon        = strClean($_POST['txtMotfon']);
				$intMotype        = intval($_POST['listMotype']);
				$strMotced        = strClean($_POST['txtMotced']);
				$strMotjob        = strClean($_POST['txtMotjob']);
				$datMotbir        = strClean($_POST['datMotbir']);
				$strMotmai        = strClean($_POST['txtMotmai']);

				$strReplas        = strClean($_POST['txtReplas']);
				$strRepnam        = strClean($_POST['txtRepnam']);
				$strRepadr        = strClean($_POST['txtRepadr']);
				$strRepfon        = strClean($_POST['txtRepfon']);
				$intRetype        = intval($_POST['listRetype']);
				$strRepced        = strClean($_POST['txtRepced']);
				$strRepjob        = strClean($_POST['txtRepjob']);
				$datRepbir        = strClean($_POST['datRepbir']);
				$strRepmai        = strClean($_POST['txtRepmai']);
				$strLassch        = strClean($_POST['txtLassch']);
				$intSec_no        = intval($_POST['listSec_no']);

				require_once ("Models/VsnewstdModel.php");
	    		$objNewStd = new VsnewstdModel();
	    		$arrData = $objNewStd->insertVsnewstd($strLas_nm, $strFir_nm, $strAddres, $strTphone, $intIdtype, $strIde_no, 
	    							                  $intStdgen, $datFecbir, $strStdmai, $intTt_who, $strFatlas, $strFatnam, 
	    							                  $strFatadr, $strFatfon, $intFatype, $strFatced, $strFatjob, $datFatbir, 
	    							                  $strFatmai, $strMotlas, $strMotnam, $strMotadr, $strMotfon, $intMotype,
	    							                  $strMotced, $strMotjob, $datMotbir, $strMotmai, $strReplas, $strRepnam,
	    							                  $strRepadr, $strRepfon, $intRetype, $strRepced, $strRepjob, $datRepbir,
	    							                  $strRepmai, $strLassch, $intSec_no);

	    		if($arrData > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Aspirante guardado con éxito.');
	    		}elseif ($arrData == 'existe') {
	    			$arrResponse = array('status' => false, 'msg' => 'Aspiriante ya existe.');
	    		}else{
	    			$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
	    		}
	    		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		

		public function resetPass()
		{
			if($_POST)
			{
				error_reporting(0);
				if(empty($_POST['txtEmailReset']))
				{
					$arrResponse = array('status' => false, 'msg' => 'Error de Datos' );
				}else{
					$token = token();
					$strEmail = strtolower(strClean($_POST['txtEmailReset']));
					$intPerfil = intval($_POST['lstPerfil']);
					$arrData = $this->model->getUserEmail($strEmail,$intPerfil);
					
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Usuario no existe' );
					}else{
						if($intPerfil == 3)
						{
							$idUser = $arrData['REPCED'];
							$nmUser = $arrData['REPLAS'].' '.$arrData['REPNAM'];
						}else{
							$idUser = $arrData['IDE_NO'];
							$nmUser = $arrData['LAS_NM'].' '.$arrData['FIR_NM'];
						}

						$url_recovery = base_url().'Login/confirmUser/'.$intPerfil.'/'.$strEmail.'/'.$token;

						//Se actualiza el campo TOKEN en la base de datos .....
						$requestUpdate = $this->model->setTokenUser($idUser,$token);

						//Envio del Email ...
						$dataUsuario = array('nombreUsuario' => $nmUser,
											 'email' => $strEmail,
											 'asunto' => 'Recuperar Contraseña -'.NOMBRE_REMITENTE,
											 'url_recovery' => $url_recovery);
						
						if($requestUpdate)
						{
							$sendEmail = sendEmail($dataUsuario,'email_cambioPassword');
							if($sendEmail)
							{
								$arrResponse = array('status' => true, 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar contraseña');
							}else{
								$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde');
							}
						}else{
							$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde');
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function	confirmUser(string $params)
		{
			if(empty($params))
			{
				header('Location: '.base_url());
			}else{	
				$arrParams = explode(',',$params);

				$intPerfil = $arrParams[0];
				$strEmail = strClean($arrParams[1]);
				$strToken = strClean($arrParams[2]);

				$arrResponse = $this->model->getUsuario($intPerfil, $strEmail, $strToken);

				if(empty($arrResponse))
				{
					header('Location: '.base_url());
				}else{
					$data['page_tag'] = 'Cambiar contraseña';
					$data['page_name'] = 'cambiar_contraseña';
					$data['page_title'] = '';
					$data['idpersona'] = $arrResponse['USU_ID'];
					$data['perfil'] = $intPerfil;
					$data['email'] = $strEmail;
					$data['token'] = $strToken;
					$data['page_functions_js'] = 'functions_login.js';
					$this->views->getView($this,"cambiar_password",$data);
				}
			}
			die();	
		}


		public function setPassword()
		{
			if($_POST)
			{
				if(empty($_POST['idUsuario']) || empty($_POST['perfil']) || empty($_POST['email']) || empty($_POST['token']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm']))
				{
					$arrResponse = array('status' => false, 'msg' => 'Error de Datos');
				}else{
					$intIdusuario = strClean($_POST['idUsuario']);
					$intPerfil = intval($_POST['perfil']);
					$strEmail = strClean($_POST['email']);
					$strToken = strClean($_POST['token']);
					$strPassword = $_POST['txtPassword'];
					$strPasswordconfirm = $_POST['txtPasswordConfirm'];

					if($strPassword != $strPasswordconfirm)
					{
						$arrResponse = array('status' => false, 'msg' => 'Las contraseñas no son iguales');
					}else{
						$arrResponseUser = $this->model->getUsuario($intPerfil, $strEmail, $strToken);
						if(empty($arrResponseUser))
						{
							$arrResponse = array('status' => false, 'msg' => 'Error de Datos');
						}else{
							$strPassword = hash("SHA256",$strPassword);
							$requestPass = $this->model->updatePassword($intIdusuario,$strPassword);

							if($requestPass)
							{
								$arrResponse = array('status' => true, 'msg' => 'Contraseña actualizada con éxito');
							}else{
								$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente más tarde');
							}
						}
					}
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

	}
