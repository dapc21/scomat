<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave

$x->setQuery("id_rec,(nombre || ' ' || apellido) as cobrador,fecha_asig,desde,hasta,cantidad,obser_asig", "vista_asignarecibo","id_rec","");
//$x->setQuery("id_rec,(nombre || ' ' || apellido) as cobrador,fecha_asig,desde,hasta,cantidad,obser_asig", "vista_recibos","id_rec","");
$x->hideColumn('id_rec');
$x->setColumnHeader('cobrador', 'Cobrador');
$x->setColumnHeader('fecha_asig', 'Fecha');
$x->setColumnHeader('desde', 'Fact. Desde');
$x->setColumnHeader('hasta', 'Hasta');
$x->setColumnHeader('cantidad', 'Cantidad');
$x->setColumnHeader('obser_asig', 'Observacion');


$x->setColumnType('fecha_asig', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);


//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

//$x->addRowSelect("buscar_id_rec('%id_rec%');window.location.replace('#');");

$x->addRowSelect("conexionPHP('validarExistencia.php','1=@recibe_recibo','id_rec=@%id_rec%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarrecibe_recibo('%id_rec%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarrecibe_recibo('%id_rec%')");
*/
$x->printTable();
?>
