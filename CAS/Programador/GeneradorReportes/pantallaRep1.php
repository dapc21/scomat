<br>
<H3 align="center"><strong>Selecci&oacute;n de Tablas</strong></H3>

<form name="f1">
	<table border="1" width="420px" align="CENTER"> 
		<tr>
			<td colspan="2" rowspan="1">
				<span class="fuenteN">Seleccione las tablas y/o las vistas para el reporte</span>
			</td>
		</tr>
		<?php echo listadoTablas($acceso);?>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="Siguiente" onClick="cargarTablasRep()">&nbsp;
					<input  type="hidden" value="" name="modificar">&nbsp;
					<input  type="hidden" value="" name="eliminar">&nbsp;
				</div>
			</td>
		</tr>
	</table>
</form>