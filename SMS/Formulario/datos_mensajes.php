<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ENVIAR_SMS_LOTES')))
{


?>
<BR><div class="cabe"><?php echo _("envio de sms y email masivo");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER">
 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("por ubicacion");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("franquicia");?></span>
			</td>
			<td>
				<select name="id_franq" id="id_franq" onchange="cargarZona()" style="width: 146px;">
					<?php echo verFranquicia($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("zona");?>
				</span>
			</td>
			<td>
				<select name="id_zona" id="id_zona" onchange="cargarSector()" style="width: 150px;">
					<?php echo verZona($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
		
			<td>
				<span class="fuente"><?php echo _("sector");?>
				</span>
			</td>
			<td>
				<select name="id_sector" id="id_sector" onchange="traerZona()" style="width: 146px;">
					<?php echo verSector($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("calle");?></span>
			</td>
			<td>
				<select name="id_calle" id="id_calle"  onchange="traerSector()" style="width: 146px;">
					<?php echo verCalle($acceso);?>
				</select>
			</td>
		
		</tr>

	</table>

	</fieldset>
  </td>		
 </tr>

 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("con deuda");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		
		<tr>
			<td colspan="4">
				<input type="checkbox" name="checkgrupo" onclick="bloquea_sd()">
				<span class="fuente"><?php echo _("sin tomar en cuenta deuda");?>&nbsp;&nbsp;&nbsp;
				</span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("desde");?>
				</span>
			</td>
			<td>
			<!--<input  type="text" name="desde" value="2006-01-01"> -->
			<select name="desde" id="desde" onchange="" style="width: 140px;">
					<?php echo verMesCorte();?>
				</select>
			<td>
				<span class="fuente"><?php echo _("hasta");?>
				</span>
			</td>
			<td>
				<select name="hasta" id="hasta" onchange="" style="width: 140px;">
					<?php echo verMesCorte();?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("y deuda mayor a");?></span>
			</td>
			<td>
				<input  type="text" name="deuda" id="deuda"  maxlength="10" size="5" value="0">
			</td>
			
		</tr>
		
	</table>

	</fieldset>
  </td>		
 </tr>
 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("por status");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		
		<tr>
			<td width="150px">
				<select name="status_pago" id="status_pago"  style="width: 146px;">
					<option value=""><?php echo _("todos");?></option>
					<?php echo verStatusCont($acceso);?>
				</select>
			</td>
		</tr>
		
	</table>
	</fieldset>
  </td>		
 </tr>
 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("mensaje");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("formatos agregados");?></span>
				
				<select name="id_form" id="id_form" onchange="validarformato_sms()" style="width: 250px;">
					<?php echo verFormatos($acceso);?>
				</select>
				
				<!--
				<input  type="button" name="cargar" onclick="javascript:conexionPHP_sms()" value="CARGAR FORMATO">
				-->
				<textarea name="sms"  style="width: 100%;" rows="3"  onKeyUp="cuenta_carac_com_m()">
<?php
$acceso->objeto->ejecutarSql("select *from formato_sms where status='ACTIVO'");
					$row=row($acceso);
					echo trim($row["formato"]);
				?>
				</textarea>
				<span class="fuente_sms">Caracteres: </span><label id="cant_car_m">0</label> / <label id="cant_sms_m">1</label></span>
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
					<input type="<?php echo $obj->in;?>" name="LISTAR" value="<?php echo _("listar clientes");?>" onclick="buscarDatos_sms_listado()">&nbsp;
					<input disabled type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("enviar mensaje");?>" onclick="buscarDatos_sms()">&nbsp;
					<input disabled type="hidden" name="modificar" value="<?php echo _("actualizar archivo");?>" onclick="act_datos_sms()">&nbsp;

					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_sms('eliminar','status_contrato')">&nbsp;
					<input  type="button" name="Resetear" onclick="javascript:conexionPHP('formulario.php','datos_mensajes')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
<tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("listado de clientes a enviar mensajes");?></legend>
			<div id="datagrid" class="data"></div>			
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
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>