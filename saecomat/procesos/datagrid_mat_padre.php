<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_m,numero_mat,nombre_mat,nombre_fam,nombre_unidad,impresion", "vista_matpadre","id_m","");
$x->hideColumn('id_m');
$x->setColumnHeader('numero_mat',_('Nº'));
$x->setColumnHeader('nombre_mat',_('Nombre'));
$x->setColumnHeader('nombre_fam',_('Familia'));
$x->setColumnHeader('impresion',_('Impresión'));
$x->setColumnHeader('nombre_unidad',_('Unidad Entrante'));
$x->setColumnHeader('','');
$x->setColumnHeader('','');
$x->setColumnType('impresion', EyeDataGrid::TYPE_CUSTOM, '');
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@mat_padre','id_m=@%id_m%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmatpadre('%id_m%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmatpadre('%id_m%')");
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
