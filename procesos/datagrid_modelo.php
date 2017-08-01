<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_modelo,nombre_modelo,nombre_marca,sistema,status_modelo", "vista_modelo","id_modelo","");
$x->hideColumn('id_modelo');
$x->setColumnHeader('tipo_modelo', 'sistema');
$x->setColumnHeader('nombre_modelo', 'nombre modelo');
$x->setColumnHeader('nombre_marca', 'nombre Marca');
$x->setColumnHeader('status_modelo', 'Status');


//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_modelo('%id_modelo%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmodelo('%id_modelo%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmodelo('%id_modelo%')");
*/
$x->printTable();
?>
