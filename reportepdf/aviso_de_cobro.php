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

$titulo = $_GET['titulo'];

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
	
		$fecha_act=date("Y-m-d");

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
			
			$fecha_corte_c = " ( SELECT ordenes_tecnicos.fecha_final FROM ordenes_tecnicos WHERE ordenes_tecnicos.id_contrato = vista_contrato_auditoria.id_contrato AND ordenes_tecnicos.status_orden = 'FINALIZADO'  order by fecha_final desc limit 1) ";
			$fecha_corte = " ( SELECT ordenes_tecnicos.fecha_final FROM ordenes_tecnicos WHERE ordenes_tecnicos.id_contrato = vista_contrato_auditoria.id_contrato AND ordenes_tecnicos.status_orden = 'FINALIZADO'  order by fecha_final desc limit 1) as fecha_corte ";
	$sql=" 	SELECT id_contrato,
	nro_contrato,id_franq,cedula,apellido,nombre,status_contrato,	 ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst <= '$fecha_act') AS deuda,	nombre_g_a,nombre_calle,urbanizacion,edificio, nombre_sector ,nombre_zona ,nombre_mun,nombre_franq,direc_adicional  ,cobrador,postel,etiqueta   FROM vista_contrato_auditoria  WHERE vista_contrato_auditoria.id_contrato<>'' $sql_sd $esta  $zona $sector  $conv   $servicio ";
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
		
	$where=$where." order by  $orden_list";




//echo $where;
class PDF extends FPDF
{
	
	function Cuerpo($acceso,$where,$deuda,$desde,$hasta,$titulo,$obser_aviso)
	{
		$dato=lectura($acceso,$where);
		//$titulo="AVISO DE COBRO";
		$cant=0;
		$entro=false;
		for($i=0;$i<count($dato);$i++){
			$id_contrato=trim($dato[$i]["id_contrato"]);
			
			if($i%2==0){
				if($cant<=10 && $entro==true){
					$this->estado_cuenta_con($acceso,$id_contrato,$titulo,140);
				}else{
					$this->AddPage('P','letter');
					$this->estado_cuenta_con($acceso,$id_contrato,$titulo,6);
				}
				$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM contrato_servicio_deuda where id_contrato='$id_contrato' AND costo_cobro>0");
				$row=row($acceso);
				$cant=trim($row["cant"]);
				$entro=false;
				//echo ":$cant:";
				
				
			}
			else{
				//echo ":$cant:";
				if($cant>10){
					$entro=true;
					$this->AddPage('P','letter');
					$this->estado_cuenta_con($acceso,$id_contrato,$titulo,6);
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM contrato_servicio_deuda where id_contrato='$id_contrato' AND costo_cobro>0");
					$row=row($acceso);
					$cant=trim($row["cant"]);
				}else{
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM contrato_servicio_deuda where id_contrato='$id_contrato' AND costo_cobro>0");
					$row=row($acceso);
					$cant=trim($row["cant"]);
					if($cant>10){
						$entro=true;
						$this->estado_cuenta_con($acceso,$id_contrato,$titulo,6);
					}else{
						$entro=false;
						$this->estado_cuenta_con($acceso,$id_contrato,$titulo,140);
					}
				}
				//$this->aviso2($acceso,$id_contrato);
			}
			
			$this->Ln(6);
			$this->SetX(10);
			$this->SetFont('Arial','',9);
			$this->MultiCell(190,5,strtoupper($obser_aviso),'0','J');
		
		}
	}
	
