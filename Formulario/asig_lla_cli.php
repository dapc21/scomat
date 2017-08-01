<?php require_once "procesos.php"; ?>
<br>
<H3 align="center">
	<strong>Administracion de asig_lla_cli
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">id_lc
				</span>
			</td>
			<td>
				<input  type="text" name="id_lc" maxlength="10" size="30"onChange="validarasig_lla_cli()" value="<?php $acceso->objeto->ejecutarSql("select *from asig_lla_cli ORDER BY id_lc desc"); echo "COD".verCo($acceso,"id_lc")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_all
				</span>
			</td>
			<td>
				<input  type="text" name="id_all" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_contrato
				</span>
			</td>
			<td>
				<input  type="text" name="id_contrato" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_lla
				</span>
			</td>
			<td>
				<input  type="text" name="id_lla" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">status_lc
				</span>
			</td>
			<td>
				<input  type="text" name="status_lc" maxlength="20" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','asig_lla_cli')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','asig_lla_cli')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','asig_lla_cli')">&nbsp;
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