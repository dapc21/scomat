
<?php 
@session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('act_contrato')))
{
		$id_contrato=$_GET['id_contrato'];

		$acceso->objeto->ejecutarSql("select *from vista_contrato where id_contrato='$id_contrato'");
		if($row=row($acceso))
		{
			$nro_contrato=trim($row["nro_contrato"]);
		}
	//	echo ":$nro_contrato:";
?>
<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
			<script language="JavaScript" type="text/javascript" src="javascript/ajax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/validacionAjax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/controlador.js"></script>  
			<script language="JavaScript" type="text/javascript" src="Programador/script.js"></script>
		<!--Fin AplicaTem-->
		<!--datepicker  -->
			<link type="text/css" href="include/datepicker/themes/base/ui.all.css" rel="stylesheet" />
			<script type="text/javascript" src="include/datepicker/jquery-1.3.2.js"></script>
			<script type="text/javascript" src="include/datepicker/ui/ui.core.js"></script>
			<script type="text/javascript" src="include/datepicker/ui/ui.datepicker.js"></script>
			<link type="text/css" href="include/datepicker/demos.css" rel="stylesheet" />
		<!--fin datepicker -->
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
		
<BR><div class="cabe"><?php echo _("actualizacion de datos del cliente");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 

 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("datos personales del cliente");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
		<input  type="hidden" name="cli_id_persona" maxlength="10" size="20"onChange="validarcliente()" value="<?php  echo verCod_cli($acceso,$ini_u)?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("nro cozcvzxntrato");?>
				</span>
			</td>
			<td>
				<input  type="text" name="nro_contrato" onChange="validarcontrato()" maxlength="10" size="20" value="<?php echo $nro_contrato;?>" >
				
			</td>
			<td>
				<span class="fuente"><?php echo _("rif / cedula");?></span>
			</td>
			<td valign="button">
				<input  type="text" name="cedula" maxlength="10" size="20" value="" onChange="validar_dato_cliente()">
			
			</td>
				
			
		</tr>
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("nombre");?>
				</span>
			</td>
			<td width="280px">
				<input  type="text" name="nombre" maxlength="30" size="20" value="" >
			</td>
		
			<td width="120px">
				<span class="fuente"><?php echo _("apellido");?>
				</span>
			</td>
			<td width="150px">
				<input  type="text" name="apellido" maxlength="30" size="20" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("celular");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telefono" maxlength="11" size="20" value="" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("telefono");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telf_casa" maxlength="11" size="20" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("telefono adicional");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telf_adic" maxlength="11" size="20" value="" >
			</td>
			<td>
				<span class="fuente"><?php echo _("email");?>
				</span>
			</td>
			<td colspan="3">
				<input  type="text" name="email" maxlength="40" size="20" value="" >
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
	  <legend ><?php echo _("datos de ubicacion del cliente");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("franquicia");?></span>
			</td> 
			<td>
				<select name="id_franq" id="id_franq" onchange="cargarZona()" style="width: 150px;">
					<?php echo verFranquicia($acceso);?>
				</select>
			</td>
			<td width="120px">
				<span class="fuente"><?php echo _("residencia");?>
				</span>
			</td>
			<td width="150px">
				<span class="fuente">
					<input  type="radio" name="tipo_costo" value="CASA" CHECKED onchange="habilitaEdif()"><?php echo _("casa");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="tipo_costo" value="EDIFICIO" onchange="habilitaEdif()"><?php echo _("edificio");?>
				</span>
			</td>
		</tr>
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("zona");?>
				</span>
			</td>
			<td width="280px">
				<select name="id_zona" id="id_zona" onchange="cargarSector()" style="width: 150px;">
					<?php echo verZona($acceso);?>
				</select>
			</td>
		
			<td width="120px">
				<span class="fuente"><?php echo _("sector");?>
				</span>
			</td>
			<td width="150px">
				<select name="id_sector" id="id_sector" onchange="traerZona()" style="width: 150px;">
					<?php echo verSector($acceso);?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("calle");?></span>
			</td>
			<td>
				<select name="id_calle" id="id_calle"  onchange="traerSector()" style="width: 150px;">
					<?php echo verCalle($acceso);?>
				</select>
			</td>
		
			<td>
				<span class="fuente"><?php echo _("nro casa / apto");?>
				</span>
			</td>
			<td>
				<input  type="text" name="numero_casa" maxlength="10" size="20" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("edificio");?></span>
			</td>
			<td>
				<select disabled name="edificio" id="edificio"  onchange="traerCalle()" style="width: 150px;">
					<?php echo verEdif($acceso);?>
				</select>
			</td>
		
			<td>
				<span class="fuente"><?php echo _("nro piso");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="numero_piso" maxlength="10" size="20" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("direccion adicional");?>
				</span>
			</td>
			<td colspan="3">
				<textarea name="direc_adicional" style="width: 500px;" rows="1"></textarea>
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
					<input  type="hidden" name="registrar" value="REGISTRAR" onclick="verificar('modificar','contrato')">&nbsp;
					<input  type="<?php echo $obj->mo; ?>" name="modificar" value="<?php echo _("actualizar");?>" onclick="verificar('actualizar','act_datos')">&nbsp;
					<input  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','contrato')">&nbsp;
					
				</div>
			</td>
		</tr>
 

		<table border="0" width="97%" align="CENTER" > 
		<input  type="hidden" name="id_contrato" maxlength="10" size="20" value="<?php echo $id_contrato?>">
		<input  type="hidden" name="status_pago" value="">
		<input  type="hidden" name="etiqueta" value="">
		<input  type="hidden" name="nro_factura" value="">
		<input  type="hidden" name="id_persona" value="">
		<input  type="hidden" name="costo_contrato" value="">
		<input  type="hidden" name="costo_dif_men" value="">
		<input  type="hidden" name="fecha_contrato" value="">
		<input  type="hidden" name="hora_contrato" value="">
		<input  type="hidden" name="observacion" value="">
		<input  type="hidden" name="id_g_a" value="">

</table>

<input  type="hidden" value="dato" name="dato">	
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

