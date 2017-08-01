<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" id_franq='$id_f'";
	}
$desde=$_GET['desde'];
$hasta=$_GET['hasta'];
$id_franq=$_GET['id_franq'];
$tipo_fecha=$_GET['tipo_fecha'];
$where="id_pd <>'' and status_pd='CONFIRMADO' ";
if($desde!='' && $hasta!=''){
	$desde=formatfecha($desde);
	$hasta=formatfecha($hasta);
	$where =$where." and  $tipo_fecha between '$desde' and '$hasta'";
}
if($id_franq!='0' && $id_franq!=''){
//	$where =$where." and id_franq='$id_franq'";
}
else{
	if($id_f!='0'){
	//	$where =$where." and id_franq='$id_f'";
	}
}
//echo "$where";

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_pd, nro_contrato, nombre || ' ' || apellido as cliente, fecha_reg, fecha_dep, banco, numero_ref, monto_dep,tipo_dt,cedula_titular, nombre_franq,login_conf,obser_p", "vista_pagodeposito","id_pd","$where");
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
$x->setColumnHeader('login_conf', 'conf. por');
$x->setColumnHeader('cedula_titular', 'cedula');
$x->setColumnHeader('obser_p', 'obser');

$x->setColumnType('fecha_reg', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_dep', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('monto_dep', EyeDataGrid::TYPE_MONTO);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
$x->showCheckboxes();
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

//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@pagodeposito','id_pd=@%id_pd%')");

//para que activar el boton modificar
//$x->addStandardControl(EyeDataGrid::STDCTRL_CONFIRMAR, "confirmarpagodeposito('%id_pd%')");
//para activar el boton eliminar
//$x->addStandardControl(EyeDataGrid::STDCTRL_NEGAR, "negarpagodeposito('%id_pd%')");

$x->printTable();
?>
