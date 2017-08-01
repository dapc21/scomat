<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php";

class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->cabecera_esp();
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
		$this->MultiCell(190,7,strtoupper(_('listado de proveedores ')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,28,58,28,28,28);
		$header=array(strtoupper(_('nro')),strtoupper(_('rif')),strtoupper(_('nombre')),strtoupper(_('telefono')),strtoupper(_('fax')),strtoupper(_('status')));
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
		$acceso->objeto->ejecutarSql("SELECT *FROM proveedor");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX(15);
			$this->Cell($w[0],6,$cont,"L",0,"C",$fill);
			$this->Cell($w[1],6,utf8_decode(trim($row["rif_prov"])),"0",0,"J",$fill);
			$this->Cell($w[2],6,utf8_decode(trim($row["nombre_prov"])),"0",0,"J",$fill);
			$this->Cell($w[3],6,utf8_decode(trim($row["telefonos_prov"])),"0",0,"J",$fill);
			$this->Cell($w[4],6,utf8_decode(trim($row["fax_prov"])),"0",0,"J",$fill);
			$this->Cell($w[5],6,utf8_decode(trim($row["status_prov"])),"R",0,"J",$fill);
			$this->Ln();
			$this->SetX(15);
			$this->MultiCell(array_sum($w),6,utf8_decode(trim($row["direccion_prov"])),"LR","J",$fill);

			//$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		$this->pie_pred();
	}
}

$pdf=new PDF();
//salto de p�gina autom�tico desde la parte inferior de la p�gina 
$pdf->SetAutoPageBreak(true,20);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 