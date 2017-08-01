<?php
require('../include/JavaPrint/JavaPrint.php');
require_once "../procesos.php";

$id_orden=trim($_GET['id_orden']);
class PDF extends JavaPrint
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		//$this->Image('../imagenes/cabecera.jpg',20,10,40);
		$this->SetXY(10,10);

		$this->SetFont('Arial','',12);
		$this->MultiCell(195,5,nombre_empresa(),'0','C');
		$this->SetFont('Arial','',10);
		$this->MultiCell(195,5,tipo_serv(),'0','C');
		
		$this->SetFont('Arial','',9);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(195,8,utf8_decode("ORDEN DE SERVICIO POR: ".$titulo),'0','C');
	}
	//Titulo del reporte
	function Titulo($titulo)
	{
		
		//$this->MultiCell(195,3,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",'0','C');
		
	}
	function TituloCampos()
	{
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(195,212,235);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,18,18,50,19,25,20,20,13);
		
		$this->SetX(10);
		
		return $w;
	}
	
	//muestra el listado de los reportes 
	function orden($acceso,$id_orden){
		$this->AddPage('P','letter');
		
		$w=$this->TituloCampos();
		$header=array('Nro','Cont.','Cedula','Nombre y Apellido','F. Cont.','Status','Etiqueta','Telefono','Deuda');
		$this->SetFont('Arial','B',9);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,strtoupper($header[$k]),0,0,'J',0);
		$this->Ln();
		
		$valor=explode("=@",$id_orden);
		$tam=count($valor)-1;
		//echo ":$tam:";
		$cad='';
		for($i=0;$i<$tam;$i++){
			
			$id_orden=$valor[$i];
			$this->Cuerpo($acceso,$valor[$i],$i+1);
			//$this->materiales($acceso,$id_orden);
			//$this->dir_mudanza();
			//$this->mas_datos($acceso,$id_orden);
			$acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set status_orden='IMPRESO' Where id_orden='$id_orden'");
		}
		
	}
	function Cuerpo($acceso,$id_orden,$num)
	{
		$w=$this->TituloCampos();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_orden where id_orden='$id_orden'  LIMIT 1 offset 0");
		if($row=row($acceso)){
			$nombre_tipo_orden=utf8_decode(trim($row['nombre_tipo_orden']));
			$nombre_det_orden=utf8_decode(trim($row['nombre_det_orden']));
			$detalle_orden=utf8_decode(trim($row['detalle_orden']));
			$this->Titulo($nombre_tipo_orden);
			$fecha_orden=formatofecha(trim($row['fecha_orden']));
			//$=trim($row['']);
			$nombre_tec=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
			
			$nombre_tipo_orden=utf8_decode(trim($row['nombre_tipo_orden']));
			$nombrecli=utf8_decode(trim($row['nombrecli'])." ".trim($row['apellidocli']));
			$etiqueta=utf8_decode(trim($row['etiqueta']));
			//$=utf8_decode(trim($row['']));

			$nro_contrato=trim($row['nro_contrato']);
			$id_contrato=trim($row['id_contrato']);
		}
		
		
		$dato=lectura($acceso,"SELECT id_contrato,nro_contrato,cedula,nombre,apellido,fecha_contrato,status_contrato,etiqueta,telefono,  (select sum(cant_serv * costo_cobro) as suma from contrato_servicio where contrato_servicio.id_contrato='$id_contrato' and status_con_ser='DEUDA') as deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa,direc_adicional FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0 ");
		
		$i=0;
		
		$this->SetTextColor(0);
			$this->SetFillColor(249,249,249);
			$id_contrato=trim($dato[$i]["id_contrato"]);
			
			
		$this->SetX(10);
			
			
			$fill=0;
			$this->SetFont('Arial','',9);
			$this->SetX(10);	  	
			$this->Cell($w[0],5,$num,"0",0,"L",$fill);
			$this->Cell($w[1],5,utf8_decode(trim($dato[$i]["nro_contrato"])),"0",0,"J",$fill);
			$this->Cell($w[2],5,utf8_decode(trim($dato[$i]["cedula"])),"0",0,"J",$fill);
			$this->Cell($w[3],5,utf8_decode(trim($dato[$i]["nombre"])." ".trim($dato[$i]["apellido"])),"0",0,"J",$fill);
			$this->Cell($w[4],5,formatofecha(trim($dato[$i]["fecha_contrato"])),"0",0,"J",$fill);
			$this->Cell($w[5],5,utf8_decode(trim($dato[$i]["status_contrato"])),"0",0,"J",$fill);
			$this->Cell($w[6],5,utf8_decode(trim($dato[$i]["etiqueta"])),"0",0,"J",$fill);
			$this->Cell($w[7],5,utf8_decode(trim($dato[$i]["telefono"])),"0",0,"J",$fill);
			$this->Cell($w[8],5,number_format(trim($dato[$i]["deuda"])+0, 2, ',', '.'),"0",0,"R",$fill);
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->Cell(52,5,"ZONA: ".utf8_decode(trim($dato[$i]["nombre_zona"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(40,5,utf8_decode(trim($dato[$i]["nombre_zona"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',9);
			$this->Cell(64,5,"SECTOR: ".utf8_decode(trim($dato[$i]["nombre_sector"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',8);
			//$this->Cell(50,5,utf8_decode(trim($dato[$i]["nombre_sector"])),"0",0,"J",$fill);
			$this->SetFont('Arial','',9);
			$this->Cell(77,5,"CALLE: ".utf8_decode(trim($dato[$i]["nombre_calle"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(65,5,utf8_decode(trim($dato[$i]["nombre_calle"])),"0",0,"J",$fill);
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->Cell(27,5,"NRO CASA: ".utf8_decode(trim($dato[$i]["numero_casa"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(10,5,utf8_decode(trim($dato[$i]["numero_casa"])),"0",0,"J",$fill);
		
			$this->SetFont('Arial','',9);
			$this->Cell(45,5,"EDIF: ".utf8_decode(trim($dato[$i]["edificio"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(35,5,utf8_decode(trim($dato[$i]["edificio"])),"0",0,"J",$fill);
		
			$this->SetFont('Arial','',9);
			$this->Cell(17,5,"PISO: ".utf8_decode(trim($dato[$i]["numero_piso"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(7,5,utf8_decode(trim($dato[$i]["numero_piso"])),"0",0,"J",$fill);
		
			$this->SetFont('Arial','',8);
			$this->Cell(8,5,"REF: ".utf8_decode(trim($dato[$i]["direc_adicional"])),"0",0,"J",$fill);
			//$this->SetFont('Arial','',8);
			//$this->Cell(96,5,utf8_decode(trim($dato[$i]["direc_adicional"])),"0",0,"J",$fill);
			//$this->MultiCell(81,5,utf8_decode(trim($dato[$i]["direc_adicional"])),'TR','J');
			$this->SetFont('Arial','',2);
			//$this->Ln();
			//$this->SetX(114);
		//	$this->Cell(89,3,'',"LR",0,"C",$fill);
			//$this->Cell(array_sum($w),3,'',"RL",0,"C",$fill);

			$this->Ln();
			$this->SetFont('Arial','',8);
			$this->MultiCell(193,5,"TIPO: $nombre_tipo_orden   | DETALLE: $nombre_det_orden  | OBS: $detalle_orden",'0','J');
 			
			$this->SetX(30);
			$this->SetFont('Arial','',8);
			$this->Cell(110,5,"FIRMA DEL TECNIO:","0",0,"J",0);
			$this->Cell(63,5,"FIRMA DEL CLIENTE:","0",0,"J",0);
			

			$this->SetFont('Arial','',8);
			$this->Ln(1);
			$this->Cell(180,4,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',"0",0,"J",$fill);
			$this->Ln();

	}
	function materiales()
	{
		$this->SetXY(10,85);
		$this->SetFont('arial','',12);
		$this->MultiCell(195,6,"MATERIALES.",'0','J');
		
		$this->SetXY(10,90);
		$this->SetFont('arial','B',8);
		$this->MultiCell(195,6,"DESCRIPCIóN",'0','J');
		
		$this->SetXY(10,95);
		$this->SetFont('arial','',8);
		$this->MultiCell(195,5,"Conectores 6
splitter in house
Cable RG 11 C/G
f81
Tap 20
Tap 30
Tap 23
Grapas
Tap 26
		",'0','J');
		
		$this->SetXY(36,95);
		$this->SetFont('arial','',8);
		$this->MultiCell(195,5,"______________
______________
______________
______________
______________
______________
______________
______________
______________

		",'0','J');
		
		$this->SetXY(75,95);
		$this->SetFont('arial','',8);
		$this->MultiCell(195,5,"Conectores 11
Cable RG 06 C/G
Cable RG 11 S/G
Clavos
Tap 29
Tap 17
Tap 14
Tap 11
Tap 12
		",'0','J');
		
		$this->SetXY(103,95);
		$this->SetFont('arial','',8);
		$this->MultiCell(195,5,"_____________
______________
______________
______________
______________
______________
______________
______________
______________

		",'0','J');
		
		$this->SetXY(140,95);
		$this->SetFont('arial','',8);
		$this->MultiCell(195,5,"Conectores 59
Cable RG 06 S/G
Cable RG 59
Bala 500
Tap 16
Dc 8
Dc 12
Feet truch 11

		",'0','J');
		
		$this->SetXY(175,95);
		$this->SetFont('arial','',8);
		$this->MultiCell(195,5,"______________
______________
______________
______________
______________
______________
______________
______________

		",'0','J');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function dir_mudanza()
	{
	
		$x_izq=10;
		$x_medio=100;
		$x_der=150;
		$this->SetXY(10,172);
		$this->SetFont('arial','',12);
		$this->Cell(193,30,'',"1",0,"J");
		
		$this->SetXY(10,152);
		$this->SetFont('arial','',9);
		$this->SetX($x_izq);
		$this->Cell(15,5,'DIRECCIÓN EN CASO DE MUDANZA',"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->Cell(10,6,'ZONA:',"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(16,6,'SECTOR:',"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(10,6,'CALLE:',"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(16,6,'NRO CASA:',"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_der);
		$this->Cell(16,6,'TELEFONO:',"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(20,6,'REFERENCIA:',"0",0,"J");
		
	}
	function mas_datos($acceso,$id_orden)
	{
	
		$x_izq=10;
		$x_medio=100;
		$x_der=150;
		
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->SetX($x_izq);
		$this->Cell(10,6,'HORA DE LLAMADA:',"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(16,6,'ATENDIDA POR:',"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(23,6,'HORA LLEGADA:',"0",0,"J");
		
		$this->Cell(20,6,'____________________________',"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(27,6,'HORA SALIDA:',"0",0,"J");
		
		$this->Cell(20,6,'____________________________',"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(23,6,'ATENDIDO POR:',"0",0,"J");
		
		$this->Cell(20,6,'____________________________',"0",0,"J");
		
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(27,6,'SUPERVISADO POR:',"0",0,"J");
		
		$this->Cell(20,6,'____________________________',"0",0,"J");
		
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(10,6,'COMENTARIO',"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(10,6,'NOTA: ',"0",0,"J");
		
		$this->Cell(20,6,'___________________________________________________________________________________________________________',"0",0,"J");
		$this->Ln();
		$this->Ln();
		$this->Ln();
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(10,6,'FECHA: _________________',"0",0,"J");
		
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(27,6,'FIRMA DEL CLIENTE: ______________________',"0",0,"J");
		
		$this->Ln();
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(27,6,'HORA: ______________________',"0",0,"J");
	}
	
	
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,10);
//agrega una nueva pagina
$pdf->setDialogo("true");

$pdf->orden($acceso,$id_orden);

$pdf->Output('reporte.pdf','D');
?> 