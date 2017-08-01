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
} elseif ($_POST['f']){
    $thefile=$_POST['f'];
}
if($dir){
	require_once("DataBase/Acceso.php");
	$cable=conectar("Postgres",'localhost','postgres','123456','saeco');   
	$cable1=conectar("Postgres",'localhost','postgres','123456','saeco');
	$consul=conectar("Postgres",'localhost','postgres','123456','saeco');
	$database_serie='copia_guanta';
	$serie='A';
	$id_franq='1';
	$id_ciudad='AM000001';
	$acceso=conectar("Postgres",'localhost','postgres','123456',$database_serie);
	$acceso5=conectar("Postgres",'localhost','postgres','123456',$database_serie);
	
//guardar_en_base_datos($dir,$acceso);

//	restaurar_cobrador($acceso,$cable,$consul,$serie,$id_franq,$id_ciudad);
//	restaurar_ubi($acceso,$cable,$consul,$serie,$id_franq,$id_ciudad,$acceso5);
//	pasar_a_nueva_bd($acceso,$cable,$consul,$serie,$id_franq);
//	pasar_pagos($cable1,$cable,$acceso,$serie,$acceso5);
//	actualizar_contrato($cable1,$cable,$acceso,$serie);
//	pasar_pagos_deuda($cable1,$cable,$acceso,$serie);
//	restaurar_ordenes($cable1,$cable,$acceso,$serie);
}

function restaurar_cobrador($acceso,$cable,$consul,$serie,$id_franq,$id_ciudad){
	//echo "entro";
	require_once "procesos.php"; $ini_u = "Z$serie"; 

	$cable->objeto->ejecutarSql("update cobrador set codcob=''; "); 
	$acceso->objeto->ejecutarSql("select *from cobrador order by codcob");
	while($row=row($acceso)){
				$codcob=trim($row['codcob']);
				$descob=trim($row['descob']);
				
				$id_persona=verCod_cli($cable,$ini_u);
				$cable->objeto->ejecutarSql("select *from cobrador ORDER BY nro_cobrador desc"); 
				$nro_cobrador = verNumero($cable,"nro_cobrador");
				$cedula=$id_franq.$nro_cobrador;
				$cable->objeto->ejecutarSql("insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$cedula','$descob','','')");	
				echo "<br>insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$nro_cobrador','$descob','','');";
				echo "<br>insert into cobrador(id_persona,nro_cobrador,direccion_cob,codcob,id_franq) values ('$id_persona','$nro_cobrador','VACIO','$codcob','$id_franq');";
				$cable->objeto->ejecutarSql("insert into cobrador(id_persona,nro_cobrador,direccion_cob,codcob,id_franq) values ('$id_persona','$nro_cobrador','VACIO','$codcob','$id_franq')");
				
				$cable->objeto->ejecutarSql("select *from vendedor ORDER BY nro_vendedor desc"); 
				$nro_vendedor = verNumero($cable,"nro_vendedor");
				
				$cable->objeto->ejecutarSql("insert into vendedor(id_persona,nro_vendedor,direccion_ven,codven,id_franq) values ('$id_persona','$nro_vendedor','VACIO','$codcob','$id_franq')");
	}
}

function restaurar_ubi($acceso,$cable,$consul,$serie,$id_franq,$id_ciudad,$acceso5){
	//echo "entro";
	require_once "procesos.php"; $ini_u = "AA"; 

	
	$acceso->objeto->ejecutarSql("select *from zona order by secnro");
		while($row=row($acceso)){
				$secnro=trim($row['secnro']);
				$nombre_zona=trim($row['secdsc']);
				$seccnt=trim($row['seccnt']);
				
				$cable->objeto->ejecutarSql("select *from zona  where (id_zona ILIKE '%ZO$serie%') ORDER BY id_zona desc"); 
				$id_zona="ZO$serie".verCo($cable,"id_zona");
			if($secnro!=''){
				if(!$cable->objeto->ejecutarSql("insert into zona(id_zona,nro_zona,id_franq,nombre_zona,n_zona,id_ciudad) values ('$id_zona','$seccnt','$id_franq','$nombre_zona','$secnro','$id_ciudad')")){
					echo "<br>$i:insert into zona(id_zona,nro_zona,id_franq,nombre_zona,n_zona,id_ciudad) values ('$id_zona','$seccnt','$id_franq','$nombre_zona','$secnro','$id_ciudad')";
					echo $cable->objeto->error().'<br>';
				} 
			}
	}
	
	
	$acceso->objeto->ejecutarSql("select *from nodo order by nodocod");
		while($row=row($acceso)){
				$n_sector=trim($row['nodocod']);
				$nombre_sector=trim($row['nodonomb']);
				$nodocnt=trim($row['nodocnt']);
					
					$cable->objeto->ejecutarSql("select *from sector  where (id_sector ILIKE '%SE$serie%') ORDER BY id_sector desc  LIMIT 1 offset 0 "); 
					$id_sector="SE$serie".verCo($cable,"id_sector");
				
					$acceso5->objeto->ejecutarSql("select  secnro from abonados where nodocod = '$n_sector' limit 1"); 
					if($fila=$acceso5->objeto->devolverRegistro())
					{
						$secnro=trim($fila['secnro']);
					}
			
				//echo "<br>select  id_zona from zona where n_zona = '$secnro'";
					$consul->objeto->ejecutarSql("select  id_zona from zona where n_zona = '$secnro'"); 
					if($fila=$consul->objeto->devolverRegistro())
					{
						$id_zona=trim($fila['id_zona']);
						$cable->objeto->ejecutarSql("insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector,afiliacion) values ('$id_sector','$nodocnt','$id_zona','$nombre_sector','$n_sector','')");
						echo "<br>insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector) values ('$id_sector','$nodocnt','$id_zona','$nombre_sector','$n_sector')";
					}
	}
	
	
	
	$acceso->objeto->ejecutarSql("select * from sector order by sectcod");
	while($row=row($acceso)){
				$sectcod=trim($row['sectcod']);
				$nombre_calle=trim($row['sectdsc']);
				$nro_calle=trim($row['sectcnt']);
				
				$cable->objeto->ejecutarSql("select *from calle  where (id_calle ILIKE 'C$serie%') ORDER BY id_calle desc"); 
				$id_calle="C$serie".verCodlong($cable,"id_calle");
				
					$acceso5->objeto->ejecutarSql("select  nodocod from abonados where sectcod = '$sectcod' limit 1"); 
					if($fila=$acceso5->objeto->devolverRegistro())
					{
						$nodocod=trim($fila['nodocod']);
					}
					
					$consul->objeto->ejecutarSql("select  id_sector from sector where  n_sector='$nodocod'"); 
					if($fila=$consul->objeto->devolverRegistro())
					{
						
						$id_sector=trim($fila['id_sector']);
							if(!$cable->objeto->ejecutarSql("insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$sectcod')")){
								echo "<br>$i:insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$sectcod')";
								$i++;
								echo $cable->objeto->error().'<br>';
							}
					}
					else{
						echo "<br>$secnro:$codsec:$n_calle:$nombre_calle";
					}
	}
}

