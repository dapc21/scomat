<?php 
	require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PRECINTOS')))
{

?>

<BR><div class="cabe"><?php echo _("administracion de precintos");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_prec" maxlength="10" size="30"onChange="validarprecintos()" value="<?php $acceso->objeto->ejecutarSql("select *from precintos  where (id_prec ILIKE '$ini_u%')  ORDER BY id_prec desc"); echo $ini_u.verCodLong($acceso,"id_prec")?>">
		<input  type="hidden" name="login" maxlength="25" size="30" value="<?php echo $_SESSION["login"];?>" >
		<tr>
			<td>
				<span class="fuente">nombre precinto
				</span>
			</td>
			<td>
				<input  type="text" name="nombre_prec" maxlength="15" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Fecha ingreso
				</span>
			</td>
			<td>
				<input  type="text" name="fecha_ing_prec" id="fecha_ing_prec" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Fecha Modificacion
				</span>
			</td>
			<td>
				<input  type="text" name="fecha_mod_prec" id="fecha_mod_prec" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Status
				</span>
			</td>
			<td>
				<span class="fuente">ACTIVO
					<input  type="radio" name="status_prec" value="ACTIVO"CHECKED>&nbsp;&nbsp;&nbsp;INACTIVO
					<input  type="radio" name="status_prec" value="INACTIVO">
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
					<input  type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','precintos')">&nbsp;
					<input  type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','precintos')">&nbsp;
					<input  type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','precintos')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','precintos')" value="<?php echo _("limpiar");?>">
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