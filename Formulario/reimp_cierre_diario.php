<?php session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REIMP_CIERRE_DIARIO')))
{
	session_start();
	$id_f = $_SESSION["id_franq"]; 
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_reimprimir_cierre_diario" >
	
	<div class="border-head"><h3>Reimprimir Cierre Diario</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Búsqueda</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Franquicia</label>
			<select class="form-control" name="id_f" id="id_f">
				<?php echo verFranquicia($acceso);?>
			</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Fecha</label>
			<input class="form-control" type="text" name="desde" id="desde" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			</div>
			
			</div>

		</div> <!-- FIN DEL PANEL --> 
		
	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<input  type="<?php echo "hidden";?>" name="registrar" value="<?php echo _("imprimir");?>" onclick="reimp_cierre_diario();">
			<input  type="<?php echo "hidden";?>" name="registrgar" value="<?php echo _("imprimir General");?>" onclick="reimp_cierre_diario();">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="registra" value="<?php echo _("cierre diario");?>" onclick="redes_cierre_diario();"><i class="glyphicon glyphicon-ok"></i> Cierre Diario</button>
			<input  type="<?php echo "hidden";?>" name="regddfistra" value="<?php echo _("cierre resumen corto");?>" onclick="redes_cierre_diario_general();">
			<input  type="<?php echo "hidden";?>" name="regddffgfistra" value="<?php echo _("imprimir informe administrativo ");?>" onclick="informe_comercial();">
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','reimp_cierre_diario')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<header class="panel-heading">Datos de los Puntos de Cobros</header>
		
		<div class="panel-body">
			<div id="dialogo"></div>	
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