function restaurar_ordenes($acceso,$cable,$consul,$serie){
	require_once "procesos.php"; $ini_u = "Z$serie";  
		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato   order by nro_contrato LIMIT 10000000 ");

		while($row=row($acceso)){
				$nro_contrato=trim($row['nro_contrato']);
				$id_contrato=trim($row['id_contrato']);
				$nro_contrato=str_replace("$serie",'' ,$nro_contrato);
					$cant_serv=1;
					$rec='';
					$co=false;
					$monto_pago=0;
					
					$consul->objeto->ejecutarSql("select recusr,recusrf,fallnro,recnro,recfching,recfcharr,recsts,recobscea,recobstec  from reclamo where  abocod='$nro_contrato'  order by recnro desc");
					while($fila=row($consul)){
							$fallnro=trim($fila['fallnro']);
							$recnro=trim($fila['recnro']);
							$login=trim($fila['recusr']);
							$login_fin=trim($fila['recusrf']);
							
							$tipo_orden=trim($fila['tipo_orden']);
							$emitida=trim($fila['recfching']);
							$finalizada=trim($fila['recfcharr']);
							$comentario_orden=trim($fila['recobstec']);
							$detalle_orden="".trim($fila['recobscea']);
							$sta=trim($fila['recsts']);
							
						$status=array("C"=>"CANCELADA","P"=>"ASIGNADO","E"=>"IMPRESO","F"=>"FINALIZADO");
						$status_orden=$status[$sta];
						//echo "<br>select  id_det_orden from detalle_orden where id_serv = '$fallnro'";
							$cable->objeto->ejecutarSql("select  id_det_orden from detalle_orden where id_serv = '$fallnro'"); 
					if($fila2=$cable->objeto->devolverRegistro())
					{
						$id_det_orden=trim($fila2['id_det_orden']);
					}
					else{
						$id_det_orden="EA00073";
					}
							$cable->objeto->ejecutarSql("select *from ordenes_tecnicos ORDER BY id_orden desc LIMIT 1 offset 0 ");
							$id_orden=verNumero($cable,"id_orden");
								
							if(!$cable->objeto->ejecutarSql("insert into 					 						ordenes_tecnicos(id_orden,fecha_imp,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad,login,login_fin) values 
							('$recnro','$emitida','$id_det_orden','$emitida','$finalizada','$detalle_orden','$comentario_orden','$status_orden','$id_contrato','NORMAL','$login','$login_fin')")){
								echo "<br>$fallos:insert into 					 						ordenes_tecnicos(id_orden,fecha_imp,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad,login,login_fin) values 
							('$recnro','$emitida','$id_det_orden','$emitida','$finalizada','$detalle_orden','$comentario_orden','$status_orden','$id_contrato','NORMAL','$login','$login_fin')";
								echo $cable->objeto->error().'<br>';
							}
					
				}
			$fallos++;
		}
	//}
}

function actualizar_contrato($acceso,$cable,$consul,$serie){
	require_once "procesos.php"; $ini_u = "Z$serie"; 
	//$tablas=array('clie');
		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where  (id_contrato ILIKE '$ini_u%')  order by id_contrato LIMIT 1000000 offset 0 ");
		//$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where nro_contrato<>'' order by id_contrato LIMIT 20000000 offset 0 ");
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
				//$nro_contrato=str_replace("$serie",'',$nro_contrato);
				//echo "<br><br>$nro_contrato<br>";
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$registro=false;
					$monto_pago=0;
					$rec='';
					$co=false;
					$registro=false;
					$consul->objeto->ejecutarSql("select  consts, paqcod, concntpaq from contrato where  (consts='C' or consts='X')  and (paqcod='2' or paqcod='9' or paqcod='10' or paqcod='12') and abocod='$nro_contrato'");
					//echo "<br>select  consts, paqcod, concntpaq from contrato where  (consts='C' or consts='X') and abocod='$nro_contrato'";
					while($fila=row($consul)){
						$id_serv='';
						
							$paqcod=trim($fila['paqcod']);
							$consts=trim($fila['consts']);
							$cant_serv=trim($fila['concntpaq'])+0;
							echo "<br>$paqcod:$consts:$cant_serv";
							if($paqcod=='2'){
								if($cant_serv==1){
									$id_serv="AM00005";
								}
								else if($cant_serv==2){
									$id_serv="AM00008";
								}
								else if($cant_serv==3){
									$id_serv="AM00009";
								}
								else if($cant_serv==4){
									$id_serv="AM00010";
								}
								$cant_serv=1;
							}
							else if($paqcod=='9'){
								$id_serv="AM00003";
							}
							else if($paqcod=='10'){
								$id_serv="AM00004";
							}
							else if($paqcod=='12'){
								$id_serv="AM00002";
							}
							if($consts=='C'){
								$status_con_ser="CONTRATO";
							}
						//	else{
						//		$status_con_ser="SUSPENDIDO";
						//	}
								$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%') ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
								//echo "<br>:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','$status_con_ser'):";
								$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
								if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','2013-08-01','$cant_serv','$status_con_ser')")){
									echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','$status_con_ser')<br>";
									echo $cable->objeto->error().'<br>';
								}
					}
			$fallos++;
		}
	//}
}

