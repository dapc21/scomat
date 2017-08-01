<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$id_contrato=$_GET['id_contrato'];
$x->setQuery("id_promo_con,nombre_promo,inicio_promo,fin_promo,status_promo_con", "vista_promocion","id_promo_con","id_contrato='$id_contrato'");
$x->hideColumn('id_promo_con');
$x->setColumnHeader('nombre_promo', 'Promoción');
$x->setColumnHeader('inicio_promo', 'Desde');
$x->setColumnHeader('fin_promo', 'Hasta');
$x->setColumnHeader('status_promo_con', 'Estatus');
$x->setColumnHeader('', '');
$x->setColumnHeader('', '');
$x->setColumnType('fin_promo', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('inicio_promo', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
$x->printTable();
?>
