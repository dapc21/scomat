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
	$acceso=conectar("ODBC",'SAECOG7','','','copiaboxy');
	$acceso1=conectar("ODBC",'SAECOG7','','','copiaboxy');
	
	/*$acceso=conectar("ODBC",'localhost','','',$database_serie);
	$acceso5=conectar("ODBC",'localhost','','',$database_serie);
	*/
	
	//$acceso1=conectar("ODBC",'saecog7','sa','akasky55!','CopiaBoxi');

	$cable=conectar("Postgres",'localhost','postgres','123456','saeco_cablenorte');
	$cable1=conectar("Postgres",'localhost','postgres','123456','saeco_cablenorte');
	$consul=conectar("Postgres",'localhost','postgres','123456','saeco_cablenorte');
	$ini_u="CN";
//	guardar_en_base_datos($dir,$acceso);

//	restaurar_ubi($acceso,$cable,$consul,$ini_u);

    pasar_a_nueva_bd($acceso,$cable,$consul,$ini_u);
//	actualizar_contrato($acceso,$cable,$consul,$ini_u);
//	pasar_pagos($cable1,$cable,$acceso,$acceso1,$ini_u);
//	pasar_pagos_deuda($cable1,$cable,$acceso,$ini_u);
//	restaurar_ordenes($cable1,$cable,$acceso,$ini_u);
}
function restaurar_ubi($acceso,$cable,$consul,$ini_u){
	//echo "entro";
	require_once "procesos.php";
	//$id_franq='2'; //guarataro
	$id_franq='1'; //catia
	//$id_franq='2'; //manicomio
	//$id_franq='5'; //la pastatora
	
	//$cable->objeto->ejecutarSql("delete from zona ;");
	//$cable->objeto->ejecutarSql("delete from ciudad ;");
	/*
	$cable->objeto->ejecutarSql("update zona set n_zona='';");
	$cable->objeto->ejecutarSql("update zona set n_zona='';");
	$cable->objeto->ejecutarSql("update sector set n_sector='';");
	$cable->objeto->ejecutarSql("update calle set n_calle='';");*/
	/*
	
	$acceso->objeto->ejecutarSql("select prefijo,nombre, from unineg order by prefijo");
		while($row=row($acceso)){
				$codizona=trim($row['prefijo']);
				$nombre_zona=trim($row['nombre']);
				$cable->objeto->ejecutarSql("select *from zona  where (id_zona ILIKE '%$ini_u%') ORDER BY id_zona desc  LIMIT 1 offset 0 "); 
				$id_zona=$ini_u.verCo($cable,"id_zona");
				
				$cable->objeto->ejecutarSql("select *from zona  where (id_zona ILIKE '%$ini_u%') ORDER BY id_zona desc  LIMIT 1 offset 0 "); 
				$nro_zona=verNumero($cable,"id_zona");
				

				 $cable->objeto->ejecutarSql("select *from ciudad  where (id_ciudad ILIKE '$ini_u%') ORDER BY id_ciudad desc LIMIT 1 offset 0"); 
				 $id_ciudad=$ini_u.verCo($cable,"id_ciudad");
			
					$id_mun="EA000001";
					if($nombre_zona!=""){
						
						if(!$cable->objeto->ejecutarSql("insert into ciudad(id_ciudad,id_mun,nombre_ciudad,status_ciudad,prefijo) values ('$id_ciudad','$id_mun','$nombre_zona','ACTIVO','$codizona')")){
							echo "<br>insert into ciudad(id_ciudad,id_mun,nombre_ciudad,status_ciudad) values ('$id_ciudad','$id_mun','$nombre_zona','ACTIVO')";
							echo $cable->objeto->error().'<br>';
						}	
						if(!$cable->objeto->ejecutarSql("insert into zona(id_zona,nro_zona,id_franq,nombre_zona,n_zona,id_ciudad) values ('$id_zona','$nro_zona','	$id_franq','$nombre_zona','$codizona','$id_ciudad')")){
							echo "<br>insert into zona(id_zona,nro_zona,id_franq,nombre_zona,n_zona,id_ciudad) values ('$id_zona','$nro_zona','$id_franq','$nombre_zona','$codizona','$id_ciudad')";
							echo $cable->objeto->error().'<br>';
						}
						
				}
	}
	

	$acceso->objeto->ejecutarSql("select mancodmanz,man_nombre,codloc from manzanas order by man_nombre");
	while($row=row($acceso)){
				$id_zona='';
				$codloc=substr(trim($row['codloc']),2,3);
				$n_sector=trim($row['mancodmanz']);
				$nombre_sector=trim($row['man_nombre']);
				//echo $codloc.":   ";
				
				$cable->objeto->ejecutarSql("select id_zona from zona  where n_zona='$codloc'");
				if($fila=$cable->objeto->devolverRegistro()){
					$id_zona=trim($fila['id_zona']);
				
				
				$cable->objeto->ejecutarSql("select *from sector  where (id_sector ILIKE '%$ini_u%') ORDER BY id_sector desc  LIMIT 1 offset 0 "); 
				$id_sector="$ini_u".verCo($cable,"id_sector");
				
				$cable->objeto->ejecutarSql("select id_sector from sector where (id_sector ILIKE '%$ini_u%') ORDER BY id_sector desc LIMIT 1 offset 0 "); 
				$nro_sector=verNumero($cable,"id_sector");
						
						
						if(!$cable->objeto->ejecutarSql("insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector,afiliacion) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector','$n_sector','')")){
							echo "<br>insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector,afiliacion) values ('$id_sector','$nro_sector','$id_zona','$nombre_sector','$n_sector','')";
							echo $cable->objeto->error().'<br>';
						}
						
				}
						
			//	$cable->objeto->ejecutarSql("insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_sector','$nro_sector','$id_sector','$nombre_sector','')");
	}*/
	/*
	$cable->objeto->ejecutarSql("DELETE from calle ");
	$acceso->objeto->ejecutarSql("select clvcalle,mancodmanz,nombre   from calles ");
	$i=1;
	while($row=row($acceso)){
				$id_zona='';
				$mancodmanz=trim($row['mancodmanz']);
				$nombre_calle=utf8_decode(trim($row['nombre']));
				$clvcalle=trim($row['clvcalle']);
				//echo "<br>select id_sector from vista_sector1  where nombre_sector='$nombre_sector' and id_franq='$id_franq'";
				$cable->objeto->ejecutarSql("select id_sector from sector  where n_sector='$mancodmanz' ");
				if($fila=$cable->objeto->devolverRegistro()){
					$id_sector=trim($fila['id_sector']);
				
				
				
				$cable->objeto->ejecutarSql("select id_sector from calle where (id_calle ILIKE '%$ini_u%') ORDER BY id_calle desc LIMIT 1 offset 0 "); 
				$nro_calle=verNumero($cable,"id_calle");
				
				$i++;
				
				$cable->objeto->ejecutarSql("select *from calle  where (id_calle ILIKE '%$ini_u%') ORDER BY id_calle desc  LIMIT 1 offset 0 "); 
				$id_calle="$ini_u".verCo($cable,"id_calle");
				
				if(!$cable->objeto->ejecutarSql("insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$clvcalle')")){
					echo "<br>insert into calle(id_calle,nro_calle,id_sector,nombre_calle,n_calle) values ('$id_calle','$nro_calle','$id_sector','$nombre_calle','$clvcalle')";
					echo $cable->objeto->error().'<br>';
				}
				
		}
	}*/
	/*
	
	
	
	$acceso->objeto->ejecutarSql("select nomconjunt,nomurbaniz,codizona, count(*) from cliente where nomconjunt<>'' and nomconjunt<>',' and nomconjunt<>'.' and nomconjunt<>'..'  and nomconjunt<>'...'  and nomconjunt<>'0'  and nomconjunt<>'00' group by nomconjunt,nomurbaniz,codizona  order by codizona,nomurbaniz,nomconjunt;");
	$i=1;
	while($row=row($acceso)){
				$id_zona='';
				$codizona=trim($row['codizona']);
				$nombre_sector=trim($row['nomurbaniz']);
				$nombre_urb=trim($row['nomconjunt']);
				$cable->objeto->ejecutarSql("select id_sector from vista_sector1  where nombre_sector='$nombre_sector' and id_franq='$id_franq'");
				if($fila=$cable->objeto->devolverRegistro()){
					$id_sector=trim($fila['id_sector']);
				
				
				
				$cable->objeto->ejecutarSql("select id_sector from urbanizacion where (id_urb ILIKE '%$ini_u%') ORDER BY id_urb desc LIMIT 1 offset 0 "); 
				$nro_urb=verNumero($cable,"id_urb");
				
				$i++;
				
				$cable->objeto->ejecutarSql("select *from urbanizacion  where (id_urb ILIKE '%$ini_u%') ORDER BY id_urb desc  LIMIT 1 offset 0 "); 
				$id_urb="$ini_u".verCo($cable,"id_urb");
				
				if(!$cable->objeto->ejecutarSql("insert into urbanizacion(id_urb,id_sector,nombre_urb) values ('$id_urb','$id_sector','$nombre_urb')")){
					echo "<br>insert into urbanizacion(id_urb,id_sector,nombre_urb) values ('$id_urb','$id_sector','$nombre_urb')";
					echo $cable->objeto->error().'<br>';
				}
				
		}
	}
	
	
	
	
	$acceso->objeto->ejecutarSql("select nomedif,nomurbaniz,codizona, count(*) from cliente where nomedif<>'' and nomedif<>',' and nomedif<>'.' and nomedif<>'..'  and nomedif<>'...'  and nomedif<>'0'  and nomedif<>'00' group by nomedif,nomurbaniz,codizona  order by codizona,nomurbaniz,nomedif;");
	$i=1;
	while($row=row($acceso)){
				$id_zona='';
				$codizona=trim($row['codizona']);
				$nombre_sector=trim($row['nomurbaniz']);
				$edificio=trim($row['nomedif']);
				$cable->objeto->ejecutarSql("select id_sector from vista_sector1  where nombre_sector='$nombre_sector' and id_franq='$id_franq'");
				if($fila=$cable->objeto->devolverRegistro()){
					$id_sector=trim($fila['id_sector']);
				
				$id_calle="PO00020";
				
				$cable->objeto->ejecutarSql("select id_sector from edificio where (id_edificio ILIKE '%$ini_u%') ORDER BY id_edificio desc LIMIT 1 offset 0 "); 
				$nro_edificio=verNumero($cable,"id_edificio");
				
				$i++;
				
				$cable->objeto->ejecutarSql("select *from edificio  where (id_edif ILIKE '%$ini_u%') ORDER BY id_edif desc  LIMIT 1 offset 0 "); 
				$id_edif="$ini_u".verCo($cable,"id_edif");
				
				if(!$cable->objeto->ejecutarSql("insert into edificio(id_edif,id_calle,edificio) values ('$id_edif','$id_calle','$edificio')")){
					echo "<br>insert into edificio(id_edif,id_calle,edificio) values ('$id_edif','$id_calle','$edificio')";
					echo $cable->objeto->error().'<br>';
				}
				
		}
	}
	
	*/
}

