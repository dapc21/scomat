<?php require_once "procesos.php"; ?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="orden_tabla_cortes" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Tablas para Corte</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Tabla para Corte</header>
			<div class="panel-body">	

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>id_tc</label>																													
								<input class="form-control" type="text" name="id_tc" maxlength="10" size="30"onChange="validarorden_tabla_cortes()" value="<?php $acceso->objeto->ejecutarSql("select *from orden_tabla_cortes ORDER BY id_tc desc"); echo "COD".verCo($acceso,"id_tc")?>">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>id_orden</label>																													
								<input class="form-control" type="text" name="id_orden" maxlength="10" size="30" value="" >
					</div>

				</div>
			<input class="form-control" type="hidden" value="dato" name="dato">
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','orden_tabla_cortes')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" name="modificar" value="MODIFICAR" onclick="verificar('modificar','orden_tabla_cortes')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','orden_tabla_cortes')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" type="reset" name="Resetear" value="CANCELAR"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<section class="panel">		
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data">
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
</form> <!-- FIN DEL FORMULARIO -->			
		
		