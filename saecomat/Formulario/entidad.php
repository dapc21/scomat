<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('FAMILIA'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_entidad"  action="javascript:func_vacia();">
	
	<div class="border-head"><h3>Administración de Contrapartes</h3></div>
	
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TITULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Contrapartes</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" name="id_persona" id="id_persona" maxlength="10" size="30"onChange="validarentidad()" value="<?php ECHO  verCod_cli($acceso,$ini_u); ?>">
			<input  type="hidden" value="dato" name="dato">

			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Cédula</label>
				<input class="form-control" type="text" name="cedula" maxlength="8" size="20" value="" onChange="validarPersona_mat();">
			</div>
			
			<div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<label>Nombre(s)</label>
				<input class="form-control" type="text" name="nombre" maxlength="30" size="20" value="" >
			</div>
			
			<div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<label>Apellido(s)</label>
				<input class="form-control" type="text" name="apellido" maxlength="30" size="20" value="" >
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Teléfono</label>
				<input class="form-control" type="text" name="telefono" maxlength="11" size="20" value="" >
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Tipo de Contraparte</label>
				<select class="form-control" name="id_te" id="id_te" onchange="pasaRvalorUni();">
					<?php echo verTipoEntidad($acceso);?>
				</select>
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
				<textarea class="form-control" name="descrip_ent" cols="1" rows="2"></textarea>
			</div>
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','entidad')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button class="btn btn-warning" type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','entidad')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
			<button class="btn btn-danger" type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','entidad')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','entidad')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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