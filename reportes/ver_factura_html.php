<link rel="stylesheet" type="text/css" href="estilos/reset.css">
<link rel="stylesheet" type="text/css" href="estilos/css.css">

<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_pago=$_GET['id_pago'];

$x->setQuery("nombre_servicio,fecha_inst,cant_serv,costo_cobro,descu,((cant_serv*costo_cobro)-descu) as total","vista_pago_ser","","id_pago='$id_pago'");

$x->setColumnHeader("tipo_servicio", _("tipo servicio"));
$x->setColumnHeader("nombre_servicio", _("nombre servicio"));
$x->setColumnHeader("fecha_inst", _("fecha cargo"));
$x->setColumnHeader("cant_serv", _("cant"));
$x->setColumnHeader("descu", _("Descuento"));
$x->setColumnHeader("costo_cobro", _("costo cargo"));
$x->setColumnHeader("total", _("Total Servicio"));

$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_MES, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('total', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('descu', EyeDataGrid::TYPE_MONTO, '',true);
//$x->hideOrder();
$x->allowFilters();
$x->setClase("historialpago");
$x->showRowNumber();


$x->printTable();


?>
