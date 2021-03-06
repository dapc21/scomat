<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$fecha=$_GET['fecha'];
class PDF extends JavaPrint
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetXY(10,10);
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(195,5,strtoupper(tipo_serv()),'0','C');
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).':',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).':',0,0,'L');
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
		//$w=array(10,28,18,50,22,26,26);
		$w=array(10,48,18,40,22,21,21);
		$header=array(strtoupper_('nro')),strtoupper(_('punto de cobro')),strtoupper(_('monto')),strtoupper(_('cobrador')),strtoupper(_('fecha')),strtoupper(_('hora apertura')),'hora cierre')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],6,$header[$k],0,0,'J',0);
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
		
			$total_acumulado=number_format(calMontoCDCA($acceso,$fecha)+0, 2, ',', '.');
			$this->SetX(20);
			$this->SetFont('Arial','B',9);
			$this->Cell(28,6,strtoupper(_('total acumulado')).':',"0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$total_acumulado,"0",0,"L");
			
			$this->SetX(80);
			$this->SetFont('Arial','B',9);
			$this->Cell(12,6,strtoupper(_('fecha')).':',"0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$fecha,"0",0,"L");
			
			$this->SetFont('Arial','B',9);
			$this->Cell(10,5,strtoupper(_('hora')).':',0,0,'L');
			$this->SetFont('Arial','',8);
			$this->Cell(18,5,$hora_cierre,0,0,'L');
			
			
			$this->Ln();
			$this->SetX(20);
			$this->SetFont('Arial','B',9);
			$this->Cell(21,5,strtoupper(_('observacion')).':',"0",0,"L");
			
			
			$this->SetFont('Arial','',9);
			$this->SetX(42);
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
				$this->Cell(45,6,strtoupper(_("forma pago")),"0",0,"L");
				
				
				
				
				$this->Cell(12,6,strtoupper(_("total")),"0",0,"R");
			$this->SetH(3);
			$this->Ln();
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',9);
			$this->Cell(45,6,"----------------------------------------------------","0",0,"L");
			
		$dato=lectura($acceso,"SELECT *FROM tipo_pago where status_pago='ACTIVO'");
		for($k=0;$k<count($dato);$k++){
			$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
			$acceso->objeto->ejecutarSql("SELECT monto_pago FROM vista_tipopago where fecha_pago='$fecha' and id_tipo_pago='$id_tipo_pago' and tipo_caja='PRINCIPAL' and status_pago='PAGADO'");
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
			$this->Cell(45,3,"----------------------------------------------------","0",0,"L");
			$this->Ln();
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
				$this->SetH(3);
			$this->Ln();
			$this->SetX($right)	;
			$this->SetFont('Arial','',9);
			$this->Cell(45,6,"------------------------------------------------------------------------------","0",0,"L");
			
		$dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
		for($k=0;$k<count($dato);$k++){
			$id_serv=trim($dato[$k]["id_serv"]);
			$acceso->objeto->ejecutarSql("SELECT costo_cobro,cant_serv FROM vista_pago_ser where fecha_pago='$fecha' and id_serv='$id_serv' and tipo_caja='PRINCIPAL' and status_pago='PAGADO'");
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
			$this->Cell(45,3,"------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
			$this->SetX($right)	;
			$this->SetFont('Arial','B',9);
			$this->Cell(72,6,strtoupper(_("total")).":","0",0,"L");
			
			$this->SetFont('Arial','B',9);
			$this->Cell(12,6,$total_acumulado,"0",0,"R");

		
		
			
			
			
			$this->Ln();
			$this->Ln();
		$this->SetX(15);
		$this->Cell(40,6,strtoupper(_('detalle de los puntos de cobros1')),"0",0,"L");
		$this->Ln();
		$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA' and tipo_caja='PRINCIPAL'");

		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{	
			$fill=0;
			$this->SetX(15);
			$this->Cell($w[0],6,$cont,"",0,"C",$fill);
			$this->Cell($w[1],6,substr(utf8_decode(trim($row["nombre_caja"])), 0,15),"",0,"J",$fill);
			$this->Cell($w[2],6,number_format(utf8_decode(trim($row["monto_acum"]))+0, 2, ',', '.'),"",0,"J",$fill);
			$this->Cell($w[3],6,utf8_decode(trim($row["nombre"])." ".trim($row["apellido"])),"",0,"J",$fill);
			$this->Cell($w[4],6,formatofecha(trim($row["fecha_caja"])),"",0,"J",$fill);
			$this->Cell($w[5],6,utf8_decode(trim($row["apertura_caja"])),"",0,"J",$fill);
			$this->Cell($w[6],6,utf8_decode(trim($row["cierre_caja"])),"",0,"J",$fill);

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
		$this->SetY(-15);
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().'',0,1,'C');
	    
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de p�gina autom�tico desde la parte inferior de la p�gina 
$pdf->SetAutoPageBreak(true,35);
//agrega una nueva pagina
$pdf->AddPage("P","carta");
//$pdf->Fecha();
$pdf->Titulo();
$pdf->Cuerpo($acceso,$fecha);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 