<?php session_start();require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('EXPORTARARCHIVOSA2')))
{
?>
<BR><div class="cabe"><?php echo _("exportar archivos para sistema A2");?></div>
<form name="f1" action="javascript:;">
<table border="0" width="97%" align="CENTER" > 

		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="exportar facturas A2" onclick="exportar_facturas()">&nbsp;
					<input  type="<?php echo $obj->in; ?>" name="modidfficar" value="exportar pagos A2" onclick="exportar_pagos()">&nbsp;
					<input  type="hidden" name="modificar" value="exportar pagos A2" onclick="exportar_pagos()">&nbsp;
					<input  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','tabla_bancos')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','exportar_archivo_A2')" value="<?php echo _("limpiar");?>">
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