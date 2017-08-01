<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CARGAR_DEUDA')))
{
	$acceso->objeto->ejecutarSql("delete from cargar_deuda where id_contrato ilike '$ini_u%'");
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate="" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Cargar Deuda</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Búsqueda de Abonados</header>
		
		<div class="panel-body">
		<input class="form-control" type="hidden" name="id_contrato" id="id_contrato" maxlength="10" size="15" value="">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<label>Nº de Abonado</label>
				<div class="input-group">
				<input data-parsley-id="nro_contrato" required="" class="form-control" type="text" name="nro_contrato" id="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_abonado" onclick=""><i class="fa fa-search"></i></button>	
				</div>
				</div>
				<ul id="parsley-id-nro_contrato" class="parsley-errors-list"></ul>
			</div>												
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<label>RIF/Cédula</label>
				<div class="input-group">				
				<input class="form-control" type="text" name="cedula_b" id="cedula_b" maxlength="10" size="15" value="" onChange="buscar_cedula_contrato()">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick=""><i class="fa fa-search"></i></button>	
				</div>
				</div>
			</div>
			
			<div class="form-group area-btn-agregar col-lg-2 col-md-2 col-sm-12 col-xs-12">					
				<button type="button" class="btn btn-info btn-txt" id="busqueda_avanzada" name="busqueda_avanzada" onclick="ajaxVentana('Abonados', this.id);" >
				<i class="fa fa-search"></i> Busqueda Avanzada
				</button>
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
			<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<label>Nombre(s)</label>
				<input data-parsley-id="nombre" required=""  class="form-control" readonly type="text" name="nombre" id="nombre"  value="" >
				<ul id="parsley-id-nombre" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<label>Apellido(s)</label>
				<input data-parsley-id="apellido" required=""  class="form-control" readonly type="text" name="apellido" id="apellido"  value="" >
				<ul id="parsley-id-apellido" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<label>Estatus</label>
				<input data-parsley-id="status_contrato" required="" class="form-control" readonly type="text" name="status_contrato" id="status_contrato" value="" >
				<ul id="parsley-id-status_contrato" class="parsley-errors-list"></ul>
			</div>
			</div>

		</div> <!-- FIN DEL PANEL -->
	
	</section>
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Deuda a Cargar</header>
	
		<div class="panel-body">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
				<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<label>Tipo de Cargo</label>
					<div class="has-js">
						<div class="radios">
							
								<input type="radio" name="tipo_costo" value="COSTO MENSUAL"checked onchange="activa_serv_cargo()"> Mensual
								<input type="radio" name="tipo_costo" value="COSTO UNICO" onchange="activa_serv_cargo()"> Único
						</div>
					</div>
				</div>
				<div class="form-group col-lg-9 col-md-9 col-sm-6 col-xs-12">
					<label>Mes</label>
					<select class="form-control" name="mes" id="mes" onchange="">
						<?php echo verMesCorte();?>
					</select>
				</div>
				<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<label>Descripcion</label>
					<select  class="form-control" disabled name="id_serv" id="id_serv" onchange="traer_costo_ser()">
						<?php echo verServiciosCostoU($acceso);?>
					</select>
				</select>
				</div>
				<div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
					<label>cantidad</label>
					<input data-parsley-id="cantidad" required="" data-parsley-type="integer" class="form-control" disabled type="text" name="cantidad" id="cantidad" maxlength="10" size="10" value="1"  onchange="calcular_total_cargar_deuda()">
					<ul id="parsley-id-cantidad" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<label>costo</label>
					<input data-parsley-id="costo" required="" data-parsley-type="number" class="form-control" disabled type="text" name="costo" id="costo" maxlength="10" size="10" value="0" onchange="calcular_total_cargar_deuda()">
					<ul id="parsley-id-costo" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<label>total</label>
					
					<div class="input-group">
						<input data-parsley-id="total" required="" data-parsley-type="number"  class="form-control" disabled type="text" name="total" id="total" maxlength="10" size="10" value="0" >
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="ad" onclick="gestionar_cargar_deuda('incluir','cargar_deuda');"><i class="fa fa-plus"></i></button>
						</div>
					</div>
					<ul id="parsley-id-total" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="datagrid" class="data">
						<input  type="hidden" name="id_cd" id="id_cd" maxlength="" size=""  value="<?php $acceso->objeto->ejecutarSql("select *from cargar_deuda  where (id_cd ILIKE '$ini_u%') ORDER BY id_cd desc"); echo $ini_u.verCoo($acceso,"id_cd")?>">
					</div>	
				</div>

				</div>
			
		</div> <!-- FIN DEL PANEL -->
				
	</section>

	<section class="panel">

		<div class="panel-body">
				<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					<button class="btn btn-info"  type="<?php echo $obj->in; ?>" name="registrar" id="registrar" value="" onclick="cargar_cargar_deuda('cargar','cargar_deuda')"><i class="glyphicon glyphicon-ok"></i> Cargar Deuda</button>
					<button class="btn btn-success" type="button" name="salir" id="salir" onclick="cargar_form_cargar_deuda()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>					
					
				</div>


			
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