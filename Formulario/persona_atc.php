<?php 
	require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('COBRADOR')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="persona_atc" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Personas</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Persona</header>
			<div class="panel-body">

				<input class="form-control" type="hidden" name="id_persona" maxlength="10" size="20"onChange="validarpersona()" value="<?php echo verCod_cli($acceso,$ini_u)?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-5 col-md-6 col-sm-12 col-xs-12">
						<label>Cédula</label>													
						<input class="form-control" type="text" name="cedula" maxlength="8" size="20" value="" onChange="validarPersona()">
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Nombre(s)</label>													
						<input class="form-control" type="text" name="nombre" maxlength="30" size="20" value="" >
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Apellido(s)</label>													
						<input class="form-control" type="text" name="apellido" maxlength="30" size="20" value="" >
					</div>
					
					<div class="form-group col-lg-5 col-md-6 col-sm-12 col-xs-12">
						<label>Teléfono</label>													
						<input class="form-control" type="text" name="telefono" maxlength="11" size="20" value="" >
					</div>
				
				</div>
				
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
				
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','persona')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','persona')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','persona')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','persona')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<section class="panel" id="tabla-persona-atc">		
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