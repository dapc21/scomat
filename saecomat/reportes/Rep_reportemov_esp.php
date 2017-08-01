<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
require_once "../procesos.php";
$x = new EyeDataGrid($db);
$id_dep= $_GET['id_dep'];
$tipo_ent_sal= $_GET['tipo_ent_sal'];
$id_tm= $_GET['id_tm'];
$id_te= $_GET['id_te'];
$id_persona= $_GET['id_persona'];
$desde= formatfecha($_GET['desde']);
$hasta= formatfecha($_GET['hasta']);

$sq='';
if($tipo_ent_sal!='' && $tipo_ent_sal!='0'){
	$sq=$sq." and tipo_ent_sal='$tipo_ent_sal'";
}
if($id_tm!='' && $id_tm!='0'){
	$sq=$sq." and id_tm='$id_tm'";
}
if($id_te!='' && $id_te!='0'){
	$sq=$sq." and id_te='$id_te'";
}
if($id_persona!='' && $id_persona!='0'){
	$sq=$sq." and id_persona='$id_persona'";
}
$campos="numero_mat,nombre_mat,
(select sum(cant_mov) from vista_mov_materiales where tipo_ent_sal='SALIDA' and id_dep='$id_dep' and  vista_mov_materiales.fecha_ent_sal  between '$desde' and '$hasta' and vista_matpadre.id_m=vista_mov_materiales.id_m $sq) as salida, 
(select sum(cant_mov) from vista_mov_materiales where tipo_ent_sal='ENTRADA' and id_dep='$id_dep' and  vista_mov_materiales.fecha_ent_sal  between '$desde' and '$hasta' and vista_matpadre.id_m=vista_mov_materiales.id_m $sq) as entrada, 
(select sum(stock) from materiales where id_dep='$id_dep' and materiales.id_m=vista_matpadre.id_m) as stock 
";

$where="
(select sum(cant_mov) from vista_mov_materiales where tipo_ent_sal='SALIDA' and id_dep='$id_dep' and  vista_mov_materiales.fecha_ent_sal  between '$desde' and '$hasta' and vista_matpadre.id_m=vista_mov_materiales.id_m $sq)>0 or 
(select sum(cant_mov) from vista_mov_materiales where tipo_ent_sal='ENTRADA' and id_dep='$id_dep' and  vista_mov_materiales.fecha_ent_sal  between '$desde' and '$hasta' and vista_matpadre.id_m=vista_mov_materiales.id_m $sq)>0
";

//echo $bus;
$x->setQuery("$campos","vista_matpadre","",$where);
$x->hideColumn('id_mov');
$x->setColumnHeader("id_mov", _("id_mov"));
$x->setColumnHeader("fecha_ent_sal", _("fecha"));
$x->setColumnHeader("nombre_tm", _("movimiento"));
$x->setColumnHeader("tipo_ent_sal", _("tipo"));
$x->setColumnHeader("nombre_dep", _("deposito"));
$x->setColumnHeader("observacion", _("observacion"));

//$x->hideOrder();
$x->setColumnType('fecha_ent_sal', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//$x->addRowSelect("ImprimirRep_reportemovimiento02('%id_mov%')");
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
