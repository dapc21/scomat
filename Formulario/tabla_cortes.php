<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="tabla_cortes" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Tablas para Cortes</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Tabla para Cortes</header>
			<div class="panel-body">	

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label>id_tc</label>																					
								<input class="form-control" type="text" name="id_tc" maxlength="10" size="30"onChange="validartabla_cortes()" value="<?php $acceso->objeto->ejecutarSql("select *from tabla_cortes where (id_tc ILIKE '$ini_u%') ORDER BY id_tc desc"); echo $ini_u.verCo($acceso,"id_tc")?>">
					</div>
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label>franquicia</label>																					
								<select class="form-control" name="id_franq" id="-1" onchange="">
									<option value="0">Seleccione...</option>
									<option value="1">1</option>
								</select>
					</div>
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Fecha_tc</label >												
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_tc" id="fecha_tc" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >						
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>grupo trabajo</label >																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="id_gt" id="id_gt" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >						
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div>															
							<input type="radio" name="status_tc" value="ACTIVO"CHECKED /> Activo &nbsp;&nbsp;									
							<input  type="radio" name="status_tc" value="INACTIVO" /> Inactivo
						</div>
					</div>	
															
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Observación</label >		
						<textarea class="form-control" name="obser_tc" cols="30" rows="1"></textarea>
					</div>

				</div>
				
			<input class="form-control" type="hidden" value="dato" name="dato">	
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
	
<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','tabla_cortes')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','tabla_cortes')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','tabla_cortes')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','tabla_cortes')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	
		
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Tablas para Cortes</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
</form> <!-- FIN DEL FORMULARIO -->		
</div><!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->					

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
		
		
		