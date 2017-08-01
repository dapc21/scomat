<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];



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
		$this->MultiCell(190,7,strtoupper(_('total clientes')),'0','C');
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
		$w=array(10,18,18,50,19,25,20,20,13);
		$header=array(strtoupper(_('nro'),strtoupper(_('nro abo.')),strtoupper(_('cedula')),strtoupper(_('nombre y apellido')),strtoupper(_('fecha cont')),strtoupper(_('status')),strtoupper(_('etiqueta')),strtoupper(_('telefono')),strtoupper(_('deuda')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$gen_ubi,$gen_fec,$status_contrato,$desde,$hasta,$id_franq,$id_zona,$id_sector,$id_calle)
	{
		$w=$this->TituloCampos();
		
		if($gen_ubi!='GENERAL' || $gen_fec!='GENERAL' || $status_contrato!=''){
		$where= "SELECT id_contrato,nro_contrato,cedula,nombre,apellido,fecha_contrato,status_contrato,etiqueta,telefono,  deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa,direc_adicional FROM vista_contrato where (id_contrato ILIKE '%0%') ";
		$tipo='';
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
			if($id_franq!=''){
				$where=$where. " and fecha_contrato between '$desde' and '$hasta'";
				$tipo='id_franq';
			}
			
		
		}
		
		if($status_contrato!=''){
			if($id_franq!=''){
				$where=$where. " and (status_contrato ILIKE '%$status_contrato%')";
			}
			
			
		}
		$where=$where.' order by id_zona,id_sector,nombre_calle';
		//echo ":$where:";
		$dato=lectura($acceso,$where);
	}
	else{
		$dato=lectura($acceso,"SELECT id_contrato,nro_contrato,cedula,nombre,apellido,fecha_contrato,status_contrato,etiqueta,telefono, deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa,direc_adicional FROM vista_contrato");
	}

		$this->SetFont('Arial','',8);
		$cont=1;
		
		
		$cad="{\\rtf1\\ansi\\ansicpg1252\\deff0\\deflang3082{\\fonttbl{\\f0\\fswiss\\fcharset0 Arial;}}
{\\*\\generator Msftedit 5.41.15.1515;}\\viewkind4\\uc1\\pard\\qc\\f0\\fs24 TELVICENTNEX  C.A.\\par
TV POR CABLE.\\par
\\b\\fs20 TOTAL CLIENTES\\par
\\par
\\pard\\qr\\fs16 Fecha: \\b0\\fs20 $f_act   \\b\\fs16 Hora:\\fs20  \\b0 $h_act\\fs16\\par
\\par
\\pard\\tx568\\tx1562\\tx2840\\tx5538\\tx5964\\tx6674\\tx7242\\tx8520\\tx9514\\tx11076\\b Nro \\tab Contrato \\tab Cedula \\tab Nombre y Apellido\\tab Fecha Cont\\tab  Status\\tab Etiqueta \\tab Telefono \\tab Deuda\\par
\\pard\\tx568\\tx1988\\tx3124\\tx7952\\tx9372\\tx10792 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\\par
";

		$salto=0;
		for($i=0;$i<count($dato);$i++){
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			$id_contrato=trim($dato[$i]["id_contrato"]);
			
			$this->SetX(10);
			
			
			
			$nro_c=trim($dato[$i]["nro_contrato"]);
			$cedula=trim($dato[$i]["cedula"]);
			$nombre=substr(utf8_decode(trim($dato[$i]["nombre"])." ".trim($dato[$i]["apellido"])),0,20);
			$etiqueta=utf8_decode(trim($dato[$i]["etiqueta"]));
			$telefono=utf8_decode(trim($dato[$i]["telefono"]));
			$deudas=trim($dato[$i]["deuda"])+0;
			$deuda=number_format($deudas+0, 2, ',', '.');
			
			$status_contrato=utf8_decode(trim($dato[$i]["status_contrato"]));
			$fecha_c=formatofecha(trim($dato[$i]["fecha_contrato"]));
			
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
			
			
						$cad.="\\pard\\tx568\\tx1562\\tx2840\\tx5538\\tx6674\\tx8520\\tx9514\\tx11076\\b0\\fs20 $cont \\tab $nro_c\\tab $cedula\\tab $nombre\\tab $fecha_c\\tab $status_contrato\\tab $etiqueta\\tab $telefono\\tab $deuda\\par
\\pard\\tx3408\\tx7384\\b\\fs16 ZONA: \\b0\\fs20 $nombre_zona \\fs16\\tab\\b SECTOR: \\b0\\fs20 $nombre_sector\\fs16\\tab\\b CALLE: \\b0\\fs20 $nombre_calle\\fs16\\par
\\pard\\b NRO CASA: \\b0\\fs20 $num_casa   \\b\\fs16 EDIF: \\b0\\fs20 $edificio      \\b\\fs16 PISO: \\b0\\fs20 $n_p    \\b\\fs16 REF: \\b0\\fs20 $direc_adicional\\fs16\\par
\\pard\\tx1988\\tx3976\\tx4970 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\\par
";

			$cont++;
			$salto++;
			if($salto==11){
				$this->AddPage();
				
				$w=$this->TituloCampos();
				$salto=0;
			}
			
		}
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
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

$cad=$pdf->Cuerpo($acceso,$gen_ubi,$gen_fec,$status_contrato,$desde,$hasta,$id_franq,$id_zona,$id_sector,$id_calle);
dl_file($cad);
//imprime el reporte en formato PDF
//$pdf->Output('reporte.pdf','I');
?> 