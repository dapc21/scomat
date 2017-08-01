<?php
require('../include/FPDF/fpdf.php');

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$desde = formatfecha($_GET['desde']);
$hasta = formatfecha($_GET['hasta']);


$id_f=$_GET['id_franq'];
$descuento_conf=$_GET['descuento_conf']+0;
$desc_confc=$_GET['desc_confc'];

session_start();
	//$_SESSION["id_franq"] = $id_f; 
	
	if($id_f!='0'){
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_cierre="CALCULO DE COMISIONES DE $nombre_franq";
	}
	else{
		$titulo_cierre='CALCULO DE COMISIONES GENERAL';
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
		
		$this->Image("../imagenes/$logo",20,15,$ancho_logo);
		$this->SetFont('Arial','B',12);
		$this->SetXY(20,20)	;
		$this->MultiCell(235,5,nombre_empresa(),'0','R');
	//	$this->MultiCell(190,5,"CABLE, C.A.",'0','L');
		$this->SetFont('Arial','B',10);
		$this->SetX(20)	;
		$this->MultiCell(235,5,strtoupper(_(tipo_serv())),'0','R');
		//$this->Ln(8);
	}

	function Titulo($titulo_cierre)
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->SetX(20)	;
		$this->MultiCell(235,7,strtoupper(_("$titulo_cierre")),'0','R');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,70,25,20,20,25,80);
		$header=array(strtoupper(_('nro')),strtoupper(_('Estacion de trabajo')),strtoupper(_('reporte z')),strtoupper(_('fecha')),strtoupper(_('hora')),strtoupper(_('TOTAL')),strtoupper(_('OBSERVACION')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$desde,$hasta,$id_f,$descuento_conf,$desc_confc)
	{
		$tipo_caja=verCajaPrincipal($acceso);
		//$fecha=date("Y-m-d");
		
		
		
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
			$consult_fw=" where id_franq='$id_f'";
		}
		else{
		//	echo ":$id_f:";
			$consult_g=" and  id_franq='0'";
		}
	
		$desde_t=formatofecha($desde);
		$hasta_t=formatofecha($hasta);
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		
	
		$acceso->objeto->ejecutarSql("select * from vista_confcomision where id_franq='$id_f' and status_confc='ACTIVO'");
			 
				if($row=row($acceso)){
					$nombre_franq=trim($row["nombre_franq"]);
					
					$porc_acord=trim($row["porc_acord"])+0;
					$porc_ret_iva=trim($row["porc_ret_iva"])+0;
					$porc_ret_islr=trim($row["porc_ret_islr"])+0;
					//$descuento_conf=trim($row["descuento_conf"])+0;
					$tipo_e_p=trim($row["tipo_e_p"]);
					$empresa_confc=trim($row["empresa_confc"]);
					$rif_empresa=trim($row["rif_empresa"]);
					$represen_confc=trim($row["represen_confc"]);
					$cedula_rep=trim($row["cedula_rep"]);
				//	$desc_confc=trim($row["desc_confc"]);
				}
				
	
		$this->SetFillColor(197,217,241);
		
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=20;
		$top=45;
		
			$this->SetXY($right,$top);
			$this->SetFont('Arial','',10);
			$this->Cell(50,6,"Nº COMPROBANTE: ","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(25,6,"0000001","0",0,"L",1);
			
			$this->Ln(8);
			$this->SetX(20);
			$this->SetFont('Arial','',10);
			$this->Cell(50,6,"FECHA DE ELABORACION: ","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(25,6,formatofecha(date("d/m/Y")),"0",0,"L",1);
			
			$this->Ln(8);
			$this->SetX(20);
			$this->SetFont('Arial','',10);
			$this->Cell(50,6,"PERIODO      DESDE ","0",0,"L");
			
			$this->SetFont('Arial','',10);
			$this->Cell(25,6,formatofecha($desde_t),"0",0,"L",1);
			$this->Cell(25,6,"HASTA:","0",0,"C");
			$this->SetFont('Arial','',10);
			$this->Cell(25,6,formatofecha($hasta_t),"0",0,"L",1);
			
			
			$this->Ln(8);
			$this->SetX(20);
			$this->SetFont('Arial','',10);
			$this->Cell(50,6,"EMPRESA: ","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(75,6,$empresa_confc,"0",0,"L",1);
			/*
			$this->SetX(160);
			$this->Cell(25,6,"Rif: ","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(25,6,$rif_empresa,"0",0,"L",1);
			*/
			
			$this->Ln(8);
			$this->SetX(20);
			$this->SetFont('Arial','',10);
			$this->Cell(50,6,"REPRESENTANTE: ","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(75,6,$represen_confc,"0",0,"L",1);
			
			$this->SetX(160);
			$this->Cell(25,6,"NODO: ","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(70,6,$nombre_franq,"0",0,"L",1);
			/*
			$this->SetX(160);
			$this->Cell(25,6,"Rif: ","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(25,6,$cedula_rep,"0",0,"L",1);
			*/
			
			
			$this->SetXY(160,45);
			$this->Cell(60,6,"% ACORDADO EN CONTRATO:","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(20,6,$porc_acord,"0",0,"L",1);
			$this->Cell(15,6,"%","0",0,"R",1);
			
			$this->Ln(8);
			$this->SetX(160);
			$this->Cell(60,6,"% DE RETENCION DE IVA:","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(20,6,$porc_ret_iva,"0",0,"L",1);
			$this->Cell(15,6,"%","0",0,"R",1);
			
			$this->Ln(8);
			$this->SetX(160);
			$this->Cell(60,6,"% DE RETENCION DE ISLR:","0",0,"L");
			$this->SetFont('Arial','',10);
			$this->Cell(20,6,$porc_ret_islr,"0",0,"L",1);
			$this->Cell(15,6,"%","0",0,"R",1);
			
			
			
			
		//	$this->MultiCell(190,7,"$porc_acord $desde_t  Hasta $hasta_t",'0','C');
		
			
			
			
			
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago ) as monto_pago  FROM vista_pago_cont,vista_ubica where vista_pago_cont.id_calle=vista_ubica.id_calle and  vista_ubica.id_franq='$id_f' and fecha_pago between '$desde' and '$hasta'  ");
			 
			$row=row($acceso);
			$total_cob_sis=trim($row["monto_pago"])+0;
			$base_cob_sis=$total_cob_sis/1.12;
			$iva_cob_sis=$base_cob_sis*0.12;
			$monto_comision=$base_cob_sis*$porc_acord/100;
			$base_comision=$monto_comision/1.12;
			$iva_comision=$base_comision*0.12;
			
			$monto_ret_iva=$iva_comision*$porc_ret_iva/100;
			$monto_ret_islr=$base_comision*$porc_ret_islr/100;
			$total_reintegro=$monto_comision-$monto_ret_iva-$monto_ret_islr;
			
			$UT=127;
			$sustraendo=0;
			//ECHO $tipo_e_p;
			if($tipo_e_p=='PERSONA'){ 
				$ingreso_minimo=((1000/12)*$UT);
				//ECHO "MINIMO:$ingreso_minimo:";
				if($base_comision>=$ingreso_minimo){
					$sustraendo=($ingreso_minimo*($porc_ret_islr)/100);
					//$sustraendo=89.16;
				}
			}
			$total_deposito=$total_reintegro-$descuento_conf+$sustraendo;
			
			$this->Ln(10);
			$right=70;
			$right_d=200;
			$top=95;
		
			$this->SetXY($right,$top);
					
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"TOTAL COBRANZAS EN SISTEMA:","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R",1);
					$this->SetFont('Arial','B',10);
					$this->Cell(20,5,number_format($total_cob_sis+0, 2, ',', '.'),"RTB",0,"R",1);
					
					$this->SetX($right_d);
					$this->Cell(55,5,"DATOS PARA FACTURA","1",0,"C");
					
					
					
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"IVA 12 %:","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($iva_cob_sis+0, 2, ',', '.'),"RTB",0,"R");
					
					
					$this->SetX($right_d);
					$this->Cell(30,5,"BASE","1",0,"L");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(18,5,number_format($base_comision+0, 2, ',', '.'),"RTB",0,"R");
					
					
					
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"BASE IMPONIBLE A LIQUIDAR:","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($base_cob_sis+0, 2, ',', '.'),"RTB",0,"R");
					
					$this->SetX($right_d);
					$this->Cell(30,5,"IVA","1",0,"L");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(18,5,number_format($iva_comision+0, 2, ',', '.'),"RTB",0,"R");
					
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"COMISION SEGÚN CONTRATO			$porc_acord	% :","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($monto_comision+0, 2, ',', '.'),"RTB",0,"R");
					
					
					$this->SetX($right_d);
					$this->Cell(30,5,"TOTAL","1",0,"L");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(18,5,number_format($monto_comision+0, 2, ',', '.'),"RTB",0,"R");
					
					
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"IVA FACTURA DESARROLLO:","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($iva_comision+0, 2, ',', '.'),"RTB",0,"R");
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"BASE DE FACTURA DESARROLLO:","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($base_comision+0, 2, ',', '.'),"RTB",0,"R");
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"RETENCION DE IVA			$porc_ret_iva	%","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($monto_ret_iva+0, 2, ',', '.'),"RTB",0,"R");
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"RETENCION DE ISLR  $porc_ret_islr %","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($monto_ret_islr+0, 2, ',', '.'),"RTB",0,"R");
					$this->Ln();
										
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"SUSTRAENDO","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($sustraendo+0, 2, ',', '.'),"RTB",0,"R");
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"TOTAL A REINTEGRAR AL DESARROLLO:","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($total_reintegro+0, 2, ',', '.'),"RTB",0,"R");
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','',10);
					$this->Cell(75,5,"** DESCUENTO:","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R");
					$this->Cell(20,5,number_format($descuento_conf+0, 2, ',', '.'),"RTB",0,"R");
					$this->Ln();
					
					$this->SetX($right);
					$this->SetFont('Arial','B',10);
					$this->Cell(75,5,"TOTAL A DEPOSITAR AL DESARROLLO:","1",0,"R");
					$this->Cell(7,5,"Bs.","LTB",0,"R",1);
					$this->SetFont('Arial','B',10);
					$this->Cell(20,5,number_format($total_deposito+0, 2, ',', '.'),"RTB",0,"R",1);
					$this->Ln(9);
				
					$this->SetX(20);
					$this->SetFont('Arial','',10);
					$this->Cell(50,5,"DESCRIPCION DESCUENTO","0",0,"L");
					$this->MultiCell(102,5,strtoupper("$desc_confc"),"1","L");
					
					$this->Ln(12);
					
				
					$y=$this->GetY();
					$this->SetX(40);
					$this->SetFont('Arial','B',10);
					$this->Cell(50,5,"MANUEL COLMENARES","B",0,"C",1);
					$this->SetFont('Arial','I',10);
					$this->Ln();
					$this->SetX(40);
					$this->Cell(50,5,"REALIZADO POR","T",0,"C");
					$this->Ln(9);
					
					$this->SetXY(110,$y);
					$this->SetFont('Arial','B',10);
					$this->Cell(50,5,"MANUEL COLMENARES","B",0,"C",1);
					$this->SetFont('Arial','I',10);
					$this->Ln();
					$this->SetX(110);
					$this->Cell(50,5,"REALIZADO POR","T",0,"C");
					$this->Ln(9);
					
					$this->SetXY(180,$y);
					$this->SetFont('Arial','B',10);
					$this->Cell(50,5,"DAYHANA GUALDRON","B",0,"C",1);
					$this->SetFont('Arial','I',10);
					$this->Ln();
					$this->SetX(180);
					$this->Cell(50,5,"PAGADO POR","T",0,"C");
					$this->Ln(9);
					
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-20);
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
	
	
	
	
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,15);
//agrega una nueva pagina
$pdf->AddPage('L','letter');
$pdf->Titulo($titulo_cierre);
$pdf->Cuerpo($acceso,$desde,$hasta,$id_f,$descuento_conf,$desc_confc);
$pdf->Output('reporte.pdf','D');
?> 