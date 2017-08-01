<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
		$login=$_SESSION["login"];
		$fec=date("Y-02-01");
		$tarifa= array();
		$acceso->objeto->ejecutarSql("select *from mensualidad where fecha_mens='$fec'"); 
		  if(!row($acceso)){
			$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
		//	$id_cont_serv=$ini_u.verCodLong($acceso,"id_cont_serv");
		$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
			
					$dato=lectura($acceso,"select id_serv from servicios where tipo_costo='COSTO MENSUAL'");
					for($i=0;$i<count($dato);$i++){
						$id_serv=trim($dato[$i]['id_serv']);
						$acceso->objeto->ejecutarSql("select tarifa_ser from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'  LIMIT 1 offset 0 "); 
						$row=row($acceso);
						$tarifa_ser=trim($row['tarifa_ser']);
						$tarifa[trim($dato[$i]['id_serv'])]=$tarifa_ser;
					}

		    $contra=lectura($acceso,"select id_contrato from contrato where status_contrato='ACTIVO' and (select count(*) from servicios,contrato_servicio where contrato_servicio.id_serv=servicios.id_serv and contrato_servicio.id_contrato=contrato.id_contrato and contrato_servicio.fecha_inst='$fec' and servicios.tipo_costo='COSTO MENSUAL')='0' order by nro_contrato");
			for($j=0;$j<count($contra);$j++){

				$id_contrato=trim($contra[$j]['id_contrato']);
					$dato=lectura($acceso,"select id_serv,cant_serv from contrato_servicio where id_contrato='$id_contrato' and status_con_ser='CONTRATO'");
					for($i=0;$i<count($dato);$i++){
						$id_serv=trim($dato[$i]['id_serv']);
						$cant_serv=trim($dato[$i]['cant_serv']);
						$fecha=$fec;
						
						$tarifa_ser=$tarifa[$id_serv];
						
						echo "<br>$j:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser')";
						//$acceso->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser')");
						$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
					}
			}
			
				
				$acceso->objeto->ejecutarSql("select id_mensualidad from mesualidad  where (id_mensualidad ILIKE '$ini_u%') ORDER BY id_mensualidad desc  LIMIT 1 offset 0 "); 
				$id_mensualidad=$ini_u.verCo($acceso,"id_mensualidad");
							
				echo "<br>insert into mensualidad(id_mensualidad,login,fecha_mens,generada) values ('$id_mensualidad','$login','$fec','AUTOMATICO')";
			//	$acceso->objeto->ejecutarSql("insert into mensualidad(id_mensualidad,login,fecha_mens,generada) values ('$id_mensualidad','$login','$fec','AUTOMATICO')");
		  }
?>