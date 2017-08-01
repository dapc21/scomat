<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$tipo_caja=verCajaPrincipal($acceso);
//echo $tipo_caja;	
$x = new EyeDataGrid($db);

$id_franq = $_GET['id_franq'];
$id_f = $id_franq;  
if($id_f!='0'){
	$consult=" and id_franq='$id_f'";
}else{
	//	$consult=" and id_franq='$id_franq'";
}
//echo $consult;
//echo $consult;
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

if($_GET['order']==''){
	$x->setOrder('nro_control', 'ASC');
}

$x->setQuery("id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_pago, fecha_factura, fecha_pago,status_pago , n_credito","vista_pago_cont","","fecha_pago between '$desde' and '$hasta'  and tipo_caja='PRINCIPAL'  and impresion='SI'  $consult");
$x->setColumnHeader("nro_contrato", _("contrato"));
$x->setColumnHeader("nro_factura", _("factura"));
$x->setColumnHeader("nro_control", _("control"));
$x->setColumnHeader("cedulacli", _("C.I./RIF"));
$x->setColumnHeader("nombrecli", _("cliente"));
$x->setColumnHeader("apellidocli", _("apellido"));
$x->setColumnHeader("monto_pago", _("monto"));
$x->setColumnHeader("fecha_factura", _("Fecha factura"));
$x->setColumnHeader("fecha_pago", _("Fecha ingreso"));
$x->setColumnHeader("hora_pago", _("hora"));
$x->setColumnHeader("base_imp", _("base"));
$x->setColumnHeader("desc_pago", _("desc"));
$x->setColumnHeader("monto_iva", _("iva"));
$x->setColumnHeader("monto_reten", _("Ret. IVA"));
$x->setColumnHeader("islr", _("Ret. ISLR"));
$x->setColumnHeader("status_pago", _("Status"));
$x->setColumnHeader("n_credito", _("Nota Cred."));
$x->hideColumn('id_pago');
$x->hideColumn('id_contrato');

$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "respRefActCont('%id_contrato%')");

