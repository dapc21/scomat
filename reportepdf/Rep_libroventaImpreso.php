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
		$this->SetXY(70,10)	;
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
		$this->SetX(10);
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
		//$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as excento FROM vista_pago,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva=0 and fecha_pago between '$desde' and '$hasta'  ");
	
		
		
		$this->Ln();
		
			
		$w=array(60,15,25);	
	
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=10;
		$top=33;
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen de facturacion')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("DESCRIPCION")),"TBL",0,"L");
				$this->Cell($w[1],5,strtoupper(_("CANT")),"TB",0,"C");
				
				$this->Cell($w[2],5,strtoupper(_("total"))." ","TBR",0,"R");
			$this->Ln();
			$this->SetFont('Arial','',8);
			
			
			$this->SetX($right)	;
				
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as excento FROM vista_pago ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  vista_pago.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva=0 and fecha_pago between '$desde' and '$hasta'   AND status_pago='PAGADO' ");
				if($row=row($acceso)){
					$cant_nc=trim($row["cant"]);
					$excento=trim($row["excento"]);
				}
				/*
					if($id_f=='1'){
						$cant_nc=0;
						$total_nc=0;
					}
					*/
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"FACTURAS (EXCENTAS)","L",0,"L");
					$this->Cell($w[1],5,$excento,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($total_nc+0, 2, ',', '.'),"R",0,"R");
				
			$this->Ln();
				// echo "SELECT count(*) cant, sum(base_imp) as base_imp, sum(monto_iva) as monto_iva FROM vista_pago,caja_cobrador where vista_pago.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva>0 and fecha_pago between '$desde' and '$hasta' ";
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp) as base_imp, sum(monto_iva) as monto_iva FROM vista_pago  ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  vista_pago.id_caja_cob=caja_cobrador .id_caja_cob and   fecha_pago between '$desde' and '$hasta'  AND status_pago='PAGADO' ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$base_imp=trim($row["base_imp"])+0;
					$monto_iva=trim($row["monto_iva"])+0;
					$total_ingresos=$base_imp+$monto_iva;
					
				}
				
					$this->SetX($right);
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"BASE IMPONIBLE","L",0,"L");
					$this->Cell($w[1],5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($base_imp+0, 2, ',', '.'),"R",0,"R");
					
					
					$this->Ln();	
					$this->SetX($right);
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"IVA (12%)","L",0,"L");
					$this->Cell($w[1],5,$cant,"0",0,"C");
					$this->Cell($w[2],5,number_format($monto_iva+0, 2, ',', '.'),"R",0,"R");
					
					$this->Ln();	
					$this->SetX($right);
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"TOTAL INGRESOS","LT",0,"L");
					$this->Cell($w[1],5,'',"T",0,"C");
					$this->Cell($w[2],5,number_format($total_ingresos+0, 2, ',', '.'),"RT",0,"R");
					
				
				
			$this->Ln();	
			//echo "SELECT count(*) cant, sum(monto_pago) as total_nc FROM vista_pago  where   fecha_pago between '$desde' and '$hasta' and  status_pago='NOTA CREDITO' ";
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as total_nc FROM vista_pago  ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  vista_pago.id_caja_cob=caja_cobrador .id_caja_cob and    fecha_pago between '$desde' and '$hasta'  and  status_pago='NOTA CREDITO' ");
				if($row=row($acceso)){
					$cant_nc=trim($row["cant"])+0;
					$total_nc_dia=trim($row["total_nc"])+0;
				}
				
					/*
					if($id_f=='2'){
						$cant_nc=0;
						$total_nc=0;
					}
					*/
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"NOTAS DE CREDITOS","L",0,"L");
					$this->Cell($w[1],5,$cant_nc,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($total_nc_dia+0, 2, ',', '.'),"R",0,"R");
