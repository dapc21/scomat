<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave

$id_contrato=$_GET['id_contrato'];
if($_GET['DESC']=''){
	$x->setOrder('fecha_inst', 'ORDER_ASC');
}
$x->setQuery("tipo_costo,id_cont_serv,costo_dif_men,fecha_inst as fecha_ven, fecha_inst,nombre_servicio,tipo_servicio,(cant_serv*costo_cobro) as subtotal,descu ,((cant_serv * costo_cobro)- descu+0 ) as total", "vista_contratodeu","id_cont_serv","id_contrato='$id_contrato' and status_con_ser='DEUDA' and costo_cobro>0 ");
$x->hideColumn('tipo_costo');
$x->hideColumn('id_cont_serv');
$x->hideColumn('costo_dif_men');
$x->setColumnHeader('nombre_servicio', _("Servicio"));
$x->setColumnHeader('tipo_servicio', _("Tipo Servicio"));
$x->setColumnHeader('fecha_inst', _("F. cargo"));
$x->setColumnHeader('fecha_ven', _("F. plazo"));
$x->setColumnHeader('cant_serv', _("cant"));
$x->setColumnHeader('costo_cobro', _("costo"));
$x->setColumnHeader('subtotal', _("Sub-total"));
$x->setColumnHeader('total', _("Total"));
$x->setColumnHeader('descu', 'Desc');

$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "fraccionarCargo('%id_cont_serv%');window.location.replace('#');");
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "editar_desc('%descu%','%id_cont_serv%');window.location.replace('#');");

//$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('subtotal', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('total', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('desc', EyeDataGrid::TYPE_MONTO);
//para permitir filtros
$x->allowFilters();
$x->showCheckboxes();

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
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@convenio_pago','id_conv=@%id_conv%')");
$x->setClase("Convenio");
$x->printTable();
?>
