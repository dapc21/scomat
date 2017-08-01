<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
$id_contrato=$_GET['id_contrato'];

	session_start();
	$id_f = $_SESSION["id_franq"];
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_pd, fecha_reg, fecha_dep, banco, numero_ref, monto_dep,tipo_dt,status_pd,obser_p", "vista_pagodeposito","id_pd","(status_pd='REGISTRADO' or status_pd='CONFIRMADO' or status_pd='NEGADO') and id_contrato='$id_contrato' $consult ");
$x->hideColumn('id_pd');
$x->setColumnHeader('nro_contrato', 'contrato');
$x->setColumnHeader('cliente', 'cliente');
$x->setColumnHeader('nombre_sector', 'sector');
$x->setColumnHeader('nombre_franq', 'franquicia');
$x->setColumnHeader('fecha_reg', 'fecha reg.');
$x->setColumnHeader('fecha_dep', 'fecha dep.');
$x->setColumnHeader('banco', 'banco');
$x->setColumnHeader('numero_ref', 'num . referencia');
$x->setColumnHeader('monto_dep', 'monto');
$x->setColumnHeader('tipo_dt', 'tipo');
$x->setColumnHeader('login_reg', 'registrado por');
$x->setColumnHeader('cedula_titular', 'cedula');
$x->setColumnHeader('obser_p', 'obser');
$x->setColumnHeader('status_pd', 'status');

$x->setColumnType('fecha_reg', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_dep', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('monto_dep', EyeDataGrid::TYPE_MONTO);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->addRowSelect("conexionPHP('validarExistencia.php','1=@pagodeposito','id_pd=@%id_pd%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarpagodeposito('%id_pd%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarpagodeposito('%id_pd%')");
*/
$x->printTable();
?>
