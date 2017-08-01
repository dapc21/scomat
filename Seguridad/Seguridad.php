<?php
//archivo que se encarga de administrar que funcios de seguridad desea ejecutar
session_start();
require_once("../DataBase/Acceso.php");
$acceso=conexion();

	require_once "Usuario.php";
	$clase=trim($_POST['clase']);
	$login=trim($_POST['login']);
	$password=trim($_POST['password']);

	switch($clase)
	{
		case IniciarSesion:
			$objeto=new Usuario($login,$password,'','','');
			$objeto->iniciarSesion($acceso);
			break;
		case CerrarSesion:
			$objeto=new Usuario('','','','','');
			echo $objeto->cerrarSesion($acceso);
			break;
		case cargarMensualidad:
			$objeto=new Usuario('','','','','');
			echo $objeto->cargarMensualidad($acceso);
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