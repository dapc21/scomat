<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_prov,rif_prov,nombre_prov,direccion_prov,telefonos_prov,fax_prov,web_prov,email_prov,obser_prov,forma_pago,banco,cuenta,status_prov,contacto", "proveedor","id_prov","");
$x->hideColumn('dato');
$x->hideColumn('id_prov');
$x->setColumnHeader('rif_prov', _('RIF'));
$x->setColumnHeader('nombre_prov', _('Nombre'));
$x->hideColumn('direccion_prov');
$x->setColumnHeader('telefonos_prov', _('Teléfonos'));
$x->setColumnHeader('fax_prov', _('Fax'));
$x->setColumnHeader('web_prov', _('Web'));
$x->setColumnHeader('email_prov', _('Email'));
$x->hideColumn('obser_prov');
$x->hideColumn('forma_pago');
$x->hideColumn('banco');
$x->hideColumn('cuenta');
$x->hideColumn('status_prov');
$x->hideColumn('contacto');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@proveedor','id_prov=@%id_prov%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarproveedor('%id_prov%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarproveedor('%id_prov%')");
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
