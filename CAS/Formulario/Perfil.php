<?php
require_once "procesos.php";			
$acceso->objeto->ejecutarSql("select *from perfil ORDER BY codigoperfil desc");
?>


<br>

<H3 align="center">
	<strong>Administracion de Perfiles de Usuarios
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">Codigo</span>
			</td>
			<td>
				<input  type="text" name="codigo" maxlength="7" size="25"onChange="validarCodigo()" value="<?php echo "PERF".verCodigo($acceso,'codigoperfil')?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Nombre</span>
			</td>
			<td>
				<input  type="text" name="nombre" maxlength="25" size="25" value="">
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
				<textarea name="descripcion" cols="46" rows="1"></textarea>
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
				<strong>Asignar Modulos
				</strong></span>
			</td>
			<td align="center">
				<span class="fuente">
				<strong>Operaciones
				</strong></span>
			</td>
		</tr>
			<?php echo perfiles($acceso)?>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_cas('incluir','Perfil')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','Perfil')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','Perfil')">&nbsp;
					<input  type="reset" name="Resetear" value="CANCELAR">
				</div>
			</td>
		</tr>
	</table>
</form>