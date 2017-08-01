<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];

$desde = formatfecha($_GET['desde']);
$hasta = formatfecha($_GET['hasta']);
$id_det_orden = $_GET['id_det_orden'];
$id_tipo_orden = $_GET['id_tipo_orden'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];

$where= "SELECT id_orden,nro_contrato,fecha_orden,nombre_tipo_orden,nombre_det_orden,status_orden from vista_orden where (id_contrato ILIKE '%0%')";
if($gen_ubi!='GENERAL' || $gen_fec!='GENERAL' || $status_contrato!='' || $id_tipo_orden!='0'){
	
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
			$where=$where. " and fecha_orden between '$desde' and '$hasta'";
			$tipo='id_franq';
		}
		
	
	}
	
	if($status_contrato!=''){
			$where=$where. " and (status_orden ILIKE '%$status_contrato%')";
		
	}
	
	if($id_tipo_orden!='0'){
			$where=$where. " and (id_tipo_orden ILIKE '%$id_tipo_orden%') and (id_det_orden ILIKE '%$id_det_orden%') ";
	}
	//echo ":$where:";
	//$x->consultas($where);
}

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
		$this->MultiCell(190,7,strtoupper(_('reporte de ordenes de tecnicos')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,20,20,20,45,45,35);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro orden')),strtoupper(_('nro cont')),strtoupper(_('fecha')),strtoupper(_('tipo orden')),strtoupper(_('detalle orden')),strtoupper(_('status orden')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$where)
	{
		$w=array(10,20,20,20,45,45,35);
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
			$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
			$this->Cell($w[1],6,utf8_d(trim($row["id_orden"])),"LR",0,"J",$fill);
			$this->Cell($w[2],6,utf8_d(trim($row["nro_contrato"])),"LR",0,"J",$fill);
			$this->Cell($w[3],6,formatofecha(trim($row["fecha_orden"])),"LR",0,"J",$fill);
			$this->Cell($w[4],6,utf8_d(trim($row["nombre_tipo_orden"])),"LR",0,"J",$fill);
			$this->Cell($w[5],6,utf8_d(trim($row["nombre_det_orden"])),"LR",0,"J",$fill);
			$this->Cell($w[6],6,utf8_d(trim($row["status_orden"])),"LR",0,"J",$fill);
			

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
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();
//$pdf->Titulo();
//$pdf->Fecha();
$pdf->Cuerpo($acceso,$where);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 