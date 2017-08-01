<?php require_once "procesos.php"; ?>

<BR><div class="cabe"><?php echo _("decreaseIPPVbalance Smartcard");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td>
				<span class="fuente">SMCid
				</span>
			</td>
			<td>
				<input  type="text" name="SMCid" maxlength="12" size="30"onChange="" value="">
			</td>
		</tr>
		
		<tr>
			<td>
				<span class="fuente">amount
				</span>
			</td>
			<td>
				<input  type="text" value="" maxlength="12" size="30" name="nmIPPVbalance">
			</td>
		</tr>
		
		
	</table>
	</fieldset>
  </td>		
 </tr>
<input  type="hidden" value="" name="statusId">
<input  type="hidden" value="dato" name="dato">

<input  type="hidden" name="statusDate" id="statusDate" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
<input  type="hidden" value="" name="broadcasterId">
<input  type="hidden" value="" name="total">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="decreaseIPPVbalance" onclick="verificar_cas('decreaseIPPVbalance','decreaseIPPVbalance')">&nbsp;
					<input  type="hidden" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','Smartcard')">&nbsp;
					<input  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','Smartcard')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','decreaseIPPVbalance')" value="<?php echo _("limpiar");?>">
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