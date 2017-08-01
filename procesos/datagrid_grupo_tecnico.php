<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_persona,num_tecnico,cedula,nombre,apellido", "vista_tecnico","id_persona","status_tec='ACTIVO' $consult");
$x->hideColumn('id_persona');
$x->setColumnHeader('cedula', _("Cédula"));
$x->setColumnHeader('nombre', _("Nombre"));
$x->setColumnHeader('apellido', _("Apellido"));
$x->setColumnHeader('num_tecnico', _("Nº Técnico"));
$x->setColumnHeader('','');

//para permitir filtros
$x->showCheckboxes();
$x->hideOrder();
//$x->allowFilters();
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
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@vista_tecnico','id_persona=@%id_persona%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificartecnico('%id_persona%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminartecnico('%id_persona%')");
*/
$x->printTable();
?>
