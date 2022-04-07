<?php

	class DTEmpresaModel extends Mysql
	{

		public function __construct(){

			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function datosEmpresa()
		{
			$sql = "SELECT * FROM vsdefaul";
			$request = $this->select($sql);
			return $request;
		}
	}