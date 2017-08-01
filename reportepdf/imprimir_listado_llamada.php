<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 



$id_all = trim($_GET['id_all']);
$fecha_act=date("Y-m-01");
$sql="SELECT numero_casa,edificio,numero_piso,postel,pto, vista_contrato_auditoria.id_contrato,nro_contrato,etiqueta,id_franq,cedula,apellido,nombre,status_contrato,telf_casa,telefono,telf_adic,	 ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst <= '$fecha_act') AS deuda,	nombre_g_a,nombre_calle,urbanizacion, nombre_sector ,nombre_zona ,nombre_mun,nombre_franq,direc_adicional   ,cobrador  FROM vista_contrato_auditoria,asig_lla_cli  WHERE vista_contrato_auditoria.id_contrato=asig_lla_cli.id_contrato  AND status_lc='REGISTRADO' and id_all='$id_all' ";
	$where=$sql." order by  nombre, apellido";

	//echo $where;
			$acceso->objeto->ejecutarSql("SELECT obser_all, login_resp,ubica_all FROM asigna_llamada where id_all='$id_all' ");
			if($row=row($acceso)){
					$login_resp=trim($row["login_resp"]);
					$obser_all=trim($row["obser_all"]);
					$ubica_all=trim($row["ubica_all"]);
				//	echo $paquete;
			}
			
//echo $where;
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function cabecera_h($acceso,$obser_all,$login_resp,$ubica_all)
	{
		$obser_all = utf8_decode($obser_all);
		//$this->SetY(10);
		$this->SetFont('Arial','B',10);
		$this->Cell(50,5,nombre_empresa(),'0',0,'J');
		$this->Cell(93,5,"LISTADO PARA LLAMADAS",'0',0,'C');
		$this->Cell(50,5,strtoupper(_("fecha")).":".date("d/m/Y"),'0',0,'R');
		$this->Ln();
		$acceso->objeto->ejecutarSql("select *from personausuario where statususuario='ACTIVO' $consult order By login");
	$row=row($acceso);
	$responsable=trim($row["nombre"])." ".trim($row["apellido"]);
		$this->SetFont('Arial','B',9);
		$this->Cell(21,5,"Responsable: ",'0',0,'J');
		$this->SetFont('Arial','',9);
		$this->Cell(25,5,"Responsable: ",'0',0,'J');
		$this->SetFont('Arial','',9);
		$this->Cell(50,5,"$responsable",'0',0,'J');
		$this->SetFont('Arial','B',9);
		$this->Cell(22,5,"Ubicacion: ",'0',0,'J');
		$this->SetFont('Arial','',9);
		$this->Cell(50,5,"$ubica_all",'0',0,'J');
		$this->SetFont('Arial','B',9);
		
		$this->Ln();
		$this->Cell(21,5,"Observacion:",'0',0,'J');
		$this->SetFont('Arial','',9);
		$this->MultiCell(172,5,"$obser_all",'0','J');
		
		
	}//Cabecera del Reporte aparecera en todas las paginas
	function cabecera($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list,$cobrador='')
	{
		//$this->SetY(10);
		$this->SetFont('Arial','B',9);
		
			$this->cabecera_titulo($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list,$cobrador);
		
	}
	function cabecera_titulo($nombre_mun,$nombre_zona,$nombre_sector,$fecha_d,$titulo_list)
	{
		//$this->SetY(10);
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(120,5,"Municipio: $nombre_mun    Zona: $nombre_zona     Sector : $nombre_sector","0",0,"L");
			
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(171,171,171);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(12,15,18,58,60,30);
		$header=array(strtoupper(_('nro')),strtoupper(_('cont.')),strtoupper(_('cedula')),strtoupper(_('nombre y apellido')),strtoupper(_('telefonos')),strtoupper(_('status')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],5,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$where,$deuda,$desde,$hasta,$titulo_list,$salto_p,$cobrador,$obser_all,$login_resp)
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
		///	$acceso->objeto->ejecutarSql("select *from asigna_llamada  where (id_all ILIKE '$ini_u%') ORDER BY id_all desc"); 
		//	$id_all = $ini_u.verCo($acceso,"id_all");
			$login_enc=$_SESSION["login"];
			$fecha_all=date("Y-m-d");
		//	$acceso->objeto->ejecutarSql("insert into asigna_llamada(id_all,ubica_all,fecha_all,login_enc,login_resp,obser_all,status_all,dato) values ('$id_all','$ubica_all','$fecha_all','$login_enc','$login_resp','$obser_all','REGISTRADO','')");	
		//	$acceso->objeto->ejecutarSql("insert into proceso_corte(id_proc,login_proc,fecha_proc,status_proc) values ('$id_proc','$login_proc','$fecha_proc','GENERADO')");	
	//	echo ":".count($dato).":";
		for($i=0;$i<count($dato);$i++){
			
			$status_contrato=trim($dato[$i]["status_contrato"]);
		
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
			$tel_a='';
			if(trim($dato[$i]["telf_casa"])!=''){
				$tel_a=$tel_a." / ".trim($dato[$i]["telf_casa"]);
			}
			if(trim($dato[$i]["telf_adic"])!=''){
				$tel_a=$tel_a." / ".trim($dato[$i]["telf_adic"]);
			}
			$this->Cell($w[4],5,trim($dato[$i]["telefono"])."$tel_a","1",0,"J",$fill);
			$this->Cell($w[5],5,trim($dato[$i]["status_contrato"]),"1",0,"R",$fill);
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
			/*
			$acceso->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,id_det_orden,fecha_orden,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad,login,hora) values ('$id_orden','DEO00010','$fecha_orden','PROCESO DE CORTE','','CREADO','$id_contrato','NORMAL','$login','$hora')");
			$acceso->objeto->ejecutarSql("update contrato set status_contrato='POR CORTAR' where id_contrato='$id_contrato' ");
			
			$acceso->objeto->ejecutarSql("select *from abo_cortados  where (id_abo_c ILIKE '$ini_u%') ORDER BY id_abo_c desc"); 
			$id_abo_c = $ini_u.verCodlong($acceso,"id_abo_c");
			
			*/
			//$acceso->objeto->ejecutarSql("select *from asig_lla_cli  where (id_lc ILIKE '$ini_u%') ORDER BY id_lc desc"); 
			//$id_lc = $ini_u.verCo($acceso,"id_lc");
			
			//$acceso->objeto->ejecutarSql("insert into asig_lla_cli(id_lc,id_all,id_contrato,status_lc) values ('$id_lc','$id_all','$id_contrato','REGISTRADO')");
			
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
$pdf->cabecera_h($acceso,$obser_all,$login_resp,$ubica_all);
$pdf->Cuerpo($acceso,$where,$deuda,$desde,$hasta,$titulo_list,$salto,$cobrador,$obser_all,$login_resp);


$pdf->Output('reporte.pdf','D');

?>
