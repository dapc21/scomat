<br>
<H3 align="center"><strong>Seleccione los Campos para el Reporte</strong></H3>

<form name="form1">
	<table border="1" width="480px" align="CENTER"> 
		<tr>
			<td width="200px">
				<span class="fuenteN">Campos Disponibles</span>
			</td>
			<td >&nbsp;
			</td>
			<td width="200px">
				<span class="fuenteN">Campos Seleccionados</span>
			</td>
		</tr>
		<tr>
			<td width="200px">
				<select size="5" name="AllFields" id="AllFields" style="width:200px;height: 100px;">
					
				</select>
			</td>
			<td align="center">
				<table id="table15" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr><td align="center"><input name="B3" class="arrow_btn" onClick="movel2R();" value="  &gt;  " type="button"></td></tr>
					<tr><td align="center"><input name="B4" class="arrow_btn" onClick="moveR2l()" value="  &lt;  " type="button"></td></tr>
					<tr><td align="center"><input name="B5" class="arrow_btn" onClick="MoveAllRight()" value=" &gt;&gt; " type="button"></td></tr>
					<tr><td align="center"><input name="B6" class="arrow_btn" onClick="MoveAllLeft()" value=" &lt;&lt; " type="button"></td></tr>
				</table>
			
			
			</td>
			<td width="200px">
					<select size="2" name="SelectedFields[]" id="fields" style="width:200px;height: 100px;" multiple="multiple">
					</select>
			</td>
		</tr>
		<tr>
			<td colspan="3" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="modificar" value="Anterior" onClick="conexionPHP_mat('Programador/creaFormulario.php','GenerarReportes');anteriorTablas2();">&nbsp;
					<input  type="button" name="registrar" value="Siguiente" onClick="cargarTablasRep2()">&nbsp;
					<input  type="hidden" value="" name="eliminar">&nbsp;
				</div>
			</td>
		</tr>
	</table>
</form>