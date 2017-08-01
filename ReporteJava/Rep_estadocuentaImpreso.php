<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_contrato=$_GET['id_contrato'];
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
		
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		//$this->SetXY(10,10);
		
		$this->SetFont('Arial','B',8);
		$this->SetX(133,30);
		$this->Cell(12,5,strtoupper(_('fecha')).':',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).':',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo()
	{
		$this->SetXY(10,25);
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('ordenes de servicios del cliente')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		//$this->SetFillColor(244,249,255);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,25,55,53,20,22,15);
		$header=array(strtoupper(_('nro')),strtoupper(_('fecha')),strtoupper(_('tipo orden')),strtoupper(_('nombre orden')),strtoupper(_('status')),strtoupper(_('fecha f.')),strtoupper(_('visitas')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],4,strtoupper($header[$k]),'',0,'J',0);
		
		$this->Ln(1);
			$this->SetFont('Arial','',8);
			$this->SetX(10);
			$this->Cell(180,3,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',"0",0,"J",0);
			$this->Ln(1);
			
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_contrato)
	{
		//echo ":$id_contrato:";
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contrato where id_contrato='$id_contrato'");
		
		
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
			$nombre_zona=utf8_d(trim($row["nombre_zona"]));
			$nombre_franq=utf8_d(trim($row["nombre_franq"]));
			$edificio=utf8_d(trim($row["edificio"]));
			$numero_piso=trim($row["numero_piso"]);
			$telf_adic=trim($row["telf_adic"]);
			$fecha_contrato=formatofecha(trim($row["fecha_contrato"]));
			$status_contrato=trim($row["status_contrato"]);
			$status_contrato=trim($row["status_contrato"]);
			$etiqueta=utf8_d(trim($row["etiqueta"]));
		
			$this->Ln();
			$this->SetX(10);
			
			$this->SetFont('Arial','B',9);
			$this->Cell(190,6,strtoupper(_("datos personales")),"0",0,"J");
			
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','',9);
			$this->Cell(27,6,strtoupper(_("nro abonado")).": ".$nro_contrato,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("fecha")).": ".$fecha_contrato,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,'',"0",0,"J");
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("status")).": ".$status_contrato,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','',9);
			$this->Cell(27,6,strtoupper(_("cedula")).": ".$cedula,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("nombre")).": ".$nombre,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,'',"0",0,"J");
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("apellido")).": ".$apellido,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','',9);
			$this->Cell(27,6,strtoupper(_("telefono")).": ".$telefono,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("telf casa")).": ".$telf_casa,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,'',"0",0,"J");
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("telf adic")).": ".$telf_adic,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','',9);
			$this->Cell(27,6,strtoupper(_("email")).": ".$email,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("precinto")).": ".$etiqueta,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,'',"0",0,"J");
			
			
			$this->Ln();
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','B',9);
			$this->Cell(190,6,strtoupper(_("datos de ubicacion")),"0",0,"J");
			
			$this->Ln();
			
			$this->SetX(10);
			$this->SetFont('Arial','',9);
			$this->Cell(27,6,strtoupper(_("franquicia")).": ".$nombre_franq,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("zona")).": ".$nombre_zona,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,'',"0",0,"J");
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("sector")).": ".$nombre_sector,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->Ln();
			
			
			$this->SetX(10);
			$this->SetFont('Arial','',9);
			$this->Cell(27,6,strtoupper(_("calle")).": ".$nombre_calle,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(108,6,'',"0",0,"J");
			
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("nro casa")).": ".$numero_casa,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->Ln();
			
			
			$this->SetX(10);
			$this->SetFont('Arial','',9);
			$this->Cell(27,6,strtoupper(_("edificio")).": ".$edificio,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(108,6,'',"0",0,"J");
			
			
			$this->SetFont('Arial','',9);
			$this->Cell(18,6,strtoupper(_("nro piso")).": ".$numero_piso,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,'',"0",0,"J");
			
			$this->Ln();
			
			
			$this->SetX(10);
			$this->SetFont('Arial','',9);
			$this->Cell(27,6,strtoupper(_("referencia")).": ".$direc_adicional,"0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(108,6,'',"0",0,"J");
		}
		
			$this->Ln();
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','B',9);
			$this->Cell(190,6,strtoupper(_("asignaciones")),"0",0,"J");
		$this->Ln();
		$w=$this->TituloCampos();
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_orden where id_contrato='$id_contrato'");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(0,0,0);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$fill=0;
			$this->SetX(10);
			$this->Cell($w[0],4,$cont,"0",0,"L",0);
			$this->Cell($w[1],4,formatofecha(trim($row["fecha_orden"])),"0",0,"J",0);
			$this->Cell($w[2],4,utf8_d(trim($row["nombre_tipo_orden"])),"0",0,"J",0);
			$this->Cell($w[3],4,utf8_d(trim($row["nombre_det_orden"])),"0",0,"J",0);
			$this->Cell($w[4],4,utf8_d(trim($row["status_orden"])),"0",0,"J",0);
			$this->Cell($w[5],4,formatofecha(trim($row["fecha_final"])),"0",0,"J",0);
			$this->Cell($w[6],6,utf8_d(trim($row["num_visitas"])),"0",0,"C",$fill);
			
			$this->Ln();
			$this->SetX(10);
			$this->Cell(195,4,strtoupper(_("comentario")).": ".utf8_d(trim($row["comentario_orden"])),"0",0,"J",0);

			$this->SetFont('Arial','',8);
			$this->Ln(1);
			$this->Cell(180,3,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',"0",0,"J",$fill);
			$this->Ln(1);
			
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(10);
		//$this->Cell(array_sum($w),5,'','T');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	/*function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		//$this->AliasNbPages();
		$this->SetY(-30);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_d(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo(),0,1,'C');
	    
	}*/
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$id_contrato);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');

?> 