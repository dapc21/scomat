<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$com = $_GET['com'];
$id_persona_cob = $_GET['id_persona'];
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
		$this->MultiCell(190,7,strtoupper(_('reporte de cobranza por vendedor')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,20,20,60,20,20,34);
		$header=array(strtoupper(_('nro')),strtoupper(_('contrato')),strtoupper(_('cedula')),strtoupper(_('cliente')),strtoupper(_('fecha')),strtoupper(_('costo')),strtoupper(_('status')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'C',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$desde,$hasta,$id_persona_cob,$com)
	{
	
		
		$acceso->objeto->ejecutarSql("select *from vista_vendedor  where id_persona='$id_persona_cob' order By nombre");
		if($row=row($acceso))
		{
			$nombre=utf8_decode(trim($row["nombre"])." ".trim($row["apellido"]));
			$ncedula=trim($row["cedula"]);
		}
	
		$this->SetFont('Arial','B',10);
		$this->SetX(20);
		$this->Cell(40,5,strtoupper(_("vendedor ")).": ".$nombre." ".strtoupper(_("cedula ")).": ".$ncedula,0,0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',10);
		$this->SetX(20);
		$this->Cell(40,5,strtoupper(_("fecha Desde ")).": ".formatofecha($desde).strtoupper(_("     hasta ")).": ".formatofecha($hasta),0,0,'L');
		
		
		$this->Ln();
		$this->Ln();
		
		
		//$tipo_caja=verCajaPrincipal($acceso);
		$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
		//echo "SELECT id_contrato,nro_contrato,cedula,(nombre || ' ' || apellido) as nombre,fecha_contrato, status_contrato, costo_contrato,nombre_sector,nombre_zona FROM vista_contrato where fecha_contrato between '$desde' and '$hasta'   and id_persona='$id_persona_cob'  order by fecha_contrato,nro_contrato";
		$acceso->objeto->ejecutarSql("SELECT id_contrato,nro_contrato,cedula,(nombre || ' ' || apellido) as nombre,fecha_contrato, status_contrato, costo_contrato,nombre_sector,nombre_zona FROM vista_contrato where fecha_contrato between '$desde' and '$hasta'   and id_persona='$id_persona_cob'  order by fecha_contrato,nro_contrato");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$sumatoria=0.00;
		while ($row=row($acceso))
		{
			
				$this->SetX(15);
				$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
				$this->Cell($w[1],6,utf8_decode(trim($row["nro_contrato"])),"LR",0,"J",$fill);
				$this->Cell($w[2],6,utf8_decode(trim($row["cedula"])),"LR",0,"J",$fill);
				$this->Cell($w[3],6,substr(utf8_decode(trim($row["nombre"])), 0,28),"LR",0,"J",$fill);
				$this->Cell($w[4],6,number_format(trim($row["costo_contrato"])+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[5],6,formatofecha(trim($row["fecha_contrato"])),"LR",0,"C",$fill);
				$this->Cell($w[6],6,trim($row["status_contrato"]),"LR",0,"C",$fill);

				$this->Ln();
				$fill=!$fill;
				$cont++;
			
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
		
		
		$acceso->objeto->ejecutarSql("select sum(costo_contrato) as total_p from contrato where fecha_contrato between '$desde' and '$hasta'  and id_persona='$id_persona_cob'");
		$row=row($acceso);
		$total_p=trim($row["total_p"]);
		
		$comision=($total_p*$com)/100;
		
		$this->Ln();
		$this->SetX(75);
		$this->SetFont('Arial','BI',9);
		$this->Cell(55,6,strtoupper(_('resumen general')),"0",0,"C",$fill);
		
		$this->Ln();
		$this->SetX(75);
		$this->Cell(30,6,strtoupper(_('comision '))."($com%): ","1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($comision+0, 2, ',', '.'),"1",0,"R",$fill);
		
		
		$this->Ln();
		$this->SetX(75);
		$this->Cell(30,6,strtoupper(_('total general')).": ","1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($total_p+0, 2, ',', '.'),"1",0,"R",$fill);
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
$pdf->Cuerpo($acceso,$desde,$hasta,$id_persona_cob,$com);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 