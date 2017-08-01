<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('aviso_cobro')))
{
?>
<br>
<H3 align="center">
	<strong><?php echo _("cargar mensualidad");?>
	</strong>
</H3>
<form name="f1" >
	<table border="0" width="300px" align="CENTER" bordercolor="" > 
		<input  type="hidden" name="id_cont_serv" maxlength="12" size="30"onChange="validarcontrato_servicio()" value="<?php $acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); echo $ini_u.verCodLong($acceso,"id_cont_serv")?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("tipo servicio");?></span>
			</td>
			<td>
					<select name="id_tipo_servicio" id="id_tipo_servicio" onchange="cargarServicioMensual()" style="width: 150px;">
					<?php echo verTipoSer($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("servicio");?></span>
			</td>
			<td>
				<select name="id_serv" id="id_serv" onchange="traerTipoSer()" style="width: 150px;">
					<?php echo verServicioMensualCable($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("status");?></span>
			</td>
			<td>
				<select name="status_contrato" id="status_contrato"  style="width: 150px;">
					<option value="Todos"><?php echo _("todos");?></option>
					<option value="Activo"><?php echo _("activo");?></option>
					<option value="Cortados"><?php echo _("cortados");?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="4" rowspan="1">
				<br>
				<div align="center">
					<input disabled type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("cargar mensualidad");?>" onclick="verificar('incluir','aviso_cobro')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','caja_cobrador')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','caja_cobrador')">&nbsp;
					
				</div>
			</td>
		</tr>
		<tr>			
			<td colspan="4">				
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