<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_lla, login, nro_contrato,(nombre || ' ' || apellido) as cliente, fecha_lla, hora_lla, nombre_tll,nombre_trl , nombre_drl,obser_lla", "vista_llamadas","id_lla","");
$x->hideColumn('id_lla');
$x->setColumnHeader('login', 'responsable');
$x->setColumnHeader('fecha_lla', 'fecha');
$x->setColumnHeader('hora_lla', 'hora');
$x->setColumnHeader('nombre_tll', 'tipo');
$x->setColumnHeader('nombre_drl', 'detalle resp');
$x->setColumnHeader('nombre_trl', 'tipo resp.');
$x->setColumnHeader('cliente', 'cliente');
$x->setColumnHeader('obser_lla', 'obser_lla');
$x->setColumnHeader('', '');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_lla('%id_lla%');window.location.replace('#');");

//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@llamadas','id_lla=@%id_lla%')");

/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarllamadas('%id_lla%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarllamadas('%id_lla%')");
*/
$x->printTable();
?>
