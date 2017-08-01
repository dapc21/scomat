<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);
$tipo=$_GET['tipo'];
$sql=$_GET['sql'];
if($tipo=='EJECUCION'){
		
if($modo!='EXCEL'){
	echo ":$sql:";
}
	if($acceso->objeto->ejecutarSql("$sql")){
			
if($modo!='EXCEL'){
		echo strtoupper("sql ejecutado con exito");
	}
	}
	else{
			
if($modo!='EXCEL'){
		echo strtoupper("error al ejecutar sql")."<br><br>".$acceso->objeto->error().'<br>';
		}
	}
}
else{
$x->consultas($sql);
$x->setQuery("*", "familia","id_fam","");
$x->allowFilters();
$x->showRowNumber();

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
}
?>