$x->setColumnType('base', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('iva', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_pago', EyeDataGrid::TYPE_MONTO, '',true);

$x->setColumnType('fecha_factura', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_pago', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->desde=$desde;
$x->hasta=$hasta;

$x->setClase("rep_libroventa");
$x->allowFilters();
$x->showRowNumber();

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


if($_GET['modo']!="EXCEL"){


$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as exento FROM vista_pago,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva=0  and fecha_pago between '$desde' and '$hasta'  and impresion='SI'  and tipo_caja='PRINCIPAL' ");
if($row=row($acceso)){
	$cantexento=trim($row["cant"]);
	$exento=trim($row["exento"]);
}


$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as base_imp, sum(monto_iva) as monto_iva FROM vista_pago ,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0  and fecha_pago between '$desde' and '$hasta'  and impresion='SI'  and tipo_caja='PRINCIPAL'  ");

if($row=row($acceso)){
	$cantbase_imp=trim($row["cant"]);
	$base_imp=trim($row["base_imp"]);
}

$acceso->objeto->ejecutarSql("SELECT count(*) cant,  sum(monto_iva) as monto_iva FROM vista_pago ,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0  and fecha_pago between '$desde' and '$hasta'  and impresion='SI'  and tipo_caja='PRINCIPAL'  ");

if($row=row($acceso)){
	$cantmonto_iva=trim($row["cant"]);
	$monto_iva=trim($row["monto_iva"]);
}


//TOTAL INGRESO
$cant_ingreso = $cantbase_imp + $cantmonto_iva + $cantexento;
$total_ingreso = $base_imp + $monto_iva + $exento;

$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM vista_pago ,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago between '$desde' and '$hasta'  and  status_pago='ANULADO'");
if($row=row($acceso)){
	$canttotal_nc_dia=trim($row["cant"]);
	$total_nc_dia=trim($row["total_nc"]);
}


$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(desc_pago) as desc_pago FROM vista_pago ,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and desc_pago>0  and fecha_pago between '$desde' and '$hasta'  and impresion='SI'  and tipo_caja='PRINCIPAL' ");
if($row=row($acceso)){
	$cantdesc_pago=trim($row["cant"]);
	$desc_pago=trim($row["desc_pago"]);
}

			
$total_facturado=$exento+$base_imp+$monto_iva-$desc_pago-$total_nc_dia;

echo '
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<section class="panel">

<header class="panel-heading">Resúmen de Facturación</header>
	
	<div class="panel-body">
	
	<table class="table table-condensed">
		<thead>
		<tr class="titulo-tabla">
		  <th>DESCRIPCIÓN</th>
		  <th class="numeric">CANTIDAD</th>
		  <th class="numeric">TOTAL</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		  <td>FACTURAS (EXENTAS)</td>
		  <td class="numeric">'.$cantexento.'</td>
		  <td class="numeric">'.number_format($exento+0, 2, ',', '.').'</td>
		</tr>
		<tr>
		  <td>FACTURAS (BASE IMPONIBLE)</td>
		  <td class="numeric">'.$cantbase_imp.'</td>
		  <td class="numeric">'.number_format($base_imp+0, 2, ',', '.').'</td>
		</tr>
		<tr>
		  <td>IVA (12%)</td>
		  <td class="numeric">'.$cantmonto_iva.'</td>
		  <td class="numeric">'.number_format($monto_iva+0, 2, ',', '.').'</td>
		</tr>
		<tr>
		  <td>NOTAS DE CRÉDITOS</td>
		  <td class="numeric">'.$canttotal_nc_dia.'</td>
		  <td class="numeric">-'.number_format($total_nc_dia+0, 2, ',', '.').'</td>
		</tr>
		<tr>
		  <td>DESCUENTOS</td>
		  <td class="numeric">'.$cantdesc_pago.'</td>
		  <td class="numeric">-'.number_format($desc_pago+0, 2, ',', '.').'</td>
		</tr>
		<tr class="total-tabla">
		  <td>TOTAL FACTURADO</td>
		  <td class="numeric"> </td>
		  <td class="numeric">'.number_format($total_facturado+0, 2, ',', '.').'</td>
		</tr>

		</tbody>
		</table>
	
	</div>
	
</section>
	
</div>
';


echo '
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<section class="panel">

<header class="panel-heading">Resúmen por Forma de Pago</header>
	
	<div class="panel-body">
	
	<table class="table table-condensed">
	  <thead>
	  <tr class="titulo-tabla">
		  <th>FORMA DE PAGO</th>
		  <th class="numeric">CANTIDAD</th>
		  <th class="numeric">TOTAL</th>
	  </tr>
	  </thead>
	  <tbody>';
			 
			
$dato=lectura($acceso,"SELECT * FROM tipo_pago where status_pago='ACTIVO'");
$suma_c=0;
$suma_can=0;
			 
	for($k=0;$k<count($dato);$k++){
		$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
		$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago where  fecha_pago between '$desde' and '$hasta'  and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'  and impresion='SI'  and tipo_caja='PRINCIPAL'  $consult  ");
		$suma=0;
		if($row=row($acceso))
		{
			$monto_tp=trim($row["monto_tp"])+0;
			$cant=trim($row["cant"])+0;
			$suma_c+=$monto_tp;
			$suma_can+=$cant;

					echo '<tr>
					  <td>'.trim($dato[$k]["tipo_pago"]).'</td>
					  <td class="numeric">'.$cant.'</td>
					  <td class="numeric">'.number_format($monto_tp+0, 2, ',', '.').'</td>
					</tr>';
		}
	}
	
	/*
$acceso->objeto->ejecutarSql("SELECT  sum(monto_reten) as monto_reten FROM vista_pago ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and monto_reten>0  and fecha_pago between '$desde' and '$hasta'  and status_pago='PAGADO'  and impresion='SI'  and tipo_caja='PRINCIPAL'  ");
if($row=row($acceso)){
	$monto_reten=trim($row["monto_reten"]);
}
$acceso->objeto->ejecutarSql("SELECT  sum(islr) as islr FROM vista_pago ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and islr>0  and fecha_pago between '$desde' and '$hasta'  and status_pago='PAGADO'  and impresion='SI'  and tipo_caja='PRINCIPAL'  ");
if($row=row($acceso)){
	$islr=trim($row["islr"]);
}
*/

echo '
	  <tr class="total-tabla">
		  <td>TOTAL FORMA DE PAGO</td>
		  <td class="numeric">'.$suma_can.'</td>
		  <td class="numeric">'.number_format($suma_c+0, 2, ',', '.').'</td>
	  </tr>
	  
	  <tr class="total-tabla">
		<td>RET. IVA: '.number_format($monto_reten+0, 2, ',', '.').' + RET. ISLR: '.number_format($islr+0, 2, ',', '.').' + TOTAL: '.number_format($islr+0, 2, ',', '.').' </td>
		<td class="numeric"> = </td>
		<td class="numeric">'.number_format($monto_reten+$islr+$suma_c+0, 2, ',', '.').'</td>
	  </tr>
	  
	  </tbody>
	</table>
	
	</div>
	
</section>
	
</div>
';



echo '
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<section class="panel">
<div class="panel-body">
';
}
$x->printTable();
if($_GET['modo']!="EXCEL"){
	echo '
	</div>
	</section>
	</div>	
	';
}
?>
