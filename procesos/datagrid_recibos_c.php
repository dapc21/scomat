<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$id_cobrador = $_GET['id_cobrador'];

$x->setQuery("nro_recibo,fecha_asig,status_pago", "vista_recibos","nro_recibo","status_pago='ASIGNADO' AND id_cobrador='$id_cobrador' and tipo='CONTRATO'");
$x->setColumnHeader('nro_recibo', 'Nro Factura');
$x->setColumnHeader('fecha_asig', 'Fecha');

$x->setClase("Recibos");
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
$x->showCheckboxes();
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

//$x->addRowSelect("buscar_id_rec('%id_rec%');window.location.replace('#');");

//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@recibos','nro_recibo=@%nro_recibo%')");
$x->setColumnType('fecha_asig', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarrecibos('%nro_recibo%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarrecibos('%nro_recibo%')");
*/
$x->printTable();
?>
