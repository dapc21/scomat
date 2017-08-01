<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php";

class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		//$this->Image('../imagenes/cabecera.jpg',20,10,40);
		$this->SetFont('Arial','B',10);
		$this->SetXY(15,18);
		$this->MultiCell(180,5,strtoupper(_('encabezado'))),'0','C');
		$this->Ln();
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('reporte de pedido')),'0','C');
		$this->Ln();
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,34,34,34,34,34);
		$header=array(strtoupper(_('nro')),strtoupper(_('id_ped')),strtoupper(_('fecha_ent')),strtoupper(_('status')),strtoupper(_('proveedor')),strtoupper(_('rif')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso)
	{
		$w=$this->TituloCampos();
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_pedido");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX(15);
			$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
			$this->Cell($w[1],6,utf8_decode(trim($row["id_ped"])),"LR",0,"J",$fill);
			$this->Cell($w[2],6,utf8_decode(trim($row["fecha_ent"])),"LR",0,"J",$fill);
			$this->Cell($w[3],6,utf8_decode(trim($row["status_ped"])),"LR",0,"J",$fill);
			$this->Cell($w[4],6,utf8_decode(trim($row["nombre_prov"])),"LR",0,"J",$fill);
			$this->Cell($w[5],6,utf8_decode(trim($row["rif_prov"])),"LR",0,"J",$fill);

			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-30);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode('pie pa'),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	    
	}
}
//crea el objeto pdf
$pdf=new PDF();
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,35);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Fecha();
$pdf->Titulo();
$pdf->Cuerpo($acceso);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 