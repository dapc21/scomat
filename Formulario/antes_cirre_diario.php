<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
session_start();
	$id_f = $_SESSION["id_franq"]; 
	$consult=" and id_franq='$id_f'";
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('cirre_consulta')))
{

	$fecha= date("Y-m-d");
	
$acceso->objeto->ejecutarSql("select * from cirre_diario where fecha_cierre='$fecha'");
if($acceso->objeto->registros>0)
	echo '<div class="error"><br>Error, ya se realiz&oacute; el cierre de d&iacute;a.</div>';
else{
	
	
	$acceso->objeto->ejecutarSql("select sum(desc_pago) as desccuento ,(sum(monto_pago)-sum(desc_pago)) as total from pagos where  fecha_pago='$fecha' and status_pago='PAGADO'");
	if($row=row($acceso)){
				$desccuento=trim($row["desccuento"]);
				$total=trim($row["total"]);
	}
	echo "DESCUENTO: $desccuento <br>";		
	echo "TOTAL: $total <br>";	
	
?>
<BR><div class="cabe"><?php echo _("consulta de cierre diario");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos del cierre");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_cierre" maxlength="12" size="30"onChange="validarcirre_diario()" value="<?php $acceso->objeto->ejecutarSql("select *from cirre_diario  where (id_cierre ILIKE '$ini_u%') ORDER BY id_cierre desc"); echo $ini_u.verCodLong($acceso,"id_cierre")?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="fecha_cierre" id="fecha_cierre" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hora ");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="hora_cierre" maxlength="10" size="10" value="<?php echo date("H:i:s");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("monto");?>
				</span>
			</td>
			<td>
				<input  disabled type="text" name="monto_total" maxlength="10" size="10" value="<?php echo calMontoCDCA($acceso,date("Y-m-d"),$id_f); ?>" >
			</td>
		
		</tr>
		<tr>
			
			<td>
				<span class="fuente"><?php echo _("observacion");?>
				</span>
			</td>
			<td COLSPAN="5">
				<textarea name="obser_cierre" cols="95" rows="1"></textarea>
			</td>
		</tr>
	</table>
	</fieldset>
  </td>		
 </tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="4" rowspan="1">
				<br>
				<div align="center">
					<input  type="hidden" name="registrar" value="<?php echo _("registrar cierre");?>" onclick="verificar('incluir','cirre_diario')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cirre_diario')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','cirre_diario')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','antes_cirre_diario')" value="ACTUALIZAR CONSULTA">
				</div>
			</td>
		</tr>

<tr>
  <td>
  <?php
	$tipo_caja=verCajaPrincipal($acceso);
	$fecha=date("Y-m-d");

////////////////////////////////////////////////////////////////////////////



echo '
<table border="0" width="960px" align="CENTER"> 
<tr>
  
  
  <td width50%" valign="top">
	<fieldset >
		<legend >'. _('resumen de facturacions').'</legend>
			<table border="0" width="95%" align="left"> 
			<tr>
			  <td class="fuenteN" width="50%">
				'. _('descripcion').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="25%">
				'. _('cant').'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="25%">
				'. _('total').'
			  </td>
			 </tr>
			 ';
				//echo "SELECT count(*) cant, sum(base_imp + desc_pago ) as excento FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva=0  and fecha_pago='$fecha'";
				$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as excento FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva=0  and fecha_pago='$fecha' ");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$excento=trim($row["excento"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('FACTURAS (EXCENTAS)').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">
				'.number_format($excento+0, 2, ',', '.').'
			  </td>
			 </tr>';
			 
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as base_imp, sum(monto_iva) as monto_iva FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0  and fecha_pago='$fecha' ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$base_imp=trim($row["base_imp"]);
					
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('FACTURAS (BASE IMPONIBLE)').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">
				'.number_format($base_imp+0, 2, ',', '.').'
			  </td>
			 </tr>';
			 
				$acceso->objeto->ejecutarSql("SELECT count(*) cant,  sum(monto_iva) as monto_iva FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0  and fecha_pago='$fecha' ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto_iva=trim($row["monto_iva"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('IVA (12%)').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">
				'.number_format($monto_iva+0, 2, ',', '.').'
			  </td>
			 </tr>';
		
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago='$fecha' and  status_pago='ANULADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$total_nc=trim($row["total_nc"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('NOTAS DE CREDITOS').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">-
				'.number_format($total_nc+0, 2, ',', '.').'
			  </td>
			 </tr>';
			 
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(desc_pago) as desc_pago FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and desc_pago>0  and fecha_pago='$fecha'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$desc_pago=trim($row["desc_pago"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('DESCUENTOS').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">-
				'.number_format($desc_pago+0, 2, ',', '.').'
			  </td>
			 </tr>';
			
			$total_facturado=$excento+$base_imp+$monto_iva-$desc_pago-$total_nc;
		echo '
			<tr>
			  <td class="fuenteN" width="50%">
				'. _('TOTAL facturado').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="25%">
				
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="25%">
				'.number_format($total_facturado+0, 2, ',', '.').'
			  </td>
			 </tr>
			 
			 
			 </table>		
	</fieldset>
  </td>		
 
 <td width="50%" valign="top">
	<fieldset >
		<legend >'. _('resumen por forma de pago').'</legend>
			<table border="0" width="100%" align="CENTER"> 
			<tr>
			  <td class="fuenteN" width="50%">
				'. _('forma pago').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="50%">
				'. _('cantidad').'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="50%">
				'. _('total').'
			  </td>
			  

			 </tr>
			 ';
			 
			
			 $dato=lectura($acceso,"SELECT *FROM tipo_pago where status_pago='ACTIVO'");
			$suma_c=0;
			$suma_can=0;
			 
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago where  fecha_pago='$fecha' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'");
				$suma=0;
				if($row=row($acceso))
				{
					$monto_tp=trim($row["monto_tp"])+0;
					$cant=trim($row["cant"])+0;
					$suma_c+=$monto_tp;
					$suma_can+=$cant;

					//if($total>0){
					
					echo '<tr><td class="fuente">
							'.trim($dato[$k]["tipo_pago"]).'
						  </td>		
						  <td class="fuente" ALIGN="center" >
							'.$cant.'
						  </td>		
						  <td class="fuente" ALIGN="right">
							'.number_format($monto_tp+0, 2, ',', '.').'
						  </td>	
						  </tr>';
					//}
				}
			}
		echo '
			 <tr>
			  <td class="fuenteN"  >
				'. _('total forma de pago').'
			  </td>		
			  
			  <td class="fuenteN" ALIGN="center" >
				'.$suma_can.'
			  </td>	
			  <td class="fuenteN" ALIGN="right" >
				'.number_format($suma_c+0, 2, ',', '.').'
			  </td>	
			 </tr>
			 ';
				 $acceso->objeto->ejecutarSql("SELECT  sum(monto_reten) as monto_reten FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_reten>0  and fecha_pago='$fecha' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$monto_reten=trim($row["monto_reten"]);
				}
			 $acceso->objeto->ejecutarSql("SELECT  sum(islr) as islr FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and islr>0  and fecha_pago='$fecha' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$islr=trim($row["islr"]);
				}
			 
			 ECHO '
			 
			 <tr>
			  
			  <td class="fuente" ALIGN="right" width="80px" colspan="5">
				ret. IVA  '.number_format($monto_reten+0, 2, ',', '.').' 
				+ ret. ISLR '.number_format($islr+0, 2, ',', '.').' 
				+ total '.number_format($islr+0, 2, ',', '.').' 
				= '.number_format($monto_reten+$islr+$suma_c+0, 2, ',', '.').'
			  </td>	
			 </tr>
			 
			</table>		
	</fieldset>
  </td>		
 </tr>
 
 
 <tr>
	<td width="50%" valign="top">
	<fieldset>
		<legend >'. _('resumen por servicios').'</legend>
			<table border="0" width="95%" align="left"> 
			<tr>
			  <td class="fuenteN" width="30%">
				'. _('servicio').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="10%">
				'. _('cant').'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="20%">
				'. _('costo').'
			  </td>
			  <td class="fuenteN" ALIGN="right" width="20%">
				'. _('desc').'
			  </td>
			  <td class="fuenteN" ALIGN="right" width="20%">
				'. _('total').'
			  </td>
			 </tr>
			 ';
			 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where    fecha_pago='$fecha' and id_serv='$id_serv'  and tipo_caja='PRINCIPAL' and status_pago='PAGADO'");
				
				$cont=0;
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$costo_cobro=trim($row["costo_cobro"]);
					$descu=trim($row["descu"]);
					$total=$costo_cobro-$descu;
					$suma_c+=$costo_cobro;
					$suma_d+=$descu;
					$suma_can+=$cant;
				
				
					if($total>0){
						echo '<tr><td class="fuente">
							'.strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"]))).'
						  </td>
						  <td class="fuente" ALIGN="center">
							'.$cant.'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($costo_cobro+0, 2, ',', '.').'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($descu+0, 2, ',', '.').'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($total+0, 2, ',', '.').'
						  </td>	
						  </tr>';
					
					
					}
				}
			}
			$total=$suma_c-$suma_d;
		echo '
			<tr>
			  <td class="fuenteN" width="200px" >
				'. _('total servicios').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="50px">
				'.$suma_can.'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($suma_c+0, 2, ',', '.').'
			  </td>		
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($suma_d+0, 2, ',', '.').'
			  </td>		
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($total+0, 2, ',', '.').'
			  </td>	
			 </tr>
			 ';
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0  and fecha_pago='$fecha' and status_pago='PAGADO' ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			 
			 ECHO '
			 
			 <tr>
			  
			  <td class="fuente" ALIGN="right" width="80px" colspan="5">
				IVA  '.number_format($monto_iva+0, 2, ',', '.').'  + total 
				'.number_format($total+0, 2, ',', '.').' = 
				'.number_format($monto_iva+$total+0, 2, ',', '.').'
			  </td>	
			 </tr>
			 
		</table>
	</fieldset>
  </td>		
 
 
  <td width50%" valign="top">
	<fieldset >
		<legend >'. _('resumen de retenciones').'</legend>
			<table border="0" width="95%" align="left"> 
			 <tr>
			  <td class="fuenteN" width="50%">
				'. _('descripcion').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="25%">
				'. _('cant').'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="25%">
				'. _('total').'
			  </td>
			 </tr>
			 ';
		
		
		
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_reten) as monto_reten FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_reten>0  and fecha_pago='$fecha' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto_reten=trim($row["monto_reten"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('RETENCION IVA (75%)').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">-
				'.number_format($monto_reten+0, 2, ',', '.').'
			  </td>
			 </tr>';
		
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(islr) as islr FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and islr>0  and fecha_pago='$fecha' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$islr=trim($row["islr"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('RETENCION ISLR (2%)').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">-
				'.number_format($islr+0, 2, ',', '.').'
			  </td>
			 </tr>
			 <tr>
			  <td class="fuente" width="50%">
				'. _('TOTAL facturado').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">
				'.number_format($total_facturado+0, 2, ',', '.').'
			  </td>
			 </tr>
			 ';
		
		
		
			$total_general=$total_facturado - $monto_reten - $islr;
		echo '
			<tr>
			  <td class="fuenteN" width="50%">
				'. _('TOTAL INGRESO').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="25%">
				
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="25%">
				'.number_format($total_general+0, 2, ',', '.').'
			  </td>
			 </tr>';
			
		echo '	 
		</table>
	</fieldset>
  </td>		
 </tr>
 
 <tr>
   <td width50%" valign="top">
	<fieldset >
		<legend >'. _('resumen cargos cobrados por meses').'</legend>
			<table border="0" width="95%" align="left"> 
			<tr>
			  <td class="fuenteN" width="30%">
				'. _('mes').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="10%">
				'. _('cant').'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="20%">
				'. _('costo').'
			  </td>
			  <td class="fuenteN" ALIGN="right" width="20%">
				'. _('desc').'
			  </td>
			  <td class="fuenteN" ALIGN="right" width="20%">
				'. _('total').'
			  </td>
			 </tr>
			 ';
			// echo "SELECT distinct fecha_inst  FROM vista_pago_ser where  fecha_pago='$fecha'  and status_pago='PAGADO'";
			 $dato=lectura($acceso,"SELECT distinct fecha_inst  FROM vista_pago_ser where  fecha_pago='$fecha'  and status_pago='PAGADO' order by fecha_inst");
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$fecha_inst=trim($dato[$k]["fecha_inst"]);
				list($ano,$mes,$dia)=explode("-",$fecha_inst);
				$mes_l = formato_mes_com1($mes)." $ano";
				//echo "SELECT count(*) as cant,sum(cant_serv*costo_cobro*cambio_d*1.12) as total FROM vista_pago_ser where  fecha_pago='$fecha' and status_pago='PAGADO' and fecha_inst='$fecha_inst' ";
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where  fecha_pago='$fecha' and status_pago='PAGADO' and fecha_inst='$fecha_inst' ");
				$suma=0;
				$cont=0;
				if($row=row($acceso))
				{
					$cant=trim($row["cant"]);
					$costo_cobro=trim($row["costo_cobro"]);
					$descu=trim($row["descu"]);
					$total=$costo_cobro-$descu;
					$suma_c+=$costo_cobro;
					$suma_d+=$descu;
					$suma_can+=$cant;
				
				
					if($total>0){
						echo '<tr><td class="fuente">
							'.strtoupper($mes_l).'
						  </td>
						  <td class="fuente" ALIGN="center">
							'.$cant.'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($costo_cobro+0, 2, ',', '.').'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($descu+0, 2, ',', '.').'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($total+0, 2, ',', '.').'
						  </td>	
						  </tr>';
					
					
					}
					
				}
				
			}
			$total=$suma_c-$suma_d;
		echo '
			<tr>
			  <td class="fuenteN" width="200px" >
				'. _('total servicios').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="50px">
				'.$suma_can.'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($suma_c+0, 2, ',', '.').'
			  </td>		
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($suma_d+0, 2, ',', '.').'
			  </td>		
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($total+0, 2, ',', '.').'
			  </td>	
			 </tr>
			 ';
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0  and fecha_pago='$fecha' and status_pago='PAGADO' ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			 
			 ECHO '
			 
			 <tr>
			  
			  <td class="fuente" ALIGN="right" width="80px" colspan="5">
				IVA  '.number_format($monto_iva+0, 2, ',', '.').'  + total 
				'.number_format($total+0, 2, ',', '.').' = 
				'.number_format($monto_iva+$total+0, 2, ',', '.').'
			  </td>	
			 </tr>
		</table>
	</fieldset>
  </td>		
  <td width="30px">
	&nbsp;&nbsp;&nbsp;
  </td>		
 
 </tr>
 
 
</table>


';




////////////////////////////////////////////////////////////////////////////
  ?>
  
  
  
	<br>
	<fieldset >
		<legend ><?php echo _("detalles de puntos de cobros");?></legend>
			<div id="datagrid" class="data">
<?php
require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("id_caja_cob,nombre_caja,apellido,monto_acum,nombre,fecha_caja,apertura_caja,cierre_caja","vista_caja","","fecha_caja='$fecha' and status_caja_cob='CERRADA'  and tipo_caja='PRINCIPAL'  $consult");
$x->hideColumn('id_caja_cob');
$x->hideColumn('apellido');
$x->setColumnHeader("nombre_caja", _("punto de cobro"));
$x->setColumnHeader("monto_acum", _("monto"));
$x->setColumnHeader("nombre", _("cobrador"));
$x->setColumnHeader("fecha_caja", _("fecha"));
$x->setColumnHeader("apertura_caja", _("hora apertura"));
$x->setColumnHeader("cierre_caja", _("hora cierre"));

$x->setColumnType('fecha_caja', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->setClase("CierreDiario");
$x->addRowSelect("GuardarRep_detcob('%id_caja_cob%')");
$x->hideOrder();
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

$x->printTable();				

//echo '<br><div align="center"><input  type="button" name="imprimir" value="IMPRIMIR PUNTOS DE COBROS" onclick="ImprimirRep_CierreDiario()">&nbsp;</div>';
?>
				</div>			
	</fieldset>
  </td>		
 </tr>
</table>
</form>
<?php 

}
?>

<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>