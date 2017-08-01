<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];

$id_gt=trim($_GET['id_gt']);
$organizar_por=trim($_GET['organizar_por']);
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		//$this->Image('../imagenes/cabecera.jpg',20,10,40);
		$this->SetFont('times','',13);
		$this->SetXY(10,10);
		$this->MultiCell(195,5,nombre_empresa(),'0','L');
		$this->SetFont('times','I',9);
		$this->SetXY(90,10);
		$this->MultiCell(115,5,tipo_serv(),'0','R');
	}
	
	//Titulo del reporte
	function Titulo($titulo)
	{
		$this->SetFont('times','BI',10);
		$this->SetTextColor(0,0,0);
		$this->SetXY(10,15);
		$this->MultiCell(195,5,strtoupper(utf8_decode(strtoupper(_("grupo de trabajo")))),'0','L');
		$this->SetFont('times','',8);
		$this->SetXY(10,15);
		$this->MultiCell(195,5,strtoupper(strtoupper(_('Fecha'))).": ".date("d/m/Y")." ".strtoupper(_('Hora')).": ".date("h:i:s A"),'0','R');
		$this->SetFont('times','',9);
		
		$this->Cell(195,2,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",'0',0,'C');
		
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_gt)
	{
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		
		$acceso->objeto->ejecutarSql("SELECT *FROM grupo_trabajo where id_gt='$id_gt'  LIMIT 1 offset 0");
		if($row=row($acceso)){
			$nombre_grupo=utf8_decode(trim($row['nombre_grupo']));
			$hora_creacion=utf8_decode(trim($row['hora_creacion']));
			$fecha_creacion=formatofecha(trim($row['fecha_creacion']));
		}
		$x_izq=10;
		$x_der=130;
		
		$this->Ln(2);
		
		$this->SetX(10);
		$this->SetFont('times','B',9);
		$this->MultiCell(195,6,strtoupper(_("datos del grupo de trabajo")),'0','L');
		
		$this->SetFont('times','B',8);
		$this->SetX($x_izq);
		$this->Cell(35,5,strtoupper(_('nombre del grupo')),"1",0,"J");
		
		$this->SetFont('times','',8);
		$this->Cell(95,5,$nombre_grupo,"1",0,"J");
		$this->SetFont('times','B',8);

		$this->Cell(33,5,strtoupper(_('fecha creacion')),"1",0,"L");
		
		$this->Cell(30,5,$fecha_creacion."  ".$hora_creacion,"1",0,"L");
		$this->Ln(6);
	}
	function datos_tecnicos($acceso,$id_gt)
	{
		$this->SetX(10);
		$this->SetFont('times','B',9);
		$this->Ln(3);
		$this->MultiCell(195,6,strtoupper(_("datos de los tecnicos agregados")),'0','L');
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$w=array(10,30,50,50,);
		$header=array(strtoupper(_('nro')),strtoupper(_('cedula')),strtoupper(_('nombre')),strtoupper(_('apellido')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_grupotecnico where id_gt='$id_gt' ");
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX(10);
			$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
			$this->Cell($w[1],6,trim($row["cedula"]),"LR",0,"J",$fill);
			$this->Cell($w[2],6,utf8_d(trim($row["nombre"])),"LR",0,"J",$fill);
			$this->Cell($w[3],6,utf8_d(trim($row["apellido"])),"LR",0,"J",$fill);
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
	}
	function datos_sector($acceso,$id_gt,$organizar_por)
	{
		$this->SetX(10);
		$this->SetFont('times','B',9);
		$this->Ln(3);
		$this->MultiCell(195,6,strtoupper(_("datos de los sectores agregados")),'0','L');
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		$w=array(10,65,65);
		$header=array(strtoupper(_('nro')),strtoupper(_('nombre sector')),strtoupper(_('nombre zona')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_grupoubicacion where id_gt='$id_gt' order by nombre_zona,nombre_sector");
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX(10);
			$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
			$this->Cell($w[1],6,utf8_d(trim($row["nombre_sector"])),"LR",0,"J",$fill);
			$this->Cell($w[2],6,utf8_d(trim($row["nombre_zona"])),"LR",0,"J",$fill);
			
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
	}
	
}
//crea el objeto pdf
$pdf=new PDF();    
      
$pdf->SetDisplayMode("real");
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,5);
//agrega una nueva pagina
$pdf->AddPage('P','letter');
//$pdf->Fecha();

$pdf->Titulo($titulo);
$pdf->Cuerpo($acceso,$id_gt);
//dl_file($cad);

$pdf->datos_tecnicos($acceso,$id_gt);
$pdf->datos_sector($acceso,$id_gt,$organizar_por);

//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');

?> 