<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  ?>
<BR><div class="cabe"><?php echo _("reporte de deudas por sectores");?></div>
<form name="f1" >
	<table border="0" width="100%" align="CENTER">

 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("con deuda");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 

		<tr>
			<td>
				<span class="fuente"><?php echo _("desde");?></span>
			</td>
			<td>
			<!--<input  type="text" name="desde" value="2006-01-01"> -->
			<select name="desde" id="desde" onchange="" style="width: 130px;">
					<?php echo verMesCorte();?>
				</select>
			<td>
				<span class="fuente"><?php echo _("hasta");?>
				</span>
			</td>
			<td>
				<select name="hasta" id="hasta" onchange="" style="width: 130px;">
					<?php echo verMesCorte();?>
				</select>
			</td>

			<td width="150px">
				<span class="fuente"><?php echo _("status contrato");?>
				</span>
			</td>
			<td >
				<select name="status_contrato" id="status_contrato"  style="width: 146px;">
					<option value=""><?php echo _("todos");?></option>
					<?php echo verStatusCont($acceso);?>
				</select>
			</td>

			<input  type="hidden" name="deuda" id="deuda"  maxlength="10" size="5" value="0">
		</tr>
		
	</table>

	</fieldset>
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
		<tr>
			<td colspan="2">
				<br>
				
				<div align="center">
					<input  type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscarRep_deudasector()">&nbsp;
					<input  type="button" name="modificar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_deudasector()">&nbsp;
					<input  type="hidden" name="modificar" value="CANCELAR">
					<input  type="hidden" name="eliminar" value="CANCELAR">
					<input  type="hidden" name="Resetear" value="CANCELAR">
				</div>
			</td>
		</tr>
	</table>
</form>