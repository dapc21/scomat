<?php 
	require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('INTERFAZ_ACC')))
{

?>

<BR><div class="cabe"><?php echo _("INTERFAZ acc");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="text" name="id_alarma" maxlength="10" size="30"onChange="validaralarmas()" value="<?php $acceso->objeto->ejecutarSql("select *from interfazacc  where (id_accquery ILIKE '$ini_u%')  ORDER BY id_accquery desc"); echo $ini_u.verCodLong($acceso,"id_accquery")?>">
		<tr>
			<td>
				<span class="fuente">CODIGO
				</span>
			</td>
			<td>
				<input  type="text" name="nombre_alarma" maxlength="50" size="30" value="" >
			</td>
			<td>
				<span class="fuente">Tipo alarma
				</span>
			</td>
			<td>
				<select name="id_tipo_alarma" id="-1" onchange="" style="width: 175px;">
					<option value="ACTIVAR">ACTIVAR</option>
					<option value="DESACTIVAR">DESACTIVAR</option>
					<option value="SERVICIOSBASICO">SERVICIOSBASICO</option>
					<option value="SERVICIOSHBO">SERVICIOSHBO</option>
					<option value="SERVICIOSADULTO">SERVICIOSADULTO</option>
					<option value="SERVICIOSTODOS">SERVICIOSTODOS</option>
					<option value="BORRARDECO">BORRARDECO</option>
					<option value="HABILITARDECO">HABILITARDECO</option>
					
				</select>
			</td>
			<td>
				<span class="fuente">STATUS
				</span>
			</td>
			<td>
				<select name="ref_alarma" id="-1" onchange="" style="width: 175px;">
					<option value="FALSE">FALSE</option>
					<option value="TRUE">TRUE</option>
					
				</select>
			</td>
		</tr>
		<tr>
			<input  type="hidden" name="fecha_alarma" id="fecha_alarma" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			
			<input  type="HIDDEN" name="detalle_alarma" maxlength="15" size="30" value="" >
			<input  type="hidden" name="status_alarma" maxlength="15" size="30" value="" >
			<input  type="hidden" value="dato" name="dato">
		</table>
	</fieldset>
  </td>		
 </tr>
 
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','alarmas')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','alarmas')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','alarmas')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','alarmas')" value="<?php echo _("limpiar");?>">
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