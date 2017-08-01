<?php
require('../include/FPDF/fpdf.php');

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];

			$fecha=date("Y-m-d");
	
		
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	
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
		$this->AddPage('L','letter');
		$this->SetFont('Arial','BIU',8);
		
		
		$fech=formatofecha($desde);
			//$this->Ln(10);
		$this->SetX($right);
		$this->Cell(40,6,strtoupper(_("detalles de clientes facturados $nombre_franq $fech ")),"0",0,"L");
		$this->Ln();
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,20,20,60,20,30,95);
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
			//$fill=0;
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
				$this->Cell($w[0],4,$cont,"LR",0,"C",$fill);
				$this->Cell($w[1],4,utf8_decode(trim($row["nro_contrato"])),"LR",0,"J",$fill);
				$this->Cell($w[2],4,utf8_decode(trim($row["nro_factura"])),"LR",0,"J",$fill);
				$this->Cell($w[3],4,substr(utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])),0,35),"LR",0,"J",$fill);
				$this->Cell($w[4],4,number_format(trim($row["monto_pago"])+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[5],4,utf8_decode(trim($row["status_pago"])),"LR",0,"J",$fill);
				$this->Cell($w[6],4,"$banco","LR",0,"J",$fill);
				
				$this->Ln();
				$fill=!$fill;
				$cont++;
		
		}
		$this->SetX($right);
		$this->Cell(array_sum($w),4,'','T');
		
		
	}
	function deuda_abo($acceso,$id_f)
	{
		$right=10;
		
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,15);
//agrega una nueva pagina
//$pdf->AddPage('L','letter');
//$pdf->AddPage('L','letter');
/*
$pdf->AddPage('L','letter');

$pdf->Titulo($titulo_cierre);
$pdf->Cuerpo($acceso,$fecha,$id_f);
$pdf->ordenes($acceso,$fecha,$id_f);
$pdf->deuda_abo($acceso,$id_f);
*/
$pdf->detalle_factura($acceso,$fecha,$fecha,$id_f);

$pdf->Output('reporte.pdf','D');
?> 