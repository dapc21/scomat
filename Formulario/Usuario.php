<?php
session_start();
require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"]; 
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('USUARIO')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Usuarios</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos Personales</header>
			<div class="panel-body">
				
				<input class="form-control" type="hidden" name="id_persona_g" id="id_persona_g" maxlength="8" size="20" value="<?php $acceso->objeto->ejecutarSql("select *from persona  where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc"); echo $ini_u.verCo($acceso,"id_persona")?>">
				<input class="form-control" type="hidden" name="id_persona" id="id_persona" maxlength="8" size="20" value="<?php $acceso->objeto->ejecutarSql("select *from persona  where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc"); echo $ini_u.verCo($acceso,"id_persona")?>">
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Cédula</label>													
							<input data-parsley-id="cedula" required=""  class="form-control" type="text" name="cedula" id="cedula" maxlength="8" size="20" value="" onChange="buscar_cedula_persona();" >
							<ul id="parsley-id-cedula" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Nombre(s)</label>													
							<input data-parsley-id="nombre" required=""  class="form-control" type="text" name="nombre" id="nombre" maxlength="30" size="20" value="" >
							<ul id="parsley-id-nombre" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Apellido(s)</label>													
							<input data-parsley-id="apellido" required=""  class="form-control" type="text" name="apellido" id="apellido" maxlength="30" size="20" value="" >
							<ul id="parsley-id-apellido" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Teléfono</label>													
							<input data-parsley-id="telefono" required=""  class="form-control" type="text" name="telefono" id="telefono" maxlength="11" size="20" value="" >
							<ul id="parsley-id-telefono" class="parsley-errors-list"></ul>
					</div>
				
				</div>
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Cuenta de Usuario</header>
			<div class="panel-body">
											
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Usuario</label>													
							<input data-parsley-id="login" required=""  class="form-control" type="text" name="login_usuario" id="login_usuario" maxlength="15" size="20"onChange="buscar_login()" value="">
							<ul id="parsley-id-login" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Perfil</label>													
							<select data-parsley-id="codigoperfil" required=""  class="form-control" name="codigoperfil" id="codigoperfil">
								<?php echo perfil($acceso);?>
							</select>
							<ul id="parsley-id-codigoperfil" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Contraseña</label>													
						<input data-parsley-id="password" required=""  class="form-control" type="password" name="password" id="password" maxlength="25" size="20" value="">	
						<ul id="parsley-id-password" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Confirmar Contraseña</label>													
						<input data-parsley-id="otropassword" required=""  class="form-control" type="password" name="otropassword" id="otropassword" maxlength="25" size="20" value="">
						<ul id="parsley-id-otropassword" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Servidor</label>													
						<select class="form-control" name="id_servidor" id="id_servidor">
							<?php echo verServidorTodo($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Franquicia</label>													
						<select class="form-control" name="id_franq" id="id_franq">
							<?php echo verFranquicia($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div>																		
							<input type="radio" name="status" value="ACTIVO"CHECKED /> Activo &nbsp;&nbsp;											
							<input  type="radio" name="status" value="INACTIVO" /> Inactivo
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
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_usuario('incluir','usuario_sistema')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_usuario('modificar','usuario_sistema')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_usuario('eliminar','usuario_sistema')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_usuario();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
		
	<section class="panel" id="tabla-usuario-sistema">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Usuarios Registrados</header>
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