function pasar_pagos_deuda($acceso,$cable,$consul,$serie){
	require_once "procesos.php"; $ini_u = "Z$serie"; 
	//$tablas=array('clie');
		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where  (id_contrato ILIKE '$ini_u%')  order by id_contrato LIMIT 1000000 offset 0 ");
		//$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where nro_contrato<>'' order by id_contrato LIMIT 20000000 offset 0 ");
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
				$nro_contrato=str_replace("$serie",'',$nro_contrato);
				//echo "<br><br>$nro_contrato<br>";
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$registro=false;
					$monto_pago=0;
				
					$rec='';
					$co=false;
					$registro=false;
					$consul->objeto->ejecutarSql("select  docfch, doctpo, docdscpag, abocod, docfchpgo, docnro,docimp,docimpapl from document where  docsts='I' and docimp>0  and abocod='$nro_contrato' order by docfch DESC");
					
					while($fila=row($consul)){
						
							$abocod=trim($fila['abocod']);
							$fecha_inst=trim($fila['docfch']);
							$monto_pago=trim($fila['docimp'])+0;
							$docimpapl=trim($fila['docimpapl'])+0;
							if($monto_pago != $docimpapl){
								$monto_pago = $monto_pago - $docimpapl;
							}
							
							$costo_cobro=$monto_pago;
						if($costo_cobro>0){
							$recibo=trim($fila['docnro']);
							$fecha_pago=trim($fila['docfchpgo']);
							$concepto1=trim($fila['docdscpag']);
							
							if(strstr($concepto1,"MENSUALIDAD PAQ.SUPER ESTELER")){
										$id_serv="AM00004";
									}
									else if(strstr($concepto1,"MENSUALIDAD PAQUETE ESTELAR")){
										$id_serv="AM00003";
									}
									else if(strstr($concepto1,"MENSUALIDAD DEL CANAL DE ADULT")){
										$id_serv="AM00002";
									}
									else if(strstr($concepto1,"MENSUALIDAD PAQUETE ADULTO")){
										$id_serv="AM00002";
									}
									else if(strstr($concepto1,"MENSUALIDAD DE TOMA ADICIONAL")){
										$id_serv="AM00005";
									}
									else if(strstr($concepto1,"MENSUALIDAD")){
										$fecha_inst=ver_fecha($concepto1,$fecha_inst);
										$id_serv="SER00001";
									}
									else if(strstr($concepto1,'DOMICILIO')){
										$id_serv="BM00004";
									}
									else if(strstr($concepto1,'CABLE ADICIONAL')){
										$id_serv="EA00000";
									}
									else if(strstr($concepto1,"PUNTO ADICIONAL")){
										$id_serv="EA00001";
									}
									else if(strstr($concepto1,"RECONEXION")){
										$id_serv="SER00002";
									}
									else if(strstr($concepto1,"ADULTO")){
										$id_serv="AM00002";
									}
									else if(strstr($concepto1,"SUSCRIPCION") || strstr($concepto1,"INSTALACION") || strstr($concepto1,"VENTA CONTRATO")){
										$id_serv="BM00001";
									}
									
									else {
										$id_serv="RE00001";
									}
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda   where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des,descrip) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO','$concepto1')")){
								echo "<br>$fallos:insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des,descrip) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO','$concepto1')";
								echo $cable->objeto->error().'<br>';
							}
						}
					}
			$fallos++;
		}
	//}
}

