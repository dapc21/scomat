<?php
//echo '<h1>CAUTION: This code should not be used in a production environment.</h1>';
if (isset($_POST['dir'])){
    $dir=$_POST['dir'];
} elseif (isset($_GET['dir'])) {
    $dir=$_GET['dir'];
} else {
    $dir = "./";
}

if($dir == "./"){
echo '<form method="post">';
echo '<table border="2">';

echo '<tr><td>Directory</td><td><input type="text" size="50" name="dir" value="'.$dir.'"></td></tr>';





echo '<tr><td>&nbsp;</td><td><input type="submit" name="doit" value="Show file"></td></tr>';
echo '</table>';
echo '</form>';
}

if($_GET['f']){
    $thefile=$_GET['f'];
} elseif ($_POST['f']) {
    $thefile=$_POST['f'];
}
if($dir){
	require_once("DataBase/Acceso.php");
//	$acceso=conexion();
	
	$acceso=conectar("Postgres",'localhost','postgres','123456','datos_zulcable');
	$cable=conectar("Postgres",'localhost','postgres','123456','saeco_zulcables');
	$cable1=conectar("Postgres",'localhost','postgres','123456','saeco_zulcables');
	$consul=conectar("Postgres",'localhost','postgres','123456','datos_zulcable');
	
	//guardar_en_base_datos($dir,$consul);

	
	//restaurar_ubi($acceso,$cable,$consul);
	//pasar_a_nueva_bd($consul,$cable,$consul);
	//pasar_pagos($cable1,$cable,$consul);
	restaurar_ordenes($cable1,$cable,$consul);
}
function restaurar_ubi($acceso,$cable,$consul){
	echo "entro";
	require_once "procesos.php"; $ini_u = "AA"; 
	//$tablas=array('zona','sector','calle');
	$tablas=array('sector');
	/*
	for($i=0;$i<count($tablas);$i++){
		$table=$tablas[$i];
		
		*/
		$i=0;
		$table='calle';
		$acceso->objeto->ejecutarSql("SELECT DISTINCT urba,calle FROM clie order by urba,calle;");
		while($row=row($acceso)){
		/*	if(=="zona"){
				$cable->objeto->ejecutarSql("select *from zona  where (id_zona ILIKE '%ZON%') ORDER BY id_zona desc"); 
				$id_zona="ZON".verCo($cable,"id_zona");
				
				
								$cable->objeto->ejecutarSql("select id_zona from zona ORDER BY id_zona desc LIMIT 1 offset 0 "); 
								$nro_zona=verNumero($cable,"id_zona");
								
				$n_zona=trim($row['codigoz']);
				$nombre_zona=trim($row['nombre']);
				$cable->objeto->ejecutarSql("insert into zona(id_zona,nro_zona,id_franq,nombre_zona,n_zona) values ('$id_zona','$nro_zona','1','$nombre_zona','$n_zona')");
				echo "<br>insert into zona(id_zona,nro_zona,id_franq,nombre_zona,n_zona) values ('$id_zona','$nro_zona','1','$nombre_zona','$n_zona')";
			}
			else
			*/
			/*
			if($table=="sector"){
				
				$cable->objeto->ejecutarSql("select *from sector  where (id_sector ILIKE '%SEC%') ORDER BY id_sector desc"); 
				$id_sector="SEC".verCo($cable,"id_sector");
				
				$cable->objeto->ejecutarSql("select id_sector from sector ORDER BY id_sector desc LIMIT 1 offset 0 "); 
				$nro_sector=verNumero($cable,"id_sector");
								
				$n_sector='';
				$valor=explode("-",$n_sector);
				$nro_zona=trim($valor[0]);
				$urba=trim($row['urba']);
				//	echo "<br>$urba";
				//echo ":$nro_zona:";
				$cable->objeto->ejecutarSql("select *from sector where nombre_sector='$urba'");
				if(!$fila=$cable->objeto->devolverRegistro()){
					$id_zona='ZON00000';
					$nombre_sector=trim($row['urba']);
						$cable->objeto->ejecutarSql("insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector','$n_sector')");
						echo "<br>insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector','$n_sector')";
				}
				else{
					echo "<br>$urba";
				}
			}
			*/
			/*
			
		if($table=="sector"){
				echo "h";
				$cable->objeto->ejecutarSql("select *from sector  where (id_sector ILIKE '%SEC%') ORDER BY id_sector desc"); 
				$id_sector="SEC".verCo($cable,"id_sector");
				
				$cable->objeto->ejecutarSql("select id_sector from sector ORDER BY id_sector desc LIMIT 1 offset 0 "); 
				$nro_sector=verNumero($cable,"id_sector");
								
				$n_sector=trim($row['codigos']);
				$valor=explode("-",$n_sector);
				$nro_zona=trim($valor[0]);
				
				//echo ":$nro_zona:";
				$cable->objeto->ejecutarSql("select *from zona where n_zona='$nro_zona'");
				if($fila=$cable->objeto->devolverRegistro()){
					$id_zona=trim($fila['id_zona']);;
					//$id_zona='ZON00001';
					$nombre_sector=trim($row['nombre']);
						$cable->objeto->ejecutarSql("insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector','$n_sector')");
						echo "<br>insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector','$n_sector')";
				}
			}
			*/
			/*
			else 
			*/
			
			if($table=="calle"){
				$cable->objeto->ejecutarSql("select *from calle  where (id_calle ILIKE 'CA%') ORDER BY id_calle desc"); 
				$id_calle="CA".verCodlong($cable,"id_calle");
				
				$cable->objeto->ejecutarSql("select id_calle from calle ORDER BY id_calle desc LIMIT 1 offset 0 "); 
				$nro_calle=verNumero($cable,"id_calle");
									
				$n_calle='';
				$nombre_calle=trim($row['calle']);
				$urba=trim($row['urba']);
				
			//	$valor=explode("-",$n_calle);
			//	$nro_sector=trim($valor[0])."-".trim($valor[1]);
				
				//echo "<br>select *from sector where n_sector='$nro_sector'";
				$cable->objeto->ejecutarSql("select *from sector where nombre_sector='$urba'"); 
				if($fila=$cable->objeto->devolverRegistro()){
					$id_sector=trim($fila['id_sector']);
					$cable->objeto->ejecutarSql("insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$n_calle')");
					echo "<br>$i:insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$n_calle'))";
					$i++;
				}
			}
			
			
		}
	//}
	
	/*
	//restauro calle directamente de CLIE
	$acceso->objeto->ejecutarSql("select DISTINCT urba,calle from clie");
		while($row=row($acceso)){
			
				$cable->objeto->ejecutarSql("select *from calle  where (id_calle ILIKE '$ini_u%') ORDER BY id_calle desc"); 
				$id_calle=$ini_u.verCodlong($cable,"id_calle");
				
				$cable->objeto->ejecutarSql("select id_calle from calle ORDER BY id_calle desc LIMIT 1 offset 0 "); 
				$nro_calle=verNumero($cable,"id_calle");
									
				$urba=trim($row['urba']);
				$nombre_calle=trim($row['calle']);
				
				//echo "<br>select *from sector where n_sector='$nro_sector'";
				$cable->objeto->ejecutarSql("select *from sector where nombre_sector='$urba'"); 
				if($fila=$cable->objeto->devolverRegistro()){
					$id_sector=trim($fila['id_sector']);
						
							$cable->objeto->ejecutarSql("insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$n_calle')");
							echo "<br>insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$n_calle'))";
						
				}
			
		}
	*/	
}

