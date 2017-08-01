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
$x->setColumnHeader('nombre_promo', 'Promocion');
$x->setColumnHeader('inicio_promo', 'valido desde');
$x->setColumnHeader('fin_promo', 'hasta');
$x->setColumnHeader('status_promo_con', 'Status');
$x->setColumnHeader('', '');
$x->setColumnHeader('', '');
$x->setColumnType('fin_promo', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('inicio_promo', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@promo_contrato','id_promo_con=@%id_promo_con%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarpromo_contrato('%id_promo_con%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarpromo_contrato('%id_promo_con%')");
*/
$x->printTable();
?>
