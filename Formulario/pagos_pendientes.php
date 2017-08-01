<?php session_start();require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
$login= $_SESSION["login"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PAGOSFRANQUICIA')))
{
?>
<BR><div class="cabe"><?php echo _("PAGOS PENDIENTES");?></div>
<form name="f1" action="javascript:;">
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		
				<input  type="hidden" name="id_esta" maxlength="8" size="30"onChange="validarestado()" value="<?php $acceso->objeto->ejecutarSql("select *from estado  where (id_esta ILIKE '$ini_u%') ORDER BY id_esta desc LIMIT 1 offset 0"); echo $ini_u.verCoo($acceso,"id_esta")?>">
		<tr>
			<td >
				<span class="fuente"><?php echo _("franquicia");?>
				</span>
			</td>
			<td >
				<select name="id_franq" id="id_franq" onchange="valida_nom_restado()" style="width: 206px;">
					<?php echo verFranquicia($acceso);?>
				</select>
			</td>
			
			<td>
				<span class="fuente">status
				</span>
			</td>
			<td>
				
				<select name="status_df" id="status_df" onchange="" style="width: 206px;">
					<option value="0">TODOS</OPTION>
					<option value="REGISTRADO">REGISTRADO</OPTION>
					<option value="PAGADO">PAGADO</OPTION>
				</select>
			</td>
		</tr>
		<tr>	
			<td>
				<span class="fuente">fecha desde</span>
			</td>
			<td>
				<input  type="text" name="fecha_desde_ctb" id="fecha_desde_ctb" maxlength="10" size="30" value="<?php //echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"> hasta
				</span>
			</td>
			<td >
				<input  type="text" name="fecha_hasta_ctb" id="fecha_hasta_ctb" maxlength="10" size="30" value="<?php //echo date("d/m/Y");?>" >
			</td>
		</tr>
		
		</table>
		</fieldset>
</td>		
 </tr>		
 </tr>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="BUSCAR" onclick="buscar_pagos_pend()">&nbsp;
					
					<input  type="HIDDEN" name="modificar" value="MODIFICAR" onclick="verificar('modificar','detalle_tipopago_df')">&nbsp;
					<input  type="HIDDEN" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','detalle_tipopago_df')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','pagos_pendientes')" value="<?php echo _("ACTUALIZAR");?>">
				</div>
			</td>
		</tr>
		
 <tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("detalle DE LOS PAGOS PENDIENTES");?></legend>
			<div id="datagrid" class="data">
		
		
			</div>			
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

