<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('tipo_sist_equipo'))) //validar privilegios
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de tipo_sist_equipo</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">
				<input  type="hidden" name="id_tse" id="id_tse" maxlength="" size=""  value="<?php $acceso->objeto->ejecutarSql("select *from tipo_sist_equipo  where (id_tse ILIKE '$ini_u%') ORDER BY id_tse desc"); echo $ini_u.verCodigo($acceso,"id_tse")?>">
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>sistema</label>
					<input data-parsley-id="sistema" required=""    class="form-control" type="text" name="sistema" id="sistema" maxlength="30"  value="" >
					<ul id="parsley-id-sistema" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>ubicacion</label>
					<input data-parsley-id="ubicacion" required=""    class="form-control" type="text" name="ubicacion" id="ubicacion" maxlength="30"  value="" >
					<ul id="parsley-id-ubicacion" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>alias</label>
					<input data-parsley-id="abrev_nombre_tse" required=""    class="form-control" type="text" name="abrev_nombre_tse" id="abrev_nombre_tse" maxlength="15"  value="" >
					<ul id="parsley-id-abrev_nombre_tse" class="parsley-errors-list"></ul>							
				</div>

					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Status</label>
						<div>
							<input  type="radio" name="status_tse" value="ACTIVO"CHECKED>ACTIVO
							&nbsp;&nbsp;&nbsp;<input  type="radio" name="status_tse" value="INACTIVO">INACTIVO
						</div>
					</div>

				<input  type="hidden" value="dato" name="dato" id="dato">
		<tr>
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_tipo_sist_equipo('incluir','tipo_sist_equipo')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_tipo_sist_equipo('modificar','tipo_sist_equipo')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_tipo_sist_equipo('eliminar','tipo_sist_equipo')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_tipo_sist_equipo()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos Agregados</header>
			<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid"></div>
					
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

