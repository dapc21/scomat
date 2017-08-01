<?php 
	require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
	 
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CAJA')))
{

?>
<br>
<H3 align="center">
	<strong><?php echo _("administracion de personas");?>
	</strong>
</H3>
<form name="f1" >
	<table border="1" width="420px" align="CENTER" bordercolor="" > 
		<input  type="hidden" name="id_persona" maxlength="8" size="30" value="<?php $acceso->objeto->ejecutarSql("select *from persona  where (id_persona ILIKE '$ini_u%') ORDER BY id_persona desc"); echo $ini_u.verCo($acceso,"id_persona")?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("cedula");?>
				</span>
			</td>
			<td>
				<input  type="text" name="cedula" maxlength="8" size="30" value="" onChange="validarPersona()">
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
				<span class="fuente"><?php echo _("telefono");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telefono" maxlength="11" size="30" value="" >
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
				<?php
					if($obj->permisoIncluir($acceso,'Persona'))
						$incluir="button";
					else
						$incluir="hidden";
						
					if($obj->permisoModificar($acceso,'Persona'))
						$modificar="button";
					else
						$modificar="hidden";
					
					if($obj->permisoEliminar($acceso,'Persona'))
						$eliminar="button";
					else
						$eliminar="hidden";
					
					echo '<input  type="'.$incluir.'" name="registrar" value="'._("registrar").'" onclick="verificar(\'incluir\',\'Persona\')">&nbsp;
					<input  type="'.$modificar.'" name="modificar" value=" '._("modificar").'" onclick="verificar(\'modificar\',\'Persona\')">&nbsp;
					<input  type="'.$eliminar.'" name="eliminar" value="'._("eliminar").'" onclick="verificar(\'eliminar\',\'Persona\')">&nbsp;
					<input  type="button" name="salir" onclick="cerrarVenta()" value="'._("limpiar").'">
					';
				?>
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
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p>';
	}
?>