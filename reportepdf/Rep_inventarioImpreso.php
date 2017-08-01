<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$id_inv = $_GET['id_inv'];


class PDF extends FPDF
{
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('inventario de materiales')),'0','C');
		$this->SetFont('Arial','B',8);
		$this->Ln();
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(195,212,235);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,20,70,25,30,25);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro mat')),strtoupper(_('nombre')),strtoupper(_('unidad')),strtoupper(_('tipo')),strtoupper(_('stock')));
		$this->SetFont('Arial','B',8);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,strtoupper($header[$k]),1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_inv)
	{
		
		
		
		
		$acceso->objeto->ejecutarSql("SELECT *FROM inventario where id_inv='$id_inv'  LIMIT 1 offset 0 ");
		
		if($row=row($acceso)){

			$fecha_inv=formatofecha(trim($row['fecha_inv']));
			$hora_inv=utf8_decode(trim($row['hora_inv']));
			$tipo_inv=utf8_decode(trim($row['tipo_inv']));
			$obser_inv=utf8_decode(trim($row['obser_inv']));
		}
		
		
		$this->Ln();
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(70,5,strtoupper(_('fecha inventario')).": ".$fecha_inv,0,0,'J');
		$this->Cell(60,5,strtoupper(_('hora inventario')).": ".$hora_inv,0,0,'J');
		$this->Cell(50,5,strtoupper(_('tipo')).": ".$tipo_inv,0,0,'J');
		
		$this->Ln();
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(100,5,strtoupper(_('observacion')).": ",0,0,'J');
		
		$this->SetX(43);
		$this->SetFont('Arial','',9);
		$this->MultiCell(180,5,$obser_inv,'0','J');
		
		$w=$this->TituloCampos();
		
	
		//echo "select id_mat,numero_mat,nombre_mat,unidad_mat,cant_existencia,tipo,cantidad from materiales,inventario_materiales WHERE materiales.id_mat=inventario_materiales.id_mat and inventario_materiales.id_inv='$id_inv'";
		$dato = lectura($acceso,"select numero_mat,nombre_mat,unidad_mat,cant_existencia,tipo,cantidad from materiales,inventario_materiales WHERE materiales.id_mat=inventario_materiales.id_mat and inventario_materiales.id_inv='$id_inv' order by numero_mat");	
		

		$this->SetFont('Arial','',8);
		$cont=1;
		
		
		$salto=0;
		for($i=0;$i<count($dato);$i++){
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			$id_contrato=trim($dato[$i]["id_contrato"]);
			$this->SetX(15);
			
			
			
			$this->SetFont('Arial','',8);
			$this->SetX(15);
			$this->Cell($w[0],6,$cont,"1",0,"C",$fill);
			$this->Cell($w[1],6,utf8_decode(trim($dato[$i]["numero_mat"])),"1",0,"J",$fill);
			$this->Cell($w[2],6,utf8_decode(trim($dato[$i]["nombre_mat"])),"1",0,"J",$fill);
			$this->Cell($w[3],6,utf8_decode(trim($dato[$i]["unidad_mat"])),"1",0,"J",$fill);
			$this->Cell($w[4],6,utf8_decode(trim($dato[$i]["tipo"])),"1",0,"J",$fill);
			$this->Cell($w[5],6,utf8_decode(trim($dato[$i]["cantidad"])),"1",0,"J",$fill);
			
			$this->Ln();
			$fill=!$fill;
			$cont++;

		}
		$this->SetX(15);
		$this->Cell(array_sum($w),6,'','T');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-25);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	    
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,20);
//agrega una nueva pagina
$pdf->AddPage();

$pdf->Cuerpo($acceso,$id_inv);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 