<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php";

		//	ECHO $bonificacion;
//$cadena=$_POST['d'];
//$valor=explode("=@",$cadena);

$id_pago=$_GET['id_pago'];

class PDF extends FPDF
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
		$this->fuente='arial';
		$this->tipo='may';
		
		
		
		$select="SELECT pagos.obser_pago,pagos.id_pago,pagos.fecha_pago, pagos.hora_pago,pagos.monto_pago,pagos.nro_factura, 
  contrato_servicio_pagado.id_contrato, contrato_servicio_pagado.fecha_inst, contrato_servicio_pagado.cant_serv, contrato_servicio_pagado.costo_cobro
  ,contrato.nro_contrato, vista_cliente.cedula AS cedulacli, vista_cliente.nombre AS nombrecli, vista_cliente.apellido AS apellidocli
  , vista_tarifa.nombre_servicio, vista_tarifa.tipo_costo 
   FROM pago_servicio, pagos, contrato_servicio_pagado, vista_tarifa, contrato, vista_cliente
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv and contrato_servicio_pagado.id_serv = vista_tarifa.id_serv AND contrato_servicio_pagado.id_contrato = contrato.id_contrato AND vista_tarifa.status_tarifa_ser = 'ACTIVO'::bpchar and contrato.cli_id_persona = vista_cliente.id_persona and pagos.id_pago='$id_pago'
ORDER BY pagos.fecha_pago, pagos.hora_pago;";
		//echo $select;
		$pago=lectura($acceso,$select);
		$id_contrato=trim($pago[0]['id_contrato']);
		$cont=lectura($acceso,"SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono,edificio,numero_piso,telf_casa,direc_adicional FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
	
		$t_pago=lectura($acceso,"SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		
		
	
			$id_franq='1';
			$id_contrato=trim($pago[0]['id_contrato']);
			$fecha=trim($pago[0]['fecha_pago']);
			$hora_pago=trim($pago[0]['hora_pago']);
			$obser_pago=trim($pago[0]['obser_pago']);
			$fechaN=explode("-",$fecha);
			$fecha_pago= $fechaN[2].'/'.$fechaN[1].'/'.$fechaN[0];
			
			
			$monto_pago=trim($pago[0]['monto_pago']);
			$nro_factura=trim($pago[0]['nro_factura']);
			$cedulacli=trim($pago[0]['cedulacli']);
			$nombrecli=utf8_decode(trim($pago[0]['nombrecli'])." ".trim($pago[0]['apellidocli']));
			$nro_contrato=trim($pago[0]['nro_contrato']);
		
		
//		$acceso->objeto->ejecutarSql("SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
		//if($row=row($acceso)){
			$nombre_zona=utf8_decode(trim($cont[0]['nombre_zona']));
			$nombre_sector=utf8_decode(trim($cont[0]['nombre_sector']));
			$nombre_calle=utf8_decode(trim($cont[0]['nombre_calle']));
			$numero_casa=utf8_decode(trim($cont[0]['numero_casa']));
			$direc_adicional=utf8_decode(trim($cont[0]['direc_adicional']));
			$telefono=utf8_decode(trim($cont[0]['telefono']));
			$telf_casa=utf8_decode(trim($cont[0]['telf_casa']));
			$numero_piso=utf8_decode(trim($cont[0]['numero_piso']));
			$edificio=utf8_decode(trim($cont[0]['edificio']));
		//}
		
//		echo "<br><br>SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago";
		$acceso->objeto->ejecutarSql("SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		//if($row=row($acceso)){
			$tipo_pago=utf8_decode(trim($t_pago[0]['tipo_pago']));
			$banco=trim($t_pago[0]['banco']);
			$numero=trim($t_pago[0]['numero']);
		//}
		
		$acceso->objeto->ejecutarSql("SELECT * FROM vista_fallecidos where id_contrato='$id_contrato' order by id_orden desc LIMIT 1 offset 0");
		if($row=row($acceso)){
			$nombre_falle=trim($row["nombre"])." ".trim($row["apellido"]);
			
		}
		
		
		
		for($j=0;$j<2;$j++){
			if($j==0){
				$alto_y=0;
			}
			else{
				$alto_y=135;
			}

		$this->Image('../imagenes/logo_pariatel.jpg',15,5+$alto_y,60);
		$this->SetFont('times','B',19);
		$this->SetXY(90,7+$alto_y);
		$this->Cell(100,5,"Ejemplo Empresa, C.A.",0,0,"C");
		$this->SetFont('arial','',9);
		$this->SetXY(90,13+$alto_y);
			$this->MultiCell(100,4,'Calle Bolivar cruce con calle Piar S/N sector Centro
Frente a la Casa Azul, municipio Sucre,
Cumana - Estado Sucre / Teléfono: (0294) 8465789
','0','C');

$this->SetXY(15,23+$alto_y);
$this->SetFont('arial','B',12);
//$this->MultiCell(75,4,'RIF: J-29706977-1','0','C');

		$this->SetFont('arial','B',10);
		$this->SetXY(15,29+$alto_y);
		$this->Cell(25,5,"RECIBO",1,0,"L");
		$this->SetTextColor(255,0,0);
		$this->SetFont('arial','',10);
		$this->Cell(35,5,"Nº  $nro_factura",1,0,"C");
		$this->SetTextColor(0,0,0);
		
		list($dia,$mes,$anio) = explode("/",$fecha_pago);
		
		$mes_letra=formato_mes_com($mes);
		$this->SetFont('arial','B',10);
		$this->Cell(35,5,"FECHA",1,0,"R");
		$this->SetFont('arial','',10);
		$this->Cell(80,5,"$dia de $mes_letra de $anio","1",0,"C");
		
		$this->SetFont('arial','B',15);
		$this->SetXY(15,36+$alto_y);
		$this->Cell(175,5,"RECIBO DE COBRO",0,0,"C");
		
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetFont('arial','B',14);
		$this->SetXY(15,43+$alto_y);
		$this->Cell(175,36,"",1,0,"C");
		
		$this->SetDrawColor(0,0,0);
		$this->SetFillColor(244,249,255);
		$this->SetLineWidth(.2);
		$this->SetXY(15,43+$alto_y);
		$this->SetFont('arial','BI',11);
		$this->Cell(175,5,"DATOS DEL CLIENTE",0,0,"C",1);
		
		$this->SetXY(17,50+$alto_y);
		$this->SetFont('arial','B',9);
		$this->Cell(47,4,"NOMBRE O RAZON SOCIAL:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(123,3,"$nombrecli","B",0,"L");
		
		$this->Ln(5);
		$this->SetX(17);
		$this->SetFont('arial','B',9);
		$this->Cell(25,4,"RIF / CEDULA:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(65,3,"$cedulacli","B",0,"L");
		
		$this->SetFont('arial','B',9);
		$this->Cell(25,4,"  CONTRATO:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(55,3,"$nro_contrato","B",0,"L");
		
		$this->Ln(5);
		$this->SetX(17);
		$this->SetFont('arial','B',9);
		$this->Cell(15,4,"ZONA:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(75,3,$nombre_zona,"B",0,"L");
		
		$this->SetFont('arial','B',9);
		$this->Cell(20,4,"  SECTOR:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(60,3,$nombre_sector,"B",0,"L");
		
		$this->Ln(5);
		$this->SetX(17);
		$this->SetFont('arial','B',9);
		$this->Cell(17,4,"CALLE:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(73,3,$nombre_calle,"B",0,"L");
		
		$this->SetFont('arial','B',9);
		$this->Cell(30,4,"  Nº CASA/APTO:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(50,3,$numero_casa,"B",0,"L");
		
	
		$this->Ln(5);
		$this->SetX(17);
		$this->SetFont('arial','B',9);
		$this->Cell(20,4,"CELULAR:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(70,3,$telefono,"B",0,"L");
		
		$this->SetFont('arial','B',9);
		$this->Cell(25,4,"  TELEFONO:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(55,3,$telf_casa,"B",0,"L");
		
		$this->Ln(5);
		$this->SetX(17);
		$this->SetFont('arial','B',9);
		$this->Cell(26,4,"REFERENCIA:",0,0,"L");
		$this->SetFont('arial','',9);
		$this->Cell(144,3,$direc_adicional,"B",0,"L");
		
		
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetFont('arial','B',14);
		$this->SetXY(15,81+$alto_y);
		$this->Cell(175,50,"",1,0,"C");
		
		$this->SetDrawColor(0,0,0);
		$this->SetFillColor(244,249,255);
		$this->SetLineWidth(.2);
		$this->SetXY(15,81+$alto_y);
		$this->SetFont('arial','BI',11);
		$this->Cell(175,5,"DATOS DE LOS SERVICIOS",0,0,"C",1);
		
		$this->Ln(8);
		
		
		$x1	=10;
		$x2	=140;
		$y1	=300;
		$y2	=440;
		$inter=11;
		$alto=$inter+400;
		
		//$this->Ln(5);
		$this->SetX(17);
		$this->SetFont('arial','B',9);
		$this->Cell(100,6,"DESCRIPCION",1,0,"J");
		$this->Cell(20,6,"CANT",1,0,"C");
		$this->Cell(20,6,"MONTO",1,0,"C");
		$this->Cell(30,6,"TOTAL",1,0,"C");
		
		
		
		
		//$acceso->objeto->ejecutarSql("SELECT nombre_servicio,tipo_costo,fecha_inst,cant_serv,costo_cobro FROM vista_pagoser where id_pago='$id_pago'");
//		echo "<br><br>".$select;
		//$acceso->objeto->ejecutarSql($select);
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_franq='$id_franq' and id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
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
			//ECHO ":$tipo_costo:";
			if($tipo_costo=='COSTO MENSUAL'){
				$nombre_servicio=$nombre_servicio." ($mes $anio)";
			}
			
			$cant_serv=trim($pago[$i]['cant_serv']);
			$costo_cobro=trim($pago[$i]['costo_cobro']);
			$total=$cant_serv*$costo_cobro;
			$suma=$suma+$total;
			
			
			$porc=($por_iva/100)+1;
			$costo_cobro=$costo_cobro/$porc;
			$total=$total/$porc;
			
			
			$this->Ln();
			$this->SetX($x_izq);
			$costo_cobro=number_format($costo_cobro+0, 2, ',', '.');
			$total=number_format($total+0, 2, ',', '.');
			
			$alto+=$inter;
			
			$this->SetX(17);
			$this->SetFont('arial','',9);
			$this->Cell(100,5,$nombre_servicio,1,0,"J");
			$this->Cell(20,5,$cant_serv,1,0,"C");
			$this->Cell(20,5,$costo_cobro,1,0,"R");
			$this->Cell(30,5,$total,1,0,"R");
			
			
			$xy=$xy+15;
		}
		$k=$i;
		$this->SetDrawColor(215,215,215);
		//echo ":$i:";
		for($i=$k;$i<4;$i++){
			$this->Ln();
			$this->SetX(17);
			$this->SetFont('arial','',9);
			$this->Cell(100,5,"- -","LRB",0,"C");
			$this->Cell(20,5,"- -","LRB",0,"C");
			$this->Cell(20,5,"- -","LRB",0,"C");
			$this->Cell(30,5,"- -","LRB",0,"C");
			
		}
		$this->SetDrawColor(0,0,0);
		
//		echo "<br><br>SELECT *FROM parametros where id_franq='$id_franq' and id_param='2'";
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
		$total_p=$suma;
		$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
		
		
		$base=number_format($base+0, 2, ',', '.');
		$por_iva=number_format($por_iva, 0, '', '.');
		$iva=number_format($iva+0, 2, ',', '.');
		
		
		$total_p=number_format($total_p+0, 2, ',', '.');

	
			$this->Ln();
			$this->SetX(117);
			$this->SetFont('arial','B',10);
			$this->Cell(40,5,"SUB-TOTAL",1,0,"R");
			$this->Cell(30,5,$base,1,0,"R");
		
			$this->Ln();
			$this->SetX(117);
			$this->SetFont('arial','B',10);
			$this->Cell(40,5,"IVA (12%)",1,0,"R");
			$this->Cell(30,5,$iva,1,0,"R");
		
			$this->Ln();
			$this->SetX(117);
			$this->SetFont('arial','B',10);
			$this->Cell(40,5,"TOTAL",1,0,"R");
			$this->Cell(30,5,$total_p,1,0,"R");
		
		
		}		
		return $cad;
	}
	
}

//crea el objeto pdf
$pdf=new PDF();
$pdf->AddPage('P','letter');
//$pdf->AddPage();
$pdf->SetAutoPageBreak(true,0);
$pdf->Cuerpo($acceso,$id_pago);

$pdf->Output('reporte.pdf','D');




?> 
