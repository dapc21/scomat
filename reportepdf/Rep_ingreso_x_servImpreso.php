<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_f=$_GET['id_franq'];

	if($id_f!='0'){
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_analisis="ingresos por servicios DE $nombre_franq";
	}
	else{
		$titulo_analisis='ingresos por servicios';
	}
	
	
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$tipo = $_GET['tipo'];
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(250,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(250,5,strtoupper(_("tv por cable.")),'0','C');
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
		$this->SetX(193);
		$this->Cell(12,5,strtoupper(_('fecha')),0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')),0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo($acceso,$titulo_analisis)
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(250,7,strtoupper(_('ingresos por servicios')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(20,25,15,25,15,25,15,20,20,25,18,18,20);
		$header=array(strtoupper(_('fecha')),strtoupper(_('mant. Z1')),strtoupper(_('n f.')),strtoupper(_('mant. Z2')),strtoupper(_('n f.')),strtoupper(_('mant. Z3')),strtoupper(_('n f.')),strtoupper(_('cable')),strtoupper(_('afil. y der.')),strtoupper(_('trasl. y rec.')),strtoupper(_('base')),strtoupper(_('iva')),strtoupper(_('total')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'C',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$desde,$hasta,$tipo,$id_f)
	{
		$tipo=utf8_decode($tipo);
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		$this->Cell(100,6,"Tipo: $tipo          Desde ".formatofecha($desde)."  Hasta ".formatofecha($desde),"LR",0,"C",$fill);
		$this->Ln();
		$acceso1=conexion();
		$tipo_caja=verCajaPrincipal($acceso);
	//	$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		
		$w=array(20);
		$total_f=array();
		$total_t=array();
		$header=array('Fecha');
		$tama=20;
		$tama_c=8;
		$i=1;
		$acceso1->objeto->ejecutarSql("SELECT nombre_servicio,tipo_costo FROM servicios where status_serv='ACTIVO' ORDER BY tipo_costo");
		while($row=row($acceso1)){
			$nombre_servicio=substr(trim($row['nombre_servicio']),0,10);
			$tipo_costo=trim($row['tipo_costo']);
			$w[$i]=$tama;
			$header[$i]=$nombre_servicio;
			$i++;
			$w[$i]=$tama_c;
			$header[$i]="Cant";
			$i++;
			
			/*
			if($tipo_costo=="COSTO MENSUAL"){
				$w[$i]=$tama_c;
				$header[$i]="CANT";
				$i++;
			}
			*/
		}
			$w[$i]=22;
			$header[$i]="TOTAL";
			$i++;
			$w[$i]=12;
			$header[$i]="Cant T";
			$i++;
			
			$this->SetFont('Arial','B',8);
			$this->SetX(10);
			for($k=0;$k<count($header);$k++)
				$this->Cell($w[$k],7,$header[$k],1,0,'C',1);
			$this->Ln();
		
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$sumatoria=0.00;
	//	echo "<BR>$desde,$hasta";
		$i=0;
		$j=0;
	
	
	
	
	while(comparaFecha($desde,$hasta)<=0){
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_w=" and  estado.id_franq='$id_f'";
		}
		
		if($tipo=="POR DIA"){
			$hast=$desde;
		}
		else if($tipo=="POR MES"){
			list($anio,$mes,$dia) = explode("-",$desde);
			$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $anio ));
			$hast="$anio-$mes-$ult_dia_mes";
		}
		else if($tipo=="POR ANO"){
			list($anio,$mes,$dia) = explode("-",$desde);
			$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $anio ));
			$hast="$anio-12-$ult_dia_mes";
		}
		else if($tipo=="UNICO"){
			$hast="2050-12-31";
		}
		$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto, count(*) as cant FROM vista_pago_ser where  fecha_pago between '$desde' and '$hast'  and status_pago='PAGADO' $consult");
		$row=row($acceso);
		$monto=trim($row["monto"])+0;
		$cant=trim($row["cant"])+0;
		
		
	 if($monto>0){
		$wi=0;
		$j=0;
		$suma=0;
		$suma_m=0;
		$this->SetX(10);
		$this->Cell($w[$wi],6,formatofecha($desde),"LR",0,"C",$fill);
		$wi++;		
		$acceso1->objeto->ejecutarSql("SELECT id_serv,tipo_costo FROM servicios where status_serv='ACTIVO' ORDER BY tipo_costo");
		while($row=row($acceso1)){
			$id_serv=trim($row['id_serv']);
			$tipo_costo=trim($row['tipo_costo']);
		
			$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto, count(*) as cant FROM vista_pago_ser where fecha_pago between '$desde' and '$hast'  and id_serv='$id_serv' and status_pago='PAGADO' $consult");
			$row=row($acceso);
			$monto=trim($row["monto"])+0;
			$cant=trim($row["cant"])+0;
			
				$total_t[$i][$j]=$monto;
				$suma=$suma+$monto;
				$j++;
				$this->Cell($w[$wi],6,number_format($monto+0, 2, ',', '.'),"LR",0,"R",$fill);
				$wi++;		
				
				
				$total_t[$i][$j]=$cant;
				$suma_m=$suma_m+$cant;
				$j++;
				$this->Cell($w[$wi],6,$cant,"LR",0,"C",$fill);
				$wi++;		
				
		}//while	
			$total_t[$i][$j]=$suma;
			$j++;
			$total_t[$i][$j]=$suma_m;
			$j++;
			$this->SetFont('Arial','B',8);
			$this->Cell($w[$wi],6,number_format($suma+0, 2, ',', '.'),"LR",0,"R",$fill);
			$wi++;		
			$this->Cell($w[$wi],6,$suma_m,"LR",0,"R",$fill);
			$this->SetFont('Arial','',8);
			$this->Ln();
			$fill=!$fill;
			$cont++;
			$i++;
		}//if monto	
		
		
		if($tipo=="POR DIA"){
			$desde=sumadia($desde);
		}
		else if($tipo=="POR MES"){
			$desde=sumames($desde);
		}
		else if($tipo=="POR ANO"){
			$desde=sumaanio($desde);
			//$desde=sumames($desde);
		}
		else if($tipo=="UNICO"){
			break;
		}
		
	}
	
	if($tipo!="UNICO"){
	
		$col=$j;
		$fil=$i;
		$this->SetFont('Arial','B',8);
				$this->SetX(10);
				$this->Cell($w[0],6,"TOTAL","LR",0,"C",$fill);
		
		for($j=0;$j<$col;$j++){
			$suma=0;
			for($i=0;$i<$fil;$i++){
				$suma=$suma+$total_t[$i][$j];
			}		
			if($j%2==0){
				$this->Cell($w[$j+1],6,number_format($suma+0, 2, ',', '.'),"LRT",0,"R",$fill);
			}
			else{
				$this->Cell($w[$j+1],6,$suma,"LRT",0,"R",$fill);
			}
		}
		$this->Ln();
	}
	
		
		$this->Cell(array_sum($w),5,'','T');
		
		/*
		$total_p=$sumatoria;
		$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
		
		$this->Ln();
		$this->Ln();
		$this->SetX(108);
		$this->SetFont('Arial','BI',9);
		$this->Cell(55,6,strtoupper(_('resumen general')),"0",0,"C",$fill);
		
		$this->Ln();
		$this->SetX(108);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,6,strtoupper(_('total base')).": ","1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($base+0, 2, ',', '.'),"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(108);
		$this->Cell(30,6,strtoupper(_('total iva')).": ","1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($iva+0, 2, ',', '.'),"1",0,"R",$fill);
		
		$this->Ln();
		$this->SetX(108);
		$this->Cell(30,6,strtoupper(_('total general')).": ","1",0,"L",$fill);
		
		$this->Cell(25,6,number_format($total_p+0, 2, ',', '.'),"1",0,"R",$fill);
		*/
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
$pdf->Titulo($acceso,$titulo_analisis);
$pdf->Fecha();
$pdf->Cuerpo($acceso,$desde,$hasta,$tipo,$id_f);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 