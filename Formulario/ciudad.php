<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CIUDAD')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" id="f1"  name="f1"  data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Ciudades</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Ciudad</header>
			<div class="panel-body">
				<input class="form-control" type="hidden" id="id_ciudad" maxlength="8" size="30"onChange="validarciudad()" value="<?php $acceso->objeto->ejecutarSql("select *from ciudad  where (id_ciudad ILIKE '$ini_u%') ORDER BY id_ciudad desc LIMIT 1 offset 0"); echo $ini_u.verCoo($acceso,"id_ciudad")?>">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Estado</label>													
							<select data-parsley-id="2" required="" class="form-control" id="id_esta"  name="id_esta" onchange="cargar_municipio_n()">
								<?php echo ver_estado($acceso);?>
							</select>
							<ul id="parsley-id-2" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Municipio</label>													

							<select data-parsley-id="3" required="" class="form-control" id="id_mun"  name="id_mun" onchange="traer_estado_n();">
								<?php echo ver_municipio($acceso);?>
							</select>
							<ul id="parsley-id-3" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Ciudad</label>													
							<input data-parsley-id="4" required="" class="form-control" type="text" id="nombre_ciudad" maxlength="50" size="30" value="" >
							<ul id="parsley-id-4" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Estatus</label>						
						<div>						
							&nbsp;<?php echo _("ACTIVO");?>
							<input  type="radio" name="status_ciudad" value="ACTIVO"CHECKED>&nbsp;&nbsp;&nbsp;
							<?php echo _("INACTIVO");?>
							<input  type="radio" name="status_ciudad" value="INACTIVO">					
						</div>
					</div>																	
				
				</div>
				<input class="form-control" type="hidden" value="dato" id="dato">
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_ciudad('incluir','ciudad')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_ciudad('modificar','ciudad')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_ciudad('eliminar','ciudad')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" onclick="cargar_form_ciudad()('formulario.php','ciudad')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-ciudad">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Ciudades Agregadas</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_ciudad" class="data"></div>
					
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