<?php session_start();require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
$login= $_SESSION["login"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PAGOSFRANQUICIA')))
{
?>
<BR><div class="cabe"><?php echo _("Registro de pagos de franquicias");?></div>
<form name="f1" action="javascript:;">
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<input  type="hidden" name="id_dbf" maxlength="8" size="30"onChange="validardetalle_tipopago_df()" value="<?php $acceso->objeto->ejecutarSql("select *from detalle_tipopago_df   where (id_dbf ILIKE '$ini_u%') ORDER BY id_dbf desc"); echo $ini_u.verCoo($acceso,"id_dbf")?>">
		
		<tr>
			<td>
				<span class="fuente">pagos pendientes
				</span>
			</td>
			<td>
				<select name="id_df_tp" id="id_df_tp" onchange="" style="width: 200px;">
					<?php echo ver_pagos_pendientes($acceso);?>
				</select>
				<input  type="button" name="registrdfar" value="CARGAR TODOS" onclick="cargar_todos_pagos_pend()">&nbsp;
			</td>
			<td>
				<span class="fuente">tipo de pago
				</span>
			</td>
			<td>
				<select name="id_tipo_pago" id="id_tipo_pago" onchange=""  style="width: 200px;">
					<?php echo verTipoPago_df($acceso,'PAGOS');?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">cuenta bancaria
				</span>
			</td>
			<td>
				<select name="id_cuba" id="id_cuba" onchange="" style="width: 200px;">
					<?php echo vercuenta_bancaria($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente">fecha pago
				</span>
			</td>
			<td>
				<input  type="text" name="fecha_dbf" id="fecha_dbf" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">referencia
				</span>
			</td>
			<td>
				<input  type="text" name="refer_dbf" maxlength="25" size="30" value="" >
			</td>
			<td>
				<span class="fuente">monto
				</span>
			</td>
			<td>
				<input  type="text" name="monto_dbf" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">observacion
				</span>
			</td>
			<td colspan="3">
				<textarea name="obser_dbf" cols="100" rows="2"></textarea>
			</td>
		</tr>
				<input  type="hidden" name="status_dbf" maxlength="20" size="30" value="REGISTRADO" >
		
				<input  type="hidden" name="hora_dbf" maxlength="8" size="30" value="<?php echo date("H:i:s");?>" >
			
				<input  type="hidden" name="login_dbf" maxlength="25" size="30" value="<?php echo $login;?>" >
			
		<input  type="hidden" value="dato" name="dato">
		
		
		
		
		
		</table>
		</fieldset>
</td>		
 </tr>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="REGISTRAR" onclick="verificar('incluir','detalle_tipopago_df')">&nbsp;
					<input  type="<?php echo $obj->mo; ?>" name="modificar" value="MODIFICAR" onclick="verificar('modificar','detalle_tipopago_df')">&nbsp;
					<input  type="<?php echo $obj->el; ?>" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','detalle_tipopago_df')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','detalle_tipopago_df')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
		
 <tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("detalle_tipopago_dfes agregadas");?></legend>
			<div id="datagrid" class="data">
		
		
			</div>			
	</fieldset>
  </td>		
 </tr>
</table>

</form>

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

