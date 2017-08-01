<?php 	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REPORTE_FISCAL')))
{
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_reporte_fiscal" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Reporte Fiscal</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Reporte Fiscal</header>
		
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<input type="hidden" name="id_contrato" maxlength="10" size="20" value="">

			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Desde</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="desde" id="desde" maxlength="10" size="12" value="<?php echo date("d/m/Y");?>" >
			</div>	
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Hasta</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="hasta" id="hasta" maxlength="10" size="12" value="<?php echo date("d/m/Y");?>" >
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Tipo</label >
				<div class="input-group m-bot15">				
				<select class="form-control" name="tipo" id="tipo" onchange="">
					<option value="D">D -> <?php echo _("reporte por dias");?></option>
					<option value="M">M -> <?php echo _("detallado por mes");?></option>
					<option value="R">R -> <?php echo _("reporte con un resumen por ventas diarias");?></option>
				</select>
				<span class="input-group-btn">
					<button type="button" class="btn btn-info" name="registrar" onclick="imp_cierre_x_fecha();"><i class="glyphicon glyphicon-search"></i> Buscar</button>	
				</span>
				</div>
				
				
			</div>
		
		</div> <!-- FIN DEL PANEL -->
		
		</div>
		
	</section>	

	<span class="fuente"><?php echo _("nota: el reporte fiscal saldra por la impresora fiscal");?> </span>

	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="button" name="registrarX" value="<?php echo _("cierre x");?>" onclick="imp_cierrex()">Cierre X </button>
			<button class="btn btn-warning" type="button" name="registrarZ" value="<?php echo _("cierre z");?>" onclick="imp_cierrez()">Cierre Z </button>
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