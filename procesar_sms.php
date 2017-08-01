<?php
	require_once "procesos.php"; $ini_u = "JK"; 
				$acceso->objeto->ejecutarSql("insert into sms (mensaje_sms,hora_sms) values('hola','now();');");
?>	