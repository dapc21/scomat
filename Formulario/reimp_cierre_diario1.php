<?php session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REIMP_CIERRE_DIARIO')))
{
?>
<br>
<div class="cabe"><?php echo _("reimprimir cierre diario");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset>
	  <legend ><?php echo _("datos de la busqueda");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
		<tr>
			<td width="250px" align="right">
				<span class="fuente"><?php echo _("fecha");?></span>
			</td>
			<td>
				<input type="text" name="desde" id="desde" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td width="300px" align="left">
				<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("imprimir");?>" onclick="reimp_cierre_diario1()">&nbsp;
				<input  type="<?php echo $obj->in;?>" name="registra" value="<?php echo _("guardar");?>" onclick="redes_cierre_diario1()">&nbsp;
			</td>
		</tr>
		
	</table>
	</fieldset>
  </td>		
 </tr>
		<tr>
			<td colspan="5">
				<br>
				
				<div align="center">
					
					<input  type="hidden" name="modificar" value="CANCELAR">
					<input  type="hidden" name="eliminar" value="CANCELAR">
					<input  type="hidden" name="Resetear" value="CANCELAR">
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