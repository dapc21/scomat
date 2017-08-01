<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_prec,nombre_prec,fecha_ing_prec,fecha_mod_prec,status_prec", "precintos","id_prec","");
$x->hideColumn('id_prec');
$x->setColumnHeader('nombre_prec','nombre_prec');
$x->setColumnHeader('fecha_ing_prec','fecha ingreso');
$x->setColumnHeader('fecha_mod_prec','fecha mod.');
$x->setColumnHeader('status_prec','status');

$x->setColumnType('fecha_ing_prec', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_mod_prec', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@precintos','id_prec=@%id_prec%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarprecintos('%id_prec%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarprecintos('%id_prec%')");
*/
$x->printTable();
?>
