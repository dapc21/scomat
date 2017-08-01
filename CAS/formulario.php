<?php
//Archivo que permite identificar que formulario se desea cargar
//verifica que antes se haya iniciado sesion
require_once("DataBase/Acceso.php");
$acceso=conexion();
if($acceso)
{
	session_start();
	$valor=explode("=@",$_POST['d']);
	$clase=$valor[0];
	if($_SESSION["autenticacion"]!="On"){
		if($clase=='Sesion')
			include "Formulario/Sesion.php";
		else
			echo "SecurityFalse";
	}
	else{
		switch($clase)
		{
			case Sesion:
				//incluyo todo el formulario que se encuentre en ese archivo 
				//se puede ejecutar codigo php en los archivos
				include "Formulario/Sesion.php";
				break;
			case Usuario:
				include "Formulario/Usuario.php";
				break;
			case Perfil:
				include "Formulario/Perfil.php";
				break;
			case Modulo:
				include "Formulario/Modulo.php";
				break;
		case Persona:
			include "Formulario/Persona.php";
			break;
	case Broadcaster:
		include "Formulario/Broadcaster.php";
		break;
	case Channel:
		include "Formulario/Channel.php";
		break;
	case Smartcard:
		include "Formulario/Smartcard.php";
		break;
	case Product:
		include "Formulario/Product.php";
		break;
	case Purchase:
		include "Formulario/Purchase.php";
		break;
	case Event:
		include "Formulario/Event.php";
		break;
	case Subscription:
		include "Formulario/Subscription.php";
		break;
	case CASSTBBean:
		include "Formulario/CASSTBBean.php";
		break;
	case ProductEvent:
		include "Formulario/ProductEvent.php";
		break;
	case CASTimeRangeBean:
		include "Formulario/CASTimeRangeBean.php";
		break;
	case Message:
		include "Formulario/Message.php";
		break;
	case SubscriptionChannel:
		include "Formulario/SubscriptionChannel.php";
		break;
	default:
		include "Formulario/$clase.php";
		}// fin switch
	}
}
else{
	include "Formulario/Configuracion.php";
}
?>