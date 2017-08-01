<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult=" status_ent <> 'INTERNO'";
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_persona,cedula,nombre,apellido,telefono,id_te,descrip_ent,status_ent,nombre_te,status_te", "vista_entidad","id_persona","$consult");
$x->hideColumn('id_persona');
$x->hideColumn('id_te');
$x->hideColumn('descrip_ent');
$x->hideColumn('status_te');
$x->setColumnHeader('cedula', _("Cédula"));
$x->setColumnHeader('nombre', _("Nombre(s)"));
$x->setColumnHeader('apellido',_("Apellido(s)"));
$x->setColumnHeader('telefono', _("Teléfono"));
$x->setColumnHeader('status_ent', 'Estatus');
$x->setColumnHeader('nombre_te', 'Tipo de Contraparte');


//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_te('%id_persona%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarentidad('%id_persona%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarentidad('%id_persona%')");
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
