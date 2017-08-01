<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

//$cadena=$_POST['d'];
//$valor=explode("=@",$cadena);

$id_contrato_serv=$_GET['id_contrato_serv'];
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
		


		$d=true;
		$num=count($valor)-1;
		for($k=1;$k<count($valor);$k++){
			$id_contrato_serv=trim($valor[$k]);
		//	echo "<<:$id_contrato_serv:";
			if($d==true){
				$this->AddPage();
				$this->SetXY(20,10);
				
				$x1	=20;
				$x2	=140;
				$y1	=300;
				$y2	=440;
				$inter=11;
				$alto=$inter+40;
				$d=false;
			}
			else{
				$this->SetXY(20,150);
				$x1	=20;
				$x2	=140;
				$y1	=300;
				$y2	=440;
				$inter=11;
				$alto=$inter+390;
				$d=true;
			}
		
	//	$this->SetXY(20,10);
		
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
		/*
		$x1	=20;
		$x2	=140;
		$y1	=300;
		$y2	=440;
		$inter=11;
		$alto=$inter+80;
		
		$this->SetFont('arial','',9);
		*/
		
		$this->SetFont('arial','',12);
		$this->SetX(20);
		$this->MultiCell(180,5,"SISTELVICOM, C.A.",'0','C');
		
		$this->SetFont('arial','',10);
		$this->SetX(20);
		$this->MultiCell(180,4,"CALLE 5 BIS CON CARRERA 12 NRO. 12-43 URB. JAUREGUI LA FRIA EDO. TACHIRA",'0','C');
		$this->SetX(20);
		$this->MultiCell(180,4,"TELF. 0277-5410238 RIF J-30844471-5 NIT 0211834234",'0','C');
		
		$this->SetFont('arial','',10);
		$this->SetX(10);
		$this->MultiCell(190,5,"---------------------------------------------------------------------------------------------------------------------------------------------------------------------",'0','L');
		$this->SetFont('arial','',14);
		$this->SetX(20);
		$this->MultiCell(180,6,"RECIBO DE COBRO",'0','C');
		
		$alto=$alto+40;
		/*
		$x1	=20;
		$x2	=140;
		$y1	=300;
		$y2	=440;
		$inter=11;
		$alto=$inter+80;
		*/
		$this->SetFont('arial','',8);
		
	$this->add("DATOS DEL CLIENTE",231,$alto);				
	//	$this->add("DATOS DEL CLIENTE",360,$alto);
		$alto+=$inter;
		$this->add("CONTRATO: $nro_contrato",$x1,$alto);
		$this->add("CEDULA: $cedulacli",$y1,$alto);
		
	//	$this->add("CONTRATO: $nro_contrato",$y1,$alto);
		//$this->add("CEDULA: $cedulacli",$y2,$alto);
		$alto+=$inter;
		$this->add("NOMBRE: ". $nombrecli,$x1,$alto);
	//	$this->add("NOMBRE: ". $nombrecli,$y1,$alto);
		//$alto+=$inter;
		//$this->add("DIRECCIÓN:",$x1,$alto);
	//	$this->add("TELF:$telefono",$x2,$alto);
		
	//	$this->add("DIRECCIÓN: ",$y1,$alto);
	///	$this->add("TELF:$telefono",$y2,$alto);
		$alto+=$inter;
		$this->add("ZONA: ". $nombre_zona,$x1,$alto);
	//	$this->add("ZONA: ". $nombre_zona,$y1,$alto);
		
		$this->add("SECTOR: ". $nombre_sector,$y1,$alto);
	//	$this->add("SECTOR: ". $nombre_sector,$y1,$alto);
		$alto+=$inter;
		$this->add("CALLE: ". $nombre_calle,$x1,$alto);
		$this->add("NRO CASA/EDIF.: $numero_casa         precinto:$etiqueta",$y1,$alto);

		
		$alto+=$inter;
		$this->add("EDIFICIO: ".$edificio,$x1,$alto);
		$this->add("NRO PISO: $numero_piso",$y1,$alto);
		
		$alto+=$inter;
		$this->add("REF.: ". $direc_adicional,$x1,$alto);
		$this->add("TELF:$telefono",$y1,$alto);
		
		
		$alto+=$inter;
		$this->add("----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",$x1,$alto);
		
	//	$this->add("CALLE: ". $nombre_calle,$y1,$alto);
		$alto+=$inter;
		$this->add("DATOS DEL RECIBO",225,$alto);
	//	$this->add("DATOS DE LA FACTURA",350,$alto);
		$alto+=$inter+5;
		$this->add("RECIBO DE COBRO NRO: $nro_fact                      Nro: $k / $num",$x1,$alto);
	//	$this->add("FACTURA CONTROL: $nro_factura",$y1,$alto);
		$alto+=$inter;
		$this->add("FECHA: ". $fecha_pago,$x1,$alto);
		$this->add("HORA: $hora_pago",$y1,$alto);
		
	//	$this->add("FECHA: ". $fecha_pago,$y1,$alto);
	//	$this->add("HORA: $hora_pago",$y2,$alto);
		$alto+=$inter;
		$this->add("FORMA DE PAGO: ". $tipo_pago,$x1,$alto);
	//	$this->add("FORMA DE PAGO: ". $tipo_pago,$y1,$alto);
		$alto+=$inter;
		$this->add("BANCO: ". $banco,$x1,$alto);
	//	$this->add("BANCO ". $banco,$y1,$alto);
	//	$alto+=$inter;
		$this->add("NRO: $numero",$y1,$alto);
	//	$this->add("NRO: $numero",$y1,$alto);
		$alto+=$inter;
		$this->add("DESCRIPCIÓN",$x1,$alto);
		$this->add("CANT",300,$alto);
		$this->add("MONTO",360,$alto);
		$this->add("TOTAL",430,$alto);
		
	/*	$this->add("DETALLE",$y1,$alto);
		$this->add("CANT",440,$alto);
		$this->add("MONTO",460,$alto);
		$this->add("TOTAL",500,$alto);
	*/	$alto+=$inter-5;
		$this->add("----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",$x1,$alto);
	//	$this->add("-------------------------------------------------------",$y1,$alto);
		
		
		
		
		//$acceso->objeto->ejecutarSql("SELECT nombre_servicio,tipo_costo,fecha_inst,cant_serv,costo_cobro FROM vista_pagoser where id_pago='$id_pago'");
//		echo "<br><br>".$select;
		//$acceso->objeto->ejecutarSql($select);
		$this->SetFont($this->fuente,'',8);
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
			$this->add("$cant_serv",304,$alto);
			$this->add("$costo_cobro",360,$alto);
			$this->add("$total",430,$alto);
			
		//	$this->add("$nombre_servicio",$y1,$alto);
		//	$this->add("$cant_serv",444,$alto);
		//	$this->add("$costo_cobro",460,$alto);
		//	$this->add("$total",500,$alto);
			
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
		$this->SetFont($this->fuente,'',9);
		$this->SetX($x_izq+$w[0]+$w[1]);
		//$this->Cell($w[2],4,'BASE:',"0",0,"R");
		
		$this->SetFont($this->fuente,'',9);
		$this->SetX($x_izq+$w[0]+$w[1]+$w[2]);
		//$this->Cell($w[3],4,number_format($base+0, 2, ',', '.'),"0",0,"R");
		$base=number_format($base+0, 2, ',', '.');
		
		$this->Ln();
		$this->SetFont($this->fuente,'',9);
		$this->SetX($x_izq+$w[0]+$w[1]);
		//$this->Cell($w[2],4,'IVA('.number_format($por_iva, 1, ',', '.').'%):',"0",0,"R");
		$por_iva=number_format($por_iva, 0, '', '.');
		
		$this->SetFont($this->fuente,'',9);
		$this->SetX($x_izq+$w[0]+$w[1]+$w[2]);
	//	$this->Cell($w[3],4,number_format($iva+0, 2, ',', '.'),"0",0,"R");
		$iva=number_format($iva+0, 2, ',', '.');
		
		$this->Ln();
		$this->SetFont($this->fuente,'',9);
		$this->SetX($x_izq+$w[0]+$w[1]);
		//$this->Cell($w[2],4,'TOTAL:',"0",0,"R");
		
		$this->SetFont($this->fuente,'',8);
		$this->SetX($x_izq+$w[0]+$w[1]+$w[2]);
		//$this->Cell($w[3],4,number_format($total_p+0, 2, ',', '.'),"0",0,"R");
		$total_p=number_format($total_p+0, 2, ',', '.');

		

		
		$alto+=$inter-5;
		$this->add("----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",$x1,$alto);
		
	//	$this->add("-------------------------------------------------------",$y1,$alto);
		$xy=$xy+15;
		$alto+=$inter;
		//
		$this->add("BASE:",360,$alto);
		$this->add("$base",430,$alto);
		
	//	$this->add("BASE:",440,$alto);
	//	$this->add("$base",500,$alto);
		$alto+=$inter;
		$xy=$xy+15;
		$this->add("IVA ($por_iva%):",360,$alto);
		$this->add("$iva",430,$alto);
		
	//	$this->add("IVA ($por_iva%):",440,$alto);
	//	$this->add("$iva",500,$alto);
		$alto+=$inter;
		$xy=$xy+15;
		$this->add("TOTAL:",360,$alto);
		$this->add("$total_p",430,$alto);
		
		$alto+=$inter+20;
		$this->add($id_contrato_serv,440,$alto);
		
		$nro_fact++;
		}
		return $cad;
}
}

//crea el objeto pdf
$pdf=new PDF();
$pdf=new PDF("p","carta");	
//$pdf->AddPage();

$pdf->Cuerpo($acceso,$id_contrato_serv,$nro_fact,$conti);

$pdf->Output('reporte.pdf','D');

?> 
