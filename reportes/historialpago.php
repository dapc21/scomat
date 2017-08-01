<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
$id_contrato=$_GET['id_contrato'];

$modo = $_GET['modo'];
if($modo!="EXCEL"){
echo '
<!--h6>HISTORIAL DE PAGO</h6-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section id="tabla-historialpago">
	 ';
}


if($_GET['order']==''){
	$x->setOrder('fecha_pago', 'DESC');
}
$x->setQuery("id_pago,tipo_costo,id_cont_serv,nro_factura,nro_control,fecha_pago,nombre_servicio,fecha_inst,cant_serv,costo_cobro,monto_pago,cobrador,nombre_franq,obser_pago","vista_pago_ser","","id_contrato='$id_contrato'");
$x->hideColumn('nro_control');
$x->hideColumn('tipo_costo');
$x->hideColumn('id_cont_serv');
$x->hideColumn('id_pago');
$x->setColumnHeader("nombre_franq", _("Franquicia"));
$x->setColumnHeader("nro_factura", _("Factura"));
$x->setColumnHeader("fecha_pago", _("fecha pago"));
$x->setColumnHeader("tipo_servicio", _("Tipo Servicio"));
$x->setColumnHeader("nombre_servicio", _("Servicio"));
$x->setColumnHeader("fecha_inst", _("fecha cargo"));
$x->setColumnHeader("cant_serv", _("Cant."));
$x->setColumnHeader("costo_cobro", _("Costo"));
$x->setColumnHeader("nro_control", _("Control"));
$x->setColumnHeader("obser_pago", _("Observación"));
$x->setColumnHeader("monto_pago", _("Total"));

$x->setColumnType('fecha_pago', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO, '',true);
//$x->hideOrder();
$x->allowFilters();
$x->setClase("historialpago");
//$x->showRowNumber();

$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "ver_factura_html('%id_pago%')");
//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->printTable();

$acceso->objeto->ejecutarSql("select sum(monto_pago) as suma from vista_pago_cont where id_contrato='$id_contrato'");
	if($row=row($acceso)){
		$suma=trim($row["suma"]);
	}
$acceso->objeto->ejecutarSql("select sum(monto_pago) as suma from vista_pago_cont where id_contrato='$id_contrato'");
	if($row=row($acceso)){
		$suma=trim($row["suma"]);
	}
	if($suma==''){
		$suma=0;
	}
	echo '<span class="fuenteN">'. _('total pagado').':</span><span class="fuenteN">'.number_format($suma+0, 2, ',', '.').'</span>';


echo '
		</section>
	</div>
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section class="panel">
		<div class="text-btn" align="center">
			<button class="btn btn-info" type="button" name="registrDFar" value="'. _('imprimir reporte').'" onclick="ImprimirRep_historialpago(\''.$id_contrato.'\')"><i class="glyphicon glyphicon-print"></i> Imprimir</button>
			<button class="btn btn-info" type="button" name="regisDFtrar" value="'. _('guardar reporte').'" onclick="GuardarRep_historialpago(\''.$id_contrato.'\')"><i class="glyphicon glyphicon-ok"></i> Guardar</button>
		</div>
		</section>
	</div>

</div>';
?>
