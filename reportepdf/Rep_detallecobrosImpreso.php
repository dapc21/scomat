<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_caja_cob=$_GET['id_caja_cob'];
$cierre_caja=$_GET['cierre_caja'];
$monto_acum=$_GET['monto_acum'];
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$logo=logo();
		$ancho_logo=ancho_logo();
		$direc_fiscal=direc_fiscal();
		$telef_emp=telef_emp();
		
			$this->Image("../imagenes/$logo",15,10,$ancho_logo);
		$this->SetFont('Arial','',12);
		$this->SetXY(70,15)	;
		$this->MultiCell(190,5,nombre_empresa(),'0','L');
		$this->SetFont('Arial','',10);
		$this->SetX(70)	;
		$this->MultiCell(190,5,strtoupper(tipo_serv()),'0','L');
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
		$this->SetX(200);
		$this->Cell(12,5,strtoupper(_('fecha')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->SetX(70)	;
		$this->MultiCell(260,7,strtoupper(_('cierre de puntos de cobros')),'0','L');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,18,18,18,50,18,18,18,18,18,18,18);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abo.')),strtoupper(_('factura')),strtoupper(_('control')),strtoupper(_('C.I./RIF')),strtoupper(_('Cliente')),strtoupper(_('base I.')),strtoupper(_('Desc')),strtoupper(_('IVA')),strtoupper(_('Ret. IVA')),strtoupper(_('Ret. ISLR')),strtoupper(_('TOTAL')),strtoupper(_('STATUS')));
		$this->SetFont('Arial','B',7);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_caja_cob,$cierre_caja,$monto_acum)
	{
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_caja where id_caja_cob='$id_caja_cob'");
		if($row=row($acceso)){
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell(20,6,strtoupper(_('caja')).": ","0",0,"L");
			$this->SetX(35);
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,utf8_decode(trim($row['nombre_caja'])),"0",0,"L");
			
			$this->SetX(90);
			$this->SetFont('Arial','B',9);
			$this->Cell(25,6,strtoupper(_('cobrador')).": ","0",0,"L");
			$this->SetX(115);
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,utf8_decode(trim($row['nombre'])." ".trim($row['apellido'])),"0",0,"L");
			
			$this->SetX(190);
			$this->SetFont('Arial','B',9);
			$this->Cell(25,6,strtoupper(_('monto acumulado')).": ","0",0,"L");
			$this->SetX(228);
			$this->SetFont('Arial','',9);
			if(trim($row['monto_acum'])!=""){
				$monto_acum =trim($row['monto_acum']);
			}
			//echo "$monto_acum";
			$this->Cell(30,6,number_format($monto_acum+0, 2, ',', '.'),"0",0,"L");
			
			$this->Ln();
			
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell(32,6,strtoupper(_('fecha Factura ')).": ","0",0,"L");
			$this->SetFont('Arial','',9);
			$fecha=trim($row['fecha_caja']);
			$this->Cell(30,6,formatofecha(trim($row['fecha_sugerida'])),"0",0,"L");
			
			
			$this->SetFont('Arial','B',9);
			$this->Cell(32,6,strtoupper(_('fecha ingreso ')).": ","0",0,"L");
			$this->SetFont('Arial','',9);
			$fecha=trim($row['fecha_caja']);
			$this->Cell(30,6,formatofecha(trim($row['fecha_caja'])),"0",0,"L");

			
			
			$this->SetFont('Arial','B',9);
			$this->Cell(32,6,strtoupper(_('hora apertura')).": ","0",0,"L");
			$this->SetFont('Arial','',9);
			$this->Cell(30,6,trim($row['apertura_caja']),"0",0,"L");
			
			$this->SetFont('Arial','B',9);
			$this->Cell(25,6,strtoupper(_('hora cierre')).": ","0",0,"L");
			$this->SetFont('Arial','',9);
			if(trim($row['cierre_caja'])!=''){
				$cierre_caja=trim($row['cierre_caja']);
			}
			$this->Cell(30,6,$cierre_caja,"0",0,"L");
			
			$this->Ln();
		}
		
		
		
		$this->Ln();
		
		
		$this->Ln();
		
			
		$w=array(60,15,25);	
	
		/////////////////////////////////////////////////////////////////////////////////////////////
		$right=10;
		$top=60;
			$this->SetXY($right,$top);
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen de facturacion')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("DESCRIPCION")),"TBL",0,"L");
				$this->Cell($w[1],5,strtoupper(_("CANT")),"TB",0,"C");
				
				$this->Cell($w[2],5,strtoupper(_("total"))." ","TBR",0,"R");
			$this->Ln();
			$this->SetFont('Arial','',8);
			
			
			$this->SetX($right)	;
				
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as excento FROM pagos where por_iva=0 and  id_caja_cob='$id_caja_cob' and fecha_pago::date='$fecha' and tipo_doc='PAGO' ");
				if($row=row($acceso)){
					$cant_nc=trim($row["cant"]);
					$excento=trim($row["excento"]);
				}
				/*
					if($id_f=='1'){
						$cant_nc=0;
						$total_nc=0;
					}
					*/
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"FACTURAS (EXCENTAS)","L",0,"L");
					$this->Cell($w[1],5,$excento,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($total_nc+0, 2, ',', '.'),"R",0,"R");
				
			$this->Ln();
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp) as base_imp, sum(monto_iva) as monto_iva FROM vista_pago_cont  where   fecha_pago::date='$fecha' and tipo_doc='PAGO'   and  id_caja_cob='$id_caja_cob' AND status_pago='PAGADO' ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$base_imp=trim($row["base_imp"])+0;
					$monto_iva=trim($row["monto_iva"])+0;
					$total_ingresos=$base_imp+$monto_iva;
					
				}
				
					$this->SetX($right);
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"BASE IMPONIBLE","L",0,"L");
					$this->Cell($w[1],5,$cant,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($base_imp+0, 2, ',', '.'),"R",0,"R");
					
					
					$this->Ln();	
					$this->SetX($right);
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"IVA (12%)","L",0,"L");
					$this->Cell($w[1],5,$cant,"0",0,"C");
					$this->Cell($w[2],5,number_format($monto_iva+0, 2, ',', '.'),"R",0,"R");
					
					$this->Ln();	
					$this->SetX($right);
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"TOTAL INGRESOS","LT",0,"L");
					$this->Cell($w[1],5,'',"T",0,"C");
					$this->Cell($w[2],5,number_format($total_ingresos+0, 2, ',', '.'),"RT",0,"R");
					
				
				
			$this->Ln();	
			//echo "SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  where   fecha_pago::date='$fecha' and tipo_doc='PAGO'  and  status_pago='NOTA CREDITO' ";
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  where   fecha_pago::date='$fecha' and tipo_doc='PAGO'  and fecha_factura='$fecha'  and  id_caja_cob='$id_caja_cob' and  status_pago='NOTA CREDITO' ");
				if($row=row($acceso)){
					$cant_nc=trim($row["cant"])+0;
					$total_nc_dia=trim($row["total_nc"])+0;
				}
				
					/*
					if($id_f=='2'){
						$cant_nc=0;
						$total_nc=0;
					}
					*/
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"NOTAS DE CREDITOS DEL DÍA","L",0,"L");
					$this->Cell($w[1],5,$cant_nc,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($total_nc_dia+0, 2, ',', '.'),"R",0,"R");

			$this->Ln();	
		//	echo "SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  where   fecha_pago::date='$fecha' and tipo_doc='PAGO'  and fecha_factura<'$fecha'  and  pagos.id_caja_cob='$id_caja_cob' and  status_pago='NOTA CREDITO' <br> ";
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as total_nc FROM pagos  where   fecha_pago::date='$fecha' and tipo_doc='PAGO'  and fecha_factura<'$fecha'  and  id_caja_cob='$id_caja_cob' and  status_pago='NOTA CREDITO' ");
				if($row=row($acceso)){
					$cant_nc=trim($row["cant"])+0;
					$total_nc=trim($row["total_nc"])+0;
				}
				
					/*
					if($id_f=='2'){
						$cant_nc=0;
						$total_nc=0;
					}
					*/
					$this->SetX($right)	;
					$this->SetFont('Arial','',8);
					$this->Cell($w[0],5,"NOTAS DE CREDITOS DE DIAS ANTERIORES","L",0,"L");
					$this->Cell($w[1],5,$cant_nc,"0",0,"C");
					
					$this->SetFont('Arial','',8);
					$this->Cell($w[2],5,number_format($total_nc+0, 2, ',', '.'),"R",0,"R");

		$this->Ln();
		
			$total_facturado=$total_ingresos-$total_nc-$total_nc_dia;
			$this->SetX($right)	;
			
			$this->SetX($right)	;
					$this->SetFont('Arial','B',8);
					$this->Cell($w[0],5,"TOTAL FACTURADO","TBL",0,"L");
					$this->Cell($w[1],5,'',"TB",0,"C");
					$this->Cell($w[2],5,number_format($total_facturado+0, 2, ',', '.'),"TBR",0,"R");
					
		/////////////////////////////////////////////////////////////////////////////////////////////
		
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
			
			$this->SetX($right);
			
			$this->SetFont('Arial','',8);
			//$this->Cell(45,1,"--------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"SELECT *FROM tipo_pago order by id_tipo_pago");
			$suma_c=0;
			$suma_can=0;
			 
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
				//ECHO "SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago  where   fecha_pago::date='$fecha' and tipo_doc='PAGO'  and id_caja_cob='$id_caja_cob'  and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'    ";
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago  where   fecha_pago::date='$fecha' and tipo_doc='PAGO'  and id_caja_cob='$id_caja_cob'  and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'     ");
				$suma=0;
				if($row=row($acceso))
				{
					$monto_tp=trim($row["monto_tp"])+0;
					$cant=trim($row["cant"])+0;
					$suma_c+=$monto_tp;
					$suma_can+=$cant;
					
					$this->Ln();
					
					$this->SetX($right);
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
			
		
		/////////////////////////////////////////////////////////////////////////////////////////////
		

		
		$right=120;
		$top=60;
			$this->SetXY($right,$top);
			
			
			$this->SetFont('Arial','BIU',8);
			$this->Cell($right,5,strtoupper(_('resumen por servicios')),"0",0,"L");
			
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',8);
				$this->Cell($w[0],5,strtoupper(_("servicio")),"TBL",0,"L");
				$this->Cell($w[1],5,strtoupper(_("cant")),"TB",0,"C");
				$this->Cell($w[2],5,strtoupper(_("costo")),"TB",0,"R");
				$this->Cell($w[1],5,strtoupper(_("desc")),"TB",0,"R");
				$this->Cell($w[2],5,strtoupper(_("total")),"TBR",0,"R");
		
			$this->SetFont('Arial','',8);
			$this->SetX($right);
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato=lectura($acceso,"SELECT *FROM servicios;");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro_fact) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where    fecha_pago::date='$fecha' and tipo_doc='PAGO'  and  id_caja_cob='$id_caja_cob' and id_serv='$id_serv'  and status_pago='PAGADO' and tipo_doc='PAGO' ");
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
						$this->SetFont('Arial','',8);
						$this->Cell($w[0],5,strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"])))."","L",0,"L");
						$this->Cell($w[1],5,$cant,"0",0,"C");
						$this->Cell($w[2],5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[1],5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"R",0,"R");
					}
				}
			}
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
						$this->SetX($right);
						$this->SetFont('Arial','B',8);
						$this->Cell($w[0],5,strtoupper("total SERVICIOS"),"TBL",0,"L");
						$this->Cell($w[1],5,$suma_can,"TB",0,"C");
						$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[1],5,number_format($suma_d+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"TBR",0,"R");
		
		
						
						
						
						
			
		$right=120;
		$this->Ln(7);
			$this->SetX($right)	;
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen DE cargos cobrados por meses')),"0",0,"L");
			
				
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',9);
				$this->Cell($w[0],6,strtoupper(_("MES")),"TBL",0,"L");
				$this->Cell($w[1],6,strtoupper(_("cant")),"TB",0,"C");
				$this->Cell($w[2],6,strtoupper(_("costo")),"TB",0,"R");
				$this->Cell($w[1],6,strtoupper(_("desc")),"TB",0,"R");
				$this->Cell($w[2],6,strtoupper(_("total")),"TBR",0,"R");
			//$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
		  $dato=lectura($acceso,"SELECT TO_CHAR(FECHA_INST,'YYYY-MM') as mes,count(*)  FROM vista_pago_ser where  fecha_pago::date='$fecha' and tipo_doc='PAGO'  and  id_caja_cob='$id_caja_cob'   and status_pago='PAGADO'  group by mes ORDER BY mes ");
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
			for($k=0;$k<count($dato);$k++){
				$fecha_inst=trim($dato[$k]["mes"]);
				list($ano,$mes)=explode("-",$fecha_inst);
				$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $ano ));
				$desde="$ano-$mes-01";
				$hasta="$ano-$mes-$ult_dia_mes";

				$mes_l = formato_mes_com1($mes)." $ano";
				//echo $mes_l ;
				//echo "SELECT sum(costo_cobro_fact) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where fecha_pago::date='$fecha' and tipo_doc='PAGO' and  id_caja_cob='$id_caja_cob' and status_pago='PAGADO' and fecha_inst between '$desde' and '$hasta'   ";
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro_fact) as costo_cobro,sum(descu) as descu, count(*) as cant  FROM vista_pago_ser where fecha_pago::date='$fecha' and tipo_doc='PAGO' and  id_caja_cob='$id_caja_cob' and status_pago='PAGADO' and fecha_inst between '$desde' and '$hasta'   ");
				$suma=0;
				$cont=0;
				if($row=row($acceso))
				{
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
						$this->Cell($w[0],5,strtoupper($mes_l),"L",0,"L");
						$this->Cell($w[1],5,$cant,"0",0,"C");
						$this->Cell($w[2],5,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[1],5,number_format($descu+0, 2, ',', '.'),"0",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"R",0,"R");
						
					}
				}
			}
			$total=$suma_c-$suma_d;
			$this->Ln();
			$this->SetX($right)	;
			//$this->Cell(45,1,"---------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
			//$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',9);
						$this->Cell($w[0],5,strtoupper("total"),"TBL",0,"L");
						$this->Cell($w[1],5,$suma_can,"TB",0,"C");
						$this->Cell($w[2],5,number_format($suma_c+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[1],5,number_format($suma_d+0, 2, ',', '.'),"TB",0,"R");
						$this->Cell($w[2],5,number_format($total+0, 2, ',', '.'),"TBR",0,"R");
		
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM vista_pago_cont where  monto_iva>0  and  id_caja_cob='$id_caja_cob'  and fecha_pago::date='$fecha' and tipo_doc='PAGO'  and status_pago='PAGADO'   ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			
	
	

		
		$this->AddPage('P','letter');
		$this->SetFont('Arial','BIU',8);
		
		
		
		$this->SetX(10);
		$this->Cell(40,6,strtoupper(_('detalle de los pagos')),"0",0,"L");
		$this->Ln();
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,32,17,50,18,17,16,18);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abo.')),"ZONA",strtoupper(_('C.I./RIF')),strtoupper(_('Cliente')),strtoupper(_('factura')),strtoupper(_('control')),strtoupper(_('TOTAL')),strtoupper(_('STATUS')));
		$this->SetFont('Arial','B',7);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		
		$cable=conexion();
		
		$acceso->objeto->ejecutarSql("SELECT id_contrato,id_pago,nro_contrato,nombre_zona,nro_factura,nro_control,cedulacli,(nombrecli || ' ' || apellidocli) as nombrecli, base_imp, desc_pago, monto_iva,  monto_pago, fecha_pago,status_pago , n_credito FROM vista_pago_cont where id_caja_cob='$id_caja_cob'  order by inc");
		
		$this->SetFont('Arial','',7);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		$ca[0]='';
		$tipo_pago[0]='';
		$y=0;
		while ($row=row($acceso))
		{
			$fill=0;
				$this->SetX(10);
				$this->Cell($w[0],5,$cont,"L",0,"C",$fill);
				$this->Cell($w[1],5,utf8_decode(trim($row["nro_contrato"])),"1",0,"J",$fill);
				$this->Cell($w[2],5,substr(utf8_decode(trim($row["nombre_zona"])),0,15),"1",0,"J",$fill);
				$this->Cell($w[3],5,utf8_decode(trim($row["cedulacli"])),"1",0,"J",$fill);
				$this->Cell($w[4],5,substr(utf8_decode(trim($row["nombrecli"])." ".trim($row["apellidocli"])),0,30),"1",0,"J",$fill);
				$this->Cell($w[5],5,utf8_decode(trim($row["nro_factura"])),"1",0,"J",$fill);
				$this->Cell($w[6],5,utf8_decode(trim($row["nro_control"])),"1",0,"J",$fill);
				$this->SetFont('Arial','B',7);
				$this->Cell($w[7],5,number_format(trim($row["monto_pago"])+0, 2, ',', '.'),"1",0,"R",$fill);
				$this->SetFont('Arial','',7);
				$this->Cell($w[8],5,utf8_decode(trim($row["status_pago"])),"1",0,"J",$fill);
				
				$id_pago=trim($row["id_pago"]);
				$cable->objeto->ejecutarSql("SELECT abrev_tp,refer_tp,monto_tp,(select abrev_banco from banco where detalle_tipopago.id_banco=banco.id_banco and tipo_banco<>'EMPRESA' LIMIT 1) AS abrev_banco FROM detalle_tipopago,tipo_pago WHERE detalle_tipopago.id_tipo_pago=tipo_pago.id_tipo_pago and id_pago='$id_pago' ");
				$banco='';
				while($row1=row($cable)){
					$abrev_banco=trim($row1['abrev_banco']);
					$ban=trim($row1['banco']);
					$tipo_pago=trim($row1['abrev_tp']);
					$refer_tp=trim($row1['refer_tp']);
					$monto_tp=trim($row1['monto_tp']);
					number_format($cargo+0, 2, ',', '.');
					$banco= $banco."$tipo_pago, $monto_tp  $abrev_banco $refer_tp ;  ";
				}
				$cable->objeto->ejecutarSql("SELECT nombre_servicio,costo_cobro,tipo_costo,tipo_paq,fecha_inst FROM pago_servicio, contrato_servicio_pagado, servicios   WHERE  pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv  AND contrato_servicio_pagado.id_serv = servicios.id_serv and id_pago='$id_pago' ");
				 

				
				$servicio='';
				while($row1=row($cable)){
					$nombre_servicio=trim($row1['nombre_servicio']);
					$tipo_costo=trim($row1['tipo_costo']);
					$tipo_paq=trim($row1['tipo_paq']);
					$costo_cobro=trim($row1['costo_cobro']);
					$fecha_inst=trim($row1['fecha_inst']);
					$costo_cobro=number_format($costo_cobro+0, 2, ',', '.');
					
					
					$fechaN=explode("-",$fecha_inst);
					$mes=formato_mes($fechaN[1]);
					$anio=$fechaN[0];
					
					if($tipo_costo=='COSTO MENSUAL' and $tipo_paq=='PAQUETE BASICO'){
						$nombre_servicio="MENS $mes $anio;";
					}
					else if($tipo_costo=='COSTO MENSUAL'){
						$nombre_servicio="$nombre_servicio $mes $anio;";
					}
					
					$servicio= $servicio."$nombre_servicio $costo_cobro ;";
				}
				$this->Ln();
				$this->SetX(10);
				$this->MultiCell(array_sum($w),4,"               Forma de Pago: $banco      Detalle Servicios: $servicio","LRB","J",$fill);
				
				
				
				$fill=!$fill;
				$cont++;
		
		}
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
		
		
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
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$id_caja_cob,$cierre_caja,$monto_acum);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 