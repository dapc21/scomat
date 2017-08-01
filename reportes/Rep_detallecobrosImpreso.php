<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_caja_cob=$_GET['id_caja_cob'];
$cierre_caja=$_GET['cierre_caja'];
$monto_acum=$_GET['monto_acum'];
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
		$this->Cell(12,5,strtoupper(_('fecha')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('cierre de puntos de cobros')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,17,20,52,15,20,20,18);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro cont.')),strtoupper(_('nro fact.')),strtoupper(_('cedula')),strtoupper(_('nombre y apellido')),strtoupper(_('monto')),strtoupper(_('fecha')),strtoupper(_('hora')),strtoupper(_('status')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_caja_cob,$cierre_caja,$monto_acum)
	{
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_caja where id_caja_cob='$id_caja_cob'");
		if($row=row($acceso)){
			$this->SetX(25);
			$this->SetFont('Arial','B',9);
			$this->Cell(32,6,strtoupper(_('punto de cobro')).': ',"0",0,"L");
			$this->SetX(51);
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,utf8_decode(trim($row['nombre_caja'])),"0",0,"L");
			
			$this->SetX(90);
			$this->SetFont('Arial','B',9);
			$this->Cell(25,6,strtoupper(_('cobrador')).': ',"0",0,"L");
			$this->SetX(122);
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,utf8_decode(trim($row['nombre'])." ".trim($row['apellido'])),"0",0,"L");
			
			$this->Ln();
			
			$this->SetX(25);
			$this->SetFont('Arial','B',9);
			$this->Cell(32,6,strtoupper(_('fecha de cobro')).': ',"0",0,"L");
			$this->SetX(51);
			$this->SetFont('Arial','',9);
			$fecha=trim($row['fecha_caja']);
			$this->Cell(30,6,formatofecha(trim($row['fecha_caja'])),"0",0,"L");
			
			$this->SetX(90);
			$this->SetFont('Arial','B',9);
			$this->Cell(25,6,strtoupper(_('monto acumulado')).': ',"0",0,"L");
			$this->SetX(122);
			$this->SetFont('Arial','',9);
			if(trim($row['monto_acum'])!=""){
				$monto_acum =trim($row['monto_acum']);
			}
			//echo "$monto_acum";
			$this->Cell(30,6,number_format($monto_acum+0, 2, ',', '.'),"0",0,"L");
			
			$this->Ln();
			
			$this->SetX(25)	;
			$this->SetFont('Arial','B',9);
			$this->Cell(32,6,strtoupper(_('hora apertura')).': ',"0",0,"L");
			$this->SetX(51);
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,trim($row['apertura_caja']),"0",0,"L");
			
			$this->SetX(90);
			$this->SetFont('Arial','B',9);
			$this->Cell(25,6,strtoupper(_('hora cierre')).': ',"0",0,"L");
			$this->SetX(122);
			$this->SetFont('Arial','',9);
			if(trim($row['cierre_caja'])!=''){
				$cierre_caja=trim($row['cierre_caja']);
			}
			$this->Cell(30,6,$cierre_caja,"0",0,"L");
			
			$this->Ln();
		}
		
		
		
		$this->Ln();
		
				
		
		$this->Ln();
		
		$right=120;
		$top=60;
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BI',9);
			$this->Cell($right,6,strtoupper(_('resumen por forma de pago')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(45,6,strtoupper(_("forma pago")),"0",0,"L");
				
				
				
				
				$this->Cell(12,6,strtoupper(_("total")),"0",0,"R");
			$this->Ln();
			$this->SetFont('Arial','',9);
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',9);
			$this->Cell(45,1,"----------------------------------------------------","0",0,"L");
			
		$dato=lectura($acceso,"SELECT *FROM tipo_pago where status_pago='ACTIVO'");
		for($k=0;$k<count($dato);$k++){
			$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
			$acceso->objeto->ejecutarSql("SELECT monto_pago FROM vista_tipopago where id_caja_cob='$id_caja_cob' and fecha_pago='$fecha' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'");
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
			$this->Cell(45,6,strtoupper(_("total")).": ","0",0,"L");
			
			$this->SetFont('Arial','B',9);
			$this->Cell(12,6,number_format($monto_acum+0, 2, ',', '.'),"0",0,"R");
			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$right=25;
		$top=60;
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BI',9);
			$this->Cell($right,6,strtoupper(_('resumen por servicios')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(52,6,strtoupper(_("servicio")),"0",0,"L");
				
				$this->Cell(20,6,strtoupper(_("cant")),"0",0,"C");
				
				
				$this->Cell(12,6,strtoupper(_("total")),"0",0,"R");
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"------------------------------------------------------------------------------","0",0,"L");
			
		$dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
		for($k=0;$k<count($dato);$k++){
			$id_serv=trim($dato[$k]["id_serv"]);
			$acceso->objeto->ejecutarSql("SELECT costo_cobro,cant_serv FROM vista_pago_ser where id_caja_cob='$id_caja_cob' and fecha_pago='$fecha' and id_serv='$id_serv' and status_pago='PAGADO'");
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
			$this->Cell(12,6,number_format($monto_acum+0, 2, ',', '.'),"0",0,"R");

		
		
		
		$this->SetFont('Arial','BI',9);
		$this->Ln();
		$this->Ln();
		$this->SetX(15);
		$this->Cell(40,6,strtoupper(_('detalle de los pagos')),"0",0,"L");
		$this->Ln();
		$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_pago_cont where id_caja_cob='$id_caja_cob' and fecha_pago='$fecha' order by nro_factura");
		
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		while ($row=row($acceso))
		{
			$x=0;
			for($j=0;$j<count($ca);$j++)
			{
				if($ca[$j]==trim($row["id_pago"])){
					$x=1;
				}
			}
			if($x==0){
				$ca[$y]=trim($row["id_pago"]);
				$y++;

				$this->SetX(15);
				$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
				$this->Cell($w[1],6,utf8_decode(trim($row["nro_contrato"])),"LR",0,"J",$fill);
				$this->Cell($w[2],6,utf8_decode(trim($row["nro_factura"])),"LR",0,"J",$fill);
				$this->Cell($w[3],6,utf8_decode(trim($row["cedulacli"])),"LR",0,"J",$fill);
				$this->Cell($w[4],6,utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])),"LR",0,"J",$fill);
				$this->Cell($w[5],6,number_format(trim($row["monto_pago"])+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[6],6,formatofecha(trim($row["fecha_pago"])),"LR",0,"J",$fill);
				$this->Cell($w[7],6,utf8_decode(trim($row["hora_pago"])),"LR",0,"J",$fill);
				$this->Cell($w[8],6,utf8_decode(trim($row["status_pago"])),"LR",0,"J",$fill);

				$this->Ln();
				$fill=!$fill;
				$cont++;
			}
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
$pdf->Cuerpo($acceso,$id_caja_cob,$cierre_caja,$monto_acum);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','I');
?> 