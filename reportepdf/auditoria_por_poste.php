<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 



$gen_fec = $_GET['gen_fec'];
$desde1 = formatfecha($_GET['desde1']);
$hasta1 = formatfecha($_GET['hasta1']);
$por_fecha = $_GET['por_fecha'];
$tipo_lista = $_GET['tipo_lista'];
$deuda = $_GET['deuda'];
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$hasta_filtro = sumames(formatfecha($hasta));
$id_franq = $_GET['id_franq'];
$cod_id_persona = $_GET['cod_id_persona'];

$sd = trim($_GET['sd']);
$dep = trim($_GET['dep']);

$id_tipo_servicio = $_GET['id_tipo_servicio'];
$id_serv = $_GET['id_serv'];
$id_g_a = $_GET['id_g_a'];
$id_esta = $_GET['id_esta'];
$id_mun = $_GET['id_mun'];
$id_ciudad = $_GET['id_ciudad'];
$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$urbanizacion = $_GET['urbanizacion'];
$id_calle = $_GET['id_calle'];

$convenio = $_GET['convenio'];

$status_contrato = $_GET['status_contrato'];
$order = $_GET['order'];
if($order!=''){
	$valor=explode(":",$order);
$order =" order by ".$valor[0]." ".$valor[1] ;
}

$esta='';
	if($status_contrato!=''){
		$status=explode("=@",$status_contrato);
			$valor=$status[0];
			$esta=$esta." and (status_contrato='$valor'";
			for($i=1;$i<count($status)-1;$i++)
			{
				$valor=$status[$i];
				$esta=$esta." or status_contrato='$valor'";
			}
			$esta=$esta." )";
			
	}
	
