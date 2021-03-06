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
		$titulo_cierre="CIERRE DIARIO - RESUMEN DE $nombre_franq";
	}
	else{
		$titulo_cierre='CIERRE DIARIO - RESUMEN GENERAL';
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
		$this->SetFillColor(249,249,249);
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
		$this->SetFillColor(249,249,249);
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
		$row=row($acceso);
		
			$monto_total=utf8_d(trim($row["monto_total"]));
			$obser_cierre=utf8_d(trim($row["obser_cierre"]));
			$hora_cierre=utf8_d(trim($row["hora_cierre"]));
			
			
	
			$fecha_cierre=formatofecha($fecha);
			$total_acumulado=$monto_total;
			$parcial=calMontoCDCA($acceso,$fecha,$id_f);
			$acumulado=calMontoAcumulado($acceso,$fecha,$id_f);
			
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
			
			$this->SetX(170);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,6,strtoupper(_('Monto Cierre')).":","0",0,"L");
			
			
			$this->Cell(20,6,$parcial,"0",0,"L");
			
			$this->SetFont('Arial','B',9);
			$this->Cell(30,6,strtoupper(_('monto Mes')).":","0",0,"L");
			
			
			$this->Cell(25,6,$acumulado,"0",0,"L");
			
			
			$this->Ln();
			$this->SetX($right);
			$this->SetFont('Arial','B',9);
			$this->Cell(21,5,strtoupper(_('observacion')).":","0",0,"L");
			
			
			$this->SetFont('Arial','',9);
			$this->SetX(50);
			$this->MultiCell(150,5,strtoupper(utf8_decode($obser_cierre)),'0','J');
			
			////////////////////////////////////////////
			
		$w=array(40,10,20);	
	
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=10;
		$top=30;
			$this->SetXY($right,$top);
			
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen por forma de pago')),"0",0,"L");
			$fill=1;
			$this->SetX($right)	;
			$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("forma de pago")),"TBL",0,"L",$fill);
				$this->Cell($w[1],5,strtoupper(_("CANT")),"TB",0,"C",$fill);
				$this->Cell($w[2],5,strtoupper(_("total"))." ","TBR",0,"R",$fill);
				
				
			$this->SetFont('Arial','',8);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',8);
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
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
					$this->SetFont('Arial','',8);
					$this->Cell(80,5,'ret. IVA  '.number_format($monto_reten+0, 2, ',', '.').' + ret. ISLR '.number_format($islr+0, 2, ',', '.').' + total '.number_format($islr+0, 2, ',', '.').' = '.number_format($monto_reten+$islr+$suma_c+0, 2, ',', '.'),"0",0,"L");			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
			
			
			
			
			
			
			$fecha_ACT=$fecha;
			$fecha_ini=date("Y-m-01");
			
			$right=100;
		$top=30;
			$this->SetXY($right,$top);
			
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('Desconexiones por Morosidad')),"0",0,"L");
			
			$this->SetX($right)	;
			$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("status orden")),"TBL",0,"L",$fill);
				$this->Cell($w[2],5,strtoupper(_("CANT")),"TBR",0,"C",$fill);
								
				
			
			$this->SetFont('Arial','',8);
			
			
							
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='CREADO' and fecha_orden between '$fecha_ini' and '$fecha'  ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							$this->Ln();
							$this->SetX($right);
							$this->Cell($w[0],5,strtoupper(_("ASIGNADAS")),"L",0,"L");
							$this->Cell($w[2],5," $cant1","R",0,"C");
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='IMPRESO' and fecha_orden between '$fecha_ini' and '$fecha'  ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							
							$this->Ln();
							$this->SetX($right);
							$this->Cell($w[0],5,strtoupper(_("IMPRESAS")),"L",0,"L");
							$this->Cell($w[2],5," $cant1","R",0,"C");
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='DEVUELTA' and fecha_orden between '$fecha_ini' and '$fecha'  ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							
							$this->Ln();
							$this->SetX($right);
							$this->Cell($w[0],5,strtoupper(_("DEVUELTAS")),"L",0,"L");
							$this->Cell($w[2],5," $cant1","R",0,"C");
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='CANCELADA' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_orden between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							
							$this->Ln();
							$this->SetX($right);
							$this->Cell($w[0],5,strtoupper(_("CANCELADAS")),"L",0,"L");
							$this->Cell($w[2],5," $cant1","R",0,"C");
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							
							$this->Ln();
							$this->SetX($right);
							$this->Cell($w[0],5,strtoupper(_("FINALIZADA")),"L",0,"L");
							$this->Cell($w[2],5," $cant1","R",0,"C");
							
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult and fecha_orden between '$fecha_ini' and '$fecha'  ");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							
							$this->SetFont('Arial','B',8);
							$this->Ln();
							$this->SetX($right);
							$this->Cell($w[0],5,strtoupper(_("TOTAL")),"LBT",0,"L");
							$this->Cell($w[2],5," $cant1","RBT",0,"C");
							
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant  FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='FINALIZADO'  and fecha_orden between '$fecha_ini' and '$fecha' and fecha_cierre between '$fecha_ini' and '$fecha' 
and (SELECT count(*) FROM ordenes_tecnicos where ordenes_tecnicos.id_contrato=vista_orden.id_contrato and id_det_orden='DEO00003' and fecha_orden >= '$fecha_ini')>0");
							$row=row($acceso);
							$cant1=trim($row["cant"])+0;
							
							$this->Ln();
							$this->SetX($right);
							$this->SetFont('Arial','',8);
							$this->Cell($w[0],5,strtoupper(_("RECONEXIONES")),"0",0,"L");
							$this->Cell($w[2],5," $cant1","0",0,"C");
							
							

		//}	
		$this->Ln(17);
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
		
		$this->SetFillColor(249,249,249);
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
/*
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
		*/
		$this->SetX($right);
		$this->Cell(250,5,'','T');
		
		
		
		
		
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_w=" and  estado.id_franq='$id_f'";
		}
		$this->Ln(5);
		$this->SetFont('Arial','BIU',8);
		$this->Cell($right,6,strtoupper(_('deuda de abonados por STATUS ')),"0",0,"L");
		$this->Ln();
		$this->SetFillColor(249,249,249);
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
			$fill=0;
			$cs=0;
			$nombrestatus=trim($dato[$j]["nombrestatus"]);
			$abrev=strtoupper(trim($dato[$j]["abrev"]));
		
			$acceso->objeto->ejecutarSql("select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and status_contrato='$nombrestatus'");
			$row=row($acceso);
			$total_abo=trim($row["cont"]);
		
			$acceso->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato,vista_ubica,contrato_servicio_deuda where contrato.id_calle=vista_ubica.id_calle and contrato_servicio_deuda.id_contrato=contrato.id_contrato  $consult and status_contrato='$nombrestatus'");
			$row=row($acceso);
			$monto_total=trim($row["monto"]);
				
			$cable->objeto->ejecutarSql("select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and  contrato.status_contrato='$nombrestatus' and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst <= '$fecha'  and costo_cobro>0 )<=0");
			$row1=row($cable);
			$sin_deuda=trim($row1['cont'])+0;
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
			$cable->objeto->ejecutarSql("select contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and  contrato.status_contrato='$nombrestatus' and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha_ini'  and costo_cobro>0 )<=0 ");		
			while ($row1=row($cable)){
				$cant++;
				$id_contrato=trim($row1['id_contrato']);
				//echo "<br>$id_contrato:select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato'";
				$cable1->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato'");
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
			$cable->objeto->ejecutarSql("select contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and  contrato.status_contrato='$nombrestatus' and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 ");		
			while ($row1=row($cable)){
				$cant++;
				$id_contrato=trim($row1['id_contrato']);
				//echo "<br>$id_contrato:select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato'";
				$cable1->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato'");
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
		$fill=0;
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
			//c
		}
		else{
			$fecha=formatfecha($fecha_dia);
		}
			
			
					
		
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
				$fill=1;
				$this->Cell($w[0],4,strtoupper(_("detalle orden")),"LRT",0,"L",$fill);
				$this->Cell($w[1]+$w[2]+$w[3],4,"CREADO","LRT",0,"C",$fill);
				$this->Cell($w[4]+$w[5]+$w[6],4,"IMPRESO","LRT",0,"C",$fill);
				$this->Cell($w[7]+$w[8]+$w[9],4,"DEVUELTA","LRT",0,"C",$fill);
				$this->Cell($w[10]+$w[11]+$w[12],4,"CANCELADA DEL MES","LRT",0,"C",$fill);
				$this->Cell($w[13]+$w[14]+$w[15],4,"FINALIZADO DEL DIA","LRT",0,"C",$fill);
				$this->Cell($w[16]+$w[17]+$w[18],4,"FINALIZADO DEL MES","LRT",0,"C",$fill);
				
				//$this->Cell($w[2],6,strtoupper(_("TOTAL")),"0",0,"L",$fill);
				$this->Ln(3);
				$this->SetFont('Arial','',8);
				$this->Cell($w[0],3,'',"LRB",0,"L",$fill);
				
				$this->Cell($w[1],3,"Dia","LB",0,"L",$fill);
				$this->Cell($w[2],3,"Mes","B",0,"L",$fill);
				$this->Cell($w[3],3,"Actual","BR",0,"L",$fill);
				
				$this->Cell($w[4],3,"Dia","LB",0,"L",$fill);
				$this->Cell($w[5],3,"Mes","B",0,"L",$fill);
				$this->Cell($w[6],3,"Actual","BR",0,"L",$fill);
				
				$this->Cell($w[7],3,"Dia","LB",0,"L",$fill);
				$this->Cell($w[8],3,"Mes","B",0,"L",$fill);
				$this->Cell($w[9],3,"Actual","BR",0,"L",$fill);
				
				$this->Cell($w[10],3,"Dia","LB",0,"L",$fill);
				$this->Cell($w[11],3,"Mes","B",0,"L",$fill);
				$this->Cell($w[12],3,"Mes Ant.","BR",0,"L",$fill);
				
				$this->Cell($w[13],3,"Dia","LB",0,"L",$fill);
				$this->Cell($w[14],3,"Mes","B",0,"L",$fill);
				$this->Cell($w[15],3,"Mes Ant.","BR",0,"L",$fill);
				
				$this->Cell($w[16],3,"Dia","LB",0,"L",$fill);
				$this->Cell($w[17],3,"Mes","B",0,"L",$fill);
				$this->Cell($w[18],3,"Mes Ant.","BR",0,"L",$fill);
				
			//	echo "SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN'";
				$tipo_serv=lectura($acceso,"SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN' and (id_det_orden='DEO00003' or id_det_orden='DEO00010' or id_det_orden='DEO00001') ORDER BY nombre_tipo_orden");
			
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
			$this->Ln(10);
		}
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-15);
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
		
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,18,50,18,25,120);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abo.')),strtoupper(_('factura')),strtoupper(_('Cliente')),strtoupper(_('Monto')),strtoupper(_('STATUS')),strtoupper(_('detalle Forma Pago')));
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
	function deuda_abo($acceso,$id_f)
	{
		$right=10;
		
	}
}
//crea el objeto pdf
$pdf=new PDF();    
          
