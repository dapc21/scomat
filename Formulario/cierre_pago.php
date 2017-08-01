<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('cierre_pago')))
{
?>
<br>
<H3 align="center">
	<strong><?php echo _("administracion de cierre pago");?>
	</strong>
</H3>
<form name="f1" >
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente"><?php echo _("id cont serv");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_cont_serv" maxlength="15" size="30"onChange="validarcierre_pago()" value="">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("id cierre");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_cierre" maxlength="12" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','cierre_pago')">&nbsp;
					<input  type="<?php echo $obj->mo; ?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cierre_pago')">&nbsp;
					<input  type="<?php echo $obj->el; ?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','cierre_pago')">&nbsp;
					
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