$orden_list = $_GET['orden_list'];	
	$zona='';
	if($id_zona!=''){
		$dato=explode("=@",$id_zona);
			$valor=$dato[0];
			$zona=$zona." and (id_zona='$valor'";
			for($i=1;$i<count($dato)-1;$i++)
			{
				$valor=$dato[$i];
				$zona=$zona." or id_zona='$valor'";
			}
			$zona=$zona." )";
	}
	
	$sector='';
	if($id_sector!=''){
		$dato=explode("=@",$id_sector);
			$valor=$dato[0];
			$sector=$sector." and (id_sector='$valor'";
			for($i=1;$i<count($dato)-1;$i++)
			{
				$valor=$dato[$i];
				$sector=$sector." or id_sector='$valor'";
			}
			$sector=$sector." )";
	}
	
		
		$servicio='';
		if($id_serv!='' && $id_serv!='0'){
			$servicio=$servicio. " and  ( SELECT count(*) FROM contrato_servicio , servicios WHERE contrato_servicio.id_serv=servicios.id_serv and contrato_servicio.id_contrato = vista_contrato_auditoria.id_contrato  and (servicios.id_serv ILIKE '%$id_serv%'))>0";
		}
		else if($id_tipo_servicio!='' && $id_tipo_servicio!='0'){
			$servicio=$servicio. " and  ( SELECT count(*) FROM contrato_servicio , servicios WHERE contrato_servicio.id_serv=servicios.id_serv and contrato_servicio.id_contrato = vista_contrato_auditoria.id_contrato  and (id_tipo_servicio ILIKE '%$id_tipo_servicio%'))>0";
		}
	
		$fecha_act=date("Y-m-01");

		if($sd!=''){
			$sql_sd=" and  ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda , servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and 
			
			(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato_auditoria.id_contrato and fecha_inst < '$hasta_filtro'  and costo_cobro>0 )>0 and 	(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato_auditoria.id_contrato and fecha_inst < '$desde'  and costo_cobro>0 )<=0
			
			and ( SELECT count(vista_convenio.costo_cobro) FROM vista_convenio WHERE  vista_convenio.id_cont_serv = contrato_servicio_deuda.id_cont_serv AND vista_convenio.status_con_ser = 'DEUDA' and vista_convenio.status_conv='ACTIVO' and fecha_ven>='$hasta') <= 0
			) > $deuda   and ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst < '$fecha_act')> $deuda ";
			
			$sd_conv="  and vista_convenio.fecha_ven between '$desde' and '$hasta'";
			if($dep!=''){
				$sql_sd=$sql_sd." and  ( SELECT count(*) FROM pagodeposito WHERE  pagodeposito.id_contrato = vista_contrato_auditoria.id_contrato AND (status_pd = 'REGISTRADO' or status_pd = 'CONFIRMADO')) =0 ";
			
			}

		}
		$conv='';
		if($convenio=='CON CONVENIO'){
			
			$conv=" and ( SELECT count(*) FROM vista_convenio WHERE vista_convenio.id_contrato = vista_contrato_auditoria.id_contrato AND vista_convenio.status_con_ser = 'DEUDA'::bpchar  $sd_conv) > 0 ";
		}
		else if($convenio=='SIN CONVENIO'){
			$conv=" and ( SELECT count(*) FROM vista_convenio WHERE vista_convenio.id_contrato = vista_contrato_auditoria.id_contrato AND vista_convenio.status_con_ser = 'DEUDA'::bpchar  $sd_conv) <= 0 ";
		}
		else if($convenio=='CONVENIO POR FECHA'){
			$conv=" and ( SELECT count(*) FROM vista_convenio WHERE vista_convenio.id_contrato = vista_contrato_auditoria.id_contrato   $sd_conv) > 0 ";
		}
	
			$fecha_ven_conv = " ( SELECT vista_convenio.fecha_ven FROM vista_convenio WHERE vista_convenio.id_contrato = vista_contrato_auditoria.id_contrato AND vista_convenio.status_con_ser = 'DEUDA'::bpchar  $sd_conv order by fecha_ven limit  1 OFFSET 0) as convenio, ";
			
	//$sql=" 	SELECT numero_casa,edificio,numero_piso,postel,pto, id_contrato,Nro_contrato,id_franq,cedula,apellido,nombre,status_contrato,	 ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst <= '$fecha_act') AS deuda,	nombre_g_a,nombre_calle,urbanizacion, nombre_sector ,nombre_zona ,nombre_mun,nombre_franq,direc_adicional  ,cobrador,postel   FROM vista_contrato_auditoria  WHERE vista_contrato_auditoria.id_contrato<>'' $sql_sd $esta  $conv  ";
	
			$fecha_corte_c = " ( SELECT ordenes_tecnicos.fecha_final FROM ordenes_tecnicos WHERE ordenes_tecnicos.id_contrato = vista_contrato_auditoria.id_contrato AND ordenes_tecnicos.status_orden = 'FINALIZADO'  order by fecha_final desc limit 1) ";
			$fecha_corte = " ( SELECT ordenes_tecnicos.fecha_final FROM ordenes_tecnicos WHERE ordenes_tecnicos.id_contrato = vista_contrato_auditoria.id_contrato AND ordenes_tecnicos.status_orden = 'FINALIZADO'  order by fecha_final desc limit 1) as fecha_corte ";
	/*		
	$sql=" 	SELECT numero_casa,edificio,numero_piso,postel,pto, id_contrato,nro_contrato,etiqueta,id_franq,cedula,apellido,nombre,status_contrato,telf_casa,telefono,	 
	( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst < '$fecha_act') AS deuda
	,	nombre_g_a,nombre_calle,urbanizacion, nombre_sector ,nombre_zona ,nombre_mun,nombre_franq,direc_adicional   ,cobrador  FROM vista_contrato_auditoria  WHERE  vista_contrato_auditoria.id_contrato<>'' $sql_sd  $esta  $zona $sector  $conv  $servicio  ";
	
	*/
	$sql=" 	SELECT nombre_zona ,nombre_sector ,postel, count(*) as cantidad  FROM vista_contrato_auditoria  WHERE  vista_contrato_auditoria.id_contrato<>'' $sql_sd  $esta  $zona $sector  $conv  $servicio  ";
	$where=  $sql;
	
	if($gen_fec!='GENERAL'){
		if($por_fecha=='CORTE'){
			$where=$where. " and $fecha_corte_c between '$desde1' and '$hasta1'";
		}else if($por_fecha=='INSTALACION'){
			$where=$where. " and fecha_contrato between '$desde1' and '$hasta1'";
		}{
		}
	}
	
	
