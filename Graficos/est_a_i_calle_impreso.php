<?php
require('../include/FPDF/fpdf.php');
require_once "metodosGraficos.php";


$inicio_a=$_GET['inicio_a'];
$fin_a=$_GET['fin_a'];
$id_calle=$_GET['id_calle'];

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
		
		$this->MultiCell(190,7,utf8_decode('ESTADISTICAS ANUALES DE INGRESOS Y DEUDAS POR CALLE'),'0','C');
		
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
	function Cuerpo($acceso,$inicio_a,$fin_a,$id_calle)
	{
		$acceso->objeto->ejecutarSql("SELECT nombre_calle,id_sector FROM calle where id_calle='$id_calle'");
		$row=row($acceso);
		$nombre_calle = trim($row["nombre_calle"]);
		$id_sector = trim($row["id_sector"]);

		$acceso->objeto->ejecutarSql("SELECT nombre_sector,id_zona FROM sector where id_sector='$id_sector'");
		$row=row($acceso);
		$nombre_sector = trim($row["nombre_sector"]);
		$id_zona = trim($row["id_zona"]);

		$acceso->objeto->ejecutarSql("SELECT nombre_zona FROM zona where id_zona='$id_zona'");
		$row=row($acceso);
		$nombre_zona = trim($row["nombre_zona"]);

		
		$this->SetXY(20,30);
		$this->Cell(190,6,'AÑO INICIO: '.$inicio_a.'          AÑO FIN: '.$fin_a.'          ZONA: '.utf8_decode(strtoupper($nombre_zona).'          SECTOR: '.strtoupper($nombre_sector).'          CALLE: '.strtoupper($nombre_calle)),"0",0,"L");
		
		
		$this->Image('../include/openflashchart/tmp-upload-images/grafico1.jpg',20,35,170);
		$this->Image('../include/openflashchart/tmp-upload-images/grafico4.jpg',20,115,170);
		$this->Image('../include/openflashchart/tmp-upload-images/grafico2.jpg',20,172,85);
		$this->Image('../include/openflashchart/tmp-upload-images/grafico3.jpg',105,172,85);
		
		$this->AddPage();
		
		$fec_ini="$inicio_a-01-01";
$fec_fin="$fin_a-12-31";


$total_ing = 0;
$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as monto_pago FROM pagos,contrato where fecha_pago between '$fec_ini' and '$fec_fin' and contrato.id_calle='$id_calle' and status_pago='PAGADO' and pagos.id_contrato=contrato.id_contrato");
//echo "SELECT sum(monto_pago) as monto_pago FROM pagos,contrato where fecha_pago between '$fec_ini' and '$fec_fin' and contrato.id_calle='$id_calle' and status_pago='PAGADO' and pagos.id_contrato=contrato.id_contrato";
if($row=row($acceso))
	$total_ing += trim($row["monto_pago"])+0;

$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro) as deuda FROM contrato_servicio_deuda,contrato where fecha_inst between '$fec_ini' and '$fec_fin' and status_con_ser='DEUDA' and contrato.id_calle='$id_calle' and contrato_servicio_deuda.id_contrato=contrato.id_contrato");
$row=row($acceso);
$total_deu = trim($row["deuda"])+0;


	
$year = array();
$data = array();
$data2 = array();
$data_pie = array();
$data_pie1 = array();
$rango = array();
//$total_ing=0;
$resumen="";
$k=0;
for($i=$inicio_a;$i<=$fin_a;$i++){
	$fec_ini="$i-01-01";
	$fec_fin="$i-12-31";
	
	$total = 0;
	$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as monto_pago FROM pagos,contrato where fecha_pago between '$fec_ini' and '$fec_fin' and contrato.id_calle='$id_calle' and status_pago='PAGADO'  and pagos.id_contrato=contrato.id_contrato");
	if($row=row($acceso))
		$total += trim($row["monto_pago"])+0;
	
	$year[$k] = "$i";
	$data[$k] = $total;
	@$porc=($total*100)/$total_ing;
	$porcentaje=number_format($porc, 2, ',','.');
	//$data_pie[$k] = new pie_value($total, "$i ($porcentaje%)");
	
	$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro) as deuda FROM contrato_servicio_deuda,contrato where fecha_inst between '$fec_ini' and '$fec_fin' and status_con_ser='DEUDA' and contrato.id_calle='$id_calle' and contrato_servicio_deuda.id_contrato=contrato.id_contrato");
	$row=row($acceso);
	$deuda = trim($row["deuda"])+0;
	$data2[$k]=$deuda;
	@$porc=($deuda*100)/$total_deu;
	$porcentaje1=number_format($porc, 2, ',','.');
	//$data_pie1[$k] = new pie_value($deuda, "$i ($porcentaje1%)");
	$k++;
	
	//$resumen.='<tr><td width="180px" class="estilocabe">A&ntilde;o '.$i.'</td><td width="40px" class="estilocabeN"  align="center">'.$porcentaje.'%</td<td width="120px" align="right" class="estilocabe">'.number_format($total+0, 2, ',', '.').'</td><td width="40px" class="estilocabeN" align="center">'.$porcentaje1.'%</td<td width="120px" align="right" class="estilocabe">'.number_format($deuda+0, 2, ',', '.').'</td></tr>';
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
		$act_c=number_format($act, 2, ',','.');
		
		@$porc=($cor*100)/$total_c;
		$porcentaje_c=number_format($porc, 2, ',','.');
		$cor_c=number_format($cor, 2, ',','.');
						
		$this->SetTextColor(74,90,109);
		$this->SetDrawColor(74,90,109);
		$this->SetLineWidth(.4);
		
		$this->SetFont('Arial','BI',10);
		$this->Ln();
		$this->Ln();
		$this->SetX(15);
		$this->Cell(190,6,'RESUMEN DE INGRESOS Y DEUDAS',"0",0,"C");
		$this->Ln();
		
		//dimenciones de cada campo
		$w=array(40,30,30,30,30);
		$header=array('Descripción ','Ingreso (%).','Ingresos (Bs)','Deuda (%). ','Deuda (Bs) ');
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
				$this->Cell($w[0],6,"Año ".$year[$i],"1",0,"J");
				$this->Cell($w[1],6,$porcentaje.'%',"1",0,"C");
				$this->Cell($w[2],6,number_format($total+0, 2, ',', '.'),"1",0,"R");
				$this->Cell($w[3],6,$porcentaje1.'%',"1",0,"C");
				$this->Cell($w[4],6,number_format($deuda+0, 2, ',', '.'),"1",0,"R");
				$this->Ln();
				$cont++;
		}
				$this->SetFont('Arial','B',10);
				$this->SetX(25);
				$this->Cell($w[0],8,"TOTAL","1",0,"J");
				$this->Cell($w[2]+$w[1],8,$total_ingreso,"1",0,"R");
				$this->Cell($w[3]+$w[4],8,$total_deuda,"1",0,"R");
				
				$this->Ln();
				
				$this->SetFont('Arial','B',10);
				$this->SetX(25);
				$this->Cell($w[0],8,"PROMEDIO","1",0,"J");
				$this->Cell($w[1],8,$porcentaje_a.'%',"1",0,"C");
				$this->Cell($w[2],8,$act_c,"1",0,"R");
				$this->Cell($w[3],8,$porcentaje_c.'%',"1",0,"C");
				$this->Cell($w[4],8,$cor_c,"1",0,"R");
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
$pdf->Cuerpo($acceso,$inicio_a,$fin_a,$id_calle);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 