/*
			$this->Ln();	
		//	echo "SELECT count(*) cant, sum(monto_pago) as total_nc FROM vista_pago  where   fecha_pago between '$desde' and '$hasta' and fecha_factura<'$fecha'  and  status_pago='NOTA CREDITO' <br> ";
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as total_nc FROM vista_pago  ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  vista_pago.id_caja_cob=caja_cobrador .id_caja_cob and    fecha_pago between '$desde' and '$hasta' and fecha_factura<'$fecha'  and  status_pago='NOTA CREDITO' ");
				if($row=row($acceso)){
					$cant_nc=trim($row["cant"])+0;
					$total_nc=trim($row["total_nc"])+0;
				}
				
					
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"NOTAS DE CREDITOS DE DIAS ANTERIORES","L",0,"L");
					$this->Cell($w[1],5,$cant_nc,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($total_nc+0, 2, ',', '.'),"R",0,"R");
*/
		$this->Ln();
		
			$total_facturado=$total_ingresos-$total_nc_dia;
			$this->SetX($right)	;
			
			$this->SetX($right)	;
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"TOTAL FACTURADO","TBL",0,"L");
					$this->Cell($w[1],5,'',"TB",0,"C");
					$this->Cell($w[2],5,number_format($total_facturado+0, 2, ',', '.'),"TBR",0,"R");
					
		/////////////////////////////////////////////////////////////////////////////////////////////
		
		$this->Ln(7);
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen por forma de pago')),"0",0,"L");
			
			$this->SetX($right)	;
			$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("forma de pago")),"TBL",0,"L");
				$this->Cell($w[1],5,strtoupper(_("CANT")),"TB",0,"C");
				$this->Cell($w[2],5,strtoupper(_("total"))." ","TBR",0,"R");
				
			$this->SetFont('Arial','',8);
			
			$this->SetX($right);
			
			$this->SetFont('Arial','',8);
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"SELECT *FROM tipo_pago order by id_tipo_pago");
			$suma_c=0;
			$suma_can=0;
			 
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
			
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago  where   fecha_pago between '$desde' and '$hasta' $consult and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'   and obser_pago<>'NOTA CREDITO'  ");
				$suma=0;
				if($row=row($acceso))
				{
					$monto_tp=trim($row["monto_tp"])+0;
					$cant=trim($row["cant"])+0;
					$suma_c+=$monto_tp;
					$suma_can+=$cant;
					
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,trim($dato[$k]["tipo_pago"]),"L",0,"L");
					$this->Cell($w[1],5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($monto_tp+0, 2, ',', '.'),"R",0,"R");
				}
			}
		
		$this->Ln();
			
			$this->SetX($right)	;
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"TOTAL FORMA DE PAGO","TBL",0,"L");
					$this->Cell($w[1],5,$suma_can,"TB",0,"C");
					$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TBR",0,"R");
			
		
		/////////////////////////////////////////////////////////////////////////////////////////////
		

		
		$right=120;
		$top=33;
			$this->SetXY($right,$top);
			
			
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen por servicios')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("servicio")),"TBL",0,"L");
				$this->Cell($w[1],5,strtoupper(_("cant")),"TB",0,"C");
				$this->Cell($w[2],5,strtoupper(_("costo")),"TB",0,"R");
				$this->Cell($w[1],5,strtoupper(_("desc")),"TB",0,"R");
				$this->Cell($w[2],5,strtoupper(_("total")),"TBR",0,"R");
		
			$this->SetFont('Arial','',8);
			$this->SetX($right);
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
	
				$suma_ct=0;
				$suma_dt=0;
				$suma_cant=0;
