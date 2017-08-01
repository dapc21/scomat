<?php 
	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('DESCUENTO_LOTES')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="descuento" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Descuento por Lotes</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Clientes Por Ubicación</header>
		
		<div class="panel-body">		

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Seleccione</label>
						<div class="has-js">
							<div class="radios">						
																															
									<input  type="radio" name="status_serv" value="GENERAL"CHECKED onchange="hab_total_cli_ubi()"> General
								
								
									<input  type="radio" name="status_serv" value="ESPECIFICO"  onchange="hab_total_cli_ubi()"> Especifico
								
							</div>	
						</div>	
						
				</div>
				
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>Franquicia</label>
					<select class="form-control" disabled name="id_franq" id="id_franq" onchange="cargarZona()">
						<?php echo verFranquicia($acceso);?>
					</select>
				</div>
				
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>zona</label>													
					<select class="form-control" disabled name="id_zona" id="id_zona" onchange="cargarSector()">
						<?php echo verZona($acceso);?>
					</select>
				</div>										
					
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>sector</label>													
					<select class="form-control" disabled name="id_sector" id="id_sector" onchange="traerZona()">
						<?php echo verSector($acceso);?>
					</select>
				</div>
				
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>Calle</label>													
					<select class="form-control" disabled name="id_calle" id="id_calle"  onchange="traerSector()">
						<?php echo verCalle($acceso);?>
					</select>
				</div>
			
			</div>

		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Clientes Por Status</header>
		
		<div class="panel-body">		

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>Status Contrato</label>													
					<select class="form-control" name="status_contrato" id="status_contrato">
						<option value=""><?php echo _("todos");?></option>
						<?php echo verStatusCont($acceso);?>
					</select>
				</div>
				
				
			</div>

		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">parametros del descuento</header>
		
		<div class="panel-body">		

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
					<label>Monto a Descontar</label >
					<div class="input-group">											
					<input class="form-control" onKeyUp="aplica_nota_dc();" type="text" name="monto_dc" maxlength="8" onchange="<?php echo $validam;?>" value="0">
					<span class="input-group-addon">BsF</span>
					</div>
						
				</div>
				
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>Para el Mes</label >
					<select class="form-control" name="hasta" id="hasta" onchange="">
						<?php echo verMesCorte();?>
					</select>					
				</div>
				
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>clasificacion motivo</label >
					<select class="form-control" name="motivo" id="motivo" onchange="">
						<?php echo verMotivoNotas($acceso);?>
					</select>					
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>describa motivo</label >
					<textarea class="form-control" name="comentario"></textarea>					
				</div>
				
				
			</div>

		</div> <!-- FIN DEL PANEL -->
	
	</section>	
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("buscar");?>" onclick="buscarDesc()"><i class="fa fa-search"></i> Buscar</button>								
						<button class="btn btn-success" type="button" disabled type="<?php echo $obj->mo; ?>" class="boton" name="modificar" value="<?php echo _("realizar descuento");?>" onclick="realizar_desc()"><i class="glyphicon glyphicon-ok"></i> Realizar Descuento</button>
						<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','status_contrato')">&nbsp;					
						<input class="form-control" type="hidden" name="Resetear" value="CANCELAR">
						
						
					</div>	
				</div>		
			</div> <!-- FIN DEL PANEL -->	
	</section>		 
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-estado">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Estados Agregados</header>
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