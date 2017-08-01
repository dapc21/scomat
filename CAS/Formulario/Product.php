<?php require_once "procesos.php"; ?>

<BR><div class="cabe"><?php echo _("Administracion de Product");?></div>
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
				<input  type="text" name="productId" maxlength="30" size="30"onChange="validarProduct()" value="">
			</td>
		</tr>
		<tr>
				<td>
				<span class="fuente">productDs
				</span>
			</td>
			<td>
				<input  type="text" name="productDs" maxlength="50" size="30" value="" >
			</td>
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
				<span class="fuente">validityDateBegin
				</span>
			</td>
			<td>
				<input  type="text" name="validityDateBegin" id="validityDateBegin" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente">validityDateEnd
				</span>
			</td>
			<td>
				<input  type="text" name="validityDateEnd" id="validityDateEnd" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
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
				<input  type="text" name="subgenreId" maxlength="30" size="30" value="" >
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
				<span class="fuente">maxEvents
				</span>
			</td>
			<td>
				<input  type="text" name="maxEvents" maxlength="4" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">ippv
				</span>
			</td>
			<td>
				<select name="ippv" id="-1" onchange="" style="width: 176px;">
					<option value="0">Non IPPV product</option>
					<option value="1">IPPV product</option>
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
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_cas('incluir','Product')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','Product')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','Product')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','Product')" value="<?php echo _("limpiar");?>">
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