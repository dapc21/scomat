<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('imprimir_ordenes_tecnicos')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate="" >

	<div class="border-head"><h3>Asignar/Imprimir Órdenes de Servicios</h3></div>
	
	<section class="panel">

		<header class="panel-heading">Datos del grupo de trabajo a asignar ordenes</header>

		<div class="panel-body">

			<input  type="hidden" name="id_orden" id="id_orden" maxlength="10" size="15" value="">		
			<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<label>Asignar a Grupo</label>			
				<select data-parsley-id="id_gt" required=""  class="form-control" name="id_gt" id="id_gt" onchange="">
					<?php echo verGrupoTec($acceso);?>
				</select>
				<ul id="parsley-id-id_gt" class="parsley-errors-list"></ul>
			</div>	
			
			<div class="form-group">	
				<label><i class="fa fa-edit label-blanco"></i></label>					
				<div class="form-btn col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<button class="btn btn-success" type="button" name="salir" onclick="cargar_form_imprimir_ordenes_tecnicos();" value="<?php echo _("refrescar");?>"><i class="glyphicon glyphicon-repeat"></i> Refrescar</button>					
				</div>	
			</div>
												
		</div> <!-- FIN DEL PANEL -->	
	</section> 

	<section class="panel">

		<header class="panel-heading">PARAMETROS PARA BUSQUEDA DE ORDENES DE SERVICIOS</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Desde</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="desde" id="desde" maxlength="10" size="10" value="">	
			</div>
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Hasta</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="hasta" id="hasta" maxlength="10" size="10" value="">	
			</div>		
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Franquicia</label>
				<select class="form-control" name="id_franq" id="id_franq" onCHANGE="filtrar_imprimir_orden();">
					<?php echo verFranquicia($acceso);?>
				</select>
			</div>		
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Grupo</label>
					<select class="form-control" name="id_gt1" id="id_gt1" onchange="filtrar_imprimir_orden();">
						<option value="TODOS"><?php echo _("todos");?></option>
						<option value=""><?php echo _("sin grupo");?></option>
						<?php echo verGrupoTecnico($acceso);?>
					</select>
			</div>			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Tipo Orden</label>
					<select class="form-control" name="id_tipo_orden" id="id_tipo_orden" onchange="cargarDO1();filtrar_imprimir_orden()">
						<option value=""><?php echo _("todos");?></option>
						<?php echo verTipoOrdenEst($acceso);?>
					</select>
			</div>	
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Detalle Orden</label>
				<select class="form-control" name="id_det_orden" id="id_det_orden" onchange="traerTO();filtrar_imprimir_orden()">
					<option value=""><?php echo _("todos");?></option>
					<?php echo verDetalleOrdenFiltro($acceso);?>
				</select>
			</div>
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Prioridad</label>
				<select class="form-control" name="prioridad" id="prioridad" onchange="filtrar_imprimir_orden()">
					<option value=""><?php echo _("todos");?></option>
					<option value="NORMAL"><?php echo _("normal");?></option>
					<option value="URGENTE"><?php echo _("urgente");?></option>
					<option value="EMERGENCIA"><?php echo _("emergencia");?></option>
				</select>
			</div>	
			
			<div class="form-group">
				<label><i class="fa fa-edit label-blanco"></i></label>
				<div class="form-btn col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-left">
				<button class="btn btn-info" name="buscar" id="buscar" type="button"  value="<?php echo _("buscar");?>" onclick="filtrar_imprimir_orden()"><i class="glyphicon glyphicon-search"></i> Buscar</button>
				</div>
			</div>
					
		</div> <!-- FIN DEL PANEL -->
		
	</section>
	<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
	<section class="panel" id="tabla-imprimir-orden-servicio">			

		<div class="panel-body">
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
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