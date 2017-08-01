<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php"; 
$id_ped=$_GET["id_ped"];

class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetFont('times','',13);
		$this->SetXY(10,10);
		$this->MultiCell(195,5,nombre_empresa(),'0','L');
		$this->SetFont('times','I',9);
		$this->SetXY(90,10);
		$this->MultiCell(115,5,"RIF ".tipo_serv(),'0','R');
		$this->Titulo();
		$this->Fecha();
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
		$this->MultiCell(190,5,strtoupper(_('Planilla Pedido de Materiales')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimensiones de cada campo
		$w=array(30,45,35,35,35);
		$header=array(strtoupper(_('Referencia')),strtoupper(_('Material')),strtoupper(_('Almacen')),strtoupper(_('Cant. Solicitada')),strtoupper(_('Cant. Comprada')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],5,$header[$k],1,0,'C',1);
		$this->Ln();
		return $w;
	}
	
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_ped)
	{
		$acceso1=conexion();
		$acceso2=conexion();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		
		/** CONSULTA PARA TRAER EL PEDIDO (id_ped) CORRESPONDE A UN REGISTRO **/
		$acceso->objeto->ejecutarSql("SELECT * FROM vista_pedido WHERE id_ped = '$id_ped'");
		$row=row($acceso);
		$ref_ped = trim($row["ref_ped"]);
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_("Datos del Pedido")),1,0,'J',0);
		$this->Ln();
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,5,strtoupper(_('Referencia')),1,0,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->Cell(30,5,utf8_decode(trim($row["ref_ped"])),1,0,'J',FALSE);
		$this->SetFont('Arial','B',9);
		$this->Cell(20,5,strtoupper(_('Estatus')),1,0,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->Cell(45,5,utf8_decode(trim($row["nombre_est_ped"])),1,0,'J',FALSE);
		$this->SetFont('Arial','B',9);
		$this->Cell(20,5,strtoupper(_('Fecha')),1,0,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->Cell(35,5,utf8_decode(formatofecha(trim($row["fecha_ped"]))),1,0,'J',FALSE);
		$this->Ln();
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_('Observacion')),1,1,'J',FALSE);
		$this->SetFont('Arial','',9);
		$this->SetX(15);
		$this->MultiCell(180,5,utf8_decode(trim($row["obser_ped"])),1,'B',FALSE);			
		$fill=!$fill;
		
		
		$this->Ln();
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_("Datos de Materiales")),1,0,'J',0);
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		
		$w=$this->TituloCampos();
		
		$this->SetFont('Arial','',9);
		
		$dato=lectura($acceso1,"SELECT * FROM vista_pedido_material, pedido, estatus_pedido WHERE vista_pedido_material.id_ped = '$id_ped'
		AND vista_pedido_material.id_estatus_reg = 1 AND vista_pedido_material.id_ped = pedido.id_ped AND pedido.id_est_ped = estatus_pedido.id_est_ped");
		$cantiReg = count($dato);
		for($i=0;$i<$cantiReg;$i++){
			$acceso1->objeto->ejecutarSql("SELECT * FROM vista_pedido_material, pedido, estatus_pedido WHERE vista_pedido_material.id_ped = '$id_ped'
			AND vista_pedido_material.id_estatus_reg = 1 AND vista_pedido_material.id_ped = pedido.id_ped AND pedido.id_est_ped = estatus_pedido.id_est_ped");
			
			if($row2=row($acceso1)){
				$this->SetX(15);
				$this->Cell($w[0],5,utf8_decode(trim($dato[$i]["codigo_mat"])),1,0,"C",$fill);
				$this->Cell($w[1],5,substr(utf8_decode(trim($dato[$i]["nombre_mat"])),0,20),1,0,"J",$fill);
				$this->Cell($w[2],5,substr(utf8_decode(trim($dato[$i]["nombre_alm"])),0,15),1,0,"J",$fill);
				$this->Cell($w[3],5,utf8_decode(trim($dato[$i]["cant_ped_mat"]))." ".utf8_decode(trim($dato[$i]["abrev_uni_sal"])),1,0,"C",$fill);
				if(trim($dato[$i]["codigo_est_ped"])=="SOL")
				{
					$this->Cell($w[4],5,"0.00 ".utf8_decode(trim($dato[$i]["abrev_uni_sal"])),1,0,"C",$fill);
				}else{
					$this->Cell($w[4],5,utf8_decode(trim($dato[$i]["cant_comp_mat"]))." ".utf8_decode(trim($dato[$i]["abrev_uni_sal"])),1,0,"C",$fill);
				}
				$this->Ln();
				$fill=!$fill;
			}
		}
		$this->SetX(15);
		$this->Cell(180,5,'','T');
		
		$this->SetX(15);
		$this->Cell(180,4,strtoupper(_("Total Registros")).": ".$cantiReg,1,0,"J",0);
		
		
		$log = $_SESSION["login"];
		$acceso2->objeto->ejecutarSql("SELECT (persona.nombre || ' ' || persona.apellido) AS user, usuario.inicial as inicial FROM persona, usuario WHERE persona.id_persona = usuario.id_persona and usuario.login = '$log'");
		if($row3=row($acceso2)){
			$respReg=utf8_decode(trim($row3["user"]));
		}
		
		
		$this->Ln(20);
		$this->SetY(250);
		$this->SetX(15);
		$this->Cell(180,2,'________________________',0,0,'C','');
		$this->Ln(3);
		$this->SetX(15);
		$this->Cell(180,4,"Solicitado Por",0,0,'C','');
		$this->Ln(4);
		$this->SetX(15);
		$this->Cell(180,4,$respReg." ".$ini_u,0,0,'C','');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{		
		$this->AliasNbPages();
		$this->SetY(-20);
		
		$this->SetFont('Arial','B',8);
		$this->MultiCell(180,5,"",'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}

$pdf=new PDF();
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,10);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Cuerpo($acceso,$id_ped);
//imprime el reporte en formato PDF
$pdf->Output('planillaPedidoPDF.pdf','D');
?> 