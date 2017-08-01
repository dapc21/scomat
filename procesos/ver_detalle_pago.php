<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="border-head"><h3>DETALLE DE SERVICIOS</h3></div>
	
	<section class="panel">
<?php
$id_pago=$_POST['archivo'];
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("nombre_servicio,fecha_inst,cant_serv,costo_cobro,descu,costo_cobro as total","vista_pago_ser","","id_pago='$id_pago'");

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
$x->hideOrder();

$x->setClase("historialpago");

$x->hideFooter(true);
$x->printTable();
?>
		
	</section>	
	<div class="border-head"><h3>DETALLE DE forma de pago</h3></div>
	<section class="panel">		
<?php

$data_p = new EyeDataGrid($db);

//$id_pago=$_GET['id_pago'];
//echo$id_pago;
$data_p->setQuery("tipo_pago,monto_tp,banco,refer_tp","vista_tipopago","","id_pago='$id_pago'");

$data_p->setColumnHeader("tipo_pago", _("Forma Pago"));
$data_p->setColumnHeader("monto_tp", _("monto"));
$data_p->setColumnHeader("cant_serv", _("cant"));
$data_p->setColumnHeader("banco", _("entidad"));
$data_p->setColumnHeader("refer_tp", _("referencia"));
$data_p->setColumnHeader("total", _("Total Servicio"));

$data_p->setColumnType('monto_tp', EyeDataGrid::TYPE_MONTO, '',true);
$data_p->hideOrder();
//$data_p->allowFilters();
$data_p->setClase("historialpago");
//$data_p->showRowNumber();


$data_p->hideFooter(true);
$data_p->printTable();


?>

</section>	 
 

</div> 
