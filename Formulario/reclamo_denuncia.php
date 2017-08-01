<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('reclamo_denuncia')))
{
?>
<br>
<H3 align="center">
	<strong><?php echo _("administracion de reclamo denuncia");?>
	</strong>
</H3>
<form name="f1" >
	<table border="1" width="600px" align="CENTER" bordercolor="" > 
		<input  type="hidden" name="id_rec" maxlength="8" size="30"onChange="validarreclamo_denuncia()" value="<?php $acceso->objeto->ejecutarSql("select *from reclamo_denuncia  where (id_rec ILIKE '$ini_u%') ORDER BY id_rec desc"); echo $ini_u.verCo($acceso,"id_rec")?>">
		<input  type="hidden" name="id_persona" maxlength="10" size="30" value="" >
		<tr>
			<td>
				<span class="fuente"><?php echo _("nro reclamo");?>
				</span>
			</td>
			<td>
				<input  type="text" name="nro_rec" maxlength="5" size="30" value="<?php $acceso->objeto->ejecutarSql("select *from reclamo_denuncia ORDER BY nro_rec desc"); echo verNumero($acceso,"nro_rec")?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("tipo");?>
				</span>
			</td>
			<td>
				<span class="fuente"><?php echo _("reclamo");?>
					<input  type="radio" name="tipo_rec" value="Reclamo"CHECKED>&nbsp;&nbsp;&nbsp;<?php echo _("denuncia");?>
					<input  type="radio" name="tipo_rec" value="Denuncia">
				</span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("rif / cedula");?>
				</span>
			</td>
			<td>
				<input  type="text" name="cedula" maxlength="10" size="30" value="" onChange="validarcliente()">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("nombre cliente");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="nombre" maxlength="30" size="30" value="" >
			</td>
		</tr>
		
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="fecha_rec" id="fecha_rec" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("hora");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="hora_rec" maxlength="8" size="30" value="<?php echo date("H:i:s");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("motivo");?>
				</span>
			</td>
			<td>
				<input  type="text" name="motivo_rec" maxlength="30" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("descripcion");?>
				</span>
			</td>
			<td>
				<textarea name="descrip_rec" cols="30" rows="3"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("denunciado");?>
				</span>
			</td>
			<td>
				<input  type="text" name="denunciado" maxlength="10" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("status reclamo");?>
				</span>
			</td>
			<td>
				<input  type="text" name="status_rec" maxlength="8" size="30" value="En Proceso" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','reclamo_denuncia')">&nbsp;
					<input  type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','reclamo_denuncia')">&nbsp;
					<input  type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','reclamo_denuncia')">&nbsp;
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