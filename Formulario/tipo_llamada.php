<?php 
	require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('TIPO_LLAMADA')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de TIPOS DE LLAMADAS</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del TIPO DE LLAMADA</header>
			<div class="panel-body">	
				
				<input class="form-control" type="hidden" name="id_tll" id="id_tll" maxlength="5" size="30"onChange="validartipo_llamada()" value="<?php $acceso->objeto->ejecutarSql("select *from tipo_llamada   where (id_tll ILIKE '$ini_u%') ORDER BY id_tll desc"); echo $ini_u.verCodigo($acceso,"id_tll")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>Nombre</label>													
							<input data-parsley-id="nombre_tll" required="" class="form-control" type="text" name="nombre_tll" id="nombre_tll" maxlength="30" size="30" value=""  >	
							<ul id="parsley-id-nombre_tll" class="parsley-errors-list"></ul>							
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div>																	
							<input type="radio" name="status_tll" value="ACTIVO"CHECKED /> Activo &nbsp;&nbsp;										
							<input type="radio" name="status_tll" value="INACTIVO" /> Inactivo
						</div>
					</div>										
				
				</div>
			
			<input class="form-control" type="hidden" value="dato" name="dato" id="dato">			
			</div> <!-- FIN DEL PANEL -->	
			
	</section>	
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				
				<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_tipo_llamada('incluir','tipo_llamada')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>	

				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_tipo_llamada('modificar','tipo_llamada')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>

				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_tipo_llamada('eliminar','tipo_llamada')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>

				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_tipo_llamada()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<section class="panel" id="tabla-grupo-afinidad">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los TIPOS DE LLAMADAS Registrados</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_tipo_llamada" class="data">
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
</form> <!-- FIN DEL FORMULARIO -->				


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