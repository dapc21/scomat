<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];

$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];

if($id_franq!='' || $id_zona!='' || $id_sector!='' || $id_calle!=''){
	$sql=" 
	SELECT id_contrato,nro_contrato,id_franq,cedula,apellido,nombre,status_contrato,etiqueta,telefono,
	( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro)FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$hasta' and '$hasta') AS deuda
	,nombre_zona,nombre_sector,nombre_calle,numero_casa,direc_adicional
 
   FROM vista_contrato
  WHERE vista_contrato.status_contrato = 'ACTIVO'::bpchar and 
  ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$hasta' and '$hasta')>0
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
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('listado de clientes para cortes')),'0','C');
		$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(195,212,235);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,20,21,74,25,25,18);
		$header=array(strtoupper(_('nro')),strtoupper(_('nro abo.')),strtoupper(_('cedula')),strtoupper(_('nombre y apellido')),strtoupper(_('Etiqueta')),strtoupper(_('telefono')),strtoupper(_('deuda')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
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
		
		
	
	
	
		$w=$this->TituloCampos();
		
		$dato=lectura($acceso,$where);
	
		$this->SetFont('Arial','',8);
		$cont=1;
		
		
		$salto=0;
		$f_act=date("d/m/Y");
		$h_act=date("h:i:s A");
		$nombre_zona=utf8_decode(trim($dato[0]["nombre_zona"]));
		$nombre_sector=utf8_decode(trim($dato[0]["nombre_sector"]));
		
		$cad="{\\rtf1\\ansi\\ansicpg1252\\deff0\\deflang11274{\\fonttbl{\\f0\\fswiss\\fcharset0 Arial;}}
{\\*\\generator Msftedit 5.41.15.1512;}\\viewkind4\\uc1\\pard\\tx1988\\f0\\fs32 hola\\par
";
		for($i=0;$i<count($dato);$i++){
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			
			$id_contrato=trim($dato[$i]["id_contrato"]);
		//	ordenDeCorte($acceso,$id_contrato,$tecnico);
			
			$this->SetX(10);
			
			
			
			$this->SetFont('Arial','',8);
			$this->SetX(10);
			$this->Cell($w[0],5,$cont,"1",0,"C",$fill);
			$nro_contrato=trim($dato[$i]["nro_contrato"]);
			$cedula=trim($dato[$i]["cedula"]);
			$nombre=utf8_decode(trim($dato[$i]["nombre"])." ".trim($dato[$i]["apellido"]));
			$etiqueta=utf8_decode(trim($dato[$i]["etiqueta"]));
			$telefono=utf8_decode(trim($dato[$i]["telefono"]));
			$deuda=number_format(trim($dato[$i]["deuda"])+0, 2, ',', '.');
			
			$this->Ln();
			$this->SetFont('Arial','B',8);
			$this->Cell(12,5,strtoupper(_("zona")).": ","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(40,5,utf8_decode(trim($dato[$i]["nombre_zona"])),"TBR",0,"J",$fill);
			$nombre_zona=utf8_decode(trim($dato[$i]["nombre_zona"]));
			$this->SetFont('Arial','B',8);
			$this->Cell(14,5,strtoupper(_("sector")).": ","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$nombre_sector=utf8_decode(trim($dato[$i]["nombre_sector"]));
			$this->SetFont('Arial','B',8);
			$this->Cell(12,5,strtoupper(_("calle")).": ","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$nombre_calle=utf8_decode(trim($dato[$i]["nombre_calle"]));
			
			
			$this->Ln();
			$this->SetFont('Arial','B',8);
			$this->Cell(17,5,strtoupper(_("nro casa")).": ","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$num_casa=utf8_decode(trim($dato[$i]["numero_casa"]));
		
			$this->SetFont('Arial','B',8);
			$this->Cell(10,5,strtoupper(_("edif")).": ","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$edificio=utf8_decode(trim($dato[$i]["edificio"]));
		
			$this->SetFont('Arial','B',8);
			$this->Cell(10,5,strtoupper(_("piso")).": ","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$n_p=utf8_decode(trim($dato[$i]["numero_piso"]));
		
			$this->SetFont('Arial','B',8);
			$this->Cell(8,5,strtoupper(_("ref")).": ","TLB",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$direc_adicional=utf8_decode(trim($dato[$i]["direc_adicional"]));
			//$this->MultiCell(81,5,utf8_decode(trim($dato[$i]["direc_adicional"])),'TR','J');
			$this->SetFont('Arial','',2);
			$this->Ln();
			$this->SetX(114);
		//	$this->Cell(89,3,'',"LR",0,"C",$fill);
			//$this->Cell(array_sum($w),3,'',"RL",0,"C",$fill);
			
			
			
			$this->Ln();
			$fill=!$fill;
			
			$salto++;
			if($salto==11 && $salto!=count($dato)){
				$this->AddPage();
				
				$w=$this->TituloCampos();
				$salto=0;
			}
			
			$cad.="$nro_contrato \\tab $nro_contrato \\tab
";
		$cont++;
		}
		
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
		$cad.="}
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
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}
//crea el objeto pdf
$pdf=new PDF();              

$cad=$pdf->Cuerpo($acceso,$where);
dl_file($cad);


?>
