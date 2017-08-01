<?php
session_start();
$respuesta = array();
if($_SESSION["autenticacion"]!="On"){
	//echo "SecurityFalse";
	$respuesta["success"] = false;
	$respuesta["error"] = "Intento de Violación de Seguridad, debe iniciar sesion.";
}
else{
	require_once("procesos.php");
	$clase=$_GET["clase"];

	if($clase=='c_nro_factura_nc'){
		$nro_factura=$_GET["nro_factura"];
		$cedula_b=$_GET["cedula_b"];
		$nro_contrato=$_GET["nro_contrato"];

		if($nro_factura!=''){
			$where="and pagos.nro_factura='$nro_factura'";
		}
		else if($cedula_b!=''){
			$where="and persona.cedula='$cedula_b'";
		}
		else if($nro_contrato!=''){
			$where="and contrato.nro_contrato='$nro_contrato'";
		}
		else {
			$where="and pagos.nro_factura='$nro_factura'";
		}
		
		//echo "select n_credito,impresion,id_pago,pagos.nro_factura,pagos.nro_control ,nro_contrato,fecha_pago::date,nombre,apellido,monto_pago,status_pago from pagos,contrato,persona where pagos.id_contrato=contrato.id_contrato and contrato.cli_id_persona=persona.id_persona  and tipo_doc='FACTURA' $where limit 100";
		$acceso->objeto->ejecutarSql("select n_credito,impresion,id_pago,pagos.nro_factura,pagos.nro_control ,nro_contrato,fecha_pago::date,nombre,apellido,monto_pago,status_pago from pagos,contrato,persona where pagos.id_contrato=contrato.id_contrato and contrato.cli_id_persona=persona.id_persona  and tipo_doc='FACTURA' $where limit 100");
		$cad='';
		$cadena='';
		while($row=row($acceso)){
			$n_credito=trim($row["n_credito"]);
			if($n_credito!=''){
				$cad=$cad. "<tbody><tr style=\"cursor: pointer;\" onclick=\"alerta('Error esta Facturata ya posee Nota de Credito')\" ><td class=\"numeric\">".trim($row["id_pago"])."</td><td class=\"numeric\">".trim($row["nro_factura"])."</td><td class=\"numeric\">".trim($row["nro_control"])."</td><td class=\"numeric\">".trim($row["monto_pago"])."</td><td class=\"numeric\">".formatofecha(trim($row["fecha_pago"]))."</td><td>".trim($row["status_pago"])."</td><td class=\"numeric\">".trim($row["nro_contrato"])."</td><td>".trim($row["nombre"])."  ".trim($row["apellido"])."</td><td>".trim($row["impresion"])."</td></tr></tbody>";
			}
			else{
				$cad=$cad. "<tbody><tr style=\"cursor: pointer;\" onclick=\"traer_id_pago_nc('".trim($row["id_pago"])."','".trim($row["nro_factura"])."')\" ><td class=\"numeric\">".trim($row["id_pago"])."</td><td class=\"numeric\">".trim($row["nro_factura"])."</td><td class=\"numeric\">".trim($row["nro_control"])."</td><td class=\"numeric\">".trim($row["monto_pago"])."</td><td class=\"numeric\">".formatofecha(trim($row["fecha_pago"]))."</td><td>".trim($row["status_pago"])."</td><td class=\"numeric\">".trim($row["nro_contrato"])."</td><td>".trim($row["nombre"])."  ".trim($row["apellido"])."</td><td>".trim($row["impresion"])."</td></tr></tbody>";
			}
		}
	//	if($cad!=''){
		
			$cadena=$cadena. '
			<section class="panel">

				
			<header class="panel-heading">FACTURAS ENCONTRADAS</header>
				<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				';
					$cadena=$cadena. '<table class="table table-hovered table-condensed">';
					$cadena=$cadena. '<thead><tr class="titulo-tabla"><th class="numeric">ID PAGO</th><th class="numeric">FACTURA</th><th class="numeric">CONTROL</th><th class="numeric">MONTO</th><th class="numeric">FECHA FACTURA</th><th>ESTATUS FACTURA</th> <th class="numeric">Nº ABONADO</th> <th>CLIENTE</th><th>IMPRESION</th></thead>';
					$cadena=$cadena. $cad;
					$cadena=$cadena. '</table>';
			$cadena=$cadena. '
				</div>
				</div>
			</section>
			';
	//	}
		//echo "entro";
		echo $cadena;

	}
	else if($clase=='c_nro_factura_nd'){
		$nro_factura=$_GET["nro_factura"];
		$cedula_b=$_GET["cedula_b"];
		$nro_contrato=$_GET["nro_contrato"];

		if($nro_factura!=''){
			$where="and pagos.nro_factura='$nro_factura'";
		}
		else if($cedula_b!=''){
			$where="and persona.cedula='$cedula_b'";
		}
		else if($nro_contrato!=''){
			$where="and contrato.nro_contrato='$nro_contrato'";
		}
		else {
			$where="and pagos.nro_factura='$nro_factura'";
		}


		$acceso->objeto->ejecutarSql("select n_debito,impresion,id_pago,pagos.nro_factura,pagos.nro_control ,nro_contrato,fecha_pago::date,nombre,apellido,monto_pago,status_pago from pagos,contrato,persona where pagos.id_contrato=contrato.id_contrato and contrato.cli_id_persona=persona.id_persona and tipo_doc='FACTURA' $where ");
		$cad='';
		$cadena='';
		while($row=row($acceso)){
			
				$cad=$cad. "<tbody><tr style=\"cursor: pointer;\" onclick=\"traer_id_pago_nc('".trim($row["id_pago"])."','".trim($row["nro_factura"])."')\" ><td class=\"numeric\">".trim($row["id_pago"])."</td><td class=\"numeric\">".trim($row["nro_factura"])."</td><td class=\"numeric\">".trim($row["nro_control"])."</td><td class=\"numeric\">".trim($row["monto_pago"])."</td><td class=\"numeric\">".formatofecha(trim($row["fecha_pago"]))."</td><td>".trim($row["status_pago"])."</td><td class=\"numeric\">".trim($row["nro_contrato"])."</td><td>".trim($row["nombre"])."  ".trim($row["apellido"])."</td><td>".trim($row["impresion"])."</td></tr></tbody>";
		}
	//	if($cad!=''){
		
			$cadena=$cadena. '
			<section class="panel">

				
			<header class="panel-heading">FACTURAS ENCONTRADAS</header>
				<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				';
					$cadena=$cadena. '<table class="table table-hovered table-condensed">';
					$cadena=$cadena. '<thead><tr class="titulo-tabla"><th class="numeric">ID PAGO</th><th class="numeric">FACTURA</th><th class="numeric">CONTROL</th><th class="numeric">MONTO</th><th class="numeric">FECHA FACTURA</th><th>ESTATUS FACTURA</th> <th class="numeric">Nº ABONADO</th> <th>CLIENTE</th><th>IMPRESION</th></thead>';
					$cadena=$cadena. $cad;
					$cadena=$cadena. '</table>';
			$cadena=$cadena. '
				</div>
				</div>
			</section>
			';
	//	}
		//echo "entro";
		echo $cadena;

	}
	else if($clase=='traeinfoFactura_nc'){
		$id_pago=$_GET["id_pago"];
		$acceso->objeto->ejecutarSql("select id_contrato, nro_contrato, cedulacli, apellidocli, nro_factura, nro_control,fecha_pago::date , monto_pago from vista_pago_cont where id_pago='$id_pago' AND TIPO_DOC='FACTURA' LIMIT 1 offset 0 ");
	$cad='';
	if($row=row($acceso)){
		$id_contrato=trim($row["id_contrato"]);
		$nro_contrato=trim($row["nro_contrato"]);
		$cedula=trim($row["cedulacli"]);
		$cliente=trim($row["nombrecli"])." ".trim($row["apellidocli"]);
		$nro_factura=trim($row["nro_factura"]);
		$nro_control=trim($row["nro_control"]);
		$fecha_pago=formatofecha(trim($row["fecha_pago"]));
		$monto_pago=trim($row["monto_pago"])+0;
		
		
		echo '
		<section class="panel">

		<header class="panel-heading">Datos de la Factura Fiscal</header>
			<div class="panel-body">
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Nro Contrato</label>
					<input disabled type="hidden" name="id_contrato" id="id_contrato"  onChange="" value="'.$id_contrato.'">
					<input disabled class="form-control" type="text" name="nro_contrato" id="nro_contrato"  onChange="" value="'.$nro_contrato.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Cedula</label>
					<input disabled class="form-control" type="text" name="cedula" id="cedula"  onChange="" value="'.$cedula.'">
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>Cliente</label>
					<input disabled class="form-control" type="text" name="cliente" id="cliente"  onChange="" value="'.$cliente.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Nro Factura</label>
					<input disabled class="form-control" type="text" name="nro_facturaA" id="nro_facturaA"  onChange="" value="'.$nro_factura.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Nro Control</label>
					<input disabled class="form-control" type="text" name="nro_controlA" id="nro_controlA"  onChange="" value="'.$nro_control.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Fecha</label>
					<input disabled class="form-control" type="text" name="fecha_pago" id="fecha_pago"  onChange="" value="'.$fecha_pago.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Total</label>
					<input disabled class="form-control" type="text" name="monto_factura" id="monto_factura"  onChange="" value="'.$monto_pago.'">
				</div>
			</div>
	
		</section>
		';
		
		
		}
	}
	
}

?>