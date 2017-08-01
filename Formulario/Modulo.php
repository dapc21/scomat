<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('MODULO')))
{
			
$acceso->objeto->ejecutarSql(sql("modulo ORDER BY codigomodulo desc"));	
?>
<br>
<H3 align="center">
	<strong><?php echo _("administracion de modulos de perfiles");?>
	</strong>
</H3>
<form name="f1" >
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<tr>
			<td>
				<span class="fuente"><?php echo _("codigo");?></span>
			</td>
			<td>
				<input  type="text" name="codigo" maxlength="7" size="25"onChange="validarModulo()" value="<?php $acceso->objeto->ejecutarSql(sql("modulo ORDER BY codigomodulo desc")); echo "MODU".verCodigo($acceso,"codigomodulo")?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("nombre");?></span>
				<input  type="text" name="nombre" maxlength="25" size="25" value="" > <!-- onChange="asignaNameModulo()"-->
			</td>
			<td>
				<span class="fuente">name</span>
				<input  type="text" name="name" value="" maxlength="20" size="25" >
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1">
				<label>
					<strong>
						<span class="fuente"><?php echo _("descripcion");?></span>
					</strong>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1">
				<textarea name="descripcion" cols="46" rows="3"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="datagrid" type="checkbox" value=""> <span class="fuente"><?php echo _("agregar datagrid al formulario");?></span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("status");?></span>
			</td>
			<td>
				<span class="fuente"><?php echo _("activo");?>
				<input  type="radio" name="status" value="Activo" CHECKED><?php echo _("inactivo");?>
				<input  type="radio" name="status" value="Inactivo"></span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">
				<strong><?php echo _("asignar a los perfiles");?>
				</strong></span>
			</td>
			<td align="center">
				<span class="fuente">
				<strong><?php echo _("operaciones");?>
				</strong></span>
			</td>
		</tr>
		<?php echo modulos($acceso)?>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','Modulo')">&nbsp;
					<input  type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','Modulo')">&nbsp;
					<input  type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','Modulo')">&nbsp;
					<input  type="button" name="salir" onclick="cerrarVenta()" value="<?php echo _("limpiar");?>">
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