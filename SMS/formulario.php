<?php
//require_once("../DataBase/Acceso.php");
//$acceso=conexion();
/*if($acceso)
{
*/
	session_start();
	$valor=explode("=@",$_POST['d']);
	$clase=$valor[0];
	if($_SESSION["autenticacion"]!="On"){
		if($clase=='Sesion')
			include "Formulario/Sesion.php";
		else
			echo "SecurityFalse";
	}
	else{
		switch($clase)
		{
			
			case sms:
				include "Formulario/sms.php";
				break;
			case envio_aut:
				include "Formulario/envio_aut.php";
				break;
			case comandos_sms:
				include "Formulario/comandos_sms.php";
				break;
			case formato_sms:
				include "Formulario/formato_sms.php";
				break;
			case config_sms:
				include "Formulario/config_sms.php";
				break;
			case gerentes_permitidos:
				include "Formulario/gerentes_permitidos.php";
				break;
			case variables_sms:
				include "Formulario/variables_sms.php";
				break;
			case otros_datos:
				include "Formulario/otros_datos.php";
				break;
			case familia:
				include "Formulario/familia.php";
				break;
			default:
				include "Formulario/$clase.php";
		}
	}
	/*
}
else{
	include "Formulario/Configuracion.php";
}
*/
?>