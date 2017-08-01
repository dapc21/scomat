<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('MODIFICAR_GRUPO_ORDEN')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="ordenes_tecnico" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>modificar grupo de trabajo a ordenes</h3></div>
	
	<input type="hidden" value="TEC00001" name="id_persona">
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Orden</header>
			<div class="panel-body">	
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Nº de Órden</label>
						<input class="form-control" type="text" name="id_orden" maxlength="12" size="20"onChange="validarordenes_tecnicos()" value="<?php echo $id_orden;?>">						
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Prioridad</label>
						<select class="form-control" name="prioridad" id="prioridad">
							<option value="NORMAL"><?php echo _("normal");?></option>
							<option value="URGENTE"><?php echo _("urgente");?></option>
							<option value="EMERGENCIA"><?php echo _("emergencia");?></option>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Tipo de Órden</label>						
						<select class="form-control" name="id_tipo_orden" id="id_tipo_orden" onchange="cargarDO()">
							<?php echo utf8_decode(verTipoOrden($acceso));?>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Detalle de Órden</label>
						<select class="form-control" name="id_det_orden" id="id_det_orden" onchange="traerTO()">
							<?php echo verDetalleOrden($acceso);?>
						</select>
					</div>
			
					<input class="form-control" type="hidden" name="fecha_orden" id="fecha_orden" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
					<input class="form-control" type="hidden" name="fecha_final" id="fecha_imp" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
					<input class="form-control" type="hidden" name="fecha_final" id="fecha_final" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Comentario</label>
						<textarea class="form-control" name="detalle_orden"></textarea>
					</div>
				
					<input class="form-control" type="hidden" value="CREADO" name="status_orden">
					<input class="form-control" type="hidden" value="" name="comentario_orden">
					
				</div>
			
			</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Impresión</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>asignar a grupo</label>			
						<select class="form-control" name="id_gt" id="gt" onchange="">
							<?php echo verGrupoTec($acceso);?>
						</select>
					</div>											
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>			
	
	<!-- EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O TΔULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Búsqueda de Clientes</header>
			<div class="panel-body">	
				<input class="form-control" type="hidden" name="id_contrato" maxlength="10" size="15" value="">
				<input class="form-control" type="hidden" name="status_con" maxlength="10" size="20" value="POR INSTALAR">
		
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>N°Abonado</label>
						<div class="input-group">
							<input class="form-control" type="text" name="nro_contrato" onChange="validarcontrato();" maxlength="11" size="12" value="" >
							<!--a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a-->
							<div class="input-group-btn">
								<button type="button" class="btn btn-info" id="buscar_abonado" onclick="ajaxVentana('Número de abonado', this.id);"><i class="fa fa-search"></i></button>	
							</div>
						</div>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>RIF/Cédula</label>
						<div class="input-group">
						<input class="form-control" type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula();">
						<!--a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a-->
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick="ajaxVentana('RIF/Cédula', this.id);"><i class="fa fa-search"></i></button>	
						</div>
						</div>
					</div>					
			
				</div>
		
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<section class="panel">
	
		<!-- CABECERA O TΔULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Clientes</header>
			<div class="panel-body">	
				<input class="form-control" type="hidden" name="id_contrato" maxlength="10" size="15" value="">
				<input class="form-control" type="hidden" name="status_con" maxlength="10" size="20" value="POR INSTALAR">
		
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Nombre</label>						
							<input class="form-control" readonly type="text" name="nombre" maxlength="30" size="15" value="" >													
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Apellido</label>						
							<input class="form-control" readonly type="text" name="apellido" maxlength="30" size="15" value="" >													
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Status</label>						
							<input class="form-control" readonly type="text" name="status_pago" maxlength="15" size="15" value="" >												
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Zona</label>						
							<input class="form-control" readonly type="text" name="id_zona" maxlength="11" size="15" value="" >													
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Sector</label>	
							<input class="form-control" readonly type="text" name="id_sector" maxlength="11" size="15" value="" >							
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Calle</label>	
							<input class="form-control" readonly type="text" name="id_calle" maxlength="11" size="15" value="" >							
					</div>										
								
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	

	<!-- EA DE PANEL O PANELES -->
	<section class="panel">		
			<div class="panel-body">	
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<button class="btn btn-warning" type="button" type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar orden");?>" onclick="cambiar_grupo_trabajo()"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
						<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','ordenes_tecnicos')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>						
						<input class="form-control" type="hidden" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','ordenes_tecnicos')">						
						<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','ordenes_tecnicos')">
					</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>		  
 	
	<!-- EA DE PANEL O PANELES -->
	<section class="panel">		
		<!-- CABECERA O TΔULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Órdenes Pendientes</header>
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