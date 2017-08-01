<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('MAT_PROV'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_material_proveedor" action="javascript:func_vacia();">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Suministro de Materiales por Proveedor</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Búsqueda de Abonados</header>
		
		<div class="panel-body">
		
		<input  type="hidden" name="rif_prov" maxlength="15" size="15" value="" >
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
			<label>Proveedor</label>
			<select class="form-control" name="id_prov" id="id_prov" onchange="validarproveedor2();">
				<?php echo verProveedor($acceso);?>
			</select>
		</div>
		
		<div class="form-group col-lg-9 col-md-8 col-sm-12 col-xs-12">
			<label>Nombre(s)</label>
			<input class="form-control" type="text" name="nombre_prov" readonly maxlength="50" size="30" value="" >
		</div>
		
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label>Dirección</label>
			<textarea class="form-control" name="direccion_prov" cols="1" rows="2" readonly ></textarea>
		</div>
		
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Teléfono(s)</label>
			<input class="form-control" type="text" name="telefonos_prov" readonly maxlength="50" size="30" value="" >
		</div>
		
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Fax</label>
			<input class="form-control" type="text" name="fax_prov" readonly maxlength="20" size="30" value="" >
		</div>
		
		<input  type="hidden" name="web_prov" maxlength="30" size="30" value="" >
		<input  type="hidden" name="email_prov" maxlength="40" size="30" value="" >
		<input  type="hidden" name="obser_prov" value="">
		<input  type="hidden" name="forma_pago" value="">
		<input  type="hidden" name="banco" value="">
		<input  type="hidden" name="cuenta" maxlength="25" size="30" value="" >
		<input  type="hidden" name="contacto" maxlength="50" size="30" value="" >
		<input  type="hidden" name="status_prov" maxlength="50" size="30" value="" >
		<input  type="hidden" value="dato" name="dato">
		
		</div>
		
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	<section class="panel">
		
		<div class="panel-body">
			
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<input  type="hidden" name="registrar" value="<?php echo _("guardar");?>" onclick="verificar_mat('incluir','mat_prov')">
				<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','mat_prov')">
				<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','mat_prov')">
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','mat_prov')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>

		</div> <!-- FIN DEL PANEL -->

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	<section class="panel" id="tabla-material-proveedor">
	
		<header class="panel-heading">Datos de los Materiales Suministrados</header>
		
		<div class="panel-body">
			<div id="datagrid" class="data"></div>		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->

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