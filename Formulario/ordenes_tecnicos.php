<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ordenes_tecnicos')))
{
	session_start();
	$id_fr = $_SESSION["id_franq"];
	$serie='';
	if($id_fr!='0'){
		$cons=" and  id_franq='$id_fr';";
		$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_fr';");
		$row=row($acceso);
		$serie= trim($row["serie"]);
	}
	else{
		$cons=" and  id_franq='1'";
	}
	$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos  where (id_orden ILIKE '$ini_u%')   ORDER BY id_orden desc LIMIT 1 offset 0 ");
						$id_orden=$ini_u.verCodLong($acceso,"id_orden");
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate="" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Crear Órdenes de Servicios</h3></div>
	
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


	<input type="hidden" value="TEC00001" name="id_persona" id="id_persona">
	<!-- EA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TΔULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Orden</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Nº de orden</label>
						<input data-parsley-id="id_orden" required="" disabled class="form-control" type="text" name="id_orden" id="id_orden" maxlength="12" size="20"onChange="validarordenes_tecnicos()" value="<?php echo $id_orden;?>">
						<ul id="parsley-id-id_orden" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Prioridad</label>
						<select data-parsley-id="prioridad" required="" class="form-control" name="prioridad" id="prioridad">
							<option value="NORMAL"><?php echo _("normal");?></option>
							<option value="URGENTE"><?php echo _("urgente");?></option>
							<option value="EMERGENCIA"><?php echo _("emergencia");?></option>
						</select>
						<ul id="parsley-id-prioridad" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Tipo de Orden</label>						
						<select data-parsley-id="id_tipo_orden" required="" class="form-control" name="id_tipo_orden" id="id_tipo_orden" onchange="cargarDO()">
							<?php echo utf8_decode(verTipoOrden($acceso));?>
						</select>
						<ul id="parsley-id-id_tipo_orden" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Detalle Orden</label>
						<select data-parsley-id="id_det_orden" required="" class="form-control" name="id_det_orden" id="id_det_orden" onchange="traerTO()">
							<?php echo verDetalleOrden($acceso);?>
						</select>
						<ul id="parsley-id-id_det_orden" class="parsley-errors-list"></ul>
					</div>
					<input class="form-control" type="hidden" name="fecha_orden" id="fecha_orden" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
					<input class="form-control" type="hidden" name="fecha_final" id="fecha_imp" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
					<input class="form-control" type="hidden" name="fecha_final" id="fecha_final" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Comentario Orden</label>
						<textarea data-parsley-id="detalle_orden" required="" class="form-control" name="detalle_orden" id="detalle_orden"></textarea>
						<ul id="parsley-id-detalle_orden" class="parsley-errors-list"></ul>
					</div>
					<input class="form-control" type="hidden" value="CREADO" name="status_orden" id="status_orden">
					<input class="form-control" type="hidden" value="" name="comentario_orden" id="comentario_orden">
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<!-- EA DE PANEL O PANELES -->
	<section class="panel">		
			<div class="panel-body">	
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					<button class="btn btn-success" type="<?php echo $obj->in;?>" name="registrar" id="registrar" value="" onclick="gestionar_ordenes_tecnicos('incluir','ordenes_tecnicos')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
					<!--<button class="btn btn-warning" type="hidden" name="modificar" id="modificar" value="" onclick="gestionar_ordenes_tecnicos('modificar','ordenes_tecnicos')"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
					<button class="btn btn-danger" type="hidden"  name="eliminar" id="eliminar" value="" onclick="gestionar_ordenes_tecnicos('eliminar','ordenes_tecnicos')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
					-->
					<button class="btn btn-info" type="button" name="salir" onclick="cargar_form_ordenes_tecnicos();" value=""><i class="glyphicon glyphicon-repeat"></i>Limpiar</button>
				</div>
		</div> <!-- FIN DEL PANEL -->	
	</section>		
	
	<!-- EA DE PANEL O PANELES -->
	<!--section class="panel">		
		<header class="panel-heading">Datos de Impresión</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Asignar a Grupo</label>			
						<select class="form-control" name="id_gt" id="gt" onchange="" disabled>
							<?php //echo verGrupoTec($acceso);?>
						</select>
					</div>	
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">				
						<label><i class="fa fa-edit label-blanco"></i></label>
						<div class="has-js">
						<div class="checkboxes">
						<label class="label_check"> 
						<input type="checkbox" name="checkgrupo"checked onchange="bloquea_asig_grupo()">
							Selección Automática
						</label>
						</div>
						</div>
					</div>	
					
				</div>		
		</div>
	</section-->			
		
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