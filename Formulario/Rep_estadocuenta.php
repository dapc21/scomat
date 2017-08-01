<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REIMP_ESTADODECUENTA')))
{
?>

<BR><div class="cabe"><?php echo _("ordenes de servicios");?></div>
<br>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos de busqueda");?></legend>
		
	<table border="0" width="100%" align="CENTER"> 
		<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">	
		<tr>
			<td>
				<span class="fuente"><?php echo _("nro abonado");?>
				</span>
			</td>
			<td>
				<input  type="text" name="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="" >
				<a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a>
			</td>
			<td>
				<span class="fuente"><?php echo _("rif / cedula");?></span>
			</td>
			<td valign="button">
				<input  type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula()">
				<a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a>
			</td>
				
			<td colspan="2">
				<a href="#" onclick="abrirBusq_cont_avanz()" ><img src="imagenes/busAvanz1.png" width="150px" height="25px" title="Busqueda Avanzada"></a>
			</td>
		</tr>
	 </table>
	</fieldset >	
</td>
	</tr>
	
	<tr>
  <td>
	<br>
	<div id="datagrid">
					
	</div>
	
</td>
	</tr>
		
</table>
					<input  type="hidden" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_estadocuenta()">&nbsp;
					<input  type="hidden" name="modificar" value="CANCELAR">
					<input  type="hidden" name="eliminar" value="CANCELAR">
					<input  type="hidden" name="Resetear" value="CANCELAR">
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