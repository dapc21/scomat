<?php 
	require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PERFIL')))
{
?>
<BR><div class="cabe"><?php echo _("CONSULTAS PREDETERMINADAS");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("consultas definidas");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
					<input  type="hidden" name="registrar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cobrador')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cobrador')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','cobrador')">&nbsp;
					
			
		<tr>
			<td width="20%">
				<input style="width: 400px;" type="button" name="registrar" value="CLIENTES CON MAS DE UN CONTRATO" onclick="ejecutar_consulta_pred('cliente_con_repedito')">
			</td>
			<td align="left">
				<span class="fuenteNormal"><?php echo _("Permite visualizar clientes que poseen mas de un contrato");?></span>
			</td>
		</tr>
			
		<tr>
			<td width="20%">
				<input style="width: 400px;" type="button" name="registrar" value="saldo negativo en sistema boxi" onclick="ejecutar_consulta_pred('cliente_con_saldo_negativo_boxi')">
			</td>
			<td align="left">
				<span class="fuenteNormal"><?php echo _("Permite visualizar clientes que tenian saldo a favor en boxi");?></span>
			</td>
		</tr>
		<tr>
			<td width="20%">
				<input style="width: 400px;" type="button" name="registrar" value="clientes con doble reconexion" onclick="ejecutar_consulta_pred('clientes_con_doble_reconexion')">
			</td>
			<td align="left">
				<span class="fuenteNormal"><?php echo _("clientes con doble reconexion");?></span>
			</td>
		</tr>
		<tr>
			<td width="20%">
				<input style="width: 400px;" type="button" name="registrar" value="clientes activos sin suscripcion activa" onclick="ejecutar_consulta_pred('clientes_activos_sin_suscripcion_activa')">
			</td>
			<td align="left">
				<span class="fuenteNormal"><?php echo _("clientes activos sin suscripcion activa");?></span>
			</td>
		</tr>
		<tr>
			<td width="20%">
				<input style="width: 400px;" type="button" name="registrar" value="clientes activos sin suscripcion mensual" onclick="ejecutar_consulta_pred('clientes_sin_suscripcion_mensual')">
			</td>
			<td align="left">
				<span class="fuenteNormal"><?php echo _("clientes activos sin suscripcion mensual");?></span>
			</td>
		</tr>
		<tr>
			<td width="20%">
				<input style="width: 400px;" type="button" name="registrar" value="clientes con deuda mayor a tarifa mensual" onclick="ejecutar_consulta_pred('deuda_mayor_a_tarifa_mensual')">
			</td>
			<td align="left">
				<span class="fuenteNormal"><?php echo _("lientes con deuda mayor a tarifa mensual");?></span>
			</td>
		</tr>
		<tr>
			<td width="20%">
				<input style="width: 400px;" type="button" name="registrar" value="CLIENTES POR GENERAR DEUDA" onclick="ejecutar_consulta_pred('clientes_por_generar_deuda')">
			</td>
			<td align="left">
				<span class="fuenteNormal"><?php echo _("CLIENTES POR GENERAR DEUDA MENSUAL");?></span>
			</td>
		</tr>
		<tr>
			<td width="20%">
				<input style="width: 400px;" type="button" name="registrar" value="CLIENTES CON DEUDA Y POR PAGAR" onclick="ejecutar_consulta_pred('clientes_con_deuda_por_pagar')">
			</td>
			<td align="left">
				<span class="fuenteNormal"><?php echo _("CLIENTES CON DEUDA Y POR PAGAR");?></span>
			</td>
		</tr>
		
		</table>
<tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("resultado DE consulta");?></legend>
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