<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('anular_pagos')))
{

$fecha= date("Y-m-d");
$id_persona=$_SESSION["id_persona"];
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");
/*
if($acceso->objeto->registros<=0)
	echo '<div class="error"><br>Error, No tiene un punto de Cobro Abierto, debe abrir un punto de cobro.</div>';
else{
*/
	$row=row($acceso);
	$id_caja_cob=trim($row['id_caja_cob']);
	$nombre=trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"]);
?>
<BR><div class="cabe"><?php echo _("nota de credito");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER"> 

 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("a la factura");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
			<input  type="hidden" name="id_pago" maxlength="15" size="10"onChange="validarpagos()" value="">
		<tr>	
			<td>
				<span class="fuente"><?php echo _("nro factura");?>
				</span>
			</td>
			<td>
				<input type="text" name="nro_factura" onChange="validarpagos()" maxlength="10" size="15" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("punto de cobro");?></span>
			</td>
			<td>
				<select readonly name="id_caja_cob" id="id_caja_cob" onchange="" style="width: 330px;">
					<?php echo verPuntoC($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input readonly  type="text" name="fecha_pago" id="fecha_pago" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hora");?>
				</span>
			</td>
			<td>
				<input readonly  type="text" name="hora_pago" maxlength="8" size="15" value="<?php echo date("H:i:s");?>" >
			</td>
		</tr>
		<tr>
			
			<td>
				<span class="fuente">F<?php echo _("forma de pago");?></span>
			</td>
			<td>
				<select  readonly name="id_tipo_pago" id="id_tipo_pago" onchange="cargarDetTipoPago()" style="width: 116px;">
					<?php echo verTipoPago($acceso);?>
				</select>
			</td>
			<td colspan="2">
				<span class="fuente"><?php echo _("banco");?></span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<select readonly name="banco" id="banco"  onchange="" style="width: 110px;">
					<?php echo verBanco($acceso);?>
				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="fuente"><?php echo _("numero");?></span>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input readonly type="text" name="numero" maxlength="25" size="15" value="" >
				<input  type="hidden" value="" name="obser_detalle">
			</td>
		</tr>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("monto pago");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="monto_pago" maxlength="10" size="15" value="0" >
			</td>
		
			<td valign="center">
				<span class="fuente"><?php echo _("observacion");?>
				</span>
			</td>
			<td >
				<textarea  readonly name="obser_pago" style="width: 330px;" rows="1"></textarea>
			</td>
		</tr>
		
		<input  type="hidden" value="dato" name="dato">
		</table>
				
	</fieldset>
  </td>		
 </tr>
 


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
				<input  readonly type="text" name="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("rif / cedula");?></span>
			</td>
			<td valign="button">
				<input  readonly type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula()">
				
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
		<!--
		<tr>
			<td>
				<span class="fuente">Zona
				</span>
			</td>
			<td>
				<input readonly type="text" name="id_zona" maxlength="11" size="15" value="" >
			</td>
		
			<td>
				<span class="fuente">Sector
				</span>
			</td>
			<td>
				<input readonly type="text" name="id_sector" maxlength="11" size="15" value="" >
			</td>
		
			<td>
				<span class="fuente">Calle</span>
			</td>
			<td>
				<input readonly type="text" name="id_calle" maxlength="11" size="15" value="" >
			</td>
		
			
		</tr>
		-->
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
				<input readonly type="text" name="status_contrato" maxlength="15" size="15" value="" >
			</td>
			<input type="hidden" name="status_pago" maxlength="15" size="15" value="PAGADO" >
		</tr>
		
	</table>
				
	</fieldset>
  </td>		
 </tr>
 
 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("cargos pagados");?></legend>
		<table border="1" width="97%" align="CENTER" bordercolor="" > 
		<input  type="hidden" name="id_cont_serv" maxlength="12" size="15"onChange="validarcontrato_servicio()" value="<?php $acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); echo $ini_u.verCodLong($acceso,"id_cont_serv")?>">
		<input  type="hidden" name="fecha_inst" id="fecha_inst" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
		<input  type="hidden" name="cant_serv" maxlength="2" size="15" value="1" >
		
		<tr>			
			<td colspan="2" rowspan="1">
				<div id="datagrid" class="data">
						<input  type="hidden" name="total_reg_data" value="0">
					</div>		
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
					<input readonly type="hidden" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('nota_de_credito','pagos')">&nbsp;
					<input  type="<?php echo $obj->mo; ?>" name="modificar" value="<?php echo _("registrar nota de credito");?>" onclick="verificar('nota_de_credito','anular_pagos')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','pagos')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','nota_de_credito')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
</table>
<!--
<div id="a_tabbar" style="width:395px; height:390px;"/>
<div id='html_1'><img src="include/dhtmlx/commonTabbar/page_a.gif"></div>
<div id='html_2'><img src="include/dhtmlx/commonTabbar/page_b.gif"></div>
-->

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