//salto de p�gina autom�tico desde la parte inferior de la p�gina 
$pdf->SetAutoPageBreak(true,10);
/*
//agrega una nueva pagina
//$pdf->AddPage('L','letter');
//$pdf->AddPage('L','letter');
$pdf->AddPage('L','letter');
$pdf->Titulo($titulo_cierre);
$pdf->Cuerpo($acceso,$fecha,$id_f);
$pdf->ordenes($acceso,$fecha,$id_f);
//$pdf->deuda_abo($acceso,$id_f);
//$pdf->detalle_factura($acceso,$fecha,$fecha,$id_f);

$pdf->Output('reporte.pdf','D');
*/

		if($fecha==""){
			$fecha=date("Y-m-d");
		}
		else{
			$fecha=formatfecha($fecha);
		}
		$cable=conexion();
		$cable->objeto->ejecutarSql("SELECT id_franq,nombre_franq FROM franquicia order by id_franq ");
		while($row=row($cable)){
			$id_f=trim($row["id_franq"]);
			$nombre_franq=trim($row["nombre_franq"]);
			if($id_f!='0'){
				$titulo_cierre="CIERRE DIARIO - RESUMEN DE $nombre_franq";
			}
			
			$pdf=new PDF(); 
			$pdf->SetAutoPageBreak(true,10);
			$pdf->AddPage('L','letter');
			$pdf->Titulo($titulo_cierre);
			$pdf->Cuerpo($acceso,$fecha,$id_f);
			$pdf->ordenes($acceso,$fecha,$id_f);
			
			$pdf->Output("../archivos/$id_f/$fecha cierre_resumen.pdf",'F');
		}
		
			$id_f='0';
			
				$titulo_cierre='CIERRE DIARIO - RESUMEN GENERAL';
			
			
			$pdf=new PDF();              
			$pdf->SetAutoPageBreak(true,10);
			$pdf->AddPage('L','letter');
			$pdf->Titulo($titulo_cierre);
			$pdf->Cuerpo($acceso,$fecha,$id_f);
			$pdf->ordenes($acceso,$fecha,$id_f);
			
			$pdf->Output("../archivos/general/$fecha cierre_resumen.pdf",'F');
			//echo ":../archivos/general/$fecha cierre_resumen.pdf:";
			
			header('Location: informe_tecnico_diario_a.php');

?> 