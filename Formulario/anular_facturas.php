<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PAGOS')))
{

$fecha= date("Y-m-d");
$id_persona=$_SESSION["id_persona"];
  /*
	$ip_est = $_SERVER['REMOTE_ADDR'];
	$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
	if($row=row($acceso)){
		$id_est=trim($row['id_est']);
		$nombre_est=trim($row['nombre_est']);
	}
	*/
//echo "select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha'  and id_est='$id_est' and status_caja_cob='Abierta'";
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha'  and status_caja_cob='Abierta'");

if($acceso->objeto->registros<=0)
	echo '<div class="error"><br>Error, No tiene un punto de Cobro Abierto, debe abrir un punto de cobro.<br> o abrio punto de cobro desde otra estacion de trabajo</div>';
else{
	
	$row=row($acceso);
	$id_caja=trim($row['id_caja']);
	$nombre_est=trim($row['nombre_est']);
	$id_est=trim($row['id_est']);
	$id_caja_cob=trim($row['id_caja_cob']);
	$tipo_caja=trim($row['tipo_caja']);
	$caja_externa=trim($row['caja_externa']);
	$fecha_sugerida=date("d/m/Y", strtotime(trim($row['fecha_sugerida'])));
	$nombre_caja_cob=trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"])." => E.T. ".$nombre_est;
	
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	

	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and pagos.id_caja_cob='$id_caja_cob' ORDER BY inc desc LIMIT 1 offset 0 "); 
	$nro_factura = verCodFact($acceso,"nro_factura");


	$acceso->objeto->ejecutarSql("select nro_factura from pagos where nro_factura='$nro_factura'"); 
	if($acceso->objeto->registros>0){
		$nro_factura = '';
	}
	
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='3'"); 
	if($row=row($acceso)){
		$valor_param_v=trim($row['valor_param']);
	}
	
	$bgcolor=array("EXTERNA"=>"CFD2D6","OFICINA"=>"F5F9FE");
//	echo ":$caja_externa:";
//	echo $bgcolor[$caja_externa];
?>
<div class="cabe"><?php echo _("anular facturas en lotes");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER">
<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
		
		<input  type="hidden" name="caja_externa" maxlength="10" size="15" value="<?php echo $caja_externa; ?>">
		
	<input readonly type="hidden" name="base" maxlength="10" size="5" value="0" >
	<input readonly type="hidden" name="iva" maxlength="10" size="5" value="0" >
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos del cliente");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4" bgcolor="#<?php echo $bgcolor[$caja_externa];?>"> 
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("punto de cobro");?></span>
			</td>
			<td colspan="3">
				<select disabled name="id_caja_cob" id="id_caja_cob" onchange="validarcaja_cobrador()" style="width: 500px;">
					<?php echo '<option value="'.$id_caja_cob.'">'.$nombre_caja_cob.'</option>';?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha de factura");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="fecha_factura" id="fecha_factura" maxlength="10" size="20" value="<?php echo $fecha_sugerida;?>" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("fecha actual");?></span>
			</td>
			<td>
				<input disabled  type="text" name="fecha_pago" id="fecha_pago" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			
			<td>
				<span class="fuente"><?php echo _("sERIE");?>
				</span>
			</td>
			<td>
				<input type="text" name="serie" id="serie" maxlength="10" size="10" value="" >
			</td>
		
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("factura desde");?>
				</span>
			</td>
			<td>
				<input type="text" name="desde" id="desde" maxlength="10" size="20" value="" onchange="contar_fact()" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hasta");?>
				</span>
			</td>
			<td>
				<input type="text" name="hasta" id="hasta" maxlength="10" size="20" value="" onchange="contar_fact()"  >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("cantidad");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="cantidad" id="cantidad" maxlength="10" size="10" value="" >
			</td>
		
		</tr>
					
			<input  type="hidden" name="id_pago" maxlength="15" size="20"onChange="validarpagos()" value="<?php echo $id_pago;?>">
		</table>
	</fieldset>
  </td>		
 </tr>
 
 
 <tr>
			<td colspan="2" rowspan="1">
				
				<div align="center">
					<input type="button" name="registrar1" value="<?php echo _("anular facturas");?>" onclick="anular_factura()">&nbsp;
					
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','anular_facturas')" value="<?php echo _("limpiar");?>">
					<input  type="hidden" name="registrar">
					<input  type="hidden" name="modificar">
				</div>
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