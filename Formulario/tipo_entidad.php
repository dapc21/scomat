<?php
require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('FAMILIA'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="f1" data-parsley-validate="">
	
	<div class="border-head"><h3>Administración de los Tipos de Contrapartes</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Tipos de Contrapartes</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" name="id_te" id="id_te" maxlength="10" size="30"onChange="validartipo_entidad()" value="<?php $acceso->objeto->ejecutarSql("select * from tipo_entidad where (id_te ILIKE '$ini_u%') ORDER BY id_te desc LIMIT 1 offset 0"); echo $ini_u.verCodigo($acceso,"id_te")?>">
			<input  type="hidden" value="dato" id="dato" name="dato">

			<div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<label>Nombre</label>
				<input data-parsley-id="nombre_te" required="" class="form-control" type="text" id="nombre_te" name="nombre_te" maxlength="50" size="30" value="">
				<ul id="parsley-id-nombre_te" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Estatus</label >
				<div>
					<input type="radio" checked name="status_te" id="estatus_activo" value="ACTIVO" onchange="checkRadio();" /> Activo &nbsp;&nbsp;
					<input type="radio" name="status_te" id="estatus_inactivo" value="INACTIVO" onchange="checkRadio();" /> Inactivo
				</div>
			</div>
			
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" id="registrar" name="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_tipo_entidad('incluir','tipo_entidad')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button disabled class="btn btn-warning" type="<?php echo $obj->mo;?>" id="modificar" name="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_tipo_entidad('modificar','tipo_entidad')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
			<button disabled class="btn btn-danger" type="<?php echo $obj->el;?>" id="eliminar" name="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_tipo_entidad('eliminar','tipo_entidad')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
			<button class="btn btn-info" type="button" id="salir" name="salir" onclick="cargar_form_tipo_entidad();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<header class="panel-heading">Datos de los Tipos de Contrapartes Registrados</header>
	
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