//PARA VENTAS		
			$tipo_serv=" and (tipo_serv='INSTALACION' OR tipo_serv='PUNTO ADICIONAL')" ;
			$acceso->objeto->ejecutarSql("SELECT  count(*) as cant FROM vista_pago_ser where    fecha_pago between '$desde' and '$hasta'  $consult $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
			$row=row($acceso);
			$cant=trim($row["cant"])+0;
		//	echo ":$cant:";
			if($cant>0){
	$dato_ts=lectura($acceso,"SELECT tipo_serv , count(*) cant_ts FROM servicios where status_serv='ACTIVO' $tipo_serv group by tipo_serv order by tipo_serv");
	
		 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO' ");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where     fecha_pago between '$desde' and '$hasta'  $consult and id_serv='$id_serv' $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
				
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
						$this->SetFont('Arial','',8);
						$this->Cell($w[0],5,strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"])))."","L",0,"L");
						$this->Cell($w[1],5,$cant,"0",0,"C");
						$this->Cell($w[2],5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[1],5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"R",0,"R");
					}
				}
			}
				$suma_ct+=$suma_c;
				$suma_dt+=$suma_d;
				$suma_cant+=$suma_can;
				
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
						$this->SetX($right);
						$this->SetFont('Arial','B',8);
						$this->Cell($w[0],5,strtoupper("total ventas"),"TBL",0,"L");
						$this->Cell($w[1],5,$suma_can,"TB",0,"C");
						$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[1],5,number_format($suma_d+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"TBR",0,"R");
		
			}//id existe
						


//PARA RECONEXION
			$tipo_serv=" and (tipo_serv='RECONEXION')" ;
			$acceso->objeto->ejecutarSql("SELECT  count(*) as cant FROM vista_pago_ser where    fecha_pago between '$desde' and '$hasta'  $consult $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
			$row=row($acceso);
			$cant=trim($row["cant"])+0;
		//	echo ":$cant:";
			if($cant>0){
	$dato_ts=lectura($acceso,"SELECT tipo_serv , count(*) cant_ts FROM servicios where status_serv='ACTIVO' $tipo_serv group by tipo_serv order by tipo_serv");
	
		 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO' ");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where     fecha_pago between '$desde' and '$hasta'  $consult and id_serv='$id_serv' $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
				
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
						$this->SetFont('Arial','',8);
						$this->Cell($w[0],5,strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"])))."","L",0,"L");
						$this->Cell($w[1],5,$cant,"0",0,"C");
						$this->Cell($w[2],5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[1],5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"R",0,"R");
					}
				}
			}
				$suma_ct+=$suma_c;
				$suma_dt+=$suma_d;
				$suma_cant+=$suma_can;
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
						$this->SetX($right);
						$this->SetFont('Arial','B',8);
						$this->Cell($w[0],5,strtoupper("total RECONEXION"),"TBL",0,"L");
						$this->Cell($w[1],5,$suma_can,"TB",0,"C");
						$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[1],5,number_format($suma_d+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"TBR",0,"R");
		
			}//id existe
						