	function estado_cuenta_con($acceso,$id_contrato,$titulo,$sety)
	{
		
		
		
		$acceso->objeto->ejecutarSql("select *from parametros where id_param='57' and id_franq='1'");
		$row=row($acceso);
		$logo=trim($row['valor_param']);

		$acceso->objeto->ejecutarSql("select *from parametros where id_param='58' and id_franq='1'");
		$row=row($acceso);
		$ancho_logo=trim($row['valor_param']);
		
		$this->Image('../imagenes/'.$logo,10,$sety-3,$ancho_logo);
		$this->SetFont('Times','B',12);
		$this->SetXY(50,$sety);
		$this->MultiCell(80,5,strtoupper(nombre_empresa()),'0','l');
		$this->SetFont('Times','B',11);
		$this->SetXY(50,$sety+5);
		$this->MultiCell(70,5,strtoupper(" ".tipo_serv()),'0','l');
		$this->Ln(1);
		$this->SetX(50);
		$this->SetFont('Arial','',9);
		$this->MultiCell(150,3,telef_emp(),'0','L');

		$this->Ln(2);		
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		$this->Cell(12,5,strtoupper(_('fecha')).": ",0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',9);
		$this->Cell(12,5,strtoupper(_('hora')).": ",0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
		
		
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contrato_auditoria where id_contrato='$id_contrato'");
		
		
		if($row=row($acceso))
		{
			$nro_contrato=trim($row["nro_contrato"]);
			$cedula=trim($row["cedula"]);
			$nombre=utf8_d(trim($row["nombre"]));
			$apellido=utf8_d(trim($row["apellido"]));
			$telefono=trim($row["telefono"]);
			$telf_casa=trim($row["telf_casa"]);
			$email=trim($row["email"]);
			$direc_adicional=utf8_d(trim($row["direc_adicional"]));
			$numero_casa=trim($row["numero_casa"]);
			$nombre_calle=utf8_d(trim($row["nombre_calle"]));
			$nombre_sector=utf8_d(trim($row["nombre_sector"]));
			
			$nombre_franq=utf8_d(trim($row["nombre_franq"]));
			$edificio=utf8_d(trim($row["edificio"]));
			$numero_piso=trim($row["numero_piso"]);
			$telf_adic=trim($row["telf_adic"]);
			$telefono ="$telefono / $telf_casa / $telf_adic"; 
			$fecha_contrato=formatofecha(trim($row["fecha_contrato"]));
			$status_contrato=trim($row["status_contrato"]);
			$status_contrato=trim($row["status_contrato"]);
			$etiqueta=utf8_d(trim($row["etiqueta"]));
		
			$nombre_zona=utf8_d(trim($row["nombre_zona"]));
			$nombre_mun=utf8_d(trim($row["nombre_mun"]));
			$nombre_sector=utf8_decode(trim($row["nombre_sector"]));
			$edificio=utf8_decode(trim($row["edificio"]));
			$numero_piso=utf8_decode(trim($row["numero_piso"]));
			$urbanizacion=utf8_decode(trim($row["urbanizacion"]));
			$nombre_calle=utf8_decode(trim($row["nombre_calle"]));
			$urbanizacion=utf8_decode(trim($row["urbanizacion"]));
			$direc_adicional=utf8_decode(trim($row["direc_adicional"]));
			
			
			if($edificio!=''){
				$edificio=",  Edif: $edificio, piso: $numero_piso ";
			}
			if($urbanizacion!=''){
				$urbanizacion=", Urb: $urbanizacion ";
			}
			$dir ="$nombre_mun, $nombre_zona, $nombre_sector, $urbanizacion,  $nombre_calle $edificio,  $numero_casa ; REF. $direc_adicional";
			
			
			$this->SetXY(125,$sety-4);
			$this->SetFont('Arial','B',10);
			$this->Cell(75,5,strtoupper(_("suscriptor")),"1",0,"C");
			
			$this->Ln();
			$this->SetX(125);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,6,strtoupper(_("contrato nro")).": ","0",0,"J");
			$this->SetFont('Arial','',9);
			$this->Cell(75,6,$nro_contrato  ."         ".$status_contrato ,"0",0,"J");
	
			$this->Ln();
			$this->SetX(125);
			$this->SetFont('Arial','B',9);
			$this->Cell(75,6,$apellido."   ". $nombre,"0",0,"J");
			
			$this->Ln();
			$this->SetX(125);
			$this->SetFont('Arial','B',9);
			$this->Cell(17,6,strtoupper(_("ci/r.i.f.")).": ","0",0,"J");
			$this->SetFont('Arial','',9);
			$this->Cell(45,6,$cedula ,"0",0,"J");
			//celda
			$this->SetXY(125,$sety+1);
			$this->Cell(75,18,"","1",0,"J");
			
			$this->Ln(20);
			
			
			
			$this->SetX(10);
			$this->SetFont('Arial','B',10);
			$this->Cell(23,6,strtoupper(_("Direccion")).": ","0",0,"J");
			$this->SetFont('Arial','',10);
			$this->MultiCell(170,5,$dir ,"0","J");
		}
		
			
			$this->Ln(2);
			$this->SetX(10);
			$this->SetFont('Times','B',12);
			$this->Cell(70,6,strtoupper(_($titulo)),"1",0,"C");
		
			$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as deuda FROM contrato_servicio_deuda where id_contrato='$id_contrato'  AND costo_cobro>0");
			$row=row($acceso);
			$deuda=trim($row["deuda"]);
		
		$this->SetFont('Times','B',12);
		$this->Cell(50,6,"","0",0,"R",$fill);
		$this->Cell(70,6,strtoupper(_('monto pendiente')).": ".number_format($deuda+0, 2, ',', '.'),"1",0,"C",$fill);
		
		
		$this->Ln(7);
		
		$this->SetFillColor(244,249,255);
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(171,171,171);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(15,30,65,40,40);
		$header=array(strtoupper(_('nro')), strtoupper(_('aviso nro')),strtoupper(_('servicio')),strtoupper(_('periodo')),strtoupper(_('monto bs.f')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contratodeu where id_contrato='$id_contrato'  AND costo_cobro>0 order by fecha_inst asc");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$suma=0.00;
		while ($row=row($acceso))
		{
			$tipo_costo=trim($row["tipo_costo"]);
			$total=0.00;
			$cant=trim($row["cant_serv"]);
			$tar=trim($row["costo_cobro"]);
			$total=($cant*$tar);
			$suma=$suma+$total;
			$fecha_inst=trim($row["fecha_inst"]);
			
							$fec = explode ("-",$fecha_inst);
							$me=$fec[1];
							$anio=$fec[0];
							$mes=array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
							$f_mes=$mes[$me];
							if($tipo_costo=="COSTO MENSUAL"){
								$fecha=strtoupper("$f_mes $anio");
							}
							else{
								$fecha = date("d/m/Y", strtotime($value));
							}
			
			$fill=0;
			$this->SetX(10);
			$this->Cell($w[0],5,$cont,"L",0,"J",$fill);
			$this->Cell($w[1],5,utf8_d(trim($row["id_cont_serv"])),"0",0,"J",$fill);
			$this->Cell($w[2],5,utf8_d(trim($row["nombre_servicio"])),"0",0,"J",$fill);
			$this->Cell($w[3],5,$fecha,"0",0,"J",$fill);
			$this->Cell($w[4]-15,5,number_format(utf8_d(trim($row["costo_cobro"]))+0, 2, ',', '.'),"0",0,"R",$fill);
			$this->Cell(15,5,'',"R",0,"R",$fill);
			


			$this->Ln();
			//$fill=!$fill;
			$cont++;
		}
		
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
		
			$this->Ln();	
			
			$acceso->objeto->ejecutarSql("SELECT fecha_pago,fecha_inst,monto_pago, nro_factura  FROM vista_pago_ser where  id_contrato='$id_contrato'  order BY fecha_inst desc LIMIT 1");
				$row=row($acceso);
					$fecha_pago=formatofecha(trim($row["fecha_pago"]));
					$fecha_inst=trim($row["fecha_inst"]);
					list($ano,$mes,$dia)=explode("-",$fecha_inst);
					$periodo = formato_mes_com1($mes)." $ano";
					$nro_factura=trim($row["nro_factura"]);
					$monto_pago=trim($row["monto_pago"])+0;
					$monto_pago=number_format(trim($row["monto_pago"])+0, 2, ',', '.');
					$this->SetFont('Arial','B',9);
					$this->Cell(30,5,"ULTIMO PAGO","LBT",0,"J",$fill);
					$this->Cell(15,5,"FECHA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(20,5,"$fecha_pago","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(18,5,"FACTURA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(20,5,"$nro_factura","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(17,5,"PERIODO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,"$periodo","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"PAGADO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(20,5,"$monto_pago","TBR",0,"J",$fill);
					
			$this->Ln();
			 $meses=lectura($acceso,"SELECT distinct fecha_inst  FROM contrato_servicio_deuda where   id_contrato='$id_contrato'  and status_con_ser='DEUDA' AND costo_cobro>0 order by fecha_inst");
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
			$meses_vencido=count($dato1);
			 $this->SetFont('Arial','B',9);
					$this->Cell(40,5,"MESES VENCIDOS","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(25,5,"$meses_vencido","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"ETIQUETA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(18,5,"$etiqueta","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"TELEFONO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(67,5,"$telefono","TBR",0,"J",$fill);
		
				
					
	}
	
	
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,15);

$pdf->Cuerpo($acceso,$where,$deuda,$desde,$hasta,$titulo,$obser_aviso);


$pdf->Output('reporte.pdf','D');

?>
