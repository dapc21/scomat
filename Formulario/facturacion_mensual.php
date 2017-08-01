<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('anular_pagos')))
{

$fecha= date("Y-m-d");

?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_anular_pagos" >
	
	<div class="border-head"><h3>FACTURACION MENSUAL</h3></div>
	
	
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la nota de credito</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">	
		
				<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">	
					<label>Mes</label>
					<select class="form-control" name="mes" id="mes" onchange="">
						<?php echo verMesCorte();?>
					</select>
				</div>
		</div> <!-- FIN DEL PANEL --> 

	</section>
	
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<input  readonly type="hidden" name="registrar" value="" onclick="">
			<input  readonly type="hidden" name="modificar" value="" onclick="">
			<input  readonly type="hidden" name="eliminar" value="" onclick="">
			
			<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="regisfgtrar" value="<?php echo _("regifgstrar");?>" onclick="verificar('incluir','estacion_trabajo')"><i class="glyphicon glyphicon-ok"></i> Generar proceso de FActuracion</button>	
			
			<button class="btn btn-success" type="button" name="salir" onclick="FACTURAR" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>

		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->

	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<div id="datagrid" class="data"></div>
		</div>

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