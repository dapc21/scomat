<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("","","","");
//$x->hideOrder();
$x->showRowNumber();
$x->setResultsPerPage(20);
$x->printTable();
?>
