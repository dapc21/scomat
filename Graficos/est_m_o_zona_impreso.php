<?php
require('../include/FPDF/fpdf.php');
require_once "metodosGraficos.php";


$anio=$_GET['inicio_a'];
$id_det_orden=$_GET['id_det_orden'];
$id_tipo_orden=$_GET['id_tipo_orden'];
$id_zona=$_GET['id_zona'];



crearIMG("grafico1");
crearIMG("grafico4");

if($anio==""){
	$anio=date("Y");
}

class PDF extends FPDF
{
	public $nombre_det_orden;
	function __construct($acceso,$id_det_orden,$id_tipo_orden)
	{
		parent::__construct();
		if($id_det_orden=="TODOS"){
			$acceso->objeto->ejecutarSql("SELECT nombre_tipo_orden FROM tipo_orden where id_tipo_orden='$id_tipo_orden'");
			$row=row($acceso);
			$nombre_det_orden = trim($row["nombre_tipo_orden"]);
		}
		else{
			$acceso->objeto->ejecutarSql("SELECT nombre_det_orden,id_tipo_orden FROM detalle_orden where id_det_orden='$id_det_orden'");
			$row=row($acceso);
			$nombre_det_orden = trim($row["nombre_det_orden"]);
			$id_tipo_orden = trim($row["id_tipo_orden"]);

			$acceso->objeto->ejecutarSql("SELECT nombre_tipo_orden FROM tipo_orden where id_tipo_orden='$id_tipo_orden'");
			$row=row($acceso);
			$nombre_tipo_orden = trim($row["nombre_tipo_orden"]);
		}
		$this->nombre_det_orden=$nombre_det_orden;
	}
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		//$this->Image('../imagenes/cabecera.jpg',20,10,40);
		$this->SetTextColor(74,90,109);
		$this->SetFont('Arial','',12);
		$this->MultiCell(190,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,tipo_serv(),'0','C');
		
		$this->SetFont('Arial','B',10);
		
		$this->MultiCell(190,7,utf8_decode("ESTADISTICAS ANUALES DE $this->nombre_det_orden POR ZONA"),'0','C');
		
		$this->SetFont('Arial','B',8);
		$this->SetX(123);
		$this->Cell(12,5,'Fecha:',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,'Hora:',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		
	}
	//para mostrar las fecha de impresion del reporte
	
	//muestra los titulos de los campos de los reportes
	
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$anio,$id_det_orden,$id_tipo_orden,$id_zona)
	{
		
		$acceso->objeto->ejecutarSql("SELECT nombre_zona FROM zona where id_zona='$id_zona'");
		$row=row($acceso);
		$nombre_zona = trim($row["nombre_zona"]);
		
		$this->SetXY(20,30);
		$this->Cell(190,6,'AÑO: '.$anio.'         ZONA: '.utf8_decode(strtoupper($nombre_zona)),"0",0,"L");
		
		
		$this->Image('../include/openflashchart/tmp-upload-images/grafico1.jpg',20,35,170);
		$this->Image('../include/openflashchart/tmp-upload-images/grafico4.jpg',20,115,170);
		
		$total_ing = 0;
		$total_deu = 0;
		
		$year = array();
		$data = array();
		$data2 = array();
		$data_pie = array();
		$data_pie1 = array();
		$rango = array();
		$resumen="";
		$k=0;
		
		
	
		$total_i = 0;
		$total_d = 0;
		$num_k=0;
		$meses=ver_meses($acceso,$anio);
		$mes_ini=$meses[0];
		$mes_fin=$meses[1];
		
		for($i=$mes_ini;$i<=$mes_fin;$i++){
			$ult_dia_mes=date("t",mktime( 0, 0, 0, $i, 1, $anio ));
			
			$fec_ini="$anio-$i-01";
			$fec_fin="$anio-$i-$ult_dia_mes";
			
			if($id_det_orden=='TODOS'){
				$corte=verCant($acceso,"select count(ordenes_tecnicos.id_contrato) as total from ordenes_tecnicos,detalle_orden,contrato, calle, sector where ordenes_tecnicos.id_det_orden=detalle_orden.id_det_orden and detalle_orden.id_tipo_orden='$id_tipo_orden' and fecha_orden between '$fec_ini' and '$fec_fin' and sector.id_zona='$id_zona' and ordenes_tecnicos.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			}
			else{
				$corte=verCant($acceso,"select count(ordenes_tecnicos.id_contrato) as total from ordenes_tecnicos,contrato, calle, sector where id_det_orden='$id_det_orden' and fecha_orden between '$fec_ini' and '$fec_fin' and sector.id_zona='$id_zona' and ordenes_tecnicos.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
			}
			$total_ing += $corte;
			
			$year[$k] = "$i";
			$data[$k] = $corte;
			$k++;
			$num_k++;
		}
		

	$num_k=count($data);
		

		$total_ingreso=number_format($total_ing, 0, ',', '.');
		$total_deuda=number_format($total_deu+0, 2, ',', '.');

				
		
		@$act=$total_ing/$num_k;
		$porcentaje_a=number_format($act, 0, ',','.');
						
		$this->SetTextColor(74,90,109);
		$this->SetDrawColor(74,90,109);
		$this->SetLineWidth(.4);
		
		$this->SetFont('Arial','BI',10);
		$this->Ln();
		$this->Ln();
		$this->SetY(180);
		$this->SetX(15);
		$this->Cell(190,6,'RESUMEN DE ORDENES DE SERVICIOS',"0",0,"C");
		$this->Ln();
		
		//dimenciones de cada campo
		$w=array(50,50,50);
		$header=array('DESCRIPCIÓN ',"$this->nombre_det_orden (%).","$this->nombre_det_orden (Cant)");
		$this->SetFont('Arial','B',9);
		$this->SetX(30);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],8,$header[$k],1,0,'J');
		$this->Ln();
		
		$this->SetFont('Arial','',9);
		$cont=1;
		
		$mes_letra=array("1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		for($i=0;$i<$num_k;$i++){
			
			$total=$data[$i];
			@$porc=($total*100)/$total_ing;
			$porcentaje=number_format($porc, 2, ',','.');
		
			
			
			$deuda = $data2[$i];
			@$porc=($deuda*100)/$total_deu;
			$porcentaje1=number_format($porc, 2, ',','.');
				
				$mes_l=$year[$i];
			
				$this->SetX(30);
				$this->Cell($w[0],6,$mes_letra[$mes_l].' '.$anio,"1",0,"J");
				$this->Cell($w[1],6,$porcentaje.'%',"1",0,"J");
				$this->Cell($w[2],6,number_format($total, 0, ',', '.'),"1",0,"J");
				$this->Ln();
				$cont++;
		}
				$this->SetFont('Arial','B',10);
				$this->SetX(30);
				$this->Cell($w[0],8,"PROMEDIO","1",0,"J");
				$this->Cell($w[1],8,'',"1",0,"J");
				$this->SetX(30+$w[0]+$w[1]);
				$this->Cell($w[2],8,$porcentaje_a,"1",0,"J");
				
				$this->Ln();
				
				$this->SetFont('Arial','B',10);
				$this->SetX(30);
				$this->Cell($w[0],8,"TOTAL","1",0,"J");
				$this->Cell($w[1],8,'',"1",0,"J");
				$this->SetX(30+$w[0]+$w[1]);
				$this->Cell($w[2],8,$total_ingreso,"1",0,"J");
				$this->Ln();
	
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
$pdf=new PDF($acceso,$id_det_orden,$id_tipo_orden);              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Cuerpo($acceso,$anio,$id_det_orden,$id_tipo_orden,$id_zona);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 
