<?php

	// Heredamos la clase: Controllers
	class Roles extends Controllers{

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


		public function Roles(){
			if(empty($_SESSION['permisosMod']['r'])){
				header("location:".base_url().'Dashboard');
			}

			$data['page_tag'] 	= 'Roles Usuario';
			$data['page_name'] 	= 'rol_usuario';
			$data['page_title'] = 'Roles de Usuario';
			$data['page_functions_js'] = "functions_roles.js";
			$this->views->getView($this,"roles",$data);
		}


		public function getRoles()
		{
			$arrData = $this->model->selectRoles();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				// Se crean variables para restringir acceso a los botones ..
				$btnPermiso = "";
				$btnEditRol = "";
				$btnDelRol = "";

				if($arrData[$i]['rol_status'] == 1) {
					$arrData[$i]['rol_status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['rol_status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				if($_SESSION['permisosMod']['u'])
				{
					$btnPermiso = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisosRol('.$arrData[$i]['rol_id'].')" title="Permisos"><i class="fas fa-key"></i></button>';
					$btnEditRol= '<button class="btn btn-info btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['rol_id'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				if($_SESSION['permisosMod']['d'])
				{
					$btnDelRol = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['rol_id'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center">'.$btnPermiso.''.$btnEditRol.' '.$btnDelRol.'</div>';
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// OBTIENE UN REGISTRO
		public function getRol(int $idRol)
		{
			$intRol = intval(strClean($idRol));
			if($intRol > 0)
			{
				$arrData = $this->model->selectRol($intRol);
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


		public function setRol()
		{
			$intIdRol 		= intval($_POST['idRol']);
			$strRol 		= strClean($_POST['txtNombre']);
			$strDescripcion = strClean($_POST['txtDescripcion']);
			$intStatus 		= intval($_POST['listStatus']);

			if($intIdRol == 0)
			{
				// Crea un Rol
				$request_rol = $this->model->insertRol($strRol,$strDescripcion,$intStatus);
				$opcion = 1;
			}else{
				$request_rol = $this->model->updateRol($intIdRol,$strRol,$strDescripcion,$intStatus);
				$opcion = 2;
			}

			if($request_rol > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados con éxito.');
						break;
					default:
						$arrResponse = array('status' => true, 'msg' => 'Datos actualizados con éxito.');
						break;
				}

			}else if($request_rol == 'existe'){
				$arrResponse = array('status' => false, 'msg' => 'Atención!, el Rol ya existe');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}


		// Extraer Roles para el ComboList
		public function getSelectRoles()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.' - - - - - - - - - - - - - - - - - - - - '.'</option>';

			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.trim($arrData[$i]['rol_id']).'">'.$arrData[$i]['rol_name'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		public function delRol()
		{
			$intIdRol = intval($_POST['idrol']);
			$request = $this->model->deleteRol($intIdRol);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
			}else if($request == 'exist'){
				$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}
	}
