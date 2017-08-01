<?php 
	require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('COBRADOR')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Modificar Datos Personales</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Búsqueda de Personas</header>
			<div class="panel-body">
				<input class="form-control" type="HIDDEN" name="id_persona" id="id_persona" maxlength="10" size="20"onChange="validarpersona()" value="">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>Cédula</label>
						<div class="input-group">
						<input data-parsley-id="cedulax" required=""  class="form-control" type="text" name="cedulax" id="cedulax" maxlength="12" size="20" value="" onChange="validarPersona_mod()">
						<ul id="parsley-id-cedulax" class="parsley-errors-list"></ul>
						<!--a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a-->
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick="ajaxVentana('RIF/Cédula', this.id);"><i class="fa fa-search"></i></button>	
						</div>
						</div>
					</div>
				</div>
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
		
		<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos a Modificar</header>
			<div class="panel-body">			
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-5 col-md-6 col-sm-12 col-xs-12">
						<label>Cédula</label>
							<input data-parsley-id="cedula" required=""  class="form-control" type="text" name="cedula" id="cedula" maxlength="8" size="20" value="" onChange="buscar_cedula_persona_global()">
							<ul id="parsley-id-cedula" class="parsley-errors-list"></ul>	
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Nombre</label>													
							<input data-parsley-id="nombre" required=""  class="form-control" type="text" name="nombre" id="nombre" maxlength="30" size="20" value="" >
							<ul id="parsley-id-nombre" class="parsley-errors-list"></ul>	
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Apellido</label>													
							<input data-parsley-id="apellido" required=""  class="form-control" type="text" name="apellido" id="apellido" maxlength="30" size="20" value="" >
							<ul id="parsley-id-apellido" class="parsley-errors-list"></ul>	
					</div>
					
					<div class="form-group col-lg-5 col-md-6 col-sm-12 col-xs-12">
						<label>Teléfono</label>													
							<input data-parsley-id="telefono" required=""  class="form-control" type="text" name="telefono" id="telefono" maxlength="11" size="20" value="" >
							<ul id="parsley-id-telefono" class="parsley-errors-list"></ul>	
					</div>
				
				</div>
				
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>	
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" name="modificar" id="modificar" value="" onclick="gestionar_persona('modificar','persona')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_perso()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">personas agregadas</header>
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