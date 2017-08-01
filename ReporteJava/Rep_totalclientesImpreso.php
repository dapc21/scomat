<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];



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
		$this->MultiCell(190,7,utf8_decode(_('total clientes')),'0','C');
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
		$w=array(10,18,18,50,19,25,20,20,13);
		$header=array(_('nro'),_('cont.'),_('cedula'),_('nombre y apellido'),_('f. cont.'),_('status'),_('etiqueta'),_('telefono'),_('deuda'));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,strtoupper($header[$k]),0,0,'J',0);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$gen_ubi,$gen_fec,$status_contrato,$desde,$hasta,$id_franq,$id_zona,$id_sector,$id_calle)
	{
		$this->Ln();
		$w=$this->TituloCampos();
		
		if($gen_ubi!='GENERAL' || $gen_fec!='GENERAL' || $status_contrato!=''){
		$where= "SELECT id_contrato,nro_contrato,cedula,nombre,apellido,fecha_contrato,status_contrato,etiqueta,telefono,  deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa,direc_adicional FROM vista_contrato where (id_contrato ILIKE '%0%') ";
		$tipo='';
		if($gen_ubi!='GENERAL'){
			if($id_franq!='0'){
				$where=$where. " and (id_franq = '$id_franq')";
				$tipo='id_franq';
			}
			else if($id_zona!='0'){
				$where=$where. " and (id_zona ILIKE '%$id_zona%')";
				$tipo='id_zona';
			}
			else if($id_sector!='0'){
				$where=$where. " and (id_sector ILIKE '%$id_sector%')";
				$tipo='id_sector';
			}
			else if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
				$tipo='id_calle';
			}
			
			if($tipo=='id_franq'){
				if($id_zona!='0'){
					$where=$where. " and (id_zona ILIKE '%$id_zona%')";
				}
				if($id_sector!='0'){
					$where=$where. " and (id_sector ILIKE '%$id_sector%')";
				}
				if($id_calle!='0'){
					$where=$where. " and (id_calle ILIKE '%$id_calle%')";
				}
				
			}
			else if($tipo=='id_zona'){
				if($id_sector!='0'){
					$where=$where. " and (id_sector ILIKE '%$id_sector%')";
				}
				if($id_calle!='0'){
					$where=$where. " and (id_calle ILIKE '%$id_calle%')";
				}
				
			}
			else if($tipo=='id_sector'){
				if($id_calle!='0'){
					$where=$where. " and (id_calle ILIKE '%$id_calle%')";
				}
				
			}

		
		}
	  
	  
		if($gen_fec!='GENERAL'){
			if($id_franq!=''){
				$where=$where. " and fecha_contrato between '$desde' and '$hasta'";
				$tipo='id_franq';
			}
			
		
		}
		
		if($status_contrato!=''){
			if($id_franq!=''){
				$where=$where. " and (status_contrato ILIKE '%$status_contrato%')";
			}
			
			
		}
		$where=$where.' order by id_zona,id_sector,nombre_calle';
		//echo ":$where:";
		$dato=lectura($acceso,$where);
	}
	else{
		$dato=lectura($acceso,"SELECT id_contrato,nro_contrato,cedula,nombre,apellido,fecha_contrato,status_contrato,etiqueta,telefono, deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa,direc_adicional FROM vista_contrato");
	}

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
			$this->Cell($w[1],5,utf8_decode(trim($dato[$i]["nro_contrato"])),"0",0,"J",$fill);
			$this->Cell($w[2],5,utf8_decode(trim($dato[$i]["cedula"])),"0",0,"J",$fill);
			$this->Cell($w[3],5,utf8_decode(trim($dato[$i]["nombre"])." ".trim($dato[$i]["apellido"])),"0",0,"J",$fill);
			$this->Cell($w[4],5,formatofecha(trim($dato[$i]["fecha_contrato"])),"0",0,"J",$fill);
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
			$this->Cell(17,5,_("nro casa").": ".utf8_decode(trim($dato[$i]["numero_casa"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(15,5,'',"0",0,"J",$fill);
		
			$this->SetFont('Arial','',9);
			$this->Cell(10,5,_("edif").": ".utf8_decode(trim($dato[$i]["edificio"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(40,5,'',"0",0,"J",$fill);
		
			$this->SetFont('Arial','',9);
			$this->Cell(20,5,_("piso").": ".utf8_decode(trim($dato[$i]["numero_piso"])),"0",0,"J",$fill);
			
			$this->SetFont('Arial','',9);
			$this->Cell(41,5,_("postel").": ".utf8_decode(trim($dato[$i]["postel"])),"0",0,"J",$fill);
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,5,_("taps").": ".utf8_decode(trim($dato[$i]["taps"])),"0",0,"J",$fill);
			
			$this->SetFont('Arial','',9);
			$this->Cell(25,5,_("pto").": ".utf8_decode(trim($dato[$i]["pto"])),"0",0,"J",$fill);
			
			
			$this->Ln();
			
			$this->SetFont('Arial','',9);
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
			if($salto==9){
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

$pdf->Cuerpo($acceso,$gen_ubi,$gen_fec,$status_contrato,$desde,$hasta,$id_franq,$id_zona,$id_sector,$id_calle);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 