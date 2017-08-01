<?php require_once "procesos.php"; ?>
<BR><div class="cabe"><?php echo _("SubscriptionChannel");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td>
				<span class="fuente">subscription
				</span>
			</td>
			<td>
				<select name="subscriptionId" id="-1"  style="width: 176px;" onchange="listarCanalSusc()">
					<?php echo versubscription($acceso);?>
				</select>
				
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">channel
				</span>
			</td>
			<td>
				<select name="channelId" id="-1" onchange="" style="width: 176px;">
					<?php echo verchannel($acceso);?>
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
					<input  type="button" name="registrar" value="createSubscriptionChannel" onclick="verificar_cas('incluir','SubscriptionChannel')">&nbsp;
					<input  type="hidden" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','SubscriptionChannel')">&nbsp;
					<input  type="button" name="eliminar" value="deleteSubscriptionChannel" onclick="verificar_cas('eliminar','SubscriptionChannel')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','SubscriptionChannel')" value="<?php echo _("limpiar");?>">
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