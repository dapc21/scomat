<?php 
require_once "../procesos.php"; 
$id_f = $_SESSION["id_franq"];  
$cedula=$_GET['cedula'];
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >		

	
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">parametros de para la búsqueda Avanzada</header>
			<div class="panel-body" bgcolor="#ffffff">	

				<script>
				archivoDataGrid="busqueda/busq_cont_avanz.php";
				//updateTable();
				</script>
				<input class="form-control" type="hidden" value="<?php echo $id_franq;?>" id="bid_f" >
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">			
				
					<div class="form-group col-lg-6 col-md-4 col-sm-12 col-xs-12">
						<label>nombre</label>												
						<input class="form-control" type="text" id="bnombre" maxlength="30" size="15" value="" onKeyPress="return buscarC(event)">
					</div>	
					
					<div class="form-group col-lg-6 col-md-4 col-sm-12 col-xs-12">
						<label>apellido</label>												
						<input class="form-control" type="text" id="bapellido" maxlength="30" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>	
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>rif/cédula</label>												
						<input class="form-control" type="text" id="bcedula" maxlength="10" size="15" value="<?php echo $cedula;?>" onKeyPress="return buscarC(event)">
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>nro abonado</label>												
						<input class="form-control" type="text" id="bnro_contrato" maxlength="100" size="15" value="" onKeyPress="return buscarC(event)">
					</div>

					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>contrato fisico</label>												
						<input class="form-control" type="text" id="bcontrato_fisico" maxlength="10" size="15" value="" onKeyPress="return buscarC(event)">
					</div>										
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>precinto</label>												
						<input class="form-control" type="text" id="betiqueta" maxlength="11" size="15" value="" onKeyPress="return buscarC(event)">
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Fecha</label>
						<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" id="bfecha_contrato" maxlength="10" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>	
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Franquicia</label>
						<select class="form-control" <?php echo $disab;?> id="bid_franq" onchange="bcargarZona_franq()">
							<?php echo verFranquicia($acceso);?>
						</select>
					</div>	
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Zona</label>
						<select class="form-control" id="bid_zona" onchange="bcargarSector()">
							<?php echo verZona_franquicia($acceso);?>
						</select>
					</div>	
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Sector</label>
						<select class="form-control" id="bid_sector" onchange="bcargarCalle()">
							<option value="0"><?php echo _("Seleccione...");?></option>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Calle</label>
						<select class="form-control" id="bid_calle"   onchange="">
							<option value="0"><?php echo _("Seleccione...");?></option>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>status cont</label>
						<select class="form-control" id="bstatus_contrato">
							<option value=""><?php echo _("todos");?></option>
							<?php echo verStatusCont($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>grupo de afinidad</label>
						<select class="form-control" id="bid_g_a"  onchange="">
							<?php echo verGrupoAfinidad($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>vendedor</label>
						<select class="form-control" id="bid_persona"  onchange="">
							<?php echo verVendedores($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>cobrador</label>
						<select class="form-control" id="bcod_id_persona" onchange="">
							<?php echo verCobradores($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>celular</label>
						<input class="form-control" type="text" id="btelefono" maxlength="11" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>teléfono</label>
						<input class="form-control" type="text" id="btelf_casa" maxlength="11" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>nro casa / apto</label>
						<input class="form-control" type="text" id="bnumero_casa" maxlength="10" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>poste</label>
						<input class="form-control" type="text" id="bpostel" maxlength="20" size="20" value="" >
					</div>
					
				</div>
				
				<!--div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					<button class="btn btn-success" type="button" id="registrar" value="Buscar" onclick="buscarContAvanz()"><i class="fa fa-search"></i> buscar</button>		
					<button class="btn btn-info" type="button" id="Resetear" value="Limpiar" onclick="limpiarBusqAvanz()"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>				
					<button class="btn btn-default" type="button"  id="Salir" value="CERRAR" onclick="cerrarBusqAvanz()"><i class=""></i> Cerrar</button>				
				</div-->
				
			</div> <!-- FIN DEL PANEL -->
				
	</section>	
	<section class="panel">
		<header class="panel-heading">resultados encontrados de la búsqueda</header>	
			<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="datagrid_busqueda"></div>	
				</div>	
			</div> <!-- FIN DEL PANEL -->
	</section>
	

	
</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->		
			
	
		