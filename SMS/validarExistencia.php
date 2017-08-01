<?php
session_start();
if($_SESSION["autenticacion"]!="On"){
	echo "SecurityFalse";
}
else{
	require_once("../DataBase/Acceso.php");
	$acceso=conexion();
	$cadena=$_POST["d"];
	$palabras=explode("=@",$cadena);
	$consulta=$palabras[0];
	$tabla=$palabras[1];
	if($consulta=="0"){
		$select="select * from ".$tabla;
	}
	else{
		$dato=$palabras[2];
		$codigo=$palabras[3];
	}
	if($consulta=="1"){
		$select="select * from $tabla where $dato='$codigo'";
	}
	else if($consulta=="2"){
		$dato1=$palabras[4];
		$codigo1=$palabras[5];
		$select="select * from $tabla where $dato='$codigo' and $dato1='$codigo1'";
	}
	$acceso->objeto->ejecutarSql($select);	
	if($row=$acceso->objeto->devolverRegistro()){		
		$num = count($row);
		echo $num/2;
		for($i=0;$i<$num;$i++){
			echo "=@".trim($row[$i]);
		}	
	}
	else{			
		echo "false";
	}
}
?>