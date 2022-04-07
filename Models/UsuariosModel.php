<?php

	class UsuariosModel extends Mysql
	{
		private $intIdusuario;
		private $strUsuario;
		private $strAlias;
		private $strNombre;
		private $strClave;
		private $strToken;
		private $intTipousuario;
		private $intEmp;
		private $strPto_no;
		private $strSucursal;
		private $intStatus;
		

		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


   		// OBTIENE INFORMACION DE UN USUARIO
   		public function selectUsuario(int $idUsuario)
   		{
   			$this->intIdusuario = $idUsuario;
   			$sql = "SELECT v.USU_SEC,v.USU_ID,v.ALI_NO,v.USU_NM,v.USU_PAS,r.rol_name,v.PTO_NO,v.USU_NO,v.ESTADO,v.TOKEN,DATE_FORMAT(v.DATECREATED, '%Y-%m-%d') as Fecha_registro
			        FROM vsaccess v
			        INNER JOIN vsrolusr r
			        ON v.USU_ROL = r.rol_id
			        WHERE v.USU_SEC = $this->intIdusuario";
   			$request = $this->select($sql);
   			return $request;
   		}


		// OBTIENE TODOS LOS USUARIOS
   		public function selectUsuarios()
		{
			$whereAdmin = "";  
			if($_SESSION['userData']['USU_SEC'] !=2 AND $_SESSION['userData']['USU_SEC'] !=3 )
			{
				$whereAdmin = " AND v.USU_SEC != 2 AND v.USU_SEC != 3 ORDER BY v.USU_NM";
			}else{
				$whereAdmin = " ORDER BY v.USU_NM";
			}

			$sql = "SELECT v.USU_SEC,v.USU_ID,v.USU_NM,r.rol_id,r.rol_name,v.ESTADO
			        FROM vsaccess v
			        INNER JOIN vsrolusr r
			        ON v.USU_ROL = r.rol_id
			        WHERE v.ESTADO != 0".$whereAdmin;
			$request = $this->select_all($sql);
			return $request;
		}


		// BUSCA UN USUARIO
		public function searchUsers(string $sql, string $quantity)
		{
			$this->Intquery	= $sql;
			$this->Quantity	= $quantity;
			if($this->Quantity == 'one')
			{
				$request_users 	= $this->select($this->Intquery);
			}else{
				$request_users 	= $this->select_all($this->Intquery);
			}
			return $request_users;
		}


		// GRABA USUARIO
		public function grabarUsers(string $insert, array $Data, int $profil, int $usu_no, int $flag)
		{
			$query_insert 		= $insert;
			$arrData 			= $Data;
			$query_type     	= $flag;
			$this->IntProfil 	= $profil;
			$this->IntUsu_no 	= $usu_no;
			if($query_type == 1)
			{
				$request 		= $this->insert($query_insert,$arrData);
			}else{
				$request 		= $this->update($query_insert,$arrData);
			}
			return $request;
		}


		// ELIMINA UN USUARIO
		public function deleteUsuario(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "DELETE FROM vsaccess WHERE USU_SEC = {$this->intSec_id}";
			$request 	= $this->delete($sql);
			if($request)
			{
				$request = 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}


		// INSERTA UN USUARIO
		public function insertUsuario(string $Usuario, string $Alias, string $Nombre, string $Clave, int $Tipousuario, int $Emp, string $pto_no, int $Status)
		{
			$this->strUsuario 		= $Usuario;
			$this->strAlias 		= $Alias;
			$this->strNombre 		= $Nombre;
			$this->strClave 		= hash("SHA256",$Clave);
			$this->intTipousuario 	= $Tipousuario;
			$this->intEmp 			= $Emp;
			$this->strPto_no 		= $pto_no;
			$this->intStatus 		= $Status;

			if($this->intTipousuario == 2 OR $this->intTipousuario == 3 OR $this->intTipousuario == 4 OR $this->intTipousuario == 5 OR $this->intTipousuario == 6 OR $this->intTipousuario == 7 OR $this->intTipousuario == 9)
			{
				// TIPO DE USUARIO ES AUTOMATICO
				$return = -2;
				return $return;
			}

			$sql 		= "SELECT * FROM vsaccess WHERE USU_ID = '{$this->strUsuario}' or USU_NM = '{$this->strNombre}'";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$query_insert 	= "INSERT INTO vsaccess(USU_ID,ALI_NO,USU_NM,USU_PAS,USU_ROL,USU_NO,PTO_NO,ESTADO) VALUES(?,?,?,?,?,?,?,?)";
				$arrData 		= array($this->strUsuario,$this->strAlias,$this->strNombre,$this->strClave,$this->intTipousuario,$this->intEmp,$this->strPto_no,$this->intStatus);
				$request_insert = $this->insert($query_insert,$arrData);
				$return 		= $request_insert;
			}else{
				$return = -1;
			}
			return $return;
		}


		// ACTUALIZA UN USUARIO
		public function updateUsuario(int $Idsec, string $Usuario, string $Alias, string $Nombre, string $Clave, int $Tipousuario, int $Emp, string $pto_no, int $Status)
		{
			$this->intIdSec			= $Idsec;
			$this->strUsuario 		= $Usuario;
			$this->strAlias			= $Alias;
			$this->strNombre 		= $Nombre;
			$this->strClave 		= $Clave;
			$this->intTipousuario 	= $Tipousuario;
			$this->intEmp 			= $Emp;
			$this->strPto_no 		= $pto_no;
			$this->intStatus 		= $Status;

			$sql 		= "SELECT * FROM vsaccess WHERE USU_NM = '{$this->strNombre}' AND USU_ID != '{$this->strUsuario}'";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$query_insert 	= "UPDATE vsaccess SET USU_ID = ?, ALI_NO = ?, USU_NM = ?, USU_PAS = ?, USU_ROL = ?, PTO_NO = ?, ESTADO = ? WHERE USU_SEC = {$this->intIdSec}";
				$arrData 		= array($this->strUsuario,$this->strAlias,$this->strNombre,$this->strClave,$this->intTipousuario,$this->strPto_no,$this->intStatus);
				$request_insert = $this->update($query_insert,$arrData);
				$return 		= $request_insert;
			}else{
				$return = -1;
			}
			return $return;
		}
	}
