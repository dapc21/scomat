<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["$ini_u"]; 

//$cadena=$_POST['d'];
//$valor=explode("=@",$cadena);

$id_pago=$_GET['id_pago'];

class PDF extends JavaPrint
{
	public $fuente;
	public $tipo;
	
	function add($cad,$x,$y){
		$x=$x/2.54;
		$y=$y/2.54;
		$this->SetXY($x,$y);
		$this->Cell(100,5,$cad,0,0,"");
	}
	function Cuerpo($acceso,$id_pago)
	{
		$this->fuente='times';
		$this->tipo='may';
		
		
		$select="SELECT pagos.id_caja_cob,pagos.id_pago,pagos.fecha_pago, pagos.hora_pago,pagos.monto_pago,pagos.nro_factura, 
  contrato_servicio_pagado.id_contrato, contrato_servicio_pagado.fecha_inst, contrato_servicio_pagado.cant_serv, (contrato_servicio_pagado.costo_cobro - contrato_servicio_pagado.descu) as costo_cobro 
  ,contrato.nro_contrato, vista_cliente.cedula AS cedulacli, vista_cliente.nombre AS nombrecli, vista_cliente.apellido AS apellidocli, vista_cliente.inicial_doc AS inicial
  , vista_servicios.nombre_servicio, vista_servicios.tipo_costo 
   FROM pago_servicio, pagos, contrato_servicio_pagado, vista_servicios, contrato, vista_cliente
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv and contrato_servicio_pagado.id_serv = vista_servicios.id_serv AND contrato_servicio_pagado.id_contrato = contrato.id_contrato  and contrato.cli_id_persona = vista_cliente.id_persona and pagos.id_pago='$id_pago'
ORDER BY pagos.fecha_pago, pagos.hora_pago;";
		$pago=lectura($acceso,$select);
		$id_contrato=trim($pago[0]['id_contrato']);
		$cont=lectura($acceso,"SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono,direc_adicional,tipo_cliente,edificio,numero_piso FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
	
		$t_pago=lectura($acceso,"SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		
		
	
			$id_franq='1';
			$id_contrato=trim($pago[0]['id_contrato']);
			$fecha=trim($pago[0]['fecha_pago']);
			$hora_pago=trim($pago[0]['hora_pago']);
			$fechaN=explode("-",$fecha);
			$fecha_pago= $fechaN[2].'/'.$fechaN[1].'/'.$fechaN[0];
			
			
			$id_caja_cob=trim($pago[0]['id_caja_cob']);
			$monto_pago=trim($pago[0]['monto_pago']);
			$nro_factura=trim($pago[0]['nro_factura']);
			//$cedulacli=trim($pago[0]['cedulacli']);
			$cedulacli=utf8_decode(trim($pago[0]['inicial'])."-".trim($pago[0]['cedulacli']));
			$nombrecli=utf8_decode(trim($pago[0]['nombrecli'])." ".trim($pago[0]['apellidocli']));
			$inicial=trim($pago[0]['inicial']);
			$nro_contrato=trim($pago[0]['nro_contrato']);
		
//		$acceso->objeto->ejecutarSql("SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
		//if($row=row($acceso)){
			$nombre_zona=utf8_decode(trim($cont[0]['nombre_zona']));
			$nombre_sector=utf8_decode(trim($cont[0]['nombre_sector']));
			$nombre_calle=utf8_decode(trim($cont[0]['nombre_calle']));
			$numero_casa=utf8_decode(trim($cont[0]['numero_casa']));
			$telefono=utf8_decode(trim($cont[0]['telefono']));
			$direc_adicional=utf8_decode(trim($cont[0]['direc_adicional']));
			//$direc_adicional=utf8_decode(trim($nombre_zona).','.trim($nombre_sector).','.trim($nombre_calle));
			
			$tipo_cliente=utf8_decode(trim($cont[0]['tipo_cliente']));
			$edificio=utf8_decode(trim($cont[0]['edificio']));
			$numero_piso=utf8_decode(trim($cont[0]['numero_piso']));
		//}
		
//		echo "<br><br>SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago";
		$acceso->objeto->ejecutarSql("SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		//if($row=row($acceso)){
			$tipo_pago=utf8_decode(trim($t_pago[0]['tipo_pago']));
			$banco=trim($t_pago[0]['banco']);
			$numero=trim($t_pago[0]['numero']);
		//}
		$acceso->objeto->ejecutarSql("SELECT nombre_est,nombre,apellido FROM vista_caja where id_caja_cob='$id_caja_cob' ");
		if($row=row($acceso)){
			$cobrador=trim($row['nombre'])." ".trim($row['apellido']);
			$nombre_estacion=trim($row['nombre_est']);
		}
		
		$x1	=20;
		$x2	=140;
		$y1	=290;
		$y2	=440;
		$inter=10;
		$alto=$inter+60;
		
		$this->SetFont('times','',9);
		$this->add("FACTURA:$nro_factura",$x1,$alto);
		$this->add("FECHA:$fecha_pago",$x2,$alto);
		
		$this->add("FACTURA:$nro_factura",$y1,$alto);
		$this->add("FECHA:$fecha_pago",$y2,$alto);
		$alto+=$inter;
		
		
		//$this->add("DIRECCIÓN:",$x1,$alto);
		$this->SetFont('times','B',9);
		$this->add("CODIGO CLIENTE ",$x1,$alto);
		$this->add("CI/RIF",$x2,$alto);
		$this->add("CODIGO CLIENTE ",$y1,$alto);
		$this->add("CI/RIF",$y2,$alto);
		$alto+=$inter;
		//$this->add("DIRECCIÓN: ",$y1,$alto);
		$this->SetFont('times','',9);
		$this->add( $nro_contrato,$x1,$alto);
		$this->add("$cedulacli",$x2,$alto);
		
		$this->add( $nro_contrato,$y1,$alto);
		$this->add("$cedulacli",$y2,$alto);
		$alto+=$inter;
		
		$this->SetFont('times','B',9);
		$this->add("NOMBRE: ",$x1,$alto);
		$this->add("NOMBRE: ",$y1,$alto);
		
		$this->SetFont('times','',9);
		$alto+=$inter;
		$this->add($nombrecli,$x1,$alto);
		$this->add($nombrecli,$y1,$alto);
		
		
		$alto+=$inter;

		$this->add("TELF: ". $telefono,$x1,$alto);
		$this->add("NRO CASA/APTO: $numero_casa",$x2,$alto);
		
		
		$this->add("TELF: ". $telefono,$y1,$alto);
		$this->add("NRO CASA/APTO: $numero_casa",$y2,$alto);
		
		
		//$this->add("CALLE: ". $nombre_calle,$x1,$alto);
		//$this->add("CALLE: ". $nombre_calle,$y1,$alto);
		
		if($edificio!='' && $edificio!='0'){
			$alto+=$inter;
			
			$this->add("EDIF: ". $edificio,$x1,$alto);
			$this->add("NRO PISO: $numero_piso",$x2,$alto);
			
			$this->add("EDIF: ". $edificio,$y1,$alto);
			$this->add("NRO PISO: $numero_piso",$y2,$alto);
		}
		
		$alto+=$inter;
		$this->SetFont('times','B',9);
		$this->add("DIRECCION: ",$x1,$alto);
		$this->add("DIRECCION: ",$y1,$alto);
		
		$this->SetFont('times','',8);		
		
		$alto+=$inter;
		$caractn3=strlen($direc_adicional);
		//$nrfilas3=abs($caractn3 % 35);
		$nin3=0;
		$nfi3=35;
		//$alto+=$inter;
		if($caractn3>0 && $caractn3<=35){
			$this->add(substr($direc_adicional,0,35),$x1,$alto);
				$this->add(substr($direc_adicional,0,35),$y1,$alto);
				
				$alto+=$inter;
		
		}else if($caractn3>36 ){
				$this->add(substr($direc_adicional,0,40),$x1,$alto);
				$this->add(substr($direc_adicional,0,40),$y1,$alto);
				
				$alto+=$inter;
				$this->add(substr($direc_adicional,35,70),$x1,$alto);
				$this->add(substr($direc_adicional,35,70),$y1,$alto);
				
				$alto+=$inter;
		
		}else{
			$this->add(substr($direc_adicional,0,40),$x1,$alto);
				$this->add(substr($direc_adicional,0,40),$y1,$alto);
				
				$alto+=$inter;
		}
		
		/*
			else if($caractn3>71 ){
				$this->add(substr($direc_adicional,0,35),$x1,$alto);
				$this->add(substr($direc_adicional,0,35),$y1,$alto);
				
				$alto+=$inter;
				$this->add(substr($direc_adicional,35,70),$x1,$alto);
				$this->add(substr($direc_adicional,35,70),$y1,$alto);
				
				$alto+=$inter;
				$this->add(substr($direc_adicional,70,95),$x1,$alto);
				$this->add(substr($direc_adicional,70,95),$y1,$alto);
				
				$alto+=$inter;
		
		*/
		
		//if($caractn > 35){
			//$a=0;
			
			//for($a3=0;$a3<$nrfilas3;$a3++){
			/*while($a3<$nrfilas3){
				$this->add(substr($direc_adicional,$nin3,$nfi3),$x1,$alto);
				$this->add(substr($direc_adicional,$nin3,$nfi3),$y1,$alto);
				$nin3=$nfi3+1;
				$nfi3=$nfi3+35;
				$alto+=$inter;	
				$a3++;				
			}
			
		*/
		/*}else{
			$this->add("$direc_adicional",$x1,$alto);
			$this->add("$direc_adicional",$y1,$alto);
		}*/
		
		//$alto+=$inter;
		/*$this->add("FECHA: ". $fecha_pago,$x1,$alto);
		$this->add("HORA: $hora_pago",$x2,$alto);
		
		$this->add("FECHA: ". $fecha_pago,$y1,$alto);
		$this->add("HORA: $hora_pago",$y2,$alto);
		$alto+=$inter;*/
		$this->SetFont('times','B',9);
		$this->add("CAJERO: ". $nombre_estacion,$x1,$alto);
		/*$this->add("COB: $cobrador",$x2,$alto);*/
		$this->add("CAJERO: ". $nombre_estacion,$y1,$alto);
		/*$this->add("COB: $cobrador",$y2,$alto);*/
		$alto+=$inter;
		/*if($banco!=''){
			$this->add("BANCO". $banco,$x1,$alto);
			$this->add("BANCO". $banco,$y1,$alto);
			$alto+=$inter;
			$this->add("NRO: $numero",$x1,$alto);
			$this->add("NRO: $numero",$y1,$alto);
			$alto+=$inter;
		}*/
		$this->SetFont('times','B',8);
		$this->add("CONCEPTO Servicio de TV por cable",$x1,$alto);
		$this->add("CANT",140,$alto);
		$this->add("MONTO",170,$alto);
		$this->add("TOTAL",210,$alto);
		
		$this->add("CONCEPTO Servicio de TV por cable",$y1,$alto);
		$this->add("CANT",440,$alto);
		$this->add("MONTO",460,$alto);
		$this->add("TOTAL",500,$alto);
		$this->SetFont('times','',9);
		$alto+=$inter-5;
		/*
		$this->add("-----------------------------------------------------",$x1,$alto);
		$this->add("-------------------------------------------------------",$y1,$alto);
		*/
		$this->add("-----------------------------------------------------",$x1,$alto);
		$this->add("-------------------------------------------------------",$y1,$alto);
		
		$inter=9;
		
		//$acceso->objeto->ejecutarSql("SELECT nombre_servicio,tipo_costo,fecha_inst,cant_serv,costo_cobro FROM vista_pagoser where id_pago='$id_pago'");
//		echo "<br><br>".$select;
		//$acceso->objeto->ejecutarSql($select);
		
		$suma=0;
		//while($row=row($acceso)){
		$xy=260;
		for($i=0;$i<count($pago);$i++){
			$nombre_servicio=utf8_decode(trim($pago[$i]['nombre_servicio']));
			$id_serv=utf8_decode(trim($pago[$i]['id_serv']));
			$tipo_costo=trim($pago[$i]['tipo_costo']);
			$fecha=trim($pago[$i]['fecha_inst']);
			$fechaN=explode("-",$fecha);
			$mes=formato_mes($fechaN[1]);
			$anio=$fechaN[0];
		/*	if($id_serv=='SER00001' || $id_serv=='BM00009' || $id_serv=='BM00008'){
				$nombre_servicio='MANT';
					
				$nombre_servicio=$mes." ".$anio." (".$nombre_servicio.")";
			}
		*/
			if($tipo_costo=='COSTO MENSUAL'){
				/*
				if($nombre_servicio=='MESUALIDAD CABLE')
					$nombre_servicio='CA';
				else if($nombre_servicio=='PUNTOS ADICIONALES')
					$nombre_servicio='PA';
				*/
				$nombre_servicio="$nombre_servicio ($mes $anio)";
			}
			
			$cant_serv=trim($pago[$i]['cant_serv']);
			$costo_cobro=trim($pago[$i]['costo_cobro']);
			$total=$cant_serv*$costo_cobro;
			$suma=$suma+$total;
			$this->Ln();
			$this->SetX($x_izq);
			//$this->Cell($w[0],4,$nombre_servicio,"0",0,"J");
			//$this->Cell($w[1],4,$cant_serv,"0",0,"C");
			//$this->Cell($w[2],4,number_format($costo_cobro, 2, ',', '.'),"0",0,"R");
			//$this->Cell($w[3],4,number_format($total, 2, ',', '.'),"0",0,"R");
			$costo_cobro_bi=$costo_cobro/1.12;
			$total_bi=$total/1.12;
			$costo_cobro_bi=number_format($costo_cobro_bi, 2, ',', '.');
			$total_bi=number_format($total_bi, 2, ',', '.');
			
			$alto+=$inter;
			$this->add("$nombre_servicio",$x1,$alto);
			$this->add("$cant_serv",144,$alto);
			$this->add("$costo_cobro_bi",170,$alto);
			$this->add("$total_bi",210,$alto);
			
			$this->add("$nombre_servicio",$y1,$alto);
			$this->add("$cant_serv",444,$alto);
			$this->add("$costo_cobro_bi",460,$alto);
			$this->add("$total_bi",500,$alto);
			
			$xy=$xy+15;
		}
		$inter=10;
		
//		echo "<br><br>SELECT *FROM parametros where id_franq='$id_franq' and id_param='2'";
		$acceso->objeto->ejecutarSql("SELECT * FROM parametros where id_franq='$id_franq' and id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
		$total_p=$suma;
		$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
		
		if($tipo_cliente=='AGENTE RETENCION'){
			$ret=$iva*0.75;
			$total_p=$total_p-$ret;
			$ret=number_format($ret, 2, ',', '.');
		}
		
		
		$this->Ln();
		$this->SetX($x_izq);
		//$this->Cell($ancho,1,'----------------------------------------------------------------------------------------------------',"0",0,"J");
		//$this->Cell($ancho,1,'-------------------------------------------------',"0",0,"J");
		
		$this->Ln();
		
		$this->SetX($x_izq+$w[0]+$w[1]);
		//$this->Cell($w[2],4,'BASE:',"0",0,"R");
		
		
		$this->SetX($x_izq+$w[0]+$w[1]+$w[2]);
		//$this->Cell($w[3],4,number_format($base, 2, ',', '.'),"0",0,"R");
		$base=number_format($base, 2, ',', '.');
		
		$this->Ln();
		
		$this->SetX($x_izq+$w[0]+$w[1]);
		//$this->Cell($w[2],4,'IVA('.number_format($por_iva, 1, ',', '.').'%):',"0",0,"R");
		$por_iva=number_format($por_iva, 0, '', '.');
		
		
		$this->SetX($x_izq+$w[0]+$w[1]+$w[2]);
	//	$this->Cell($w[3],4,number_format($iva, 2, ',', '.'),"0",0,"R");
		$iva=number_format($iva, 2, ',', '.');
		
		$this->Ln();
		
		$this->SetX($x_izq+$w[0]+$w[1]);
		//$this->Cell($w[2],4,'TOTAL:',"0",0,"R");
		
		
		$this->SetX($x_izq+$w[0]+$w[1]+$w[2]);
		//$this->Cell($w[3],4,number_format($total_p, 2, ',', '.'),"0",0,"R");
		$total_p=number_format($total_p, 2, ',', '.');

		

		
		$alto+=$inter-5;
		$this->add("-----------------------------------------------------",$x1,$alto);
		$this->add("-------------------------------------------------------",$y1,$alto);
		$xy=$xy+15;
		$alto+=$inter;
		$alto+=$inter;
		$this->add("BASE:",140,$alto);
		$this->add("$base",210,$alto);
		
		$this->add("BASE:",440,$alto);
		$this->add("$base",500,$alto);
		$alto+=$inter;
		$xy=$xy+15;
		$this->add("IVA ($por_iva%):",140,$alto);
		$this->add("$iva",210,$alto);
		
		$this->add("IVA ($por_iva%):",440,$alto);
		$this->add("$iva",500,$alto);
		$alto+=$inter;
		$xy=$xy+15;
		
		if($tipo_cliente=='AGENTE RETENCION'){
		
			$this->add("RETENCION:",140,$alto);
			$this->add("$ret",210,$alto); 
		
			$this->add("RETENCION:",440,$alto);
			$this->add("$ret",500,$alto);
			$alto+=$inter;
			$xy=$xy+15;
		}
		
		$this->add("TOTAL:",140,$alto);
		$this->add("$total_p",210,$alto);
		
		$this->add("TOTAL:",440,$alto);
		$this->add("$total_p",500,$alto);
		
		$alto+=$inter;
		$alto+=$inter;
		$this->add("$hora_pago:",$x1,$alto);
		//$this->add("$total_p",210,$alto);
		
		$this->add("$hora_pago:",$y1,$alto);
		//$this->add("$total_p",500,$alto);
		
		return $cad;
	}
	
}

//crea el objeto pdf
$pdf=new PDF();
$pdf->AddPage("p","mediacarta");
//$pdf->AddPage();

$pdf->Cuerpo($acceso,$id_pago);
//$pdf->Cuerpo($acceso,"AD0000000002");

$pdf->Output('reporte.pdf','D');

?> 
