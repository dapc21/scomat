<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_asignar_facturas" >
	
	<div class="border-head"><h3>Reporte de Clientes por Calles</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Búsqueda</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Zona</label>
				<select class="form-control" name="id_zona" id="id_zona" onchange="cargarSector(); buscarRep_calle();">
					<?php echo verZona($acceso);?>
				</select>
			</div>
			
			<input  type="hidden" name="nro_sector" maxlength="4" size="20" onChange="validarsector();" value="<?php $acceso->objeto->ejecutarSql("select * from sector ORDER BY nro_sector desc"); echo verNumero($acceso,"nro_sector");?>" >
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Sector</label>
				<select class="form-control" name="id_sector" id="id_sector" onchange="buscarRep_calle(); traerZona();">
					<?php echo verSector($acceso);?>
				</select>
			</div>
			
			</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	
	<section class="panel">
	
		<header class="panel-heading">Datos de la Ubicación del Cliente</header>
	
		<div class="panel-body">	
		<div id="datagrid" class="data"></div>	
		</div> <!-- FIN DEL PANEL --> 

	</section>
	
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="button" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_calle();"><i class="glyphicon glyphicon-print"></i> Imprimir Reporte</button>
			<button class="btn btn-success" type="button" name="registrar" value="<?php echo _("reporte penetracion");?>" onclick="ImprimirRep_calle_p();"><i class="glyphicon glyphicon-print"></i> Reporte de Penetración</button>
			<input type="hidden" name="modificar" value="CANCELAR">
			<input type="hidden" name="eliminar" value="CANCELAR">
			<input type="hidden" name="Resetear" value="CANCELAR">
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->

</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->