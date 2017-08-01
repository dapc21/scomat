<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$mes = $_GET['mes'];
$mes_a = $_GET['mes_a'];
$mes_p = $_GET['mes_p'];
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
		$this->MultiCell(190,5,strtoupper(tipo_serv()),'0','C');
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
	function Titulo($acceso)
	{
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		
		
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$desde,$hasta,$mes,$mes_a,$mes_p)
	{
		//echo "$desde,$hasta,$mes,$mes_a,$mes_p";
		
		$valor=explode("-",trim($mes));
		
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
	//	$this->MultiCell(190,7,utf8_decode('INGRESOS POR SERVICIOS'),'0','C');
		
		
		$titulo=" ".strtoupper(_("ingresos por servicios       analisis para el mes de"))." ".formato_mes_com($valor[1])." ".strtoupper(_("del año"))." ".$valor[0];	
		$this->MultiCell(190,7,$titulo,'0','C');
		
		$this->Fecha();
		
		
		$m_i=$mes;
		$m_f=$mes;
		for($i=0;$i<$mes_a;$i++)
			$m_i=restames($m_i);
			
		for($i=0;$i<$mes_p;$i++)
			$m_f=sumames($m_f);
			
		//echo ":$m_f:$m_i:";
		
		$f_i=$m_i;
		
		
		
		
		//$w=$this->TituloCampos();
				
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(20,25,15,25,15,25,15,20,20,25,20,18,18,20);
		$header=array(strtoupper(_('fecha')),strtoupper(_('mant. Z1')),strtoupper(_('n f.')),strtoupper(_('mant. Z2')),strtoupper(_('n f.')),strtoupper(_('mant. Z3')),strtoupper(_('n f.')),strtoupper(_('cable')),strtoupper(_('afil. y der.')),strtoupper(_('trasl. y rec.')),strtoupper(_('otros')),strtoupper(_('base')),strtoupper(_('iva')),strtoupper(_('total')));
		///////////////////////
		$i=14;
		while(comparaFecha($m_i,$m_f)<=0){
			
			$valor=explode("-",trim($m_i));
			$mes=$valor[1];
			$w[$i]=22;
			$header[$i]="M.".formato_mes($mes);
			$i++;
			$w[$i]=10;
			$header[$i]="Nº F ";
			//echo "$header[$i]:";
			
			$i++;
			$m_i=sumames($m_i);
		}
		/////////////////////
		
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'C',1);
			
			
		$this->Ln();		
		
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
			$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$sumatoria=0.00;
		
		$s_m=array();
		$s_c=array();
		
	//	echo "<BR>$desde,$hasta";
		while(comparaFecha($desde,$hasta)<=0){
		
		//$acceso->objeto->ejecutarSql("SELECT inicial_doc,fecha_pago,nro_factura,cedulacli,nombrecli,apellidocli,monto_pago,status_pago,tipo_cliente FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta'  and tipo_caja='PRINCIPAL'   order by nro_factura");
		//ECHO "<BR>SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where fecha_pago='$desde' and (id_serv='SER00001' or id_serv='BM00008' or id_serv='BM00009') and status_pago='PAGADO'";
		$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto, count(*) as cant FROM vista_pago_ser where fecha_pago='$desde' and (id_serv<>'SER00001' and id_serv<>'BM00008' and id_serv<>'BM00009' and id_serv<>'SER00012' and id_serv<>'BM00001' and id_serv<>'BM00006' and id_serv<>'BM00007' and id_serv<>'BM00002' and id_serv<>'SER00002' and id_serv<>'BM00004') and status_pago='PAGADO'");
		$row=row($acceso);
		$otro=trim($row["monto"])+0;
		$s_otro=$s_otro+$otro;
		$cant_o=trim($row["cant"])+0;
		$s_cant_o=$s_cant_o+$cant_o;
		
		
		$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto, count(*) as cant FROM vista_pago_ser where fecha_pago='$desde' and (id_serv='SER00001') and status_pago='PAGADO'");
		$row=row($acceso);
		$mant=trim($row["monto"])+0;
		$s_mant=$s_mant+$mant;
		$cant=trim($row["cant"])+0;
		$s_cant=$s_cant+$cant;
		
		$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto, count(*) as cant FROM vista_pago_ser where fecha_pago='$desde' and (id_serv='BM00008') and status_pago='PAGADO'");
		$row=row($acceso);
		$mant1=trim($row["monto"])+0;
		$s_mant1=$s_mant1+$mant1;
		$cant1=trim($row["cant"])+0;
		$s_cant1=$s_cant1+$cant1;
	
		$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto, count(*) as cant FROM vista_pago_ser where fecha_pago='$desde' and (id_serv='BM00009') and status_pago='PAGADO'");
		$row=row($acceso);
		$mant2=trim($row["monto"])+0;
		$s_mant2=$s_mant2+$mant2;
		$cant2=trim($row["cant"])+0;
		$s_cant2=$s_cant2+$cant2;
	
		$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto cant FROM vista_pago_ser where fecha_pago='$desde' and (id_serv='SER00012') and status_pago='PAGADO'");
		$row=row($acceso);
		$cable=trim($row["monto"])+0;
		$s_cable=$s_cable+$cable;
		
		$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto, count(*) as cant FROM vista_pago_ser where fecha_pago='$desde' and (id_serv='BM00001' or id_serv='BM00006' or id_serv='BM00007' or id_serv='BM00002') and status_pago='PAGADO'");
		$row=row($acceso);
		$afil=trim($row["monto"])+0;
		$s_afil=$s_afil+$afil;
		
		$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto, count(*) as cant FROM vista_pago_ser where fecha_pago='$desde' and (id_serv='BM00004' or id_serv='SER00002') and status_pago='PAGADO'");
		$row=row($acceso);
		$rec=trim($row["monto"])+0;
		$s_rec=$s_rec+$rec;
		
		$monto_p=$mant+$mant1+$mant2+$cable+$afil+$rec+$otro;
		$s_monto_p=$s_monto_p+$monto_p;
		
		$sumatoria=$sumatoria+$monto_p;
		$total_p=$monto_p;
		$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
		
		$s_base=$s_base+$base;
		$s_iva=$s_iva+$iva;
				$this->SetX(10);
				$this->Cell($w[0],6,formatofecha($desde),"LR",0,"C",$fill);
				$this->Cell($w[1],6,number_format($mant+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[2],6,$cant,"LR",0,"C",$fill);
				$this->Cell($w[3],6,number_format($mant1+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[4],6,$cant1,"LR",0,"C",$fill);
				$this->Cell($w[5],6,number_format($mant2+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[6],6,$cant2,"LR",0,"C",$fill);
				$this->Cell($w[7],6,number_format($cable+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[8],6,number_format($afil+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[9],6,number_format($rec+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[10],6,number_format($otro+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[11],6,number_format($base+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[12],6,number_format($iva+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[13],6,number_format($monto_p+0, 2, ',', '.'),"LR",0,"R",$fill);
				$j=14;
				$m_i=$f_i;
				//$ki=0;
				while(comparaFecha($m_i,$m_f)<=0){
			
					
					$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto, count(*) as cant FROM vista_pago_ser where fecha_pago='$desde' and fecha_inst='$m_i' and (id_serv='SER00001' or id_serv='BM00008' or id_serv='BM00009') and status_pago='PAGADO'");
					$row=row($acceso);
					$mant=trim($row["monto"])+0;
					$s_mant=$s_mant+$mant;
					$cant=trim($row["cant"])+0;
					//$s_cant=$s_cant+$cant;
					$s_m[$j]=$s_m[$j]+$mant;
					$s_c[$j]=$s_c[$j]+$cant;
					$this->Cell($w[$j],6,number_format($mant+0, 2, ',', '.'),"LR",0,"R",$fill);
					$this->Cell($w[$j+1],6,$cant,"LR",0,"C",$fill);
				
		
					$j=$j+2;
					$m_i=sumames($m_i);
				}

				$this->Ln();
				$fill=!$fill;
				$cont++;
			
			$desde=sumadia($desde);
			
	}

				$this->SetFont('Arial','B',9);
				$this->SetX(10);
				$this->Cell($w[0],6,_("total"),"LR",0,"C",$fill);
				$this->Cell($w[1],6,number_format($s_mant+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[2],6,$s_cant,"LR",0,"C",$fill);
				$this->Cell($w[3],6,number_format($s_mant1+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[4],6,$s_cant1,"LR",0,"C",$fill);
				$this->Cell($w[5],6,number_format($s_mant2+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[6],6,$s_cant2,"LR",0,"C",$fill);
				$this->Cell($w[7],6,number_format($s_cable+0, 2, ',', '.'),"LR",0,"J",$fill);
				$this->Cell($w[8],6,number_format($s_afil+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[9],6,number_format($s_rec+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[10],6,number_format($s_otro+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[11],6,number_format($s_base+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[12],6,number_format($s_iva+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[13],6,number_format($s_monto_p+0, 2, ',', '.'),"LR",0,"R",$fill);
				
				$j=14;
				$m_i=$f_i;
				//$ki=0;
				while(comparaFecha($m_i,$m_f)<=0){
			
					
					
					$this->Cell($w[$j],6,number_format($s_m[$j]+0, 2, ',', '.'),"LR",0,"R",$fill);
					$this->Cell($w[$j+1],6,$s_c[$j],"LR",0,"C",$fill);
				
		
					$j=$j+2;
					$m_i=sumames($m_i);
				}
				
				
				
				$this->Ln();
		$this->Cell(array_sum($w),5,'','T');
		
		
		$total_p=$sumatoria;
		$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
		
		$this->Ln();
		$this->Ln();
		$this->SetX(75);
		$this->SetFont('Arial','BI',9);
		$this->Cell(55,6,strtoupper(_('resumen general')),"0",0,"C",$fill);
		
		$this->Ln();
		$this->SetX(75);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,6,strtoupper(_('total base')).": ","1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($base+0, 2, ',', '.'),"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(75);
		$this->Cell(30,6,strtoupper(_('total iva')).": ","1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($iva+0, 2, ',', '.'),"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(75);
		$this->Cell(30,6,strtoupper(_('total general')).": ","1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($total_p+0, 2, ',', '.'),"1",0,"R",$fill);
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-30);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	    
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage('L','legal1');
//$pdf->Titulo($acceso);
//$pdf->Fecha();
$pdf->Cuerpo($acceso,$desde,$hasta,$mes,$mes_a,$mes_p);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 