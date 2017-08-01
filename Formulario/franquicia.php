<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
$login=$_SESSION["login"];  
//ECHO ":$login:";
if($obj->permisoModulo($acceso,strtoupper('franquicia')))
{

$acceso->objeto->ejecutarSql("select  id_franq from franquicia  where (id_franq ILIKE '$ini_u%')   ORDER BY id_franq desc LIMIT 1 offset 0 ");
$id_franq=$ini_u.verCodigo($acceso,"id_franq");

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" id="f1" name="f1"   data-parsley-validate="">

	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Franquicias</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Franquicia</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-2 col-md-6 col-sm-12 col-xs-12">
						<label>Nº</label>													
							<input data-parsley-id="1"  required="" class="form-control" type="text" id="id_franq" maxlength="5" size="20"onChange="validarfranquicia()" value="<?php echo $id_franq; ?>">
							<ul id="parsley-id-1" class="parsley-errors-list"></ul>	
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>Nombre franquicia</label>													
							<input data-parsley-id="2"  required="" class="form-control" type="text" id="nombre_franq" maxlength="50" size="30" value="" onChange="">
							<ul id="parsley-id-2" class="parsley-errors-list"></ul>	
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>empresa juridica</label>
						<select data-parsley-id="id_emp"  required="" class="form-control" id="id_emp" onchange="">
							<?php echo verEmpresas($acceso);?>
						</select>
						<ul id="parsley-id-id_emp" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>grupo</label>
						<select data-parsley-id="id_gf"  required="" class="form-control" id="id_gf" onchange="">
							<?php echo verGrupoFranq($acceso);?>
						</select>
						<ul id="parsley-id-id_gf" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Dirección</label>													
							<textarea data-parsley-id="direccion_franq"  required="" class="form-control" id="direccion_franq" rows="1"></textarea>
							<ul id="parsley-id-direccion_franq" class="parsley-errors-list"></ul>	
					</div>
				
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Observacion</label>													
							<textarea class="form-control" id="obser_franq" rows="1"></textarea>
							
					</div>

					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>serie</label>					
							<input data-parsley-id="serie"  class="form-control" type="text" id="serie" maxlength="5" size="20" value="">
							<ul id="parsley-id-serie" class="parsley-errors-list"></ul>	
					</div>
					
					
				</div>
				
				<input class="form-control" type="hidden" value="dato" id="dato">
				
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in;?>" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_franquicia('incluir','franquicia')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo;?>" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_franquicia('modificar','franquicia')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el;?>" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_franquicia('eliminar','franquicia')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" onclick="cargar_form_franquicia()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>		

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-franquicia">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Franquicias Agregadas</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_franquicia" class="data"></div>
					
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