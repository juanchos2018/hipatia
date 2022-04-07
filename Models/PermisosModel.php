<?php

	class PermisosModel extends Mysql
	{

		public $intIdpermiso;
		public $intRolid;
		public $intModuloid;
		public $r;
		public $w;
		public $u;
		public $d;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectModulos()
		{
			$sql = "SELECT * FROM vsmodul WHERE estado = 1";
			$request = $this->select_all($sql);
			return $request;
		} 


		// Extrae los permisos por modulo ......
		public function permisosModulo(int $idRol)
		{
			$this->intRolid = $idRol;
			$sql = "SELECT p.rolid,
			               p.moduloid,
			               m.nombre as modulo,
			               p.r,
			               p.w,
			               p.u,
			               p.d
			        FROM vspermisos p
			        INNER JOIN vsmodul m
			        ON p.moduloid = m.idmodulo
			        WHERE p.rolid = {$this->intRolid}";
			$request = $this->select_all($sql);
			$arrPermisos = array();
			for($i=0; $i < count($request); $i++)
			{
				$arrPermisos[$request[$i]['moduloid']] = $request[$i];
			}
			return $arrPermisos;
		}


		public function selectPermisosRol(int $idRol)
		{
			$this->intRolid = $idRol;
			$sql = "SELECT * FROM vspermisos WHERE rolid = {$this->intRolid}";
			$request = $this->select_all($sql);
			return $request;
		}


		public function deletePermisos(int $idRol)
		{
			$this->intRolid = $idRol;
			$sql = "DELETE FROM vspermisos WHERE rolid = {$this->intRolid}";
			$request = $this->delete($sql);
			return $request;
		}

		
		public function insertPermisos(int $idrol,int $idmodulo,int $r,int $w,int $u,int $d)
		{
			$request_insert = "";

			$this->intRolid = $idrol;
			$this->intModuloid = $idmodulo;
			$this->r = $r;
			$this->w = $w;
			$this->u = $u;
			$this->d = $d;

			$query_insert = "INSERT INTO vspermisos(rolid,moduloid,r,w,u,d) VALUES(?,?,?,?,?,?)";		
			$arrData = array($this->intRolid, $this->intModuloid, $this->r, $this->w, $this->u, $this->d);
			$request_insert = $this->insert($query_insert,$arrData);
			return $request_insert;
		}
	}
	