<?php session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ordenes_tecnicos2')))
{

session_start();
						$id_fr = $_SESSION["id_franq"]; 
						$serie='';
						if($id_fr!='0'){
							$cons=" and  id_franq='$id_fr'";
							$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_fr'");
							$row=row($acceso);
							$serie= trim($row["serie"]);
						}
						else{
							$cons=" and  id_franq='1'";
						}
						
						$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos, contrato,vista_ubica where  ordenes_tecnicos.id_contrato = contrato.id_contrato and contrato.id_calle=vista_ubica.id_calle  ORDER BY num_o desc  LIMIT 1 offset 0 "); 
						$id_orden = verNumero($acceso,"id_orden");
?>
<BR><div class="cabe"><?php echo _("asignar ordenes a tecnicos");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER" > 
 
  <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("datos de la orden");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
			<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
			<input  type="hidden" name="status_con" maxlength="10" size="20" value="POR INSTALAR">
			<tr>
			<td>
				<span class="fuente"><?php echo _("nro de orden");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="id_orden" maxlength="12" size="20"onChange="validarordenes_tecnicos()" value="<?php echo $id_orden;?>">
			</td>
		
			<td>
				<span class="fuente"><?php echo _("tecnico");?>
				</span>
			</td>
			<td>
				<select disabled name="id_persona" id="-1" onchange="" style="width: 146px;">
					<?php echo utf8_decode(verTecnicos($acceso));?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("tipo de orden");?>
				</span>
			</td>
			<td>
				<select disabled name="id_tipo_orden" id="id_tipo_orden" onchange="" style="width: 146px;">
					<?php echo utf8_decode(verTipoOrdenFalla($acceso));?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("detalle orden");?></span>
			</td>
			<td>
				<select name="id_det_orden" id="id_det_orden" onchange="" style="width: 146px;">
					<?php echo verDetalleOrdenFalla($acceso);?>
				</select>
			</td>
		</tr>
		
		<input  type="hidden" name="fecha_orden" id="fecha_orden" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
		<input  type="hidden" name="fecha_final" id="fecha_final" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
		
		
		<input  type="hidden" value="CREADO" name="status_orden">
		<input  type="hidden" value="" name="comentario_orden">
		<input  type="hidden" value="" name="detalle_orden">
		<input  type="hidden" value="NORMAL" name="prioridad">
		</table>
				
	</fieldset>
  </td>		
 </tr>
  
 <tr>
			<td colspan="1" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','asig_orden')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','asig_orden')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','ordenes_tecnicos')">&nbsp;
					
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