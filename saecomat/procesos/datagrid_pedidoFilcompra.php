<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
$x->showCheckboxes();

$id_ped= $_GET['id_ped'];
//crea la consulta SQL 
//campos, tabla, campo clave

$x->setQuery("c_uni_sal,id_mat,cant_ped,stock_min,precio,abreviatura,numero_mat,nombre_mat,stock,stock_min as min,nombre_dep,nombre_fam,nombre_unidad", "vista_matped_und","id_mat","id_ped='$id_ped'");
$x->hideColumn('id_mat');
$x->hideColumn('c_uni_sal');
//$x->hideColumn('cant_ped');

$x->setColumnHeader('numero_mat', _("#mat"));
$x->setColumnHeader('nombre_mat', _("nombre"));
$x->setColumnHeader('stock',_("stock"));
$x->setColumnHeader('stock_min',_("cantE"));
$x->setColumnHeader('abreviatura',_("totalU"));
$x->setColumnHeader('cant_ped',_("cantP"));
$x->setColumnHeader('precio',_("precioU"));
$x->setColumnHeader('min',_("stock min"));
$x->setColumnHeader('nombre_dep',_("deposito"));
$x->setColumnHeader('nombre_fam',_("familia"));
$x->setColumnHeader('nombre_unidad',_("medida"));
$x->setColumnHeader('c_uni_sal',_("cant saliente"));
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setClase("realizar_compra");

//para permitir filtros
$x->setColumnType('%abreviatura%', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('%precio%', EyeDataGrid::TYPE_MONTO);
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