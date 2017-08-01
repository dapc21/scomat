<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

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
	//	$this->TituloCampos();
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
		$this->MultiCell(190,7,strtoupper(_('informe de penetracion por zona / status')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{

	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso)
	{
		session_start();
		$id_f = $_SESSION["id_franq"]; 
		
		if($id_f!='0'){
			$consult=" and id_franq='$id_f'";
			$consult_w=" where vista_zona1.id_franq='$id_f'";
		}
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(30,67,15,15,13,13,13,18);
		//$header=array(strtoupper(_('nro franquicia')),strtoupper(_('nombre franquicia')),strtoupper(_('ac')),strtoupper(_('co')),strtoupper(_('si')),strtoupper(_('su')),strtoupper(_('ex')),strtoupper(_('total')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		$this->Cell(40,7,strtoupper(_('nombre zona')),1,0,'J',1);
		//$this->Cell(30,7,strtoupper(_('franquicia')),1,0,'J',1);
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'  AND penet='TRUE' order by tipo_sta");
				$entro=false;
				for($j=0;$j<count($dato);$j++){
					$nombrestatus=trim($dato[$j]["nombrestatus"]);
					$abrev=trim($dato[$j]["abrev"]);
					$tipo_sta=trim($dato[$j]["tipo_sta"]);
					$nombrest=str_replace(" ",'_',$nombrestatus);
				
					if($tipo_sta!="INCREMENTA" && $entro==false){
						$ac=$ac." (select count(*) from vista_ubica,contrato,statuscont where contrato.status_contrato=statuscont.nombrestatus and vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_zona=vista_zona1.id_zona and tipo_sta='INCREMENTA' $consult) as total_inc ,";
						$this->Cell(15,7,strtoupper(_('Total I.')),1,0,'J',1);
						$this->Cell(15,7,"%",1,0,'C',1);
						$entro=true;
					}
					
					$ac=$ac." (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_zona=vista_zona1.id_zona and status_contrato='$nombrestatus' $consult) as $abrev ,";
					
					$this->Cell(15,7,strtoupper($abrev),1,0,'C',1);
					$this->Cell(15,7,"%",1,0,'C',1);
				}
				$this->Cell(18,7,strtoupper(_('total')),1,0,'J',1);	
				$this->Cell(18,7,strtoupper(_('t. hogar')),1,0,'J',1);	

$total=" (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_zona=vista_zona1.id_zona $consult) as total";

$where="
select nombre_zona,nombre_franq,nro_zona, $ac $total from vista_zona1 $consult_w
";

		$this->Ln();
		
		
		$w=array(30,67,15,15,13,13,13,18);
		
		//echo ":$where:";
		$acceso->objeto->ejecutarSql($where);
			
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetTextColor(0);
		$cont_s=array();
		$cont_h=0;
		$cont_t=0;
		$in_h=0;
		for($j=0;$j<count($dato);$j++){
					$abrev=trim($dato[$j]["abrev"]);
					$cont_s[$abrev]=0;
					
		}
		
		
		while ($row=row($acceso))
		{
			$hogar=trim($row["nro_zona"])+0;
			$cont_h=$cont_h+$hogar;
			$total=trim($row["total"]);
			$cont_t= $cont_t+$total;
			$ACTI=trim($row["ACTI"]);
			$ACTI=trim($row["$abrev"])+$hogar;
			
			$hogar=trim($row["nro_zona"]);
			$hogar=trim($row["nro_zona"]);
			$hogar=trim($row["nro_zona"]);
			$hogar=trim($row["nro_zona"]);
			
			$this->SetX(10);
			$this->Cell(40,6,utf8_d(trim($row["nombre_zona"])),"LR",0,"J",$fill);
			//$this->Cell(30,6,utf8_d(trim($row["nombre_franq"])),"LR",0,"J",$fill);
				$entro=false;
				for($j=0;$j<count($dato);$j++){
					$tipo_sta=trim($dato[$j]["tipo_sta"]);
					if($tipo_sta!="INCREMENTA" && $entro==false){
						$abrev=strtolower("total_inc");
						$ACTI=trim($row["$abrev"])+0;
						$cont_s[$abrev]=$cont_s[$abrev] + $ACTI;
						$poc_acti=0;
						if($hogar>$ACTI){
							$poc_acti=($ACTI/$hogar)*100;
						}
						$this->Cell(15,6, utf8_d(trim($row["$abrev"])),"LR",0,"C",$fill);
						$this->Cell(15,6, number_format($poc_acti+0, 2, ',', '.'),"LR",0,"C",$fill);
						$entro=true;
					}
					$abrev=strtolower(trim($dato[$j]["abrev"]));
					$ACTI=trim($row["$abrev"])+0;
					$cont_s[$abrev]=$cont_s[$abrev] + $ACTI;
					$poc_acti=0;
					if($hogar>$ACTI){
						$poc_acti=($ACTI/$hogar)*100;
					}
					
					$this->Cell(15,6, utf8_d(trim($row["$abrev"])),"LR",0,"C",$fill);
					$this->Cell(15,6, number_format($poc_acti+0, 2, ',', '.'),"LR",0,"C",$fill);
					
				}
			$this->Cell(18,6, utf8_d(trim($row["total"])),"LR",0,"C",$fill);
			$this->Cell(18,6, utf8_d(trim($row["nro_zona"])),"LR",0,"C",$fill);
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		
			$this->SetFont('Arial','B',9);
			$this->SetX(10);
			$this->Cell(40,6,"TOTAL","LR",0,"J",$fill);
			
			$entro=false;
			$hogar=$cont_h;
				for($j=0;$j<count($dato);$j++){
					$tipo_sta=trim($dato[$j]["tipo_sta"]);
					if($tipo_sta!="INCREMENTA" && $entro==false){
						$abrev=strtolower("total_inc");
						$ACTI=$cont_s[$abrev];
						$poc_acti=0;
						if($hogar>$ACTI){
							$poc_acti=($ACTI/$hogar)*100;
						}
						$this->Cell(15,6, $ACTI,"LR",0,"C",$fill);
						$this->Cell(15,6, number_format($poc_acti+0, 2, ',', '.'),"LR",0,"C",$fill);
						$entro=true;
					}
					
					$abrev=strtolower(trim($dato[$j]["abrev"]));
					$ACTI=$cont_s[$abrev];
					$poc_acti=0;
					if($hogar>$ACTI){
						$poc_acti=($ACTI/$hogar)*100;
					}
					$this->Cell(15,6, $ACTI,"LR",0,"C",$fill);
					$this->Cell(15,6, number_format($poc_acti+0, 2, ',', '.'),"LR",0,"C",$fill);
				}
			
			$this->Cell(18,6, $cont_t,"LR",0,"C",$fill);
			$this->Cell(18,6, $cont_h,"LR",0,"C",$fill);
			
		$this->Ln();
		$this->SetX(10);
		$this->Cell(250,5,'','T');
		
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
$pdf->Cuerpo($acceso);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 