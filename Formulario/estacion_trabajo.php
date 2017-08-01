<?php 
session_start();
require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('COBRADOR')))
{

$ip_est = $_SERVER['REMOTE_ADDR'];
$nombre_est = $_SERVER['REMOTE_HOST'];
$REMOTE_USER = $_SERVER['REMOTE_USER'];
//echo ":$nombre_est:$REMOTE_USER:";
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de las Estaciones de Trabajos</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Estación de Trabajo</header>
			
			<div class="panel-body">

				<input class="form-control" type="hidden" id="id_est" name="id_est" maxlength="10" size="30"onChange="validarestacion_trabajo()" value="<?php $acceso->objeto->ejecutarSql("select * from estacion_trabajo   where (id_est ILIKE '$ini_u%') ORDER BY id_est desc"); echo $ini_u.verCodigo($acceso,"id_est")?>">
				<input class="form-control" type="HIDDEN" id="login" name="login" maxlength="25" size="30" value="<?php echo $_SESSION["login"];?>" >
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Nombre Estación</label>															
						<input data-parsley-id="nombre_est" required="" class="form-control" type="text" id="nombre_est" name="nombre_est" maxlength="30" size="30" value="<?php echo $nombre_est; ?>" >
						<ul id="parsley-id-nombre_est" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<label>Dirección IP</label>																	
						<input data-parsley-id="ip_est" required="" class="form-control" type="text" id="ip_est" name="ip_est" maxlength="100" size="100" value="<?php echo $ip_est; ?>" >
						<ul id="parsley-id-ip_est" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>Franquicia</label>																	
						<select data-parsley-id="nom_comp" required="" class="form-control" name="nom_comp" id="nom_comp" >
						<?php echo verFranquicia_selec($acceso);?>
						</select>
						<ul id="parsley-id-nom_comp" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>Equipo Fiscal</label>																				
						<input data-parsley-id="mac_est" required="" class="form-control" type="text" id="mac_est" name="mac_est" maxlength="100" size="100" value="" >
						<ul id="parsley-id-mac_est" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div class="has-js">
							<div class="radios">
								<input type="radio" name="status_est" value="ACTIVO"CHECKED /> Activo
								<input  type="radio" name="status_est" value="INACTIVO" /> Inactivo
								<input  type="radio" name="status_est" value="IMPRESORAFISCAL" /> Impresora Fiscal
							</div>
						</div>
					</div>	
					
					
				
				</div>
			<input class="form-control" type="hidden" value="dato" id="dato" name="dato">
			<input class="form-control" type="hidden" value="dato" id="id_franq" name="id_franq">
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" name="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_estacion_trabajo('incluir','estacion_trabajo')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" name="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_estacion_trabajo('modificar','estacion_trabajo')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" id="eliminar" name="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_estacion_trabajo('eliminar','estacion_trabajo')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" name="salir" onclick="cargar_form_estacion_trabajo();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		
			
	<section class="panel" id="tabla-estacion-trabajo">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Estaciones de Trabajo Registradas</header>
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