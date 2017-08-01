<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BITACORA')))
{
 ?>
<br>
<H3 align="center">
	<strong>Administracion de info_adic
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente">id_inf_a
				</span>
			</td>
			<td>
				<input  type="text" name="id_inf_a" maxlength="8" size="30"onChange="validarinfo_adic()" value="<?php $acceso->objeto->ejecutarSql("select *from info_adic ORDER BY id_inf_a desc"); echo "COD".verCo($acceso,"id_inf_a")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">id_cli
				</span>
			</td>
			<td>
				<input  type="text" name="id_cli" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">detalle info
				</span>
			</td>
			<td>
				<input  type="text" name="info_a" maxlength="20" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">informacion adicional
				</span>
			</td>
			<td>
				<input  type="text" name="desc" maxlength="100" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" class="boton" name="registrar" value="REGISTRAR" onclick="verificar_crm('incluir','info_adic')">&nbsp;
					<input  type="button" class="boton" name="modificar" value="MODIFICAR" onclick="verificar_crm('modificar','info_adic')">&nbsp;
					<input  type="button" class="boton" name="eliminar" value="ELIMINAR" onclick="verificar_crm('eliminar','info_adic')">&nbsp;
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

<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>