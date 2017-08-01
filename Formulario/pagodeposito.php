<?php require_once "procesos.php";
session_start();
$ini_u = $_SESSION["ini_u"];  
$login = $_SESSION["login"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{
?>
<BR><div class="cabe"><?php echo _("REGISTRO DE DEPOSITOS");?></div>
<form name="f1" action="javascript:;">
<table border="0" width="97%" align="CENTER" > 

 <tr>
  <td align="right">
 
	<fieldset >
	  <legend ><?php echo _("datos del cliente");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="2" cellspacing="2" > 
		<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
		
		<input  type="hidden" name="caja_externa" maxlength="10" size="15" value="<?php echo $caja_externa; ?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("nro abonado");?></span> 
			</td>
			<td>
				<input  type="text" name="nro_contrato" onChange="validarcontrato_todo()" maxlength="11" size="15" value="<?php ?>" >
				<a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a>
			</td>
			<td>
				<span class="fuente"><?php echo _("rif / cedula");?></span>
			</td>
			<td valign="button">
				<input  type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula_todo()">
				<a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a>
			</td>
				
			<td colspan="2">
				<a href="#" onclick="abrirBusq_cont_avanz_todo()" ><img src="imagenes/busAvanz1.png" width="150px" height="25px" title="Busqueda Avanzada"></a>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("tipo cliente");?>
				</span>
			</td>
			<td >
				<select DISABLED name="tipo_cliente" id="tipo_cliente" onchange="activa_tipo_c()" style="width: 90px;">
					<option value="NATURAL"><?php echo _("natural");?></option>
					<option value="JURIDICO"><?php echo _("juridico");?></option>
				</select>
				<select disabled name="inicial_doc" id="inicial_doc" onchange="" style="width: 37px;">
					<option value="V"><?php echo _("V");?></option>
					<option value="J"><?php echo _("J");?></option>
					<option value="E"><?php echo _("E");?></option>
					<option value="G"><?php echo _("G");?></option>
				</select>
			</td>
			<td >
				<span class="fuente"><?php echo _("razon social");?>
				</span>
			</td>
			<td colspan="3">
				<input disabled type="text" name="empresa" maxlength="30" style="width: 295px;" value="">
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
				<span class="fuente"><?php echo _("nro casa");?>
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
				<input class="resaltado" readonly type="text" name="status_contrato" maxlength="15" size="15" value="" >
			</td>
			<input type="hidden" name="status_pago" maxlength="15" size="15" value="PAGADO" >
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("contrato fisico");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="contrato_fisico" maxlength="11" size="15" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("referencia");?>
				</span>
			</td>
			<td colspan="3">
				<textarea disabled name="direc_adicional" style="width: 500px;height: 22px;" onkeypress=" return limita(this, event,100)" rows="1"></textarea>
			</td>
		</tr>
	</table>
	</fieldset>
  </td>		
 </tr>
	
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos DEL deposito / transferencia");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_pd" maxlength="8" size="30"onChange="validarpagodeposito()" value="<?php $acceso->objeto->ejecutarSql("select *from pagodeposito  where (id_pd ILIKE '$ini_u%') ORDER BY id_pd desc"); echo $ini_u.verCoo($acceso,"id_pd"); ?>">
		
		<input  type="hidden" name="fecha_reg" id="fecha_reg" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
		<input  type="hidden" name="hora_reg" maxlength="8" size="30" value="<?php echo date("H:i:s");?>" >
		<input  type="hidden" name="login_reg" maxlength="25" size="30" value="<?php echo $login;?>" >
		<input  type="hidden" name="fecha_conf" id="fecha_conf" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
		<input  type="hidden" name="hora_conf" maxlength="8" size="30" value="<?php echo date("H:i:s");?>" >
		<input  type="hidden" name="login_conf" maxlength="25" size="30" value="<?php echo $login;?>" >
		<input  type="hidden" name="status_pd" maxlength="15" size="30" value="REGISTRADO" >
		<input  type="hidden" name="fecha_proc" id="fecha_proc" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
		<input  type="hidden" name="login_proc" maxlength="25" size="30" value="<?php echo $login;?>" >
		<input  type="hidden" value="dato" name="dato">
		<tr><td>
				<span class="fuente">cuenta bancaria
				</span>
			</td>
			<td>
				<select name="banco" id="banco" onchange="" style="width: 182px;">
					<?php echo vercuenta_bancaria($acceso);?>
				</select>
				
			</td>
			<td>
				<span class="fuente">fecha
				</span>
			</td>
			<td>
				<input  type="text" name="fecha_dep" id="fecha_dep" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente">numero referencia
				</span>
			</td>
			<td>
				<input  type="text" name="numero_ref" maxlength="25" size="30" value="" onchange="valida_num_ref()">
			</td>
			<td>
				<span class="fuente">monto
				</span>
			</td>
			<td>
				<input  type="text" name="monto_dep" maxlength="25" size="30" value="" >
			</td>
		</tr>
		
		<tr>
			
			<td>
				<span class="fuente">cedula titular 
				</span>
			</td>
			<td>
				<input  type="text" name="cedula_titular" maxlength="25" size="30" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("tipo");?></span>
			</td>
			<td>
				<span class="fuente"><?php echo _("DEPOSITO");?>
					<input  type="radio" name="tipo_dt" value="DEPOSITO"CHECKED>&nbsp;&nbsp;&nbsp;
					<?php echo _("TRANSFERENCIA");?>
					<input  type="radio" name="tipo_dt" value="TRANSFERENCIA">
				</span>
			</td>
		</tr>
		<tr>
			
			<td>
				<span class="fuente"><?php echo _("observacion");?>
				</span>
			</td>
			<td colspan="3">
				<textarea name="obser_p" rows="1" style="width: 550px; height:24px;" maxlength="255"></textarea>
			</td>
		</tr>
		
		</table>
		</fieldset>
</td>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','pagodeposito')">&nbsp;
					<input  type="<?php echo $obj->mo; ?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','pagodeposito')">&nbsp;
					<input  type="<?php echo $obj->el; ?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','pagodeposito')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','pagodeposito')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
		
 <tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("calles agregadas");?></legend>
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