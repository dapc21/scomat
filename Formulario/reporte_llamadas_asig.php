<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('LISTADO_ABONADOS')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="status_contrato" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Reporte de Llamadas Asignadas</h3></div>
	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Parámetros de Asignación de llamadas</header>
			<div class="panel-body">
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Desde</label>																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="desde" data-mask="99/99/9999" id="desde" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																									
					</div>

					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Hasta</label>																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="hasta" data-mask="99/99/9999" id="hasta" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																														
					</div>
					
					</div>
							
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						
						<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" name="registrdxar" value="<?php echo _("buscar");?>" onclick="buscarlistado_llamada_asig()"><i class="fa fa-search"></i> por ubicacion</button>								
						<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" name="registgfrar" value="<?php echo _("buscar");?>" onclick="buscarlistado_llamada_asig_resp()"><i class="fa fa-search"></i> por responsable</button>								
						<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','reporte_llamadas_asig')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>												
										<input class="form-control" type="hidden" value="dato" name="registrar">			
										<input class="form-control" type="hidden" value="dato" name="modificar">			
										<input class="form-control" type="hidden" value="dato" name="eliminar">			
					</div>	
				</div>		
			</div> <!-- FIN DEL PANEL -->	
	</section>			
 	
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<div class="panel-body">	
			
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<header class="panel-heading">Listado</header>
					
						<div id="datagrid" class="data"></div>						
						
					</div>		
					  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <header class="panel-heading">
                                  Llamadas a clientes por responsables
                              </header>
                              <div class="panel-body">
                                  <div id="llamada_barra" class="graph"></div>
                              </div>
                         
                      </div>
			
					  <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                              <header class="panel-heading">
                                  Estadísticas de clientes por responsables de LLamadas
                              </header>
                              <div class="panel-body">
                                  <div id="hero-bar" class="graph"></div>
                              </div>
                         
                      </div>
                      <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                              <header class="panel-heading">
                                  Efectividad clientes
                              </header>
                              <div class="panel-body">
                                  <div id="hero-area" class="graph"></div>
                              </div>
                          
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