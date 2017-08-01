
<style type="text/Css">
<!--
.titulo_ca
{
    font-weight: bold;
    font-size: 24pt;
    font-family: Arial;
    text-align: center;
}
.marca
{
    font-weight: bold;
    font-size: 22pt;
    font-family: Arial;
    text-align: center;
}
.texto_n
{
    font-weight: normal;
    font-size: 10pt; 
    font-family: Arial;
    text-align: left;
}
-->
</style>

<?php
require_once("../procesos.php");  $ini_u = $_SESSION["$ini_u"]; 
$acceso1=conexion();
$id_pago=$_GET['id_pago'];

$acceso->objeto->ejecutarSql("SELECT * FROM vista_pago_cont where id_pago='$id_pago' ");
if($row=row($acceso)){
	$id_caja_cob=trim($row['id_caja_cob']);
	$nombre_caja=trim($row['nombre_caja']);
	$id_est=trim($row['id_est']);
	$cobrador=trim($row['nombre'])." ".trim($row['apellido']);
	$id_contrato=trim($row['id_contrato']);
	$fecha_pago=formatofecha($row['fecha_pago']);
	$obser_pago=trim($row['obser_pago']);
	$hora_pago=trim($row['hora_pago']);
	
	$monto_pago=trim($row['monto_pago']);
	$nro_factura=trim($row['nro_factura']);
	$impresion=trim($row['impresion']);

	$cedulacli=trim($row['cedulacli']);
	$nombrecli=utf8_decode(trim($row['apellidocli'])." ".trim($row['nombrecli']));
	$nro_contrato=trim($row['nro_contrato']);

	$acceso->objeto->ejecutarSql("SELECT update_saldo(contrato.id_contrato) as saldo, pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago::date, pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, caja_cobrador.id_persona AS id_persona_cob, contrato.taps, caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, pagos.monto_pago / (pagos.por_iva / 100::numeric + 1::numeric) AS base_imp, pagos.monto_pago / (pagos.por_iva / 100::numeric + 1::numeric) * 12::numeric / 100::numeric AS monto_iva, pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est, pagos.impresion, pagos.inc, zona.nombre_zona, sector.nombre_sector, pagos.obser_pago, sector.id_sector, pagos.tipo_doc, pagos.desc_pago AS por_reten, pagos.desc_pago AS monto_reten, pagos.desc_pago AS islr, pagos.inc AS cont
   FROM pagos 
   JOIN contrato ON contrato.id_contrato::text = pagos.id_contrato::text and pagos.id_pago='$id_pago' 
   JOIN cliente ON cliente.id_persona::text = contrato.cli_id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN caja_cobrador ON pagos.id_caja_cob::text = caja_cobrador.id_caja_cob::text
   JOIN caja ON caja_cobrador.id_caja::text = caja.id_caja::text
   JOIN calle ON calle.id_calle::text = contrato.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text;
    ");
	if($row=row($acceso)){
		$id_caja_cob=trim($row['id_caja_cob']);
		$nombre_caja=trim($row['nombre_caja']);
		$id_est=trim($row['id_est']);
		$impresion=trim($row['impresion']);
		if($impresion=='NO'){
			$recibo='RECIBO';
			$acceso->objeto->ejecutarSql("update pagos set impresion='SI' where pagos.id_pago='$id_pago'");
		}else{
			$recibo='COPIA DE RECIBO';
		}
		$id_contrato=trim($row['id_contrato']);
		$fecha_pago=formatofecha($row['fecha_pago']);
		$obser_pago=utf8_decode($row['obser_pago']);
		$hora_pago=trim($row['hora_pago']);
		$nro_factura=trim($row['nro_factura']);

		$monto_pago=trim($row['monto_pago'])+0;
		$monto_iva=trim($row['monto_iva'])+0;
		$base_imp=trim($row['base_imp'])+0;
		$monto_pago=number_format($monto_pago, 2, ',', '.');
		$monto_iva=number_format($monto_iva, 2, ',', '.');
		$base_imp=number_format($base_imp, 2, ',', '.');

		$saldo=trim($row['saldo'])+0;
		$saldo=number_format($saldo, 2, ',', '.');

		$inicial_doc=trim($row['inicial_doc']);
		$cedulacli=trim($row['cedulacli']);
		$nombrecli=utf8_decode(trim($row['apellidocli'])." ".trim($row['nombrecli']));
		$nro_contrato=trim($row['nro_contrato']);

		$nombre_franq=utf8_decode(trim($row['nombre_franq']));
		$estado_franq=utf8_decode(trim($row['estado_franq']));
		$ciudad_franq=utf8_decode(trim($row['ciudad_franq']));
		$prefijo=utf8_decode(trim($row['prefijo']));
		$pref_desde=utf8_decode(trim($row['pref_desde']));
		$pref_hasta=utf8_decode(trim($row['pref_hasta']));
		$telefono_franq=utf8_decode(trim($row['telefono_franq']));
		$direccion_franq=utf8_decode(trim($row['direccion_franq']));
		$nombre_zona=utf8_decode(trim($row['nombre_zona']));
		$nombre_sector=utf8_decode(trim($row['nombre_sector']));
		$nombre_calle=utf8_decode(trim($row['nombre_calle']));
		$numero_casa=utf8_decode(trim($row['numero_casa']));
		$taps=utf8_decode(trim($row['taps']));
		$telefono=utf8_decode(trim($row['telefono']));

		$urbanizacion=utf8_decode(trim($row['urbanizacion']));
		$numero_piso=utf8_decode(trim($row['numero_piso']));
		$edificio=utf8_decode(trim($row['edificio']));
		$direc_adicional=utf8_decode(trim($row['direc_adicional']));
		if($edificio!=''){
            $edificio=",  Edif: $edificio, piso: $numero_piso ";
        }
		$dir= "$nombre_sector $urbanizacion,  $nombre_calle $edificio,  $numero_casa";
	}
	$acceso1->objeto->ejecutarSql("SELECT nombre,apellido, login FROM personausuario where id_persona='$id_persona_cob'");
    if($row=row($acceso1)){
            $login_cob=trim($row1['login']);
    }
}
?>

<div id="body_recibo">
<table border="0" align="center" width="96%" class="body_recibo">
	<tr><td colspan="4" class="titulo_ca"><div align="left">CableHOGAR</div></td></tr>
	<tr><td colspan="4" class="texto_n">Television e internet para todos</td></tr>
	<tr><td colspan="4" class="texto_n">2da. Av de las Fuentes. Qta. CableHOGAR, El Paraiso. 0212-4050211</td></tr>
	<tr><td colspan="4" class="texto_n">Sucursales: Propatria. La Vega, El limón, Gramoven, La Pastora, El Junquito, Antimano y Boqueron. (012)</td></tr>
	<tr><td colspan="4" class="texto_n">&nbsp;</td></tr>
	<?php ?>
	<tr><td colspan="4" class="marca"><?php echo $recibo; ?></td></tr>
	<tr><td colspan="4" class="texto_n">&nbsp;</td></tr>
	<tr><td colspan="4" class="texto_n"><div align="center">Nro. <?php echo $nro_factura; ?></div></td></tr>
	<tr >
	<td colspan="2" class="texto_n">Se&ntilde;or(a): <?php echo $nombrecli; ?></td>
	<td colspan="2" class="texto_n">Fecha: <?php echo $fecha_pago; ?></td>
	</tr>
	<tr>
	<td class="texto_n">CI/RIF: <?php echo $inicial_doc.$cedulacli; ?></td>
	<td class="texto_n">Localidad: <?php echo $nombre_zona; ?> </td>
	<td class="texto_n">Cajero(a): <?php echo $login_cob; ?> </td>
	<td class="texto_n">Abonado: <?php echo $nro_contrato; ?> </td>
	</tr>
	<tr>
	<td colspan="4" class="texto_n">Domicilio: <?php echo $dir; ?></td>
	</tr>
	<tr>
	<td colspan="4"  class="texto_n">
		<table width="100%" border="0">
  <tr>
    <td  class="texto_n"><strong>Descripci&oacute;n</strong></td>
    <td  class="texto_n"><div align="right"><strong>Total Bs. </strong></div></td>
  </tr>
  <tr>
    <td colspan="2"><hr></td>
    </tr>
    <?php 
    	$acceso1->objeto->ejecutarSql(" SELECT nombre_servicio, servicios.id_serv, servicios.tipo_costo,contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, pago_factura.costo_cobro_serv
   FROM pago_factura
   JOIN contrato_servicio_deuda ON pago_factura.id_cont_serv::text = contrato_servicio_deuda.id_cont_serv::text
   JOIN servicios ON contrato_servicio_deuda.id_serv::text = servicios.id_serv::text and  pago_factura.id_pago='$id_pago' ");
		while($row1=row($acceso1)){
			$nombre_servicio=trim($row1['nombre_servicio']);
			$tipo_costo=trim($row1['tipo_costo']);
			$fecha_inst=trim($row1['fecha_inst']);
			$fecha=trim($row1['fecha_inst']);
			$cant_serv=trim($row1['cant_serv'])+0;
			$costo_cobro=trim($row1['costo_cobro_serv'])+0;

			
			$fecha_contrato=formatofecha($pago[$i]['fecha_inst']);
			$fechaN=explode("-",$fecha);

					//CANEYES
				$mes=formato_m($fechaN[1]);
				$anio=$fechaN[0];
				if($tipo_costo=='COSTO MENSUAL'){
					if($id_serv=='ZZZ00001'){
						$nombre_servicio = "ABONO $mes $anio ";
					}else{
						$nombre_servicio = "MENS. $mes $anio ";
					}
				}
			
			$total=$cant_serv*$costo_cobro;
			$suma=$suma+$total;

			$costo_cobro=number_format($costo_cobro, 2, ',', '.');
			
			$total=number_format($total+0, 2, ',', '.');

     ?>
  <tr>
    <td  class="texto_n"><?php echo $nombre_servicio; ?></td>
    <td  class="texto_n"><p align="right"><?php echo $total; ?></p>
      </td>
  </tr>
  <?php 
    	}//while servicios pagados
     ?>
</table>	</td>
	</tr>
	
	 <tr>
	<td colspan="4"  class="texto_n">
	
		<table width="100%" border="0">
		  <tr>
			<td  class="texto_n"><div align="right">Sub-Total Bs: </div></td>
			<td  class="texto_n"><div align="right"><?php echo number_format($base_imp, 2, ',', '.');; ?></div></td>
		  </tr>
		 <tr>
			<td  class="texto_n"><div align="right">IVA <?php echo $nro_factura; ?>% Bs: </div></td>
			<td  class="texto_n"><div align="right"><?php echo number_format($monto_iva, 2, ',', '.');; ?></div></td>
		  </tr>
		 <tr>
			<td  class="texto_n"><div align="right">Total Bs: </div></td>
			<td  class="texto_n"><div align="right"><?php echo number_format($monto_pago, 2, ',', '.'); ?></div></td>
		  </tr>
		 <tr>
			<td  class="texto_n"></td>
			<td  class="texto_n"></td>
		  </tr>
		</table>	
	   </td>
	</tr>
	<tr>
	<td colspan="4" class="texto_n">&nbsp;</td>
	</tr>
	<tr>
	<td colspan="4" class="texto_n"><strong>Detalle del Pago</strong></td>
	</tr>
	
	 <tr>

	  <?php 
	  
    	$acceso1->objeto->ejecutarSql("SELECT tipo_pago.abrev_tp,detalle_tipopago.refer_tp, detalle_tipopago.monto_tp, banco.banco, detalle_tipopago.lote_tp, tipo_pago.tipo_pago 
FROM detalle_tipopago 
 JOIN tipo_pago ON detalle_tipopago.id_tipo_pago::text = tipo_pago.id_tipo_pago::text and detalle_tipopago.id_pago='$id_pago' 
 LEFT JOIN banco ON banco.id_banco::text = detalle_tipopago.id_banco::text ");
		while($row1=row($acceso1)){
			$refer_tp=trim($row1['refer_tp']);
			$monto_tp=trim($row1['monto_tp']);
			$banco=trim($row1['banco']);
			$lote_tp=trim($row1['lote_tp']);
			$tipo_pago=trim($row1['tipo_pago']);
			$abrev_tp=trim($row1['abrev_tp']);

			$monto_tp=number_format($monto_tp, 2, ',', '.');
			
     ?>

	<td colspan="4"  class="texto_n">
	
		<table width="100%" border="0">
		  <tr>
			<td  class="texto_n">Cuenta Recaudadora: <?php echo $banco; ?></td>
		 
			<td  class="texto_n">(<?php echo $abrev_tp; ?>): Tarjeta Nro. <?php echo $refer_tp; ?></td>
		 
			<td  class="texto_n">Cupon Nro.<?php echo $lote_tp; ?> </td>
			<td  class="texto_n">Importe: <?php echo $monto_tp; ?> </td>
		  </tr>
		 <tr>
			<td  class="texto_n">Saldo Actual: <?php echo $saldo; ?></td>
		  </tr>
		</table>	
	   </td>
	</tr>
	 <?php 
    	}//while servicios pagados
     ?>
	
	<tr>
	<td colspan="4" class="texto_n"><div align="center">CALL CENTER: 0500-TVHOGAR - Reciba su saldo en su celular enviando la palabra SALDO m&aacute;s su n&uacute;mero de C&eacute;dula al Nro. 0412-961.83.88 </div></td>
	</tr>
</table>
</div>