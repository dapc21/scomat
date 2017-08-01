<?php 	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('INGRESO_X_SERV')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="ingreso_x_serv" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Ingresos por Servicios</h3></div>
	
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Ingresos</header>
				<div class="panel-body">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Franquicia</label>
							<select class="form-control" name="id_franq" id="id_franq">
								<?php echo verFranquicia($acceso);?>
							</select>					
						</div>
						
						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Desde</label>																		
							<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="desde" data-mask="99/99/9999" id="desde" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																														
						</div>

						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Hasta</label>																		
							<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="hasta" data-mask="99/99/9999" id="hasta" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																														
						</div>
						
						<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Tipo</label>																		
							<select class="form-control" name="tipo" id="tipo" onchange="">
								<option value="POR DIA"><?php echo _("POR DIA");?></option>
								<option value="POR MES"><?php echo _("POR MES");?></option>
								<option value="POR ANO"><?php echo _("POR A&Ntilde;O");?></option>
								<option value="UNICO"><?php echo _("UNICO");?></option>
							</select>
						</div>
					
					</div>
					
				</div> <!-- FIN DEL PANEL -->	
			
		</section>
		
		<section class="panel">		
		
			<div class="panel-body">
					
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					<input class="form-control" type="hidden" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_libroventa();">						
					<button class="btn btn-success" type="button" type="<?php echo $obj->in;?>" name="registrarf" value="<?php echo _("descargar reporte");?>" onclick="DescargarRep_ingreso_x_serv()"><i class="fa fa-download"></i> descargar reporte</button>
					<input class="form-control" type="hidden" name="modificar" value="<?php echo _("cancelar");?>">
					<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>">
					<input class="form-control" type="hidden" name="Resetear" value="<?php echo _("resetear");?>">
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