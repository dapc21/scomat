<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
$id_com=$_GET['id_com'];

			$acceso->objeto->ejecutarSql("SELECT *FROM comandos_sms where id_com='$id_com'");
			if($row=row($acceso))
			{
				$id_franq=trim($row["id_franq"]);
				$tipo_com=trim($row["tipo_com"]);
				$nombre_com=trim($row["nombre_com"]);
				$descrip_com=trim($row["descrip_com"]);
				$status_com=trim($row["status_com"]);
				$sms_resp=trim($row["sms_resp"]);
				$tipo_variable=trim($row["tipo_variable"]);
				$sms_error=trim($row["sms_error"]);
				$status_error=trim($row["status_error"]);
				$resp_correo=trim($row["resp_correo"]);
			}
?>

		<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			
			<script language="JavaScript" type="text/javascript" src="../javascript/validacion.js"> </script>
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
		
<body bgcolor="#ffffff">

<BR><div class="fuenteN cabe"><?php echo _("editar comandos para mensajes de textos");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos del comando");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_com" maxlength="8" size="30" value="<?php echo $id_com; ?>">
		<input  type="hidden" value="<?php echo $id_franq; ?>" name="id_franq">
		<input  type="hidden" value="<?php echo $tipo_com; ?>" name="tipo_com">
		<input  type="hidden" value="<?php echo $status_com; ?>" name="status_com">
		<input  type="hidden" value="<?php echo $tipo_variable; ?>" name="tipo_variable">
		<input  type="hidden" value="<?php echo $status_error; ?>" name="status_error">
		<input  type="hidden" value="dato" name="dato">
		<tr>
			<td>
				<span class="fuente"><?php echo _("comando");?></span>
			</td>
			<td>
				<input  type="text" name="nombre_com" maxlength="15"  style="width: 200px;" value="<?php echo utf8_decode($nombre_com); ?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("descripcion");?></span>
			</td>
			<td>
				<textarea name="descrip_com"  style="width: 600px;" rows="1"><?php echo utf8_decode($descrip_com); ?></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("sms correcto");?></span>
			</td>
			<td>
				<textarea name="sms_resp"  style="width: 600px;" rows="4"  onKeyUp="cuenta_carac_com()"><?php echo utf8_decode($sms_resp); ?></textarea>
				<span class="fuente_sms">Caracteres: </span><label id="cant_car">15</label> / <label id="cant_sms">1</label></span>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("mensaje erroneo");?></span>
			</td>
			<td>
				<textarea name="sms_error"  style="width: 600px;" rows="4"  onKeyUp="cuenta_carac_com_e()"><?php echo $sms_error; ?></textarea>
				<span class="fuente_sms">Caracteres: </span><label id="cant_car_e">15</label> / <label id="cant_sms_e">1</label></span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("email correcto");?></span>
			</td>
			<td>
				<textarea name="resp_correo" id="resp_correo" style="width: 600px; height:200px;"><?php echo $resp_correo; ?></textarea>
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
					<input  type="hidden" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_sms('incluir','comandos_sms')">&nbsp;
					<input  type="button" name="modificar" value=<?php echo _("guardar");?> onclick="verificar_sms('modificar','comandos_sms')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_sms('eliminar','comandos_sms')">&nbsp;
					<input  type="hidden" name="Resetear" value="<?php echo _("cancelar");?>">
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

</body>

<script type="text/javascript">
			cuenta_carac_com();
				cuenta_carac_com_e();
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/listadovariables.php?tipo_variable="+tipo_variable()+"&";
				updateTable_sms1();
		</script>