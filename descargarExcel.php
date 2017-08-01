<?php
	require_once 'generaExcel.php';
	$obj=new generarExcel();
	
	require "procesos.php";
	$acceso=conexion();
	$sql = $_GET['sql'];
	//ECHO $_GET['sql'];
	$valor=explode("@@",$_GET['sql']);
	$sql=$valor[0];
	//echo $valor[0];
	$hea=explode(";",$valor[1]);
	$head=array();
	$num=count($hea)-1;
	for($j=0;$j<$num;$j=$j+2){
		$head[ $hea[$j]] = $hea[$j+1];
		echo $hea[$j+1].":";
	}
	
	//echo implode(";",$head);

	$sql=str_replace("=@","%",$sql);
	$sql=str_replace("|","'",$sql);
	
	echo "<BR>".$sql;
	
	$obj->generar_con_sql($acceso,$sql,$head);

?>