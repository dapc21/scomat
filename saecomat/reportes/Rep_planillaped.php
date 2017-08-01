<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock,stock_min","vista_planillaped","","");
$x->setColumnHeader("numero_mat", _("numero"));
$x->setColumnHeader("nombre_mat", _("material"));
$x->setColumnHeader("nombre_dep", _("deposito"));
$x->setColumnHeader("nombre_fam", _("familia"));
$x->setColumnHeader("nombre_unidad", _("medida"));
$x->setColumnHeader("stock", _("stock"));
$x->setColumnHeader("stock_min", _("min"));

//$x->hideOrder();
$x->showRowNumber();
$x->setResultsPerPage(20);

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