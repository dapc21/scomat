<?php

	require_once("DataBase/Acceso.php");
	$acceso=conexion();
	
	$acceso=conectar("Postgres",'localhost','postgres','123456','copia');
	$cable=conectar("Postgres",'localhost','postgres','123456','pruebajup');
	$cable1=conectar("Postgres",'localhost','postgres','123456','pruebajup');
	$consul=conectar("Postgres",'localhost','postgres','123456','copia');
	$consul1=conectar("Postgres",'localhost','postgres','123456','copia');
	restaurar_ubi($acceso,$cable,$consul,$cable1,$consul1);
	//pasar_a_nueva_bd($acceso,$cable,$consul);
	//pasar_pagos($acceso,$cable,$consul);

function restaurar_ubi($acceso,$cable,$consul,$cable1,$consul1){
	echo "entro";
	require_once "procesos.php"; $ini_u = "AA"; 
	//$tablas=array('contrato');
	//$tablas=array('zona','sector','calle');
	$tablas=array('caja_cobrador');
	
	for($i=0;$i<count($tablas);$i++){
		$table=$tablas[$i];
		$acceso->objeto->ejecutarSql("select *from $table ");
		while($row=row($acceso)){
			/*if($table=="zona"){
				$n_zona=trim($row['id_zona']);
				$nombre_zona=trim($row['nombre_zona']);
				$cable1->objeto->ejecutarSql("select *from zona where n_zona=$n_zona"); 
				if(!row($cable1)){
					
					
					$cable->objeto->ejecutarSql("select *from zona ORDER BY id_zona desc"); 
					$id_zona="ZON".verCo($cable,"id_zona");
					
					$cable->objeto->ejecutarSql("select nro_zona from zona ORDER BYnro_zona desc LIMIT 1 offset 0 ");
					$nro_zona=verNumero($cable,"nro_zona");
					
					echo "<br>insert into zona(id_zona,nro_zona,id_franq,nombre_zona,n_zona) values ('$id_zona','$nro_zona','1','$nombre_zona','$n_zona')";
					$cable->objeto->ejecutarSql("insert into zona(id_zona,nro_zona,id_franq,nombre_zona,n_zona) values ('$id_zona','$nro_zona','1','$nombre_zona','$n_zona')");
				}
			}
			else if($table=="sector"){
				$n_sector=trim($row['id_sector']);
				$nombre_sector=trim($row['nombre_sector']);
				$n_zona=trim($row['id_zona']);
				$cable1->objeto->ejecutarSql("select *from sector where n_sector=$n_sector"); 
				if(!row($cable1)){
					echo "<br>select id_zona from zona where n_zona='$n_zona'";
					$cable1->objeto->ejecutarSql("select id_zona from zona where n_zona='$n_zona'"); 
					$zona=row($cable1);
					$id_zona=trim($zona['id_zona']);
					
					$cable->objeto->ejecutarSql("select *from sector ORDER BY id_sector desc"); 
					$id_sector="SEC".verCo($cable,"id_sector");
					
					$cable->objeto->ejecutarSql("select nro_sector from sector ORDER BY nro_sector desc LIMIT 1 offset 0 "); 
					$nro_sector=verNumero($cable,"nro_sector");
				
					echo "<br>insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector','$n_sector')";
					$cable->objeto->ejecutarSql("insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector','$n_sector')");
				}
			}
			else if($table=="calle"){
				$n_calle=trim($row['id_calle']);
				$nombre_calle=trim($row['nombre_calle']);
				$n_sector=trim($row['id_sector']);
				$cable1->objeto->ejecutarSql("select *from calle where n_calle=$n_calle"); 
				if(!row($cable1)){
					$cable1->objeto->ejecutarSql("select id_sector from sector where n_sector='$n_sector'"); 
					$sector=row($cable1);
					$id_sector=trim($sector['id_sector']);
				
					$cable->objeto->ejecutarSql("select *from calle where (id_calle ILIKE '%CA%') ORDER BY id_calle desc"); 
					$id_calle="CA".verCodlong($cable,"id_calle");
					
					$cable->objeto->ejecutarSql("select nro_calle from calle ORDER BY nro_calle desc LIMIT 1 offset 0 "); 
					$nro_calle=verNumero($cable,"nro_calle");
					
					echo "<br>insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$n_calle')";
					$cable->objeto->ejecutarSql("insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$n_calle')");
				}
			
			}//fin else
			
			else if($table=="contrato"){
				$id_contrato = trim($row['id_contrato']);
				$n_calle = trim($row['id_calle']);
				$id_persona = trim($row['id_persona']);
				$cli_id_persona = trim($row['cli_id_persona']);
				$nro_contrato = trim($row['nro_contrato']);
				$nro=substr($nro_contrato , 1,5);
				//echo ":$nro_contrato:";
				$nro_contrato ="P$nro";
				//echo ":$nro_contrato:";
				$fecha_contrato = trim($row['fecha_contrato']);
				$hora_contrato = trim($row['hora_contrato']);
				$observacion = trim($row['observacion']);
				$etiqueta = trim($row['etiqueta']);
				$costo_contrato = trim($row['costo_contrato']);
				$costo_dif_men = trim($row['costo_dif_men']);
				
				$status_contrato = trim($row['status_contrato']);
				$nro_factura = trim($row['nro_factura']);
				$direc_adicional = trim($row['direc_adicional']);
				$numero_casa = trim($row['numero_casa']);
				$edificio = trim($row['edificio']);
				$numero_piso = trim($row['numero_piso']);
				
				$cable1->objeto->ejecutarSql("select id_calle from calle where n_calle='$n_calle'"); 
				$calle=row($cable1);
				$id_calle=trim($calle['id_calle']);
				
				$consul->objeto->ejecutarSql("select *from persona where id_persona='$cli_id_persona'"); 
				$fila=row($consul);
				$cedula=trim($fila['cedula']);
				$nombre=trim($fila['nombre']);
				$apellido=trim($fila['apellido']);
				$telefono=trim($fila['telefono']);
				
				$cable->objeto->ejecutarSql("select id_persona from persona   where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc LIMIT 1 offset 0 "); 
				$id_persona_n = $ini_u.verCodLong($cable,"id_persona");
				echo "<br>insert into Persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona_n','$cedula','$nombre','$apellido','$telefono');";
				$cable->objeto->ejecutarSql("insert into Persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona_n','$cedula','$nombre','$apellido','$telefono')");			
				
				
				$consul->objeto->ejecutarSql("select *from cliente where id_persona='$cli_id_persona'"); 
				$fila=row($consul);
				$telf_casa=trim($fila['telf_casa']);
				$email=trim($fila['email']);
				$telf_adic=trim($fila['telf_adic']);
				echo "<br>insert into cliente(id_persona,telf_casa,email,telf_adic) values ('$id_persona_n','$telf_casa','$email','$telf_adic');";
				$cable->objeto->ejecutarSql("insert into cliente(id_persona,telf_casa,email,telf_adic) values ('$id_persona_n','$telf_casa','$email','$telf_adic')");
				
				$cable->objeto->ejecutarSql("select id_contrato from contrato  where (id_contrato ILIKE '$ini_u%')  ORDER BY id_contrato desc  LIMIT 1 offset 0 ");
				$id_contrato_n=$ini_u.verCodLong($cable,"id_contrato");
				echo "<br>insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso,n_contrato) values ('$id_contrato_n','$id_calle','$id_persona','$id_persona_n','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','$nro_factura','$direc_adicional','$numero_casa','$edificio','$numero_piso','$id_contrato');";
				$cable->objeto->ejecutarSql("insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso,n_contrato) values ('$id_contrato_n','$id_calle','$id_persona','$id_persona_n','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','$nro_factura','$direc_adicional','$numero_casa','$edificio','$numero_piso','$id_contrato')");
				
				$consul->objeto->ejecutarSql("select *from ordenes_tecnicos where id_contrato='$id_contrato'"); 
				while($fila=row($consul)){
					
					$id_orden =trim($fila['id_orden']);
					$id_persona_t =trim($fila['id_persona']);
					$id_det_orden =trim($fila['id_det_orden']);
					$fecha_orden =trim($fila['fecha_orden']);
					$fecha_final =trim($fila['fecha_final']);
					$detalle_orden =trim($fila['detalle_orden']);
					$comentario_orden =trim($fila['comentario_orden']);
					$status_orden =trim($fila['status_orden']);
					$prioridad =trim($fila['prioridad']);
					echo "<br>insert into ordenes_tecnicos(id_orden,id_persona,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$id_persona_t','$id_det_orden','$fecha_orden','$fecha_final','$detalle_orden','$comentario_orden','$status_orden','$id_contrato_n','$prioridad');";	
					$cable->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,id_persona,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$id_persona_t','$id_det_orden','$fecha_orden','$fecha_final','$detalle_orden','$comentario_orden','$status_orden','$id_contrato_n','$prioridad')");
				}
				
				
				$consul->objeto->ejecutarSql("select *from contrato_servicio where id_contrato='$id_contrato'"); 
				while($fila=row($consul)){
					
					$id_cont_serv =trim($fila['id_cont_serv']);
					$id_serv =trim($fila['id_serv']);
					
					$fecha_inst = trim($fila['fecha_inst']);
					$cant_serv = trim($fila['cant_serv']);
					$status_con_ser = trim($fila['status_con_ser']);
					$costo_cobro = trim($fila['costo_cobro']);
					
					if($costo_cobro==''){
						$costo_cobro=0;
					}

					$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
					$id_cont_serv_n = $ini_u.verCodLong($cable,"id_cont_serv");
					echo "<br>insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,n_cont_serv) values ('$id_cont_serv_n','$id_serv','$id_contrato_n','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','$id_cont_serv');";
					$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,n_cont_serv) values ('$id_cont_serv_n','$id_serv','$id_contrato_n','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','$id_cont_serv')");
				}
				
			}//fin else
			
			else*/ if($table=="caja_cobrador"){
				$id_caja_cob =trim($row['id_caja_cob']);
				$id_caja =trim($row['id_caja']);
				$id_persona =trim($row['id_persona']);
				$fecha_caja =trim($row['fecha_caja']);
				$apertura_caja =trim($row['apertura_caja']);
				$cierre_caja =trim($row['cierre_caja']);
				if($cierre_caja==''){
					$cierre_caja="12:00:00";
				}
				$monto_acum =trim($row['monto_acum']);
				if($monto_acum==''){
					$monto_acum=0;
				}
				
				$status_caja =trim($row['status_caja']);
				
				$cable->objeto->ejecutarSql("select id_caja_cob from caja_cobrador where (id_caja_cob ILIKE '%AC%') ORDER BY id_caja_cob desc LIMIT 1 offset 0"); 
				$id_caja_cob_n= $ini_u.verCodLong($cable,"id_caja_cob");
				
				echo "<br>insert into caja_cobrador(id_caja_cob,id_caja,id_persona,fecha_caja,apertura_caja,cierre_caja,monto_acum,status_caja,n_caja_cob) values ('$id_caja_cob_n','$id_caja','$id_persona','$fecha_caja','$apertura_caja','$cierre_caja','$monto_acum','$status_caja','$id_caja_cob');";
				$cable->objeto->ejecutarSql("insert into caja_cobrador(id_caja_cob,id_caja,id_persona,fecha_caja,apertura_caja,cierre_caja,monto_acum,status_caja,n_caja_cob) values ('$id_caja_cob_n','$id_caja','$id_persona','$fecha_caja','$apertura_caja','$cierre_caja','$monto_acum','$status_caja','$id_caja_cob')");
				

				
				$consul->objeto->ejecutarSql("select *from pagos where id_caja_cob='$id_caja_cob' order by id_pago asc"); 
				while($fila=row($consul)){
					$id_pago =trim($fila['id_pago']);
					$fecha_pago =trim($fila['fecha_pago']);
					$hora_pago =trim($fila['hora_pago']);
					$monto_pago =trim($fila['monto_pago']);
					if($monto_pago==''){
						$monto_pago=0;
					}
					$obser_pago =trim($fila['obser_pago']);
					$status_pago =trim($fila['status_pago']);
					$nro_factura =trim($fila['nro_factura']);
					
					$cable->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '%CA%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
					$id_pago_n = 'CA'.verCodLargo($cable,"id_pago");
		
					echo "<br>insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,n_pagos) values ('$id_pago_n','$id_caja_cob_n','$fecha_pago','$hora_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_pago');";
					$cable->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,n_pagos) values ('$id_pago_n','$id_caja_cob_n','$fecha_pago','$hora_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_pago')");
					
					
					$consul1->objeto->ejecutarSql("select *from detalle_tipopago where id_pago='$id_pago'"); 
					$fila1=row($consul1);
					
					$banco =trim($fila1['banco']);
					$numero =trim($fila1['numero']);
					$obser_detalle =trim($fila1['obser_detalle']);
					
					$cable->objeto->ejecutarSql("select id_tipo_pago from detalle_tipopago where (id_tipo_pago ILIKE '%CA%') ORDER BY id_tipo_pago desc LIMIT 1 offset 0 "); 
					$id_tipo_pago = 'TPA'.verCo($cable,"id_tipo_pago");
					
					echo "<br>insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,obser_detalle) values ('$id_tipo_pago','$id_pago_n','$banco','$numero','$obser_detalle');";
					$cable->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,obser_detalle) values ('$id_tipo_pago','$id_pago_n','$banco','$numero','$obser_detalle')");			
					
					echo "<br><br>select *from pago_servicio where id_pago='$id_pago_n'";
					$consul1->objeto->ejecutarSql("select *from pago_servicio where id_pago='$id_pago'"); 
					while($fila1=row($consul1)){
						$n_cont_serv =trim($fila1['id_cont_serv']);
					
						$cable1->objeto->ejecutarSql("select id_cont_serv from contrato_servicio where n_cont_serv='$n_cont_serv'"); 
						$calle=row($cable1);
						$id_cont_serv=trim($calle['id_cont_serv']);
						
						echo "<br>insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago_n','$id_cont_serv');";
						$cable->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago_n','$id_cont_serv')");
					}
				}
			}//fin else
		
		}//while
	}//for
}//func

