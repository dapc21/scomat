<?php 
	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_NOTAS')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_rep_notas" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Reporte Auditoria de Notas de Débito y Crédito</h3></div>
	
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">
		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Clientes por Ubicación</header>
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="has-js">
								<div class="radios">						
																																
										<input disabled type="radio" name="status_serv" value="GENERAL" onchange="hab_total_cli_ubi()">General&nbsp;&nbsp;&nbsp;
										<input  type="radio" name="status_serv" value="ESPECIFICO" CHECKED onchange="hab_total_cli_ubi()">Especifico
								</div>	
							</div>	
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
			<header class="panel-heading">Datos de la Nota</header>
				<div class="panel-body">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">												
					
						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Generado Por</label>													
							<select class="form-control" name="generado_por" id="generado_por">
								<option value=""><?php echo _("todos");?></option>
								<option value="USUARIO"><?php echo _("usuario");?></option>
								<option value="SISTEMA"><?php echo _("sistema");?></option>
							</select>
						</div>	

						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>IP del equipo</label>													
							<select class="form-control" name="dir_ip" id="dir_ip">
								<option value=""><?php echo _("todos");?></option>
								<?php echo verDirIp($acceso);?>
							</select>
						</div>	
						
						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Tipo</label>													
							<select class="form-control" name="tipo" id="tipo">
								<option value=""><?php echo _("todos");?></option>
								<option value="NOTA DE CREDITO"><?php echo _("nota de credito");?></option>
								<option value="NOTA DE DEBITO"><?php echo _("nota de debito");?></option>
							</select>
						</div>	
						
						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Motivo</label>													
							<select class="form-control" name="idmotivonota" id="idmotivonota">
								<option value=""><?php echo _("todos");?></option>
								<?php echo verMotivoNotas($acceso);?>
							</select>
						</div>	
						
						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Solicitado Por</label>													
							<select class="form-control" name="login" id="login">
								<option value=""><?php echo _("todos");?></option>
								<?php echo verUsuarios($acceso);?>
							</select>
						</div>
						
						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Autorizado Por</label>													
							<select class="form-control" name="login_aut" id="login_aut">
								<option value=""><?php echo _("todos");?></option>
								<?php echo verUsuarios($acceso);?>
							</select>
						</div>
												
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
						
						<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label>Por fecha</label>
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
				
				<button class="btn btn-success" type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_notas()"><i class="fa fa-search"></i> Buscar</button>								
										
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
 
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">clientes encontrados</header>
		
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