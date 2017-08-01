<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$fecha=$_GET['fecha'];
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		//$this->Image('../imagenes/cabecera.jpg',20,10,40);
		$this->SetFont('Arial','',12);
		$this->MultiCell(195,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(195,5,tipo_serv(),'0','C');
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).":",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).":",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(195,7,strtoupper(_('cierre diario')),'0','C');
		$this->Ln();
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,40,50,22,20,20,20);
		$header=array(strtoupper(_('nro')),strtoupper(_('punto de cobro')),strtoupper(_('cobrador')),strtoupper(_('fecha')),strtoupper(_('hora a.')),strtoupper(_('hora c.')),strtoupper(_('monto')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$fecha)
	{
		if($fecha==""){
			$fecha=date("Y-m-d");
		}
		
		$acceso->objeto->ejecutarSql("SELECT *FROM cirre_diario where fecha_cierre='$fecha'");
		if($row=row($acceso))
		{
			$obser_cierre=utf8_d(trim($row["obser_cierre"]));
			$hora_cierre=utf8_d(trim($row["hora_cierre"]));
		
			$total_acumulado=number_format(calMontoCD($acceso,$fecha)+0, 2, ',', '.');
			$this->SetX(20);
			$this->SetFont('Arial','B',9);
			$this->Cell(35,6,strtoupper(_('total acumulado')).":","0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$total_acumulado,"0",0,"L");
			
			$this->SetX(100);
			$this->SetFont('Arial','B',9);
			$this->Cell(20,6,strtoupper(_('fecha')).":","0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$fecha,"0",0,"L");
			
			$this->SetFont('Arial','B',9);
			$this->Cell(15,5,strtoupper(_('hora')).":",0,0,'L');
			$this->SetFont('Arial','',8);
			$this->Cell(18,5,$hora_cierre,0,0,'L');
			
			
			$this->Ln();
			$this->SetX(20);
			$this->SetFont('Arial','B',9);
			$this->Cell(21,5,strtoupper(_('observacion')).":","0",0,"L");
			
			
			$this->SetFont('Arial','',9);
			$this->SetX(50);
			$this->MultiCell(150,5,strtoupper(utf8_decode($obser_cierre)),'0','J');
			
			////////////////////////////////////////////
			
		
			$this->Ln();
		
			$right=120;
			$top=55;
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BI',9);
			$this->Cell($right,6,strtoupper(_('resumen por forma de pago')),"0",0,"L");
			$this->Ln();
			
			$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(45,6,strtoupper(_("forma de pago")),"0",0,"L");
				
				
				
				
				$this->Cell(12,6,strtoupper(_("total")),"0",0,"R");
			$this->Ln();
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',9);
			$this->Cell(45,1,"----------------------------------------------------","0",0,"L");
			
		$dato=lectura($acceso,"SELECT *FROM tipo_pago where status_pago='ACTIVO'");
		for($k=0;$k<count($dato);$k++){
			$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
			$acceso->objeto->ejecutarSql("SELECT monto_pago FROM vista_tipopago where fecha_pago='$fecha' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'");
			$suma=0;
			while ($row=row($acceso))
			{
				$suma=$suma+trim($row["monto_pago"]);
			}
			$total=$suma;
			if($total>0){
				$this->Ln();
				
				$this->SetX($right)	;
				$this->SetFont('Arial','',9);
				$this->Cell(45,6,trim($dato[$k]["tipo_pago"]).":","0",0,"L");
				
				$this->SetFont('Arial','',9);
				$this->Cell(12,6,number_format($total+0, 2, ',', '.'),"0",0,"R");
			}
		}
		
		$this->Ln();
			
			$this->SetX($right)	;
			$this->Cell(45,1,"----------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
			$this->SetFont('Arial','B',9);
			$this->Cell(45,6,strtoupper(_("total")).":","0",0,"L");
			
			$this->SetFont('Arial','B',9);
			$this->Cell(12,6,$total_acumulado,"0",0,"R");
			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$right=25;
		$top=55;
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BI',9);
			$this->Cell($right,6,strtoupper(_('resumen por servicios')),"0",0,"L");
			$this->Ln();
			$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(52,6,strtoupper(_("servicio")),"0",0,"L");
				
				$this->Cell(20,6,strtoupper(_("cant")),"0",0,"C");
				
				
				$this->Cell(12,6,strtoupper(_("total")),"0",0,"R");
			$this->Ln();
			$this->SetX($right)	;
			$this->SetFont('Arial','',9);
			$this->Cell(45,1,"------------------------------------------------------------------------------","0",0,"L");
			
		$dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
		for($k=0;$k<count($dato);$k++){
			$id_serv=trim($dato[$k]["id_serv"]);
			$acceso->objeto->ejecutarSql("SELECT costo_cobro,cant_serv FROM vista_pago_ser where fecha_pago='$fecha' and id_serv='$id_serv' and status_pago='PAGADO'");
			$suma=0;
			$cont=0;
			while ($row=row($acceso))
			{
				$cant=trim($row["cant_serv"]);
				$tar=trim($row["costo_cobro"]);
				$suma=$suma+($cant*$tar);
				$cont=$cont+$cant;
			}
			$total=$suma;
			if($total>0){
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','',9);
				$this->Cell(52,6,strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"]))).":","0",0,"L");
				
				$this->Cell(20,6,$cont,"0",0,"C");
				
				$this->SetFont('Arial','',9);
				$this->Cell(12,6,number_format($total+0, 2, ',', '.'),"0",0,"R");
			}
		}
		
		$this->Ln();
			$this->SetX($right)	;
			$this->Cell(45,1,"------------------------------------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
			$this->SetFont('Arial','B',9);
			$this->Cell(72,6,strtoupper(_("total")).": ","0",0,"L");
			
			$this->SetFont('Arial','B',9);
			$this->Cell(12,6,$total_acumulado,"0",0,"R");

		
		
			
			
			
			$this->Ln();
			$this->Ln();
		$this->SetX(15);
		$this->Cell(40,6,_('detalles de los puntos de cobros'),"0",0,"L");
		$this->Ln();
		$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA'");

		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX(15);
			$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
			$this->Cell($w[1],6,substr(utf8_decode(trim($row[_("nombre_caja")])),0,19),"LR",0,"J",$fill);
			$this->Cell($w[2],6,substr(utf8_decode(trim($row[_("nombre")])." ".trim($row["apellido"])),0,25),"LR",0,"J",$fill);
			$this->Cell($w[3],6,formatofecha(trim($row[_("fecha_caja")])),"LR",0,"J",$fill);
			$this->Cell($w[4],6,utf8_decode(trim($row[_("apertura_caja")])),"LR",0,"J",$fill);
			$this->Cell($w[5],6,utf8_decode(trim($row[_("cierre_caja")])),"LR",0,"J",$fill);
			$this->Cell($w[6],6,number_format(trim($row[_("monto_acum")])+0+0, 2, ',', '.'),"LR",0,"R",$fill);
						
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
		
		}
		else{
			$this->Ln();
			$this->Ln();
			$this->SetFont('Arial','',12);
			$this->MultiCell(195,5,strtoupper(_("error, no existe el cierre diario para esta fecha")),'0','C');
		}
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
$pdf->SetAutoPageBreak(true,35);
//agrega una nueva pagina
$pdf->AddPage();
//$pdf->Fecha();
$pdf->Titulo();
$pdf->Cuerpo($acceso,$fecha);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 