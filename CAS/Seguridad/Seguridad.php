<?php
//archivo que se encarga de administrar que funcios de seguridad desea ejecutar
session_start();
require_once("../DataBase/Acceso.php");
$acceso=conexion();

	require_once "Usuario.php";
	$valor=explode("=@",$_POST['d']);
	$clase=$valor[0];
	$error='Error, el Usuario y/o Contraseña ingresados no son validos<br>';
	$retorno=false;
	switch($clase)
	{
		case IniciarSesion:
			$objeto=new Usuario($valor[1],$valor[2],'','','');
			if(!$objeto->iniciarSesion($acceso)){
				echo "false";
			}
			break;
		case CerrarSesion:
			$objeto=new Usuario('','','','','');
			echo $objeto->cerrarSesion($acceso);
			break;
		case ConfirmarSesion:
			if($_SESSION["autenticacion"]!="On")
				echo "false";
			else
				echo "true";
			break;
			default:
				echo "SecurityFalse";
	}

?>