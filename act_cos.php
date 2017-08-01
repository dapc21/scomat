<?php

require_once "procesos.php"; $ini_u = "YY"; 
		$acceso=conectar("Postgres",'localhost','postgres','123456','saeco_cablehogar');
		$cable1=conectar("Postgres",'localhost','postgres','123456','saeco_cablehogar');
		/*
		$acceso->objeto->ejecutarSql("UPDATE CONTRATO set costo_dif_men='1';");
		$cable1->objeto->ejecutarSql("UPDATE CONTRATO set costo_dif_men='1';");
			*/
			/*
		$dato=lectura($acceso,"select id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and costo_dif_men=1 ORDER by nombre_franq,status_contrato,fecha_contrato limit 100000000");
		
		for($i=0;$i<count($dato);$i=$i+3){
			$id_contrato=trim($dato[$i]['id_contrato']);
			$acceso->objeto->ejecutarSql("update  contrato set costo_dif_men=0 where id_contrato='$id_contrato'");
		}
		
		/*
		$dato=lectura($acceso,"select id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and costo_dif_men=0 ORDER by nombre_franq,status_contrato,fecha_contrato limit 100000000");
		
		for($i=0;$i<count($dato);$i=$i+9)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			//echo "<br>update  contrato set costo_dif_men=0 where id_contrato='$id_contrato';";
			$acceso->objeto->ejecutarSql("update  contrato set costo_dif_men=1 where id_contrato='$id_contrato'");
			
		}
		*/
?>		