$tipo_fact = $_GET['tipo_fact'];
		if($tipo_fact!='' && $tipo_fact!='0'){
			$where=$where. " and (tipo_fact = '$tipo_fact')";
		}
		
		if($id_franq!='' && $id_franq!='0'){
			$where=$where. " and (id_franq = '$id_franq')";
		}
		if($cod_id_persona!='' && $cod_id_persona!='0'){
			$where=$where. " and (cod_id_persona ILIKE '%$cod_id_persona%')";
		}
		if($id_g_a!='' && $id_g_a!='0'){
			$where=$where. " and (id_g_a ILIKE '%$id_g_a%')";
		}
		if($id_esta!='' && $id_esta!='0'){
			$where=$where. " and (id_esta ILIKE '%$id_esta%')";
		}
		if($id_mun!='' && $id_mun!='0'){
			$where=$where. " and (id_mun ILIKE '%$id_mun%')";
		}
		if($id_ciudad!='' && $id_ciudad!='0'){
			$where=$where. " and (id_ciudad ILIKE '%$id_ciudad%')";
		}
		/*
		if($id_zona!='' && $id_zona!='0'){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
		}
		if($id_sector!='' && $id_sector!='0'){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		*/
		 
		if($id_calle!='' && $id_calle!='0'){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		if($urbanizacion!='' && $urbanizacion!='0'){
			$where=$where. " and (urbanizacion = '$urbanizacion')";
		}
		
	//$where=$where." order by id_zona $order";
	//$x->consultas($where);
	

	$where=$where." group by nombre_zona ,nombre_sector ,postel order by  nombre_zona ,nombre_sector ,postel ";
//	echo $where;
	

	//	echo $where;
		
			$acceso->objeto->ejecutarSql("SELECT nombre, apellido FROM vista_cobrador where id_persona='$cod_id_persona' ");
			if($row=row($acceso)){
					$cobrador=utf8_decode(trim($row["nombre"]))." ".utf8_decode(trim($row["apellido"]))."";
				//	echo $paquete;
			}

//echo $where;
class PDF extends FPDF
{
	
	function Header()
	{
		$this->SetFont('Arial','',12);

		$this->SetXY(10,5);
		$this->Cell(60,5,nombre_empresa(),'0',0,'L');
		$this->SetFont('Arial','U',12);
		$this->Cell(120,5,"LISTADO PARA AUDITORIA",'0',0,'C');
		
		$this->SetFont('Arial','B',8);
		$this->SetX(180);
		$this->Cell(12,5,strtoupper(_('fecha')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(34,5,date("h:i:s A"),0,0,'L');
		$this->SetFont('Arial','B',9);
		$this->AliasNbPages();
		 $this->Cell(10,5,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
		$this->Ln(3);
		
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(171,171,171);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,25,50,22,20,20,20,30,60);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abonado.')),strtoupper(_('cliente')),strtoupper(_('precinto')),strtoupper(_('deuda TV')),strtoupper(_('Deuda int.')),strtoupper(_('total')),strtoupper(_('status')),strtoupper(_('OBSERVACION')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],6,$header[$k],1,0,'C',1);
		$this->Ln();
		
	}
		
	function Cuerpo($acceso,$where,$deuda,$desde,$hasta,$titulo_list,$salto_p,$cobrador)
	{
	
	
		$w=array(10,25,50,22,20,20,20,30,60);
		
		$dato=lectura($acceso,$where);
		
		$cont=1;
		
			$cable=conexion();
			$suma_total_deuda=0;
			$fecha_act=date("Y-m-01");
		for($i=0;$i<count($dato);$i++){
			
			
			$fill=0;
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			
			$nombre_zona=utf8_decode(trim($dato[$i]["nombre_zona"]));
			$nombre_sector=utf8_decode(trim($dato[$i]["nombre_sector"]));
			$postel=utf8_decode(trim($dato[$i]["postel"]));
			$cantidad=trim($dato[$i]["cantidad"]);
			
				$this->Ln(3);
			$this->SetX(10);
			
			$this->SetFont('Arial','B',11);
			$this->Cell(12,6,"Zona: ","B",0,"L",$fill);
			$this->SetFont('Arial','',11);
			$this->Cell(24,6,$nombre_zona,"B",0,"L",$fill);
			
			$this->SetFont('Arial','B',11);
			$this->Cell(14,6,"Sector: ","B",0,"L",$fill);
			$this->SetFont('Arial','',11);
			$this->Cell(50,6,$nombre_sector,"B",0,"L",$fill);
			
			$this->SetFont('Arial','B',11);
			$this->Cell(12,6,"Poste: ","B",0,"L",$fill);
			$this->SetFont('Arial','',11);
			$this->Cell(24,6,$postel,"B",0,"L",$fill);
			
			$cable->objeto->ejecutarSql("SELECT nombre_calle,numero_casa,direc_adicional  FROM vista_contrato_auditoria  WHERE  nombre_zona='$nombre_zona' and  nombre_sector='$nombre_sector' and  postel='$postel'   order by direc_adicional desc limit 1");
			
			$row=row($cable);
			$nombre_calle = utf8_decode(trim($row["nombre_calle"]));
			$numero_casa = utf8_decode(trim($row["numero_casa"]));
			$direc_adicional = utf8_decode(trim($row["direc_adicional"]));
				
				
				
			
			$this->SetFont('Arial',"B",8);
			$this->Cell(7,6,"Dir: ","B",0,"L",$fill);
			$this->SetFont('Arial','',8);
			$alto=$this->GetY();
			$this->SetXY(153,$alto-1);
			$dir=substr("Calle: $nombre_calle; $direc_adicional",0,140);
			$dir=str_replace("
"," ",$dir);
			$dir=str_replace("\n"," ",$dir);
			$this->MultiCell(116,3,$dir,"0","J",$fill);
			
			$this->SetY($alto+6);
			
		//	$this->Ln();
			
	
			$cable->objeto->ejecutarSql("SELECT nro_contrato,etiqueta,apellido,nombre,status_contrato,	 
	( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and  (id_tipo_servicio = 'TSE00001') and fecha_inst < '$fecha_act') AS deuda_tv,	 
	( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and  (id_tipo_servicio = 'AE00001 ') and fecha_inst < '$fecha_act') AS deuda_internet  FROM vista_contrato_auditoria  WHERE  nombre_zona='$nombre_zona' and  nombre_sector='$nombre_sector' and  postel='$postel' order by status_contrato ");
				 

				
				$servicio='';
			while($row=row($cable)){
				
				$deuda_tv = trim($row["deuda_tv"])+0;
				$deuda_internet = trim($row["deuda_internet"])+0;
				$total_deuda = $deuda_internet+$deuda_tv;
				$suma_total_deuda+=$total_deuda ;
				$borde="1";
				$this->SetFont('Arial','',10);
				$this->SetX(10);
				$this->Cell($w[0],6,$cont,$borde,0,"C",$fill);
				$this->Cell($w[1],6,utf8_decode(trim($row["nro_contrato"])),$borde,0,"J",$fill);
				$this->Cell($w[2],6,substr(utf8_decode(trim($row["nombre"])." ".trim($row["apellido"])),0,20),$borde,0,"J",$fill);
				$this->Cell($w[3],6,utf8_decode(trim($row["etiqueta"])),$borde,0,"C",$fill);
				$this->Cell($w[4],6,number_format($deuda_tv+0, 2, ',', '.'),$borde,0,"R",$fill);
				$this->Cell($w[5],6,number_format($deuda_internet+0, 2, ',', '.'),$borde,0,"R",$fill);
				$this->Cell($w[6],6,number_format($total_deuda+0, 2, ',', '.'),$borde,0,"R",$fill);
				$this->SetFont('Arial','B',10);
				$this->Cell($w[7],6,trim($row["status_contrato"]),$borde,0,"L",$fill);
				$this->Cell($w[8],6,"",$borde,0,"R",$fill);
				
				$this->Ln();
				
				
				
				$cont++;
			}
		}
		
		$suma_total_deuda=number_format($suma_total_deuda+0, 2, ',', '.');
		$this->Ln();
		$this->SetFont('Arial','B',9);
		$this->MultiCell(193,5,"TOTAL DEUDA:  $suma_total_deuda","0","J");
		
		$this->SetX(10);
		//$this->Cell(array_sum($w),5,'','T');
		$cad.="\\pard\\par
}
";
		return $cad;
	}
	
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,1);
$pdf->AddPage('L','letter');
$pdf->Cuerpo($acceso,$where,$deuda,$desde,$hasta,$titulo_list,$salto,$cobrador);


$pdf->Output('reporte.pdf','D');

?>
