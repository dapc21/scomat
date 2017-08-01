<?php

require_once "procesos.php"; $ini_u = "YY"; 
	
	//$database='saeco_uni_act';

	/*
	$acceso=conectar("Postgres",'localhost','postgres','123456','copia_unicable_final');
	$cable2=conectar("Postgres",'localhost','postgres','123456','copia_unicable_final');
	$cable=conectar("Postgres",'localhost','postgres','123456','copia_unicable_final');
	
	*/
	
	$acceso=conexion();
	$cable=conexion();
	$cable1=conexion();
	
	//XB00008
	
	
	$dato=lectura($acceso,"select id_contrato from contrato limit 100000");
		
		for($i=0;$i<count($dato);$i++){
			$id_contrato=trim($dato[$i]['id_contrato']);
			combinar_cargos($acceso,$id_contrato);
		}
	
?>