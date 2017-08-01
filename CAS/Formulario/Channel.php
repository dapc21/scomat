<?php require_once "procesos.php"; ?>

<BR><div class="cabe"><?php echo _("Administracion de Channel");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td>
				<span class="fuente">channelId
				</span>
			</td>
			<td>
				<input  type="text" name="channelId" maxlength="8" size="30"onChange="validarChannel()" value="">
			</td>
			<td >
				<span class="fuente">channelDs
				</span>
			</td>
			<td>
				<input  type="text" name="channelDs" maxlength="100" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">broadcasterId
				</span>
			</td>
			<td>
				<select name="broadcasterId" id="-1" onchange="" style="width: 176px;">
					<?php echo verbroadcaster($acceso);?>
				</select>
			</td>
		
		</tr>
		<tr>
			<td>
				<span class="fuente">Tipo de Canal
				</span>
			</td>
			<td>
				<span class="fuente">
					<input  type="radio" name="tipoCanal" onchange="habilita_tipo_canal()" value="NORMAL" CHECKED><?php echo _("NORMAL");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="tipoCanal" onchange="habilita_tipo_canal()" value="AVANZADO"><?php echo _("AVANZADO");?>
				</span>
			</td>
			<td></td>
			<td></td>
		</tr>
		
		<tr>
		
			<td>
				<span class="fuente">parentalType
				</span>
			</td>
			<td>
				<select disabled name="parentalType" id="-1" onchange="" style="width: 176px;">
					<option value="0">Undefined</option>
					<option value="1">For all ages</option>
					<option value="2">Not suitable for under-7s</option>
					<option value="3">Not suitable for under-13s</option>
					<option value="4">Not suitable for under-18s</option>
					<option value="5">Adult content</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>
				<span class="fuente">inExportable
				</span>
			</td>
			<td>
				<select disabled name="inExportable" id="-1" onchange="" style="width: 176px;">
					<option value="0">No exportable</option>
					<option value="1">Exportable</option>
				</select>
			</td>
		
			<td>
				<span class="fuente">inFreeAccess
				</span>
			</td>
			<td>
				<select disabled name="inFreeAccess" id="-1" onchange="" style="width: 176px;">
					<option value="0">No Free Access</option>
					<option value="1">Free Access</option>
				</select>
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
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_cas('incluir','Channel')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','Channel')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','Channel')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','Channel')" value="<?php echo _("limpiar");?>">
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