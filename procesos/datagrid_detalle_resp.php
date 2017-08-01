<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_drl,nombre_drl,nombre_trl,status_drl", "detalle_resp,tipo_resp","id_drl","detalle_resp.id_trl=tipo_resp.id_trl");

$x->hideColumn('dato');
$x->hideColumn('id_drl');
$x->setColumnHeader('nombre_trl', 'nombre tipo RESPUESTA');
$x->setColumnHeader('nombre_drl', 'nombre DETALLE RESPUESTA');
$x->setColumnHeader('status_drl', 'status');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);

$x->addRowSelect("buscar_id_drl('%id_drl%');window.location.replace('#');");

//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@detalle_resp','id_drl=@%id_drl%');window.location.replace('#');");
/*

//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificardetalle_resp('%id_drl%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminardetalle_resp('%id_drl%')");
*/
$x->printTable();
?>
