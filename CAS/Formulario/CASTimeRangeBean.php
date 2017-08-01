<?php require_once "procesos.php"; ?>
<br>
<H3 align="center">
	<strong>Administracion de CASTimeRangeBean
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">idCASTimeRangeBean
				</span>
			</td>
			<td>
				<input  type="text" name="idCASTimeRangeBean" maxlength="8" size="30"onChange="validarCASTimeRangeBean()" value="<?php $acceso->objeto->ejecutarSql("select *from castimerangebean ORDER BY idcastimerangebean desc"); echo "COD".verCo($acceso,"idcastimerangebean")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">subscriptionId
				</span>
			</td>
			<td>
				<input  type="text" name="subscriptionId" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">day
				</span>
			</td>
			<td>
				<select name="day" id="-1" onchange="">
					<option value="0">Seleccione...</option>
					<option value="1"></option>
					<option value="Lunes"></option>
					<option value="2">Martes</option>
					<option value="3">Miercoles</option>
					<option value="4">Jueves</option>
					<option value="5">Viernes</option>
					<option value="6">Sabado</option>
					<option value="7">Domingo</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">broadcastTimeBegin
				</span>
			</td>
			<td>
				<input  type="text" name="broadcastTimeBegin" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">broadcastTimeEnd
				</span>
			</td>
			<td>
				<input  type="text" name="broadcastTimeEnd" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar_cas('incluir','CASTimeRangeBean')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar_cas('modificar','CASTimeRangeBean')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar_cas('eliminar','CASTimeRangeBean')">&nbsp;
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