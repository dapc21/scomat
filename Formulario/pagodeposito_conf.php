<?php require_once "procesos.php"; 
$ini_u = $_SESSION["ini_u"];
$login = $_SESSION["login"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CONFIRMAR PAGO DEPOSITO')))
{
?>
<BR><div class="cabe"><?php echo _("CONFIRMAR DEPOSITOS");?></div>
<form name="f1" action="javascript:;">
<table border="0" width="97%" align="CENTER" > 

 <tr>
  <td align="right">
  <fieldset >
	  <legend ><?php echo _("busqueda de pagos registrados");?></legend>
		<table border="0" width="95%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td>
				<span class="fuente"><?php echo _("franquicia");?></span>
			</td>
			<td>
				<select name="id_franq" id="id_franq" style="width: 146px;" onchange="buscar_confir_dep()">
					<?php echo verFranquicia($acceso);?>
				</select>
				
			</td>
			
			<td>
				<span class="fuente">banco
				</span>
			</td>
			<td colspan='3'>
				<select name="banco" id="banco" onchange="buscar_confir_dep()" style="width: 146px;">
					<?php echo verbancoEmp($acceso);?>
				</select>
				<a href="javascript:addCampo('banco','banco')" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Nuevo7','','imagenes/addba.png',7)" title="Agregar Banco"><img src="imagenes/addb.png" name="Nuevo7" width="20" height="20" border="0" id="Nuevo7" ></a>
			</td>
			
			<td>
				<span class="fuente">status
				</span>
				<select name="status_pd" id="status_pd" onchange="buscar_confir_dep()">
					<option value="REGISTRADO">REGISTRADO</option>
					<option value="NEGADO">NEGADO</option>
				</select>
				<a href="javascript:addCampo('banco','banco')" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Nuevo7','','imagenes/addba.png',7)" title="Agregar Banco"><img src="imagenes/addb.png" name="Nuevo7" width="20" height="20" border="0" id="Nuevo7" ></a>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">tipo fecha
				</span>
			</td>
			<td>
				<select name="tipo_fecha" id="tipo_fecha" style="width: 146px;">
					<option value="fecha_reg">FECHA REGISTRO</option>
					<option value="fecha_dep">FECHA DEPOSITO</option>
				</select>
				
			</td>
			<td >
				<span class="fuente"><?php echo _("desde");?></span>
			</td>
			<td>
				<input type="text" name="desde" id="desde" maxlength="10" size="10" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hasta");?></span>
			</td>
			<td>
				<input type="text" name="hasta" id="hasta" maxlength="10" size="10" value="" >
			</td>
			<td width="38%">
				<input  type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_confir_dep()">&nbsp;
				<input  type="button" name="salir" onclick="conexionPHP('formulario.php','pagodeposito_conf')" value="<?php echo _("limpiar");?>">
			</td>
				<input  type="hidden" value="dato" name="registrar">
				<input  type="hidden" value="dato" name="modificar">
				<input  type="hidden" value="dato" name="eliminar">
		</tr>
		
		<tr>
			<td colspan="5">
				<span class="fuenteN">modificar datos
				</span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">numero referencia
				</span>
			</td>
			<td>
				<input  type="hidden" name="id_pd" maxlength="25" size="20" value="">
				<input  type="text" name="numero_ref" maxlength="25" size="20" value="" onchange="valida_num_ref()">
			</td>
			<td>
				<span class="fuente">monto
				</span>
			</td>
			<td>
				<input  type="text" name="monto_dep" maxlength="25" size="15" value="" >
			</td>
			<td colspan="3" >
				<input disabled type="button" name="modifi" value="<?php echo _("Modificar y Confirmar");?>" onclick="confirmarpagodeposito_mod()">&nbsp;
			</td>
		</tr>
		
		
	</table>
	</fieldset>
  </td>		
 </tr>
	
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("DEPOSITOS / TRANSFERENCIAS PENDIENTES POR CONFIRMAR");?></legend>
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