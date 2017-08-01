<?php
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REIMPRIMIR FACTURA FISCAL')))
{
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_factura" >
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Reimprimir Factura Fiscal</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Factura</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<label>Nº Factura</label>		
			<div class="input-group">
			<input class="form-control" type="text" name="nro_factura" onChange="c_nro_factura();" maxlength="12" size="20" value="" >
			<div class="input-group-btn">
				<button type="button" class="btn btn-info" id="buscar_abonado" onclick="c_nro_factura();"><i class="fa fa-search"></i></button>	
			</div>
			</div>
			</div>
			
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<label>ID de la Factura a Imprimir</label>		
			<div class="input-group">
			<input class="form-control" type="text" name="id_pago" maxlength="20" size="20" value="" >
			<div class="input-group-btn">
				<button type="button" class="btn btn-info" name="mod" onclick="buscardf();" id="cargar_factura_imprimir" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Cargue la factura que desea imprimir." data-original-title="CARGAR FACTURA">
				<i class="fa fa-arrow-up"></i>
				</button>	
			</div>
			</div>
			</div>
			
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<label>ID de la Factura a Anular</label>	
			<div class="input-group">
			<input class="form-control" type="text" name="id_pago1" maxlength="20" size="20" value="" >
			<div class="input-group-btn">
				<button type="button" class="btn btn-info" name="mod" onclick="confir_buscar_anular_df();" id="cargar_factura_anular" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Cargue la factura que desea anular." data-original-title="CARGAR FACTURA">
				<i class="fa fa-arrow-up"></i>
				</button>	
			</div>
			</div>
			</div>
			

			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<div>
			<input type="checkbox" name="checkbox" id="checkbox01" value="checkbox" onchange="habilitaArchivoPF();" /> Editar Archivo
			</div>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<textarea class="form-control" name="archivo" id="archivo" style="text-transform :none;" colspan="1" rows="10" disabled></textarea>
			</div>
			
			</div>

			
			
		</div> <!-- FIN DEL PANEL --> 
		
		

	</section>
	
	<section class="panel">
	
		<div class="panel-body">
		 
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			
				<button class="btn btn-info" type="button" name="registrar1" value="EJECUTAR COMANDO" disabled onclick="imp_fiscal('')"><i class="glyphicon glyphicon-ok"></i> Ejecutar Comando</button>
				<button class="btn btn-success" type="button" name="salir" onclick="conexionPHP('formulario.php','factura')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				<input class="btn btn-info" type="hidden" name="registrar" value="EJECUTAR COMANDO" disabled onclick="ejecutar_df()">
				<input class="btn btn-info" type="hidden" name="modificar" value="DEVOLUCION" onclick="buscar_anular_df()">
				<input class="btn btn-info" type="hidden" name="eliminar" value="CIERRE DIARIO" onclick="imp_cierrez()">
					
			</div>
			
		</div> <!-- FIN DEL PANEL --> 
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	<div id="result" class="data"></div>

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
