<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('FAMILIA'))){

?>
<BR><div class="cabe"><?php echo _("configuracion de materiales");?></div>
<form name="f1" action="javascript:func_vacia()">
<input  type="hidden" name="id_c_mat" id="id_c_mat" maxlength="10" size="30"onChange="validarentidad()" value="<?php $acceso->objeto->ejecutarSql("select *from config_mat  where (id_c_mat ILIKE '$ini_u%') ORDER BY id_c_mat desc"); echo $ini_u.verCodigo($acceso,"id_c_mat")?>">
<table border="0" width="97%" align="CENTER" > 
	<tr>
		<td>
			<fieldset >
			  <legend ><?php echo _("datos a configurar");?></legend>				
				<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
					<tr>
						<td >
							<span class="fuente"><?php echo _("franquicia");?></span>
						</td>
						<td >
							<select name="id_franq" id="-1" onchange="" style="width: 150px;">
								<?php echo verFranquicia($acceso);?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<span class="fuente"><?php echo _("habilitar alerta de stock minimo");?>
							</span>
						</td>
						<td>
							<select name="hab_alerta_min" id="hab_alerta_min"  style="width: 150px">
								<option value="F">DESABILITADO</option>
								<option value="T">HABILITADO</option>
							</select>
						</td>
					</tr>
					</tr>
						<td>
							<span class="fuente"><?php echo _("habilitar descuento de almacen de grupo");?>
							</span>
						</td>
						<td>
							<select name="hab_desc_alm_gru" id="hab_desc_alm_gru"  onchange="hab_alm_gen()" style="width: 150px">
								<option value="F">DESABILITADO</option>
								<option value="T">HABILITADO</option>
							</select>
						</td>
					</tr>
					</tr>
						<td>
							<span class="fuente"><?php echo _("habilitar descuento de almacen especifico");?>
							</span>
						</td>
						<td>
							<select name="hab_desc_alm_gen" id="hab_desc_alm_gen" onchange="habilitaDep()" style="width: 150px">
								<option value="F">DESABILITADO</option>
								<option value="T">HABILITADO</option>
							</select>
						</td>
					</tr>
					</tr>
						<td>
							<span class="fuente"><?php echo _("seleccione almacen general a descontar");?>
							</span>
						</td>
						<td>
							<select disabled name="id_deposito" id="id_deposito" style="width: 150px;">
								<?php echo verDeposito($acceso);?>
							</select>
						</td>
					</tr>
					</tr>
						<td>
							<span class="fuente"><?php echo _("habilitar solo registro de materiales en ordenes");?>
							</span>
						</td>
						<td>
							<select name="hab_mat_orden" id="hab_mat_orden"  onchange="hab_alm_ord()"  style="width: 150px">
								<option value="F">DESABILITADO</option>
								<option value="T">HABILITADO</option>
							</select>
						</td>
					</tr>
					</tr>
						<td>
							<span class="fuente"><?php echo _("habilitar impresion de materiales en las ordenes");?>
							</span>
						</td>
						<td>
							<select name="hab_imp_mat" id="hab_imp_mat" " style="width: 150px">
								<option value="F">DESABILITADO</option>
								<option value="T">HABILITADO</option>
							</select>
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
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','config_mat')">&nbsp;
					<input  type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','config_mat')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','config_mat')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP_mat('formulario.php','config_mat')" value="<?php echo _("limpiar");?>">
			</div>
		</td>
	</tr>
	
<tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("configuraciones agregadas");?></legend>
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