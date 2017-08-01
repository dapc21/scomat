<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
/*	
	if($id_f!='0'){
		$consult=" and  id_franq='$id_f'";
	}
*/
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_pago, id_nota, nro_contrato, nombre || ' ' || apellido as cliente, tipo,fecha_sol,monto_pago, nombremotivonota,login_sol,comentario_sol", "vista_notas_cd","id_pago","status='SOLICITADA' $consult");
$x->hideColumn('id_nota');
$x->hideColumn('id_pago');
/*
$x->hideColumn('nro_contrato');
$x->hideColumn('fecha');
$x->hideColumn('monto_anterior');
$x->hideColumn('comentario');
$x->hideColumn('servicio');
*/
$x->setColumnHeader("nro_nota", "Nro Nota");
$x->setColumnHeader("nro_contrato", "Contrato");
$x->setColumnHeader("comentario_sol",_("Descripcion "));
$x->setColumnHeader("nombremotivonota",_("Motivo"));
$x->setColumnHeader("monto_posterior",_("Monto Pos."));
$x->setColumnHeader("monto_anterior",_("Monto Ant."));
$x->setColumnHeader("monto_pago",_("Monto D/C"));
$x->setColumnHeader("hora,",_("Hora"));
$x->setColumnHeader("fecha_sol",_("Fecha D/C"));
$x->setColumnHeader("dir_ip",_("IP Equipo"));
$x->setColumnHeader("tipo",_("Tipo"));
$x->setColumnHeader("generado_por",_("Generado Por"));
$x->setColumnHeader("login_sol",_("Solicitado Por"));
$x->setColumnHeader("login_aut",_("Autorizado Por"));
$x->setColumnHeader("status",_("Estatus"));

$x->setColumnHeader('nombre_franq', 'Franquicia');
$x->setColumnHeader('cliente', 'cliente');



$x->setColumnType('monto_anterior', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_posterior', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_pago', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('fecha_sol', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0){
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0){
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->showCheckboxes();

//$x->addRowSelect("traerpagodeposito_mod('%id_nota%','%numero_ref%','%monto_dep%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "ajaxVentana_msg('ver_detalle_nota_credito.php','%id_pago%','Detalle de Nota de Credito');");
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_CONFIRMAR, "autorizar_nota_cd_fiscal('%id_pago%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_NEGAR, "negar_nota_cd_fiscal('%id_pago%')");
$x->printTable();


echo '<button class="btn btn-success" type="button" name="autorizar_todas" id="autorizar_todas" onclick="autorizar_notas_seleccionada()" value=""><i class="glyphicon glyphicon-ok"></i> autorizar solicitudes seleccionadas</button>&nbsp; &nbsp; &nbsp;';
echo '<button class="btn btn-danger" type="button" name="autorizar_todas" id="autorizar_todas" onclick="negar_notas_seleccionada()" value=""><i class="glyphicon glyphicon-trash"></i> Negar solicitudes seleccionadas</button>';
?>
