<?php

require('../include/FPDF/fpdf.php');

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];


$fecha=$_GET['fecha'];
if($fecha==""){
			$fecha=date("Y-m-d");
		}
		else{
			$fecha=formatfecha($fecha);
		}
		
$id_f=$_GET['id_f'];
session_start();
	//$_SESSION["id_franq"] = $id_f; 
	
	if($id_f!='0'){
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_cierre="CIERRE DIARIO ADMINISTRATIVO DE $nombre_franq";
	}
	else{
		$titulo_cierre='CIERRE DIARIO ADMINISTRATIVO GENERAL';
	}
class PDF extends FPDF
{
	private $ancho_t;
		private $ancho;
		private $vacio;
		private $l;
		private $r;
		private $t;
		private $b;
		private $tbr;
		private $tbl;
		private $tblr;
		private $tb;
		private $lr;
		private $lrb;
		private $lb;
		private $rb;
		private $lrt;
		private $fondo_t;
	
	function config_style()
	{
		/*
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);
		
		$this->ancho_t=6;
		$this->ancho=5;
		$this->fondo_t="1";
		
		
		$this->vacio="1";
		$this->l="1";
		$this->r="1";
		$this->t="1";
		$this->b="1";
		$this->tb="1";
		$this->lr="1";
		$this->lb="1";
		$this->rb="1";
		$this->tbr="1";
		$this->tbl="1";
		$this->lrb="1";
		$this->lrt="1";
		$this->tblr="1";
		
		*/
		$this->SetFillColor(244,249,255);
		//$this->SetDrawColor(225,240,255);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);
		
		$this->ancho_t=6;
		$this->ancho=5;
		$this->fondo_t="1";
		
		$this->vacio="0";
		$this->l="L";
		$this->r="R";
		$this->t="T";
		$this->b="B";
		$this->tb="TB";
		$this->lr="LR";
		$this->lb="LB";
		$this->rb="RB";
		$this->tbr="TBR";
		$this->tbl="TBL";
		$this->lrb="LRB";
		$this->lrt="LRT";
		$this->tblr="1";
		
		
	}	
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$logo=logo();
		$ancho_logo=ancho_logo();
		$direc_fiscal=direc_fiscal();
		$telef_emp=telef_emp();
		
