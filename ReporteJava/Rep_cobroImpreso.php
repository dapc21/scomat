<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
class PDF extends JavaPrint
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetXY(10,10);
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,strtoupper(tipo_serv()),'0','C');
		
		
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('libro de ventas')),'0','C');
		
		$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).':',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).':',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();
			
		
		$this->TituloCampos();
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		
	}
	//Titulo del reporte
	function Titulo()
	{
		
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,15,23,50,14,13,18,22,20);
		$header=array(strtoupper(_('nro')),strtoupper(_('factura')),strtoupper(_('cedula')),strtoupper(_('nombre')),strtoupper(_('base')),strtoupper(_('iva')),strtoupper(_('total')),strtoupper(_('fecha')),strtoupper(_('status')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],6,$header[$k],1,0,'C',0);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$desde,$hasta)
	{
		$w=array(10,15,23,50,14,13,18,22,20);
		
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
		
		$acceso->objeto->ejecutarSql("SELECT inicial_doc,fecha_pago,nro_factura,cedulacli,nombrecli,monto_pago,status_pago,tipo_cliente FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta'  and tipo_caja='PRINCIPAL'  order by nro_factura");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$sumatoria=0.00;
		while ($row=row($acceso))
		{
			$x=0;
			for($j=0;$j<count($ca);$j++)
			{
				if($ca[$j]==trim($row["nro_factura"])){
					$x=1;
				}
			}
			if($x==0){
				$ca[$y]=trim($row["nro_factura"]);
				$y++;
				
				$monto=trim($row["monto_pago"]);
				if(trim($row["status_pago"])=="PAGADO"){
					$sumatoria=$sumatoria+$monto;
				}
				$total_p=$monto;
				$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
				$fill=0;
				$this->SetX(15);
				if(trim($row['tipo_cliente'])=="JURIDICO"){
								$cedula=trim($row['inicial_doc'])."-".trim($row['cedulacli']);
				}
				else{
					$cedula=trim($row['cedulacli']);
				}
				
				$this->Cell($w[0],6,$cont,"0",0,"C",$fill);
				$this->Cell($w[1],6,utf8_decode(trim($row["nro_factura"])),"0",0,"J",$fill);
				$this->Cell($w[2],6,$cedula,"0",0,"J",$fill);
				$this->Cell($w[3],6,utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])),"0",0,"J",$fill);
				$this->Cell($w[4],6,number_format($base+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[5],6,number_format($iva+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[6],6,number_format($monto+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[7],6,formatofecha(trim($row["fecha_pago"])),"0",0,"C",$fill);
				$this->Cell($w[8],6,trim($row["status_pago"]),"0",0,"C",$fill);

				$this->Ln();
				//$fill=!$fill;
				$cont++;
			}
		}
		$this->SetX(15);
		//$this->Cell(array_sum($w),5,'','T');
		
		
		$total_p=$sumatoria;
		$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
		
		$fill=0;
		$this->Ln();
		$this->SetX(75);
		$this->SetFont('Arial','BI',9);
		$this->Cell(55,6,strtoupper(_('resumen general')),"0",0,"C",$fill);
		
		$this->Ln();
		$this->SetX(75);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,6,strtoupper(_('total base')).':',"1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($base+0, 2, ',', '.'),"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(75);
		$this->Cell(30,6,strtoupper(_('total iva')).':',"1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($iva+0, 2, ',', '.'),"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(75);
		$this->Cell(30,6,strtoupper(_('total general')).':',"1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($total_p+0, 2, ',', '.'),"1",0,"R",$fill);
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
	    $this->Cell(190,7,'Pag. '.$this->PageNo().'',0,1,'C');
	}
	
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$desde,$hasta);
//imprime el reporte en formato PDF

$pdf->Output('reporte.pdf','D');
?> 