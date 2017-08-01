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
				botones(boton("Ejecutar Limpiador","registrar",'verificar(\'incluir\',\'Limpiador\')',"button"),BOculto('modificar'),BOculto('eliminar'),'').
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
	case asigna_llamada:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de asigna_llamada");
		return    $titulo.
		    cabecera().
		    campoClave("id_all","id_all",10,30,"onChange","validarasigna_llamada()",'<?php $acceso->objeto->ejecutarSql("select *from asigna_llamada ORDER BY id_all desc"); echo "COD".verCo($acceso,"id_all")?>').
		    campo("ubicacion","ubica_all",255,60,""," ").
		    fechaepoch("fecha_all","fecha_all").
		    campo("login_enc","login_enc",25,30,""," ").
		    campo("login_resp","login_resp",25,30,""," ").
		    areaCorta("observacion","obser_all",30,1,"","").
		    campo("status","status_all",20,30,"ASIGNADO"," ").
			campoOculto("dato","dato").
			botones(registrar("asigna_llamada"),modificar("asigna_llamada"),eliminar("asigna_llamada"),cancelar()).
			ultimo();
		break;
	case asig_lla_cli:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de asig_lla_cli");
		return    $titulo.
		    cabecera().
		    campoClave("id_lc","id_lc",10,30,"onChange","validarasig_lla_cli()",'<?php $acceso->objeto->ejecutarSql("select *from asig_lla_cli ORDER BY id_lc desc"); echo "COD".verCo($acceso,"id_lc")?>').
		    campo("id_all","id_all",10,30,""," ").
		    campo("id_contrato","id_contrato",10,30,""," ").
		    campo("id_lla","id_lla",10,30,""," ").
		    campo("status_lc","status_lc",20,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("asig_lla_cli"),modificar("asig_lla_cli"),eliminar("asig_lla_cli"),cancelar()).
			ultimo();
		break;
	case tipo_llamada:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de tipo_llamada");
		return    $titulo.
		    cabecera().
		    campoClave("id_tll","id_tll",10,30,"onChange","validartipo_llamada()",'<?php $acceso->objeto->ejecutarSql("select *from tipo_llamada ORDER BY id_tll desc"); echo "COD".verCo($acceso,"id_tll")?>').
		    campo("nombre","nombre_tll",100,30,""," ").
			fila(columna(fuente("status")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_tll").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_tll").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("tipo_llamada"),modificar("tipo_llamada"),eliminar("tipo_llamada"),cancelar()).
			ultimo();
		break;
	case llamadas:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de llamadas");
		return    $titulo.
		    cabecera().
		    campoClave("id_lla","id_lla",10,30,"onChange","validarllamadas()",'<?php $acceso->objeto->ejecutarSql("select *from llamadas ORDER BY id_lla desc"); echo "COD".verCo($acceso,"id_lla")?>').
			menu("DETALLE LLAMADA",select("id_drl",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
			menu("TIPO LLAMADA",select("id_tll",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    campo("id_contrato","id_contrato",10,30,""," ").
		    fechaepoch("fecha","fecha_lla").
		    campo("hora","hora_lla",10,30,""," ").
		    campo("login","login",25,30,""," ").
		    areaCorta("observacion","obser_lla",30,1,"","").
			fila(columna(fuente("crear alarma")).columna(fuente("NO".input(tipo("radio").nombre("crea_alarma").valor("NO"). "CHECKED")."&nbsp;&nbsp;&nbsp;SI".input(tipo("radio").nombre("crea_alarma").valor("SI"))))).
			campoOculto("dato","dato").
			botones(registrar("llamadas"),modificar("llamadas"),eliminar("llamadas"),cancelar()).
			ultimo();
		break;
	case detalle_resp:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de detalle_resp");
		return    $titulo.
		    cabecera().
		    campoClave("id_drl","id_drl",10,30,"onChange","validardetalle_resp()",'<?php $acceso->objeto->ejecutarSql("select *from detalle_resp ORDER BY id_drl desc"); echo "COD".verCo($acceso,"id_drl")?>').
			menu("TIPO LLAMADA",select("id_trl",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    campo("NOMBRE","nombre_drl",100,30,""," ").
			fila(columna(fuente("status")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_drl").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_drl").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("detalle_resp"),modificar("detalle_resp"),eliminar("detalle_resp"),cancelar()).
			ultimo();
		break;
	case tipo_resp:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de tipo_resp");
		return    $titulo.
		    cabecera().
		    campoClave("id_trl","id_trl",10,30,"onChange","validartipo_resp()",'<?php $acceso->objeto->ejecutarSql("select *from tipo_resp ORDER BY id_trl desc"); echo "COD".verCo($acceso,"id_trl")?>').
		    campo("nombre","nombre_trl",50,30,""," ").
			fila(columna(fuente("status")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_trl").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_trl").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("tipo_resp"),modificar("tipo_resp"),eliminar("tipo_resp"),cancelar()).
			ultimo();
		break;
	case cat_inc:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de cat_inc");
		return    $titulo.
		    cabecera().
		    campoClave("id_cat_s","id_cat_s",8,30,"onChange","validarcat_inc()",'<?php $acceso->objeto->ejecutarSql("select *from cat_inc ORDER BY id_cat_s desc"); echo "COD".verCo($acceso,"id_cat_s")?>').
		    campo("categoria","nombre_cat_s",100,30,""," ").
			fila(columna(fuente("status_cat_s")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_cat_s").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_cat_s").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("cat_inc"),modificar("cat_inc"),eliminar("cat_inc"),cancelar()).
			ultimo();
		break;
	case sub_cat_inc:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de sub_cat_inc");
		return    $titulo.
		    cabecera().
		    campoClave("id_sub_cat_s","id_sub_cat_s",8,30,"onChange","validarsub_cat_inc()",'<?php $acceso->objeto->ejecutarSql("select *from sub_cat_inc ORDER BY id_sub_cat_s desc"); echo "COD".verCo($acceso,"id_sub_cat_s")?>').
			menu("categoria",select("id_cat_s",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    campo("Sub categoria","nombre_sub_cat_s",30,200,""," ").
			fila(columna(fuente("status")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_sub_cat_s").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_sub_cat_s").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("sub_cat_inc"),modificar("sub_cat_inc"),eliminar("sub_cat_inc"),cancelar()).
			ultimo();
		break;
	case incidencia:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de incidencia");
		return    $titulo.
		    cabecera().
		    campoClave("nro_inc","nro_inc",10,30,"onChange","validarincidencia()",'<?php $acceso->objeto->ejecutarSql("select *from incidencia ORDER BY nro_inc desc"); echo "COD".verCo($acceso,"nro_inc")?>').
			menu("Sub categoria",select("id_sub_cat_s",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    fechaepoch("fecha inc","fecha_inc").
			menu("prioridad",select("prioridad_inc",'<option value="0">Seleccione...</option><option value="REGISTRADA">REGISTRADA</option><option value="ASIGNADA">ASIGNADA</option><option value="EN SOLUCION">EN SOLUCION</option><option value="REASIGNADO">REASIGNADO</option><option value="SOLUCIONADO">SOLUCIONADO</option><option value="SIN SOLUCION">SIN SOLUCION</option><option value="CANCELADO">CANCELADO</option>',null)).
		    fechaepoch("fecha sol","fecha_sol").
		    fechaepoch("fecha ven","fecha_ven").
		    areaCorta("incidencia reg","incidencia",30,2,"","").
		    areaCorta("solucion_inc","solucion_inc",30,2,"","").
		    areaCorta("observacion","obser_inc",30,2,"","").
		    campo("login_resp","login_resp",25,30,""," ").
			menu("status",select("status_inc",'<option value="0">Seleccione...</option><option value="BAJA">BAJA</option><option value="MEDIA">MEDIA</option><option value="ALTA">ALTA</option>',null)).
			menu("tipo_inc",select("tipo_inc",'<option value="0">Seleccione...</option><option value="PRIVADO">PRIVADO</option><option value="PUBLICO">PUBLICO</option>',null)).
		    campo("id_contacto","id_contacto",10,30,""," ").
		    campo("id_contrato","id_contrato",10,30,"10"," ").
			campoOculto("dato","dato").
			botones(registrar("incidencia"),modificar("incidencia"),eliminar("incidencia"),cancelar()).
			ultimo();
		break;
	case ayuda_inc:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de ayuda_inc");
		return    $titulo.
		    cabecera().
		    campoClave("id_ay","id_ay",10,30,"onChange","validarayuda_inc()",'<?php $acceso->objeto->ejecutarSql("select *from ayuda_inc ORDER BY id_ay desc"); echo "COD".verCo($acceso,"id_ay")?>').
		    campo("nro_inc","nro_inc",10,30,""," ").
		    campo("login","login",25,30,""," ").
		    areaCorta("descripcion","descripcion",30,2,"","").
		    fechaepoch("fecha","fecha").
			campoOculto("dato","dato").
			botones(registrar("ayuda_inc"),modificar("ayuda_inc"),eliminar("ayuda_inc"),cancelar()).
			ultimo();
		break;
	case detalle_tipopago_df:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de detalle_tipopago_df");
		return    $titulo.
		    cabecera().
		    campoClave("id_dbf","id_dbf",8,30,"onChange","validardetalle_tipopago_df()",'<?php $acceso->objeto->ejecutarSql("select *from detalle_tipopago_df ORDER BY id_dbf desc"); echo "COD".verCo($acceso,"id_dbf")?>').
			menu("id_tipo_pago",select("id_tipo_pago",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
			menu("cuenta bancaria",select("id_cuba",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
			menu("pagos pendientes",select("id_df_tp",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    fechaepoch("fecha pago","fecha_dbf").
		    campo("referencia","refer_dbf",25,30,""," ").
		    campo("monto","monto_dbf",10,30,""," ").
		    areaCorta("observacion","obser_dbf",2,30,"","").
		    campo("status","status_dbf",20,30,"REGISTRADO"," ").
		    campo("hora","hora_dbf",8,30,""," ").
		    campo("login","login_dbf",25,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("detalle_tipopago_df"),modificar("detalle_tipopago_df"),eliminar("detalle_tipopago_df"),cancelar()).
			ultimo();
		break;
	case carga_tabla_banco:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de carga_tabla_banco");
		return    $titulo.
		    cabecera().
		    campoClave("id_ctb","id_ctb",30,30,"onChange","validarcarga_tabla_banco()",'<?php $acceso->objeto->ejecutarSql("select *from carga_tabla_banco ORDER BY id_ctb desc"); echo "COD".verCo($acceso,"id_ctb")?>').
			menu("cuenta bancaria",select("id_cuba",'<option value="0">Seleccione...</option><option value="1">1</option>',null)).
		    fechaepoch("fecha","fecha_ctb").
		    campo("hora","hora_ctb",8,30,""," ").
		    campo("login","login_ctb",25,30,""," ").
		    fechaepoch("fecha desde","fecha_desde_ctb").
		    fechaepoch("fecha hasta","fecha_hasta_ctb").
		    campo("status","status_ctb",20,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("carga_tabla_banco"),modificar("carga_tabla_banco"),eliminar("carga_tabla_banco"),cancelar()).
			ultimo();
		break;
	case tabla_bancos:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de tabla_bancos");
		return    $titulo.
		    cabecera().
		    campoClave("id_tb","id_tb",10,30,"onChange","validartabla_bancos()",'<?php $acceso->objeto->ejecutarSql("select *from tabla_bancos ORDER BY id_tb desc"); echo "COD".verCo($acceso,"id_tb")?>').
		    campo("id_ctb","id_ctb",8,30,""," ").
		    fechaepoch("fecha_tb","fecha_tb").
		    campo("tipo_tb","tipo_tb",30,30,""," ").
		    campo("referencia_tb","referencia_tb",30,30,""," ").
		    campo("monto_tb","monto_tb",10,30,""," ").
		    areaCorta("descrip_tb","descrip_tb",30,2,"","").
		    campo("status_tb","status_tb",20,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("tabla_bancos"),modificar("tabla_bancos"),eliminar("tabla_bancos"),cancelar()).
			ultimo();
		break;
	case tipo_pago_df:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de tipo_pago_df");
		return    $titulo.
		    cabecera().
		    campoClave("id_tipo_pago","id_tipo_pago",8,30,"onChange","validartipo_pago_df()",'<?php $acceso->objeto->ejecutarSql("select *from tipo_pago_df ORDER BY id_tipo_pago desc"); echo "COD".verCo($acceso,"id_tipo_pago")?>').
		    campo("tipo de pago","tipo_pago",30,30,""," ").
			menu("tipo tp",select("tipo_tp",'<option value="0">Seleccione...</option><option value="FACTURAS">FACTURAS</option><option value="PAGOS">PAGOS</option>',null)).
			fila(columna(fuente("status")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_pago").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_pago").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("tipo_pago_df"),modificar("tipo_pago_df"),eliminar("tipo_pago_df"),cancelar()).
			ultimo();
		break;
			default:
	}// fin switch
}
?>