function pasar_pagos($acceso,$cable,$consul,$serie,$acceso5){
	require_once "procesos.php"; $ini_u = "Z$serie"; 
	//$tablas=array('clie');

		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where   (id_contrato ILIKE '$ini_u%') order by id_contrato LIMIT 1000000 offset 0 ");
		$id_franq="1";
		$fallos=1;
		$f_z=1;
		$f_s=1;
		$f_c=1;
		$falla=array();
		//$acceso->objeto->seekRegistro(8737);
		while($row=row($acceso)){
				
				$nro_contrato=trim($row['nro_contrato']);
				$nro_contrato=str_replace("$serie",'',$nro_contrato);
				$id_contrato=trim($row['id_contrato']);
				//echo "<br>$nro_contrato";
					$cant_serv=1;
					$rec='';
					$co=false;
					$registro=false;
					$monto_pago=0;
				
					$rec='';
					$co=false;
					$registro=false;
					//select  docfch, doctpo, docdscpag, abocod, docfchpgo, docnro,docimp from document where  docsts='P' and docimp>0  and abocod='$nro_contrato' order by docfch DESC
					$consul->objeto->ejecutarSql("select  docfch, doctpo, docdscpag,docref, abocod, docfchpgo, docnro,docimp,docimpapl from document where docsts='V' and docimp>0  and abocod='$nro_contrato' order by docfch DESC LIMIT 12 offset 0 ");
					$id_caja_cob="EA00000001";
					
						while($fila=row($consul)){
						
							$abocod=trim($fila['abocod']);
							
							$fecha_inst=trim($fila['docfch']);
							list($ano,$mes,$dia)=explode("-",$fecha_inst);
							
							$monto_pago=trim($fila['docimp'])+0;
							$base=($monto_pago/1.12);
							$iva=$monto_pago-$base;
							$base=number_format($base+0, 2, '.', '');
							$iva=number_format($iva+0, 2, '.', '');
							
							$docimpapl=trim($fila['docimpapl'])+0;
							
							//echo "<br>$monto_pago";
							$costo_cobro=$monto_pago;
							$docnro=trim($fila['docnro']);
							$recibo=trim($fila['docref']);
							$fecha_pago=trim($fila['docfch']);

							$cable->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%')ORDER BY id_pago desc LIMIT 1 offset 0 "); 
							$id_pago = $ini_u.verCodLargo($cable,"id_pago");
					
							if(!$cable->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,por_iva,base_imp,monto_iva,desc_pago) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato','12','$base','$iva','0')")){
									echo "<br>insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato')";
									echo $cable->objeto->error().'<br>';
							}
									
									if(!$cable->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('TPA00001','$id_pago','','','$monto_pago')")){
										echo "<br>$fallos:insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('TPA00001','$id_pago','','','$monto_pago')";
										echo $cable->objeto->error().'<br>';
									}
													
			
	
						//	echo "<br>select  docnrodoc,dimpapli from docdet where   docnro='$docnro' ";
							$dato=lectura($acceso5,"select  docnrodoc,dimpapli from docdet where   docnro='$docnro' ");
							for($i=0;$i<count($dato);$i++){
								$docnrodoc=trim($dato[$i]["docnrodoc"]);
								$costo_cobro=trim($dato[$i]["dimpapli"]);
								
								$acceso5->objeto->ejecutarSql("select  docdscpag,docfch from document where docnro='$docnrodoc'");
							
								if($fila=row($acceso5)){
									$fecha_inst=trim($fila['docfch']);
									$concepto1=strtoupper(trim($fila['docdscpag']));
									
									
									if(strstr($concepto1,"MENSUALIDAD PAQ.SUPER ESTELER")){
										$id_serv="AM00004";
									}
									else if(strstr($concepto1,"MENSUALIDAD PAQUETE ESTELAR")){
										$id_serv="AM00003";
									}
									else if(strstr($concepto1,"MENSUALIDAD DEL CANAL DE ADULT")){
										$id_serv="AM00002";
									}
									else if(strstr($concepto1,"MENSUALIDAD PAQUETE ADULTO")){
										$id_serv="AM00002";
									}
									else if(strstr($concepto1,"MENSUALIDAD DE TOMA ADICIONAL")){
										$id_serv="AM00005";
									}
									else if(strstr($concepto1,"MENSUALIDAD")){
										$fecha_inst=ver_fecha($concepto1,$fecha_inst);
										$id_serv="SER00001";
									}
									else if(strstr($concepto1,'DOMICILIO')){
										$id_serv="BM00004";
									}
									else if(strstr($concepto1,'CABLE ADICIONAL')){
										$id_serv="EA00000";
									}
									else if(strstr($concepto1,"PUNTO ADICIONAL")){
										$id_serv="EA00001";
									}
									else if(strstr($concepto1,"RECONEXION")){
										$id_serv="SER00002";
									}
									else if(strstr($concepto1,"ADULTO")){
										$id_serv="AM00002";
									}
									else if(strstr($concepto1,"SUSCRIPCION") || strstr($concepto1,"INSTALACION") || strstr($concepto1,"VENTA CONTRATO")){
										$id_serv="BM00001";
									}
									
									else {
										$id_serv="RE00001";
									}
									$cant_serv=1;
									$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado   where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
									$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
									
								//	echo"<br>insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
									if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
										echo "<br>$fallos:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
										echo $cable->objeto->error().'<br>';
									}
									
									if(!$cable->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')")){
										echo "<br>$fallos:insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')";
										echo $cable->objeto->error().'<br>';
									}

								}else{
									echo "<br>ERROR NO EXITE<br>";
								}
							}
							
							if($docimpapl>0){
								echo "<br>:$nro_contrato";
								$id_select=agrega($id_contrato,$docimpapl,$cable,$cable);
								$valor=explode("=@",$id_select);
								
							//	echo "<br>:$id_select:".count($valor);
								for($i=1;$i<count($valor);$i++){
									$id_cont_servD=$valor[$i];
							//		echo "<br>select * from contrato_servicio_deuda where id_cont_serv='$id_cont_servD'";
									$cable->objeto->ejecutarSql("select * from contrato_servicio_deuda where id_cont_serv='$id_cont_servD'");
									if($row=$cable->objeto->devolverRegistro()){		
										$id_serv = trim($row['id_serv']);
										$id_contrato = trim($row['id_contrato']);
										$fecha_inst = trim($row['fecha_inst']);
										$cant_serv = trim($row['cant_serv']);
										$status_con_ser = 'PAGADO';
										$costo_cobro = trim($row['costo_cobro']);
										$descu = trim($row['descu']);
										$modo_des = trim($row['modo_des']);
									}
																		
									$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
									$id_cont_serv=verCodLongP($cable,"id_cont_serv",$ini_u);
									$cable->objeto->ejecutarSql("insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','$descu','$modo_des')");

									$cable->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')");			
									$cable->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_cont_serv='$id_cont_servD'");
								}
								
								
							}	
							
							
							
							
							
							
							
					}
			$fallos++;
		}
	//}
}

function agrega($id_contrato,$monto_pago,$acceso,$acceso1){
$resto=$monto_pago;
if($monto_pago>0){
	while($monto_pago>0){
		$id_select='';
		$monto_pago=$resto;
	
		$acceso1->objeto->ejecutarSql("select id_cont_serv,((cant_serv * costo_cobro)- descu+0 ) as costo,fecha_inst,inc from vista_contratodeu where id_contrato='$id_contrato' and status_con_ser='DEUDA' and costo_cobro>0 order by fecha_inst,inc");

		while($row=row($acceso1)){
			$id_cont_serv=trim($row['id_cont_serv']);
			$fecha_inst=trim($row['fecha_inst']);
			$costo=trim($row['costo'])+0;
		//	echo "<br>$fecha_inst:$monto_pago >= $costo:";
			if($monto_pago>=$costo){
				$id_select=$id_select."=@$id_cont_serv";
				$monto_pago=$monto_pago-$costo;
			}
			else if($monto_pago>0){
				
				$dif=$costo-$monto_pago;
				
				//echo "Update contrato_servicio_deuda Set costo_cobro='$monto_pago', descu='0',cant_serv='1' where id_cont_serv='$id_cont_serv'";
				$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set costo_cobro='$monto_pago', descu='0',cant_serv='1' where id_cont_serv='$id_cont_serv'");
				$id_select=$id_select."=@$id_cont_serv";
				
				$acceso->objeto->ejecutarSql("select * from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'");
				$cad='';
				if($row=row($acceso)){
					$id_serv = trim($row["id_serv"]);
					$id_contrato = trim($row["id_contrato"]);
					$fecha_inst = trim($row["fecha_inst"]);
					$cant_serv = trim($row["cant_serv"]);
					$status_con_ser = trim($row["status_con_ser"]);
					$costo_cob = trim($row["costo_cobro"]);
					
					$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
					$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
					
					//echo "insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','Deuda','$dif','0','AUTOMATICO')";
					$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','Deuda','$dif','0','AUTOMATICO')");
					
				}
				$monto_pago=0;
			}
		}
	//	echo "<br>>monto_pago:$monto_pago:<";
		if($monto_pago>0){
			agregar_mes($acceso,$id_contrato);
			
		}
		if($i==50){
			break;
		}
		$i++;
	}
}
return $id_select;
}

