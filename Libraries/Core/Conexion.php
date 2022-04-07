<?php

class Conexion{
		private $conecta;
			
		public function __construct(){
			$connectionString="mysql:host=".DB_HOST.";dbname=".DB_NAME.";.DB_CHARSET.";
		
			try{
				$this->conecta = new PDO($connectionString,DB_USER,DB_PASSWORD);
				$this->conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//echo "conexion exitosa, OK";
			}catch(PDOException $e) {
				$this->conecta = 'Error de conexión';
				echo "ERROR en Conexion: ".$e->getMessage();
			}
		}

		public function conecta(){
			return $this->conecta;
		}
}

	