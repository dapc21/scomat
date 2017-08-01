<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$deuda = $_GET['deuda'];
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$status_contrato = $_GET['status_contrato'];


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
		$this->MultiCell(190,7,strtoupper(_('reporte de deudas por sectores')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(15,45,20,20,18,15,18,15,10,10,5);
		$header=array(strtoupper(_('nro sec.')),strtoupper(_('nombre sector')),strtoupper(_('nombre zona')),strtoupper(_('total cli')),strtoupper(_('deuda')),strtoupper(_('cli. d.')),strtoupper(_('pagado')),strtoupper(_("cli. p.")),strtoupper(_("rec.")),strtoupper(_("reco.")),strtoupper(_("c.")));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$deuda,$desde,$hasta,$status_contrato)
	{
		$w=array(15,45,20,20,18,15,18,15,10,10,5);
		
if($status_contrato!=''){
	$status="contrato.status_contrato='$status_contrato' and ";
	$statusw=" where contrato.status_contrato='$status_contrato' ";
}

$deuda="(SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) 
           FROM contrato_servicio_deuda,contrato,zona,calle,sector
          WHERE $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          contrato_servicio_deuda.id_contrato = contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar and sector.id_zona=zona.id_zona and sector.id_sector=vista_sector.id_sector   and fecha_inst between '$desde' and '$hasta') AS deuda";
$pagado="(SELECT sum(contrato_servicio_pagado.cant_serv::numeric * contrato_servicio_pagado.costo_cobro) 
           FROM contrato_servicio_pagado,contrato,zona,calle,sector
          WHERE $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          contrato_servicio_pagado.id_contrato = contrato.id_contrato AND contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar and sector.id_zona=zona.id_zona and  sector.id_sector=vista_sector.id_sector   and fecha_inst between '$desde' and '$hasta') AS pagado";
$num_pagado="(SELECT count(contrato_servicio_pagado.id_contrato)            FROM contrato_servicio_pagado,contrato,zona,calle,sector          WHERE $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and           contrato_servicio_pagado.id_contrato = contrato.id_contrato AND contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar and sector.id_zona=zona.id_zona and  sector.id_sector=vista_sector.id_sector   and fecha_inst between '$desde' and '$hasta'  and (contrato_servicio_pagado.id_serv = 'SER00001' or contrato_servicio_pagado.id_serv = 'BM00008' or contrato_servicio_pagado.id_serv = 'BM00009' )  ) AS num_pagado";


		  $num_deuda="(select count(*) from contrato,zona,calle,sector where $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and  sector.id_zona=zona.id_zona and  sector.id_sector=vista_sector.id_sector and 
(SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) as deuda 
           FROM contrato_servicio_deuda
          WHERE contrato_servicio_deuda.id_contrato = contrato.id_contrato and fecha_inst between '$desde' and '$hasta'  and (contrato_servicio_deuda.id_serv = 'SER00001' or contrato_servicio_deuda.id_serv = 'BM00008' or contrato_servicio_deuda.id_serv = 'BM00009' ) )  > 0 ) as num_deuda";
$t_cli="(SELECT count(*) 
           FROM contrato,zona,calle,sector
          WHERE $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          sector.id_zona=zona.id_zona and  sector.id_sector=vista_sector.id_sector ) as t_cli";

$valor=explode("-",$hasta);
$mes=$valor[1];
$anio=$valor[0];
$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $anio ));
$hasta_f="$anio-$mes-$ult_dia_mes";

$t_rec="(select count(*) from contrato,calle where  $status calle.id_calle = contrato.id_calle   and calle.id_sector = vista_sector.id_sector
 and (select count(*) from ordenes_tecnicos where id_det_orden='DEO00003' and fecha_orden between '$desde' and '$hasta_f' and ordenes_tecnicos.id_contrato = contrato.id_contrato)>0
 and (select count(*) from ordenes_tecnicos where id_det_orden='DEO00010' and fecha_orden between '$desde' and '$hasta_f' and ordenes_tecnicos.id_contrato = contrato.id_contrato)>0) as t_rec ";


$t_reco="(select count(*) from contrato,calle where  $status calle.id_calle = contrato.id_calle   and calle.id_sector = vista_sector.id_sector
 and (select count(*) from ordenes_tecnicos where id_det_orden='DEO00003' and fecha_orden between '$desde' and '$hasta_f' and ordenes_tecnicos.id_contrato = contrato.id_contrato)>0
 and (select count(*) from ordenes_tecnicos where id_det_orden='DEO00010' and fecha_orden between '$desde' and '$hasta_f' and ordenes_tecnicos.id_contrato = contrato.id_contrato)=0) as t_reco ";

 
