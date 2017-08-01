<?php
require_once "procesos.php";			
$acceso->objeto->ejecutarSql(sql("modulo ORDER BY codigomodulo desc"));	
?>
<br>
<H3 align="center">
	<strong>Administracion de Modulos de Perfiles
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">Codigo</span>
			</td>
			<td>
				<input  type="text" name="codigo" maxlength="7" size="25"onChange="validarModulo_mat()" value="<?php $acceso->objeto->ejecutarSql(sql("modulo ORDER BY codigomodulo desc")); echo "MODU".verCodigo($acceso,"codigomodulo")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Nombre</span>
			</td>
			<td>
				<input  type="text" name="nombre" maxlength="25" size="25" value="" onChange="asignaNameModulo()">
				<input  type="hidden" name="name" value="">
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1">
				<label>
					<strong>
						<span class="fuente">Descripci&oacute;n</span>
					</strong>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1">
				<textarea name="descripcion" cols="46" rows="3"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="datagrid" type="checkbox" value=""> <span class="fuente">Agregar DataGrid al formulario</span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Status</span>
			</td>
			<td>
				<span class="fuente">Activo
				<input  type="radio" name="status" value="Activo" CHECKED>Inactivo
				<input  type="radio" name="status" value="Inactivo"></span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">
				<strong>Asignar a los perfiles
				</strong></span>
			</td>
			<td align="center">
				<span class="fuente">
				<strong>Operaciones
				</strong></span>
			</td>
		</tr>
		<?php echo modulos($acceso)?>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_mat('incluir','Modulo')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_mat('modificar','Modulo')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_mat('eliminar','Modulo')">&nbsp;
					<input  type="reset" name="Resetear" value="CANCELAR">
				</div>
			</td>
		</tr>
	</table>
</form>