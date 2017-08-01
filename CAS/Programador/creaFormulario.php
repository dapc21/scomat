<?php
session_start();
require_once("../DataBase/Acceso.php");
$acceso=conexion();
include "formulario.php";
$valor=explode("=@",$_POST['d']);
if($_SESSION["autenticacion"]!="On"){
	if($valor[0]=='Configuracion')
		creaForm($acceso,$valor);
	else
		echo "SecurityFalse";
}
else{
	creaForm($acceso,$valor);
}
function creaForm($acceso,$valor){
	$clase=$valor[0];
	switch($clase)
	{
		case CreaFormulario:
			$titulo=titulo("Administraci&oacute;n de formularios del Sistema");
			echo	$titulo.
				cabecera().
				objetoFormulario($acceso,'CreaFormulario').
				fila(colspan('<div id="plantilla"><div>',2,1)).
				botones(BOculto('registrar'),BOculto('modificar'),BOculto('eliminar'),'').
				ultimo();
				break;
		case Plantilla:
			echo cabecera().
				plantilla($valor[1]).
				ultimo();
				break;
		case Configuracion:
			$titulo=titulo("Configuraci&oacute;n de la Base de Datos");
			echo 	$titulo.
				cabecera().	
				gestor().
				campo("Servidor","servidor",25,25,"localhost",'').
				campo("Usuario","login",25,25,"",'').
				password("Contrase&ntilde;a","password",25,25,'','').
				campo("Base de Datos","database",25,25,"",'').
				'<tr>
					<td colspan="2">
						<input name="datagrid" type="checkbox" value=""> <span class="fuente">Restaurar Base de Datos si no existe</span>
					</td>
				</tr>'.
				botones(registrar("Configuracion"),BOculto('registrar'),BOculto('modificar'),BOculto('eliminar')).
				ultimo();
				break;
		case Plantillas:
			$titulo=titulo("Configuraci&oacute;n de Plantilla");
			echo 	$titulo.
				cabecera().
				'
				<tr>
				    <td align="center"><img src="Programador/imagenes/plantilla1.jpg" width="200px"  align="left">
						<input  type="radio" name="plantilla" value="plantilla1" CHECKED><span class="fuente">Plantilla 1</span>
					</td>
				    <td align="center"><img src="Programador/imagenes/plantilla2.jpg" width="200px"  align="left">
						<input  type="radio" name="plantilla" value="plantilla2" ><span class="fuente">Plantilla 2</span>
					</td>
				  </tr>
				  <tr>
				    <td align="center"><img src="Programador/imagenes/plantilla3.jpg" width="200px"  align="left">
						<input  type="radio" name="plantilla" value="Plantilla3" ><span class="fuente">Plantilla 3</span>
					</td>
				    <td align="center"><img src="Programador/imagenes/plantilla4.jpg" width="200px"  align="left">
						<input  type="radio" name="plantilla" value="Plantilla4" ><span class="fuente">Plantilla 4</span>
					</td>
				  </tr>'.
				botones(boton("Aplicar Plantilla","registrar",'verPlantillas()',"button"),BOculto('registrar'),BOculto('modificar'),BOculto('eliminar')).
				ultimo();
				break;
		case Temas:
			$titulo=titulo("Configuraci&oacute;n de Tema");
			echo 	$titulo.
				cabecera().
				'
				<tr>
				    <td align="center"><img src="Programador/imagenes/Tema1.jpg" width="200px"  align="left">
						<input  type="radio" name="tema" value="tema1" CHECKED><span class="fuente">Tema 1</span>
					</td>
				    <td align="center"><img src="Programador/imagenes/tema2.jpg" width="200px"  align="left">
						<input  type="radio" name="tema" value="tema2" ><span class="fuente">Tema 2</span>
					</td>
				  </tr>'.
				botones(boton("Aplicar Tema","registrar",'verTemas()',"button"),BOculto('registrar'),BOculto('modificar'),BOculto('eliminar')).
				ultimo();
				break;
		case VerDatos:
			$titulo=titulo("Visualizar Datos en la Base de Datos");
			echo 	$titulo.
				cabecera().
				objetoFormulario($acceso,'VerDatos').
				fila(colspan('<div id="plantilla"><div>',2,1)).
				botones(BOculto('registrar'),BOculto('modificar'),BOculto('eliminar'),'').
				ultimo();			
				break;
		case LimpiarProyecto:
			$titulo=titulo("Limpieza de Proyecto");
			echo 	$titulo.
				cabecera().
				modulosCreado($acceso).
				fila(colspan('<div id="plantilla">'.
				LimpiezaModulo().
				'<div>',2,1)).
				botones(boton("Ejecutar Limpiador","registrar",'verificar_cas(\'incluir\',\'Limpiador\')',"button"),BOculto('modificar'),BOculto('eliminar'),'').
				ultimo();			
				break;
		case GenerarReportes:
			include "GeneradorReportes/pantallaRep1.php";			
			break;
		case pantallaRep2:
			include "GeneradorReportes/pantallaRep2.php";
			break;
		case pantallaRep3:
			include "GeneradorReportes/pantallaRep3.php";
			break;
		case pantallaRep4:
			include "GeneradorReportes/pantallaRep4.php";
			break;
		case pantallaRep5:
			include "GeneradorReportes/pantallaRep5.php";
			break;
		case pantallaRep6:
			include "GeneradorReportes/pantallaRep6.php";
			break;
	case Persona:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de Persona");
		return    $titulo.
		    cabecera().
		    campoClave("idPersona","idPersona",8,30,"onChange","validarPersona()",'<?php $acceso->objeto->ejecutarSql("select *from persona ORDER BY idPersona desc"); echo "COD".verCo($acceso,"idPersona")?>').
		    campo("Cedula","cedula",8,30,""," ").
		    campo("Nombre","nombre",30,30,""," ").
		    campo("Apellido","apellido",30,30,""," ").
		    campo("edad","edad",2,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("Persona"),modificar("Persona"),eliminar("Persona"),cancelar()).
			ultimo();
		break;
	case Broadcaster:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de Broadcaster");
		return    $titulo.
		    cabecera().
		    campoClave("broadcasterId","broadcasterId",8,30,"onChange","validarBroadcaster()",'<?php $acceso->objeto->ejecutarSql("select *from broadcaster ORDER BY broadcasterid desc"); echo "COD".verCo($acceso,"broadcasterid")?>').
		    campo("descripcion","broadcasterDs",100,50,""," ").
			campoOculto("dato","dato").
			botones(registrar("Broadcaster"),modificar("Broadcaster"),eliminar("Broadcaster"),cancelar()).
			ultimo();
		break;
	case Channel:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de Channel");
		return    $titulo.
		    cabecera().
		    campoClave("ID","channelId",8,30,"onChange","validarChannel()",'<?php $acceso->objeto->ejecutarSql("select *from channel ORDER BY channelid desc"); echo "COD".verCo($acceso,"channelid")?>').
		    campo("Descripcion","channelDs",100,50,""," ").
			menu("broadcaster",select("broadcasterId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
			menu("parentalType",select("parentalType",'<option value="0">Seleccione...</option><option value="0">Undefined</option><option value="1">For all ages</option><option value="2">Not suitable for under-7s</option><option value="3">Not suitable for under-13s</option><option value="4">Not suitable for under-18s</option><option value="5">Adult content</option>',null)).
			menu("inExportable",select("inExportable",'<option value="0">Seleccione...</option><option value="0">No exportable</option><option value="1">Exportable</option>',null)).
			menu("inFreeAccess",select("inFreeAccess",'<option value="0">Seleccione...</option><option value="0">No Free Access</option><option value="1">Free Access</option>',null)).
			campoOculto("dato","dato").
			botones(registrar("Channel"),modificar("Channel"),eliminar("Channel"),cancelar()).
			ultimo();
		break;
	case Smartcard:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de Smartcard");
		return    $titulo.
		    cabecera().
		    campoClave("SMCid","SMCid",12,30,"onChange","validarSmartcard()","").
			menu("broadcaster",select("broadcasterId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    campo("total","total",4,30,""," ").
			menu("statusId",select("statusId",'<option value="0">Seleccione...</option><option value="0">statusId</option><option value="1">Deactivation</option><option value="2">Lock</option>',null)).
		    campo("nmIPPVbalance","nmIPPVbalance",3,30,""," ").
		    fechaepoch("statusDate","statusDate").
			campoOculto("dato","dato").
			botones(registrar("Smartcard"),modificar("Smartcard"),eliminar("Smartcard"),cancelar()).
			ultimo();
		break;
	case Product:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de Product");
		return    $titulo.
		    cabecera().
		    campoClave("productId","productId",30,30,"onChange","validarProduct()","").
		    campo("productDs","productDs",50,30,""," ").
			menu("broadcasterId",select("broadcasterId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    fechaepoch("validityDateBegin","validityDateBegin").
		    fechaepoch("validityDateEnd","validityDateEnd").
		    fechaepoch("purchaseDateBegin","purchaseDateBegin").
		    fechaepoch("purchaseDateEnd","purchaseDateEnd").
		    campo("genreId","genreId",4,30,""," ").
		    campo("subgenreId","subgenreId",30,30,""," ").
		    campo("price","price",10,30,""," ").
		    campo("maxEvents","maxEvents",4,30,""," ").
			menu("ippv",select("ippv",'<option value="0">Seleccione...</option><option value="0">Non IPPV product</option><option value="1">IPPV product</option>',null)).
			campoOculto("dato","dato").
			botones(registrar("Product"),modificar("Product"),eliminar("Product"),cancelar()).
			ultimo();
		break;
	case Purchase:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de Purchase");
		return    $titulo.
		    cabecera().
		    campoClave("idPurchase","idPurchase",8,30,"onChange","validarPurchase()",'<?php $acceso->objeto->ejecutarSql("select *from purchase ORDER BY idpurchase desc"); echo "COD".verCo($acceso,"idpurchase")?>').
			menu("operationType",select("operationType",'<option value="0">Seleccione...</option><option value="0">Purchase</option><option value="1">Cancellation</option><option value="2">Immediate subscription deactivation</option>',null)).
			menu("productId",select("productId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
			menu("subscriptionId",select("subscriptionId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    campo("SMCid","SMCid",12,30,""," ").
		    campo("statusId","statusId",1,30,""," ").
		    fechaepoch("statusDate","statusDate").
			campoOculto("dato","dato").
			botones(registrar("Purchase"),modificar("Purchase"),eliminar("Purchase"),cancelar()).
			ultimo();
		break;
	case Event:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de Event");
		return    $titulo.
		    cabecera().
		    campoClave("eventId","eventId",8,30,"onChange","validarEvent()","").
		    campo("title","title",100,50,""," ").
		    fechaepoch("broadcastBegin","broadcastBegin").
		    fechaepoch("broadcastEnd","broadcastEnd").
			menu("channelId",select("channelId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    campo("genreId","genreId",4,30,""," ").
		    campo("subgenreId","subgenreId",4,30,""," ").
			menu("parentalType",select("parentalType",'<option value="0">Seleccione...</option><option value="0">Undefined</option><option value="1">For all ages</option><option value="2">Not suitable for under-7s</option><option value="3">Not suitable for under-13s</option><option value="4">Not suitable for under-18s</option><option value="5">Adult content</option>',null)).
			menu("previewType",select("previewType",'<option value="0">Seleccione...</option><option value="0">No preview</option><option value="1">Preview at the beginning of event</option><option value="2">Preview anytime (changing the channel)</option>',null)).
		    campo("previewDuration","previewDuration",4,30,""," ").
			menu("inScrambled",select("inScrambled",'<option value="0">Seleccione...</option><option value="0">No scrambled</option><option value="1">Scrambled</option><option value=""></option>',null)).
			campoOculto("dato","dato").
			botones(registrar("Event"),modificar("Event"),eliminar("Event"),cancelar()).
			ultimo();
		break;
	case Subscription:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de Subscription");
		return    $titulo.
		    cabecera().
		    campoClave("subscriptionId","subscriptionId",8,30,"onChange","validarSubscription()",'<?php $acceso->objeto->ejecutarSql("select *from subscription ORDER BY subscriptionid desc"); echo "COD".verCo($acceso,"subscriptionid")?>').
		    campo("subscriptionDs","subscriptionDs",100,50,""," ").
			menu("channelId",select("channelId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    fechaepoch("purchaseDateBegin","purchaseDateBegin").
		    fechaepoch("purchaseDateEnd","purchaseDateEnd").
		    campo("price","price",10,30,""," ").
			menu("ippv",select("ippv",'<option value="0">Seleccione...</option><option value="0">Non IPPV subscription</option><option value="1">IPPV subscription</option>',null)).
			campoOculto("dato","dato").
			botones(registrar("Subscription"),modificar("Subscription"),eliminar("Subscription"),cancelar()).
			ultimo();
		break;
	case CASSTBBean:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de CASSTBBean");
		return    $titulo.
		    cabecera().
		    campoClave("stbTypeId","stbTypeId",4,30,"onChange","validarCASSTBBean()",'<?php $acceso->objeto->ejecutarSql("select *from casstbbean ORDER BY stbtypeid desc"); echo "COD".verCo($acceso,"stbtypeid")?>').
		    campo("stbManufacturerId","stbManufacturerId",4,30,""," ").
			menu("broadcasterId",select("broadcasterId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    campo("serialNumber","serialNumber",100,50,""," ").
		    campo("barcode","barcode",255,50,""," ").
			menu("inMaster",select("inMaster",'<option value="0">Seleccione...</option><option value="0">Master</option><option value="1">Slave</option>',null)).
		    campo("stbMasterTypeId","stbMasterTypeId",4,30,""," ").
		    campo("stbMasterManufacturerId","stbMasterManufacturerId",4,30,""," ").
		    campo("serialNumberMaster","serialNumberMaster",255,50,""," ").
			campoOculto("dato","dato").
			botones(registrar("CASSTBBean"),modificar("CASSTBBean"),eliminar("CASSTBBean"),cancelar()).
			ultimo();
		break;
	case ProductEvent:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de ProductEvent");
		return    $titulo.
		    cabecera().
		    campoClave("eventId","eventId",8,30,"onChange","validarProductEvent()",'<?php $acceso->objeto->ejecutarSql("select *from productevent ORDER BY eventid desc"); echo "COD".verCo($acceso,"eventid")?>').
		    campo("productId","productId",8,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("ProductEvent"),modificar("ProductEvent"),eliminar("ProductEvent"),cancelar()).
			ultimo();
		break;
	case CASTimeRangeBean:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de CASTimeRangeBean");
		return    $titulo.
		    cabecera().
		    campoClave("idCASTimeRangeBean","idCASTimeRangeBean",8,30,"onChange","validarCASTimeRangeBean()",'<?php $acceso->objeto->ejecutarSql("select *from castimerangebean ORDER BY idcastimerangebean desc"); echo "COD".verCo($acceso,"idcastimerangebean")?>').
		    campo("subscriptionId","subscriptionId",8,30,""," ").
			menu("day",select("day",'<option value="0">Seleccione...</option><option value="1"></option><option value="Lunes"></option><option value="2">Martes</option><option value="3">Miercoles</option><option value="4">Jueves</option><option value="5">Viernes</option><option value="6">Sabado</option><option value="7">Domingo</option>',null)).
		    campo("broadcastTimeBegin","broadcastTimeBegin",8,30,""," ").
		    campo("broadcastTimeEnd","broadcastTimeEnd",8,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("CASTimeRangeBean"),modificar("CASTimeRangeBean"),eliminar("CASTimeRangeBean"),cancelar()).
			ultimo();
		break;
	case Message:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de Message");
		return    $titulo.
		    cabecera().
		    campoClave("idMessage","idMessage",8,30,"onChange","validarMessage()",'<?php $acceso->objeto->ejecutarSql("select *from message ORDER BY idmessage desc"); echo "COD".verCo($acceso,"idmessage")?>').
		    campo("para","to",12,30,""," ").
		    campo("De","from",50,30,""," ").
		    campo("Asunto","subject",50,30,""," ").
		    areaCorta("Mensaje","text",50,3,"","").
		    fechaepoch("sendDate","sendDate").
			menu("broadcasterId",select("broadcasterId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
			campoOculto("dato","dato").
			botones(registrar("Message"),modificar("Message"),eliminar("Message"),cancelar()).
			ultimo();
		break;
	case SubscriptionChannel:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de SubscriptionChannel");
		return    $titulo.
		    cabecera().
		    campoClave("subscriptionId","subscriptionId",8,30,"onChange","validarSubscriptionChannel()",'<?php $acceso->objeto->ejecutarSql("select *from subscriptionchannel ORDER BY subscriptionid desc"); echo "COD".verCo($acceso,"subscriptionid")?>').
			menu("channelId",select("channelId",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
			campoOculto("dato","dato").
			botones(registrar("SubscriptionChannel"),modificar("SubscriptionChannel"),eliminar("SubscriptionChannel"),cancelar()).
			ultimo();
		break;
			default:
	}// fin switch
}
?>