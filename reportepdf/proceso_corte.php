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
			) > $deuda   and ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst < '$fecha_act')> $deuda";
			
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
	$sql="SELECT numero_casa,edificio,numero_piso,postel,pto, id_contrato,nro_contrato,etiqueta,id_franq,cedula,apellido,nombre,status_contrato,telf_casa,telefono,	 ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst <= '$fecha_act') AS deuda,	nombre_g_a,nombre_calle,urbanizacion, nombre_sector ,nombre_zona ,nombre_mun,nombre_franq,direc_adicional   ,cobrador  FROM vista_contrato_auditoria  WHERE  vista_contrato_auditoria.id_contrato<>'' $sql_sd  $esta  $zona $sector   $conv  $servicio  ";
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
//	echo $where;
	//$x->consultas($where);
	$where=$where." order by  $orden_list";

	//	echo $where;
		
			$acceso->objeto->ejecutarSql("SELECT nombre, apellido FROM vista_cobrador where id_persona='$cod_id_persona' ");
			if($row=row($acceso)){
					$cobrador=utf8_decode(trim($row["nombre"]))." ".utf8_decode(trim($row["apellido"]))."";
				//	echo $paquete;
			}

//echo $where;
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function cabecera($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list,$cobrador='')
	{
		//$this->SetY(10);
		$this->SetFont('Arial','B',9);
		$this->Cell(50,5,nombre_empresa(),'0',0,'J');
		$this->Cell(93,5,strtoupper(_($titulo_list))." $cobrador",'0',0,'C');
		$this->Cell(50,5,strtoupper(_("fecha")).":".date("d/m/Y"),'0',0,'R');
		$this->Ln();
			$this->cabecera_titulo($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list,$cobrador);
		
	}
	function cabecera_titulo($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list)
	{
		//$this->SetY(10);
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(120,5,"Muni: $nombre_mun    Zona: $nombre_zona     Sector : $nombre_sector","0",0,"L");
			$this->Cell(75,5,"$fecha_d","0",1,"R");
		
	}
	
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(171,171,171);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(12,15,18,60,18,40,30);
		$header=array(strtoupper(_('nro')),strtoupper(_('cont.')),strtoupper(_('cedula')),strtoupper(_('nombre y apellido')),strtoupper(_('etiqueta')),strtoupper(_('telefonos')),strtoupper(_('status')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],5,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$where,$deuda,$desde,$hasta,$titulo_list,$salto_p,$cobrador)
	{
	
	
	
		$dato=lectura($acceso,$where);
		
		$cont=1;
		
		$fecha_act=date("Y-m-d");
		$salto=0;
		$f_act=date("d/m/Y");
		$h_act=date("h:i:s A");
		$nombre_mun=utf8_decode(trim($dato[0]["nombre_mun"]));
		$nombre_zona=utf8_decode(trim($dato[0]["nombre_zona"]));
		$nombre_sector=utf8_decode(trim($dato[0]["nombre_sector"]));
		
		$this->SetFont('Arial','B',8);
			$valor=explode("-",trim($desde));
			$des = formato_mes_com1($valor[1]). " $valor[0] ";
			
			$valor=explode("-",trim($hasta));
			$has = formato_mes_com1($valor[1]). " $valor[0] ";
			$fecha_d=_("Deuda")." " ._("Desde")."  $des   ".strtoupper(_("hasta"))."  $has";
			$this->cabecera($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list,$cobrador);
			
			
			
			
		//$this->Ln();

			$w=$this->TituloCampos();
			$cable=conexion();
			session_start();
			 $ini_u = $_SESSION["ini_u"]; 
			$acceso->objeto->ejecutarSql("select *from proceso_corte  where (id_proc ILIKE '$ini_u%') ORDER BY id_proc desc"); 
			$id_proc = $ini_u.verCo($acceso,"id_proc");
			$login_proc=$_SESSION["login"];
			$fecha_proc=date("Y-m-d");
			$acceso->objeto->ejecutarSql("insert into proceso_corte(id_proc,login_proc,fecha_proc,status_proc) values ('$id_proc','$login_proc','$fecha_proc','GENERADO')");	
			
		for($i=0;$i<count($dato);$i++){
			
			$status_contrato=trim($dato[$i]["status_contrato"]);
			if($status_contrato=='ACTIVO'){
			
			$fill=0;
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			
			$id_contrato=trim($dato[$i]["id_contrato"]);
			
			$nombre_sector1=utf8_decode(trim($dato[$i]["nombre_sector"]));
			if($nombre_sector!=$nombre_sector1){
			//	echo ":$nombre_sector!=$nombre_sector1:";
			//echo "$salto_p:";
				if($salto_p=="SALTO"){
					$this->AddPage();	
					$this->cabecera($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list);
					$w=$this->TituloCampos();
					$salto=0;
				}else{
					$this->cabecera_titulo($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list);
					$w=$this->TituloCampos();
				}
			}
			
			 $meses=lectura($acceso,"SELECT distinct fecha_inst  FROM contrato_servicio_deuda where   fecha_inst <= '$fecha_act' and id_contrato='$id_contrato'  and status_con_ser='DEUDA' order by fecha_inst");
			 $dato1=array();
			 $ind=0;
			 
			 for($k=0;$k<count($meses);$k++){
				$fecha_inst=trim($meses[$k]["fecha_inst"]);
				list($ano,$mes,$dia)=explode("-",$fecha_inst);
				$fecha1="$ano-$mes";
				//echo $fecha1;
				if(!in_array($fecha1,$dato1)){
					$dato1[$ind]=$fecha1;
					$ind++;
				}
			 }
			 $det_deuda="";
			for($k=0;$k<count($dato1);$k++){
				$fecha_inst=trim($dato1[$k]);
				list($ano,$mes)=explode("-",$fecha_inst);
				$anio=substr($ano, -2);
				$mes_l = "$mes/$anio";
			//	echo $mes_l;
				$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $ano ));
				
				$fec_ini="$ano-$mes-01";
				$fec_fin="$ano-$mes-$ult_dia_mes";
			//	echo "SELECT sum(costo_cobro*cant_serv) as costo_cobro  FROM contrato_servicio_deuda where  id_contrato='$id_contrato' and status_con_ser='DEUDA' and fecha_inst between '$fec_ini' and '$fec_fin'" ;
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro  FROM contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and id_tipo_servicio='TSE00001' AND id_contrato='$id_contrato' and status_con_ser='DEUDA' and fecha_inst between '$fec_ini' and '$fec_fin' ");
				
				$row=row($acceso);
				$costo_cobro=trim($row["costo_cobro"])+0;
				$costo_cobro=number_format(trim($row["costo_cobro"])+0, 2, ',', '.');
				if($costo_cobro>0){
					$det_deuda = $det_deuda."C $mes_l:  $costo_cobro;        ";
				}
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro  FROM contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and id_tipo_servicio='AP00001' AND id_contrato='$id_contrato' and status_con_ser='DEUDA' and fecha_inst between '$fec_ini' and '$fec_fin' ");

				$row=row($acceso);
				$costo_cobro=trim($row["costo_cobro"])+0;
				$costo_cobro=number_format(trim($row["costo_cobro"])+0, 2, ',', '.');
				if($costo_cobro>0){
					$det_deuda = $det_deuda."I $mes_l:  $costo_cobro;        ";
				}
			}
			/*
			//echo "SELECT vista_convenio.fecha_ven FROM vista_convenio WHERE vista_convenio.id_contrato = '$id_contrato' AND vista_convenio.status_con_ser = 'DEUDA'::bpchar  order by fecha_ven asc limit  1 OFFSET 0 ";
			$acceso->objeto->ejecutarSql("SELECT vista_convenio.fecha_ven FROM vista_convenio WHERE vista_convenio.id_contrato = '$id_contrato' AND vista_convenio.status_con_ser = 'DEUDA'::bpchar  order by fecha_ven asc limit  1 OFFSET 0 ");
			$fecha_ven='';
			if($row=row($acceso)){
				echo $fecha_ven;
				$fecha_ven="VEN. CONV. ".formatofecha(trim($row["fecha_ven"]));	
			}
				*/
		//	ordenDeCorte($acceso,$id_contrato,$tecnico);
			
			$this->SetX(10);
			
			$total_p=trim($dato[$i]["deuda"]);
			$porc=($por_iva/100)+1;
			$base=$total_p/$porc;
			$iva=($base*$por_iva)/100;
			
			$this->SetFont('Arial','',8);
			$this->SetX(10);
			$this->Cell($w[0],5,$cont,"1",0,"C",$fill);
			$this->SetFont('Arial','B',8);
			$this->Cell($w[1],5,utf8_decode(trim($dato[$i]["nro_contrato"])),"1",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell($w[2],5,utf8_decode(trim($dato[$i]["cedula"])),"1",0,"J",$fill);
			$this->SetFont('Arial','B',8);
			$this->Cell($w[3],5,substr(utf8_decode(trim($dato[$i]["nombre"])." ".trim($dato[$i]["apellido"])),0,30),"1",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell($w[4],5,utf8_decode(trim($dato[$i]["etiqueta"])),"1",0,"J",$fill);
			$this->Cell($w[5],5,utf8_decode(trim($dato[$i]["telefono"])." / ".trim($dato[$i]["telf_casa"])),"1",0,"J",$fill);
			$this->Cell($w[6],5,trim($dato[$i]["status_contrato"]),"1",0,"R",$fill);
			$deuda=number_format(trim($dato[$i]["deuda"])+0, 2, ',', '.');
			
			
			$nombre_sector=utf8_decode(trim($dato[$i]["nombre_sector"]));
			$edificio=utf8_decode(trim($dato[$i]["edificio"]));
			$numero_piso=utf8_decode(trim($dato[$i]["numero_piso"]));
			$urbanizacion=utf8_decode(trim($dato[$i]["urbanizacion"]));
			$nombre_calle=utf8_decode(trim($dato[$i]["nombre_calle"]));
			$urbanizacion=utf8_decode(trim($dato[$i]["urbanizacion"]));
			$direc_adicional=utf8_decode(trim($dato[$i]["direc_adicional"]));
			$numero_casa=utf8_decode(trim($dato[$i]["numero_casa"]));
			$postel=utf8_decode(trim($dato[$i]["postel"]));
			$pto=utf8_decode(trim($dato[$i]["pto"]));
			$cobrador=utf8_decode(trim($dato[$i]["cobrador"]));
			
			
			if($edificio!=''){
				$edificio=",  Edif: $edificio, piso: $numero_piso ,";
			}
			if($urbanizacion!=''){
				$urbanizacion=", Urb: $urbanizacion , ";
			}
			//ECHO "<BR>:$postel:";
			$dir ="CALLE: $nombre_calle $urbanizacion $edificio ; NRO CASA: $numero_casa ; REF. $direc_adicional, $postel, PUNTOS: $pto; ";
			$this->Ln();
		
			$this->SetFont('Arial','',8);
			$this->MultiCell(193,5,"$dir","1","J",$fill);
			
				
			//ECHO " SELECT fecha_pago,fecha_inst,monto_pago, nro_factura  FROM vista_pago_ser where  id_contrato='$id_contrato' order fecha_inst desc ";
			/*
			$acceso->objeto->ejecutarSql("SELECT fecha_pago,fecha_inst,monto_pago, nro_factura  FROM vista_pago_ser where  id_contrato='$id_contrato' order BY fecha_inst desc LIMIT 1");
				$row=row($acceso);
					$fecha_pago=formatofecha(trim($row["fecha_pago"]));
					$fecha_inst=trim($row["fecha_inst"]);
					list($ano,$mes,$dia)=explode("-",$fecha_inst);
					$periodo = formato_mes_com1($mes)." $ano";
					$nro_factura=trim($row["nro_factura"]);
					$monto_pago=trim($row["monto_pago"])+0;
					$monto_pago=number_format(trim($row["monto_pago"])+0, 2, ',', '.');
					$this->SetFont('Arial','B',8);
					$this->Cell(30,5,"ULTIMO PAGO","LBT",0,"J",$fill);
					$this->Cell(12,5,"FECHA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',8);
					$this->Cell(17,5,"$fecha_pago","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',8);
					$this->Cell(18,5,"FACTURA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',8);
					$this->Cell(16,5,"$nro_factura","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',8);
					$this->Cell(14,5,"PAGO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',8);
					$this->Cell(14,5,"$monto_pago","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',8);
					$this->Cell(17,5,"PERIODO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',8);
					$this->Cell(25,5,"$periodo","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(13,5,"DEUDA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',10);
					$this->Cell(17,5,"$deuda","TBR",0,"J",$fill);
					
			$this->Ln();	
			*/
			$this->SetFont('Arial','B',8);
			$this->MultiCell(193,5,"DETALLE: $det_deuda      TOTAL:$deuda ","1","J",$fill);
			$acceso->objeto->ejecutarSql("SELECT  nombre_servicio, cant_serv FROM contrato_servicio,servicios where contrato_servicio.id_serv=servicios.id_serv and  id_contrato='$id_contrato' ");
			$paquete='';
			
			while ($row=row($acceso)){
					$paquete=$paquete.utf8_decode(trim($row["nombre_servicio"])).": ".utf8_decode(trim($row["cant_serv"]))."; ";
				//	echo $paquete;
			}
			
			
			/*
		//$this->Ln();
		$this->SetFont('Arial','',8);
		$this->MultiCell(193,5,"PAQUETES SUSCRITOS:  $paquete","1","J");
		*/
			
session_start();
						$id_fr = $_SESSION["id_franq"]; 
						$serie='';
						if($id_fr!='0'){
							$cons=" and  id_franq='$id_fr'";
							$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_fr'");
							$row=row($acceso);
							$serie= trim($row["serie"]);
						}
						else{
							$cons=" and  id_franq='1'";
						}
						/*
						$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos, contrato,vista_ubica where  ordenes_tecnicos.id_contrato = contrato.id_contrato and contrato.id_calle=vista_ubica.id_calle  ORDER BY num_o desc  LIMIT 1 offset 0 "); 
						$id_orden = verNumero($acceso,"id_orden");*/
						session_start();
						$ini_u = $_SESSION["ini_u"];  
						$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos  where (id_orden ILIKE '$ini_u%')   ORDER BY id_orden desc LIMIT 1 offset 0 ");
						$id_orden=$ini_u.verCodLong($acceso,"id_orden");
						
						
			$login= $_SESSION["login"];
			$hora=date("H:i:s");
			$fecha_orden=date("Y-m-d");
			
			$acceso->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,id_det_orden,fecha_orden,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad,login,hora) values ('$id_orden','DEO00010','$fecha_orden','PROCESO DE CORTE','','CREADO','$id_contrato','NORMAL','$login','$hora')");
			$acceso->objeto->ejecutarSql("update contrato set status_contrato='POR CORTAR' where id_contrato='$id_contrato' ");
			
			$acceso->objeto->ejecutarSql("select *from abo_cortados  where (id_abo_c ILIKE '$ini_u%') ORDER BY id_abo_c desc"); 
			$id_abo_c = $ini_u.verCodlong($acceso,"id_abo_c");
			
			
			$acceso->objeto->ejecutarSql("insert into abo_cortados(id_abo_c,id_proc,id_contrato,id_orden) 
			values ('$id_abo_c','$id_proc','$id_contrato','$id_orden')");
			
			$this->Ln(3);
			
			$fill=!$fill;
			
			$salto++;
			if($salto==10 && $salto!=count($dato)){
				
				if($salto_p=="SALTO"){
					$this->AddPage();	
					$this->cabecera($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list);
					$w=$this->TituloCampos();
					$salto=0;
				}else{
					$this->cabecera_titulo($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list);
					$w=$this->TituloCampos();
				}
				/*
				$this->AddPage();
				$this->cabecera($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list);
				$w=$this->TituloCampos();
				$salto=0;
				*/
			}
			
			
		$cont++;
		}
		}
		$this->SetX(10);
		//$this->Cell(array_sum($w),5,'','T');
		$cad.="\\pard\\par
}
";
		return $cad;
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-18);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage('P','letter');
$pdf->Cuerpo($acceso,$where,$deuda,$desde,$hasta,$titulo_list,$salto,$cobrador);


$pdf->Output('reporte.pdf','D');

?>
