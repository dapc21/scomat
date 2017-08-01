<?php
require('../include/FPDF/fpdf.php');

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
session_start();
	//$id_f = $_SESSION["id_franq"]; 
	//$consult=" and id_franq='$id_f'";

$id_cierre=$_GET['id_cierre'];

$acceso->objeto->ejecutarSql("SELECT id_franq FROM cirre_diario_et where id_cierre='$id_cierre' ");
if($row=row($acceso)){
	$id_f=trim($row["id_franq"]);
}
		
session_start();
	//$_SESSION["id_franq"] = $id_f; 
	
	if($id_f=='0'){
		$id_f='1';
	}
	
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_cierre="CIERRE DE ESTACION DE TRABAJO DE $nombre_franq";
	
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
		$this->SetFont('Arial','',10);
		$this->SetX(70)	;
		$this->MultiCell(190,5,strtoupper(tipo_serv()),'0','L');
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
		$this->MultiCell(195,7,strtoupper(_("$titulo_cierre")),'0','L');
		$this->Ln();
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
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
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_cierre)
	{
		
		$acceso->objeto->ejecutarSql("SELECT *FROM cirre_diario_et,estacion_trabajo where cirre_diario_et.id_est=estacion_trabajo.id_est and id_cierre='$id_cierre'");
		if($row=row($acceso))
		{
			$obser_cierre=utf8_d(trim($row["obser_cierre"]));
			$fecha_cierre=formatofecha(trim($row["fecha_cierre"]));
			$fecha=trim($row["fecha_cierre"]);
			//$fecha='';
			$hora_cierre=utf8_d(trim($row["hora_cierre"]));
			$monto_total=utf8_d(trim($row["monto_total"]));
			$reporte_z=utf8_d(trim($row["reporte_z"]));
			$nombre_est=utf8_d(trim($row["nombre_est"]));
			$id_est=trim($row["id_est"]);
		
			$total_acumulado=number_format($monto_total+0, 2, ',', '.');
			$this->SetX(20);
			$this->SetFont('Arial','B',9);
			$this->Cell(35,6,strtoupper(_('total estacion')).":","0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$total_acumulado,"0",0,"L");
			
			$this->SetX(150);
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
			$this->Cell(40,6,strtoupper(_('estacion de trabajo')).":","0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$nombre_est,"0",0,"L");
			
			$this->SetX(150);
			$this->SetFont('Arial','B',9);
			$this->Cell(20,6,strtoupper(_('reporte z')).":","0",0,"L");
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,$reporte_z,"0",0,"L");
			
			
			$this->Ln();
			$this->SetX(20);
			$this->SetFont('Arial','B',9);
			$this->Cell(21,5,strtoupper(_('observacion')).":","0",0,"J");
			
			
			$this->SetFont('Arial','',9);
			$this->SetX(50);
			$this->MultiCell(210,5,strtoupper(utf8_decode($obser_cierre)),'0','J');
			
			////////////////////////////////////////////
			
		
			
		$this->Ln();
		
			
		$w=array(60,15,25);	
	
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=10;
		$top=60;
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
				
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as excento FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva=0 and  id_est='$id_est' and fecha_pago='$fecha'   AND status_pago='PAGADO' ");
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
				// echo "SELECT count(*) cant, sum(base_imp) as base_imp, sum(monto_iva) as monto_iva FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva>0 and  id_est='$id_est' and fecha_pago='$fecha' ";
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp) as base_imp, sum(monto_iva) as monto_iva FROM pagos  ,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and   fecha_pago='$fecha'  and  id_est='$id_est' AND status_pago='PAGADO' ");
			 
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
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  ,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and    fecha_pago='$fecha' and fecha_factura='$fecha'  and  id_est='$id_est' and  status_pago='NOTA CREDITO' ");
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
		//	echo "SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  where   fecha_pago='$fecha' and fecha_factura<'$fecha'  and  id_est='$id_est' and  status_pago='NOTA CREDITO' <br> ";
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  ,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and    fecha_pago='$fecha' and fecha_factura<'$fecha'  and  id_est='$id_est' and  status_pago='NOTA CREDITO' ");
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
				//ECHO "SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago  where   fecha_pago='$fecha' and id_est='$id_est'  and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'   and obser_pago<>'NOTA CREDITO' ";
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago  where   fecha_pago='$fecha' and id_est='$id_est'  and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'   and obser_pago<>'NOTA CREDITO'  ");
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
		$top=60;
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
			
		 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where    fecha_pago = '$fecha'  and  id_est='$id_est' and id_serv='$id_serv'  and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO' ");
				
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
			
		  $dato=lectura($acceso,"SELECT distinct fecha_inst  FROM vista_pago_ser where  fecha_pago='$fecha' and  id_est='$id_est'   and status_pago='PAGADO'  and obser_pago<>'NOTA CREDITO' order by fecha_inst");
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$fecha_inst=trim($dato[$k]["fecha_inst"]);
				list($ano,$mes,$dia)=explode("-",$fecha_inst);
				$mes_l = formato_mes_com1($mes)." $ano";
				//echo $mes_l ;
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where fecha_pago='$fecha'  and  id_est='$id_est' and status_pago='PAGADO' and fecha_inst='$fecha_inst' and obser_pago<>'NOTA CREDITO'  ");
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
		
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva>0  and  caja_cobrador.id_est='$id_est'  and fecha_pago='$fecha' and status_pago='PAGADO' and obser_pago<>'NOTA CREDITO'  ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			
	
	





			
	
		
		$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',9);
			
			$this->Ln();
		$this->SetX(15);
		$this->Cell(40,6,strtoupper(_('detalles de los puntos de cobros')),"0",0,"L");
		$this->Ln();
		$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_caja where id_est='$id_est' and  fecha_caja='$fecha' and status_caja_cob='CERRADA'");

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
//$pdf->Fecha();
$pdf->Titulo($titulo_cierre);
$pdf->Cuerpo($acceso,$id_cierre);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 