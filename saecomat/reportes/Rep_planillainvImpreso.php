<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php";
$id_inv=$_GET["id_inv"];

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
		$this->Cell(12,5,strtoupper(_('fecha')).':',0,0,'L');
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
		$this->MultiCell(190,5,strtoupper(_('Planilla Inventario de Materiales')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimensiones de cada campo
		$w=array(30,70,40,40);
		$header=array(strtoupper(_('Referencia')),strtoupper(_('Material')),strtoupper(_('Stock Almacén')),strtoupper(_('Stock Real')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],5,$header[$k],1,0,'C',1);
		$this->Ln();
		return $w;
	}
	
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_inv)
	{
		$acceso1=conexion();
		$acceso2=conexion();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		
		/** CONSULTA PARA TRAER EL INVENTARIO (id_inv) CORRESPONDE A UN REGISTRO **/
		$acceso->objeto->ejecutarSql("SELECT * FROM vista_inventario WHERE id_inv = '$id_inv'");
		$row=row($acceso);
		$ref_inv = trim($row["ref_inv"]);
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_("Datos del Inventario")),1,0,'J',0);
		$this->Ln();
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,5,strtoupper(_('Referencia')),1,0,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->Cell(60,5,utf8_decode(trim($row["ref_inv"])),1,0,'J',FALSE);
		$this->SetFont('Arial','B',9);
		$this->Cell(20,5,strtoupper(_('Almacén')),1,0,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->Cell(70,5,utf8_decode(trim($row["nombre_alm"])),1,0,'J',FALSE);
		$this->Ln();
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,5,strtoupper(_('Motivo')),1,0,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->Cell(60,5,utf8_decode(trim($row["nombre_mot_inv"])),1,0,'J',FALSE);
		$this->SetFont('Arial','B',9);
		$this->Cell(20,5,strtoupper(_('Fecha')),1,0,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->Cell(25,5,utf8_decode(formatofecha(trim($row["fecha_inv"]))),1,0,'J',FALSE);
		$this->SetFont('Arial','B',9);
		$this->Cell(20,5,strtoupper(_('Hora')),1,0,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->Cell(25,5,utf8_decode(trim($row["hora_inv"])),1,0,'J',FALSE);
		$this->Ln();
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,5,strtoupper(_('Estatus')),1,0,'J',FALSE);
		$this->SetFont('Arial','',9);
		if(trim($row["nombre_est_inv"])=="FINALIZADO")
		{
			$this->Cell(150,5,"FINALIZADO",1,0,'J',FALSE);
		}else{
			$this->Cell(150,5,"EN REVISION",1,0,'J',FALSE);
		}
		$this->Ln();
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_('Observación')),1,1,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->SetX(15);
		$this->MultiCell(180,5,utf8_decode(trim($row["obser_inv"])),1,'B',FALSE);			
		$fill=!$fill;
		
		
		$this->Ln();
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_("Datos de Materiales ubicados en ".utf8_decode(trim($row["nombre_alm"])) )),1,0,'J',0);
		
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		$w=$this->TituloCampos();
		
		$this->SetFont('Arial','',9);
		
		/** CONSULTA PARA TRAER MATERIALES REALCIONADOS AL INVENTARIO (id_inv) 
		SEGUN ALMACÉN, CORRESPONDE A UNO O VARIOS REGISTROS ASOCIADOS **/
		$dato=lectura($acceso1,"SELECT * FROM vista_inventario_material WHERE id_inv = '$id_inv'");
		$cantiReg = count($dato);
		for($i=0;$i<$cantiReg;$i++){
			$acceso1->objeto->ejecutarSql("SELECT * FROM vista_inventario_material WHERE id_inv = '$id_inv'");
			if($row2=row($acceso1)){
				$this->SetX(15);
				$this->Cell($w[0],5,utf8_decode(trim($dato[$i]["codigo_mat"])),1,0,"C",$fill);
				$this->Cell($w[1],5,substr(utf8_decode(trim($dato[$i]["nombre_mat"])),0,23),1,0,"J",$fill);
				$this->Cell($w[2],5,utf8_decode(trim($dato[$i]["cant_sist"]))." ".utf8_decode(trim($dato[$i]["abrev_uni_sal"])),1,0,"C",$fill);
				$this->Cell($w[3],5," ",1,0,"J",$fill);
				$this->Ln();
				$fill=!$fill;
			}
		}
		$this->SetX(15);
		$this->Cell(180,5,'','T');
		
		$this->SetX(15);
		$this->Cell(180,4,strtoupper(_("Total Registros")).": ".$cantiReg,1,0,"J",0);
		
		
		$acceso2->objeto->ejecutarSql("SELECT encargado FROM vista_inventario WHERE id_inv='$id_inv'");
		if($row3=row($acceso2)){
			$respVer=utf8_decode(trim($row3["encargado"]));
		}
		$ini_u = $_SESSION["ini_u"];
		$acceso2->objeto->ejecutarSql("SELECT (persona.nombre || ' ' || persona.apellido) AS user, usuario.inicial as inicial FROM persona, usuario WHERE persona.id_persona = usuario.id_persona and usuario.inicial = '$ini_u'");
		if($row3=row($acceso2)){
			$respReg=utf8_decode(trim($row3["user"]));
			$inicial=utf8_decode(trim($row3["inicial"]));
		}
		
		/** NOTA: Colocar una nota que diga "Debe finalizar este inventario luego de realizada la inspección, y en caso de ser necesario aplicar ajustes en el stock" **/
		
		$this->Ln(20);
		$this->SetY(250);
		$this->SetX(15);
		$this->Cell(90,2,'________________________',0,0,'C','');		
		$this->Cell(90,2,'________________________',0,0,'C','');		
		$this->Ln(3);
		$this->SetX(15);
		$this->Cell(90,4,"Registrado Por",0,0,'C','');
		$this->Cell(90,4,"Inspeccionado Por",0,0,'C','');
		$this->Ln(4);
		$this->SetX(15);
		$this->Cell(90,4,$respReg." ".$ini_u,0,0,'C','');
		$this->Cell(90,4,$respVer,0,0,'C','');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		$this->pie_pred();
	}
}

$pdf=new PDF();
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,20);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$id_inv);
//imprime el reporte en formato PDF
$pdf->Output('planillaInventarioPDF.pdf','D');
?> 