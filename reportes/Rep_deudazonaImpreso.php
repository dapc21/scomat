<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		
		$this->Titulo();
		$this->Fecha();
		$this->TituloCampos();
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
		$this->MultiCell(190,7,strtoupper(_('reporte de deuda por zonas')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(20,45,40,20,20,20,20);
		$header=array(strtoupper(_('nro zona')),strtoupper(_('nombre zona')),strtoupper(_('franquicia')),strtoupper(_('deuda')),strtoupper(_('pagado')),strtoupper(_('total cli')),strtoupper(_('con deuda')));
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
		
		$w=array(20,45,40,20,20,20,20);
		
		$deuda="(select sum(deuda) from vista_deudacli where vista_deudacli.id_zona=vista_zona.id_zona) as deuda";
		$pagado="(select sum(pagado) from vista_deudacli where vista_deudacli.id_zona=vista_zona.id_zona) as pagado";
		$num_deuda="(select count(*) from vista_deudacli where vista_deudacli.id_zona=vista_zona.id_zona and deuda>0) as num_deuda";
		$t_cli="(select count(*) from vista_deudacli where vista_deudacli.id_zona=vista_zona.id_zona) as t_cli";


		$where="
		select nro_zona,nombre_zona,nombre_franq,$deuda,$pagado,$t_cli,$num_deuda from vista_zona
		";
		$acceso->objeto->ejecutarSql($where);
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX(15);
			
			$this->Cell($w[0],6,utf8_d(trim($row["nro_zona"])),"LR",0,"J",$fill);
			$this->Cell($w[1],6,utf8_d(trim($row["nombre_zona"])),"LR",0,"J",$fill);
			$this->Cell($w[2],6,utf8_d(trim($row["nombre_franq"])),"LR",0,"J",$fill);
			$this->Cell($w[3],6,number_format(trim($row["deuda"])+0, 2, ',', '.'),"LR",0,"R",$fill);
			$this->Cell($w[4],6,number_format(trim($row["pagado"])+0, 2, ',', '.'),"LR",0,"R",$fill);
			$this->Cell($w[5],6,utf8_d(trim($row["t_cli"])),"LR",0,"R",$fill);
			$this->Cell($w[6],6,utf8_d(trim($row["num_deuda"])),"LR",0,"R",$fill);
			

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
		$this->MultiCell(180,5,utf8_d(''),'0','C');
		
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
//$pdf->Titulo();
//$pdf->Fecha();
$pdf->Cuerpo($acceso);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','I');
?> 