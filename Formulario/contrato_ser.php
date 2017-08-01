<<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('contrato_ser')))
{
?>
<BR><div class="cabe"><?php echo _("parametros de licencia");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos de la empresa");?></legend>
	  <table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<input  type="hidden" name="id_seg" maxlength="100" size="50"onChange="validarcontrato_ser()" value="c4ca4238a0b923820dcc509a6f75849b">
		<input  type="HIDDEN" name="firma_seg" maxlength="100" size="50" value="" >
		<tr>
			<td>
				<span class="fuente"><?php echo _("empresa");?>
				</span>
			</td>
			<td>
				<input  type="text" name="empresa_aut" maxlength="100" size="50" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("rif");?>
				</span>
			</td>
			<td>
				<input  type="text" name="version_sis" maxlength="100" size="20" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("direccion");?>
				</span>
			</td>
			<td colspan="3">
				<input  type="text" name="acerca_de" maxlength="100" size="110" value="" >
			</td>
		</tr>
		
		<input  type="hidden" name="campo_seg1" maxlength="100" size="50" value="" >
		<input  type="hidden" name="campo_seg2" maxlength="100" size="50" value="" >
		<input  type="hidden" name="campo_seg3" maxlength="100" size="50" value="" >
		<input  type="hidden" name="campo_seg4" maxlength="100" size="50" value="" >
		<input  type="hidden" name="campo_seg5" maxlength="100" size="50" value="" >
		<input  type="hidden" name="campo_seg6" maxlength="100" size="50" value="" >
		<input  type="hidden" name="campo_seg7" maxlength="100" size="50" value="" >
		
		<input  type="hidden" value="dato" name="dato">

</table>
	</fieldset>
  </td>		
 </tr>
 
 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos de licencia");?></legend>
	  <table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td>
				<span class="fuente"><?php echo _("Paquete");?>
				</span>
			</td>
			<td colspan="3">
				<select name="licencia_seg" id="-1" onchange="" style="width: 400px;">
					<option value="0"><?php echo _("seleccione....");?></option>
					<option value="2000"><?php echo _("saeco 2.000");?></option>
					<option value="5000"><?php echo _("saeco 5.000");?></option>
					<option value="10000"><?php echo _("saeco 10.000");?></option>
					<option value="100000"><?php echo _("saeco limitado");?></option>
					<option value=""></option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha registro");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="fecha_lic" id="fecha_lic" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hora registro");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="hora_lic" maxlength="100" size="15" value="<?php echo date("H:i:s");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("clave de instalacion");?>
				</span>
			</td>
			<td colspan="3">
				<input  type="text" name="llave_enc" maxlength="100"  style="width: 400px;" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("clave de sistema");?>
				</span>
			</td>
			<td colspan="3">
				<input Disabled type="text" name="llave_dec" maxlength="100"  style="width: 400px;" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("clave de licencia");?>
				</span>
			</td>
			<td colspan="3">
				<input Disabled type="text" name="limite_reg" maxlength="100"  style="width: 400px;" value="" >
			</td>
		</tr>
				<tr>
			<td>
				<span class="fuente"><?php echo _("status");?>
				</span>
			</td>
			<td colspan="3">
				<input disabled type="text" name="status_seg" maxlength="100"  style="width: 400px;"  value="NO REGISTRADO" >
			</td>
		</tr>
</table>
	</fieldset>
  </td>		
 </tr>
 
	  
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="<?php echo _("general clave del sistema");?>" onclick="verificar('generarclave','contrato_ser')">&nbsp;
					<input  type="button" name="modificar" value="<?php echo _("registrar sistema");?>" onclick="verificar('modificar','contrato_ser')">&nbsp;
					<input  type="HIDDEN" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','contrato_ser')">&nbsp;
					<input  type="HIDDEN" name="salir" onclick="conexionPHP('formulario.php','contrato_ser')" value="<?php echo _("limpiar");?>">
				</div>
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