function restaurar_ordenes($acceso,$cable,$consul,$ini_u){
	require_once "procesos.php"; 
		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where id_contrato ilike '$ini_u%'  order by id_contrato LIMIT 100000000 offset 0 ");
		$cable->objeto->ejecutarSql("select *from ordenes_tecnicos ORDER BY id_orden desc LIMIT 1 offset 0 "); 
		$id_orden = verNumero($cable,"id_orden");		
		while($row=row($acceso)){
			
				$nro_contrato=trim($row['nro_contrato']);
				$id_contrato=trim($row['id_contrato']);
				$nro_contrato=str_replace("O","",$nro_contrato);	
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$monto_pago=0;
					
					//echo "select inicclie,conorden,observacion,final,status from orden where codiclie='$nro_contrato' order by inicclie desc <br>";
						
					$consul->objeto->ejecutarSql("select inicclie,conorden,observacio,final,status,tipoorden from orden where  codiclie='$nro_contrato' order by inicclie desc ");
					
					while($fila=row($consul)){
						//echo "entros";
							$conorden=trim($fila['conorden']);
							$tipoorden=trim($fila['tipoorden']);
							
							$emitida=formatfecha(trim($fila['inicclie']));
							$fecha_imp=formatfecha(trim($fila['inicclie']));
							$finalizada=formatfecha(trim($fila['final']));
							$comentario=trim($fila['observacio']);
							//$concepto=trim($fila['conorden']);
							
							$status=trim($fila['status']);
							$conorden=trim($fila['conorden']);
							/*
							if($status=="PENDIENTE" || $status=="ANULADA"){
								$finalizada=formatfecha(trim($fila['inicclie']));
							//	echo "<br>:$finalizada:";
							}
							*/
							if(trim($fila['final'])==''){
								$finalizada=formatfecha(trim($fila['inicclie']));
							}
							$status1=array("PENDIENTE"=>"IMPRESO","FINALIZADA"=>"FINALIZADO","ANULADA"=>"CANCELADA");
							$status=$status1[$status];
							//ECHO "<BR>$conorden";
							
							     if($tipoorden=='CD' or $tipoorden=='SP' or $tipoorden=='OC'){
								$id_det_orden='DEO00010';
							}
							else if($tipoorden=='OA'){
								$id_det_orden="EA000100";
							}
							else if($tipoorden=='OI'){
								$id_det_orden='DEO00001';
							}
							else if($tipoorden=='PA'){
								$id_det_orden='DEO00002';
							}
							else if($tipoorden=='RC'){
								$id_det_orden='DEO00003';
							}
							else if($tipoorden=='SE'){
								if(strpos($conorden, "PUNTO ADICIONAL")!=false){
									$id_det_orden="DEO00002";
								}
								else if(strpos($conorden, "MUDANZA")!=false){
									$id_det_orden="EA00056";
								}
								else if(strpos($conorden, "MALA SEÑAL")!=false){
									$id_det_orden="EA00073";
								}
								else if(strpos($conorden, "REVISION")!=false){
									$id_det_orden="EA000100";
								}
								else{
									$id_det_orden='EA00073';
								}
							}
							else if($tipoorden=='ST'){
								$id_det_orden='EA00053';
							}	
							else{
								$id_det_orden="EA000100";
							}
							/*
							$consul->objeto->ejecutarSql("update ordenes_tecnicos set detalle_orden='$direc_adicional',comentario_orden='', id_det_ordenid_det_orden='$id_det_orden' where id_contrato = '$id_contrato'");
							*/
							/*
							
							
							
							if(strpos($conorden, "INSTALACION")!=false){
								$id_det_orden='DEO00001';
							}
							else if(strpos($conorden, "MUDANZA")!=false){
								$id_det_orden="EA00056";
							}
							else if(strpos($conorden, "RECONEXION")!=false){
								ECHO "reco:$conorden:";
								$id_det_orden="DEO00003";
							}
							else if(strpos($conorden, "MALA SEÑAL")!=false){
								$id_det_orden="EA00073";
							}
							else if(strpos($conorden, "REVISION")!=false){
								$id_det_orden="EA00073";
							}
							else if(strpos($conorden, "PUNTO ADICIONAL")!=false){
								$id_det_orden="DEO00002";
							}
							else if(strpos($conorden, "RETIRO DEFINITIVO")!=false){
								$id_det_orden="EA00053";
							}
							else if(strpos($conorden, "SUSPENCION TEMPORAL")!=false){
								$id_det_orden="EA00053";
							}
							else if(strpos($conorden, "SUSPENCION")!=false){
								$id_det_orden="EA00053";
							}
							else if(strpos($conorden,"AUDITORIA")!=false){
								$id_det_orden="EA00099";
							}
							else if(strpos($conorden, "CORTE POR DEMORA EN PAGO")!=false){
								$id_det_orden="DEO00010";
							//	ECHO "ENTRO";
							}
							else {
								$id_det_orden='AM00001';
							}

							$id_persona="AM00001";
							*/
							
							
							if(!$cable->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,fecha_imp,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$fecha_imp','$id_det_orden','$emitida','$finalizada','$conorden','$comentario','$status','$id_contrato','NORMAL')")){
								echo "<br>insert into ordenes_tecnicos(id_orden,fecha_imp,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$fecha_imp','$id_det_orden','$emitida','$finalizada','$conorden','$comentario','$status','$id_contrato','NORMAL')";
								echo $cable->objeto->error().'<br>';
							}
							$id_orden++;
							
					}
		}
	//}
}

