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
		$titulo_cierre="INFORME TECNICO DE $nombre_franq";
	}
	else{
		$titulo_cierre='INFORME TECNICO GENERAL';
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
		
		$this->ancho_t=5;
		$this->ancho=4;
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
		$this->SetXY(160,5);
		$this->Cell(12,5,strtoupper(_('fecha')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(20,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->SetXY(160,8);
		$this->Cell(12,5,strtoupper(_('hora')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(20,5,date("H:i:s"),0,0,'L');
		$this->Ln(12);		
		
	}
	
	function ordenes_asignada_impresa($acceso,$fecha,$id_f,$setx,$sety)
	{
		$w=array(60,30);	
		$this->config_style();
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		
		
		$right=$setx; $this->SetY($sety); $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('ORDENES DE SERVICIOS POR STATUS ')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t,strtoupper(_("DESCRIPCION")),$this->tbl,0,"L",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("CANTIDAD")),$this->tbr,0,"C",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_t=0;
		
					$acceso->objeto->ejecutarSql("select count(*) as cant from vista_ubica,contrato,ordenes_tecnicos where  ordenes_tecnicos.id_contrato = contrato.id_contrato AND vista_ubica.id_calle=contrato.id_calle $consult and status_orden='CREADO' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"ORDENES ASIGNADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
					$acceso->objeto->ejecutarSql("select count(*) as cant from vista_ubica,contrato,ordenes_tecnicos where  ordenes_tecnicos.id_contrato = contrato.id_contrato AND vista_ubica.id_calle=contrato.id_calle $consult and status_orden='IMPRESO' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"ORDENES IMPRESAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
					
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tbl,0,'J');	
				$this->Cell($w[1],$this->ancho_t,$suma_t,$this->tbr,0,'C');	
				
			$this->Ln(10);
	}
	
	function analisis_vencimiento($acceso,$fecha,$id_f,$setx,$sety)
	{
		$cable=conexion();
		$cable1=conexion();
		$w=array(46,20,30);	
		$desc_dias=array('ABONADOS A 30 DIAS','ABONADOS A 60 DIAS','ABONADOS A 90 DIAS','ABONADOS A 120 DIAS','ABONADOS A 150 DIAS','ABONADOS A MAS DE 150 DIAS','30 DIAS',);	
		$this->config_style();
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		
		
		$right=$setx; $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('DEUDA DE ABONADOS ACTIVOS')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t,strtoupper(_("DESCRIPCION")),$this->tbl,0,"L",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("CANTIDAD")),$this->tbr,0,"C",$this->fondo_t);
		$this->Cell($w[2],$this->ancho_t,strtoupper(_("MONTO")),$this->tbr,0,"C",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_t=0;
		$suma_m=0;
		
		$fecha=date("Y-m-01");
		$fecha_actu=date("Y-m-01");
		$fecha_actual=date("Y-m-01");
		$fecha_ant=restames($fecha);
		$fecha_ant=restames($fecha_ant);
		$fecha_ant=restames($fecha_ant);
		$fecha_ant=restames($fecha_ant);
		$fecha_ant=restames($fecha_ant);
		$nombrestatus="ACTIVO";
		
			$acceso->objeto->ejecutarSql("select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and status_contrato='$nombrestatus'");
			$row=row($acceso);
			$total_abo=trim($row["cont"])+0;
		
			$acceso->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato,vista_ubica,contrato_servicio_deuda where contrato.id_calle=vista_ubica.id_calle and contrato_servicio_deuda.id_contrato=contrato.id_contrato  $consult and status_contrato='$nombrestatus' and fecha_inst < '$fecha_actu'");
			$row=row($acceso);
			$monto_total=trim($row["monto"]);
				
			$cable->objeto->ejecutarSql("select count(*) as cont from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult and  contrato.status_contrato='$nombrestatus' and (select sum(costo_cobro * cant_serv) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha_actu' )>0");
			
			$row1=row($cable);
			$sin_deuda=trim($row1['cont'])+0;
			$sin_deuda=$total_abo-$sin_deuda;
			$suma_t+=$sin_deuda;
			$cs++;
			$this->SetFont('Arial','',8);
			$this->SetX($right);
				
					$this->Cell($w[0],$this->ancho,"ABONADOS AL DIA",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$sin_deuda,$this->vacio,0,'C');
					$this->Cell($w[2],$this->ancho,number_format(0, 2, ',', '.'),$this->r,0,'R');
			
					
					$this->Ln();
					
			
			$fecha=date("Y-m-01");
			$fecha_ini=restames($fecha);
			$ind=0;
			while(comparaFecha($fecha,$fecha_ant)>0){
				$fecha_ini=restames($fecha);
				
				
				
		
			$monto=0;
			$cant=0;
			$cable->objeto->ejecutarSql("select contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult  and  contrato.status_contrato='$nombrestatus' and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha_ini'  and costo_cobro>0 )<=0 ");	
			/*
			$cable->objeto->ejecutarSql("select contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle  $consult and  contrato.status_contrato='$nombrestatus' and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 and 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha_ini'  and costo_cobro>0 )<=0 ");		
*/
			while ($row1=row($cable)){
				$cant++;
				$id_contrato=trim($row1['id_contrato']);
				$cable1->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato'  and fecha_inst < '$fecha_actu'");
				$row2=row($cable1);
				$monto+=trim($row2['monto'])+0;
			}
				$suma_t+=$cant;
				$suma_m+=$monto;
					
				$fecha=restames($fecha);
			
				$this->SetFont('Arial','',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho,$desc_dias[$ind],$this->l,0,'L');
				$this->Cell($w[1],$this->ancho,$cant,$this->vacio,0,'C');
				$this->Cell($w[2],$this->ancho,number_format($monto, 2, ',', '.'),$this->r,0,'R');
				$ind++;
				$this->Ln();
		}	
				$monto=0;
			$cant=0;
				$cable->objeto->ejecutarSql("select contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult  and  contrato.status_contrato='$nombrestatus' and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 ");		
				
			while ($row1=row($cable)){
				$cant++;
				$id_contrato=trim($row1['id_contrato']);
				//echo "<br>$id_contrato:select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato'";
				$cable1->objeto->ejecutarSql("select sum(costo_cobro*cant_serv) as monto from contrato_servicio_deuda where id_contrato='$id_contrato'  and fecha_inst < '$fecha_actu'");
				$row2=row($cable1);
				$monto+=trim($row2['monto'])+0;
			}
				$suma_t+=$cant;
				$suma_m+=$monto;
				
			//echo "<br>$cant:$monto<br>select contrato.id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle $consult  and  contrato.status_contrato='$nombrestatus' and (select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst < '$fecha'  and costo_cobro>0 )>0 <br>";

				
				$this->SetFont('Arial','',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho,$desc_dias[$ind],$this->l,0,'L');
				$this->Cell($w[1],$this->ancho,$cant,$this->vacio,0,'C');
				$this->Cell($w[2],$this->ancho,number_format($monto, 2, ',', '.'),$this->r,0,'R');
				$ind++;
				$this->Ln();
				
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tbl,0,'J');	
				$this->Cell($w[1],$this->ancho_t,$suma_t,$this->tb,0,'C');
				$this->Cell($w[2],$this->ancho_t,number_format($suma_m, 2, ',', '.'),$this->tbr,0,'R');
				
				
		
			
			
			$this->Ln(10);
	}
	
	function cortes_generales($acceso,$fecha,$id_f,$setx,$sety)
	{
		$w=array(40,20);	
		$this->config_style();
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		$fecha=date("Y-m-d");
		list($ano,$mes,$dia)=explode("-",$fecha);
		$fecha_ini="$ano-$mes-01";
		
		$right=$setx; $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('CORTES por Morosidad')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t,strtoupper(_("DESCRIPCION")),$this->tbl,0,"L",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("CANTIDAD")),$this->tbr,0,"C",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_t=0;
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='CREADO' and fecha_orden between '$fecha_ini' and '$fecha'  ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"ASIGNADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='IMPRESO' and fecha_orden between '$fecha_ini' and '$fecha'  ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"IMPRESAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='CANCELADA' and fecha_orden between '$fecha_ini' and '$fecha' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"CANCELADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		//echo "SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' ";
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"FINALIZADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tbl,0,'J');	
				$this->Cell($w[1],$this->ancho_t,$suma_t,$this->tbr,0,'C');	
				
		

				
				
			$this->Ln(10);
	}
	
	function reconexiones_generales($acceso,$fecha,$id_f,$setx,$sety)
	{
		$w=array(40,20);	
		$this->config_style();
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		$fecha=date("Y-m-d");
		list($ano,$mes,$dia)=explode("-",$fecha);
		$fecha_ini="$ano-$mes-01";
		$fecha_ini_ant=restames($fecha_ini);
		
		$right=$setx; $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('RECONEXIONES DEL MES')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t,strtoupper(_("DESCRIPCION")),$this->tbl,0,"L",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("CANTIDAD")),$this->tbr,0,"C",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_t=0;
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant  FROM vista_orden,proceso_corte,abo_cortados where vista_orden.id_orden=abo_cortados.id_orden and proceso_corte.id_proc=abo_cortados.id_proc and id_det_orden='DEO00010' $consult AND status_orden='FINALIZADO'  and fecha_orden between '$fecha_ini' and '$fecha' and fecha_cierre between '$fecha_ini' and '$fecha' 
and (SELECT count(*) FROM ordenes_tecnicos where ordenes_tecnicos.id_contrato=vista_orden.id_contrato and id_det_orden='DEO00003' and fecha_orden >= '$fecha_ini')>0");

					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$rec_por_proceso=$cant;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"DE PROCESO DE CORTE",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
					
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant  FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='FINALIZADO'  and fecha_orden < '$fecha_ini' and fecha_orden >= '$fecha_ini_ant' and fecha_cierre between '$fecha_ini' and '$fecha' and (SELECT count(*) FROM ordenes_tecnicos where ordenes_tecnicos.id_contrato=vista_orden.id_contrato and id_det_orden='DEO00003' and fecha_orden >= '$fecha_ini')>0");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$rec_de_mes_ant=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"DE MES PASADO",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant  FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='FINALIZADO'  and fecha_orden < '$fecha_ini_ant' and fecha_cierre between '$fecha_ini' and '$fecha' and (SELECT count(*) FROM ordenes_tecnicos where ordenes_tecnicos.id_contrato=vista_orden.id_contrato and id_det_orden='DEO00003' and fecha_orden >= '$fecha_ini')>0");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$rec_de_mes_ant=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"DE DOS MESES HACIA ATRAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant  FROM vista_orden where id_det_orden='DEO00010' $consult AND status_orden='FINALIZADO'  and fecha_orden between '$fecha_ini' and '$fecha' and fecha_cierre between '$fecha_ini' and '$fecha' and (SELECT count(*) FROM ordenes_tecnicos where ordenes_tecnicos.id_contrato=vista_orden.id_contrato and id_det_orden='DEO00003' and fecha_orden >= '$fecha_ini')>0");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$cant=$cant-$rec_de_mes_ant-$rec_por_proceso;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"DE CORTES MANUALES DE MES",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tbl,0,'J');	
				$this->Cell($w[1],$this->ancho_t,$suma_t,$this->tbr,0,'C');	
				
		

				
				
			$this->Ln(10);
	}
	
	function proceso_corte($acceso,$fecha,$id_f,$setx,$sety)
	{
		$w=array(40,20);	
		$this->config_style();
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		$fecha=date("Y-m-d");
		
		list($ano,$mes,$dia)=explode("-",$fecha);
		$fecha_ini="$ano-$mes-01";
		
		$right=$setx; $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('CORTE DE PROCESO')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t,strtoupper(_("DESCRIPCION")),$this->tbl,0,"L",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("CANTIDAD")),$this->tbr,0,"C",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_t=0;
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,proceso_corte,abo_cortados where vista_orden.id_orden=abo_cortados.id_orden and proceso_corte.id_proc=abo_cortados.id_proc and id_det_orden='DEO00010' $consult AND status_orden='CREADO' and fecha_orden between '$fecha_ini' and '$fecha' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"ASIGNADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
					
				//	ECHO "SELECT count(*) as cant FROM vista_orden,proceso_corte,abo_cortados where vista_orden.id_orden=abo_cortados.id_orden and proceso_corte.id_proc=abo_cortados.id_proc and id_det_orden='DEO00010' $consult AND status_orden='IMPRESO' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' ";
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,proceso_corte,abo_cortados where vista_orden.id_orden=abo_cortados.id_orden and proceso_corte.id_proc=abo_cortados.id_proc and id_det_orden='DEO00010' $consult AND status_orden='IMPRESO' and fecha_orden between '$fecha_ini' and '$fecha' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"IMPRESAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,proceso_corte,abo_cortados where vista_orden.id_orden=abo_cortados.id_orden and proceso_corte.id_proc=abo_cortados.id_proc and id_det_orden='DEO00010' $consult AND status_orden='CANCELADA' and fecha_orden between '$fecha_ini' and '$fecha'   ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"CANCELADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,proceso_corte,abo_cortados where vista_orden.id_orden=abo_cortados.id_orden and proceso_corte.id_proc=abo_cortados.id_proc and id_det_orden='DEO00010' $consult AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"FINALIZADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tbl,0,'J');	
				$this->Cell($w[1],$this->ancho_t,$suma_t,$this->tbr,0,'C');	
				
			$this->Ln(10);
	}
	
	function abonados_incremento($acceso,$fecha,$id_f,$setx,$sety)
	{
		$w=array(60,30);	
		$this->config_style();
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		
		$right=$setx; $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('ABONADOS POR  STATUS ')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t,strtoupper(_("DESCRIPCION")),$this->tbl,0,"L",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("CANTIDAD")),$this->tbr,0,"C",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_t=0;
				$dato=lectura($acceso,"SELECT nombrestatus FROM statuscont WHERE  status='ACTIVO' and tipo_sta='INCREMENTA'");
				for($j=0;$j<count($dato);$j++){
					$nombrestatus=trim($dato[$j]["nombrestatus"]);
					$acceso->objeto->ejecutarSql("select count(*) as cant from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and status_contrato='$nombrestatus' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,strtoupper($nombrestatus),$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
				}
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tbl,0,'J');	
				$this->Cell($w[1],$this->ancho_t,$suma_t,$this->tbr,0,'C');	
		
					$this->SetFont('Arial','',8);
					$this->Ln();
					$acceso->objeto->ejecutarSql("select count(*) as cant from vista_ubica,contrato where  vista_ubica.id_calle=contrato.id_calle $consult and status_contrato='DUPLICADO' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"DUPLICADOS",$this->tbl,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->tbr,0,'C');
		
			$this->Ln(10);
	}
	
	function ordenes_mes($acceso,$fecha,$id_f,$setx,$sety)
	{
		$w=array(42,16,16,16);	
		$this->config_style();
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		$fecha=date("Y-m-d");
		list($ano,$mes,$dia)=explode("-",$fecha);
		$fecha_ini="$ano-$mes-01";
		
		$right=$setx; $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('ORDENES FINALIZADAS DEL MES')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t,strtoupper(_("DESCRIPCION")),$this->tbl,0,"L",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("ASIG")),$this->tb,0,"C",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("FINAL")),$this->tb,0,"C",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("CANC")),$this->tbr,0,"C",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_t=0;
		$suma_t1=0;
		$suma_t2=0;
				
				$dato=lectura($acceso,"SELECT id_det_orden,nombre_det_orden FROM vista_detalleorden WHERE  status_tipord='ORDEN' ORDER BY nombre_tipo_orden");
				for($j=0;$j<count($dato);$j++){
					$id_det_orden=trim($dato[$j]["id_det_orden"]);
					$nombre_det_orden=trim($dato[$j]["nombre_det_orden"]);
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,strtoupper($nombre_det_orden),$this->l,0,'L');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->vacio,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t1+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->vacio,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' AND status_orden='CANCELADA' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->r,0,'C');
					
					$this->Ln();
					
					
					
				}
					
					$id_tipo_orden='TIO00005';
					$nombre_det_orden="RECLAMOS";
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,strtoupper($nombre_det_orden),$this->l,0,'L');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and fecha_orden between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->vacio,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' AND status_orden='FINALIZADO' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t1+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->vacio,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and status_orden='CANCELADA' and fecha_orden between '$fecha_ini' and '$fecha'  and fecha_cierre between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->r,0,'C');
					
					$this->Ln();
					
				
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tbl,0,'J');	
				$this->Cell($w[1],$this->ancho_t,$suma_t,$this->tb,0,'C');	
				$this->Cell($w[1],$this->ancho_t,$suma_t1,$this->tb,0,'C');	
				$this->Cell($w[1],$this->ancho_t,$suma_t2,$this->tbr,0,'C');	
		
					
		
			$this->Ln(10);
	}

	function ordenes_pendientes_semanas($acceso,$fecha,$id_f,$setx,$sety)
	{
		$w=array(38,13,13);	
		$this->config_style();
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		$fecha=date("Y-m-d");
		list($ano,$mes,$dia)=explode("-",$fecha);
		$fecha_ini="$ano-$mes-01";
		$fecha_6_10=restadia($fecha,5);
		$fecha_11_20=restadia($fecha,10);
		$fecha_mas_20=restadia($fecha,20);
		
		$fecha5=restadia($fecha,5);
		$fecha6=restadia($fecha,6);
		$fecha10=restadia($fecha,10);
		$fecha11=restadia($fecha,11);
		$fecha20=restadia($fecha,20);
		
		
		//echo "$fecha:$fecha_6_10:$fecha_11_20:$fecha_mas_20";
		$right=$setx; $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('ORDENES PENDIENTES POR RANGO DE DIAS')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','',8);
		$this->Cell($w[0],$this->ancho_t-2,strtoupper(_("")),0,0,"L",0);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2],$this->ancho_t-2,strtoupper(_("DE 1 A 5 Dias")),$this->lrt,0,"C",$this->fondo_t);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2],$this->ancho_t-2,strtoupper(_("DE 6 A 10 Dias")),$this->lrt,0,"C",$this->fondo_t);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2],$this->ancho_t-2,strtoupper(_("DE 11 A 20 Dias")),$this->lrt,0,"C",$this->fondo_t);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2],$this->ancho_t-2,strtoupper(_("mas de 20 Dias")),$this->lrt,0,"C",$this->fondo_t);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1]+$w[2]+$w[2],$this->ancho_t-2,strtoupper(_("totales")),$this->tblr,0,"C",$this->fondo_t);
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t-2,strtoupper(_("DESCRIPCION")),$this->tblr,0,"L",$this->fondo_t);
		$this->SetFont('Arial','',8);
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("ASIG")),$this->lb,0,"C",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("IMPR")),$this->rb,0,"C",$this->fondo_t);
		
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("ASIG")),$this->lb,0,"C",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("IMPR")),$this->rb,0,"C",$this->fondo_t);
		
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("ASIG")),$this->lb,0,"C",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("IMPR")),$this->rb,0,"C",$this->fondo_t);
		
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("ASIG")),$this->lb,0,"C",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("IMPR")),$this->rb,0,"C",$this->fondo_t);
		
		$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("ASIG")),$this->lb,0,"C",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("IMPR")),$this->rb,0,"C",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t-2,strtoupper(_("TOTAL")),$this->rb,0,"C",$this->fondo_t);
				
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
		
				
				$dato=lectura($acceso,"SELECT id_det_orden,nombre_det_orden FROM vista_detalleorden WHERE  status_tipord='ORDEN' ORDER BY nombre_tipo_orden");
				for($j=0;$j<count($dato);$j++){
					$id_det_orden=trim($dato[$j]["id_det_orden"]);
					$nombre_det_orden=trim($dato[$j]["nombre_det_orden"]);
					$suma_t=0;
					$suma_t1=0;
					$suma_t2=0;
					
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,strtoupper($nombre_det_orden),$this->lr,0,'L');
					$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden between '$fecha5' and '$fecha' AND status_orden='CREADO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant; $suma_a+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->l,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden between '$fecha5' and '$fecha' AND status_orden='IMPRESO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant; $suma_i+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					
					
					$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden between '$fecha10' and '$fecha6' AND status_orden='CREADO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant; $suma_a1+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->l,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden between '$fecha10' and '$fecha6' AND status_orden='IMPRESO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant; $suma_i1+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					
					
					$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden between '$fecha20' and '$fecha11' AND status_orden='CREADO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant; $suma_a2+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->l,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden between '$fecha20' and '$fecha11' AND status_orden='IMPRESO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant; $suma_i2+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					
					
					$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and  fecha_orden < '$fecha20' AND status_orden='CREADO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant; $suma_a3+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->l,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden < '$fecha20' AND status_orden='IMPRESO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant; $suma_i3+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					
					
					
					$this->SetFont('Arial','B',8);
					$this->Cell(3,$this->ancho,"",0,0,"C");
					$this->Cell($w[1],$this->ancho,$suma_t,$this->l,0,'C');
					$this->Cell($w[1],$this->ancho,$suma_t2,$this->vacio,0,'C');
					$this->Cell($w[2],$this->ancho,$suma_t+$suma_t2,$this->r,0,'C');
					$this->SetFont('Arial','',8);
					
					
					$this->Ln();
					
					
					
				}
					$suma_t=0;
					$suma_t1=0;
					$suma_t2=0;
					$id_tipo_orden='TIO00005';
					$nombre_det_orden="RECLAMOS";
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,strtoupper($nombre_det_orden),$this->lr,0,'L');
					
					$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and fecha_orden between '$fecha5' and '$fecha' AND status_orden='CREADO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant; $suma_a+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->lb,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and fecha_orden between '$fecha5' and '$fecha' AND status_orden='IMPRESO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant; $suma_i+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->rb,0,'C');
					
					
					$this->Cell(3,$this->ancho_t-2,"",$this->vacio,0,"C");
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and fecha_orden between '$fecha10' and '$fecha6' AND status_orden='CREADO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant; $suma_a1+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->lb,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and fecha_orden between '$fecha10' and '$fecha6' AND status_orden='IMPRESO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant; $suma_i1+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->rb,0,'C');
					
					
					$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and  fecha_orden between '$fecha20' and '$fecha11' AND status_orden='CREADO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant; $suma_a2+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->lb,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and  fecha_orden between '$fecha20' and '$fecha11' AND status_orden='IMPRESO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant; $suma_i2+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->rb,0,'C');
					
					
					$this->Cell(3,$this->ancho_t-2,"",0,0,"C");
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and  fecha_orden < '$fecha20' AND status_orden='CREADO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant; $suma_a3+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->lb,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and  fecha_orden < '$fecha20' AND status_orden='IMPRESO' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant; $suma_i3+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->rb,0,'C');
					
					
					$this->SetFont('Arial','B',8);
					$this->Cell(3,$this->ancho,"",0,0,"C");
					$this->Cell($w[1],$this->ancho,$suma_t,$this->lb,0,"C");
					$this->Cell($w[1],$this->ancho,$suma_t2,$this->b,0,'C');
					$this->Cell($w[2],$this->ancho,$suma_t+$suma_t2,$this->rb,0,'C');
					$this->SetFont('Arial','',8);
					
					$this->Ln();
					
				
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tblr,0,'J');	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"C");
				$this->Cell($w[1],$this->ancho_t,$suma_a,$this->lb,0,'C');	
				$this->Cell($w[1],$this->ancho_t,$suma_i,$this->rb,0,'C');	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"C");
				$this->Cell($w[1],$this->ancho_t,$suma_a1,$this->lb,0,'C');	
				$this->Cell($w[1],$this->ancho_t,$suma_i1,$this->rb,0,'C');	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"C");
				$this->Cell($w[1],$this->ancho_t,$suma_a2,$this->lb,0,'C');	
				$this->Cell($w[1],$this->ancho_t,$suma_i2,$this->rb,0,'C');	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"C");
				$this->Cell($w[1],$this->ancho_t,$suma_a3,$this->lb,0,'C');	
				$this->Cell($w[1],$this->ancho_t,$suma_i3,$this->rb,0,'C');	
				
				$this->Cell(3,$this->ancho_t,"",0,0,"C");
				$this->Cell($w[1],$this->ancho_t,$suma_a+$suma_a1+$suma_a2+$suma_a3,$this->lb,0,'C');	
				$this->Cell($w[1],$this->ancho_t,$suma_i+$suma_i1+$suma_i2+$suma_i3,$this->b,0,'C');	
				$this->Cell($w[1],$this->ancho_t,$suma_a+$suma_i+$suma_a1+$suma_i1+$suma_a2+$suma_i2+$suma_a3+$suma_i3,$this->rb,0,'C');	
					
		
			$this->Ln(10);
	}

	function ordenes_mes_anterior($acceso,$fecha,$id_f,$setx,$sety)
	{
		$w=array(40,18,20,18);
		$this->config_style();
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
		}
		$fecha=date("Y-m-d");
		list($ano,$mes,$dia)=explode("-",$fecha);
		$fecha_ini="$ano-$mes-01";
		
		$right=$setx; $this->SetY($sety);
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('ORDENES FINALIZADAS DEL MES ANTERIOR')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t,strtoupper(_("DESCRIPCION")),$this->tbl,0,"L",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("ASIG")),$this->tb,0,"C",$this->fondo_t);
		$this->Cell($w[2],$this->ancho_t,strtoupper(_("FINAL")),$this->tb,0,"C",$this->fondo_t);
		$this->Cell($w[3],$this->ancho_t,strtoupper(_("CANC")),$this->tbr,0,"C",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_t=0;
		$suma_t1=0;
		$suma_t2=0;
				
				$dato=lectura($acceso,"SELECT id_det_orden,nombre_det_orden FROM vista_detalleorden WHERE  status_tipord='ORDEN' ORDER BY nombre_tipo_orden");
				for($j=0;$j<count($dato);$j++){
					$id_det_orden=trim($dato[$j]["id_det_orden"]);
					$nombre_det_orden=trim($dato[$j]["nombre_det_orden"]);
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,strtoupper($nombre_det_orden),$this->l,0,'L');
					
					//SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden between '$fecha_ini' and '$fecha' AND (status_orden='CREADO' OR status_orden='IMPRESO' OR (status_orden='FINALIZADO' and fecha_cierre between '$fecha_ini' and '$fecha') ) $consult
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' and fecha_orden < '$fecha_ini'  AND (status_orden='CREADO' OR status_orden='IMPRESO' OR (status_orden='FINALIZADO' and fecha_cierre between '$fecha_ini' and '$fecha') ) $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->vacio,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' AND status_orden='FINALIZADO' and fecha_orden < '$fecha_ini'  and fecha_cierre between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t1+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->vacio,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden' AND status_orden='CANCELADA' and fecha_orden < '$fecha_ini'  and fecha_cierre between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant;
					$this->Cell($w[3],$this->ancho,$cant,$this->r,0,'C');
					
					$this->Ln();
					
					
					
				}
					
					$id_tipo_orden='TIO00005';
					$nombre_det_orden="RECLAMOS";
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,strtoupper($nombre_det_orden),$this->l,0,'L');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and fecha_orden < '$fecha_ini'  AND (status_orden='CREADO' OR status_orden='IMPRESO' OR (status_orden='FINALIZADO' and fecha_cierre between '$fecha_ini' and '$fecha') )  $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->Cell($w[1],$this->ancho,$cant,$this->vacio,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' AND status_orden='FINALIZADO' and fecha_orden < '$fecha_ini'  and fecha_cierre between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t1+=$cant;
					$this->Cell($w[2],$this->ancho,$cant,$this->vacio,0,'C');
					
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden,detalle_orden where vista_orden.id_det_orden=detalle_orden.id_det_orden and id_tipo_orden='TIO00005' and status_orden='CANCELADA' and fecha_orden < '$fecha_ini'  and fecha_cierre between '$fecha_ini' and '$fecha' $consult");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t2+=$cant;
					$this->Cell($w[3],$this->ancho,$cant,$this->r,0,'C');
					
					$this->Ln();
					
				
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tbl,0,'J');	
				$this->Cell($w[1],$this->ancho_t,$suma_t,$this->tb,0,'C');	
				$this->Cell($w[2],$this->ancho_t,$suma_t1,$this->tb,0,'C');	
				$this->Cell($w[3],$this->ancho_t,$suma_t2,$this->tbr,0,'C');	
		
					
		
			$this->Ln(10);
	}

}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,5);
//agrega una nueva pagina
//$pdf->AddPage('L','letter');
//$pdf->AddPage('L','letter');
/*
$pdf->AddPage('P','letter');
$pdf->Titulo($titulo_cierre);
//$pdf->Cuerpo($acceso,$fecha,$id_f);

$pdf->abonados_incremento($acceso,$fecha,$id_f,10,23);
$pdf->analisis_vencimiento($acceso,$fecha,$id_f,110,23);

$pdf->ordenes_asignada_impresa($acceso,$fecha,$id_f,10,58);
$pdf->ordenes_mes($acceso,$fecha,$id_f,10,84);
$pdf->ordenes_mes_anterior($acceso,$fecha,$id_f,110,84);

$pdf->cortes_generales($acceso,$fecha,$id_f,10,155);
$pdf->reconexiones_generales($acceso,$fecha,$id_f,146,155);

$pdf->proceso_corte($acceso,$fecha,$id_f,77,155);

$pdf->ordenes_pendientes_semanas($acceso,$fecha,$id_f,10,190);

//$pdf->ordenes($acceso,$fecha,$id_f);
//$pdf->deuda_abo($acceso,$id_f);
//$pdf->detalle_factura($acceso,$fecha,$fecha,$id_f);

$pdf->Output('reporte.pdf','D');

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
				$titulo_cierre="INFORME TECNICO DE $nombre_franq";
			}
			
			$pdf=new PDF(); 
			$pdf->SetAutoPageBreak(true,10);
			$pdf->AddPage('P','letter');
			$pdf->Titulo($titulo_cierre);
			$pdf->abonados_incremento($acceso,$fecha,$id_f,10,23);
			$pdf->analisis_vencimiento($acceso,$fecha,$id_f,110,23);
			$pdf->ordenes_asignada_impresa($acceso,$fecha,$id_f,10,58);
			$pdf->ordenes_mes($acceso,$fecha,$id_f,10,84);
			$pdf->ordenes_mes_anterior($acceso,$fecha,$id_f,110,84);
			$pdf->cortes_generales($acceso,$fecha,$id_f,10,155);
			$pdf->reconexiones_generales($acceso,$fecha,$id_f,146,155);
			$pdf->proceso_corte($acceso,$fecha,$id_f,77,155);
			$pdf->ordenes_pendientes_semanas($acceso,$fecha,$id_f,10,190);

			
			$pdf->Output("../archivos/$id_f/$fecha cierre_tecnico.pdf",'F');
		}
		
			$id_f='0';
			
				$titulo_cierre='INFORME TECNICO GENERAL';
			
			
			$pdf=new PDF(); 
			$pdf->SetAutoPageBreak(true,10);
			$pdf->AddPage('P','letter');
			$pdf->Titulo($titulo_cierre);
			$pdf->abonados_incremento($acceso,$fecha,$id_f,10,23);
			$pdf->analisis_vencimiento($acceso,$fecha,$id_f,110,23);
			$pdf->ordenes_asignada_impresa($acceso,$fecha,$id_f,10,58);
			$pdf->ordenes_mes($acceso,$fecha,$id_f,10,84);
			$pdf->ordenes_mes_anterior($acceso,$fecha,$id_f,110,84);
			$pdf->cortes_generales($acceso,$fecha,$id_f,10,155);
			$pdf->reconexiones_generales($acceso,$fecha,$id_f,146,155);
			$pdf->proceso_corte($acceso,$fecha,$id_f,77,155);
			$pdf->ordenes_pendientes_semanas($acceso,$fecha,$id_f,10,190);
			
			$pdf->Output("../archivos/general/$fecha cierre_tecnico.pdf",'F');
			
			header('Location: Rep_zona_pImpreso_a.php');
?> 