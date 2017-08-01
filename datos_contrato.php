<?php
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('act_contrato')))
{
$cadena=$_GET['d'];
$valor=explode("=@",$cadena);
$id_contrato=$valor[0];

	//echo "SELECT *FROM vista_contrato where id_contrato='$id_contrato'";
	$acceso->objeto->ejecutarSql("SELECT *FROM vista_contrato where id_contrato='$id_contrato'");
		if($row=row($acceso)){
		
			$tipo_cliente=utf8_decode(trim($row['tipo_cliente']));
			if($tipo_cliente=="JURIDICO"){
				$empresa=utf8_decode(trim($row['nombre']));
			}
			$inicial_doc=utf8_decode(trim($row['inicial_doc']));
			$status_contrato=utf8_decode(trim($row['status_contrato']));
			
			$observacion=utf8_decode(trim($row['observacion']));
			$costo_contrato=utf8_decode(trim($row['costo_contrato']));
			$tipo_cliente=utf8_decode(trim($row['tipo_cliente']));
			$nombrecli=utf8_decode(trim($row['nombrecli']));
			$apellidocli=utf8_decode(trim($row['apellido']));
			$nombrecli=utf8_decode(trim($row['nombre']));
			$etiqueta=utf8_decode(trim($row['etiqueta']));
			$cedulacli=utf8_decode(trim($row['cedula']));
			
			$hora_contrato=formatofecha(trim($row["hora_contrato"]));
			$fecha_contrato=trim($row["fecha_contrato"]);
			$fecha_nac=formatofecha(trim($row["fecha_nac"]));
			
			
			$nro_contrato=trim($row['nro_contrato']);
			$id_contrato=trim($row['id_contrato']);
		
		
			$puntos=utf8_decode(trim($row['puntos']));
			$deuda=utf8_decode(trim($row['deuda']));
			if($deuda==""){
				$deuda=0;
			}
			
			$deuda=number_format($deuda+0, 2, ',', '.');
			$nombre_franq=utf8_decode(trim($row['nombre_franq']));
			$nombre_zona=utf8_decode(trim($row['nombre_zona']));
			$nombre_sector=utf8_decode(trim($row['nombre_sector']));
			$nombre_calle=utf8_decode(trim($row['nombre_calle']));
			$numero_casa=utf8_decode(trim($row['numero_casa']));
			$telefono=utf8_decode(trim($row['telefono']));
			$telf_casa=utf8_decode(trim($row['telf_casa']));
			$telf_adic=utf8_decode(trim($row['telf_adic']));
			$email=utf8_decode(trim($row['email']));
			$direc_adicional=utf8_decode(trim($row['direc_adicional']));
			$id_persona=utf8_decode(trim($row['id_persona']));
			$postel=utf8_decode(trim($row['postel']));
			$taps=utf8_decode(trim($row['taps']));
			$pto=utf8_decode(trim($row['pto']));
			$edificio=utf8_decode(trim($row['edificio']));
			$numero_piso=utf8_decode(trim($row['numero_piso']));
			
			if($edificio!=''){
				$residencia='EDIFICIO';
			}
			else{
				$residencia='CASA';
			}
		}
		$acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM persona where id_persona='$id_persona'  LIMIT 1 offset 0 ");
		
		if($row=row($acceso)){
			$vendedor=utf8_decode(trim($row['nombre']))." ".utf8_decode(trim($row['apellido']));
			
		}
?>

<div class="cabe"><?php echo _("datos del cliente");?></div>
<form name="f1" >
<table border="0" width="97%" align="CENTER" > 
<tr>
			<td colspan="2" rowspan="1">
				
				<div align="center">
					<input  type="button" name="registraar" value="salir" onclick="cerrarVenta_externa()">&nbsp;
				</div>
			</td>
		</tr>
 <tr>
  <td>
	
	<fieldset >
	  <legend ><?php echo _("datos personales del cliente");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="cli_id_persona" maxlength="10" size="20"onChange="validarcliente()" value="<?php echo verCod_cli($acceso,$ini_u)?>">
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("tipo cliente");?>
				</span>
			</td>
			<td >
				<select name="tipo_cliente" id="tipo_cliente" onchange="activa_tipo_c()" style="width: 90px;">
					<option value="<?php echo $tipo_cliente;?>"> <?php echo $tipo_cliente;?> </option>
					
				</select>
				<select disabled name="inicial_doc" id="inicial_doc" onchange="" style="width: 37px;">
					<option value="<?php echo $inicial_doc;?>"><?php echo $inicial_doc;?></option>
					
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("rif / cedula");?>
				</span>
			</td>
			<td>
				<input  type="text" name="cedula" id="cedula" maxlength="10" size="20" value="<?php echo $cedulacli;?>" onChange="">
			</td>
		</tr>
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("razon social");?>
				</span>
			</td>
			<td colspan="3">
				<input disabled type="text" name="empresa" maxlength="30" style="width: 540px;" value="<?php echo $empresa;?>">
			</td>
		
		</tr>
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("nombre");?>
				</span>
			</td>
			<td width="280px">
				<input  type="text" name="nombre" maxlength="30" size="20" value="<?php echo $nombrecli;?>" >
			</td>
		
			<td width="120px">
				<span class="fuente"><?php echo _("apellido");?>
				</span>
			</td>
			<td width="150px">
				<input  type="text" name="apellido" maxlength="30" size="20" value="<?php echo $apellidocli;?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("celular");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telefono" maxlength="11" size="20" value="<?php echo $telefono;?>" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("telefono");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telf_casa" maxlength="11" size="20" value="<?php echo $telf_casa;?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("telefono adicional");?>
				</span>
			</td>
			<td>
				<input  type="text" name="telf_adic" maxlength="11" size="20" value="<?php echo $telf_adic;?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("email");?>
				</span>
			</td>
			<td colspan="3">
				<input  type="text" name="email" maxlength="40" size="20" value="<?php echo $email;?>" >
			</td>
		</tr>
		<input  type="hidden" name="fecha_nac" id="fecha_nac" maxlength="10" size="20" value="<?php echo $fecha_nac;?>" >
		
		
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
					<option value="<?php echo $nombre_franq;?>"> <?php echo $nombre_franq;?> </option>
				</select>
				
			</td>
			<td width="100px">
				<span class="fuente"><?php echo _("residencia");?>
				</span>
			</td>
			<td width="170px">
				<span class="fuente">
					<input  type="text" name="tipo_costo" maxlength="40" size="20" value="<?php echo $residencia;?>" >
				</span>
			</td>
		</tr>
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("zona");?>
				</span>
			</td>
			<td width="250px">
				<select name="id_zona" id="id_zona" onchange="cargarSector()" style="width: 150px;">
					<option value="<?php echo $nombre_zona;?>"> <?php echo $nombre_zona;?> </option>
				</select>
				
				
			</td>
		
			<td width="120px">
				<span class="fuente"><?php echo _("sector");?>
				</span>
			</td>
			<td width="180px">
				<select name="id_sector" id="id_sector" onchange="traerZona()" style="width: 150px;">
					<option value="<?php echo $nombre_sector;?>"> <?php echo $nombre_sector;?> </option>
				</select>
				
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("calle");?></span>
			</td>
			<td>
				<select name="id_calle" id="id_calle"  onchange="traerSector()" style="width: 150px;">
					<option value="<?php echo $nombre_calle;?>"> <?php echo $nombre_calle;?> </option>
				</select>
				
			</td>
		
			<td>
				<span class="fuente"><?php echo _("nro casa / apto");?></span>
			</td>
			<td>
				<input  type="text" name="numero_casa" maxlength="10" size="20" value="<?php echo $numero_casa;?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("edificio");?></span>
			</td>
			<td>
				<select disabled name="edificio" id="edificio"  onchange="traerCalle()" style="width: 150px;">
					<option value="<?php echo $edificio;?>"> <?php echo $edificio;?> </option>
				</select>
				
			</td>
		
			<td>
				<span class="fuente"><?php echo _("nro piso");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="numero_piso" maxlength="10" size="20" value="<?php echo $numero_piso;?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("poste");?></span>
			</td>
			<td>
				<input type="text" name="postel" maxlength="20" size="20" value="<?php echo $postel;?>" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("taps");?>
				</span>
			</td>
			<td>
				<input type="text" name="taps" maxlength="20" size="20" value="<?php echo $taps;?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("pto");?></span>
			</td>
			<td>
				<input type="text" name="pto" maxlength="20" size="20" value="<?php echo $pto;?>" >
			</td>
		
			
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("direccion adicional");?>
				</span>
			</td>
			<td colspan="3">
				<textarea name="direc_adicional" style="width: 500px;" onkeypress=" return limita(this, event,100)" rows="1"><?php echo $direc_adicional;?></textarea>
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
	  <legend ><?php echo _("datos del contrato");?></legend>

		<table border="0" width="97%" align="CENTER" > 
		<input  type="hidden" name="id_contrato" maxlength="10" size="20" value="<?php echo $id_contrato?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("nro abonado");?></span>
			</td>
			<td>
				<input  type="text" name="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="<?php echo $nro_contrato;?>" >
				
			</td>
			
		</tr>
		<tr>
			<td width="120px">
				<span class="fuente"><?php echo _("status contrato");?>
				</span>
			</td>
			<td width="150px">
				<select name="status_pago" id="status_pago" onchange="activaGrupo()" style="width: 146px;">
					<option value="<?php echo $status_contrato;?>"> <?php echo $status_contrato;?> </option>
				</select>
			</td>
			<td width="120px">
				<span class="fuente"> <?php echo _("precinto");?>
				</span>
			</td>
			<td width="150px">
				<input  type="text" name="etiqueta" maxlength="15" size="20" value="<?php echo $etiqueta;?>" >
				<input  type="hidden" name="nro_factura" onChange="validarcontrato()" maxlength="10" size="20" value="<?php echo $nro_factura;?>" >
			</td>
		</tr>
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("vendedor");?>
				</span>
			</td>
			<td>
				<select name="id_persona" id="-1"  style="width: 146px;">
					<option value="<?php echo $vendedor;?>"> <?php echo $vendedor;?> </option>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("costo contrato");?>
				</span>
			</td> 
			<td>
				<input  type="text" name="costo_contrato" maxlength="10" size="20" value="<?php echo $costo_contrato;?>" >
			</td>
		
			<input  type="hidden" name="costo_dif_men" maxlength="10" size="20" value="<?php echo $costo_dif_men;?>" >
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="fecha_contrato" id="fecha_contrato" maxlength="10" size="20" value="<?php echo $fecha_contrato;?>" >
			</td>
		
			<td>
				<span class="fuente"><?php echo _("hora");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="hora_contrato" maxlength="8" size="20" value="<?php echo $hora_contrato;?>" >
			</td>
		</tr>
		
		
		
		<tr>
			<td  valign="center">
				<span class="fuente"><?php echo _("observacion");?>
				</span>
			</td>
			<td colspan="3">
				<textarea name="observacion" style="width: 500px;" rows="1"><?php echo $observacion;?></textarea>
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
	  <legend ><?php echo _("datos de los servicios mensuales");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		<tr>			
			<td colspan="7">
				<div id="datagrid" class="data">
				
				<?php
require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave

$x->setQuery("id_cont_serv,id_serv,id_contrato,tipo_servicio,nombre_servicio,cant_serv", "vista_contratoser","id_cont_serv","id_contrato='$id_contrato' and status_con_ser='CONTRATO'");
$x->hideColumn('id_cont_serv');
$x->hideColumn('id_contrato');
$x->hideColumn('id_serv');
$x->setColumnHeader('nombre_servicio',_('nombre servicio'));
$x->setColumnHeader('tipo_servicio', _('tipo de servicio'));
$x->setColumnHeader('cant_serv', _('cantidad'));

//para permitir filtros
$x->hideOrder();
//$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->printTable();
echo '<input  type="hidden" value="'.$x->row_count.'" name="cont_serv">	';

$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
$id_cont_serv= $ini_u.verCodLong($acceso,"id_cont_serv");
echo '<input  type="hidden" value="'.$id_cont_serv.'" name="id_cont_serv">	';
?>


				
				</div>			
			</td>		
		</tr>
		
	</fieldset>
  </td>		
 </tr>
 

 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("cargos pendientes");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		<tr>
			<td valign="center">
				<div id="cargos" class="data">
<?php					


$x->setQuery("id_cont_serv,costo_dif_men,fecha_inst,cant_serv,costo_cobro,status_serv,nombre_servicio,tipo_servicio", "vista_contratodeu","id_cont_serv","id_contrato='$id_contrato' and status_con_ser='DEUDA'  and costo_cobro>0");
$x->hideColumn('id_cont_serv');
$x->hideColumn('costo_dif_men');
$x->setColumnHeader('nombre_servicio',_('nombre servicio'));
$x->setColumnHeader('tipo_servicio', _('tipo de servicio'));
$x->setColumnHeader('fecha_inst', _('fecha'));
$x->setColumnHeader('cant_serv', _('cant'));
$x->setColumnHeader('costo_cobro', _('monto'));
$x->setColumnHeader('status_serv', _('total'));
$x->setColumnHeader('', '');

//$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_HREF, "javascript:ActualizarCampo('contrato_servicio_deuda','costo_cobro','%costo_cobro%','%id_cont_serv%','isNumber')");
//$x->setColumnType('cant_serv', EyeDataGrid::TYPE_HREF, "javascript:ActualizarCampo('contrato_servicio','cant_serv','%cant_serv%','%id_cont_serv%','isInteger')");

$x->hideOrder();

if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->setClase("Actualizar_Pagos");
$x->printTable();

echo '<div align="right" class="fuenteN">'._("total deuda").":".number_format($x->sumatoria,2,",",".").'</div>';



?>					
						</div>	
			</td>
			
		</tr>
		
		
	</fieldset>
  </td>		
 </tr>
 
 
 <tr>
  <td>
	<br>
	<fieldset >
	  <legend ><?php echo _("ordenes de servicios");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		<tr>
			<td valign="center">
				<div id="estado">
				
<?php					


$x->setQuery("id_orden,fecha_orden,nombre_tipo_orden,nombre_det_orden,status_orden,fecha_final,comentario_orden","vista_orden","","id_contrato='$id_contrato'");
$x->hideColumn('id_orden');
$x->setColumnHeader("fecha_orden", _("fecha"));
$x->setColumnHeader("nombre_tipo_orden", _("tipo orden"));
$x->setColumnHeader("nombre_det_orden", _("nombre orden"));
$x->setColumnHeader("status_orden", _("status"));
$x->setColumnHeader("fecha_final", _("fecha final"));
$x->setColumnHeader("comentario_orden", _("comentario"));
$x->setColumnHeader("num_visitas", _("v"));

//$x->hideOrder();
$x->setColumnType('fecha_orden', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_final', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

//$x->addStandardControl(EyeDataGrid::STDCTRL_VISITA, "verComentaOrd('%id_orden%')");


$x->hideOrder();
$x->showRowNumber();

$x->setResultsPerPage(1000);


$x->printTable();


?>	
				
				
				</div>
			</td>
			
		</tr>
		
		
	</fieldset>
  </td>		
 </tr>
 
 
 <tr>
  <td>
	<br>
	<fieldset>
	  <legend ><?php echo _("historial de pagos");?></legend>
		<table border="0" width="97%" align="CENTER" bordercolor="" > 
		<tr>
			<td valign="center">
				<div id="historial">
<?php					

$x->setQuery("tipo_costo,id_cont_serv,nro_factura,fecha_pago,nombre_servicio,fecha_inst,cant_serv,costo_cobro,status_serv","vista_pago_ser","","id_contrato='$id_contrato'");
$x->hideColumn('tipo_costo');
$x->hideColumn('id_cont_serv');
$x->setColumnHeader("nro_factura", _("factura"));
$x->setColumnHeader("fecha_pago", _("fecha pago"));
$x->setColumnHeader("tipo_servicio", _("tipo servicio"));
$x->setColumnHeader("nombre_servicio", _("nombre servicio"));
$x->setColumnHeader("fecha_inst", _("fecha cargo"));
$x->setColumnHeader("cant_serv", _("cant"));
$x->setColumnHeader("costo_cobro", _("costo"));
$x->setColumnHeader("status_serv", _("total"));

$x->setColumnType('fecha_pago', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO, '',true);
$x->hideOrder();

$x->setClase("historialpago");
$x->showRowNumber();

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->printTable();

$acceso->objeto->ejecutarSql("select sum(monto_pago) as suma from vista_pago_cont where id_contrato='$id_contrato'");
	if($row=row($acceso)){
		$suma=trim($row["suma"]);
	}
$acceso->objeto->ejecutarSql("select sum(monto_pago) as suma from vista_pago_cont where id_contrato='$id_contrato'");
	if($row=row($acceso)){
		$suma=trim($row["suma"]);
	}
	if($suma==''){
		$suma=0;
	}
	echo '<span class="fuenteN">_("total pagado").": "</span><span class="fuenteN">'.number_format($suma+0, 2, ',', '.').'</span>';


	
	
?>	
				</div>
			</td>
			
		</tr>
		
		
	</fieldset>
  </td>		
 </tr>
 


		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="button" name="registrar" value="<?php echo _("salir");?>" onclick="cerrarVenta_externa()">&nbsp;
					
				</div>
			</td>
		</tr>
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