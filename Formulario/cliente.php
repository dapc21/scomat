<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CLIENTE')))
{
?>
<br>
<H3 align="center">
	<strong><?php echo _("administracion de cliente");?>
	</strong>
</H3>
<form name="f1" >
	<table border="1" width="500px" align="CENTER" bordercolor="" > 
		<input  type="hidden" name="id_persona" maxlength="10" size="30"onChange="validarcliente()" value="<?php $acceso->objeto->ejecutarSql("select id_persona from persona  where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc LIMIT 1 offset 0 "); echo $ini_u.verCodLong($acceso,"id_persona")?>">
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
				<span class="fuente"><?php echo _("nombre");?>
				</span>
			</td>
			<td>
				<input  type="text" name="nombre" maxlength="30" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("apellido");?>
				</span>
			</td>
			<td>
				<input  type="text" name="apellido" maxlength="30" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("celular");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telefono" maxlength="11" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("telefono");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telf_casa" maxlength="11" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("telefono adicional");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telf_adic" maxlength="11" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("email");?>
				</span>
			</td>
			<td>
				<input  type="text" name="email" maxlength="40" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" name="direc_adicional" maxlength="10" size="30" value="" >
		<input  type="hidden" name="numero_casa" maxlength="10" size="30" value="" >
			
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','cliente')">&nbsp;
					<input  type="<?php echo $obj->mo; ?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cliente')">&nbsp;
					<input  type="<?php echo $obj->el; ?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','cliente')">&nbsp;
					
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