		$this->Image("../imagenes/$logo",10,5,$ancho_logo);
		$this->SetFont('Arial','',12);
		$this->SetXY(50,5);
		$this->MultiCell(190,5,nombre_empresa(),'0','L');
	//	$this->MultiCell(190,5,"CABLE, C.A.",'0','L');
		$this->SetFont('Arial','',10);
		$this->SetX(50)	;
		$this->MultiCell(190,5,strtoupper(_(tipo_serv())),'0','L');
		//$this->Ln();
	}
	
	
	//Titulo del reporte
	function Titulo($titulo_cierre)
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->SetX(50)	;
		$this->MultiCell(190,7,strtoupper(_("$titulo_cierre")),'0','L');
		
		$this->SetFont('Arial','B',8);
		$this->SetXY(135,5);
		$this->Cell(30,5,strtoupper(_('fecha Impresion')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(20,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("H:i:s"),0,0,'L');
		$this->Ln();		
		
	}
	
	function Cuerpo($acceso,$fecha,$id_f)
	{
		$this->SetDrawColor(225,240,255);
		$tipo_caja=verCajaPrincipal($acceso);
		//$fecha=date("Y-m-d");
		
		if($fecha==""){
			$fecha=date("Y-m-d");
		}
		else{
			$fecha=formatfecha($fecha);
		}
		$desde=date("Y-m-01");
		$hasta=$fecha;
		//list($ano,$mes,$dia)=explode("-",$fecha);
		//$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $ano ));
		
		$right=10;
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
			$consult_fw=" where id_franq='$id_f'";
		}
		else{
		//	echo ":$id_f:";
			$consult_g=" and  id_franq='0'";
		}
	//	echo "SELECT *FROM cirre_diario where fecha_cierre='$fecha' and id_franq='$id_f'";
	
		
			
			
		$w=array(45,10,25);	
	
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=10;
		$top=15;
		
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BIU',8);
			
			
		$this->Ln(7);
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen por forma de pago')),"0",0,"L");
			
			$this->SetX($right)	;
			$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("forma de pago")),"TBL",0,"L");
				$this->Cell($w[1],5,strtoupper(_("CANT")),"TB",0,"C");
				$this->Cell($w[2],5,strtoupper(_("total"))." ","TBR",0,"R");
				
				
			$this->SetFont('Arial','',8);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',8);
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"SELECT *FROM tipo_pago where status_pago='ACTIVO'");
			$suma_c=0;
			$suma_can=0;
			 
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago where  fecha_pago='$fecha' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'  $consult ");
				$suma=0;
				if($row=row($acceso))
				{
					$monto_tp=trim($row["monto_tp"])+0;
					$cant=trim($row["cant"])+0;
					$suma_c+=$monto_tp;
					$suma_can+=$cant;
					
					$this->Ln();
					
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,trim($dato[$k]["tipo_pago"]),"L",0,"L");
					$this->Cell($w[1],5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($monto_tp+0, 2, ',', '.'),"R",0,"R");
				}
			}
		
		$this->Ln();
			
			$this->SetX($right)	;
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"TOTAL FORMA DE PAGO","TBL",0,"L");
					$this->Cell($w[1],5,$suma_can,"TB",0,"C");
					$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TBR",0,"R");
			
			 $acceso->objeto->ejecutarSql("SELECT  sum(monto_reten) as monto_reten FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_reten>0 and fecha_pago='$fecha' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$monto_reten=trim($row["monto_reten"]);
				}
			 $acceso->objeto->ejecutarSql("SELECT  sum(islr) as islr FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and islr>0 and fecha_pago='$fecha' and status_pago='PAGADO'");
				if($row=row($acceso)){
					$islr=trim($row["islr"]);
				}
				
					$this->Ln();
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell(array_sum($w),5,'ret. IVA  '.number_format($monto_reten+0, 2, ',', '.').' + ret. ISLR '.number_format($islr+0, 2, ',', '.').' + total '.number_format($suma_c+0, 2, ',', '.').' = '.number_format($monto_reten+$islr+$suma_c+0, 2, ',', '.'),"LR",0,"L");			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
					
					$total=$monto_reten+$islr+$suma_c;
					$base=$total/1.12;
					$iva=$base*0.12;
					
					
					$this->Ln();
					$this->SetX($right)	;
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"BASE IMPONIBLE","L",0,"L");
					$this->Cell($w[1],5,"","0",0,"C");
					$this->Cell($w[2],5,number_format($base+0, 2, ',', '.'),"R",0,"R");

					$this->Ln();
					$this->SetX($right)	;
					$this->Cell($w[0],5,"IVA 12%","L",0,"L");
					$this->Cell($w[1],5,"","0",0,"C");
					$this->Cell($w[2],5,number_format($iva+0, 2, ',', '.'),"R",0,"R");

					$this->Ln();
					$this->SetX($right)	;
					$this->Cell($w[0],5,"TOTAL","LB",0,"L");
					$this->Cell($w[1],5,"","B",0,"C");
					$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"RB",0,"R");
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			


		/////////////////////////////////////////////////////////////////////////////////////////////
		
		$this->Ln(7);
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen por medio de cobranza')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("medio de cobranza")),"TBL",0,"L");
				$this->Cell($w[1],5,strtoupper(_("CANT")),"TB",0,"C");
				$this->Cell($w[2],5,strtoupper(_("total"))." ","TBR",0,"R");
				
				
				
			$this->Ln();
			$this->SetFont('Arial','',8);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',8);
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"select distinct caja_externa from caja;");
			$suma_c=0;
			$suma_can=0;
			 
			for($k=0;$k<count($dato);$k++){
				$caja_externa=trim($dato[$k]["caja_externa"]);
				$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as monto FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago='$fecha' and  status_pago='PAGADO' and caja_externa='$caja_externa'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto=trim($row["monto"]);
				
			 
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"$caja_externa","L",0,"L");
					$this->Cell($w[1],5,$cant,"0",0,"C");
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($monto+0, 2, ',', '.'),"R",0,"R");
					$this->Ln();
				}
			}
		
			
			$this->SetX($right)	;
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
			
				$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as monto FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago='$fecha' and  status_pago='PAGADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto=trim($row["monto"]);
				
					$this->SetX($right)	;
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"TOTAL","TBL",0,"L");
					$this->Cell($w[1],5,$cant,"TB",0,"C");
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($monto+0, 2, ',', '.'),"TRB",0,"R");
					$this->Ln();
				}
				
				
				
				

				

		
		$top=15;
		
		$right=100;
		$this->SetXY($right,$top);
		
		
		

		/////////////////////////////////////////////////////////////////////////////////////////////
		
		
		$this->Ln(7);
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen por forma de pago del mes')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("forma de pago")),"TBL",0,"L");
				$this->Cell($w[1],5,strtoupper(_("CANT")),"TB",0,"C");
				$this->Cell($w[2],5,strtoupper(_("total"))." ","TBR",0,"R");
				
				
			$this->SetFont('Arial','',8);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',8);
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"SELECT *FROM tipo_pago where status_pago='ACTIVO'");
			$suma_c=0;
			$suma_can=0;
			 
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
			//	echo "SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago where  fecha_pago between '$desde' and '$hasta'  and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'  $consult ";
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago where  fecha_pago between '$desde' and '$hasta'  and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'  $consult ");
				$suma=0;
				if($row=row($acceso))
				{
					$monto_tp=trim($row["monto_tp"])+0;
					$cant=trim($row["cant"])+0;
					$suma_c+=$monto_tp;
					$suma_can+=$cant;
					
					$this->Ln();
					
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,trim($dato[$k]["tipo_pago"]),"L",0,"L");
					$this->Cell($w[1],5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($monto_tp+0, 2, ',', '.'),"R",0,"R");
				}
			}
		
		$this->Ln();
			
			$this->SetX($right)	;
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->SetX($right)	;
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"TOTAL FORMA DE PAGO","TBL",0,"L");
					$this->Cell($w[1],5,$suma_can,"TB",0,"C");
					$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TBR",0,"R");
			
			 $acceso->objeto->ejecutarSql("SELECT  sum(monto_reten) as monto_reten FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_reten>0 and fecha_pago between '$desde' and '$hasta'  and status_pago='PAGADO'");
				if($row=row($acceso)){
					$monto_reten=trim($row["monto_reten"]);
				}
			 $acceso->objeto->ejecutarSql("SELECT  sum(islr) as islr FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and islr>0 and fecha_pago between '$desde' and '$hasta'  and status_pago='PAGADO'");
				if($row=row($acceso)){
					$islr=trim($row["islr"]);
				}
				
					$this->Ln();
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell(array_sum($w),5,'ret. IVA  '.number_format($monto_reten+0, 2, ',', '.').' + ret. ISLR '.number_format($islr+0, 2, ',', '.').' + total '.number_format($suma_c+0, 2, ',', '.').' = '.number_format($monto_reten+$islr+$suma_c+0, 2, ',', '.'),"LR",0,"L");			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
					
					$total=$monto_reten+$islr+$suma_c;
					$base=$total/1.12;
					$iva=$base*0.12;
					
					$this->Ln();
					$this->SetX($right)	;
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"BASE IMPONIBLE","L",0,"L");
					$this->Cell($w[1],5,"","0",0,"C");
					$this->Cell($w[2],5,number_format($base+0, 2, ',', '.'),"R",0,"R");

					$this->Ln();
					$this->SetX($right)	;
					$this->Cell($w[0],5,"IVA 12%","L",0,"L");
					$this->Cell($w[1],5,"","0",0,"C");
					$this->Cell($w[2],5,number_format($iva+0, 2, ',', '.'),"R",0,"R");

					$this->Ln();
					$this->SetX($right)	;
					$this->Cell($w[0],5,"TOTAL","LB",0,"L");
					$this->Cell($w[1],5,"","B",0,"C");
					$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"RB",0,"R");


		
		
		$this->Ln(7);
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen por medio de cobranza DEL MES')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("medio de cobranza")),"TBL",0,"L");
				$this->Cell($w[1],5,strtoupper(_("CANT")),"TB",0,"C");
				$this->Cell($w[2],5,strtoupper(_("total"))." ","TBR",0,"R");
				
				
				
			$this->Ln();
			$this->SetFont('Arial','',8);
			
			
			$this->SetX($right)	;
			
			$this->SetFont('Arial','',8);
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"select distinct caja_externa from caja;");
			$suma_c=0;
			$suma_can=0;
			 
			for($k=0;$k<count($dato);$k++){
				$caja_externa=trim($dato[$k]["caja_externa"]);
				$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago+monto_reten+islr) as monto FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago between '$desde' and '$hasta' and  status_pago='PAGADO' and caja_externa='$caja_externa'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto=trim($row["monto"]);
				
			 
				
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"$caja_externa","L",0,"L");
					$this->Cell($w[1],5,$cant,"0",0,"C");
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($monto+0, 2, ',', '.'),"R",0,"R");
					$this->Ln();
				}
			}
		
			
			$this->SetX($right)	;
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
			
				$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago+monto_reten+islr) as monto FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago between '$desde' and '$hasta' and  status_pago='PAGADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto=trim($row["monto"]);
				
					$this->SetX($right)	;
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"TOTAL","TBL",0,"L");
					$this->Cell($w[1],5,$cant,"TB",0,"C");
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($monto+0, 2, ',', '.'),"TBR",0,"R");
					$this->Ln();
				}
				
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		
	}
	function ordenes_pendientes_semanas($acceso,$fecha,$id_f,$setx,$sety)
	{
		$w=array(45,18,18);	
		$this->config_style();
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		$fecha=date("Y-m-d");
		list($ano,$mes,$dia)=explode("-",$fecha);
		$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $ano ));
		//$mes="08";
		$fecha_ini="$ano-$mes-01";
		$fecha_sna1_ini="$ano-$mes-01";
		$fecha_sna1_fin="$ano-$mes-07";
		$fecha_sna2_ini="$ano-$mes-08";
		$fecha_sna2_fin="$ano-$mes-14";
		$fecha_sna3_ini="$ano-$mes-15";
		$fecha_sna3_fin="$ano-$mes-21";
		$fecha_sna4_ini="$ano-$mes-22";
		$fecha_sna4_fin="$ano-$mes-$ult_dia_mes";
		
		//echo "$fecha:$fecha_6_10:$fecha_11_20:$fecha_mas_20";
		$right=$setx; $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('RESUMEN DE PAGO POR COBRADOR SEMANAL')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','',8);
		$this->Cell($w[0],$this->ancho_t-2,strtoupper(_("")),0,0,"L",0);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2],$this->ancho_t-2,strtoupper(_("SEMANA 1")),$this->lrt,0,"C",$this->fondo_t);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2],$this->ancho_t-2,strtoupper(_("SEMANA 2")),$this->lrt,0,"C",$this->fondo_t);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2],$this->ancho_t-2,strtoupper(_("SEMANA 3")),$this->lrt,0,"C",$this->fondo_t);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2],$this->ancho_t-2,strtoupper(_("SEMANA 4")),$this->lrt,0,"C",$this->fondo_t);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2]+$w[2],$this->ancho_t-2,strtoupper(_("totales")),$this->tblr,0,"C",$this->fondo_t);
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t-2,strtoupper(_("DESCRIPCION")),$this->tblr,0,"L",$this->fondo_t);
		$this->SetFont('Arial','',8);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("VENTAS")),$this->lb,0,"R",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("COBRAN.")),$this->rb,0,"R",$this->fondo_t);
		
		$this->Cell(3,$this->ancho_t-2,"",0,0,"R");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("VENTAS")),$this->lb,0,"R",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("COBRAN.")),$this->rb,0,"R",$this->fondo_t);
		
		$this->Cell(3,$this->ancho_t-2,"",0,0,"R");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("VENTAS")),$this->lb,0,"R",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("COBRAN.")),$this->rb,0,"R",$this->fondo_t);
		
		$this->Cell(3,$this->ancho_t-2,"",0,0,"R");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("VENTAS")),$this->lb,0,"R",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("COBRAN.")),$this->rb,0,"R",$this->fondo_t);
		
		$this->Cell(3,$this->ancho_t-2,"",0,0,"R");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("VENTAS")),$this->lb,0,"R",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("COBRAN.")),$this->rb,0,"R",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("TOTAL")),$this->rb,0,"R",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_a=0;
		$suma_i=0;
		
		$suma_a1=0;
		$suma_i1=0;
		
		$suma_a2=0;
		$suma_i2=0;
		
		$suma_a3=0;
		$suma_i3=0;
		
				
				$dato=lectura($acceso,"SELECT id_persona,nombre,apellido FROM vista_cobrador where id_persona<>''  $consult  ORDER BY nombre,apellido ");
				for($j=0;$j<count($dato);$j++){
					$id_persona=trim($dato[$j]["id_persona"]);
					$nombre_det_orden=substr(trim($dato[$j]["nombre"])." ".trim($dato[$j]["apellido"]),0,24);
					$suma_t=0;
					$suma_t2=0;
					
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,strtoupper($nombre_det_orden),$this->lr,0,'L');
					$this->Cell(3,$this->ancho_t-2,"",0,0,"R");
				//	echo "SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna1_ini' and '$fecha_sna1_fin' AND status_pago='PAGADO' and (id_serv='AO00002' or id_serv='BM00001')<br>";
					
					$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna1_ini' and '$fecha_sna1_fin' AND status_pago='PAGADO' and (id_serv='AO00002' or id_serv='BM00001') ");
					
					$row=row($acceso);
					$cant=trim($row["monto"])+0;
					$suma_t+=$cant;
					$suma_a+=$cant;
					$this->Cell($w[1],$this->ancho,number_format($cant+0, 2, ',', '.'),$this->l,0,"R");
					
					$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna1_ini' and '$fecha_sna1_fin' AND status_pago='PAGADO' and (id_serv<>'AO00002' and id_serv<>'BM00001') ");
					$row=row($acceso);
					$cant=trim($row["monto"])+0;
					$suma_t2+=$cant; 
					$suma_i+=$cant;
					$this->Cell($w[1],$this->ancho,number_format($cant+0, 2, ',', '.'),$this->r,0,"R");
					
					
					$this->Cell(3,$this->ancho_t-2,"",0,0,"R");
					
					
					$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna2_ini' and '$fecha_sna2_fin' AND status_pago='PAGADO' and (id_serv='AO00002' or id_serv='BM00001') ");
					$row=row($acceso);
					$cant=trim($row["monto"])+0;
					$suma_t+=$cant;
					$suma_a1+=$cant;
					$this->Cell($w[1],$this->ancho,number_format($cant+0, 2, ',', '.'),$this->l,0,"R");
					
					$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna2_ini' and '$fecha_sna2_fin' AND status_pago='PAGADO' and (id_serv<>'AO00002' and id_serv<>'BM00001') ");
					$row=row($acceso);
					$cant=trim($row["monto"])+0;
					$suma_t2+=$cant; 
					$suma_i1+=$cant;
					$this->Cell($w[1],$this->ancho,number_format($cant+0, 2, ',', '.'),$this->r,0,"R");
					
					
					$this->Cell(3,$this->ancho_t-2,"",0,0,"R");
					$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna3_ini' and '$fecha_sna3_fin' AND status_pago='PAGADO' and (id_serv='AO00002' or id_serv='BM00001') ");
					$row=row($acceso);
					$cant=trim($row["monto"])+0;
					$suma_t+=$cant; 
					$suma_a2+=$cant;
					$this->Cell($w[1],$this->ancho,number_format($cant+0, 2, ',', '.'),$this->l,0,"R");
					
					$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna3_ini' and '$fecha_sna3_fin' AND status_pago='PAGADO' and (id_serv<>'AO00002' and id_serv<>'BM00001') ");
					$row=row($acceso);
					$cant=trim($row["monto"])+0;
					$suma_t2+=$cant; 
					$suma_i2+=$cant;
					$this->Cell($w[1],$this->ancho,number_format($cant+0, 2, ',', '.'),$this->r,0,"R");
					
					
					$this->Cell(3,$this->ancho_t-2,"",0,0,"R");
					$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna4_ini' and '$fecha_sna4_fin' AND status_pago='PAGADO' and (id_serv='AO00002' or id_serv='BM00001') ");
					$row=row($acceso);
					$cant=trim($row["monto"])+0;
					$suma_t+=$cant;
					$suma_a3+=$cant;
					$this->Cell($w[1],$this->ancho,number_format($cant+0, 2, ',', '.'),$this->l,0,"R");
					
					//echo "SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna4_ini' and '$fecha_sna4_fin' AND status_pago='PAGADO' and (id_serv<>'AO00002' and id_serv<>'BM00001')<br> ";
					
					$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as monto FROM vista_pago_ser where  id_persona='$id_persona' $consult   and fecha_pago between '$fecha_sna4_ini' and '$fecha_sna4_fin' AND status_pago='PAGADO' and (id_serv<>'AO00002' and id_serv<>'BM00001') ");
					$row=row($acceso);
					$cant=trim($row["monto"])+0;
					$suma_t2+=$cant; 
					$suma_i3+=$cant;
					$this->Cell($w[1],$this->ancho,number_format($cant+0, 2, ',', '.'),$this->r,0,"R");
					
					
					$this->SetFont('Arial','B',8);
					$this->Cell(3,$this->ancho,"",0,0,"R");
					$this->Cell($w[1],$this->ancho,number_format($suma_t+0, 2, ',', '.'),$this->l,0,"R");
					$this->Cell($w[1],$this->ancho,number_format($suma_t2+0, 2, ',', '.'),$this->vacio,0,"R");
					$this->Cell($w[2],$this->ancho,number_format($suma_t+$suma_t2+0, 2, ',', '.'),$this->r,0,"R");
					$this->SetFont('Arial','',8);
					
					
					$this->Ln();
					
					
					
				}
					
					
				
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tblr,0,'J');	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"R");
				$this->Cell($w[1],$this->ancho_t,number_format($suma_a+0, 2, ',', '.'),$this->lb,0,"R");	
				$this->Cell($w[1],$this->ancho_t,number_format($suma_i+0, 2, ',', '.'),$this->rb,0,"R");	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"R");
				$this->Cell($w[1],$this->ancho_t,number_format($suma_a1+0, 2, ',', '.'),$this->lb,0,"R");	
				$this->Cell($w[1],$this->ancho_t,number_format($suma_i1+0, 2, ',', '.'),$this->rb,0,"R");	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"R");
				$this->Cell($w[1],$this->ancho_t,number_format($suma_a2+0, 2, ',', '.'),$this->lb,0,"R");	
				$this->Cell($w[1],$this->ancho_t,number_format($suma_i2+0, 2, ',', '.'),$this->rb,0,"R");	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"R");
				$this->Cell($w[1],$this->ancho_t,number_format($suma_a3+0, 2, ',', '.'),$this->lb,0,"R");	
				$this->Cell($w[1],$this->ancho_t,number_format($suma_i3+0, 2, ',', '.'),$this->rb,0,"R");	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"R");
				$this->Cell($w[1],$this->ancho_t,number_format($suma_a+$suma_a1+$suma_a2+$suma_a3+0, 2, ',', '.'),$this->lb,0,"R");	
				$this->Cell($w[1],$this->ancho_t,number_format($suma_i+$suma_i1+$suma_i2+$suma_i3+0, 2, ',', '.'),$this->b,0,"R");	
				$this->Cell($w[1],$this->ancho_t,number_format($suma_a+$suma_i+$suma_a1+$suma_i1+$suma_a2+$suma_i2+$suma_a3+$suma_i3+0, 2, ',', '.'),$this->rb,0,"R");	
					
		
			$this->Ln(10);
	}
	
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,10);
//agrega una nueva pagina
//$pdf->AddPage('L','letter');
//$pdf->AddPage('L','letter');
/*
$pdf->AddPage('L','letter');
$pdf->Titulo($titulo_cierre);
$pdf->Cuerpo($acceso,$fecha,$id_f);

$pdf->ordenes_pendientes_semanas($acceso,$fecha,$id_f,10,124);

*/
		if($fecha==""){
			$fecha=date("Y-m-d");
		}
		else{
			$fecha=formatfecha($fecha);
		}
		$cable=conexion();
		$cable->objeto->ejecutarSql("SELECT id_franq,nombre_franq FROM franquicia order by id_franq ");
		while($row=row($cable)){
			$id_f=trim($row["id_franq"]);
			$nombre_franq=trim($row["nombre_franq"]);
			if($id_f!='0'){
				$titulo_cierre="CIERRE DIARIO ADMINISTRATIVO DE $nombre_franq";
			}
			
			$pdf=new PDF(); 
			$pdf->SetAutoPageBreak(true,10);
			$pdf->AddPage('L','letter');
			$pdf->Titulo($titulo_cierre);
			$pdf->Cuerpo($acceso,$fecha,$id_f);
			$pdf->ordenes_pendientes_semanas($acceso,$fecha,$id_f,10,124);
			
			$pdf->Output("../archivos/$id_f/$fecha cierre_administrativo.pdf",'F');
		}
		
			$id_f='0';
			$nombre_franq=trim($row["nombre_franq"]);
			
				$titulo_cierre='CIERRE DIARIO ADMINISTRATIVO GENERAL';
			
			
			$pdf=new PDF();              
			$pdf->SetAutoPageBreak(true,10);
			$pdf->AddPage('L','letter');
			$pdf->Titulo($titulo_cierre);
			$pdf->Cuerpo($acceso,$fecha,$id_f);
			$pdf->ordenes_pendientes_semanas($acceso,$fecha,$id_f,10,124);
			
			$pdf->Output("../archivos/general/$fecha cierre_administrativo.pdf",'F');
			
			header('Location: Rep_CierreDiarioImpreso_general_a.php');


			
?> 