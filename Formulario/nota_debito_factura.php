<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('anular_pagos')))
{

$fecha= date("Y-m-d");
$id_persona=$_SESSION["id_persona"];
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");

	$row=row($acceso);
	$id_caja_cob=trim($row['id_caja_cob']);
	$nombre=trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"]);
	
	
	$acceso->objeto->ejecutarSql("select id_est from caja_cobrador where id_caja_cob='$id_caja_cob'");
	if($row=row($acceso)){
		$id_est=trim($row['id_est']);
	}
		
	
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


//$fecha_ant=restadia(date("Y-m-d"),5);

if($orden_factura_G=='UNICO'){

	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  pagos.id_caja_cob=caja_cobrador.id_caja_cob  and tipo_doc='NOTA DEBITO' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
}
else if($orden_factura_G=='POR ESTACION'){
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago='PAGADO'  and tipo_doc='NOTA DEBITO' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
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
	$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador where  pagos.id_caja_cob=caja_cobrador.id_caja_cob  and tipo_doc='NOTA DEBITO' ORDER BY nro_control desc LIMIT 1 offset 0");
	$nro_control = verNumero_control_v4($acceso,"nro_control",$dig_control_G);
}
else if($orden_control_G=='POR ESTACION'){
	$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob  and tipo_doc='NOTA DEBITO'  ORDER BY nro_control desc LIMIT 1 offset 0");
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

	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	
//	echo $id_pago;
	$acceso->objeto->ejecutarSql("select n_credito,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago='ANULADO' ORDER BY inc desc LIMIT 1 offset 0 "); 
	$n_credito = verCodFact($acceso,"n_credito");
	
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="f1" data-parsley-validate="">
	
	<div class="border-head"><h3>Solicitud de Nota de débito</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Factura</header>
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<label>Nº Factura</label>
				<div class="input-group">
				<input data-parsley-id="nro_factura_nc" required="" class="form-control" type="text" name="nro_factura_nc" id="nro_factura_nc" onChange="c_nro_factura_nd();" maxlength="12" size="20" value="" >

				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_abonado" onclick="c_nro_factura_nd();"><i class="fa fa-search"></i></button>	
				</div>
				</div>
				<ul id="parsley-id-nro_factura_nc" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<label>Nº de Abonado</label>
				<div class="input-group">
				<input data-parsley-id="nro_contrato" class="form-control" type="text" name="nro_contrato" id="nro_contrato" onChange="c_nro_factura_nd();" maxlength="11" size="12" value="">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_abonado" onclick="c_nro_factura_nd();"><i class="fa fa-search"></i></button>	
				</div>
				</div>
				<ul id="parsley-id-nro_contrato" class="parsley-errors-list"></ul>
			</div>												
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<label>RIF/Cédula</label>
				<div class="input-group">				
				<input class="form-control" type="text" name="cedula_b" id="cedula_b" maxlength="10" size="15" value="" onChange="c_nro_factura_nd();">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_rif_cedula" onclick="c_nro_factura_nd();"><i class="fa fa-search"></i></button>	
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
	<div id="result"></div>
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la nota de debito</header>
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<input class="form-control" type="hidden" name="id_pago" id="id_pago" maxlength="15" size="10"onChange="" value="<?php echo $id_pago;?>">
			<input class="form-control" type="hidden" name="id_pago_fac" id="id_pago_fac" maxlength="15" size="10"onChange="" value="">
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Nro Nota Crédito</label>
				<input data-parsley-id="nro_factura" required="" class="form-control" type="text" name="nro_factura" id="nro_factura" onChange="" maxlength="10" size="15" value="<?php echo $nro_factura;?>" >
				<ul id="parsley-id-nro_factura" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Nro Control</label>
				<input data-parsley-id="nro_control" required="" class="form-control" type="text" name="nro_control" id="nro_control" onChange="" maxlength="10" size="15" value="<?php echo $nro_control;?>" >
				<ul id="parsley-id-nro_control" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Total a Nota Debito</label>
				<input  data-parsley-id="monto_pago" required="" class="form-control" type="text" name="monto_pago" id="monto_pago" maxlength="10" size="20" value="0" onchange="adaptar_cargos_nd();" style="color:blue; font-weight:blod;" >
				<ul id="parsley-id-monto_pago" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Motivo</label>
				<select data-parsley-id="motivo" required="" class="form-control" name="motivo" id="motivo" onchange="" style="width: 250px;">
					<?php echo verMotivoNotas($acceso);?>
				</select>
				<ul id="parsley-id-motivo" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label>Observación</label>
			<textarea data-parsley-id="obser_pago" required="" class="form-control" name="obser_pago" id="obser_pago" cols="1" rows="1" ></textarea>
			<ul id="parsley-id-obser_pago" class="parsley-errors-list"></ul>
			</div>
			
			
		</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<div id="datagrid" class="data"></div>
		</div>

		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->

	<section class="panel">
	
		<div class="panel-body">
		<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			
			<button class="btn btn-warning" type="<?php echo $obj->mo; ?>" name="nota_debito" id="nota_debito" value="" onclick="gestionar_nota_debito('nota_debito_factura','pagos')"><i class="fa fa-trash-o"></i>realizar nota de debito</button>
			
			<button class="btn btn-success" type="button" name="salir" id="salir" onclick="cargar_form_nota_debito_factura();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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