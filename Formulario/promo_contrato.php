<?php require_once "procesos.php"; ?>
<br>
<H3 align="center">
	<strong>Administracion de promo_contrato
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">id_promo_con
				</span>
			</td>
			<td>
				<input  type="text" name="id_promo_con" maxlength="10" size="30"onChange="validarpromo_contrato()" value="<?php $acceso->objeto->ejecutarSql("select *from promo_contrato where (id_promo_con ILIKE '$ini_u%')  ORDER BY id_promo_con desc"); echo $ini_u.verCo($acceso,"id_promo_con")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_contrato
				</span>
			</td>
			<td>
				<input  type="text" name="id_contrato" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_promo
				</span>
			</td>
			<td>
				<input  type="text" name="id_promo" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">inicio promo
				</span>
			</td>
			<td>
				<input  type="text" name="inicio_promo" id="inicio_promo" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">fin_promo
				</span>
			</td>
			<td>
				<input  type="text" name="fin_promo" id="fin_promo" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">login
				</span>
			</td>
			<td>
				<input  type="text" name="login" maxlength="25" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">status_promo_con
				</span>
			</td>
			<td>
				<input  type="text" name="status_promo_con" maxlength="10" size="30" value="ACTIVO" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','promo_contrato')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','promo_contrato')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','promo_contrato')">&nbsp;
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