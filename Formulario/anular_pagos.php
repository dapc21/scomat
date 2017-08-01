<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('anular_pagos')))
{

$fecha= date("Y-m-d");
$id_persona=$_SESSION["id_persona"];
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");

	$row=row($acceso);
	$id_caja_cob=trim($row['id_caja_cob']);
	$id_est=trim($row['id_est']);
	$nombre=trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"]);
	/*
	$ip_est = $_SERVER['REMOTE_ADDR'];
	$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
	if($row=row($acceso)){
		$id_est=trim($row['id_est']);
	}
	*/
	
	
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

	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago='PAGADO'  and impresion='SI' and fecha_pago>='$fecha_ant' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
}
else if($orden_factura_G=='POR ESTACION'){
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago='PAGADO'   and fecha_pago>='$fecha_ant' and impresion='SI' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
	//echo "<br>dig:$dig_fact_G:";
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
//	echo "<br>$nro_factura:";
}
else if($orden_factura_G=='POR CAJA'){
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago='PAGADO'  and impresion='SI' ORDER BY inc desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
}
else {
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'  and impresion='SI' ORDER BY inc desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
}
	

if($orden_control_G=='UNICO'){
	$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador where  pagos.id_caja_cob=caja_cobrador.id_caja_cob   and impresion='SI'  and fecha_pago>='$fecha_ant' ORDER BY nro_control desc LIMIT 1 offset 0");
	$nro_control = verNumero_control_v4($acceso,"nro_control",$dig_control_G);
}
else if($orden_control_G=='POR ESTACION'){
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
	

	
	
	
	$acceso->objeto->ejecutarSql("select n_credito,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago='ANULADO' ORDER BY inc desc LIMIT 1 offset 0 "); 
	$n_credito = verCodFact($acceso,"n_credito");
	
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_anular_pagos" >
	
	<div class="border-head"><h3>Anular pagos</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Factura</header>
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<label>Nº Factura</label>
			<div class="input-group">
			<input class="form-control" type="text" name="nro_factura" onChange="c_nro_factura();" maxlength="12" size="20" value="" >
			<div class="input-group-btn">
				<button type="button" class="btn btn-info" id="buscar_abonado" onclick="c_nro_factura();"><i class="fa fa-search"></i></button>	
			</div>
			</div>
			</div>
			
			</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	
	<div id="result"></div>
	
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Pago</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>ID del Pago</label>
			<input class="form-control" type="text" name="id_pago" maxlength="15" size="10"onChange="validarpagos_anular_id();" value="">
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Nota de Crédito</label>
			<input class="form-control" type="text" name="n_credito" onChange="" maxlength="10" size="15" value="<?php echo $n_credito;?>" >
			</div>

			<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
			<label>Punto de Cobro</label>
			<select class="form-control" name="id_caja_cob" id="id_caja_cob" onchange="">
			<?php echo verPuntoC($acceso);?>
			</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Fecha</label>
			<input class="form-control" type="text" name="fecha_pago" id="fecha_pago" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Hora</label>
			<input class="form-control" type="text" name="hora_pago" maxlength="8" size="15" value="<?php echo date("H:i:s");?>" >
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Forma de Pago</label>
			<select class="form-control" name="id_tipo_pago" id="id_tipo_pago" onchange="cargarDetTipoPago();">
			<?php echo verTipoPago($acceso);?>
			</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Banco</label>
			<select class="form-control" name="banco" id="banco"  onchange="">
			<?php echo verBanco($acceso);?>
			</select>
			</div>

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Número</label>
			<input class="form-control" type="text" name="numero" maxlength="25" size="15" value="" readonly>
			<input class="form-control" type="hidden" value="" name="obser_detalle">
			</div>

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Monto del Pago</label>
			<input class="form-control" type="text" name="monto_pago" maxlength="10" size="15" value="0" readonly>
			</div>

			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label>Observación</label>
			<textarea class="form-control" name="obser_pago" cols="1" rows="2" readonly></textarea>
			</div>
			
			<input  type="hidden" value="dato" name="dato">
			<input  type="hidden" value="" name="id_zona">
			<input  type="hidden" value="" name="id_sector">
			<input  type="hidden" value="" name="id_calle">
			
		</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Abonado</header>
		
		<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<label>Nº de Abonado</label>
				<input readonly class="form-control" type="text" name="nro_contrato" onChange="validarcontrato();" maxlength="11" size="12" value="" >
			</div>
			
			<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<label>RIF/Cédula</label>
				<input readonly class="form-control" type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula();">
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Nombre(s)</label >
				<input readonly class="form-control" type="text" name="nombre" maxlength="30" value="" >
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Apellido(s)</label >
				<input readonly class="form-control" type="text" name="apellido" maxlength="30" value="" >
			</div>
			
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Celular (Móvil)</label >
				<input readonly class="form-control" type="text" name="telefono" maxlength="11" value="" >
			</div>
			
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Fecha del Contrato</label>
				<input readonly class="form-control" type="text" name="fecha_contrato" id="fecha_contrato" maxlength="10" size="15" value="" >
			</div>

			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Precinto</label>
				<input readonly class="form-control" type="text" name="etiqueta" maxlength="15" size="15" value="" >
			</div>

			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Estatus</label>
				<input class="form-control" readonly type="text" name="status_contrato" maxlength="15" size="15" value="" >
			</div>
			<input type="hidden" name="status_pago" maxlength="15" size="15" value="PAGADO" >
		</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>

	<input disabled  type="hidden" name="total" maxlength="8" size="20" value="0" >
	<input disabled  type="hidden" name="desc"  maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="base_imp" maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="monto_iva" maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="monto_islr" maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="porc_reten" maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="monto_reten" maxlength="10" size="20" value="0" >
	<input  type="hidden" name="id_cont_serv" maxlength="12" size="15"onChange="validarcontrato_servicio()" value="<?php $acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); echo $ini_u.verCodLong($acceso,"id_cont_serv")?>">
	<input  type="hidden" name="fecha_inst" id="fecha_inst" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
	<input  type="hidden" name="cant_serv" maxlength="2" size="15" value="1" >
	
	<div id="datagrid" class="data">
		<input  type="hidden" name="total_reg_data" value="0">
	</div>

	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<input class="btn btn-danger" readonly type="hidden" name="registrar" value="<?php echo _("anular factura");?>" onclick="verificar('anular','pagos')">
			<button class="btn btn-warning" type="<?php echo $obj->mo; ?>" name="modificar" value="<?php echo _("anular pago");?>" onclick="verificar('anular_pago','anular_solo_pagos')"><i class="fa fa-trash-o"></i> Anular Pago</button>
			 <!--
			<button class="btn btn-warning" type="hidden" name="modificar" value="<?php echo _("anular pago");?>" onclick="verificar('anular','anular_pagos')"><i class="fa fa-trash-o"></i> Anular Pago</button>
			--> 
			<button class="btn btn-danger" type="<?php echo $obj->el; ?>" name="eliminar" value="<?php echo _("eliminar pago");?>" onclick="verificar('eliminar','anular_pagos')"><i class="fa fa-trash-o"></i> Eliminar Pago</button>
			<button class="btn btn-success" type="button" name="salir" onclick="conexionPHP('formulario.php','anular_pagos')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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