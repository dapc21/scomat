<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ANALISIS_VEN')))
{
	
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="analisis_ven" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Análisis de Vencimiento por Cobradores y Zonas</h3></div>
	
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Datos del Reporte</header>
				<div class="panel-body">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Franquicia</label>
							<select class="form-control" name="id_franq" id="id_franq">
								<?php echo verFranquicia($acceso);?>
							</select>					
						</div>
						
					</div>	
					
				</div> <!-- FIN DEL PANEL -->	
			
		</section>

		<section class="panel">		
		
			<div class="panel-body">
					
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					<input class="form-control" type="hidden" name="registrar" value="<?php echo _("buscar");?>" onclick="buscarRep_deudasector()">&nbsp;						
					<button class="btn btn-success" type="button" name="modidfficar" value="<?php echo _("cartera por zona");?>" onclick="ImprimirRep_deuda_zona()"><i class="fa fa-download"></i> Cartera por zona</button>
					<button class="btn btn-success" type="button" name="modidfficar" value="<?php echo _("cartera por zona");?>" onclick="ImprimirRep_deuda_sect()"><i class="fa fa-download"></i> Cartera por sector</button>
					<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','analisis_ven')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
					<input class="form-control" type="hidden" name="modificar" value="CANCELAR">
					<input class="form-control" type="hidden" name="eliminar" value="CANCELAR">
					<input class="form-control" type="hidden" name="Resetear" value="CANCELAR">
				</div>		
			</div> <!-- FIN DEL PANEL -->	
		</section>	 

		<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos Encontrados</header>
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid"></div>						
					
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