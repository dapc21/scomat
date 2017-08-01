<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="border-head"><h3>DETALLE DE SERVICIOS</h3></div>
	
	<section class="panel">
<?php
$id_pago=$_POST['archivo'];
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
//echo "HOLA COMO ESTAS:$id_pago";

//echo $id_pago;
//$id_pago=$_GET['id_pago'];
//echo$id_pago;
$x->setQuery("nombre_servicio,fecha_inst,cant_serv,costo_cobro,descu,costo_cobro as total,pagado, (costo_cobro-pagado) as deuda","vista_contratodeu","","id_pago='$id_pago'");

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
//$x->allowFilters();
$x->setClase("historialpago");
//$x->showRowNumber();


$x->hideFooter(true);
$x->printTable();
?>
		
	</section>	

</div> 
