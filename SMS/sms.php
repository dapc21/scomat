<?php
//archivo que se encarga de administrar que funcios de seguridad desea ejecutar
session_start();
$valor=explode("=@",$_POST['d']);
$clase=$valor[0];

	require_once "Clases/sms.php";
	//require_once("../DataBase/Acceso.php");
	require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];  
	require_once "../Seguridad/Usuario.php";
	$obj=new Usuario('','','','','');
	
	$sin_acceso=false;
	$acceso=conexion();
	$objeto=new sms();
	switch($clase)
	{
		case recibirSMS:	
			//echo "verificar comando";
			echo $objeto->recibirSMS($acceso);
			//echo "verificar comando";
			break;
		case consultaSMS:
			//echo "verificar comando";
			echo $objeto->consultaSMS($acceso);
			//echo "verificar comando";
			break;
		case ini_serv_email:	
			//echo "verificar comando";
			echo $objeto->ini_serv_email($acceso);
			//echo "verificar comando";
			break;
		case det_serv_sms:	
			//echo "verificar comando";
			echo $objeto->det_serv_sms($acceso);
			//echo "verificar comando";
			break;
		case rei_serv_sms:
			//echo "verificar comando";
			echo $objeto->det_serv_sms($acceso);
			//echo "verificar comando";
			break;
		case sincronizarTelf:	
			$objeto->sincronizarTelf($acceso);
			break;
		case ini_serv_sms:	
			$objeto->ini_serv_sms($acceso,$valor);
			break;
		case mostrarSMSEsp:
			if($obj->permisoModulo($acceso,strtoupper('LEER_SMS'))){
				$objeto->mostrarSMSEsp($acceso,$valor[1],$valor[2],$valor[3],$valor[4]);
			}else{
				$sin_acceso=true;
			}
			break;
		case listadoSMSEsp:	
			
				$objeto->listadoSMSEsp($acceso,$valor[1]);
			
			break;
		case mostrarSMSUnico:
			$objeto->mostrarSMSUnico($acceso,$valor[1]);
			break;
		case EnviarSMSUnico:	
			$objeto->EnviarSMSUnico($acceso,$valor[1],$valor[2],'');
			break;
		case EnviarSMSUnicoCont:	
			$objeto->EnviarSMSUnico($acceso,$valor[1],$valor[2],$valor[3]);
			break;
		case EnviarSMSAutomatico:
			$objeto->EnviarSMSAutomatico($acceso,$valor[1],$valor[2],$valor[3]);
			break;
		case cerrarSMS:
			$_SESSION["activo_sms"]='Off';
			break;
		default:
			echo "SecurityFalse";
	}
	
	if($sin_acceso==true){
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>