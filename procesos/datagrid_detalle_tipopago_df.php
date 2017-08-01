<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave

$x->setQuery("id_dbf,abrev_cuba,tipo_pago,fecha_dbf,monto_dbf,refer_dbf,status_dbf", "vista_pagosfranquicia","id_dbf","");
//$x->setQuery("id_dbf,abrev_cuba,tipo_pago,fecha_dbf,monto_dbf,refer_dbf,status_dbf", "vista_pagosfranquicia","id_dbf","status_dbf='REGISTRADO'");
$x->hideColumn('id_dbf');
$x->setColumnHeader('abrev_cuba', 'cuenta bancaria');
$x->setColumnHeader('tipo_pago', 'tipo pago');
$x->setColumnHeader('fecha_dbf', 'fecha');
$x->setColumnHeader('refer_dbf', '# referencia');
$x->setColumnHeader('monto_dbf', 'Monto');
$x->setColumnHeader('status_dbf', 'status');

$x->setColumnType('fecha_dbf', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
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
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@detalle_tipopago_df','id_dbf=@%id_dbf%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificardetalle_tipopago_df('%id_dbf%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminardetalle_tipopago_df('%id_dbf%')");
*/
$x->printTable();
?>
