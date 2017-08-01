<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('final_ordenes_tecnicos')))
{
	
	session_start();
	$id_franq = $_SESSION["id_franq"]; 
	
	if($id_franq=='0'){
		$id_franq="1";
	}
	
	//echo ":$id_franq:";
	$acceso->objeto->ejecutarSql("select * from config_mat where id_franq='$id_franq'");
	if($row=row($acceso)){
		$hab_desc_alm_gru=trim($row["hab_desc_alm_gru"]);
		$hab_desc_alm_gen=trim($row["hab_desc_alm_gen"]);
		$hab_mat_orden=trim($row["hab_mat_orden"]);
		$id_deposito=trim($row["id_deposito"]);
	}
	if($hab_desc_alm_gru=="t"){
		$cargarMat="cargarMatGrupo()";
	}
	else if($hab_desc_alm_gen=="t"){
		$cargarMat="cargarMatGeneral()";
	}
	else if($hab_mat_orden=="t"){
		$cargarMat="cargarMatOrden()";
	}
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
	<form role="form" name="f1" id="f1" data-parsley-validate="">

		<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENU) -->
		<div class="border-head"><h3>Finalizar Órdenes de Servicios</h3></div>
						
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- DIV QUE DIVIDE LA MITAD DE LA IZQUIERDA AL CENTRO-->
		
				<!-- AREA DE PANEL O PANELES -->
			<section class="panel">
			
				<!-- CABECERA O TITULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Búsqueda de Ordenes</header>
				
				<div class="panel-body">
				
					<input class="form-control" type="hidden" name="id_contrato" id="id_contrato" maxlength="10" size="15" value="">
					<input class="form-control" type="hidden" name="dato" id="dato" maxlength="10" size="15" value="dato">
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<label>Nº de Abonado</label>
							<div class="input-group">
								<input data-parsley-id="nombre_paq" required=""  class="form-control" type="text" name="nro_contrato" id="nro_contrato" onChange="buscar_id_orden_final_cont()"  value="" >
								<div class="input-group-btn">
									<button type="button" class="btn btn-info" id="buscar_abonado" onclick=""><i class="fa fa-search"></i></button>	
								</div>
								<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>		
							</div>
						</div>										
						
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<label>Nº de Orden</label>			
							<div class="input-group">
								<input data-parsley-id="nombre_paq" required=""  class="form-control" type="text" name="id_orden" id="id_orden" maxlength="12" size="15"onChange="buscar_orden_final_id_orden()" value="">
								<div class="input-group-btn">
									<button type="button" class="btn btn-info" id="buscar_orden" onclick=""><i class="fa fa-search"></i></button>
								</div>
								<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>			
							</div>
						</div>		
					
							
					</div> <!-- FIN DEL PANEL -->
				
				</div>  <!-- FIN DEL PANEL BODY -->
				
			</section>	
								
			<section class="panel">
				
				<header class="panel-heading"> Datos del Abonado</header>
					
					<div class="panel-body">
				
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
							<div class="form-group col-lg-9 col-md-9 col-sm-6 col-xs-12">
								<label>Nombre cliente</label>			
								<input data-parsley-id="nombre_paq" required="" class="form-control" readonly type="text" name="nombre" id="nombre" maxlength="30" size="50" value="" >
								<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>		
							</div>	
							
							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<label>saldo</label>			
								<input class="form-control" style="#000000; font-weight:blod; font-size:14; "  readonly type="text" name="saldo" id="saldo" maxlength="10" size="10" value="0.00" onChange="">
							</div>														
							
						</div>
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>status</label>			
								<input class="form-control" style="#000000; font-weight:blod; font-size:14; " disabled type="text" name="status_contrato" id="status_contrato"  value="" onChange="">
							</div>	
						
							<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" hidden>
								<label>Contrato Físico</label>			
								<input class="form-control" type="text" name="contrato_fisico" id="contrato_fisico" maxlength="12" size="15"onChange="" value="">
							</div>
							<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<label>Etiqueta</label>								
								<input class="form-control" type="text" name="etiqueta" id="etiqueta" maxlength="12" size="15" value=""  onchange="valida_etiqueta()" >											
							</div>
							<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<label>Poste</label>								
								<input class="form-control" type="text" name="postel" id="postel" maxlength="20" size="20" value="" >						
							</div>
							
							<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12" hidden>
								<label>Puntos</label>								
								<input class="form-control" type="text" name="pto" id="pto" maxlength="20" size="20" value="" >							
							</div>		
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label>Observación del Cliente</label>
								<textarea class="form-control"  name="comentario_cliente" id="comentario_cliente" rows="1"></textarea>
								
							</div>
									
						</div>
									
					</div>
				
			</section>
		</div>				
		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- DIV QUE DIVIDE LA MITAD DEL CENTRO HACIA LA DERECHA -->				
		
			<section class="panel">
			<header class="panel-heading"> Datos de la Orden<i class="fa fa-print fa-2x pull-right actualizar" title="Reimprimir Orden" name="salcvir_ord" id="salcvir_ord" onclick="reimprimir_orde()" style="margin-top:-0.1em;margin-left:0.2em"></i>
				<i class="fa fa-calendar-o fa-2x pull-right actualizar" title="Agregar Visita" name="btnvisita_ord" id="btnvisita_ord" onclick="agregar_visita()" style="margin-top:-0.1em;margin-right:0.2em;margin-left:0.2em"></i>				
				</header>
					
					<div class="panel-body">
				
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<input class="form-control" type="hidden" name="tipo_detalle" id="tipo_detalle" maxlength="12" size="20"onChange="validarordenes_tecnicos()" value="">
						
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Grupo Trabajo</label>
								<div class="input-group">
									<select data-parsley-id="nombre_paq" required="" class="form-control" name="id_gt" id="id_gt" onchange="ver_config_mat()">
										<?php echo verGrupoTec($acceso);?>
									</select>
									<div class="input-group-btn">
										<button type="button" class="btn btn-info actualizarn" title="Reasignar Grupo" id="reasignar_grupo" name="reasignar_grupo" onclick="asignar_grupo()"><i class="fa fa-male"></i></button>	
									</div>
									<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>		
								</div>
							</div>	
																				
							
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Fecha de Finalización</label>			
									<input data-parsley-id="nombre_paq" required="" disabled class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_final" id="fecha_final" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >					
									<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>		
							</div>
							
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Tipo de Órden</label>
								<div class="input-group">
									<select data-parsley-id="nombre_paq" required="" class="form-control" DISABLED name="id_tipo_orden" id="id_tipo_orden" onchange="cargarDO()">	
									<?php echo verTipoOrden($acceso);?>	
									</select>
									<div class="input-group-btn">
										<button type="button" class="btn btn-warning actualizarn" title="Revertir Orden a Imprimir" id="revertir" name="revertir" onclick="revertir_imp()"><i class="fa fa-undo"></i></button>	
									</div>
									<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>		
								</div>
							</div>																					
							
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Detalle de Órden</label>			
									<select data-parsley-id="nombre_paq" required=""  disabled class="form-control" name="id_det_orden" id="id_det_orden" onchange="">
										<?php echo verDetalleOrden($acceso);?>
									</select>
									<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>		
							</div>
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label>Observacion Orden</label>								
									<textarea disabled class="form-control"  name="detalle_orden" id="detalle_orden" rows="2"></textarea>
							</div>
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label>Observacion Tecnico</label>								
									<textarea data-parsley-id="nombre_paq" required="" class="form-control"  name="comentario_orden" id="comentario_orden" rows="2" ></textarea>
									<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>		
							</div>
																					
						
						</div>
						
					</div>
				
			</section>
		</div>
