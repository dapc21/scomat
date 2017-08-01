<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_contrato = $_GET['id_contrato'];

$x->setQuery("id_pago,nro_factura,monto_pago as base,monto_pago as iva,monto_pago,fecha_pago,hora_pago","vista_ps","","id_contrato='$id_contrato'");
$x->hideColumn('id_pago');
$x->setColumnHeader("nro_factura", _("factura"));
$x->setColumnHeader("cedulacli", _("cedula"));
$x->setColumnHeader("nombrecli", _("nombre"));
$x->setColumnHeader("base", _("base"));
$x->setColumnHeader("iva", _("iva"));
$x->setColumnHeader("monto_pago", _("total"));
$x->setColumnHeader("fecha_pago", _("fecha"));
$x->setColumnHeader("hora_pago", _("hora"));

$x->setColumnType('monto_pago', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('iva', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_pago', EyeDataGrid::TYPE_MONTO, '',true);

//$x->setColumnType('fecha_pago', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "reimp_factura('%id_pago%')");

$x->desde=$desde;
$x->hasta=$hasta;

$x->setClase("rep_libroventa");
$x->allowFilters();
$x->showRowNumber();

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
?>
