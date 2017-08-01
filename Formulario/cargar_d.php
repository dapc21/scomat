<?php  
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CARGAR_DEUDA1')))
{
?>
<BR><div class="cabe"><?php echo _("cargar deuda");?></div>
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
				<span class="fuente"><?php echo _("status");?></span>
			</td>
			<td>
				<input readonly type="text" name="status_pago" maxlength="15" size="15" value="" >
			</td>
	</table>
	</fieldset>
  </td>		
 </tr>
 
 <tr>
  <td>
  <BR>
	<fieldset >
	  <legend ><?php echo _("datos de la deuda a cargar");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
			<tr>
			<td width="110px">
				<span class="fuente"><?php echo _("tipo de cargo");?></span>
			</td>
			<td>
				<span class="fuente">
					<input  type="radio" name="tipo_costo" value="COSTO MENSUAL" CHECKED onchange="activa_serv_cargo()"><?php echo _("mensual");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="tipo_costo" value="COSTO UNICO"  onchange="activa_serv_cargo()"><?php echo _("unico");?>
				</span>
			</td>
		</tr>
		<div id="tipoCargo">
		<tr>
			<td>
				<span class="fuente"><?php echo _("servicio");?></span>
			</td>
			<td>
				<select disabled name="id_serv" id="id_serv" onchange="traercs()" style="width: 206px;">
					<?php echo utf8_decode(verServiciosCostoU($acceso));?>
				</select>
				<input disabled type="text" name="costo" maxlength="10" size="10" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("mes");?></span>
			</td>
			<td>
				<select name="mes" id="mes" onchange="" style="width: 146px;">
					<?php echo verMesCorte();?>
				</select>
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
					<input  type="<?php echo $obj->in; ?>" name="registrar" value=<?php echo _("cargar deuda");?> onclick="verificar('cargar','cargar_d')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','ordenes_tecnicos')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','ordenes_tecnicos')">&nbsp;
					
				</div>
			</td>
	</tr>
	<tr>
			<td colspan="1" rowspan="1">
				<div id="datagrid" class="data">
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