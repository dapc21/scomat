<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_promo,nombre_promo,inicio_promo,fin_promo,mes_promo,tipo_promo,descuento_promo,status_promo", "promocion","id_promo","");
$x->hideColumn('id_promo');
$x->hideColumn('tipo_promo');
$x->setColumnHeader('nombre_promo', 'Promoción');
$x->setColumnHeader('fecha_promo', 'Fecha Creacion');
$x->setColumnHeader('inicio_promo', 'Válido Desde');
$x->setColumnHeader('fin_promo', 'Hasta');
$x->setColumnHeader('mes_promo', 'Meses');
$x->setColumnHeader('tipo_promo', 'Tipo de Descuento');
$x->setColumnHeader('descuento_promo', 'Descuento');
$x->setColumnHeader('status_promo', 'Estatus');

$x->setColumnType('fin_promo', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('inicio_promo', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas

if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0){
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@promocion','id_promo=@%id_promo%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarpromocion('%id_promo%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarpromocion('%id_promo%')");
*/
$x->printTable();
?>
