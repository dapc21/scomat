<?php session_start();require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PROMOCIONES')))
{
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_crear_promocion" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Crear Promociones</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Promoción</header>
		
		<div class="panel-body">
		
		<input  type="HIDDEN" name="login" maxlength="25" size="30" value="<?php echo $_SESSION["login"];?>" >
		<input  type="HIDDEN" name="id_promo" maxlength="8" size="30"onChange="validarpromocion()" value="<?php $acceso->objeto->ejecutarSql("select *from promocion  where (id_promo ILIKE '$ini_u%') ORDER BY id_promo desc"); echo $ini_u.verCo($acceso,"id_promo")?>">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Promoción</label>
				<input class="form-control" type="text" name="nombre_promo" maxlength="50" size="90" value="" onChange="validar_nom_promocion();">
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<label>Fecha Creación</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" disabled type="text" name="fecha_promo" id="fecha_promo" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<label>Duración</label>
				<select class="form-control"  name="mes_promo" id="-1" onchange="">
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
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="inicio_promo" id="inicio_promo" maxlength="10" size="30" value="" onchange="calculafechapromocion()">
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Válido Hasta</label>
				<input disabled class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fin_promo" id="fin_promo" maxlength="10" size="30" value="" >
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Tipo de Descuento</label>
				<select class="form-control"  name="tipo_promo" id="-1" onchange="">
					<option value="0">Seleccione...</option>
					<option value="PORCENTAJE DESCUENTO">PORCENTAJE DESCUENTO</option>
					<option value="MONTO DESCUENTO">MONTO DESCUENTO</option>
					<option value="MONTO FIJO">MONTO FIJO</option>
				</select>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Descuento</label>
				<input class="form-control"  type="text" name="descuento_promo" maxlength="10" size="30" value="" >
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Estatus</label >
				<div>
					&nbsp;<?php echo _("ACTIVO");?>
					<input  type="radio" name="status_promo" value="ACTIVO"CHECKED>&nbsp;&nbsp;&nbsp;
					<?php echo _("INACTIVO");?>
					<input  type="radio" name="status_promo" value="INACTIVO">					
				</div>
			</div>
		</div>
		
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	<section class="panel">		
	
		<input  type="hidden" value="dato" name="dato">
		
		<div class="panel-body">
			
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','promocion');"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button class="btn btn-warning" type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','promocion');"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
			<button class="btn btn-danger" type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','promocion');"><i class="fa fa-trash-o"></i> Eliminar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','promocion');" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>
			
		</div> <!-- FIN DEL PANEL -->

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<header class="panel-heading">Datos de los Servicios a los que Aplican</header>
		<div class="panel-body">
			<div id="servi_promo" class="data"></div>
		</div> <!-- FIN DEL PANEL -->

	</section>
	<section class="panel">
		<header class="panel-heading">Datos de las Promociones Registradas</header>
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