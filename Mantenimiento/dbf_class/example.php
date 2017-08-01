<?php
// Test CVS

require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/

$data->read('SUSCRIPT.xls');

/*
 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan']         
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/
require_once("DataBase/Acceso.php");
//error_reporting(E_ALL ^ E_NOTICE);ell
//echo "\"".$data->sheets[0]['cs'][2][2]."\",";

for ($i = 2; $i <= 863; $i++) {
	echo "insert into contrato(apellido, nombre, con, iden, pto, sector, manzana, calle, casa, poste, pto1, taps, sta, cedula, telefono, cortes, reconexi, activacion, ago, sep, oct, nov, dic, ene) values (";
	echo "'".$data->sheets[0]['cells'][$i][1]."'";
	for ($j = 2; $j <= 24; $j++) {
		//if(strlen($data->sheets[0]['cells'][$i][$j])>50){
		
		echo ",'".$data->sheets[0]['cells'][$i][$j]."'";
		//}
	}
	echo ");<br><br>";

}


//print_r($data);
//print_r($data->formatRecords);
?>
