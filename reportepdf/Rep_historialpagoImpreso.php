<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_contrato=$_GET['id_contrato'];
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
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
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7,strtoupper(_('historial de pagos')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,20,40,40,20,12,16,16);
		$header=array(strtoupper(_('nro')),strtoupper(_('factura')),strtoupper(_('fecha pago')),strtoupper(_('tipo servicio')),strtoupper(_('nombre servicio')),strtoupper(_('fecha cargo')),strtoupper(_('cant')),strtoupper(_('costo')),strtoupper(_('total')));
		$this->SetFont('Arial','B',8);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_contrato)
	{
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
			$this->SetFont('Arial','B',8);
			$this->Cell(27,6,strtoupper(_("nro abonado")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$nro_contrato,"0",0,"J");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("fecha")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,$fecha_contrato,"0",0,"J");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("status")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$status_contrato,"0",0,"J");
			
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(27,6,strtoupper(_("cedula")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$cedula,"0",0,"J");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("nombre")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,$nombre,"0",0,"J");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("apellido")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$apellido,"0",0,"J");
			
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(27,6,strtoupper(_("telefono")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$telefono,"0",0,"J");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("telf casa")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,$telf_casa,"0",0,"J");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("telf adicional")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$telf_adic,"0",0,"J");
			
			
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(27,6,strtoupper(_("email")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$email,"0",0,"J");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("precinto")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,$etiqueta,"0",0,"J");
			
			
			$this->Ln();
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','B',9);
			$this->Cell(190,6,strtoupper(_("datos de ubicacion")),"0",0,"J");
			
			$this->Ln();
			
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(27,6,strtoupper(_("franquicia")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$nombre_franq,"0",0,"J");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("zona")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(40,6,$nombre_zona,"0",0,"J");
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("sector")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$nombre_sector,"0",0,"J");
			
			$this->Ln();
			
			
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(27,6,strtoupper(_("calle")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(108,6,$nombre_calle,"0",0,"J");
			
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("nro casa")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$numero_casa,"0",0,"J");
			
			$this->Ln();
			
			
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(27,6,strtoupper(_("edificio")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(108,6,$edificio,"0",0,"J");
			
			
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,strtoupper(_("nro piso")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(50,6,$numero_piso,"0",0,"J");
			
			$this->Ln();
			
			
			$this->SetX(10);
			$this->SetFont('Arial','B',8);
			$this->Cell(27,6,strtoupper(_("referencia")).": ","0",0,"J");
			$this->SetFont('Arial','',8);
			$this->Cell(108,6,$direc_adicional,"0",0,"J");
		}
		
			$this->Ln();
			$this->Ln();
			$this->SetX(10);
			$this->SetFont('Arial','B',9);
			$this->Cell(190,6,strtoupper(_("historial de pagos")),"0",0,"J");
		$this->Ln();
		
		$w=$this->TituloCampos();
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_pago_ser where id_contrato='$id_contrato'");
		
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$suma=0.00;
		while ($row=row($acceso))
		{
			$tipo_costo=trim($row["tipo_costo"]);
			$total=0.00;
			$cant=trim($row["cant_serv"]);
			$tar=trim($row["costo_cobro"]);
			$total=($cant*$tar);
			$suma=$suma+$total;
			$fecha_inst=trim($row["fecha_inst"]);
			
							$fec = explode ("-",$fecha_inst);
							$me=$fec[1];
							$anio=$fec[0];
							$mes=array("01"=>"Enero","02"=>"Febre","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agost","09"=>"Septi","10"=>"Octub","11"=>"Novie","12"=>"Dicie");
							$f_mes=$mes[$me];
							if($tipo_costo=="COSTO MENSUAL"){
								$fecha="$f_mes $anio";
							}
							else{
								$fecha = date("d/m/Y", strtotime($value));
							}
			
			
			$this->SetX(10);
			$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
			$this->Cell($w[1],6,utf8_d(trim($row["nro_factura"])),"LR",0,"J",$fill);
			$this->Cell($w[2],6,formatofecha(trim($row["fecha_pago"])),"LR",0,"J",$fill);
			$this->Cell($w[3],6,utf8_d(trim($row["tipo_servicio"])),"LR",0,"J",$fill);
			$this->Cell($w[4],6,utf8_d(trim($row["nombre_servicio"])),"LR",0,"J",$fill);
			$this->Cell($w[5],6,$fecha,"LR",0,"J",$fill);
			$this->Cell($w[6],6,utf8_d(trim($row["cant_serv"])),"LR",0,"J",$fill);
			$this->Cell($w[7],6,number_format($tar+0, 2, ',', '.'),"LR",0,"J",$fill);
			$this->Cell($w[8],6,number_format($total+0, 2, ',', '.'),"LR",0,"J",$fill);

			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
		
		
		$this->Ln();
		$this->SetX(10);
			$this->SetFont('Arial','B',9);
		$this->Cell(30,6,strtoupper(_('total pagado')).": ","0",0,"J",$fill);
		$this->Cell(20,6,number_format($suma+0, 2, ',', '.'),"0",0,"J",$fill);
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-30);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_d(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	    
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de p�gina autom�tico desde la parte inferior de la p�gina 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$id_contrato);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 