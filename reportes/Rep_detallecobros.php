<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$modo=$_GET['modo'];
$id_caja_cob=$_GET['id_caja_cob'];
$fecha=date("Y-m-d");

if($_GET['order']==''){
	$x->setOrder('nro_control', 'ASC');
}

$x->setQuery("id_contrato,id_pago,nro_factura,nro_control,nro_contrato,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, monto_pago,status_pago","vista_pago_cont","","id_caja_cob='$id_caja_cob' and fecha_pago::date='$fecha' and tipo_doc='PAGO'");
$x->setColumnHeader("nro_contrato", _("Nº Abonado"));
$x->setColumnHeader("nro_factura", _("Nº Factura"));
$x->setColumnHeader("nro_control", _("Nº Control"));
$x->setColumnHeader("cedulacli", _("CI/RIF"));
$x->setColumnHeader("nombrecli", _("Cliente"));
$x->setColumnHeader("apellidocli", _("Apellido"));
$x->setColumnHeader("monto_pago", _("Monto"));
$x->setColumnHeader("fecha_pago", _("Fecha Ingreso"));
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
//$x->addStandardControl(EyeDataGrid::STDCTRL_VISITA, "respRefActCont('%id_contrato%')");
$x->setColumnType('monto_pago', EyeDataGrid::TYPE_MONTO, '',true);

$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "ver_factura_html('%id_pago%')");

$x->setClase("DetalleCobros");

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



if($modo!='EXCEL'){

//BASE IMPONIBLE
$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as monto_pago FROM pagos where monto_pago>0 and  id_caja_cob='$id_caja_cob' and fecha_pago::date='$fecha' and tipo_doc='PAGO'  ");
if($row=row($acceso)){
	$cant_pago=trim($row["cant"]);
	$monto_pago=trim($row["monto_pago"]);
}

//BASE IMPONIBLE
$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as monto_pago FROM pagos where monto_pago>0 and  id_caja_cob='$id_caja_cob' and fecha_pago::date='$fecha' and tipo_doc='PAGO' AND status_pago='ANULADO' ");
if($row=row($acceso)){
	$cant_anulado=trim($row["cant"]);
	$monto_anulado=trim($row["monto_pago"]);
}

$cant_ingreso = $cant_pago - $cant_anulado;
$total_ingreso = $monto_pago - $monto_anulado;

//TOTAL FACTURADO
$total_facturado = $total_ingreso - $total_nc - $total_nc_dia;

echo '
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<section class="panel">

<header class="panel-heading">Resúmen de Cobranza</header>
	
	<div class="panel-body">
	
	<table class="table table-condensed">
		
		<tr class="titulo-tabla">
		  <th>DESCRIPCIÓN</th>
		  <th class="numeric">CANTIDAD</th>
		  <th class="numeric">TOTAL</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		  <td>PAGOS REALIZADOS</td>
		  <td class="numeric">'.$cant_pago.'</td>
		  <td class="numeric">'.number_format($monto_pago+0, 2, ',', '.').'</td>
		</tr>
		<tr>
		  <td>PAGOS ANULADOS</td>
		  <td class="numeric">'.$cant_anulado.'</td>
		  <td class="numeric">'.number_format($monto_anulado+0, 2, ',', '.').'</td>
		</tr>
		<tr class="total-tabla">
		  <td>TOTAL INGRESO</td>
		  <td class="numeric">'.$cant_ingreso.'</td>
		  <td class="numeric">'.number_format($total_ingreso+0, 2, ',', '.').'</td>
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

$dato=lectura($acceso,"SELECT * FROM tipo_pago ORDER BY id_tipo_pago");
$suma_c=0;
$suma_can=0;

		for($k=0;$k<count($dato);$k++){
			$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
			$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) AS cant FROM vista_tipopago WHERE id_caja_cob='$id_caja_cob' AND fecha_pago::date='$fecha' and tipo_doc='PAGO' AND id_tipo_pago='$id_tipo_pago' AND status_pago='PAGADO' AND obser_pago <> 'NOTA CREDITO' ");
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
echo '
	  <tr class="total-tabla">
		  <td>TOTAL FORMA DE PAGO</td>
		  <td class="numeric">'.$suma_can.'</td>
		  <td class="numeric">'.number_format($suma_c+0, 2, ',', '.').'</td>
	  </tr>
	  
	  </tbody>
	</table>
	
	</div>
	
</section>
	
</div>
';

echo '
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<section id="tabla-factura" class="panel">

<header class="panel-heading">Datos de las Facturas</header>
	
	<div class="panel-body">';	
	$x->printTable();
echo '
	
	</div>
	
</section>
	
</div>
';

}
?>