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
		$this->MultiCell(190,7,strtoupper(_('reporte de cobranza por cobrador')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,15,23,50,14,13,18,22,20);
		$header=array(strtoupper(_('nro')),strtoupper(_('factura')),strtoupper(_('cedula')),strtoupper(_('nombre')),strtoupper(_('base')),strtoupper(_('iva')),strtoupper(_('total')),strtoupper(_('fecha')),strtoupper(_('status')));
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
	
		
		$acceso->objeto->ejecutarSql("select *from vista_cobrador  where id_persona='$id_persona_cob' order By nombre");
		if($row=row($acceso))
		{
			$nombre=utf8_decode(trim($row["nombre"])." ".trim($row["apellido"]));
			$ncedula=trim($row["cedula"]);
		}
	
		$this->SetFont('Arial','B',10);
		$this->SetX(20);
		$this->Cell(40,5,strtoupper(_("cobrador ")).": ".$nombre." ".strtoupper(_("cedula ")).": ".$ncedula,0,0,'L');
		$this->Ln();
		$this->SetFont('Arial','B',10);
		$this->SetX(20);
		$this->Cell(40,5,strtoupper(_("fecha Desde ")).": ".formatofecha($desde).strtoupper(_("     hasta ")).": ".formatofecha($hasta),0,0,'L');
		
		
		
		$this->Ln();
		
		
		
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=20;
		$top=45;
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de facturacion')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(60,6,strtoupper(_("DESCRIPCION")),"0",0,"L");
				$this->Cell(10,6,strtoupper(_("CANT")),"0",0,"C");
				
				$this->Cell(30,6,strtoupper(_("total"))." ","0",0,"R");
			$this->Ln();
			$this->SetFont('Arial','',9);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',9);
			$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as excento FROM vista_pago,vista_caja where vista_pago.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and  monto_iva=0  and fecha_pago between '$desde' and '$hasta' ");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$excento=trim($row["excento"]);
				}
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"FACTURAS (EXCENTAS)","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($excento+0, 2, ',', '.'),"0",0,"R");
				
			$this->Ln();
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as base_imp, sum(monto_iva) as monto_iva FROM vista_pago,vista_caja where vista_pago.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and  monto_iva>0  and fecha_pago between '$desde' and '$hasta' ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$base_imp=trim($row["base_imp"]);
					
				}
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"FACTURAS (BASE IMPONIBLE)","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($base_imp+0, 2, ',', '.'),"0",0,"R");
				
			$this->Ln();	
			$acceso->objeto->ejecutarSql("SELECT count(*) cant,  sum(monto_iva) as monto_iva FROM vista_pago,vista_caja where vista_pago.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and  monto_iva>0  and fecha_pago between '$desde' and '$hasta' ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto_iva=trim($row["monto_iva"]);
				}
			 
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"IVA (12%)","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($monto_iva+0, 2, ',', '.'),"0",0,"R");
				
				
			$this->Ln();	
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM vista_pago,vista_caja where vista_pago.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob'  and fecha_pago between '$desde' and '$hasta' and  status_pago='ANULADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$total_nc=trim($row["total_nc"]);
				}
			 
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"NOTAS DE CREDITOS","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($total_nc+0, 2, ',', '.'),"0",0,"R");
				
				
				
			$this->Ln();	
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(desc_pago) as desc_pago FROM vista_pago,vista_caja where vista_pago.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and  desc_pago>0  and fecha_pago between '$desde' and '$hasta'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$desc_pago=trim($row["desc_pago"]);
				}
			 
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',9);
					$this->Cell(60,5,"DESCUENTOS","0",0,"L");
					$this->Cell(20,5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,number_format($desc_pago+0, 2, ',', '.'),"0",0,"R");
				
				
		$this->Ln();
		
			$total_facturado=$excento+$base_imp+$monto_iva-$desc_pago-$total_nc;
			$this->SetX($right)	;
			$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
					$this->SetFont('Arial','B',9);
					$this->Cell(60,5,"TOTAL FACTURADO","0",0,"L");
					$this->Cell(20,5,'',"0",0,"C");
					$this->Cell(30,5,number_format($total_facturado+0, 2, ',', '.'),"0",0,"R");
					
		
		
		
		
		$right=20;
		$top=93;
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen por servicios')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell(50,6,strtoupper(_("servicio")),"0",0,"L");
				$this->Cell(10,6,strtoupper(_("cant")),"0",0,"C");
				$this->Cell(20,6,strtoupper(_("costo")),"0",0,"R");
				$this->Cell(25,6,strtoupper(_("Base Imp")),"0",0,"R");
				$this->Cell(25,6,strtoupper(_("total")),"0",0,"R");
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where id_persona='$id_persona_cob' and fecha_pago between '$desde' and '$hasta' and id_serv='$id_serv'  and status_pago='PAGADO'");
				
				$cont=0;
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
						$this->SetX($right);
						$this->SetFont('Arial','',9);
						$this->Cell(50,5,strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"]))).":","0",0,"L");
						$this->Cell(10,5,$cant,"0",0,"C");
						$this->Cell(20,5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($total+0, 2, ',', '.'),"0",0,"R");
					}
				}
			}
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
			$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',9);
						$this->Cell(50,5,strtoupper("total SERVICIOS"),"0",0,"L");
						$this->Cell(10,5,$suma_can,"0",0,"C");
						$this->Cell(20,5,number_format($suma_c+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($suma_d+0, 2, ',', '.'),"0",0,"R");
						$this->Cell(25,5,number_format($total+0, 2, ',', '.'),"0",0,"R");
		
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM vista_pago,vista_caja where vista_pago.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and  monto_iva>0  and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO' ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			
		
		
		
		
		
		
		$this->AddPage();
		$this->Ln();
		
		
		
		//$tipo_caja=verCajaPrincipal($acceso);
		$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		
		
		$acceso->objeto->ejecutarSql("SELECT inicial_doc,fecha_pago,nro_factura,cedulacli,nombrecli,apellidocli,monto_pago,status_pago,tipo_cliente FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta'   and id_persona_cob='$id_persona_cob'  order by nro_factura");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$sumatoria=0.00;
		while ($row=row($acceso))
		{
			$x=0;
			for($j=0;$j<count($ca);$j++)
			{
				if($ca[$j]==trim($row["nro_factura"])){
					$x=1;
				}
			}
			if($x==0){
				$ca[$y]=trim($row["nro_factura"]);
				$y++;
				
				$monto=trim($row["monto_pago"]);
				if(trim($row["status_pago"])=="PAGADO"){
					$sumatoria=$sumatoria+$monto;
				}
				$total_p=$monto;
				$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;
			
				if(trim($row['tipo_cliente'])=="JURIDICO"){
								$cedula=trim($row['inicial_doc'])."-".trim($row['cedulacli']);
				}
				else{
					$cedula=trim($row['cedulacli']);
				}
				$this->SetX(15);
				$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
				$this->Cell($w[1],6,utf8_decode(trim($row["nro_factura"])),"LR",0,"J",$fill);
				$this->Cell($w[2],6,$cedula,"LR",0,"J",$fill);
				$this->Cell($w[3],6,utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])),"LR",0,"J",$fill);
				$this->Cell($w[4],6,number_format($base+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[5],6,number_format($iva+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[6],6,number_format($monto+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[7],6,formatofecha(trim($row["fecha_pago"])),"LR",0,"C",$fill);
				$this->Cell($w[8],6,trim($row["status_pago"]),"LR",0,"C",$fill);

				$this->Ln();
				$fill=!$fill;
				$cont++;
			}
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
		
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