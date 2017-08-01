<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_persona,cedula,nombre,apellido,telefono,email", "vista_cliente","id_persona","");
$x->hideColumn('id_persona');
$x->setColumnHeader('cedula', _("cedula"));
$x->setColumnHeader('nombre', _("nombre"));
$x->setColumnHeader('apellido', _("apellido"));
$x->setColumnHeader('telefono', _("telefono"));
$x->setColumnHeader('email', _("email"));
$x->setColumnHeader('','');

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
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@vista_cliente','id_persona=@%id_persona%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarcliente('%id_persona%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcliente('%id_persona%')");
*/
$x->printTable();
?>
