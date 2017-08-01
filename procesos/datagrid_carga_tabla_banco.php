<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
$fecha=date("Y-m-d");
$fecha=restadia($fecha,1);
//campos, tabla, campo clave
$x->setQuery("id_ctb,abrev_cuba,fecha_ctb,fecha_desde_ctb,fecha_hasta_ctb,login_ctb,(select count(*) from tabla_bancos where tabla_bancos.id_ctb=carga_tabla_banco.id_ctb ) as registro", "carga_tabla_banco, cuenta_bancaria","id_ctb","carga_tabla_banco.id_cuba=cuenta_bancaria.id_cuba and fecha_ctb>='$fecha' ");
//$x->hideColumn('id_ctb');
$x->setColumnHeader('abrev_cuba', 'Cuenta Bancaria');
$x->setColumnHeader('login_ctb', 'responsable');
$x->setColumnHeader('abrev_cuba', 'Cuenta Bancaria');
$x->setColumnHeader('fecha_ctb', 'Fecha carga');
$x->setColumnHeader('fecha_desde_ctb', 'desde');
$x->setColumnHeader('fecha_hasta_ctb', 'hasta');
$x->setColumnHeader('registro', 'registros');

$x->setColumnType('fecha_ctb', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_desde_ctb', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_hasta_ctb', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);

$x->addRowSelect("buscar_id_carga_tabla_banco('%id_ctb%');window.location.replace('#');");

//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@carga_tabla_banco','id_ctb=@%id_ctb%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarcarga_tabla_banco('%id_ctb%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcarga_tabla_banco('%id_ctb%')");
*/
$x->printTable();
?>
