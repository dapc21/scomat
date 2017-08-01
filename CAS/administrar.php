<?php
//ARCHIVO ENCARGADO DE ADMINISTRAR QUE SE QUIERE HACER Y A QUE CLASE
//ES DECIR 'incluir', 'modificar' o 'eliminar' a la clase 'Persona'
session_start();
if($_SESSION["autenticacion"]!="On"){
	echo "SecurityFalse";
}
else{
require_once("DataBase/Acceso.php");
$acceso=conexion();
//recibe los datos enviados
$cadena=$_POST['d'];

//divide la cadena recibida cada vez que consiga '-Class-', esto quiere decir que se va a hacer peticiones a varias clases en una sala petición
$clases=explode("-Class-",$cadena);
$mensaje=false;
//cuenta la cantidad de clases
$x=count($clases);

$y=0;
//recorre el ciclo dependiendo de la cantidad de clases que se desea instaciar
for($y=0;$y<$x;$y++)
{
	//divide la cadena de la primeta clase en '=@' 
	$valor=explode("=@",$clases[$y]);
	//la  posicion '$valor[0], representa la operacion de desea realizar ya sea incluir modificar o eliminar
	$boton=$valor[0];
	//la  posicion '$valor[0], representa la clase.
	$nombreClase=$valor[1];
	if($nombreClase=="Modulo" || $nombreClase=="ModuloPerfil" || $nombreClase=="Perfil" || $nombreClase=="Usuario")
		require_once "Seguridad/".$nombreClase.".php";
	else
		require_once "Clases/".$nombreClase.".php";

	if(class_exists($nombreClase))
	{
		//se crea el objeto de la clase
		$objeto = llamada($nombreClase,$valor);
		//concateno la funcion a la que voy a llamar ejemplo 'incluirPersona'
		$metodo=$boton.$nombreClase;
		//verifico la existencia del campo clave
		if(!$objeto->validaExistencia($acceso)){
			//verifica si vas a incluir
			if($boton=="incluir" || $nombreClase=="ModuloPerfil"){
				//haces la llamada al metodo
				$objeto->$metodo($acceso);
				$mensaje=true;
			}
			else{
				echo ', EL CAMPO NO ESTA REGISTRADO EN ESTA TABLA';
				$mensaje=false;
			}
		}
		else{
			if($boton!="incluir" || $nombreClase=="ModuloPerfil"){
				$objeto->$metodo($acceso);
				$mensaje=true;
			}
			else{
				echo ', EL CAMPO YA ESTA REGISTRADO EN ESTA TABLA';
				$mensaje=false;
			}
		}
	}
	else
		echo 'LA CLASE NO EXISTE'; 
	
	if(!$mensaje)
	{
		break;
	}
}
if($mensaje)
	echo 'true';

}//security
//funcion que te permite instaciar un objeto sin importar la cantidad de parametros que tenga
function llamada($nombreClase,$args)
{
	//verifico la catidad de parametros
	switch (count($args))
	{
		Case 4: 
			//ejemplo en caso de ser 4 parametros el primeto es la 'operacio' el segundo la 'clase' y los demas atributos de la clase
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
	}
	//retorno el objeto ya creado
	return $objeto;
}
?>