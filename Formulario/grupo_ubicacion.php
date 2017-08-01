<?php require_once "procesos.php"; ?>
<br>
<H3 align="center">
	<strong>Administracion de grupo_ubicacion
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">id_gt
				</span>
			</td>
			<td>
				<input  type="text" name="id_gt" maxlength="8" size="30"onChange="validargrupo_ubicacion()" value="<?php $acceso->objeto->ejecutarSql("select *from grupo_ubicacion ORDER BY id_gt desc"); echo "COD".verCo($acceso,"id_gt")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_sector
				</span>
			</td>
			<td>
				<input  type="text" name="id_sector" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','grupo_ubicacion')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','grupo_ubicacion')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','grupo_ubicacion')">&nbsp;
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