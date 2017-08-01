<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REV_LISTADO_SMS')))
{
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_lista_falla" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Listado de Reclamos Reportadas por Revisar</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<header class="panel-heading">Datos del Listado</header>
		
		<div class="panel-body">
			
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Mostrar SMS</label>
				<select class="form-control" name="status_list" id="status_list" onchange="buscar_list_reclamo();">
					<option value="POR REVISAR">POR REVISAR</option>
					<option value="REVISADO">REVISADO</option>
					<option value="">TODOS</option>
				</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Marcar Como</label>
				<select class="form-control" name="marcar_como" id="marcar_como" onchange="marcar_list_reclamo();">
					<option value="">SELECCIONE...</option>
					<option value="POR REVISAR">POR REVISAR</option>
					<option value="REVISADO">REVISADO</option>
					<option value="ELIMINAR">ELIMINAR</option>
				</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Falla Técnica</label>
				<select class="form-control" name="id_det_orden" id="id_det_orden" onchange="">
					<?php echo verDetalleOrdenFalla1($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">								
				<label><i class="fa fa-edit label-blanco"></i></label>
				<div>
					<input type="checkbox" name="omitir" onchange="hab_SMS();" value="checkbox" onclick="checkRadio();">
					Omitir SMS
				</div>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>SMS Respuesta</label>
				<textarea class="form-control" name="sms_resp" rows="3" cols="1"  onKeyUp="cuenta_carac_com();"><?php echo $sms_resp; ?></textarea>
				<span class="help-inline">Caracteres: </span><label id="cant_car_f">15</label> / <label id="cant_sms_f">1</label></span>
			</div>
			
			<input  type="hidden" name="fecha_orden" id="fecha_orden" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			<input  type="hidden" name="fecha_final" id="fecha_final" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			<input  type="hidden" value="CREADO" name="status_orden">
			<input  type="hidden" value="" name="comentario_orden">
			<input  type="hidden" value="" name="detalle_orden">
			<input  type="hidden" value="NORMAL" name="prioridad">
		
		</div>
		
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" name="registrar" value="<?php echo _("procesar reclamo");?>" onclick="procesar_list_reclamo()"><i class="glyphicon glyphicon-ok"></i> Procesar Reclamo</button>
				<input  type="hidden" name="modificar" value="<?php echo _("rechazar peticion");?>" onclick="rec_falla_rep()">
				<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_sms('eliminar','ordenes_tecnicos')">
				<button class="btn btn-info" type="button" name="Resetear" onclick="javascript:conexionPHP_sms('formulario.php','list_reclamo')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i>Limpiar</button>
			
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>
	
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Reclamos Registradas</header>
		
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
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>