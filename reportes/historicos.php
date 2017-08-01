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
		<section id="tabla-historico">
	 ';
}

if(!isset($_GET['order'])){
	$x->setOrder('fecha_pago', 'DESC');
}

	
$x->setQuery("id_pago,nro_factura,fecha_pago,monto_pago,obser_pago,documento,caja,fecha_factura","pagos_his","","id_contrato='$id_contrato'");
$x->hideColumn('tipo_costo');
$x->hideColumn('id_cont_serv');
$x->hideColumn('id_pago');
$x->setColumnHeader("nro_factura", _("Factura"));
$x->setColumnHeader("fecha_pago", _("Fecha Cargo"));
$x->setColumnHeader("fecha_factura", _("Fecha Pago"));
$x->setColumnHeader("monto_pago", _("Total"));
$x->setColumnHeader("documento", _("Doc."));
$x->setColumnHeader("obser_pago", _("Observación"));

$x->setColumnType('fecha_pago', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('monto_pago', EyeDataGrid::TYPE_MONTO, '',true);
//$x->hideOrder();
$x->allowFilters();
$x->setClase("historialpago");
//$x->showRowNumber();

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
