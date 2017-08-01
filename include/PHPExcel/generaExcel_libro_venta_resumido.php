<?php
//error_reporting(E_ALL ^ E_NOTICE);
	$desde = $_GET['desde'];
	$hasta = $_GET['hasta'];
	$id_franq = $_GET['id_franq'];
	$id_est = $_GET['id_est'];
	require_once("../../procesos.php");
			$acceso=conexion();
			$obj=new generarExcel();
		
			
			$obj->generar_con_sql($acceso,$desde,$hasta,$id_franq,$id_est);
			
class generarExcel
{
	private $cabeceras;
	private $filas;

	function __construct()
	{
	}
	
	
public function generar_con_sql($acceso,$desde,$hasta,$id_franq,$id_est)
	{

error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$colum=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ");

//$header=array("No. de Oper.","Fecha de Factura","No.RIF","Nombre o Razón Social","Factura Desde","Factura Hasta","Nro. Nota de crèdito","No. de Factura afectada","Número comprobante retención","Total de Venta Incluyendo IVA","Ventas NO GRAVADAS","Base Imponible","% Alicuota","Impuesto IVA","IVA retenido (por el comprador)","Ventas NO GRAVADAS","Base Imponible","% Alicuota","Impuesto IVA");
$header=array("No. de Oper.","Fecha de Factura","No.RIF","Nombre o Razón Social","Factura Desde","Factura Hasta","Reporte Z ","Impresora Fiscal","Número comprobante retención","Total de Venta Incluyendo IVA","Ventas NO GRAVADAS","Base Imponible","% Alicuota","Impuesto IVA","IVA retenido (por el comprador)","Ventas NO GRAVADAS","Base Imponible","% Alicuota","Impuesto IVA");


$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');	
$objPHPExcel->getDefaultStyle()->getFont()->setSize(8);
$objPHPExcel->getDefaultStyle()->getFont()->setBold(true);

		$num=count($header);
		for($j=0;$j<count($header);$j++){
			$head = $header[$j];
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[$j].'1', $head);
			$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($j)->setAutoSize(true);
		
		}
		
		
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(8);
$objPHPExcel->getDefaultStyle()->getFont()->setBold(false);

error_reporting(E_ALL ^ E_NOTICE);
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
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		$cable=conexion();
		
		
	if($id_franq!='0'){
		$consult=" AND id_franq='$id_franq'";
	}
		
	if($id_est!='0'){
		$estacion=" AND estacion_trabajo.id_est='$id_est'";
	}
	
		$cable5=conexion();
		//echo "SELECT fecha_pago, sum(monto_pago) as monto_pago FROM vista_pago_cont,estacion_trabajo where vista_pago_cont.id_est=estacion_trabajo.id_est $estacion AND  fecha_pago between '$desde' and '$hasta' $consult order by fecha_pago";
		$cable5->objeto->ejecutarSql("SELECT fecha_pago,vista_pago_cont.id_est, sum(monto_pago) as monto_pago FROM vista_pago_cont,estacion_trabajo where vista_pago_cont.id_est=estacion_trabajo.id_est $estacion AND  fecha_pago between '$desde' and '$hasta' $consult   group by fecha_pago,vista_pago_cont.id_est order by fecha_pago,vista_pago_cont.id_est");
		
		
		
		$cont=1;
		//$this->SetFillColor(249,249,249);
		//$this->SetTextColor(0);
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		$sumatoria=0.00;
		//$this->SetFont('Arial','',6);
		$dia=$desde;
		
		$i=0;
		
