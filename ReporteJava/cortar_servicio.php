<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 



$deuda = $_GET['deuda'];
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];

$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];

if($id_franq!='' || $id_zona!='' || $id_sector!='' || $id_calle!=''){
	$sql=" 
	SELECT id_contrato,nro_contrato,id_franq,cedula,apellido,nombre,status_contrato,etiqueta,telefono,
	( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro)FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$desde' and '$hasta') AS deuda
	,nombre_zona,nombre_sector,nombre_calle,numero_casa,direc_adicional
 
   FROM vista_contrato
  WHERE vista_contrato.status_contrato = 'ACTIVO'::bpchar and 
  ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$desde' and '$hasta')>$deuda
   and 
  ";
  
	$where=  $sql;
		//$where= "SELECT id_contrato,nro_contrato,id_franq,apellido,nombre,status_contrato,id_persona,nombre_calle,nombre_sector,nombre_zona,nombre_franq FROM vista_contrato where status_contrato='ACTIVO' and ";
	$tipo='';
	if($id_franq!=''){
		$where=$where. "(id_franq = '$id_franq')";
		$tipo='id_franq';
	}
	else if($id_zona!=''){
		$where=$where. "(id_zona ILIKE '%$id_zona%')";
		$tipo='id_zona';
	}
	else if($id_sector!=''){
		$where=$where. "(id_sector ILIKE '%$id_sector%')";
		$tipo='id_sector';
	}
	else if($id_calle!=''){
		$where=$where. "(id_calle ILIKE '%$id_calle%')";
		$tipo='id_calle';
	}
	
	if($tipo=='id_franq'){
		if($id_zona!=''){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
		}
		if($id_sector!=''){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		
	}
	else if($tipo=='id_zona'){
		if($id_sector!=''){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		
	}
	else if($tipo=='id_sector'){
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		
	}
	$where=$where.' order by id_zona,id_sector,nombre_calle';
}

//echo $where;
class PDF extends JavaPrint
{
	//Cabecera del Reporte aparecera en todas las paginas
	function cabecera($nombre_zona,$nombre_sector,$fecha_d)
	{
		$this->SetY(5);
		$this->SetFont('Arial','',10);
		$this->MultiCell(195,4,nombre_empresa()."                           ".strtoupper(_("    listado de clientes para cobros "))."                                   ".strtoupper(_("fecha")).":".date("d/m/Y"),'0','J');
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(50,4,strtoupper(_("zona")).": $nombre_zona","0",0,"L");
			$this->Cell(50,4,strtoupper(_("sector")).": $nombre_sector","0",0,"L");
			$this->Cell(95,4,"$fecha_d","0",1,"R");
		$this->Ln();
	}
	
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(128,128,128);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,17,19,53,20,22,14,14,14,10);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abo.')),strtoupper(_('cedula')),strtoupper(_('nombre y apellido')),strtoupper(_('precinto')),strtoupper(_('telefono')),strtoupper(_('iva')),strtoupper(_('base')),strtoupper(_('deuda')),strtoupper(_('pago')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],4,$header[$k],0,0,'J',0);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$where,$deuda,$desde,$hasta)
	{
		$acceso->objeto->ejecutarSql("select id_persona from vista_orden order By id_orden desc  LIMIT 1 offset 0");
		if($row=row($acceso))
		{
			$tecnico=trim($row["id_persona"]);
		}
		else{
			$acceso->objeto->ejecutarSql("select *from vista_tecnico  LIMIT 1 offset 0");
			if($row=row($acceso))
			{
				$tecnico=trim($row["id_persona"]);
			}
		}
		
		
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_franq='1' and id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
	
	
		
		
		$dato=lectura($acceso,$where);
	
		
		$cont=1;
		
		
		$salto=0;
		$f_act=date("d/m/Y");
		$h_act=date("h:i:s A");
		$nombre_zona=utf8_decode(trim($dato[0]["nombre_zona"]));
		$nombre_sector=utf8_decode(trim($dato[0]["nombre_sector"]));
		
		$this->SetFont('Arial','B',8);
			$valor=explode("-",trim($desde));
			$des = formato_mes_com1($valor[1]). " $valor[0] ";
			
			$valor=explode("-",trim($hasta));
			$has = formato_mes_com1($valor[1]). " $valor[0] ";
			$fecha_d="deuda desde  $des   hasta   $has";
			$this->cabecera($nombre_zona,$nombre_sector,$fecha_d);
			
			/*
			$this->SetX(10);
			$this->Cell(50,4,"ZONA: $nombre_zona","0",0,"L");
			$this->Cell(50,4,"SECTOR:: $nombre_sector","0",0,"L");
			$this->Cell(95,4,"Deuda desde  $des   hasta  $has","0",0,"R");
			*/
			
			
		//$this->Ln();		

			$w=$this->TituloCampos();
			$cable=conexion();
			
		for($i=0;$i<count($dato);$i++){
			
			
			$fill=0;
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			
			$id_contrato=trim($dato[$i]["id_contrato"]);
			
			$nombre_sector1=utf8_decode(trim($dato[$i]["nombre_sector"]));
			if($nombre_sector!=$nombre_sector1){
			//	echo ":$nombre_sector!=$nombre_sector1:";
				$this->AddPage();
				$this->cabecera($nombre_zona,$nombre_sector1,$fecha_d);
				$w=$this->TituloCampos();
				$salto=0;
			}
				 
			$cable->objeto->ejecutarSql(" SELECT servicios.nombre_servicio,servicios.id_serv,fecha_inst FROM contrato_servicio_deuda,servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = '$id_contrato' AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$desde' and '$hasta'  order by fecha_inst");
			//$cable->objeto->ejecutarSql(" SELECT servicios.nombre_servicio,servicios.id_serv,fecha_inst FROM contrato_servicio,servicios where id_contrato='$id_contrato'");
			
				$nombre_servicio='';
				while($row1=row($cable)){
					$id_serv=trim($row1["id_serv"]);
					
					if($id_serv=='SER00001' || $id_serv=='BM00008' || $id_serv=='BM00009'){
						$fecha_inst=trim($row1["fecha_inst"]);
						$me=substr($fecha_inst , 5,2);
						$mes=formato_m($me);
						$nombre_servicio=$nombre_servicio.$mes."; ";
					}
					else{
						$nombre_servicio=$nombre_servicio.trim($row1["nombre_servicio"])."; ";
					}
				}
				
				
		//	ordenDeCorte($acceso,$id_contrato,$tecnico);
			
			$this->SetX(10);
			
			$total_p=trim($dato[$i]["deuda"]);
			$porc=($por_iva/100)+1;
			$base=$total_p/$porc;
			$iva=($base*$por_iva)/100;
			
			$this->SetFont('Arial','',8);
			$this->SetX(10);
			$this->Cell($w[0],4,$cont,"0",0,"C",$fill);
			
			$this->Cell($w[1],4,utf8_decode(trim($dato[$i]["nro_contrato"])),"0",0,"J",$fill);
			$this->Cell($w[2],4,utf8_decode(trim($dato[$i]["cedula"])),"0",0,"J",$fill);
			$this->Cell($w[3],4,utf8_decode(trim($dato[$i]["nombre"])." ".trim($dato[$i]["apellido"])),"0",0,"J",$fill);
			$this->Cell($w[4],4,utf8_decode(trim($dato[$i]["etiqueta"])),"0",0,"J",$fill);
			$this->Cell($w[5],4,utf8_decode(trim($dato[$i]["telefono"])),"0",0,"J",$fill);
			$this->Cell($w[6],4,number_format($iva+0, 2, ',', '.'),"0",0,"R",$fill);
			$this->Cell($w[7],4,number_format($base+0, 2, ',', '.'),"0",0,"R",$fill);
			$this->Cell($w[8],4,number_format(trim($dato[$i]["deuda"])+0, 2, ',', '.'),"0",0,"R",$fill);
			$this->Cell($w[9],4,'',"0",0,"R",$fill);
			$nombre_sector=utf8_decode(trim($dato[$i]["nombre_sector"]));
		
			/*
			$this->Ln();
			$this->SetFont('Arial','B',8);
			$this->Cell(12,4,_("zona").":","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(40,4,utf8_decode(trim($dato[$i]["nombre_zona"])),"TBR",0,"J",$fill);
			$this->SetFont('Arial','B',8);
			$this->Cell(14,4,_("sector").":","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(50,4,utf8_decode(trim($dato[$i]["nombre_sector"])),"TBR",0,"J",$fill);
			$this->SetFont('Arial','B',8);
			$this->Cell(12,4,_("calle").":","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(65,4,utf8_decode(trim($dato[$i]["nombre_calle"])),"TBR",0,"J",$fill);
			
			
			$this->Ln();
			$this->SetFont('Arial','B',8);
			$this->Cell(17,4,_("nro casa").":","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(15,4,utf8_decode(trim($dato[$i]["numero_casa"])),"TBR",0,"J",$fill);
		
			$this->SetFont('Arial','B',8);
			$this->Cell(10,4,_("edif").":","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(40,4,utf8_decode(trim($dato[$i]["edificio"])),"TBR",0,"J",$fill);
		
			$this->SetFont('Arial','B',8);
			$this->Cell(10,4,_("piso").":","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(7,4,utf8_decode(trim($dato[$i]["numero_piso"])),"TBR",0,"J",$fill);
			
			
			$this->SetFont('Arial','',9);
			$this->Cell(41,4,_("postel").": ".utf8_decode(trim($dato[$i]["postel"])),"TBR",0,"J",$fill);
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,4,_("taps").": ".utf8_decode(trim($dato[$i]["taps"])),"TBR",0,"J",$fill);
			
			$this->SetFont('Arial','',9);
			$this->Cell(23,4,_("pto").": ".utf8_decode(trim($dato[$i]["pto"])),"TBR",0,"J",$fill);
			
			*/
			$this->Ln();
		
			$this->SetFont('Arial','B',8);
			$this->Cell(8,4,strtoupper(_("ref")).":","0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(105,4,utf8_decode(trim($dato[$i]["direc_adicional"])),"0",0,"J",$fill);
			$this->Cell(15,4,strtoupper(_("pto")).": ".utf8_decode(trim($dato[$i]["pto"])),"0",0,"J",$fill);
			$this->Cell(65,4,strtoupper(_("cargo")).": $nombre_servicio","0",0,"J",$fill);
			//$this->MultiCell(81,4,utf8_decode(trim($dato[$i]["direc_adicional"])),'TR','J');
			$this->SetFont('Arial','',2);
			$this->Ln();
			$this->SetX(114);
		//	$this->Cell(89,3,'',"LR",0,"C",$fill);
			//$this->Cell(array_sum($w),3,'',"RL",0,"C",$fill);
			
			$this->SetFont('Arial','',8);
			//$this->Ln(1);
			$this->SetX(10);
			$this->Cell(180,2,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',"0",0,"J",$fill);
			//$this->Ln();
			
			/*
			$this->SetLineWidth(.4);
			$this->SetX(10);
			$this->Cell(array_sum($w),1,'','T');
			$this->SetLineWidth(.2);
			*/
			
			$this->Ln(2);
			$fill=!$fill;
			
			$salto++;
			if($salto==25 && $salto!=count($dato)){
				$this->AddPage();
				$this->cabecera($nombre_zona,$nombre_sector,$fecha_d);
				$w=$this->TituloCampos();
				$salto=0;
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
		$this->SetY(-14);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().'',0,1,'C');
	}
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,5);
$pdf->AddPage('P','letter');
$pdf->Cuerpo($acceso,$where,$deuda,$desde,$hasta);


$pdf->Output('reporte.pdf','D');

?>