function restaurar_ordenes($acceso,$cable,$consul){
	require_once "procesos.php"; $ini_u = "AA"; 
		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato order by nro_contrato ");
		
		while($row=row($acceso)){
			
				$nro_contrato=trim($row['nro_contrato']);
				$id_contrato=trim($row['id_contrato']);
				
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$monto_pago=0;
					
						
					$consul->objeto->ejecutarSql("select tipo_orden,emitida,finalizada,comentario,concepto,coment1 from ordenes where contrato='$nro_contrato' order by emitida desc");
					while($fila=row($consul)){
						
							$tipo_orden=trim($fila['tipo_orden']);
							$emitida=trim($fila['emitida']);
							$finalizada=trim($fila['finalizada']);
							$comentario=trim($fila['comentario']);
							$concepto=trim($fila['concepto']);
							$coment1=trim($fila['coment1']);
							
							if($tipo_orden=="CORTE SERVICIO"){
								$id_det_orden='DEO00010';
							}
							else if($tipo_orden=="FALLA TECNICA"){
								
								if($concepto=="CABLE CAIDO"){
									$id_det_orden='DEO00006';
								}
								
								else if($concepto=="SIN SEÑAL"){
									$id_det_orden='DEO00009';
								}
								else{
									$id_det_orden='DEO00008';
								}
							}
							else if($tipo_orden=="INSTA. NUE."){
								$id_det_orden='DEO00001';
							}
							else if($tipo_orden=="PUNTOS ADICI."){
								$id_det_orden='DEO00002';
							}
							else if($tipo_orden=="RECONEXION"){
								$id_det_orden='DEO00003';
							}
							else if($tipo_orden=="SUSP/SERVI"){
								$id_det_orden='DEO00003';
							}
							else if($tipo_orden=="TRASLADO"){
								$id_det_orden='DEO00004';
							}
							else{
								$id_det_orden='DEO00008';
							}

							$id_persona="TEC00001";
							$cable->objeto->ejecutarSql("select *from ordenes_tecnicos ORDER BY id_orden desc LIMIT 1 offset 0 "); 
							$id_orden = verNumero($cable,"id_orden");		
							//echo "<br>insert into ordenes_tecnicos(id_orden,id_persona,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$id_persona','$id_det_orden','$emitida','$finalizada','$concepto','$comentario','FINALIZADA','$id_contrato','NORMAL')";
							if(!$cable->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$id_det_orden','$emitida','$finalizada','$concepto','$comentario','FINALIZADA','$id_contrato','NORMAL')")){
								echo "<br>$fallos:insert into ordenes_tecnicos(id_orden,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$id_det_orden','$emitida','$finalizada','$concepto','$comentario','FINALIZADA','$id_contrato','NORMAL')";
								echo $cable->objeto->error().'<br>';
							}
					}
			$fallos++;
		}
	//}
}

