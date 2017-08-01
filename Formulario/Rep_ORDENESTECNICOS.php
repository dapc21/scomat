<?php 
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('Rep_ordenes')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="Rep_ORDENESTECNICOS" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Reporte de Órdenes de Servicios</h3></div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	

			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Responsable</header>
					
					<div class="panel-body">
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">																									
								
								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Emisión</label>													
									<select class="form-control" name="login_emi" id="login_emi">
										<?php echo respon_emi($acceso);?>
									</select>
								</div>
								
								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Impresión</label>													
									<select class="form-control" name="login_imp" id="login_imp">
										<?php echo respon_imp($acceso);?>
									</select>
								</div>
								
								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Cierre por Sistema</label>													
									<select class="form-control" name="login_final" id="login_final">
										<?php echo respon_fin($acceso);?>
									</select>
								</div>
								
								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Grupo de Trabajo</label>													
									<select class="form-control" name="id_gt" id="id_gt">
										<?php echo verGrupoTecnico_rep($acceso);?>
									</select>
								</div>
							
							</div>				
									
					</div> <!-- FIN DEL PANEL -->	
					
			</section>

		</div> <!-- FIN DEL DIV COL 6 -->

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	

				<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Clasificación de Orden</header>
					
					<div class="panel-body">
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">																																																	

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Estatus de Orden</label>													
									<select class="form-control" name="status_orden" id="status_orden">
										<option value=""><?php echo _("todos");?></option>
										<option value="CREADO"><?php echo _("CREADO");?></option>
										<option value="IMPRESO"><?php echo _("impreso");?></option>
										<option value="FINALIZADO"><?php echo _("finalizado");?></option>
										<option value="DEVUELTA"><?php echo _("devuelta");?></option>
										<option value="CANCELADA"><?php echo _("cancelada");?></option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Tipo de Orden</label>													
									<select class="form-control" name="id_tipo_orden" id="id_tipo_orden" onchange="cargarDO();">
										<?php echo verTipoOrden($acceso);?>
									</select>
								</div>
								
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label>Detalle Orden</label>													
									<select class="form-control" name="id_det_orden" id="id_det_orden" onchange="traerTO();">
										<?php echo verDetalleOrden($acceso);?>
									</select>
								</div>								
																							
							</div>
															
					</div> <!-- FIN DEL PANEL -->	
					
			</section>	

		</div> <!-- FIN DEL DIV COL 6 -->		

	</div><!-- FIN DEL DIV COL 12 -->		

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">
		
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Otros Parámetros</header>
					<div class="panel-body">
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">																									
								
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label>Por fecha</label>
									<div class="has-js">
										<div class="radios">						
																															
											<input  type="radio" name="tipo_costo" value="GENERAL"CHECKED  onchange="hab_total_cli_fec()"> General
											
											<input  type="radio" name="tipo_costo" value="ESPECIFICO" onchange="hab_total_cli_fec()"> Especifico
											
										</div>	
									</div>	
								</div>	
								
								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Desde</label>																		
									<input class="form-control form-control-inline input-medium default-date-picker" disabled type="text" name="desde" data-mask="99/99/9999" id="desde" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >																														
								</div>

								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Hasta</label>																		
									<input class="form-control form-control-inline input-medium default-date-picker" disabled type="text" name="hasta" data-mask="99/99/9999" id="hasta" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >																														
								</div>	

								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<label>Concepto</label>																		
									<select class="form-control" name="por_fecha" id="por_fecha">
										<option value="fecha_orden"><?php echo _("asignacion");?></option>
										<option value="fecha_imp"><?php echo _("impresion");?></option>
										<option value="fecha_final"><?php echo _("finalizacion");?></option>
										<option value="fecha_cierre"><?php echo _("cierre por sistema");?></option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Grupo de Afinidad</label>													
									<select class="form-control" name="id_g_a" id="id_g_a" onchange="">
										<?php echo verGrupoAfinidad($acceso);?>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Estatus del Contrato</label>													
									<select class="form-control" name="status_contrato" id="status_contrato">
										<option value=""><?php echo _("todos");?></option>
										<?php echo verStatusCont($acceso);?>
									</select>
								</div>																
							
							</div>
														
					</div> <!-- FIN DEL PANEL -->	
					
			</section>	

		</div> <!-- FIN DEL DIV COL 6 -->

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Clientes por Ubicación</header>
					<div class="panel-body">

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Franquicia</label>
								<select class="form-control" name="id_franq" id="id_franq" onchange="cargar_estado()">
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
								<label>ciudad</label>													
								<select class="form-control" name="id_ciudad" id="id_ciudad" onchange="traer_municipio();cargarZona();">
									<?php echo verCiudad($acceso);?>
								</select>						
							</div>
							
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Zona</label>													
								<select class="form-control" name="id_zona" id="id_zona" onchange="traer_ciudad();cargarSector();">
									<?php echo verZona($acceso);?>
								</select>						
							</div>
							
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Sectores</label>													
								<select class="form-control" name="id_sector" id="id_sector" onchange="traerZona();cargarCalle();cargarUrb();">
									<?php echo verSector($acceso);?>
								</select>
							</div>

							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Calle</label>													
								<select class="form-control" name="id_calle" id="id_calle"  onchange="traerSector()">
									<?php echo verCalle($acceso);?>
								</select>
							</div>
							
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Urbanización</label>													
								<select class="form-control" name="urbanizacion" id="urbanizacion" onchange="traerSectorUrb()">
									<?php echo verUrb($acceso);?>
								</select>
							</div>														
					
					</div>
					
				</div> <!-- FIN DEL PANEL -->
			
			</section>

		</div> <!-- FIN DEL DIV COL 6 -->		

	</div><!-- FIN DEL DIV COL 12 -->

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">		
			<div class="panel-body">
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					
					<button class="btn btn-success" type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_ordenes()"><i class="fa fa-search"></i> Buscar</button>		
					<button class="btn btn-warning" type="button" name="registDFrar" value="imprimir reporte" onclick="ImprimirRep_ORDENESTECNICOS()"><i class="fa fa-print"></i> Imprimir Reporte</button>		
					<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','Rep_ORDENESTECNICOS')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>																		
											
				</div>	
			</div> <!-- FIN DEL PANEL -->	
		</section>	
	</div>

 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section class="panel">		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Clientes Encontrados</header>
			
				<div class="panel-body">	
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						<div id="datagrid" class="data">
							<input class="form-control" type="hidden" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_totalclientes()">&nbsp;
							<input class="form-control" type="hidden" name="modificar" value="CANCELAR">
							<input class="form-control" type="hidden" name="eliminar" value="CANCELAR">
							<input class="form-control" type="hidden" name="Resetear" value="CANCELAR">
						</div>						
						
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