<?php require_once "procesos.php"; ?>
<br>
<H3 align="center">
	<strong>Administracion de promo_serv
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">id_serv
				</span>
			</td>
			<td>
				<input  type="text" name="id_serv" maxlength="30" size="30"onChange="validarpromo_serv()" value="<?php $acceso->objeto->ejecutarSql("select *from promo_serv ORDER BY id_serv desc"); echo "COD".verCo($acceso,"id_serv")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_promo
				</span>
			</td>
			<td>
				<input  type="text" name="id_promo" maxlength="30" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','promo_serv')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','promo_serv')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','promo_serv')">&nbsp;
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