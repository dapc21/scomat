<?php  session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ordenes_tecnicos2')))
{
session_start();
						$id_fr = $_SESSION["id_franq"]; 
						$serie='';
						if($id_fr!='0'){
							$cons=" and  id_franq='$id_fr'";
							$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_fr'");
							$row=row($acceso);
							$serie= trim($row["serie"]);
						}
						else{
							$cons=" and  id_franq='1'";
						}
						
						$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos, contrato,vista_ubica where  ordenes_tecnicos.id_contrato = contrato.id_contrato and contrato.id_calle=vista_ubica.id_calle  ORDER BY num_o desc  LIMIT 1 offset 0 "); 
						$id_orden = verNumero($acceso,"id_orden");
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12">
<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_asig_contrato1" >
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>asignar ordenes a tecnicos</h3></div>
	
<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Cliente</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
			<input class="form-control" type="hidden" name="id_contrato" maxlength="10" size="15" value="">
			<input class="form-control" type="hidden" name="status_con" maxlength="10" size="20" value="POR INSTALAR">
			
			<div class="form-group col-lg-4 col-md-5 col-sm-5 col-xs-12">
				<label>nro abonado</label >
				<div class="input-group">
					<input class="form-control" type="text" name="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="" >
					<!--<a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a>-->
					<div class="input-group-btn">
						<button type="button" class="btn btn-info" id="buscar_abonado" onclick="ajaxVentana('Número de abonado', this.id);"><i class="fa fa-search"></i></button>	
					</div>
				</div>
			</div> <!--primer div-->
			
			<div class="form-group col-lg-4 col-md-3 col-sm-3 col-xs-12">
				<label>RIF/C&eacute;dula</label>
				<div class="input-group">
				<input class="form-control" type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula();">
				<!--a href="#" onclick="" ><img src="imagenes/buscar.png" width="20px" height="20px" title="Buscar Cliente"></a-->
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick="ajaxVentana('RIF/Cédula', this.id);"><i class="fa fa-search"></i></button>	
				</div>
				</div>
			</div>	
			
			<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<!--a href="#" onclick="abrirBusq_cont_avanz()" ><img src="imagenes/busAvanz1.png" width="150px" height="25px" title="Busqueda Avanzada"></a-->
				<label><i class="fa fa-edit label-blanco"></i></label>
				<div class="input-group text-btn">
				<input class="form-control" type="hidden" value="0" name="tipo_s" value="AUTOMATICO">	
				<button type="button" class="btn btn-info" id="buscar_avanzado" name="agregar" onclick="ajaxVentana_BA('Abonados', this.id);">
				<i class="fa fa-search"></i> Busqueda Avanzada
				</button>
				</div>
			</div>	
			
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Nombre</label>
				<input  class="form-control" readonly type="text" name="nombre" maxlength="30" size="15" value="" >

			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Apellido</label>
				<input class="form-control" readonly type="text" name="apellido" maxlength="30" size="15" value="" >

			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Estatus</label>
				<input class="form-control" readonly type="text" name="status_pago" maxlength="15" size="15" value="" >
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Zona</label>
				<input class="form-control" readonly type="text" name="id_zona" maxlength="15" size="15" value="" >
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Sector</label>
				<input class="form-control" readonly type="text" name="id_sector" maxlength="15" size="15" value="" >
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Calle</label>
				<input class="form-control" readonly type="text" name="id_calle" maxlength="15" size="15" value="" >
			</div>
		</div> <!-- FIN DEL PANEL -->
	</section>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Orden</header>
			<div class="panel-body">	
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label>nro de orden</label>
					<input class="form-control" type="text" name="id_orden" maxlength="12" size="20"onChange="validarordenes_tecnicos()" value="<?php echo $id_orden;?>">
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label>tecnico</label>
					<select class="form-control" name="id_persona" id="-1" onchange="">
						<?php echo utf8_decode(verTecnicos($acceso));?>
					</select>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<label>tipo de orden</label>
					<select class="form-control" name="id_tipo_orden" id="id_tipo_orden" onchange="cargarDO()">
						<?php echo utf8_decode(verTipoOrden($acceso));?>
					</select>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<label>detalle orden</label>
					<select class="form-control" name="id_det_orden" id="id_det_orden" onchange="traerTO()">
						<?php //echo verDetalleOrden($acceso);?>
					</select>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<label>prioridad</label>
					<select class="form-control" name="prioridad" id="prioridad">
					<option value="NORMAL"><?php echo _("normal");?></option>
					<option value="URGENTE"><?php echo _("urgente");?></option>
					<option value="EMERGENCIA"><?php echo _("emergencia");?></option>
					</select>
				</div>
			
				<input class="form-control" type="hidden" name="fecha_orden" id="fecha_orden" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
				<input class="form-control" type="hidden" name="fecha_final" id="fecha_final" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
				
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>comentario orden</label>
					<textarea class="form-control" name="detalle_orden"></textarea>
				</div>
		
				<input class="form-control" type="hidden" value="CREADO" name="status_orden">
				<input class="form-control" type="hidden" value="" name="comentario_orden">
		
			</div> <!-- FIN DEL PANEL -->
		
			<div class="panel-body">
				<div class="text-btn" align="center">
					<button class="btn btn-info"  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','asig_orden')"><i class="glyphicon glyphicon-ok"></i>Registrar</button>
					<input class="btn btn-warning" type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','ordenes_tecnicos')">&nbsp;
					<input class="btn btn-warning" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','ordenes_tecnicos')">&nbsp;
				</div>
			</div> <!-- FIN DEL PANEL -->	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->

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