function pasar_pagos($acceso,$cable,$consul){
	require_once "procesos.php"; $ini_u = "AA"; 
	//$tablas=array('clie');

		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato order by nro_contrato ");
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
				
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$monto_pago=0;
					$cable->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '%CA%')ORDER BY id_pago desc LIMIT 1 offset 0 "); 
					$id_pago = "CA".verCodLargo($cable,"id_pago");
					echo "<br><br><br>$id_pago";	
						
					$consul->objeto->ejecutarSql("select recibo,pago,vencido,fec_cob,concepto1 from cuotas where contrato='$nro_contrato' and cancelado='SI' order by fec_cob desc");
					while($fila=row($consul)){
						if($co==false){
							$rec=trim($fila['recibo']);
						}
						
						
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$recibo=trim($fila['recibo']);
							$fec_cob=trim($fila['fec_cob']);
							$concepto1=trim($fila['concepto1']);
						  if($rec==$recibo){
							$fecha_pago=$fec_cob;
							$monto_pago=$monto_pago+$costo_cobro;
							if($concepto1=='MENSUALIDAD'){
								$id_serv="SER00001";
							}
							if($concepto1=='RECONEXION'){
								$id_serv="SER00002";
							}
							else{
								$id_serv="SER00005";
							}
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							echo "<br>$fallos:$nro_contrato:$fec_cob:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
							echo "<br>insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,obser_detalle) values ('TPA00001','$id_pago','','','')";
							$cable->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,obser_detalle) values ('TPA00001','$id_pago','','','')");
							echo "<br>insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')";
							$cable->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')");
							
							$co=true;
						  }
					}
					
				if($co==false){
					
					$consul->objeto->ejecutarSql("select recibo,pago,vencido,fec_cob,concepto1 from his_men where contrato='$nro_contrato' and cancelado='SI' order by fec_cob desc");
					while($fila=row($consul)){
						if($co==false){
							$rec=trim($fila['recibo']);
							
						}
						
						
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$recibo=trim($fila['recibo']);
							$fec_cob=trim($fila['fec_cob']);
							$concepto1=trim($fila['concepto1']);
						  if($rec==$recibo){	
							$fecha_pago=$fec_cob;
							
							$monto_pago=$monto_pago+$costo_cobro;
							if($concepto1=='MENSUALIDAD'){
								$id_serv="SER00001";
							}
							if($concepto1=='RECONEXION'){
								$id_serv="SER00002";
							}
							else{
								$id_serv="SER00005";
							}
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							echo "<br>$fallos:$nro_contrato:$fec_cob:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
							echo "<br>insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,obser_detalle) values ('TPA00001','$id_pago','','','')";
							$cable->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,obser_detalle) values ('TPA00001','$id_pago','','','')");
							echo "<br>insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')";
							$cable->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')");
							
							$co=true;
						  }
					}
				}
				if($co==true){
							
							$id_caja_cob="AC00000002";
							echo "<br>insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura) values ('$id_pago','$id_caja_cob','$fec_cob','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo')";
							$cable->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo')");
				}			
					
					
					$consul->objeto->ejecutarSql("select pago,vencido,fec_cob from his_men where contrato='$nro_contrato' and cancelado='SI' and concepto1='MENSUALIDAD' and  vencido between '2011-09-01' and '2012-11-01'");
					while($fila=row($consul)){
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$fec_cob=trim($fila['fec_cob']);
							$id_serv="SER00001";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
						
							//echo "<br>$fallos::$nro_contrato:$fec_cob:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
					}
					
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
		
		$acceso->objeto->ejecutarSql("select cedula,nombre,edif,telefo,telefo1,contrato,feccon,horsys,tagin,status,comenta,nrcasa,comenta,calle,zona,nom_zona,urba,puntos from clie");
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
					$nombre_sector=trim($row['urba']);
						
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
								*/	$cable->objeto->ejecutarSql("select id_calle from calle  where (id_calle ILIKE '$ini_u%') ORDER BY id_calle desc LIMIT 1 offset 0 "); 
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
				
				
			

				$cable->objeto->ejecutarSql("select id_persona from persona  where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc LIMIT 1 offset 0 "); 
				$id_persona = $ini_u.verCodLong($cable,"id_persona");
				
				
				$cedula=trim($row['cedula']);
				$nombre=trim($row['nombre']);
				
				
				
				$valor=explode(" ",$nombre);
				$pal_nom=count($valor);
				if($pal_nom==2){
					$apellido=trim($valor[0]);
					$nombre=trim($valor[1]);
				}
				else if($pal_nom==3){
					$apellido=trim($valor[0])." ".trim($valor[1]);
					$nombre=trim($valor[2]);
				}
				else if($pal_nom==4){
					$apellido=trim($valor[0])." ".trim($valor[1]);
					$nombre=trim($valor[2])." ".trim($valor[3]);
				}
				else{
					$apellido=trim($valor[0])." ".trim($valor[1]);
					$nombre='';
					for($ki=2;$ki<count($valor);$ki++){
						$nombre=$nombre.trim($valor[$ki])." ";
					}
				}
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
				$observacion='';
				$etiqueta=trim($row['tagin']);
				$costo_contrato=0.00;
				$costo_dif_men=0.00;
				$status=array("AC"=>"ACTIVO","CO"=>"CORTADO","SI"=>"POR INSTALAR","SU"=>"SUSPENDIDO","EX"=>"EXONERADO","RT"=>"SUSPENDIDO");
				$status_contrato=$status[trim($row['status'])];
				$direc_adicional=trim($row['comenta']);
				
				$numero_casa=trim($row['nrcasa']);
				
				if(strlen($numero_casa)>10){
					$numero_casa='S/N';
				}
				
				$edificio='';
				$numero_piso='';
				$direc_adicional=trim($row['comenta']);
				
				//$nro_calle=trim($row['codigoge']);
				
				
				
				$cable->objeto->ejecutarSql("select id_contrato from contrato  where (id_contrato ILIKE '$ini_u%')  ORDER BY id_contrato desc  LIMIT 1 offset 0 ");
				$id_contrato=$ini_u.verCodLong($cable,"id_contrato");
				
				
				if(!$cable->objeto->ejecutarSql("insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso) values ('$id_contrato','$id_calle','$id_vendedor','$id_persona','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','','$direc_adicional','$numero_casa','$edificio','$numero_piso')")){
						echo "<br>$fallos:insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso) values ('$id_contrato','$id_calle','$id_vendedor','$id_persona','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','','$direc_adicional','$numero_casa','$edificio','$numero_piso')<br>";
						echo $cable->objeto->error().'<br>';
						//$fallos++;
				}
				else{
					
					$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
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
					
					$consul->objeto->ejecutarSql("select pago,vencido from cuotas where contrato='$nro_contrato' and cancelado='NO'  and pago>0 and concepto1='MENSUALIDAD'");
					while($fila=row($consul)){
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$id_serv="SER00001";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
					}
					
					if($status_contrato=="CORTADO"){
							$fecha_inst=date("Y-m-d");
							$costo_cobro=40.00;
							$id_serv="SER00002";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");

							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
					}
					
					$consul->objeto->ejecutarSql("select pago,vencido,fec_cob from cuotas where contrato='$nro_contrato' and cancelado='SI' and concepto1='MENSUALIDAD' and  vencido between '01/12/2010' and '01/11/2011'");
					while($fila=row($consul)){
							$fecha_inst=trim($fila['vencido']);
							$costo_cobro=trim($fila['pago']);
							$fec_cob=trim($fila['fec_cob']);
							$id_serv="SER00001";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
						
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
					}
					
				}
				
			}
			
		}
	//}
}


?>
