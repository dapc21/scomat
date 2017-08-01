<?php
//require_once("../DataBase/Acceso.php");
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

//crea la consulta SQL 
//campos, tabla, campo clave
$id_contrato=$_GET['id_contrato'];


$pagos=lectura($acceso," select id_pago,monto_pago,tipo_doc,nro_factura,obser_pago,fecha_pago::date,status_pago from pagos where id_contrato='$id_contrato' and (tipo_doc='FACTURA' OR tipo_doc='PAGO' OR tipo_doc='NOTA CREDITO' OR tipo_doc='NOTA DEBITO' OR tipo_doc='AVISO') and (status_pago<>'ANULADO' AND status_pago<>'SOLICITADA' )order By fecha_pago,inc");

if($modo!='EXCEL'){
echo '

	<div class="panel-body">
	
	<table class="table table-condensed">
		<thead>
		<tr class="titulo-tabla">
		  <th class="numeric">Nº</th>
		  <th class="numeric">FECHA</th>
		  <th class="numeric">Nº DOCUMENTO</th>
		  <th class="numeric">TIPO</th>
		  <th>DESCRIPCION</th>
		  <th class="numeric">CARGO</th>
		  <th class="numeric">ABONO</th>
		  <th class="numeric">SALDO</th>
		  <th class="numeric">DETALLE</th>
		</tr>
		</thead>
';
}
$estado_cuenta=array();
$saldo=0;
for($i=0;$i<count($pagos);$i++){
	
	$monto_pago=trim($pagos[$i]['monto_pago'])+0;
	$id_pago=trim($pagos[$i]['id_pago']);
	$status_pago=trim($pagos[$i]['status_pago']);
	$fecha=trim($pagos[$i]['fecha_pago']);
	$tipo=trim($pagos[$i]['tipo_doc']);
	$nro_factura=trim($pagos[$i]['nro_factura']);
	$obser_pago=trim($pagos[$i]['obser_pago']);
	$cargo=0;
	$abono=0;
	
	$verdatos='';
	
	if($tipo=='FACTURA'){
		$saldo+=$monto_pago;
		$cargo=$monto_pago;
		$verdatos='&nbsp;';
		$color='';
		$verdatos='<a href="javascript:ajaxVentana_msg(\'ver_detalle_factura.php\',\''.$id_pago.'\',\'Detalle de Factura\')">
		<button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle"><i class="fa fa-table"></i></button>
		</a>';
	}
	else if($tipo=='AVISO'){
		$saldo+=$monto_pago;
		$cargo=$monto_pago;
		$verdatos='&nbsp;';
		$color='';
		$verdatos='<a href="javascript:ajaxVentana_msg(\'ver_detalle_factura.php\',\''.$id_pago.'\',\'Detalle de Aviso\')">
		<button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle"><i class="fa fa-table"></i></button>
		</a>';
	}
	else if($tipo=='NOTA DEBITO'){
		$saldo+=$monto_pago;
		$cargo=$monto_pago;
		
		$color='';
		$acceso->objeto->ejecutarSql("select n_credito from pagos where id_pago='$id_pago' ");
		$deuda=0;
		if($row=row($acceso)){
			$n_credito=trim($row["n_credito"]);
		//	echo "select nro_factura,fecha_pago,fecha_factura from pagos where id_pago='$n_credito' ";
			$acceso->objeto->ejecutarSql("select nro_factura,fecha_factura,obser_pago from pagos where id_pago='$n_credito' ");

			$deuda=0;
			if($row=row($acceso)){
				$nro_factura=trim($row["nro_factura"]);
				$fecha_factura=trim($row["fecha_factura"]);
				list($ano,$mes,$dia)=explode("-",$fecha_factura);
				$mes_fact=formato_m($mes);
				$fecha_pago=formatofecha(trim($row["fecha_pago"]));
				$obser_pago=trim($row["obser_pago"]);
				$obser_pago= " FACTURA $nro_factura,  $mes_fact $ano";
			}
			
		}	
		
		$verdatos='<a href="javascript:ajaxVentana_msg(\'ver_detalle_nota_debito.php\',\''.$id_pago.'\',\'Detalle de Nota de Debito\')">
		<button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle"><i class="fa fa-table"></i></button>
		</a>';
	}
	else if($tipo=='PAGO'){
		if($status_pago=="ANULADO"){
			continue;
		}
		$color=' class="alert-success"';
		$saldo-=$monto_pago;
		$abono=$monto_pago;
		$obser_pago='PAGO REALIZADO';
		$verdatos='<a href="javascript:ajaxVentana_msg(\'ver_detalle_pago.php\',\''.$id_pago.'\',\'Detalle de Pago\')">
		<button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle"><i class="fa fa-table"></i></button>
		</a>
		<a href="javascript:imprimir_recibo_pago(\''.$id_pago.'\')">
		<button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle"><i class="fa fa-print"></i></button>
		</a>';
	}
	else if($tipo=='NOTA CREDITO'){
		$color=' class="alert-success"';
		$saldo-=$monto_pago;
		$abono=$monto_pago;
		
		
	$acceso->objeto->ejecutarSql("select n_credito from pagos where id_pago='$id_pago' ");
	$deuda=0;
	if($row=row($acceso)){
		$n_credito=trim($row["n_credito"]);
	//	echo "select nro_factura,fecha_pago,fecha_factura from pagos where id_pago='$n_credito' ";
		$acceso->objeto->ejecutarSql("select nro_factura,fecha_factura,obser_pago from pagos where id_pago='$n_credito' ");

		$deuda=0;
		if($row=row($acceso)){
			$nro_factura=trim($row["nro_factura"]);
			$fecha_factura=trim($row["fecha_factura"]);
			list($ano,$mes,$dia)=explode("-",$fecha_factura);
			$mes_fact=formato_m($mes);
			$fecha_pago=formatofecha(trim($row["fecha_pago"]));
			$obser_pago=trim($row["obser_pago"]);
			$obser_pago= " FACTURA $nro_factura,  $mes_fact $ano";
		}
		
	}

	
		
	//	$obser_pago='PAGO REALIZADO';
		$verdatos='<a href="javascript:ajaxVentana_msg(\'ver_detalle_nota_credito.php\',\''.$id_pago.'\',\'Detalle de Nota de Credito\')">
		<button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle"><i class="fa fa-table"></i></button>
		</a>';
	}
	
	$abono=number_format($abono+0, 2, ',', '.');
	$cargo=number_format($cargo+0, 2, ',', '.');
	$saldo_f=number_format($saldo+0, 2, ',', '.');
	
	$cont=$i+1;
	
	
		$estado_cuenta[$i]['color']=$color;
		$estado_cuenta[$i]['nro_factura']=$nro_factura;
		$estado_cuenta[$i]['fecha']=formatofecha($fecha);
		$estado_cuenta[$i]['tipo']=$tipo;
		$estado_cuenta[$i]['obser_pago']=$obser_pago;
		$estado_cuenta[$i]['cargo']=$cargo;
		$estado_cuenta[$i]['abono']=$abono;
		$estado_cuenta[$i]['saldo_f']=$saldo_f;
		$estado_cuenta[$i]['verdatos']=$verdatos;
		
}
	$j=$i-1;
	$cont=1;
	$saldo="0,00";
