<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("nombre_caja,monto_acum,nombre,fecha_caja,apertura_caja,cierre_caja","vista_caja","","");
$x->hideColumn('id_caja_cob');
$x->setColumnHeader("nombre_caja", _("punto de cobro"));
$x->setColumnHeader("monto_acum", _("monto"));
$x->setColumnHeader("nombre", _("cobrador"));
$x->setColumnHeader("fecha_caja", _("fecha"));
$x->setColumnHeader("apertura_caja", _("hora apertura"));
$x->setColumnHeader("cierre_caja", _("hora cierre"));

$x->setColumnType('fecha_caja', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->setColumnType('monto_acum', EyeDataGrid::TYPE_MONTO, '',true);

$x->addRowSelect("ImprimirRep_detcob('%id_caja_cob%')");

$x->setClase("CierreDiario");
$x->hideOrder();
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
