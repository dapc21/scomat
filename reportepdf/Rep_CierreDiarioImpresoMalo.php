<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_franq = $_GET['id_franq'];
$id_f = $id_franq;
if($id_f!='0'){
	$consult=" and id_franq='$id_f'";
}else{
	if($id_franq!='0'){
	//	$consult=" and id_franq='$id_franq'";
	}
}

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
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
		$this->MultiCell(190,7,strtoupper(_('libro de ventas')),'0','C');
		
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
	function Cuerpo($acceso,$desde,$hasta,$consult)
	{
		
		
		$desde_t=formatofecha($desde);
		$hasta_t=formatofecha($hasta);
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,"$desde_t  Hasta $hasta_t",'0','C');
		
			$this->Ln(7);
		
	
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=160;
		$top=35;
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
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as excento FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva=0 and fecha_pago between '$desde' and '$hasta' ");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$excento=trim($row["excento"]);
				}
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"FACTURAS (EXENTAS)","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($excento+0, 2, ',', '.'),"0",0,"R");
				
			$this->Ln();
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as base_imp, sum(monto_iva) as monto_iva FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0 and fecha_pago between '$desde' and '$hasta' ");
			 
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
			$acceso->objeto->ejecutarSql("SELECT count(*) cant,  sum(monto_iva) as monto_iva FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0 and fecha_pago between '$desde' and '$hasta' ");
			 
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
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago between '$desde' and '$hasta' and  status_pago='ANULADO'");
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
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(desc_pago) as desc_pago FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and desc_pago>0 and fecha_pago between '$desde' and '$hasta'");
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
					
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=160;
		$this->Ln(7);
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen por forma de pago')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(60,6,strtoupper(_("forma de pago")),"0",0,"L");
				$this->Cell(10,6,strtoupper(_("CANT")),"0",0,"C");
				$this->Cell(30,6,strtoupper(_("total"))." ","0",0,"R");
				
				
				
			$this->Ln();
			$this->SetFont('Arial','',9);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',9);
			$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"SELECT *FROM tipo_pago where status_pago='ACTIVO'");
			$suma_c=0;
			$suma_can=0;
			 
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago where  fecha_pago between '$desde' and '$hasta' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'");
				$suma=0;
				if($row=row($acceso))
				{
					$monto_tp=trim($row["monto_tp"])+0;
					$cant=trim($row["cant"])+0;
					$suma_c+=$monto_tp;
					$suma_can+=$cant;
					
					$this->Ln();
					
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,trim($dato[$k]["tipo_pago"]),"0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($monto_tp+0, 2, ',', '.'),"0",0,"R");
				}
			}
		
		$this->Ln();
			
			$this->SetX($right)	;
			$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
					$this->SetFont('Arial','B',9);
					$this->Cell(60,5,"TOTAL FORMA DE PAGO","0",0,"L");
					$this->Cell(20,5,$suma_can,"0",0,"C");
					$this->Cell(30,5,number_format($suma_c+0, 2, ',', '.'),"0",0,"R");
			
			 $acceso->objeto->ejecutarSql("SELECT  sum(monto_reten) as monto_reten FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_reten>0 and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$monto_reten=trim($row["monto_reten"]);
				}
			 $acceso->objeto->ejecutarSql("SELECT  sum(islr) as islr FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and islr>0 and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$islr=trim($row["islr"]);
				}
				
					$this->Ln();
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(110,5,'ret. IVA  '.number_format($monto_reten+0, 2, ',', '.').' + ret. ISLR '.number_format($islr+0, 2, ',', '.').' + total '.number_format($islr+0, 2, ',', '.').' = '.number_format($monto_reten+$islr+$suma_c+0, 2, ',', '.'),"0",0,"R");			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		
		$this->Ln(7);
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de retenciones')),"0",0,"L");
			
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
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_reten) as monto_reten FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_reten>0 and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto_reten=trim($row["monto_reten"]);
				}
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"RETENCION IVA (75%)","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,"-".number_format($monto_reten+0, 2, ',', '.'),"0",0,"R");
				
			$this->Ln();
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(islr) as islr FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and islr>0 and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$islr=trim($row["islr"]);
				}
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"RETENCION ISLR (2%)","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,"-".number_format($islr+0, 2, ',', '.'),"0",0,"R");
				
			$this->Ln();	
			$total_general=$total_facturado - $monto_reten - $islr;
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"TOTAL FACTURADO","0",0,"L");
					$this->Cell(20,5,"","0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($total_facturado+0, 2, ',', '.'),"0",0,"R");
				
				
			
				
		$this->Ln();
		
			$total_facturado=$excento+$base_imp+$monto_iva-$desc_pago-$total_nc;
			$this->SetX($right)	;
			$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
					$this->SetFont('Arial','B',9);
					$this->Cell(60,5,"TOTAL INGRESO","0",0,"L");
					$this->Cell(20,5,"","0",0,"C");
					
					$this->Cell(30,5,number_format($total_general+0, 2, ',', '.'),"0",0,"R");
					
				
					
		$right=160;
		
					
		/////////////////////////////////////////////////////////////////////////////////////////////

		
		$right=10;
		$top=35;
			$this->SetXY($right,$top);
			
			
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen por franquiciaS')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(45,6,strtoupper(_("FRANQUICIA")),"0",0,"L");
				$this->Cell(30,6,strtoupper(_("AMC")),"0",0,"R");
				$this->Cell(30,6,strtoupper(_("UNICABLE"))." ","0",0,"R");
				$this->Cell(25,6,strtoupper(_("total"))." ","0",0,"R");
				
			$this->Ln();
			$this->SetFont('Arial','',9);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago, count(*) as cant FROM pagos ,caja_cobrador,caja where pagos.id_caja_cob=caja_cobrador.id_caja_cob and caja_cobrador.id_caja=caja.id_caja and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO' and id_franq='2' ");
				$row=row($acceso);
				$monto_pago_t=trim($row["monto_pago"])+0;
				
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos,caja_cobrador,caja ,vista_contrato_dir where
								pagos.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								pagos.id_contrato=vista_contrato_dir.id_contrato and 
								caja.id_franq='2'  and 
								fecha_pago between '$desde' and '$hasta' and 
								status_pago='PAGADO' and 
								vista_contrato_dir.id_franq='2'");
								$row=row($acceso);
								$monto_pago_AMC=trim($row["monto_pago"])+0;
								
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos,caja_cobrador,caja ,vista_contrato_dir where
								pagos.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								pagos.id_contrato=vista_contrato_dir.id_contrato and 
								caja.id_franq='1'  and 
								fecha_pago between '$desde' and '$hasta' and 
								status_pago='PAGADO' and 
								vista_contrato_dir.id_franq='2'");
								$row=row($acceso);
								$monto_pago_UNI=trim($row["monto_pago"])+0;
									
					$this->Ln();
					
					$this->SetX($right)	;
					$this->SetFont('Arial','B',9);
					$this->Cell(45,5,"AMC","0",0,"L");
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($monto_pago_AMC+0, 2, ',', '.'),"0",0,"R");
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($monto_pago_UNI+0, 2, ',', '.'),"0",0,"R");
					$this->SetFont('Arial','B',9);
					$this->Cell(25,5,number_format($monto_pago_t+0, 2, ',', '.'),"0",0,"R");
				
				
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago, count(*) as cant FROM pagos ,caja_cobrador,caja where pagos.id_caja_cob=caja_cobrador.id_caja_cob and caja_cobrador.id_caja=caja.id_caja and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO' and id_franq='1' ");
				$row=row($acceso);
				$monto_pago_t=trim($row["monto_pago"])+0;
				
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos,caja_cobrador,caja ,vista_contrato_dir where
								pagos.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								pagos.id_contrato=vista_contrato_dir.id_contrato and 
								caja.id_franq='2'  and 
								fecha_pago between '$desde' and '$hasta' and 
								status_pago='PAGADO' and 
								vista_contrato_dir.id_franq='1'");
								$row=row($acceso);
								$monto_pago_AMC=trim($row["monto_pago"])+0;
								
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos,caja_cobrador,caja ,vista_contrato_dir where
								pagos.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								pagos.id_contrato=vista_contrato_dir.id_contrato and 
								caja.id_franq='1'  and 
								fecha_pago between '$desde' and '$hasta' and 
								status_pago='PAGADO' and 
								vista_contrato_dir.id_franq='1'");
								$row=row($acceso);
								$monto_pago_UNI=trim($row["monto_pago"])+0;
									
					$this->Ln();
					
					$this->SetX($right)	;
					$this->SetFont('Arial','B',9);
					$this->Cell(45,5,"UNICABLE","0",0,"L");
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($monto_pago_AMC+0, 2, ',', '.'),"0",0,"R");
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($monto_pago_UNI+0, 2, ',', '.'),"0",0,"R");
					$this->SetFont('Arial','B',9);
					$this->Cell(25,5,number_format($monto_pago_t+0, 2, ',', '.'),"0",0,"R");
				
				
		
		$this->Ln();
			
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
					$this->SetFont('Arial','B',9);
					
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos,caja_cobrador,caja ,vista_contrato_dir where
								pagos.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								pagos.id_contrato=vista_contrato_dir.id_contrato and 
								fecha_pago between '$desde' and '$hasta' and 
								status_pago='PAGADO' and 
								vista_contrato_dir.id_franq='2'");
								$row=row($acceso);
								$monto_pago_AMC=trim($row["monto_pago"])+0;
								
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos,caja_cobrador,caja ,vista_contrato_dir where
								pagos.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								pagos.id_contrato=vista_contrato_dir.id_contrato and 
								fecha_pago between '$desde' and '$hasta' and 
								status_pago='PAGADO' and 
								vista_contrato_dir.id_franq='1'");
								$row=row($acceso);
								$monto_pago_UNI=trim($row["monto_pago"])+0;
									
					$this->Ln();
					
					$this->SetX($right)	;
					$this->SetFont('Arial','B',9);
					$this->Cell(45,5,"TOTAL","0",0,"L");
					$this->SetFont('Arial','B',9);
					$this->Cell(30,5,number_format($monto_pago_AMC+0, 2, ',', '.'),"0",0,"R");
					$this->SetFont('Arial','B',9);
					$this->Cell(30,5,number_format($monto_pago_UNI+0, 2, ',', '.'),"0",0,"R");
					
				
			$this->Ln(7);	
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen por servicios')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(50,6,strtoupper(_("servicio")),"0",0,"L");
				$this->Cell(10,6,strtoupper(_("cant")),"0",0,"C");
				$this->Cell(20,6,strtoupper(_("costo")),"0",0,"R");
				$this->Cell(25,6,strtoupper(_("desc")),"0",0,"R");
				$this->Cell(25,6,strtoupper(_("total")),"0",0,"R");
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where  fecha_pago between '$desde' and '$hasta' and id_serv='$id_serv'  and status_pago='PAGADO'");
				
				$cont=0;
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$costo_cobro=trim($row["costo_cobro"]);
					$descu=trim($row["descu"]);
					$total=$costo_cobro-$descu;
					$suma_c+=$costo_cobro;
					$suma_d+=$descu;
					$suma_can+=$cant;
				
				
					if($total>0){
						$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','',9);
						$this->Cell(50,5,strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"]))).":","0",0,"L");
						$this->Cell(10,5,$cant,"0",0,"C");
						$this->Cell(20,5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($total+0, 2, ',', '.'),"0",0,"R");
					}
				}
			}
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
			$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',9);
						$this->Cell(50,5,strtoupper("total SERVICIOS"),"0",0,"L");
						$this->Cell(10,5,$suma_can,"0",0,"C");
						$this->Cell(20,5,number_format($suma_c+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($suma_d+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($total+0, 2, ',', '.'),"0",0,"R");
		
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0 and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO' ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			$this->Ln();
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(130,5,'IVA '.number_format($monto_iva+0, 2, ',', '.').'  + total '.number_format($total+0, 2, ',', '.').' = '.number_format($monto_iva+$total+0, 2, ',', '.'),"0",0,"R");	

		
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$right=10;
		$this->Ln(7);
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen DE cargos cobrados por meses')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(50,6,strtoupper(_("MES")),"0",0,"L");
				$this->Cell(10,6,strtoupper(_("cant")),"0",0,"C");
				$this->Cell(20,6,strtoupper(_("costo")),"0",0,"R");
				$this->Cell(25,6,strtoupper(_("desc")),"0",0,"R");
				$this->Cell(25,6,strtoupper(_("total")),"0",0,"R");
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
		  $dato=lectura($acceso,"SELECT distinct fecha_inst  FROM vista_pago_ser where  fecha_pago between '$desde' and '$hasta'  and status_pago='PAGADO' order by fecha_inst");
			 $dato1=array();
			 $ind=0;
			 for($k=0;$k<count($dato);$k++){
				$fecha_inst=trim($dato[$k]["fecha_inst"]);
				list($ano,$mes,$dia)=explode("-",$fecha_inst);
				$fecha1="$ano-$mes";
				
				if(!in_array($fecha1,$dato1)){
					$dato1[$ind]=$fecha1;
					$ind++;
				}
			 }
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato1);$k++){
				$fecha_inst=trim($dato1[$k]);
			//	echo $fecha_inst;
				list($ano,$mes)=explode("-",$fecha_inst);
				$mes_l = formato_mes_com1($mes)." $ano";
				
				$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $ano ));
				
				$fec_ini="$ano-$mes-01";
				$fec_fin="$ano-$mes-$ult_dia_mes";
			
				//echo "'$fec_ini' and '$fec_fin' <br>";
				//echo "SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where  fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO' and fecha_inst between '$fec_ini' and '$fec_fin'<br> ";
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where  fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO' and fecha_inst between '$fec_ini' and '$fec_fin' ");
				
				$suma=0;
				$cont=0;
				if($row=row($acceso))
				{
					$cant=trim($row["cant"]);
					$costo_cobro=trim($row["costo_cobro"]);
					$descu=trim($row["descu"]);
					$total=$costo_cobro-$descu;
					$suma_c+=$costo_cobro;
					$suma_d+=$descu;
					$suma_can+=$cant;
				
				
					if($total>0){
						$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','',9);
						$this->Cell(50,5,strtoupper($mes_l),"0",0,"L");
						$this->Cell(10,5,$cant,"0",0,"C");
						$this->Cell(20,5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($total+0, 2, ',', '.'),"0",0,"R");
					}
				}
			}
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
			$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',9);
						$this->Cell(50,5,strtoupper("total"),"0",0,"L");
						$this->Cell(10,5,$suma_can,"0",0,"C");
						$this->Cell(20,5,number_format($suma_c+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($suma_d+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($total+0, 2, ',', '.'),"0",0,"R");
		
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cobmonto_iva>0 and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO' ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			$this->Ln();
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(130,5,'IVA '.number_format($monto_iva+0, 2, ',', '.').'  + total '.number_format($total+0, 2, ',', '.').' = '.number_format($monto_iva+$total+0, 2, ',', '.'),"0",0,"R");	

	
		
		
		
		
		
		$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',9);
			
			$this->Ln();
		$this->SetX(15);
		$this->Cell(40,6,strtoupper(_('detalles de las estaciones de trabajos')),"0",0,"L");
		$this->Ln();
		$w=$this->TituloCampos();
		$acceso->objeto->ejecutarSql("SELECT id_cierre,nombre_est,reporte_z,fecha_cierre,hora_cierre,monto_total,obser_cierre from estacion_trabajo,cirre_diario_et where estacion_trabajo.id_est=cirre_diario_et.id_est and fecha_cierre between '$desde' and '$hasta' ");

		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX(15);
			$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
			$this->Cell($w[1],6,utf8_decode(trim($row["nombre_est"])),"LR",0,"J",$fill);
			$this->Cell($w[2],6,utf8_decode(trim($row["reporte_z"])),"LR",0,"J",$fill);
			$this->Cell($w[3],6,formatofecha(trim($row["fecha_cierre"])),"LR",0,"J",$fill);
			$this->Cell($w[4],6,utf8_decode(trim($row["hora_cierre"])),"LR",0,"J",$fill);
			$this->Cell($w[5],6,number_format(trim($row["monto_total"])+0+0, 2, ',', '.'),"LR",0,"R",$fill);
			$this->Cell($w[6],6,utf8_decode(trim($row["obser_cierre"])),"1",0,"J",$fill);
			
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
		
		
		
		
		
		
		
		
		
		
		
		
		
		$this->Ln(10);
		
		
	//	$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',9);
			
		
		$this->SetX(15);
		$this->Cell(40,6,strtoupper(_('detalles de los puntos de cobros')),"0",0,"L");
		$this->Ln();
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,50,50,40,25,25,25,25);
		$header=array(strtoupper(_('nro')),strtoupper(_('caja')),strtoupper(_('cobrador')),strtoupper(_('estacion de trabajo')),strtoupper(_('fecha')),strtoupper(_('hora a.')),strtoupper(_('hora c.')),strtoupper(_('total')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		
	//	$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_caja where  fecha_caja between '$desde' and '$hasta' and status_caja_cob='CERRADA'");

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
			$this->Cell($w[3],6,substr(utf8_decode(trim($row[_("nombre_est")])),0,19),"LR",0,"J",$fill);
			$this->Cell($w[4],6,formatofecha(trim($row[_("fecha_caja")])),"LR",0,"J",$fill);
			$this->Cell($w[5],6,utf8_decode(trim($row[_("apertura_caja")])),"LR",0,"J",$fill);
			$this->Cell($w[6],6,utf8_decode(trim($row[_("cierre_caja")])),"LR",0,"J",$fill);
			$this->Cell($w[7],6,number_format(trim($row[_("monto_acum")])+0+0, 2, ',', '.'),"LR",0,"R",$fill);
			
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
		
		
		
		
		
		
		
		
		
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function ordenes($acceso,$fecha)
	{
		
		if($fecha==""){
			$fecha=date("Y-m-d");
		}
		$right=10;
			
		//$this->Ln(2);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de clientes por franquicias')),"0",0,"L");
			$right=10;
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("Franquicia")),"0",0,"L");
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=substr(trim($dato[$j]["nombrestatus"]),0,13);
						$this->Cell(25,6,$nombrestatus,"0",0,"L");
				}
				$this->Cell(25,6,strtoupper(_("total")),"0",0,"L");
				
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato_franq=lectura($acceso,"SELECT *FROM franquicia order by id_franq ");
			$suma_s=array();
				$suma=0;
			for($k=0;$k<count($dato_franq);$k++){
				$id_franq=trim($dato_franq[$k]["id_franq"]);
				$nombre_franq=trim($dato_franq[$k]["nombre_franq"]);
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','',7);
				$this->Cell(50,4,substr($nombre_franq,0,13),"0",0,"L");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]["nombrestatus"]);
						$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_contrato_status where  status_contrato='$nombrestatus' and id_franq='$id_franq'");
						$row=row($acceso);
						$cant=trim($row["cant"]);
						$this->Cell(25,4," $cant","0",0,"L");
						$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
				}
				$this->SetFont('Arial','B',7);
					$this->Cell(25,4,"$suma","0",0,"L");
			}
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(50,5,"TOTAL","0",0,"L");
				
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]["nombrestatus"]);
							$cant=$suma_s[$nombrestatus];
							$this->Cell(25,5," $cant","0",0,"L");
							
					}
		
		
		$this->Ln(8);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de clientes por tipos de servicios')),"0",0,"L");
			$right=10;
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("tipo de servicio")),"0",0,"L");
				
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]["nombrestatus"]);
						$this->Cell(25,6,substr($nombrestatus,0,13),"0",0,"L");
				}
				$this->Cell(25,6,strtoupper(_("total")),"0",0,"L");
				$tipo_serv=lectura($acceso,"SELECT * FROM tipo_servicio WHERE  status_servicio='ACTIVO'");
				
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato_franq=lectura($acceso,"SELECT *FROM franquicia order by id_franq ");
			
				$suma_s=array();
				$suma=0;
				for($ij=0;$ij<count($tipo_serv);$ij++){
					$id_tipo_servicio=trim($tipo_serv[$ij]["id_tipo_servicio"]);
					$tipo_servicio=trim($tipo_serv[$ij]["tipo_servicio"]);
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					$this->Cell(50,4,$tipo_servicio,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]["nombrestatus"]);
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_servicio_status where id_tipo_servicio='$id_tipo_servicio' and status_contrato='$nombrestatus' ");
							$row=row($acceso);
							$cant=trim($row["cant"]);
							$this->Cell(25,4," $cant","0",0,"L");
							$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
					}
					
					$this->SetFont('Arial','B',7);
					$this->Cell(25,4,"$suma","0",0,"L");
				}
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(50,5,"TOTAL","0",0,"L");
					
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]["nombrestatus"]);
							$cant=$suma_s[$nombrestatus];
							$this->Cell(25,5," $cant","0",0,"L");
							
					}
					
		
			
		$this->Ln(4);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de ordenes de servicios')),"0",0,"L");
			$right=10;
			$this->SetX($right)	;
			
				$dato=array("CREADO","IMPRESO","FINALIZADO","DEVUELTA","CANCELADA");
				$fechas=array("fecha_orden","fecha_imp","fecha_cierre","fecha_dev","fecha_canc");
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("detalle orden")),"0",0,"L");
				$this->Cell(40,6,strtoupper(_("Tipo de orden")),"0",0,"L");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]);
						$this->Cell(30,6,substr($nombrestatus,0,13),"0",0,"C");
				}
				
				$this->Cell(30,6,strtoupper(_("TOTAL")),"0",0,"L");
				
				
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
				
			//	echo "SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN'";
				$tipo_serv=lectura($acceso,"SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN' ORDER BY nombre_tipo_orden");
			
				$suma_s=array();
				$suma_s1=array();
				$suma=0;
				$suma1=0;
				for($ij=0;$ij<count($tipo_serv);$ij++){
					$id_det_orden=trim($tipo_serv[$ij]["id_det_orden"]);
					$nombre_det_orden=trim($tipo_serv[$ij]["nombre_det_orden"]);
					$nombre_tipo_orden=trim($tipo_serv[$ij]["nombre_tipo_orden"]);
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					
					$this->Cell(50,4,$nombre_det_orden,"0",0,"L");
					$this->Cell(40,4,$nombre_tipo_orden,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM ordenes_tecnicos where id_det_orden='$id_det_orden' AND status_orden='$nombrestatus' and fecha_orden between '$desde' and '$hasta'");
							$row=row($acceso);
							$cant1=trim($row["cant"]);
							$this->Cell(15,4," $cant1","R",0,"L");
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM ordenes_tecnicos where id_det_orden='$id_det_orden' AND status_orden='$nombrestatus'");
							$row=row($acceso);
							$cant=trim($row["cant"]);
							$this->Cell(15,4," $cant","0",0,"L");
							
							$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
					}
					
					$this->SetFont('Arial','B',7);
					$this->Cell(15,4,"$suma","0",0,"L");
					//$this->Cell(15,4,"$suma1","0",0,"L");
				}
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(90,5,"TOTAL","0",0,"L");
					
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$cant1=$suma_s1[$nombrestatus];
							$this->Cell(15,5," $cant1","0",0,"L");
							
							$cant=$suma_s[$nombrestatus];
							$this->Cell(15,5," $cant","0",0,"L");
							
					}
					
				$this->Ln(8);	
				$this->SetFont('Arial','B',8);
				$this->Cell(15,4,"NOTA: LA PRIMERA COLUMNA DE CADA ESTATUS REPRESENTA LO QUE SE HIZO Y LA SEGUNDA LO QUE QUEDA ACTUALMENTE","0",0,"L");	
		
		
			$this->AddPage('L','letter');
		$this->Ln(10);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de RECLAMOS de servicios')),"0",0,"L");
			$right=10;
			$this->SetX($right)	;
			
				$dato=array("CREADO","IMPRESO","FINALIZADO","DEVUELTA","CANCELADA");
				$fechas=array("fecha_orden","fecha_imp","fecha_cierre","fecha_dev","fecha_canc");
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("detalle orden")),"0",0,"L");
				$this->Cell(40,6,strtoupper(_("Tipo de orden")),"0",0,"L");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]);
						$this->Cell(30,6,substr($nombrestatus,0,13),"0",0,"C");
				}
				
				$this->Cell(30,6,strtoupper(_("TOTAL")),"0",0,"L");
				
				
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
				
			//	echo "SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN'";
				$tipo_serv=lectura($acceso,"SELECT * FROM vista_detalleorden WHERE  status_tipord='RECLAMO' ORDER BY nombre_tipo_orden");
			
				$suma_s=array();
				$suma_s1=array();
				$suma=0;
				$suma1=0;
				for($ij=0;$ij<count($tipo_serv);$ij++){
					$id_det_orden=trim($tipo_serv[$ij]["id_det_orden"]);
					$nombre_det_orden=trim($tipo_serv[$ij]["nombre_det_orden"]);
					$nombre_tipo_orden=trim($tipo_serv[$ij]["nombre_tipo_orden"]);
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					
					$this->Cell(50,4,$nombre_det_orden,"0",0,"L");
					$this->Cell(40,4,$nombre_tipo_orden,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM ordenes_tecnicos where id_det_orden='$id_det_orden' AND status_orden='$nombrestatus' and fecha_orden between '$desde' and '$hasta'");
							$row=row($acceso);
							$cant1=trim($row["cant"]);
							$this->Cell(15,4," $cant1","R",0,"L");
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM ordenes_tecnicos where id_det_orden='$id_det_orden' AND status_orden='$nombrestatus'");
							$row=row($acceso);
							$cant=trim($row["cant"]);
							$this->Cell(15,4," $cant","0",0,"L");
							
							$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
					}
					
					$this->SetFont('Arial','B',7);
					$this->Cell(15,4,"$suma","0",0,"L");
					//$this->Cell(15,4,"$suma1","0",0,"L");
				}
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(90,5,"TOTAL","0",0,"L");
					
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$cant1=$suma_s1[$nombrestatus];
							$this->Cell(15,5," $cant1","0",0,"L");
							
							$cant=$suma_s[$nombrestatus];
							$this->Cell(15,5," $cant","0",0,"L");
							
					}
					
				$this->Ln(8);	
				$this->SetFont('Arial','B',8);
				$this->Cell(15,4,"NOTA: LA PRIMERA COLUMNA DE CADA ESTATUS REPRESENTA LO QUE SE HIZO Y LA SEGUNDA LO QUE QUEDA ACTUALMENTE","0",0,"L");	
		
	}
	function listado($acceso,$desde,$hasta,$consult)
	{
		
		$this->SetFont('Arial','BIU',9);
		
		
		$this->SetX(10);
		$this->Cell(40,6,strtoupper(_('detalle de los pagos')),"0",0,"L");
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
		
	//	$w=$this->TituloCampos();
		
		$cable=conexion();
		
		$acceso->objeto->ejecutarSql("SELECT id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont where  fecha_pago between '$desde' and '$hasta' order by nro_factura");
		
		$this->SetFont('Arial','',7);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		while ($row=row($acceso))
		{
			
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
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$desde,$hasta,$consult);
$pdf->AddPage('L','letter');
$pdf->ordenes($acceso,$fecha);
$pdf->AddPage('L','letter');
$pdf->listado($acceso,$desde,$hasta,$consult);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 