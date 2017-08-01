<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('contrato')))
{
	session_start();
	$id_f = $_SESSION["id_franq"];
	$serie = $_SESSION["serie"];
	if($serie==''){
		//$serie='001';
	}
	$cons_serie="";
	if($id_f!='0'){
		$consult=" and  id_franq='$id_f'";
			
		$cons_serie="  and (nro_contrato ilike '$serie%') ";
	}
	else{
		$consult=" and  id_franq='1'";
		$id_f="1";
	}

$acceso->objeto->ejecutarSql("select  id_contrato from contrato  where (id_contrato ILIKE '$ini_u%')   ORDER BY id_contrato desc LIMIT 1 offset 0 ");
$id_contrato=$ini_u.verCodLong($acceso,"id_contrato");

$acceso->objeto->ejecutarSql("select  id_venta from venta_contrato  where (id_venta ILIKE '$ini_u%')   ORDER BY id_venta desc LIMIT 1 offset 0 ");
$id_venta=$ini_u.verCodLong($acceso,"id_venta");

$acceso->objeto->ejecutarSql("delete from cargar_deuda where id_contrato='$id_contrato'");
$acceso->objeto->ejecutarSql("delete from contrato_servicio_temp where id_contrato='$id_contrato'");
$cli_id_persona = verCod_cli($acceso,$ini_u);


		
$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_f'");
$row=row($acceso);
$serie=trim($row['serie']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='43' and id_franq='1'");
$row=row($acceso);
$dig_cont_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='79' and id_franq='1'");
$row=row($acceso);
$habilita_cobrador=trim($row['valor_param']);

//echo "select nro_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and  status_contrato<>'VACIO' ORDER BY num desc  LIMIT 1 offset 0 ";
$acceso->objeto->ejecutarSql("select nro_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and  status_contrato<>'VACIO' ORDER BY num desc  LIMIT 1 offset 0 ");
/*
if($serie_correl_G!='0' && $serie_correl_G!=''){
	$nro_abonado= $serie.verNumero_abonado_v4($acceso,"nro_contrato",$dig_cont_G,$serie_correl_G);
}else{
	$nro_abonado= verNumero_abonado_v4($acceso,"nro_contrato",$dig_cont_G,$serie_correl_G);
}
*/
$acceso->objeto->ejecutarSql("select nro_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and  status_contrato<>'VACIO' ORDER BY num desc  LIMIT 1 offset 0 ");
$nro_abonado= verCodLong($acceso,"nro_contrato");

$acceso->objeto->ejecutarSql("select * from contrato where nro_contrato='$nro_contrato' ");
if($row=row($acceso)){
	$nro_abonado= '';
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
$acceso->objeto->ejecutarSql("select nro_recibo from vista_recibos where id_persona='$id_persona' and tipo='CONTRATO' and  status_pago='RECIBIDO' order by nro_recibo");
if($row=row($acceso)){
	$nro_control=trim($row['nro_recibo']);
}
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" id="f1" name="f1"  data-parsley-validate="">
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Registrar Contrato</h3></div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Contrato</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<input type="hidden" name="nro_contrato_nuevo" id="nro_contrato_nuevo"  value="<?php echo $nro_abonado;?>">
				<input type="hidden" name="id_contrato" id="id_contrato"  value="<?php echo $id_contrato?>">
				<input type="hidden" name="id_venta" id="id_venta"  value="<?php echo $id_venta?>">
				
				<input type="hidden" name="etiqueta_n" id="etiqueta_n" value="" onchange="valida_etiqueta_n()">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">								
				
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>Tipo de Facturación</label >
					<div class="form-group">
							<input  type="radio" name="tipo_fact" value="POSTPAGO" CHECKED >&nbsp;<?php echo _("POSTPAGO");?>&nbsp;&nbsp;&nbsp;
							<input  type="radio" name="tipo_fact" value="PREPAGO" >&nbsp;<?php echo _("PREPAGO");?>
					</div>
				</div>									
				
			</div>			
	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Vendedor</label >
					<select  data-parsley-id="id_persona" required="" class="form-control" name="id_persona" id="id_persona" onchange="traer_numero_contrato()">
						<?php echo verVendedores($acceso);?>
					</select>
					<ul id="parsley-id-id_persona" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Cobrador</label >
					<select disabled data-parsley-id="cod_id_persona" required="" class="form-control" name="cod_id_persona" id="cod_id_persona" onchange="">
						<option value="BB00000002">NO APLICA</option>
						<?php //echo verCobradores($acceso);?>
					</select>
					<ul id="parsley-id-cod_id_persona" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Grupo Afinidad</label >
					<select  data-parsley-id="id_g_a" required="" class="form-control" name="id_g_a" id="id_g_a" onchange="">
						<?php echo verGrupoAfinidad($acceso);?>
					</select>
					<ul id="parsley-id-id_g_a" class="parsley-errors-list"></ul>
				</div>
				
				
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<input type="hidden" name="costo_dif_men" id="costo_dif_men" value="0" >
				
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Nro de Abonado</label >
					<input  data-parsley-id="nro_contrato" required="" class="form-control" type="text" name="nro_contrato" id="nro_contrato" onChange="validarcontrato()" maxlength="10" value="<?php echo $nro_abonado;?>" disabled>
					<ul id="parsley-id-nro_contrato" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Nro de Contrato</label >
					<input class="form-control" <?php if($valor_param_v=='1'){ echo 'disabled';}?> type="text" name="contrato_fisico" id="contrato_fisico" onChange="validarcontrato_control()" maxlength="10" value="" disabled>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Fecha</label >
					<input disabled class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fecha_contrato" id="fecha_contrato" maxlength="10" value="<?php echo date("d/m/Y");?>" >
					<span  data-parsley-id="fecha_contrato" required="" class="help-inline"></span>
					<ul id="parsley-id-fecha_contrato" class="parsley-errors-list"></ul>
				</div>
			
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" hidden>
			
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" >
					<label>Estatus</label >
					<select  class="form-control" name="status_contrato" id="status_contrato" onchange="activaGrupo();" disabled>
						<?php echo verStatusCont($acceso);?>
					</select>
					
				</div>
				<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<label>Costo Instalación</label >
					<select   class="form-control" name="id_serv_v" id="id_serv_v" onchange="">
						<?php echo vercosto_instalacion($acceso);?>
					</select>
					
				</div>
				

			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<input class="form-control" type="HIDDEN" name="ultima_act" id="ultima_act"  value="<?php echo date("Y-m-d");?>" disabled>
				<input class="form-control" type="HIDDEN" name="contrato_imp" id="contrato_imp"  value="NO" disabled>
												
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>Observación</label >
					<textarea class="form-control" name="observacion" id="observacion" rows="1" style="height:34px"></textarea>
					
				</div>
				
			</div>
			
			</div>
		</div> <!-- FIN DEL PANEL -->
	</section>
	
	</div> <!-- FIN DE LA DIVISION DEL PANEL DE DATOS DEL CONTRATO-->
	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Abonado</header>
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<input  type="hidden" name="cli_id_persona" id="cli_id_persona" onChange="validarcliente()" value="<?php  echo $cli_id_persona; ?>">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<label>persona</label>
					<select data-parsley-id="tipo_cliente" required="" class="form-control" name="tipo_cliente" id="tipo_cliente" onchange="activa_tipo_c()" for="tipo_cliente">
						<option value="NATURAL"><?php echo _("NATURAL");?></option>
						<option value="JURIDICO"><?php echo _("JURIDICO");?></option>
					</select>
					<ul id="parsley-id-tipo_cliente" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
					<label> Tipo doc.</label >
					<select data-parsley-id="inicial_doc" required="" class="form-control" name="inicial_doc" id="inicial_doc" onchange="">
						<option value="V"><?php echo _("V");?></option>
						<option value="E"><?php echo _("E");?></option>
					</select>
					<ul id="parsley-id-inicial_doc" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>RIF/Cédula</label >
						<input class="form-control" type="text" data-parsley-id="cedula" data-parsley-required="true" for="cedula" name="cedula" id="cedula" maxlength="10" value="" onChange="validar_dato_cliente();">
						<ul id="parsley-id-cedula" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<label>Fecha Nac.</label >
					<input data-parsley-id="fecha_nac" required="" class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fecha_nac" id="fecha_nac" maxlength="10" value="<?php echo date("d/m/Y");?>" >
					<ul id="parsley-id-fecha_nac" class="parsley-errors-list"></ul>
				</div>
			
			</div>

			<div id="tipo_jur" style="display:none">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Razón Social</label >
							<input disabled class="form-control" type="text" name="empresa" id="empresa" maxlength="80" value="">
					</div>
					
				</div>
			</div>
			<div id="tipo_per" style="display:block">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<label>Nombre(s)</label >
							<input class="form-control" type="text" name="nombre" id="nombre" maxlength="30" value="" onkeypress="return sololetras(event)" onpaste="return false">
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<label>Apellido(s)</label >
							<input class="form-control" type="text" name="apellido" id="apellido" maxlength="30" value="" onkeypress="return sololetras(event)" onpaste="return false">
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Celular</label >
						<input class="form-control" type="text" data-parsley-id="telefono" required="" data-parsley-minlength="11" data-parsley-type="digits" name="telefono" id="telefono" maxlength="11" value="" >
						<ul id="parsley-id-telefono" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Teléfono</label >
						<input class="form-control" type="text" data-parsley-id="telf_casa" data-parsley-minlength="11" data-parsley-type="digits" name="telf_casa" id="telf_casa" maxlength="11" value="" >
						<ul id="parsley-id-telf_casa" class="parsley-errors-list"></ul>
				</div>
			
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Tlf. Adicional</label >
						<input class="form-control" type="text" data-parsley-id="telf_adic" data-parsley-minlength="11" data-parsley-type="digits" name="telf_adic" id="telf_adic" maxlength="11" value="" >
						<ul id="parsley-id-telf_adic" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>E-mail</label >
						<input class="form-control" type="text" name="email" id="email" maxlength="40" value="" >
				</div>
			
			</div>
				
		</div>
		
		</div> <!-- FIN DEL PANEL -->
	</section>
		
	</div> <!-- FIN DE LA DIVISION DEL PANEL DE DATOS DEL ABONADO-->
	
	</div> <!-- FIN DE LA DIVISION MACRO-->
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Ubicación del Abonado</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Franquicia</label >
						<select data-parsley-id="id_franq" required="" class="form-control" name="id_franq" id="id_franq" onchange="cargarubicacion()">
							<?php echo verFranquicia($acceso);?>
						</select>
						<ul id="parsley-id-id_franq" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Estado</label >
						<select class="form-control" name="id_esta" id="id_esta" onchange="cargar_municipio_n();">
							<?php echo verEstado($acceso);?>
						</select>	
					</div>
					
				
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Municipio</label >
						<select class="form-control" name="id_mun" id="id_mun" onchange="traer_estado_n();cargar_ciudad_n();">
							<?php echo verMun($acceso);?>
						</select>
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Ciudad</label >
						<select class="form-control" name="id_ciudad" id="id_ciudad" onchange="traer_municipio_n();cargarZona_n();">
							<?php echo verCiudad($acceso);?>
						</select>
					</div>
					
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Zona</label >-->
						<!--<div class="input-group">-->
						<select class="form-control" name="id_zona" id="id_zona" onchange="traer_ciudad_n();cargarSector_n();">
						<?php echo verZona($acceso);?>
						</select>
						<!--
						<div class="input-group-btn">
						<button type="button" class="btn btn-info" id="add_zona" onclick="ajaxVentana('Registrar Zonas', this.id);"><i class="fa fa-plus"></i></button>	
						</div>
						</div>
						-->
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Sector</label >
						<div class="input-group">
						<select class="form-control" name="id_sector" id="id_sector" onchange="cargar_datos_sector()">
						<?php echo verSector($acceso);?>
						</select>
						<div class="input-group-btn">
						<button type="button" class="btn btn-info" id="add_sector" onclick="ajaxVentana('Registrar Sectores', this.id);"><i class="fa fa-plus"></i></button>
						</div>
						</div>
					</div>
				
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Calle</label >
						<div class="input-group">
						<select  data-parsley-id="id_calle" required="" class="form-control" name="id_calle" id="id_calle"  onchange="traerSector_n();" >
							<option value=""><?php echo _("Seleccione...");?></option>
						</select>
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="add_calle" onclick="ajaxVentana('Registrar Calles', this.id);"><i class="fa fa-plus"></i></button>
						</div>
						<ul id="parsley-id-id_calle" class="parsley-errors-list"></ul>
						</div>				
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Urbanización</label >
						<div class="input-group">
						<select class="form-control" name="id_urb" id="id_urb" onchange="traerSectorUrb_n()">
							<option value=""><?php echo _("Seleccione...");?></option>
						</select>
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="add_urb" onclick="ajaxVentana('Registrar Urbanizaciones', this.id);"><i class="fa fa-plus"></i></button>
						</div>
						</div>
					</div>
				
				</div>
			
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	</div> <!-- FIN DE LA DIVISION DEL PANEL DE DATOS DE UBICACIÓN DEL ABONADO-->
	
	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Residencia del Abonado</header>
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Residencia</label>
						<div class="form-group">
							<input  type="radio" name="tipo_costo" value="CASA" CHECKED onchange="habilitaEdif()">&nbsp;<?php echo _("CASA");?>&nbsp;&nbsp;&nbsp;
							<input  type="radio" name="tipo_costo" value="EDIFICIO" onchange="habilitaEdif()">&nbsp;<?php echo _("EDIFICIO");?>
							
						</div>			
					</div>					
				
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Nro Casa/Apto.</label >
						<input type="text"  class="form-control" name="numero_casa" id="numero_casa" maxlength="10" >
						
					</div>
				
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Edificio</label >
						<div class="input-group">
						<select class="form-control" disabled name="id_edif" id="id_edif" onchange="traerSectorEdif_n()">
							<option value=""><?php echo _("Seleccione...");?></option>
						</select>
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="add_edificio" onclick="ajaxVentana('Registrar Edificios', this.id);"><i class="fa fa-plus"></i></button>
						</div>
						</div>
						
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Nro Piso</label >
						<input class="form-control" type="text" name="numero_piso" id="numero_piso" maxlength="10" disabled />
					</div>
				
				</div>
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Poste</label>
						<input class="form-control" type="text" name="postel" id="postel" maxlength="10">
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Precinto</label >
						<input class="form-control" type="text" name="etiqueta" id="etiqueta" maxlength="10" onchange="valida_etiqueta()">
						<input class="form-control" type="hidden" name="taps" id="taps" >
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Puntos Adicionales</label >
						<input class="form-control" type="text" name="pto" id="pto" maxlength="20">
					</div>
				
				</div>																		
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Punto de Referencia</label >
						<textarea data-parsley-id="direc_adicional" required="" class="form-control" name="direc_adicional" id="direc_adicional" onkeypress=" return limita(this, event,100)" rows="1"  style="height:30px" ></textarea>
						<ul id="parsley-id-direc_adicional" class="parsley-errors-list"></ul>
					</div>
				
				</div>
			
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	</div> <!-- FIN DE LA DIVISION DEL PANEL DE DATOS DE RESIDENCIA DEL ABONADO-->
	
	</div> <!-- FIN DE LA DIVISION MACRO-->

</form><!-- CIERRE DE FORMULARIO f1 -->


<form role="form" name="f5" id="f5" >
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">costos de instalacion</header>
	
		<div class="panel-body">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<label>DESCRIPCION</label>	
					<select  data-parsley-id="id_serv_i" required="" class="form-control"  name="id_serv_i" id="id_serv_i" onchange="traer_costo_ser_inst()">
						<?php echo verServicios_instalacion($acceso);?>
					</select>
					<ul id="parsley-id-id_serv_i" class="parsley-errors-list"></ul>
				</select>
				</div>
				<div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
					<label>cantidad</label>
					<input data-parsley-id="cantidad" required="" data-parsley-type="integer" class="form-control"  type="text" name="cantidad" id="cantidad" maxlength="10" size="10" value="1"  onchange="calcular_total_cargar_deuda()">
					<ul id="parsley-id-cantidad" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
					<label>costo</label>
					<input data-parsley-id="costo" required="" data-parsley-type="number" class="form-control" disabled type="text" name="costo" id="costo" maxlength="10" size="10" value="0" onchange="calcular_total_cargar_deuda()">
					<ul id="parsley-id-costo" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
					<label>total</label>
					
					
						<input data-parsley-id="total" required="" data-parsley-type="number"  class="form-control" disabled type="text" name="total" id="total" maxlength="10" size="10" value="0" >
						
					
					<ul id="parsley-id-total" class="parsley-errors-list"></ul>
				</div>
				
				<div class="form-group area-btn-agregar col-lg-2 col-md-2 col-sm-6 col-xs-12">
					<button type="button" class="btn btn-info btn-txt" name="ad" id="ad" onclick=" gestion_cargar_deuda_inst('incluir_inst','cargar_deuda');">
					<i class="fa fa-plus"></i> Agregar
					</button>
				</div>

		
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="datagrid_instalacion" class="data">
						<input  type="hidden" name="id_cd" id="id_cd" maxlength="" size=""  value="<?php $acceso->objeto->ejecutarSql("select *from cargar_deuda  where (id_cd ILIKE '$ini_u%') ORDER BY id_cd desc"); echo $ini_u.verCoo($acceso,"id_cd")?>">
					</div>	
				</div>

				</div>
			
		</div> <!-- FIN DEL PANEL -->
				
	</section>
</div> <!-- FIN DEL PANEL -->
		
</form> <!-- FIN DEL FORMULARIO -->

<form role="form" name="f2" id="f2" data-parsley-validate="">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Servicios Mensuales Suscritos</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<input type="hidden" name="fecha_inst" id="fecha_inst" value="<?php echo date("d/m/Y");?>">
			<input type="hidden" name="id_cant" id="id_cant" value="">
			
			<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
				<label>Tipo de Servicio</label >
				<select data-parsley-id="id_tipo_servicio"  required="" class="form-control" name="id_tipo_servicio" id="id_tipo_servicio" onchange="cargarServicioMensual_c_temp();">
					<?php echo verTipoSer($acceso);?>
				</select>
				<ul id="parsley-id-id_tipo_servicio" class="parsley-errors-list"></ul>
			</div>
			<!--
			<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
				<label>Televisores</label >
				<select class="form-control" name="id_cant" id="id_cant" onchange="cargar_servicio_tv_temp()">
				
					<option value="">Seleccione...</option>
					
				</select>
				span class="campo_oblig">&nbsp;*&nbsp;</span
			</div>
			-->
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Servicio</label >
				<select data-parsley-id="id_serv"  required="" class="form-control" name="id_serv" id="id_serv" onchange="traer_costo_servicio();">
					<option value="">Seleccione...</option>
				</select>
				<ul id="parsley-id-id_serv" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
				<label>Cantidad</label >
				<input data-parsley-id="cant_serv" required="" class="form-control" type="text" name="cant_serv" id="cant_serv" maxlength="2" value="1" onchange="calcular_total_susc()">
				<ul id="parsley-id-cant_serv" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
				<label>Costo</label >
				<input data-parsley-id="costo_cobro"  required="" class="form-control" type="text" name="costo_cobro" id="costo_cobro" maxlength="10" value="0" disabled  onchange="calcular_total_susc()">
				<ul id="parsley-id-costo_cobro" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
				<label>Total</label>
				<input data-parsley-id="total_s"  required="" class="form-control" type="text" name="total_s" id="total_s" maxlength="10" value="0" disabled>
				<ul id="parsley-id-total_s" class="parsley-errors-list"></ul>
			</div>
			<!--BOTÓN-->
			<div class="form-group area-btn-agregar col-lg-2 col-md-2 col-sm-6 col-xs-12">
				<input class="form-control" type="hidden" value="0" name="tipo_s" id="tipo_s" value="AUTOMATICO">	
				<button type="button" class="btn btn-info btn-txt" name="agregar" id="agregar" onclick=" gestionar_contrato_servicio_temp('incluir','contrato_servicio_temp');">
				<i class="fa fa-plus"></i> Agregar
				</button>
			</div>
			
			<!--DATAGRID-->
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<section id="tabla-servicio">
					<div id="datagrid" class="data">
					<?php
						$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_temp  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
						$id_cont_serv= $ini_u.verCodLong($acceso,"id_cont_serv");
						echo '<input  type="hidden" value="'.$id_cont_serv.'" name="id_cont_serv" id="id_cont_serv">';
					?>
					</div>
				</section>
			</div>
			
			</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section>
	
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	<section class="panel">
	
		<div class="panel-body">
		<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-info" type="<?php echo $obj->in;?>" name="registrar" id="registrar" value="<?php echo _("Registrar");?>" onclick="registrar_contrato('incluir','contrato')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button class="btn btn-success" type="button" name="salir" id="salir" onclick="cargar_form_contrato()" value="<?php echo _("Limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

		<input  type="hidden" value="dato" name="dato" id="dato">	
		
		
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	</div>

</form> <!-- FIN DEL FORMULARIO -->
</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

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