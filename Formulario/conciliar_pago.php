<?php session_start();require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{
?>
<BR><div class="cabe"><?php echo _("Conciliar Pagos");?></div>
<form name="f1" action="javascript:;">
<table border="0" width="97%" align="CENTER" > 

 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("procesos");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td>
				<span class="fuente">Identificar Pagos Clientes</span>
			</td>
			<td > 
				<div id="identificar_pago_cli" >
				</div>			
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Conciliar Pagos Clientes</span>
			</td>
			<td > 
				<div id="conciliar_pago_cli" >
				</div>	
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Conciliar Pagos Franquicias</span>
			</td>
			<td > 
				<div id="conciliar_pago_franq" >
				</div>	
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		
		
		
		</table>
		</fieldset>
</td>		
 </tr> 
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="Iniciar Proceso" onclick="iniciar_proceso_conciliacion()">&nbsp;
					<input  type="hidden" name="modificar" value="MODIFICAR" onclick="verificar('modificar','conciliar_pago')">&nbsp;
					<input  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','conciliar_pago')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','conciliar_pago')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
		
 <tr>

  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("tabla_bancoses agregadas");?></legend>
			<div id="datagrid" class="data">
		
		
			</div>			
	</fieldset>
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