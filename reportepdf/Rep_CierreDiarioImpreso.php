<?php
require('../include/FPDF/fpdf.php');

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];


$fecha=$_GET['fecha'];
if($fecha==""){
			$fecha=date("Y-m-d");
		}
		else{
			$fecha=formatfecha($fecha);
		}
		
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
		
		$this->Image("../imagenes/$logo",10,5,$ancho_logo);
		$this->SetFont('Arial','',12);
		$this->SetXY(50,5);
		$this->MultiCell(190,5,nombre_empresa(),'0','L');
	//	$this->MultiCell(190,5,"CABLE, C.A.",'0','L');
		$this->SetFont('Arial','',10);
		$this->SetX(50)	;
		$this->MultiCell(190,5,strtoupper(_(tipo_serv())),'0','L');
		//$this->Ln();
	}
	
	
	//Titulo del reporte
	function Titulo($titulo_cierre)
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->SetX(50)	;
		$this->MultiCell(190,7,strtoupper(_("$titulo_cierre")),'0','L');
		
		$this->SetFont('Arial','B',8);
		$this->SetXY(170,5);
		$this->Cell(30,5,strtoupper(_('fecha Impresion')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(20,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("H:i:s"),0,0,'L');
		$this->Ln();		
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$right=10;
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,70,25,20,20,25,80);
		$header=array(strtoupper(_('nro')),strtoupper(_('Estacion de trabajo')),strtoupper(_('reporte z')),strtoupper(_('fecha')),strtoupper(_('hora')),strtoupper(_('TOTAL')),strtoupper(_('OBSERVACION')));
		$this->SetFont('Arial','B',8);
		$this->SetX($right);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$fecha,$id_f)
	{
		$this->SetDrawColor(225,240,255);
		$tipo_caja=verCajaPrincipal($acceso);
		//$fecha=date("Y-m-d");
		
		if($fecha==""){
			$fecha=date("Y-m-d");
		}
		else{
			$fecha=formatfecha($fecha);
		}
		$desde=date("Y-m-01");
		$hasta=$fecha;
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
	//	echo "SELECT *FROM cirre_diario where fecha_cierre='$fecha' and id_franq='$id_f'";
	
		$acceso->objeto->ejecutarSql("SELECT *FROM cirre_diario where fecha_cierre='$fecha' and id_franq='$id_f'");
		if($row=row($acceso))
		{
			$monto_total=utf8_d(trim($row["monto_total"]));
			$obser_cierre=utf8_d(trim($row["obser_cierre"]));
			$hora_cierre=utf8_d(trim($row["hora_cierre"]));
			
			
	
		//	$total_acumulado=$monto_total;
		//	$parcial=calMontoCDCA($acceso,$fecha,$id_f);
		//	$acumulado=calMontoAcumulado($acceso,$fecha,$id_f);
		}
			$fecha_cierre=formatofecha($fecha);
			$this->SetX(170)	;
			$this->SetFont('Arial','B',8);
			$this->Cell(30,6,strtoupper(_('fecha Cierre')).":","0",0,"L");
			
			$this->SetFont('Arial','',8);
			$this->Cell(20,6,$fecha_cierre,"0",0,"L");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(12,5,strtoupper(_('hora')).":",0,0,'L');
			$this->SetFont('Arial','',8);
			$this->Cell(18,5,$hora_cierre,0,0,'L');
			$this->Ln(6);
			
			
			
			$this->Ln();
			$this->SetX($right);
			$this->SetFont('Arial','B',9);
			$this->Cell(21,5,strtoupper(_('observacion')).":","0",0,"L");
			
			
			$this->SetFont('Arial','',9);
			$this->SetX(50);
			$this->MultiCell(150,5,strtoupper(utf8_decode($obser_cierre)),'0','J');
			
				
		
				
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
				
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as excento FROM pagos ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva=0 and fecha_pago='$fecha'   AND status_pago='PAGADO' ");
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
				// echo "SELECT count(*) cant, sum(base_imp) as base_imp, sum(monto_iva) as monto_iva FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva>0 and fecha_pago='$fecha' ";
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp) as base_imp, sum(monto_iva) as monto_iva FROM pagos  ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  pagos.id_caja_cob=caja_cobrador .id_caja_cob and   fecha_pago='$fecha'  AND status_pago='PAGADO' ");
			 
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
			//echo "SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  where   fecha_pago='$fecha' and  status_pago='NOTA CREDITO' ";
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  pagos.id_caja_cob=caja_cobrador .id_caja_cob and    fecha_pago='$fecha' and fecha_factura='$fecha'  and  status_pago='NOTA CREDITO' ");
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
					$this->Cell($w[0],5,"NOTAS DE CREDITOS DEL DÍA","L",0,"L");
					$this->Cell($w[1],5,$cant_nc,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($total_nc_dia+0, 2, ',', '.'),"R",0,"R");

			$this->Ln();	
		//	echo "SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  where   fecha_pago='$fecha' and fecha_factura<'$fecha'  and  status_pago='NOTA CREDITO' <br> ";
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  pagos.id_caja_cob=caja_cobrador .id_caja_cob and    fecha_pago='$fecha' and fecha_factura<'$fecha'  and  status_pago='NOTA CREDITO' ");
				if($row=row($acceso)){
					$cant_nc=trim($row["cant"])+0;
					$total_nc=trim($row["total_nc"])+0;
				}
				
					/*
					if($id_f=='2'){
						$cant_nc=0;
						$total_nc=0;
					}
					*/
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"NOTAS DE CREDITOS DE DIAS ANTERIORES","L",0,"L");
					$this->Cell($w[1],5,$cant_nc,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($total_nc+0, 2, ',', '.'),"R",0,"R");

		$this->Ln();
		
			$total_facturado=$total_ingresos-$total_nc-$total_nc_dia;
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
			
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago  where   fecha_pago='$fecha' $consult and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'   and obser_pago<>'NOTA CREDITO'  ");
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
			$this->Cell($right,5,strtoupper(_('resumen por servicios / paquetes')),"0",0,"L");
			
			$this->SetX($right)	;
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("servicios / paquetes")),"TBL",0,"L");
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
			$acceso->objeto->ejecutarSql("SELECT  count(*) as cant FROM vista_pago_ser where   fecha_pago = '$fecha' $consult $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
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
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where    fecha_pago = '$fecha' $consult and id_serv='$id_serv' $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
				
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
			$acceso->objeto->ejecutarSql("SELECT  count(*) as cant FROM vista_pago_ser where   fecha_pago = '$fecha' $consult $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
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
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where    fecha_pago = '$fecha' $consult and id_serv='$id_serv' $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
				
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
			$acceso->objeto->ejecutarSql("SELECT  count(*) as cant FROM vista_pago_ser where   fecha_pago = '$fecha' $consult $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
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
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where    fecha_pago = '$fecha' $consult and id_serv='$id_serv' $tipo_serv and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
				
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
		//	echo "SELECT TO_CHAR(FECHA_INST,'YYYY-MM') as mes,count(*) FROM vista_pago_ser where  fecha_pago='$fecha' $consult  and status_pago='PAGADO'  and obser_pago<>'NOTA CREDITO'  group by mes ORDER BY mes ";
		  $dato=lectura($acceso,"SELECT TO_CHAR(FECHA_INST,'YYYY-MM') as mes,count(*) FROM vista_pago_ser where  fecha_pago='$fecha' $consult  and status_pago='PAGADO'  and obser_pago<>'NOTA CREDITO'  group by mes ORDER BY mes");
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$fecha_inst=trim($dato[$k]["mes"]);
				
				list($ano,$mes)=explode("-",$fecha_inst);
				$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $ano ));
				$desde="$ano-$mes-01";
				$hasta="$ano-$mes-$ult_dia_mes";
				$mes_l = formato_mes_com1($mes)." $ano";
				//echo $mes_l ;
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where fecha_pago='$fecha' $consult and status_pago='PAGADO' and fecha_inst = TO_CHAR(FECHA_INST,'YYYY-MM')  and obser_pago<>'NOTA CREDITO'  ");
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
		if($yy<140){
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
		$acceso->objeto->ejecutarSql("SELECT id_cierre,nombre_est,reporte_z,fecha_cierre,hora_cierre,monto_total,obser_cierre from estacion_trabajo,cirre_diario_et where estacion_trabajo.id_est=cirre_diario_et.id_est and fecha_cierre='$fecha'  $consult ");

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
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_caja where  fecha_caja ='$fecha' and status_caja_cob='CERRADA'  $consult ");

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
		
		
		

			
						/*
							
							
//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$right=10;
	
			$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',8);
			$w=array(20,56,56,56,56,56,20);	
			
			$this->Ln(2);
			
			
			
			
		$this->SetX($right);
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,6,strtoupper(_('resumen por franquiciaS')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell($w[0],6,strtoupper(_("FRANQUICIA")),"1",0,"L");
				$dato_f=lectura($acceso,"SELECT *FROM franquicia $consult_fw order by id_franq");
				
				$dato=lectura($acceso,"SELECT *FROM franquicia order by id_franq");
				$dato1=lectura($acceso,"SELECT *FROM franquicia order by id_franq");
				for($j=0;$j<count($dato);$j++){
					$nombre_franq=trim($dato[$j]["nombre_franq"]);
					$this->Cell($w[$j+1],6,$nombre_franq,"1",0,"R");
				}
			//if($id_f=='0'){
				$this->Cell(20,6,strtoupper(_("total"))." ","1",0,"R");
		//	}	
			
			$this->SetFont('Arial','',7);
			$this->Ln();
			$tama=14;
			$this->Cell($w[0],4,strtoupper(_("detalle")),"TBL",0,"L");
			for($j=0;$j<count($dato);$j++){
					$this->Cell($tama,4,"Efect","TB",0,"R");
					$this->Cell($tama,4,"Tarjeta","TB",0,"R");
					$this->Cell($tama,4,"Cheque","TB",0,"R");
					$this->Cell($tama,4,"Total","TBR",0,"R");
			}
			$this->Cell(20,4,strtoupper(_(""))." ","R",0,"R");
			
			
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
								
								

								$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago,vista_contrato_dir where  fecha_pago='$fecha' and (id_tipo_pago='TPA00001' or id_tipo_pago='TPA00003' or id_tipo_pago='TPA00004' ) and status_pago='PAGADO' and  vista_tipopago.id_franq='$id_franq' and  vista_tipopago.id_contrato=vista_contrato_dir.id_contrato  and 
								vista_contrato_dir.id_franq='$id_franq1' ");
								$row=row($acceso);
								$monto_tp=trim($row["monto_tp"])+0;
								$this->SetFont('Arial','',6);
								$this->Cell($tama,5,number_format($monto_tp+0, 2, ',', '.'),"0",0,"R");
								
								

								$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago,vista_contrato_dir where  fecha_pago='$fecha' and (id_tipo_pago='TPA00005' or id_tipo_pago='TPA00007') and status_pago='PAGADO' and  vista_tipopago.id_franq='$id_franq' and  vista_tipopago.id_contrato=vista_contrato_dir.id_contrato  and 
								vista_contrato_dir.id_franq='$id_franq1' ");
								$row=row($acceso);
								$monto_tp=trim($row["monto_tp"])+0;
								$this->Cell($tama,5,number_format($monto_tp+0, 2, ',', '.'),"0",0,"R");
								
								$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago,vista_contrato_dir where  fecha_pago='$fecha' and (id_tipo_pago='TPA00008') and status_pago='PAGADO' and  vista_tipopago.id_franq='$id_franq' and  vista_tipopago.id_contrato=vista_contrato_dir.id_contrato  and 
								vista_contrato_dir.id_franq='$id_franq1' ");
								$row=row($acceso);
								$monto_tp=trim($row["monto_tp"])+0;
								$this->Cell($tama,5,number_format($monto_tp+0, 2, ',', '.'),"0",0,"R");
								
								
								
								
					
									
								$this->SetFont('Arial','B',6);
								$this->Cell($tama,5,number_format($monto_pago_AMC+0, 2, ',', '.'),"R",0,"R");

								$this->SetFont('Arial','',7);
								
							}
								else{
										$this->Cell($w[$j+1],5,'',"R",0,"R");
								}
					}
					if($id_f==$id_franq || $id_f=='0'){
						$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago, count(*) as cant FROM pagos ,caja_cobrador,caja where pagos.id_caja_cob=caja_cobrador.id_caja_cob and caja_cobrador.id_caja=caja.id_caja and fecha_pago='$fecha' and status_pago='PAGADO' and id_franq='$id_franq' ");
						$row=row($acceso);
						$monto_pago_t=trim($row["monto_pago"])+0;
						$this->SetFont('Arial','B',7);
						$this->Cell($w[0],5,number_format($monto_pago_t+0, 2, ',', '.'),"R",0,"R");

					}
					else{
					$this->Cell($w[0],5,'',"R",0,"R");
					}
			}
			
		$this->Ln();
			
			$this->SetFont('Arial','',10);
			$this->SetX($right);
			//$this->Cell(45,1,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
				
					
					$this->SetX($right)	;
					$this->SetFont('Arial','B',7);
					$this->Cell($w[0],5,"TOTAL","TBL",0,"L");
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
								
								
								
								$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago,vista_contrato_dir where  fecha_pago='$fecha' and (id_tipo_pago='TPA00001' or id_tipo_pago='TPA00003' or id_tipo_pago='TPA00004' ) and status_pago='PAGADO'  and  vista_tipopago.id_contrato=vista_contrato_dir.id_contrato  and 
								vista_contrato_dir.id_franq='$id_franq' ");
								$row=row($acceso);
								$monto_tp=trim($row["monto_tp"])+0;
								$this->SetFont('Arial','',6);
								$this->Cell($tama,5,number_format($monto_tp+0, 2, ',', '.'),"TB",0,"R");
								
								

								$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago,vista_contrato_dir where  fecha_pago='$fecha' and (id_tipo_pago='TPA00005' or id_tipo_pago='TPA00007') and status_pago='PAGADO' and  vista_tipopago.id_contrato=vista_contrato_dir.id_contrato  and 
								vista_contrato_dir.id_franq='$id_franq' ");
								$row=row($acceso);
								$monto_tp=trim($row["monto_tp"])+0;
								$this->Cell($tama,5,number_format($monto_tp+0, 2, ',', '.'),"TB",0,"R");
								
								$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago,vista_contrato_dir where  fecha_pago='$fecha' and (id_tipo_pago='TPA00008') and status_pago='PAGADO' and  vista_tipopago.id_franq='$id_franq' and  vista_tipopago.id_contrato=vista_contrato_dir.id_contrato  and 
								vista_contrato_dir.id_franq='$id_franq' ");
								$row=row($acceso);
								$monto_tp=trim($row["monto_tp"])+0;
								$this->Cell($tama,5,number_format($monto_tp+0, 2, ',', '.'),"TB",0,"R");
								
								
								
								
								
								
									
								$this->SetFont('Arial','B',7);
								$this->Cell($tama,5,number_format($monto_pago_AMC+0, 2, ',', '.'),"TB",0,"R");

					}
					else{
								$this->Cell($w[$j+1],5,'',"TB",0,"R");
					}
					//$this->Cell($w[$j+1],5,'',"TBR",0,"R");
			}		
				$this->Cell($w[0],5,'',"TBR",0,"R");
			$this->Ln(7);	
			
			
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		
	
		
		*/
		
		/*
		
		}
		else{
			$this->Ln();
			$this->Ln();
			
			$this->SetFont('Arial','',12);
			$this->MultiCell(195,5,strtoupper(_("error,  no existe el cierre diario para esta fecha")),'0','C');
		}
		
		*/
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function ordenes($acceso,$fecha,$id_f)
	{
		$fecha_dia=$fecha;
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
			$consult_fw=" where id_franq='$id_f'";
		}
		else{
		//	echo ":$id_f:";
			$consult_g=" and  id_franq='0'";
		}
		
		if($fecha_dia==""){
			$fecha=date("Y-m-d");
			//c
		}
		else{
			$fecha=formatfecha($fecha_dia);
		}
		$right=10;
			
		//$this->Ln(2);
			
			
			
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,6,strtoupper(_('RESUMEN DE ABONADOS POR FRANQUICIAS / STATUS ')),"0",0,"L");
			$right=10;
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				
		
		if($id_f!='0'){
			$consult=" where id_franq='$id_f'";
		}
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(30,67,15,15,13,13,13,18);
		//$header=array(strtoupper(_('nro franquicia')),strtoupper(_('nombre franquicia')),strtoupper(_('ac')),strtoupper(_('co')),strtoupper(_('si')),strtoupper(_('su')),strtoupper(_('ex')),strtoupper(_('total')));
		$this->SetFont('Arial','B',8);
		$this->SetX($right);
		$this->Cell(50,7,strtoupper(_('nombre franquicia')),1,0,'J',1);
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
					$nombrestatus=trim($dato[$j]["nombrestatus"]);
					$abrev=strtoupper(trim($dato[$j]["abrev"]));
					$nombrest=str_replace(" ",'_',$nombrestatus);

					$ac=$ac." (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_franq=franquicia.id_franq and status_contrato='$nombrestatus') as $abrev ,";
					
					$this->Cell(20,7,strtoupper($abrev),1,0,'C',1);
				}
				$this->Cell(20,7,strtoupper(_('total')),1,0,'J',1);	
		
