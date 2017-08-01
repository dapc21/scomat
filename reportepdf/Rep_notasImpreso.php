<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$generado_por = $_GET['generado_por'];
$login = $_GET['login'];
$tipo_n = $_GET['tipo'];
$idmotivonota = $_GET['idmotivonota'];
$dir_ip = $_GET['dir_ip'];

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];


if($gen_ubi!='GENERAL' || $gen_fec!='GENERAL' || $generado_por!='' || $login!='' || $tipo_n!='' || $idmotivonota!='' || $dir_ip!=''){
	$where= "SELECT id_nota,nro_contrato,login,generado_por,tipo,dir_ip,fecha,hora,monto_anterior,monto_posterior,nombremotivonota,comentario,cedula,nombre,apellido,nombre_zona,nombre_sector,nombre_calle FROM vista_notas where (id_contrato ILIKE '%0%') ";
  if($gen_ubi!='GENERAL'){
		if($id_franq!='0'){
			$where=$where. " and (id_franq = '$id_franq')";
			$tipo='id_franq';
		}
		else if($id_zona!='0'){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
			$tipo='id_zona';
		}
		else if($id_sector!='0'){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
			$tipo='id_sector';
		}
		else if($id_calle!='0'){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			$tipo='id_calle';
		}
		
		if($tipo=='id_franq'){
			if($id_zona!='0'){
				$where=$where. " and (id_zona ILIKE '%$id_zona%')";
			}
			if($id_sector!='0'){
				$where=$where. " and (id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_zona'){
			if($id_sector!='0'){
				$where=$where. " and (id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_sector'){
			if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			}
			
		}

	}
  
  
	if($gen_fec!='GENERAL'){
			$where=$where. " and fecha between '$desde' and '$hasta'";
	}
	
	if($generado_por!=''){
			$where=$where. " and (generado_por ILIKE '%$generado_por%')";
	}
	if($login!=''){
			$where=$where. " and (login ILIKE '%$login%')";
	}
	if($tipo_n!=''){
			$where=$where. " and (tipo ILIKE '%$tipo%')";
	}
	if($idmotivonota!=''){
			$where=$where. " and (idmotivonota ILIKE '%$idmotivonota%')";
	}
	if($dir_ip!=''){
			$where=$where. " and (dir_ip ILIKE '%$dir_ip%')";
	}
	//$x->consultas($where);
}
else{
	$where= "SELECT id_nota,nro_contrato,login,generado_por,tipo,dir_ip,fecha,hora,monto_anterior,monto_posterior,nombremotivonota,comentario,cedula,nombre,apellido,nombre_zona,nombre_sector,nombre_calle FROM vista_notas where (id_contrato ILIKE '%0%') ";
}

class PDF extends FPDF
{
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('reporte de notas de debitos y de creditos')),'0','C');
		$this->SetFont('Arial','B',8);
		$this->Ln();
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).": ",0,0,'L');
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
		$w=array(10,17,20,18,30,18,17,20,20,20);
		$header=array(strtoupper(_('nro')),strtoupper(_('cont.')),strtoupper(_('login')),strtoupper(_('ip equipo')),strtoupper(_('tipo')),strtoupper(_('fecha')),strtoupper(_('hora')),strtoupper(_('monto ant.')),strtoupper(_('monto pos.')),strtoupper(_('gen. por')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,strtoupper($header[$k]),1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$where)
	{
		
		$w=$this->TituloCampos();
		
		$dato=lectura($acceso,$where);
	

		$this->SetFont('Arial','',8);
		$cont=1;
		
		
		$salto=0;
		for($i=0;$i<count($dato);$i++){
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			$id_contrato=trim($dato[$i]["id_contrato"]);
			$this->SetX(10);
			
			
			
			$this->SetFont('Arial','',8);
			$this->SetX(10);
			$this->Cell($w[0],6,$cont,"1",0,"C",$fill);
			$this->Cell($w[1],6,utf8_decode(trim($dato[$i]["nro_contrato"])),"1",0,"J",$fill);
			$this->Cell($w[2],6,utf8_decode(trim($dato[$i]["login"])),"1",0,"J",$fill);
			$this->Cell($w[3],6,utf8_decode(trim($dato[$i]["dir_ip"])),"1",0,"J",$fill);
			$this->Cell($w[4],6,utf8_decode(trim($dato[$i]["tipo"])),"1",0,"J",$fill);
			$this->Cell($w[5],6,formatofecha(trim($dato[$i]["fecha"])),"1",0,"J",$fill);
			$this->Cell($w[6],6,utf8_decode(trim($dato[$i]["hora"])),"1",0,"J",$fill);
			$this->Cell($w[7],6,utf8_decode(trim($dato[$i]["monto_anterior"])),"1",0,"J",$fill);
			$this->Cell($w[8],6,utf8_decode(trim($dato[$i]["monto_posterior"])),"1",0,"J",$fill);
			$this->Cell($w[9],6,utf8_decode(trim($dato[$i]["generado_por"])),"1",0,"J",$fill);
			
			$this->Ln();
			$this->SetFont('Arial','',8);
			$this->Cell(65,7,strtoupper(_("motivo ")).": ".utf8_decode(trim($dato[$i]["nombremotivonota"])),"1",0,"J",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell(125,7,strtoupper(_("detalle ")).": ".utf8_decode(trim($dato[$i]["comentario"])),"1",0,"J",$fill);
			
			
			$this->Ln();
			$fill=!$fill;
			$cont++;
			$salto++;
			if($salto==15){
				$this->AddPage();
				
				$w=$this->TituloCampos();
				$salto=0;
			}
			
		}
		$this->SetX(10);
		$this->Cell(array_sum($w),6,'','T');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-25);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	    
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,20);
//agrega una nueva pagina
$pdf->AddPage();

$pdf->Cuerpo($acceso,$where);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 