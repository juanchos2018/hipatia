<?php

	class PauloFreireModel extends Mysql
	{

		private $strUsuario;
		private $intPerfil;
		private $strClave;
		private $strEmail;
		private $strToken;

		public function __construct(){

			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function loginUser(string $usuario, string $password)
		{
			$this->strUsuario = $usuario;
			$this->strClave = $password;

			$sql 		= "SELECT USU_ID, ESTADO FROM vsaccess WHERE USU_ID = '{$this->strUsuario}' AND USU_PAS = '{$this->strClave}' AND ESTADO = 1";
			$request 	= $this->select($sql);
			return $request;
		}


		public function sessionLogin(string $idUser)
		{
			$this->strUsuario = $idUser;
			
			// Buscamos el Rol del Usuario .....
			$sql = "SELECT u.USU_SEC,
						   u.USU_ID,
						   u.ALI_NO,
			               u.USU_NM,
						   u.USU_NO,
			               r.rol_id,
			               r.rol_name,
			               u.PTO_NO,
			               u.ESTADO
			        FROM vsaccess u
			        INNER JOIN vsrolusr r
			        ON u.USU_ROL = r.rol_id
			        WHERE u.USU_ID = '$this->strUsuario'";
			$request = $this->select($sql);
			return $request;
		}


		public function	getUserEmail(string $strEmail, int $perfil)
		{
			$this->strUsuario = $strEmail;
			$this->intPerfil = $perfil;
			$sql = "";
			switch ($this->intPerfil) 
			{
				case 1: //Estudiante - table: VSTUDENT
					$sql = "SELECT IDE_NO,LAS_NM,FIR_NM FROM vstudent WHERE STDMAI = '$this->strUsuario'";
					break;
				case 2: //Profesor - table: VSEMPLOX
					$sql = "SELECT IDE_NO,LAS_NM,FIR_NM FROM vsemplox WHERE EMPMAI = '$this->strUsuario'";
					break;
				case 3: //Representante - table: VSTUDENT
					$sql = "SELECT REPCED,REPLAS,REPNAM FROM vstudent WHERE REPMAI = '$this->strUsuario'";
				    break;
			}
			$request = $this->select($sql);
			return $request;
		}


		public function	setTokenUser(string $idUser, string $token)
		{
			$this->strUsuario = $idUser;
			$this->strToken = $token;

			$sql 		= "UPDATE vsaccess SET TOKEN = ? WHERE USU_ID = '{$this->strUsuario}'";
			$arrData 	= array($this->strToken);
			$request 	= $this->update($sql,$arrData);
			return $request;
		}


		public function getUsuario(int $perfil, string $email, string $token)
		{
			$this->intPerfil = $perfil;
			$this->strEmail = $email;
			$this->strToken = $token;
			$sql = "";
			$request = "";

			//Validación del Email:
			switch ($this->intPerfil) 
			{
				case 1: //Estudiante
					$sql = "SELECT IDE_NO as idUser FROM vstudent WHERE STDMAI = '$this->strEmail'";
					break;
				case 2: //Empleado
					$sql = "SELECT IDE_NO as idUser FROM vsemplox WHERE EMPMAI = '$this->strEmail'";
					break;
				case 3: //Representante
					$sql = "SELECT REPCED as idUser FROM vstudent WHERE REPMAI = '$this->strEmail'";
					break;
				default:
					return $request;
					break;
			}

			$request_email 		= $this->select($sql);
			$this->strUsuario 	= $request_email['idUser'];
			if(!empty($request_email['idUser']))
			{
				$sql 	= "SELECT USU_ID FROM vsaccess WHERE USU_ID = '{$this->strUsuario}' AND TOKEN = '{$this->strToken}' AND ESTADO = 1";
				$request = $this->select($sql);
				return $request;	
			}else{
				return $request;
			}
		}


		public function updatePassword(string $idUser, string $password)
		{
			$this->strUsuario = $idUser;
			$this->strClave = $password;

			$sql 		= "UPDATE vsaccess SET USU_PAS = ?, TOKEN = ? WHERE USU_ID = '$this->strUsuario'";
			$arrData 	= array($this->strClave,"");
			$request 	= $this->update($sql,$arrData);
			return $request;
		}
	}
	