<?php 
	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_RECUPERADOS')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="Rep_recuperados" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Reporte de Recuperados</h3></div>
	
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Clientes por Ubicación</header>
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Franquicia</label>
						<select class="form-control" name="id_franq" id="id_franq" onchange="cargarZona()">
							<?php echo verFranquicia($acceso);?>
						</select>					
					</div>
						
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Zona</label>													
						<select class="form-control" name="id_zona" id="id_zona" onchange="cargarSector()">
							<?php echo verZona($acceso);?>
						</select>						
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Sector</label>													
						<select class="form-control" name="id_sector" id="id_sector" onchange="traerZona()">
							<?php echo verSector($acceso);?>
						</select>
					</div>
										
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
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
		<header class="panel-heading">Otros Parámetros</header>
			<div class="panel-body">
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																									
						<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>Estatus Actualmente</label>													
							<select class="form-control" name="status_contrato" id="status_contrato">
								<option value=""><?php echo _("todos");?></option>
								<?php echo verStatusCont($acceso);?>
							</select>
						</div>
						
						<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>Meses Transcurridos</label>		
							<!--Se coloco el id="tiempo por tiempo_x ya que daba error el diseño"-->	
							<select class="form-control" name="tiempo" id="tiempo_x">
								<option value="1"><?php echo _("Mas de 1 Mes");?></option>
								<option value="2"><?php echo _("Mas de 2 Meses");?></option>
								<option value="3"><?php echo _("Mas de 3 Meses");?></option>
								<option value="4"><?php echo _("Mas de 4 Meses");?></option>
								<option value="5"><?php echo _("Mas de 5 Meses");?></option>
								<option value="6"><?php echo _("Mas de 6 Meses");?></option>
								<option value="7"><?php echo _("Mas de 7 Meses");?></option>
								<option value="8"><?php echo _("Mas de 8 Meses");?></option>
								<option value="9"><?php echo _("Mas de 9 Meses");?></option>
								<option value="10"><?php echo _("Mas de 10 Meses");?></option>
								<option value="11"><?php echo _("Mas de 11 Meses");?></option>
								<option value="12"><?php echo _("Mas de 1 Año");?></option>
							</select>
						</div>
								
					</div>
							
			</div> <!-- FIN DEL PANEL -->	
			
	</section>	

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Otros Rango de Fechas</header>
			<div class="panel-body">
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																									
						<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label>Por Fecha</label>
							<div class="has-js">
								<div class="radios">						
																														
										<input  type="radio" name="tipo_costo" value="GENERAL"CHECKED  onchange="hab_total_cli_fec()"> General
									
										<input  type="radio" name="tipo_costo" value="ESPECIFICO" onchange="hab_total_cli_fec()"> Especifico
									
								</div>	
							</div>	
						</div>	
						
						<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label>Desde</label>																		
							<input class="form-control form-control-inline input-medium default-date-picker" disabled type="text" name="desde" data-mask="99/99/9999" id="desde" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >																														
						</div>

						<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label>Hasta</label>																		
							<input class="form-control form-control-inline input-medium default-date-picker" disabled type="text" name="hasta" data-mask="99/99/9999" id="hasta" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >																														
						</div>
						
						
								
					</div>
							
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				
				<button class="btn btn-success" type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_recuperados()"><i class="fa fa-search"></i> Buscar</button>								
										
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		
			
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">clientes encontrados</header>
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data">
						<input class="form-control" type="hidden" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_recuperados()">&nbsp;
						<input class="form-control" type="hidden" name="modificar" value="CANCELAR">
						<input class="form-control" type="hidden" name="eliminar" value="CANCELAR">
						<input class="form-control" type="hidden" name="Resetear" value="CANCELAR">
					</div>						
					
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