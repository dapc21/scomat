<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave

$serial_deco=$_GET['serial_deco'];

if($serial_deco!=''){
	$where="and serial_deco='$serial_deco'";
}else{
//	$where="status_accquery='FALSE'";
}

$x->setQuery("id_accquery,punto_da,serial_deco,comando_acc,fecha_accquery,status_accquery,errmsg", "interfazacc,deco_ana","id_accquery","interfazacc.serial_deco=deco_ana.codigo_da  $where");
$x->hideColumn('dato');
$x->hideColumn('fecha_accquery');
$x->hideColumn('id_accquery');
$x->setColumnHeader('serial_deco', 'serial decodificador');
$x->setColumnHeader('fecha_accquery', 'fecha');
$x->setColumnHeader('comando_acc', 'comando');
$x->setColumnHeader('status_accquery', 'status');
$x->setColumnHeader('errmsg', 'errmsg');
$x->setColumnHeader('punto_da', 'codificacion');
$x->setColumnType('fecha_accquery', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@interfazacc','id_accquery=@%id_accquery%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarinterfazacc('%id_accquery%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarinterfazacc('%id_accquery%')");
*/
$x->printTable();
?>