function agregar_mes($acceso,$id_contrato){
	$ini_u = "AX";
	
	$fechaSig=date("Y-m-01"); 
	$fechaSig=restames($fechaSig);
	
	$acceso->objeto->ejecutarSql("select fecha_inst from servicios, contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst>='$fechaSig' and status_con_ser<>'CONTRATO' and tipo_costo='COSTO MENSUAL'  and costo_cobro>0  order by fecha_inst desc ");
	if($row=row($acceso)){
			$fecha_inst_deuda=trim($row["fecha_inst"]);
	}
	
	$acceso->objeto->ejecutarSql("select fecha_inst from servicios, contrato_servicio_pagado where id_contrato='$id_contrato' and fecha_inst>='$fechaSig'  and status_con_ser<>'CONTRATO' and tipo_costo='COSTO MENSUAL'  and costo_cobro>0  order by fecha_inst desc ");
	if($row=row($acceso)){
			$fecha_inst_pagado=trim($row["fecha_inst"]);
	}
	if(comparaFecha($fecha_inst_deuda,$fecha_inst_pagado)>0){
		$fecha=$fecha_inst_deuda;
	}
	else{
		$fecha=$fecha_inst_pagado;
	}
	
	if($fecha==''){
		//$fechaSig=sumames(date("Y-m-01"));
		$fechaSig=date("Y-m-01"); 
	}
	else{
			$fec = explode ( "-", $fecha );
			$mes=$fec[1];
			$anio=$fec[0];
			//echo "$anio"."-$mes"."-01:";
			$fechaSig=sumames("$anio"."-$mes"."-01");
	}
	
			$dato=lectura($acceso,"select id_serv,cant_serv from vista_contratoser where id_contrato='$id_contrato' and status_con_ser='CONTRATO'");
			//echo "select id_serv,cant_serv from vista_contratoser where id_contrato='$id_contrato' and status_con_ser='CONTRATO'";
				$sum_d=0;
			for($i=0;$i<count($dato);$i++){
				$id_serv=trim($dato[$i]['id_serv']);
				$cant_serv=trim($dato[$i]['cant_serv']);
				
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
				//$id_cont_serv=$ini_u.verCodLong($acceso,"id_cont_serv");
				$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
				
				$fecha=$fechaSig;
				
				$acceso->objeto->ejecutarSql("select tarifa_ser from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'"); 
				if($row=row($acceso)){
					$tarifa_ser=trim($row['tarifa_ser']);
				}
				$sum_d=$sum_d+$tarifa_ser;
				
				$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser','0','AUTOMATICO')");
			}
}

function ver_fecha($concepto1,$fecha){

	list($ano,$mes,$dia)=explode("-",$fecha);
	if(strstr($concepto1,"MENSUALIDAD, ENERO")){
		return "$ano-01-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, FEBRERO")){
		return "$ano-02-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, MARZO")){
		return "$ano-03-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, ABRIL")){
		return "$ano-04-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, MAYO")){
		return "$ano-05-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, JUNIO")){
		return "$ano-06-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, JULIO")){
		return "$ano-07-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, AGOSTO")){
		return "$ano-08-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, SEPTIEMBRE")){
		return "$ano-09-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, OCTUBRE")){
		return "$ano-10-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, NOVIEMBRE")){
		return "$ano-11-01";
	}
	else if(strstr($concepto1,"MENSUALIDAD, DICIEMBRE")){
		return "$ano-12-01";
	}
	else{
		return $fecha;
	}
}

