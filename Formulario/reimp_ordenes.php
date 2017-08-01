<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REIMP_ORDENES')))
{
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_cargar_deuda" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Reimprimir Órdenes de Servicios</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Búsqueda</header>
		
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Nº de Abonado</label>
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
				<input class="form-control" type="text" name="cedula_b" maxlength="10" size="10" value="" onChange="buscarXcedula();">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick="buscarXcedula();"><i class="fa fa-search"></i></button>	
				</div>
				</div>
			</div>
			<div class="form-group">
				<!--a href="#" onclick="abrirBusq_cont_avanz()" ><img src="imagenes/busAvanz1.png" width="150px" height="25px" title="Busqueda Avanzada"></a-->
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
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">

		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Abonado</header>
	
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
				<label>Nombre(s)</label>
				<input  class="form-control" readonly type="text" name="nombre" maxlength="30" size="15" value="" >

			</div>
			<div class="form-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
				<label>Apellido(s)</label>
				<input class="form-control" readonly type="text" name="apellido" maxlength="30" size="15" value="" >

			</div>
			<div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-6">
				<label>Estatus</label>
				<input class="form-control" readonly type="text" name="status_contrato" maxlength="15" size="15" value="" >
			</div>
			</div>

		</div> <!-- FIN DEL PANEL -->
	
	</section>
	<section class="panel">
	
		<header class="panel-heading">Datos de las Órdenes de Servicios</header>
		
		<div class="panel-body">
			<div id="datagrid" class="data"></div>		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
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