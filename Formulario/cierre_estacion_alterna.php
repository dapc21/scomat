<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
session_start();
	$id_f = $_SESSION["id_franq"]; 
	$consult=" and (id_franq='$id_f' or id_franq='0' )";
	//echo $consult;
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CIERRE_ESTACION_ANTERNO')))
{

				
?>
<BR><div class="cabe"><?php echo _("cierre de estacion de trabajo alterna");?></div>
<form name="f1" action="javascript:;">

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos de cierre");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_cierre" maxlength="12" size="30"onChange="validarcirre_diario()" value="<?php $acceso->objeto->ejecutarSql("select *from cirre_diario_et  where (id_cierre ILIKE '$ini_u%') ORDER BY id_cierre desc"); echo $ini_u.verCodLong($acceso,"id_cierre")?>">
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input  type="text" name="fecha_cierre" id="fecha_cierre" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</td>
			
		</tr>
			
			<td>
				<span class="fuente"><?php echo _("estacion");?></span>
			</td>
			<td>
				<select  name="id_est" id="id_est" onchange="" style="width: 150px;">
					<?php echo verEstacionTrabajo1($acceso);?>
				</select>
			</td>
			
		
	</table>
	</fieldset>
  </td>		
 </tr>
		<tr>
			<td colspan="4" rowspan="1">
				
				<div align="center">

					<input  type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("Cargar cierre estacion");?>" onclick="cargar_cierre_estacion()">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cirre_diario_et')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','cirre_diario_et')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','cierre_estacion_alterna')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>

</table>
</form>
<?php 
//estacion
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>