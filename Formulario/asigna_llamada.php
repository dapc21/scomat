<?php require_once "procesos.php"; ?>
<br>
<H3 align="center">
	<strong>Administracion de asigna_llamada
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">id_all
				</span>
			</td>
			<td>
				<input  type="text" name="id_all" maxlength="10" size="30"onChange="validarasigna_llamada()" value="<?php $acceso->objeto->ejecutarSql("select *from asigna_llamada ORDER BY id_all desc"); echo "COD".verCo($acceso,"id_all")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">ubicacion
				</span>
			</td>
			<td>
				<input  type="text" name="ubica_all" maxlength="255" size="60" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">fecha_all
				</span>
			</td>
			<td>
				<input  type="text" name="fecha_all" id="fecha_all" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">login_enc
				</span>
			</td>
			<td>
				<input  type="text" name="login_enc" maxlength="25" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">login_resp
				</span>
			</td>
			<td>
				<input  type="text" name="login_resp" maxlength="25" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">observacion
				</span>
			</td>
			<td>
				<textarea name="obser_all" cols="30" rows="1"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">status
				</span>
			</td>
			<td>
				<input  type="text" name="status_all" maxlength="20" size="30" value="ASIGNADO" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','asigna_llamada')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','asigna_llamada')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','asigna_llamada')">&nbsp;
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