<?php
require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('FAMILIA'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="f1" data-parsley-validate="">
	
	<div class="border-head"><h3>Administración de Contrapartes</h3></div>
	
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TITULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Contrapartes</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" name="id_persona" id="id_persona" maxlength="10" size="30" onChange="validarentidad();" value="<?php ECHO  verCod_cli($acceso,$ini_u); ?>">
			<input  type="hidden" value="dato" id="dato" name="dato">

			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Cédula</label>
				<input data-parsley-id="cedula" required="" class="form-control" type="text" id="cedula" name="cedula" maxlength="8" size="20" value="">
				<ul id="parsley-id-cedula" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<label>Nombre(s)</label>
				<input data-parsley-id="nombre" required="" class="form-control" type="text" id="nombre" name="nombre" maxlength="30" size="20" value="" >
				<ul id="parsley-id-nombre" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<label>Apellido(s)</label>
				<input data-parsley-id="apellido" required="" class="form-control" type="text" id="apellido" name="apellido" maxlength="30" size="20" value="" >
				<ul id="parsley-id-apellido" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Teléfono</label>
				<input data-parsley-id="telefono" required="" class="form-control" type="text" id="telefono" name="telefono" maxlength="11" size="20" value="" >
				<ul id="parsley-id-telefono" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Tipo de Contraparte</label>
				<select data-parsley-id="id_te" required="" class="form-control" name="id_te" id="id_te" onchange="pasaRvalorUni();">
					<?php echo verTipoEntidad($acceso);?>
				</select>
				<ul id="parsley-id-id_te" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Estatus</label >
				<div>
					<input type="radio" checked name="status_ent" id="estatus_activo" value="ACTIVO" onchange="checkRadio();" /> Activo &nbsp;&nbsp;
					<input type="radio" name="status_ent" id="estatus_inactivo" value="INACTIVO" onchange="checkRadio();" /> Inactivo
				</div>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea data-parsley-id="descrip_ent" required="" class="form-control" id="descrip_ent" name="descrip_ent" cols="1" rows="2"></textarea>
				<ul id="parsley-id-descrip_ent" class="parsley-errors-list"></ul>
			</div>
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		<div id="error" class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" id="registrar" name="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_entidad('incluir','entidad')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button disabled class="btn btn-warning" type="<?php echo $obj->mo;?>" id="modificar" name="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_entidad('modificar','entidad')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
			<button disabled class="btn btn-danger" type="<?php echo $obj->el;?>" id="eliminar" name="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_entidad('eliminar','entidad')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
			<button class="btn btn-info" type="button" id="salir" name="salir" onclick="cargar_form_entidad();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL AREA DE PANEL O PANELES -->
	<section class="panel" id="tabla-entidad">
	
		<header class="panel-heading">Datos de los Contrapartes Registrados</header>
	
		<div class="panel-body">	
		<div id="datagrid" class="data"></div>	
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