</div>


		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- DIV QUE DIVIDE LA MITAD DE LA IZQUIERDA AL CENTRO-->
		
			<section class="panel">
				
				<header class="panel-heading"> Listado de Materiales<i class="fa fa-legal fa-2x pull-right actualizar" title="Agregar Material" name="agregar_material" id="agregar_material" onclick="cargar_form_add_material()" style="margin-top:-0.1em"></i></header>
					
					<div class="panel-body">
				
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								
								<div id="materiales"></div>
																
							</div>
							
						</div>						
									
					</div>
				
			</section>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- DIV QUE DIVIDE LA MITAD DEL CENTRO HACIA LA DERECHA -->
		
			<section class="panel">
				
				<header class="panel-heading"> Listado de Equipos<i class="fa fa-hdd-o fa-2x pull-right actualizar" title="Agregar Equipos" name="agregar_deco" id="agregar_deco" onclick="cargar_form_add_terminal()" style="margin-top:-0.1em"></i></header>
					
					<div class="panel-body">
				
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div id="terminales_orden"></div>								
								
							</div>												
																					
						
						</div>
						
					</div>
				
			</section>
		</div>
</div>

			
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
											
		<!-- AREA DE PANEL O PANELES -->
		<section class="panel">
		
			<div class="panel-body">
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">						
						<button class="btn btn-success" type="button" disabled type="<?php echo $obj->in;?>" name="registrar_ord" id="registrar_ord" value="<?php echo _("finalizar orden");?>" onclick="gestionar_ordenes_tecnicos('finalizar','ordenes_tecnicos')"><i class="glyphicon glyphicon-ok"></i> Finalizar Orden</button>
						<button class="btn btn-warning" type="button" disabled type="<?php echo $obj->in;?>" name="cancelar_ord" id="cancelar_ord" value="<?php echo _("cancelar orden");?>" onclick="cancelarOrdenTec()"><i class="glyphicon glyphicon-remove"></i> Cancelar Orden</button>
						<button class="btn btn-danger" type="button" disabled type="<?php echo $obj->in;?>" name="devolver_ord" id="devolver_ord" value="<?php echo _("devolver orden");?>" onclick="devolverOrdenTec()"><i class="fa fa-mail-reply"></i> Devolver Orden</button>
						<button class="btn btn-info" type="button" name="salir_ord" id="salir_ord" onclick="cargar_form_final_ordenes_tecnicos()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>	
					</div>
			</div>			
		    
		</section>
				
		<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TITULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">ordenes de servicios para finalizar<i class="fa fa-filter fa-2x actualizar" title="Filtrar Ordenes" id="mostrar_busqueda" onclick="ocultarmostrardiv('seccion_filtros_ordenes')" style="margin-top:-0.1em;margin-left:1em"></i></header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body" id="seccion_filtros_ordenes" style="display:none">
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Desde</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="desde" id="desde" maxlength="10" size="10" value="">	
			</div>
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Hasta</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="hasta" id="hasta" maxlength="10" size="10" value="">	
			</div>	
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>franquicia</label>
					<select class="form-control" name="id_franq" id="id_franq" onCHANGE="filtrar_final_orden()">
							<?php echo verFranquicia($acceso);?>
					</select>
			</div>		
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>grupo</label>
					<select class="form-control" name="id_gt1" id="id_gt1" onchange="filtrar_final_orden()">
						<option value="TODOS"><?php echo _("todos");?></option>
						<option value=""><?php echo _("sin grupo");?></option>
						<?php echo verGrupoTecnico($acceso);?>
					</select>
			</div>				
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>tipo orden</label>
					<select class="form-control" name="id_tipo_orden1" id="id_tipo_orden1" onchange="cargarDO1();filtrar_final_orden()">
						<option value=""><?php echo _("todos");?></option>
						<?php echo verTipoOrdenEst($acceso);?>
					</select>
			</div>	
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>detalle orden</label>
				<select class="form-control" name="id_det_orden1" id="id_det_orden1" onchange="traerTO();filtrar_final_orden()">
					<option value=""><?php echo _("todos");?></option>
					<?php echo verDetalleOrdenFiltro($acceso);?>
				</select>
			</div>
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>prioridad</label>
				<select class="form-control" name="prioridad" id="prioridad" onchange="filtrar_final_orden()">
					<option value=""><?php echo _("todos");?></option>
					<option value="NORMAL"><?php echo _("normal");?></option>
					<option value="URGENTE"><?php echo _("urgente");?></option>
					<option value="EMERGENCIA"><?php echo _("emergencia");?></option>
				</select>
			</div>
			
			<div class="form-group area-btn-agregar col-lg-2 col-md-2 col-sm-12 col-xs-12">					
				<button type="button" class="btn btn-info btn-txt" id="registrar" name="registrar" onclick="filtrar_final_orden()" >
				<i class="fa fa-search"></i> Buscar
				</button>
			</div>
		</div> <!-- FIN DEL PANEL -->
				
	</section>
	
	<section class="panel" id="tabla-finalizar-orden-servicio">			
		<div class="panel-body">
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div id="datagrid" class="data"></div>			
			</div>
		</div> <!-- FIN DEL PANEL -->

	</section> <!-- FIN DEL AREA DE PANEL O PANELES -->

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