//MENSUALIDADES
			$tipo_serv=" and (tipo_serv='OTROS' OR tipo_serv='MENSUALIDAD' )" ;
			$acceso->objeto->ejecutarSql("SELECT  count(*) as cant FROM vista_pago_ser where    fecha_pago between '$desde' and '$hasta'  $consult $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
			$row=row($acceso);
			$cant=trim($row["cant"])+0;
		//	echo ":$cant:";
			if($cant>0){
	$dato_ts=lectura($acceso,"SELECT tipo_serv , count(*) cant_ts FROM servicios where status_serv='ACTIVO' $tipo_serv group by tipo_serv order by tipo_serv");
	
		 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO' ");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where     fecha_pago between '$desde' and '$hasta'  $consult and id_serv='$id_serv' $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
				
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
						$this->SetFont('Arial','',8);
						$this->Cell($w[0],5,strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"])))."","L",0,"L");
						$this->Cell($w[1],5,$cant,"0",0,"C");
						$this->Cell($w[2],5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[1],5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"R",0,"R");
					}
				}
			}
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
				$suma_ct+=$suma_c;
				$suma_dt+=$suma_d;
				$suma_cant+=$suma_can;
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
						$this->SetX($right);
						$this->SetFont('Arial','B',8);
						$this->Cell($w[0],5,strtoupper("total SERVICIO MENSUAL"),"TBL",0,"L");
						$this->Cell($w[1],5,$suma_can,"TB",0,"C");
						$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[1],5,number_format($suma_d+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"TBR",0,"R");
		
			}//id existe
			
			
			
			$this->Ln();
			$this->SetX($right)	;
				
			$total=$suma_ct-$suma_dt;//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
						$this->SetX($right);
						$this->SetFont('Arial','B',9);
						$this->Cell($w[0],5,strtoupper("TOTAL"),"TBL",0,"L");
						$this->Cell($w[1],5,$suma_cant,"TB",0,"C");
						$this->Cell($w[2],5,number_format($suma_ct+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[1],5,number_format($suma_dt+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"TBR",0,"R");
						
						
						/*
						
						
			
			
		 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where    fecha_pago between '$desde' and '$hasta' $consult and id_serv='$id_serv'  and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
				
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
						$this->SetFont('Arial','',8);
						$this->Cell($w[0],5,strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"])))."","L",0,"L");
						$this->Cell($w[1],5,$cant,"0",0,"C");
						$this->Cell($w[2],5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[1],5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"R",0,"R");
					}
				}
			}
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
						$this->SetX($right);
						$this->SetFont('Arial','B',8);
						$this->Cell($w[0],5,strtoupper("total SERVICIOS"),"TBL",0,"L");
						$this->Cell($w[1],5,$suma_can,"TB",0,"C");
						$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[1],5,number_format($suma_d+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"TBR",0,"R");
		
		
						
						*/
						
						
			
		$right=120;
		$this->Ln(7);
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen DE cargos cobrados por meses')),"0",0,"L");
			
				
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell($w[0],6,strtoupper(_("MES")),"TBL",0,"L");
				$this->Cell($w[1],6,strtoupper(_("cant")),"TB",0,"C");
				$this->Cell($w[2],6,strtoupper(_("costo")),"TB",0,"R");
				$this->Cell($w[1],6,strtoupper(_("desc")),"TB",0,"R");
				$this->Cell($w[2],6,strtoupper(_("total")),"TBR",0,"R");
			//$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
			
			 $dato=lectura($acceso,"SELECT TO_CHAR(FECHA_INST,'YYYY-MM') as mes,count(*) FROM vista_pago_ser where  fecha_pago between '$desde' and '$hasta' $consult  and status_pago='PAGADO'  and obser_pago<>'NOTA CREDITO'  group by mes ORDER BY mes");
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$fecha_inst=trim($dato[$k]["mes"]);
				
				list($ano,$mes)=explode("-",$fecha_inst);
				$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $ano ));
				$desde1="$ano-$mes-01";
				$hasta2="$ano-$mes-$ult_dia_mes";
				$mes_l = formato_mes_com1($mes)." $ano";
				//echo $mes_l ;
				
				/*
		  $dato=lectura($acceso,"SELECT distinct fecha_inst  FROM vista_pago_ser where  fecha_pago between '$desde' and '$hasta' $consult  and status_pago='PAGADO'  and obser_pago<>'NOTA CREDITO' order by fecha_inst");
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$fecha_inst=trim($dato[$k]["fecha_inst"]);
				list($ano,$mes,$dia)=explode("-",$fecha_inst);
				$mes_l = formato_mes_com1($mes)." $ano";
				//echo $mes_l ;
				*/
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where fecha_pago between '$desde' and '$hasta' $consult and status_pago='PAGADO'  and fecha_inst between '$desde1' and '$hasta2'  and obser_pago<>'NOTA CREDITO'  ");
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
						$this->Cell($w[0],5,strtoupper($mes_l),"L",0,"L");
						$this->Cell($w[1],5,$cant,"0",0,"C");
						$this->Cell($w[2],5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[1],5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"R",0,"R");
						
					}
				}
			}
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
			//$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',9);
						$this->Cell($w[0],5,strtoupper("total"),"TBL",0,"L");
						$this->Cell($w[1],5,$suma_can,"TB",0,"C");
						$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[1],5,number_format($suma_d+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"TBR",0,"R");
		
	
		$this->Ln(10);
	
		$yy=$this->GetY();
		if($yy<140 && $this->PageNo()=='1'){
			$this->SetY(140);
		}
		//$this->SetY(142);
		$right=10;		
		
	//	$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',8);
			
		$this->SetX($right);
		$this->Cell(40,6,strtoupper(_('detalles de las estaciones de trabajos')),"0",0,"L");
		$this->Ln(5);
		$w=$this->TituloCampos();
		$acceso->objeto->ejecutarSql("SELECT id_cierre,nombre_est,reporte_z,fecha_cierre,hora_cierre,monto_total,obser_cierre from estacion_trabajo,cirre_diario_et where estacion_trabajo.id_est=cirre_diario_et.id_est and fecha_cierre between '$desde' and '$hasta'  $consult order by fecha_cierre, nombre_est ");

		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX($right);
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
		$this->SetX($right);
		$this->Cell(array_sum($w),5,'','T');
		
		
		
		
		$this->Ln(2);
		
		
	//	$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',8);
			
		
		$this->SetX($right);
		$this->Cell(40,6,strtoupper(_('detalles de los puntos de cobros')),"0",0,"L");
		$this->Ln(5);
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,45,45,45,20,20,20,20,25);
		$header=array(strtoupper(_('nro')),strtoupper(_('caja')),strtoupper(_('cobrador')),strtoupper(_('estacion de trabajo')),strtoupper(_('f. PAGO')),strtoupper(_('f. Cierre')),strtoupper(_('hora a.')),strtoupper(_('hora c.')),strtoupper(_('total')));
		$this->SetFont('Arial','B',8);
		$this->SetX($right);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		
	//	$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_caja where  fecha_caja  between '$desde' and '$hasta' and status_caja_cob='CERRADA'  $consult order by fecha_caja,nombre_caja ");

		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX($right);
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
		$this->SetX($right);
		$this->Cell(array_sum($w),5,'','T');
		$this->Ln();
		
		
		
		
		
		
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function ordenes($acceso,$desde,$hasta,$id_f)
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
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden'  and $fecha_orden between '$desde' and '$hasta' ");
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
							//echo "SELECT count(*) as cant FROM vista_orden where id_det_orden='$id_det_orden'  and $fecha_orden between '$desde' and '$hasta' ";
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_franq='$id_franq' and id_det_orden='$id_det_orden'  and $fecha_orden between '$desde' and '$hasta' ");
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
		*/
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
	
	
	
	function detalle_factura($acceso,$desde,$hasta,$id_f)
	{
		$this->SetDrawColor(225,240,255);
		$tipo_caja=verCajaPrincipal($acceso);
		//$fecha=date("Y-m-d");
		
		
		$right=10;
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
			$consult_fw=" where id_franq='$id_f'";
		}
		else{
		//	echo ":$id_f:";
			$consult_g=" and  id_franq='0'";
		}
	/*
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=15;
		$top=40;
			$this->SetXY($right,$top);
		
		*/
		$this->SetFont('Arial','BIU',8);
		
		//$this->Ln(10);
		$this->SetX($right);
		$this->Cell(40,6,strtoupper(_('detalles de clientes facturados')),"0",0,"L");
		$this->Ln();
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,18,42,18,20,73);
		$header=array(strtoupper(_('nro')),strtoupper(_('ABONADO')),strtoupper(_('factura')),strtoupper(_('Cliente')),strtoupper(_('Monto')),strtoupper(_('STATUS')),strtoupper(_('detalle Forma Pago')));
		$this->SetFont('Arial','B',7);
		$this->SetX($right);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		$acceso->objeto->ejecutarSql("SELECT vista_pago_cont.id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont where  fecha_pago between '$desde' and '$hasta'  $consult order by nro_factura");
		
		$this->SetFont('Arial','',7);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$cable=conexion();
		$cable1=conexion();
		while ($row=row($acceso))
		{
			$id_pago=trim($row["id_pago"]);
			//echo "<br>SELECT abrev_banco,tipo_pago,numero,abrev_tp, monto_tp FROM detalle_tipopago,tipo_pago,banco WHERE detalle_tipopago.id_tipo_pago=tipo_pago.id_tipo_pago and detalle_tipopago.banco=banco.banco and id_pago='$id_pago' ";
				$cable->objeto->ejecutarSql("SELECT * FROM detalle_tipopago,tipo_pago WHERE detalle_tipopago.id_tipo_pago=tipo_pago.id_tipo_pago and id_pago='$id_pago' ");
				$banco='';
				while($row1=row($cable)){
					$abrevia=trim($row1['abrev_banco']);
					$ban=trim($row1['banco']);
					$tipo_pago=trim($row1['abrev_tp']);
					$numero=trim($row1['numero']);
					$monto_tp=trim($row1['monto_tp']);
					number_format($cargo+0, 2, ',', '.');
					$banco= $banco."$tipo_pago, $monto_tp  $ban $numero ;  ";
				}
				
				$this->SetX($right);
				$this->Cell($w[0],5,$cont,"LR",0,"C",$fill);
				$this->Cell($w[1],5,utf8_decode(trim($row["nro_contrato"])),"LR",0,"J",$fill);
				$this->Cell($w[2],5,utf8_decode(trim($row["nro_factura"])),"LR",0,"J",$fill);
				$this->Cell($w[3],5,substr(utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])),0,30),"LR",0,"J",$fill);
				$this->Cell($w[4],5,number_format(trim($row["monto_pago"])+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[5],5,utf8_decode(trim($row["status_pago"])),"LR",0,"J",$fill);
				$this->Cell($w[6],5,"$banco","LR",0,"J",$fill);
				
				$this->Ln();
				$fill=!$fill;
				$cont++;
		
		}
		$this->SetX($right);
		$this->Cell(array_sum($w),5,'','T');
	}
	
	function otras_franquicias($acceso,$desde,$hasta,$id_f)
	{
		if($fecha==""){
			$fecha=date("Y-m-d");
		}
		$fecha=formatfecha($fecha);
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
			$consult_fw=" where id_franq='$id_f'";
		}
		
		$this->SetFont('Arial','BIU',9);

		$right=10;

		$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',8);
		$w=array(40,30,30,30,30,30,30,30,30,20,20,20,20,20,20,20,20);	

			$this->Ln(7);
		$this->SetX($right);
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,6,strtoupper(_('resumen por franquiciaS')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell($w[0],6,strtoupper(_("FRANQUICIA")),"TBL",0,"L");
				$dato_f=lectura($acceso,"SELECT *FROM franquicia $consult_fw order by id_franq");
				
				$dato=lectura($acceso,"SELECT *FROM franquicia order by id_franq");
				$dato1=lectura($acceso,"SELECT *FROM franquicia order by id_franq");
				for($j=0;$j<count($dato);$j++){
					$nombre_franq=trim($dato[$j]["nombre_franq"]);
					$this->Cell($w[$j+1],6,$nombre_franq,"TB",0,"R");
				}
			//if($id_f=='0'){
				$this->Cell($w[$j],6,strtoupper(_("total"))." ","TBR",0,"R");
			//}	
			
			$this->SetFont('Arial','',7);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',10);
			$this->SetX($right);
			//$this->Cell(45,1,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
			for($j=0;$j<count($dato);$j++){
				$nombre_franq=trim($dato[$j]["nombre_franq"]);
				$id_franq=trim($dato[$j]["id_franq"]);
				$this->Ln();
					
					$this->SetX($right)	;
					$this->SetFont('Arial','B',7);
					$this->Cell($w[0],5,$nombre_franq,"L",0,"L");
				
					for($k=0;$k<count($dato);$k++){
					$id_franq1=trim($dato[$k]["id_franq"]);
				
							if($id_f==$id_franq1 || $id_f==$id_franq || $id_f=='0'){
				
				
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM vista_pago,caja_cobrador,caja ,vista_contrato_dir where
								vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								vista_pago.id_contrato=vista_contrato_dir.id_contrato and 
								caja.id_franq='$id_franq'  and 
								fecha_pago between '$desde' and '$hasta' and 
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
						$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago, count(*) as cant FROM vista_pago ,caja_cobrador,caja where vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and caja_cobrador.id_caja=caja.id_caja and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO' and id_franq='$id_franq' ");
						$row=row($acceso);
						$monto_pago_t=trim($row["monto_pago"])+0;
						$this->SetFont('Arial','B',7);
						$this->Cell($w[$j+1],5,number_format($monto_pago_t+0, 2, ',', '.'),"R",0,"R");

					}
					else{
					$this->Cell($w[$j+1],5,'',"R",0,"R");
					}
					
			}
			
		$this->Ln();
			
			$this->SetFont('Arial','',10);
			$this->SetX($right);
			//$this->Cell(45,1,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");

					$this->SetX($right)	;
					$this->SetFont('Arial','B',7);
					$this->Cell($w[0],5,"TOTAL","TBL",0,"L");
					$suma=0;
			for($j=0;$j<count($dato);$j++){
				$id_franq=trim($dato[$j]["id_franq"]);
					if($id_f==$id_franq || $id_f=='0'){
					
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM vista_pago,caja_cobrador,caja ,vista_contrato_dir where
								vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								vista_pago.id_contrato=vista_contrato_dir.id_contrato and 
								fecha_pago between '$desde' and '$hasta' and 
								status_pago='PAGADO' and 
								vista_contrato_dir.id_franq='$id_franq'");
								$row=row($acceso);
								$monto_pago_AMC=trim($row["monto_pago"])+0;
								$suma+=$monto_pago_AMC;
									
								$this->SetFont('Arial','B',7);
								$this->Cell($w[$j+1],5,number_format($monto_pago_AMC+0, 2, ',', '.'),"TB",0,"R");

					}
					else{
								$this->Cell($w[$j+1],5,'',"TB",0,"R");
					}
					
					//$this->Cell($w[$j+1],5,'',"TBR",0,"R");
			}		
				$this->Cell($w[$j+1],5,number_format($suma+0, 2, ',', '.'),"TBR",0,"R");
		
		
		
		
		$dato_franq=lectura($acceso,"SELECT * FROM franquicia $consult_fw	 order by id_franq ");
		$dato=lectura($acceso,"SELECT * FROM franquicia 	 order by id_franq ");
		$suma_s=array();
			$suma=0;
		for($k=0;$k<count($dato_franq);$k++){
			$id_franq=trim($dato_franq[$k]["id_franq"]);
			$nombre_franq=trim($dato_franq[$k]["nombre_franq"]);
			
			
			for($i=0;$i<count($dato);$i++){
				$id_franq1=trim($dato[$i]["id_franq"]);
				$nombre_franq1=trim($dato[$i]["nombre_franq"]);
				
				if($id_franq!=$id_franq1){
						
					$cable=conexion();
					
					$acceso->objeto->ejecutarSql("SELECT vista_pago_cont.id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont,vista_contrato_dir where vista_pago_cont.id_contrato=vista_contrato_dir.id_contrato and  fecha_pago between '$desde' and '$hasta' and vista_pago_cont.id_franq='$id_franq' and vista_contrato_dir.id_franq='$id_franq1' order by nro_factura");
					
					$this->SetFont('Arial','',7);
					$cont=1;
					$this->SetFillColor(249,249,249);
					$this->SetTextColor(0);
					
					$ca[0]='';
					$tipo_pago[0]='';
					$y=0;
					$existe=true;
					while ($row=row($acceso))
					{
						if($existe==true){
								$existe=false;	
							$this->SetFont('Arial','BIU',9);
							
							$this->Ln(10);
							$this->SetX(15);
							$this->Cell(40,6,strtoupper(_("detalles de los clientes de $nombre_franq1 cobrados por $nombre_franq")),"0",0,"L");
							$this->Ln();
							
							$this->SetFillColor(244,249,255);
							$this->SetDrawColor(225,240,255);
							$this->SetLineWidth(.2);
							//dimenciones de cada campo
							$w=array(10,18,18,18,18,50,18,18,18,18,18,18,18);
							$header=array(strtoupper(_('nro')),strtoupper(_('contrato')),strtoupper(_('factura')),strtoupper(_('control')),strtoupper(_('C.I./RIF')),strtoupper(_('Cliente')),strtoupper(_('base I.')),strtoupper(_('Desc')),strtoupper(_('IVA')),strtoupper(_('Ret. IVA')),strtoupper(_('Ret. ISLR')),strtoupper(_('TOTAL')),strtoupper(_('STATUS')));
							$this->SetFont('Arial','B',7);
							$this->SetX(10);
							for($ki=0;$ki<count($header);$ki++)
								$this->Cell($w[$ki],7,$header[$ki],1,0,'J',1);
							$this->Ln();
							
						}
						$this->SetFillColor(249,249,249);
					$this->SetTextColor(0);
					$this->SetFont('Arial','',7);
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
			}
			
		}
		
		if($id_f!='0'){
		
		$dato=lectura($acceso,"SELECT * FROM franquicia $consult_fw	 order by id_franq ");
		$dato_franq=lectura($acceso,"SELECT * FROM franquicia 	 order by id_franq ");
		$suma_s=array();
			$suma=0;
		for($k=0;$k<count($dato_franq);$k++){
			$id_franq=trim($dato_franq[$k]["id_franq"]);
			$nombre_franq=trim($dato_franq[$k]["nombre_franq"]);
			
			
			for($i=0;$i<count($dato);$i++){
				$id_franq1=trim($dato[$i]["id_franq"]);
				$nombre_franq1=trim($dato[$i]["nombre_franq"]);
				
				if($id_franq!=$id_franq1){
						
					$this->SetFont('Arial','BIU',9);
					
					$this->Ln(10);
					$this->SetX(15);
					$this->Cell(40,6,strtoupper(_("detalles de los clientes de $nombre_franq1 cobrados por $nombre_franq")),"0",0,"L");
					$this->Ln();
					
					$this->SetFillColor(244,249,255);
					$this->SetDrawColor(225,240,255);
					$this->SetLineWidth(.2);
					//dimenciones de cada campo
					$w=array(10,18,32,17,50,18,17,16,18);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abo.')),"ZONA",strtoupper(_('C.I./RIF')),strtoupper(_('Cliente')),strtoupper(_('factura')),strtoupper(_('control')),strtoupper(_('TOTAL')),strtoupper(_('STATUS')));
					$this->SetFont('Arial','B',7);
					$this->SetX(10);
					for($ki=0;$ki<count($header);$ki++)
						$this->Cell($w[$ki],7,$header[$ki],1,0,'J',1);
					$this->Ln();
					
					$cable=conexion();
					
					$acceso->objeto->ejecutarSql("SELECT vista_pago_cont.id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont,vista_contrato_dir where vista_pago_cont.id_contrato=vista_contrato_dir.id_contrato and  fecha_pago between '$desde' and '$hasta' and vista_pago_cont.id_franq='$id_franq' and vista_contrato_dir.id_franq='$id_franq1' order by nro_factura");
					
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
			}
			
		}
		}//if_f
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
//$pdf->AddPage('L','letter');
$pdf->otras_franquicias($acceso,$desde,$hasta,$id_f);

//$pdf->detalle_factura($acceso,$desde,$hasta,$id_f);
//$pdf->ordenes($acceso,$desde,$hasta,$id_f);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 