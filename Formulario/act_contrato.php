<?php
session_start();
require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('act_contrato')))
{
	$obj1=new Usuario('','','','','');
	if(!$obj->permisoModulo($acceso,strtoupper('MODIFICAR_CEDULA'))){
		$MODIFICAR_CEDULA="disabled";
	}
	if(!$obj->permisoModulo($acceso,strtoupper('MODIFICAR_PRECINTO'))){
		$MODIFICAR_PRECINTO="disabled";
	}
	if(!$obj->permisoModulo($acceso,strtoupper('MODIFICAR_POSTE'))){
		$MODIFICAR_POSTE="disabled";
	}
	if(!$obj->permisoModulo($acceso,strtoupper('MODIFICAR_PUNTOADI'))){
		$MODIFICAR_PUNTOADI="disabled";
	}
	if(!$obj->permisoModulo($acceso,strtoupper('MODIFICAR_NRO_ABONADO'))){
		$MODIFICAR_NRO_ABONADO="disabled";
	}
	if(!$obj->permisoModulo($acceso,strtoupper('MODIFICAR_CONTRATO_FISICO'))){
		$MODIFICAR_CONTRATO_FISICO="disabled";
	}
	if(!$obj->permisoModulo($acceso,strtoupper('AGREGAR_SUSCRIPCION'))){
		$AGREGAR_SUSCRIPCION="disabled";	
	}
$cli_id_persona = verCod_cli($acceso,$ini_u);

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
		
		$acceso->objeto->ejecutarSql("select *from parametros where id_param='48' and id_franq='1'");
		$row=row($acceso);
		$modulo_cable_modem_G=trim($row['valor_param']);
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head">
		<h3>Consultar Abonados<button style="display:none" type="button" class="btn btn-info pull-right" id="mostrar_busqueda" onclick="ocultarmostrardiv('seccion_busqueda')"><i class="fa fa-search fa-1x pull-right"></i></button></h3>
	</div>

	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel" id="seccion_busqueda">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Búsqueda de Abonados</header>
		
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<input type="hidden" name="id_contrato" id="id_contrato" maxlength="10" size="20" value="">

			<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<label>Nº de Abonado</label>
				<div class="input-group">
				<input class="form-control" type="text" name="nro_contrato" id="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_abonado" onclick=""><i class="fa fa-search"></i></button>	
				</div>
				</div>
			</div>												
			<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<label>RIF/Cédula</label>
				<div class="input-group">				
				<input class="form-control" type="text" name="cedula_b" id="cedula_b" maxlength="10" size="15" value="" onChange="buscar_cedula_contrato()">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick=""><i class="fa fa-search"></i></button>	
				</div>
				</div>
			</div>										
			<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<label>Precinto</label>
				<div class="input-group">				
				<input class="form-control" type="text" name="precinto_b" id="precinto_b" maxlength="10" size="15" value="" onChange="buscar_precinto_contrato()">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick=""><i class="fa fa-search"></i></button>	
				</div>
				</div>
			</div>			
			<div class="form-group area-btn-agregar col-lg-2 col-md-2 col-sm-12 col-xs-12">					
				<button type="button" class="btn btn-info btn-txt" id="busqueda_avanzada" name="busqueda_avanzada" onclick="ajaxVentana('Abonados', this.id);" >
				<i class="fa fa-search"></i> Busqueda Avanzada
				</button>
			</div>				

		</div>
		
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<div id="act_contrato" style="display:none">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	<form role="form" name="f1" id="f1"  data-parsley-validate="">
	
		<!-- ÁREA DE PANEL O PANELES -->
		<section class="panel" id="dato_saldo" style="display:none ">
	
			<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Resumen<i style="color:red" class="fa fa-plus-square fa-2x pull-right actualizar" title="Cargar Deuda" id="add_cargar_deuda" name="agregar" onclick="llamar_cargar_deuda_act()"></i><i class="fa fa-files-o fa-2x pull-right actualizar" title="Generar Ordenes de Servicios" id="add_asignar_orden" name="agregar" id="crear_orden" onclick="llamar_ordenes_tecnicos_act()"></i></header>
		
			<div class="panel-body">
		
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">								
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Nro de Abonado</label >
						<input class="form-control" disabled <?php echo $MODIFICAR_NRO_ABONADO; ?>  type="text" name="n_contrato1" id="n_contrato1" onChange="buscar_contr_act()" maxlength="11" size="20" value="" >
					
					</div>					
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>Status</label >					
						<input class="form-control" style="#000000; font-weight:blod; font-size:14; "  readonly type="text" name="status1" id="status1"  value="" onChange="">
					</div>									
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>Saldo</label>					
							<input class="form-control" type="text" style="#000000; font-weight:blod; font-size:14; "  readonly type="text" name="saldo1" id="saldo1" value="0.00" onChange="">																						
					</div>
					<div class="form-group area-btn-agregar col-lg-2 col-md-2 col-sm-12 col-xs-12">					
						<button type="button" class="btn btn-info btn-txt" id="buscar_rif_cedula" onclick="ver_detalle_saldo();">
						<i class="fa fa-search"></i> Estado de Cuenta
						</button>
					</div>
				
				</div>
		
			</div> <!-- FIN DEL PANEL -->
	
		</section>
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	
			<section class="panel">
	
				<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos del Contrato</header>
				
				<!-- INICIO DEL PANEL -->
				<div class="panel-body">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<input type="hidden" name="status_contrato" id="status_contrato" value="" >
						<input type="hidden" name="etiqueta_n" id="etiqueta_n" maxlength="15" size="20" value="" onchange="valida_etiqueta_n();">
						
						<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
							<label>Tipo de Facturación</label >
							<div >
								<input  type="radio" name="tipo_fact" value="POSTPAGO" CHECKED >&nbsp;<?php echo _("POSTPAGO");?>&nbsp;&nbsp;&nbsp;
								<input  type="radio" name="tipo_fact" value="PREPAGO" >&nbsp;<?php echo _("PREPAGO");?>
							</div>
						</div>	
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<label>CONTRATO IMPRESO</label >
								<div class="form-group">
									
									<input disabled type="radio" name="contrato_imp" id="contrato_imp1" value="SI"  >&nbsp;<?php echo _("SI");?>&nbsp;&nbsp;&nbsp;
									<input  type="radio" name="contrato_imp" id="contrato_imp2" value="NO" CHECKED>&nbsp;<?php echo _("NO");?>
									
								</div>			
						</div>
						
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Fecha contrato</label >
							<input disabled class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fecha_contrato" id="fecha_contrato" maxlength="10" value="<?php echo date("d/m/Y");?>" >				
							
						</div>		
				
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
								<?php echo verCobradores($acceso);?>
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
				
						<input type="hidden" name="costo_contrato" id="costo_contrato" maxlength="10" size="20" value="<?php echo costoContrato($acceso);?>" >
						<input type="hidden" name="costo_dif_men" id="costo_dif_men" maxlength="10" size="20" value="0" >
							
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Nro de Abonado</label >
							<input ata-parsley-id="nro_contrato" required="" class="form-control" disabled <?php echo $MODIFICAR_NRO_ABONADO; ?>  type="text" name="n_contrato" id="n_contrato" onChange="buscar_contr_act()" maxlength="11" size="20" value="" >
							<ul id="parsley-id-nro_contrato" class="parsley-errors-list"></ul>
						</div>
				
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Nro de Contrato</label >
							<input data-parsley-id="contrato_fisico" required="" class="form-control" <?php echo $MODIFICAR_CONTRATO_FISICO; ?>  type="text" name="contrato_fisico" id="contrato_fisico" onChange="" maxlength="11" size="20" value="<?php echo $nro_contrato;?>" >
							<ul id="parsley-id-contrato_fisico" class="parsley-errors-list"></ul>
						</div>	
						
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>FECHA DE ACTUALIZACION</label >
								<input disabled class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="ultima_act" id="ultima_act" maxlength="10" value="" >				
						</div>											
																		
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" hidden>
							<label>Costo Instalación</label >
							<select  class="form-control" name="id_serv_v" id="id_serv_v" onchange="">
									<?php echo vercosto_instalacion($acceso);?>
							</select>
								
						</div>		
										
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Observación</label >
							<textarea class="form-control" name="observacion" id="observacion" rows="1" style="height:31px"></textarea>		
						</div>
								
					</div>	<!-- FIN DEL DIV COL 12 -->
			
				</div> <!-- FIN DEL PANEL BODY -->
	
			</section>
	
		</div> <!-- FIN DEL DIV COL6-->
			
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		
			<!-- ÁREA DE PANEL O PANELES -->
			<section class="panel">
		
				<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos personales</header>
				
				<!-- INICIO DEL PANEL -->
				<div class="panel-body">
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<input readonly type="hidden" name="cli_id_persona" id="cli_id_persona" maxlength="10" size="20"onChange="validarcliente()" value="<?php  echo $cli_id_persona; ?>">
						<input readonly type="hidden" name="cli_id_personaGlob" id="cli_id_personaGlob" maxlength="10" size="20"onChange="validarcliente()" value="<?php  echo $cli_id_persona; ?>">
						<input type="hidden" name="id_venta" id="id_venta" maxlength="10" size="20" value="<?php echo $id_venta?>">
						
						
						<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<label>Tipo de Abonado</label >
							<select class="form-control" name="tipo_cliente" id="tipo_cliente" onchange="activa_tipo_c()" for="tipo_cliente">
								<option value="NATURAL"><?php echo _("NATURAL");?></option>
								<option value="JURIDICO"><?php echo _("JURIDICO");?></option>
							</select>
						</div>
						<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<label> Tipo</label >
							<select class="form-control" name="inicial_doc" id="inicial_doc" onchange="">
								<option value="V"><?php echo _("V");?></option>
								<option value="E"><?php echo _("E");?></option>
							</select>
						</div>
							
						<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<label>RIF/Cédula</label >
								<div class="input-group">	
									<input disabled data-parsley-id="cedula" required="" class="form-control" class="form-control" type="text" for="cedula" name="cedula" id="cedula" maxlength="10" value="" onChange="validar_dato_cliente1()">
									<div class="input-group-btn">
										<input <?php echo $MODIFICAR_CEDULA; ?>  type="checkbox" name="habilita_camb_prop" onclick="habilitar_camb_prop();"> 
									</div>
								</div>
								<ul id="parsley-id-cedula" class="parsley-errors-list"></ul>
								<!--span class="campo_oblig">&nbsp;*&nbsp;</span-->
						</div>
						<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<label>Fecha NAcimiento</label >
							<input data-parsley-id="fecha_nac" required=""  class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fecha_nac" id="fecha_nac" maxlength="10" value="" >
							<ul id="parsley-id-fecha_nac" class="parsley-errors-list"></ul>
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
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Celular (Móvil)</label >
								<input class="form-control"  data-parsley-id="telefono" required="" data-parsley-minlength="11" data-parsley-type="digits" name="telefono" id="telefono" maxlength="11" value="" type="text" >
								<ul id="parsley-id-telefono" class="parsley-errors-list"></ul>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Teléfono (Fijo)</label >
								<input class="form-control" data-parsley-id="telefono" data-parsley-minlength="11" data-parsley-type="digits" name="telf_casa" id="telf_casa" maxlength="11" value="" type="text" >
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Teléfono Adicional</label >
									<input class="form-control" data-parsley-id="telefono" data-parsley-minlength="11" data-parsley-type="digits" name="telf_adic" id="telf_adic" maxlength="11" value="" type="text" >
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Correo Electrónico</label >
									<input class="form-control" data-parsley-id="email"  data-parsley-type="email" name="email" id="email" maxlength="40" value="" type="text" >
									<ul id="parsley-id-email" class="parsley-errors-list"></ul>
							</div>
						</div>

				</div> <!-- FIN DEL DIV COL12 -->
			
			</div> <!-- FIN DEL PANEL BODY -->
	
		</section>
	
		</div> <!-- FIN DEL DIV COL6-->
	
</div> <!-- FIN DEL PANEL MACRO COl12-->
	

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Ubicación</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Franquicia</label >
				<select class="form-control" name="id_franq" id="id_franq" onchange="traer_numero_abonado();cargarubicacion()">
					<?php echo verFranquicia($acceso);?>
				</select>
			
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Estado</label >
				<select class="form-control" name="id_esta" id="id_esta" onchange="cargar_municipio_n();">
					<?php echo verEstado($acceso);?>
				</select>
				
			</div>
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
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Zona</label >
				<div class="input-group">
				<select class="form-control" name="id_zona" id="id_zona" onchange="traer_ciudad_n();cargarSector_n();">
					<?php echo verZona($acceso);?>
				</select>
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="add_zona" onclick="ajaxVentana('Registrar Zonas', this.id);"><i class="fa fa-plus"></i></button>	
				</div>
				</div>
				

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
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Calle</label >
				<div class="input-group">
				<select  data-parsley-id="id_calle" required="" class="form-control" name="id_calle" id="id_calle"  onchange="traerSector_n();" >
					<?php echo verCalle($acceso);?>
				</select>
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="add_calle" onclick="ajaxVentana('Registrar Calles', this.id);"><i class="fa fa-plus"></i></button>
				</div>
				</div>
				<ul id="parsley-id-id_calle" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Urbanización</label >
				<div class="input-group">
				<select class="form-control" name="id_urb" id="id_urb" onchange="traerSectorUrb_n()">
					<?php echo verUrb($acceso);?>
				</select>
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="add_urb" onclick="ajaxVentana('Registrar Urbanizaciones', this.id);"><i class="fa fa-plus"></i></button>
				</div>
				</div>
			</div>
			
			</div>
								
		</div> <!-- FIN DEL PANEL BODY-->
	
	</section>
	
	</div>	<!-- FIN DEL DIV COL6-->
	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	
		<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Redidencia Del Abonado</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">				
					<label>Residencia</label >
					<div class="form-group">
						
						<input  type="radio" name="tipo_costo" value="CASA" CHECKED onchange="habilitaEdif()">&nbsp;<?php echo _("CASA");?>&nbsp;&nbsp;&nbsp;
						<input  type="radio" name="tipo_costo" value="EDIFICIO" onchange="habilitaEdif()">&nbsp;<?php echo _("EDIFICIO");?>
						
					</div>						
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Número de Casa/Apto.</label >
						<input  class="form-control" type="text" name="numero_casa" id="numero_casa" maxlength="10" >
					</div>

					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Edificio</label >
						<div class="input-group">
							<select class="form-control" disabled name="id_edif" id="id_edif" onchange="traerSectorEdif_n()">
								<?php echo verEdif($acceso);?>
							</select>
							<div class="input-group-btn">
								<button type="button" class="btn btn-info" id="add_edificio" onclick="ajaxVentana('Registrar Edificios', this.id);"><i class="fa fa-plus"></i></button>
							</div>
						</div>
						
					</div>
					
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Número de Piso</label >
						<input class="form-control" type="text" name="numero_piso" id="numero_piso" maxlength="20" disabled />
					</div>							
			
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Poste</label >
						<input <?php echo $MODIFICAR_POSTE; ?> class="form-control" type="text" name="postel" id="postel" maxlength="10">
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Precinto</label >
						<input <?php echo $MODIFICAR_PRECINTO; ?> class="form-control" type="text" name="etiqueta" id="etiqueta" maxlength="10" onchange="valida_etiqueta()">
						<input class="form-control" type="hidden" name="taps" id="taps" maxlength="20" size="10">
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>Puntos Adicionales</label >
						<input <?php echo $MODIFICAR_PUNTOADI; ?>class="form-control" type="text" name="pto" id="pto" maxlength="20">
					</div>
					
				</div>	
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Punto de Referencia</label >
						<textarea  data-parsley-id="direc_adicional" required="" class="form-control" name="direc_adicional" id="direc_adicional" onkeypress=" return limita(this, event,100)" rows="1" style="height:32px"></textarea>
						<ul id="parsley-id-direc_adicional" class="parsley-errors-list"></ul>
					</div>
				
				
				</div>
				
			</div> <!--DIV COl12-->
			
		</div> <!--DIV PANEL BODY-->
		
	</div>	<!--DIV COL6-->
	
	</div> <!--DIV COl12 GENERAL-->
	
	</form><!-- CIERRE DE FORMULARIO f1 -->
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<form role="form" name="f2" id="f2"  data-parsley-validate="">
	
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Servicios Mensuales Suscritos</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<input type="hidden" name="fecha_inst" id="fecha_inst" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>">
			
			<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<label>Tipo de Servicio</label >
				<select class="form-control" name="id_tipo_servicio" id="id_tipo_servicio" onchange="cargarServicioMensual_c();">
					<?php echo verTipoSer($acceso);?>
				</select>
			</div>
			<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<label>televisores</label >
				<select class="form-control" name="id_cant" id="id_cant" onchange="cargar_servicio_tv_c()">
				
					<option value="">Seleccione...</option>
					<?php //echo ver_cant_tv($acceso);?>
				</select>
				<!--span class="campo_oblig">&nbsp;*&nbsp;</span-->
			</div>
			<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<label>Paquete del Servicio</label >
				<select data-parsley-id="id_serv"  required="" class="form-control" name="id_serv" id="id_serv" onchange="traer_costo_servicio();">
					<option value="">Seleccione...</option>
				</select>
				<ul id="parsley-id-id_serv" class="parsley-errors-list"></ul>
				<!--span class="campo_oblig">&nbsp;*&nbsp;</span-->
			</div>
			<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<label>Cantidad</label >
				<input data-parsley-id="cant_serv"  required="" class="form-control" type="text" name="cant_serv" id="cant_serv" maxlength="2" value="1">
				<ul id="parsley-id-cant_serv" class="parsley-errors-list"></ul>
				<!--span class="campo_oblig">&nbsp;*&nbsp;</span-->
			</div>
			<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<label>Costo</label >
				<div class="input-group">
				<input data-parsley-id="costo_cobro"  required="" class="form-control" type="text" name="costo_cobro" id="costo_cobro" maxlength="10" value="0" disabled>
				<span class="input-group-addon">BsF</span>
				</div>
				<ul id="parsley-id-costo_cobro" class="parsley-errors-list"></ul>
				<!--span class="campo_oblig">&nbsp;*&nbsp;</span-->
			</div>
			
			
			<div class="form-group area-btn-agregar col-lg-2 col-md-2 col-sm-12 col-xs-12">					
					<button type="button" class="btn btn-info btn-txt" name="agregar" id="agregar" onclick=" gestionar_contrato_servicio('incluir','contrato_servicio');">
					<i class="fa fa-plus"></i> Agregar
					</button>
			</div>
			
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<section id="tabla-servicio">
					<div id="suscripcion" class="data">
					</div>
				</section>
			</div>
			</div>
		</div> 
	</section>
</form>	<!-- CIERRE DE FORMULARIO f2 -->
</div> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Terminales</header>
			<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="terminales">
						
					</div>
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
		
			<button disabled class="btn btn-success" type="<?php echo $obj->mo; ?>" name="modificar" id="modificar" value="<?php echo _("actualizar");?>" onclick="gestionar_contrato('modificar','contrato')"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>

			<button disabled class="btn btn-warning" type="<?php echo $obj->mo; ?>" name="imprimir_cont" id="imprimir_cont" value="<?php echo _("IMPRIMIR CONTRATO");?>" onclick="imp_cont1()"><i class="glyphicon glyphicon-print"></i> IMPRIMIR CONTRATO</button>
			<button disabled class="btn btn-warning" type="<?php echo $obj->mo; ?>" name="imprimir_soli" id="imprimir_soli" value="<?php echo _("IMPRIMIR SOLICITUD DE CONTRATO");?>" onclick="imp_cont()"><i class="glyphicon glyphicon-print"></i> IMPRIMIR SOLICITUD DE CONTRATO</button>
			<button class="btn btn-info" type="button" name="salir" onclick="cargar_form_act_contrato()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
								
		</div>
		</div> <!-- FIN DEL PANEL --> 						
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<section class="panel">
		<!--títulos de las pestañas-->
		<header class="panel-heading">Datos Históricos del Abonado</header>
		<!--header class="panel-heading tab-bg-succes"-->
			<ul class="nav nav-tabs" id="tabConsultarCliente">

				<li class="active">
					<a data-toggle="pill" href="#tab-estado_cuenta" onclick="mostrar_estado_cuenta()"><i class="fa fa-money"></i> Estado de Cuenta</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-ordenes" onclick="mostrarHistorial_ordenes()"><i class="fa fa-files-o"></i> Operaciones</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-comunicacion" onclick="mostrarHistorial_comunicacion()"><i class="fa fa-comment-o"></i> SMS</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-llamadas" onclick="mostrarHistorial_vitacora()"><i class="fa fa-phone"></i> Llamadas</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-obser" onclick="mostrarObservaciones()"><i class="fa fa-plus-circle"></i></i> Observaciones</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-pagodep" onclick="mostrarpago_depositos()"><i class="fa fa-table"></i> Depositos/Transf</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-promocion" onclick="mostrar_promociones()"><i class="fa fa-table"></i> Promociones</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-camb_prop" onclick="mostrar_prop()"><i class="fa fa-table"></i> Cambio Prop.</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-historial_boxi" onclick="mostrarHistorial_pago_boxi()"><i class="fa fa-money"></i> Historial Cuenta</a>
				</li>
			</ul>
			
		<!--/header-->
		<!--contenido de las pestañas-->
		<div class="panel-body">
			<div class="tab-content">
				<div id="tab-estado_cuenta" class="tab-pane fade in active">
					<div id="estado_cuenta"></div>
				</div>
				<div id="tab-ordenes" class="tab-pane fade">
					
					<div id="estado"></div>
				</div>
				<div id="tab-comunicacion" class="tab-pane fade">
					
					<div id="comunicacion"></div>
				</div>
				<div id="tab-llamadas" class="tab-pane fade">
					
					<div id="vitacora"></div>
				</div>
				<div id="tab-obser" class="tab-pane fade">
					
					<div id="observa"></div>
				</div>
				<div id="tab-pagodep" class="tab-pane fade">
					
					<div id="pagodep"></div>
				</div>
				<div id="tab-promocion" class="tab-pane fade">
					
					<div id="promocion"></div>
				</div>
				<div id="tab-camb_prop" class="tab-pane fade">
					
					<div id="camb_prop"></div>
				</div>
				<div id="tab-historial_boxi" class="tab-pane fade">
					<div id="historial_boxi"></div>
				</div>
			</div>
		</div>
	</section>
	
</div>
</div>

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