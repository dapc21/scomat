<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_contrato=$_GET['id_contrato'];

$modo = $_GET['modo'];
if($modo!="EXCEL"){
echo '
<!--h6>ASIGNACIONES</h6-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section id="tabla-estadocuenta">
	 ';
}

if($_GET['order']==''){
	$x->setOrder('fecha_orden', 'DESC');
}
$x->setQuery("id_orden,fecha_orden,fecha_imp,fecha_final,nombre_det_orden,nombre_tipo_orden,status_orden,nombre_grupo,login_emi,detalle_orden,comentario_orden","vista_orden","","id_contrato='$id_contrato'");
$x->hideColumn('fecha_imp');
$x->hideColumn('nombre_tipo_orden');
//$x->hideColumn('detalle_orden');
//$x->hideColumn('comentario_orden');
$x->hideColumn('login_emi');
$x->setColumnHeader("id_orden", _("Nº Orden"));
$x->setColumnHeader("fecha_orden", _("Fecha Emisión"));
$x->setColumnHeader("nombre_tipo_orden", _("Tipo Orden"));
$x->setColumnHeader("nombre_det_orden", _("Orden"));
$x->setColumnHeader("status_orden", _("Estatus"));
$x->setColumnHeader("fecha_imp", _("Fecha Impresión"));
$x->setColumnHeader("fecha_final", _("Fecha Final"));
$x->setColumnHeader("comentario_orden", _("Obser. Tecnico"));
$x->setColumnHeader("detalle_orden", _("Obser. Reg"));
$x->setColumnHeader("num_visitas", "V");
$x->setColumnHeader("nombre_grupo", "Grupo Trabajo");
$x->setColumnHeader("login_emi", "Creada Por");

//$x->hideOrder();
$x->setColumnType('fecha_imp', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_orden', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_final', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);


$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "guardarOrdenTec_directa('%id_orden%');");

//$x->addStandardControl(EyeDataGrid::STDCTRL_VISITA, "verComentaOrd('%id_orden%')");


$x->allowFilters();
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
/*
echo '
		</section>
	</div>
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section class="panel">
		<div class="text-btn" align="center">
			<button class="btn btn-info" type="button" name="registrar" value="'. _('imprimir').'" onclick="ImprimirRep_estadocuenta(\''.$id_contrato.'\')"><i class="glyphicon glyphicon-print"></i> Imprimir</button> 
			<button class="btn btn-info" type="button" name="registrar" value="'. _('guardar').'" onclick="GuardarRep_estadocuenta(\''.$id_contrato.'\')"><i class="glyphicon glyphicon-ok"></i> Guardar</button>
		</div>
		</section>
	</div>

</div>';
*/
?>
