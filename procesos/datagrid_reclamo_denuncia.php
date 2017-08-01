<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_rec,nro_rec,tipo_rec,cedula,nombre,apellido,fecha_rec,motivo_rec,status_rec", "vista_reclamo","id_rec","");
$x->hideColumn('id_rec');
$x->setColumnHeader('cedula', _("cedula cli"));
$x->setColumnHeader('nombre', _("nombre cli"));
$x->setColumnHeader('apellido', _("apellido cli"));
$x->setColumnHeader('nro_rec', _("nro rec"));
$x->setColumnHeader('tipo_rec', _("tipo"));
$x->setColumnHeader('fecha_rec', _("fecha"));
$x->setColumnHeader('motivo_rec', _("motivo"));
$x->setColumnHeader('status_rec', _("status"));

$x->setColumnType('fecha_rec', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
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
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@vista_reclamo','id_rec=@%id_rec%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarvista_reclamo('%id_rec%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarvista_reclamo('%id_rec%')");
*/
$x->printTable();
?>
