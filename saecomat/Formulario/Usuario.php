<?php
require_once "procesos.php";
?>
<br>
<H3 align="center">
	<strong>Administracion de Usuarios
	</strong>
</H3>
<br>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">Usuario</span>
			</td>
			<td>
				<input  type="text" name="login" maxlength="15" size="25"onChange="validarUsuario_mat()" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Cedula</span>
			</td>
			<td>
				<input  type="text" name="cedula" maxlength="8" size="25"onChange="validarEmp_mat()" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Perfil</span>
			</td>
			<td>
				<select name="codigoperfil" style="width: 176px;">
					<?php echo perfil($acceso);?>
				</select>
				
			</td>
		</tr>
		
		<tr>
			<td>
				<span class="fuente">Contrase&ntilde;a</span>
			</td>
			<td>
				<input  type="password" name="password" maxlength="25" size="25" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Confirmar Contrase&ntilde;a</span>
			</td>
			<td>
				<input  type="password" name="otropassword" maxlength="25" size="25" value="">
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
			<td colspan="2" rowspan="1">
				<br>
				
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_mat('incluir','Usuario')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_mat('modificar','Usuario')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_mat('eliminar','Usuario')">&nbsp;
					<input  type="reset" name="Resetear" value="CANCELAR">
				</div>
			</td>
		</tr>
	</table>
</form>