<?php
session_start();
$respuesta = array();
if($_SESSION["autenticacion"]!="On"){
	//echo "SecurityFalse";
	$respuesta["success"] = false;
	$respuesta["error"] = "Intento de Violación de Seguridad, debe iniciar sesion.";
}
else{
	require_once("procesos.php");
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("BEGIN;");

	//$parametros=$_GET["parametros"];
	$parametros=json_decode($_GET["parametros"],true);

	$clase=$parametros['clase'];
	$dat=$parametros['datos'];
	$respuesta["campo"] = $clase($acceso,$dat);

	$respuesta["success"] = true;

	if($resp=$acceso->objeto->error()!=''){
		$acceso->objeto->ejecutarSql("ROLLBACK;");
	}else{
		$acceso->objeto->ejecutarSql("COMMIT;");
		if($resp!='1' && $resp!=''  ){ 
			$respuesta["success"] = false;
			$respuesta["error"] = $resp;
		}else{
			$respuesta["success"] = true;
			$respuesta["error"] = $resp;
		}
	}
	
	$acceso->objeto->desconectarDataBase();

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($respuesta, JSON_FORCE_OBJECT);
}

?>