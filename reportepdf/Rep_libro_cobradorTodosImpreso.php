<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$id_persona_cob = $_GET['id_persona'];
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,strtoupper(_("tv por cable.")),'0','C');
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
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('reporte de cobranza por cobradores')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(15,30,80,30,30);
		$header=array(strtoupper(_('nro')),strtoupper(_('')),strtoupper(_('CONCEPTO')),strtoupper(_('cantidad')),strtoupper(_('Total Bs')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'C',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$desde,$hasta,$id_persona_cob)
	{
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		$this->Cell(40,5,strtoupper(_("fecha Desde ")).": ".formatofecha($desde).strtoupper(_("     hasta ")).": ".formatofecha($hasta),0,0,'L');
		$this->Ln();
		$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		$cable=conexion();
	
		
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult="where  id_franq='$id_f'";
	} 
	
		$cable->objeto->ejecutarSql("SELECT id_persona,nombre,apellido FROM vista_cobrador $consult order by nombre,apellido");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$sumatoria=0.00;
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.3);
		while ($row=row($cable))
		{
				$this->SetFont('Arial','B',9);
				$id_persona_cob=trim($row["id_persona"]);
				$this->SetX(15);
				$this->Cell($w[0],6,$cont,"",0,"C",$fill);
				$this->Cell($w[1],6,"COBRADOR:","",0,"L",$fill);
				$this->Cell($w[2],6,utf8_decode(trim($row["nombre"])." ".trim($row["apellido"])),"",0,"J",$fill);
				$this->Cell($w[3],6,'',"",0,"J",$fill);
				$this->Cell($w[4],6,'',"",0,"J",$fill);
				
				
				$this->SetFont('Arial','',9);
				
				 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
					 $totalG=0;
						$suma_c=0;
						$suma_d=0;
						$suma_can=0;
					for($k=0;$k<count($dato);$k++){
						$id_serv=trim($dato[$k]["id_serv"]);
						$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where id_persona='$id_persona_cob' and fecha_pago between '$desde' and '$hasta' and id_serv='$id_serv'  and status_pago='PAGADO'");
						
						
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
								$this->SetX(60);
								$this->Cell($w[2],5,strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"]))).":","0",0,"L");
								$this->Cell($w[3],5,$cant,"0",0,"C");
								$this->Cell($w[4],5,number_format($total+0, 2, ',', '.'),"0",0,"R");
							}
						}
					}
					$total=$suma_c-$suma_d;
					$this->Ln();
					$this->SetX(60);
					$this->Cell(140,1,"","B",0,"L");
					$this->Ln();
					//$this->SetFont('Arial','B',9);
								$this->SetX(60);
								
								$this->Cell($w[2],5,strtoupper("total"),"0",0,"L");
								$this->Cell($w[3],5,$suma_can,"0",0,"C");
								$this->Cell($w[4],5,number_format($total+0, 2, ',', '.'),"0",0,"R");
				
				
				
				
				$this->Ln(10);
				
				//$fill=!$fill;
				$cont++;
		}
		$this->SetX(15);
		//$this->Cell(array_sum($w),5,'','T');
		
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
$pdf->AddPage();
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$desde,$hasta,$id_persona_cob);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 