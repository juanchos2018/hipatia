<?php

	//Base_URL
	function base_url()
	{
		return BASE_URL;
	}


	// Restaura la url de Assets
	function media()
	{
		return BASE_URL.'Assets/';
	}


	// Convierte números a letras .....
	function numtoletter($numero)
	{
		require_once ("Helpers/conversor.php");
		$resultado = convertir($numero);
		return $resultado;
	}

	
	// HeaderAdmin
	function headerAdmin($data="")
	{
		$view_header = "Views/Template/header_admin.php";
		require_once($view_header);
	}


	function footerAdmin($data="")
	{
		$view_footer = "Views/Template/footer_admin.php";
		require_once($view_footer);
	}


	function numAut($cadena)
	{
		require_once ("Helpers/numAuthorization.php");
		$resultado = vsgetdig($cadena);
		return $resultado;
	}


	// Para subir archivos al Servidor 
	function uploadFILE(array $dataFile, string $nameFile,string $codAMIE , string $periodo, int $opcion)
	{
		$url_temp = $dataFile['tmp_name'];
		if($opcion == 1)
		{
			$destino = 'Activity/'.$codAMIE.'/'.$periodo.'/dwload/'.$nameFile;	
		} else{
			$destino = 'Activity/'.$codAMIE.'/'.$periodo.'/upload/'.$nameFile;
		}
		
		$move = move_uploaded_file($url_temp, $destino);
		return $move;
	}


	// Obtener datos de la empresa
	function datos_empresa()
	{
		require_once ("Models/DTEmpresaModel.php");
		$objEmpresa = new DTEmpresaModel();
		$datEmpresa = $objEmpresa->datosEmpresa();
		return $datEmpresa;
	}


	// Muestra los arrays de forma formateada
	function dep($data)
	{
		$format = print_r('<pre>');
		$format = print_r($data);
		$format = print_r('</pre>');
		return $format;
	}


	function getModal(string $nameModal, $data)
	{
		$view_modal = "Views/Template/Modals/{$nameModal}.php";
		require_once $view_modal;
	}


	function getPermisos(int $idModulo)
	{
		require_once ("Models/PermisosModel.php");
		$objPermisos = new PermisosModel();
		$idRol = $_SESSION['userData']['rol_id'];
		$arrPermisos = $objPermisos->permisosModulo($idRol);
		$permisos = '';
		$permisosMod = '';
		if(count($arrPermisos) > 0)
		{
			$permisos = $arrPermisos;
			$permisosMod = isset($arrPermisos[$idModulo]) ? $arrPermisos[$idModulo] : "";
		}
		$_SESSION['permisos'] = $permisos;
		$_SESSION['permisosMod'] = $permisosMod;
	}


	//Envio de correos
    function sendEmail($data,$template)
    {
        $asunto = $data['asunto'];
        $emailDestino = $data['email'];
        $empresa = NOMBRE_REMITENTE;
        $remitente = EMAIL_REMITENTE;
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$empresa} <{$remitente}>\r\n";
        ob_start();
        require_once("Views/Template/Email/".$template.".php");
        $mensaje = ob_get_clean();
        $send = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    }


	// Limpiar una cadena
	function strClean($strCadena)
	{
		$cadena=preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
		$cadena=trim($cadena); //elimina espacios en blanco al inicio y al final
		$cadena=stripslashes($cadena); // elimina los \ invertidos
		$cadena=str_ireplace("<script>","",$cadena);
		$cadena=str_ireplace("</script>","",$cadena);
		$cadena=str_ireplace("<script src>","",$cadena);
		$cadena=str_ireplace("<script type=>","",$cadena);
		$cadena=str_ireplace("SELECT * FROM","",$cadena);
		$cadena=str_ireplace("DELETE FROM","",$cadena);
		$cadena=str_ireplace("INSERT INTO","",$cadena);
		$cadena=str_ireplace("SELECT COUNT(*) FROM","",$cadena);
		$cadena=str_ireplace("DROP TABLE","",$cadena);
		$cadena=str_ireplace("DROP DATABASE","",$cadena);
		$cadena=str_ireplace("TRUNCATE TABLE","",$cadena);
		$cadena=str_ireplace("SHOW TABLES","",$cadena);
		$cadena=str_ireplace("SHOW DATABASES","",$cadena);
		$cadena=str_ireplace("<?php","",$cadena);
		$cadena=str_ireplace("?>","",$cadena);
		$cadena=str_ireplace("--","",$cadena);
		$cadena=str_ireplace(">","",$cadena);
		$cadena=str_ireplace("<","",$cadena);
		$cadena=str_ireplace("[","",$cadena);
		$cadena=str_ireplace("]","",$cadena);
		$cadena=str_ireplace("^","",$cadena);
		$cadena=str_ireplace("==","",$cadena);
		$cadena=str_ireplace(";","",$cadena);
		$cadena=str_ireplace("::","",$cadena);
		return $cadena;
	}


	//Genera una contraseña de 15 caracteres .....
	function passGenerator($length = 15)
	{
		$pass = "";
		$longitudPass = $length;
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890()*+$%&=";
		$longitudCadena = strlen($cadena);
		for($i=1;$i<=$longitudPass;$i++)
		{
			$pos = rand(0,$longitudCadena-1);
			$pass .= substr($cadena,$pos,1);
		}
		return $pass;
	}


	// Genera token, usado para restablecer contraseñas
	function token()
	{
		$r1 = bin2hex(random_bytes(10));
		$r2 = bin2hex(random_bytes(10));
		$r3 = bin2hex(random_bytes(10));
		$r4 = bin2hex(random_bytes(10));
		$token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
		return $token;
	}


	// Formato para valores monetarios 
	function formatMoney($cantidad)
	{
		$cantidad = number_format($cantidad,2,SPD,SPM);
		return $cantidad;
	}
