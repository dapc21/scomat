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
$x->setQuery("id_persona,nro_vendedor,cedula,nombre,apellido,telefono,nombre_franq", "vista_vendedor","id_persona","$consult");
$x->hideColumn('id_persona');
$x->setColumnHeader('nro_vendedor', _("Nº Vendedor"));
$x->setColumnHeader('cedula', _("Cédula"));
$x->setColumnHeader('nombre', _("Nombre"));
$x->setColumnHeader('apellido', _("Apellido"));
$x->setColumnHeader('telefono', _("Teléfono"));
$x->setColumnHeader('nombre_franq','Franquicia');

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
$x->addRowSelect("buscar_id_vendedor('%id_persona%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarvendedor('%id_persona%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarvendedor('%id_persona%')");
*/
$x->printTable();
?>
