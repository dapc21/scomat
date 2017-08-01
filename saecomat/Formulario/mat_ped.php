<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('MAT_PED'))){
?>
<br>
<H3 align="center">
	<strong><?php echo _("Administracion de mat_ped");?>
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
				<input  type="text" name="id_mat" maxlength="10" size="30"onChange="validarmat_ped()" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("id_ped");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_ped" maxlength="8" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("Cantidad Pedido");?>
				</span>
			</td>
			<td>
				<input  type="text" name="cant_ped" maxlength="4" size="20" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("Cantidad Entrante");?>
				</span>
			</td>
			<td>
				<input  type="text" name="cant_ent" maxlength="4" size="20" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("Precio");?>
				</span>
			</td>
			<td>
				<input  type="text" name="precio" maxlength="10" size="20" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','mat_ped')">&nbsp;
					<input  type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','mat_ped')">&nbsp;
					<input  type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','mat_ped')">&nbsp;
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