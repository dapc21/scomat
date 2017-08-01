<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  ?>
<BR><div class="cabe"><?php echo _("reporte de deudas por sectores");?></div>
<form name="f1" >
	<table border="0" width="100%" align="CENTER">
 
		<tr>
			<td colspan="2">
				<br>
				
				<div align="center">
					<input  type="hidden" name="registrar" value="<?php echo _("buscar");?>" onclick="buscarRep_deudasector()">&nbsp;
					<input  type="button" name="modificar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_deuda_mes()">&nbsp;
					<input  type="hidden" name="modificar" value="CANCELAR">
					<input  type="hidden" name="eliminar" value="CANCELAR">
					<input  type="hidden" name="Resetear" value="CANCELAR">
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<fieldset >
					<legend ><?php echo _("datos encontrados");?></legend>
						<div id="datagrid"></div>			
					</fieldset>
			</td>
		</tr>
		</table>
</form>