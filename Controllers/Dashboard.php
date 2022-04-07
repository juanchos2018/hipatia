<?php

	// Heredamos la clase: Controllers
	class Dashboard extends Controllers
	{

		public function __construct()
		{
			parent::__construct();

			session_start();
			
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(1);
		}

		public function dashboard()
		{
			// Se calcula numero de registros para:
			// * Ficha Estudiantil
			// * Ficha Personal
			// * Malla Curricular
			// * Historia Social
			// * Historia Clinica
			// Los numeros de registros se muestran em el DASHBOARD
			$sec = $this->model->num_section();
			$mat = $this->model->num_matter();
			$asp = $this->model->num_stdasp();
			$std = $this->model->num_student();
			$per = $this->model->num_personal();
            $cur = $this->model->num_malla();
            $soc = $this->model->num_hsocial();
            $cli = $this->model->num_hclinica(); 

            // Se incluye el arreglo DATA, que tiene informacion de la pagina ...
			$data['page_tag'] 		= 'Académico';
			$data['page_title'] 	= 'Académico';
			$data['page_name'] 		= 'Académico';
			$data['reg_section'] 	= $sec['COUNT(*)'];
			$data['reg_matter'] 	= $mat['COUNT(*)'];
			$data['reg_stdasp'] 	= $asp['COUNT(*)'];
			$data['reg_student'] 	= $std['COUNT(*)'];
			$data['reg_personal'] 	= $per['COUNT(*)'];
			$data['reg_mallac'] 	= $cur['COUNT(*)'];
			$data['reg_hsocial'] 	= $soc['COUNT(*)'];
			$data['reg_hclinica'] 	= $cli['COUNT(*)'];
			
			$this->views->getView($this,"dashboard",$data);
		}
	}