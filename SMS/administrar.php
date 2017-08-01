<?php

session_start();
if($_SESSION["autenticacion"]!="On"){
	echo "SecurityFalse";
}
else{
require_once("procesos.php");
$acceso=conexion();
$cadena=$_POST["d"];
//echo ":".$_POST["d"].":";
//echo "|| $cadena || ";
$clases=explode("-Class-",$cadena);
$mensaje=false;
$x=count($clases);

$y=0;
for($y=0;$y<$x;$y++)
{
	//echo "|| $clases[$y] ||";
	$valor=explode("=@",$clases[$y]);
	$boton=$valor[0];
	$nombreClase=$valor[1];
	if($nombreClase=="Modulo" || $nombreClase=="modulo_perfil" || $nombreClase=="Perfil" || $nombreClase=="Usuario")
		require_once "Seguridad/".$nombreClase.".php";
	else
		require_once "Clases/".$nombreClase.".php";

	if(class_exists($nombreClase))
	{
		$objeto = llamada($nombreClase,$valor);
		$metodo=$boton.$nombreClase;
		if(!$objeto->validaExistencia($acceso)){
			if($boton=="incluir" || $nombreClase=="modulo_perfil"){
				$objeto->$metodo($acceso);
				$mensaje=true;
			}
			else{
				echo ", "._("el campo no esta registrado en esta tabla:".$nombreClase);
				$mensaje=false;
			}
		}
		else{
			if($boton!="incluir" || $nombreClase=="modulo_perfil"){
				$objeto->$metodo($acceso);
				$mensaje=true;
			}
			else{
				echo ", "._(" el campo ya esta registrado en esta tabla:".$nombreClase);
				$mensaje=false;
			}
		}
	}
	else
		echo "LA CLASE NO EXISTE"; 
	
	if(!$mensaje)
	{
		break;
	}
}
if($mensaje)
	echo "true";

}
function llamada($nombreClase,$args)
{
	switch (count($args))
	{
		Case 4: 
			$objeto=new $nombreClase($args[2],$args[3]);break;
		case 5:
			$objeto=new $nombreClase($args[2],$args[3],$args[4]);break;
		case 6:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5]);break;
		case 7:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6]);break;
		case 8:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7]);break;
		case 9:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8]);break;
		case 10:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9]);break;
		case 11:
			//echo "::$args[10]::";
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10]);break;
		case 12:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11]);break;
		case 13:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12]);break;
		case 14:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13]);break;
		case 15:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14]);break;
		case 16:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15]);break;
		case 17:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16]);break;
		case 18:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17]);break;
		case 19:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18]);break;
		case 20:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19]);break;
		case 21:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20]);break;
		case 22:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21]);break;
		case 23:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22]);break;
		case 24:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23]);break;
		case 25:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23],$args[24]);break;
		case 26:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23],$args[24],$args[25]);break;
		case 27:
			$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23],$args[24],$args[25],$args[26]);break;	
			
	}
	return $objeto;
}
?>