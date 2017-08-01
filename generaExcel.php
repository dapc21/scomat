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
	public function generar($cabeceras,$filas)
	{
		
		$this->cabeceras = $cabeceras;
		$this->filas = $filas;
		
		error_reporting(E_ALL);

date_default_timezone_set('Europe/London');


require_once 'include/PHPExcel/Classes/PHPExcel.php';


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


// Add some data
$colum=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Hello');
		
		for($i=0;$i<count($this->cabeceras);$i++){
			//$worksheet->write(0, $i, 'Code',$format_header);
			//echo "<br>$colum[$i].'1', $this->cabeceras[$i]";
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[$i].'1', $this->cabeceras[$i]);
		}

		
		for($i=0;$i<count($this->filas);$i++){
			$col=$this->filas[$i];
			for($j=0;$j<count($col);$j++){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[$j].($i+2), $col[$j]);
			}
		}
		

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

	}
	
	public function generarArray($filas)
	{

error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'include/PHPExcel/Classes/PHPExcel.php';


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


	public function generar_con_sql($acceso,$sql,$header)
	{
		error_reporting(E_ALL);

		date_default_timezone_set('Europe/London');


		require_once 'include/PHPExcel/Classes/PHPExcel.php';


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


		$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(15);

		// Add some data
		$colum=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ");
		
		$acceso->objeto->ejecutarSql($sql);
		
		$num=$acceso->objeto->num_fields();
		for($j=0;$j<$num;$j++)
		{
			
			$meta = trim($acceso->objeto->fetch_field($j));
			//$head = $header[$meta];
			//echo "$head;";
			if (array_key_exists($meta, $header)){
				$head = $header[$meta];
				//echo "entro";
			}else
				$head = $meta;
				
			//echo "$head;";
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[$j].'1', strtoupper($head));
		//	$worksheet->setColumn(0, $j, 20);
		}
		
		
		

		
		$i=0;
		$acceso->objeto->ejecutarSql($sql);
		while($row=row($acceso)){
			$col=$row;
			for($j=0;$j<count($col)/2;$j++){
				//$worksheet->writeString($i+1, $j, $col[$j], $format_row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum[$j].($i+2), $col[$j]);
			}
			
			$i++;
		}
	

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Simple');


		$objPHPExcel->setActiveSheetIndex(0);


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="01simple.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}

	}
?>