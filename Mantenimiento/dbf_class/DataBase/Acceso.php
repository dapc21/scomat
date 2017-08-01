<?php
	//PERMITE CREAR LA CONEXION CON LA BASE DE DATOS EN UN MANEJADOR DETERMINADO
	require_once("DataAccess.php");
    //NOMBRE DEL MANEJADOR DE LA BDD
    $manejador='Postgres';
    //NOMBRE DEL HOST DONDE SE ENCUENTRA EL SERVICIO WEB Y DE LA BDD
    $host='localhost';
    //NOMBRE DE USUARIO QUIEN CONECTA CON LA BDD
    $usuario='postgres';
    //CLAVE DE USUARIO QUIEN CONECTA CON LA BDD
    $clave='123456';
    //NOMBRE DE LA BDD A CONECTARSE
    $data_base='datos_marac2';
	
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