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
	<div class="border-head"><h3>Listado de Llamadas</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Por Ubicación</header>
		
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Franquicia</label>
						<select class="form-control" name="id_franq" id="id_franq" onchange="cargar_estado();">
							<?php echo verFranquicia($acceso);?>
						</select>						
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Estado</label>													
						<select class="form-control" name="id_esta" id="id_esta" onchange="traer_pais();cargar_municipio();">
							<?php echo verEstado($acceso);?>
						</select>						
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Municipio</label>													
						<select class="form-control" name="id_mun" id="id_mun" onchange="traer_estado();cargar_ciudad();">
							<?php echo verMun($acceso);?>
						</select>						
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Ciudad</label>													
						<select class="form-control" name="id_ciudad" id="id_ciudad" onchange="traer_municipio();cargarZona();">
							<?php echo verCiudad($acceso);?>
						</select>						
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Zonas</label>													
						<select class="form-control" name="id_zona" id="id_zona" onchange="traer_ciudad();cargarSector();" style="height: 100px;"  multiple="multiple">
							<?php echo verZona($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Sectores</label>													
						<select class="form-control" name="id_sector" id="id_sector" onchange="traerZona();cargarCalle();cargarUrb();" style="height: 100px;" multiple="multiple">
							<?php echo verSector($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Urbanización</label>													
						<select class="form-control" name="urbanizacion" id="urbanizacion" onchange="traerSectorUrb();">
							<?php echo verUrb($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Calle</label>													
						<select class="form-control" name="id_calle" id="id_calle"  onchange="traerSector()">
							<?php echo verCalle($acceso);?>
						</select>
					</div>
			
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>

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
									<div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-12">
									<input  type="checkbox" name="status_contrato" value="'.trim($row["nombrestatus"]).'">
									'.trim($row["nombrestatus"]).
									'</div>';
							}
							echo '</div>';
						?>
						
					</div>

			</div> <!-- FIN DEL PANEL -->	
			
	</section>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Parámetros de llamadas</header>
			<div class="panel-body">
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>Desde</label>																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="desde" data-mask="99/99/9999" id="desde" maxlength="10" size="10" value="" >																														
					</div>

					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>Hasta</label>																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="hasta" data-mask="99/99/9999" id="hasta" maxlength="10" size="10" value="" >																														
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>TIPO LLAMADA</label>
							<select class="form-control" name="id_tll" id="id_tll" onchange="">
								<?php echo verTipoLlamada($acceso);?>
							</select>
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>TIPO RESPUESTA</label>													
						<select class="form-control" name="id_trl" id="id_trl" onchange="cargar_detalle_resp();">
							<?php echo verTipoResp($acceso);?>
						</select>	
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>DETALLE RESPUESTA</label>													
						<select class="form-control" name="id_drl" id="id_drl" onchange="traer_tipo_resp()">
							<?php echo verDetalleResp($acceso);?>
						</select>	
					</div>
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>responsable</label>													
							<select class="form-control" name="login_resp" id="login_resp" >
								<?php echo verUsuariosPersona($acceso);?>
							</select>
					</div>
						
					</div>
							
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						
						<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("buscar");?>" onclick="buscarlistado_llamada()"><i class="fa fa-search"></i> Buscar</button>								
						<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','reporte_callcenter')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>												
												
					</div>	
				</div>		
			</div> <!-- FIN DEL PANEL -->	
	</section>			
 	
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Listado de los Abonados</header>
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>						
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
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