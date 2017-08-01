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
				botones(boton("Ejecutar Limpiador","registrar",'verificar_mat(\'incluir\',\'Limpiador\')',"button"),BOculto('modificar'),BOculto('eliminar'),'').
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
		    campoClave("idPersona","idPersona",8,30,"onChange","validarPersona_mat()",'<?php $acceso->objeto->ejecutarSql("select *from persona ORDER BY idPersona desc"); echo "COD".verCo($acceso,"idPersona")?>').
		    campo("Cedula","cedula",8,30,""," ").
		    campo("Nombre","nombre",30,30,""," ").
		    campo("Apellido","apellido",30,30,""," ").
		    campo("edad","edad",2,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("Persona"),modificar("Persona"),eliminar("Persona"),cancelar()).
			ultimo();
		break;
	case motivo_inv:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de motivo_inv");
		return    $titulo.
		    cabecera().
		    campoClave("id_motivo","id_motivo",3,30,"onChange","validarmotivo_inv()",'<?php $acceso->objeto->ejecutarSql("select *from motivo_inv ORDER BY id_motivo desc"); echo "COD".verCo($acceso,"id_motivo")?>').
		    campo("nombre","nombre_motivo",30,30,""," ").
			fila(columna(fuente("Status")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_motivo").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_motivo").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("motivo_inv"),modificar("motivo_inv"),eliminar("motivo_inv"),cancelar()).
			ultimo();
		break;
	case familia:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de familia");
		return    $titulo.
		    cabecera().
		    campoClave("id_fam","id_fam",5,30,"onChange","validarfamilia()",'<?php $acceso->objeto->ejecutarSql("select *from familia ORDER BY id_fam desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_fam")?>').
		    campo("Nombre Familia","nombre_fam",50,30,""," ").
			fila(columna(fuente("Status")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_fam").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_fam").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("familia"),modificar("familia"),eliminar("familia"),cancelar()).
			ultimo();
		break;
	case inventario_materiales:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de inventario_materiales");
		return    $titulo.
		    cabecera().
		    campoClave("id_mat","id_mat",10,30,"onChange","validarinventario_materiales()",'<?php $acceso->objeto->ejecutarSql("select *from inventario_materiales ORDER BY id_mat desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_mat")?>').
		    campo("id_inv","id_inv",8,30,""," ").
		    campo("cant_sist","cant_sist",8,30,""," ").
		    campo("cant_real","cant_real",8,30,""," ").
		    areaCorta("justi_inv","justi_inv",20,2,"","").
			campoOculto("dato","dato").
			botones(registrar("inventario_materiales"),modificar("inventario_materiales"),eliminar("inventario_materiales"),cancelar()).
			ultimo();
		break;
	case deposito:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de deposito");
		return    $titulo.
		    cabecera().
		    campoClave("id_dep","id_dep",8,30,"onChange","validardeposito()",'<?php $acceso->objeto->ejecutarSql("select *from deposito ORDER BY id_dep desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_dep")?>').
		    campo("Nombre Deposito","nombre_dep",50,40,""," ").
		    areaCorta("Descripcion Deposito","descrip_dep",20,2,"","").
			fila(columna(fuente("Status")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_dep").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_dep").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("deposito"),modificar("deposito"),eliminar("deposito"),cancelar()).
			ultimo();
		break;
	case unidad_medida:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de unidad_medida");
		return    $titulo.
		    cabecera().
		    campoClave("id_unidad","id_unidad",8,30,"onChange","validarunidad_medida()",'<?php $acceso->objeto->ejecutarSql("select *from unidad_medida ORDER BY id_unidad desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_unidad")?>').
		    campo("Nombre Unidad","nombre_unidad",30,30,""," ").
		    campo("Unidad Entrante","unidad_ent",10,30,""," ").
		    campo("Unidad Saliente","unidad_sal",10,30,""," ").
			fila(colspan(fuenteN("Status"),2,1)).
			fila(colspan(input(tipo("checkbox").nombre("status_unidad").valor("")."").fuente("ACTIVO&nbsp;&nbsp;&nbsp;").input(tipo("checkbox").nombre("status_unidad").valor("")."").fuente("INACTIVO&nbsp;&nbsp;&nbsp;"),2,1)).
			campoOculto("dato","dato").
			botones(registrar("unidad_medida"),modificar("unidad_medida"),eliminar("unidad_medida"),cancelar()).
			ultimo();
		break;
	case tipo_movimiento:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de tipo_movimiento");
		return    $titulo.
		    cabecera().
		    campoClave("id_tm","id_tm",8,30,"onChange","validartipo_movimiento()",'<?php $acceso->objeto->ejecutarSql("select *from tipo_movimiento ORDER BY id_tm desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_tm")?>').
		    campo("Nombre Tipo Movimiento","nombre_tm",50,40,""," ").
		    campo("Tipo Entrada Saliente","tipo_ent_sal",10,30,""," ").
		    campo("Uso Tipo de Movimiento","uso_tm",15,30,""," ").
			fila(colspan(fuenteN("Status"),2,1)).
			fila(colspan(input(tipo("checkbox").nombre("status_tm").valor("")."").fuente("ACTIVO&nbsp;&nbsp;&nbsp;").input(tipo("checkbox").nombre("status_tm").valor("")."").fuente("INACTIVO&nbsp;&nbsp;&nbsp;"),2,1)).
			campoOculto("dato","dato").
			botones(registrar("tipo_movimiento"),modificar("tipo_movimiento"),eliminar("tipo_movimiento"),cancelar()).
			ultimo();
		break;
	case movimiento:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de movimiento");
		return    $titulo.
		    cabecera().
		    campoClave("id_mov","id_mov",8,30,"onChange","validarmovimiento()",'<?php $acceso->objeto->ejecutarSql("select *from movimiento ORDER BY id_mov desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_mov")?>').
		    campo("id_tm","id_tm",8,30,""," ").
		    fechaepoch("Fecha","fecha_ent_sal").
		    campo("Hora","hora_ent_sal",15,30,""," ").
		    areaCorta("observacion","observacion",20,2,"","").
		    campo("referencia","referencia",15,30,""," ").
		    campo("tipo_mov","tipo_mov",20,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("movimiento"),modificar("movimiento"),eliminar("movimiento"),cancelar()).
			ultimo();
		break;
	case proveedor:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de proveedor");
		return    $titulo.
		    cabecera().
		    campoClave("id_prov","id_prov",8,30,"onChange","validarproveedor()",'<?php $acceso->objeto->ejecutarSql("select *from proveedor ORDER BY id_prov desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_prov")?>').
		    campo("Rif. Proveedor","rif_prov",15,30,""," ").
		    campo("Nombre Proveedor","nombre_prov",50,50,""," ").
		    areaCorta("Direccion Proveedor","direccion_prov",20,2,"","").
		    campo("Telefonos Proveedor","telefonos_prov",50,50,""," ").
		    campo("Fax Proveedor","fax_prov",20,30,""," ").
		    campo("Pagina Web Proveedor","web_prov",30,50,""," ").
		    campo("Email Provedor","email_prov",40,50,""," ").
		    areaCorta("Observacion Proveedor","obser_prov",20,2,"","").
			menu("Forma Pago",select("forma_pago",'<option value="0">Seleccione...</option><option value="EFECTIVO">EFECTIVO</option><option value="CREDITO">CREDITO</option>',null)).
		    campo("banco","banco",50,50,""," ").
		    campo("cuenta","cuenta",25,30,""," ").
		    campo("contacto","contacto",50,50,""," ").
			fila(columna(fuente("Status")).columna(fuente("ACTIVO".input(tipo("radio").nombre("status_prov").valor("ACTIVO"). "CHECKED")."&nbsp;&nbsp;&nbsp;INACTIVO".input(tipo("radio").nombre("status_prov").valor("INACTIVO"))))).
			campoOculto("dato","dato").
			botones(registrar("proveedor"),modificar("proveedor"),eliminar("proveedor"),cancelar()).
			ultimo();
		break;
	case pedido:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de pedido");
		return    $titulo.
		    cabecera().
		    campoClave("id_ped","id_ped",8,30,"onChange","validarpedido()",'<?php $acceso->objeto->ejecutarSql("select *from pedido ORDER BY id_ped desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_ped")?>').
			menu("id_prov",select("id_prov",'<option value="0">Seleccione...</option><option value="0">..Seleccione..</option><option value="CO000001">CO000001</option>',null)).
		    fechaepoch("Fecha del Pedido","fecha_ped").
		    fechaepoch("Fecha de Entrega","fecha_ent").
			fila(columna(fuente("Status")).columna(fuente("ACTIVO,INACTIVO".input(tipo("radio").nombre("status_ped").valor("ACTIVO,INACTIVO"). "CHECKED")))).
		    areaCorta("Observacion Pedido","obser_ped",20,2,"","").
		    campo("Num Factura","nro_fact_ped",10,30,""," ").
		    campo("porc_desc","porc_desc",3,20,""," ").
		    campo("desc_ped","desc_ped",10,20,""," ").
		    campo("base_ped","base_ped",10,20,""," ").
		    campo("iva_ped","iva_ped",10,20,""," ").
		    campo("total_ped","total_ped",10,20,""," ").
			campoOculto("dato","dato").
			botones(registrar("pedido"),modificar("pedido"),eliminar("pedido"),cancelar()).
			ultimo();
		break;
	case materiales:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de materiales");
		return    $titulo.
		    cabecera().
		    campoClave("id_mat","id_mat",10,30,"onChange","validarmateriales_mat()",'<?php $acceso->objeto->ejecutarSql("select *from materiales ORDER BY id_mat desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_mat")?>').
		    campo("Numero de Meterales","numero_mat",10,30,""," ").
		    campo("Nombre del Material","nombre_mat",50,30,""," ").
			menu("Tipo Unidad de Medida",select("id_unidad",'<option value="0">Seleccione...</option><option value="0">Seleccione..</option><option value="1">ok</option>',null)).
			menu("Deposito",select("id_dep",'<option value="0">Seleccione...</option><option value="0">Seleccione..</option><option value="1">Deposito</option>',null)).
			menu("Familia",select("id_fam",'<option value="0">Seleccione...</option><option value="0">Seleccione..</option><option value="1">familia</option>',null)).
		    campo("Stock","stock",8,30,""," ").
		    campo("Cantidad Minima en Stock","stock_min",4,25,""," ").
		    areaCorta("Observacion","observacion",20,2,"","").
		    campo("Precio_u_p","precio_u_p",10,25,""," ").
		    campo("Cant. Unid. Entrante","c_uni_ent",4,25,""," ").
		    campo("Cant. Unid. Entrante","c_uni_sal",4,25,""," ").
			campoOculto("dato","dato").
			botones(registrar("materiales"),modificar("materiales"),eliminar("materiales"),cancelar()).
			ultimo();
		break;
	case mov_mat:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de mov_mat");
		return    $titulo.
		    cabecera().
		    campoClave("Materiales","id_mat",1,1,"onChange","validarmov_mat()","0,Seleccione..;
1,ok").
		    campo("id_mov","id_mov",8,30,""," ").
		    campo("cant_mov","cant_mov",4,20,""," ").
			campoOculto("dato","dato").
			botones(registrar("mov_mat"),modificar("mov_mat"),eliminar("mov_mat"),cancelar()).
			ultimo();
		break;
	case motivo_inv:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de motivo_inv");
		return    $titulo.
		    cabecera().
			campoOculto("dato","dato").
			botones(registrar("motivo_inv"),modificar("motivo_inv"),eliminar("motivo_inv"),cancelar()).
			ultimo();
		break;
	case mat_prov:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de mat_prov");
		return    $titulo.
		    cabecera().
		    campoClave("id_mat","id_mat",10,30,"onChange","validarmat_prov()","").
		    campo("id_prov","id_prov",8,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("mat_prov"),modificar("mat_prov"),eliminar("mat_prov"),cancelar()).
			ultimo();
		break;
	case mat_ped:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de mat_ped");
		return    $titulo.
		    cabecera().
		    campoClave("id_mat","id_mat",10,30,"onChange","validarmat_ped()","").
		    campo("id_ped","id_ped",8,30,""," ").
		    campo("Cantidad Pedido","cant_ped",4,20,""," ").
		    campo("Cantidad Entrante","cant_ent",4,20,""," ").
		    campo("Precio","precio",10,20,""," ").
			campoOculto("dato","dato").
			botones(registrar("mat_ped"),modificar("mat_ped"),eliminar("mat_ped"),cancelar()).
			ultimo();
		break;
	case inventario:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de inventario");
		return    $titulo.
		    cabecera().
		    campoClave("id_inv","idinventario",8,30,"onChange","validarinventario_mat()",'<?php $acceso->objeto->ejecutarSql("select *from inventario ORDER BY idinventario desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"idinventario")?>').
			menu("id_motivo",select("idmotivo",'<option value="0">Seleccione...</option><option value="seleccione">0</option><option value="dos">1</option>',null)).
		    fechaepoch("fechainv","fechainv").
		    campo("hora_inv","horainv",12,30,""," ").
		    areaCorta("obser_inv","obserinv",20,2,"","").
		    campo("tipo_inv","tipoinv",15,30,""," ").
			menu("id_dep",select("iddep",'<option value="0">Seleccione...</option><option value="seleccione">0</option><option value="uno">1</option>',null)).
			menu("id_fam",select("idfam",'<option value="0">Seleccione...</option><option value="seleccione">0</option><option value="uno">1</option>',null)).
			campoOculto("dato","dato").
			botones(registrar("inventario"),modificar("inventario"),eliminar("inventario"),cancelar()).
			ultimo();
		break;
	case aprobarinventario:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de aprobarinventario");
		return    $titulo.
		    cabecera().
			campoOculto("dato","dato").
			botones(registrar("aprobarinventario"),modificar("aprobarinventario"),eliminar("aprobarinventario"),cancelar()).
			ultimo();
		break;
	case matpadre:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de matpadre");
		return    $titulo.
		    cabecera().
		    campoClave("id_m","id_m",10,30,"onChange","validarmatpadre()",'<?php $acceso->objeto->ejecutarSql("select *from matpadre ORDER BY id_m desc LIMIT 1 offset 0"); echo "CO".verCo($acceso,"id_m")?>').
			menu("id_unidad",select("id_unidad",'<option value="0">Seleccione...</option><option value="seleccione">0</option><option value="uno">1</option>',null)).
			menu("id_fam",select("id_fam",'<option value="0">Seleccione...</option><option value="selecciones">0</option><option value="uno">1</option>',null)).
		    campo("numero_mat","numero_mat",8,30,""," ").
		    campo("nombre_mat","nombre_mat",50,30,""," ").
		    campo("precio_u_p","precio_u_p",10,30,""," ").
		    campo("c_uni_ent","c_uni_ent",4,30,""," ").
		    campo("c_uni_sal","c_uni_sal",4,30,""," ").
			campoOculto("dato","dato").
			botones(registrar("matpadre"),modificar("matpadre"),eliminar("matpadre"),cancelar()).
			ultimo();
		break;
	case ejempl:
		$titulo='<?php require_once "procesos.php"; ?>
'.titulo("Administracion de ejempl");
		return    $titulo.
		    cabecera().
			campoOculto("dato","dato").
			botones(registrar("ejempl"),modificar("ejempl"),eliminar("ejempl"),cancelar()).
			ultimo();
		break;
			default:
	}// fin switch
}
?>