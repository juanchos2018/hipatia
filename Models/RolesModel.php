<?php

	class RolesModel extends Mysql
	{

		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;


		public function __construct(){

			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectRoles()
		{
			// Filtramos la Busqueda del Rol: "System Manager" , solo para el superUsuario ...
			$whereAdmin = "";
			if($_SESSION['userData']['USU_SEC'] != 2 AND $_SESSION['userData']['USU_SEC'] != 3)
			{
				$whereAdmin = " and rol_id != 1";
			}

			// Extrae Roles .....
			$sql = "SELECT * FROM vsrolusr WHERE rol_status != 0".$whereAdmin;
			$request = $this->select_all($sql);
			return $request;
		}


		// Selecciona un Rol especifico
		public function selectRol(int $idRol)
		{
			$this->intIdrol = $idRol;
			$sql = "SELECT * FROM vsrolusr WHERE rol_id = {$this->intIdrol}";
			$request = $this->select($sql);
			return $request;
		}


		public function insertRol(string $rol, string $descripcion, int $status)
		{
			$return = "";
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM vsrolusr WHERE rol_name = '{$this->strRol}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$insert = "INSERT INTO vsrolusr(rol_name,rol_description,rol_status) VALUES(?,?,?)";
				$arrData = array($this->strRol,$this->strDescripcion,$this->intStatus);
				$request_insert = $this->insert($insert,$arrData);
				$return = $request_insert;
			}else{
				$return = 'existe';
			}
			return $return;
		}


		public function updateRol(int $idRol,string $rol, string $descripcion, int $status)
		{
			$this->intIdrol = $idRol;
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM vsrolusr WHERE rol_name = '$this->strRol' AND rol_id != $this->intIdrol";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE vsrolusr SET rol_name = ?, rol_description = ?, rol_status = ? WHERE rol_id = {$this->intIdrol}";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		}


		public function deleteRol(int $idRol)
		{
			$this->intIdrol = $idRol;
			$sql = "SELECT * FROM vsaccess WHERE USU_ROL = $this->intIdrol";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE vsrolusr SET rol_status = ? WHERE rol_id = {$this->intIdrol}";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}
	}
	