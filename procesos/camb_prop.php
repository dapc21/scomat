<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_contrato = $_GET['id_contrato'];

if($_GET['DESC']=''){
	$x->setOrder('fecha', 'ORDER_ASC');
}
 //and monto_posterior=0
//,cedula,nombre,apellido,nombre_zona,nombre_sector,nombre_calle
$x->setQuery("cedula,nombre,apellido,telefono,fecha,login","camb_prop,persona","","camb_prop.id_persona=persona.id_persona and id_contrato='$id_contrato'");
$x->hideColumn('id_nota');
$x->setColumnHeader("nro_contrato", "Contrato");

$x->setColumnHeader("login",_("Responsable Cambio"));


$x->setColumnType('fecha', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setClase("Rep_totalclientes");

//$x->hideOrder();
//$x->allowFilters();
$x->showRowNumber();

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
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->printTable();

?>
