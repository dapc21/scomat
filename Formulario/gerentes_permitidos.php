<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('GERENTES')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" id="f1"  data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Gerentes</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Gerente</header>
			<div class="panel-body">
				<input class="form-control" type="hidden" name="id_persona" id="id_persona" maxlength="10" size="20"onChange="validarvendedor()" value="<?php ECHO  verCod_cli($acceso,$ini_u); ?>">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Nº</label>													
							<input data-parsley-id="1" disabled required="" class="form-control" type="text" name="nro_gerente" id="nro_gerente" maxlength="4" onChange=" size="20" value="<?php $acceso->objeto->ejecutarSql("select *from gerentes_permitidos ORDER BY nro_gerente desc"); echo verNumero($acceso,"nro_gerente")?>" >
							<ul id="parsley-id-1" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<label>Cédula</label>													
							<input data-parsley-id="2" data-parsley-required="true" data-parsley-length="[7,8]" data-parsley-type="digits" class="form-control" name="cedula" id="cedula" maxlength="8" size="20" value="" onChange="buscar_cedula_gerentes_permitidos()">
							<ul id="parsley-id-2" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Nombre(s)</label>													
							<input data-parsley-id="3" required="" class="form-control" type="text" name="nombre" id="nombre" maxlength="30" size="20" value="" onkeypress="return sololetras(event)" onpaste="return false">
							<ul id="parsley-id-3" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Apellido(s)</label>													
							<input data-parsley-id="4" required="" class="form-control" type="text" name="apellido" id="apellido" maxlength="30" size="20" value="" onkeypress="return sololetras(event)" onpaste="return false">
							<ul id="parsley-id-4" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>Tipo de Gerente</label>													
							<select data-parsley-id="5" required="" class="form-control" name="tipo_gerente" id="tipo_gerente" onchange="">
								<option value=""><?php echo _("seleccione....");?></option>
								<option value="PRINCIPAL"><?php echo _("PRINCIPAL");?></option>
								<option value="SECUNDARIO"><?php echo _("SECUNDARIO");?></option>
							</select>
							<ul id="parsley-id-5" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>Cargo</label>													
							<input data-parsley-id="6" required="" class="form-control" type="text" name="cargo_gerente" id="cargo_gerente" maxlength="50" size="20" value="" onkeypress="return sololetras(event)" onpaste="return false">
							<ul id="parsley-id-6" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>Teléfono</label>													
							<input data-parsley-id="7" required="" data-parsley-minlength="11" data-parsley-type="digits" class="form-control" name="telefono" id="telefono" maxlength="11" size="20" value="" >
							<ul id="parsley-id-7" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>Correo</label>	
							<!-- <input type="email" name="email"> <!-- HTML5 -->
							<!--<input data-parsley-type="email" name="email">-->
							<input data-parsley-type="email" data-parsley-id="8" data-parsley-required="true" class="form-control" type="email" name="correo_gerente" id="correo_gerente" maxlength="50" size="20" value="" >
							<ul id="parsley-id-8" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>Franquicia</label>													
							<select data-parsley-id="9" required="" class="form-control" name="id_franq" id="id_franq">
								<?php echo verFranquicia_selec($acceso);?>
							</select>
							<ul id="parsley-id-9" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div>																	
							<input type="radio" name="sattus_gerente" value="ACTIVO"CHECKED /> Activo &nbsp;&nbsp;																	
							<input  type="radio" name="sattus_gerente" value="INACTIVO" /> Inactivo
						</div>
					</div>	
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Descripción</label>													
							<textarea data-parsley-id="10" required="" data-parsley-type="alphanum" class="form-control" name="descrip_gerente" id="descrip_gerente" cols="95" rows="1"></textarea>
							<ul id="parsley-id-10" class="parsley-errors-list">
					</div>
				
				</div>
			
			
			<input class="form-control" type="hidden" value="dato" name="dato" id="dato">
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_gerentes_permitidos('incluir','gerentes_permitidos')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_gerentes_permitidos('modificar','gerentes_permitidos')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_gerentes_permitidos('eliminar','gerentes_permitidos')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_gerentes_permitidos()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		

	<section class="panel" id="tabla-gerente-permitido">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Gerentes Agregados</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_gerentes_permitidos" class="data"></div>						
					
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