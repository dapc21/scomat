<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('inventario_material'))) //validar privilegios
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate="" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administración de inventario de materiales</h3></div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos del Stock (Material en Almacén)</header>
					<div class="panel-body">
					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
							
						</div>
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
							
						</div>
						
					</div> <!-- FIN DEL PANEL -->	
			</section>
		
		</div>
	
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos del Inventario</header>
					<div class="panel-body">
						
						
					</div> <!-- FIN DEL PANEL -->	
			</section>
		
		</div>
	
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<section class="panel">		
				<div class="panel-body">	
					<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_inv_mat();"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
						<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_inventario_material()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
					</div>	
				</div>	
			</section>
	
		</div>-->
			
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">		
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos Agregados</header>
					<div class="panel-body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<div id="datagrid"></div>
							
						</div>		
				</div> <!-- FIN DEL PANEL -->	
			</section>

		</div>
	
	</div>
 
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