$cor="(select count(*) from contrato,calle where  $status calle.id_calle = contrato.id_calle   and calle.id_sector = vista_sector.id_sector
and (select count(*) from ordenes_tecnicos where id_det_orden='DEO00010' and fecha_orden between '$desde' and '$hasta_f' and ordenes_tecnicos.id_contrato = contrato.id_contrato)>0) as cor ";

//echo $t_rec;
		  
		/*
		$deuda="(select sum(deuda) from vista_deudacli where vista_deudacli.id_sector=vista_sector.id_sector) as deuda";
		$pagado="(select sum(pagado) from vista_deudacli where vista_deudacli.id_sector=vista_sector.id_sector) as pagado";
		$num_deuda="(select count(*) from vista_deudacli where vista_deudacli.id_sector=vista_sector.id_sector and deuda>0) as num_deuda";
		$t_cli="(select count(*) from vista_deudacli where vista_deudacli.id_sector=vista_sector.id_sector) as t_cli";
*/

		$where="
		select nro_sector,nombre_sector,nombre_zona,$t_cli,$deuda,$num_deuda,$pagado,$num_pagado,$t_rec,$t_reco,$cor from vista_sector
		";
		//echo "$where";
		$acceso->objeto->ejecutarSql($where);
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetTextColor(0);
		$sumad=0;
		$sumap=0;
		$sumat=0;
		$sumar=0;
		$sumadr=0;
		while ($row=row($acceso))
		{
			$this->SetX(15);
			$this->Cell($w[0],6,utf8_d(trim($row["nro_sector"])),"LR",0,"J",$fill);
			$this->Cell($w[1],6,utf8_d(trim($row["nombre_sector"])),"LR",0,"J",$fill);
			$this->Cell($w[2],6,utf8_d(trim($row["nombre_zona"])),"LR",0,"J",$fill);
			$deuda=trim($row["deuda"]);
			$pagado=trim($row["pagado"]);
			$t_cli=trim($row["t_cli"]);
			$num_deuda=trim($row["num_deuda"]);
			if($deuda=='')
				$deuda=0;
			if($pagado=='')
				$pagado=0;
			
			$sumad=$sumad+$deuda;	
			$sumap=$sumap+$pagado;	
			$sumat=$sumat+trim($row["t_cli"]);	
			$sumar=$sumar+trim($row["num_deuda"]);	
			$sumadr=$sumadr+trim($row["num_pagado"]);	
			$num_deuda=trim($row["num_deuda"]);
			
			$sumarec=$sumarec+trim($row["t_rec"]);	
			$sumareco=$sumareco+trim($row["t_reco"]);	
			$sumacor=$sumacor+trim($row["cor"]);	
			$this->Cell($w[3],6,utf8_d(trim($row["t_cli"])),"LR",0,"C",$fill);
			$this->Cell($w[4],6,number_format($deuda+0, 2, ',', '.'),"LR",0,"C",$fill);
			$this->Cell($w[5],6,utf8_d(trim($row["num_deuda"])),"LR",0,"C",$fill);
			$this->Cell($w[6],6,number_format($pagado+0, 2, ',', '.'),"LR",0,"C",$fill);
			$this->Cell($w[7],6,utf8_d(trim($row["num_pagado"])),"LR",0,"C",$fill);
			$this->Cell($w[8],6,utf8_d(trim($row["t_rec"])),"LR",0,"C",$fill);
			$this->Cell($w[9],6,utf8_d(trim($row["t_reco"])),"LR",0,"C",$fill);
			$this->Cell($w[10],6,utf8_d(trim($row["cor"])),"LR",0,"C",$fill);

			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
		
		$this->SetFont('Arial','B',10);
		$this->SetX(15);
		$this->Cell($w[0]+$w[1]+$w[2],6,strtoupper(_("total")),"LR",0,"J",$fill);
			
			$this->Cell($w[3],6,$sumat,"LR",0,"C",$fill);
			$this->Cell($w[4],6,number_format($sumad+0, 2, ',', '.'),"LR",0,"C",$fill);
			$this->Cell($w[5],6,$sumar,"LR",0,"C",$fill);
			$this->Cell($w[6],6,number_format($sumap+0, 2, ',', '.'),"LR",0,"C",$fill);
			$this->Cell($w[7],6,$sumadr,"LR",0,"C",$fill);
		
			$this->Cell($w[8],6,$sumarec,"LR",0,"C",$fill);
			$this->Cell($w[9],6,$sumareco,"LR",0,"C",$fill);
			$this->Cell($w[10],6,$sumacor,"LR",0,"C",$fill);
		
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
$pdf->AddPage();
//$pdf->Titulo();
//$pdf->Fecha();
$pdf->Cuerpo($acceso,$deuda,$desde,$hasta,$status_contrato);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 