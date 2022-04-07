<?php

	// Heredamos la clase: Controllers
	class Usuarios extends Controllers
	{
		public function __construct()
		{
			parent::__construct();
			session_start();
			
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(19);
		}


		public function usuarios()
		{
			if(empty($_SESSION['permisosMod']['r']))
			{
				header("location:".base_url().'Dashboard');
			}

			$data['page_tag'] 		= "Usuarios";
			$data['page_title'] 	= "Usuarios";
			$data['page_name'] 		= 'usuarios';
			$data['page_functions_js'] = "functions_usuarios.js";
			$this->views->getView($this,"usuarios",$data);
		}


		// OBTIENE UN REGISTRO
		public function getUser(int $usuSEC)
		{
			$idUsuario = intval($usuSEC);
			if($idUsuario > 0)
			{
				$arrData = $this->model->selectUsuario($idUsuario); 
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


		// EXTRAE DATA DE USUARIOS VSACCESS
		public function getUsuarios()
		{
			$arrData = $this->model->selectUsuarios();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$btnView = "";
				$btnEdit = "";
				$btnDel  = "";

				if($arrData[$i]['ESTADO'] == 1) 
				{
					$arrData[$i]['ESTADO'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['ESTADO'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				if($_SESSION['permisosMod']['r'])
				{
					$btnView = '<button class="btn btn-warning btn-sm btnViewUser" onClick="fntViewUser('.$arrData[$i]['USU_SEC'].')" title="Consultar"><i class="fas fa-eye"></i></button>';
 				}

				// Validacion del Boton Update: Solo los Superusuarios pueden hacerlo
				if($_SESSION['permisosMod']['u'])
				{
					if((($_SESSION['userData']['USU_SEC'] == 2 OR $_SESSION['userData']['USU_SEC'] == 3 ) AND $_SESSION['userData']['rol_id'] == 1) OR
					   ($_SESSION['userData']['rol_id'] == 1 AND $arrData[$i]['rol_id'] != 1))
					{
						$btnEdit= '<button class="btn btn-info btn-sm btnEditUser" onClick="fntEditUser('.$arrData[$i]['USU_SEC'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}else{
						$btnEdit= '<button class="btn btn-secondary btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>';
					}
				}

				// Validacion del boton Eliminar Usuarios: 
				// Se restringe para todos los Admins y los SuperUsuarios, para que no se puedan eliminar asi mismos

				if($_SESSION['permisosMod']['d'])
				{
					if(((($_SESSION['userData']['USU_SEC'] == 2 OR $_SESSION['userData']['USU_SEC'] == 3 ) AND $_SESSION['userData']['rol_id'] == 1) OR
					   ($_SESSION['userData']['rol_id'] == 1 AND $arrData[$i]['rol_id'] != 1)) AND
					   ($_SESSION['userData']['USU_SEC'] != $arrData[$i]['USU_SEC']))
					{
						$btnDel = '<button class="btn btn-danger btn-sm btnDelUser" onClick="fntDelUser('.$arrData[$i]['USU_SEC'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
					}else{
						$btnDel = '<button class="btn btn-secondary btn-sm" disabled><i class="fas fa-trash-alt"></i></button>';
					}
				}

				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDel.'</div>';
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function delUsuario()
		{
			$intSec = intval($_POST['idSec']);
			$request = $this->model->deleteUsuario($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}


		public function setUsuario()
		{
			$intIdSec 	  	= intval($_POST['idSec']);
			$strUsuario 	= strclean($_POST['txtUsuario']); 
			$strAlias 		= strclean($_POST['txtAlias']);
    		$strNombre 		= strclean($_POST['txtNombre']);
			$strPto_no 		= strclean($_POST['txtPto_no']);
    		$strClave 		= strclean($_POST['txtClave']);
    		$intTipousuario = intval($_POST['listRol']);
    		$intEmp 		= intval($_POST['txtEmp']);  
    		$intStatus 		= intval($_POST['listEstado']);

			if($intIdSec == 0)
			{
				// Crea un Usuario
				$opcion = 1;
				$request_user = $this->model->insertUsuario($strUsuario,$strAlias,$strNombre,$strClave,$intTipousuario,$intEmp,$strPto_no,$intStatus);
			}else{
				$opcion = 2;
				$request_user = $this->model->updateUsuario($intIdSec,$strUsuario,$strAlias,$strNombre,$strClave,$intTipousuario,$intEmp,$strPto_no,$intStatus);
			}
					
			if($request_user > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Usuario guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Usuario actualizado con éxito.');
						break;
				}
    		}else if ($request_user == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Usuario ya existe.');
			}else if ($request_user == -2){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Tipo de Usuario debe ser generado automáticamente.');
			}else{
    			$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		// Actualiza VSACCESS con registros de VSEMPLOX y VSTUDENT
		public function saveUsers()
		{
			// OBTIENE TABLA VSEMPLOX PERSONAL
			$sql 				= "SELECT IDE_NO,LAS_NM,FIR_NM,EMP_NO,PROFIL FROM vsemplox WHERE ESTATU = 1";
			$request_vsemplox 	= $this->model->searchUsers($sql,'all');

			for ($i = 0; $i < count($request_vsemplox); $i++) 
			{
				// REGISTRA USUARIO DE PERSONAL
				$this->IntProfil 	= $request_vsemplox[$i]['PROFIL'];
				$this->IntUsu_no 	= $request_vsemplox[$i]['EMP_NO'];
				$insert 			= "INSERT INTO vsaccess(USU_ID,ALI_NO,USU_NM,USU_PAS,USU_ROL,USU_NO,PTO_NO,ESTADO) VALUES(?,?,?,?,?,?,?,?)";
				$update				= "UPDATE vsaccess SET USU_ID = ?, ALI_NO = ?, USU_NM = ?, USU_PAS = ?, USU_ROL = ?, USU_NO = ?, PTO_NO = ?, ESTADO = ? WHERE USU_ROL = {$this->IntProfil} AND USU_NO = '{$this->IntUsu_no}'";

				$arrData = array($request_vsemplox[$i]['IDE_NO'],$request_vsemplox[$i]['LAS_NM'],$request_vsemplox[$i]['LAS_NM']." ".$request_vsemplox[$i]['FIR_NM'],hash("SHA256",$request_vsemplox[$i]['IDE_NO']),$request_vsemplox[$i]['PROFIL'],$request_vsemplox[$i]['EMP_NO'],"",1);

				// SI CEDULA EXISTE LA ACTUALIZA
				$Ide_no 			= $request_vsemplox[$i]['IDE_NO'];
				$sql 				= "SELECT USU_ID FROM vsaccess WHERE USU_ROL = {$this->IntProfil} AND USU_NO = '{$this->IntUsu_no}'";
				$request_user 		= $this->model->searchUsers($sql,'one');
				if(empty($request_user) and !empty($Ide_no) and $Ide_no != "0")
				{
					$request_insert = $this->model->grabarUsers($insert,$arrData,$this->IntProfil,$this->IntUsu_no,1);
				}else{
					$request_insert = $this->model->grabarUsers($update,$arrData,$this->IntProfil,$this->IntUsu_no,2);
				}
			}
			$return  = $request_insert;


			// OBTIENE TABLA VSTUDENT ESTUDIANTES
			$sql 				= "SELECT IDE_NO,LAS_NM,FIR_NM,REPCED,REPLAS,REPNAM,STD_NO FROM vstudent WHERE ESTATU = 2";
			$request_vstudent 	= $this->model->searchUsers($sql,'all');

			for ($i = 0; $i < count($request_vstudent); $i++) 
			{
				// REGISTRA USUARIO DE ESTUDIANTE
				$this->IntProfil 	= 7;
				$this->IntUsu_no 	= $request_vstudent[$i]['STD_NO'];
				$insert 			= "INSERT INTO vsaccess(USU_ID,ALI_NO,USU_NM,USU_PAS,USU_ROL,USU_NO,PTO_NO,ESTADO) VALUES(?,?,?,?,?,?,?,?)";
				$update				= "UPDATE vsaccess SET USU_ID = ?, ALI_NO = ?, USU_NM = ?, USU_PAS = ?, USU_ROL = ?, USU_NO = ?, PTO_NO = ?, ESTADO = ? WHERE USU_ROL = {$this->IntProfil} AND USU_NO = '{$this->IntUsu_no}'";
				$arrData 			= array($request_vstudent[$i]['IDE_NO'],$request_vstudent[$i]['LAS_NM'],$request_vstudent[$i]['LAS_NM']." ".$request_vstudent[$i]['FIR_NM'],hash("SHA256",$request_vstudent[$i]['IDE_NO']),7,$request_vstudent[$i]['STD_NO'],"",1);

				// SI CEDULA EXISTE LA ACTUALIZA
				$Ide_no 		= $request_vstudent[$i]['IDE_NO'];
				$sql 			= "SELECT USU_ID FROM vsaccess WHERE USU_ROL = {$this->IntProfil} AND USU_NO = '{$this->IntUsu_no}'";
				$request_user 	= $this->model->searchUsers($sql,'one');
				if(empty($request_user) and !empty($Ide_no) and $Ide_no != "0")
				{
					$request_insert = $this->model->grabarUsers($insert,$arrData,$this->IntProfil,$this->IntUsu_no,1);
				}else{
					$request_insert = $this->model->grabarUsers($update,$arrData,$this->IntProfil,$this->IntUsu_no,2);
				}
			}


			for ($i = 0; $i < count($request_vstudent); $i++) 
			{
				// REGISTRA USUARIO DE REPRESENTANTE
				$this->IntProfil 	= 8;
				$insert 	= "INSERT INTO vsaccess(USU_ID,ALI_NO,USU_NM,USU_PAS,USU_ROL,USU_NO,PTO_NO,ESTADO) VALUES(?,?,?,?,?,?,?,?)";
				$arrData 	= array($request_vstudent[$i]['REPCED'],$request_vstudent[$i]['REPLAS'],$request_vstudent[$i]['REPLAS']." ".$request_vstudent[$i]['REPNAM'],hash("SHA256",$request_vstudent[$i]['REPCED']),8,$request_vstudent[$i]['STD_NO'],"",1);

				// SI CEDULA EXISTE LA ACTUALIZA
				$Ide_no 		= $request_vstudent[$i]['REPCED'];
				$sql 			= "SELECT USU_ID FROM vsaccess WHERE USU_ID = '{$Ide_no}'";
				$request_user 	= $this->model->searchUsers($sql,'one');
				if(empty($request_user) and !empty($Ide_no) and $Ide_no != "0")
				{
					$request_insert = $this->model->grabarUsers($insert,$arrData,$this->IntProfil,0,1);
				}
			}
			$return  = $request_insert;
			die();
		}		
	}
