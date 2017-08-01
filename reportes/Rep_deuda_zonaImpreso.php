<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_f=$_GET['id_franq'];

	if($id_f!='0'){
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_analisis="RESUMEN DE CARTERA POR ZONA DE $nombre_franq";
	}
	else{
		$titulo_analisis='RESUMEN DE CARTERA POR ZONA GENERAL';
	}
	
class PDF extends FPDF
{
	public $titulo_analisis;
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		
		$this->Titulo();
		$this->Fecha();

	}
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
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$mes=date("m");
		$mes_letra=formato_mes_com($mes);
		$anio=date("m");
		$this->MultiCell(190,7,strtoupper(_("$this->titulo_analisis")),'0','C');
		
	}
	
	function Cuerpo($acceso,$id_f)
	{
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_w=" and  estado.id_franq='$id_f'";
		}
		$right=10;
		
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_w=" and  estado.id_franq='$id_f'";
		}
		$this->Ln(5);
		$this->SetFont('Arial','BIU',8);
		$this->Cell($right,6,strtoupper(_('deuda de abonados por ZONAS ')),"0",0,"L");
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(0,30,15,12,17,12,17,12,17,12,17,12,17,12,17,20,25);
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
		$fecha_act=date("Y-m-01");
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
		$fecha_actu=date("Y-m-01");
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
		
		$dato=lectura($acceso,"SELECT * FROM vista_zona1 WHERE id_zona<>'' $consult ");
		for($j=0;$j<count($dato);$j++){
			$cs=0;
			$nombrestatus=trim($dato[$j]["nombre_zona"]);
			$id_zona=trim($dato[$j]["id_zona"]);
			$abrev=strtoupper(trim($dato[$j]["abrev"]));
			//echo "<br>select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and contrato.status_contrato='ACTIVO'  and id_zona='$id_zona'<br>";
			$acceso->objeto->ejecutarSql("select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and contrato.status_contrato='ACTIVO'  and id_zona='$id_zona'");
			$row=row($acceso);
			$total_abo=trim($row["cont"])+0;
		
			$acceso->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato,vista_ubica,contrato_servicio_deuda where contrato.id_calle=vista_ubica.id_calle and contrato_servicio_deuda.id_contrato=contrato.id_contrato  $consult and contrato.status_contrato='ACTIVO'  and id_zona='$id_zona'  and fecha_inst < '$fecha_actu'");
			$row=row($acceso);
			$monto_total=trim($row["monto"]);
			
			

			$cable->objeto->ejecutarSql("select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle  $consult and contrato.status_contrato='ACTIVO' and id_zona='$id_zona' and (select sum(costo_cobro * cant_serv) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha_act')>0");
			$row1=row($cable);
			$sin_deuda=trim($row1['cont'])+0;
			//echo ":<br>$sin_deuda: ";
			$sin_deuda=$total_abo-$sin_deuda;
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
			/*	echo "<br><br>select nro_contrato,contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle  $consult and  id_zona='$id_zona' and 
	(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 and 
	(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha_ini'  and costo_cobro>0 )<=0 ";*/
		
				$cable->objeto->ejecutarSql("select nro_contrato,contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle  $consult and  status_contrato='ACTIVO'  and id_zona='$id_zona' and 
	(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 and 
	(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha_ini'  and costo_cobro>0 )<=0 ");		
				
				while ($row1=row($cable)){
					$cant++;
					$id_contrato=trim($row1['id_contrato']);
					$nro_contrato=trim($row1['nro_contrato']);
					//ECHO "$id_contrato<br>";
					
					$cable1->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst < '$fecha_actu'");
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
/*
			echo "<br><br>select nro_contrato,contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult  and contrato.status_contrato='ACTIVO' and  id_zona='$id_zona' and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 ";
*/
			$cable->objeto->ejecutarSql("select nro_contrato,contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and  status_contrato='ACTIVO'  $consult  and  id_zona='$id_zona' and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 ");		
			while ($row1=row($cable)){
				$cant++;
				$id_contrato=trim($row1['id_contrato']);
				$nro_contrato=trim($row1['nro_contrato']);
				
				//ECHO "$id_contrato<br>";
				$cable1->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst < '$fecha_actu'");
				$row2=row($cable1);
				$monto+=trim($row2['monto'])+0;
			}
			//echo "<br>$nombrestatus:$cant:$monto<br>select nro_contrato,contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle status_contrato='ACTIVO'  and $consult  and contrato.status_contrato='ACTIVO' and  id_zona='$id_zona' and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 <br>";
			//	$fecha=restames($fecha);
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
			//ECHO "<br><br><br>$id_zona";
		}
		
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
$pdf->titulo_analisis=$titulo_analisis;                   
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage('L','letter');
//$pdf->Titulo();
//$pdf->Fecha();
$pdf->Cuerpo($acceso,$id_f);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 