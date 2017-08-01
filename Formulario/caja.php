<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CAJA')))
{
$acceso->objeto->ejecutarSql("select  id_caja from caja  where (id_caja ILIKE '$ini_u%')   ORDER BY id_caja desc LIMIT 1 offset 0 ");
$id_caja=$ini_u.verCodigo($acceso,"id_caja");
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Cajas</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Caja</header>
			<div class="panel-body">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input class="form-control"  type="hidden" name="id_caja" id="id_caja" maxlength="5" size="20" onChange="validarcaja()" value="<?php  echo $id_caja; ?>">
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Nombre de la Caja</label>																				
							<input data-parsley-id="nombre_caja" required="" class="form-control" type="text" name="nombre_caja" id="nombre_caja" maxlength="30" value="" onChange="">
							<ul id="parsley-id-nombre_caja" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label>Franquicia</label>																				
							<select data-parsley-id="id_franq" required="" class="form-control" name="id_franq" id="id_franq">
								<?php echo verFranquicia_selec($acceso);?>
							</select>
							<ul id="parsley-id-id_franq" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div class="has-js">
							<div class="radios">
																									
									<input type="radio" name="status_caja" value="ACTIVA"CHECKED /> Activa
																									
									<input  type="radio" name="status_caja" value="ABIERTA" /> Abierta
																								
									<input  type="radio" name="status_caja" value="INACTIVO" /> Inactiva
								
							</div>
						</div>
					</div>		

					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Tipo de Caja</label>
						<div class="has-js">
							<div class="radios">
																									
									<input type="radio" name="tipo_caja" value="OFICINA"CHECKED /> Oficina
																									
									<input  type="radio" name="tipo_caja" value="EXTERNA" /> Externa
																								
									<input  type="radio" name="tipo_caja" value="EMPRESA" /> Cobrador Empresa
								
							</div>
						</div>
					</div>													
					
					<div class="form-group col-lg-6 col-md-4 col-sm-4 col-xs-12">
						<label></label>																				
							
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Descripción</label>																				
						<textarea data-parsley-id="descripcion_caja" required="" class="form-control" name="descripcion_caja" id="descripcion_caja" rows="1"></textarea>	
						<ul id="parsley-id-descripcion_caja" class="parsley-errors-list"></ul>
					</div>
				
				</div>
				<input class="form-control" type="hidden" value="dato" name="dato" id="dato">
			</div> <!-- FIN DEL PANEL -->	
			
	</section>		

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_caja('incluir','caja')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_caja('modificar','caja')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_caja('eliminar','caja')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_caja()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>
		</div> <!-- FIN DEL PANEL -->	
	</section>	
		
	<section class="panel" id="tabla-caja-adm">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Cajas Registradas</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>
					
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
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>