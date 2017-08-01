<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('almacen'))) //validar privilegios
{

$idAlm = id_unico();
$codAlm = 'ALM'.$ini_u.substr($idAlm, 13,20);
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administración de almacenes</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<input class="form-control" type="hidden" name="id_alm" id="id_alm" maxlength="20" size="20" value="<?php echo $idAlm; ?>">
					</div>
					
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>código del almacén</label>
						<input data-parsley-id="codigo_alm" required="" class="form-control" type="text" name="codigo_alm" id="codigo_alm" maxlength="20" size="20" value="<?php echo $codAlm; ?>" disabled />
						<ul id="parsley-id-codigo_alm" class="parsley-errors-list"></ul>							
					</div>
					
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>grupo de trabajo</label>
						<select data-parsley-id="id_gt" required="" class="form-control" name="id_gt" id="id_gt" onchange="">
							<?php echo verGrupoTecTrabajo($acceso);?>
						</select>
						<ul id="parsley-id-id_gt" class="parsley-errors-list"></ul>			
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>encargado</label>
						<select data-parsley-id="id_enc" required="" class="form-control" name="id_enc" id="id_enc" onchange="">
							<?php echo verEncargadoAlmacen($acceso);?>
						</select>
						<ul id="parsley-id-id_enc" class="parsley-errors-list"></ul>			
					</div>
					
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>almacen</label>
						<input data-parsley-id="nombre_alm" required="" class="form-control" type="text" name="nombre_alm" id="nombre_alm" maxlength="65" size="20" value="" >
						<ul id="parsley-id-nombre_alm" class="parsley-errors-list"></ul>							
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>dirección/ubicación</label>
						<input data-parsley-id="direccion_alm" required="" class="form-control" type="text" name="direccion_alm" id="direccion_alm" maxlength="65" size="20" value="" >
						<ul id="parsley-id-direccion_alm" class="parsley-errors-list"></ul>							
					</div>
					
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>observación</label>
						<textarea data-parsley-id="descrip_alm" required="" class="form-control" name="descrip_alm" id="descrip_alm" rows="2"></textarea>
						<ul id="parsley-id-descrip_alm" class="parsley-errors-list"></ul>
					</div>

					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>estatus</label>
						<div>
							<input  type="radio" name="status_alm" value="ACTIVO"CHECKED>&nbsp;ACTIVO
							&nbsp;&nbsp;&nbsp;<input  type="radio" name="status_alm" value="INACTIVO">&nbsp;INACTIVO
						</div>
					</div>
					
				</div>

			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_almacen('incluir','almacen')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_almacen('modificar','almacen')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_almacen('eliminar','almacen')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_almacen()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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