$total=" (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_franq=franquicia.id_franq) as total";

$where="
select id_franq, nombre_franq, $ac $total from franquicia $consult
";

		$this->Ln();
		
		
		$w=array(30,67,15,15,13,13,13,18);
		
	//	echo ":$where:";
		$acceso->objeto->ejecutarSql($where);
			
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX($right);
			$this->Cell(50,6,utf8_d(trim($row["nombre_franq"])),"LR",0,"J",$fill);
			
				for($j=0;$j<count($dato);$j++){
					$abrev=strtolower(trim($dato[$j]["abrev"]));
					$this->Cell(20,6, utf8_d(trim($row["$abrev"])),"LR",0,"C",$fill);
				}
			
			
			$this->Cell(20,6, utf8_d(trim($row["total"])),"LR",0,"C",$fill);
			
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX($right);
		$this->Cell(250,5,'','T');
		
	//	$this->Ln();
		
		

		///////////////////////////////////////////////////////
		
		if($id_f=='0'){
		
		$this->SetFont('Arial','B',8);
		$this->SetX($right);
		//$this->Cell(50,7,strtoupper(_('TOTAL')),1,0,'J',1);
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
					$nombrestatus=trim($dato[$j]["nombrestatus"]);
					$abrev=strtoupper(trim($dato[$j]["abrev"]));
					$nombrest=str_replace(" ",'_',$nombrestatus);

					$ac=$ac." (select count(*) from contrato where  status_contrato='$nombrestatus') as $abrev ,";
					
					//$this->Cell(20,7,strtoupper($abrev),1,0,'C',1);
				}
			//	$this->Cell(20,7,strtoupper(_('total')),1,0,'J',1);	
		
