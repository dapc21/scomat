<?php require_once "procesos.php"; ?>

<BR><div class="cabe"><?php echo _("Administracion de Event");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td>
				<span class="fuente">eventId
				</span>
			</td>
			<td>
				<input  type="text" name="eventId" maxlength="8" size="30"onChange="validarEvent()" value="">
			</td>
			<td>
				<span class="fuente">title
				</span>
			</td>
			<td>
				<input  type="text" name="title" maxlength="100" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">broadcastBegin
				</span>
			</td>
			<td>
				<input  type="text" name="broadcastBegin" id="broadcastBegin" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente">broadcastEnd
				</span>
			</td>
			<td>
				<input  type="text" name="broadcastEnd" id="broadcastEnd" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">channelId</span>
			</td>
			<td>
				<select name="channelId" id="-1" onchange="" style="width: 176px;">
						<?php echo verchannel($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente">productId
				</span>
			</td>
			<td>
				<select name="productId" id="-1" onchange="" style="width: 176px;">
					<?php echo verproduct($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">genreId
				</span>
			</td>
			<td>
				<input  type="text" name="genreId" maxlength="4" size="30" value="" >
			</td>
			<td>
				<span class="fuente">subgenreId
				</span>
			</td>
			<td>
				<input  type="text" name="subgenreId" maxlength="4" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">parentalType
				</span>
			</td>
			<td>
				<select name="parentalType" id="-1" onchange="" style="width: 176px;">
					<option value="0">Undefined</option>
					<option value="1">For all ages</option>
					<option value="2">Not suitable for under-7s</option>
					<option value="3">Not suitable for under-13s</option>
					<option value="4">Not suitable for under-18s</option>
					<option value="5">Adult content</option>
				</select>
			</td>
			<td>
				<span class="fuente">previewType
				</span>
			</td>
			<td>
				<select name="previewType" id="-1" onchange="" style="width: 176px;">
					<option value="0">No preview</option>
					<option value="1">Preview at the beginning of event</option>
					<option value="2">Preview anytime (changing the channel)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">previewDuration
				</span>
			</td>
			<td>
				<input  type="text" name="previewDuration" maxlength="4" size="30" value="" >
			</td>
			<td>
				<span class="fuente">inScrambled</span>
			</td>
			<td>
				<select name="inScrambled" id="-1" onchange="" style="width: 176px;">
					<option value="0">No scrambled</option>
					<option value="1">Scrambled</option>
					<option value=""></option>
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
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_cas('incluir','Event')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','Event')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','Event')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','Event')" value="<?php echo _("limpiar");?>">
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