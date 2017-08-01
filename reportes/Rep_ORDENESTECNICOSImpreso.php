<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];
$status_orden = $_GET['status_orden'];

$desde = formatfecha($_GET['desde']);
$hasta = formatfecha($_GET['hasta']);
$por_fecha = $_GET['por_fecha'];


$id_det_orden = $_GET['id_det_orden'];
$id_tipo_orden = $_GET['id_tipo_orden'];

$id_g_a = $_GET['id_g_a'];
$id_esta = $_GET['id_esta'];
$id_mun = $_GET['id_mun'];
$id_ciudad = $_GET['id_ciudad'];
$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$urbanizacion = $_GET['urbanizacion'];
$id_calle = $_GET['id_calle'];

$login_emi = $_GET['login_emi'];
$login_imp = $_GET['login_imp'];
$login_final = $_GET['login_final'];
$id_gt = $_GET['id_gt'];
$order = $_GET['order'];
if($order!=''){
	$valor=explode(":",$order);
$order=" order by ".$valor[0]." ".$valor[1];
}




	$where= "SELECT id_contrato,id_orden,nro_contrato,(nombrecli || ' ' || apellidocli) as cliente, fecha_orden,fecha_imp,fecha_cierre,fecha_final,nombre_tipo_orden,nombre_det_orden,nombre_grupo,status_orden,login_emi,login_imp,login_fin from vista_orden where (id_contrato <> '')";
	
  if($gen_ubi!='GENERAL'){
		if($id_franq!='' && $id_franq!='0'){
			$where=$where. " and (id_franq = '$id_franq')";
		}
		if($id_esta!='' && $id_esta!='0'){
			$where=$where. " and (id_esta ILIKE '%$id_esta%')";
		}
		if($id_mun!='' && $id_mun!='0'){
			$where=$where. " and (id_mun ILIKE '%$id_mun%')";
		}
		if($id_ciudad!='' && $id_ciudad!='0'){
			$where=$where. " and (id_ciudad ILIKE '%$id_ciudad%')";
		}
		if($id_zona!='' && $id_zona!='0'){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
		}
		if($id_sector!='' && $id_sector!='0'){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!='' && $id_calle!='0'){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		if($urbanizacion!='' && $urbanizacion!='0'){
			$where=$where. " and (urbanizacion = '$urbanizacion')";
		}
	}
  
  
	if($gen_fec!='GENERAL'){
		
			$where=$where. " and $por_fecha between '$desde' and '$hasta'";
		
	
	}
	
	if($status_orden!='' && $status_orden!='0'){
			$where=$where. " and (status_orden ILIKE '%$status_orden%')";
		
	}
	if($status_contrato!='' && $status_contrato!='0'){
		$where=$where. " and (status_contrato ILIKE '%$status_contrato%')";
	}
	
	if($id_tipo_orden!='0'){
			$where=$where. " and (id_tipo_orden ILIKE '%$id_tipo_orden%') and (id_det_orden ILIKE '%$id_det_orden%') ";
	}
	
	if($login_emi!='' && $login_emi!='0'){
		$where=$where. " and (login_emi ILIKE '%$login_emi%')";
	}
	if($login_imp!='' && $login_imp!='0'){
		$where=$where. " and (login_imp ILIKE '%$login_imp%')";
	}
	if($login_final!='' && $login_final!='0'){
		$where=$where. " and (login_fin ILIKE '%$login_final%')";
	}
	if($id_gt!='' && $id_gt!='0'){
		$where=$where. " and (id_gt ILIKE '%$id_gt%')";
	}
	$where=$where.$order;

	//echo $where;
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		
		$this->Titulo();
		$this->Fecha();
		$this->TituloCampos();
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('reporte de ordenes de tecnicos')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,20,20,50,50,45,38,27);
		$header=array(strtoupper(_('nro')),strtoupper(_('# orden')),strtoupper(_('# Cont')),strtoupper(_('Cliente')),strtoupper(_('detalle orden')),strtoupper(_('tipo orden')),strtoupper(_('Grupo Trabajo ')),strtoupper(_('status orden')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$where)
	{
		$w=array(10,20,20,50,50,45,38,27);
		$acceso->objeto->ejecutarSql($where);
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX(10);
			$this->Cell($w[0],5,$cont,"LR",0,"C",$fill);
			$this->Cell($w[1],5,utf8_d(trim($row["id_orden"])),"LR",0,"J",$fill);
			$this->Cell($w[2],5,utf8_d(trim($row["nro_contrato"])),"LR",0,"J",$fill);
			$this->Cell($w[3],5,substr(utf8_d(trim($row["cliente"])),0,25),"LR",0,"J",$fill);
			//$this->Cell($w[3],5,formatofecha(trim($row["fecha_orden"])),"LR",0,"J",$fill);
			$this->Cell($w[4],5,substr(utf8_d(trim($row["nombre_det_orden"])),0,25),"LR",0,"J",$fill);
			$this->Cell($w[5],5,substr(utf8_d(trim($row["nombre_tipo_orden"])),0,22),"LR",0,"J",$fill);
			$this->Cell($w[6],5,substr(utf8_d(trim($row["nombre_grupo"])),0,25),"LR",0,"J",$fill);
			$this->Cell($w[7],5,utf8_d(trim($row["status_orden"])),"LR",0,"J",$fill);
			$this->Ln();
			//fecha_orden,fecha_imp,fecha_cierre,fecha_final,nombre_tipo_orden,nombre_det_orden,nombre_grupo,status_orden,login_emi,login_imp,login_fin
			$this->Cell(50,5,"ASIG: ".formatofecha(trim($row["fecha_orden"]))." ".trim($row["login_emi"]),"LR",0,"L",$fill);
			$this->Cell(50,5,"IMP: ".formatofecha(trim($row["fecha_imp"]))." ".trim($row["login_imp"]),"LR",0,"L",$fill);
			$this->Cell(50,5,"CIERRE: ".formatofecha(trim($row["fecha_cierre"]))." ".trim($row["login_fin"]),"LR",0,"L",$fill);
			$this->Cell(45,5,"FINALIZACION: ".formatofecha(trim($row["fecha_final"])),"LR",0,"L",$fill);
			$this->Cell(65,5,"","LR",0,"L",$fill);
			
			
			
			/*$this->Cell($w[1],5,utf8_d(trim($row["id_orden"])),"LR",0,"J",$fill);
			$this->Cell($w[2],5,utf8_d(trim($row["nro_contrato"])),"LR",0,"J",$fill);
			$this->Cell($w[3],5,substr(utf8_d(trim($row["cliente"])),0,25),"LR",0,"J",$fill);
			//$this->Cell($w[3],5,formatofecha(trim($row["fecha_orden"])),"LR",0,"J",$fill);
			$this->Cell($w[4],5,substr(utf8_d(trim($row["nombre_det_orden"])),0,25),"LR",0,"J",$fill);
			$this->Cell($w[5],5,substr(utf8_d(trim($row["nombre_tipo_orden"])),0,22),"LR",0,"J",$fill);
*/
	$this->Ln(5);
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
		$this->SetY(-30);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_d(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	    
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage('L','letter');
//$pdf->Titulo();
//$pdf->Fecha();
$pdf->Cuerpo($acceso,$where);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 