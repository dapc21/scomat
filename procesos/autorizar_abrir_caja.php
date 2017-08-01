<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


	
//crea la consulta SQL 
//campos, tabla, campo clave
$fecha=date("Y-m-d");
$x->setQuery("nombre_franq", "autorizar_abrir_caja, franquicia","id_cuba","fecha='$fecha'");
$x->hideColumn('id_cuba');
$x->setColumnHeader('nombre_franq', _("franquicia"));
//mostrar resultados por pagina
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

$x->printTable();



?>
