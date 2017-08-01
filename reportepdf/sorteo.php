<?php
require('include/FPDF/fpdf.php');
require_once("procesos.php");

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
		$this->SetFont('Arial','B',12);
		$this->SetTextColor(0,0,0);
		$this->SetY(10);
		$this->MultiCell(190,7,strtoupper(_('listado de contratos para sorteo ')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$where)
	{
		$fec=date("Y-m-01");
		//echo "select nro_contrato from contrato_servicio,contrato where contrato_servicio.id_contrato=contrato.id_contrato and fecha_inst='$fec' and id_serv='SER00001' and status_con_ser='PAGADO'";
		$dato=lectura($acceso,"select nro_contrato from contrato_servicio,contrato where contrato_servicio.id_contrato=contrato.id_contrato and fecha_inst='$fec' and id_serv='SER00001' and status_con_ser='PAGADO'");
	
			
			//$w=$this->TituloCampos();
		
		
		for($i=0;$i<count($dato);$i=$i+5){
			$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			
			$id_contrato=trim($dato[$i]["id_contrato"]);
		//	ordenDeCorte($acceso,$id_contrato,$tecnico);
			
			$this->SetX(10);
			
			
			
			$this->SetFont('Arial','',22);
			$this->SetX(15);
			$this->Cell(35,9,utf8_decode(trim($dato[$i]["nro_contrato"])),"1",0,"C",0);
			$this->Cell(35,9,utf8_decode(trim($dato[$i+1]["nro_contrato"])),"1",0,"C",0);
			$this->Cell(35,9,utf8_decode(trim($dato[$i+2]["nro_contrato"])),"1",0,"C",0);
			$this->Cell(35,9,utf8_decode(trim($dato[$i+3]["nro_contrato"])),"1",0,"C",0);
			$this->Cell(35,9,utf8_decode(trim($dato[$i+4]["nro_contrato"])),"1",0,"C",0);
			$this->Ln();
			
		$cont++;
		}
		$this->SetX(15);
		$this->Ln();
		$this->SetFont('Arial','',12);
		$this->Cell(35,9,strtoupper(_("total participante ")).count($dato) ,"0",0,"C",0);
		
		//$this->Cell(array_sum($w),5,'','T');
		
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-30);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}
//crea el objeto pdf
$pdf=new PDF();              

$pdf->AddPage('P','letter');
$pdf->Cuerpo($acceso,$where);


$pdf->Output('reporte.pdf','D');

?>
