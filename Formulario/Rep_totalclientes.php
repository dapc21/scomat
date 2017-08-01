<?php 
	session_start();
require_once "procesos.php";$ini_u = $_SESSION["ini_u"];  
$id_franq = $_SESSION["id_franq"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('Rep_totalclientes')))
{


?>

<BR><div class="cabe"><?php echo _("reporte de todos los clientes");?></div>
<form name="f1" >
<input  type="hidden" value="<?php echo $id_franq;?>" name="id_f">
<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	
	<fieldset >
	  <legend ><?php echo _("por ubicacion");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td colspan="4" >
				<span class="fuente">
					<input  type="radio" name="status_serv" value="GENERAL"CHECKED onchange="hab_total_cli_ubi()"><?php echo _("general");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="status_serv" value="ESPECIFICO"  onchange="hab_total_cli_ubi()"><?php echo _("especifico");?>
				</span>
			</td>
		</tr>
		<tr>	
			<td width="150px">
				<span class="fuente"><?php echo _("franquicia");?></span>
			</td>
			<td width="300px">
				<select disabled name="id_franq" id="id_franq" onchange="cargarZona()" style="width: 146px;">
					<?php echo verFranquicia($acceso);?>
				</select>
			</td>
			<td width="100px">
				<span class="fuente"><?php echo _("zona");?>
				</span>
			</td>
			<td width="150px">
				<select disabled name="id_zona" id="id_zona" onchange="cargarSector()" style="width: 146px;">
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
				<select disabled name="id_sector" id="id_sector" onchange="traerZona()" style="width: 146px;">
					<?php echo verSector($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("calle");?></span>
			</td>
			<td>
				<select disabled name="id_calle" id="id_calle"  onchange="traerSector()" style="width: 146px;">
					<?php echo verCalle($acceso);?>
				</select>
			</td>
		
		</tr>
	</table>
	</fieldset>
	</td>
</tr>

 <tr>
  <td>
	<BR>
	<fieldset >
	  <legend ><?php echo _("por status");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("status contrato");?>
				</span>
			</td>
			<td >
				<select name="status_contrato" id="status_contrato"  style="width: 146px;">
					<option value=""><?php echo _("todos");?></option>
					<?php echo verStatusCont($acceso);?>
				</select>
			</td>
		</tr>
		
	</table>
	</fieldset>
	</td>
</tr>

<tr>
  <td>
	<BR>
	<fieldset >
	  <legend ><?php echo _("por fecha de inscripcion");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		<tr>
			<td colspan="4" >
				<span class="fuente">
					<input  type="radio" name="tipo_costo" value="GENERAL"CHECKED  onchange="hab_total_cli_fec()"><?php echo _("general");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="tipo_costo" value="ESPECIFICO" onchange="hab_total_cli_fec()"><?php echo _("especifico");?>
				</span>
			</td>
		</tr>
		<tr>
			<td >
				<span class="fuente"><?php echo _("desde");?></span>
			</td>
			<td>
				<input disabled type="text" name="desde" id="desde" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hasta");?></span>
			</td>
			<td>
				<input disabled type="text" name="hasta" id="hasta" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</td>
		</tr>
	</table>
	</fieldset>
	</td>
</tr>
	<tr>
			<td align="center">
				<input  type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_totalclientes()">&nbsp;
			</td>
	</tr>
<tr>
  <td>
	<br>
	<fieldset>
		<legend ><?php echo _("clientes encontrados");?></legend>
			<div id="datagrid">
					<input  type="hidden" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_totalclientes()">&nbsp;
					<input  type="hidden" name="modificar" value="CANCELAR">
					<input  type="hidden" name="eliminar" value="CANCELAR">
					<input  type="hidden" name="Resetear" value="CANCELAR">
			</div>			
	</fieldset>
  </td>		


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