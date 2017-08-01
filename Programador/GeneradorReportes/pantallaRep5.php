<br>
<H3 align="center"><strong>Configuraci&oacute;n del Reporte</strong></H3>

<form name="form1">
	<table border="1" width="490px" align="CENTER"> 
		<tr>
			<td width="100px">
				<span class="fuenteN">Nombre</span>
			</td>
			<td>
				<input  type="text" name="nombre" maxlength="20" size="59" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuenteN">Titulo</span>
			</td>
			<td>
				<input  type="text" name="titulo" maxlength="100" size="59" value="">
			</td>
		</tr>
		<tr>
			<td > 
				<span class="fuenteN">Cabecera</span>
			</td>
			
			<td >
				<textarea name="cabecera" style="width:380px" rows="3"></textarea>
			</td>
		</tr>
		<tr>
			<td > 
				<span class="fuenteN">Pie</span>
			</td>
			
			<td >
				<textarea name="pie" style="width:380px" rows="2"></textarea>
			</td>
		</tr>
		<tr>
			<td >
				<span class="fuenteN">Consulta SQL</span>
				<input name="consul" type="checkbox" value="" onchange="habilitarSQL()"> <span class="fuenteN">Editar</span>
				<input  type="button" name="validar" value="Validar SQL" onClick="validarSQL()">
			</td>
			<td >
				<textarea disabled name="consulta" style="width:380px" rows="4"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="3" rowspan="1">
				<input name="vista" type="checkbox" value="vista" onchange="minUno()"> <span class="fuenteN">Generar una Vista</span>
			</td>
		</tr>
		<tr>
			<td colspan="3" rowspan="1">
				<input name="vista" type="checkbox" value="reporte" onchange="minUno()" checked> <span class="fuenteN">Generar Reporte</span>
			</td>
		</tr>
		<tr>
			<td colspan="3" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="modificar" value="Anterior" onClick="conexionPHP('Programador/creaFormulario.php','pantallaRep4');anteriorTablas5()">&nbsp;
					<input  type="button" name="registrar" value="Siguiente" onClick="cargarTablasRenombre()">&nbsp;
				</div>
			</td>
		</tr>
	</table>
</form>