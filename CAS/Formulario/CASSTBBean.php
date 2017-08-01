<?php require_once "procesos.php"; ?>

<BR><div class="cabe"><?php echo _("Administracion de CASSTBBean");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td>
				<span class="fuente">stbTypeId
				</span>
			</td>
			<td>
				<input  type="text" name="stbTypeId" maxlength="4" size="30"onChange="validarCASSTBBean()" value="">
			</td>
			<td>
				<span class="fuente">stbManufacturerId
				</span>
			</td>
			<td>
				<input  type="text" name="stbManufacturerId" maxlength="4" size="30" value="" >
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
				<span class="fuente">serialNumber
				</span>
			</td>
			<td>
				<input  type="text" name="serialNumber" maxlength="100" size="30" value="" >
			</td>
			<td>
				<span class="fuente">barcode
				</span>
			</td>
			<td>
				<input  type="text" name="barcode" maxlength="255" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">inMaster
				</span>
			</td>
			<td>
				<select name="inMaster" id="-1" onchange="" style="width: 176px;">
					<option value="0">Master</option>
					<option value="1">Slave</option>
				</select>
			</td>
			<td>
				<span class="fuente">stbMasterTypeId
				</span>
			</td>
			<td>
				<input  type="text" name="stbMasterTypeId" maxlength="4" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">stbMasterManufacturerId
				</span>
			</td>
			<td>
				<input  type="text" name="stbMasterManufacturerId" maxlength="4" size="30" value="" >
			</td>
			<td>
				<span class="fuente">serialNumberMaster
				</span>
			</td>
			<td>
				<input  type="text" name="serialNumberMaster" maxlength="255" size="30" value="" >
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
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_cas('incluir','CASSTBBean')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','CASSTBBean')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','CASSTBBean')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','CASSTBBean')" value="<?php echo _("limpiar");?>">
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