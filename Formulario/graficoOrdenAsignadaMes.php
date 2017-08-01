<?php
session_start();
require_once("procesos.php");
require_once("estadisticas/metodosGraficos.php");
$ini_u = $_SESSION["ini_u"];
$_SESSION["titulo_estadistico"] = 'ÓRDENES ASIGNADAS MENSUALES';

/*
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('act_contrato')))
{
*/
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_grafico_orden_asignada_mes" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Gráficas Estadísticas de Órdenes de Servicios Asignadas (Mensuales)</h3></div>
	<section class="panel">		
			<header class="panel-heading">
			  Opciones de Filtrado
			</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Tipo de Gráfico</label >
						<select class="form-control" name="tipo_grafico" id="tipo_grafico">
							<option value="BARRA">BARRAS</option>
							<option value="LINEA">LÍNEAS DE TIEMPO</option>
							<option value="AREA">ÁREAS</option>
						</select>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Año</label >
						<select class="form-control" name="anio_f" id="anio_f">
							<?php echo verAniosDesc($acceso);?>
						</select>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Franquicia</label >
						<select class="form-control" name="id_franq" id="id_franq">
							<?php echo verFranquicia_completo($acceso);?>
						</select>
					</div>	
				
			</div>	
	</section>	
	
	<section class="panel fondo-grafico">
		<div id="gr"></div>
		<div id="morris">
		  <div class="row">
			  
			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				  <section class="panel" id="barra">
					  <header class="panel-heading">
						  Estadísticas de Barras - Órdenes de Servicios Asignadas
					  </header>
					  <div class="panel-body">
						  <div id="hero-bar" class="graph"></div>
					  </div>
				  </section>
			  </div>
			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				  <section class="panel" id="linea">
					  <header class="panel-heading">
						  Estadísticas de Líneas de Tiempo - Órdenes de Servicios Asignadas
					  </header>
					  <div class="panel-body">
						  <div id="hero-graph" class="graph"></div>
					  </div>
				  </section>
			  </div>
		  </div>
		  <div class="row">
			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				  <section class="panel" id="area">
					  <header class="panel-heading">
						  Estadísticas de Área - Órdenes de Servicios Asignadas
					  </header>
					  <div class="panel-body">
						  <div id="hero-area" class="graph"></div>
					  </div>
				  </section>
			  </div>
		  </div>
		</div>
    </section>
	
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<input class="btn btn-success" type="hidden" name="registrar" value="REGISTRAR" onclick="">
			<input class="btn btn-warning" type="hidden" name="modificar" value="<?php echo _("actualizar");?>" onclick="">
			<button class="btn btn-success" type="<?php echo $obj->mo; ?>" name="modificar" value="" onclick="generarImg();"><i class="glyphicon glyphicon-print"></i> Generar PDF</button>
			<input class="btn btn-danger" type="hidden" name="eliminar" value="ELIMINAR" onclick="">
			<input class="btn btn-info" type="hidden" name="salir" onclick="" value="<?php echo _("limpiar");?>">
		</div>
		
		</div> <!-- FIN DEL PANEL --> 						
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

<?php 
	/*}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}*/
?>