		while ($row5=row($cable5))
		{
			$fecha_pago=trim($row5["fecha_pago"]);
			$monto_pago=trim($row5["monto_pago"])+0;
			$base_imp=$monto_pago/1.12;
			$iva=$base_imp*0.12;
			
			//$status_pago=trim($row["status_pago"]);
			$status_pago="PAGADO";
			$islr=trim($row["islr"])+0;
			$id_pago=trim($row["id_pago"]);
			//echo "SELECT nro_factura,imp_fiscal FROM vista_pago_cont,estacion_trabajo where vista_pago_cont.id_est=estacion_trabajo.id_est $estacion AND  fecha_pago = '$fecha_pago' $consult order by nro_factura asc LIMIT 1";
		$acceso->objeto->ejecutarSql("SELECT nro_factura,mac_est,estacion_trabajo.id_est FROM vista_pago_cont,estacion_trabajo where vista_pago_cont.id_est=estacion_trabajo.id_est $estacion AND  fecha_pago = '$fecha_pago' $consult order by nro_factura asc LIMIT 1");
		$row=row($acceso);
		$nro_factura_ini=trim($row["nro_factura"]);
		$imp_fiscal=trim($row["mac_est"]);
		$id_est=trim($row["id_est"]);
				
		$acceso->objeto->ejecutarSql("SELECT reporte_z FROM cirre_diario_et where  id_est = '$id_est'");
		$row=row($acceso);
		$reporte_z=trim($row["reporte_z"]);
		$acceso->objeto->ejecutarSql("SELECT nro_factura FROM vista_pago_cont,estacion_trabajo where vista_pago_cont.id_est=estacion_trabajo.id_est $estacion AND  fecha_pago = '$fecha_pago' $consult order by nro_factura desc LIMIT 1");
		$row=row($acceso);
		$nro_factura_fin=trim($row["nro_factura"]);
			
			$row['monto_pago']=$monto_pago;
			$row['monto_iva']=trim($row['monto_iva']);
			$row['base_imp']=$base_imp;
			/*
			//$this->SetFont('Arial','',6);	
			$iva=trim($row["monto_iva"])+0;
			$status_pago=trim($row["status_pago"]);
			$base_imp=trim($row["base_imp"])+0;
			$islr=trim($row["islr"])+0;
			$id_pago=trim($row["id_pago"]);
			$monto_pago=$iva+$base_imp;
			*/
				$cedula=trim($row['inicial_doc'])."".trim($row['cedulacli']);
				//$this->SetX(10);
				//$this->Cell($w[0],4,$cont,"0",0,"L",$fill);
				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[0].($i+2), $cont);
				
				//$this->Cell($w[1],4,formatofecha($fecha_pago),"0",0,"C",$fill);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[1].($i+2), formatofecha($fecha_pago));
				//$this->Cell($w[2],4,$cedula,"0",0,"J",$fill);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[2].($i+2), "");
				//$this->Cell($w[3],4,substr(utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])), 0,37),"0",0,"J",$fill);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[3].($i+2), "CLIENTES VARIOS" );
				//if(trim($row["n_credito"])==''){
					//$this->Cell($w[4],4,utf8_decode(trim($row["nro_factura"])),"0",0,"J",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[4].($i+2), "'".utf8_decode($nro_factura_ini)."'");
				//}
				//else{
					//$this->Cell($w[4],4,'',"0",0,"J",$fill);
				//	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[4].($i+2), '');
				//}
				//$this->Cell($w[5],4,utf8_decode(trim($row["cont"])),"0",0,"J",$fill);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[5].($i+2), "'".utf8_decode($nro_factura_fin)."'");
				
				if(trim($row["n_credito"])!=''){
					//$this->Cell($w[6],4,utf8_decode(trim($row["n_credito"])),"0",0,"J",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[6].($i+2), utf8_decode(trim($row["n_credito"])));
					//$this->Cell($w[7],4,utf8_decode(trim($row["nro_factura"])),"0",0,"J",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[7].($i+2), utf8_decode(trim($row["nro_factura"])));
				}
				else{
					//$this->Cell($w[6],4,'',"0",0,"J",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[6].($i+2), "'$reporte_z'");
					//$this->Cell($w[7],4,'',"0",0,"J",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[7].($i+2), "'$imp_fiscal'");
				}
				
