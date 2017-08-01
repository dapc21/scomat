<br>
<H3 align="center"><strong>Seleccione los campos para ordenar</strong></H3>

<form name="form1">
	<table border="1" width="400px" align="CENTER"> 
		<tr>
			<td width="170px" align="center">
				<span class="fuenteN">Campo</span>
			</td>
			<td width="170px" align="center">
				<span class="fuenteN">Orden</span>
			</td>
			<td align="center">&nbsp;
			</td>
		</tr>
		<tr>
			<td width="170px">
				<select name="AllFields" id="AllFields" style="width:200px;">
				</select>
			</td>
			<td align="center">
				<span class="fuente">
					<input  type="radio" name="orden" value="Asc" CHECKED>Asc
					<input  type="radio" name="orden" value="Desc">Desc
				</span>
			</td>
			<td align="center">
				<input  type="button" name="agregar" value="Agregar" onClick="moveOrden()">
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1" align="center">
					<select size="2" name="SelectedFields[]" id="fields" style="width:310px;height: 100px;" multiple="multiple">
					</select>
			</td>
			<td align="center">
				<input  type="button" name="eliminarCond" value="Eliminar" onClick="eliminarCondicion()">
			</td>
		</tr>
		<tr>
			<td colspan="4" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="modificar" value="Anterior" onClick="conexionPHP_mat('Programador/creaFormulario.php','pantallaRep3');anteriorTablas4();">&nbsp;
					<input  type="button" name="registrar" value="Siguiente" onClick="cargarTablasRep4()">&nbsp;
					<input  type="hidden" value="" name="eliminar">&nbsp;
				</div>
			</td>
		</tr>
	</table>
</form>