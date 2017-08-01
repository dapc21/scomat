<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


$ini_u = $_SESSION["ini_u"]; 
$acceso->objeto->ejecutarSql("select id_tp from detalle_tipopago_temp  where (id_tp ILIKE '$ini_u%')  ORDER BY id_tp desc LIMIT 1 offset 0 "); 
$id_tp= $ini_u.verCoo($acceso,"id_tp");


$id_pago=$_GET['id_pago'];
$x->setQuery("id_tp,id_pago,id_tipo_pago,id_banco,lote_tp, tipo_pago, banco,monto_tp,refer_tp", "vista_tipopago_temp","","id_pago='$id_pago'");
$x->hideColumn('id_tp');
$x->hideColumn('id_tipo_pago');
$x->hideColumn('id_banco');
$x->hideColumn('id_pago');
$x->hideColumn('lote_tp');
$x->setColumnHeader('tipo_pago', 'forma pago');
$x->setColumnHeader('monto_tp', 'monto');
$x->setColumnHeader('tipo_pago', 'forma pago');	
$x->setColumnHeader('refer_tp', 'referencia');
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminardetalle_tipopago_temp('%id_tp%','%id_tipo_pago%','%id_banco%','%refer_tp%','%monto_tp%','%lote_tp%')");
//$x->addRowSelect("eliminardetalle_tipopago_temp('%id_tp%','%id_tipo_pago%','%id_banco%','%refer_tp%','%monto_tp%','%lote_tp%');window.location.replace('#');");
//$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcontrato_servicio_temp('%id_cont_serv%','%id_serv%','%id_contrato%')");
$x->hideFooter(true);


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
$acceso->objeto->ejecutarSql("select sum(monto_tp) as total from vista_tipopago_temp where id_pago='$id_pago'");
	$total=0;
	if($row=row($acceso)){
		$total=trim($row["total"])+0;
	}
if($modo!='EXCEL'){
echo '<input  type="hidden" value="'.$id_tp.'" name="id_tp" id="id_tp">	';
	echo '<input  type="hidden" value="'.$total.'" name="total_fp" id="total_fp">	';
	//echo '<div align="right" class="fuente">'._("total costo mensual suscrito").': <span class="fuenteN">'.number_format($total,2,",",".").'</span></div>';
}
?>
