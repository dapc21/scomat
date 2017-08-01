<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  ?>
<br>
<H3 align="center">
	<strong><?php echo _("administracion de grupo tecnico");?>
	</strong>
</H3>
<form name="f1" >
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente"><?php echo _("id gt");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_gt" maxlength="8" size="30"onChange="validargrupo_tecnico()" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("id persona");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_persona" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','grupo_tecnico')">&nbsp;
					<input  type="button" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','grupo_tecnico')">&nbsp;
					<input  type="button" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','grupo_tecnico')">&nbsp;
					<input  type="reset" name="Resetear" value="CANCELAR">
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