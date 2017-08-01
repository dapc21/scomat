<?php require_once "procesos.php"; ?>
<br>
<H3 align="center">
	<strong>Administracion de ejempl
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_mat('incluir','ejempl')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_mat('modificar','ejempl')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_mat('eliminar','ejempl')">&nbsp;
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