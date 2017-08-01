<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
//$x->setQuery("id_est,nombre_est,nombre_franq,ip_est,mac_est,status_est", "estacion_trabajo, franquicia","id_est","status_est<>'INACTIVO' and estacion_trabajo.nom_comp=franquicia.id_franq");
$x->setQuery("id_est,nombre_est,(select nombre_franq from franquicia where estacion_trabajo.nom_comp=franquicia.id_franq) as nombre_franq,ip_est,mac_est,status_est", "estacion_trabajo","id_est","");
$x->hideColumn('id_est');
$x->setColumnHeader('nombre_est','nombre estacion');
$x->setColumnHeader('nombre_franq','Franquicia');
$x->setColumnHeader('ip_est','ip');
$x->setColumnHeader('mac_est','Equipo Fiscal');
$x->setColumnHeader('status_est','status');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas

//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_est('%id_est%');window.location.replace('#');");

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
}/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarestacion_trabajo('%id_est%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarestacion_trabajo('%id_est%')");
*/
$x->printTable();
?>
