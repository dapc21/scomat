<?php 	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
$id_franq = $_SESSION["id_franq"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_LIBROVENTA')))
{

//echo verEstacionTrabajo($acceso);
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}	
?>


<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <input type='text' class="form-control" id='datetimepicker6'/>
        </div>
    </div>
</div>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="Rep_libroventa" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Libro de Ventas</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Facturas Impresas</header>
			<div class="panel-body">

				<input class="form-control" type="hidden" value="<?php echo $id_franq;?>" name="id_f">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Franquicia</label>
						<select class="form-control" name="id_franq" id="id_franq" onchange='traer_equipo_fiscal();'>
							<?php echo verFranquicia($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Equipo Fiscal</label>
						<select class="form-control" name="id_est" id="id_est">
							<?php echo verEstacionTrabajo($acceso);?>
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
				
				</div>
				
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
			<div class="panel-body">
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					
					<button class="btn btn-success" type="button" class="boton" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_rep_libroventa()"><i class="fa fa-search"></i> Buscar</button>		
					<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','Rep_libroventa')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>																		
											
				</div>	
			</div> <!-- FIN DEL PANEL -->	
	</section>			
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				
				<?php if($id_f=='0'){?>
					<button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Descargar" type="button" class="boton" type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("descargar libro de venta");?>" onclick="libroventa_unicable()"><i class="fa fa-download"></i> Libro de Ventas</button>		
				<?php }?>
				<?php if($id_f=='0'){?>
					<input class="form-control" type="hidden" name="registrar" value="<?php echo _("descargar libro de venta resumido");?>" onclick="libroventa_unicable_resumido()">&nbsp;
				<?php }?>
					<button class="btn btn-info" type="button" class="boton" type="<?php echo $obj->mo;?>" name="registrarf" value="<?php echo _("reporte libro de venta");?>" onclick="DescargarRep_libroventa()"><i class="fa fa-print"></i> Reporte Libro de Ventas</button>
					<button class="btn btn-warning" type="button" class="boton" type="<?php echo $obj->mo;?>" name="registrarf" value="<?php echo _("detallado 1");?>" onclick="DescargarRep_libroventaDetallado()"><i class="fa fa-print"></i> Detallado 1</button>
					<button class="btn btn-warning" type="button" class="boton" type="<?php echo $obj->mo;?>" name="registdrarf" value="<?php echo _("detallado 2");?>" onclick="DescargarRep_libroventaDetallado2()"><i class="fa fa-print"></i> Detallado 2</button>
					<button class="btn btn-warning" type="button" class="boton" type="<?php echo $obj->mo;?>" name="registdrarf" value="<?php echo _("detallado 2");?>" onclick="DescargarRep_libroventaDetallado_Servicio()"><i class="fa fa-print"></i> Detallado por Servicio</button>
					<button class="btn btn-warning" type="button" class="boton" type="<?php echo $obj->mo;?>" name="registdrarf" value="" onclick="DescargarRep_libroventa_sector()"><i class="fa fa-print"></i>facturacion por sector</button>
				<?php if($id_f=='0'){?>						
					<button type="button" class="btn btn-success contenido-boton-excel" data-toggle="tooltip" data-placement="bottom" title="Exportar a Excel Detallado" type="<?php echo $obj->el;?>" name="registrarf" onclick="exportar_libro_excel()"><i class="fa fa-file-text"></i> </button>							
				<?php }?>	
					
												
			</div>					
			
		</div> <!-- FIN DEL PANEL -->	
	</section>			
			
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
							
				<?php if($id_f=='0'){?>						
					<button type="button" class="btn btn-success contenido-boton-excel" data-toggle="tooltip" data-placement="bottom" title="Exportar a Excel Resumido" type="<?php echo $obj->el;?>" name="registrarf" onclick="exportar_libro_excel_resumido()"><i class="fa fa-file-text"></i> </button>
					<button class="btn btn-warning" type="button" class="boton" type="<?php echo $obj->el;?>" name="registrarfgg" value="<?php echo _("facturas con salto");?>" onclick="buscar_facturas_salto()"><i class="fa fa-search"></i> Facturas Con Salto</button>
					<button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Descargar" type="button" class="boton" type="<?php echo $obj->el;?>" name="registradfrfgg" value="<?php echo _("cobro clientes correspondientes");?>" onclick="DescargarRep_libroventaDetallado_corresp()"><i class="fa fa-download"></i> Cobro a Clientes Correspondientes</button>														
					<input class="form-control" type="hidden" name="registdfrarfgg" value="<?php echo _("reporte por franquicia");?>" onclick="DescargarRep_libroventaDetallado()">&nbsp;																	
				<?php }?>	
				
				<input class="form-control" type="hidden" name="modificar" value="CANCELAR">
				<input class="form-control" type="hidden" name="eliminar" value="CANCELAR">
				<input class="form-control" type="hidden" name="Resetear" value="CANCELAR">
																
			</div>						
			
		</div> <!-- FIN DEL PANEL -->	
	</section>		
	
	<section class="panel">
		<header class="panel-heading"> Resúmenes </header>
		<div class="panel-body">
			<div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
				<button class="btn btn-success btn-xs btn-block" type="button" class="boton" type="<?php echo $obj->el;?>" name="registrarfgg" value="<?php echo _("resumen diario de ingresos por franquicias");?>" onclick="res_diario_ing_fraq()"><i class="fa fa-file-text-o"></i> resumen diario de ingresos por franquicias</button>
				<button class="btn btn-success btn-xs btn-block" type="button" class="boton" type="<?php echo $obj->el;?>" name="registdrarfgg" value="<?php echo _("resumen diario de ventas por franquicias");?>" onclick="res_diario_ing_fraq()"><i class="fa fa-file-text-o"></i> resumen diario de ventas por franquicias</button>
				<button class="btn btn-success btn-xs btn-block" type="button" class="boton" type="<?php echo $obj->el;?>" name="regisgdftrarfgg" value="<?php echo _("resumen actual de ordenes por franquicias");?>" onclick="res_diario_ing_fraq()"><i class="fa fa-file-text-o"></i> resumen actual de ordenes por franquicias</button>				
			</div>	
		</div>
	</section>	
	

	<div id="datagrid" class="data"></div>

 
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