<?php

// invierte cadena de caracteres
function vsstring($cadena)
{
	$cadenaInvertida = "";
	for($i = strlen($cadena) - 1; $i <= 0;$i--)
	{
		$cadenaInvertida = $cadenaInvertida . substr($cadena,$i,1);
	}

	return $cadenaInvertida;
}

// Obtiene suma de digitos .....
function vsgetsum($cadena)
{
	$pivote = 2;
	$totalcan = 0;
	$b = 1;
	$charlen = strlen($cadena);
	for($i=0; $i<$charlen; $i++)
	{
		if($pivote ==8)
		{
			$pivote = 2;
		}
		$temporal = intval(substr($cadena,$i,1));
		$b = $b + 1;
		$temporal = $temporal * $pivote;
		$pivote = $pivote + 1;
		$totalcan = $totalcan + $temporal;
	}

	$totalcan = 11 - $totalcan % 11;
	return $totalcan;
}

// Obtiene el Módulo 11 en la Clave de Acceso para Facturación Electrónica .....
function vsgetdig($clave_acceso)
{
	$digito = vsgetsum(vsstring($clave_acceso));
	switch ($digito) {
		case 11:
			$clave = $clave_acceso."0";
			break;
		case 10:
			$clave = $clave_acceso."1";
			break;
		default:
			$clave = $clave_acceso.$digito;
			break;
	}
	return $clave;	
}

?>