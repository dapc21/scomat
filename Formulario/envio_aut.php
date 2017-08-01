<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  ?>

<BR><div class="cabe"><?php echo _("editar datos de envio automatico");?></div>
<form name="f1" >
<table border="0" width="500px" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos del envio");?></legend>
		
		<table border="0" width="500px" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_envio" maxlength="8" size="30"onChange="validarenvio_aut()" value="<?php $acceso->objeto->ejecutarSql("select *from envio_aut  where (id_envio ILIKE '$ini_u%') ORDER BY id_envio desc"); echo $ini_u.verCo($acceso,"id_envio")?>">
		<input  type="hidden" value="" name="id_franq">
		<input  type="hidden" value="" name="tipo_envio">
		<input  type="hidden" value="" name="envio_sms">
		<input  type="hidden" value="" name="envio_email">
		<input  type="hidden" value="" name="tipo_variable">
		<tr>
			<td>
				<span class="fuente"><?php echo _("nombre");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="nombre_envio" maxlength="50" style="width: 400px;" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("mensaje a enviar");?>
				</span>
			</td>
			<td>
				<textarea class="fuenteNormal" name="descripcion_envio" style="width: 400px;" rows="4" onKeyUp="cuenta_carac()"></textarea>
				<span class="fuente_sms">Caracteres: </span><label id="cant_car">15</label> / <label id="cant_sms">1</label></span>
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		
		</table>
		</fieldset>
		
	</td>
</tr>
		
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="hidden" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','envio_aut')">&nbsp;
					<input  type="button" name="modificar" value="<?php echo _("guardar");?>" onclick="verificar('modificar','envio_aut')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','envio_aut')">&nbsp;
					<input  type="hidden" name="agregar" value="<?php echo _("cargar ordenes");?>" onclick="verificar('cargar','envio_aut')">&nbsp;
					<input  type="hidden" name="Resetear" value="<?php echo _("cancelar");?>">
				</div>
			</td>
		</tr>
		
 <tr>
  <td>
	
	
			<div id="datagrid">
		<?php
		
		?>
		
		</div>
		
		
		
	</td>
</tr>
		
	</table>
</form>