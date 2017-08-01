<?php require_once "procesos.php"; ?>
<br>
<H3 align="center">
	<strong>Administracion de conv_con
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">id_conv_cont
				</span>
			</td>
			<td>
				<input  type="text" name="id_conv_cont" maxlength="10" size="30"onChange="validarconv_con()" value="<?php $acceso->objeto->ejecutarSql("select *from conv_con ORDER BY id_conv_cont desc"); echo "COD".verCo($acceso,"id_conv_cont")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id con 
				</span>
			</td>
			<td>
				<input  type="text" name="id_conv" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_cont_serv
				</span>
			</td>
			<td>
				<input  type="text" name="id_cont_serv" maxlength="12" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">fecha_ven
				</span>
			</td>
			<td>
				<input  type="text" name="fecha_ven" id="fecha_ven" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','conv_con')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','conv_con')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','conv_con')">&nbsp;
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