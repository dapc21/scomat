<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('comentario_cliente')))
{
?>
<BR><div class="cabe"><?php echo _("comentar clientes");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_comen" maxlength="5" size="20"onChange="validarcomentario_cliente()" value="<?php $acceso->objeto->ejecutarSql("select *from comentario_cliente ORDER BY id_comen desc"); echo verCodigo($acceso,"id_comen")?>">
		<input  type="hidden" name="id_persona" maxlength="10" size="20" value="" >
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("nro comentario");?>
				</span>
			</td>
			<td width="280px">
				<input  type="text" name="nro_comen" maxlength="5" size="20" value="<?php $acceso->objeto->ejecutarSql("select *from comentario_cliente ORDER BY nro_comen desc"); echo verNumero($acceso,"nro_comen")?>" onChange="validarcomentario_cliente()">
			</td>
			<td width="120px">
				<span class="fuente"><?php echo _("status");?>
				</span>
			</td>
			<td width="160px">
				<span class="fuente">
					<input  type="radio" name="status_comen" value="Activo"CHECKED><?php echo _("activo");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="status_comen" value="Inactivo"><?php echo _("inactivo");?>
				</span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("rif / cedula");?>
				</span>
			</td>
			<td>
				<input  type="text" name="cedula" maxlength="10" size="20" value="" onChange="validarcliente()">
			</td>
		
			<td>
				<span class="fuente"><?php echo _("nombre cliente");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="nombre" maxlength="30" size="20" value="" >
			</td>
		</tr>
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="fecha_comen" id="fecha_comen" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("hora");?></span>
			</td>
			<td>
				<input readonly type="text" name="hora_comen" maxlength="8" size="20" value="<?php echo date("H:i:s");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("comentario");?></span>
			</td>
			<td colspan="3">
				<textarea name="comentario" cols="95" rows="2"></textarea>
			</td>
		</tr>
		<tr>
			
		</tr>
	</table>
	</fieldset>
  </td>		
 </tr>
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','comentario_cliente')">&nbsp;
					<input  type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','comentario_cliente')">&nbsp;
					<input  type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','comentario_cliente')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','comentario_cliente')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
<tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("comentarios realizados");?></legend>
			<div id="datagrid" class="data"></div>			
	</fieldset>
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