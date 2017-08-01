<?php 	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_COBRADOR')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="Rep_libro_cobrador" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Reporte de Cobranza por Cobrador</h3></div>
	
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Facturas Cobradas</header>
				<div class="panel-body">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Desde</label>																		
							<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="desde" data-mask="99/99/9999" id="desde" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																														
						</div>

						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Hasta</label>																		
							<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="hasta" data-mask="99/99/9999" id="hasta" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																														
						</div>
						
						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Cobrador</label>																		
							<select class="form-control" name="id_persona" id="-1" onchange="">
								<?php echo verCobradoresListado($acceso);?>
							</select>
						</div>
						
						<input class="form-control" type="hidden" name="com" id="com" maxlength="5" style="width: 30px;" value="" >
						
						<div class="form-group">
							<label><i class="fa fa-edit label-blanco"></i></label>
							<div class="form-btn col-lg-3 col-md-6 col-sm-12 col-xs-12 pull-left">								
								<button class="btn btn-success" type="button" name="buscar" value="<?php echo _("buscar");?>" onclick="buscar_libro_cobrador()"><i class="fa fa-search"></i> Buscar</button>																						
							</div>	
						</div>	
					
						
					</div>	
					
				</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<section class="panel">		
		
			<div class="panel-body">
					
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<input class="form-control" type="hidden" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_libro_cobrador()">&nbsp;
						<button class="btn btn-info" type="button" type="<?php echo $obj->in;?>" name="registrarf" value="<?php echo _("descargar reporte individual");?>" onclick="DescargarRep_libro_cobrador()"><i class="fa fa-download"></i> Descargar reporte individual</button>
						<button class="btn btn-warning" type="button" type="<?php echo $obj->in;?>" name="registrarf" value="<?php echo _("todos los cobradores");?>" onclick="DescargarRep_libro_cobradorTodos()"><i class="fa fa-download"></i> Todos los cobradores</button>
						<input class="form-control" type="hidden" name="modificar" value="CANCELAR">
						<input class="form-control" type="hidden" name="eliminar" value="CANCELAR">
						<input class="form-control" type="hidden" name="Resetear" value="CANCELAR">
					</div>	
			</div> <!-- FIN DEL PANEL -->	
	</section>	 
	
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Facturas Encontradas</header>
		
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