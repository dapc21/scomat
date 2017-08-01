<?php
//session_start();

require_once("../DataBase/Acceso.php");
$acceso=conexion();

require_once('../../include/PHPExcel/Classes/PHPExcel.php');
require_once('../../include/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php');
$archivoExcel=$_GET['excel'];
//$archivoExcel="formatoRegistro.xlsx";
$rutaExcel="../archivo_sms_excel/listadosms.xlsx";
/** Clases necesarias */
$columnas = array('A','B','C','D','E','F','G','H');
$dato = array();

	//require_once "../procesos.php";
	
	// Cargando la hoja de cálculo
	if (file_exists($rutaExcel)){
	
	//require_once "../procesos.php";
	
	// Cargando la hoja de cálculo
	$acceso->objeto->ejecutarSql("delete from sms_excel;");	
	$objReader = new PHPExcel_Reader_Excel2007();
	$objPHPExcel = $objReader->load($rutaExcel);
	$cont=0;
	for($i=2;$i<100000;$i++)
	{
			$suma="";
			
	session_start();
	$ini_u = $_SESSION["ini_u"];  
	$acceso->objeto->ejecutarSql("select ids from sms_excel  where (ids ILIKE '$ini_u%')   ORDER BY ids desc LIMIT 1 offset 0 ");
	$ids=$ini_u.verCoo($acceso,"ids");

			$sql="insert into sms_excel(ids,tel,ced,nom,ape,c1,c2,c3,c4) values ('$ids',";
			
			$campo=trim($objPHPExcel->getActiveSheet()->getCell("$columnas[0]$i")->getValue());
				$sql=$sql."'".$campo."'";
				$suma=$suma.$campo;
				
			for($j=1;$j<count($columnas);$j++)
			{
				//$fila[$j]=trim($objPHPExcel->getActiveSheet()->getCell("$columnas[$j]$i")->getValue());
				$campo=trim($objPHPExcel->getActiveSheet()->getCell("$columnas[$j]$i")->getValue());
				$sql=$sql.",'".$campo."'";
				$suma=$suma.$campo;
			}
			
		if($suma==""){
			break;
		}
		else{
			$sql=$sql.");";
			$acceso->objeto->ejecutarSql($sql);		
			//echo "<br>$sql";
		}
	}
	
	include "listado_sms_excel.php";
	
}else{
echo '<div class="error"><br>ERROR, DEBE CARGAR UN ARCHIVO EXCEL CON EL LISTADO DE NUMEROS</div>';			
}
  
?>
