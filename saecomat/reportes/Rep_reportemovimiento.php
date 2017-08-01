<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
require_once "../procesos.php";
$x = new EyeDataGrid($db);
$valor= $_GET['status'];
$valor=explode("==",$valor);
$id_tm=$valor[0];
$desde=$valor[1];
$hasta=$valor[2];
$id_dep= $valor[3];
$tipo_ent_sal= $valor[4];
$bus="id_mov<>'' ";
if($id_tm  && $id_tm!="0" ){
	$bus=$bus."and  id_tm='$id_tm'";
}
if($desde!='' && $hasta!=''){
	$desde=formatfecha($valor[1]);
	$hasta=formatfecha($valor[2]);
	$bus=$bus."and  fecha_ent_sal  between '$desde' and '$hasta' ";
}
if($id_dep!='' && $id_dep!="0" ){
	$bus=$bus." and id_dep='$id_dep' ";
}
if($tipo_ent_sal!='' && $tipo_ent_sal!="0" ){
	$bus=$bus." and tipo_ent_sal='$tipo_ent_sal' ";
}
//echo $bus;
$x->setQuery("id_mov,num_mov,fecha_ent_sal,nombre_tm,tipo_ent_sal,nombre_dep,observacion","vista_reportemovimiento","id_mov",$bus);
$x->hideColumn('id_mov');
$x->setColumnHeader("num_mov", _("Movimiento"));
$x->setColumnHeader("id_mov", _("id_mov"));
$x->setColumnHeader("fecha_ent_sal", _("fecha"));
$x->setColumnHeader("nombre_tm", _("movimiento"));
$x->setColumnHeader("tipo_ent_sal", _("tipo"));
$x->setColumnHeader("nombre_dep", _("deposito"));
$x->setColumnHeader("observacion", _("observacion"));

//$x->hideOrder();
$x->setColumnType('fecha_ent_sal', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->addRowSelect("ImprimirRep_reportemovimiento02('%id_mov%')");
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
