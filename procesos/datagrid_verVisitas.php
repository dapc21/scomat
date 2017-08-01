<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
$id_orden= $_GET['id_orden'];
//campos, tabla, campo clave
$x->setQuery("id_visita,fecha_visita,hora,comenta_visita", "visitas","id_visita","id_orden='$id_orden'");
$x->hideColumn('id_visita');
$x->setColumnHeader('fecha_visita', _("fecha"));
$x->setColumnHeader('hora', _("hora"));
$x->setColumnHeader('comenta_visita', _("comentario Visita"));
$x->showRowNumber();
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->setColumnType('fecha_visita', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
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
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@visitas','id_visita=@%id_visita%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarzona('%id_visita%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarzona('%id_visita%')");
*/
$x->printTable();
?>
