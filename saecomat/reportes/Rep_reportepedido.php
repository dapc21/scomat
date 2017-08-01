<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
require_once "../procesos.php";
//$status=$_GET['status'];

$valor= $_GET['status'];
$valor=explode("==",$valor);
$status=$valor[0];
$desde=$valor[1];
$hasta=$valor[2];
$id_prov= $valor[3];
$bus="id_ped  ILIKE '%0%'";

if($status!=''  && $status!="0" ){
	$bus=$bus." and status_ped='$status'";
}
if($desde!='' && $hasta!=''){
	$desde=formatfecha($desde);
	$hasta=formatfecha($hasta);
	$bus=$bus." and fecha_ent between '$desde' and '$hasta'";
}
if($id_prov!='' && $id_prov!="0" ){
	$bus=$bus." and id_prov='$id_prov' ";
}

$x = new EyeDataGrid($db);

$x->setQuery("id_ped,num_ped,fecha_ped,fecha_ent,status_ped,nombre_prov,rif_prov","vista_pedido","id_ped",$bus);
$x->hideColumn('id_ped');
$x->setColumnHeader("id_ped", _("id_ped"));
$x->setColumnHeader("fecha_ped", _("fecha pedido"));
$x->setColumnHeader("fecha_ent", _("fecha compra"));
$x->setColumnHeader("status_ped", _("status"));
$x->setColumnHeader("nombre_prov", _("proveedor"));
$x->setColumnHeader("rif_prov", _("rif"));
$x->setColumnHeader('num_ped', _("Pedido"));
$x->addRowSelect("ImprimirRep_planillaped02('%id_ped%')");
$x->hideOrder();
$x->showRowNumber();
$x->setColumnType('fecha_ped', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_ent', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
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
