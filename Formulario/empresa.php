<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('empresa'))) //validar privilegios
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de empresas</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">
				<input  type="hidden" name="id_emp" id="id_emp" maxlength="" size=""  value="<?php $acceso->objeto->ejecutarSql("select *from empresa  where (id_emp ILIKE '$ini_u%') ORDER BY id_emp desc"); echo $ini_u.verCoo($acceso,"id_emp")?>">
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>rif</label>
					<input data-parsley-id="rif_emp" required=""    class="form-control" type="text" name="rif_emp" id="rif_emp" maxlength="15"  value="" >
					<ul id="parsley-id-rif_emp" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>razon social</label>
					<input data-parsley-id="razon_social_emp" required=""    class="form-control" type="text" name="razon_social_emp" id="razon_social_emp" maxlength="100"  value="" >
					<ul id="parsley-id-razon_social_emp" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>nombre comercial</label>
					<input data-parsley-id="nombre_comercial_emp" required=""    class="form-control" type="text" name="nombre_comercial_emp" id="nombre_comercial_emp" maxlength="100"  value="" >
					<ul id="parsley-id-nombre_comercial_emp" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>telefonos</label>
					<input data-parsley-id="telefono_emp" required=""    class="form-control" type="text" name="telefono_emp" id="telefono_emp" maxlength="100"  value="" >
					<ul id="parsley-id-telefono_emp" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>correo</label>
					<input data-parsley-id="correo_emp" required=""    class="form-control" type="text" name="correo_emp" id="correo_emp" maxlength="100"  value="" >
					<ul id="parsley-id-correo_emp" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>logo</label>
					<input data-parsley-id="logo_emp" required=""    class="form-control" type="text" name="logo_emp" id="logo_emp" maxlength="100"  value="" >
					<ul id="parsley-id-logo_emp" class="parsley-errors-list"></ul>							
				</div>

					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>informacion adicional</label>
						<textarea data-parsley-id="infor_adic_emp" required=""    data-parsley-type="alphanum" class="form-control" name="infor_adic_emp" id="infor_adic_emp"  rows="1"></textarea>
						<ul id="parsley-id-infor_adic_emp" class="parsley-errors-list"></ul>
				</div>

					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>direccion</label>
						<textarea data-parsley-id="direccion_emp" required=""    data-parsley-type="alphanum" class="form-control" name="direccion_emp" id="direccion_emp"  rows="2"></textarea>
						<ul id="parsley-id-direccion_emp" class="parsley-errors-list"></ul>
				</div>

					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>observacion</label>
						<textarea data-parsley-id="obsrv_emp" required=""    data-parsley-type="alphanum" class="form-control" name="obsrv_emp" id="obsrv_emp"  rows="2"></textarea>
						<ul id="parsley-id-obsrv_emp" class="parsley-errors-list"></ul>
				</div>

				<input  type="hidden" value="dato" name="dato" id="dato">
		<tr>
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_empresa('incluir','empresa')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_empresa('modificar','empresa')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_empresa('eliminar','empresa')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_empresa()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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

