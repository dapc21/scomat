<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_franq = $_GET['id_franq'];
$id_est = $_GET['id_est'];
$id_f = $_SESSION["id_franq"];  

if($id_f!='0'){
	$consult=" and id_franq='$id_f'";
}else{
	if($id_franq!='0'){
		$consult=" and id_franq='$id_franq'";
	}
}

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
function w($x,$y='null'){
	//	echo "<br>$x,$y";
		//$w=array(9,12,16,50,15,15,13,15,15,15,18,23,20,18,15,17,18,18,15,15,15);
		$w=array(9,12,16,50,15,15,15,13,15,15,15,18,23,20,18,15,17,18,18,15,15,15);
		if($y=='null'){
			return $w[$x];
		}
		
		$sum=10;
		for($i=$x;$i<=$y;$i++){
			$sum+=$w[$i];
	//		echo "<br>$i:$x,$y:$sum";
		}
	//	echo "<br>$x,$y:$sum";
		return $sum;
}
class PDF extends FPDF
{
	public $fecha;
	//Cabecera del Reporte aparecera en todas las paginas
	
	function Header()
	{
		list($anio,$mes,$dia) = explode("-",$this->fecha);
		$mes=formato_mes_com($mes);
		$this->SetXY(10,10);
		$this->SetFont('Arial','B',12);
		$this->MultiCell(250,5,nombre_empresa(),'0','J');
		$this->SetFont('Arial','',9);
		$this->MultiCell(250,4,direc_fiscal(),'0','J');
		$this->SetFont('Arial','',12);
		$this->MultiCell(250,5,tipo_serv(),'0','J');

		$this->SetXY(10,10);
		$this->SetFont('Arial','B',12);
$this->MultiCell(330,6,'LIBRO DE VENTAS','0','C');
		$this->SetFont('Arial','',12);
$this->MultiCell(330,6,'CORRESPONDIENTE AL MES DE','0','C');

		$this->SetFont('Arial','B',12);
$this->MultiCell(330,6,strtoupper($mes).' - '.$anio,'0','C');

		
		
		
		$this->SetFillColor(244,249,255);
		//$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		
		//$header=array('1','1');
		$y=30;
		$this->SetXY(10,$y);
		$this->SetFont('times','',7);
		$this->MultiCell(w(0),3,"
No. de
Oper.
 ",1,'C');
		
		$this->SetXY(10+w(0),$y);
		$this->MultiCell(w(1),3,"
Fecha de
Factura
 ",1,'C');

		$this->SetXY(w(0,1),$y);
		$this->MultiCell(w(2),12,"No.RIF",1,'C');

		$this->SetXY(w(0,2),$y);
		$this->MultiCell(w(3),12,"Nombre o Razón Social",1,'C');

		$this->SetXY(w(0,3),$y);
		$this->MultiCell(w(4),3,"
Número
de factura
 ",1,'C');
 
		$this->SetXY(w(0,4),$y);
		$this->MultiCell(w(5),3,"
Maq.
Fiscal
 ",1,'C');

		$this->SetXY(w(0,5),$y);
		$this->MultiCell(w(6),3,"
Tipo de
Transacc.
 ",1,'C');

		$this->SetXY(w(0,6),$y);
		$this->MultiCell(w(7),3,"
No. de
control
 ",1,'C');

		$this->SetXY(w(0,7),$y);
		$this->MultiCell(w(8),3,"
Nro. Nota
de crèdito
 ",1,'C');

		$this->SetXY(w(0,8),$y);
		$this->MultiCell(w(9),4,"No. de
Factura
afectada",1,'C');

		$this->SetXY(w(0,9),$y);
		$this->MultiCell(w(10),4,"Número
comprobante
retención",1,'C');

		$this->SetXY(w(0,10),$y);
		$this->MultiCell(w(11),4,"ISLR
ret. por
Comp.",1,'C');

		$this->SetXY(w(0,11),$y);
		$this->MultiCell(w(12),3,"
Total de Venta
Incluyendo IVA
 ",1,'C');

		$this->SetXY(w(0,12),$y);
		$this->MultiCell(w(13,16)-10,3,"VENTAS INTERNAS A NO CONTRIBUYENTES",1,'C');

		$this->SetXY(w(0,12),$y+3);
		$this->MultiCell(w(13),1,"","T",'C');
		$this->SetXY(w(0,12),$y+4);
		$this->MultiCell(w(13),4,"Ventas NO
GRAVADAS","LRB",'C');

		$this->SetXY(w(0,13),$y+3);
		$this->MultiCell(w(14),1,"","T",'C');
		$this->SetXY(w(0,13),$y+4);
		$this->MultiCell(w(14),4,"Base
Imponible","LRB",'C');

		$this->SetXY(w(0,14),$y+3);
		$this->MultiCell(w(15),1,"","T",'C');
		$this->SetXY(w(0,14),$y+4);
		$this->MultiCell(w(15),4,"%
Alicuota","LRB",'C');

		$this->SetXY(w(0,15),$y+3);
		$this->MultiCell(w(16),1,"","T",'C');
		$this->SetXY(w(0,15),$y+4);
		$this->MultiCell(w(16),4,"Impuesto
IVA","LRB",'C');
		

		$this->SetXY(w(0,16),$y);
		$this->MultiCell(w(17),4,"IVA retenido
(por el
comprador)",1,'C');

		$this->SetXY(w(0,17),$y);
		$this->MultiCell(w(18,22)-10,3,"VTAS INTERNAS A CONTRIBUYENTES ORDINARIOS",1,'C');

		$this->SetXY(w(0,17),$y+3);
		$this->MultiCell(w(18),1,"","T",'C');
		$this->SetXY(w(0,17),$y+4);
		$this->MultiCell(w(18),4,"Ventas NO
GRAVADAS","LRB",'C');

		$this->SetXY(w(0,18),$y+3);
		
		$this->MultiCell(w(19,21)-10,3,"VENTAS GRAVADAS",1,'C');
		

		$this->SetXY(w(0,18),$y+6);
		$this->MultiCell(w(19),3,"Base
Imponible",1,'C');

		$this->SetXY(w(0,19),$y+6);
		$this->MultiCell(w(20),3,"%
Alicuota",1,'C');

		$this->SetXY(w(0,20),$y+6);
		$this->MultiCell(w(21),3,"Impuesto
IVA",1,'C');

	
		
	}
	
	
	function Cuerpo($acceso,$desde,$hasta,$consult,$id_est)
	{
		
		$w=array(9,12,16,50,15,13,15,15,18,23,20,18,15,17,18,18,15,15,15);
		$total_dia=array();
				$total_dia['monto_pago']=0;
				$total_dia['venta_no_g']=0;
				$total_dia['venta_no_g_base']=0;
				$total_dia['venta_no_g_iva']=0;
				$total_dia['monto_reten']=0;
				$total_dia['venta_no_g_emp']=0;
				$total_dia['venta_no_g_emp_base']=0;
				$total_dia['venta_no_g_emp_iva']=0;
				$total_dia['islr']=0;
		$total_general=array();
		$tipo_caja=verCajaPrincipal($acceso);
		//$w=$this->TituloCampos();
		if($id_est!='0'){
			$estacion=" and estacion_trabajo.id_est='$id_est'";
			$estacion1=" and id_est='$id_est'";
		}
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		$cable=conexion();
		
		$acceso->objeto->ejecutarSql("SELECT nro_control,n_credito,monto_reten,islr, base_imp,monto_iva,cont, id_pago, inicial_doc, fecha_pago, nro_factura, cedulacli, nombrecli, apellidocli, monto_pago, status_pago, tipo_cliente, mac_est as imp_fiscal FROM vista_pago_cont,estacion_trabajo where vista_pago_cont.id_est=estacion_trabajo.id_est $estacion AND  fecha_pago between '$desde' and '$hasta' and impresion='SI'  and tipo_caja='PRINCIPAL'  $consult order by fecha_pago,nro_control");
		
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$sumatoria=0.00;
		$this->SetFont('Arial','',6);
		$dia=$desde;
		while ($row=row($acceso))
		{
			$fill=0;	
			if($dia!=trim($row["fecha_pago"])){
				$this->SetFont('Arial','B',8);
				/*
				$this->Cell(w(0,7)-10,6,"SUB-TOTAL DIA ".formatofecha($dia),"0",0,"L",$fill);
				$this->SetFont('Arial','B',6);
				$this->Cell($w[8],4,number_format($total_dia['islr']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[9],4,number_format($total_dia['monto_pago']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[10],4,number_format($total_dia['venta_no_g']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[11],4,number_format($total_dia['venta_no_g_base']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[12],4,'',"0",0,"R",$fill);
				$this->Cell($w[13],4,number_format($total_dia['venta_no_g_iva']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[14],4,number_format($total_dia['monto_reten']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[15],4,number_format($total_dia['venta_no_g_emp']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[16],4,number_format($total_dia['venta_no_g_emp_base']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[17],4,'',"0",0,"R",$fill);
				$this->Cell($w[18],4,number_format($total_dia['venta_no_g_emp_iva']+0, 2, ',', '.'),"0",0,"R",$fill);
				
				*/
				$total_general['islr']+= $total_dia['islr'];
				$total_general['monto_pago']+= $total_dia['monto_pago'];
				$total_general['venta_no_g']+= $total_dia['venta_no_g'];
				$total_general['venta_no_g_base']+= $total_dia['venta_no_g_base'];
				$total_general['venta_no_g_iva']+= $total_dia['venta_no_g_iva'];
				$total_general['monto_reten']+= $total_dia['monto_reten'];
				$total_general['venta_no_g_emp']+= $total_dia['venta_no_g_emp'];
				$total_general['venta_no_g_emp_base']+= $total_dia['venta_no_g_emp_base'];
				$total_general['venta_no_g_emp_iva']+= $total_dia['venta_no_g_emp_iva'];
				
				$dia=trim($row["fecha_pago"]);
				$total_dia['monto_pago']=0;
				$total_dia['venta_no_g']=0;
				$total_dia['venta_no_g_base']=0;
				$total_dia['venta_no_g_iva']=0;
				$total_dia['monto_reten']=0;
				$total_dia['venta_no_g_emp']=0;
				$total_dia['venta_no_g_emp_base']=0;
				$total_dia['venta_no_g_emp_iva']=0;
				$total_dia['islr']=0;

				//$this->Ln();
			}
			$this->SetFont('Arial','',6);	
			$imp_fiscal=trim($row["imp_fiscal"]);
			$iva=trim($row["monto_iva"])+0;
			$status_pago=trim($row["status_pago"]);
			$base_imp=trim($row["base_imp"])+0;
			$islr=trim($row["islr"])+0;
			$id_pago=trim($row["id_pago"]);
			$monto_pago=$iva+$base_imp;
				if($status_pago=='ANULADO'){
					$cedula="";
				}else{
					$cedula=trim($row['inicial_doc'])."".trim($row['cedulacli']);
				}
				
				$this->SetX(10);
				$this->Cell($w[0],4,$cont,"0",0,"L",$fill);
				$this->Cell($w[1],4,formatofecha(trim($row["fecha_pago"])),"0",0,"C",$fill);
				$this->Cell($w[2],4,$cedula,"0",0,"J",$fill);
				if($status_pago=='ANULADO'){
					$this->Cell($w[3],4,"ANULADO","0",0,"J",$fill);
				}else{
					$this->Cell($w[3],4,substr(utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])), 0,37),"0",0,"J",$fill);
				}
				if(trim($row["n_credito"])==''){
					$this->Cell($w[4],4,utf8_decode(trim($row["nro_factura"])),"0",0,"J",$fill);
				}
				else{
					$this->Cell($w[4],4,'',"0",0,"J",$fill);
				}
				
				$this->Cell($w[5],4,"","0",0,"J",$fill);
				$this->Cell($w[6],4,"01-Reg","0",0,"C",$fill);
				$this->Cell($w[7],4,utf8_decode(trim($row["nro_control"])),"0",0,"J",$fill);
				
				if(trim($row["n_credito"])!=''){
					$this->Cell($w[8],4,utf8_decode(trim($row["n_credito"])),"0",0,"J",$fill);
					$this->Cell($w[9],4,utf8_decode(trim($row["nro_factura"])),"0",0,"J",$fill);
				}
				else{
					$this->Cell($w[8],4,'',"0",0,"J",$fill);
					$this->Cell($w[9],4,'',"0",0,"J",$fill);
				}
				
				if($islr>0){
					if($status_pago=="PAGADO"){
						$this->Cell($w[8],4,number_format($islr, 2, ',', '.'),"0",0,"R",$fill);
						$total_dia['islr']+=$islr;
					}
					else{
						$this->Cell($w[8],4,"-".number_format($islr, 2, ',', '.'),"0",0,"R",$fill);
					}
				}else{
					$this->Cell($w[8],4,'',"0",0,"J",$fill);
				}
				if($status_pago=="PAGADO"){
					$this->Cell($w[9],4,number_format($monto_pago+0, 2, ',', '.'),"0",0,"R",$fill);
					$total_dia['monto_pago']+=$monto_pago;
				}
				else{
					$this->Cell($w[9],4,"-".number_format($monto_pago+0, 2, ',', '.'),"0",0,"R",$fill);
				}
				
				
				if(trim($row['tipo_cliente'])!="JURIDICO"){
					if($iva<=0){
						if($status_pago=="PAGADO"){
							$this->Cell($w[10],4,number_format(trim($row["base_imp"])+0, 2, ',', '.'),"0",0,"R",$fill);
							$total_dia['venta_no_g']+=trim($row["base_imp"])+0;
						}
						else{
							$this->Cell($w[10],4,"-".number_format(trim($row["base_imp"])+0, 2, ',', '.'),"0",0,"R",$fill);
						}
						$this->Cell($w[11],4,'0,00',"0",0,"R",$fill);
						$this->Cell($w[12],4,'0,00',"0",0,"R",$fill);
						$this->Cell($w[13],4,'0,00',"0",0,"R",$fill);
						
						
					}else{
						$this->Cell($w[10],4,'0,00',"0",0,"R",$fill);
						if($status_pago=="PAGADO"){
							$this->Cell($w[11],4,number_format(trim($row["base_imp"])+0, 2, ',', '.'),"0",0,"R",$fill);
							$total_dia['venta_no_g_base']+=trim($row["base_imp"])+0;
							$this->Cell($w[12],4,'12,00',"0",0,"R",$fill);
							$this->Cell($w[13],4,number_format($iva, 2, ',', '.'),"0",0,"R",$fill);
							$total_dia['venta_no_g_iva']+=$iva;
						}
						else{
							$this->Cell($w[11],4,"-".number_format(trim($row["base_imp"])+0, 2, ',', '.'),"0",0,"R",$fill);
							$this->Cell($w[12],4,'12,00',"0",0,"R",$fill);
							$this->Cell($w[13],4,"-".number_format($iva, 2, ',', '.'),"0",0,"R",$fill);
						}
						
					}
					if($status_pago=="PAGADO"){
						$this->Cell($w[14],4,number_format(trim($row["monto_reten"])+0, 2, ',', '.'),"0",0,"R",$fill);
						$total_dia['monto_reten']+=trim($row["monto_reten"])+0;
					}
					else{
						$this->Cell($w[14],4,"-".number_format(trim($row["monto_reten"])+0, 2, ',', '.'),"0",0,"R",$fill);	
					}
					
					$this->Cell($w[15],4,'0,00',"0",0,"R",$fill);
					$this->Cell($w[16],4,'0,00',"0",0,"R",$fill);
					$this->Cell($w[17],4,'0,00',"0",0,"R",$fill);
					$this->Cell($w[18],4,'0,00',"0",0,"R",$fill);
				}
				else{
					$this->Cell($w[10],4,'0,00',"0",0,"R",$fill);
					$this->Cell($w[11],4,'0,00',"0",0,"R",$fill);
					$this->Cell($w[12],4,'0,00',"0",0,"R",$fill);
					$this->Cell($w[13],4,'0,00',"0",0,"R",$fill);
					if($status_pago=="PAGADO"){
						$this->Cell($w[14],4,number_format(trim($row["monto_reten"])+0, 2, ',', '.'),"0",0,"R",$fill);
						$total_dia['monto_reten']+=trim($row["monto_reten"])+0;
					}
					else{
						$this->Cell($w[14],4,"-".number_format(trim($row["monto_reten"])+0, 2, ',', '.'),"0",0,"R",$fill);
					}
					if($iva<=0){
						if($status_pago=="PAGADO"){
							$this->Cell($w[15],4,number_format(trim($row["base_imp"])+0, 2, ',', '.'),"0",0,"R",$fill);
							$total_dia['venta_no_g_emp']+=trim($row["base_imp"])+0;
						}
						else{
							$this->Cell($w[15],4,"-".number_format(trim($row["base_imp"])+0, 2, ',', '.'),"0",0,"R",$fill);
						}
						$this->Cell($w[16],4,'0,00',"0",0,"R",$fill);
						$this->Cell($w[17],4,'0,00',"0",0,"R",$fill);
						$this->Cell($w[18],4,'0,00',"0",0,"R",$fill);
					}else{
						$this->Cell($w[15],4,'0.00',"0",0,"R",$fill);
						if($status_pago=="PAGADO"){
							$this->Cell($w[16],4,number_format(trim($row["base_imp"])+0, 2, ',', '.'),"0",0,"R",$fill);
							$total_dia['venta_no_g_emp_base']+=trim($row["base_imp"])+0;
							$this->Cell($w[17],4,'12,00',"0",0,"R",$fill);
							$this->Cell($w[18],4,number_format($iva, 2, ',', '.'),"0",0,"R",$fill);
							$total_dia['venta_no_g_emp_iva']+=$iva;
						}
						else{
							$this->Cell($w[16],4,"-".number_format(trim($row["base_imp"])+0, 2, ',', '.'),"0",0,"R",$fill);
							$this->Cell($w[17],4,'12,00',"0",0,"R",$fill);
							$this->Cell($w[18],4,"-".number_format($iva, 2, ',', '.'),"0",0,"R",$fill);
						}
					}
					
				}
				
				
				
				
			/*	
				
				$this->Cell($w[4],4,substr($nombre_servicio, 0,20),"LR",0,"J",$fill);
				
				$this->Cell($w[7],4,trim($row["status_pago"]),"LR",0,"C",$fill);
*/
				$ind++;
				$this->Ln();
			//	$fill=!$fill;
				$cont++;
			
		}
			/*
				$this->SetFont('Arial','B',8);
				$this->Cell(w(0,7)-10,6,"SUB-TOTAL DIA ".formatofecha($dia),"0",0,"L",$fill);
				$this->SetFont('Arial','B',6);
				$this->Cell($w[8],4,number_format($total_dia['islr']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[9],4,number_format($total_dia['monto_pago']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[10],4,number_format($total_dia['venta_no_g']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[11],4,number_format($total_dia['venta_no_g_base']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[12],4,'',"0",0,"R",$fill);
				$this->Cell($w[13],4,number_format($total_dia['venta_no_g_iva']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[14],4,number_format($total_dia['monto_reten']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[15],4,number_format($total_dia['venta_no_g_emp']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[16],4,number_format($total_dia['venta_no_g_emp_base']+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[17],4,'',"0",0,"R",$fill);
				$this->Cell($w[18],4,number_format($total_dia['venta_no_g_emp_iva']+0, 2, ',', '.'),"0",0,"R",$fill);
				*/
				$total_general['islr']+= $total_dia['islr'];
				$total_general['monto_pago']+= $total_dia['monto_pago'];
				$total_general['venta_no_g']+= $total_dia['venta_no_g'];
				$total_general['venta_no_g_base']+= $total_dia['venta_no_g_base'];
				$total_general['venta_no_g_iva']+= $total_dia['venta_no_g_iva'];
				$total_general['monto_reten']+= $total_dia['monto_reten'];
				$total_general['venta_no_g_emp']+= $total_dia['venta_no_g_emp'];
				$total_general['venta_no_g_emp_base']+= $total_dia['venta_no_g_emp_base'];
				$total_general['venta_no_g_emp_iva']+= $total_dia['venta_no_g_emp_iva'];
				
				$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as monto_pago FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO'  and impresion='SI'  and tipo_caja='PRINCIPAL'  $estacion1 $consult");
				$row=row($acceso);
				$monto_pago=trim($row["monto_pago"])+0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(base_imp) as venta_no_g_base FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta' and tipo_cliente<>'JURIDICO' and status_pago='PAGADO'   and impresion='SI'  and tipo_caja='PRINCIPAL'   $estacion1 $consult");
				$row=row($acceso);
				$venta_no_g_base=trim($row["venta_no_g_base"])+0;
				$venta_no_g=0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(monto_iva) as venta_no_g_iva FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta' and tipo_cliente<>'JURIDICO' and status_pago='PAGADO'  and impresion='SI'  and tipo_caja='PRINCIPAL'  $estacion1 $consult");
				$row=row($acceso);
				$venta_no_g_iva=trim($row["venta_no_g_iva"])+0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(monto_reten) as monto_reten FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta'  and status_pago='PAGADO' $estacion1  and impresion='SI'  and tipo_caja='PRINCIPAL'  $consult");
				$row=row($acceso);
				$monto_reten=trim($row["monto_reten"])+0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(islr) as islr FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta'  and status_pago='PAGADO'  and impresion='SI'  and tipo_caja='PRINCIPAL' $estacion1 $consult");
				$row=row($acceso);
				$islr=trim($row["islr"])+0;
				
				
				$acceso->objeto->ejecutarSql("SELECT sum(base_imp) as venta_no_g_emp_base FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta' and tipo_cliente='JURIDICO' and status_pago='PAGADO'  and impresion='SI'  and tipo_caja='PRINCIPAL'  $estacion1 $consult");
				$row=row($acceso);
				$venta_no_g_emp_base=trim($row["venta_no_g_emp_base"])+0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(monto_iva) as venta_no_g_emp_iva FROM vista_pago_cont where fecha_pago between '$desde' and '$hasta' and tipo_cliente='JURIDICO' and status_pago='PAGADO'  and impresion='SI'  and tipo_caja='PRINCIPAL'  $estacion1 $consult");
				$row=row($acceso);
				$venta_no_g_emp_iva=trim($row["venta_no_g_emp_iva"])+0;
				$venta_no_g_emp=0;
				
				/*
			//	$dia=trim($row["fecha_pago"]);
				$this->Ln();
				
				$this->SetFont('Arial','B',8);
				$this->Cell(w(0,7)-10,6,"TRANSACCIONES","0",0,"L",$fill);
				$this->SetFont('Arial','B',6);
				$this->Cell($w[8],4,number_format($islr+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[9],4,number_format($monto_pago+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[10],4,number_format($venta_no_g+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[11],4,number_format($venta_no_g_base+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[12],4,'',"0",0,"R",$fill);
				$this->Cell($w[13],4,number_format($venta_no_g_iva+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[14],4,number_format($monto_reten+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[15],4,number_format($venta_no_g_emp+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[16],4,number_format($venta_no_g_emp_base+0, 2, ',', '.'),"0",0,"R",$fill);
				$this->Cell($w[17],4,'',"0",0,"R",$fill);
				$this->Cell($w[18],4,number_format($venta_no_g_emp_iva+0, 2, ',', '.'),"0",0,"R",$fill);
				
				*/
				
			//	$dia=trim($row["fecha_pago"]);
				$this->Ln(6);
			$fill=0;	
				
		$this->SetX(10);
		$this->Cell(array_sum($w),1,'','TB');
		
		$this->Ln(10);
		$this->SetX(30);
		$this->SetFont('Arial','B',9);
		$this->Cell(120,4,"RESUMEN LIBRO DE VENTAS","0",0,"L",$fill);
		$this->Cell(40,4,"Base Imponible","0",0,"R",$fill);
		$this->Cell(40,4,"Débito Fiscal","0",0,"R",$fill);
		$this->Cell(40,4,"IVA Retenido","0",0,"R",$fill);
		$this->Cell(40,4,"IVA de Ventas","0",0,"R",$fill);
		$this->Ln();
		$this->SetX(30);
		$this->SetFont('Arial','B',9);
		$this->Cell(120,4,"","0",0,"R",$fill);
		$this->Cell(40,4,"","0",0,"R",$fill);
		$this->Cell(40,4,"","0",0,"R",$fill);
		$this->Cell(40,4,"por Comprador","0",0,"R",$fill);
		$this->Cell(40,4,"Percibido","0",0,"R",$fill);
		
		
		$this->Ln(6);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(120,4,"Total: Ventas Internas a No Contribuyentes NO GRAVADAS","0",0,"L",$fill);
		$this->Cell(40,4,number_format($venta_no_g+0, 2, ',', '.'),"0",0,"R",$fill);
		
		
		
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(120,4,"Total Ventas Internas a Contribuyentes NO GRAVADAS","0",0,"L",$fill);
		$this->Cell(40,4,number_format($venta_no_g_emp+0, 2, ',', '.'),"0",0,"R",$fill);
		
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(120,4,"Total de las Ventas Internas Afectadas Alicuota General","0",0,"L",$fill);
		$this->Cell(40,4,number_format($venta_no_g_base+$venta_no_g_emp_base+0, 2, ',', '.'),"0",0,"R",$fill);
		//$debito_fiscal=$monto_reten+$venta_no_g_iva+$venta_no_g_emp_iva+0;
		$debito_fiscal=$venta_no_g_iva+$venta_no_g_emp_iva+0;
		$this->Cell(40,4,number_format($debito_fiscal, 2, ',', '.'),"0",0,"R",$fill);
		$iva_perc=$debito_fiscal-$monto_reten+0;
		$this->Cell(40,4,number_format($monto_reten+0, 2, ',', '.'),"0",0,"R",$fill);
		$this->Cell(40,4,number_format($iva_perc+0, 2, ',', '.'),"0",0,"R",$fill);
		
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(120,4,"Total de las Ventas Internas Afectadas Alicuota General + Adicional","0",0,"L",$fill);
		$this->Cell(40,4,'0,00',"0",0,"R",$fill);
		$this->Cell(40,4,'0,00',"0",0,"R",$fill);
			
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(120,4,"Total de las Ventas Internas Afectadas en Alicuota Reducida","0",0,"L",$fill);
		$this->Cell(40,4,'0,00',"0",0,"R",$fill);
		$this->Cell(40,4,'0,00',"0",0,"R",$fill);
		
		$total=$venta_no_g+$venta_no_g_emp+$venta_no_g_base+$venta_no_g_emp_base;
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(120,4,"Total Ventas y Débitos para efectos de determinación","0",0,"L",$fill);
		$this->Cell(40,4,number_format($total+0, 2, ',', '.'),"0",0,"R",$fill);
		$this->Cell(40,4,number_format($debito_fiscal, 2, ',', '.'),"0",0,"R",$fill);
		
		
		$this->Ln(8);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(120,4,"Libro de Ventas elaborado de acuerdo al Reglamento del IVA, Articulos 76, 77 y 78","0",0,"L",$fill);
		
		
		////////////////////////////////////////
		
		$this->AddPage('L','legal');
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','B',9);
		$this->Cell(80,4,"DESCRIPCION","0",0,"L",$fill);
		$this->Cell(40,4,"MONTO","0",0,"R",$fill);
		
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(80,4,"Total Ventas y Débitos para efectos de determinación","0",0,"L",$fill);
		$this->Cell(40,4,number_format($total+0, 2, ',', '.'),"0",0,"R",$fill);
		
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(80,4,"Débito Fiscal","0",0,"L",$fill);
		$this->Cell(40,4,number_format($debito_fiscal, 2, ',', '.'),"0",0,"R",$fill);
		
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(80,4,"IVA Retenido por Comprador","0",0,"L",$fill);
		$this->Cell(40,4,"-".number_format($monto_reten+0, 2, ',', '.'),"0",0,"R",$fill);
		
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','',9);
		$this->Cell(80,4,"ISLR Retenido por Comprador","0",0,"L",$fill);
		$this->Cell(40,4,"-".number_format($islr+0, 2, ',', '.'),"0",0,"R",$fill);
		
		$total_ing=$total+$debito_fiscal-$monto_reten-$islr;
		$this->Ln(5);
		$this->SetX(30);
		$this->SetFont('Arial','B',9);
		$this->Cell(80,4,"TOTAL INGRESO","0",0,"L",$fill);
		$this->Cell(40,4,number_format($total_ing+0, 2, ',', '.'),"0",0,"R",$fill);
	
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
$pdf->fecha=$desde;
$pdf->SetAutoPageBreak(true,15);
//agrega una nueva pagina
$pdf->AddPage('L','legal');
//$pdf->Titulo();
//$pdf->Fecha();
$pdf->Cuerpo($acceso,$desde,$hasta,$consult,$id_est);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 