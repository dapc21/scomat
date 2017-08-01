<br>
<H3 align="center"><strong>Parametros Finales</strong></H3>

<form name="form1">
	<table border="1" width="440px" align="CENTER"> 
		<tr>
			<td colspan="3" align="center">
				<span class="fuenteN">Agregue los campos en el orden en que apareceran en el reporte</span>
			</td>
			
		</tr>
		<tr>
			<td width="170px" align="center">
				<span class="fuenteN">Campo</span>
			</td>
			<td width="170px" align="center">
				<span class="fuenteN">Nombre Cabecera</span>
			</td>
			<td align="center">&nbsp;
			</td>
		</tr>
		<tr>
			<td width="170px">
				<select name="AllFields" id="AllFields" style="width:175px;" onchange="cambiarNombreRep()">
				</select>
			</td>
			<td align="center">
				<input  type="text" name="nombre" maxlength="15" size="24" value="">
			</td>
			<td align="center">
				<input  type="button" name="agregar" value="Agregar" onClick="moveRenombre()">
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1" align="center">
					<select size="2" name="SelectedFields[]" id="fields" style="width:310px;height: 100px;" multiple="multiple">
					</select>
			</td>
			<td align="center">
				<input  type="button" name="eliminarCond" value="Eliminar" onClick="eliminarListar()">
			</td>
		</tr>
		<tr>
			<td colspan="4" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="modificar" value="Anterior" onClick="conexionPHP_mat('Programador/creaFormulario.php','pantallaRep5');cargarTablasRep6();">&nbsp;
					<input  type="button" name="registrar" value="Finalizar" onClick="GenerarReporte()">&nbsp;
					<input  type="hidden" value="" name="eliminar">&nbsp;
				</div>
			</td>
		</tr>
	</table>
</form>