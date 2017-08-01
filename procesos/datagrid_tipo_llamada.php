<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("*", "tipo_llamada","id_tll","");
$x->hideColumn('dato');
$x->hideColumn('id_tll');
$x->setColumnHeader('nombre_tll', 'nombre tipo llamada');
$x->setColumnHeader('status_tll', 'status');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@tipo_llamada','id_tll=@%id_tll%');window.location.replace('#');");

$x->addRowSelect("buscar_id_tll('%id_tll%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificartipo_llamada('%id_tll%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminartipo_llamada('%id_tll%')");
*/
$x->printTable();
?>
