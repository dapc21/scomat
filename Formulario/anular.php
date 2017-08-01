<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	$consult=" and id_franq='$id_f'";
	//echo $consult;
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CAJA_COBRADOR')))
{
	$ip_est = $_SERVER['REMOTE_ADDR'];
	$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
	if(!$row=row($acceso)){
		echo '<div class="error"><br>Error, la estacion de trabajo no esta asociada a una impresora fiscal</div>';
	}else{
		$estacion=opcion(trim($row["id_est"]),trim($row["nombre_est"]));
		
	$fecha= date("Y-m-d");
	$id_persona=$_SESSION["id_persona"];
	$acceso->objeto->ejecutarSql("select * from cirre_diario where fecha_cierre='$fecha' $consult");
	if($acceso->objeto->registros>0)
		echo '<div class="error"><br>Error, ya se realizo el cierre diario, no se puede abrir puntos de cobros hoy.</div>';
	else{
		$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta' $consult");
		if($acceso->objeto->registros>0){
			echo '<div class="error"><br>Error, ya tiene un punto de Cobro Abierto, debe cerrarlo para poder abrir otro</div>';
		
		$row=row($acceso);
	$id_caja_cob=trim($row['id_caja_cob']);	
	$fecha_sugerida=date("d/m/Y", strtotime(trim($row['fecha_sugerida'])));
?>
<BR><div class="cabe"><?php echo _("cambiar fecha sugerida");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<input  type="hidden" name="id_caja_cob" maxlength="10" size="30"onChange="validarcaja_cobrador()" value="<?php echo $id_caja_cob; ?>">
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha del pago");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="fecha_sugerida" id="fecha_sugerida" maxlength="10" size="10" value="<?php echo $fecha_sugerida;?>" >
			</td>
		
		</tr>
		</table>
	</fieldset>
  </td>		
 </tr>
		<input  type="hidden" name="cierre_caja" maxlength="8" size="30" value="" >
		<input  type="hidden" name="monto_acum" maxlength="10" size="30" value="" >
		<input  type="hidden" name="status_caja" maxlength="15" size="30" value="Abierta" >
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td >
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("cambiar FEcha");?>" onclick="verificar('cambiarfecha','cambiar_fecha_caja_cobrador')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','caja_cobrador')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','caja_cobrador')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','caja_cobrador')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>

</table>
</form>

<?php 
		
		}else{
		
		
?>
<BR><div class="cabe"><?php echo _("abrir punto de cobros");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<input  type="hidden" name="id_caja_cob" maxlength="10" size="30"onChange="validarcaja_cobrador()" value="<?php $acceso->objeto->ejecutarSql("select *from caja_cobrador  where (id_caja_cob ILIKE '$ini_u%') ORDER BY id_caja_cob desc"); echo $ini_u.verCodLong($acceso,"id_caja_cob")?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("caja");?></span>
			</td>
			<td>
				<select name="id_caja" id="id_caja" onchange="" style="width: 150px;">
					<?php echo verCajaActiva($acceso);?>
				</select>
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("cobrador");?></span>
			</td>
			<td>
				<select disabled name="id_persona" id="-1" onchange="" style="width: 150px;">
					<?php echo vercobradores($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("estacion de trabajo");?></span>
			</td>
			<td>
				<select disabled name="id_est" id="id_est" onchange="" style="width: 150px;">
					<?php echo $estacion?>
				</select>
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="fecha_caja" id="fecha_caja" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("hora de apertura");?></span>
			</td>
			<td>
				<input disabled type="text" name="apertura_caja" maxlength="8" size="10" value="<?php echo date("H:i:s");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha del pago");?>
				</span>
			</td>
			<td>
				<input type="text" name="fecha_sugerida" id="fecha_sugerida" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
			</td>
		
		</tr>
		</table>
	</fieldset>
  </td>		
 </tr>
		<input  type="hidden" name="cierre_caja" maxlength="8" size="30" value="" >
		<input  type="hidden" name="monto_acum" maxlength="10" size="30" value="" >
		<input  type="hidden" name="status_caja" maxlength="15" size="30" value="Abierta" >
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td >
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("abrir punto");?>" onclick="verificar('aperturar','abrir_caja_cobrador')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','caja_cobrador')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','caja_cobrador')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','caja_cobrador')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>

</table>
</form>

<?php 
}//caja cobrador
}//cierre
}//if estacion

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