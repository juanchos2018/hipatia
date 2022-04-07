<?php
	// Heredamos la clase: Controllers
	class Errores extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function notFound(){
			$this->views->getView($this,"error");
		}
	}

	$msg = new Errores();
	$msg->notFound();