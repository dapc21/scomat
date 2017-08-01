<?php require_once "procesos.php"; ?>
<BR><div class="cabe"><?php echo _("Agregar Eventos a Productos");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td>
				<span class="fuente">productId
				</span>
			</td>
			<td>
				<select  name="productId" id="-1" onchange="" style="width: 176px;">
					<?php echo verproduct($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">eventId
				</span>
			</td>
			<td>
				<select  name="eventId" id="-1" onchange="" style="width: 176px;">
					<?php echo verevent($acceso);?>
				</select>				
			</td>
		</tr>
	</table>
	</fieldset>
  </td>		
 </tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_cas('incluir','ProductEvent')">&nbsp;
					<input  type="hidden" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','ProductEvent')">&nbsp;
					<input  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','ProductEvent')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','ProductEvent')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
		<tr>			
			<td colspan="2">				
				<div id="datagrid" class="data">
				</div>			
			</td>		
		</tr>
	</table>
</form>