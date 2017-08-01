<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('tipo_pago')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de los Tipos de Pagos</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Tipo de Pago</header>
			<div class="panel-body">

				<input class="form-control" type="hidden" name="id_tipo_pago" id="id_tipo_pago" maxlength="8" size="30"onChange="validartipo_pago()" value="<?php $acceso->objeto->ejecutarSql("select *from tipo_pago  where (id_tipo_pago ILIKE 'TPA%') ORDER BY id_tipo_pago desc"); echo "TPA".verCo($acceso,"id_tipo_pago")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>nombre Tipo de Pago</label>													
							<input data-parsley-id="tipo_pago" required="" class="form-control" type="text" name="tipo_pago" id="tipo_pago" maxlength="30" size="30" value="" onChange=""  >							
							<ul id="parsley-id-tipo_pago" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>abreviatura</label>							
							<input data-parsley-id="abrev_tp" required="" class="form-control" type="text" name="abrev_tp" id="abrev_tp" maxlength="30" size="30" value="" onChange=""  >							
							<ul id="parsley-id-abrev_tp" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div>																		
							<input type="radio" name="status_pago" value="ACTIVO" CHECKED /> Activo &nbsp;&nbsp;												
							<input  type="radio" name="status_pago" value="INACTIVO" /> Inactivo 
						</div>
					</div>										
				
				<input class="form-control" type="hidden" value="dato" name="dato">
				</div>
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_tipo_pago('incluir','tipo_pago')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_tipo_pago('modificar','tipo_pago')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_tipo_pago('eliminar','tipo_pago')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_tipo_pago()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>

	<section class="panel" id="tabla-tipo-pago">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Tipos de Pagos Registrados</header>
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