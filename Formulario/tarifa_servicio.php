<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('tarifa_servicio')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Tarifas</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Tarifa</header>
			<div class="panel-body">	
			
				<input class="form-control" type="hidden" name="id_tar_ser" id="id_tar_ser" maxlength="8" size="20"onChange="validartarifa_servicio()" value="<?php $acceso->objeto->ejecutarSql("select *from tarifa_servicio  where (id_tar_ser ILIKE '$ini_u%') ORDER BY id_tar_ser desc"); echo $ini_u.verCo($acceso,"id_tar_ser")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Tipo de Servicio</label>													
							<select class="form-control" name="id_tipo_servicio" id="id_tipo_servicio" onchange="cargarServicio_n()">
							<?php echo verTipoSer($acceso);?>
							</select>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Tipo de Paquete</label>													
							<select  class="form-control" name="tipo_paq" id="tipo_paq">
								<option value="">Seleccione...</option>
								<option value="PAQUETE BASICO"><?php echo _("paquete basico");?></option>
								<option value="PAQUETE ADICIONAL"><?php echo _("paquete adicional");?></option>
							</select>
							
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Tipo de costo</label>													
							<select   class="form-control" name="tipo_costo" id="tipo_costo">
								<option value="">Seleccione...</option>
								<option value="COSTO MENSUAL">COSTO MENSUAL</option>
								<option value="COSTO UNICO">COSTO UNICO</option>
							</select>
							
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Clasificación</label>													
						<select   class="form-control" name="tipo_serv" id="tipo_serv">
							<option value="">Seleccione...</option>
							<option value="OTROS"><?php echo _("OTROS");?></option>
							<option value="MENSUALIDAD"><?php echo _("MENSUALIDAD");?></option>
							<option value="INSTALACION"><?php echo _("INSTALACION");?></option>
							<option value="RECONEXION"><?php echo _("RECONEXION");?></option>
							<option value="PUNTO ADICIONAL"><?php echo _("PUNTO ADICIONAL");?></option>
						</select>	
						
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>PAQUETE</label>													
							<select   class="form-control" name="id_paq" id="id_paq">
								<option value="">Seleccione...</option>
								<?php echo ver_paquete($acceso);?>
							</select>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>CANT TV</label>													
							<select  class="form-control" name="id_cant" id="id_cant">
								<option value="">Seleccione...</option>
								<?php echo ver_cant_tv($acceso);?>
							</select>
					</div>

				</div>
			<input class="form-control" type="hidden" value="dato" name="dato" id="dato">
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Tarifa</header>
			<div class="panel-body">	
			
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Fecha Cambio Tarifa</label >
						<input data-parsley-id="fecha_tar_ser" required=""  class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_tar_ser" data-mask="99/99/9999" id="fecha_tar_ser" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
						<ul id="parsley-id-fecha_tar_ser" class="parsley-errors-list"></ul>			
					</div>
				</div>
			<input class="form-control" type="hidden" value="dato" name="dato" id="dato">
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-warning" type="button" id="buscar" value="Buscar" onclick="filtrar_servicios()"><i class="fa fa-search"></i> buscar</button>
				<button  class="btn btn-success" type="button" type="<?php echo $obj->in;?>" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_tarifa_servicio('incluir','tarifa_servicio')"><i class="glyphicon glyphicon-ok"></i> Registrar Tarifas</button>		
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_tarifa_servicio()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
		
	<section class="panel" id="tabla-tarifa-servicio">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Tarifas Registradas</header>
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