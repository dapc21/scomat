<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 



class PDF extends JavaPrint
{
	function Header()
	{
		$this->SetXY(10,10);
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,_('reporte de clientes recuperados'),'0','C');
		$this->SetFont('Arial','B',8);
		
		$this->SetX(133);
		$this->Cell(12,5,_('fecha').':',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,_('hora').':',0,0,'L');
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
		$w=array(10,19,18,18,50,25,20,20,13);
		$header=array(_('nro'),_('fecha rec.'),_('nro abo.'),_('cedula'),_('nombre y apellido'),_('status'),_('etiqueta'),_('telefono'),_('deuda'));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,strtoupper($header[$k]),0,0,'J',0);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso)
	{
		$this->Ln();
		$w=$this->TituloCampos();
		$dato=lectura($acceso,"SELECT fecha_rec,id_contrato,nro_contrato,cedula,nombre,apellido,status_contrato,etiqueta,telefono, deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa,direc_adicional FROM vista_contratorec");
		
		$this->SetFont('Arial','',8);
		$cont=1;
		
		
		$salto=0;
		for($i=0;$i<count($dato);$i++){
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			$id_contrato=trim($dato[$i]["id_contrato"]);
			
			$this->SetX(10);
			
			
			$fill=0;
			$this->SetFont('Arial','',9);
			$this->SetX(10);
			$this->Cell($w[0],5,$cont,"0",0,"L",$fill);
			$this->Cell($w[1],5,formatofecha(trim($dato[$i]["fecha_rec"])),"0",0,"J",$fill);
			$this->Cell($w[2],5,utf8_decode(trim($dato[$i]["nro_contrato"])),"0",0,"J",$fill);
			$this->Cell($w[3],5,utf8_decode(trim($dato[$i]["cedula"])),"0",0,"J",$fill);
			$this->Cell($w[4],5,utf8_decode(trim($dato[$i]["nombre"])." ".trim($dato[$i]["apellido"])),"0",0,"J",$fill);
			
			$this->Cell($w[5],5,utf8_decode(trim($dato[$i]["status_contrato"])),"0",0,"J",$fill);
			$this->Cell($w[6],5,utf8_decode(trim($dato[$i]["etiqueta"])),"0",0,"J",$fill);
			$this->Cell($w[7],5,utf8_decode(trim($dato[$i]["telefono"])),"0",0,"J",$fill);
			$this->Cell($w[8],5,number_format(trim($dato[$i]["deuda"])+0, 2, ',', '.'),"0",0,"R",$fill);
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->Cell(52,5,_("zona").": ".utf8_decode(trim($dato[$i]["nombre_zona"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(40,5,utf8_decode(trim($dato[$i]["nombre_zona"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',9);
			$this->Cell(64,5,_("sector").": ".utf8_decode(trim($dato[$i]["nombre_sector"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			//$this->Cell(50,5,utf8_decode(trim($dato[$i]["nombre_sector"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',9);
			$this->Cell(77,5,_("calle").": ".utf8_decode(trim($dato[$i]["nombre_calle"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(65,5,utf8_decode(trim($dato[$i]["nombre_calle"])),"0",0,"J",$fill);
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->Cell(27,5,_("nro casa").": ".utf8_decode(trim($dato[$i]["numero_casa"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(10,5,utf8_decode(trim($dato[$i]["numero_casa"])),"0",0,"J",$fill);
		
			$this->SetFont('Arial','',9);
			$this->Cell(45,5,_("edif").": ".utf8_decode(trim($dato[$i]["edificio"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(35,5,utf8_decode(trim($dato[$i]["edificio"])),"0",0,"J",$fill);
		
			$this->SetFont('Arial','',9);
			$this->Cell(17,5,_("piso").": ".utf8_decode(trim($dato[$i]["numero_piso"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(7,5,utf8_decode(trim($dato[$i]["numero_piso"])),"0",0,"J",$fill);
		
			$this->SetFont('Arial','',8);
			$this->Cell(8,5,_("ref").": ".utf8_decode(trim($dato[$i]["direc_adicional"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(96,5,utf8_decode(trim($dato[$i]["direc_adicional"])),"0",0,"J",$fill);
			//$this->MultiCell(81,5,utf8_decode(trim($dato[$i]["direc_adicional"])),'TR','J');
			$this->SetFont('Arial','',2);
			//$this->Ln();
			//$this->SetX(114);
		//	$this->Cell(89,3,'',"LR",0,"C",$fill);
			//$this->Cell(array_sum($w),3,'',"RL",0,"C",$fill);
			
			$this->SetFont('Arial','',8);
			$this->Ln(1);
			$this->Cell(180,4,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',"0",0,"J",$fill);
			$this->Ln();
			
			//$this->Ln();
			//$fill=!$fill;
			$cont++;
			$salto++;
			if($salto==11){
				$this->AddPage();
				
				$w=$this->TituloCampos();
				$salto=0;
			}
			
		}
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-25);
		
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(190,7,'Pag. '.$this->PageNo().'',0,1,'C');
	    
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
//$pdf->SetAutoPageBreak(true,20);
//agrega una nueva pagina
$pdf->AddPage();

$pdf->Cuerpo($acceso);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 