<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave

$id_contrato=$_GET['id_contrato'];

$x->setQuery("id_conv,fecha_conv,obser_conv,status_conv", "convenio_pago","id_conv","id_contrato='$id_contrato' ");
$x->hideColumn('id_conv');
$x->setColumnHeader('obser_conv', _("observacion"));
$x->setColumnHeader('status_conv', _("status"));
$x->setColumnHeader('fecha_conv', _("fecha convenio"));
$x->setColumnType('fecha_conv', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarstatus_convenio('%id_conv%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimir_convenio('%id_conv%');");

//$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "fraccionarCargo('%id_cont_serv%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "editar_desc('%descu%','%id_cont_serv%')");

//$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('subtotal', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('total', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('desc', EyeDataGrid::TYPE_MONTO);
//para permitir filtros
$x->allowFilters();
//$x->showCheckboxes();

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
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
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@convenio_pago','id_conv=@%id_conv%');window.location.replace('#');");
$x->setClase("Convenio");
$x->printTable();
?>