				if($islr>0){
					if($status_pago=="PAGADO"){
						//$this->Cell($w[8],4,number_format($islr, 2, '.', ''),"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[8].($i+2), number_format($islr, 2, '.', ''));
						$total_dia['islr']+=$islr;
					}
					else{
						//$this->Cell($w[8],4,"-".number_format($islr, 2, '.', ''),"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[8].($i+2), "-".number_format($islr, 2, '.', ''));
					}
				}else{
					//$this->Cell($w[8],4,'',"0",0,"J",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[8].($i+2), '');
				}
				if($status_pago=="PAGADO"){
					//$this->Cell($w[9],4,number_format($monto_pago+0, 2, '.', ''),"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[9].($i+2), number_format($monto_pago+0, 2, '.', ''));
					$total_dia['monto_pago']+=$monto_pago;
				}
				else{
					//$this->Cell($w[9],4,"-".number_format($monto_pago+0, 2, '.', ''),"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[9].($i+2), "-".number_format($monto_pago+0, 2, '.', ''));
				}
				
				
				if(trim($row['tipo_cliente'])!="JURIDICO"){
					if($iva<=0){
						if($status_pago=="PAGADO"){
							//$this->Cell($w[10],4,number_format(trim($row["base_imp"])+0, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[10].($i+2), number_format(trim($row["base_imp"])+0, 2, '.', ''));
							$total_dia['venta_no_g']+=trim($row["base_imp"])+0;
						}
						else{
							//$this->Cell($w[10],4,"-".number_format(trim($row["base_imp"])+0, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[10].($i+2), "-".number_format(trim($row["base_imp"])+0, 2, '.', ''));
						}
						//$this->Cell($w[11],4,'0,00',"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[11].($i+2), '0,00');
						//$this->Cell($w[12],4,'0,00',"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[12].($i+2), '0,00');
						//$this->Cell($w[13],4,'0,00',"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[13].($i+2), '0,00');
						
						
					}else{
						//$this->Cell($w[10],4,'0,00',"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[10].($i+2), '0,00');
						if($status_pago=="PAGADO"){
							//$this->Cell($w[11],4,number_format(trim($row["base_imp"])+0, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[11].($i+2), number_format(trim($row["base_imp"])+0, 2, '.', ''));
							$total_dia['venta_no_g_base']+=trim($row["base_imp"])+0;
							//$this->Cell($w[12],4,'12,00',"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[12].($i+2), '12,00');
							//$this->Cell($w[13],4,number_format($iva, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[13].($i+2), number_format($iva, 2, '.', ''));
							$total_dia['venta_no_g_iva']+=$iva;
						}
						else{
							//$this->Cell($w[11],4,"-".number_format(trim($row["base_imp"])+0, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[11].($i+2), "-".number_format(trim($row["base_imp"])+0, 2, '.', ''));
							//$this->Cell($w[12],4,'12,00',"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[12].($i+2), '12,00');
							//$this->Cell($w[13],4,"-".number_format($iva, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[13].($i+2), "-".number_format($iva, 2, '.', ''));
						}
						
					}
					if($status_pago=="PAGADO"){
						//$this->Cell($w[14],4,number_format(trim($row["monto_reten"])+0, 2, '.', ''),"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[14].($i+2), number_format(trim($row["monto_reten"])+0, 2, '.', ''));
						$total_dia['monto_reten']+=trim($row["monto_reten"])+0;
					}
					else{
						//$this->Cell($w[14],4,"-".number_format(trim($row["monto_reten"])+0, 2, '.', ''),"0",0,"R",$fill);	
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[14].($i+2), "-".number_format(trim($row["monto_reten"])+0, 2, '.', ''));
					}
					
