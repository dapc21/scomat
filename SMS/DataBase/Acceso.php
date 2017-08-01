<?php

	//PERMITE CREAR LA CONEXION CON LA BASE DE DATOS EN UN MANEJADOR DETERMINADO
	require_once("DataAccess.php");
	//VARIABLES PARA ACCESO A BASE DE DATOS, SON GLOBALES PARA LOS MODULOS OPCIONALES (SAECOMAT O SMS)
    //NOMBRE DEL MANEJADOR DE LA BDD
    $manejador='Postgres';
    $host='localhost';
    //$host='192.168.167.2';
    //NOMBRE DE USUARIO QUIEN CONECTA CON LA BDD
    $usuario='postgres';
    //CLAVE DE USUARIO QUIEN CONECTA CON LA BDD
    $clave='123456';
    //NOMBRE DE LA BDD A CONECTARSE
    $data_base='saeco_cablehogar';
    $data_base_ha='saeco_cablehogar';

		
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
