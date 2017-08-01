<?php

$archivo=$_POST['archivo'];
echo ":$archivo:";
if($archivo!='buscar_avanzado_consultar_clientes' && $archivo!=''){
	include "formularios/".$archivo.".php";
}
else{
?>
<?php 
	$cedula = $_POST['archivo'];
	
require_once "../procesos.php"; 
$id_f = $_SESSION["id_franq"];  
//$cedula=$_GET['cedula'];
?>
<form name="f3" id="f3">
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >		

	
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<div class="panel-body" bgcolor="#ffffff">	

				<script>
				archivoDataGrid="busqueda/busq_cont_avanz.php";
				//updateTable();
				</script>
				<input class="form-control" type="hidden" value="<?php echo $id_franq;?>" id="bid_f" >
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">			
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>nombre</label>												
						<input class="form-control" type="text" id="bnombre" maxlength="30" size="15" value="" onKeyPress="return buscarC(event)">
					</div>	
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>apellido</label>												
						<input class="form-control" type="text" id="bapellido" maxlength="30" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>	

					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>rif/cédula</label>												
						<input class="form-control" type="text" id="bcedula" maxlength="10" size="15" value="" onKeyPress="return buscarC(event)">
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>nro abonado</label>												
						<input class="form-control" type="text" id="bnro_contrato" maxlength="100" size="15" value="" onKeyPress="return buscarC(event)">
					</div>

					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>contrato fisico</label>												
						<input class="form-control" type="text" id="bcontrato_fisico" maxlength="10" size="15" value="" onKeyPress="return buscarC(event)">
					</div>										
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>precinto</label>												
						<input class="form-control" type="text" id="betiqueta" maxlength="11" size="15" value="" onKeyPress="return buscarC(event)">
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>poste</label>
						<input class="form-control" type="text" id="bpostel" maxlength="20" size="20" value="" >
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>nro casa / apto</label>
						<input class="form-control" type="text" id="bnumero_casa" maxlength="10" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>celular</label>
						<input class="form-control" type="text" id="btelefono" maxlength="11" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>teléfono</label>
						<input class="form-control" type="text" id="btelf_casa" maxlength="11" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>
					
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Fecha contrato desde</label>
						<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" id="bfecha_contrato" maxlength="10" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>	
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>hasta</label>
						<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" id="bfecha_contrato_h" maxlength="10" size="15" value=""  onKeyPress="return buscarC(event)">
					</div>	
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>status cont</label>
						<select class="form-control" id="bstatus_contrato">
							<option value=""><?php echo _("todos");?></option>
							<?php echo verStatusCont($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>grupo de afinidad</label>
						<select class="form-control" id="bid_g_a"  onchange="">
							<?php echo verGrupoAfinidad($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>vendedor</label>
						<select class="form-control" id="bid_persona"  onchange="">
							<?php echo verVendedores($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>cobrador</label>
						<select class="form-control" id="bcod_id_persona" onchange="">
							<?php echo verCobradores($acceso);?>
						</select>
					</div>
					
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Franquicia</label>
						<select class="form-control" <?php echo $disab;?> id="bid_franq" onchange="bcargarubicacion()">
							<?php echo verFranquicia($acceso);?>
						</select>
					</div>	
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Estado</label >
						<select class="form-control" name="bid_esta" id="bid_esta" onchange="bcargar_municipio_n();">
							<?php echo verEstado($acceso);?>
						</select>
						
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Municipio</label >
						<select class="form-control" name="bid_mun" id="bid_mun" onchange="btraer_estado_n();bcargar_ciudad_n();">
							<?php echo verMun($acceso);?>
						</select>
						
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Ciudad</label >
						<select class="form-control" name="bid_ciudad" id="bid_ciudad" onchange="btraer_municipio_n();bcargarZona_n();">
							<?php echo verCiudad($acceso);?>
						</select>
						
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Zona</label>
						<select class="form-control" id="bid_zona" onchange="btraer_ciudad_n();bcargarSector_n();">
							<?php echo verZona_franquicia($acceso);?>
						</select>
					</div>	
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Sector</label>
						<select class="form-control" id="bid_sector" onchange="bcargar_datos_sector()">
							<option value="0"><?php echo _("Seleccione...");?></option>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Calle</label>
						<select class="form-control" id="bid_calle"   onchange="btraerSector_n();">
							<option value="0"><?php echo _("Seleccione...");?></option>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Urbanización</label >
						<select class="form-control" name="bid_urb" id="bid_urb" onchange="btraerSectorUrb_n()">
							<option value=""><?php echo _("Seleccione...");?></option>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Edificio</label >
						<select class="form-control" name="bid_edif" id="bid_edif" onchange="btraerSectorEdif_n()">
							<option value=""><?php echo _("Seleccione...");?></option>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>tipo facturacion</label >
						<div>
								<input  type="radio" name="btipo_fact" value="POSTPAGO" onclick="buscarContAvanz()">&nbsp;<?php echo _("POSTPAGO");?>&nbsp;&nbsp;&nbsp;
								<input  type="radio" name="btipo_fact" value="PREPAGO" onclick="buscarContAvanz()">&nbsp;<?php echo _("PREPAGO");?>
						</div>			
					</div>
				</div>
					
				
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				
					<button class="btn btn-success" type="button" id="registrar" value="Buscar" onclick="buscarContAvanz()"><i class="fa fa-search"></i> buscar</button>		
				
					<button class="btn btn-default" type="button" id="cerrar" onclick="cerrar_ventana_externa()" value=""><i class="glyphicon glyphicon-remove"></i> Cerrar </button>
				</div>	
				
			</div> <!-- FIN DEL PANEL -->
				
	</section>	
	<section class="panel">
		<header class="panel-heading">resultados encontrados de la búsqueda</header>	
			<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="datagrid_busqueda" style="overflow: auto; "></div>	
				</div>	
			</div> <!-- FIN DEL PANEL -->
	</section>
	

	
</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->		
<form name="f3" id="f3">			
	
<?php
}//if datos
?>		