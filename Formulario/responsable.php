<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('responsable'))) //validar privilegios
{

$idResp = id_unico();
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de responsable</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<!--label>ID Res</label-->
						<input class="form-control" type="hidden" name="id_res" id="id_res" maxlength="13" size="20" onChange="validarentidad();" value="<?php echo $idResp; ?>">
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<!--label>ID Per</label-->
						<input class="form-control" type="hidden" name="id_persona" id="id_persona" maxlength="13" size="20" value="">
					</div>
					
					<div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<label>cédula</label>
						<input data-parsley-id="cedula" required="" class="form-control" type="text" name="cedula" id="cedula" maxlength="8" value="" size="20" onChange="buscar_cedula_responsable();" >
						<ul id="parsley-id-cedula" class="parsley-errors-list"></ul>							
					</div>

					<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<label>nombre(s)</label>
						<input data-parsley-id="nombre" required="" class="form-control" type="text" name="nombre" id="nombre" maxlength="35" size="20" value="" >
						<ul id="parsley-id-nombre" class="parsley-errors-list"></ul>							
					</div>

					<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<label>apellido(s)</label>
						<input data-parsley-id="apellido" required="" class="form-control" type="text" name="apellido" id="apellido" maxlength="35" size="20"  value="" >
						<ul id="parsley-id-apellido" class="parsley-errors-list"></ul>							
					</div>
				
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>tipo de responsable</label>
						<select data-parsley-id="id_tipo_res" required="" class="form-control" name="id_tipo_res" id="id_tipo_res" >
							<?php echo verTipoResponsable($acceso);?>
						</select>
						<ul id="parsley-id-id_tipo_res" class="parsley-errors-list"></ul>			
					</div>
				
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>observación</label>
					<textarea data-parsley-id="descrip_res" required="" class="form-control" name="descrip_res" id="descrip_res" rows="2"></textarea>
					<ul id="parsley-id-descrip_res" class="parsley-errors-list"></ul>
				</div>
				
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div>
							<input  type="radio" name="status_res" value="ACTIVO" CHECKED >&nbsp;ACTIVO
							&nbsp;&nbsp;&nbsp;<input  type="radio" name="status_res" value="INACTIVO">&nbsp; INACTIVO
						</div>
					</div>

				</div>
		<tr>
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div id="error"  class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_responsable('incluir','responsable')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_responsable('modificar','responsable')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_responsable('eliminar','responsable')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_responsable()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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

