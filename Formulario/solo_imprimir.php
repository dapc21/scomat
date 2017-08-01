<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PAGOS')) AND $obj->in=='button')
{



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
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");

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
	$nombre_est=trim($row['nombre_est']);
	
	
	$tipo_caja=trim($row['tipo_caja']);
	$caja_externa=trim($row['caja_externa']);
	$fecha_sugerida=date("d/m/Y", strtotime(trim($row['fecha_sugerida'])));
	$nombre_caja_cob=trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"])." => E.T. ".$nombre_est;
	
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	
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



//$fecha_ant=restadia(date("Y-m-d"),1);


$acceso->objeto->ejecutarSql("select *from parametros where id_param='56' and id_franq='1'");
$row=row($acceso);
$orden_control_G=trim($row['valor_param']);
//echo "select nro_factura,inc from pagos,caja_cobrador where  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO'  and impresion='SI' and fecha_pago>='$fecha_ant' ORDER BY nro_factura desc LIMIT 1 offset 0 ";
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



?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="banco" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>imprimir facturas pendientes</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Punto de Cobro</header>
			<div class="panel-body">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Nº de abonado</label>
				<input class="form-control" disabled type="text" name="nro_contrato" onChange="" maxlength="10" size="20" value="" >
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">				
				<label>cedula /Rif</label>
				<input class="form-control"  disabled type="text" name="cedula"  maxlength="8" size="20" value="" > 
			</div>
			
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">				
				<label>cliente</label>
				<input class="form-control"  disabled  type="text" name="cliente"  maxlength="8" size="20" value="" > 
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">				
				<label>Punto de Cobro</label>
				<select class="form-control" disabled name="id_caja_cob" id="id_caja_cob" onchange="validarcaja_cobrador()">
					<?php echo '<option value="'.$id_caja_cob.'">'.$nombre_caja_cob.'</option>';?>
				</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Nº de Factura</label>
				<input class="form-control" <?php if($valor_param_v=='1'){ echo "readonly";}?> type="text" name="nro_factura" onChange="validarpagosfact()" maxlength="10" size="20" value="<?php echo $nro_factura; ?>" >
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">				
				<label>Nº de Control</label>
				<input class="form-control"   type="text" name="nro_control" <?php if($control_recibo_G=='1'){ echo 'onChange="valida_nro_control()" ';} ?>  maxlength="8" size="20" value="<?php  echo $nro_control; ?>" > 
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Fecha Factura</label>
				<input class="form-control" disabled type="text" name="fecha_factura" id="fecha_factura" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Total a pagar</label>
				<input class="form-control"  disabled type="text" name="monto_pago" maxlength="10" size="20" value="0" onchange="adaptar_cargos();" style="color:blue; font-weight:blod;" >
			</div>
				</div>
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>	

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="hidden" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="imprimir_factura_i()"><i class="glyphicon glyphicon-ok"></i> IMPRIMIR</button>		

				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','solo_imprimir')" value="<?php echo _("Actualizar");?>"><i class="glyphicon glyphicon-repeat"></i> Actualizar</button>
				
				<input class="form-control" type="hidden" value="" name="id_pago">
				<input class="form-control" type="hidden" value="dato" name="modificar">
				<input class="form-control" type="hidden" value="dato" name="eliminar">
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	
		
	<section class="panel" id="tabla-banco">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Facturas por Imprimir</header>
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
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>