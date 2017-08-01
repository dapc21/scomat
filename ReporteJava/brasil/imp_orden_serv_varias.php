<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_orden=trim($_GET['id_orden']);
$id_gt=trim($_GET['id_gt']);
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
	}
	//Titulo del reporte
	function Titulo($titulo)
	{
		$this->SetFont('Arial','',9);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(195,8,utf8_decode("ORDEN DE SERVICIO POR: ".$titulo),'0','C');
		$this->MultiCell(195,3,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",'0','C');
		
	}
	
	//muestra el listado de los reportes 
	function orden($acceso,$id_orden,$id_gt){
		$valor=explode("=@",$id_orden);
		$tam=count($valor)-1;
		//echo ":$tam:";
		$cad='';
		for($i=0;$i<$tam;$i++){
			$this->AddPage('P','letter');
			$id_orden=$valor[$i];
			$acceso->objeto->ejecutarSql("insert into orden_grupo(id_orden,id_gt) values ('$id_orden','$id_gt')");
			$this->Cuerpo($acceso,$valor[$i]);
			$this->materiales($acceso,$id_orden);
			$this->dir_mudanza();
			$this->mas_datos($acceso,$id_orden);
			$acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set status_orden='IMPRESO' Where id_orden='$id_orden'");
		}
	}
	function Cuerpo($acceso,$id_orden)
	{
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
			$cedulacli=utf8_decode(trim($row['cedulacli']));
			
			$nro_contrato=trim($row['nro_contrato']);
			$id_contrato=trim($row['id_contrato']);
		
		}
		$acceso->objeto->ejecutarSql("SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono,telf_casa,direc_adicional,
		(select sum(deuda) from vista_deudacli where vista_deudacli.id_contrato='$id_contrato') as deuda
		FROM vista_contrato where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
		
		if($row=row($acceso)){
			$deuda=utf8_decode(trim($row['deuda']));
			if($deuda==""){	
				$deuda=0;
			}
			$deuda=number_format($deuda+0, 2, ',', '.');
			$nombre_zona=utf8_decode(trim($row['nombre_zona']));
			$nombre_sector=utf8_decode(trim($row['nombre_sector']));
			$nombre_calle=utf8_decode(trim($row['nombre_calle']));
			$numero_casa=utf8_decode(trim($row['numero_casa']));
			$telefono=utf8_decode(trim($row['telefono']));
			$telf_casa=utf8_decode(trim($row['telf_casa']));
			$direc_adicional=utf8_decode(trim($row['direc_adicional']));
			
		}
		
		$acceso->objeto->ejecutarSql("SELECT postel,taps,pto,edificio,
		FROM contrato where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
		
		if($row=row($acceso)){
			$postel=utf8_decode(trim($row['postel']));
			$taps=utf8_decode(trim($row['taps']));
			$pto=utf8_decode(trim($row['pto']));
			$edificio=utf8_decode(trim($row['edificio']));
			$numero_piso=utf8_decode(trim($row['numero_piso']));
		}
		
		
		$fecha=date("d/m/Y");
		$x_izq=10;
		$x_medio=100;
		$x_der=150;
		$this->Ln();
		$this->SetFont('arial','',9);
		$this->SetX($x_izq);
		$this->Cell(30,6,'FECHA DE EMISION: '.$fecha_orden,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(28,6,'SALDO A LA FECHA: '.$deuda,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_der);
		$this->Cell(16,6,'CEDULA: '.$cedulacli,"0",0,"J");
		
		$this->Ln();
		$this->SetFont('arial','',9);
		$this->SetX($x_izq);
		$this->Cell(15,6,'CLIENTE: '.$nombrecli,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(16,6,'CONTRATO: '.$nro_contrato,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_der);
		$this->Cell(16,6,'TAG NRO: '.$etiqueta,"0",0,"J");
		
		$this->Ln();
		$this->SetFont('arial','',9);
		$this->SetX($x_izq);
		$this->Cell(15,5,'DIRECCIÓN:',"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(16,6,"TELEFONO: $telefono / $telf_casa","0",0,"J");
		
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(10,6,'ZONA: '.$nombre_zona,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(16,6,'SECTOR: '.$nombre_sector,"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(10,6,'CALLE: '.$nombre_calle,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(16,6,'NRO CASA: '.$numero_casa,"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(10,6,'EDIFICIO: '.$edificio,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(16,6,'NRO PISO: '.$numero_piso,"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(10,6,'POSTEL: '.$postel,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(16,6,'TAPS: '.$taps,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_der);
		$this->Cell(16,6,'PTO: '.$pto,"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(20,6,'REFERENCIA: '.$direc_adicional ,"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		$this->Cell(25,6,'DETALLE ORDEN: '.$nombre_det_orden,"0",0,"J");
		
		$this->SetFont('arial','',9);
		$this->SetX($x_medio);
		$this->Cell(25,6,'COMENTARIO: '.$detalle_orden,"0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('arial','',9);
		
		$acceso->objeto->ejecutarSql("SELECT *FROM orden_grupo where id_orden='$id_orden'  LIMIT 1 offset 0");
		if($row=row($acceso)){
			$id_gt=utf8_decode(trim($row['id_gt']));
		}
		$acceso->objeto->ejecutarSql("SELECT *FROM grupo_trabajo where id_gt='$id_gt'  LIMIT 1 offset 0");
		if($row=row($acceso)){
			$nombre_grupo=utf8_decode(trim($row['nombre_grupo']));
		}
		$this->Cell(20,6,'ASIGNADA A: '.$nombre_grupo,"0",0,"J");
		
		
		return $cad;
	}
	function materiales()
	{
		$this->Ln();
		
		$this->SetXY(10,95);
		$this->SetFont('arial','',12);
		$this->MultiCell(195,6,"MATERIALES.",'0','J');
		
		
		
		$this->SetXY(10,100);
		//$this->Ln();
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
		
		$this->SetXY(36,100);
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
		
		$this->SetXY(75,100);
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
		
		$this->SetXY(103,100);
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
		
		$this->SetXY(140,100);
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
		
		$this->SetXY(175,100);
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


$pdf->orden($acceso,$id_orden,$id_gt);

$pdf->Output('reporte.pdf','D');
?> 