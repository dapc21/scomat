<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$modo=$_GET['modo'];
$id_caja_cob=$_GET['id_caja_cob'];
$fecha=date("Y-m-d");
$select="
SELECT ,contrato.nro_contrato,pagos.nro_factura,pagos.id_pago,pagos.fecha_pago, pagos.hora_pago,pagos.monto_pago,status_pago, 
  contrato_servicio_pagado.id_contrato, contrato_servicio_pagado.fecha_inst, contrato_servicio_pagado.cant_serv, contrato_servicio_pagado.costo_cobro
  , vista_cliente.cedula AS cedulacli, vista_cliente.nombre AS nombrecli, vista_cliente.apellido AS apellidocli
  , vista_tarifa.id_serv, vista_tarifa.nombre_servicio, vista_tarifa.tipo_costo 
   FROM pago_servicio, pagos, contrato_servicio_pagado, vista_tarifa, contrato, vista_cliente
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv and contrato_servicio_pagado.id_serv = vista_tarifa.id_serv AND contrato_servicio_pagado.id_contrato = contrato.id_contrato AND vista_tarifa.status_tarifa_ser = 'ACTIVO'::bpchar and contrato.cli_id_persona = vista_cliente.id_persona
  and pagos.id_caja_cob='$id_caja_cob' and pagos.fecha_pago='$fecha'  and pagos.status_pago='PAGADO'
  ORDER BY pagos.inc;
";

//$x->consultas($select);

if($_GET['order']==''){
	$x->setOrder('inc', 'ASC');
}

$x->setQuery("id_contrato,id_pago,fecha_pago,nro_contrato,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli,nombre_franq,nro_factura, base_imp, monto_iva, monto_pago, status_pago,inc","vista_pago_cont,vista_ubica","","vista_pago_cont.id_calle=vista_ubica.id_calle and impresion='NO' and  tipo_caja='PRINCIPAL'");
$x->setColumnHeader("nombre_franq", _("Franquicia"));
$x->setColumnHeader("nro_contrato", _("N Abonado"));
$x->setColumnHeader("nro_factura", _("N Factura"));
$x->setColumnHeader("nro_control", _("N Control"));
$x->setColumnHeader("cedulacli", _("CI/RIF"));
$x->setColumnHeader("nombrecli", _("Cliente"));
$x->setColumnHeader("apellidocli", _("Apellido"));
$x->setColumnHeader("monto_pago", _("Total"));
$x->setColumnHeader("fecha_pago", _("Fecha pago"));
$x->setColumnHeader("fecha_factura", _("fecha factura"));
$x->setColumnHeader("hora_pago", _("Hora"));
$x->setColumnHeader("base_imp", _("Base"));
$x->setColumnHeader("desc_pago", _("Desc."));
$x->setColumnHeader("monto_iva", _("IVA"));
$x->setColumnHeader("monto_reten", _("Ret. IVA"));
$x->setColumnHeader("islr", _("Ret. ISLR"));
$x->setColumnHeader("status_pago", _("Estatus"));
$x->setColumnHeader("n_credito", _("Nota Cred."));
$x->hideColumn('id_pago');
$x->hideColumn('id_contrato');
$x->setColumnType('monto_pago', EyeDataGrid::TYPE_MONTO, '',true);


$x->addRowSelect("traer_datos_pago('%id_pago%');window.location.replace('#');");


$x->setClase("DetalleCobros");

$x->allowFilters();
$x->showRowNumber();
$x->setColumnType('fecha_pago', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
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
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}


	$x->printTable();

  
  
  
?>