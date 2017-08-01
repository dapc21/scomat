<?php 	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
$id_franq = $_SESSION["id_franq"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_RESUMEN_TEC')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="Rep_libroventa_tec" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Resumen Técnico</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Facturas Impresas</header>
			<div class="panel-body">
			
				<input class="form-control" type="hidden" value="<?php echo $id_franq;?>" name="id_f">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Franquicia</label>
						<select class="form-control" name="id_franq" id="id_franq">
							<?php echo verFranquicia($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label>Desde</label>																		
							<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="desde" data-mask="99/99/9999" id="desde" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																														
						</div>

					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Hasta</label>																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="hasta" data-mask="99/99/9999" id="hasta" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >																														
					</div>
					
				</div>	
				<input class="form-control" type="hidden" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_rep_libroventa_tec()">&nbsp;
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				
				
				<button class="btn btn-warning" type="button" class="boton" type="<?php echo $obj->in;?>" name="registrarf" value="<?php echo _("informe tecnico actual");?>" onclick="imprimir_informe_tecnico()"><i class="fa fa-print"></i> Informe Técnico Actual</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','Rep_libroventa_tec')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>																		
				<input class="form-control" type="hidden" name="modificar" value="CANCELAR">
				<input class="form-control" type="hidden" name="eliminar" value="CANCELAR">
				<input class="form-control" type="hidden" name="Resetear" value="CANCELAR">						
				<input class="form-control" type="hidden" name="Resetear" value="CANCELAR" onclick="DescargarRep_libroventa_tec()">						
				
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