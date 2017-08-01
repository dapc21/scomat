<?php 
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
$id_f = $_SESSION["id_franq"];  
$cedula=$_GET['cedula'];
?>
		<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="estilos_css/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos_css/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/busqueda.js"></script>
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
		<!--datepicker  epoch-->
			<link rel="stylesheet" type="text/css" href="estilos_css/epoch_styles.css" >
			<script type="text/javascript" src="include/epoch/epoch_classes.js"></script>
		<!--fin datepicker epoch-->

<body bgcolor="#ffffff">
<script>
archivoDataGrid="busqueda/busq_cont_avanz.php";
//updateTable();
</script>
<form name="f1" >

<input  type="hidden" value="<?php echo $id_franq;?>" name="id_f" id="id_f">

<table border="0" width="780px" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("parametros de para la busqueda Avanzada");?></legend>
		
	<table border="0" width="100%" align="CENTER">
		<tr>
			<td width="120px">
				<span class="fuente"><?php echo _("rif / cedula");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="cedula" maxlength="10" size="15" value="<?php echo $cedula;?>" onKeyPress="return buscarC(event)">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _(" nro abonado");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="nro_contrato" maxlength="100" size="15" value=""  onKeyPress="return buscarC(event)">
			</td>
		
			<td width="120px">
				<span class="fuente"><?php echo _("contrato fisico");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="contrato_fisico" maxlength="10" size="15" value="" onKeyPress="return buscarC(event)">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("nombre");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="nombre" maxlength="30" size="15" value=""  onKeyPress="return buscarC(event)">
			</td>
			<td>
				<span class="fuente"><?php echo _("apellido");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="apellido" maxlength="30" size="15" value=""  onKeyPress="return buscarC(event)">
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("precinto");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="etiqueta" maxlength="11" size="15" value="" onKeyPress="return buscarC(event)">
			</td>
		
			<td>
				<span class="fuente"><?php echo _("fecha contrato");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="fecha_contrato" id="fecha_contrato" maxlength="10" size="15" value=""  onKeyPress="return buscarC(event)">
			</td>
		</tr>
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("franquicia");?>
				</span>
			</td>
			<td>
			<select <?php echo $disab;?> name="id_franq" id="id_franq" onchange="cargarZona_franq()" style="width: 180px;">
					<?php echo verFranquicia($acceso);?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("zona");?>
				</span>
			</td>
			<td>
				<select name="id_zona" id="id_zona" onchange="cargarSector()" style="width: 180px;">
					<?php echo verZona_franquicia($acceso);?>
				</select>
			</td>
		
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("sector");?>
				</span>
			</td>
			<td>
				<select name="id_sector" id="id_sector" onchange="traerZona()" style="width: 180px;">
					<option value="0"><?php echo _("Seleccione...");?></option>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("calle");?></span>
			</td>
			<td>
				<select name="id_calle" id="id_calle"  onchange="traerSector()" style="width: 180px;">
					<option value="0"><?php echo _("Seleccione...");?></option>
				</select>
			</td>
		
			
		</tr>
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("status de contrato");?>
				</span>
			</td>
			<td >
				<select name="status_contrato" id="status_contrato"  style="width: 180px;">
					<option value=""><?php echo _("todos");?></option>
					<?php echo verStatusCont($acceso);?>
				</select>
			</td>
			<td width="120px">
				<span class="fuente"><?php echo _("grupo de afinidad");?>
				</span>
			</td>
			<td width="150px">
				<select name="id_g_a" id="id_g_a" onchange="" style="width: 180px;">
					<?php echo verGrupoAfinidad($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("vendedor");?>
				</span>
			</td>
			<td>
				<select name="id_persona" id="id_persona" onchange="" style="width: 180px;">
					<?php echo verVendedores($acceso);?>
				</select>
					
			</td>
			<td width="120px">
				<span class="fuente"><?php echo _("COBRADOR");?>
				</span>
			</td>
			<td width="150px">
				<select name="cod_id_persona" id="cod_id_persona" onchange="" style="width: 180px;">
					<?php echo verCobradores($acceso);?>
				</select>
			</td>
		</tr><tr>
			<td>
				<span class="fuente"><?php echo _("celular");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="telefono" maxlength="11" size="15" value=""  onKeyPress="return buscarC(event)">
			</td>
			<td>
				<span class="fuente"><?php echo _("telefono");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="telf_casa" maxlength="11" size="15" value=""  onKeyPress="return buscarC(event)">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("nro casa / apto");?>
				</span>
			</td>
			<td>
				<input  style="width: 180px;" type="text" name="numero_casa" maxlength="10" size="15" value=""  onKeyPress="return buscarC(event)">
			</td>
			
			<td>
				<span class="fuente"><?php echo _("poste");?></span>
			</td>
			<td>
				<input style="width: 180px;" type="text" name="postel" maxlength="20" size="20" value="" >
			</td>
		</tr>
		
		<tr>
			<td colspan="4" rowspan="1">
				
				<div align="center">
					<input  type="button" name="registrar" value="Buscar" onclick="buscarContAvanz()">
					<input  type="reset" name="Resetear" value="Limpiar">
				</div>
			</td>
		</tr>
		
	</table>
	</fieldset>
  </td>		
 </tr>
		<tr>
			<td colspan="4">
				<span class="fuenteN"><?php echo _("resultados encontrados de la busqueda");?>
				</span>
			</td>
			
		</tr>
		<tr>
			<td colspan="4">
				<div id="datagrid">
				</div>
			</td>
		</tr>
		
</table>
<script>
	
obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_contrato'),'',1940,2020);

var ced="<?php echo trim($cedula);?>";
if(ced!=''){
	buscarContAvanz();
}
</script>
</form>
</body>