for($i=$j;$i>=0;$i--){
	if($i==$j){
		$saldo=$estado_cuenta[$i]['saldo_f'];
	}
	$s_menos='';
	if($estado_cuenta[$i]['tipo']=='PAGO' || $estado_cuenta[$i]['tipo']=='NOTA CREDITO'){
		$s_menos='-';
	}
	
	if($modo!='EXCEL'){
	echo '  <tbody>
			<tr '.$estado_cuenta[$i]['color'].'>
			  <td class="numeric">'.$cont.'</td>
			  <td class="numeric">'.$estado_cuenta[$i]['fecha'].'</td>
			  <td class="numeric">'.$estado_cuenta[$i]['nro_factura'].'</td>
			  <td class="numeric">'.$estado_cuenta[$i]['tipo'].'</td>
			  <td class="numeric">'.$estado_cuenta[$i]['obser_pago'].'</td>
			  <td class="numeric">'.$estado_cuenta[$i]['cargo'].'</td>
			  <td class="numeric">'.$s_menos.$estado_cuenta[$i]['abono'].'</td>
			  <td class="numeric">'.$estado_cuenta[$i]['saldo_f'].'</td>
			  <td class="numeric">'.$estado_cuenta[$i]['verdatos'].'</td>
			</tr>

			</tbody>';
			$cont++;
	}
}
	
if($modo!='EXCEL'){
/*
	echo "select saldo,color from contrato,statuscont where contrato.status_contrato=statuscont.status_contrato and  id_contrato='$id_contrato' ";
	$acceso->objeto->ejecutarSql("select saldo,color from contrato,statuscont where contrato.status_contrato=statuscont.status_contrato and  id_contrato='$id_contrato' ");
		$deuda=0;
		if($row=row($acceso)){
			$saldo=trim($row["saldo"]);
			$color=trim($row["color"]);

echo '		</table>
	
				<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="input-group">
						<span id="saldo" class="input-group-addon">SALDO</span>
						<input class="form-control" style="#'.$color.'; font-weight:blod; font-size:14; "  type="text" name="saldo_e_c" id="saldo_e_c" maxlength="10" size="10" value="'.$saldo.'" onChange="">
						
					</div>
				</div>

	</div>

';

			}*/
/*
echo '
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section class="panel">
		<div class="text-btn" align="center">
			<button class="btn btn-info" type="button" name="registrar" value="'. _('estado de cuenta').'" onclick="GuardarRep_historial_deuda(\''.$id_contrato.'\')"><i class="glyphicon glyphicon-ok"></i> Estado de Cuenta</button>
			
		</div>
		</section>
	</div>

</div>';
*/
}


function ordernarArray ($ArrayaOrdenar, $por_este_campo, $descendiente = false) {
	$posicion = array();
	$NuevaFila = array();
	foreach ($ArrayaOrdenar as $clave => $fila) {
		$posicion[$clave] = $fila[$por_este_campo];
		$NuevaFila[$clave] = $fila;
	}
	if ($descendiente) {
		arsort($posicion);
	}
	else {
		asort($posicion);
	}
	$ArrayOrdenado = array();
	foreach ($posicion as $clave => $pos) {
		$ArrayOrdenado[] = $NuevaFila[$clave];
	}
	return $ArrayOrdenado;
} //fin de la funcion




?>