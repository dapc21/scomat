<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('actualizar_pagos')))
{

?>
<BR><div class="cabe"><?php echo _("actualizacion de pagos de clientes");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos del cliente");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
		<tr>
			<td>
				<span class="fuente"><?php echo _("nro abonado");?>
				</span>
			</td>
			<td>
				<input  type="text" name="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="" >
				<a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a>
			</td>
			<td>
				<span class="fuente"><?php echo _("rif / cedula");?></span>
			</td>
			<td valign="button">
				<input  type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula()">
				<a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a>
			</td>
				
			<td colspan="2">
				<a href="#" onclick="abrirBusq_cont_avanz()" ><img src="imagenes/busAvanz1.png" width="150px" height="25px" title="Busqueda Avanzada"></a>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("nombre");?></span>
			</td>
			<td>
				<input readonly type="text" name="nombre" maxlength="30" size="15" value="" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("apellido");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="apellido" maxlength="30" size="15" value="" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("celular");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="telefono" maxlength="11" size="15" value="" >
			</td>
		
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("zona");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="id_zona" maxlength="11" size="15" value="" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("sector");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="id_sector" maxlength="11" size="15" value="" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("calle");?></span>
			</td>
			<td>
				<input readonly type="text" name="id_calle" maxlength="11" size="15" value="" >
			</td>
		
			
		</tr>
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha contrato");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="fecha_contrato" id="fecha_contrato" maxlength="10" size="15" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("precinto");?></span>
			</td>
			<td>
				<input readonly type="text" name="etiqueta" maxlength="15" size="15" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("status");?></span>
			</td>
			<td>
				<input type="hidden" name="status_contrato" maxlength="15" size="15" value="" >
			</td>
			
		</tr>
		
	</table>
				
	</fieldset>
  </td>		
 </tr>
  <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("cargos pendientes");?></legend>
		<table border="1" width="97%" align="CENTER" bordercolor="" > 
		<input  type="hidden" name="id_cont_serv" maxlength="12" size="15"onChange="validarcontrato_servicio()" value="<?php $acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); echo $ini_u.verCodLong($acceso,"id_cont_serv")?>">
		<input  type="hidden" name="fecha_inst" id="fecha_inst" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
		<input  type="hidden" name="cant_serv" maxlength="2" size="15" value="1" >
		<tr>
			<td>
				<span class="fuente"><?php echo _("seleccione el campo a modificar");?>
				</span>
			</td>
			
		</tr>
		<tr>			
			<td >
				<div id="datagrid" class="data">
				</div>			
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
					<input disabled type="<?php echo $obj->in; ?>" name="registrar" value="REGISTRAR COBRO" onclick="verificar('incluir','pagos')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','pagos')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','pagos')">&nbsp;
					<input  type="reset" name="salir" onclick="" value="<?php echo _("limpiar");?>">
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