<?php require_once "procesos.php"; 
$ini_u = $_SESSION["ini_u"];  
$login = $_SESSION["login"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PROCESAR PAGO DEPOSITO')))
{


$fecha= date("Y-m-d");
$id_persona=$_SESSION["id_persona"];

	if(trim($_SERVER['REMOTE_HOST'])!=''){$ip_est=$_SERVER['REMOTE_HOST'];}else{$ip_est=gethostbyaddr($_SERVER['REMOTE_ADDR']);}
	$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
	if($row=row($acceso)){
		$id_est=trim($row['id_est']);
		$nombre_est=trim($row['nombre_est']);
	}
	
//echo "select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha'  and id_est='$id_est' and status_caja_cob='Abierta'";
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");

if($acceso->objeto->registros<=0)
	echo '<div class="error"><br>Error, No tiene un punto de Cobro Abierto, debe abrir un punto de cobro.<br> o abrio punto de cobro desde otra estacion de trabajo</div>';
else{
	
	$row=row($acceso);
	$id_caja=trim($row['id_caja']);
	$id_caja_cob=trim($row['id_caja_cob']);
	
	
	$tipo_caja=trim($row['tipo_caja']);
	$caja_externa=trim($row['caja_externa']);
	$fecha_sugerida=date("d/m/Y", strtotime(trim($row['fecha_sugerida'])));
	$nombre_caja_cob=trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"])." => E.T. ".$nombre_est;
	
	
	
?>
<BR><div class="cabe"><?php echo _("PROCESAR PAGOS CON  DEPOSITOS / TRANSFERENCIAS CONFIRMADOS");?></div>
<form name="f1" action="javascript:;">
<table border="0" width="97%" align="CENTER" > 

 <tr>
  <td align="right">
	
	<fieldset >
	  <legend ><?php echo _("datos del cliente");?></legend>
		<table border="0" width="95%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td>
				<span class="fuente"><?php echo _("franquicia");?></span>
			</td>
			<td>
				<select name="id_franq" id="id_franq" style="width: 146px;">
					<?php echo verFranquicia($acceso);?>
				</select>
				
			</td>
			<td>
				<span class="fuente"><?php echo _("tipo");?></span>
			</td>
			<td>
				<select name="tipo_fecha" id="tipo_fecha" style="width: 146px;">
					<option value="fecha_reg">FECHA REGISTRO</option>
					<option value="fecha_dep">FECHA DEPOSITO</option>
				</select>
				
			</td>
			<td >
				<span class="fuente"><?php echo _("desde");?></span>
			</td>
			<td>
				<input type="text" name="desde" id="desde" maxlength="10" size="10" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hasta");?></span>
			</td>
			<td>
				<input type="text" name="hasta" id="hasta" maxlength="10" size="10" value="" >
			</td>
			<td width="38%">
				<input  type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_reg_dep()">&nbsp;
				<input  type="button" name="salir" onclick="conexionPHP('formulario.php','pagodeposito_reg')" value="<?php echo _("limpiar");?>">
			</td>
				<input  type="hidden" value="dato" name="registrar">
				<input  type="hidden" value="dato" name="modificar">
				<input  type="hidden" value="dato" name="eliminar">
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("punto de cobro");?></span>
			</td>
			<td colspan="5">
				<select disabled name="id_caja_cob" id="id_caja_cob" onchange="validarcaja_cobrador()" style="width: 500px;">
					<?php echo '<option value="'.$id_caja_cob.'">'.$nombre_caja_cob.'</option>';?>
				</select>
			</td>
			<td COLSPAN="3" ALIGN="CENTER">
				
				<input  type="button" name="regi_pa" value="<?php echo _("REGISTRAR DEPOSITOS");?>" onclick="registrar_pago_depositos()">&nbsp;
			</td>
			
		</tr>
	</table>
	</fieldset>
  </td>		
 </tr>
	
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("DEPOSITOS / TRANSFERENCIAS PENDIENTES POR CONFIRMAR");?></legend>
			<div id="datagrid" class="data"></div>			
	</fieldset>
  </td>		
 </tr>
</table>

</form>

<?php 
	}//punto
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>