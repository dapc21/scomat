<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('contrato_servicio')))
{
?>
<br>
<H3 align="center">
	<strong><?php echo _("administracion de contrato servicio");?>
	</strong>
</H3>
<form name="f1" >
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente"><?php echo _("id cont serv");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_cont_serv" maxlength="12" size="30"onChange="validarcontrato_servicio()" value="<?php $acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); echo $ini_u.verCodLong($acceso,"id_cont_serv")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("servicios");?>
				</span>
			</td>
			<td>
				<select name="id_serv" id="-1" onchange=""style="width: 206px;">
					<?php echo verServicios($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("id contrato");?>
				</span>
			</td>
			<td>
				<input  type="text" name="id_contrato" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input  type="text" name="fecha_inst" id="fecha_inst" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("cantidad");?></span>
			</td>
			<td>
				<input  type="text" name="cant_serv" maxlength="2" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("costo");?>
				</span>
			</td>
			<td>
				<input  type="text" name="costo_cobro" maxlength="2" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','contrato_servicio')">&nbsp;
					<input  type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','contrato_servicio')">&nbsp;
					<input  type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','contrato_servicio')">&nbsp;
					<input  type="button" name="salir" onclick="cerrarVenta()" value="<?php echo _("limpiar");?>">
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