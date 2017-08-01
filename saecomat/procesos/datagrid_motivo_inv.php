<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_motivo,nombre_motivo,status_motivo", "motivo_inv","id_motivo","");
$x->hideColumn('id_motivo');
$x->hideColumn('dato');
$x->setColumnHeader('nombre_motivo','Nombre');
$x->setColumnHeader('status_motivo','Estatus');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@motivo_inv','id_motivo=@%id_motivo%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmotivo_inv('%id_motivo%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmotivo_inv('%id_motivo%')");
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
