<?php
require('../include/FPDF/fpdf.php');
require_once "metodosGraficos.php";

$id_zona=$_GET['id_zona'];
$anio=$_GET['anio'];


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
		
		$this->MultiCell(190,7,utf8_decode('ESTADISTICAS MENSUALES DE CLIENTES ACTIVOS Y CORTADOS POR ZONAS'),'0','C');
		
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
	function Cuerpo($acceso,$anio,$id_zona)
	{
		$fec_ini="$anio-01-01";
		$fec_fin="$anio-12-31";
			
		$acceso->objeto->ejecutarSql("SELECT nombre_zona FROM zona where id_zona='$id_zona'");
		$row=row($acceso);
		$nombre_zona = trim($row["nombre_zona"]);

		
		$this->SetXY(20,30);
		$this->Cell(190,6,'AÑO: '.$anio.'  ZONA: '.strtoupper($nombre_zona),"0",0,"L");
		
		
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
		$meses=ver_meses($acceso,$anio);
		$mes_ini=$meses[0];
		$mes_fin=$meses[1];
		
		
		//echo "<br>$mes_ini=$mes_fin:";
		
		for($i=$mes_ini;$i<=$mes_fin;$i++){
			$ult_dia_mes=date("t",mktime( 0, 0, 0, $i, 1, $anio ));
			
			$fec_ini="$anio-$i-01";
			$fec_fin="$anio-$i-$ult_dia_mes";
			
			//select * from contrato, calle, sector where contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector
			$gen1=verCant($acceso,"select count(DISTINCT contrato.id_contrato) as total from contrato_servicio_pagado,contrato, calle, sector where id_serv='SER00001' and fecha_inst = '$fec_ini' and sector.id_zona='$id_zona' and contrato_servicio_pagado.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			$gen2=verCant($acceso,"select count(DISTINCT contrato.id_contrato) as total from contrato_servicio_deuda,contrato, calle, sector where id_serv='SER00001' and fecha_inst = '$fec_ini' and sector.id_zona='$id_zona' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			$gen=$gen1+$gen2;
			$corte1=verCant($acceso,"select count(DISTINCT contrato.id_contrato)  as total from contrato_servicio_pagado ,contrato, calle, sector  where id_serv='SER00002' and fecha_inst between '$fec_ini' and '$fec_fin' and sector.id_zona='$id_zona' and contrato_servicio_pagado.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			$corte1=verCant($acceso,"select count(DISTINCT contrato.id_contrato)  as total from contrato_servicio_deuda_deuda ,contrato, calle, sector  where id_serv='SER00002' and fecha_inst between '$fec_ini' and '$fec_fin' and sector.id_zona='$id_zona' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			$corte=$corte1+$corte2;
			$rec=verCant($acceso,"select count(DISTINCT contrato.id_contrato)  as total from ordenes_tecnicos ,contrato, calle, sector where id_det_orden='DEO00003' and fecha_orden between '$fec_ini' and '$fec_fin' and sector.id_zona='$id_zona' and ordenes_tecnicos.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			$rec_mes=verCant($acceso,"select count(DISTINCT id_pago)  as total from vista_pago_ser,contrato, calle, sector where id_serv='SER00002' and fecha_inst between '$fec_ini' and '$fec_fin' and sector.id_zona='$id_zona' and vista_pago_ser.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			$inst=verCant($acceso,"select count(id_contrato)  as total from contrato, calle, sector where fecha_contrato > '$fec_fin'  and sector.id_zona='$id_zona' and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			$total=verCant($acceso,"select count(id_contrato)  as total from contrato, calle, sector where sector.id_zona='$id_zona' and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			$activos=(($gen-$rec_mes)+$rec)-$corte;
			$cortados=($total-$inst)-$activos;
			
			//echo "<br> select count(id_contrato)  as total from contrato, calle, sector where sector.id_zona='$id_zona' and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector";
			$total_ing += $activos;
			$total_deu += $cortados;
			
			$year[$k] = "$i/$anio";
			$mon[$k] = "$i";
			$data[$k] = $activos;
			$data2[$k]=$cortados;
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
		$this->Cell(190,6,'RESUMEN DE CLIENTES ACTIVOS Y CORTADOS DE '.utf8_decode(strtoupper($nombre_zona)),"0",0,"C");
		$this->Ln();
		
		//dimenciones de cada campo
		$w=array(40,30,30,30,30);
		$header=array('Descripción ','Activos (%).','Activos (Cant)','Cortados (%). ','Cortados (Cant) ');
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
				
				$mes_l=$mon[$i];
			
				$this->SetX(25);
				$this->Cell($w[0],6,$mes_letra[$mes_l].' '.$anio,"1",0,"J");
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
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Cuerpo($acceso,$anio,$id_zona);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 
