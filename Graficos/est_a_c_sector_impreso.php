<?php
require('../include/FPDF/fpdf.php');
require_once "metodosGraficos.php";

$id_sector=$_GET['id_sector'];
$inicio_a=$_GET['inicio_a'];
$fin_a=$_GET['fin_a'];

if($fin_a=="" && $inicio_a==""){
	$valor=ver_anios($acceso);
	$inicio_a=$valor[0];
	$fin_a=$valor[1];
}


crearIMG("grafico1");
crearIMG("grafico2");
crearIMG("grafico3");
crearIMG("grafico4");

if($anio==""){
	$anio=date("Y");
}

class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		//$this->Image('../imagenes/cabecera.jpg',20,10,40);
		$this->SetTextColor(74,90,109);
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		
		$this->SetFont('Arial','B',10);
		
		$this->MultiCell(190,7,utf8_decode('ESTADISTICAS ANUALES DE CLIENTES ACTIVOS Y CORTADOS POR SECTOR'),'0','C');
		
		$this->SetFont('Arial','B',8);
		$this->SetX(123);
		$this->Cell(12,5,'Fecha:',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,'Hora:',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		
	}
	//para mostrar las fecha de impresion del reporte
	
	//muestra los titulos de los campos de los reportes
	
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$inicio_a,$fin_a,$id_sector)
	{
		$fec_ini="$anio-01-01";
		$fec_fin="$anio-12-31";
			
		$acceso->objeto->ejecutarSql("SELECT nombre_sector,id_zona FROM sector where id_sector='$id_sector'");
		$row=row($acceso);
		$nombre_sector = utf8_decode(trim($row["nombre_sector"]));
		$id_zona = trim($row["id_zona"]);

		$acceso->objeto->ejecutarSql("SELECT nombre_zona FROM zona where id_zona='$id_zona'");
		$row=row($acceso);
		$nombre_zona = utf8_decode(trim($row["nombre_zona"]));

		
		$this->SetXY(20,30);
		$this->Cell(190,6,'A�O INICIO: '.$inicio_a.'          A�O FIN: '.$fin_a.'          ZONA: '.strtoupper($nombre_zona).'          SECTOR: '.strtoupper($nombre_sector),"0",0,"L");
		
		
		$this->Image('../include/openflashchart/tmp-upload-images/grafico1.jpg',20,35,170);
		$this->Image('../include/openflashchart/tmp-upload-images/grafico4.jpg',20,115,170);
		$this->Image('../include/openflashchart/tmp-upload-images/grafico2.jpg',20,172,85);
		$this->Image('../include/openflashchart/tmp-upload-images/grafico3.jpg',105,172,85);
		
		$this->AddPage();
		$total_ing = 0;
		$total_deu = 0;
		
		$year = array();
		$data = array();
		$data2 = array();
		$data_pie = array();
		$data_pie1 = array();
		$rango = array();
		//$total_ing=0;
		$resumen="";
		$k=0;
	for($j=$inicio_a;$j<=$fin_a;$j++){
		$total_i = 0;
		$total_d = 0;
		$num_k=0;
		$meses=ver_meses($acceso,$j);
		$mes_ini=$meses[0];
		$mes_fin=$meses[1];

		//echo "<br>$mes_ini=$mes_fin:";
		
		for($i=$mes_ini;$i<=$mes_fin;$i++){
			$ult_dia_mes=date("t",mktime( 0, 0, 0, $i, 1, $j ));

			$fec_ini="$j-$i-01";
			$fec_fin="$j-$i-$ult_dia_mes";
			
			$gen1=verCant($acceso,"select count(DISTINCT contrato.id_contrato) as total from contrato_servicio_deuda,contrato, calle where id_serv='SER00001' and fecha_inst = '$fec_ini' and calle.id_sector='$id_sector' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle");
			$gen2=verCant($acceso,"select count(DISTINCT contrato.id_contrato) as total from contrato_servicio_pagado,contrato, calle where id_serv='SER00001' and fecha_inst = '$fec_ini' and calle.id_sector='$id_sector' and contrato_servicio_pagado.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle");
			$gen=$gen1+$gen2;
			$corte1=verCant($acceso,"select count(DISTINCT contrato.id_contrato)  as total from contrato_servicio_deuda ,contrato, calle  where id_serv='SER00002' and fecha_inst between '$fec_ini' and '$fec_fin' and calle.id_sector='$id_sector' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle");
			$corte2=verCant($acceso,"select count(DISTINCT contrato.id_contrato)  as total from contrato_servicio_pagado ,contrato, calle  where id_serv='SER00002' and fecha_inst between '$fec_ini' and '$fec_fin' and calle.id_sector='$id_sector' and contrato_servicio_pagado.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle");
			$corte=$corte1+$corte2;
			$rec=verCant($acceso,"select count(DISTINCT contrato.id_contrato)  as total from ordenes_tecnicos ,contrato, calle where id_det_orden='DEO00003' and fecha_orden between '$fec_ini' and '$fec_fin' and calle.id_sector='$id_sector' and ordenes_tecnicos.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle");
			$rec_mes=verCant($acceso,"select count(DISTINCT id_pago)  as total from vista_pago_ser,contrato, calle where id_serv='SER00002' and fecha_inst between '$fec_ini' and '$fec_fin' and calle.id_sector='$id_sector' and vista_pago_ser.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle");
			$inst=verCant($acceso,"select count(id_contrato)  as total from contrato, calle where fecha_contrato > '$fec_fin'  and calle.id_sector='$id_sector' and contrato.id_calle = calle.id_calle");
			$total=verCant($acceso,"select count(id_contrato)  as total from contrato, calle where calle.id_sector='$id_sector' and contrato.id_calle = calle.id_calle");
			$activos=(($gen-$rec_mes)+$rec)-$corte;
			$cortados=($total-$inst)-$activos;
			//echo "<br> select count(id_contrato)  as total from contrato, calle where calle.id_sector='$id_sector' and contrato.id_calle = calle.id_calle";
			
			
			$total_i += $activos;
			$total_d += $cortados;
			$num_k++;
			
		}
		@$act=number_format($total_i/$num_k, 0, '','')+0;
		@$cor=number_format($total_d/$num_k, 0, '','')+0;
		
		$total_ing += $total_i/$num_k;
		$total_deu += $total_d/$num_k;
		
		$year[$k] = "$j";
		$data[$k] = $act;
		$data2[$k]= $cor;
			
		//echo "<br>$j:$data[$k]:$data2[$k]:$num_k";	
			$k++;
	}

		$num_k=count($data);

		$total_ingreso=number_format($total_ing+0, 2, ',', '.');
		$total_deuda=number_format($total_deu+0, 2, ',', '.');

				
		
		@$act=$total_ing/$num_k;
		@$cor=$total_deu/$num_k;
		$total_c=$act+$cor;
		$data_prom=array();

		@$porc=($act*100)/$total_c;
		$porcentaje_a=number_format($porc, 2, ',','.');
		$act_c=number_format($act, 0, ',','.');
		
		@$porc=($cor*100)/$total_c;
		$porcentaje_c=number_format($porc, 2, ',','.');
		$cor_c=number_format($cor, 0, ',','.');
						
		$this->SetTextColor(74,90,109);
		$this->SetDrawColor(74,90,109);
		$this->SetLineWidth(.4);
		
		$this->SetFont('Arial','BI',10);
		$this->Ln();
		$this->Ln();
		$this->SetX(15);
		$this->Cell(190,6,'RESUMEN DE CLIENTES ACTIVOS Y CORTADOS DE '.strtoupper($nombre_sector),"0",0,"C");
		$this->Ln();
		
		//dimenciones de cada campo
		$w=array(40,30,30,30,30);
		$header=array('Descripci�n ','Ingreso (%).','Ingresos (Bs)','Deuda (%). ','Deuda (Bs) ');
		$this->SetFont('Arial','B',10);
		$this->SetX(25);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],8,$header[$k],1,0,'J');
		$this->Ln();
		
		$this->SetFont('Arial','',9);
		$cont=1;
		
		$mes_letra=array("1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		for($i=0;$i<$num_k;$i++){
			
			$total=$data[$i];
			@$porc=($total*100)/$total_ing;
			$porcentaje=number_format($porc, 2, ',','.');
		
			
			
			$deuda = $data2[$i];
			@$porc=($deuda*100)/$total_deu;
			$porcentaje1=number_format($porc, 2, ',','.');
				
				$mes_l=$i+1;
			
				$this->SetX(25);
				$this->Cell($w[0],6,"A�o ".$year[$i],"1",0,"J");
				$this->Cell($w[1],6,$porcentaje.'%',"1",0,"J");
				$this->Cell($w[2],6,number_format($total, 0, ',', '.'),"1",0,"J");
				$this->Cell($w[3],6,$porcentaje1.'%',"1",0,"J");
				$this->Cell($w[4],6,number_format($deuda, 0, ',', '.'),"1",0,"J");
				$this->Ln();
				$cont++;
		}
				$this->SetFont('Arial','B',10);
				$this->SetX(25);
				$this->Cell($w[0],8,"PROMEDIO","1",0,"J");
				$this->Cell($w[1],8,$porcentaje_a.'%',"1",0,"J");
				$this->Cell($w[2],8,$act_c,"1",0,"J");
				$this->Cell($w[3],8,$porcentaje_c.'%',"1",0,"J");
				$this->Cell($w[4],8,$cor_c,"1",0,"J");
				$this->Ln();
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-30);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de p�gina autom�tico desde la parte inferior de la p�gina 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Cuerpo($acceso,$inicio_a,$fin_a,$id_sector);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 
