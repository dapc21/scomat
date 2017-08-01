<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$tipo = $_GET['tipo'];
$nro_recibo = $_GET['nro_recibo'];

$gen_fec = $_GET['gen_fec'];
$id_cobrador = $_GET['id_cobrador'];
$login = $_GET['login'];
$status_pago = $_GET['status_pago'];
$idmotivonota = $_GET['idmotivonota'];
$dir_ip = $_GET['dir_ip'];

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$where= "SELECT nro_recibo ,(nombre || ' ' || apellido) as cobrador,fecha_asig,status_pago,login_asig, (select fecha_rec from recibe_recibo where vista_recibos.id_rec=recibe_recibo.id_rec ) as fecha_rec FROM vista_recibos where (id_asig ILIKE '%0%') ";
  
	if($gen_fec!='GENERAL'){
			$where=$where. " and fecha_asig between '$desde' and '$hasta'";
	}
	if($id_cobrador!=''){
			$where=$where. " and (id_cobrador ILIKE '%$id_cobrador%')";
	}
	if($login!=''){
			$where=$where. " and (login_asig ILIKE '%$login%')";
	}
	if($status_pago!=''){
			$where=$where. " and (status_pago ILIKE '%$status_pago%')";
	}
	if($nro_recibo!=''){
			$where=$where. " and (nro_recibo ILIKE '%$nro_recibo%')";
	}
	if($tipo!=''){
			$where=$where. " and (tipo ILIKE '%$tipo%')";
	}

	//echo $where;
	//$x->consultas($where);

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
		$this->MultiCell(190,7,strtoupper(_('reporte de Facturas')),'0','C');
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
		$w=array(10,25,80,25,25,40,35);
		$header=array(strtoupper(_('nro')),strtoupper(_('Nro. Fact.')),strtoupper(_('Cobrador')),strtoupper(_('Fecha Asig.')),strtoupper(_('Fecha Rec')),strtoupper(_('Status')),strtoupper(_('	ASIGNADO POR')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,strtoupper($header[$k]),1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$where)
	{
		
		$w=$this->TituloCampos();
		
		$dato=lectura($acceso,$where);
	

		$this->SetFont('Arial','',8);
		$cont=1;
		
		
		$salto=0;
		for($i=0;$i<count($dato);$i++){
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			$this->SetX(10);
			
			
			
			$this->SetFont('Arial','',8);
			$this->SetX(10);
			$this->Cell($w[0],6,$cont,"1",0,"C",$fill);
			$this->Cell($w[1],6,utf8_decode(trim($dato[$i]["nro_recibo"])),"1",0,"J",$fill);
			$this->Cell($w[2],6,utf8_decode(trim($dato[$i]["cobrador"])),"1",0,"J",$fill);
			$this->Cell($w[3],6,formatofecha(trim($dato[$i]["fecha_asig"])),"1",0,"J",$fill);
			$this->Cell($w[4],6,formatofecha(trim($dato[$i]["fecha_rec"])),"1",0,"J",$fill);
			$this->Cell($w[5],6,utf8_decode(trim($dato[$i]["status_pago"])),"1",0,"J",$fill);
			$this->Cell($w[6],6,utf8_decode(trim($dato[$i]["login_asig"])),"1",0,"J",$fill);
			
			
			$this->Ln();
			$fill=!$fill;
			$cont++;
			$salto++;
			if($salto==20){
				$this->AddPage();
				
				$w=$this->TituloCampos();
				$salto=0;
			}
			
		}
		$this->SetX(10);
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
$pdf->AddPage('L','letter');

$pdf->Cuerpo($acceso,$where);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 