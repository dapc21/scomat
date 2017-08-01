<?php session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('final_ordenes_tecnicos')))
{
?>
<BR><div class="cabe"><?php echo _("administrar visitas a las ordenes de servicios");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER" > 
 
  <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("datos de la visita");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
			<input  type="hidden" name="id_visita" maxlength="10" size="15" value="<?php $acceso->objeto->ejecutarSql("select *from visitas  where (id_visita ILIKE '$ini_u%') ORDER BY id_visita desc"); echo $ini_u.verCo($acceso,"id_visita")?>">
			<tr>
			<input disabled type="hidden" name="id_orden" maxlength="12" size="20"onChange="validarordenes_tecnicos()" value="<?php $acceso->objeto->ejecutarSql("select *from ordenes_tecnicos ORDER BY id_orden desc"); echo verNumero($acceso,"id_orden")?>">
			
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input  type="text" name="fecha_visita" id="fecha_visita" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hora");?>
				</span>
			</td>
			<td>
				<input  type="text" name="hora" id="hora" maxlength="5" size="20" value="<?php echo date("H:i");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("observacion");?>
				</span>
			</td>
			<td colspan="3">
				<textarea name="comenta_visita" style="width: 500px;" rows="3"></textarea>
			</td>
		</tr>
		
		</table>
				
	</fieldset>
  </td>		
 </tr>
  
 <tr>
			<td colspan="1" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','visitas')">&nbsp;
					<input disabled type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','visitas')">&nbsp;
					<input disabled type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','visitas')">&nbsp;
					
				</div>
			</td>
	</tr>
<tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("visitas agregadas para esta orden");?></legend>
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