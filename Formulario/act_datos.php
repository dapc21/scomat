<?php 
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('act_datos')))
{

$dato=lectura($acceso,"select *from contrato where status_contrato='VACIO'");

for($i=0;$i<count($dato);$i++){
	$id_cont=trim($dato[$i]['id_contrato']);
	$id_persona=trim($dato[$i]['cli_id_persona']);
	
		$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos where id_contrato='$id_cont'");
		while($row=row($acceso))
		{
			$id_orden=trim($row['id_orden']);
			$acceso->objeto->ejecutarSql("delete from orden_grupo where id_orden='$id_orden'");
		}
	
	$acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_contrato='$id_cont'");
	$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_cont'");
	$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_contrato='$id_cont'");
	$acceso->objeto->ejecutarSql("delete from sms where id_contrato='$id_cont'");
	
	//ECHO "<BR>delete from contrato where id_contrato='$id_cont';<BR>";
	
	$acceso->objeto->ejecutarSql("delete from contrato where id_contrato='$id_cont'");
	$acceso->objeto->ejecutarSql("delete from cliente where id_persona='$id_persona'");
	$acceso->objeto->ejecutarSql("delete from persona where id_persona='$id_persona'");
}

$cli_id_persona = verCod_cli($acceso,$ini_u);

$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
$id_cont_serv= $ini_u.verCodLong($acceso,"id_cont_serv");

	$acceso->objeto->ejecutarSql("select *from parametros where id_param='4'"); 
	if($row=row($acceso)){
		$valor_param_v=trim($row['valor_param']);
	}
		$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='7'");
		if($row=row($acceso)){
			$cargo_aut= trim($row["valor_param"]);
		}
		$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='11'");
		if($row=row($acceso)){
			$status_visible= trim($row["valor_param"]);
		}
		$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='12'");
		if($row=row($acceso)){
			$etiqueta_visible= trim($row["valor_param"]);
		}
?>

<BR><div class="cabe"><?php echo _("actualizacion de datos del cliente");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 

 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("datos personales del cliente");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_gt" maxlength="12" size="30"onChange="" value="">
		<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
		<input  type="hidden" name="cli_id_persona" maxlength="10" size="20"onChange="validarcliente()" value="<?php $acceso->objeto->ejecutarSql("select id_persona from persona  where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc LIMIT 1 offset 0 "); echo $ini_u.verCodLong($acceso,"id_persona")?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("nro abonado");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="nro_contrato" onChange="validarcontrato()" maxlength="10" size="20" value="" >
				
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("tipo cliente");?>
				</span>
			</td>
			<td >
				<select name="tipo_cliente" id="tipo_cliente" onchange="activa_tipo_c()" style="width: 90px;">
					<option value="NATURAL"><?php echo _("NATURAL");?></option>
					<option value="JURIDICO"><?php echo _("JURIDICO");?></option>
				</select>
				<select name="inicial_doc" id="inicial_doc" onchange="" style="width: 37px;">
					<option value="V"><?php echo _("V");?></option>
					<option value="E"><?php echo _("E");?></option>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("rif / cedula");?>
				</span>
			</td>
			<td >
				<input type="text" name="cedula" id="cedula" maxlength="10" size="20" value="" onChange="validar_dato_cliente2()">
			</td>
		</tr>
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("razon social");?>
				</span>
			</td>
			<td colspan="3">
				<input disabled type="text" name="empresa" maxlength="30" style="width: 540px;" value="">
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
		<input  type="hidden" name="fecha_nac" id="fecha_nac" maxlength="10" size="20" value="11/11/1111" >
		
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
					<?php echo utf8_decode(verFranquicia($acceso));?>
				</select>
			</td>
			<td width="120px">
				<span class="fuente"><?php echo _("residencia");?>
				</span>
			</td>
			<td width="150px">
				<span class="fuente">
					<input  type="radio" name="tipo_costo" value="CASA" CHECKED onchange="habilitaEdif()">Casa&nbsp;&nbsp;&nbsp;
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
					<?php echo utf8_decode(verZona($acceso));?>
				</select>
			</td>
		
			<td width="120px">
				<span class="fuente"><?php echo _("sector");?>
				</span>
			</td>
			<td width="150px">
				<select name="id_sector" id="id_sector" onchange="traerZona()" style="width: 150px;">
					<?php echo utf8_decode(verSector($acceso));?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("calle");?></span>
			</td>
			<td>
				<select name="id_calle" id="id_calle"  onchange="traerSector()" style="width: 150px;">
					<?php echo utf8_decode(verCalle($acceso));?>
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
					<?php echo utf8_decode(verEdif($acceso));?>
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
				<span class="fuente"><?php echo _("postel");?></span>
			</td>
			<td>
				<input type="text" name="postel" maxlength="20" size="20" value="" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("taps");?>
				</span>
			</td>
			<td>
				<input type="text" name="taps" maxlength="20" size="20" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("pto");?></span>
			</td>
			<td>
				<input type="text" name="pto" maxlength="20" size="20" value="" >
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
					<input  type="hidden" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('modificar','contrato')">&nbsp;
					<input  type="<?php echo $obj->mo; ?>" name="modificar" value="<?php echo _("actualizar");?>" onclick="verificar('actualizar','act_datos')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','contrato')">&nbsp;
					
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