function pasar_deudas($acceso,$cable,$consul,$serie){
	require_once "procesos.php"; $ini_u = "Z$serie";
	echo "entro";
	
		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where nro_contrato<>''  and  (id_contrato ILIKE '$ini_u%') order by nro_contrato LIMIT 10000000 offset 0");
		$id_franq="1";
		
		$fallos=1;
		$f_z=1;
		$f_s=1;
		$f_c=1;
		$falla=array();
		//$acceso->objeto->seekRegistro(8737);
		while($row=row($acceso)){
				echo "entro";
				$nro_contrato=trim($row['nro_contrato']);
				$id_contrato=trim($row['id_contrato']);
				$nro_contrato=str_replace("$serie",'',$nro_contrato);
				echo "<br>$nro_contrato : $observacion <br>";
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$registro=false;
					$monto_pago=0;
					
				
					$rec='';
					$co=false;
					$registro=false;
				//if($co==false){
					//echo "<br>select contrato,year,mes,cancelado,fec_cob,recibo,tip_pag,(impuesto+pago2) as pago from alvey1 where contrato='$nro_contrato' and cancelado='SI' and fec_cob between '2000-01-24' and '2012-01-19'  and year between '2000' and '2012'  order by fec_cob desc";
					$consul->objeto->ejecutarSql("select deuda,fecha_c,comenta from clie where contrato='$nro_contrato'");
					while($fila=row($consul)){
						
							
							$fecha_inst=trim($fila['fecha_c']);
							echo "<br>$id_contrato:$nro_contrato: $observacion <br>";
							$monto_pago=trim($fila['deuda']);;
							//echo "<br>$monto_pago";
							$costo_cobro=$monto_pago;
							$observacion=$fecha_inst."; $monto_pago; ".trim($fila['comenta']);
							//$recibo=trim($fila['recibo']);
							//$fecha_pago=trim($fila['fec_cob']);
							$concepto1=trim($fila['tip_pag']);
					
							$cable->objeto->ejecutarSql("Update contrato Set observacion='$observacion' Where id_contrato='$id_contrato'");	
							$id_serv="AQ00001";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda   where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");

						//	echo "<br>$i:insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
							$cable->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_serv='$id_serv' and id_contrato='$id_contrato'");
							
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							/*
							$tipo_orden=trim($fila['tipo_orden']);
							$emitida=$fecha_inst;
							$finalizada=$fecha_inst;
							$comentario=trim($fila['comentario']);
							$concepto=trim($fila['concepto']);
							$coment1=trim($fila['coment1']);
							
								$id_det_orden='DEO00010';

							$id_persona="AB00001";
							
							$cable->objeto->ejecutarSql("delete from ordenes_tecnicos where id_det_orden='DEO00010' and id_contrato='$id_contrato'");
							$cable->objeto->ejecutarSql("select *from ordenes_tecnicos ORDER BY id_orden desc LIMIT 1 offset 0 "); 
							$id_orden = verNumero($cable,"id_orden");		
						//	echo "<br>insert into ordenes_tecnicos(id_orden,id_persona,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$id_persona','$id_det_orden','$emitida','$finalizada','','','FINALIZADA','$id_contrato','NORMAL')";
							$cable->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,id_persona,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$id_persona','$id_det_orden','$emitida','$finalizada','','','FINALIZADA','$id_contrato','NORMAL')");
							*/
					$i++;
							
						  }
						 
				
			$fallos++;
		}
		
	//$tablas=array('clie');
/*
		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where nro_contrato<>'' order by nro_contrato LIMIT 10000 offset 0");
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
				echo "<br>$nro_contrato<br>";
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$registro=false;
					$monto_pago=0;
					
				
					$rec='';
					$co=false;
					$registro=false;
				//if($co==false){
					//echo "<br>select contrato,year,mes,cancelado,fec_cob,recibo,tip_pag,(impuesto+pago2) as pago from alvey1 where contrato='$nro_contrato' and cancelado='SI' and fec_cob between '2000-01-24' and '2012-01-19'  and year between '2000' and '2012'  order by fec_cob desc";
					$consul->objeto->ejecutarSql("select year,mes,(impuesto+monto12) as pago from alvey1 where contrato='$nro_contrato' and (cancelado='NO' or cancelado='') ");
					while($fila=row($consul)){
						
							$year=trim($fila['year']);
							$mes=trim($fila['mes']);
							if($year!=''){
								if($mes!=''){
									$fecha_inst=$year."-".$mes."-01";
								}
								else{
									$fecha_inst=$year."-01-01";
								}
							}
							else{
								$fecha_inst="2011-01-01";
							}
							
							$monto_pago=trim($fila['pago']);
							//echo "<br>$monto_pago";
							$costo_cobro=$monto_pago;
							$recibo=trim($fila['recibo']);
							$fecha_pago=trim($fila['fec_cob']);
							$concepto1=trim($fila['tip_pag']);
					
							$id_serv="SER00001";
							$cant_serv=1;
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda   where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");

							echo "<br>$i:insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
							
					$i++;
							
						  }
						 
				
			$fallos++;
		}
	//}
	*/
	/*
	$acceso->objeto->ejecutarSql("select id_contrato from contrato where status_contrato='CORTADO' order by id_contrato");
		$id_franq="1";
		$fallos=1;
		$f_z=1;
		$f_s=1;
		$f_c=1;
		$falla=array();
		//$acceso->objeto->seekRegistro(8737);
		while($row=row($acceso)){
				
				$id_contrato=trim($row['id_contrato']);
							$cant_serv=1;
							$id_serv="SER00002";
							$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda   where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							$costo_cobro=30;
							$fecha_inst='2012-01-20';
							echo "<br>$i:insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
		}
		*/
		
		
}

