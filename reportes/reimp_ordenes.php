<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$id_contrato = $_GET['id_contrato'];

$x->setQuery("id_orden,nombre_tipo_orden,nombre_det_orden,fecha_orden,prioridad,status_orden","vista_orden","","id_contrato='$id_contrato'");
$x->hideColumn(_('apellido'));
$x->setColumnHeader("id_orden", _("nro"));
$x->setColumnHeader("nro_contrato", _("nro cont"));
$x->setColumnHeader("status_orden", _("status"));
$x->setColumnHeader("nombre", _("tecnico"));
$x->setColumnHeader("nombre_tipo_orden", _("tipo orden"));
$x->setColumnHeader("nombre_det_orden", _("detalle orden"));
$x->setColumnHeader("fecha_orden", _("fecha"));
$x->setColumnHeader('prioridad', _('prioridad'));

$x->setClase("reimp_ordenes");

//$x->addRowSelect("reimp_ordenes('%id_orden%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "reimp_ordenes('%id_orden%')");
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
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@ordenes_tecnicos','id_orden=@%id_orden%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarordenes_tecnicos('%id_orden%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarordenes_tecnicos('%id_orden%')");
*/
$x->printTable();
?>
