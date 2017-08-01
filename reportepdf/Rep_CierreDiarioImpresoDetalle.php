<?php
require('../include/FPDF/fpdf.php');

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$fecha=$_GET['fecha'];
$id_f=$_GET['id_f'];
session_start();
	//$_SESSION["id_franq"] = $id_f; 
	
	if($id_f!='0'){
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_cierre="CIERRE DIARIO DE $nombre_franq";
	}
	else{
		$titulo_cierre='CIERRE DIARIO GENERAL';
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
		$this->Ln(8);
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
	function Cuerpo($acceso,$fecha,$id_f)
	{
		$tipo_caja=verCajaPrincipal($acceso);
		//$fecha=date("Y-m-d");
		
		if($fecha==""){
			$fecha=date("Y-m-d");
		}
		else{
			$fecha=formatfecha($fecha);
		}
		
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
			$consult_fw=" where id_franq='$id_f'";
		}
		else{
		//	echo ":$id_f:";
			$consult_g=" and  id_franq='0'";
		}
	//	echo "SELECT *FROM cirre_diario where fecha_cierre='$fecha' and id_franq='$id_f'";
	
		$acceso->objeto->ejecutarSql("SELECT *FROM cirre_diario where fecha_cierre='$fecha' and id_franq='$id_f'");
		if($row=row($acceso))
		{
			$monto_total=utf8_d(trim($row["monto_total"]));
			$obser_cierre=utf8_d(trim($row["obser_cierre"]));
			$hora_cierre=utf8_d(trim($row["hora_cierre"]));
			
			
	
			$fecha_cierre=formatofecha($fecha);
			$total_acumulado=$monto_total;
			$parcial=calMontoCDCA($acceso,$fecha);
			$acumulado=calMontoAcumulado($acceso,$fecha);
			
			$this->SetX(20);
			$this->SetFont('Arial','B',9);
			$this->Cell(25,6,strtoupper(_('PARCIAL')).":","0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$parcial,"0",0,"L");
			
			$this->SetFont('Arial','B',9);
			$this->Cell(37,6,strtoupper(_('monto acumulado')).":","0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$acumulado,"0",0,"L");
			
			
			$this->SetFont('Arial','B',9);
			$this->Cell(20,6,strtoupper(_('fecha')).":","0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$fecha_cierre,"0",0,"L");
			
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
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as excento FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva=0 and fecha_pago='$fecha' ");
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
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as base_imp, sum(monto_iva) as monto_iva FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0 and fecha_pago='$fecha' ");
			 
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
			$acceso->objeto->ejecutarSql("SELECT count(*) cant,  sum(monto_iva) as monto_iva FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0 and fecha_pago='$fecha' ");
			 
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
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago='$fecha' and  status_pago='ANULADO'");
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
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(desc_pago) as desc_pago FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and desc_pago>0 and fecha_pago='$fecha'");
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
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago where  fecha_pago='$fecha' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'  $consult ");
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
			
			 $acceso->objeto->ejecutarSql("SELECT  sum(monto_reten) as monto_reten FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_reten>0 and fecha_pago='$fecha' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$monto_reten=trim($row["monto_reten"]);
				}
			 $acceso->objeto->ejecutarSql("SELECT  sum(islr) as islr FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and islr>0 and fecha_pago='$fecha' and status_pago='PAGADO'");
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
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_reten) as monto_reten FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_reten>0 and fecha_pago='$fecha' and status_pago='PAGADO'");
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
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(islr) as islr FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and islr>0 and fecha_pago='$fecha' and status_pago='PAGADO'");
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
		$top=55;
			$this->SetXY($right,$top);
			
			
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
			echo "SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where  fecha_pago='$fecha' and id_serv='$id_serv'  and status_pago='PAGADO' $consult ";
				
		 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				echo "SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where  fecha_pago='$fecha' and id_serv='$id_serv'  and status_pago='PAGADO' $consult ";
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where  fecha_pago='$fecha' and id_serv='$id_serv'  and status_pago='PAGADO' $consult ");
				
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
		
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0 and fecha_pago='$fecha' and status_pago='PAGADO' ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			
		
		
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
			
		  $dato=lectura($acceso,"SELECT distinct fecha_inst  FROM vista_pago_ser where  fecha_pago='$fecha'  and status_pago='PAGADO' $consult  order by fecha_inst");
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
				//echo "SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where  fecha_pago='$fecha' and status_pago='PAGADO' and fecha_inst between '$fec_ini' and '$fec_fin'<br> ";
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where  fecha_pago='$fecha' and status_pago='PAGADO' and fecha_inst between '$fec_ini' and '$fec_fin'  $consult ");
				
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
		
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cobmonto_iva>0 and fecha_pago='$fecha' and status_pago='PAGADO' ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			
//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		
	
			$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',9);
			$w=array(20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20);	
			
			$this->Ln();
		$this->SetX(15);
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen por franquiciaS')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell($w[0],6,strtoupper(_("FRANQUICIA")),"0",0,"L");
				$dato_f=lectura($acceso,"SELECT *FROM franquicia $consult_fw order by id_franq");
				
				$dato=lectura($acceso,"SELECT *FROM franquicia order by id_franq");
				$dato1=lectura($acceso,"SELECT *FROM franquicia order by id_franq");
				for($j=0;$j<count($dato);$j++){
					$nombre_franq=trim($dato[$j]["nombre_franq"]);
					$this->Cell($w[$j+1],6,$nombre_franq,"0",0,"R");
				}
			//if($id_f=='0'){
				$this->Cell($w[$j+1],6,strtoupper(_("total"))." ","0",0,"R");
		//	}	
			$this->Ln();
			$this->SetFont('Arial','',7);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',10);
			$this->SetX($right);
			$this->Cell(45,1,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
			for($j=0;$j<count($dato);$j++){
				$nombre_franq=trim($dato[$j]["nombre_franq"]);
				$id_franq=trim($dato[$j]["id_franq"]);
				$this->Ln();
					
					$this->SetX($right)	;
					$this->SetFont('Arial','B',7);
					$this->Cell($w[0],5,$nombre_franq,"0",0,"L");
				
					for($k=0;$k<count($dato);$k++){
					$id_franq1=trim($dato[$k]["id_franq"]);
				
							if($id_f==$id_franq1 || $id_f==$id_franq || $id_f=='0'){
				
				
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos,caja_cobrador,caja ,vista_contrato_dir where
								pagos.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								pagos.id_contrato=vista_contrato_dir.id_contrato and 
								caja.id_franq='$id_franq'  and 
								fecha_pago='$fecha' and 
								status_pago='PAGADO' and 
								vista_contrato_dir.id_franq='$id_franq1'");
								$row=row($acceso);
								$monto_pago_AMC=trim($row["monto_pago"])+0;
								
									
								$this->SetFont('Arial','',7);
								$this->Cell($w[$j+1],5,number_format($monto_pago_AMC+0, 2, ',', '.'),"0",0,"R");
								$this->SetFont('Arial','',7);
								
							}
								else{
										$this->Cell($w[$j+1],5,'',"0",0,"R");
								}
					}
					if($id_f==$id_franq || $id_f=='0'){
						$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago, count(*) as cant FROM pagos ,caja_cobrador,caja where pagos.id_caja_cob=caja_cobrador.id_caja_cob and caja_cobrador.id_caja=caja.id_caja and fecha_pago='$fecha' and status_pago='PAGADO' and id_franq='$id_franq' ");
						$row=row($acceso);
						$monto_pago_t=trim($row["monto_pago"])+0;
						$this->SetFont('Arial','B',7);
						$this->Cell($w[$j+1],5,number_format($monto_pago_t+0, 2, ',', '.'),"0",0,"R");
					}
			}
			
		$this->Ln();
			
			$this->SetFont('Arial','',10);
			$this->SetX($right);
			$this->Cell(45,1,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
					
					$this->Ln();
					
					$this->SetX($right)	;
					$this->SetFont('Arial','B',7);
					$this->Cell($w[0],5,"TOTAL","0",0,"L");
			for($j=0;$j<count($dato);$j++){
				$id_franq=trim($dato[$j]["id_franq"]);		
					if($id_f==$id_franq || $id_f=='0'){
					
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos,caja_cobrador,caja ,vista_contrato_dir where
								pagos.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								pagos.id_contrato=vista_contrato_dir.id_contrato and 
								fecha_pago='$fecha' and 
								status_pago='PAGADO' and 
								vista_contrato_dir.id_franq='$id_franq'");
								$row=row($acceso);
								$monto_pago_AMC=trim($row["monto_pago"])+0;
								
									
								$this->SetFont('Arial','B',7);
								$this->Cell($w[$j+1],5,number_format($monto_pago_AMC+0, 2, ',', '.'),"0",0,"R");
					}
					else{
								$this->Cell($w[$j+1],5,'',"0",0,"R");
					}
			}		
				
			$this->Ln(7);	
			
			
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
		$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',9);
			
		$this->Ln();
		$this->SetX(15);
		$this->Cell(40,6,strtoupper(_('detalles de las estaciones de trabajos')),"0",0,"L");
		$this->Ln();
		$w=$this->TituloCampos();
		$acceso->objeto->ejecutarSql("SELECT id_cierre,nombre_est,reporte_z,fecha_cierre,hora_cierre,monto_total,obser_cierre from estacion_trabajo,cirre_diario_et where estacion_trabajo.id_est=cirre_diario_et.id_est and fecha_cierre='$fecha'  $consult ");

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
		
		
		
		
		$this->Ln(7);
		
		
	//	$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',9);
			
		
		$this->SetX(15);
		$this->Cell(40,6,strtoupper(_('detalles de los puntos de cobros')),"0",0,"L");
		$this->Ln();
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,45,45,45,20,20,20,20,25);
		$header=array(strtoupper(_('nro')),strtoupper(_('caja')),strtoupper(_('cobrador')),strtoupper(_('estacion de trabajo')),strtoupper(_('f. PAGO')),strtoupper(_('f. Cierre')),strtoupper(_('hora a.')),strtoupper(_('hora c.')),strtoupper(_('total')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		
	//	$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_caja where  fecha_caja ='$fecha' and status_caja_cob='CERRADA'  $consult ");

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
			$this->Cell($w[4],6,formatofecha(trim($row[_("fecha_sugerida")])),"LR",0,"J",$fill);
			$this->Cell($w[5],6,formatofecha(trim($row[_("fecha_caja")])),"LR",0,"J",$fill);
			$this->Cell($w[6],6,utf8_decode(trim($row[_("apertura_caja")])),"LR",0,"J",$fill);
			$this->Cell($w[7],6,utf8_decode(trim($row[_("cierre_caja")])),"LR",0,"J",$fill);
			$this->Cell($w[8],6,number_format(trim($row[_("monto_acum")])+0+0, 2, ',', '.'),"LR",0,"R",$fill);
			
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
			$this->MultiCell(195,5,strtoupper(_("error,  no existe el cierre diario para esta fecha")),'0','C');
		}
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function ordenes($acceso,$fecha,$id_f)
	{
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
			$consult_fw=" where id_franq='$id_f'";
		}
		else{
		//	echo ":$id_f:";
			$consult_g=" and  id_franq='0'";
		}
		
		if($fecha==""){
			$fecha=date("Y-m-d");
			//c
		}
		else{
			$fecha=formatfecha($fecha);
		}
		$right=10;
			
		//$this->Ln(2);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('RESUMEN POR FRANQUICIAS')),"0",0,"L");
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
			
		 $dato_franq=lectura($acceso,"SELECT *FROM franquicia $consult_fw order by id_franq ");
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
		/*
		
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
			
		 $dato_franq=lectura($acceso,"SELECT *FROM franquicia $consult_fw order by id_franq ");
			
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
					
		*/
			/*
		$this->Ln(4);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de ordenes de servicios por franquicias')),"0",0,"L");
			$right=10;
		*/
		$dato_franq=lectura($acceso,"SELECT *FROM franquicia  $consult_fw  order by id_franq ");
			$suma_s=array();
				$suma=0;
			for($k=0;$k<count($dato_franq);$k++){
				$id_franq=trim($dato_franq[$k]["id_franq"]);
				$nombre_franq=trim($dato_franq[$k]["nombre_franq"]);
				$this->Ln(10);
				$this->SetX($right);
				$this->SetFont('Arial','BIU',9);
				$this->Cell(50,6,strtoupper(_("resumen de ordenes de servicios franquicia $nombre_franq")),"0",0,"L");

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
					$nombre_det_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_det_orden"]));
					$nombre_tipo_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_tipo_orden"]));
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					
					$this->Cell(50,4,$nombre_det_orden,"0",0,"L");
					$this->Cell(40,4,$nombre_tipo_orden,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden'  and $fecha_orden='$fecha'");
							$row=row($acceso);
							$cant1=trim($row["cant"]);
							$this->Cell(15,4," $cant1","R",0,"L");
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and  id_det_orden='$id_det_orden' AND status_orden='$nombrestatus'");
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
				/*	
				$this->Ln(8);	
				$this->SetFont('Arial','B',8);
				$this->Cell(15,4,"NOTA: LA PRIMERA COLUMNA DE CADA ESTATUS REPRESENTA LO QUE SE HIZO Y LA SEGUNDA LO QUE QUEDA ACTUALMENTE","0",0,"L");	
		*/
		
			//$this->AddPage('L','letter');
		$this->Ln(10);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_("resumen de RECLAMOS de servicios  franquicia $nombre_franq ")),"0",0,"L");
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
					$nombre_det_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_det_orden"]));
					$nombre_tipo_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_tipo_orden"]));
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					
					$this->Cell(50,4,$nombre_det_orden,"0",0,"L");
					$this->Cell(40,4,$nombre_tipo_orden,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							//echo "SELECT count(*) as cant FROM vista_orden where id_det_orden='$id_det_orden'  and $fecha_orden='$fecha'";
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_franq='$id_franq' and id_det_orden='$id_det_orden'  and $fecha_orden='$fecha'");
							$row=row($acceso);
							$cant1=trim($row["cant"]);
							$this->Cell(15,4," $cant1","R",0,"L");
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_franq='$id_franq' and id_det_orden='$id_det_orden' AND status_orden='$nombrestatus'");
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
				}	
				$this->Ln(8);	
				$this->SetFont('Arial','B',8);
				$this->Cell(15,4,"NOTA: LA PRIMERA COLUMNA DE CADA ESTATUS REPRESENTA LO QUE SE HIZO Y LA SEGUNDA LO QUE QUEDA ACTUALMENTE","0",0,"L");	
		
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
$pdf->Titulo($titulo_cierre);
$pdf->Cuerpo($acceso,$fecha,$id_f);
//$pdf->AddPage('L','letter');
//$pdf->ordenes($acceso,$fecha,$id_f);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 