function pasar_a_nueva_bd($acceso,$cable,$consul,$serie,$id_franq){
	
	require_once "procesos.php"; $ini_u = "Z$serie"; 
	//$tablas=array('clie');

	$acceso1=conectar("Postgres",'localhost','postgres','123456','copia_guanta');
	$num=count($tablas);
echo "select *from vendedor where id_franq='$id_franq'";
	$cable->objeto->ejecutarSql("select *from vendedor where id_franq='$id_franq'"); 
	if($fila=$cable->objeto->devolverRegistro()){
		$id_vendedor=trim($fila['id_persona']);
	}else{
		$cable->objeto->ejecutarSql("select *from vendedor"); 
		if($fila=$cable->objeto->devolverRegistro()){
			$id_vendedor=trim($fila['id_persona']);
		}
	}
		$table="clie";
		
		$acceso->objeto->ejecutarSql("SELECT  abocod,abodocnro AS cedula, aboape, abonom, abodir, abodir1, abotel, abotel1, abotel2, abotelcod, abotelcod1, abotelcod2, abofching, abofchins, abofchcort, abofchnac , abosts, sectcod, secnro,nodocod,abocodcli,abonatjur, abotap, abotapnro, aboapec, abonomc,aboteltrab,abodocnroc,abotelcelc , abonropre as etiqueta, aboposte FROM abonados order by abocod LIMIT 1000000 offset 0");
		//$id_franq="1";
		$fallos=1;
		$f_z=1;
		$f_s=1;
		$f_c=1;
		$falla=array();
		$ccc=1;
		while($row=row($acceso)){
			if($table=="clie"){
			$nro_contrato=trim($row['abocod']);
				
			$sectcod=trim($row['sectcod']);
			$secnro=trim($row['secnro']);
			$nodocod=trim($row['nodocod']);
			
			$contrato_fisico=trim($row['abocodcli']);
			$abonatjur=trim($row['abonatjur']);
			$tap=trim($row['abotap'])." X ".trim($row['abotapnro']);
			$fecha_nac=trim($row['abofchnac']);
			
			$codcob=trim($row['codcob']);
			$codven=trim($row['codven']);
						
						$vendedor='';
						$cobrador='';
						/*
						$acceso1->objeto->ejecutarSql("select  desven from vendedores where codven='$codven'"); 
						if($fila=$acceso1->objeto->devolverRegistro()){
							$vendedor=trim($fila['desven']);
						}
						*/
					//	echo "<br>select  id_persona from cobrador where codcob='$codcob' and id_franq='$id_franq'";
						$consul->objeto->ejecutarSql("select  id_persona from cobrador where codcob='$codcob' and id_franq='$id_franq'"); 
						if($fila=$consul->objeto->devolverRegistro()){
							$cod_id_persona=trim($fila['id_persona']);
						}else{
							$cod_id_persona='PER00001';
						}
						/*
						$cobrador='';
						$acceso1->objeto->ejecutarSql("select  descob from cobradores where codcob='$codcob'"); 
						if($fila=$acceso1->objeto->devolverRegistro()){
							$cobrador=trim($fila['descob']);
						}
						*/
						/*$consul->objeto->ejecutarSql("select  id_sector from sector where n_sector='$codsec'"); 
						if($fila=$consul->objeto->devolverRegistro()){
							$id_sector=trim($fila['id_sector']);
						}
						$consul->objeto->ejecutarSql("select  nombre_calle,id_calle from calle where n_calle='$codcal'"); 
						if($fila=$consul->objeto->devolverRegistro()){
							$id_calle=trim($fila['id_calle']);
							$nom_calle=trim($fila['nombre_calle']);
						}
						$consul->objeto->ejecutarSql("select  nombre_calle,id_calle from calle where n_calle='$codcal' and id_sector='$id_sector'"); 
						if($fila=$consul->objeto->devolverRegistro()){
							$id_calle=trim($fila['id_calle']);
							$nom_calle=trim($fila['nombre_calle']);
						}
						else{
							echo "<br>Abonado:$nro_contrato: $codcal: $id_sector:la calle no corresponde a un sector registrado";
						}
						*/
				//	echo "select calle.id_calle,sector.id_sector from calle,sector,zona where calle.id_sector=sector.id_sector and sector.id_zona=zona.id_zona and n_calle='$codcal' and n_sector = '$codsec' and n_zona='$codzon'";
						$id_calle='';
						$consul->objeto->ejecutarSql("select calle.id_calle,sector.id_sector from calle,sector where calle.id_sector=sector.id_sector and n_calle='$sectcod' and n_sector = '$nodocod' "); 
						//$consul->objeto->ejecutarSql("select  nombre_calle,id_calle from calle where n_calle='$codcal' and id_sector='$id_sector'"); 
						if($fila=$consul->objeto->devolverRegistro()){
							$id_calle=trim($fila['id_calle']);
						//	$nom_calle=trim($fila['nombre_calle']);
						//	echo "<br>$ccc: $id_calle";
						}
						else{
							$consul->objeto->ejecutarSql("select id_calle from calle where n_calle='$sectcod' "); 
							if($fila=$consul->objeto->devolverRegistro()){
								$id_calle=trim($fila['id_calle']);
							}
							else{
								
							}
							
							echo "<br>$ccc:$nro_contrato: Abonado:$nro_contrato: $sectcod: $nodocod: a calle no corresponde a un sector registrado";
							$ccc++;
						}
				
					
				
				
				
				
				
				$nombre=trim($row['abonom']);
				$apellido=trim($row['aboape']);
				$telf_casa=substr(trim($row['abotelcod']).trim($row['abotel']),0,12);
				$telefono=substr(trim($row['abotelcod1']).trim($row['abotel1']),0,12);
				$telf_adic=substr(trim($row['abotelcod2']).trim($row['abotel2']),0,12);
				$tipocon=trim($row['tipocon']);
					
				$telefono=str_replace("-","",$telefono);
				if(strlen($telefono)==7){
						$telefono="0291".$telefono;
				}
				$telf_casa=str_replace("-","",$telf_casa);
				if(strlen($telf_casa)==7){
						$telf_casa="0291".$telf_casa;
				}
				
				$telf_adic=str_replace("-","",$telf_adic);
				if(strlen($telf_adic)==7){
						$telf_adic="0291".$telf_adic;
				}
				
				$cedula=trim($row['cedula']);
				$cedula=str_replace(".","",$cedula);
				$cedula=str_replace(" ","",$cedula);
				$cedula=str_replace("V","",$cedula);
				$cedula=str_replace("-","",$cedula);
				
				if($abonatjur=='J'){
					$tipo_cliente='JURIDICO';
					$inicial_doc='J';
				}else{
					$tipo_cliente='NATURAL';
					$inicial_doc='V';
				}	
				
			
				$cable->objeto->ejecutarSql("select id_persona from persona  where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc LIMIT 1 offset 0 "); 
				$id_persona = $ini_u.verCodLong($cable,"id_persona");
				
							 //  echo "<br>$fallos:insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$cedula','$nombre','$apellido','$telefono')";
				if(!$cable->objeto->ejecutarSql("insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$cedula','$nombre','$apellido','$telefono')")){
					echo "<br>$fallos:insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$cedula','$nombre','$apellido','$telefono')";
						echo $cable->objeto->error().'<br>';
				}
								//echo "<br>insert into cliente(id_persona,telf_casa,email,telf_adic,tipo_cliente,$inicial_doc) values ('$id_persona','$telf_casa','$email','$telf_adic','$tipo_cliente','$inicial_doc')<br>";
				if(!$cable->objeto->ejecutarSql("insert into cliente(id_persona,telf_casa,email,telf_adic,tipo_cliente,inicial_doc,fecha_nac) values ('$id_persona','$telf_casa','$email','$telf_adic','$tipo_cliente','$inicial_doc','$fecha_nac')")){
					echo "<br>$fallos:insert into cliente(id_persona,telf_casa,email,telf_adic,tipo_cliente,inicial_doc,fecha_nac) values ('$id_persona','$telf_casa','$email','$telf_adic','$tipo_cliente','$inicial_doc','$fecha_nac')";
						echo $cable->objeto->error().'<br>';
				}
				else{
					$aboapec=trim($row['aboapec']);
					$abonomc=trim($row['abonomc']);
					$aboteltrab=trim($row['aboteltrab']);
					$cedula=trim($row['abodocnroc']);
					$abotelcelc=trim($row['abotelcelc']);
					$cedula=trim($row['cedula']);
					$cedula=str_replace(".","",$cedula);
					$cedula=str_replace(" ","",$cedula);
					$cedula=str_replace("V","",$cedula);
					$cedula=str_replace("-","",$cedula);
					if($aboapec!=''){
						$cable->objeto->ejecutarSql("select id_persona from conyuge  where (id_persona ILIKE 'CY%')  ORDER BY id_persona desc LIMIT 1 offset 0 "); 
						$id_persona_cony = "CY".verCodLong($cable,"id_persona");
					
						if(!$cable->objeto->ejecutarSql("insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona_cony','$cedula','$abonomc','$aboapec','$aboteltrab')")){
							echo "<br>$fallos:insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$cedula','$nombre','$apellido','$telefono')";
								echo $cable->objeto->error().'<br>';
						}
						if(!$cable->objeto->ejecutarSql("insert into conyuge(id_persona,id_persona_cliente,telf_casa) values ('$id_persona_cony','$id_persona','$abotelcelc')")){
							echo "<br>$fallos:insert into conyuge(id_persona,id_persona_cliente,telf_casa,email,telf_adic,fecha_nac) values ('$id_persona_cony','$id_persona','$telf_casa','$email','$telf_adic','$fecha_nac')";
								echo $cable->objeto->error().'<br>';
						}
					}
				}

				$nro_factura=trim($row['contrato']);
				$fecha_contrato=trim($row['abofching']);
				//$fecha_contrato=trim($row['abofchins']);
				$hora_contrato="09:00:00";
				$etiqueta=trim($row['etiqueta']);
				$postel=trim($row['aboposte']);
				$pto=trim($row['puntos']);
				$costo_contrato=0.00;
				$costo_dif_men=0.00;
				$sta=trim($row['abosts']);
				$status=array("C"=>"ACTIVO","X"=>"CORTADO","E"=>"POR INSTALAR","A"=>"ANULADO","D"=>"DUPLICADO");
				$status_contrato=$status[$sta];
				
				
				$direc_adicional=trim($row['abodir'])."; ".trim($row['abodir1']);
				//$direc_adicional='';
				
				$numero_casa=trim($row['vivienda']);
				
				$edificio='';
				$numero_piso='';
				
				$fecha_inst=trim($row['abofchins']);
				$fecha_c=trim($row['abofchcort']);
				$observacion="Fecha inst: $fecha_inst; Fecha Corte. $fecha_c;  ".trim($row['observa']);
				
				
				$cable->objeto->ejecutarSql("select id_contrato from contrato  where (id_contrato ILIKE '$ini_u%')  ORDER BY id_contrato desc  LIMIT 1 offset 0 ");
				$id_contrato=$ini_u.verCodLong($cable,"id_contrato");
				
				//echo "<br>$fallos:insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso) values ('$id_contrato','$id_calle','$id_vendedor','$id_persona','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','','$direc_adicional','$numero_casa','$edificio','$numero_piso')<br>";
				$id_g_a='AM001';
				
				
				if(!$cable->objeto->ejecutarSql("insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso,pto,id_g_a,postel,cod_id_persona,contrato_fisico) values ('$id_contrato','$id_calle','$id_vendedor','$id_persona','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','$nro_factura','$direc_adicional','$numero_casa','$edificio','$numero_piso','$pto','$id_g_a','$postel','$cod_id_persona','$contrato_fisico')")){
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
					//echo "select  paqcod,consts,concntpaq from contrato where abocod='$nro_contrato' and ( consts='C' or consts='X' ) and (paqcod='2' or paqcod='9' or paqcod='10' or paqcod='12')";
					
						$acceso1->objeto->ejecutarSql("select  paqcod,consts,concntpaq from contrato where abocod='$nro_contrato' and ( consts='C' or consts='X' ) and (paqcod='2' or paqcod='9' or paqcod='10' or paqcod='12')"); 
						while($fila=row($acceso1)){
							$paqcod=trim($fila['paqcod']);
							$consts=trim($fila['consts']);
							$cant_serv=trim($fila['concntpaq']);
							
							if($paqcod=='2'){
								$id_serv="AM00005";
							}
							else if($paqcod=='9'){
								$id_serv="AM00003";
							}
							else if($paqcod=='10'){
								$id_serv="AM00004";
							}
							else if($paqcod=='12'){
								$id_serv="AM00002";
							}
							
							if($consts=='C'){
								$status_con_ser="CONTRATO";
							}
							else{
								$status_con_ser="SUSPENDIDO";
							}		

								$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%') ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
								$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
								
								if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','$status_con_ser')")){
									echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','$status_con_ser')<br>";
									echo $cable->objeto->error().'<br>';
								}
							
						}
						
					
					
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
		 	echo "<br>$ruta$file";
           if(filetype($ruta . $file)=="file"){
				echo "<br>$ruta$file";
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
echo ":$thefile:";
if($thefile){

    $dbf->dbf_c($thefile);
    $num_rec=$dbf->dbf_num_rec;
    $field_num=$dbf->dbf_num_field;
   
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
	echo "<br>".$sql;
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
			
				//if(strstr($date,"\A5")){
					
				//}
				$row[$j]=str_replace("\A5","\D1",$row[$j]);
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
				echo "<br>$i:$sql";
				echo $acceso->objeto->error().'<br>';
			}
			else{
			//	echo "<br>$i:";
			}
			
		//}
    }
	

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