function pasar_pagos($acceso,$cable,$consul,$consul1,$ini_u){
	require_once "procesos.php"; 
	//$tablas=array('clie');
		
		echo "select id_contrato,nro_contrato from contrato where id_contrato ilike '$ini_u%'  order by id_contrato LIMIT 100000 offset 0 ";
		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where id_contrato ilike '$ini_u%'  order by id_contrato LIMIT 10000000 offset 0 ");
		$id_franq='4';
		$fallos=1;
		$f_z=1;
		$f_s=1;
		$f_c=1;
		$falla=array();
		//$acceso->objeto->seekRegistro(8737);
		$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado   where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
		$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
		
		$cable->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%')ORDER BY id_pago desc LIMIT 1 offset 0 "); 
		$id_pago = $ini_u.verCodLargo($cable,"id_pago");
							
		while($row=row($acceso)){
				
				$nro_contrato=trim($row['nro_contrato']);
				$id_contrato=trim($row['id_contrato']);
				//echo "<br><br>$nro_contrato<br>";
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$registro=false;
					$monto_pago=0;
				
					$rec='';
					$co=false;
					$registro=false;
						
					
						
					$consul->objeto->ejecutarSql("select cuentaco.fechmovi,fechreci,abonreci,cuentaco.factmovi,cuencobr.numereci,tippagrec,numcherec,bancreci from  recibocx , cuentaco,cuencobr where   cuentaco.factmovi = cuencobr.factmovi and  recibocx.numereci=cuencobr.numereci  and cuentaco.codiclie='$nro_contrato' order by fechreci DESC LIMIT 8 offset 0 ");
					while($fila=row($consul)){
					//	echo "hola";
							
							$fecha_inst=trim($fila['fechmovi']);
							$monto_pago=trim($fila['abonreci'])+0;
							$costo_cobro=$monto_pago;
							$recibo=trim($fila['factmovi']);
							$nro_control=trim($fila['numereci']);
							$fecha_pago=trim($fila['fechreci']);
							$tippagrec=trim($fila['tippagrec']);
							$banco=trim($fila['bancreci']);
							$numero=trim($fila['numcherec']);
							list($ano,$mes,$dia)=explode("-",$fecha_inst);
							
							$id_tipo_pago='TPA00001';
							
								if($tippagrec=='DEPOSITO'){
									$id_tipo_pago='TPA00003';
								}
								else if($tippagrec=='TARJETA'){
									$id_tipo_pago='TPA00005';
								}
								else if($tippagrec=='CHEQUE'){
									$id_tipo_pago='TPA00008';
								}
								else if($tippagrec=='EFECTIVO'){
									$id_tipo_pago='TPA00001';
								}
							
								$id_serv="SER00001";
							
							$cant_serv=1;
						
					
						
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
								
							$id_caja_cob="EA00000004";
							
							
					
							if(!$cable->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato','$nro_control')")){
									echo "<br>insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato')";
									echo $cable->objeto->error().'<br>';
							}
							
							if(!$cable->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('$id_tipo_pago','$id_pago','$banco','$numero','$costo_cobro')")){
									echo "<br>insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('$id_tipo_pago','$id_pago','$banco','$numero','$costo_cobro')";
									echo $cable->objeto->error().'<br>';
							}
							if(!$cable->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')")){
									echo "<br>insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')";
									echo $cable->objeto->error().'<br>';
							}
							$id_pago=$ini_u.verCodLongInc_pago($acceso,$id_pago);
							$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
						  }//WHILE 
						  
						  
						  

						//  ECHO"select  fechmovi, factmovi, moncuecob, culcuecob from cuentaco where moncuecob<0  and codiclie='$nro_contrato' and culcuecob='1111-11-11'  order by fechmovi DESC LIMIT 12 offset 0 ";

					$consul->objeto->ejecutarSql("select  fechmovi, factmovi, moncuecob, culcuecob from cuentaco where moncuecob<0  and codiclie='$nro_contrato' and culcuecob='1111-11-11'  order by fechmovi DESC LIMIT 12 offset 0 ");
					while($fila=row($consul)){
					//	echo "hola";
							
							$fecha_inst=trim($fila['fechmovi']);
							
							$monto_pago=trim($fila['moncuecob'])+0;
							$monto_pago=abs($monto_pago);
							if($monto_pago>1000){
								$monto_pago=$monto_pago/1000;
							}
							$costo_cobro=$monto_pago;
							$recibo=trim($fila['factmovi']);
							$fecha_pago=trim($fila['culcuecob']);
							list($ano,$mes,$dia)=explode("-",$fecha_inst);
							
								$id_serv="SER00001";
							
							$cant_serv=1;
							$fecha_pago=date("2013-09-01");
							
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','PAGADO','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							
							$id_caja_cob="EA00000001";
							
							
					
							if(!$cable->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato')")){
									echo "<br>insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato) values ('$id_pago','$id_caja_cob','$fecha_pago','08:00:00','$monto_pago','PAGADO CON EL SISTEMA ANTERIOR','PAGADO','$recibo','$id_contrato')";
									echo $cable->objeto->error().'<br>';
							}
							
							$cable->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('TPA00001','$id_pago','','','$costo_cobro')");
							$cable->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago','$id_cont_serv')");
							
							$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
							
							$id_pago=$ini_u.verCodLongInc_pago($acceso,$id_pago);
						  }//WHILE 
						  
						  
			$fallos++;
		}
	//}
}

