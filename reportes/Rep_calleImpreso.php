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
		//$this->TituloCampos();
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')),0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')),0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,utf8_d(_('reporte de calles')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{

	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso)
	{
		
		session_start();
		
	$id_f = $_SESSION["id_franq"]; 
	$id_zona = $_GET["id_zona"]; 
	$id_sector = $_GET["id_sector"]; 
	
	//echo ":$id_f:";
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	if($id_zona!='' && $id_zona!='0'){
			$consult=$consult. " and (id_zona ILIKE '%$id_zona%')";
	}
	
		if($id_sector!='' && $id_sector!='0'){
			$consult=$consult. " and (id_sector ILIKE '%$id_sector%')";
		}

	
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(30,67,15,15,13,13,13,18);
		//$header=array(strtoupper(_('nro franquicia')),strtoupper(_('nombre franquicia')),strtoupper(_('ac')),strtoupper(_('co')),strtoupper(_('si')),strtoupper(_('su')),strtoupper(_('ex')),strtoupper(_('total')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		$this->Cell(40,7,strtoupper(_('nombre calle')),1,0,'J',1);
		$this->Cell(40,7,strtoupper(_('nombre sector')),1,0,'J',1);
		$this->Cell(30,7,strtoupper(_('zona')),1,0,'J',1);
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
					$nombrestatus=trim($dato[$j]["nombrestatus"]);
					$abrev=trim($dato[$j]["abrev"]);
					$nombrest=str_replace(" ",'_',$nombrestatus);
					
					$ac=$ac." (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_calle=vista_calle1.id_calle and status_contrato='$nombrestatus' $consult) as $abrev ,";
					
					$this->Cell(15,7,strtoupper($abrev),1,0,'C',1);
				}
			$this->Cell(15,7,strtoupper(_('total')),1,0,'J',1);	

$total=" (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_calle=vista_calle1.id_calle $consult) as total";

$where="
select nombre_calle,nombre_sector,nombre_zona, $ac $total from vista_calle1 WHERE id_calle<>'' $consult
";
		$this->Ln();
		
		
		$w=array(30,67,15,15,13,13,13,18);
		
	//	echo ":$where:";
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
			$this->Cell(40,6,utf8_d(trim($row["nombre_calle"])),"LR",0,"J",$fill);
			$this->Cell(40,6,utf8_d(trim($row["nombre_sector"])),"LR",0,"J",$fill);
			$this->Cell(30,6,utf8_d(trim($row["nombre_zona"])),"LR",0,"J",$fill);
			
				for($j=0;$j<count($dato);$j++){
					$abrev=strtolower(trim($dato[$j]["abrev"]));
					$this->Cell(15,6, utf8_d(trim($row["$abrev"])),"LR",0,"C",$fill);
				}
			$this->Cell(15,6, utf8_d(trim($row["total"])),"LR",0,"C",$fill);
			
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->Cell(250,5,'','T');
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
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage('L','letter');
//$pdf->Titulo();
//$pdf->Fecha();
$pdf->Cuerpo($acceso);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 