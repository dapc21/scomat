<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php";
$id_ped=$_GET["id_ped"];
//$id_ped=$_GET["id_ped"];
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
		$this->MultiCell(180,5,strtoupper(_('planilla pedido materiales')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,50,50,20,15,20,15);
		$header=array(strtoupper(_('#mat')),strtoupper(_('material')),strtoupper(_('deposito')),strtoupper(_('stock')),strtoupper(_('min')),strtoupper(_('solicitado')),strtoupper(_('medida')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],5,$header[$k],1,0,'C',1);
		$this->Ln();
		return $w;
	}
	function TituloCampos2()
	{
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,70,25,25,20,30);
		$header=array(strtoupper(_('#mat')),strtoupper(_('material')),strtoupper(_('solicitado')),strtoupper(_('entregado')),strtoupper(_('preciouni')),strtoupper(_('totaluni')));
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
		
		$acceso->objeto->ejecutarSql("SELECT num_ped,login_sol,login_apr,login_com FROM pedido where id_ped='$id_ped'");
		$row=row($acceso);
		$num_ped=trim($row["num_ped"]);
		$login_sol=trim($row["login_sol"]);
		$login_apr=trim($row["login_apr"]);
		$login_com=trim($row["login_com"]);
		
		/***************************************/
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		/***************************************/
		$acceso1=conexion();
		$acceso1->objeto->ejecutarSql("SELECT *FROM vista_planillaped, proveedor where id_ped='$id_ped' and vista_planillaped.id_prov=proveedor.id_prov LIMIT 1 offset 0");
		
		
		$z=array(26,118,20,16);
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_("datos pedido        Nº $num_ped")),1,0,'J',0);
		$this->Ln();
		while ($row=row($acceso1))
		{
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,5,strtoupper(_('proveedor')),1,0,'J',FALSE);
			$this->SetFont('Arial','',9);
			$this->Cell(85,5,utf8_decode(trim($row["nombre_prov"])),1,0,'J',FALSE);
			$this->SetFont('Arial','B',9);
			$this->Cell(15,5,strtoupper(_('rif')),1,0,'J',FALSE);
			$this->SetFont('Arial','',9);
			$this->Cell(30,5,utf8_decode(trim($row["rif_prov"])),1,0,'C',FALSE);
			$this->Cell(20,5,utf8_decode(formatofecha(trim($row["fecha_ped"]))),1,0,'C',FALSE);
			$this->Ln();
			
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,5,strtoupper(_('status')),1,0,'J',FALSE);
			$this->SetFont('Arial','',9);
			$this->Cell(150,5,utf8_decode(trim($row["status_ped"])),1,0,'J',FALSE);
			$this->Ln();
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell(180,5,strtoupper(_('observación')),1,1,'J',FALSE);
			//$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX(15);
			$this->MultiCell(180,5,utf8_decode(trim($row["obser_ped"])),1,'B',FALSE);			
			$fill=!$fill;//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
		}		
		/*******************************************/
		$this->Ln();
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_("datos materiales")),1,0,'J',0);
		
		$acceso->objeto->ejecutarSql("SELECT * FROM vista_planillaped where id_ped='$id_ped'  LIMIT 1 offset 0");
		while ($row=row($acceso))
		{
			$this->SetX(15);
			if(trim($row["status_ped"])!="COMPRADO"){
				$w=$this->TituloCampos();
			}else{
				$w=$this->TituloCampos2();
			}
		}
		
		//stock,c_uni_sal,numero_mat,nombre_mat,nombre_dep,stock_min,cant_ped,abreviatura
		$acceso->objeto->ejecutarSql("SELECT * FROM vista_planillaped where id_ped='$id_ped' ");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$fill=!$fill;
		while ($row=row($acceso))
		{
			$this->SetX(15);
			if(trim($row["status_ped"])!="COMPRADO"){
				//$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
				$this->Cell($w[0],5,utf8_decode(trim($row["numero_mat"])),"LR",0,"J",$fill);
				$this->Cell($w[1],5,substr(utf8_decode(trim($row["nombre_mat"])),0,23),"LR",0,"J",$fill);
				$this->Cell($w[2],5,substr(utf8_decode(trim($row["nombre_dep"])),0,25),"LR",0,"J",$fill);
				
				$stock=trim($row["stock"]);
				$stock1=explode('.',$stock/trim($row["c_uni_sal"]));
				$this->Cell($w[3],5,$stock1[0],"LR",0,"R",$fill);
				$this->Cell($w[4],5,utf8_decode(trim($row["stock_min"])),"LR",0,"R",$fill);
				$this->Cell($w[5],5,utf8_decode(trim($row["cant_ped"])),"LR",0,"R",$fill);
				$this->Cell($w[6],5,utf8_decode(trim($row["abreviatura"])),"LR",0,"C",$fill);

				
			}else{
				$this->Cell($w[0],5,utf8_decode(trim($row["numero_mat"])),"LR",0,"J",$fill);
				$this->Cell($w[1],5,substr(utf8_decode(trim($row["nombre_mat"])),0,25),"LR",0,"J",$fill);
				//$this->Cell($w[2],6,substr(utf8_decode(trim($row["nombre_dep"])),0,25),"LR",0,"J",$fill);
				
			//	$stock=trim($row["stock"]);
			//	$stock1=explode('.',$stock/trim($row["c_uni_sal"]));
				$this->Cell($w[2],5,utf8_decode(trim($row["cant_ped"])),"LR",0,"R",$fill);
				$this->Cell($w[3],5,utf8_decode(trim($row["cant_ent"])),"LR",0,"R",$fill);
				$this->Cell($w[4],5,number_format(utf8_decode(trim($row["precio"]))+0, 2, ',', '.'),"LR",0,"R",$fill);
				$this->Cell($w[5],5,number_format(utf8_decode(trim($row["precio"])*trim($row["cant_ent"]))+0, 2, ',', '.'),"LR",0,"R",$fill);
			
			
			}
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
		
		$this->Ln(1);
		$this->SetX(15);
		$this->Cell(array_sum($w),4,strtoupper(_("Total Registros")).": ".($cont -1),1,0,"J",0);
		$acceso1->objeto->ejecutarSql("SELECT *FROM vista_planillaped, proveedor where id_ped='$id_ped' and vista_planillaped.id_prov=proveedor.id_prov LIMIT 1 offset 0");
		
		while ($row2=row($acceso1))
		{
			if(trim($row2["status_ped"])=="COMPRADO"){
				$this->Ln();
				$this->SetX(15);
				$this->SetFont('Arial','B',9);
				$this->Cell(120,5,'',0,0,'J',FALSE);
				$this->Cell(30,5,strtoupper(_('descuento')),'LT',0,'J',FALSE);
				$this->SetFont('Arial','',9);
				$this->Cell(30,5,number_format(utf8_decode(trim($row2["desc_ped"]))+0, 2, ',', '.'),1,1,'R',FALSE);
				$this->SetX(15);
				$this->SetFont('Arial','B',9);
				$this->Cell(120,5,'','L',0,'J',FALSE);
				$this->Cell(30,5,strtoupper(_('sub-total')),1,0,'J',FALSE);
				$this->SetFont('Arial','',9);
				$this->Cell(30,5,number_format(utf8_decode(trim($row2["base_ped"]))+0, 2, ',', '.'),1,1,'R',FALSE);
				$this->SetX(15);
				$this->SetFont('Arial','B',9);
				$this->Cell(120,5,'','L',0,'J',FALSE);
				$this->Cell(30,5,strtoupper(_('iva')).'(12%)',1,0,'J',FALSE);
				$this->SetFont('Arial','',9);
				$this->Cell(30,5,number_format(utf8_decode(trim($row2["iva_ped"]))+0, 2, ',', '.'),1,1,'R',FALSE);
				$this->SetX(15);
				$this->SetFont('Arial','B',9);
				$this->Cell(120,5,'','L',0,'J',FALSE);
				$this->Cell(30,5,strtoupper(_('total')),1,0,'J',FALSE);
				$this->SetFont('Arial','',9);
				$this->Cell(30,5,number_format(utf8_decode(trim($row2["total_ped"]))+0, 2, ',', '.'),'LB',1,'R',FALSE);
				$this->Ln();
			}
		}
		
		
		$this->Ln(40);
		$this->SetY(250);
		$this->SetX(15);
		$this->Cell(60,2,'________________________',0,0,'C','');		
		$this->Cell(60,2,'________________________',0,0,'C','');		
		$this->Cell(60,2,'________________________',0,0,'C','');		
		$this->Ln(3);
		$this->SetX(15);
		$this->Cell(60,4,"Solicitado Por",0,0,'C','');
		$this->Cell(60,4,"Aprobado/Rechazado Por",0,0,'C','');
		$this->Cell(60,4,"Registro de Compra",0,0,'C','');
		$this->Ln(4);
		$this->SetX(15);
		
		$acceso->objeto->ejecutarSql("select nombre,apellido from personausuario where login='$login_sol'");
		if($row=row($acceso)){
			$resp_sol=utf8_decode(trim($row["nombre"])." ".trim($row["apellido"]));
		}
		
		$acceso->objeto->ejecutarSql("select nombre,apellido from personausuario where login='$login_apr'");
		if($row=row($acceso)){
			$resp_apr=utf8_decode(trim($row["nombre"])." ".trim($row["apellido"]));
		}
		
		$acceso->objeto->ejecutarSql("select nombre,apellido from personausuario where login='$login_com'");
		if($row=row($acceso)){
			$resp_com=utf8_decode(trim($row["nombre"])." ".trim($row["apellido"]));
		}
		
		$this->Cell(60,4,$resp_sol,0,0,'C','');
		$this->Cell(60,4,$resp_apr,0,0,'C','');
		$this->Cell(60,4,$resp_com,0,0,'C','');
		
		
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
$pdf->Cuerpo($acceso,$id_ped);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 