<?php

require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
$x->showCheckboxes();

//crea la consulta SQL 
//campos, tabla, campo clave     id_dep='A0000001' ES EL CODIGO ESTANDAR DEL DEPOSITO PRINCIPAL
$x->setQuery("id_mat,numero_mat,nombre_mat,stock", "vista_materiales","id_mat","id_dep='A0000001'");
$x->hideColumn('id_mat');

$x->setColumnHeader('id_mat', _("ID MAT"));
$x->setColumnHeader('numero_mat', _("Nº Mat"));
$x->setColumnHeader('nombre_mat', _("Nombre"));
$x->setColumnHeader('stock',_("Stock"));


//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setClase("mat_prov");

//para permitir filtros

$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@materiales','id_mat=@%id_mat%')");
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