function pasar_pagos_deuda($acceso,$cable,$consul,$ini_u){
	require_once "procesos.php"; 
	//$tablas=array('clie');

		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato where id_contrato ilike '$ini_u%'  order by id_contrato LIMIT 20000000 offset 0 ");
		$id_franq='4';
		$fallos=1;
		$f_z=1;
		$f_s=1;
		$f_c=1;
		$falla=array();
		//$acceso->objeto->seekRegistro(8737);
		$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda   where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
		$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
							
		while($row=row($acceso)){
				
				$nro_contrato=trim($row['nro_contrato']);
				$id_contrato=trim($row['id_contrato']);
				//echo "<br><br>$nro_contrato<br>";
					$cant_serv=1;
					
					$rec='';
					$co=false;
					$registro=false;
					$monto_pago=0;
				
					$rec='';
					$co=false;
					$registro=false;
				
					//echo "select  fechmovi, factmovi, salcuecob, culcuecob from cuentaco where salcuecob>0  and codiclie='$nro_contrato' and culcuecob<>'1111-11-11' order by fechmovi DESC LIMIT 8 offset 0 ";
					$consul->objeto->ejecutarSql("select  fechmovi, factmovi, salcuecob, culcuecob from cuentaco where  codiclie='$nro_contrato' and salcuecob>0 and fechmovi >= '2008-01-01' order by fechmovi DESC ");
					while($fila=row($consul)){
					//	echo "hola";
							
							$fecha_inst=trim($fila['fechmovi']);
							
							$monto_pago=trim($fila['salcuecob'])+0;
							if($monto_pago>1000){
								$monto_pago=$monto_pago/1000;
							}
							$costo_cobro=$monto_pago;
							$recibo=trim($fila['factmovi']);
							$fecha_pago=trim($fila['culcuecob']);
							list($ano,$mes,$dia)=explode("-",$fecha_inst);

							//if($dia=="01" || $dia=="02" || $dia=="03" || $dia=="27" || $dia=="28" || $dia=="29" || $dia=="30" || $dia=="31"){
								$id_serv="SER00001";
						/*	}
							else{
								$id_serv="RE00001";
							}
							*/
							$cant_serv=1;
							
							
							
							if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')")){
								echo "<br>$fallos:insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$costo_cobro')";
								echo $cable->objeto->error().'<br>';
							}
							$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
			
			
			
				}//while

	}//while
}

