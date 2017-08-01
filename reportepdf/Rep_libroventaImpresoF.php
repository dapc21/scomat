<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$desde = $_GET['desde']
$hasta = $_GET['hasta'];
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		
	}
	
	function TituloCampos($desde)
	{
		list($anio,$mes,$dia) = explode("-",$desde);
		$this->SetXY(15,15);
		$this->SetFont('Arial','',10);
		$this->MultiCell(250,4,nombre_empresa().'
RIF: '.tipo_serv().'
LIBRO DE VENTA AL VALOR AGREGADO (I.V.A.)
CORRESPONDIENTE AL MES: '.$mes.' / '.$anio,'0','C');

		$this->SetFont('Arial','B',8);
		$this->SetXY(230,20);
		$this->Cell(15,4,'Página:',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(15,4,$this->PageNo().'',0,0,'L');
		$this->SetXY(230,24);
		$this->Cell(15,4,_('Fecha:').": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,4,date("d/m/Y"),0,0,'L');
		
		
		$this->SetFillColor(244,249,255);
		//$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(12,40,12,7,7,13,12,12,12,12,5,5,5,5,18,18,18,9,18,10);
		//$header=array('1','1');
		$this->SetXY(15,35);
		$this->SetFont('times','',8);
		$this->Cell($w[0]+$w[1]+$w[2],5,"DATOS DEL CLIENTE",1,0,'C');
		
		$this->SetXY(15,40);
		$this->SetFont('times','',7);
		$this->Cell($w[0],8,"Fecha",1,0,'C');
		$this->Cell($w[1],8,"Nombre o Razón Social",1,0,'C');
		$this->Cell($w[2],8,"R.I.F. o C.I.",1,0,'C');
		
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2],35);
		$this->Cell($w[3]+$w[4],2,"Tipo de","LRT",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2],37);
		$this->Cell($w[3]+$w[4],3,"Contribuyente","LRB",0,'C');
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2],40);
		$this->Cell($w[3],8,"O","1",0,'C');
		$this->Cell($w[4],8,"SPE","1",0,'C');
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4],35);
		$this->Cell($w[5],3,"","LRT",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4],38);
		$this->Cell($w[5],3,"Numero de","LR",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4],41);
		$this->Cell($w[5],3,"Documento","LR",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4],43);
		$this->Cell($w[5],5,"","LRB",0,'C');
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5],35);
		$this->Cell($w[6],5,"Serial","LRT",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5],40);
		$this->Cell($w[6],3,"Impresora","LR",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5],43);
		$this->Cell($w[6],5,"Fiscal","LRB",0,'C');
		
		$this->SetFont('times','',8);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6],35);
		$this->Cell($w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13],5,"DATOS DEL DOCUMENTO","1",0,'C');
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6],40);
		$this->Cell($w[7],4,"Reporte","LRT",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6],44);
		$this->Cell($w[7],4,"Fiscal Z","LRB",0,'C');
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7],40);
		$this->Cell($w[8]+$w[9],4,"Nº Factura","1",0,'C');
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7],44);
		$this->Cell($w[8],4,"Desde","1",0,'C');
		$this->Cell($w[9],4,"Hasta","1",0,'C');
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9],40);
		$this->Cell($w[10]+$w[11]+$w[12]+$w[13],4,"Tipo","1",0,'C');
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9],44);
		$this->Cell($w[10],4,"F","1",0,'C');
		$this->Cell($w[11],4,"N/D","1",0,'C');
		$this->Cell($w[12],4,"N/C","1",0,'C');
		$this->Cell($w[13],4,"CR","1",0,'C');
		
		
		$this->SetFont('times','',8);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13],35);
		$this->Cell($w[14]+$w[15]+$w[16]+$w[17]+$w[18],5,"VENTAS INTERNAS","1",0,'C');
		
		$this->SetFont('times','',7);
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13],40);
		$this->Cell($w[14],4,"Total Ventas ","LRT",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13],44);
		$this->Cell($w[14],4,"Incluyendo IVA ","LRB",0,'C');
		
		
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13]+$w[14],40);
		$this->Cell($w[15],4,"Ventas Internas","LRT",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13]+$w[14],44);
		$this->Cell($w[15],4,"No Gravadas","LRB",0,'C');
		
		
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13]+$w[14]+$w[15],40);
		$this->Cell($w[16]+$w[17]+$w[18],4,"Alicuota General","1",0,'C');
		
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13]+$w[14]+$w[15],44);
		$this->Cell($w[16],4,"Base Imponible","1",0,'C');
		$this->Cell($w[17],4,"%","1",0,'C');
		$this->Cell($w[18],4,"Impuesto I.V.A.","1",0,'C');
		
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13]+$w[14]+$w[15]+$w[16]+$w[17]+$w[18],35);
		$this->Cell($w[19],3,"IVA","LRT",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13]+$w[14]+$w[15]+$w[16]+$w[17]+$w[18],38);
		$this->Cell($w[19],3,"Retenido","LR",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13]+$w[14]+$w[15]+$w[16]+$w[17]+$w[18],41);
		$this->Cell($w[19],3,"por el","LR",0,'C');
		$this->SetXY(15+$w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13]+$w[14]+$w[15]+$w[16]+$w[17]+$w[18],44);
		$this->Cell($w[19],4,"Cliente","LRB",0,'C');
		
		
		
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$desde,$hasta)
	{
		$mes_l=$desde;
		$tipo_caja=verCajaPrincipal($acceso);
		$w=$this->TituloCampos($mes_l);
		
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		$this->SetXY(15,48);
		$this->SetFont('times','',7);
		$cont=1;
		while(comparaFecha($desde,$hasta)<=0){
			$fact_d='';
			$fact_h='';
			$total_v=0;
			$reporte_z='';
			//echo "<br>SELECT sum(monto_pago) as total_v FROM vista_pago_cont where fecha_pago = '$desde'  and tipo_caja='PRINCIPAL'";
			$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as total_v FROM vista_pago_cont where fecha_pago = '$desde'  and status_pago ='PAGADO' and tipo_caja='PRINCIPAL' ");
			if($row=row($acceso)){
				$total_v=trim($row["total_v"]);
			}
			
			$acceso->objeto->ejecutarSql("SELECT nro_factura FROM vista_pago_cont where fecha_pago = '$desde'  and tipo_caja='PRINCIPAL' order by nro_factura desc  LIMIT 1 offset 0 ");
			if($row=row($acceso)){
				$fact_h=trim($row["nro_factura"]);
			}
			$acceso->objeto->ejecutarSql("SELECT reporte_z FROM cirre_diario where fecha_cierre = '$desde' LIMIT 1 offset 0 ");
			if($row=row($acceso)){
				$reporte_z=trim($row["reporte_z"]);
			}
			$acceso->objeto->ejecutarSql("SELECT nro_factura FROM vista_pago_cont where fecha_pago = '$desde'  and tipo_caja='PRINCIPAL' order by nro_factura  LIMIT 1 offset 0 ");
			if($row=row($acceso)){
				$fact_d=trim($row["nro_factura"]);
			
				if($cont==20){
					$this->resumen($acceso,$mes_l,$hasta,$w);
					$cont=1;
					$this->AddPage('L','letter');
					$w=$this->TituloCampos($mes_l);
					$this->SetXY(15,48);
				}
				$total_p=$total_v;
				$porc=($por_iva/100)+1;
				$base=$total_p/$porc;
				$iva=($base*$por_iva)/100;
				
				$sumatoria=$sumatoria+$total_p;
				
				$this->SetX(15);
				$this->Cell($w[0],5,formatofecha($desde),"1",0,"C",$fill);
				$this->Cell($w[1],5,"VENTAS A NO CONTRIBUYENTES","1",0,"J",$fill);
				$this->Cell($w[2],5,"","1",0,"J",$fill);
				$this->Cell($w[3],5,"","1",0,"J",$fill);
				$this->Cell($w[4],5,"","1",0,"J",$fill);
				$this->Cell($w[5],5,"","1",0,"J",$fill);
				$this->Cell($w[6],5,"Z1B8018","1",0,"J",$fill);
				$this->Cell($w[7],5,$reporte_z,"1",0,"J",$fill);
				$this->Cell($w[8],5,$fact_d,"1",0,"J",$fill);
				$this->Cell($w[9],5,$fact_h,"1",0,"J",$fill);
				$this->Cell($w[10],5,"","1",0,"J",$fill);
				$this->Cell($w[11],5,"","1",0,"J",$fill);
				$this->Cell($w[12],5,"","1",0,"J",$fill);
				$this->Cell($w[13],5,"","1",0,"J",$fill);
				$this->Cell($w[14],5,number_format($total_v+0+0, 2, ',', '.'),"1",0,"R",$fill);
				$this->Cell($w[15],5,"","1",0,"J",$fill);
				$this->Cell($w[16],5,number_format($base+0+0, 2, ',', '.'),"1",0,"R",$fill);
				$this->Cell($w[17],5,number_format($por_iva+0+0, 2, ',', '.'),"1",0,"R",$fill);
				$this->Cell($w[18],5,number_format($iva+0+0, 2, ',', '.'),"1",0,"R",$fill);
				$this->Cell($w[19],5,"","1",0,"C",$fill);

				$this->Ln();
				
		
				$cont++;
			}
			$desde=sumadia($desde);
		}//while
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
		$this->resumen($acceso,$mes_l,$hasta,$w);
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function resumen($acceso,$desde,$hasta,$w)
	{
		
		$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as total_v FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta' and status_pago ='PAGADO' and tipo_caja='PRINCIPAL'");
			if($row=row($acceso)){
				$total_p=trim($row["total_v"]);
			}
	//	$total_p=$sumatoria;
		$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
		
		$this->SetXY(15+$w[0]+$w[1],150);
		$this->SetFont('Arial','B',7);
		$this->Cell($w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12]+$w[13],5,_('TOTAL GENERAL'),"1",0,"L",$fill);
		$this->Cell($w[14],5,number_format($total_p+0+0, 2, ',', '.'),"1",0,"R",$fill);
		$this->Cell($w[15],5,'',"1",0,"C",$fill);
		$this->Cell($w[16],5,number_format($base+0+0, 2, ',', '.'),"1",0,"R",$fill);
		$this->Cell($w[17],5,'',"0",0,"C",$fill);
		$this->Cell($w[18],5,number_format($iva+0+0, 2, ',', '.'),"1",0,"R",$fill);
		
		
		$this->Ln(8);
		$this->SetX(15+$w[0]+$w[1]);
		$this->SetFont('Arial','B',7);
		$this->Cell($w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12],5,_('Total: Ventas Internas No Gravadas'),"1",0,"L",$fill);
		$this->Cell($w[14],5,"","1",0,"R",$fill);
		$this->Cell($w[15],5,'',"1",0,"R",$fill);
		$this->Cell($w[16],5,'',"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(15+$w[0]+$w[1]);
		$this->SetFont('Arial','B',7);
		$this->Cell($w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12],5,_('Sumatoria: Ventas de Exportación'),"1",0,"L",$fill);
		$this->Cell($w[14],5,"","1",0,"R",$fill);
		$this->Cell($w[15],5,'',"1",0,"R",$fill);
		$this->Cell($w[16],5,'',"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(15+$w[0]+$w[1]);
		$this->SetFont('Arial','B',7);
		$this->Cell($w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12],5,_('Sumatoria: Ventas Internas Afectadas solo Alicuota General'),"1",0,"L",$fill);
		$this->Cell($w[14],5,"","1",0,"R",$fill);
		$this->Cell($w[15],5,number_format($total_p+0+0, 2, ',', '.'),"1",0,"R",$fill);
		$this->Cell($w[16],5,number_format($base+0+0, 2, ',', '.'),"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(15+$w[0]+$w[1]);
		$this->SetFont('Arial','B',7);
		$this->Cell($w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12],5,_('Sumatoria: Ventas Internas Afectadas en Alicuota General + Adicional'),"1",0,"L",$fill);
		$this->Cell($w[14],5,"","1",0,"R",$fill);
		$this->Cell($w[15],5,'',"1",0,"R",$fill);
		$this->Cell($w[16],5,'',"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(15+$w[0]+$w[1]);
		$this->SetFont('Arial','B',7);
		$this->Cell($w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12],5,_('Sumatoria: Ventas Internas Afectadas en Alicuota Reducida'),"1",0,"L",$fill);
		$this->Cell($w[14],5,"","1",0,"R",$fill);
		$this->Cell($w[15],5,'',"1",0,"R",$fill);
		$this->Cell($w[16],5,'',"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(15+$w[0]+$w[1]);
		$this->SetFont('Arial','B',7);
		$this->Cell($w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7]+$w[8]+$w[9]+$w[10]+$w[11]+$w[12],5,'',"0",0,"C",$fill);
		$this->Cell($w[14],5,"","0",0,"R",$fill);
		$this->Cell($w[15],5,number_format($total_p+0+0, 2, ',', '.'),"1",0,"R",$fill);
		$this->Cell($w[16],5,number_format($base+0+0, 2, ',', '.'),"1",0,"R",$fill);
		
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage('L','letter');

$pdf->Cuerpo($acceso,$desde,$hasta);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 