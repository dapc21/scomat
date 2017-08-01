<?php
$obj=new generarExcel();
	$cabeceras=array("Ene","Feb","Mar");
	$filas=array(array("1a","2s","3d"),array("4f","5g","6h"),array("7e","8r","9t"));
	//$obj->generar($cabeceras,$filas);
	//require "procesos.php";
	//$acceso=conexion();
	//$obj->generar_con_sql($acceso,"select *from calle");
	$obj->generarArray($filas);
	
class generarExcel
{
	private $cabeceras;
	private $filas;

	function __construct()
	{
	}
	public function generarArray($filas)
	{

error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once '../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$colum=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ");

for($i=0;$i<count($filas);$i++){
			//echo "<br>";
			$col=$filas[$i];
			for($j=0;$j<count($col);$j++){
				//echo $colum[$j].($i+1).$col[$j].":";
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[$j].($i+1), $col[$j]);
				
            
			}
		}
		
		

$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

}
}
