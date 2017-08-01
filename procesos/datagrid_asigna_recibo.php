<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$tipo=$_GET['tipo'];
$fecha=date("Y-m-d");
//crea la consulta SQL
//campos, tabla, campo clave
$x->setQuery("id_asig,(nombre || ' ' || apellido) as cobrador,fecha_asig,desde,hasta,cantidad,obser_asig", "vista_asignarecibo","id_asig"," fecha_asig='$fecha' and tipo='$tipo'");
$x->hideColumn('id_asig');
$x->setColumnHeader('cobrador', 'Cobrador/Vendedor');
$x->setColumnHeader('fecha_asig', 'Fecha');
$x->setColumnHeader('desde', 'Desde');
$x->setColumnHeader('hasta', 'Hasta');
$x->setColumnHeader('cantidad', 'Cantidad');
$x->setColumnHeader('obser_asig', 'Observación');


$x->setColumnType('fecha_asig', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);


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
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->addRowSelect("buscar_id_asig('%id_asig%');window.location.replace('#');");

//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@asigna_recibo','id_asig=@%id_asig%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarasigna_recibo('%id_asig%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarasigna_recibo('%id_asig%')");
*/

$x->printTable();

?>