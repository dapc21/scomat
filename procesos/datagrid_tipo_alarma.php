<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_tipo_alarma,nombre_alarma,status_alarma", "tipo_alarma","id_tipo_alarma","");
$x->hideColumn('id_tipo_alarma');
$x->setColumnHeader('nombre_alarma','nombre');
$x->setColumnHeader('status_alarma','status');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@tipo_alarma','id_tipo_alarma=@%id_tipo_alarma%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificartipo_alarma('%id_tipo_alarma%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminartipo_alarma('%id_tipo_alarma%')");
*/
$x->printTable();
?>
