<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
$id_envio=$_GET['id_envio'];

			$acceso->objeto->ejecutarSql("SELECT *FROM envio_aut where id_envio='$id_envio'");
			if($row=row($acceso))
			{
				$id_franq=trim($row["id_franq"]);
				$tipo_envio=trim($row["tipo_envio"]);
				$nombre_envio=trim($row["nombre_envio"]);
				$envio_sms=trim($row["envio_sms"]);
				$envio_email=trim($row["envio_email"]);
				$descripcion_envio=trim($row["descripcion_envio"]);
				$ref_envio=trim($row["ref_envio"]);
				$tipo_variable=trim($row["tipo_variable"]);
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
			claseGlobal="edit_envio_aut";
			//conexionPHP_sms("validarExistencia.php","1=@comandos_sms","id_com=@"+id_com);
			
		</script>
		
<body bgcolor="#ffffff">

<BR><div class="fuenteN cabe"><?php echo _("editar datos de envio automatico");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos del envio");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_envio" maxlength="8" size="30"onChange="validarenvio_aut()" value="<?php echo $id_envio;?>">
		<input  type="hidden" value="<?php echo $id_franq;?>" name="id_franq">
		<input  type="hidden" value="<?php echo $tipo_envio;?>" name="tipo_envio">
		<input  type="hidden" value="<?php echo $envio_sms;?>" name="envio_sms">
		<input  type="hidden" value="<?php echo $envio_email;?>" name="envio_email">
		<input  type="hidden" value="<?php echo $tipo_variable;?>" name="tipo_variable">
		<tr>
			<td>
				<span class="fuente"><?php echo _("nombre");?>
				</span>
			</td>
			<td>
				<input readonly type="text" name="nombre_envio" maxlength="50" style="width: 600px;" value="<?php echo utf8_decode($nombre_envio);?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("sms a enviar");?>
				</span>
			</td>
			<td>
				<textarea class="fuenteNormal" name="descripcion_envio" style="width: 600px;" rows="4" onKeyUp="cuenta_carac()"><?php echo utf8_decode($descripcion_envio);?></textarea>
				<span class="fuente_sms">Caracteres: </span><label id="cant_car">15</label> / <label id="cant_sms">1</label></span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("e-mail a enviar");?></span>
			</td>
			<td>
				<textarea name="resp_correo" id="resp_correo" style="width: 600px; height:200px;"><?php echo utf8_decode($resp_correo); ?></textarea>
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
					<input  type="hidden" name="registrar" value="REGISTRAR" onclick="verificar_sms('incluir','envio_aut')">&nbsp;
					<input  type="button" name="modificar" value="<?php echo _("guardar");?>" onclick="verificar_sms('modificar','envio_aut')">&nbsp;
					<input  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar_sms('eliminar','envio_aut')">&nbsp;
					<input  type="hidden" name="agregar" value="CARGAR ORDENES" onclick="verificar_sms('cargar','envio_aut')">&nbsp;
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

</body>

<script type="text/javascript">
				cuenta_carac();
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/listadovariables.php?tipo_variable="+tipo_variable()+"&";
				updateTable_sms1();
		</script>