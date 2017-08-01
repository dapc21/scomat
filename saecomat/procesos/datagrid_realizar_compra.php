<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
//$x->showCheckboxes();

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_ped,num_ped,id_prov,fecha_ped,status_ped,nombre_prov,rif_prov", "vista_pedido","id_ped","status_ped='APROBADO'");
$x->hideColumn('id_ped');

$x->setColumnHeader('id_ped', _("Pedido"));
$x->hideColumn('id_prov', _("Proveedor"));
$x->setColumnHeader('fecha_ped',_("Fecha de Pedido"));
$x->setColumnHeader('status_ped',_("Estatus"));
$x->setColumnHeader('nombre_prov', _("Proveedor"));
$x->setColumnHeader('rif_prov', _("RIF"));
$x->setColumnHeader('num_ped', _("Pedido"));

//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setClase("confir_pedido");
$x->setColumnType('fecha_ped', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros

$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
//
$x->addRowSelect("cargarDatosP_dos('%id_ped%','%id_prov%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmateriales('%id_mat%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmateriales('%id_mat%')");*/



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
