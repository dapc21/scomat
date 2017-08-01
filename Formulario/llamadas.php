<?php 
	require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('LLAMADAS')))
{
$login = strtoupper(trim($_SESSION["login"]));
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de llamadas</h3></div>
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Búsqueda de Abonados</header>
		
		<div class="panel-body">
		
		<input class="form-control" type="hidden" name="id_contrato" id="id_contrato" maxlength="10" size="15" value="">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Nº de Abonado</label>
				<div class="input-group">
				<input class="form-control" type="text" name="nro_contrato" id="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="" >
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" name="buscar_abonado" id="buscar_abonado" onclick="validarcontrato();"><i class="fa fa-search"></i></button>	
				</div>
				</div>
			</div>
			
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<label>RIF/Cédula</label>
				<div class="input-group">				
				<input class="form-control" type="text" name="cedula_b" id="cedula_b" maxlength="10" size="15" value="" onChange="buscar_cedula_contrato()">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick=""><i class="fa fa-search"></i></button>	
				</div>
				</div>
			</div>

			<div class="form-group area-btn-agregar col-lg-2 col-md-2 col-sm-12 col-xs-12">					
				<button type="button" class="btn btn-info btn-txt" id="busqueda_avanzada" name="busqueda_avanzada" onclick="ajaxVentana('Abonados', this.id);" >
				<i class="fa fa-search"></i> Busqueda Avanzada
				</button>
			</div>	
									
			
		</div>
		
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">

		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Abonado</header>
	
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group col-lg-5 col-md-6 col-sm-12 col-xs-12">
				<label>Nombre(s)</label>
				<input  class="form-control" readonly type="text" name="nombre" id="nombre" maxlength="30" size="15" value="" >

			</div>
			<div class="form-group col-lg-5 col-md-6 col-sm-12 col-xs-12">
				<label>Apellido(s)</label>
				<input class="form-control" readonly type="text" name="apellido" id="apellido" maxlength="30" size="15" value="" >

			</div>
			<div class="form-group col-lg-2 col-md-6 col-sm-12 col-xs-6">
				<label>Estatus</label>
				<input class="form-control" readonly type="text" name="status_contrato" id="status_contrato" maxlength="15" size="15" value="" >
			</div>
			</div>
		</div> <!-- FIN DEL PANEL -->
	</section>
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la llamada</header>
			<div class="panel-body">	
				
				<input class="form-control" type="hidden" name="id_lla" id="id_lla" maxlength="5" size="30"onChange="validarllamadas()" value="<?php $acceso->objeto->ejecutarSql("select *from llamadas   where (id_lla ILIKE '$ini_u%') ORDER BY num desc"); echo $ini_u.verCoo($acceso,"id_lla")?>">
				<input  type="hidden" name="id_lc" id="id_lc" value="">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>TIPO LLAMADA</label>
							<select data-parsley-id="id_tll" required="" class="form-control" name="id_tll" id="id_tll" onchange="">
								<?php echo verTipoLlamada($acceso);?>
							</select>
							<ul id="parsley-id-id_tll" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>TIPO RESPUESTA</label>													
						<select data-parsley-id="id_trl" required="" class="form-control" name="id_trl" id="id_trl" onchange="cargar_detalle_resp();">
							<?php echo verTipoResp($acceso);?>
						</select>	
						<ul id="parsley-id-id_trl" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>DETALLE RESPUESTA</label>													
						<select data-parsley-id="id_drl" required="" class="form-control" name="id_drl" id="id_drl" onchange="traer_tipo_resp()">
							<?php echo verDetalleResp($acceso);?>
						</select>	
						<ul id="parsley-id-id_drl" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>Responsable</label>													
							<input disabled class="form-control" type="text" name="login" id="login" maxlength="30" size="30" value="<?php echo $login;?>"  >							
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>fecha</label>													
								<input disabled class="form-control" type="text" name="fecha_lla" id="fecha_lla" maxlength="30" size="30" value="<?php echo date("d/m/Y");?>"  >							
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>hora</label>													
								<input disabled class="form-control" type="text" name="hora_lla" id="hora_lla" maxlength="30" size="30" value="<?php echo date("H:i");?>"  >							
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>observacion</label>													
							<textarea class="form-control" name="obser_lla" id="obser_lla" rows="2"></textarea>					
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>crear alarma</label>
						<div>																	
							
								<input  type="radio" name="crea_alarma" value="NO"CHECKED/>NO
								<input  type="radio" name="crea_alarma" value="SI"/>SI
						
						</div>
					</div>										
				
				</div>
			
			<input class="form-control" type="hidden" value="dato" name="dato" id="dato">			
			</div> <!-- FIN DEL PANEL -->	
			
	</section>	
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
				
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_llamadas('incluir','llamadas')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		

				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_llamadas('modificar','llamadas')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>

				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_llamadas('eliminar','llamadas')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>

				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_llamadas()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<section class="panel" id="tabla-grupo-afinidad">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las llamadas Registradas</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_llamadas" class="data">
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
</form> <!-- FIN DEL FORMULARIO -->				


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