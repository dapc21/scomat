<?php require_once "procesos.php"; ?>
<BR><div class="cabe"><?php echo _("Administracion de Subscription");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td>
				<span class="fuente">subscriptionId
				</span>
			</td>
			<td>
				<input  type="text" name="subscriptionId" maxlength="8" size="30"onChange="validarSubscription()" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">subscriptionDs
				</span>
			</td>
			<td>
				<input  type="text" name="subscriptionDs" maxlength="100" size="30" value="" >
			</td>
			<td>
				<span class="fuente">channelId
				</span>
			</td>
			<td>
				<select name="channelId" id="-1" onchange="" style="width: 176px;">
					<?php echo verchannel($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">purchaseDateBegin
				</span>
			</td>
			<td>
				<input  type="text" name="purchaseDateBegin" id="purchaseDateBegin" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente">purchaseDateEnd
				</span>
			</td>
			<td>
				<input  type="text" name="purchaseDateEnd" id="purchaseDateEnd" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">price
				</span>
			</td>
			<td>
				<input  type="text" name="price" maxlength="10" size="30" value="" >
			</td>
			<td>
				<span class="fuente">ippv
				</span>
			</td>
			<td>
				<select name="ippv" id="-1" onchange="" style="width: 176px;">
					<option value="0">Non IPPV subscription</option>
					<option value="1">IPPV subscription</option>
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
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_cas('incluir','Subscription')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','Subscription')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','Subscription')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','Subscription')" value="<?php echo _("limpiar");?>">
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