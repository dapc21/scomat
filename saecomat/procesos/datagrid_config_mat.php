<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_c_mat,hab_imp_mat,hab_desc_alm_gru,hab_mat_orden,hab_desc_alm_gen
, ( select nombre_franq from franquicia where config_mat.id_franq=franquicia.id_franq) as nombre_franq
, ( select nombre_dep from deposito where config_mat.id_deposito=deposito.id_dep) as deposito
", "config_mat","id_c_mat","");
$x->hideColumn('id_c_mat');
$x->setColumnHeader('id_franq',_('id franq'));
$x->setColumnHeader('hab_desc_alm_gru',_('almacen de grupo'));
$x->setColumnHeader('hab_desc_alm_gen',_('almacen especifico'));
$x->setColumnHeader('hab_mat_orden',_('solo registro'));
$x->setColumnHeader('id_deposito',_('id_deposito'));
$x->setColumnHeader('hab_imp_mat',_('habilita impresion'));
$x->setColumnHeader('nombre_franq', _('franquicia'));

$x->setColumnHeader('','');

$x->setColumnType('hab_desc_alm_gru', EyeDataGrid::TYPE_CUSTOM);
$x->setColumnType('hab_desc_alm_gen', EyeDataGrid::TYPE_CUSTOM);
$x->setColumnType('hab_mat_orden', EyeDataGrid::TYPE_CUSTOM);
$x->setColumnType('hab_imp_mat', EyeDataGrid::TYPE_CUSTOM);

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@config_mat','id_c_mat=@%id_c_mat%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarfamilia('%id_c_mat%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarfamilia('%id_c_mat%')");
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
