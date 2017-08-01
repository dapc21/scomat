<?php
	require_once("DataAccess.php");
    $manejador='Postgres';
    $host='localhost';
    $usuario='postgres';
    $clave='123456';
    $data_base='saeco';
    $data_base_ha='historico';
		
	function conexion(){
		global $manejador;
		global $host;
		global $usuario;
		global $clave;
		global $data_base;
		$acceso=new DataAccess();
		$conexion=$acceso->conectar($manejador,$host,$usuario,$clave,$data_base);
		if($conexion==true){
			return $acceso;
		}
		else{
			return false;
		}
	}
	function conexion_ha(){
		global $manejador;
		global $host;
		global $usuario;
		global $clave;
		global $data_base_ha;
		$acceso=new DataAccess();
		$conexion=$acceso->conectar($manejador,$host,$usuario,$clave,$data_base_ha);
		if($conexion==true){
			return $acceso;
		}
		else{
			return false;
		}
	}
	function conectar($manejador,$host,$usuario,$clave,$data_base){
		$acceso=new DataAccess();
		$conexion=$acceso->conectar($manejador,$host,$usuario,$clave,$data_base);
		if($conexion==true){
			return $acceso;
		}
		else{
			return false;
		}
	}
?>
