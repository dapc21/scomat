<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 

$dato=lectura($acceso,"select contrato_servicio_deuda.id_contrato,contrato_servicio_deuda.id_cont_serv,vista_contrato.nro_contrato from vista_contrato, contrato_servicio_deuda where vista_contrato.id_zona='ZON00004' and contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato and contrato_servicio_deuda.fecha_inst='2010-12-01' and contrato_servicio_deuda.status_con_ser='DEUDA' and id_serv='SER00001'");
		for($i=0;$i<count($dato);$i++)
		{
			echo "<br>$i: ".trim($dato[$i]['nro_contrato']);
				$id_cont_serv=trim($dato[$i]['id_cont_serv']);
				$id_contrato=trim($dato[$i]['id_contrato']);
				$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set costo_cobro=costo_cobro-10 Where id_cont_serv='$id_cont_serv'");	
				actualizarDeuda($acceso,$id_contrato);
		}
?>