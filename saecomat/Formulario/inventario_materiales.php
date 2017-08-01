<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('INVENTARIO_MATERIALES'))){
?>
<br>
<H3 align="center">
	<strong><?php echo _("Administracion de inventario_materiales");?>
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente"><?php echo _("id_mat");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_mat" maxlength="10" size="30"onChange="validarinventario_materiales()" value="<?php $acceso->objeto->ejecutarSql("select *from inventario_materiales where (id_mat ILIKE '$ini_u%') ORDER BY id_mat desc LIMIT 1 offset 0"); echo $ini_u.verCo($acceso,"id_mat")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("id_inv");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_inv" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("cant_sist");?>
				</span>
			</td>
			<td>
				<input  type="text" name="cant_sist" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("cant_real");?>
				</span>
			</td>
			<td>
				<input  type="text" name="cant_real" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("justi_inv");?>
				</span>
			</td>
			<td>
				<textarea name="justi_inv" cols="20" rows="2"></textarea>
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','inventario_materiales')">&nbsp;
					<input  type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','inventario_materiales')">&nbsp;
					<input  type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','inventario_materiales')">&nbsp;
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