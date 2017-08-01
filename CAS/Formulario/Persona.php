<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  ?>
<BR><div class="cabe"><?php echo _("administracion de motivo de notas de credito/debito");?></div>


<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="HIDDEN" name="idmotivonota" maxlength="8" size="30"onChange="validarmotivonotas()" value="<?php $acceso->objeto->ejecutarSql("select *from motivonotas  where (idmotivonota ILIKE '$ini_u%') ORDER BY idmotivonota desc"); echo $ini_u.verCo($acceso,"idmotivonota")?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("nombre motivo");?>
				</span>
			</td>
			<td>
				<input  type="text" name="nombremotivonota" maxlength="50" size="30" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("status");?>
				</span>
			</td>
			<td>
				<span class="fuente"><?php echo _("activo");?>
					<input  type="radio" name="status" value="<?php echo _("activo");?>"CHECKED>&nbsp;&nbsp;&nbsp;<?php echo _("inactivo");?>
					<input  type="radio" name="status" value="<?php echo _("inactivo");?>">
				</span>
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
	</table>
				
	</fieldset>
  </td>		
 </tr>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_cas('incluir','motivonotas')">&nbsp;
					<input  type="button" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_cas('modificar','motivonotas')">&nbsp;
					<input  type="button" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_cas('eliminar','motivonotas')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_cas('formulario.php','motivonotas')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
<tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("motivos agregados");?></legend>
			<div id="datagrid" class="data"></div>			
	</fieldset>
  </td>		
 </tr>
</table>
</form>