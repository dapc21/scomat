<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('LISTADO_ABONADOS')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="status_contrato" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Listado de Abonados</h3></div>
	

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Por Estatus de Contrato</header>
					
					<div class="panel-body">
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																					
								<?php 
									
									$acceso->objeto->ejecutarSql("select *from statuscont order By nombrestatus");
									$i=1;
									echo'<div>';
									while ($row=row($acceso))
										{
											if($i==5){
											//	echo "<br>";
												$i=0;
											}	
											$i++;
											echo '
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<input  type="checkbox" name="status_contrato" value="'.trim($row["nombrestatus"]).'">
											'.trim($row["nombrestatus"]).
											'</div>';
									}
									echo '</div>';
								?>
								
							</div>
															
					</div> <!-- FIN DEL PANEL -->	
					
			</section>

		</div> <!-- FIN DIV COL 6 -->

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Con Deuda</header>
				
				<div class="panel-body">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="checkbox" name="checkgrupo" onclick="bloquea_sd()">
							<?php echo _("Sin Tomar en Cuenta Deuda");?> </br>
							
							
						</div>		
									
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<input type="checkbox" name="checkdeposito" onclick="">
							<?php echo _("Sin Tomar en Abonados con Pagos/Transferencias Pendientes");?>
							
						</div>		
						
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Desde</label>					
							<select class="form-control" name="desde" id="desde" onchange="">
								<option value='2005-01-01'>TODOS</option>
									<?php echo verMesCorte();?>
							</select>
						</div>
						
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Hasta</label>					
							<select class="form-control" name="hasta" id="hasta" onchange="">
								<?php echo verMesCorte();?>
							</select>
						</div>
						
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Y Deuda Mayor a:</label >
							<div class="input-group">												
							<input class="form-control" type="text" name="deuda" id="deuda"  maxlength="10" size="5" value="0">
							<span class="input-group-addon">BsF</span>
							</div>
							
						</div>
					
					</div>
					
				</div> <!-- FIN DEL PANEL -->
			
			</section>

		</div>	<!-- FIN DIV COL 6 -->	

	</div> <!-- FIN DIV COL 12 -->
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">		
			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) 
				<header class="panel-heading">Por Ubicación</header>-->
				<header class="panel-heading">Por Ubicación<i class="fa fa-filter fa-2x actualizar" title="Filtrar por Ubicación" id="mostrar_busqueda" onclick="ocultarmostrardiv('seccion_filtros_listadoabonado')" style="margin-top:-0.1em;margin-left:1em"></i></header>
				
				<div class="panel-body" id="seccion_filtros_listadoabonado" style="display:none">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Franquicia</label>
								<select class="form-control" name="id_franq" id="id_franq" onchange="cargar_estado();colocar_ubica_franq();">
									<?php echo verFranquicia($acceso);?>
								</select>						
							</div>
							
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Estado</label>													
								<select class="form-control" name="id_esta" id="id_esta" onchange="traer_pais();cargar_municipio();">
									<?php echo verEstado($acceso);?>
								</select>						
							</div>
							
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Municipio</label>													
								<select class="form-control" name="id_mun" id="id_mun" onchange="traer_estado();cargar_ciudad();">
									<?php echo verMun($acceso);?>
								</select>						
							</div>
							
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Ciudad</label>													
								<select class="form-control" name="id_ciudad" id="id_ciudad" onchange="traer_municipio();cargarZona();">
									<?php echo verCiudad($acceso);?>
								</select>						
							</div>

							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Urbanización</label>													
								<select class="form-control" name="urbanizacion" id="urbanizacion" onchange="traerSectorUrb();colocar_ubica_urb();">
									<?php echo verUrb($acceso);?>
								</select>
							</div>
							
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Calle</label>													
								<select class="form-control" name="id_calle" id="id_calle"  onchange="traerSector()">
									<?php echo verCalle($acceso);?>
								</select>
							</div>
							
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Zonas</label>													
								<select class="form-control" name="id_zona" id="id_zona" onchange="traer_ciudad();cargarSector();colocar_ubica();" style="height: 85px;"  multiple="multiple">
									<?php echo verZona($acceso);?>
								</select>
							</div>
							
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Sectores</label>													
								<select class="form-control" name="id_sector" id="id_sector" onchange="traerZona();cargarCalle();cargarUrb();colocar_ubica_sector();" style="height: 85px;" multiple="multiple">
									<?php echo verSector($acceso);?>
								</select>
							</div>														
					
					</div>
					
				</div> <!-- FIN DEL PANEL -->
			
			</section>

		</div> <!-- FIN DEL COL6 -->

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) 
				<header class="panel-heading">Otros Parámetros</header>-->
				<header class="panel-heading">Otros Parametros<i class="fa fa-filter fa-2x actualizar" title="Filtrar por Otros Parametros" id="mostrar_busqueda" onclick="ocultarmostrardiv('seccion_filtros_otrosparam')" style="margin-top:-0.1em;margin-left:1em"></i></header>

					<div class="panel-body" id='seccion_filtros_otrosparam' style='display:none'>
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Por fecha Contrato</label>
									<div class="has-js">
										<div class="radios">
												<input  type="radio" name="tipo_costo" value="GENERAL"CHECKED  onchange="hab_total_cli_fec1()"> General
												<input  type="radio" name="tipo_costo" value="ESPECIFICO" onchange="hab_total_cli_fec1()"> Especifico	
										</div>	
									</div>	
								</div>	
								
								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Desde</label>																		
									<input class="form-control form-control-inline input-medium default-date-picker" disabled type="text" name="desde1" data-mask="99/99/9999" id="desde1" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																														
								</div>

								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Hasta</label>																		
									<input class="form-control form-control-inline input-medium default-date-picker" disabled type="text" name="hasta1" data-mask="99/99/9999" id="hasta1" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																														
								</div>
							</div>
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Tipo de Servicio</label>													
									<select class="form-control" name="id_tipo_servicio" id="id_tipo_servicio" onchange="cargarServicioMensual()">
										<?php echo verTipoSer($acceso);?>
									</select>
								</div>
								
								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Servicios</label>													
									<select class="form-control" name="id_serv" id="id_serv" onchange="traerTipoSer()">
										<?php echo verServicios($acceso);?>
									</select>
								</div>
								
								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Grupo Afinidad</label>													
									<select class="form-control" name="id_g_a" id="id_g_a" onchange="">
										<?php echo verGrupoAfinidad($acceso);?>
									</select>
								</div>
							
								
								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Cobrador</label>													
									<select class="form-control" name="cod_id_persona" id="cod_id_persona" onchange="">
										<?php echo verCobradores($acceso);?>
									</select>
								</div>																

								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Concepto</label>
									<select class="form-control" name="por_fecha" id="por_fecha">
										<option value="INSTALACION"><?php echo _("Instalacion");?></option>
										<option value="CORTE"><?php echo _("Ultimo Corte");?></option>								
									</select>
								</div>												
								
								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Convenio Pago</label>													
									<select class="form-control" name="convenio" id="convenio" onchange="">
										<option value=''>Seleccione...</option>
										<option value='CON CONVENIO'>CON CONVENIO</option>
										<option value='SIN CONVENIO'>SIN CONVENIO</option>
										<option value='CONVENIO POR FECHA'>CONVENIO POR FECHA</option>
									</select>
								</div>
								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>T. facturacion</label>													
									<select class="form-control" name="tipo_fact" id="tipo_fact" onchange="">
										<option value=''>Seleccione...</option>
										<option value='POSTPAGO'>POSTPAGO</option>
										<option value='PREPAGO'>PREPAGO</option>
									</select>
								</div>		
							</div>
									
					</div> <!-- FIN DEL PANEL -->	
					
			</section>

		</div>	<!-- FIN DEL COL6 -->

	</div> <!-- FIN DEL COL 12 -->	

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Configuración de Listado</header>
				<div class="panel-body">
						
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																				
							<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<label>Título de Listados</label>													
								<select class="form-control" name="titulo_list" id="titulo_list">
									<option value="LISTADO PARA CORTE">LISTADO PARA CORTE</option>
									<option value="LISTADO DE COBRANZA">LISTADO DE COBRANZA</option>
									<option value="LISTADO PARA AUDITORIA">LISTADO PARA AUDITORIA</option>
									<option value="LISTADO DE INTERNET">LISTADO DE INTERNET</option>
									<option value="LISTADO DE RETIRO DE CABLE">LISTADO DE RETIRO DE CABLE</option>
								</select>
							</div>
							
							<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<label>Orden de Listado</label>													
								<select class="form-control" name="orden_list" id="orden_list">
									<option value="">Seleccione...</option>
									<option value="nombre_zona ,nombre_sector">nombre_zona ,nombre_sector </option>
									<option value="nombre_ciudad, nombre_zona ,nombre_sector, nombre_calle">ciudad, zona, sector , calle</option>
									<option value="nombre_ciudad, nombre_zona ,nombre, apellido">ciudad, zona, nombre, apellido</option>
									<option value="nombre_ciudad, nombre_zona ,apellido, nombre">ciudad, zona, apellido, nombre</option>
									<option value="nombre, apellido">nombre, apellido</option>
									<option value="apellido, nombre">apellido, nombre</option>
								</select>
							</div>
							
							<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<label>Listado de Campos a Mostrar</label>													
								<select class="form-control" name="tipo_lista" id="tipo_lista" onchange="">
									<option value="LISTADO CORTO PARA CORTE">LISTADO CORTO PARA CORTE</option>								
									<option value="LISTADO GENERAL AUDITORIA">LISTADO GENERAL AUDITORIA</option>
								</select>
							</div>
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label>Observación Aviso</label >					
								<textarea class="form-control" name="obser_aviso" rows="1" maxlength="100"></textarea>
							</div>
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">								
								<label></label>
								<input type="checkbox" name="checksalto" onclick="" checked>
								<?php echo _("SALTO EN CADA SECTOR DIFERENTE");?> 
							</div>		

							<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
							
								<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("buscar");?>" onclick="buscarCortar()"><i class="fa fa-search"></i> Buscar</button>								
								<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','status_contrato')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>												
														
							</div>	
									
						</div>				
								
				</div> <!-- FIN DEL PANEL -->	
				
		</section>

	</div>	
 	
 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">		
			<div class="panel-body">
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">

					<button class="btn btn-success" disabled type="button" name="eliminar" value="<?php echo _("imprimir listado formato 1");?>" onclick="guardar_cortar_servicio()"><i class="fa fa-print"></i> Imprimir Listado Formato 1</button>
					<button class="btn btn-success" disabled type="button" name="eliminar1" value="<?php echo _("imprimir listado formato 2");?>" onclick="guardar_cortar_servicio2()"><i class="fa fa-print"></i> Imprimir Listado Formato 2</button>
				</div>	
			</div> <!-- FIN DEL PANEL -->	
		</section>	
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
		<section class="panel">		
			<div class="panel-body">
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					
					<button class="btn btn-warning" disabled type="button" name="modificar" value="<?php echo _("Aviso Cobro");?>" onclick="imprimir_aviso()"><i class="glyphicon glyphicon-ok-circle"></i> Aviso Cobro</button>
					<button class="btn btn-warning" disabled type="button" name="modificar1" value="<?php echo _("Aviso Suspensión");?>" onclick="imprimir_aviso_susp()"><i class="glyphicon glyphicon-remove-circle"></i> Aviso Suspensión</button>
					<input class="form-control" disabled type="hidden" name="modificar2" value="<?php echo _("Estado de Cuenta");?>" onclick="estado_cuenta_b()">
				</div>	
			</div> <!-- FIN DEL PANEL -->	
		</section>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<section class="panel">		
				<div class="panel-body">	
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
							
							<button class="btn btn-danger" type="button" disabled type="<?php echo $obj->el; ?>" class="boton" name="procesos_corte" value="<?php echo _("Generar proceso de corte");?>" onclick="guardar_cortar_servicio_proc()"><i class="glyphicon glyphicon-share"></i> Generar Proceso de Corte</button>
							
							<button class="btn btn-danger" type="button" disabled type="<?php echo $obj->el; ?>" class="boton" name="callcenter" value="<?php echo _("Generar proceso de corte");?>" onclick="habilita_listado_llamada()"><i class="glyphicon glyphicon-share"></i> Call Center</button>
											
							<button class="btn btn-danger" type="button"  type="<?php echo $obj->el; ?>" class="boton" name="callcfdenter" value="<?php echo _("Generar proceso de corte");?>" onclick="auditoria_por_poste()"><i class="glyphicon glyphicon-share"></i>AUDITORIA POR POSTE</button>
													
						</div>	
					</div>		
				</div> <!-- FIN DEL PANEL -->	
		</section>		
 	</div>

 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<section class="panel"  id="divcallcenter" style="display:none;">
				<div class="panel-body">	
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" >
							
							<div class="form-group col-lg-5 col-md-12 col-sm-12 col-xs-12">
								<label>observacion Listado llamada</label >
								<textarea class="form-control" name="obser_all" rows="1"></textarea>
								<!--span class="campo_oblig">&nbsp;*&nbsp;</span-->
							</div>
							<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<label>Ubicacion</label>													
								<input class="form-control" type="text" name="ubica_all" maxlength="30" size="30" value=""  >
							</div>
							<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<label>responsable</label>													
								<select class="form-control" name="login_resp" id="login_resp" >
									<?php echo verUsuariosPersona($acceso);?>
								</select>
							</div>
							<div id="callcenter" class="form-btn col-lg-2 col-md-4 col-sm-6 col-xs-12" >
								<button class="btn btn-danger" type="button"  type="<?php echo $obj->el; ?>" class="boton" name="llamadacallcenter" value="<?php echo _("Generar proceso de corte");?>" onclick="guardar_listado_llamada()"><i class="glyphicon glyphicon-share"></i> Imprimir</button>
							</div>							
						</div>	
					</div>		
				</div> <!-- FIN DEL PANEL -->	
		</section>	
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
 	
		<section class="panel">		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Listado de los Abonados</header>
			
				<div class="panel-body">	
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						<div id="datagrid" class="data"></div>						
						
					</div>		
			</div> <!-- FIN DEL PANEL -->	
		</section>	 
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