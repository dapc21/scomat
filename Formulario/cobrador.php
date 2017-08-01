<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('COBRADOR')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y id="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" id="f1"  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Cobradores</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Cobrador</header>
			<div class="panel-body">
				
				<input class="form-control" type="HIDDEN" id="id_persona" maxlength="10" size="20"onChange="validarcobrador()" value="<?php echo verCod_cli($acceso,$ini_u)?>">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Nº</label>													
							<input data-parsley-id="1" required="" class="form-control" type="text" id="nro_cobrador" onChange="validarcobrador1()" maxlength="4" size="20" value="<?php $acceso->objeto->ejecutarSql("select *from cobrador ORDER BY nro_cobrador desc"); echo verNumero($acceso,"nro_cobrador")?>" >
							<ul id="parsley-id-1" class="parsley-errors-list">	
					</div>
					
					<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<label>Cédula</label>								
							<input data-parsley-id="2" data-parsley-required="true" data-parsley-length="[7,8]" data-parsley-type="digits" class="form-control" name="cedula" id="cedula" maxlength="8" size="20" value="" onChange="buscar_cedula_cobrador()">
							<ul id="parsley-id-2" class="parsley-errors-list"></ul>	
					</div>
				
					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Nombre</label>								
							<input data-parsley-id="3" required="" class="form-control" type="text" name="nombre" id="nombre" maxlength="30" size="20" value="" onkeypress="return sololetras(event)" onpaste="return false">
							<ul id="parsley-id-3" class="parsley-errors-list"></ul>	
					</div>
					
					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Apellido</label>													
							<input data-parsley-id="4" required="" class="form-control" type="text" name="apellido" id="apellido" maxlength="30" size="20" value="" onkeypress="return sololetras(event)" onpaste="return false">
							<ul id="parsley-id-4" class="parsley-errors-list"></ul>	
					</div>
				
					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>Teléfono</label>															
							<input data-parsley-id="5" required="" data-parsley-minlength="11" data-parsley-type="digits" class="form-control" name="telefono" id="telefono" maxlength="11" size="20" value="" >
							<ul id="parsley-id-5" class="parsley-errors-list"></ul>	
					</div>
					
					<div class="form-group col-lg-6 required="" col-md-6 col-sm-12 col-xs-12">
						<label>Franquicia</label>													
							<select data-parsley-id="7" class="form-control" id="id_franq" >
								<?php echo verFranquicia_selec($acceso);?>
							</select>
							<ul id="parsley-id-7" class="parsley-errors-list"></ul>	
					</div>
					
					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>Nº Visual</label>													
							<input data-parsley-id="8" required="" data-parsley-type="digits" class="form-control" type="text" name="dato" id="dato" maxlength="11" size="3" value="" >
							<ul id="parsley-id-8" class="parsley-errors-list"></ul>	
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Dirección</label>													
							<textarea data-parsley-id="9" required="" data-parsley-type="alphanum" class="form-control" name="direccion_cob" id="direccion_cob" cols="30" rows="1"></textarea>
							<ul id="parsley-id-9" class="parsley-errors-list"></ul>	
					</div>
					
				
				</div>
			
			
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" id="registrar" type="<?php echo $obj->in; ?>" class="boton" gestionar_cobrador="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_cobrador('incluir','cobrador')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" id="modificar" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_cobrador('modificar','cobrador')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" id="eliminar" type="button" type="<?php echo $obj->el; ?>" class="boton" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_cobrador('eliminar','cobrador')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" onclick="cargar_form_cobrador();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<section class="panel" id="tabla-cobrador">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Cobradores Agregados</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_cobrador" class="data"></div>			
					
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