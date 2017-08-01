<br>
<H3 align="center"><strong>Seleccione los Campos a comparar</strong></H3>

<form name="form1">
	<table border="1" width="480px" align="CENTER"> 
		<tr>
			<td width="170px" align="center">
				<span class="fuenteN">Campo 1</span>
			</td>
			<td align="center">&nbsp;
			</td>
			<td width="170px" align="center">
				<span class="fuenteN">Campo 2</span>
			</td>
			<td align="center">&nbsp;
			</td>
		</tr>
		<tr>
			<td width="170px">
				<select name="AllFields" id="AllFields" style="width:170px;">
				</select>
			</td>
			<td align="center">
				<b>=</b>
			</td>
			<td width="170px">
					<select name="AllFields1" id="AllFields1" style="width:170px;">
					
				</select>
			</td>
			<td align="center"><input  type="button" name="agregar" value="Agregar" onClick="moveCondicion()">
			</td>
		</tr>
		<tr>
			<td colspan="3" rowspan="1" align="center">
					<select size="2" name="SelectedFields[]" id="fields" style="width:400px;height: 100px;" multiple="multiple">
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
					<input  type="button" name="modificar" value="Anterior" onClick="conexionPHP_cas('Programador/creaFormulario.php','pantallaRep2');anteriorTablas3();">&nbsp;
					<input  type="button" name="registrar" value="Siguiente" onClick="cargarTablasRep3()">&nbsp;
					<input  type="hidden" value="" name="eliminar">&nbsp;
				</div>
			</td>
		</tr>
	</table>
</form>