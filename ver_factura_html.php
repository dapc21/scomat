<link rel="stylesheet" type="text/css" href="estilos/reset.css">
<link rel="stylesheet" type="text/css" href="estilos/css.css">

<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>

			<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("cargos cancelados");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td width="120px">
<?php
require_once("procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_pago=$_GET['id_pago'];
//echo$id_pago;
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
$x->hideOrder();
//$x->allowFilters();
$x->setClase("historialpago");
//$x->showRowNumber();


$x->printTable();
?>
</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		</table>
		</fieldset>
</td>		
 </tr>		
  <tr>
  <td>

<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("Forma de pago");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td width="120px">
<?php

$data_p = new EyeDataGrid($db);

$id_pago=$_GET['id_pago'];
//echo$id_pago;
$data_p->setQuery("tipo_pago,monto_tp,banco,numero","detalle_tipopago, tipo_pago","","detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago  and id_pago='$id_pago'");

$data_p->setColumnHeader("tipo_pago", _("Forma Pago"));
$data_p->setColumnHeader("monto_tp", _("monto"));
$data_p->setColumnHeader("cant_serv", _("cant"));
$data_p->setColumnHeader("banco", _("banco"));
$data_p->setColumnHeader("numero", _("numero"));
$data_p->setColumnHeader("total", _("Total Servicio"));

$data_p->setColumnType('monto_tp', EyeDataGrid::TYPE_MONTO, '',true);
$data_p->hideOrder();
//$data_p->allowFilters();
$data_p->setClase("historialpago");
//$data_p->showRowNumber();


$data_p->printTable();


?>

	</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		</table>
		</fieldset>

		</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		</table>