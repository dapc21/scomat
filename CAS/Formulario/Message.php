<?php require_once "procesos.php"; ?>

<BR><div class="cabe"><?php echo _("Administracion de Message");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requeridos");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<input  type="hidden" name="idMessage" maxlength="8" size="30"onChange="validarMessage()" value="<?php $acceso->objeto->ejecutarSql("select *from message ORDER BY idmessage desc"); echo "COD".verCo($acceso,"idmessage")?>">
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
			<td>
				<span class="fuente">para smartCard
				</span>
			</td>
			<td>
				<input  type="text" name="to" maxlength="12" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">De
				</span>
			</td>
			<td>
				<input  type="text" name="from" maxlength="50" size="30" value="" >
			</td>
			<td>
				<span class="fuente">Asunto
				</span>
			</td>
			<td>
				<input  type="text" name="subject" maxlength="50" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Mensaje
				</span>
			</td>
			<td colspan="3">
				<textarea name="text" cols="100" rows="3"></textarea>
			</td>
		</tr>
		<input  type="hidden" name="sendDate" id="sendDate" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
		
	</table>
	</fieldset>
  </td>		
 </tr>
<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="enviar" onclick="verificar_cas('incluir','Message')">&nbsp;
					<input  type="hidden" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','Message')">&nbsp;
					<input  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','Message')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','Message')" value="<?php echo _("limpiar");?>">
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