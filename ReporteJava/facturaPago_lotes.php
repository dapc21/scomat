<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

//$cadena=$_POST['d'];
//$valor=explode("=@",$cadena);

$id_contrato_serv=$_GET['id_contrato_serv'];

//$clase=$valor[0];

$nro_fact=$_GET['nro_fact'];
$conti=$_GET['i'];

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
	function Cuerpo($acceso,$id_cont,$nro_fact,$conti)
	{
		$this->fuente='arial';
		$this->tipo='may';
		
		$valor=explode("=@",$id_cont);
		$clase=$valor[0];
		

		$num=count($valor)-1;
		$d=true;
		for($k=1;$k<count($valor);$k++){
			$id_contrato_serv=trim($valor[$k]);
		//	echo "<<:$id_contrato_serv:";
			if($d==true){
				$this->AddPage();
				$x1	=20;
				$x2	=140;
				$y1	=300;
				$y2	=440;
				$inter=11;
				$alto=$inter+80;
				$d=false;
				
			}
			else{
				$x1	=20;
				$x2	=140;
				$y1	=300;
				$y2	=440;
				$inter=11;
				$alto=$inter+417;
				$d=true;
				
			}


		/*$select="SELECT pagos.id_pago,pagos.fecha_pago, pagos.hora_pago,pagos.monto_pago,pagos.nro_factura, 
  contrato_servicio_pagado.id_contrato, contrato_servicio_pagado.fecha_inst, contrato_servicio_pagado.cant_serv, contrato_servicio_pagado.costo_cobro
  ,contrato.nro_contrato, vista_cliente.cedula AS cedulacli, vista_cliente.nombre AS nombrecli, vista_cliente.apellido AS apellidocli
  , vista_tarifa.nombre_servicio, vista_tarifa.tipo_costo 
   FROM pago_servicio, pagos, contrato_servicio_pagado, vista_tarifa, contrato, vista_cliente
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv and contrato_servicio_pagado.id_serv = vista_tarifa.id_serv AND contrato_servicio_pagado.id_contrato = contrato.id_contrato AND vista_tarifa.status_tarifa_ser = 'ACTIVO'::bpchar and contrato.cli_id_persona = vista_cliente.id_persona and pagos.id_pago='$id_pago'
ORDER BY pagos.fecha_pago, pagos.hora_pago;";
*/

		$select="SELECT * FROM vista_contratodeu WHERE  id_cont_serv='$id_contrato_serv';";
		$pago=lectura($acceso,$select);
		$id_contrato=trim($pago[0]['id_contrato']);
		$cont=lectura($acceso,"SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono,direc_adicional,etiqueta FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
		$t_pago=lectura($acceso,"SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		
		
	
			$id_franq='1';
			$id_contrato=trim($pago[0]['id_contrato']);
			/*$fecha=trim($pago[0]['fecha_pago']);
			$hora_pago=trim($pago[0]['hora_pago']);
			*/
			$fecha=date("Y/m/d");
			$hora_pago=date("H:i:s");
			
			$fechaN=explode("-",$fecha);
			//$fecha_pago= $fechaN[2].'/'.$fechaN[1].'/'.$fechaN[0];
			$fecha_pago= date("Y/m/d");
			
			
			$monto_pago=trim($pago[0]['monto_pago']);
			//$nro_factura=trim($pago[0]['nro_factura']);
			$nro_factura=$nro_fact;
			$cedulacli=trim($pago[0]['cedulacli']);
			$nombrecli=utf8_decode(trim($pago[0]['nombrecli'])." ".trim($pago[0]['apellidocli']));
			$nro_contrato=trim($pago[0]['nro_contrato']);
			$etiqueta=trim($cont[0]['etiqueta']);
		
		
//		$acceso->objeto->ejecutarSql("SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
		//if($row=row($acceso)){
			$nombre_zona=utf8_decode(trim($cont[0]['nombre_zona']));
			$nombre_sector=utf8_decode(trim($cont[0]['nombre_sector']));
			$nombre_calle=utf8_decode(trim($cont[0]['nombre_calle']));
			$numero_casa=utf8_decode(trim($cont[0]['numero_casa']));
			$telefono=utf8_decode(trim($cont[0]['telefono']));
			$direc_adicional=utf8_decode(trim($cont[0]['direc_adicional']));
		//}
		
//		echo "<br><br>SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago";
		$acceso->objeto->ejecutarSql("SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		//if($row=row($acceso)){
			//$tipo_pago=utf8_decode(trim($t_pago[0]['tipo_pago']));
			$tipo_pago="EFECTIVO";
			$banco=trim($t_pago[0]['banco']);
			$numero=trim($t_pago[0]['numero']);
		//}
		
		
		$this->SetFont('arial','',8);
		
		$this->add(strtoupper(_("datos del cliente")),65,$alto);				
		$this->add(strtoupper(_("datos del cliente")),360,$alto);
		$alto+=$inter;
		$this->add(strtoupper(_("contrato")).": $nro_contrato",$x1,$alto);
		$this->add(strtoupper(_("cedula")).": $cedulacli",$x2,$alto);
		
		$this->add(strtoupper(_("contrato")).": $nro_contrato",$y1,$alto);
		$this->add(strtoupper(_("cedula")).": $cedulacli",$y2,$alto);
		$alto+=$inter;
		$this->add(strtoupper(_("nombre")).": ". $nombrecli,$x1,$alto);
		$this->add(strtoupper(_("nombre")).": ". $nombrecli,$y1,$alto);
		
		
		
		$alto+=$inter;
		//$this->add("DIRECCIÓN:",$x1,$alto);
		$this->add(strtoupper(_("zona")).": ". $nombre_zona,$x1,$alto);
		$this->add(strtoupper(_("telf")).": $telefono",$x2,$alto);
		
		//$this->add("DIRECCIÓN: ",$y1,$alto);
		$this->add(strtoupper(_("zona")).": ". $nombre_zona,$y1,$alto);
		$this->add(strtoupper(_("telf")).": $telefono",$y2,$alto);
		$alto+=$inter;

		$this->add(strtoupper(_("sector")).": ". $nombre_sector,$x1,$alto);
		$this->add(strtoupper(_("nro casa / apto")).": $numero_casa",$x2,$alto);
		
		$this->add(strtoupper(_("sector")).": ". $nombre_sector,$y1,$alto);
		$this->add(strtoupper(_("nro casa / apto")).": $numero_casa",$y2,$alto);
		
		$alto+=$inter;
		$this->add(strtoupper(_("calle")).": ". $nombre_calle,$x1,$alto);
		$this->add(strtoupper(_("calle")).": ". $nombre_calle,$y1,$alto);
		
		$this->add(strtoupper(_("precinto")).": ". $etiqueta,$x2,$alto);
		$this->add(strtoupper(_("precinto")).": $etiqueta",$y2,$alto);
		
		$alto+=$inter;
		$this->add(strtoupper(_("ref")).": ". $direc_adicional,$x1,$alto);
		$this->add(strtoupper(_("ref")).": ". $direc_adicional,$y1,$alto);
		
		
		$alto+=$inter+5;
		$this->add(strtoupper(_("datos de la factura")),55,$alto);
		$this->add(strtoupper(_("datos de la factura")),350,$alto);
		$alto+=$inter+5;
		$this->add(strtoupper(_("factura control")).": $nro_fact                  Nro: $k / $num",$x1,$alto);
		$this->add(strtoupper(_("factura control")).": $nro_fact                  Nro: $k / $num",$y1,$alto);
		$alto+=$inter;
		$this->add(strtoupper(_("fecha")).": ". $fecha_pago,$x1,$alto);
		$this->add(strtoupper(_("hora")).": $hora_pago",$x2,$alto);
		
		$this->add(strtoupper(_("fecha")).": ". $fecha_pago,$y1,$alto);
		$this->add(strtoupper(_("hora")).": $hora_pago",$y2,$alto);
		$alto+=$inter;
		$this->add(strtoupper(_("forma de pago")).": ". $tipo_pago,$x1,$alto);
		$this->add(strtoupper(_("forma de pago")).": ". $tipo_pago,$y1,$alto);
		$alto+=$inter;
		$this->add(strtoupper(_("banco ")). $banco,$x1,$alto);
		$this->add(strtoupper(_("banco ")). $banco,$y1,$alto);
		$alto+=$inter;
		$this->add(strtoupper(_("nro")).": $numero",$x1,$alto);
		$this->add(strtoupper(_("nro")).": $numero",$y1,$alto);
		$alto+=$inter;
		$this->add(strtoupper(_("detalle")),$x1,$alto);
		$this->add(strtoupper(_("cant")),140,$alto);
		$this->add(strtoupper(_("monto")),170,$alto);
		$this->add(strtoupper(_("total")),210,$alto);
		
		$this->add(strtoupper(_("detalle")),$y1,$alto);
		$this->add(strtoupper(_("cant")),440,$alto);
		$this->add(strtoupper(_("monto")),460,$alto);
		$this->add(strtoupper(_("total")),500,$alto);
		$alto+=$inter-5;
		$this->add("---------------------------------------------------",$x1,$alto);
		$this->add("---------------------------------------------------",$y1,$alto);
		
		
		
		
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
			$mes=formato_mes_com($fechaN[1]);
			$anio=$fechaN[0];
			if($id_serv=='SER00001' || $id_serv=='BM00009' || $id_serv=='BM00008'){
				$nombre_servicio='MANT';
					
				$nombre_servicio=$mes." ".$anio." (".$nombre_servicio.")";
			}
			
			$cant_serv=trim($pago[$i]['cant_serv']);
			$costo_cobro=trim($pago[$i]['costo_cobro']);
			$total=$cant_serv*$costo_cobro;
			$suma=$suma+$total;
			$this->Ln();
			$this->SetX($x_izq);
			//$this->Cell($w[0],4,$nombre_servicio,"0",0,"J");
			//$this->Cell($w[1],4,$cant_serv,"0",0,"C");
			//$this->Cell($w[2],4,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
			//$this->Cell($w[3],4,number_format($total+0, 2, ',', '.'),"0",0,"R");
			$costo_cobro=number_format($costo_cobro+0, 2, ',', '.');
			$total=number_format($total+0, 2, ',', '.');
			
			$alto+=$inter;
			$this->add("$nombre_servicio",$x1,$alto);
			$this->add("$cant_serv",144,$alto);
			$this->add("$costo_cobro",170,$alto);
			$this->add("$total",210,$alto);
			
			$this->add("$nombre_servicio",$y1,$alto);
			$this->add("$cant_serv",444,$alto);
			$this->add("$costo_cobro",460,$alto);
			$this->add("$total",500,$alto);
			
			$xy=$xy+15;
		}
		
		
//		echo "<br><br>SELECT *FROM parametros where id_franq='$id_franq' and id_param='2'";
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_franq='$id_franq' and id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		$total_p=$suma;
		$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
		
		$this->Ln();
		$this->SetX($x_izq);
		//$this->Cell($ancho,1,'----------------------------------------------------------------------------------------------------',"0",0,"J");
		//$this->Cell($ancho,1,'-------------------------------------------------',"0",0,"J");
		
		$this->Ln();
		
		$this->SetX($x_izq+$w[0]+$w[1]);
		//$this->Cell($w[2],4,'BASE:',"0",0,"R");
		
		
		$this->SetX($x_izq+$w[0]+$w[1]+$w[2]);
		//$this->Cell($w[3],4,number_format($base+0, 2, ',', '.'),"0",0,"R");
		$base=number_format($base+0, 2, ',', '.');
		
		$this->Ln();
		
		$this->SetX($x_izq+$w[0]+$w[1]);
		//$this->Cell($w[2],4,'IVA('.number_format($por_iva, 1, ',', '.').'%):',"0",0,"R");
		$por_iva=number_format($por_iva, 0, '', '.');
		
		
		$this->SetX($x_izq+$w[0]+$w[1]+$w[2]);
	//	$this->Cell($w[3],4,number_format($iva+0, 2, ',', '.'),"0",0,"R");
		$iva=number_format($iva+0, 2, ',', '.');
		
		$this->Ln();
		
		$this->SetX($x_izq+$w[0]+$w[1]);
		//$this->Cell($w[2],4,'TOTAL:',"0",0,"R");
		
		
		$this->SetX($x_izq+$w[0]+$w[1]+$w[2]);
		//$this->Cell($w[3],4,number_format($total_p+0, 2, ',', '.'),"0",0,"R");
		$total_p=number_format($total_p+0, 2, ',', '.');

		

		
		$alto+=$inter-5;
		$this->add("---------------------------------------------------",$x1,$alto);
		$this->add("---------------------------------------------------",$y1,$alto);
		$xy=$xy+15;
		$alto+=$inter;
		$this->add(strtoupper(_("base")).":",140,$alto);
		$this->add("$base",210,$alto);
		
		$this->add(strtoupper(_("base")).":",440,$alto);
		$this->add("$base",500,$alto);
		$alto+=$inter;
		$xy=$xy+15;
		$this->add(strtoupper(_("iva"))." ($por_iva%):",140,$alto);
		$this->add("$iva",210,$alto);
		
		$this->add(strtoupper(_("iva"))." ($por_iva%):",440,$alto);
		$this->add("$iva",500,$alto);
		$alto+=$inter;
		$xy=$xy+15;
		$this->add(strtoupper(_("total")).":",140,$alto);
		$this->add("$total_p",210,$alto);
		
		$this->add(strtoupper(_("total")).":",440,$alto);
		$this->add("$total_p",500,$alto);
		
		
		
		
		
		
		
		
		
		
		
		$nro_fact++;
		}

		return $cad;
	}
	
}

//crea el objeto pdf
$pdf=new PDF("p","carta");



$pdf->Cuerpo($acceso,$id_contrato_serv,$nro_fact,$conti);

//$pdf->Cuerpo($acceso,$id_contrato_serv,$nro_fact,$conti);


$pdf->Output('reporte.pdf','D');

?> 
