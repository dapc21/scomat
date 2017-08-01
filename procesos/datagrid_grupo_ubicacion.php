<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" id_franq='$id_f'";
	}

$organizar_por=$_GET['organizar_por'];
$id_zona=$_GET['id_zona'];
$sql="id_sector<>'' ";
	if($organizar_por=='ZONAS'){
		$x->setQuery("id_zona,nombre_zona,nombre_franq", "vista_zona1","id_zona","$consult");
		$x->hideColumn('id_zona');
		$x->setColumnHeader('nro_zona', _("Nº"));
		$x->setColumnHeader('nombre_zona', _("Zona"));
		$x->setColumnHeader('nombre_franq', _("Franquicia"));
	}
	else{
		if($id_zona!=''){
			$sql=$sql." and id_zona='$id_zona' ";
		}
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
		$x->setQuery("id_sector,nombre_sector,nombre_zona", "vista_sector1","id_sector","$sql $consult");
		$x->hideColumn('id_sector');
		$x->setColumnHeader('nro_sector', _("Nº"));
		$x->setColumnHeader('nombre_sector', _("Sector"));
		$x->setColumnHeader('nombre_zona', _("zona"));
	}


$x->setClase("grupo_ubicacion");
//para permitir filtros
//$x->allowFilters();
$x->hideOrder();
//para ir contanfo las filas
//$x->showRowNumber();
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
