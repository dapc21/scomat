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

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_ciudad,nombre_ciudad,nombre_mun,nombre_esta,status_ciudad", "vista_ciudad","id_ciudad","$consult");
$x->hideColumn('id_ciudad');
$x->setColumnHeader('nombre_ciudad','Ciudad');
$x->setColumnHeader('nombre_mun','Municipio');
$x->setColumnHeader('nombre_esta','Estado');
$x->setColumnHeader('nombre_franq','Franquicia');
$x->setColumnHeader('status_ciudad','Estatus');
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_ciudad('%id_ciudad%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarciudad('%id_ciudad%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarciudad('%id_ciudad%')");
*/

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

//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_ciudad('%id_ciudad%')");

$x->printTable();
?>
