<?php require_once "procesos.php"; ?>
<br>
<H3 align="center">
	<strong>Administracion de alarma_perfil
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">codigoperfil
				</span>
			</td>
			<td>
				<input  type="text" name="codigoperfil" maxlength="8" size="30"onChange="validaralarma_perfil()" value="<?php $acceso->objeto->ejecutarSql("select *from alarma_perfil ORDER BY codigoperfil desc"); echo "COD".verCo($acceso,"codigoperfil")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_tipo_alarma
				</span>
			</td>
			<td>
				<input  type="text" name="id_tipo_alarma" maxlength="5" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','alarma_perfil')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','alarma_perfil')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','alarma_perfil')">&nbsp;
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