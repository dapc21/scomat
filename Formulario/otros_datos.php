<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  ?>
<br>
<H3 align="center">
	<strong><?php echo _("administracion de otros datos");?>
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','otros_datos')">&nbsp;
					<input  type="button" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','otros_datos')">&nbsp;
					<input  type="button" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','otros_datos')">&nbsp;
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