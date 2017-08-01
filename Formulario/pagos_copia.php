<?php require_once "procesos.php";
		session_start();
	$id_f = $_SESSION["id_franq"]; 
	$serie='';
	$cons_serie="";
	if($id_f!='0'){
		$consult=" and  id_franq='$id_f'";
		$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_f'");
		$row=row($acceso);
		$serie= trim($row["serie"]);
		$cons_serie="  and (nro_contrato ilike '$serie%') ";
	}
	else{
		$consult=" and  id_franq='1'";
	}
		
$ini_u = $_SESSION["ini_u"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PAGOS')))
{
//echo ":$obj->in:";
//echo "$obj->mo:";
$fecha= date("Y-m-d");


	$id_persona=$_SESSION["id_persona"];

	$ip_est = $_SERVER['REMOTE_ADDR'];
	$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
	if($row=row($acceso)){
		$id_est=trim($row['id_est']);
		$nombre_est=trim($row['nombre_est']);
	}
	
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha'  and id_est='$id_est' and status_caja_cob='Abierta'");

if($acceso->objeto->registros<=0)
	echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
			<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
			<p class="contenido-alerta" align="justify"> Probables causas:<br>
			<ul class="contenido-alerta">
			<li> 1- No ha aperturado un Punto de Cobro (Caja). NOTA: Para aperturar el Punto de Cobro (Caja) ubíquese en el menú lateral: <a href="javascript:conexionPHP(\'formulario.php\',\'caja_cobrador\');" class="alert-link">Cobranza -> Abrir Caja</a>. </li> 
			<li> 2- Probablemente aperturó un Punto de Cobro (Caja) desde otra Estación de Trabajo. </li> 
			 <ul>
			</p>
		</div>';
else{

	$row=row($acceso);
	$id_caja=trim($row['id_caja']);
	$id_caja_cob=trim($row['id_caja_cob']);
	
	
	$tipo_caja=trim($row['tipo_caja']);
	//ECHO "$tipo_caja:";
	$caja_externa=trim($row['caja_externa']);
	$fecha_sugerida=date("d/m/Y", strtotime(trim($row['fecha_sugerida'])));
	$nombre_caja_cob=trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"])." => E.T. ".$nombre_est;
	
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	
	$acceso->objeto->ejecutarSql("select count(*) as cant from pagos,vista_caja where pagos.id_caja_cob=vista_caja.id_caja_cob and fecha_pago<'$fecha' and impresion='NO' and status_pago='PAGADO' and tipo_caja='PRINCIPAL' and tipo_doc='PAGO'");
		if($row=row($acceso)){
			$cant=trim($row['cant'])+0;
		}
	if($cant>0){
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
			<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
			<p class="contenido-alerta" align="justify"> Error, Tiene '.$cant.' pagos pendientes por facturar antes de esta fecha, debe imprirlos<br>
			
			</p>
		</div>';
	}
	else{
	
$acceso->objeto->ejecutarSql("select *from parametros where id_param='47' and id_franq='1'");
$row=row($acceso);
$pagao_efec_G=trim($row['valor_param']);
	
$acceso->objeto->ejecutarSql("select *from parametros where id_param='46' and id_franq='1'");
$row=row($acceso);
$dig_fact_G=trim($row['valor_param']);
	
$acceso->objeto->ejecutarSql("select *from parametros where id_param='52' and id_franq='1'");
$row=row($acceso);
$dig_control_G=trim($row['valor_param']);
	
$acceso->objeto->ejecutarSql("select *from parametros where id_param='53' and id_franq='1'");
$row=row($acceso);
$control_recibo_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='55' and id_franq='1'");
$row=row($acceso);
$orden_factura_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='56' and id_franq='1'");
$row=row($acceso);
$orden_control_G=trim($row['valor_param']);


$fecha_ant=restadia(date("Y-m-d"),5);




if($orden_factura_G=='UNICO'){
	if($tipo_caja=='PRINCIPAL'){
		$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'  and impresion='SI' and fecha_pago>='$fecha_ant' and tipo_caja='PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 

		$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
	}
	else{
		//ECHO "select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'  and impresion='SI' and fecha_pago>='$fecha_ant' and tipo_caja<>'PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 ";
		$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'  and impresion='SI' and fecha_pago>='$fecha_ant' and tipo_caja<>'PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 

		$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
	}
}
else if($orden_factura_G=='POR ESTACION'){
	$fecha_ant=restadia(date("Y-m-d"),5);
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'   and fecha_pago>='$fecha_ant' and impresion='SI' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
	//echo "<br>dig:$dig_fact_G:";
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
//	echo "<br>$nro_factura:";
}
else if($orden_factura_G=='POR CAJA'){
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'  and impresion='SI' ORDER BY inc desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
}
else {
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'  and impresion='SI' ORDER BY inc desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
}
	

if($orden_control_G=='UNICO'){
	if($tipo_caja=='PRINCIPAL'){
		$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador ,caja where caja_cobrador.id_caja=caja.id_caja and   pagos.id_caja_cob=caja_cobrador.id_caja_cob   and impresion='SI'  and fecha_pago>='$fecha_ant' and tipo_caja='PRINCIPAL' ORDER BY nro_control desc LIMIT 1 offset 0");
		$nro_control = verNumero_control_v4($acceso,"nro_control",$dig_control_G);
	}
	else{
		$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador ,caja where caja_cobrador.id_caja=caja.id_caja and   pagos.id_caja_cob=caja_cobrador.id_caja_cob   and impresion='SI'  and fecha_pago>='$fecha_ant'  and tipo_caja<>'PRINCIPAL' ORDER BY nro_control desc LIMIT 1 offset 0");
		$nro_control = verNumero_control_v4($acceso,"nro_control",$dig_control_G);
	}
	
}
else if($orden_control_G=='POR ESTACION'){
	$fecha_ant=restadia(date("Y-m-d"),1);
	$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob    and fecha_pago>='$fecha_ant' and impresion='SI' ORDER BY nro_control desc LIMIT 1 offset 0");
	$nro_control = verNumero_control_v4($acceso,"nro_control",$dig_control_G);
}
else if($orden_control_G=='POR CAJA'){
	$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob   and impresion='SI' ORDER BY inc desc LIMIT 1 offset 0");
	$nro_control = verNumero_control_v4($acceso,"nro_control",$dig_control_G);
}
else {
	$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob   and impresion='SI' ORDER BY inc desc LIMIT 1 offset 0");
	$nro_control = verNumero_control_v4($acceso,"nro_control",$dig_control_G);
}
	

	

if($control_recibo_G=='1'){

	if($caja_externa!='OFICINA'){
		$acceso->objeto->ejecutarSql("select nro_recibo from vista_recibos where id_persona='$id_persona' and tipo='FACTURA' and  status_pago='RECIBIDO' order by nro_recibo");
		if($row=row($acceso)){
			$nro_control=trim($row['nro_recibo']);
		}	
	}else{
		$nro_control='';
	}
}

	$acceso->objeto->ejecutarSql("select nro_factura from pagos where nro_factura='$nro_factura'"); 
	if($acceso->objeto->registros>0){
	//	$nro_factura = '';
	}
	
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='3'"); 
	if($row=row($acceso)){
		$valor_param_v=trim($row['valor_param']);
	}
	
	$bgcolor=array("EXTERNA"=>"CFD2D6","OFICINA"=>"F5F9FE","COBRADOR EMPRESA"=>"CFD2D6");

?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_cargar_deuda" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Facturar (Abonados)
		<div class="form-btn pull-right">
			<div class="row">
			 <button type="button" class="btn btn-info" id="add_asignar_orden" name="agregar" onclick="llamar_actualizar_datos_pagos()">
				<i class="glyphicon glyphicon-ok"></i> Actualizar Datos
			 </button>
			 <button type="button" class="btn btn-success" id="add_asignar_orden" name="agregar" onclick="llamar_ordenes_tecnicos_pagos()">
				<i class="fa fa-pencil"></i> Asignar Órdenes
			 </button>
			<button type="button" class="btn btn-danger" id="add_cargar_deuda" name="agregar" onclick="llamar_cargar_deuda_pagos()">
				<i class="fa fa-plus"></i> Cargar Deuda
			</button>
			</div>
		</div>
	</h3>
	</div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
			
			<div class="panel-body">
			
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm6- col-xs-12">
						<label>Nº de Abonado</label>
						<div class="input-group">
							<input class="form-control" type="text" name="nro_contrato" onChange="validarcontrato_todo();" maxlength="11" size="12" value="" >
							<div class="input-group-btn">
								<button type="button" class="btn btn-info" id="buscar_abonado" onclick="validarcontrato_todo();"><i class="fa fa-search"></i></button>	
							</div>
						</div>
					</div>
					 <div class="col-lg-2 col-md-2 col-sm6- col-xs-12">
							<label>RIF/Cédula</label>
							<div class="input-group">
								<input class="form-control" type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula_todo();">
								<div class="input-group-btn">
									<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick="buscarXcedula_todo();"><i class="fa fa-search"></i></button>	
								</div>
							</div>
					 </div>
					<div class="col-lg-2 col-md-2 col-sm6- col-xs-12">
							<label>Contrato Fisico</label>
							<div class="input-group">						
								<input class="form-control" type="text" name="contrato_fis" onChange="buscarxcontrato_fisico_todo()" maxlength="11" size="12" value="">
								<div class="input-group-btn">
									<button type="button" class="btn btn-info" id="buscar_abonado" onclick="buscarxcontrato_fisico_todo();"><i class="fa fa-search"></i></button>	
								</div>
							</div>
					</div>		
					<input class="form-control" type="hidden" value="0" name="tipo_s" value="AUTOMATICO">
					
					<div class="col-lg-2 col-md-2 col-sm6- col-xs-12">	
						<label><i class="fa fa-edit label-blanco"></i></label>					
							<button type="button" class="btn btn-info contenido-boton" id="buscar_avanzado_consultar_clientes" name="agregar" onclick="ajaxVentana_BAT('Abonados', this.id);" >
							<i class="fa fa-search"></i></button>
					</div>	
				
				</div> <!-- FIN DEL ROW -->
				
			</div> <!-- FIN DEL PANEL BODY-->
								
	</section>		
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Abonado</header>
		
			<div class="panel-body">
			
				<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">		
				<input  type="hidden" name="caja_externa" maxlength="10" size="15" value="<?php echo $caja_externa; ?>">
				
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm6- col-xs-12">
							<label>Tipo Documento: </label >							
							<label name="nombre">V19447744</label >							
					 </div>			 										 
					 <div class="col-lg-6 col-md-6 col-sm6- col-xs-12">
							<label>Cliente: <?php echo $nombre; ?>&nbsp;&nbsp;<?php echo $apellido; ?></label> 						
					  </div>					  
					 
					 <div class="col-lg-3 col-md-4 col-sm6- col-xs-12">
							<label>Estatus: <?php echo $status_contrato;?></label >								
					 </div>					 					
					 <div class="col-lg-12 col-md-6 col-sm6- col-xs-12">
							<label>Dirección: <?php echo $id_zona; ?>&nbsp;<?php echo $id_zona; ?>&nbsp;<?php echo $id_sector; ?>&nbsp;<?php echo $id_calle; ?>&nbsp;<?php echo $fecha_contrato; ?>&nbsp;<?php echo $direc_adicional; ?></label >							
					 </div>
					 <input type="hidden" name="status_pago" maxlength="15" size="15" value="PAGADO" >
					<input readonly type="hidden" name="id_persona" maxlength="10" size="5" value="<?php echo $id_persona; ?>" >
					<input readonly type="hidden" name="base" maxlength="10" size="5" value="0" >
					<input readonly type="hidden" name="iva" maxlength="10" size="5" value="0" >	
					 
				</div> <!-- FIN DEL ROW -->
				
			</div> <!-- FIN DEL PANEL BODY-->					
	
	</section>
		
	<!-- ÁREA DE PANEL O PANELES -->
	
		<div class="row">					
							
			<div class="col-lg-6">						
						
				<section class="panel">						
						<header class="panel-heading">Datos de la Factura</header>	
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-4 col-md-3 col-sm6- col-xs-12">
											<label>Nº de Factura</label>
											<input class="form-control" <?php if($valor_param_v=='1'){ echo "readonly";}?> type="text" name="nro_factura" onChange="validarpagosfact()" maxlength="10" size="20" value="<?php echo $nro_factura; ?>" >										
									 </div>	
									<div class="form-group col-lg-4 col-md-3 col-sm-6 col-xs-12">
										<label>Fecha Factura</label>
										<input class="form-control" disabled type="text" name="fecha_factura" id="fecha_factura" maxlength="10" size="20" value="<?php echo $fecha_sugerida;?>" >
									</div>	
									<div class="form-group col-lg-4 col-md-3 col-sm-6 col-xs-12">
										<label>Total a pagar</label>
										<input class="form-control" type="text" name="monto_pago" maxlength="10" size="20" value="0" onchange="adaptar_cargos();" style="color:blue; font-weight:blod;" >
									</div>
									
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label>Forma de Pago 1</label>
										<div class="input-group">
											<span class="input-group-addon">
											<input disabled type="checkbox" name="checktp" value="REGISTRADO" checked />
											</span>
											<select class="form-control" name="id_tipo_pago" id="id_tipo_pago" onchange="cargarDetTipoPago();valida_numero_ref();">
												<?php echo verTipoPago($acceso);?>
											</select>
										</div>
									</div>
									<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label>Forma de Pago 2</label>
										<div class="input-group">
										<span class="input-group-addon">
										<input type="checkbox" name="checktp1" value="REGISTRADO"  onchange="habilita_fp()">
										</span>
										<select class="form-control" disabled name="id_tipo_pago1" id="id_tipo_pago1" onchange="cargarDetTipoPago1()" />
											<?php echo traer_tipo_pago($acceso,'TPA00001');?>
										</select>
										</div>
									</div>
									
									<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">				
										<label>Monto 1</label>
										<input class="form-control" disabled type="text" name="monto_tp" maxlength="10" size="15" value="0" >
									</div>
									<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<label>Banco 1</label >
										<div class="input-group">
										<select class="form-control" <?php echo $pagao_efec_G;?> name="banco" id="banco" onchange="valida_numero_ref()">
											<?php echo verBanco($acceso);?>
										</select>						
										</div>						
									</div>
									<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">				
										<label>Número 1</label>
										<input class="form-control" <?php echo $pagao_efec_G;?> type="text" name="numero" maxlength="25" size="15" value="" onchange="valida_numero_ref()">
									</div>
									
									<div id="fpago2" style="display:none"><!--hidden-->
										<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">				
											<label>Monto 2</label>
											<input class="form-control" disabled type="text" name="monto_tp1" maxlength="10"  onkeyup="calc_mtp()" size="15" value="0" >
										</div>
										<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<label>Banco 2</label >
											<div class="input-group">
												<select class="form-control" disabled name="banco1" id="banco1" onchange="">
													<?php echo verBanco($acceso);?>
												</select>
											</div>						
										</div>
										<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">				
											<label>Número 2</label>
											<input class="form-control" disabled type="text" name="numero1" maxlength="25" size="15" value="" >
										</div>
									</div><!--hideen-->
										
								</div>
									<input class="form-control" type="hidden" name="id_pago" maxlength="15" size="20"onChange="validarpagos()" value="<?php echo $id_pago;?>">
									<input class="form-control" disabled type="hidden" name="hora_pago" maxlength="8" size="20" value="<?php echo date("H:i:s");?>" >
									<input type="hidden" value="" name="obser_detalle">
								
									<input class="form-control" type="hidden" value="dato" name="dato">
									<input class="form-control" type="hidden" name="id_cont_serv" maxlength="12" size="15"onChange="validarcontrato_servicio()" value="<?php $acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%') ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); echo $ini_u.verCodLong($acceso,"id_cont_serv")?>">
									<input class="form-control" type="hidden" name="fecha_inst" id="fecha_inst" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
									<input class="form-control" type="hidden" name="cant_serv" maxlength="2" size="15" value="1" >
								
							</div>
				</section>			
			</div> <!-- FIN DEL col 6-->
			
			<div class="col-lg-6">						
						
				<section class="panel">		
					
					<header class="panel-heading">Cargos</header>	
					<div class="panel-body">
						
							
							<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">	
								<div id="datagrid" class="data"></div>
								<input  type="hidden" name="total_reg_data" value="0">
								<input  type="hidden" name="deuda_total" value="0">
								<input  type="hidden" name="desc_pago" value="FALSE">
							</div>
							
						
					</div>
				</section>			
			</div> <!-- FIN DEL col 6-->
		</div>
	
		<section class="panel">
		<!--títulos de las pestañas-->
		<!--header class="panel-heading tab-bg-succes"-->
			<ul class="nav nav-tabs" id="tabConsultarCliente">
								
				<li class="">
					<a data-toggle="pill" href="#tab-estado_cuenta" onclick="mostrar_estado_cuenta()"><i class="fa fa-money"></i> Estado de Cuenta</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-ordenes" onclick="mostrarHistorial_ordenes()"><i class="fa fa-files-o"></i> Operaciones</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-suscripcion" onclick="mostrar_Suscripcion()"><i class="fa fa-files-o"></i> Suscripcion</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-comunicacion" onclick="mostrarHistorial_comunicacion()"><i class="fa fa-comment-o"></i> SMS</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-llamadas" onclick="mostrarHistorial_vitacora()"><i class="fa fa-phone"></i> Llamadas</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-pagodep" onclick="mostrarpago_depositos()"><i class="fa fa-table"></i> Depositos</a>
				</li>
				<li class="">
					<a data-toggle="pill" href="#tab-promocion" onclick="mostrar_promociones()"><i class="fa fa-table"></i> Promociones</a>
				</li>
			</ul>
		<!--/header-->
		<!--contenido de las pestañas-->
		<div class="panel-body">
			<div class="tab-content">
				<div id="tab-cargos" class="tab-pane fade in active">
				<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">	
					<div id="datagrid" class="data"></div>
					<input  type="hidden" name="total_reg_data" value="0">
					<input  type="hidden" name="deuda_total" value="0">
					<input  type="hidden" name="desc_pago" value="FALSE">
				</div>
				</div>
				
				<div id="tab-estado_cuenta" class="tab-pane fade">
				
					<div id="estado_cuenta"></div>
				</div>
				<div id="tab-ordenes" class="tab-pane fade">
				
					<div id="estado"></div>
				</div>
				<div id="tab-suscripcion" class="tab-pane fade">
				
					<div id="suscripcion"></div>
				</div>
				<div id="tab-comunicacion" class="tab-pane fade">
				
					<div id="comunicacion"></div>
				</div>
				<div id="tab-llamadas" class="tab-pane fade">
				
					<div id="vitacora"></div>
				</div>
				<div id="tab-pagodep" class="tab-pane fade">
				
					<div id="pagodep"></div>
				</div>
				<div id="tab-promocion" class="tab-pane fade">
				
					<div id="promocion"></div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
		
			<?php if($obj->in=="button"){?>
			<button class="btn btn-info" type="<?php echo $obj->in;?>" name="registrar1" value="<?php echo _("imprimir Pago");?>" onclick="verificar('incluir','pagos')"><i class="glyphicon glyphicon-ok"></i> Imprimir Pago</button>
			<?php }?>
			<?php if($obj->mo=="button"){?>
			<button class="btn btn-info" type="<?php echo $obj->mo;?>" name="modificar1" value="<?php echo _("Guardar Pago");?>" onclick="verificar('guardar','pagos')"><i class="glyphicon glyphicon-ok"></i>Guardar Pago</button>
			<?php }?>
			
			<button class="btn btn-success" type="button" name="salir" onclick="conexionPHP('formulario.php','pagos')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			
			<input  type="hidden" name="anular1" value="<?php echo _("ANULAR PAGO");?>" onclick="verificar('anularfactura','anularfactura')">
			<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','pagos')">
			<input  type="hidden" name="registrar">
			<input  type="hidden" name="modificar">
			
			
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->		

</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->
<?php 
}
}
?>

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