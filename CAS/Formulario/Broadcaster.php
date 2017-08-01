<?php require_once "procesos.php"; ?>

<BR><div class="cabe"><?php echo _("Administracion de Broadcaster");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td>
				<span class="fuente">broadcasterId</span>
			</td>
			<td>
				<input  type="text" name="broadcasterId" maxlength="8" size="30"onChange="validarBroadcaster()" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">broadcasterDs
				</span>
			</td>
			<td>
				<input  type="text" name="broadcasterDs" maxlength="100" size="60" value="" >
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
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_cas('incluir','Broadcaster')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','Broadcaster')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','Broadcaster')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','Broadcaster')" value="<?php echo _("limpiar");?>">
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