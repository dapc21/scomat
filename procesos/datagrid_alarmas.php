<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_accquery,serial_deco,comando_acc,status_accquery", "interfazacc","id_accquery","");
$x->hideColumn('id_accquery');
$x->setColumnHeader('serial_deco','SERIAL DECO');
$x->setColumnHeader('comando_acc','comando');
$x->setColumnHeader('status_accquery','satatus');


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
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificaralarmas('%id_accquery%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminaralarmas('%id_accquery%')");
*/
$x->printTable();
?>
