<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
require_once "../procesos.php";
$x = new EyeDataGrid($db);
$valor= $_GET['status'];
$valor=explode("==",$valor);
$id_mov=$valor[0];
$desde=$valor[1];
$hasta=$valor[2];
$id_dep= $valor[3];
$status= $valor[4];
$bus="";

if($id_mov  && $id_mov!="0" ){
	$bus=$bus." and  id_motivo='$id_mov'";
}
if($desde){
	$desde=formatfecha($valor[1]);
	$hasta=formatfecha($valor[2]);
	$bus=$bus." and  fecha_inv between '$desde' and '$hasta'";
}
if($id_dep && $id_dep!="0" ){
	$bus=$bus." and id_dep='$id_dep' ";
}
if($status && $status!="0" ){
	$bus=$bus." and status_inv='$status' ";
}

$x->setQuery("id_inv,num_inv,fecha_inv,nombre_motivo,nombre_dep,obser_inv,status_inv,login_reg,login_aju","vista_reporteinventario","id_inv","id_inv<>''  $bus");
$x->hideColumn('id_inv');
$x->setColumnHeader("fecha_inv", _("fecha"));
$x->setColumnHeader("nombre_motivo", _("motivo"));
$x->setColumnHeader("nombre_dep", _("deposito"));
$x->setColumnHeader("obser_inv", _("observacion"));
$x->setColumnHeader("status_inv", _("status"));
$x->setColumnHeader("num_inv", _("Num Inv"));
$x->setColumnHeader("login_reg", _("R. Registro"));
$x->setColumnHeader("login_aju", _("R. Aprobacion"));


//$x->hideOrder();
$x->showRowNumber();
$x->setColumnType('fecha_inv', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->addRowSelect("ImprimirRep_planillainv02('%id_inv%')");
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
