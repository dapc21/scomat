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
	function Header()
	{
		$this->SetXY(10,10);
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		$this->SetFont('Arial','',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,'LISTADO DE CLIENTES PARA CORTES','0','C');
		
	}
	
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		//$this->SetFillColor(244,249,255);
		$this->SetDrawColor(195,212,235);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,20,21,74,25,25,18);
		$header=array('Nro','Contrato','Cedula','Nombre y Apellido','Etiqueta','Telefono','Deuda');
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],6,strtoupper($header[$k]),"0",0,'J',0);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$where)
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
		
		
	
	
	
		
		
		$dato=lectura($acceso,$where);
	
		
		$cont=1;
		
		
		$salto=0;
		$f_act=date("d/m/Y");
		$h_act=date("h:i:s A");
		$nombre_zona=utf8_decode(trim($dato[0]["nombre_zona"]));
		$nombre_sector=utf8_decode(trim($dato[0]["nombre_sector"]));
		
		$this->SetFont('Arial','',10);
			$this->SetX(55);
			$this->Cell(50,5,"ZONA: $nombre_zona","0",0,"C");
			$this->Cell(50,5,"SECTOR:: $nombre_sector","0",0,"C");
			
			$this->Ln();	
			$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,'Fecha:',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,'Hora:',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
			
			$w=$this->TituloCampos();
		
		
		for($i=0;$i<count($dato);$i++){
			$this->SetTextColor(0);
			//$this->SetFillColor(249,249,249);
			
			$id_contrato=trim($dato[$i]["id_contrato"]);
		//	ordenDeCorte($acceso,$id_contrato,$tecnico);
			
			$this->SetX(10);
			
			$fill=0;
			
			
			$this->SetFont('Arial','',9);
			$this->SetX(10);
			$this->Cell($w[0],5,$cont,"0",0,"L",$fill);
			
			$this->Cell($w[1],5,utf8_decode(trim($dato[$i]["nro_contrato"])),"0",0,"J",$fill);
			$this->Cell($w[2],5,utf8_decode(trim($dato[$i]["cedula"])),"0",0,"J",$fill);
			$this->Cell($w[3],5,utf8_decode(trim($dato[$i]["nombre"])." ".trim($dato[$i]["apellido"])),"0",0,"J",$fill);
			$this->Cell($w[4],5,utf8_decode(trim($dato[$i]["etiqueta"])),"0",0,"J",$fill);
			$this->Cell($w[5],5,utf8_decode(trim($dato[$i]["telefono"])),"0",0,"J",$fill);
			$this->Cell($w[6],5,number_format(trim($dato[$i]["deuda"])+0, 2, ',', '.'),"0",0,"R",$fill);
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->Cell(12,5,"ZONA: ".utf8_decode(trim($dato[$i]["nombre_zona"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(40,5,'',"0",0,"J",$fill);
			$this->SetFont('Arial','',9);
			$this->Cell(14,5,"SECTOR: ".utf8_decode(trim($dato[$i]["nombre_sector"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(50,5,'',"0",0,"J",$fill);
			$this->SetFont('Arial','',9);
			$this->Cell(12,5,"CALLE: ".utf8_decode(trim($dato[$i]["nombre_calle"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(65,5,'',"0",0,"J",$fill);
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->Cell(17,5,"NRO CASA: ".utf8_decode(trim($dato[$i]["numero_casa"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(15,5,'',"0",0,"J",$fill);
		
			$this->SetFont('Arial','',9);
			$this->Cell(10,5,"EDIF: ".utf8_decode(trim($dato[$i]["edificio"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(40,5,'',"0",0,"J",$fill);
		
			$this->SetFont('Arial','',9);
			$this->Cell(20,5,"PISO: ".utf8_decode(trim($dato[$i]["numero_piso"])),"0",0,"J",$fill);
			
			$this->SetFont('Arial','',9);
			$this->Cell(41,5,"POSTEL: ".utf8_decode(trim($dato[$i]["postel"])),"0",0,"J",$fill);
			
			$this->SetFont('Arial','',9);
			$this->Cell(30,5,"TAPS: ".utf8_decode(trim($dato[$i]["taps"])),"0",0,"J",$fill);
			
			$this->SetFont('Arial','',9);
			$this->Cell(25,5,"PTO: ".utf8_decode(trim($dato[$i]["pto"])),"0",0,"J",$fill);
			
			
			$this->Ln();
			
			$this->SetFont('Arial','',9);
			$this->Cell(8,5,"REF: ".utf8_decode(trim($dato[$i]["direc_adicional"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(96,5,'',"0",0,"J",$fill);
			//$this->MultiCell(81,5,utf8_decode(trim($dato[$i]["direc_adicional"])),'TR','J');
			$this->SetFont('Arial','',10);
			
			$this->SetFont('Arial','',8);
			$this->Ln(1);
			$this->Cell(180,4,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',"0",0,"J",$fill);
			$this->Ln();
			//$fill=!$fill;
			
			$salto++;
			if($salto==9 && $salto!=count($dato)){
				$this->AddPage();
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
		$this->SetY(-23);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(190,7,'Pag. '.$this->PageNo().'',0,1,'C');
	}
}
//crea el objeto pdf
$pdf=new PDF();              

$pdf->AddPage('P','letter');
$pdf->Cuerpo($acceso,$where);


$pdf->Output('reporte.pdf','D');

?>
