<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("*", "motivollamada","idmotivonota","");
$x->hideColumn('dato');
$x->hideColumn('idmotivonota');
$x->setColumnHeader('nombremotivonota', _("Nombre del Motivo"));
$x->setColumnHeader('status', _("Estatus"));

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas

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

//llama al evento al darle click a la fila
$x->addRowSelect("buscar_idmotivonota('%idmotivonota%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmotivollamada('%idmotivonota%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmotivollamada('%idmotivonota%')");
*/
$x->printTable();
?>
