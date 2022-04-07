<?php

	// Heredamos la clase: Controllers
	class Dashacoun extends Controllers{

		public function __construct(){
			parent::__construct();

			session_start();
			
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			//getPermisos(1);
		}

		public function dashacoun(){
			// Se incluye el arreglo DATA, que tiene informacion de la pagina ...
			$data['page_id'] 	= 2;
			$data['page_tag'] 	= 'Financiero';
			$data['page_title'] = 'Financiero';
			$data['page_name'] 	= 'Financiero';
			$this->views->getView($this,"dashacoun",$data);
		}
	}