<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

//crea la consulta SQL 
//campos, tabla, campo clave
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);
//echo $_GET['order'];
if($_GET['order']==''){
	$x->setOrder('tipo_costo', 'ORDER_ASC');
}
$x->setQuery("id_serv,nombre_servicio,tipo_servicio,tipo_costo", "vista_servicios","id_serv","status_serv='ACTIVO'");
$x->hideColumn('id_serv');
$x->setColumnHeader('nombre_servicio', _("Servicio"));
$x->setColumnHeader('status_serv', _("Estatus"));
$x->setColumnHeader('tipo_costo', _("Tipo de Costo"));
$x->setColumnHeader('tipo_servicio', _("Tipo de Servicio"));

//$x->hideOrder();
$x->allowFilters();

if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0){
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}
$x->showCheckboxes();
$x->printTable();
?>
