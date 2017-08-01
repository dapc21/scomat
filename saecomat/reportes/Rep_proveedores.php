<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("rif_prov,id_prov,telefonos_prov,fax_prov,status_prov,direccion_prov","proveedor","","");
$x->setColumnHeader("rif_prov", _("rif"));
$x->setColumnHeader("id_prov", _("nombre"));
$x->setColumnHeader("telefonos_prov", _("telefono"));
$x->setColumnHeader("fax_prov", _("fax"));
$x->setColumnHeader("status_prov", _("status"));
$x->setColumnHeader("direccion_prov", _("direccion"));

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
