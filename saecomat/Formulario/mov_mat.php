<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('MOV_MAT'))){
?>
<br>
<H3 align="center">
	<strong><?php echo _("Administracion de mov_mat");?>
	</strong>
</H3>
<form name="f1">
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente"><?php echo _("Materiales");?>
				</span>
			</td>
			<td>
				<!--input  type="text" name="id_mat" maxlength="1" size="1"onChange="validarmov_mat()" value=""-->
				<input  type="text" name="id_mat" maxlength="10" size="30"onChange="" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("id_mov");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_mov" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("cant_mov");?>
				</span>
			</td>
			<td>
				<input  type="text" name="cant_mov" maxlength="4" size="20" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','mov_mat')">&nbsp;
					<input  type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','mov_mat')">&nbsp;
					<input  type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','mov_mat')">&nbsp;
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