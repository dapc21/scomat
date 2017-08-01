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
			
			(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato_auditoria.id_contrato and fecha_inst < '$hasta'  and costo_cobro>0 )>0 and 	(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato_auditoria.id_contrato and fecha_inst < '$desde'  and costo_cobro>0 )<=0
			
			and ( SELECT count(vista_convenio.costo_cobro) FROM vista_convenio WHERE  vista_convenio.id_cont_serv = contrato_servicio_deuda.id_cont_serv AND vista_convenio.status_con_ser = 'DEUDA' and vista_convenio.status_conv='ACTIVO' and fecha_ven>='$hasta') <= 0
			) > $deuda ";
			
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
	
			
			$fecha_corte_c = " ( SELECT ordenes_tecnicos.fecha_final FROM ordenes_tecnicos WHERE ordenes_tecnicos.id_contrato = vista_contrato_auditoria.id_contrato AND ordenes_tecnicos.status_orden = 'FINALIZADO'  order by fecha_final desc limit 1) ";
			$fecha_corte = " ( SELECT ordenes_tecnicos.fecha_final FROM ordenes_tecnicos WHERE ordenes_tecnicos.id_contrato = vista_contrato_auditoria.id_contrato AND ordenes_tecnicos.status_orden = 'FINALIZADO'  order by fecha_final desc limit 1) as fecha_corte ";
	$sql=" 	SELECT id_contrato   FROM vista_contrato_auditoria  WHERE vista_contrato_auditoria.id_contrato<>'' $sql_sd $esta  $zona $sector  $conv  ";
	$where=  $sql;
	
	if($gen_fec!='GENERAL'){
		if($por_fecha=='CORTE'){
			$where=$where. " and $fecha_corte_c between '$desde1' and '$hasta1'";
		}else if($por_fecha=='INSTALACION'){
			$where=$where. " and fecha_contrato between '$desde1' and '$hasta1'";
		}{
		}
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
			$this->estado_cuenta_con($acceso,$id_contrato);
		}
	}
	
	
	
	function estado_cuenta_con($acceso,$id_contrato)
	{
	
		
		$this->AddPage();
		//ECHO "SELECT *FROM vista_contrato_auditoria where id_contrato='$id_contrato'";
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
			
			$fecha_est=date("01/m/Y");
			
			
			if($edificio!=''){
				$edificio=",  Edif: $edificio, piso: $numero_piso ";
			}
			
			if($urbanizacion!=''){
				$urbanizacion=", Urb: $urbanizacion ";
			}
			$dir ="$urbanizacion,  $nombre_calle $edificio,  $numero_casa ; REF. $direc_adicional";
			$fecha=date("Y-m-01");
			
			$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as deuda FROM contrato_servicio_deuda where id_contrato='$id_contrato'  AND costo_cobro>0 and fecha_inst<'$fecha'");
			$row=row($acceso);
			$deuda_ant=trim($row["deuda"])+0;
			
			$fecha=date("Y-m-01");
			list($ano,$mes,$dia)=explode("-",$fecha);
			if($deuda_ant<=0){
				$fecha_ven=sumames($fecha);
				list($ano1,$mes1,$dia1)=explode("-",$fecha_ven);
				$periodo = "15   ".formato_mes_com1($mes1)."  $ano1";
				
			}else{
				list($ano1,$mes1,$dia1)=explode("-",$fecha);
				$periodo = "15   ".formato_mes_com1($mes1)."  $ano1";
			}
			$perio = formato_mes_com1($mes)."";
			
		//	echo "SELECT * as deuda FROM contrato_servicio_deuda where id_contrato='$id_contrato'  AND costo_cobro>0 and fecha_inst='$fecha'";
			$acceso->objeto->ejecutarSql("SELECT * FROM contrato_servicio_deuda where id_contrato='$id_contrato'  AND costo_cobro>0 and fecha_inst='$fecha'");
			$row=row($acceso);
			$id_cont_serv=trim($row["id_cont_serv"]);
			$costo_cobro=trim($row["costo_cobro"])+0;
			
			$base=$costo_cobro/1.12;
			$iva=$base*0.12;
			$total=$deuda_ant + $costo_cobro;
			$id_cont_serv=trim($row["id_cont_serv"]);
			
			
			$xx=32;
			$yy=8;
			$this->SetXY($xx+40,$yy+10);
			$this->SetFont('Arial','B',9);
			$this->Cell(105,5,$apellido."   ". $nombre,"0",0,"J");
			
			$this->Ln(6);
			$this->SetX($xx+40);
			$this->SetFont('Arial','',8);
			$this->MultiCell(105,3,"                    $dir","0","J");
			
			$this->SetXY($xx+40,$yy+26);
			$this->SetFont('Arial','B',8);
			$this->Cell(67,6,$nombre_zona,"0",0,"J");
			$this->Cell(40,6,$nombre_sector,"0",0,"J");
			$this->Ln(12);
			
			$this->SetX($xx);
			$this->SetFont('Arial','B',8);
			$this->Cell(33,6,$nro_contrato,"0",0,"C");
			$this->Cell(35,6,$id_cont_serv,"0",0,"C");
			$this->Cell(40,6,$periodo,"0",0,"C");
			$this->Cell(37,6,"","0",0,"C");
			
			
			$this->Ln(34);
			
			$this->SetX($xx);
			$this->SetFont('Arial','B',8);
			$this->Cell(30,6,$perio,"0",0,"C");
			$this->Cell(73,6,"Servicio Basico Television","0",0,"L");
			$this->Cell(20,6,number_format($base+0, 2, ',', '.'),"0",0,"L");
			$this->Cell(25,6,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"L");
			$this->Ln(8);
			
			$this->SetX($xx+10);
			$this->SetFont('Arial','B',12);
			$this->Cell(60,6,"GARCIAS POR SU PAGO!","0",0,"L");
			
			$this->Image('../imagenes/carita.jpg',$this->GetX(),$this->GetY(),15);
			
			$this->Ln(38);
			
			$this->SetX($xx);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,6,"","0",0,"L");
			$this->Cell(73,6,"","0",0,"L");
			$this->Cell(20,6,"","0",0,"L");
			$this->Cell(25,6,number_format($costo_cobro+0, 2, ',', '.'),"0",0,"R");
			
			$this->Ln(7);
			
			$this->SetX($xx);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,6,"","0",0,"L");
			$this->Cell(73,6,"","0",0,"L");
			$this->Cell(20,6,"","0",0,"L");
			$this->Cell(25,6,number_format($deuda_ant+0, 2, ',', '.'),"0",0,"R");
			
			$this->Ln(8);
			
			$this->SetX($xx);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,6,$fecha_est,"0",0,"L");
			$this->Cell(73,6,"","0",0,"L");
			$this->Cell(20,6,"","0",0,"L");
			$this->Cell(25,6,number_format($total+0, 2, ',', '.'),"0",0,"R");
			
			$this->Ln(18);
			
			$this->SetX($xx+70);
			$this->SetFont('Arial','B',9);
			$this->Cell(40,5,$nro_contrato,"0",0,"L");
			$this->Cell(35,5,"","0",0,"L");
			
			$this->Ln(6);
			
			$this->SetX($xx+70);
			$this->SetFont('Arial','B',9);
			$this->Cell(40,5,$id_cont_serv,"0",0,"L");
			$this->Cell(35,5,number_format($total+0, 2, ',', '.'),"0",0,"R");
			
			$this->Ln(8);
			
			$this->SetX($xx+83);
			$this->SetFont('Arial','B',9);
			$this->Cell(15,6,"15","0",0,"C");
			$this->Cell(33,6,strtoupper(formato_mes_com1($mes1)),"0",0,"C");
			$this->Cell(12,6,$ano1,"0",0,"C");
			
			
			
			
		}
		
		
		
					
	}
	
	
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,15);

$pdf->Cuerpo($acceso,$where,$deuda,$desde,$hasta,$titulo,$obser_aviso);


$pdf->Output('reporte.pdf','D');

?>