function pasar_a_nueva_bd($acceso,$cable,$consul,$ini_u){
	require_once "procesos.php";
	$num=count($tablas);
	$cable->objeto->ejecutarSql("select *from vista_vendedor"); 
	
	$acceso->objeto->ejecutarSql("SELECT ABONUMERO AS codiclie,suspendido,rifclie,nombclie,nombclie1,apeclie,apeclie1,direclie,email,teleclie, teleclie1,teleclie2,teleclie3,teleclie4, codmensual,nomurbaniz,fechacontr,tag,poste,refeclie,fechainsta                                  ,napto,npiso,nomconjunt,ncalle,nomedif,ubicavivie                         FROM cliente  order by codiclie LIMIT 1000000 offset 0");
		
	
	$acceso->objeto->ejecutarSql("select *from vista_vendedor"); 
	while($row=row($acceso)){
	
/*CROMENTARIO CREADO POR RICARDO**********************************************************************************************************************************
/*CROMENTARIO CREADO POR RICARDO**********************************************************************************************************************************
	
	if($fila=$cable->objeto->devolverRegistro()){
		$id_vendedor=trim($fila['id_persona']);
	}

		$table="clie";
		
		//$id_franq='2'; //guarataro
		$id_franq='2'; //la pastatora
		//$acceso->objeto->ejecutarSql("delete from cliente where id_persona<>'PER00001' and id_persona<>'EA00001';delete from persona where id_persona<>'PER00001' and id_persona<>'EA00001';");
		//$acceso->objeto->ejecutarSql("SELECT codiclie,suspendido,rifclie,nombclie,nombclie1,apeclie,apeclie1,direclie,email,teleclie, teleclie1,teleclie2,teleclie3,teleclie4, codmensual,nomurbaniz,fechacontr,tag,poste,refeclie,fechainsta                                  ,napto,npiso,nomconjunt,ncalle,nomedif,ubicavivie                         FROM cliente  order by codiclie LIMIT 1000000 offset 0");
		
		$acceso->objeto->ejecutarSql("SELECT codiclie,suspendido,rifclie,nombclie,nombclie1,apeclie,apeclie1,direclie,email,teleclie, teleclie1,teleclie2,teleclie3,teleclie4, codmensual,nomurbaniz,fechacontr,tag,poste,refeclie,fechainsta                                  ,napto,npiso,nomconjunt,ncalle,nomedif,ubicavivie                         FROM cliente  order by codiclie LIMIT 1000000 offset 0");
		
		$falla=array();
		
		while($row=row($acceso)){
		if($table=="clie"){
			$numero_casa=substr(trim($row['napto']), 0,10);
			$numero_piso=substr(trim($row['npiso']), 0,14);
			$edificio=trim($row['nomedif']);
			$urbanizacion=trim($row['nomconjunt']);
			$ncalle=trim($row['ncalle']);

			$nro_contrato=trim($row['codiclie']);
			$suspendido=trim($row['suspendido']);
			$rifclie=trim($row['rifclie']);
			//echo trim($row['nombclie'])." ".trim($row['nombclie1'])."<br>";
			$nombre=substr(trim($row['nombclie'])." ".trim($row['nombclie1']), 0,50);
			
			$apellido=substr(trim($row['apeclie'])." ".trim($row['apeclie1']), 0,50);
			$nombre=str_replace(".","",$nombre);
			$apellido=str_replace(".","",$apellido);
			
**********************************************************************************************************CIERRE DE COMENTARIO CREADO POR EL USUARIO
**********************************************************************************************************CIERRE DE COMENTARIO CREADO POR EL USUARIO*/

			
			/*
			$nombre=utf8_encode(trim($row['nombclie'])." ".trim($row['nombclie1']));
			$apellido=utf8_encode(trim($row['apeclie'])." ".trim($row['apeclie1']));
			*/
			
			
/*CROMENTARIO CREADO POR RICARDO**********************************************************************************************************************
/*CROMENTARIO CREADO POR RICARDO**********************************************************************************************************************
			$direc_adicional=trim($row['ubicavivie']);
			$otra_dir=trim($row['direclie']);
			$email=trim($row['email']);
			if(!strpos($email, "@")){
				$email="";
			}
			$telefono=trim($row['teleclie']);
			$telf_casa=trim($row['teleclie1']);
			$telf_adic=trim($row['teleclie2']);
			$teleclie3=trim($row['teleclie3']);
			$teleclie4=trim($row['teleclie4']);
			$codmensual=trim($row['codmensual']);
			$nomurbaniz=trim($row['nomurbaniz']);
			$nomedif=trim($row['nomedif']);
			$fecha_contrato=trim($row['fechacontr']);
			
			//ECHO "<BR>:$fecha_contrato:";
			$fechainstalacion=trim($row['fechainsta']);
			$etiqueta=trim($row['tag']);
			$poste=trim($row['poste']);
			$observacion=trim($row['refeclie']);
			$id_serv='SER00001';
			$pto=1;
			if($codmensual=='001'){
				$pto=1;
				$id_serv='SER00001';
			}
			else if($codmensual=='003'){
				$pto=1;
				$id_serv='AM00007';
			}
			else if($codmensual=='017'){
				$pto=1;
				$id_serv="EA00012";
			}
			else if($codmensual=='019'){
				$pto=5;
				$id_serv="AM00011";
			}
			else if($codmensual=='99'){
				$pto=4;
				$id_serv="AM00010";
			}
			else if($codmensual=='101'){
				$pto=2;
			}
			else if($codmensual=='102'){
				$pto=3;
			}
			
			$id_calle='';
						$consul->objeto->ejecutarSql("select  id_calle from vista_calle1 where nombre_calle='$ncalle' and nombre_sector='$nomurbaniz' and id_franq='$id_franq'"); 
						if($fila=$consul->objeto->devolverRegistro()){
							$id_calle=trim($fila['id_calle']);
						}
						
				$telefono=str_replace("-","",$telefono);
				$telf_casa=str_replace("-","",$telf_casa);
				$telf_adic=str_replace("-","",$telf_adic);
				$teleclie3=str_replace("-","",$teleclie3);
				$teleclie4=str_replace("-","",$teleclie4);
				
					if(strlen($telefono)==10){
						$telefono="0".$telefono;
					}
					else if(strlen($telefono)==11){
					}
					else {
						$telefono='';
					}
				
					if(strlen($telf_casa)==10){
						$telf_casa="0".$telf_casa;
					}
					else if(strlen($telf_casa)==11){
					}
					else {
						$telf_casa='';
					}
				
					if(strlen($telf_adic)==10){
						$telf_adic="0".$telf_adic;
					}
					else if(strlen($telf_adic)==11){
					}
					else {
						$telf_adic='';
					}
					
					if(strlen($teleclie3)==10){
						$teleclie3="0".$teleclie3;
					}
					else if(strlen($teleclie3)==11){
					}
					else {
						$teleclie3='';
					}
					
					if(strlen($teleclie4)==10){
						$teleclie4="0".$teleclie4;
					}
					else if(strlen($teleclie4)==11){
					}
					else {
						$teleclie4='';
					}
					
			
				
				//echo "<br>$nro_contrato<br>:$telefono:$telf_casa::::::$telf_adic:$teleclie3:$teleclie4:";
				
				if(isMovil($telefono)=="FIJO" && isMovil($telf_casa)=="MOVIL"){
					$tel=$telefono;
					$telefono=$telf_casa;
					$telf_casa=$tel;
				}
				
				if(isMovil($telefono)=="FIJO" && isMovil($telf_adic)=="MOVIL"){
					$tel=$telefono;
					$telefono=$telf_adic;
					$telf_adic=$tel;
				}else if(isMovil($telefono)=="FIJO" && isMovil($teleclie3)=="MOVIL"){
					$tel=$telefono;
					$telefono=$teleclie3;
					$teleclie3=$tel;
				}else if(isMovil($telefono)=="FIJO" && isMovil($teleclie4)=="MOVIL"){
					$tel=$telefono;
					$telefono=$teleclie4;
					$teleclie4=$tel;
				}
				
				if(isMovil($telf_casa)=="FIJO" && isMovil($telf_adic)=="MOVIL"){
					$tel=$telf_casa;
					$telf_casa=$telf_adic;
					$telf_adic=$tel;
				}else if(isMovil($telf_casa)=="FIJO" && isMovil($teleclie3)=="MOVIL"){
					$tel=$telf_casa;
					$telf_casa=$teleclie3;
					$teleclie3=$tel;
				}else if(isMovil($telf_casa)=="FIJO" && isMovil($teleclie4)=="MOVIL"){
					$tel=$telf_casa;
					$telf_casa=$teleclie4;
					$teleclie4=$tel;
				}
				//echo "<br>:$telefono:$telf_casa::::::$telf_adic:$teleclie3:$teleclie4:";
				
				if($teleclie3!=''){
					$telf_adic=" $telf_adic;$teleclie3";
				}
				if($teleclie4!=''){
					$telf_adic=" $telf_adic;$teleclie4";
				}
				
				
					
					
				
				$cedula=$rifclie;
				$cedula=str_replace(".","",$cedula);
				$cedula=str_replace(" ","",$cedula);
				$cedula=str_replace("V","",$cedula);
				$cedula=str_replace("-","",$cedula);
				
				
					$tipo_cliente='NATURAL';
					$inicial_doc='V';
				
				
				$cable->objeto->ejecutarSql("select id_persona from persona  where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc LIMIT 1 offset 0 "); 
				$id_persona = $ini_u.verCodLong($cable,"id_persona");
				
							 
				if(!$cable->objeto->ejecutarSql("insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$cedula','$nombre','$apellido','$telefono')")){
					echo "<br>$fallos:insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('$id_persona','$cedula','$nombre','$apellido','$telefono')";
						echo $cable->objeto->error().'<br>';
				}
								
				if(!$cable->objeto->ejecutarSql("insert into cliente(id_persona,telf_casa,email,telf_adic,tipo_cliente,inicial_doc) values ('$id_persona','$telf_casa','$email','$telf_adic','$tipo_cliente','$inicial_doc')")){
					echo "<br>$fallos:insert into cliente(id_persona,telf_casa,email,telf_adic) values ('$id_persona','$telf_casa','$email','$telf_adic')";
						echo $cable->objeto->error().'<br>';
				}
				$nro_factura='';
				//$fecha_contrato=trim($row['abofchins']);
				$hora_contrato="09:00:00";
				//$etiqueta=trim($row['etiqueta']);
				
				$costo_contrato=0.00;
				$costo_dif_men=0.00;
				$status=array("ACTIVOS"=>"ACTIVO","CORTADOS"=>"CORTADO","P/INSTALAR"=>"POR INSTALAR","P/RECONECTAR"=>"POR RECONECTAR","SUSPEN/TEM"=>"SUSPENDIDO","RETIR./VOL"=>"SUSPENDIDO","EXONERADOS TODO PAGO"=>"EXONERADO","RETIR./VOL"=>"SUSPENDIDO","RETIRADOS"=>"SUSPENDIDO","ANULADOS"=>"ANULADO","ANULADA"=>"ANULADO","P/CORTAR"=>"POR CORTAR");
				$status_contrato=$status[$suspendido];
				
				
				//$observacion="V";
				
				$cable->objeto->ejecutarSql("select id_contrato from contrato  where (id_contrato ILIKE '$ini_u%')  ORDER BY id_contrato desc  LIMIT 1 offset 0 ");
				$id_contrato=$ini_u.verCodLong($cable,"id_contrato");
				
				
				$id_g_a='AM001';
				
				if(!$cable->objeto->ejecutarSql("insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso,pto,id_g_a,postel,cod_id_persona,urbanizacion,otra_dir) values ('$id_contrato','$id_calle','$id_vendedor','$id_persona','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','$nro_factura','$direc_adicional','$numero_casa','$edificio','$numero_piso','$pto','$id_g_a','$poste','PER00001','$urbanizacion','$otra_dir')")){
						echo "<br>$fallos:insert into contrato(id_contrato,id_calle,id_persona,cli_id_persona,nro_contrato,fecha_contrato,hora_contrato,observacion,etiqueta,costo_contrato,costo_dif_men,status_contrato,nro_factura,direc_adicional,numero_casa,edificio,numero_piso,pto,id_g_a) values ('$id_contrato','$id_calle','$id_vendedor','$id_persona','$nro_contrato','$fecha_contrato','$hora_contrato','$observacion','$etiqueta','$costo_contrato','$costo_dif_men','$status_contrato','$nro_factura','$direc_adicional','$numero_casa','$edificio','$numero_piso','$pto','$id_g_a')<br>";
						echo $cable->objeto->error().'<br>';
						//$fallos++;
				}
				else{
					
					$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%') ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
					$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
					//$id_serv="SER00001";
					$cant_serv=1;
					if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','CONTRATO')")){
						echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','CONTRATO')<br>";
						echo $cable->objeto->error().'<br>';
					}
				}
				
			}
			
		}
	//}
	
**********************************************************************************************************CIERRE DE COMENTARIO CREADO POR EL USUARIO
**********************************************************************************************************CIERRE DE COMENTARIO CREADO POR EL USUARIO*/
}
function isMovil($tel){
	if(substr($tel , 0,4)=="0212"){
		return "FIJO";
	}
	else if(substr($tel , 0,4)=="0414" || substr($tel , 0,4)=="0424" || substr($tel , 0,4)=="0416" || substr($tel , 0,4)=="0426" || substr($tel , 0,4)=="0412"){
		return "MOVIL";
	}
	else{
		return "FALSE";
	}
}
function actualizar_contrato($acceso,$cable,$consul,$ini_u){
	require_once "procesos.php";
	//echo "select id_contrato,nro_contrato,direc_adicional from contrato where id_contrato ilike '$ini_u%'  order by id_contrato LIMIT 100 offset 0 ";
	$cable->objeto->ejecutarSql("select id_contrato,nro_contrato,direc_adicional from contrato where id_contrato ilike '$ini_u%'  order by id_contrato LIMIT 100000000 offset 0 ");
	while($row1=row($cable)){
			
				$nro_contrato=trim($row1['nro_contrato']);
				$nro_contrato=str_replace("P","",$nro_contrato);
				$id_contrato=trim($row1['id_contrato']);
				$direc_adicional=trim($row1['direc_adicional']);
				//$direc_adicional=str_replace(", torre. ",", ",$direc_adicional);
				
		//echo "<br>select codiclie,nomurbaniz,ncalle,nomedif,nomconjunt,torre,ncallejon,nvereda,navenida,ntransvers,tipovivien from cliente where codiclie='$nro_contrato' ";
		$acceso->objeto->ejecutarSql("select codiclie,nomurbaniz,ncalle,nomedif,nomconjunt,torre,ncallejon,nvereda,navenida,ntransvers,tipovivien,ala from cliente where codiclie='$nro_contrato'");
		
		if($row=row($acceso)){
			$nro_contrato=trim($row['codiclie']);
			$nomedif=trim($row['nomedif']);
			$nomconjunt=trim($row['nomconjunt']);
		//	$torre=trim($row['torre']);
			$ncallejon=trim($row['ncallejon']);
			$nvereda=trim($row['nvereda']);
			$navenida=trim($row['navenida']);
			$ntransvers=trim($row['ntransvers']);
			$tipovivien=trim($row['tipovivien']);
			$ala=trim($row['ala']);
			
			$nomedif=str_replace("S/N","",$nomedif);
			$nomedif=str_replace("SN","",$nomedif);
			$nomedif=str_replace(".","",$nomedif);
			$nomedif=str_replace(",","",$nomedif);
			
			$nomconjunt=str_replace(".","",$nomconjunt);
			$nomconjunt=str_replace(",","",$nomconjunt);
			/*
			$torre=str_replace(".","",$torre);
			$torre=str_replace(",","",$torre);
			$torre=str_replace("S/N","",$torre);
			$torre=str_replace("SN","",$torre);
			*/
			
			$ala=str_replace(".","",$ala);
			$ala=str_replace(",","",$ala);
			$ala=str_replace("S/N","",$ala);
			$ala=str_replace("SN","",$ala);
			
			
			
			$ncallejon=str_replace(".","",$ncallejon);
			$ncallejon=str_replace(",","",$ncallejon);
			
			$nvereda=str_replace(".","",$nvereda);
			$nvereda=str_replace(",","",$nvereda);
			
			$navenida=str_replace(".","",$navenida);
			$navenida=str_replace(",","",$navenida);
			
			$ntransvers=str_replace(".","",$ntransvers);
			$ntransvers=str_replace(",","",$ntransvers);
			
			$tipovivien=str_replace(".","",$tipovivien);
			$tipovivien=str_replace(",","",$tipovivien);
			
			$direc_adicional=str_replace(".","",$direc_adicional);
			$direc_adicional=str_replace(",","",$direc_adicional);
			$direc_adicional=str_replace("''","",$direc_adicional);
			
			if($nomedif<>''){
				$nomedif= ', Edif. '.$nomedif;
			}
			if($nomconjunt<>''){
				$nomconjunt= ', Conj. '.$nomconjunt;
			}
			/*
			if($torre<>''){
				$torre= ', torre. '.$torre;
			}
			*/
			if($ncallejon<>''){
				$ncallejon= ', callejon. '.$ncallejon;
			}
			if($nvereda<>''){
				$nvereda= ', vrd. '.$nvereda;
			}
			if($navenida<>''){
				$navenida= ', av. '.$navenida;
			}
			if($ntransvers<>''){
				$ntransvers= ', trans. '.$ntransvers;
			}
			if($tipovivien<>''){
				$tipovivien= ', '.$tipovivien;
			}
			
			if($direc_adicional<>''){
				$direc_adicional= '; P.R. '.$direc_adicional;
			}
			
			if($ala<>''){
				$ala= 'torre '.$ala;
			}
			$direc_adicional="$ntransvers$navenida$nvereda$nomconjunt$nomedif$ala$direc_adicional";
		//	$direc_adicional="$ala$direc_adicional";
		//	echo "<br>update contrato set direc_adicional='$direc_adicional' where id_contrato = '$id_contrato';";
			$consul->objeto->ejecutarSql("update contrato set direc_adicional='$direc_adicional' where id_contrato = '$id_contrato'");
		}
	}
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
//$thefile="prueba/ordenes.DBF";
//echo $thefile;
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
	//$file="ordenes.DBF";
	$valor=explode(".DBF",$file);
	$tabla=$valor[0];
	
		
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
	else if(strstr($date,"/")){06
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
