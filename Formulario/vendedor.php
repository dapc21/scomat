<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('VENDEDOR')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" id="f1" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Vendedores</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Vendedor</header>
			<div class="panel-body">

				<input class="form-control" type="HIDDEN" id="id_persona" maxlength="10" size="20"onChange="validarvendedor()" value="<?php echo verCod_cli($acceso,$ini_u)?>">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<label>Nº</label>												
							<input data-parsley-id="1" disabled required="" class="form-control" type="text" id="nro_vendedor" maxlength="4" onChange="" size="20" value="<?php $acceso->objeto->ejecutarSql("select *from vendedor ORDER BY nro_vendedor desc"); echo verNumero($acceso,"nro_vendedor"); ?> " >
							<ul id="parsley-id-1" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<label>Cédula</label>								
							<input type="text" data-parsley-id="2" data-parsley-required="true" data-parsley-length="[7,8]" data-parsley-type="digits" class="form-control" name="cedula" id="cedula" maxlength="8" size="20" value="" onChange="buscar_cedula_vendedor()" >
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
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Teléfono</label>								
							<input type="text" data-parsley-id="5" required="" data-parsley-minlength="11" data-parsley-type="digits" class="form-control" name="telefono" id="telefono" maxlength="11" size="20" value="" >
							<ul id="parsley-id-5" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Franquicia</label>													
							<select data-parsley-id="1" required="" class="form-control" id="id_franq" id="id_franq">			
								<?php echo verFranquicia_selec($acceso);?>
							</select>
							<ul id="parsley-id-1" class="parsley-errors-list">
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Dirección</label>													
							<textarea data-parsley-id="6" required="" data-parsley-type="alphanum" class="form-control" name="direccion_ven" id="direccion_ven" cols="30" rows="1"></textarea>
							<ul id="parsley-id-6" class="parsley-errors-list">					
					</div>
				
				</div>
				
			
			<input class="form-control" type="hidden" value="dato" id="dato">
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

		<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_vendedor('incluir','vendedor')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_vendedor('modificar','vendedor')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_vendedor('eliminar','vendedor')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" onclick="cargar_form_vendedor();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		

	<section class="panel" id="tabla-vendedor">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Vendedores Agregados</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_vendedor" class="data"></div>						
					
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
					<input  type="button" id="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>