$total=" (select count(*) from contrato) as total";

$where="
select id_franq, nombre_franq, $ac $total from franquicia LIMIT 1
";

	//	$this->Ln();

		$w=array(30,67,15,15,13,13,13,18);
		
		//echo ":$where:";
		$acceso->objeto->ejecutarSql($where);
			
		$this->SetFont('Arial','B',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX($right);
			$this->Cell(50,6,"TOTAL","LR",0,"J",$fill);
			
				for($j=0;$j<count($dato);$j++){
					$abrev=strtolower(trim($dato[$j]["abrev"]));
					$this->Cell(20,6, utf8_d(trim($row["$abrev"])),"LR",0,"C",$fill);
				}
			
			
			$this->Cell(20,6, utf8_d(trim($row["total"])),"LR",0,"C",$fill);
			
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX($right);
		$this->Cell(250,5,'','T');
		
		}
		
		
		
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_w=" and  estado.id_franq='$id_f'";
		}
		$this->Ln(5);
		$this->SetFont('Arial','BIU',8);
		$this->Cell($right,6,strtoupper(_('deuda de abonados por STATUS ')),"0",0,"L");
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(0,22,15,12,17,12,17,12,17,12,17,12,17,12,17,20,25);
		$this->SetFont('Arial','B',8);
		$this->SetX($right);
		//$this->Cell($w[0],5,'',"LRT",0,'C',1);
		$this->Cell($w[1],4,strtoupper(_("sTATUS")),"LRT",0,'C',1);
		$this->Cell($w[2],4,strtoupper(_("AL DIA")),1,0,'C',1);
		$this->Cell($w[3]+$w[4],4,strtoupper(_("30 dias")),1,0,'C',1);
		$this->Cell($w[5]+$w[6],4,strtoupper(_("60 dias")),1,0,'C',1);
		$this->Cell($w[7]+$w[8],4,strtoupper(_("90 dias")),1,0,'C',1);
		$this->Cell($w[9]+$w[10],4,strtoupper(_("120 dias")),1,0,'C',1);
		$this->Cell($w[11]+$w[12],4,strtoupper(_("150 dias")),1,0,'C',1);
		$this->Cell($w[13]+$w[14],4,strtoupper(_("+150 dias")),1,0,'C',1);
		$this->Cell($w[15],4,strtoupper(_("T ABO.")),"LRT",0,'C',1);
		$this->Cell($w[16],4,strtoupper(_("t. MONTO")),"LRT",0,'C',1);
		
		$this->Ln();
		$this->SetX($right);
		//$this->Cell($w[0],4,strtoupper(_("")),"LRB",0,'C',1);
		$this->Cell($w[1],4,strtoupper(_("")),"LRB",0,'C',1);
		$this->Cell($w[2],4,strtoupper(_("")),"LRB",0,'C',1);
		$this->Cell($w[3],4,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[4],4,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[5],4,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[6],4,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[7],4,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[8],4,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[9],4,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[10],4,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[11],4,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[12],4,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[13],4,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[14],4,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[15],4,strtoupper(_("")),"LRB",0,'C',1);
		$this->Cell($w[16],4,strtoupper(_("")),"LRB",0,'C',1);
		
		$this->Ln();
		
		$where="select nombre_zona ";
		$fecha=date("Y-m-01");
		

		$cable=conexion();
		$cable1=conexion();
		
		//echo $where;
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetTextColor(0);

		$fecha=date("Y-m-01");
		$fecha_actu=date("Y-m-01");
		$fecha_ant=restames($fecha);
		$fecha_ant=restames($fecha_ant);
		$fecha_ant=restames($fecha_ant);
		$fecha_ant=restames($fecha_ant);
		$fecha_ant=restames($fecha_ant);
		
		$sumat=array();
		$cs=0;
		for($i=0;$i<15;$i++){
			$sumat[$i]=0;
		}
		
		$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO' and (nombrestatus='ACTIVO' OR nombrestatus='CORTADO')");
		for($j=0;$j<count($dato);$j++){
			$cs=0;
			$nombrestatus=trim($dato[$j]["nombrestatus"]);
			$abrev=strtoupper(trim($dato[$j]["abrev"]));
		
			$acceso->objeto->ejecutarSql("select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and status_contrato='$nombrestatus' ");
			$row=row($acceso);
			$total_abo=trim($row["cont"])+0;
		
			$acceso->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato,vista_ubica,contrato_servicio_deuda where contrato.id_calle=vista_ubica.id_calle and contrato_servicio_deuda.id_contrato=contrato.id_contrato  $consult and status_contrato='$nombrestatus'  and fecha_inst < '$fecha_actu'");
			$row=row($acceso);
			$monto_total=trim($row["monto"]);
				
			$cable->objeto->ejecutarSql("select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and  contrato.status_contrato='$nombrestatus' and (select sum(costo_cobro * cant_serv) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha_actu' )>0");
									
			$row1=row($cable);
			$sin_deuda=trim($row1['cont'])+0;
			$sin_deuda=$total_abo-$sin_deuda;
			$sumat[$cs]+=$sin_deuda;
			$cs++;
			$this->SetFont('Arial','',8);
			$this->SetX($right);
			//$this->Cell($w[0],5,'',"0",0,'C',1);
			$this->Cell($w[1],5,"$nombrestatus","0",0,'L',$fill);
			$this->Cell($w[2],5,$sin_deuda,"0",0,'C',$fill);
			
			
			$fecha=date("Y-m-01");
			$fecha_ini=restames($fecha);
			//echo ":$fecha,$fecha_ant:";
			
			while(comparaFecha($fecha,$fecha_ant)>0){
				$fecha_ini=restames($fecha);
				
				
				
		
			$monto=0;
			$cant=0;
			$cable->objeto->ejecutarSql("select contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle  $consult and  contrato.status_contrato='$nombrestatus' and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha_ini'  and costo_cobro>0 )<=0 ");		
			while ($row1=row($cable)){
				$cant++;
				$id_contrato=trim($row1['id_contrato']);
				//echo "<br>$id_contrato:select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato'";
				$cable1->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst < '$fecha_actu'");
				$row2=row($cable1);
				$monto+=trim($row2['monto'])+0;
			}
		//	echo "<br>$cant:$monto";
				$fecha=restames($fecha);
			$sumat[$cs]+=$cant;
			$cs++;
			$sumat[$cs]+=$monto;
			$cs++;
			$this->Cell($w[3],5,$cant,0,0,'C',$fill);
			$this->Cell($w[4],5,number_format($monto+0, 2, ',', '.'),0,0,'R',$fill);
		}
		
			$monto=0;
			$cant=0;
			$cable->objeto->ejecutarSql("select contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and  contrato.status_contrato='$nombrestatus' and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 ");		
			while ($row1=row($cable)){
				$cant++;
				$id_contrato=trim($row1['id_contrato']);
				//echo "<br>$id_contrato:select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato'";
				$cable1->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst < '$fecha_actu'");
				$row2=row($cable1);
				$monto+=trim($row2['monto'])+0;
				
			}
			/*
			echo "<br>$nombrestatus:$cant:$monto<br>select contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and  contrato.status_contrato='$nombrestatus' and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 <br>";
*/
				$fecha=restames($fecha);
			$sumat[$cs]+=$cant;
			$cs++;
			$sumat[$cs]+=$monto;
			$cs++;
			$this->Cell($w[3],5,$cant,0,0,'C',$fill);
			$this->Cell($w[4],5,number_format($monto+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[15],5,$total_abo,"0",0,'C',$fill);
			$this->Cell($w[16],5,number_format($monto_total+0, 2, ',', '.'),"0",0,'R',$fill);

			$sumat[$cs]+=$total_abo;
			$cs++;
			$sumat[$cs]+=$monto_total;
			$cs++;
			
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		
			$this->SetFont('Arial','B',8);
			$this->SetX($right);
			$this->Cell($w[0]+$w[1],5,"TOTAL ","0",0,'L',$fill);
			$this->Cell($w[2],5,$sumat[0],"0",0,'C',$fill);
			$this->Cell($w[3],5,$sumat[1],0,0,'C',$fill);
			$this->Cell($w[4],5,number_format($sumat[2]+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[5],5,$sumat[3],0,0,'C',$fill);
			$this->Cell($w[6],5,number_format($sumat[4]+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[7],5,$sumat[5],0,0,'C',$fill);
			$this->Cell($w[8],5,number_format($sumat[6]+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[9],5,$sumat[7],0,0,'C',$fill);
			$this->Cell($w[10],5,number_format($sumat[8]+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[11],5,$sumat[9],0,0,'C',$fill);
			$this->Cell($w[12],5,number_format($sumat[10]+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[13],5,$sumat[11],0,0,'C',$fill);
			
			$this->Cell($w[14],5,number_format($sumat[12]+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[15],5,$sumat[13],"0",0,'C',$fill);
			$this->Cell($w[16],5,number_format($sumat[14]+0, 2, ',', '.'),"0",0,'R',$fill);
			$this->SetX($right);
			$this->Cell(array_sum($w),5,'','T');
			$this->Ln(7);
			
			
			if($fecha_dia==""){
			$fecha=date("Y-m-d");
			
		}
		else{
			$fecha=formatfecha($fecha_dia);
		}
			
			
			/*		
		
		$dato_franq=lectura($acceso,"SELECT *FROM franquicia  $consult_fw  order by id_franq ");
			$suma_s=array();
				$suma=0;
			for($k=0;$k<count($dato_franq);$k++){
				$id_franq=trim($dato_franq[$k]["id_franq"]);
				$nombre_franq=trim($dato_franq[$k]["nombre_franq"]);
				
				$this->SetX($right);
				$this->SetFont('Arial','BIU',8);
				$this->Cell(50,6,strtoupper(_("resumen de ordenes de servicios franquicia $nombre_franq")),"0",0,"L");

		$this->SetX($right)	;
				$w=array(40,11,12,12,11,12,12,11,12,12,11,12,12,11,12,12,13,13,14);
				$dato=array("CREADO","IMPRESO",'DEVUELTA',"CANCELADA","FINALIZADO");
				$fechas=array("fecha_orden","fecha_imp","fecha_dev","fecha_canc","fecha_cierre");
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell($w[0],4,strtoupper(_("detalle orden")),"LRT",0,"L");
				$this->Cell($w[1]+$w[2]+$w[3],4,"CREADO","LRT",0,"C");
				$this->Cell($w[4]+$w[5]+$w[6],4,"IMPRESO","LRT",0,"C");
				$this->Cell($w[7]+$w[8]+$w[9],4,"DEVUELTA","LRT",0,"C");
				$this->Cell($w[10]+$w[11]+$w[12],4,"CANCELADA DEL MES","LRT",0,"C");
				$this->Cell($w[13]+$w[14]+$w[15],4,"FINALIZADO DEL DIA","LRT",0,"C");
				$this->Cell($w[16]+$w[17]+$w[18],4,"FINALIZADO DEL MES","LRT",0,"C");
				
				//$this->Cell($w[2],6,strtoupper(_("TOTAL")),"0",0,"L");
				$this->Ln(3);
				$this->SetFont('Arial','',8);
				$this->Cell($w[0],3,'',"LRB",0,"L");
				
				$this->Cell($w[1],3,"Dia","LB",0,"L");
				$this->Cell($w[2],3,"Mes","B",0,"L");
				$this->Cell($w[3],3,"Actual","BR",0,"L");
				
				$this->Cell($w[4],3,"Dia","LB",0,"L");
				$this->Cell($w[5],3,"Mes","B",0,"L");
				$this->Cell($w[6],3,"Actual","BR",0,"L");
				
				$this->Cell($w[7],3,"Dia","LB",0,"L");
				$this->Cell($w[8],3,"Mes","B",0,"L");
				$this->Cell($w[9],3,"Actual","BR",0,"L");
				
				$this->Cell($w[10],3,"Dia","LB",0,"L");
				$this->Cell($w[11],3,"Mes","B",0,"L");
				$this->Cell($w[12],3,"Mes Ant.","BR",0,"L");
				
				$this->Cell($w[13],3,"Dia","LB",0,"L");
				$this->Cell($w[14],3,"Mes","B",0,"L");
				$this->Cell($w[15],3,"Mes Ant.","BR",0,"L");
				
				$this->Cell($w[16],3,"Dia","LB",0,"L");
				$this->Cell($w[17],3,"Mes","B",0,"L");
				$this->Cell($w[18],3,"Mes Ant.","BR",0,"L");
				
			//	echo "SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN'";
				$tipo_serv=lectura($acceso,"SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN' ORDER BY nombre_tipo_orden");
			
				$suma_s=array();
				$cs=0;
				for($i=0;$i<18;$i++){
					$suma_s[$i]=0;
				}
				
				
				list($ano,$mes,$dia)=explode("-",$fecha);
				$fecha_ini="$ano-$mes-01";
				for($ij=0;$ij<count($tipo_serv);$ij++){
					$id_det_orden=trim($tipo_serv[$ij]["id_det_orden"]);
					$nombre_det_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_det_orden"]));
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					
					$this->Cell(40,4,$nombre_det_orden,"L",0,"L");
					$cs=0;
					
					for($j=0;$j<count($dato)-2;$j++){
						
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden'  and $fecha_orden='$fecha'");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[1],4," $cant1","L",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden'  and $fecha_orden between '$fecha_ini' and '$fecha'");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[2],4," $cant1","",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and  id_det_orden='$id_det_orden' AND status_orden='$nombrestatus'");
							$row=row($acceso);
							$cant=trim($row["cant"])+0;
							$this->Cell($w[3],4," $cant","0",0,"L");
							$suma_s[$cs]+=$cant;
							$cs++;
							
						}
						
						// ORDENES CANCELADAS
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden' AND status_orden='CANCELADA' and fecha_orden='$fecha'  and fecha_canc between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[10],4," $cant1","L",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden' AND status_orden='CANCELADA' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_canc between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[11],4," $cant1","",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and  id_det_orden='$id_det_orden' AND status_orden='CANCELADA' and fecha_orden <'$fecha_ini' and fecha_canc between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant=trim($row["cant"])+0;
							$this->Cell($w[12],4," $cant","0",0,"L");
							$suma_s[$cs]+=$cant;
							$cs++;
							
						// ORDENES FINALIZADAS DEL DIA	
						
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden' AND status_orden='FINALIZADO' and fecha_orden='$fecha'  
							and fecha_cierre = '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[13],4," $cant1","L",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
						
						$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden' AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha' 
						and  fecha_cierre = '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[14],4," $cant1","",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and  id_det_orden='$id_det_orden' AND status_orden='FINALIZADO' and fecha_orden <'$fecha_ini' 
							and fecha_cierre ='$fecha' ");
							$row=row($acceso);
							$cant=trim($row["cant"])+0;
							$this->Cell($w[15],4," $cant","0",0,"L");
							$suma_s[$cs]+=$cant;
							$cs++; 
							
						// ORDENES FINALIZADAS DEL DIA	
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden' AND status_orden='FINALIZADO' and fecha_orden='$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha'");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[16],4," $cant1","L",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden' AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[17],4," $cant1","",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and  id_det_orden='$id_det_orden' AND status_orden='FINALIZADO' and fecha_orden <'$fecha_ini' and fecha_cierre between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant=trim($row["cant"])+0;
							$this->Cell($w[18],4," $cant","R",0,"L");
							$suma_s[$cs]+=$cant;
							
							$cs++;
					}
					$this->Ln();
					$cs=0;
					/////////////////////////////////////RECLAMOS///////////////////////////////
					$this->Cell(40,4,"RECLAMOS","L",0,"L");
					
					
					
					for($j=0;$j<count($dato)-2;$j++){
						
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005'  and $fecha_orden='$fecha'");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[1],4," $cant1","L",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005' and $fecha_orden between '$fecha_ini' and '$fecha'");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[2],4," $cant1","",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005' AND status_orden='$nombrestatus'");
							$row=row($acceso);
							$cant=trim($row["cant"])+0;
							$this->Cell($w[3],4," $cant","0",0,"L");
							$suma_s[$cs]+=$cant;
							$cs++;
							
						}
						
						// ORDENES CANCELADAS
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005' AND status_orden='CANCELADA' and fecha_orden='$fecha'  and fecha_canc between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[10],4," $cant1","L",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005' AND status_orden='CANCELADA' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_canc between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[11],4," $cant1","",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005' AND status_orden='CANCELADA' and fecha_orden <'$fecha_ini' and fecha_canc between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant=trim($row["cant"])+0;
							$this->Cell($w[12],4," $cant","0",0,"L");
							$suma_s[$cs]+=$cant;
							$cs++;
							
						// ORDENES FINALIZADAS DEL DIA	
						
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005'AND status_orden='FINALIZADO' and fecha_orden='$fecha'  
							and fecha_cierre = '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[13],4," $cant1","L",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
						
						$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005'AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha' 
						and  fecha_cierre = '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[14],4," $cant1","",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005' AND status_orden='FINALIZADO' and fecha_orden <'$fecha_ini' 
							and fecha_cierre ='$fecha' ");
							$row=row($acceso);
							$cant=trim($row["cant"])+0;
							$this->Cell($w[15],4," $cant","0",0,"L");
							$suma_s[$cs]+=$cant;
							$cs++; 
							
						// ORDENES FINALIZADAS DEL DIA	
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005'AND status_orden='FINALIZADO' and fecha_orden='$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha'");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[16],4," $cant1","L",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005'AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Cell($w[17],4," $cant1","",0,"L");
							$suma_s[$cs]+=$cant1;
							$cs++;
							
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden AND id_franq='$id_franq' and id_tipo_orden='TIO00005' AND status_orden='FINALIZADO' and fecha_orden <'$fecha_ini' and fecha_cierre between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant=trim($row["cant"])+0;
							$this->Cell($w[18],4," $cant","R",0,"L");
							$suma_s[$cs]+=$cant;
							
							$cs++;
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell($w[0],5,"TOTAL","1",0,"L");
					$i=0;
					for($j=0;$j<18;$j++){
							$i++;
							$cant1=$suma_s[$j];
							if($i==3){
								$bor="RTB";
								$i=0;
							}
							else{
								$bor="TB";
							}
							$this->Cell($w[$j+1],5," $cant1","$bor",0,"L");
					}
			}	
			*/
			$this->Ln(10);
		}
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-20);
		$this->SetFont('Arial','B',8);
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
			
			$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		
		}
		else{
		//	echo ":$id_f:";
			$consult_g=" and  id_franq='0'";
			$nombre_franq="GENERAL";
		}
		
		
	/*
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=15;
		$top=40;
			$this->SetXY($right,$top);
		
		*/
		$this->AddPage('P','letter');
		$this->SetFont('Arial','BIU',8);
		
		
		$fech=formatofecha($desde);
			//$this->Ln(10);
		$this->Ln(5);
		
		$this->SetX($right);
		$this->Cell(40,6,strtoupper(_("detalles de clientes facturados $nombre_franq $fech ")),"0",0,"L");
		$this->Ln();
		
		
		
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,32,17,50,18,17,16,18);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abo.')),"ZONA",strtoupper(_('C.I./RIF')),strtoupper(_('Cliente')),strtoupper(_('factura')),strtoupper(_('control')),strtoupper(_('TOTAL')),strtoupper(_('STATUS')));
		$this->SetFont('Arial','B',7);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		$cable=conexion();
		
		$acceso->objeto->ejecutarSql("SELECT id_contrato,id_pago,nombre_zona,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta'  order by nro_control");
		
		$this->SetFont('Arial','',7);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		while ($row=row($acceso))
		{
			$fill=0;
				$this->SetX(10);
				$this->Cell($w[0],5,$cont,"L",0,"C",$fill);
				$this->Cell($w[1],5,utf8_decode(trim($row["nro_contrato"])),"1",0,"J",$fill);
				$this->Cell($w[2],5,substr(utf8_decode(trim($row["nombre_zona"])),0,15),"1",0,"J",$fill);
				$this->Cell($w[3],5,utf8_decode(trim($row["cedulacli"])),"1",0,"J",$fill);
				$this->Cell($w[4],5,substr(utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])),0,30),"1",0,"J",$fill);
				$this->Cell($w[5],5,utf8_decode(trim($row["nro_factura"])),"1",0,"J",$fill);
				$this->Cell($w[6],5,utf8_decode(trim($row["nro_control"])),"1",0,"J",$fill);
				$this->SetFont('Arial','B',7);
				$this->Cell($w[7],5,number_format(trim($row["monto_pago"])+0, 2, ',', '.'),"1",0,"R",$fill);
				$this->SetFont('Arial','',7);
				$this->Cell($w[8],5,utf8_decode(trim($row["status_pago"])),"1",0,"J",$fill);
				
				$id_pago=trim($row["id_pago"]);
				$cable->objeto->ejecutarSql("SELECT abrev_tp,numero,monto_tp,(select abrev_banco from banco where detalle_tipopago.banco=banco.banco and tipo_banco<>'EMPRESA' LIMIT 1) AS abrev_banco FROM detalle_tipopago,tipo_pago WHERE detalle_tipopago.id_tipo_pago=tipo_pago.id_tipo_pago and id_pago='$id_pago' ");
				$banco='';
				while($row1=row($cable)){
					$abrev_banco=trim($row1['abrev_banco']);
					$ban=trim($row1['banco']);
					$tipo_pago=trim($row1['abrev_tp']);
					$numero=trim($row1['numero']);
					$monto_tp=trim($row1['monto_tp']);
					number_format($cargo+0, 2, ',', '.');
					$banco= $banco."$tipo_pago, $monto_tp  $abrev_banco $numero ;  ";
				}
				$cable->objeto->ejecutarSql("SELECT nombre_servicio,costo_cobro,tipo_costo,tipo_paq,fecha_inst FROM pago_servicio, contrato_servicio_pagado, servicios   WHERE  pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv  AND contrato_servicio_pagado.id_serv = servicios.id_serv and id_pago='$id_pago' ");
				 

				
				$servicio='';
				while($row1=row($cable)){
					$nombre_servicio=trim($row1['nombre_servicio']);
					$tipo_costo=trim($row1['tipo_costo']);
					$tipo_paq=trim($row1['tipo_paq']);
					$costo_cobro=trim($row1['costo_cobro']);
					$fecha_inst=trim($row1['fecha_inst']);
					$costo_cobro=number_format($costo_cobro+0, 2, ',', '.');
					
					
					$fechaN=explode("-",$fecha_inst);
					$mes=formato_mes($fechaN[1]);
					$anio=$fechaN[0];
					
					if($tipo_costo=='COSTO MENSUAL' and $tipo_paq=='PAQUETE BASICO'){
						$nombre_servicio="MENS $mes $anio;";
					}
					else if($tipo_costo=='COSTO MENSUAL'){
						$nombre_servicio="$nombre_servicio $mes $anio;";
					}
					
					$servicio= $servicio."$nombre_servicio $costo_cobro ;";
				}
				$this->Ln();
				$this->SetX(10);
				$this->MultiCell(array_sum($w),4,"               Forma de Pago: $banco      Detalle Servicios: $servicio","LRB","J",$fill);
				
				
				
				$fill=!$fill;
				$cont++;
		
		}
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
		
		
		
		
		
	}
	function otras_franquicias($acceso,$fecha,$id_f)
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
					
								$acceso->objeto->ejecutarSql("SELECT  sum(monto_pago) as monto_pago FROM pagos,caja_cobrador,caja ,vista_contrato_dir where
								pagos.id_caja_cob=caja_cobrador.id_caja_cob and 
								caja_cobrador.id_caja=caja.id_caja and 
								pagos.id_contrato=vista_contrato_dir.id_contrato and 
								fecha_pago='$fecha' and 
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
					
					$acceso->objeto->ejecutarSql("SELECT vista_pago_cont.id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont,vista_contrato_dir where vista_pago_cont.id_contrato=vista_contrato_dir.id_contrato and  fecha_pago='$fecha' and vista_pago_cont.id_franq='$id_franq' and vista_contrato_dir.id_franq='$id_franq1' order by nro_factura");
					
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
					
					$acceso->objeto->ejecutarSql("SELECT vista_pago_cont.id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont,vista_contrato_dir where vista_pago_cont.id_contrato=vista_contrato_dir.id_contrato and  fecha_pago='$fecha' and vista_pago_cont.id_franq='$id_franq' and vista_contrato_dir.id_franq='$id_franq1' order by nro_factura");
					
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
//$pdf->AddPage('L','letter');
//$pdf->AddPage('L','letter');
$pdf->AddPage('L','letter');
$pdf->Titulo($titulo_cierre);
$pdf->Cuerpo($acceso,$fecha,$id_f);

$pdf->otras_franquicias($acceso,$fecha,$id_f);
$pdf->detalle_factura($acceso,$fecha,$fecha,$id_f);

$pdf->Output('reporte.pdf','D');
?> 