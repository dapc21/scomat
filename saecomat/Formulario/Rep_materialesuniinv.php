<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_MATERIALESUNIINV'))){
?>
<BR><div class="cabe"><?php echo _("materiales_uni_inv");?></div>
<form name="f1">
	<table border="0" width="100%" align="CENTER"> 
		<tr>
			<td colspan="2">
				<div id="datagrid">
					
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<br>
				
				<div align="center">
					<input  type="button" name="registrar" value="IMPRIMIR REPORTE" onclick="ImprimirRep_materialesuniinv()">&nbsp;
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