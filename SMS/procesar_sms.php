<?php
	require_once "Clases/sms.php";
	require_once("../procesos.php");  
	$acceso=conexion();
	$objeto=new sms();
	$objeto->procesarConsulta($acceso);
?>