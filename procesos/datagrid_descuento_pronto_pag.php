<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_dpp,nombre_franq,dia_dpp,monto_dpp,obser_dpp,status_dpp", "descuento_pronto_pag,franquicia","id_dpp","descuento_pronto_pag.id_franq=franquicia.id_franq");
$x->hideColumn('id_dpp');
$x->hideColumn('dato');
$x->setColumnHeader('nombre_franq','Franquicia');
$x->setColumnHeader('dia_dpp','Hasta el Día');
$x->setColumnHeader('monto_dpp','Monto');
$x->setColumnHeader('obser_dpp','Observación');
$x->setColumnHeader('status_dpp','Estatus');
$x->setColumnHeader('','');
$x->setColumnHeader('','');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@descuento_pronto_pag','id_dpp=@%id_dpp%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificardescuento_pronto_pag('%id_dpp%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminardescuento_pronto_pag('%id_dpp%')");
*/
$x->printTable();
?>
