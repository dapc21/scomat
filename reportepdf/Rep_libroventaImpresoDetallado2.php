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
		$this->MultiCell(190,7,strtoupper(_("detalle de $titulo_cierre")),'0','L');
		
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
		$right=15;
		$top=40;
			$this->SetXY($right,$top);
			
			$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as total FROM vista_pago,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  vista_pago.id_caja_cob=caja_cobrador.id_caja_cob and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO'  ");
				if($row=row($acceso)){
					$total=trim($row["total"]);
				}
				
					$this->SetFont('Arial','B',9);
					$this->Cell(40,5,"TOTAL FACTURADO","0",0,"L");
					
					$this->Cell(20,5,number_format($total+0, 2, ',', '.'),"0",0,"R");
					

		
		
		
		
		$this->SetFont('Arial','BIU',9);
		
		
		$fech=formatofecha($desde);
			//$this->Ln(10);
		$this->Ln(5);
		/*
		$this->SetX($right);
		$this->Cell(40,6,strtoupper(_("detalles de clientes facturados $nombre_franq $fech ")),"0",0,"L");
		$this->Ln();
		*/
		
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,17,50,18,17,16,16,16,18);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abo.')),strtoupper(_('C.I./RIF')),strtoupper(_('Cliente')),strtoupper(_('factura')),strtoupper(_('control')),strtoupper(_('base I.')),strtoupper(_('IVA')),strtoupper(_('TOTAL')),strtoupper(_('STATUS')));
		$this->SetFont('Arial','B',7);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		
		$cable=conexion();
		
		$acceso->objeto->ejecutarSql("SELECT id_contrato,id_pago,nro_contrato,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva, monto_reten, islr, monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta'  order by nro_control");
		
		$this->SetFont('Arial','',7);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		while ($row=row($acceso))
		{
			$fill=
				$this->SetX(10);
				$this->Cell($w[0],5,$cont,"L",0,"C",$fill);
				$this->Cell($w[1],5,utf8_decode(trim($row["nro_contrato"])),"1",0,"J",$fill);
				$this->Cell($w[2],5,utf8_decode(trim($row["cedulacli"])),"1",0,"J",$fill);
				$this->Cell($w[3],5,substr(utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])),0,30),"1",0,"J",$fill);
				$this->Cell($w[4],5,utf8_decode(trim($row["nro_factura"])),"1",0,"J",$fill);
				$this->Cell($w[5],5,utf8_decode(trim($row["nro_control"])),"1",0,"J",$fill);
				$this->Cell($w[6],5,number_format(trim($row["base_imp"])+0, 2, ',', '.'),"1",0,"R",$fill);
				$this->Cell($w[7],5,number_format(trim($row["monto_iva"])+0, 2, ',', '.'),"1",0,"R",$fill);
				$this->SetFont('Arial','B',7);
				$this->Cell($w[8],5,number_format(trim($row["monto_pago"])+0, 2, ',', '.'),"1",0,"R",$fill);
				$this->SetFont('Arial','',7);
				$this->Cell($w[9],5,utf8_decode(trim($row["status_pago"])),"1",0,"J",$fill);
				
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
//salto de p�gina autom�tico desde la parte inferior de la p�gina 
$pdf->SetAutoPageBreak(true,15);
//agrega una nueva pagina
$pdf->AddPage('P','letter');
$pdf->Titulo($titulo_cierre);
$pdf->Cuerpo($acceso,$desde,$hasta,$id_f);

$pdf->Output('reporte.pdf','D');
?> 