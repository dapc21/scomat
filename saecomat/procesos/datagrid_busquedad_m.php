<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
require_once "../procesos.php";
$x = new EyeDataGrid($db);
//$id_dep=$_GET["id_dep"];
//crea la consulta SQL 
//campos, tabla, campo clave
//echo $id_dep;

$valor= $_GET['id_dep'];
$valor=explode("==",$valor);
$id_dep=$valor[0];
$desde=$valor[1];
$hasta= $valor[2];
$id_mat= $valor[3];	

$x->showCheckboxes();
$bus="id_mat='$id_mat'";
	if($desde!='' && $desde!=""){ 	
		$desde=formatfecha($desde);
		$hasta= formatfecha($hasta);
		$bus=$bus." and fecha_ent_sal  between '$desde' and '$hasta'";	
	}
	
$x->setQuery("id_mat,id_dep,id_mov,nombre_tm,tipo_ent_sal,nombre_dep,fecha_ent_sal,cant_mov", "vista_movimiento_mov_mat","",$bus);
$x->hideColumn('id_mat');
$x->hideColumn('id_dep');
$x->hideColumn('id_mov');
$x->hideColumn('nombre_dep');
$x->setColumnHeader('id_mov',_("id_mov"));
$x->setColumnHeader('nombre_tm',_("movimiento"));
$x->setColumnHeader('tipo_ent_sal',_("tipo"));
$x->setColumnHeader('fecha_ent_sal',_("fecha"));
$x->setColumnHeader('cant_mov',_("cantidad"));
$x->setColumnType('fecha_ent_sal', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->setResultsPerPage(2000);

/*
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
*/

$x->printTable();
?>