					//$this->Cell($w[15],4,'0,00',"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[15].($i+2), '0,00');
					//$this->Cell($w[16],4,'0,00',"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[16].($i+2), '0,00');
					//$this->Cell($w[17],4,'0,00',"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[17].($i+2), '0,00');
					//$this->Cell($w[18],4,'0,00',"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[18].($i+2), '0,00');
				}
				else{
					//$this->Cell($w[10],4,'0,00',"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[10].($i+2), '0,00');
					//$this->Cell($w[11],4,'0,00',"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[11].($i+2), '0,00');
					//$this->Cell($w[12],4,'0,00',"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[12].($i+2), '0,00');
					//$this->Cell($w[13],4,'0,00',"0",0,"R",$fill);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[13].($i+2), '0,00');
					if($status_pago=="PAGADO"){
						//$this->Cell($w[14],4,number_format(trim($row["monto_reten"])+0, 2, '.', ''),"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[14].($i+2), number_format(trim($row["monto_reten"])+0, 2, '.', ''));
						$total_dia['monto_reten']+=trim($row["monto_reten"])+0;
					}
					else{
						//$this->Cell($w[14],4,"-".number_format(trim($row["monto_reten"])+0, 2, '.', ''),"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[14].($i+2), "-".number_format(trim($row["monto_reten"])+0, 2, '.', ''));
					}
					if($iva<=0){
						if($status_pago=="PAGADO"){
							//$this->Cell($w[15],4,number_format(trim($row["base_imp"])+0, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[15].($i+2),number_format(trim($row["base_imp"])+0, 2, '.', ''));
							$total_dia['venta_no_g_emp']+=trim($row["base_imp"])+0;
						}
						else{
							//$this->Cell($w[15],4,"-".number_format(trim($row["base_imp"])+0, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[15].($i+2), "-".number_format(trim($row["base_imp"])+0, 2, '.', ''));
						}
						//$this->Cell($w[16],4,'0,00',"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[16].($i+2), '0,00');
						//$this->Cell($w[17],4,'0,00',"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[17].($i+2), '0,00');
						//$this->Cell($w[18],4,'0,00',"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[18].($i+2), '0,00');
					}else{
						//$this->Cell($w[15],4,'0.00',"0",0,"R",$fill);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[15].($i+2), '0,00');
						if($status_pago=="PAGADO"){
							//$this->Cell($w[16],4,number_format(trim($row["base_imp"])+0, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[16].($i+2), number_format(trim($row["base_imp"])+0, 2, '.', ''));
							$total_dia['venta_no_g_emp_base']+=trim($row["base_imp"])+0;
							//$this->Cell($w[17],4,'12,00',"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[17].($i+2), '12,00');
							//$this->Cell($w[18],4,number_format($iva, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[18].($i+2), number_format($iva, 2, '.', ''));
							$total_dia['venta_no_g_emp_iva']+=$iva;
						}
						else{
							//$this->Cell($w[16],4,"-".number_format(trim($row["base_imp"])+0, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[16].($i+2), "-".number_format(trim($row["base_imp"])+0, 2, '.', ''));
							//$this->Cell($w[17],4,'12,00',"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[17].($i+2), '12,00');
							//$this->Cell($w[18],4,"-".number_format($iva, 2, '.', ''),"0",0,"R",$fill);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[18].($i+2), "-".number_format($iva, 2, '.', ''));
						}
					}
					
				}
				
				
				
				
			
				//$ind++;
				//$this->Ln();
			//	$fill=!$fill;
				$cont++;
			//	echo ":$cant:";
				if($cant > 1){
					
					for($j=1; $j<$cant;$j++){
						$row=row($acceso);
					}
				}
				
			$i++;	
		}//while
		
		error_reporting(E_ALL ^ E_NOTICE);
		
$objPHPExcel->setActiveSheetIndex(0);

$sharedStyle1 = new PHPExcel_Style();


$sharedStyle1->applyFromArray(
	array('fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
								'color'		=> array('argb' => 'FFCCFFCC')
							),
		  'borders' => array(
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
							)
		 ));



$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A1:".$colum[$num-1]."1");
		

$objPHPExcel->getActiveSheet()->setTitle('Simple');




// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

}
}
