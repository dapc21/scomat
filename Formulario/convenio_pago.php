<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CONVENIO_PAGO')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="convenio_pago" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Convenio de Pago</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Búsqueda de Clientes</header>
		
		<div class="panel-body">		

			<input class="form-control" type="hidden" name="nombre_promo" maxlength="50" size="90" value="" >		
			<input class="form-control" type="hidden" name="id_contrato" maxlength="10" size="15" value="">
			
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>N° de Abonado</label>
				<div class="input-group">
					<input class="form-control" type="text" name="nro_contrato" onChange="validarcontrato();" maxlength="11" size="12" value="" >
					<div class="input-group-btn">
						<button type="button" class="btn btn-info" id="buscar_abonado" onclick="validarcontrato();"><i class="fa fa-search"></i></button>	
					</div>
				</div>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>RIF/Cédula</label>
				<div class="input-group">
				<input class="form-control" type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula();">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick="buscarXcedula();"><i class="fa fa-search"></i></button>	
				</div>
				</div>
			</div>
			<div class="form-group">
				<label><i class="fa fa-edit label-blanco"></i></label>
				<div class="form-btn col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left">
				<input class="form-control" type="hidden" value="0" name="tipo_s" value="AUTOMATICO">	
				<button type="button" class="btn btn-info contenido-boton" id="buscar_avanzado_consultar_clientes" name="agregar" onclick="ajaxVentana_BA('Abonados', this.id);" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Realice búsquedas por múltiples criterios." data-original-title="BÚSQUEDA AVANZADA">
				<i class="fa fa-search"></i> <!--Busqueda Avanzada-->
				</button>
				</div>
			</div>
	
		</div>
			
		</div> <!-- FIN DEL PANEL -->	
			
	</section>
			
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Cliente</header>
		
		<div class="panel-body">		
						
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Nombre</label>													
					<input class="form-control" readonly type="text" name="nombre" maxlength="30" size="15" value="" >
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Apellido</label>													
					<input class="form-control" readonly type="text" name="apellido" maxlength="30" size="15" value="" >
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Estatus</label>													
					<input class="form-control" readonly type="text" name="status_pago" maxlength="15" size="15" value="" >
				</div>
				
			</div>
			
		</div> <!-- FIN DEL PANEL -->	
			
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Convenio de Pago</header>
		
		<div class="panel-body">		
			<input class="form-control" type="hidden" name="id_conv" maxlength="8" size="30"onChange="validarconvenio_pago()" value="<?php $acceso->objeto->ejecutarSql("select *from convenio_pago where (id_conv ILIKE '$ini_u%')  ORDER BY id_conv desc"); echo $ini_u.verCo($acceso,"id_conv")?>">			
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>Fecha Convenio</label>																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_conv" data-mask="99/99/9999" id="fecha_conv" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >																						
				</div>
				
				<div class="form-group col-lg-8 col-md-4 col-sm-6 col-xs-12">
						<label>Estatus del Convenio</label>
						<div >
							<input  type="radio" name="status_conv" value="ACTIVO" CHECKED > &nbsp;Activo &nbsp;				
							<input  type="radio" name="status_conv" value="INACTIVO"> &nbsp;Inactivo
						</div>	
				</div>
				
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>Observación</label >
					<textarea class="form-control" name="obser_conv" cols="90" rows="1"></textarea>																	
				</div>
				
			</div>
			
		<input class="form-control" type="HIDDEN" name="login" maxlength="25" size="30" value="<?php echo $_SESSION["login"];?>" >
		<input class="form-control" type="hidden" value="dato" name="dato">
		</div> <!-- FIN DEL PANEL -->	
			
	</section>	
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" class="boton" name="registrar" value="REGISTRAR" onclick="verificar('incluir','convenio_pago')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" class="boton" name="modificar" value="MODIFICAR" onclick="verificar('modificar','convenio_pago')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" class="boton" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','convenio_pago')"><i class="fa fa-trash-o"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','convenio_pago')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i>Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>			
			
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-convenio-pendiente">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Cargos Pendientes</header>
		
		<div class="panel-body">		
						
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>Fecha Limite</label>																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_lim" data-mask="99/99/9999" id="fecha_lim" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >																						
				</div>
			
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div id="datagrid" class="data"></div>
				
			</div>
			
		</div> <!-- FIN DEL PANEL -->	
			
	</section>			
		
		
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Convenios Creados</header>
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="convenios" class="data"></div>						
					
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