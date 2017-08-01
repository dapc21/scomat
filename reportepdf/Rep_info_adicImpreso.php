<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$login = $_GET['login'];
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,strtoupper(_("tv por cable.")),'0','C');
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
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
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('reporte de bitacoras')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,20,50,30,20,15,50);
		$header=array(strtoupper(_('nro')),strtoupper(_('cont')),strtoupper(_('cliente')),strtoupper(_('responsable')),strtoupper(_('fecha')),strtoupper(_('hora')),strtoupper(_('asunto')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'C',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$desde,$hasta,$login)
	{
	
		
		
		
		
		//$tipo_caja=verCajaPrincipal($acceso);
		$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		if($login!="TODOS" && $login!="0"){
			$where_c= " and login='$login'";
		}
		//echo "select nro_contrato,cedula,(nombre || ' ' || apellido) as cliente, login, fecha, hora, info_a","vista_contrato,info_adic FROM vista_contrato,info_adic where vista_contrato.id_contrato=info_adic.id_contrato and fecha between '$desde' and '$hasta' $where_c  order by fecha, hora";
		$acceso->objeto->ejecutarSql("select nro_contrato,cedula,(nombre || ' ' || apellido) as cliente, login, fecha, hora, info_a,desc_a FROM vista_contrato,info_adic where vista_contrato.id_contrato=info_adic.id_contrato and fecha between '$desde' and '$hasta' $where_c  order by fecha, hora");
		
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$sumatoria=0.00;
		while ($row=row($acceso))
		{
			
				$this->SetX(10);
				$this->Cell($w[0],5,$cont,"L",0,"C",$fill);
				$this->Cell($w[1],5,utf8_decode(trim($row["nro_contrato"])),"",0,"J",$fill);
				$this->Cell($w[2],5,utf8_decode(trim($row["cliente"])),"0",0,"J",$fill);
				$this->Cell($w[3],5,utf8_decode(trim($row["login"])),"0",0,"J",$fill);
				$this->Cell($w[4],5,formatofecha(trim($row["fecha"])),"0",0,"J",$fill);
				$this->Cell($w[5],5,trim($row["hora"]),"0",0,"J",$fill);
				$this->Cell($w[6],5,trim($row["info_a"]),"R",0,"J",$fill);

				$this->Ln();
				$this->MultiCell(array_sum($w),5,trim($row["desc_a"]),"LR","J",$fill);
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
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
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
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$desde,$hasta,$login);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 