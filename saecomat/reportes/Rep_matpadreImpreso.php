<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php";

$id_fam= $_GET['id_fam'];
$id_unidad= $_GET['id_unidad'];
$impresion= $_GET['impresion'];



class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->cabecera_esp();
		$this->Ln();
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
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
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('reporte materiales independiente')),'0','C');
	
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(20,74,42,44);
		$header=array(strtoupper(_('numero')),strtoupper(_('nombre')),strtoupper(_('familia')),strtoupper(_('unidad medida')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_fam,$id_unidad,$impresion)
	{
		$this->SetFont('Arial','',8);
		
		if($id_fam!=''  && $id_fam!="0" ){
			$bus=$bus." and id_fam='$id_fam'";
			
			$acceso->objeto->ejecutarSql("SELECT nombre_fam FROM familia where id_fam='$id_fam'");
			$row=row($acceso);
			$this->SetX(15);
			$this->Cell(50,6,strtoupper(_("familia")).": ".utf8_decode(trim($row["nombre_fam"])),"0",0,"J",$fill);
		}

		if($id_unidad!=''  && $id_unidad!="0" ){
			$bus=$bus." and id_unidad='$id_unidad'";
			
			$acceso->objeto->ejecutarSql("SELECT nombre_unidad FROM unidad_medida where id_unidad='$id_unidad'");
			$row=row($acceso);
			$this->Cell(50,6,strtoupper(_("unidad medida")).": ".utf8_decode(trim($row["nombre_unidad"])),"0",0,"J",$fill);
		}

		if($impresion!=''  && $impresion!="0" ){
			$bus=$bus." and impresion='$impresion'";
			$val=array("T"=>"SI","F"=>"NO");
			$this->Cell(50,6,strtoupper(_("para impresion")).": ".$val["$impresion"],"0",0,"J",$fill);
		}

		
		$w=$this->TituloCampos();
		$bus=" where  id_m <>'' ";

		if($id_fam!=''  && $id_fam!="0" ){
			$bus=$bus." and id_fam='$id_fam'";
		}
		if($id_unidad!=''  && $id_unidad!="0" ){
			$bus=$bus." and id_unidad='$id_unidad'";
		}
		if($impresion!=''  && $impresion!="0" ){
			$bus=$bus." and impresion='$impresion'";
		}
		$acceso->objeto->ejecutarSql("SELECT numero_mat,nombre_mat,nombre_fam,nombre_unidad FROM vista_matpadre $bus");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		while ($row=row($acceso))
		{
			$this->SetX(15);
			/*$this->Cell($w[0],6,$cont,"L",0,"C",$fill);*/
			$this->Cell($w[0],6,utf8_decode(trim($row["numero_mat"])),"L",0,"J",$fill);
			$this->Cell($w[1],6,utf8_decode(trim($row["nombre_mat"])),"0",0,"J",$fill);
			$this->Cell($w[2],6,utf8_decode(trim($row["nombre_fam"])),"0",0,"J",$fill);
			$this->Cell($w[3],6,utf8_decode(trim($row["nombre_unidad"])),"R",0,"J",$fill);

			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		$this->pie_pred();
	    
	}
}
//crea el objeto pdf
$pdf=new PDF();
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,20);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$id_fam,$id_unidad,$impresion);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 