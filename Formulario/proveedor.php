<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PROVEEDOR'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="f1" data-parsley-validate="">
	
	<div class="border-head"><h3>Administración de Proveedores</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Proveedores</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" id="id_prov" name="id_prov" maxlength="8" size="30" onChange="validarproveedor()" value="<?php $acceso->objeto->ejecutarSql("select * from proveedor where (id_prov ILIKE '$ini_u%') ORDER BY id_prov desc LIMIT 1 offset 0"); echo $ini_u.verCoo($acceso,"id_prov")?>">
			<input  type="hidden" value="dato" id="dato" name="dato">

			<div class="form-group col-lg-4 col-md-5 col-sm-12 col-xs-12">
				<label>RIF</label>
				<input data-parsley-id="rif_prov" required="" class="form-control" type="text" name="rif_prov"	id="rif_prov" maxlength="15" size="30" value="">
				<ul id="parsley-id-rif_prov" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-8 col-md-7 col-sm-12 col-xs-12">
				<label>Nombre</label>
				<input data-parsley-id="nombre_prov" required="" class="form-control" type="text" id="nombre_prov" name="nombre_prov" maxlength="50" size="30" value="">
				<ul id="parsley-id-nombre_prov" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Dirección</label>
				<textarea data-parsley-id="direccion_prov" required="" class="form-control" id="direccion_prov" name="direccion_prov" cols="1" rows="2"></textarea>
				<ul id="parsley-id-direccion_prov" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Teléfono(s)</label>
				<input data-parsley-id="telefonos_prov" required="" class="form-control" type="text" id="telefonos_prov" name="telefonos_prov" maxlength="50" size="30" value="" >
				<ul id="parsley-id-telefonos_prov" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Fax</label>
				<input data-parsley-id="fax_prov" required="" class="form-control" type="text" id="fax_prov" name="fax_prov" maxlength="20" size="30" value="" >
				<ul id="parsley-id-fax_prov" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Dirección Web</label>
				<input data-parsley-id="web_prov" required="" class="form-control" type="text" id="web_prov" name="web_prov" maxlength="30" size="30" value="" >
				<ul id="parsley-id-web_prov" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>E-mail</label>
				<input data-parsley-id="email_prov" required="" class="form-control" type="text" id="email_prov" name="email_prov" maxlength="40" size="30" value="" >
				<ul id="parsley-id-email_prov" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea data-parsley-id="obser_prov" required="" class="form-control" id="obser_prov" name="obser_prov" cols="1" rows="2"></textarea>
				<ul id="parsley-id-obser_prov" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Forma de Pago</label>
				<select data-parsley-id="forma_pago" required="" class="form-control" name="forma_pago" id="forma_pago" onchange="">
					<option value="0">Seleccione...</option>
					<option value="EFECTIVO"><?php echo _("efectivo");?></option>
					<option value="CREDITO"><?php echo _("credito");?></option>
				</select>
				<ul id="parsley-id-forma_pago" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Banco</label>
				<select data-parsley-id="banco" required="" class="form-control" name="banco" id="banco" onchange="">
					<?php echo verBancosMat($acceso); ?>
				</select>
				<ul id="parsley-id-banco" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Cuenta</label>
				<input data-parsley-id="cuenta" required="" class="form-control" type="text" id="cuenta" name="cuenta" maxlength="25" size="30" value="" >
				<ul id="parsley-id-cuenta" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Contacto</label>
				<input data-parsley-id="contacto" required="" class="form-control" type="text" id="contacto" name="contacto" maxlength="50" size="30" value="" >
				<ul id="parsley-id-contacto" class="parsley-errors-list"></ul>
			</div>
			
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Estatus</label >
				<div>
					<input type="radio" checked name="status_prov" id="estatus_activo" value="ACTIVO" onchange="checkRadio();" /> Activo &nbsp;&nbsp;
					<input type="radio" name="status_prov" id="estatus_inactivo" value="INACTIVO" onchange="checkRadio();" /> Inactivo
				</div>
			</div>
			
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" id="registrar" name="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_proveedor('incluir','proveedor')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button disabled class="btn btn-warning" type="<?php echo $obj->mo;?>" id="modificar" name="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_proveedor('modificar','proveedor')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
			<button disabled class="btn btn-danger" type="<?php echo $obj->el;?>" id="eliminar" name="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_proveedor('eliminar','proveedor')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
			<button class="btn btn-info" type="button" id="salir" name="salir" onclick="cargar_form_proveedor();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	<section class="panel" id="tabla-proveedor">
	
		<header class="panel-heading">Datos de los Proveedores Registrados</header>
	
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