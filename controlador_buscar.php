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
	//$parametros=$_GET["parametros"];
	$parametros=json_decode($_GET["parametros"],true);
	$respuesta["objetos"] = array();

	for ($i=0; $i < count($parametros); $i++){
		$clase=$parametros[$i]['clase'];
		$consulta=$parametros[$i]['consulta'];
		$respuesta["objetos"][$i]["clase"]=$clase;

		//$acceso->objeto->ejecutarSqlObject("$consulta limit 10");
		$acceso->objeto->ejecutarSqlObject("$consulta");
		$respuesta["objetos"][$i]["cantidad"] = $acceso->objeto->registros;
		$respuesta["objetos"][$i]["data"] = array();
		while($row=$acceso->objeto->devolverRegistro()){
			$respuesta["objetos"][$i]["data"][] = limpiar($row);
			$acceso->objeto->siguienteRegistroObject();
		}
	}
	if($acceso->objeto->error()!=''){
		$respuesta["success"] = false;
		$respuesta["objetos"] = '';
		$respuesta["error"] = $acceso->objeto->error();
	}else{
		$respuesta["success"] = true;
		$respuesta["error"] = $resp;
	}
	
	$acceso->objeto->desconectarDataBase();
}
function traerconsulta($consulta){
	if(substr(strtoupper($consulta), " DROP ")){
		return "";
	}else if(substr(strtoupper($consulta), " INSERT ")){
		return "";
	}else if(substr(strtoupper($consulta), " DELETE ")){
		return "";
	}else if(substr(strtoupper($consulta), " UPDATE ")){
		return "";
	}else {
		$cad1=explode("SELECT ",strtoupper($consulta));
		$cad2=explode("FROM ",strtoupper($cad1[1]));
		$cad3=explode(" WHERE ",strtoupper($cad2[1]));
		$cad4=explode("  ",strtoupper($cad1));

	}
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($respuesta, JSON_FORCE_OBJECT);



?>