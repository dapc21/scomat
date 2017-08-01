<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('COMANDO_SMS')))
{

 ?>


	<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			
			<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
			<script language="JavaScript" type="text/javascript" src="javascript/ajax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/validacionAjax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/controlador.js"></script>  
			<script type="text/javascript" src="../javascript/file_js.php"></script>
		<!--Fin AplicaTem-->
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
		
		<!--  Include the WYSIWYG javascript files-->
		<script type="text/javascript" src="include/editor/scripts/wysiwyg.js"></script>
		<script type="text/javascript" src="include/editor/wysiwyg-settings.js"></script>
		<!-- Attach the editor on the textareas -->
		<script type="text/javascript">
			WYSIWYG.attach('resp_correo');
			claseGlobal="edit_comandos_sms";
		</script>
		
		
<BR><div class="cabe"><?php echo _("agregar comandos para mensajes de textos");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos del comando");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="text" name="id_com" maxlength="8" size="30"onChange="validarcomandos_sms()" value="<?php $acceso->objeto->ejecutarSql("select *from comandos_sms  where (id_com ILIKE '$ini_u%') ORDER BY id_com desc"); echo $ini_u.verCo($acceso,"id_com")?>">
		<input  type="hidden" value="FALSE" name="status_com">
		
		<input  type="hidden" value="FALSE" name="status_error">
		<input  type="hidden" value="dato" name="dato">
		<td width="120px">
				<span class="fuente"><?php echo _("franquicia");?>
				</span>
			</td>
			<td >
				<select name="id_franq" id="-1" onchange="" style="width: 206px;">
					<?php echo verFranquicia($acceso);?>
				</select>
			</td>
		
			<td>
				<span class="fuente"><?php echo _("tipo com");?>
				</span>
			</td>
			<td>
				<select name="tipo_com" id="-1" onchange="">
					<option value="0">Seleccione...</option>
					<option value="PARA CLIENTES"><?php echo _("para clientes");?></option>
					<option value="PARA TECNICOS"><?php echo _("para tecnicos");?></option>
					<option value="PARA GERENTES"><?php echo _("para gerentes");?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("comando");?></span>
			</td>
			<td>
				<input  type="text" name="nombre_com" maxlength="15"  style="width: 200px;" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("tipo variable");?>
				</span>
			</td>
			<td>
				<select name="tipo_variable" id="-1" onchange="">
					<option value="CONTRATO"><?php echo _("contrato");?></option>
					<option value="INGRESO_ACTUAL"><?php echo _("ingreso actual");?></option>
					<option value="CIERRE_DIARIO"><?php echo _("cierre diario");?></option>
				</select>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("descripcion");?></span>
			</td>
			<td COLSPAN="3">
				<textarea name="descrip_com"  style="width: 600px;" rows="1"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("sms correcto");?></span>
			</td>
			<td COLSPAN="3">
				<textarea name="sms_resp"  style="width: 600px;" rows="4"  onKeyUp="cuenta_carac_com()"></textarea>
				<span class="fuente_sms">Caracteres: </span><label id="cant_car">15</label> / <label id="cant_sms">1</label></span>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("mensaje erroneo");?></span>
			</td>
			<td COLSPAN="3">
				<textarea name="sms_error"  style="width: 600px;" rows="4"  onKeyUp="cuenta_carac_com_e()"></textarea>
				<span class="fuente_sms">Caracteres: </span><label id="cant_car_e">15</label> / <label id="cant_sms_e">1</label></span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("e-mail correcto");?></span>
			</td>
			<td COLSPAN="3">
				<textarea name="resp_correo" id="resp_correo" style="width: 600px; height:200px;"></textarea>
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
					<input  type="button" name="registrar" value="<?php echo _("agregar");?>" onclick="verificar_sms('incluir','comandos_sms')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("guardar");?>" onclick="verificar_sms('modificar','comandos_sms')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_sms('eliminar','comandos_sms')">&nbsp;
					<input  type="hidden" name="Resetear" value="CANCELAR">
				</div>
			</td>
		</tr>
<tr>
  <td>
	<div id="datagrid">
	</div>	
	</td>
</tr>
		
	</table>
</form>


<script type="text/javascript">
				cuenta_carac_com();
				cuenta_carac_com_e();
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/listadovariables.php?tipo_variable="+tipo_variable()+"&";
				updateTable_sms1();
		</script>

<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>