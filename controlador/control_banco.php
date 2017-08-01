<?php
session_start();
$respuesta = array();
if($_SESSION["autenticacion"]!="On"){
	//echo "SecurityFalse";
	$respuesta["success"] = false;
	$respuesta["error"] = "Intento de Violación de Seguridad, debe iniciar sesion.";
}
else{
	require_once("../procesos.php");
	$acceso=conexion();
	$operaciones=$_POST["operaciones"];
	

	for ($i=0; $i < count($operaciones); $i++) {
/*		echo "<br>".$operaciones[$i]['clase'].":";
		echo "<br>".$operaciones[$i]['accion'].":";
		$datos=$operaciones[$i]['datos'];
		$datos=$operaciones[$i]['datos'];
		for ($j=0; $j < count($datos); $j++) {
			echo "<br> ".$datos[$j]['id_banco'].":";
			echo "<br> ".$datos[$j]['banco'].":";
			echo "<br> ".$datos[$j]['tipo_banco'].":";
		}

*/
		$datos=$operaciones[$i]['datos'];
		$boton=$operaciones[$i]['accion'];
		$nombreClase=$operaciones[$i]['clase'];
		if($nombreClase=="Modulo" || $nombreClase=="modulo_perfil" || $nombreClase=="Perfil" || $nombreClase=="Usuario")
			require_once "../Seguridad/".$nombreClase.".php";
		else
			require_once "../Clases/".$nombreClase.".php";

		echo ":$nombreClase:";
		if(class_exists($nombreClase))
		{
			$objeto = llamada($nombreClase,$datos);
			$metodo=$boton.$nombreClase;
			echo ":$metodo:";
			
			if(!$objeto->validaExistencia($acceso)){
				if($boton=="incluir" || $nombreClase=="recibe_recibo"  || $nombreClase=="modulo_perfil" || $nombreClase=="pagos" || $nombreClase=="ordenes_tecnicos" || $nombreClase=="caja_cobrador" || $nombreClase=="grupo_ubicacion" || $nombreClase=="detalle_tipopago"){
					if($error=$objeto->$metodo($acceso)){
						$respuesta["success"] = true;
					}
					else{
						$respuesta["success"] = false;
						$respuesta["error"] = $error;
					}
				}
				else{
					$respuesta["success"] = false;
					$respuesta["error"] = "el campo no esta registrado en esta tabla:".$nombreClase;
				}
			}
			else{
				if($boton!="incluir" || $nombreClase=="modulo_perfil"  || $nombreClase=="caja_cobrador" || $nombreClase=="ordenes_tecnicos" ){
					if($error=$objeto->$metodo($acceso)){
						$respuesta["success"] = true;
					}
					else{
						$respuesta["success"] = false;
						$respuesta["error"] = $error;
					}
				}
				else{
					$respuesta["success"] = false;
					$respuesta["error"] = " el campo ya esta registrado en esta tabla:".$nombreClase;
				}
			}
			
		}
		else{
			$respuesta["success"] = false;
			$respuesta["error"] = " La Clase '$nombreClase' no existe:";
		}		
	}
}

	//header('Content-type: application/json; charset=utf-8');
	//echo json_encode($respuesta, JSON_FORCE_OBJECT);

function llamada($nombreClase,$args)
{
	switch (nombreClase)
	{
		Case banco: 
			echo "id_banco:".$args['id_banco'].":";
			return $objeto=new banco($args['id_banco'],$args['banco'],$args['tipo_banco']);break;
		default:
		
			switch (count($args))
			{
				Case 3: 
					$objeto=new $nombreClase($args[2],$args[3]);break;
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
				case 28:
					$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23],$args[24],$args[25],$args[26],$args[27]);break;	
				case 29:
					$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23],$args[24],$args[25],$args[26],$args[27],$args[28]);break;	
				case 30:
					$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23],$args[24],$args[25],$args[26],$args[27],$args[28],$args[29]);break;	
				case 31:
					$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23],$args[24],$args[25],$args[26],$args[27],$args[28],$args[29],$args[30]);break;	
				case 32:
					$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23],$args[24],$args[25],$args[26],$args[27],$args[28],$args[29],$args[30],$args[31]);break;	
				case 33:
					$objeto=new $nombreClase($args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8],$args[9],$args[10],$args[11],$args[12],$args[13],$args[14],$args[15],$args[16],$args[17],$args[18],$args[19],$args[20],$args[21],$args[22],$args[23],$args[24],$args[25],$args[26],$args[27],$args[28],$args[29],$args[30],$args[31],$args[32]);break;

		} //segundo switch
	}//primer switch
	
	return $objeto;
}

?>