function pasar_pagos($acceso,$cable,$consul){
	require_once "procesos.php"; $ini_u = "AA"; 
	//$tablas=array('clie');

		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato order by nro_contrato LIMIT 50000 offset 0");
		$id_franq="1";
		$fallos=1;
		$f_z=1;
		$f_s=1;
		$f_c=1;
		$falla=array();
		//$acceso->objeto->seekRegistro(8737);
		while($row=row($acceso)){
				
				$nro_contrato=trim($row['nro_contrato']);
				$id_contrato=trim($row['id_contrato']);
				/*
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$registro=false;
					$monto_pago=0;
					$cable->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '%CA%')ORDER BY id_pago desc LIMIT 1 offset 0 "); 
					$id_pago = "CA".verCodLargo($cable,"id_pago");
					//echo "<br><br><br>$id_pago";	
						
					$consul->objeto->ejecutarSql("select recibo,pago,vencido,fec_cob,concepto1 from cuotas where contrato='$nro_contrato' and cancelado='SI' order by fec_cob,recibo desc");
					while($fila=row($consul)){
						
														
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$recibo=trim($fila['recibo']);
							$fec_cob=trim($fila['fec_cob']);
							$concepto1=trim($fila['concepto1']);
							if($rec!=$recibo){
								$registro=false;
								$cable->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '%CA%')ORDER BY id_pago desc LIMIT 1 offset 0 "); 
								$id_pago = "CA".verCodLargo($cable,"id_pago");
								$rec=trim($fila['recibo']);
							}
						  
						  if($rec==$recibo){
							
							$fecha_pago=$fec_cob;
							$monto_pago=$monto_pago+$costo_cobro;
							
							$id_serv="SER00001";
							
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							//echo "<br>$fallos:$nro_contrato:$fec_cob:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
							//echo "<br>insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,obser_detalle) values ('TPA00001','$id_pago','','','')";
							//echo "<br>insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')";
							$cable->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')");
							
							$co=true;
							
							if($registro==false){
									$id_caja_cob="AM00000001";
								
									$cable->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('TPA00001','$id_pago','','','$monto_pago')");
								
									$cable->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato')");
									$monto_pago=0;
									$registro=true;
							}
							
						  }
						  
					}
					
					
					
					$rec='';
					$co=false;
					$registro=false;
				//if($co==false){
					
					$consul->objeto->ejecutarSql("select recibo,pago,vencido,fec_cob,concepto1 from his_men where contrato='$nro_contrato' and cancelado='SI'  and pago<>0 order by vencido desc LIMIT 10 offset 0 ");
					while($fila=row($consul)){
						
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$recibo=trim($fila['recibo']);
							$fec_cob=trim($fila['fec_cob']);
							$concepto1=trim($fila['concepto1']);
							if($rec!=$recibo){
								$registro=false;
								$cable->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '%CA%')ORDER BY id_pago desc LIMIT 1 offset 0 "); 
								$id_pago = "CA".verCodLargo($cable,"id_pago");
								$rec=trim($fila['recibo']);
							}
						  
						  if($rec==$recibo){
							$fecha_pago=$fec_cob;
							
							$monto_pago=$monto_pago+$costo_cobro;
							//if($concepto1=='MENSUALIDAD'){
								$id_serv="SER00001";
							//}
							//if($concepto1=='RECONEXION'){
							//	$id_serv="SER00002";
							//}
							//else{
							//	$id_serv="SER00005";
							//}
							
							
							
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado   where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							//echo "<br>$fallos:$nro_contrato:$fec_cob:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
							//echo "<br>insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,obser_detalle) values ('TPA00001','$id_pago','','','')";
							//echo "<br>insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')";
							if(!$cable->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')")){
								echo "<br>$fallos:insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')";
								echo $cable->objeto->error().'<br>';
							}
							
								if($registro==false){
									$cable->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('TPA00001','$id_pago','','','$monto_pago')");

									$id_caja_cob="AM00000001";
									$cable->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato')");
									$monto_pago=0;
									$registro=true;
								}
						  }
						 
					}
				

			*/	


					$cant_serv=1;
					
					$rec='';
					$co=false;
					$registro=false;
					$monto_pago=0;
					
						
					$consul->objeto->ejecutarSql("select recibo,pago,vencido,fec_cob,concepto1 from cuotas where contrato='$nro_contrato' and cancelado='NO' order by fec_cob,recibo desc");
					while($fila=row($consul)){

							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$concepto1=trim($fila['concepto1']);
							
						  
						 	
							$fecha_pago=$fec_cob;
							//$monto_pago=$monto_pago+$costo_cobro;
							
							$id_serv="SER00001";
							
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							//echo "<br>$fallos:$nro_contrato:$fec_cob:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
						
					}
					
					
					
					
					
				//}
				/*
				if($co==true){
							$id_caja_cob="AB00000001";
							echo "<br>insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato) values ('$id_pago','$id_caja_cob','$fec_cob','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato')";
							$cable->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato')");
				}			
					*/
					/*
					$consul->objeto->ejecutarSql("select pago,vencido,fec_cob from his_men where contrato='$nro_contrato' and cancelado='SI' and concepto1='MENSUALIDAD' and  vencido between '2011-09-01' and '2012-11-01'");
					while($fila=row($consul)){
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$fec_cob=trim($fila['fec_cob']);
							$id_serv="SER00001";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio   where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
						
							//echo "<br>$fallos::$nro_contrato:$fec_cob:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
					}
					*/
			$fallos++;
		}
	//}
}
function pasar_a_nueva_bd($acceso,$cable,$consul){
	require_once "procesos.php"; $ini_u = "AA"; 
	//$tablas=array('clie');

	$num=count($tablas);

	$cable->objeto->ejecutarSql("select *from vista_vendedor"); 
	if($fila=$cable->objeto->devolverRegistro()){
		$id_vendedor=trim($fila['id_persona']);
	}
	else{
		$cable->objeto->ejecutarSql("select *from vendedor  where (id_persona ILIKE '%VEN%') ORDER BY id_persona desc"); 
		$id_vendedor = "VEN".verCo($acceso,"id_persona");
		$cable->objeto->ejecutarSql("insert into persona(id_persona) values ('$id_vendedor')");			
		$cable->objeto->ejecutarSql("insert into vendedor(id_persona) values ('$id_vendedor')");			
	}
	

		$table="clie";
		
		$acceso->objeto->ejecutarSql("select cedula,nombre,edif,telefo,telefo1,contrato,feccon,horsys,tagin,status,comenta,nrcasa,comenta,calle,zona,nom_zona,urba,puntos,monto from clie order by contrato");
		$id_franq="1";
		$fallos=1;
		$f_z=1;
		$f_s=1;
		$f_c=1;
		$falla=array();
		//$acceso->objeto->seekRegistro(8737);
		while($row=row($acceso)){
			if($table=="clie"){
				$nro_contrato=trim($row['contrato']);
				$nombre=trim($row['nombre']);
				
				/*
				//AGREGAR ZONA
				$nom_zona=trim($row['nom_zona']);
				$zona=trim($row['zona']);
				$consul->objeto->ejecutarSql("select  *from zona where nombre = '$nom_zona'"); 
				if($consul->objeto->devolverRegistro()){
						$cable->objeto->ejecutarSql("select id_zona from zona where nombre_zona = '$nom_zona'"); 
						if($fila=$cable->objeto->devolverRegistro()){
							$id_zona=trim($fila['id_zona']);
						}
						else{
								$cable->objeto->ejecutarSql("select id_zona from zona  where (id_zona ILIKE '%ZON%') ORDER BY id_zona desc LIMIT 1 offset 0 "); 
								$id_zona="ZON".verCo($cable,"id_zona");
								
								$cable->objeto->ejecutarSql("select id_zona from zona ORDER BY id_zona desc LIMIT 1 offset 0 "); 
								$nro_zona=verNumero($cable,"id_zona");
								
								if(!$cable->objeto->ejecutarSql("insert into zona(id_zona,nro_zona,id_franq,nombre_zona) values ('$id_zona','$nro_zona','$id_franq','$nom_zona')")){
									echo "<br>$fallos:insert into zona(id_zona,nro_zona,id_franq,nombre_zona) values ('$id_zona','$nro_zona','$id_franq','$nom_zona')<br>";
									echo $cable->objeto->error().'<br>';
								}
						}
						
					//AGREGAR SECTOR
						
					$consul->objeto->ejecutarSql("select  *from sector where nombre = '$nombre_sector'"); 
					if($consul->objeto->devolverRegistro())
					{
						$cable->objeto->ejecutarSql("select id_sector from sector where id_zona='$id_zona' and nombre_sector='$nombre_sector'"); 
						if($fila=$cable->objeto->devolverRegistro()){
							$id_sector=trim($fila['id_sector']);
						}
						else{
							/*
							$cable->objeto->ejecutarSql("select id_sector from sector where nombre_sector='$nombre_sector'"); 
							if($fila=$cable->objeto->devolverRegistro()){
								$id_sector=trim($fila['id_sector']);
							}
							else{
							*/
							/*
								$cable->objeto->ejecutarSql("select id_sector from sector  where (id_sector ILIKE '%SEC%') ORDER BY id_sector desc LIMIT 1 offset 0 "); 
								$id_sector="SEC".verCo($cable,"id_sector");
								$cable->objeto->ejecutarSql("select id_sector from sector ORDER BY id_sector desc LIMIT 1 offset 0 "); 
								$nro_sector=verNumero($cable,"id_sector");
								if(!$cable->objeto->ejecutarSql("insert into sector(id_sector,nro_sector,id_zona,nombre_sector) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector')")){
									echo "<br>$fallos:insert into sector(id_sector,nro_sector,id_zona,nombre_sector) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector')<br>";
									echo $cable->objeto->error().'<br>';
								}
							//}
						}
						
						//AGREGAR CALLE
						$nombre_calle=trim($row['calle']);
							
						$consul->objeto->ejecutarSql("select  *from calle where nombre = '$nombre_calle'"); 
						if($consul->objeto->devolverRegistro())
						{
							$cable->objeto->ejecutarSql("select id_calle from calle where id_sector='$id_sector' and  nombre_calle='$nombre_calle'"); 
							if($fila=$cable->objeto->devolverRegistro()){
								$id_calle=trim($fila['id_calle']);
							}
							else{
								/*
								$cable->objeto->ejecutarSql("select id_calle from calle where nombre_calle='$nombre_calle'"); 
								if($fila=$cable->objeto->devolverRegistro()){
									$id_calle=trim($fila['id_calle']);
								}
								else{
								*/
/*								$cable->objeto->ejecutarSql("select id_calle from calle  where (id_calle ILIKE '$ini_u%')  ORDER BY id_calle desc LIMIT 1 offset 0 "); 
									$id_calle=$ini_u.verCodlong($cable,"id_calle");
									$cable->objeto->ejecutarSql("select id_calle from calle ORDER BY id_calle desc LIMIT 1 offset 0 "); 
									$nro_calle=verNumero($cable,"id_calle");
									if(!$cable->objeto->ejecutarSql("insert into calle(id_calle,nro_calle,id_sector,nombre_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle')")){
										echo "<br>$fallos:insert into calle(id_calle,nro_calle,id_sector,nombre_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle')<br>";
										echo $cable->objeto->error().'<br>';
									}
								//}
							}
						}
						else{
							echo "<br>CALLE: $f_c : $nro_contrato : $nombre : $nombre_calle";
							$f_c++;
							$id_calle='CA00000000';
							$id_sector='SEC00000';
							$id_zona='ZON00000';
						}
					}
					else{
						echo "<br>SECTOR: $f_s : $nro_contrato : $nombre : $nombre_sector";
						$f_s++;
						$id_calle='CA00000000';
						$id_sector='SEC00000';
						$id_zona='ZON00000';
					}	
						
						
						
				}
				else{
					echo "<br>ZONA: $f_z : $nro_contrato : $nombre : $nom_zona";
					$f_z++;
					$id_calle='CA00000000';
					$id_sector='SEC00000';
					$id_zona='ZON00000';
				}
				*/
				
				$nombre_sector=trim($row['urba']);
					
				$nombre_calle=trim($row['calle']);
				
					$cable->objeto->ejecutarSql("select id_calle from vista_calle where nombre_sector='$nombre_sector' and nombre_calle='$nombre_calle'"); 
					if($fila=$cable->objeto->devolverRegistro()){
						$id_calle=trim($fila['id_calle']);
				}
							
							

				$cable->objeto->ejecutarSql("select id_persona from persona  where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc LIMIT 1 offset 0 "); 
				$id_persona = $ini_u.verCodLong($cable,"id_persona");
				
				
				$cedula=trim($row['cedula']);
				$cedula=str_replace(".","",$cedula);
				$cedula=str_replace(" ","",$cedula);
				
				$nombre=trim($row['nombre']);
				$nombre_o=trim($row['nombre']);
				
				$valor=explode(" ",$nombre);
				$pal_nom=count($valor);
				if($pal_nom==2){
					$apellido=trim($valor[0]);
					$nombre=trim($valor[1]);
				}
				else if($pal_nom==3){
					
					if(strlen($valor[1])<3){
						$apellido=trim($valor[0])." ".trim($valor[1]);
						$nombre=trim($valor[2]);
					}
					else{
						$apellido=trim($valor[0]);
						$nombre=trim($valor[1])." ".trim($valor[2]);
					}
					
				}
				else if($pal_nom==4){
				
					if(strlen($valor[1])<4 && strlen($valor[3])>2){
						$apellido=trim($valor[0])." ".trim($valor[1])." ".trim($valor[2]);
						$nombre=trim($valor[3]);
					}
					else if(strlen($valor[2])<4){
						$apellido=trim($valor[0]);
						$nombre=trim($valor[1])." ".trim($valor[2])." ".trim($valor[3]);
					}
					else{
						$apellido=trim($valor[0])." ".trim($valor[1]);
						$nombre=trim($valor[2])." ".trim($valor[3]);
					}

				}
				else if($pal_nom==5){
				
					if(strlen($valor[1])<4 && strlen($valor[3])>2){
						$apellido=trim($valor[0])." ".trim($valor[1])." ".trim($valor[2]);
						$nombre=trim($valor[3])." ".trim($valor[4]);
					}
					else{
						$apellido=trim($valor[0])." ".trim($valor[1]);
						$nombre=trim($valor[2])." ".trim($valor[3])." ".trim($valor[4]);
					}
				}
				else{
					$apellido=trim($valor[0])." ".trim($valor[1])." ".trim($valor[2]);
					$nombre='';
					for($ki=3;$ki<count($valor);$ki++){
						$nombre=$nombre.trim($valor[$ki])." ";
					}
				}
				
				//echo"<br><br>$nombre_o:<br>$apellido:$nombre";
				
				
				
				/*
				//$apellido=trim($row['codigocall']);

				$telf_adic=trim($row['edif']);
				if(strlen($telf_adic)>11){
					$telf_adic='';
				}
				$telefono=trim($row['telefo']);
				if(strlen($telefono)>11){
					$telefono='';
				}
				if(strstr($telefono,"-")){
					$valor=explode("-",$telefono);
					$telefono=$valor[0];
					$telf_casa=$valor[1];
				}
				else if(strstr($telefono,"/")){
					$valor=explode("/",$telefono);
					$telefono=$valor[0];
					$telf_casa=$valor[1];
				}
				
				else{
					$telf_casa=trim($row['telefo1']);	
				}
				
				*/
				
				
				$telf_casa='';
					$telefono='';
					$telf_adic='';
					
				
				
				$telefo=trim($row['telefo']);
				$telefo=str_replace("-","",$telefo);
				$telefo=str_replace(" ","",$telefo);
				
				if(strlen($telefo>11)){
					$telefo=substr($telefo , 0,11);;
					
				}
				
				
				$telefono_o=trim($row['telefo']);
				if(strlen($telefo)==6){
					$telf_casa=$telefo;
					$telefono='';
				}
				if(strlen($telefo)==7){
					$telf_casa=$telefo;
					$telefono='';
				}
				else if(strlen($telefo)==13){
					$valor=explode("-",$telefo);
					$telf_casa=$valor[0];
					$telf_adic=$valor[0];
					$telefono='';
				}
				else if(strlen($telefo)==11){
					$ini=substr($telefo , 0,2);
					if($ini=="04"){
						$telefono=$telefo;	
					}
					else if($ini=="02"){
						$telefono='';
						$telf_casa=$telefo;
					}
					
				}
				else if(strlen($telefo)==12){
					/*$telefo=str_replace("-","",$telefo);
					$ini=substr($telefo , 0,2);
					if($ini=="04"){
						$telefono=$telefo;	
					}
					else if($ini=="02"){
						$telefono='';
						$telf_casa=$telefo;
					}
					*/
					//echo "a";
					
				}
				
				
				
				$ini=substr($telefo , 0,3);
				if($ini=="014"){
						$telefono=str_replace("014","0414",$telefo);
				}
				
				$ini=substr($telefo , 0,3);
					if($ini=="416" && strlen($telefo)==12){
							$telefono=str_replace("416","0416",$telefo);
					}
					if($ini=="426" ){
							$telefono=str_replace("426","0426",$telefo);
					}
					if($ini=="426" ){
							$telefono=str_replace("426","0426",$telefo);
					}
					if($ini=="424" ){
							$telefono=str_replace("424","0424",$telefo);
					}
					if($ini=="414" ){
							$telefono=str_replace("414","0414",$telefo);
					}
				
				//echo"<br><br>|$telefono_o<br>$telefono : $telf_casa : $telf_adic";
				
				
				if(!$cable->objeto->ejecutarSql("insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$cedula','$nombre','$apellido','$telefono')")){
					echo "<br>$fallos:insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$cedula','$nombre','$apellido','$telefono')";
						echo $cable->objeto->error().'<br>';
				}
				
				
				//echo "<br>insert into cliente(id_persona,telf_casa,email,telf_adic) values ('$id_persona','$telf_casa','$email','$telf_adic')";
				if(!$cable->objeto->ejecutarSql("insert into cliente(id_persona,telf_casa,email,telf_adic) values ('$id_persona','$telf_casa','$email','$telf_adic')")){
					echo "<br>$fallos:insert into cliente(id_persona,telf_casa,email,telf_adic) values ('$id_persona','$telf_casa','$email','$telf_adic')";
						echo $cable->objeto->error().'<br>';
				}
				

				
				$fecha_contrato=trim($row['feccon']);
				$hora_contrato=trim($row['horsys']);
				$observacion=trim($row['nom_zona'])."; ";
				$etiqueta=trim($row['tagin']);
				$costo_contrato=trim($row['monto']);
				$costo_dif_men=0.00;
				$status=array("AC"=>"ACTIVO","CO"=>"CORTADO","SI"=>"POR INSTALAR","SU"=>"SUSPENDIDO","EX"=>"EXONERADO","RT"=>"SUSPENDIDO","RE"=>"SUSPENDIDO","NO"=>"SUSPENDIDO","CU"=>"SUSPENDIDO");
				$status_contrato=$status[trim($row['status'])];
				$direc_adicional=trim($row['comenta']);
				
				$numero_casa=trim($row['nrcasa']);
				
				if(strlen($numero_casa)>10){
					$numero_casa='S/N';
				}
				
				$edificio='';
				$numero_piso='';
				$direc_adicional=trim($row['comenta']);
				$puntos=trim($row['puntos']);
				
				//$nro_calle=trim($row['codigoge']);
				
				
				
				$cable->objeto->ejecutarSql("select id_contrato from contrato  where (id_contrato ILIKE '$ini_u%')  ORDER BY id_contrato desc  LIMIT 1 offset 0 ");
				$id_contrato=$ini_u.verCodLong($cable,"id_contrato");
				
				//	echo "<br>$fallos:insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso,pto) values ('$id_contrato','$id_calle','$id_vendedor','$id_persona','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','','$direc_adicional','$numero_casa','$edificio','$numero_piso','$puntos')<br>";
				
				if(!$cable->objeto->ejecutarSql("insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso,pto) values ('$id_contrato','$id_calle','$id_vendedor','$id_persona','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','','$direc_adicional','$numero_casa','$edificio','$numero_piso','$puntos')")){
						echo "<br>$fallos:insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso) values ('$id_contrato','$id_calle','$id_vendedor','$id_persona','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','','$direc_adicional','$numero_casa','$edificio','$numero_piso')<br>";
						echo $cable->objeto->error().'<br>';
						//$fallos++;
				}
				else{
					
					$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%') ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
					$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
					$id_serv="SER00001";
					$cant_serv=1;
					if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','CONTRATO')")){
						echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','CONTRATO')<br>";
						echo $cable->objeto->error().'<br>';
					}
					
					$puntos=trim($row['puntos']);
					if($puntos>0){
						$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
						$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
						$id_serv="SER00003";
						$cant_serv=$puntos;
						if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','CONTRATO')")){
							echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','CONTRATO')<br>";
							echo $cable->objeto->error().'<br>';
						}
					}
					/*
					$consul->objeto->ejecutarSql("select pago,vencido from cuotas where contrato='$nro_contrato' and cancelado='NO'  and pago>0 and concepto1='MENSUALIDAD'");
					while($fila=row($consul)){
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$id_serv="SER00001";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
					}
					*/
					if($status_contrato=="CORTADO"){
							$fecha_inst=date("Y-m-d");
							$costo_cobro=80.00;
							$id_serv="SER00002";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");

							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
					}
					
					
					/*
					$consul->objeto->ejecutarSql("select pago,vencido,fec_cob from cuotas where contrato='$nro_contrato' and cancelado='SI' and concepto1='MENSUALIDAD' ");
					while($fila=row($consul)){
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$fec_cob=trim($fila['fec_cob']);
							$id_serv="SER00001";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
						
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
					}
					*/
				}
			}
		}
	//}
}
function guardar_en_base_datos($ruta,$acceso){
	$timer = new timerClass();
    $timer ->start();
	$endexct = $timer->end();
//	echo "<br>Tiempo de Ejecucion:$endexct<br>";
   
	include('./dbf_class.php');
	 $dbf = new dbf_class();
	 
   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
		$i=1;
         while (($file = readdir($dh)) !== false) {
           if(filetype($ruta . $file)=="file"){
				//echo "<br>$ruta$file";
				//if(strstr($file,".DBF")){
						generaSQL("$ruta","$file",$dbf,$acceso);
						$i++;
				//}
			}
         }
      closedir($dh);
      }
   }else
      echo "<br>No es ruta valida";
}
function generaSQL($ruta,$file,$dbf,$acceso){
$thefile=$ruta.$file;
if($thefile){

    $dbf->dbf_c($thefile);
    $num_rec=$dbf->dbf_num_rec;
    $field_num=$dbf->dbf_num_field;
   
    //exit("$field_num $num_rec");
 /*   echo("<blockquote>File Name : $file<br>Number of Records : $num_rec<br>Number of Fields : $field_num </blockquote>");
    echo('<table border=1 cellspacing=0>');
    echo('<tr>');
    echo('<td><br>No.&nbsp;</td>');	
*/
	$tablas_no=array('FOXHELP','INF_CL','MEMOERR','REC1_','TEMHISC','CONCEPTO','AYUDA','ORDENA','TOTALES','TIPO_V','REC_');
	if($num_rec==0 || $num_rec==1 || $num_rec==2 || $num_rec==3){
		eliminarArc($thefile);
		return;
	}
	else{
		for($i=0;$i<count($tablas_no);$i++){
			if($file==$tablas_no[$i]){
				eliminarArc($thefile);
				return;
			}
		}
		$i=0;	
	//	echo("<blockquote>File Name : <a href='$thefile'>$file</a><br>Number of Records : $num_rec<br>Number of Fields : $field_num </blockquote>");
	
	$valor=explode(".DBF",$file);
	$tabla=$valor[0];
	if($tabla=="&ANTES_2")
		$tabla="ANTES_2";
	else if($tabla=="&DES_1")
		$tabla="DES_1";
	else if($tabla=="001")
		$tabla="A001";
	else if($tabla=="002")
		$tabla="A002";
	else if($tabla=="003")
		$tabla="A003";
		
	else if($tabla=="CUOTAS~1")
		$tabla="CUOTAS_1";
		
		
	$sql= "CREATE TABLE $tabla (";
	
	$num_f=$field_num-1;
	
	$ca[0]='';
	$y=0;
    for($j=0; $j<$field_num; $j++){
			
			$x=0;
			for($k=0;$k<count($ca);$k++)
			{
				if($ca[$k]==$dbf->dbf_names[$j]['name']){
					$x=1;
				}
			}
			if($x==0){
				$ca[$y]=$dbf->dbf_names[$j]['name'];
				$y++;
	  
		if($num_f==$j){
			if ($dbf->dbf_names[$j]['type']=='C') {
				$tipo=$dbf->dbf_names[$j]['name']." char(".$dbf->dbf_names[$j]['len'].")";
			}
			else if ($dbf->dbf_names[$j]['type']=='N') {
				$tipo=$dbf->dbf_names[$j]['name']." numeric(".$dbf->dbf_names[$j]['len'].")";
			}
			else if($dbf->dbf_names[$j]['type']=='D') {
				$tipo=$dbf->dbf_names[$j]['name']." date NULL";
			}
			else{
				$tipo=$dbf->dbf_names[$j]['name']." char(255)";
			}
		}
		else{
			if($dbf->dbf_names[$j]['type']=='C') {
				$tipo=$dbf->dbf_names[$j]['name']." char(".$dbf->dbf_names[$j]['len']."), ";
			}
			else if ($dbf->dbf_names[$j]['type']=='N') {
				$tipo=$dbf->dbf_names[$j]['name']." numeric(".$dbf->dbf_names[$j]['len']."), ";
			}
			else if($dbf->dbf_names[$j]['type']=='D') {
				$tipo=$dbf->dbf_names[$j]['name']." date  NOT NULL, ";
			}
			else{
				$tipo=$dbf->dbf_names[$j]['name']." char(255), ";
			}
		}
		
		$sql.= $tipo;
		
		}
    }
	
	$sql.= ");";
	//echo "<br>".$sql;
	$acceso->objeto->ejecutarSql($sql);
	
	
	
    //echo '</tr>';
	
    for($i=0; $i<$num_rec; $i++){
		$exite=false;
		$sql = "INSERT INTO $tabla VALUES (";
        if ($row = $dbf->getRow($i)) {
			$num_f=$field_num-1;
	        for($j=0; $j<$field_num; $j++){
				$row[$j]=str_replace("'","",$row[$j]);
				
				// for($ij=0; $ij<10000; $ij++){
					//hola
				// }
			
				//if(strstr($date,"¥")){
					
				//}
				$row[$j]=str_replace("¥","Ñ",$row[$j]);
				$row[$j]=utf8_encode($row[$j]);
				
				//$row[$j]=htmlentities($row[$j]);
				if(trim($row[$j])!=""){
					$existe=true;
				}
				
				if ($dbf->dbf_names[$j]['type']=='N'){
					if(trim($row[$j])==''){
						$row[$j]=0;
					}
					if($num_f==$j){
						$sql.= "".$row[$j]."";
					}
					else{
						$sql.= "".$row[$j].",";
					}
				}
				else if($dbf->dbf_names[$j]['type']=='D'){
					if(trim($row[$j])==''){
						$row[$j]='1111-11-11';
					}
					if($num_f==$j){
						$sql.= "'".formato_f($row[$j])."'";
					}
					else{
						$sql.= "'".formato_f($row[$j])."',";
					}
				}
				else{
					if($num_f==$j){
						$sql.= "'".$row[$j]."'";
					}
					else{
						$sql.= "'".$row[$j]."', ";
					}
				}
    	    }
        }
		$sql.= ");";
		//if($existe==true){
			if(!$acceso->objeto->ejecutarSql($sql)){
				//echo "<br>$i:$sql";
				echo $acceso->objeto->error().'<br>';
			}
			else{
				//echo "<br>$i:";
			}
			
		//}
    }
  }//if
}
//$thefile
}
function formato_f($date){
	if(strstr($date,"-")){
		return $date;
	}
	else if(strstr($date,"/")){
		$valor=explode("/",trim($date));
		$fecha= $valor[2].'-'.$valor[1].'-'.$valor[0];
		return $fecha;
	}
	else{
	//	echo "<:$date:>";
		$dia=$date[6].$date[7];
		$mes=$date[4].$date[5];
		$ano=$date[0].$date[1].$date[2].$date[3];
		
		return "$ano-$mes-$dia";
	}
}

class timerClass {
	var $startTime;
	var $started;
	function timerClass($start=true) {
		$this->started = false;
		if ($start)
			$this->start();
	}
	function start() {
		$startMtime = explode(' ',microtime());
		$this->startTime = (double)($startMtime[0])+(double)($startMtime[1]);
		$this->started = true;
	}
	function end($iterations=1) {
		$endMtime = explode(' ',microtime());
		if ($this->started) {
			$endTime = (double)($endMtime[0])+(double)($endMtime[1]);
			$dur = $endTime - $this->startTime;
			$avg = 1000*$dur/$iterations;
			$avg = round(1000*$avg)/1000;
			return "$avg milliseconds";
		} else {
			return "timer not started";
		}
	}
}
function eliminarArc($archivo){
	if (file_exists($archivo)){
		unlink($archivo);
	}
}
?>
