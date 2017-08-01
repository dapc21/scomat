<?php
//require_once("../DataBase/Acceso.php");
session_start();
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

$id_serv_fraccion='ZZZ00001';
$acceso1=conexion();
$id_contrato=$_GET['id_contrato'];
$id_pago=$_GET['id_pago'];


	
if($modo!='EXCEL'){
}
if($_GET['order']==''){
	$x->setOrder('fecha_inst', 'ASC');
}
$x->setQuery("tipo_costo,id_cont_serv,fecha_inst,nombre_servicio,cant_serv,costo_cobro,(cant_serv*costo_cobro) as subtotal,descu ,((cant_serv * costo_cobro)- descu+0 ) as total, apagar", "vista_contratodeu","id_cont_serv","id_contrato='$id_contrato' and  id_pago='$id_pago' and tipo_doc='FACTURA' and costo_cobro>0 ");
$x->hideColumn('tipo_costo');
$x->hideColumn('id_cont_serv');
$x->hideColumn('costo_dif_men');
$x->setColumnHeader('apagar', _("nota credito"));
$x->setColumnHeader('nombre_servicio', _("Servicio"));
$x->setColumnHeader('tipo_servicio', _("Tipo Servicio"));
$x->setColumnHeader('fecha_inst', _("Fecha"));
$x->setColumnHeader('cant_serv', _("Cant."));
$x->setColumnHeader('costo_cobro', _("costo"));
$x->setColumnHeader('subtotal', _("Sub-total"));
$x->setColumnHeader('total', _("Total"));
$x->setColumnHeader('descu', 'Desc.');

$x->hideFooter(true);
//$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "fraccionarCargo('%id_cont_serv%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "editar_desc('%descu%','%id_cont_serv%')");


//$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('subtotal', EyeDataGrid::TYPE_MONTO);
//$x->setColumnType('total', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('desc', EyeDataGrid::TYPE_MONTO);
//para permitir filtros
$x->allowFilters();
$acceso->objeto->ejecutarSql("select *from parametros where id_param='38'");
$row=row($acceso);
$habilita=trim($row['valor_param']);
if($habilita=='1'){
	$x->showCheckboxes();
}
else {
	$x->showCheckboxes(true,'disabled');
}
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas

//mostrar resultados por pagina
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

$x->setClase("Nota Credito");

	
if($modo!='EXCEL'){
echo '
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section id="tabla-cargos-pagos">
	 ';
}

$x->printTable();
/*
		
$fecha=date("Y-m-01");

$acceso->objeto->ejecutarSql("select sum((costo_cobro*cant_serv)-descu-pagado) as deuda from vista_contrato_servicio_deuda where id_contrato='$id_contrato' and status_con_ser='DEUDA' ");
	$deuda=0;
	if($row=row($acceso)){
		$deuda_total=trim($row["deuda"]);
	}
	
if($modo!='EXCEL'){
echo'
	


<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section class="panel">
		<div class="text-btn" align="left">
			<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
			<div class="input-group">
				<span id="saldo" class="input-group-addon">TOTAL CARGOS</span>
				<input class="form-control" style="font-size:100%: color: #000000; font-weight:bold; text-align:right;" readonly type="text" name="saldo1" id="saldo1" maxlength="10" size="10" value="'.number_format($deuda_total+0, 2, ',', '.').'" onChange="">
				<span id="moneda" class="input-group-addon">BsF</span>
			</div>
			
			</div>
		</div>
		</section>
	</div>
';
}

*/
?>