<?php
require('libAlphaPDF/fpdf_alpha.php');

$title = $_SESSION["titulo_estadistico"];
$nombre = trim($_GET['nombre']);
$ext = trim('.png');
$archivo = $nombre.$ext;

//Comprobamos que la imagen exista
if (file_exists($archivo)) { //si existe crea el documento.pdf
	$pdf = new PDF_ImageAlpha('L','mm','A4');
	$pdf->AddPage();
	$pdf->SetFont('Arial', '', 16); 
	$pdf->Cell(40,20);
	$pdf->Titulo($title);
	$pdf->Fecha();
	$pdf->Image($archivo,10,80,290,80,'PNG','', false, 0);
	unlink($archivo); //borramos la imagen para que no quede almacenada
	ob_end_clean();
	$pdf->Output('Estadistica.pdf','I');
} else {
	//Con esta instrucción llamamos al metodo generarImg definido
	//en la ventana padre y generamos un reload por si el usuario
	//refresca el popup y pulsa enter/intro en la barra de direcciones
	echo "<script language='javascript'> window.opener.generarImg(); </script>";  
}
?>