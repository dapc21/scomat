<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  ?>
<BR><div class="cabe"><?php echo _("reporte de deudas por zonas");?></div>
<form name="f1" >
	<table border="0" width="100%" align="CENTER"> 
		<tr>
			<td colspan="2">
				<fieldset >
					<legend ><?php echo _("datos encontrados");?></legend>
						<div id="datagrid"></div>			
					</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<br>
				
				<div align="center">
					<input  type="button" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_deudazona()">&nbsp;
					<input  type="hidden" name="modificar" value="CANCELAR">
					<input  type="hidden" name="eliminar" value="CANCELAR">
					<input  type="hidden" name="Resetear" value="CANCELAR">
				</div>
			</td>
		</tr>
	</table>
</form>