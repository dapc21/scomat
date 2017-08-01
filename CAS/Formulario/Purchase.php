<?php require_once "procesos.php"; ?>

<BR><div class="cabe"><?php echo _("Administracion de Purchase");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<input  type="hidden" name="idPurchase" maxlength="8" size="30"onChange="validarPurchase()" value="<?php $acceso->objeto->ejecutarSql("select *from purchase ORDER BY idpurchase desc"); echo "COD".verCo($acceso,"idpurchase")?>">
		<tr>
			<td>
				<span class="fuente">operationType
				</span>
			</td>
			<td>
				<select name="statusId" id="-1" onchange="" style="width: 176px;">
					<option value="0">Purchase</option>
					<option value="1">Cancellation</option>
					<option value="2">Immediate subscription deactivation</option>
				</select>
			</td>
			<td>
				<span class="fuente">SMCid
				</span>
			</td>
			<td>
				<input  type="text" name="SMCid" maxlength="12" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Tipo de Compra
				</span>
			</td>
			<td>
				<span class="fuente">
					<input  type="radio" name="tipoCanal" onchange="habilita_tipo_purchase()" value="SUBSCRIPTION" CHECKED><?php echo _("SUBSCRIPTION");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="tipoCanal" onchange="habilita_tipo_purchase()" value="PRODUCT"><?php echo _("PRODUCT");?>
				</span>
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<span class="fuente">subscriptionId
				</span>
			</td>
			<td>
				<select name="subscriptionId" id="-1" onchange="" style="width: 176px;">
					<?php echo versubscription($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente">productId
				</span>
			</td>
			<td>
				<select disabled name="productId" id="-1" onchange="" style="width: 176px;">
					<?php echo verproduct($acceso);?>
				</select>
			</td>
		</tr>
		
			<input  type="hidden" name="statusDate" id="statusDate" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
		
		
	</table>
	</fieldset>
  </td>		
 </tr>
<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="comprar" onclick="verificar_cas('incluir','Purchase')">&nbsp;
					<input  type="button" name="modificar" value="actualizar Operacion" onclick="verificar_cas('modificar','Purchase')">&nbsp;
					<input  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','Purchase')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','Purchase')" value="<?php echo _("limpiar");?>">
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