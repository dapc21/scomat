<?php
require('../include/FPDF/fpdf.php');

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$desde = formatfecha($_GET['desde']);
$hasta = formatfecha($_GET['hasta']);


$id_f=$_GET['id_franq'];
session_start();
	//$_SESSION["id_franq"] = $id_f; 
	
	if($id_f!='0'){
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_cierre="LIBRO DE VENTAS DE $nombre_franq";
	}
	else{
		$titulo_cierre='LIBRO DE VENTAS GENERAL';
	}
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		
		$logo=logo();
		$ancho_logo=ancho_logo();
		$direc_fiscal=direc_fiscal();
		$telef_emp=telef_emp();
		
		$this->Image("../imagenes/$logo",15,10,$ancho_logo);
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
	function Titulo($titulo_cierre)
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->SetX(70)	;
		$this->MultiCell(190,7,strtoupper(_("$titulo_cierre")),'0','L');
		
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
		$tipo_caja=verCajaPrincipal($acceso);
		//$fecha=date("Y-m-d");
		
		
		
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
			$consult_fw=" where id_franq='$id_f'";
		}
		else{
		//	echo ":$id_f:";
			$consult_g=" and  id_franq='0'";
		}
	//	echo "SELECT *FROM cirre_diario where fecha_cierre between '$desde' and '$hasta'  and id_franq='$id_f'";
	
		$desde_t=formatofecha($desde);
		$hasta_t=formatofecha($hasta);
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,"$desde_t  Hasta $hasta_t",'0','C');
		
	
			
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=160;
		$top=55;
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de facturacion')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(60,6,strtoupper(_("DESCRIPCION")),"0",0,"L");
				$this->Cell(10,6,strtoupper(_("CANT")),"0",0,"C");
				
				$this->Cell(30,6,strtoupper(_("total"))." ","0",0,"R");
			$this->Ln();
			$this->SetFont('Arial','',9);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',9);
			$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as excento FROM vista_pago,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva=0 and fecha_pago between '$desde' and '$hasta'  ");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$excento=trim($row["excento"]);
				}
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"FACTURAS ANULADAS","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($excento+0, 2, ',', '.'),"0",0,"R");
				
			$this->Ln();
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as base_imp, sum(monto_iva) as monto_iva FROM vista_pago,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0 and fecha_pago between '$desde' and '$hasta'  ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$base_imp=trim($row["base_imp"]);
					
				}
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"FACTURAS (BASE IMPONIBLE)","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($base_imp+0, 2, ',', '.'),"0",0,"R");
				
			$this->Ln();	
			$acceso->objeto->ejecutarSql("SELECT count(*) cant,  sum(monto_iva) as monto_iva FROM vista_pago,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0 and fecha_pago between '$desde' and '$hasta'  ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto_iva=trim($row["monto_iva"]);
				}
			 
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"IVA (12%)","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($monto_iva+0, 2, ',', '.'),"0",0,"R");
				
				
			$this->Ln();	
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM vista_pago,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago between '$desde' and '$hasta'  and  status_pago='ANULADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$total_nc=trim($row["total_nc"]);
				}
			 
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"NOTAS DE CREDITOS","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($total_nc+0, 2, ',', '.'),"0",0,"R");
				
				
				
			$this->Ln();	
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(desc_pago) as desc_pago FROM vista_pago,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and desc_pago>0 and fecha_pago between '$desde' and '$hasta' ");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$desc_pago=trim($row["desc_pago"]);
				}
			 
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"DESCUENTOS","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($desc_pago+0, 2, ',', '.'),"0",0,"R");
				
				
		$this->Ln();
		
			$total_facturado=$excento+$base_imp+$monto_iva-$desc_pago-$total_nc;
			$this->SetX($right)	;
			$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
					$this->SetFont('Arial','B',9);
					$this->Cell(60,5,"TOTAL FACTURADO","0",0,"L");
					$this->Cell(20,5,'',"0",0,"C");
					$this->Cell(30,5,number_format($total_facturado+0, 2, ',', '.'),"0",0,"R");
					

		
		
		$this->SetFont('Arial','BIU',9);
		
			$this->Ln(10);
		$this->SetX(15);
		$this->Cell(40,6,strtoupper(_('detalles de clientes')),"0",0,"L");
		$this->Ln();
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,18,18,18,50,18,18,18,18,18,18,18);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abo.')),strtoupper(_('factura')),strtoupper(_('control')),strtoupper(_('C.I./RIF')),strtoupper(_('Cliente')),strtoupper(_('base I.')),strtoupper(_('Desc')),strtoupper(_('IVA')),strtoupper(_('Ret. IVA')),strtoupper(_('Ret. ISLR')),strtoupper(_('TOTAL')),strtoupper(_('STATUS')));
		$this->SetFont('Arial','B',7);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		
		$cable=conexion();
	//	echo "SELECT vista_pago_cont.id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont where  and fecha_pago between '$desde' and '$hasta'  $consult order by nro_factura";
		$acceso->objeto->ejecutarSql("SELECT vista_pago_cont.id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont where  fecha_pago between '$desde' and '$hasta'  $consult order by nro_control");
		
		$this->SetFont('Arial','',7);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		while ($row=row($acceso))
		{
			
				if(trim($row["status_pago"])=='ANULADO'){
					$row["nro_contrato"]='';
					$row["cedulacli"]='';
					$row["nombrecli"]='';
					$row["apellidocli"]='';
				}
				$this->SetX(10);
				$this->Cell($w[0],5,$cont,"LR",0,"C",$fill);
				$this->Cell($w[1],5,utf8_decode(trim($row["nro_contrato"])),"LR",0,"J",$fill);
				$this->Cell($w[2],5,utf8_decode(trim($row["nro_factura"])),"LR",0,"J",$fill);
				$this->Cell($w[3],5,utf8_decode(trim($row["nro_control"])),"LR",0,"J",$fill);
				$this->Cell($w[4],5,utf8_decode(trim($row["cedulacli"])),"LR",0,"J",$fill);
				$this->Cell($w[5],5,substr(utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])),0,30),"LR",0,"J",$fill);
				$this->Cell($w[6],5,number_format(trim($row["base_imp"])+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[7],5,number_format(trim($row["desc_pago"])+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[8],5,number_format(trim($row["monto_iva"])+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[9],5,number_format(trim($row["monto_reten"])+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[10],5,number_format(trim($row["islr"])+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[11],5,number_format(trim($row["monto_pago"])+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[12],5,utf8_decode(trim($row["status_pago"])),"LR",0,"J",$fill);
				
				$this->Ln();
				$fill=!$fill;
				$cont++;
		
		}
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
		
		
	}
	//muestra el pie de la pagina se repite en todas las paginas
	
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-20);
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,15);
//agrega una nueva pagina
$pdf->AddPage('L','letter');
$pdf->Titulo($titulo_cierre);
$pdf->Cuerpo($acceso,$desde,$hasta,$id_f);

$pdf->Output('reporte.pdf','D');
?> 