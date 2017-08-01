<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('status_contrato')))
{
?>
<BR><div class="cabe"><?php echo _("impresion de facturas en lotes");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER" > 
 
 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("con deuda");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		
		<tr>
			
			<input  type="hidden" name="desde" value="2006-01-01">
			<td>
				<span class="fuente"><?php echo _("mes");?>
				</span>
			</td>
			<td>
				<select name="hasta" id="hasta" onchange="cargarSector()" style="width: 200px;">
					<?php echo verMesCorte();?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("factura inicial");?></span>
			</td>
			<td>
				<input  type="text" name="deuda" id="deuda"  maxlength="10" size="5" value="0">
			</td>
			<td>
				<span class="fuente"><?php echo _("tipo");?>
				</span>
			</td>
			<td>
				<select name="tipo" id="tipo" onchange="cargarSector()" style="width: 40px;">
					<option value=""><?php echo _("P");?></option>
				</select>
			</td>
		</tr>
		
	</table>

	</fieldset>
  </td>		
 </tr>
 
 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("por ubicaci&oacute;n");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("franquicia");?></span>
			</td>
			<td>
				<select name="id_franq" id="id_franq" onchange="cargarZona()" style="width: 146px;">
					<?php echo verFranquicia($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("zona");?>
				</span>
			</td>
			<td>
				<select name="id_zona" id="id_zona" onchange="cargarSector()" style="width: 150px;">
					<?php echo verZona($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
		
			<td>
				<span class="fuente"><?php echo _("sector");?>
				</span>
			</td>
			<td>
				<select name="id_sector" id="id_sector" onchange="traerZona()" style="width: 146px;">
					<?php echo verSector($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("calle");?></span>
			</td>
			<td>
				<select name="id_calle" id="id_calle"  onchange="traerSector()" style="width: 146px;">
					<?php echo verCalle($acceso);?>
				</select>
			</td>
		
		</tr>

	</table>

	</fieldset>
  </td>		
 </tr>


		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_imp_fact_lotes()">&nbsp;
					<input disabled type="button" name="modificar" value="<?php echo _("imprimir facturas seleccionadas");?>" onclick="imprimir_fact_sel()">&nbsp;
					<input disabled type="HIDDEN" name="eliminar" value="<?php echo _("guardar listado");?>" onclick="guardar_cortar_servicio()">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','status_contrato')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
<tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("clientes con deuda");?></legend>
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