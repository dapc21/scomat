<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ESTADO')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1"  id="f1"  data-parsley-validate="">
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de MODELos de equipos</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">	
				<input  type="hidden" name="id_modelo" id="id_modelo" maxlength="8" size="30"onChange="validarmodelo()" value="<?php $acceso->objeto->ejecutarSql("select *from modelo  where (id_modelo ILIKE '$ini_u%') ORDER BY id_modelo desc"); echo $ini_u.verCo($acceso,"id_modelo")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Nombre modelo</label>											
								<input data-parsley-id="1" required="" class="form-control" type="text" name="nombre_modelo" id="nombre_modelo" maxlength="50" size="30" value="" onChange="" >		
								<ul id="parsley-id-1" class="parsley-errors-list"></ul>									
					</div>
					
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Marca</label>
						<select data-parsley-id="2" required="" class="form-control" name="id_marca" id="id_marca" onchange="">
							<?php echo ver_marca($acceso);?>
						</select>
						<ul id="parsley-id-2" class="parsley-errors-list"></ul>			
					</div>
					
					
					
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>sistema</label>
						<select data-parsley-id="3" required="" class="form-control" name="id_tse" id="id_tse" onchange="">
							<?php echo ver_tipo_sist_equipo($acceso);?>
						</select>
						<ul id="parsley-id-3" class="parsley-errors-list"></ul>			
					</div>
					
					
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Status</label>
						<div>																	
							
								<input  type="radio" name="status_modelo" value="ACTIVO"CHECKED>ACTIVO&nbsp;&nbsp;&nbsp;
								<input  type="radio" name="status_modelo" value="INACTIVO">INACTIVO
							
						</div>
					</div>	
					
					
				
				</div>
				<input class="form-control" type="hidden" value="dato" name="dato">
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_modelo('incluir','modelo')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_modelo('modificar','modelo')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_modelo('eliminar','modelo')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir"  onclick="cargar_form_modelo();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-estado">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Estados Agregados</header>
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
					<input  type="button" class="boton" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>



