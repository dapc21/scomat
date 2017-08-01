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
	$parametros=json_decode($_POST["parametros"],true);
	//echo "<br>parametros:".$parametros[0]['accion'].":";
	
	for ($i=0; $i < count($parametros); $i++) {
		
		$acceso->objeto->ejecutarSql("BEGIN;");

		$accion=$parametros[$i]['accion'];
		$nombreClase=$parametros[$i]['clase'];
		$dat=$parametros[$i]['datos'];

		if($nombreClase=="Modulo" || $nombreClase=="modulo_perfil" || $nombreClase=="Perfil" || $nombreClase=="Usuario")
			require_once "Seguridad/".$nombreClase.".php";
		else
			require_once "Clases/".$nombreClase.".php";

		if(class_exists($nombreClase))
		{
			//$objeto=new $nombreClase(limpiar_entrada($dat));
			$objeto=new $nombreClase($dat);
			$resp=$objeto->$accion($acceso);

			if($acceso->objeto->error()!=''){
				$acceso->objeto->ejecutarSql("ROLLBACK;");
				$respuesta["success"] = false;
				$respuesta["error"] = $acceso->objeto->error();
			}else{
				if($resp!='1' && $resp!=''  ){
					$acceso->objeto->ejecutarSql("ROLLBACK;");
					$respuesta["success"] = false;
					$respuesta["error"] = $resp;
				}else{
					$acceso->objeto->ejecutarSql("COMMIT;");
					$respuesta["success"] = true;
				}
			}
		}
		else{
			$acceso->objeto->ejecutarSql("ROLLBACK;");
			$respuesta["success"] = false;
			$respuesta["error"] = " La Clase '$nombreClase' no existe:";
		}		
	}
	$acceso->objeto->desconectarDataBase();
}
header('Content-type: application/json; charset=utf-8');
echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>