<?php

	// Heredamos la clase: Controllers
	class Home extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function home(){
			// Se incluye el arreglo DATA, que tiene informacion de la pagina ...
			$data['page_id'] 		= 1;
			$data['page_tag'] 		= 'Appi';
			$data['page_title'] 	= 'Página Principal - Bienvenido';
			$data['page_name'] 		= 'home';
			$data['page_content'] 	= 'Lorem ipsum dolor, sit amet consectetur, adipisicing elit.';
			$this->views->getView($this,"home",$data);
		}

/*
		public function datos($params){
			echo "Datos recibidos: ".$params;
		}

		public function carrito($params){
			$carrito = $this->model->getCarrito($params);
			echo $carrito;
		}

		public function insertar()
		{
			$data = $this->model->setUser("Maria",50);
			print_r($data);
		}

		public function verusuario($id)
		{
			$data = $this->model->getUser($id);
			print_r($data);
		}

		public function actualizar()
		{

			$data = $this->model->updateUser(2,"Pepe",10);
			print_r($data);
		}

		public function verUsuarios()
		{

			$data = $this->model->getUsers();
			print_r($data);
		}

		public function eliminarUsuario($id)
		{
			$data = $this->model->delUser($id);
			print_r($data);

		}
	*/

	}