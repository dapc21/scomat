<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_f=$_GET['id_franq'];

	if($id_f!='0'){
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_analisis="RESUMEN DE CARTERA POR COBRADOR DE $nombre_franq";
	}
	else{
		$titulo_analisis='RESUMEN DE CARTERA POR COBRADOR GENERAL';
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
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,50,20,12,20,12,20,12,20,12,20,25,27);
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		$this->Cell($w[0],5,strtoupper(_("NRO")),"LRT",0,'C',1);
		$this->Cell($w[1],5,strtoupper(_("cobrador")),"LRT",0,'C',1);
		$this->Cell($w[2],5,strtoupper(_("sin")),1,0,'C',1);
		$this->Cell($w[3]+$w[4],5,strtoupper(_("30 dias")),1,0,'C',1);
		$this->Cell($w[5]+$w[6],5,strtoupper(_("60 dias")),1,0,'C',1);
		$this->Cell($w[7]+$w[8],5,strtoupper(_("90 dias")),1,0,'C',1);
		$this->Cell($w[9]+$w[10],5,strtoupper(_("+90 dias")),1,0,'C',1);
		$this->Cell($w[11],5,strtoupper(_("abonados")),"LRT",0,'C',1);
		$this->Cell($w[12],5,strtoupper(_("total")),"LRT",0,'C',1);
		
		$this->Ln();
		$this->SetX(10);
		$this->Cell($w[0],5,strtoupper(_("")),"LRB",0,'C',1);
		$this->Cell($w[1],5,strtoupper(_("")),"LRB",0,'C',1);
		$this->Cell($w[2],5,strtoupper(_("deuda")),"LRB",0,'C',1);
		$this->Cell($w[3],5,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[4],5,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[5],5,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[6],5,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[7],5,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[8],5,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[9],5,strtoupper(_("cant")),1,0,'C',1);
		$this->Cell($w[10],5,strtoupper(_("Bs.")),1,0,'C',1);
		$this->Cell($w[11],5,strtoupper(_("")),"LRB",0,'C',1);
		$this->Cell($w[12],5,strtoupper(_("")),"LRB",0,'C',1);
		
		$this->Ln();
		return $w;
	}
	function Cuerpo($acceso,$id_f)
	{
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_w=" where  id_franq='$id_f'";
		}
		$w=$this->TituloCampos();
		
		$where="select nombre,apellido ";
		$fecha=date("Y-m-01");
	
		$fecha=date("Y-m-01");
		$d_30=date("Y-m-01");
		list($anio,$mes,$dia)=explode("-",$d_30);
		$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $anio ));
		$fec_fin="$anio-$mes-$ult_dia_mes";	
		$fecha=restames($fecha);
		$d_60=$fecha;
		$fecha=restames($fecha);
		$d_90=$fecha;
		$fecha=restames($fecha);
		$d_mas90=$fecha;
		
	//	ECHO "<br>$fec_fin<br>$d_30<br>$d_60<br>$d_90<br>";
		

		$cable=conexion();
		//$where=$where." from vista_cobrador order by nombre limit 100 offset 1";
		//echo "select id_persona,nombre,apellido,(select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona=vista_cobrador.id_persona ) as total  from vista_cobrador $consult_w order by nombre, apellido  ";
		$acceso->objeto->ejecutarSql("select id_persona,nombre,apellido,(select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona=vista_cobrador.id_persona ) as total  from vista_cobrador $consult_w order by nombre, apellido  ");
		//echo $where;
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$this->SetTextColor(0);
		$a1=0;
		$a2=0;
		$a3=0;
		$a4=0;
		$a5=0;
		$a6=0;
		$s1=0;
		$s2=0;
		$s3=0;
		$s4=0;
		$s5=0;
		$s6=0;
		
		while ($row=row($acceso))
		{
			$id_persona=trim($row["id_persona"]);
			$total_abo=trim($row["total"]);
			
			$cable->objeto->ejecutarSql("select count(*) as cont from contrato where  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona='$id_persona' and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst <= '$fec_fin'  and costo_cobro>0 )<=0");
			$row1=row($cable);
			$sin_deuda=trim($row1['cont'])+0;
			
			$cable->objeto->ejecutarSql("select count(*) as cont from contrato where  contrato.status_contrato='ACTIVO' and  contrato.cod_id_persona='$id_persona' and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst <= '$fec_fin'  and costo_cobro>0 )>0 ");
			$row1=row($cable);
			$a_30_dias=trim($row1['cont'])+0;
			
			$cable->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda,contrato where  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona='$id_persona' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst <= '$fec_fin' ");
			$row1=row($cable);
			$monto_a_30_dias=trim($row1['monto'])+0;
			$monto_total=trim($row1['monto'])+0;
			
			$cable->objeto->ejecutarSql("select count(*) as cont from contrato where  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona='$id_persona' and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$d_30'  and costo_cobro>0 )>0 ");
			$row1=row($cable);
			$a_60_dias=trim($row1['cont'])+0;
			
			$cable->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda,contrato where  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona='$id_persona' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$d_30'");
			$row1=row($cable);
			$monto_a_60_dias=trim($row1['monto'])+0;
			
			$cable->objeto->ejecutarSql("select count(*) as cont from contrato where  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona='$id_persona' and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$d_60'  and costo_cobro>0 )>0 ");
			$row1=row($cable);
			$a_90_dias=trim($row1['cont'])+0;
			
			$cable->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda,contrato where  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona='$id_persona' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$d_60'");
			$row1=row($cable);
			$monto_a_90_dias=trim($row1['monto'])+0;
			
			$cable->objeto->ejecutarSql("select count(*) as cont from contrato where  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona='$id_persona' and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$d_90'  and costo_cobro>0 )>0 ");
			$row1=row($cable);
			$a_mas_90_dias=trim($row1['cont'])+0;
			
			$cable->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda,contrato where  contrato.status_contrato='ACTIVO' and contrato.cod_id_persona='$id_persona' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$d_90'");
			$row1=row($cable);
			$monto_a_mas_90_dias=trim($row1['monto'])+0;
			
			
			$monto_a_30_dias=$monto_a_30_dias-$monto_a_60_dias;
			$monto_a_60_dias=$monto_a_60_dias-$monto_a_90_dias;
			$monto_a_90_dias=$monto_a_90_dias-$monto_a_mas_90_dias;
			
			$a_30_dias=$a_30_dias-$a_60_dias;
			$a_60_dias=$a_60_dias-$a_90_dias;
			$a_90_dias=$a_90_dias-$a_mas_90_dias;
			
			$a1=$a1+$sin_deuda;
			$a2=$a2+$a_30_dias;
			$a3=$a3+$a_60_dias;
			$a4=$a4+$a_90_dias;
			$a5=$a5+$a_mas_90_dias;
			$a6=$a6+$total_abo;
			
			$s1=$s1+$monto_a_30_dias;
			$s2=$s2+$monto_a_60_dias;
			$s3=$s3+$monto_a_90_dias;
			$s4=$s4+$monto_a_mas_90_dias;
			$s5=$s5+$monto_total;
			
			
			$this->SetFont('Arial','',8);
			$this->SetX(10);
			$this->Cell($w[0],5,$cont,"0",0,'C',$fill);
			$this->Cell($w[1],5,strtoupper(utf8_d(trim($row["nombre"])." ".trim($row["apellido"]))),"0",0,'L',$fill);
			$this->Cell($w[2],5,$sin_deuda,"0",0,'C',$fill);
			$this->Cell($w[3],5,$a_30_dias,0,0,'C',$fill);
			$this->Cell($w[4],5,number_format($monto_a_30_dias+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[5],5,$a_60_dias,0,0,'C',$fill);
			$this->Cell($w[6],5,number_format($monto_a_60_dias+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[7],5,$a_90_dias,0,0,'C',$fill);
			$this->Cell($w[8],5,number_format($monto_a_90_dias+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[9],5,$a_mas_90_dias,0,0,'C',$fill);
			$this->Cell($w[10],5,number_format($monto_a_mas_90_dias+0, 2, ',', '.'),0,0,'R',$fill);
			$this->SetFont('Arial','B',8);
			$this->Cell($w[11],5,$total_abo,"0",0,'C',$fill);
			
			$this->Cell($w[12],5,number_format($monto_total+0, 2, ',', '.'),"0",0,'R',$fill);

			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		
			$this->SetFont('Arial','B',8);
			$this->SetX(10);
			$this->Cell($w[0]+$w[1],5,"TOTAL GENERAL","0",0,'L',$fill);
			$this->Cell($w[2],5,$a1,"0",0,'C',$fill);
			$this->Cell($w[3],5,$a2,0,0,'C',$fill);
			$this->Cell($w[4],5,number_format($s1+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[5],5,$a3,0,0,'C',$fill);
			$this->Cell($w[6],5,number_format($s2+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[7],5,$a4,0,0,'C',$fill);
			$this->Cell($w[8],5,number_format($s3+0, 2, ',', '.'),0,0,'R',$fill);
			$this->Cell($w[9],5,$a5,0,0,'C',$fill);
			$this->Cell($w[10],5,number_format($s4+0, 2, ',', '.'),0,0,'R',$fill);
			$this->SetFont('Arial','B',8);
			$this->Cell($w[11],5,$a6,"0s",0,'C',$fill);
			
			$this->Cell($w[12],5,number_format($s5+0, 2, ',', '.'),"0",0,'R',$fill);

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