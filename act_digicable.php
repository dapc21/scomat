<?php

require_once "procesos.php"; $ini_u = "YY"; 
	
	//$database='saeco_uni_act';

	
	//$acceso=conectar("Postgres",'192.168.10.20','postgres','digicable123456!','saeco');
	
	$acceso=conectar("Postgres",'192.168.10.20','postgres','digicable123456!','saeco');
	$cable=conectar("Postgres",'192.168.10.20','postgres','digicable123456!','saeco');
	$cable1=conectar("Postgres",'192.168.10.20','postgres','digicable123456!','saeco');
	
	//XB00008
	
	echo "<table border='1' cellpadding='0' cellspacing='0' >
	<tr><td> # </td><td>MES</td><td>CONTRATO</td><td>ID INTERNO</td><td>SUSCRITO</td><td>DEUDA + PAGADO</td><td>DEUDA</td><td>PAGADO</td><td>PAGOS ADELANTADOS</td><td>ORDENES</td></tr>";
	
	
	//$dato=lectura($acceso,"select id_contrato,nro_contrato,fecha_contrato,OBSERVACION from contrato where status_contrato='ACTIVO' and id_g_a<>'AB001' and observacion not ilike 'SE LE CARGO%' order by nro_contrato limit 1000000");
	
	$dato=lectura($acceso,"select id_contrato,nro_contrato,fecha_contrato,OBSERVACION from contrato where  id_g_a<>'AB001' and observacion ilike 'SE LE CARGO%' order by nro_contrato limit 1000000");
		
		$contador=1;
		
		for($i=0;$i<count($dato);$i++){
			$entro=false;
			$fecha_inst='2014-08-01';
			$fecha_hasta='2014-08-31';
		
			$fecha_contrato=trim($dato[$i]['fecha_contrato']);
			
			//echo "$fecha_contrato, 2014-08-01";
			if(comparaFecha($fecha_contrato,"2014-08-01")<=0){
			
			
				$id_contrato=trim($dato[$i]['id_contrato']);
				$nro_contrato=trim($dato[$i]['nro_contrato']);
				$cable->objeto->ejecutarSql("SELECT  contrato_servicio.id_serv FROM contrato_servicio,servicios WHERE contrato_servicio.id_serv=servicios.id_serv AND id_contrato='$id_contrato' ");
				$costo_suscrito=0;
				while($row=row($cable)){
					$id_serv=trim($row['id_serv']);
					$costo_suscrito+=verTarifa($acceso,$fecha_inst,$id_serv);
				}
				
				$acceso->objeto->ejecutarSql("SELECT  sum(costo_cobro) as costo_cobro FROM contrato_servicio_deuda,servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv AND id_contrato='$id_contrato'  and fecha_inst='$fecha_inst' and tipo_costo='COSTO MENSUAL' "); 
				if($row=row($acceso)){
					$deuda=trim($row['costo_cobro'])+0;
				}
				$acceso->objeto->ejecutarSql("SELECT  sum(costo_cobro) as costo_cobro FROM contrato_servicio_pagado,servicios WHERE contrato_servicio_pagado.id_serv=servicios.id_serv AND id_contrato='$id_contrato'  and fecha_inst='$fecha_inst' and tipo_costo='COSTO MENSUAL' "); 
				if($row=row($acceso)){
					$pagado=trim($row['costo_cobro'])+0;
				}
				
				$pagos_ade=0;
				$acceso->objeto->ejecutarSql("SELECT  monto FROM clie WHERE  nro_contrato='$nro_contrato'"); 
				if($row=row($acceso)){
					$pagos_ade=trim($row['monto'])+0;
				}
				/*
				$cable->objeto->ejecutarSql("SELECT  nombre_det_orden, fecha_final FROM ordenes_tecnicos,detalle_orden WHERE  ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden and  id_contrato='$id_contrato'  and fecha_final between '$fecha_inst' and '$fecha_hasta' order by fecha_final"); 
				$orden='.';
				while($row=row($cable)){
					$nombre_det_orden=trim($row['nombre_det_orden']);
					$fecha_final=formatofecha(trim($row['fecha_final']));
					$orden=$orden."$fecha_final : $nombre_det_orden :";
				}
				*/
				$cable->objeto->ejecutarSql("SELECT  nombre_det_orden, fecha_final FROM ordenes_tecnicos,detalle_orden WHERE  ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden and  id_contrato='$id_contrato' and (detalle_orden.id_det_orden='DEO00010')  order by fecha_final desc "); 
				$orden='.';
				if($row=row($cable)){
					$nombre_det_orden=trim($row['nombre_det_orden']);
					$fecha_final=formatofecha(trim($row['fecha_final']));
					$orden=$orden."$fecha_final : $nombre_det_orden :";
				}
				
				$cable->objeto->ejecutarSql("SELECT  nombre_det_orden, fecha_final FROM ordenes_tecnicos,detalle_orden WHERE  ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden and  id_contrato='$id_contrato' and (detalle_orden.id_det_orden='DEO00003' )  order by fecha_final desc "); 
				
				if($row=row($cable)){
					$nombre_det_orden=trim($row['nombre_det_orden']);
					$fecha_final=formatofecha(trim($row['fecha_final']));
					$orden=$orden."$fecha_final : $nombre_det_orden :";
				}
				
				
				$deuda_pagado=$deuda+$pagado;
			//	echo "<br>$costo_suscrito : $deuda_pagado ";
				if($costo_suscrito!=$deuda_pagado){
					//echo "<td>$nro_contrato<td> $costo_suscrito : $deuda_pagado ";
				//	echo "<tr><td> $contador </td><td> AGOSTO </td><td>$nro_contrato</td><td>$id_contrato</td><td>$costo_suscrito</td><td>$deuda_pagado</td><td>$deuda</td><td>$pagado</td><td>$pagos_ade</td><td>$orden</td></tr>";
					$entro=true;
					
				}
			
			
			}
			////////////////////////////////////////////////////
			
			if(comparaFecha($fecha_contrato,"2014-09-01")<=0){
				$fecha_inst='2014-09-01';
				$fecha_hasta='2014-09-30';
			
				$id_contrato=trim($dato[$i]['id_contrato']);
				$nro_contrato=trim($dato[$i]['nro_contrato']);
				$cable->objeto->ejecutarSql("SELECT  contrato_servicio.id_serv FROM contrato_servicio,servicios WHERE contrato_servicio.id_serv=servicios.id_serv AND id_contrato='$id_contrato' ");
				$costo_suscrito=0;
				while($row=row($cable)){
					$id_serv=trim($row['id_serv']);
					$costo_suscrito+=verTarifa($acceso,$fecha_inst,$id_serv);
				}
				
				$acceso->objeto->ejecutarSql("SELECT  sum(costo_cobro) as costo_cobro FROM contrato_servicio_deuda,servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv AND id_contrato='$id_contrato'  and fecha_inst='$fecha_inst' and tipo_costo='COSTO MENSUAL' "); 
				if($row=row($acceso)){
					$deuda=trim($row['costo_cobro'])+0;
				}
				$acceso->objeto->ejecutarSql("SELECT  sum(costo_cobro) as costo_cobro FROM contrato_servicio_pagado,servicios WHERE contrato_servicio_pagado.id_serv=servicios.id_serv AND id_contrato='$id_contrato'  and fecha_inst='$fecha_inst' and tipo_costo='COSTO MENSUAL' "); 
				if($row=row($acceso)){
					$pagado=trim($row['costo_cobro'])+0;
				}
				
				$pagos_ade=0;
				$acceso->objeto->ejecutarSql("SELECT  monto FROM clie WHERE  nro_contrato='$nro_contrato'"); 
				if($row=row($acceso)){
					$pagos_ade=trim($row['monto'])+0;
				}
				
				$cable->objeto->ejecutarSql("SELECT  nombre_det_orden, fecha_final FROM ordenes_tecnicos,detalle_orden WHERE  ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden and  id_contrato='$id_contrato'  and fecha_final between '$fecha_inst' and '$fecha_hasta' order by fecha_final"); 
				$orden='';
				while($row=row($cable)){
					$nombre_det_orden=trim($row['nombre_det_orden']);
					$fecha_final=formatofecha(trim($row['fecha_final']));
					$orden=$orden."$fecha_final : $nombre_det_orden :";
				}
				$cable->objeto->ejecutarSql("SELECT  nombre_det_orden, fecha_final FROM ordenes_tecnicos,detalle_orden WHERE  ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden and  id_contrato='$id_contrato' and (detalle_orden.id_det_orden='DEO00003' or detalle_orden.id_det_orden='DEO00010')  order by fecha_final desc "); 
				$orden='';
				if($row=row($cable)){
					$nombre_det_orden=trim($row['nombre_det_orden']);
					$fecha_final=formatofecha(trim($row['fecha_final']));
					$orden=$orden."$fecha_final : $nombre_det_orden :";
				}
				
				$deuda_pagado=$deuda+$pagado;
			//	echo "<br>$costo_suscrito : $deuda_pagado ";
				if($costo_suscrito!=$deuda_pagado){
					//echo "<td>$nro_contrato<td> $costo_suscrito : $deuda_pagado ";
				//	echo "<tr><td> $contador </td><td> SEPTIEMBRE </td><td>$nro_contrato</td><td>$id_contrato</td><td>$costo_suscrito</td><td>$deuda_pagado</td><td>$deuda</td><td>$pagado</td><td>$pagos_ade</td><td>$orden</td></tr>";
					$entro=true;
				}
			
			
			
			}
			
			
			/////////////////////////////////////////////////////
			
			if(comparaFecha($fecha_contrato,"2014-10-01")<=0){
			
			
				$fecha_inst='2014-10-01';
				$fecha_hasta='2014-10-31';
			
				$id_contrato=trim($dato[$i]['id_contrato']);
				$nro_contrato=trim($dato[$i]['nro_contrato']);
				$cable->objeto->ejecutarSql("SELECT  contrato_servicio.id_serv FROM contrato_servicio,servicios WHERE contrato_servicio.id_serv=servicios.id_serv AND id_contrato='$id_contrato' ");
				$costo_suscrito=0;
				while($row=row($cable)){
					$id_serv=trim($row['id_serv']);
					$costo_suscrito+=verTarifa($acceso,$fecha_inst,$id_serv);
				}
				
				$acceso->objeto->ejecutarSql("SELECT  sum(costo_cobro) as costo_cobro FROM contrato_servicio_deuda,servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv AND id_contrato='$id_contrato'  and fecha_inst='$fecha_inst' and tipo_costo='COSTO MENSUAL' "); 
				if($row=row($acceso)){
					$deuda=trim($row['costo_cobro'])+0;
				}
				$acceso->objeto->ejecutarSql("SELECT  sum(costo_cobro) as costo_cobro FROM contrato_servicio_pagado,servicios WHERE contrato_servicio_pagado.id_serv=servicios.id_serv AND id_contrato='$id_contrato'  and fecha_inst='$fecha_inst' and tipo_costo='COSTO MENSUAL' "); 
				if($row=row($acceso)){
					$pagado=trim($row['costo_cobro'])+0;
				}
				
				$pagos_ade=0;
				$acceso->objeto->ejecutarSql("SELECT  monto FROM clie WHERE  nro_contrato='$nro_contrato'"); 
				if($row=row($acceso)){
					$pagos_ade=trim($row['monto'])+0;
				}
				
				$cable->objeto->ejecutarSql("SELECT  nombre_det_orden, fecha_final FROM ordenes_tecnicos,detalle_orden WHERE  ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden and  id_contrato='$id_contrato'  and fecha_final between '$fecha_inst' and '$fecha_hasta' order by fecha_final"); 
				$orden='';
				while($row=row($cable)){
					$nombre_det_orden=trim($row['nombre_det_orden']);
					$fecha_final=formatofecha(trim($row['fecha_final']));
					$orden=$orden."$fecha_final : $nombre_det_orden :";
				}
				
				$cable->objeto->ejecutarSql("SELECT  nombre_det_orden, fecha_final FROM ordenes_tecnicos,detalle_orden WHERE  ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden and  id_contrato='$id_contrato' and (detalle_orden.id_det_orden='DEO00003' or detalle_orden.id_det_orden='DEO00010')  order by fecha_final desc "); 
				$orden='';
				if($row=row($cable)){
					$nombre_det_orden=trim($row['nombre_det_orden']);
					$fecha_final=formatofecha(trim($row['fecha_final']));
					$orden=$orden."$fecha_final : $nombre_det_orden :";
				}
				
				$deuda_pagado=$deuda+$pagado;
			//	echo "<br>$costo_suscrito : $deuda_pagado ";
				if($costo_suscrito!=$deuda_pagado){
					//echo "<td>$nro_contrato<td> $costo_suscrito : $deuda_pagado ";
				//	echo "<tr><td> $contador </td><td> OCTUBRE </td><td>$nro_contrato</td><td>$id_contrato</td><td>$costo_suscrito</td><td>$deuda_pagado</td><td>$deuda</td><td>$pagado</td><td>$pagos_ade</td><td>$orden</td></tr>";
					
					$entro=true;
				}
				
			}
			
			
			if($entro==true){
				$contador++;
			}else{
					
				
				$acceso->objeto->ejecutarSql("SELECT  sum(costo_cobro) as costo_cobro FROM contrato_servicio_pagado,servicios WHERE contrato_servicio_pagado.id_serv=servicios.id_serv AND id_contrato='$id_contrato'  and fecha_inst>='2014-09-01' and tipo_costo='COSTO MENSUAL' "); 
				$pagado1=0;
				if($row=row($acceso)){
					$pagado1=trim($row['costo_cobro'])+0;
				}
				if($pagado1>0){
					$contador++;
					echo "<tr><td> $contador </td><td> OCTUBRE </td><td>$nro_contrato</td><td>$id_contrato</td><td>$costo_suscrito</td><td>$deuda_pagado</td><td>$deuda</td><td>$pagado</td><td>$pagado1</td><td>$orden</td></tr>";
				}
				//$acceso->objeto->ejecutarSql("update contrato set id_g_a='AB001' where id_contrato='$id_contrato'");
			}	
		}
		echo "</table>";

?>