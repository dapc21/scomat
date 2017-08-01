<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
$x->setQuery("*", "conv_con","id_conv_cont","");
$x->hideColumn('dato');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');

$x->showRowNumber();

$x->setResultsPerPage(20);
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@conv_con','id_conv_cont=@%id_conv_cont%');window.location.replace('#');");

$x->printTable();
?>
