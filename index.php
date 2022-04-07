<?php

	require_once("Config/Config.php");
	require_once("Helpers/Helpers.php");

	$ruta = !empty($_GET['ruta']) ? $_GET['ruta'] : 'Login/login';

	// convertir a la variable ruta en un arreglo
	$arrRuta = explode("/", $ruta);
	$controller = $arrRuta[0];
	$method = $arrRuta[0];
	$params = "";

	// validacion de controlador y metodo ......
	if(!empty($arrRuta[1]))
	{
		if($arrRuta[1] != ""){
			$method = $arrRuta[1];
		}
	}

	// validacion de parametros .....
	if(!empty($arrRuta[2])){
		if($arrRuta[2] != ""){
			for($i=2; $i < count($arrRuta); $i++){
				$params .= $arrRuta[$i].','; 
			}
			$params = trim($params,',');
		}
	}

	require_once("Libraries/Core/Autoload.php");
	require_once("Libraries/Core/Load.php");
	
	/*
	echo "<br>";
	echo "controlador: ".$controller;
	echo "<br>";
	echo "metodo: ".$method;
	echo "<br>";
	echo "parametros: ".$params;
	*/


