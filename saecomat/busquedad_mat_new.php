<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>AplicaTem 3.5</title>
	<!--AplicaTem-->
		<link rel="stylesheet" type="text/css" href="estilos/css.css">
		<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
		<script language="JavaScript" type="text/javascript" src="javascript/ajax.js"></script>
		<script language="JavaScript" type="text/javascript" src="javascript/validacionAjax.js"></script>
		<script language="JavaScript" type="text/javascript" src="javascript/controlador.js"></script>  
		<script language="JavaScript" type="text/javascript" src="Programador/script.js"></script>
	<!--Fin AplicaTem-->
	<!--datepicker  epoch-->
		<link rel="stylesheet" type="text/css" href="include/epoch/epoch_styles.css" >
		<script type="text/javascript" src="include/epoch/epoch_classes.js"></script>
	<!--fin datepicker epoch-->
	<!--DataGrid-->
		<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
		<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
	<!-- fin DataGrid -->
</head>
<body background="imagenes/fondo.jpg" ondblclick>
<div id="contenedor">
<div id="cuerpo">
<div id="principal" style="position:absolute;float: center;">
<?php require_once "procesos.php"; 
	$val=$_GET["valor"];
?>
<BR><div class="cabe"><?php echo _("administracion de materiales");?></div>
<form name="f1">
<input  type="hidden" name="precio_u_p" maxlength="10" size="25" value="000" >
<input  type="hidden" name="id_m" maxlength="10" size="30"onChange="validarmat_padre()" value="<?php $acceso->objeto->ejecutarSql("select *from mat_padre ORDER BY id_m desc LIMIT 1 offset 0"); echo "CO".verCodlong($acceso,"id_m")?>">
<input  type="hidden" name="id_mat" id="id_mat" maxlength="10" size="30"onChange="validarmateriales_mat()" value="<?php $acceso->objeto->ejecutarSql("select *from materiales ORDER BY id_mat desc LIMIT 1 offset 0"); echo "CO".verCodLong($acceso,"id_mat")?>">
<table border="0" width="97%" align="CENTER" > 
	<tr>
		<td>
			<fieldset >
			  <legend ><?php echo _("datos generales");?></legend>				
				<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
					<input type="hidden" id="id_dep" name="id_dep" value="<?php echo $val;?>">
					<tr>
						<td>
							<span class="fuente"><?php echo _("nro material");?>
							</span>
						</td>
						<td>
							<input  type="text" name="numero_mat" id="numero_mat" onChange="filtraMovimiento('id_dep','idfam','nombre_mat','numero_mat');"  maxlength="10" size="10" value="" style="text-align: left;">
						</td>
						<td>
							<span class="fuente"><?php echo _("nombre");?>
							</span>
						</td>
						<td >
							<input  type="text" name="nombre_mat" id="nombre_mat" onChange="filtraMovimiento('id_dep','idfam','nombre_mat','numero_mat');"  maxlength="50" size="40" value="" onChange="validarmat_padre3();">
						</td>
					</tr>
					<tr>
						<td>
							<span class="fuente"><?php echo _("medida entrante");?>
							</span>
						</td>
						<td>
							<select name="id_unidad" id="id_unidad" onChange="filtraMovimiento('id_dep','idfam','nombre_mat','numero_mat');"  style="width: 120px;">
								<?php echo verUnidadMedida($acceso);?>
							</select>
							
						
						</td>
						<td>
							<span class="fuente"><?php echo _("medida saliente");?>
							</span>
						</td>
						<td>
							<select name="uni_id_unidad" id="uni_id_unidad" onChange="filtraMovimiento('id_dep','idfam','nombre_mat','numero_mat');"  style="width: 120px;">
								<?php echo verUnidadMedida($acceso);?>
							</select>							
							
						</td>
					</tr>
					<tr>
						<td>
							<span class="fuente"><?php echo _("familia");?>
							</span>
						</td>
					
						<td>
							<select name="idfam" id="idfam" onchange="filtraMovimiento('id_dep','idfam','nombre_mat','numero_mat');" style="width: 150px;">
								<?php echo verFamilia($acceso);?>
							</select>
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
				<input  type="hidden" name="registrar" value="<?php echo _("Buscar");?>" onclick="">&nbsp;
				<input  type="hidden" name="modificar" value="<?php echo _("Seleccionar");?>" onclick="">&nbsp;				
				<input  type="button" name="salir" onclick="window.close();" value="<?php echo _("cancelar");?>">
			</div>
		</td>
	</tr>
	<tr>
	  <td>
		<br>
		<fieldset >
			<legend ><?php echo _("material agregados");?></legend>
				<div id="datagrid" class="data"></div>			
		</fieldset>
	  </td>		
	 </tr>
</table>

</form>
		</div>
	
	<!--
	</div>
	<div id="pie">
		Copyright CEDESOFT BOLIVAR F.P. 2009.<br><font size="1" face="Arial">Diseño y Programación: Jesús Bolívar.</font></div>
	</div>
	-->
</div>
<script>
	
	filtraMovimiento('id_dep','idfam','nombre_mat','numero_mat');
	//setTimeOut("document.getElementById('id_dep').value=document.getElementById('val').value;",500);
</script>
</body>

</html>