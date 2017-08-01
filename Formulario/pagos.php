<?php require_once "../procesos.php";
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" and  id_franq='$id_f'";
	}
	else{
		$consult=" and  id_franq='1'";
	}
		
$ini_u = $_SESSION["ini_u"];
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PAGOS')))
{
//echo ":$obj->in:";
//echo "$obj->mo:";
$fecha= date("Y-m-d");


	$id_persona=$_SESSION["id_persona"];
/*
	$ip_est = $_SERVER['REMOTE_ADDR'];
	$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
	if($row=row($acceso)){
		$id_est=trim($row['id_est']);
		$nombre_est=trim($row['nombre_est']);
	}
	*/
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha'  and status_caja_cob='ABIERTA'");
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
	$id_est=trim($row['id_est']);
	
	$tipo_caja=trim($row['tipo_caja']);
	$caja_externa=trim($row['caja_externa']);

	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");

	$acceso->objeto->ejecutarSql("delete from detalle_tipopago_temp where id_pago='$id_pago'"); 

	$acceso->objeto->ejecutarSql("select id_tp from detalle_tipopago_temp  where (id_tp ILIKE '$ini_u%')  ORDER BY id_tp desc LIMIT 1 offset 0 "); 
	$id_tp= $ini_u.verCoo($acceso,"id_tp");
	/*
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
		*/
	
$acceso->objeto->ejecutarSql("select *from parametros where id_param='47' and id_franq='1'");
$row=row($acceso);
$pagao_efec_G=trim($row['valor_param']);
	
$acceso->objeto->ejecutarSql("select *from parametros where id_param='2' and id_franq='1'");
$row=row($acceso);
$IVA=trim($row['valor_param']);
	
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


$fecha_ant=restadia(date("Y-m-d"),15);

if($orden_factura_G=='UNICO'){
	if($tipo_caja=='PRINCIPAL'){
		$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'  and impresion='SI' and fecha_pago>='$fecha_ant' and tipo_caja='PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 ");
		$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
	}
	else{
		$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'  and impresion='SI' and fecha_pago>='$fecha_ant' and tipo_caja<>'PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
		$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
	}
}
else if($orden_factura_G=='POR ESTACION'){
	$fecha_ant=restadia(date("Y-m-d"),5);
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'   and fecha_pago>='$fecha_ant' and impresion='SI' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
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

	}
	
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='3'"); 
	if($row=row($acceso)){
		$valor_param_v=trim($row['valor_param']);
	}
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head">
		<h3 id="titulo-pagos">MODULO DE COBRANZAS<button style="display:none" type="button" class="btn btn-info pull-right" id="mostrar_busqueda" onclick="ocultarmostrardiv('seccion_busqueda')"><i id="toggle-search" class="fa fa-search fa-1x pull-right"></i></button></h3>

	</div>
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel" id="seccion_busqueda">
			
		<header class="panel-heading">Búsqueda</header>
		
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			
				<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<label>Nº de Abonado</label>
					<div class="input-group">
					<input data-parsley-id="nombre_paq" required=""  class="form-control" type="text" name="nro_contrato" id="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="">
					<div class="input-group-btn">
						<button type="button" class="btn btn-info" id="buscar_abonado" onclick=""><i class="fa fa-search"></i></button>	
					</div>
					</div>
					<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>
				</div>												
				<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<label>RIF/Cédula</label>
					<div class="input-group">				
					<input class="form-control" type="text" name="cedula_b" id="cedula_b" maxlength="10" size="15" value="" onChange="buscar_cedula_contrato()">
					<div class="input-group-btn">
						<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick=""><i class="fa fa-search"></i></button>	
					</div>
					</div>
				</div>
				<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<label>Precinto</label>
					<div class="input-group">				
					<input class="form-control" type="text" name="precinto_b" id="precinto_b" maxlength="10" size="15" value="" onChange="buscar_precinto_contrato()">
					<div class="input-group-btn">
						<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick=""><i class="fa fa-search"></i></button>	
					</div>
					</div>
				</div>
				<!--BOTÓN-->
				<div class="form-group area-btn-agregar col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<button type="button" class="btn btn-info btn-txt" id="busqueda_avanzada" name="busqueda_avanzada" onclick="ajaxVentana('Abonados', this.id);" >
					<i class="fa fa-search"></i> Búsqueda Avanzada
					</button>
				</div>
			
			
			</div>
			
		</div> <!-- FIN DEL PANEL BODY-->

	</section>
	
	</div>
	
	<div id="pagos" style="display:none"> <!-- DIV QUE OCULTA EL CONTENIDO ANTES DE LA BÚSQUEDA -->
	
		<input type="hidden" name="id_pago" id="id_pago" value="<?php echo $id_pago;?>">
		<input type="hidden" name="obser_pago" id="obser_pago" value="PAGO POR OFICINA">
		<input type="hidden" name="id_caja_cob" id="id_caja_cob" value="<?php echo $id_caja_cob;?>">
		<input type="hidden" name="id_contrato" id="id_contrato" value="">
		<input type="hidden" name="impresion" id="impresion" value="SI">
		<input type="hidden" name="por_iva" id="por_iva" value="<?php echo $IVA;?>">
		<input type="hidden" name="desc_pago" id="desc_pago" value="<?php echo $IVA;?>">
		
	
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- DIV QUE DIVIDE LA MITAD DE LA IZQUIERDA AL CENTRO-->
		
			<section class="panel">
			
				<header class="panel-heading">
					Datos del Abonado<i class="fa fa-pencil-square-o fa-2x pull-right text-inverse actualizar" title="Actualizar Datos" id="add_asignar_orden" name="actualizar_d" id="actualizar_d" onclick="llamar_actualizar_datos_pagos()"></i><i class="fa fa-files-o fa-2x pull-right text-inverse actualizar" title="Generar Ordenes de Servicios" id="add_asignar_orden" name="crear_orden" id="crear_orden" onclick="cargar_form_ordenes_tecnicos()"></i>
				</header>
				
				<div class="panel-body">
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">		

						<div id="abonado"><label>N° Abonado: </label><label class="border-head"><h4> </h4></label></div >							

						</div>		

						<div class="col-lg-8 col-md-8 col-sm-4 col-xs-12">

						<div id="status" class="pull-right"><label>Status: </label><label class="border-head"><h4> </h4></label></div >							
						</div>			 										 
													
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div id="ced"><label>C.I/RIF: </label > <label class="border-head"><h4> </h4></label></div >

						</div>						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

							<div id="cliente"><label>CLIENTE: </label > <label class="border-head"><h4> </h4></label></div >
							
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div id="tel"><label>TELFONOS: </label > <label class="border-head"><h4> </h4></label></div >

						</div>			 										 
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div id="direccion"><label>DIRECCION: </label > <label class="border-head"><h4> </h4></label></div >			
										
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div id="referencia"><label>REFERENCIA: </label > <label class="border-head"><h4> </h4></label></div >			
										
						</div>
					
					
					</div>
					
				</div> <!-- FIN DEL PANEL BODY-->
				
			</section>
			
			<section class="panel">	
			
				<header class="panel-heading">Datos del Pago</header>
				
				<div class="panel-body">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				
					<div class="form-group col-lg-4 col-md-4 col-sm-4- col-xs-12">
						<label>Nº de Factura</label>
						<input disabled data-parsley-id="nombre_paq" required="" class="form-control" <?php if($valor_param_v=='1'){ echo "readonly";}?> type="text" name="nro_factura" id="nro_factura" onChange="validarpagosfact()" maxlength="10" size="20" value="<?php echo $nro_factura; ?>" >										
						<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Nº de Control</label>
					<input disabled data-parsley-id="nombre_paq" required="" class="form-control"   type="text" name="nro_control" id="nro_control" <?php if($control_recibo_G=='1'){ echo 'onChange="valida_nro_control()" ';} ?>  maxlength="8" size="20" value="<?php  echo $nro_control; ?>" > 
					<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>
					</div>	
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Fecha Factura</label>
					<input data-parsley-id="nombre_paq" required="" class="form-control" disabled type="text" name="fecha_factura" id="fecha_factura" id="fecha_factura" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
					<ul id="parsley-id-nombre_paq" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Forma de Pago</label>

						<select class="form-control" name="id_tipo_pago" id="id_tipo_pago" onchange="traerBanco()">
							<?php echo verTipoPago($acceso);?>
						</select>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Entidad</label >

					<select class="form-control" <?php echo $pagao_efec_G;?> name="id_banco" id="id_banco" onchange="">
						<?php echo verBanco_n($acceso);?>
					</select>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">				
					<label>Monto</label>
					<input class="form-control" type="text" name="monto_tp" id="monto_tp" maxlength="10" size="15" value="0" >
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">				
					<label>Referencia</label>
					<input class="form-control" <?php echo $pagao_efec_G;?> type="text" name="refer_tp" id="refer_tp" maxlength="25" size="15" value="" onchange="">
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Lote</label>
					<input class="form-control" <?php echo $pagao_efec_G;?> type="text" name="lote_tp" id="lote_tp" maxlength="25" size="15" value="" onchange="">
					</div>
					<div class="form-group">
					<label><i class="fa fa-edit label-blanco"></i></label>
					<div class="form-btn col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left">
									
					<button type="button" class="btn btn-info" id="agregar_tp" name="agregar_tp" onclick="gestion_detalle_tipopago_temp('incluir','detalle_tipopago_temp');" >
					<i class="fa fa-plus"></i>

					</button>
					</div>
					</div>
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="datagrid_forma_pago" >
						<input  type="hidden" value="0" name="total_fp" id="total_fp">
						<input class="form-control" type="hidden" name="id_tp" id="id_tp" maxlength="15" size="20"onChange="" value="<?php echo $id_tp;?>">
					</div>
					</div>
				
				</div>
					
				</div> <!-- FIN DEL PANEL BODY-->
				
			</section>
				
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- DIV QUE DIVIDE LA MITAD DEL CENTRO HACIA LA DERECHA -->
		
			<section class="panel">
			
				<header class="panel-heading">
					Cargos pendientes<i class="fa fa-plus-square fa-2x text-danger pull-right actualizar" title="Cargar Deuda" id="add_cargar_deuda" name="cargar_duda" onclick="llamar_cargar_deuda_pagos()"></i>					
					<span class="badge bg-success pull-right actualizarn" title="Solicitar Nota Debito" id="add_cargar_notadebito" name="cargar_notadebito" onclick="llamar_cargar_nota_debito()" style="margin-right:1em;margin-left:0.2em"><strong>ND</strong></span>
					<span class="badge bg-important pull-right actualizarn" title="Solicitar Nota Credito" id="add_cargar_notacredito" name="cargar_notacredito" onclick="llamar_cargar_nota_credito()"><strong>NC</strong></span>
				</header>	
				<div class="panel-body">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="input-group">
							<span id="saldo" class="input-group-addon">SALDO</span>
							<input class="form-control" style="#000000; font-weight:blod; font-size:16; "  readonly type="text" name="saldo1" id="saldo1" maxlength="10" size="10" value="0.00" onChange="">
						</div>
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="input-group">
							<span id="saldo" class="input-group-addon">TOTAL A PAGAR</span>
							<input data-parsley-id="monto_pago" required=""  data-parsley-type="number" class="form-control" type="text" name="monto_pago" id="monto_pago" maxlength="10" size="20" value="0" onchange="adaptar_cargos();" style="color:blue; font-weight:blod;" >
							<ul id="parsley-id-monto_pago" class="parsley-errors-list"></ul>
							
						</div>
					</div>
					<div  style="	height: 280px;  overflow: auto; " class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div id="datagrid" class="data">
						
						</div>
						
						<input  type="hidden" name="total_reg_data" id="total_reg_data" value="0">
						<input  type="hidden" name="deuda_total" id="deuda_total" value="0">
						<input  type="hidden" name="desc_pago" id="desc_pago" value="FALSE">
						
					</div>
					
					<br>
					
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
						<?php if($obj->in=="button"){?>
							<button class="btn btn-info" type="<?php echo $obj->in;?>" name="imprimir" id="imprimir" value="<?php echo _("imprimir Pago");?>" onclick="gestionar_pagos('incluir','pagos','SI')"><i class="glyphicon glyphicon-ok"></i> Imprimir</button>
						<?php }?>
						<?php /*if($obj->mo=="button"){?>
							<button class="btn btn-info" type="<?php echo $obj->mo;?>" name="guardar" id="guardar" value="<?php echo _("Guardar Pago");?>" onclick="gestionar_pagos('incluir','pagos','NO')"><i class="glyphicon glyphicon-ok"></i>Guardar </button>
						<?php }   */?>

							<button class="btn btn-success" type="button" name="salir" id="salir" onclick="cargar_form_pagos()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
					</div>
					
					
					</div>
					
				</div> <!-- FIN DEL PANEL BODY-->
				
			</section>
				
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <!-- DIV QUE MUESTRA LA PARTE INFERIOR DE LAS PESTAÑAS Y OTRA INFO -->
		
			<section class="panel">
				
				<div class="panel-body">
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
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
							
							<li class="">
								<a data-toggle="pill" href="#tab-historial_boxi" onclick="mostrarHistorial_pago_boxi()"><i class="fa fa-money"></i> Historial Cuenta</a>
							</li>
						</ul>
						<!--/header-->
						<!--contenido de las pestañas-->
						<div class="panel-body">
							<div class="tab-content">
								
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
								<div id="tab-historial_boxi" class="tab-pane fade">
									<div id="historial_boxi"></div>
								</div>
							</div>
						</div>

					
					</div>
					
				</div> <!-- FIN DEL PANEL BODY-->
				
			</section>
				
		</div>
	
	
	</div><!-- FIN DEL DIV QUE OCULTA EL CONTENIDO ANTES DE LA BÚSQUEDA -->
	
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

<?php 
//}
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