<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];
require '../include/eyedatagrid/class.eyepostgresadap_ha.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
$id_contrato=$_GET['id_contrato'];

$modo = $_GET['modo'];
if($modo!="EXCEL"){
echo '
<!--h6>HISTORIAL DE PAGO BOXI</h6-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section id="tabla-historialpago">
	 ';
}


if($_GET['order']==''){
	$x->setOrder('ctafecha', 'DESC');
}
$x->setQuery("idctacte,abonumero,facnrofact,ctanrocomp,ctatipcomp,ctafecha,ctacoment,ctaimpgrab,estcta","ctacte","","id_contrato='$id_contrato'");

$x->hideColumn('facnrofact');
$x->hideColumn('ctanrocomp');
$x->hideColumn('estcta');
$x->setColumnHeader("idctacte", _("Nro. comp"));
$x->setColumnHeader("abonumero", _("Abonado"));
$x->setColumnHeader("ctatipcomp", _("Tipo"));
$x->setColumnHeader("ctacoment", _("Detalle"));
$x->setColumnHeader("ctaimpgrab", _("Monto"));
$x->setColumnHeader("ctafecha", _("Fecha"));

$x->setColumnType('ctafecha', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('ctaimpgrab', EyeDataGrid::TYPE_MONTO, '',true);
//$x->hideOrder();
$x->allowFilters();
$x->setClase("historialpago_boxi");
//$x->showRowNumber();

//$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "ver_factura_html('%id_pago%')");
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
$acceso=conexion_ha();
$acceso->objeto->ejecutarSql("select sum(ctaimpgrab) as suma from ctacte where id_contrato='$id_contrato'");
	if($row=row($acceso)){
		$suma=trim($row["suma"]);
	}
	if($suma==''){
		$suma=0;
	}
	echo '<span class="fuenteN">'. _('SALDO A LA FECHA').':</span><span class="fuenteN">'.number_format($suma+0, 2, ',', '.').'</span>';


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
