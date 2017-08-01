<?php 
	require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('COBRADOR')))
{

?>

<BR><div class="cabe"><?php echo _("administracion de tipos de alarmas");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_tipo_alarma" maxlength="5" size="30"onChange="validartipo_alarma()" value="<?php $acceso->objeto->ejecutarSql("select *from tipo_alarma  where (id_tipo_alarma ILIKE '$ini_u%')  ORDER BY id_tipo_alarma desc"); echo $ini_u.verCodigo($acceso,"id_tipo_alarma")?>">
		<tr>
			<td>
				<span class="fuente">NOMBRE
				</span>
			</td>
			<td>
				<input  type="text" name="nombre_alarma" maxlength="30" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Status
				</span>
			</td>
			<td>
				<span class="fuente">ACTIVO
					<input  type="radio" name="status_alarma" value="ACTIVO"CHECKED>&nbsp;&nbsp;&nbsp;INACTIVO
					<input  type="radio" name="status_alarma" value="INACTIVO">
				</span>
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
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','tipo_alarma')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','tipo_alarma')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','tipo_alarma')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','tipo_alarma')" value="<?php echo _("limpiar");?>">
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