<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_fam= $_GET['id_fam'];
$id_unidad= $_GET['id_unidad'];
$impresion= $_GET['impresion'];
$bus=" id_m <>'' ";

if($id_fam!=''  && $id_fam!="0" ){
	$bus=$bus." and id_fam='$id_fam'";
}

if($id_unidad!=''  && $id_unidad!="0" ){
	$bus=$bus." and id_unidad='$id_unidad'";
}

if($impresion!=''  && $impresion!="0" ){
	$bus=$bus." and impresion='$impresion'";
}

$x->setQuery("numero_mat,nombre_mat,nombre_fam,nombre_unidad,impresion","vista_matpadre","","$bus");
$x->setColumnHeader("numero_mat", _("numero"));
$x->setColumnHeader("nombre_mat", _("nombre"));
$x->setColumnHeader("nombre_fam", _("familia"));
$x->setColumnHeader("impresion", _("impresion"));
$x->setColumnHeader("nombre_unidad", _("unidad medida"));
$x->setColumnType('impresion', EyeDataGrid::TYPE_CUSTOM, '');
//$x->hideOrder();
//$x->showRowNumber();
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
