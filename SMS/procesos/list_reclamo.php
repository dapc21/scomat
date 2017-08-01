<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


$status_list=$_GET['status_list'];
$sql="";
if($status_list!=""){
	$sql=" and status_list='$status_list'";
}
$x->setQuery("id_sms,nro_contrato,nombre,apellido,fecha_sms,mensaje_sms", "vista_sms","id_sms"," tipo_sms='DELIVER' and tipo_list='RECLAMO' $sql");
$x->hideColumn('id_sms');
$x->setColumnHeader('nro_contrato', _("cont"));
$x->setColumnHeader('nombre', _("nombre"));
$x->setColumnHeader('apellido', _("apellido"));
$x->setColumnHeader('fecha_sms', _("fecha"));
$x->setColumnHeader('mensaje_sms', _("mensaje"));

$x->setColumnType('fecha_sms', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->showCheckboxes();

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
