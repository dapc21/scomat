<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('soporte_pago'))) //validar privilegios
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de soporte_pago</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">
				<input  type="hidden" name="id_pd" id="id_pd" maxlength="" size="10"  value="<?php $acceso->objeto->ejecutarSql("select *from soporte_pago  where (id_pd ILIKE '$ini_u%') ORDER BY id_pd desc"); echo $ini_u.verCoo($acceso,"id_pd")?>">
				<input  type="hidden" name="id_cuba" id="id_cuba" maxlength="" size="10"  value="<?php $acceso->objeto->ejecutarSql("select *from soporte_pago  where (id_cuba ILIKE '$ini_u%') ORDER BY id_cuba desc"); echo $ini_u.verCoo($acceso,"id_cuba")?>">
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>id_cuba</label>
						<textarea data-parsley-id="id_cuba" required=""    data-parsley-type="alphanum" class="form-control" name="id_cuba" id="id_cuba"  rows="1"></textarea>
						<ul id="parsley-id-id_cuba" class="parsley-errors-list"></ul>
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>id_contrato</label>
					<input data-parsley-id="id_contrato" required=""    class="form-control" type="text" name="id_contrato" id="id_contrato" maxlength="10"  value="" >
					<ul id="parsley-id-id_contrato" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>monto_dep</label>
					<input data-parsley-id="monto_dep" required=""    class="form-control" type="text" name="monto_dep" id="monto_dep" maxlength="10"  value="" >
					<ul id="parsley-id-monto_dep" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>fecha_reg</label>
					<input data-parsley-id="fecha_reg" required=""    class="form-control" type="text" name="fecha_reg" id="fecha_reg" maxlength="10"  value="" >
					<ul id="parsley-id-fecha_reg" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>fecha_dep</label>
					<input data-parsley-id="fecha_dep" required=""    class="form-control" type="text" name="fecha_dep" id="fecha_dep" maxlength="10"  value="" >
					<ul id="parsley-id-fecha_dep" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>numero_ref</label>
					<input data-parsley-id="numero_ref" required=""    class="form-control" type="text" name="numero_ref" id="numero_ref" maxlength="20"  value="" >
					<ul id="parsley-id-numero_ref" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>status_pd</label>
					<input data-parsley-id="status_pd" required=""    class="form-control" type="text" name="status_pd" id="status_pd" maxlength="20"  value="" >
					<ul id="parsley-id-status_pd" class="parsley-errors-list"></ul>							
				</div>

					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Status</label>
						<div>
							<input  type="radio" name="tipo_dt" value="ACTIVO"CHECKED>ACTIVO
							&nbsp;&nbsp;&nbsp;<input  type="radio" name="tipo_dt" value="TRANSFERENCIA">TRANSFERENCIA
						</div>
					</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>telefono</label>
					<input data-parsley-id="telefono" required=""    class="form-control" type="text" name="telefono" id="telefono" maxlength="15"  value="" >
					<ul id="parsley-id-telefono" class="parsley-errors-list"></ul>							
				</div>

				<input  type="hidden" value="dato" name="dato" id="dato">
		<tr>
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_soporte_pago('incluir','soporte_pago')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_soporte_pago('modificar','soporte_pago')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_soporte_pago('eliminar','soporte_pago')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_soporte_pago()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos Agregados</header>
			<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid"></div>
					
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
					<input  type="button" class="boton" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>

