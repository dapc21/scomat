<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   ?>
<br>
<H3 align="center">
	<strong>Administracion de Persona
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<input  type="hidden" name="idPersona" maxlength="8" size="30" value="<?php $acceso->objeto->ejecutarSql("select *from persona where (idpersona ILIKE '$ini_u%') ORDER BY idpersona desc"); echo $ini_u.verCo($acceso,"idpersona")?>">
		<tr>
			<td>
				<span class="fuente">Cedula
				</span>
			</td>
			<td>
				<input  type="text" name="cedula" maxlength="8" size="30" value="" onChange="validarPersona_mat()">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Nombre
				</span>
			</td>
			<td>
				<input  type="text" name="nombre" maxlength="30" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Apellido
				</span>
			</td>
			<td>
				<input  type="text" name="apellido" maxlength="30" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_mat('incluir','Persona')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_mat('modificar','Persona')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_mat('eliminar','Persona')">&nbsp;
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