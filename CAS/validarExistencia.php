<?php
//ARCHIVO QUE ES LLAMADO CUANDO SE DESEA VERIFICAR LA EXISTENCIA DE CUALQUIER CAMPO DE UNA CLASE Y RETORNA TODOS LOS CAMPOS ENCOTRADOS O LA PALABRA 'false'
session_start();
if($_SESSION["autenticacion"]!="On"){
	echo "SecurityFalse";
}
else{
	require_once("DataBase/Acceso.php");
	$acceso=conexion();
	$cadena=$_POST['d'];
	//recibe una cadena concatenada con '=@', separa la cadena
	$palabras=explode("=@",$cadena);
	//el primer valor representa el tipo de consulta,
	$consulta=$palabras[0];
	//el segundo valor la tabla que se desea consultar
	$tabla=$palabras[1];
	if($consulta=="0"){
		$select="select * from ".$tabla;
	}
	else{
		//los otros dos valores representan el dato que deseas comparar y el valor para compararlo
		$dato=$palabras[2];
		$codigo=$palabras[3];
	}
	if($consulta=="1"){
		//crea la consulta SQL
		$select="select * from ".$tabla." where ".$dato."="."'".$codigo."'";
		
	}
	else if($consulta=="2"){
		//en caso de que sea una consulta a una tabla con dos comparaciones
		$dato1=$palabras[4];
		$codigo1=$palabras[5];
		$select="select * from ".$tabla." where ".$dato."="."'".$codigo."'"." and ".$dato1."="."'".$codigo1."' and ".$dato1."="."'".$codigo1."'";
	}
	//ejecuto la sentencia SQL
	$acceso->objeto->ejecutarSql($select);	
	//devuleve los valores
	if($row=$acceso->objeto->devolverRegistro()){		
		$num = count($row);
		//imprime la cantidad de valores
		echo $num/2;
		for($i=0;$i<$num;$i++){
			
			//va concatenando cada valor con '=@'
			echo '=@'.$row[$i];
		}	
	}
	else{			
		//si no existe retorna la cadena 'false'
		echo 'false';
	}
}//security
?>