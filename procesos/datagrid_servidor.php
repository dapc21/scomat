<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_servidor,nombre_servidor,status_ser,status_servidor,sincronizar,direc_servidor", "servidor","id_servidor","");
$x->hideColumn('id_servidor');
$x->setColumnHeader('nombre_servidor', 'Nombre');
$x->setColumnHeader('direc_servidor', 'Direción');
$x->setColumnHeader('sincronizar', 'Sincronizado');
$x->setColumnHeader('status_servidor', 'Tipo');
$x->setColumnHeader('status_ser', 'Estatus');
$x->setColumnHeader('', '');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@servidor','id_servidor=@%id_servidor%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarservidor('%id_servidor%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarservidor('%id_servidor%')");
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
$x->printTable();
?>
