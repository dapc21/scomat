<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('AREGAR_PROMOCION')))
{
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_asignar_promocion" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Asignar Promociones a los Abonados</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Búsqueda de Abonados</header>
		
		<div class="panel-body">
		
		<input  type="HIDDEN" name="login" maxlength="25" size="30" value="<?php echo $_SESSION["login"];?>" >
		<input  type="hidden" name="nombre_promo" maxlength="50" size="90" value="" >
		<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
		
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
				<input class="form-control" readonly type="text" name="status_pago" maxlength="15" size="15" value="" >
			</div>
			</div>

		</div> <!-- FIN DEL PANEL -->
	
	</section>
	<section class="panel">

		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Promociones</header>
	
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Promoción</label>
				<select class="form-control" name="id_promo" id="id_promo" onchange="cargar_promocion();">
					<?php echo verPromocionesActivas($acceso);?>
				</select>
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<label>Fecha Creación</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" disabled type="text" name="fecha_promo" id="fecha_promo" maxlength="10" size="30" value="" >
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<label>Duración</label>
				<select class="form-control" disabled name="mes_promo" id="-1" onchange="">
					<option value="0">Seleccione...</option>
					<option value="1">1 MES</option>
					<option value="2">2 MESES</option>
					<option value="3">3 MESES</option>
					<option value="4">4 MESES</option>
					<option value="5">5 MESES</option>
					<option value="6">6 MESES</option>
					<option value="12">12 MESES</option>
					<option value="24">24 MESES</option>
					<option value="36">36 MESES</option>
					<option value="48">48 MESES</option>
					<option value="60">60 MESES</option>
				</select>
			</div>
			
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Válido Desde</label>
				<input onchange="calculafechapromocion()" class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="inicio_promo" id="inicio_promo" maxlength="10" size="30" value="">
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Válido Hasta</label>
				<input disabled class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fin_promo" id="fin_promo" maxlength="10" size="30" value="" >
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Tipo de Descuento</label>
				<select class="form-control" disabled name="tipo_promo" id="-1" onchange="">
					<option value="0">Seleccione...</option>
					<option value="PORCENTAJE DESCUENTO">PORCENTAJE DESCUENTO</option>
					<option value="MONTO DESCUENTO">MONTO DESCUENTO</option>
					<option value="MONTO FIJO">MONTO FIJO</option>
				</select>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Descuento</label>
				<input class="form-control" disabled type="text" name="descuento_promo" maxlength="10" size="30" value="" >
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Estatus</label >
				<div>
					&nbsp;<?php echo _("ACTIVO");?>
					<input  type="radio" name="status_promo_con" value="ACTIVO"CHECKED>&nbsp;&nbsp;&nbsp;
					<?php echo _("INACTIVO");?>
					<input  type="radio" name="status_promo_con" value="INACTIVO">					
				</div>			
			</div>

		</div> <!-- FIN DEL PANEL -->
	
	</section>

	<input type="hidden" name="id_promo_con" maxlength="10" size="30" onChange="validarpromo_contrato();" value="<?php $acceso->objeto->ejecutarSql("select * from promo_contrato where (id_promo_con ILIKE '$ini_u%')  ORDER BY id_promo_con desc"); echo $ini_u.verCo($acceso,"id_promo_con")?>">
	<input  type="hidden" value="dato" name="dato">

	<section class="panel">			

		<div class="panel-body">
			
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("AGREGAR")?>" onclick="verificar('incluir','promo_contrato');"><i class="glyphicon glyphicon-ok"></i> Agregar</button>
				<button class="btn btn-warning" disabled type="<?php echo $obj->mo; ?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','promo_contrato')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','agregar_promo_contrato')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				<input class="btn btn-danger" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','promo_contrato')">
			</div>			
			
		</div> <!-- FIN DEL PANEL -->

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	<section class="panel">
		<header class="panel-heading">Datos de las Promociones Agregadas a Clientes</header>
		<div class="panel-body">
			<div id="datagrid" class="data">
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