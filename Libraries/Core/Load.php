<?php

	// -- Archivo Load.php 
	// ++ la funcion: ucwords convierte la primera letra en mayuscula
	$controller = ucwords($controller);
	$controllerfile = 'Controllers/'.$controller.'.php';
	// Validacion del archivo controlador 
	if(file_exists($controllerfile)){
		require_once($controllerfile);
		$controller = new $controller();

		// Validacion del Método
		if(method_exists($controller, $method)){
			$controller->{$method}($params);
		}else{
			//echo "No existe el método: ".$method;	
			require_once("Controllers/Error.php");
		}

	}else{
		//echo "No existe controlador: ".$controllerfile;
		require_once("Controllers/Error.php");
	}