<?php
require('../include/FPDF/fpdf.php');

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$desde = formatfecha($_GET['desde']);
$hasta = formatfecha($_GET['hasta']);


$id_f=$_GET['id_franq'];
session_start();
	//$_SESSION["id_franq"] = $id_f; 
	/*
	if($id_f!='0'){
		//$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_cierre="LIBRO DE VddddENTAS DE $nombre_franq";
	}
	else{*/
		$titulo_cierre='RESUMEN DIARIO DE INGRESO POR FRANQUICIAS';
	//}
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->Image('../imagenes/logo.jpg',15,10,40);
		$this->SetFont('Arial','',12);
		$this->SetXY(70,15)	;
		$this->MultiCell(190,5,nombre_empresa(),'0','L');
	//	$this->MultiCell(190,5,"CABLE, C.A.",'0','L');
		$this->SetFont('Arial','',10);
		$this->SetX(70)	;
		$this->MultiCell(190,5,strtoupper(_(tipo_serv())),'0','L');
		//$this->Ln(8);
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
	function Titulo($titulo_cierre,$desde,$hasta)
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->SetX(70)	;
		$this->MultiCell(190,7,strtoupper(_("$titulo_cierre"."  Desde ".formatofecha($desde)."  Hasta ".formatofecha($hasta))),'0','L');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,70,25,20,20,25,80);
		$header=array(strtoupper(_('nro')),strtoupper(_('Estacion de trabajo')),strtoupper(_('reporte z')),strtoupper(_('fecha')),strtoupper(_('hora')),strtoupper(_('TOTAL')),strtoupper(_('OBSERVACION')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$desde,$hasta,$id_f)
	{
		
		$tipo=utf8_decode($tipo);
		$this->SetFont('Arial','B',9);
		
		$acceso1=conexion();
		
		
		//$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
	$w=array(20,20,25);	
	$col=5;
	$right=10;
	$alto=49;	
		$this->SetX($right);
			
		$this->SetX($right);
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,6,strtoupper(_('ingresos cobrados por franquicia')),"0",0,"L");
			
			
			$this->SetX($right)	;
			
				$this->Ln(12);
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell($w[0],7,"","LRB",0,"L");
				$der=15;
				$this->RotatedText($der, $alto, "FECHA", 25);
				$der=$der+$w[1];
				$dato=lectura($acceso,"SELECT *FROM franquicia order by nombre_franq");
				for($j=0;$j<count($dato);$j++){
					$nombre_franq=trim($dato[$j]["nombre_franq"]);
					$this->RotatedText($der, $alto, $nombre_franq, 25);
					$der=$der+$w[1];
					$this->Cell($w[1],7,"","LRB",0,"C");
				}
				$der=$der+5;
				$this->RotatedText($der, $alto, "TOTAL", 25);
				$this->Cell($w[2],7,""." ","LRB",0,"C");
		
			$this->Ln(7);
		
			$sum_total=array();
			$sum_t=0;
	while(comparaFecha($desde,$hasta)<=0){
		//ECHO "SELECT sum(monto_pago) as monto FROM pagos where fecha_pago='$desde'  ";
		$acceso->objeto->ejecutarSql("SELECT monto_pago as monto FROM pagos where fecha_pago='$desde'  and pagos.id_caja_cob<>'EA00000001' limit 1 ");
		$row=row($acceso);
		$monto=trim($row["monto"])+0;
		$cant=trim($row["cant"])+0;
		
		
	 if($monto>0){
		$wi=0;
		$j=0;
		$suma=0;
		$suma_m=0;
		$this->SetX(10);
		//list($ano,$mes,$dia)=explode("-",$desde);
		$fecha=$desde;
		$dia=formatofecha($desde);
		$this->SetFont('Arial','B',10);
		$this->Cell($w[$wi],$col,$dia,"LR",0,"C",$fill);
		$wi++;
		
			
			$this->SetFont('Arial','',9);
			$sum_t=0;
			for($j=0;$j<count($dato);$j++){
				$id_franq=trim($dato[$j]["id_franq"]);
				
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos ,caja_cobrador,caja where pagos.id_caja_cob=caja_cobrador.id_caja_cob and caja_cobrador.id_caja=caja.id_caja and fecha_pago='$fecha' and status_pago='PAGADO' and id_franq='$id_franq' and pagos.id_caja_cob<>'EA00000001' ");
				$row=row($acceso);
				$monto_pago=trim($row["monto_pago"])+0;
				$sum_total[$j]+=$monto_pago;
				$sum_t+=$monto_pago;
				$this->Cell($w[$wi],$col,number_format($monto_pago+0, 2, ',', '.'),"LR",0,"R",$fill);
				
			}
				$sum_total[$j]+=$sum_t;
				$this->SetFont('Arial','B',9);
				$this->Cell($w[2],$col,number_format($sum_t+0, 2, ',', '.'),"LR",0,"R",$fill);
				$fill=!$fill;
			
		$this->Ln();
			
		}//if monto	
		$desde=sumadia($desde);
			
	}
			$this->SetFont('Arial','B',9);
			$this->SetX($right)	;
			$this->Cell($w[0],7,"TOTAL","1",0,"R",$fill);
			$sum_to=0;
			for($j=0;$j<count($dato);$j++){
				$id_franq=trim($dato[$j]["id_franq"]);
				$this->SetFont('Arial','B',9);
				//$sum_to+=$sum_total[$j];
				$this->Cell($w[1],7,number_format($sum_total[$j]+0, 2, ',', '.'),"1",0,"R",$fill);
				
			}
			$this->SetFont('Arial','B',10);
			$this->Cell($w[2],7,number_format($sum_total[$j]+0, 2, ',', '.'),"1",0,"R",$fill);
		
	}//FUNCION CUERPO
	
		function Cuerpo_corrresponde($acceso,$desde,$hasta,$id_f)
	{
		
		$tipo=utf8_decode($tipo);
		$this->SetFont('Arial','B',9);
		
		$acceso1=conexion();
		
		
		//$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
	$w=array(20,20,25);	
	$col=5;
	$right=10;
	$alto=42;	
		$this->SetX($right);
			
		$this->SetX($right);
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,6,strtoupper(_('ingresos correspondiente a las franquicias')),"0",0,"L");
			
			
			$this->SetX($right)	;
			
				$this->Ln(12);
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell($w[0],7,"","LRB",0,"L");
				$der=15;
				$this->RotatedText($der, $alto, "FECHA", 25);
				$der=$der+$w[1];
				$dato=lectura($acceso,"SELECT *FROM franquicia order by nombre_franq");
				for($j=0;$j<count($dato);$j++){
					$nombre_franq=trim($dato[$j]["nombre_franq"]);
					$this->RotatedText($der, $alto, $nombre_franq, 25);
					$der=$der+$w[1];
					$this->Cell($w[1],7,"","LRB",0,"C");
				}
				$der=$der+5;
				$this->RotatedText($der, $alto, "TOTAL", 25);
				$this->Cell($w[2],7,""." ","LRB",0,"C");
		
			
			
			$this->Ln(7);
		
			$sum_total=array();
			$sum_t=0;
	while(comparaFecha($desde,$hasta)<=0){
		//ECHO "SELECT sum(monto_pago) as monto FROM pagos where fecha_pago='$desde'  ";
		$acceso->objeto->ejecutarSql("SELECT monto_pago as monto FROM pagos where fecha_pago='$desde' and pagos.id_caja_cob<>'EA00000001'  limit 1 ");
		$row=row($acceso);
		$monto=trim($row["monto"])+0;
		$cant=trim($row["cant"])+0;
		
		
	 if($monto>0){
		$wi=0;
		$j=0;
		$suma=0;
		$suma_m=0;
		$this->SetX(10);
		//list($ano,$mes,$dia)=explode("-",$desde);
		$fecha=$desde;
		$dia=formatofecha($desde);
		$this->SetFont('Arial','B',10);
		$this->Cell($w[$wi],$col,$dia,"LR",0,"C",$fill);
		$wi++;
		
			
			$this->SetFont('Arial','',9);
			$sum_t=0;
			for($j=0;$j<count($dato);$j++){
				$id_franq=trim($dato[$j]["id_franq"]);
				
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos, contrato,vista_ubica where  pagos.id_contrato= contrato.id_contrato and contrato.id_calle=vista_ubica.id_calle and fecha_pago='$fecha' and status_pago='PAGADO' and vista_ubica.id_franq='$id_franq'  and pagos.id_caja_cob<>'EA00000001' ");
				$row=row($acceso);
				$monto_pago=trim($row["monto_pago"])+0;
				$sum_total[$j]+=$monto_pago;
				$sum_t+=$monto_pago;
				$this->Cell($w[$wi],$col,number_format($monto_pago+0, 2, ',', '.'),"LR",0,"R",$fill);
				
			}
				$sum_total[$j]+=$sum_t;
				$this->SetFont('Arial','B',9);
				$this->Cell($w[2],$col,number_format($sum_t+0, 2, ',', '.'),"LR",0,"R",$fill);
				$fill=!$fill;
			
		$this->Ln();
			
		}//if monto	
		$desde=sumadia($desde);
			
	}
			$this->SetFont('Arial','B',9);
			$this->SetX($right)	;
			$this->Cell($w[0],7,"TOTAL","1",0,"R",$fill);
			$sum_to=0;
			for($j=0;$j<count($dato);$j++){
				$id_franq=trim($dato[$j]["id_franq"]);
				$this->SetFont('Arial','B',9);
				//$sum_to+=$sum_total[$j];
				$this->Cell($w[1],7,number_format($sum_total[$j]+0, 2, ',', '.'),"1",0,"R",$fill);
				
			}
			$this->SetFont('Arial','B',10);
			$this->Cell($w[2],7,number_format($sum_total[$j]+0, 2, ',', '.'),"1",0,"R",$fill);
		
		
		
		
		
		
		
	}
	
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-15);
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
	
	
	
	
	
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,10);
//agrega una nueva pagina
$pdf->AddPage('L','legal1');
$pdf->Titulo($titulo_cierre,$desde,$hasta);
$pdf->Cuerpo($acceso,$desde,$hasta,$id_f);
$pdf->AddPage('L','legal1');
$pdf->Cuerpo_corrresponde($acceso,$desde,$hasta,$id_f);
//$pdf->AddPage('L','legal1');
//$pdf->detalle_factura($acceso,$desde,$hasta,$id_f);
//$pdf->ordenes($acceso,$desde,$hasta,$id_f);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 