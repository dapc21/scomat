<?php
	require_once "procesos.php"; $ini_u = "SY"; 
	$cable=conexion();
	$cable1=conexion();
	$cable2=conexion();
	
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	/*
	//echo "select * from cirre_diario where fecha_cierre='$fecha' and id_franq='0' ";
	$acceso->objeto->ejecutarSql("select * from cirre_diario where fecha_cierre='$fecha' and id_franq='0' ");
	if(!$acceso->objeto->registros>0){
		echo "<br>INICIO DE CIERRE GENERAL<br><br>";
		echo "<br>no esta cerrado el general";
		$cable->objeto->ejecutarSql("SELECT id_franq FROM franquicia order by id_franq");
		while($row=row($cable)){
			$id_franq=trim($row["id_franq"]);
			echo "<br>:$id_franq";
			$acceso->objeto->ejecutarSql("select * from cirre_diario where fecha_cierre='$fecha' and id_franq='$id_franq' ");
			if(!$acceso->objeto->registros>0){
				echo "<br> cierre de franquicia abierto";
				$cable1->objeto->ejecutarSql("SELECT id_caja FROM caja where status_caja='ABIERTA'  and id_franq='$id_franq'  ");
				while($row=row($cable1)){
					$id_caja=trim($row["id_caja"]);
					echo "<br>:caja abierta:$id_caja";
					$cable2->objeto->ejecutarSql("SELECT id_caja_cob,id_est FROM caja_cobrador where  fecha_caja='$fecha' and id_caja='$id_caja' and status_caja='ABIERTA'");
					while($row=row($cable2)){
						$id_caja_cob=trim($row["id_caja_cob"]);
						$id_est=trim($row["id_est"]);
						
						
						echo "<br>:caja_cobrador abierta:$id_caja";
						$acceso->objeto->ejecutarSql("select sum(monto_pago) as monto from pagos where id_caja_cob='$id_caja_cob' and status_pago='PAGADO'");
						$row=row($acceso);
						$monto=trim($row["monto"])+0;
						echo "<br>Update caja_cobrador Set cierre_caja='$hora', monto_acum='$monto', status_caja='CERRADA' Where id_caja_cob='$id_caja_cob'";
						$acceso->objeto->ejecutarSql("Update caja_cobrador Set cierre_caja='$hora=', monto_acum='$monto', status_caja='CERRADA' Where id_caja_cob='$id_caja_cob'");
					}
					echo "<br>Update caja Set status_caja='ACTIVA' Where id_caja='$id_caja'";
					$acceso->objeto->ejecutarSql("Update caja Set status_caja='ACTIVA' Where id_caja='$id_caja'");
				}
				
				$acceso->objeto->ejecutarSql("select *from cirre_diario  where (id_cierre ILIKE '$ini_u%') ORDER BY id_cierre desc"); 
				$id_cierre = $ini_u.verCodLong($acceso,"id_cierre");
				
				$monto_cierre=calMontoCDCA($acceso,$fecha,$id_franq)+0;
				ECHO "<br>insert into cirre_diario(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre,reporte_z,id_franq) values ('$id_cierre','$fecha','$hora','$monto_cierre','CERRADO AUTOMATICO','','$id_franq')";
				$acceso->objeto->ejecutarSql("insert into cirre_diario(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre,reporte_z,id_franq) values ('$id_cierre','$fecha','$hora','$monto_cierre','CERRADO AUTOMATICO','','$id_franq')");			
			
				$dato = lectura($acceso,"select *from vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA'  and id_franq='$id_franq' ");
				for($i=0;$i<count($dato);$i++)
				{
					$id_caja_cob=trim($dato[$i]["id_caja_cob"]); 
					ECHO "<br>insert into cierre_pago(id_caja_cob,id_cierre) values ('$id_caja_cob','$id_cierre')";
					$acceso->objeto->ejecutarSql("insert into cierre_pago(id_caja_cob,id_cierre) values ('$id_caja_cob','$id_cierre')");
				}
			
			}
		}
		
		$cable->objeto->ejecutarSql("SELECT id_franq,id_est FROM caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and fecha_caja='$fecha' group by id_franq,id_est");
		while($row=row($cable)){
			$id_est=trim($row["id_est"]);
			$id_franq=trim($row["id_franq"]);
			$monto_est=calMontoCDCA_est($acceso,$fecha,$id_est)+0;
			//echo "<br>estacion:$id_est:$id_franq:$monto_est";
			$acceso->objeto->ejecutarSql("select * from cirre_diario_et where fecha_cierre='$fecha' and id_franq='$id_franq' ");
			if(!$acceso->objeto->registros>0){
				
				$acceso->objeto->ejecutarSql("select *from cirre_diario_et  where (id_cierre ILIKE '$ini_u%') ORDER BY id_cierre desc");
				$id_cierre=$ini_u.verCodLong($acceso,"id_cierre");
				
				echo "<br>insert into cirre_diario_et(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre,id_est,id_franq) values ('$id_cierre','$fecha','$hora','$monto_est','CERRADO AUTOMATICO','$id_est','$id_franq');";
				$acceso->objeto->ejecutarSql("insert into cirre_diario_et(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre,id_est,id_franq) values ('$id_cierre','$fecha','$hora','$monto_est','CERRADO AUTOMATICO','$id_est','$id_franq')");			
			
				$dato = lectura($acceso,"select *from vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA' and id_est='$id_est' and id_franq='$id_franq' ");
				for($i=0;$i<count($dato);$i++){
					$id_caja_cob=trim($dato[$i]["id_caja_cob"]);
					echo "<br>insert into cierre_pago_et(id_caja_cob,id_cierre) values ('$id_caja_cob','$id_cierre');";
					$acceso->objeto->ejecutarSql("insert into cierre_pago_et(id_caja_cob,id_cierre) values ('$id_caja_cob','$id_cierre')");
				}
			}
		}
		
		
		$id_franq=0;
			$acceso->objeto->ejecutarSql("select *from cirre_diario  where (id_cierre ILIKE '$ini_u%') ORDER BY id_cierre desc"); 
			$id_cierre = $ini_u.verCodLong($acceso,"id_cierre");
			
			$monto_cierre=calMontoCDCA($acceso,$fecha,$id_franq)+0;
			ECHO "<br>insert into cirre_diario(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre,reporte_z,id_franq) values ('$id_cierre','$fecha','$hora','$monto_cierre','CERRADO AUTOMATICO','','$id_franq')";
			$acceso->objeto->ejecutarSql("insert into cirre_diario(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre,id_franq) values ('$id_cierre','$fecha','$hora','$monto_cierre','CERRADO AUTOMATICO','$id_franq')");			
		
			$dato = lectura($acceso,"select *from vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA'  and id_franq='$id_franq' ");
			for($i=0;$i<count($dato);$i++)
			{
				$id_caja_cob=trim($dato[$i]["id_caja_cob"]);
				ECHO "<br>insert into cierre_pago(id_caja_cob,id_cierre) values ('$id_caja_cob','$id_cierre')";
				$acceso->objeto->ejecutarSql("insert into cierre_pago(id_caja_cob,id_cierre) values ('$id_caja_cob','$id_cierre')");
			}
		
		echo "<br><br>INICIO DE CIERRE GENERAL";
		
	}else{
		echo "<br><br>YA SE REALIZO CIERRE GENERAL<br>";
	}
	
	$acceso->objeto->ejecutarSql("Update caja Set status_caja='ACTIVA' Where status_caja='ABIERTA'");
	$acceso->objeto->ejecutarSql("Update caja_cobrador Set status_caja='CERRADA' Where status_caja='ABIERTA'");
	
*/	
	$fecha= date("Y-06-12");
	//ALMACENAR ESTADISTICAS DE POR FRANQUICIAS
		$cable->objeto->ejecutarSql("SELECT id_franq FROM franquicia order by id_franq limit 1");
		while($row=row($cable)){
			$id_franq=trim($row["id_franq"]);
			
				$cable1->objeto->ejecutarSql("SELECT sum(monto_pago) as total_ingreso
   FROM pagos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE pagos.id_contrato=contrato.id_contrato and contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND fecha_pago='$fecha' and status_pago='PAGADO' and sector.id_franq = '$id_franq'  ");
				if($row=row($cable1)){
					$total_ingreso=trim($row["total_ingreso"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT sum(monto_pago) as total_facturado,count(*) as cant_facturas
   FROM pagos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE pagos.id_contrato=contrato.id_contrato and contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND fecha_pago='$fecha' and sector.id_franq = '$id_franq'  ");
				if($row=row($cable1)){
					$total_facturado=trim($row["total_facturado"])+0;
					$cant_facturas=trim($row["cant_facturas"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT sum(monto_pago) as total_nota_credito,count(*) as cant_nota_credito
   FROM pagos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE pagos.id_contrato=contrato.id_contrato and contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND fecha_pago='$fecha'  and status_pago='NOTA DE CREDITO' and sector.id_franq = '$id_franq'  ");
				if($row=row($cable1)){
					$total_nota_credito=trim($row["total_nota_credito"])+0;
					$cant_nota_credito=trim($row["cant_nota_credito"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT sum(costo_cobro) as total_x_servicio
   FROM contrato_servicio_pagado,pago_servicio,pagos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE contrato_servicio_pagado.id_cont_serv=pago_servicio.id_cont_serv and pago_servicio.id_pago=pagos.id_pago and pagos.id_contrato=contrato.id_contrato and contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND fecha_pago='$fecha' and status_pago='PAGADO' and sector.id_franq = '$id_franq'  ");
				if($row=row($cable1)){
					$total_x_servicio=trim($row["total_x_servicio"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT sum(monto_tp) as total_x_form_pago
   FROM detalle_tipopago,pagos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE  detalle_tipopago.id_pago=pagos.id_pago and pagos.id_contrato=contrato.id_contrato and contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND fecha_pago='$fecha' and status_pago='PAGADO' and sector.id_franq = '$id_franq'  ");
				if($row=row($cable1)){
					$total_x_form_pago=trim($row["total_x_form_pago"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT sum(saldo) as deuda_act
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='ACTIVO' and sector.id_franq = '$id_franq'  and saldo>0 ");
				if($row=row($cable1)){
					$deuda_act=trim($row["deuda_act"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT sum(saldo) as deuda_cor
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='CORTADO' and sector.id_franq = '$id_franq'   and saldo>0 ");
				if($row=row($cable1)){
					$deuda_cor=trim($row["deuda_cor"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT sum(saldo) as deuda_xint
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='POR INSTALAR' and sector.id_franq = '$id_franq'   and saldo>0 ");
				if($row=row($cable1)){
					$deuda_xint=trim($row["deuda_xint"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT sum(saldo) as deuda_xcor
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='POR CORTAR' and sector.id_franq = '$id_franq'   and saldo>0 ");
				if($row=row($cable1)){
					$deuda_xcor=trim($row["deuda_xcor"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT sum(saldo) as deuda_xrec
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='POR RECONECTAR' and sector.id_franq = '$id_franq'   and saldo>0 ");
				if($row=row($cable1)){
					$deuda_xrec=trim($row["deuda_xrec"])+0;
				}
				$cable1->objeto->ejecutarSql("SELECT sum(saldo) as deuda_exo
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='EXONERADO' and sector.id_franq = '$id_franq'    and saldo>0 ");
				if($row=row($cable1)){
					$deuda_exo=trim($row["deuda_exo"])+0;
				}
				$cable1->objeto->ejecutarSql("SELECT sum(saldo) as deuda_otros
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato<>'ACTIVO'  AND status_contrato<>'CORTADO'  AND status_contrato<>'POR INSTALAR'  AND status_contrato<>'POR CORTAR'  AND status_contrato<>'POR RECONECTAR' and  status_contrato<>'EXONERADO' and sector.id_franq = '$id_franq'   and saldo>0 ");
				if($row=row($cable1)){
					$deuda_otros=trim($row["deuda_otros"])+0;
				}
				$cable1->objeto->ejecutarSql("SELECT sum(saldo) as deuda_total
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq'   and saldo>0 ");
				if($row=row($cable1)){
					$deuda_total=trim($row["deuda_total"])+0;
				}
				
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as abo_activos
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='ACTIVO' and sector.id_franq = '$id_franq'  AND fecha_contrato<='$fecha' ");
				if($row=row($cable1)){
					$abo_activos=trim($row["abo_activos"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as abo_cortados
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='CORTADO' and sector.id_franq = '$id_franq'  AND fecha_contrato<='$fecha'  ");
				if($row=row($cable1)){
					$abo_cortados=trim($row["abo_cortados"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as abo_x_instalar
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='POR INSTALAR' and sector.id_franq = '$id_franq'  AND fecha_contrato<='$fecha'  ");
				if($row=row($cable1)){
					$abo_x_instalar=trim($row["abo_x_instalar"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as abo_x_cortar
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='POR CORTAR' and sector.id_franq = '$id_franq'  AND fecha_contrato<='$fecha'  ");
				if($row=row($cable1)){
					$abo_x_cortar=trim($row["abo_x_cortar"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as abo_x_reconectar
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='POR RECONECTAR' and sector.id_franq = '$id_franq'  AND fecha_contrato<='$fecha'  ");
				if($row=row($cable1)){
					$abo_x_reconectar=trim($row["abo_x_reconectar"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as abo_exonerado
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato='EXONERADO' and sector.id_franq = '$id_franq'  AND fecha_contrato<='$fecha'  ");
				if($row=row($cable1)){
					$abo_exonerado=trim($row["abo_exonerado"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as abo_otros
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND status_contrato<>'ACTIVO'  AND status_contrato<>'CORTADO'  AND status_contrato<>'POR INSTALAR'  AND status_contrato<>'POR CORTAR'  AND status_contrato<>'POR RECONECTAR' AND status_contrato<>'EXONERADO' and sector.id_franq = '$id_franq'  AND fecha_contrato<='$fecha'  ");
				if($row=row($cable1)){
					$abo_otros=trim($row["abo_otros"])+0;
				}
								
				$cable1->objeto->ejecutarSql("SELECT count(*) as abo_total
   FROM contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq'  AND fecha_contrato<='$fecha' ");
				if($row=row($cable1)){
					$abo_total=trim($row["abo_total"])+0;
				}
								
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_asig_inst
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_det_orden='DEO00001' and fecha_orden='$fecha'");
				if($row=row($cable1)){
					$ord_asig_inst=trim($row["ord_asig_inst"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_asig_rec
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_det_orden='DEO00003' and fecha_orden='$fecha'");
				if($row=row($cable1)){
					$ord_asig_rec=trim($row["ord_asig_rec"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_asig_corte
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and (detalle_orden.id_det_orden='DEO00010' or detalle_orden.id_det_orden='EA00053')and fecha_orden='$fecha'");
				if($row=row($cable1)){
					$ord_asig_corte=trim($row["ord_asig_corte"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_asig_reclamo
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_tipo_orden='TIO00005' and fecha_orden='$fecha'");
				if($row=row($cable1)){
					$ord_asig_reclamo=trim($row["ord_asig_reclamo"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_asig_otras
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_tipo_orden<>'TIO00005'  and detalle_orden.id_det_orden<>'DEO00010' and detalle_orden.id_det_orden<>'EA00053' and detalle_orden.id_det_orden<>'DEO00003' and detalle_orden.id_det_orden<>'DEO00001'and fecha_orden='$fecha'");
				
				if($row=row($cable1)){
					$ord_asig_otras=trim($row["ord_asig_otras"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_asig_total
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and fecha_orden='$fecha'");
				if($row=row($cable1)){
					$ord_asig_total=trim($row["ord_asig_total"])+0;
				}
				
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_imp_inst
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_det_orden='DEO00001' and fecha_imp='$fecha'");
				if($row=row($cable1)){
					$ord_imp_inst=trim($row["ord_imp_inst"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_imp_rec
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_det_orden='DEO00003' and fecha_imp='$fecha'");
				if($row=row($cable1)){
					$ord_imp_rec=trim($row["ord_imp_rec"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_imp_corte
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and (detalle_orden.id_det_orden='DEO00010' or detalle_orden.id_det_orden='EA00053')and fecha_imp='$fecha'");
				if($row=row($cable1)){
					$ord_imp_corte=trim($row["ord_imp_corte"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_imp_reclamo
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_tipo_orden='TIO00005' and fecha_imp='$fecha'");
				if($row=row($cable1)){
					$ord_imp_reclamo=trim($row["ord_imp_reclamo"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_imp_otras
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_tipo_orden<>'TIO00005'  and detalle_orden.id_det_orden<>'DEO00010' and detalle_orden.id_det_orden<>'EA00053' and detalle_orden.id_det_orden<>'DEO00003' and detalle_orden.id_det_orden<>'DEO00001'and fecha_imp='$fecha'");
				if($row=row($cable1)){
					$ord_imp_otras=trim($row["ord_imp_otras"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_imp_total
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and fecha_imp='$fecha'");
				if($row=row($cable1)){
					$ord_imp_total=trim($row["ord_imp_total"])+0;
				}
				
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_fin_inst
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_det_orden='DEO00001' and fecha_cierre='$fecha'");
				if($row=row($cable1)){
					$ord_fin_inst=trim($row["ord_fin_inst"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_fin_rec
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_det_orden='DEO00003' and fecha_cierre='$fecha'");
				if($row=row($cable1)){
					$ord_fin_rec=trim($row["ord_fin_rec"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_fin_corte
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and (detalle_orden.id_det_orden='DEO00010' or detalle_orden.id_det_orden='EA00053')and fecha_cierre='$fecha'");
				if($row=row($cable1)){
					$ord_fin_corte=trim($row["ord_fin_corte"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_fin_reclamo
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_tipo_orden='TIO00005' and fecha_cierre='$fecha'");
				if($row=row($cable1)){
					$ord_fin_reclamo=trim($row["ord_fin_reclamo"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_fin_otras
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and detalle_orden.id_tipo_orden<>'TIO00005'  and detalle_orden.id_det_orden<>'DEO00010' and detalle_orden.id_det_orden<>'EA00053' and detalle_orden.id_det_orden<>'DEO00003' and detalle_orden.id_det_orden<>'DEO00001'and fecha_cierre='$fecha'");
				if($row=row($cable1)){
					$ord_fin_otras=trim($row["ord_fin_otras"])+0;
				}
				
				$cable1->objeto->ejecutarSql("SELECT count(*) as ord_fin_total
   FROM detalle_orden,ordenes_tecnicos,contrato,calle, sector, ciudad, municipio, zona, franquicia, estado
  WHERE detalle_orden.id_det_orden=ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_contrato=contrato.id_contrato and  contrato.id_calle=calle.id_calle and sector.id_sector = calle.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND  sector.id_franq = '$id_franq' and fecha_cierre='$fecha'");
				if($row=row($cable1)){
					$ord_fin_total=trim($row["ord_fin_total"])+0;
				}
				
				
				
				echo "<br> ord_fin_total : $ord_fin_total";
				echo "<br> ord_fin_otras : $ord_fin_otras";
				echo "<br> ord_fin_reclamo : $ord_fin_reclamo";
				echo "<br> ord_fin_rec : $ord_fin_rec";
				echo "<br> ord_fin_corte : $ord_fin_corte";
				echo "<br> ord_fin_inst : $ord_fin_inst";
				
				echo "<br> ord_imp_total : $ord_imp_total";
				echo "<br> ord_imp_otras : $ord_imp_otras";
				echo "<br> ord_imp_reclamo : $ord_imp_reclamo";
				echo "<br> ord_imp_rec : $ord_imp_rec";
				echo "<br> ord_imp_corte : $ord_imp_corte";
				echo "<br> ord_imp_inst : $ord_imp_inst";
				
				echo "<br> ord_asig_total : $ord_asig_total";
				echo "<br> ord_asig_otras : $ord_asig_otras";
				echo "<br> ord_asig_reclamo : $ord_asig_reclamo";
				echo "<br> ord_asig_rec : $ord_asig_rec";
				echo "<br> ord_asig_corte : $ord_asig_corte";
				echo "<br> ord_asig_inst : $ord_asig_inst";
				echo "<br> abo_total : $abo_total";
				echo "<br> abo_otros : $abo_otros";
				echo "<br> abo_exonerado : $abo_exonerado";
				echo "<br> abo_x_reconectar : $abo_x_reconectar";
				echo "<br> abo_x_cortar : $abo_x_cortar";
				echo "<br> abo_x_instalar : $abo_x_instalar";
				echo "<br> abo_cortados : $abo_cortados";
				echo "<br> abo_activos : $abo_activos";
				echo "<br> total_ingreso : $total_ingreso";
				echo "<br> total_facturado : $total_facturado";
				echo "<br> total_nota_credito : $total_nota_credito";
				echo "<br> total_x_servicio : $total_x_servicio";
				echo "<br> total_x_form_pago : $total_x_form_pago";
				echo "<br> cant_facturas : $cant_facturas";
				echo "<br> cant_nota_credito : $cant_nota_credito";
				echo "<br> deuda_act : $deuda_act";
				echo "<br> deuda_cor : $deuda_cor";
				echo "<br> deuda_xint : $deuda_xint";
				echo "<br> deuda_xcor : $deuda_xcor";
				echo "<br> deuda_xrec : $deuda_xrec";
				echo "<br> deuda_exo : $deuda_exo";
				echo "<br> deuda_otros : $deuda_otros";
				echo "<br> deuda_total : $deuda_total";
				
				$ini_u="WW";
				$cable1->objeto->ejecutarSql("select *from cierre_historico  where (id_cierre ILIKE '$ini_u%') ORDER BY id_cierre desc LIMIT 1 offset 0"); 
				$id_cierre = $ini_u.verCoo($cable1,"id_cierre");
			/*	$cable1->objeto->ejecutarSql("insert into cierre_historico( id_cierre, id_franq, fecha_c, total_ingreso,total_facturado ,total_nota_credito ,total_x_servicio , total_x_form_pago, cant_facturas, cant_nota_credito, deuda_act, deuda_cor, deuda_xint, deuda_xcor, deuda_xrec, deuda_exo, deuda_otros,deuda_total , abo_activos,abo_cortados , abo_x_instalar, abo_x_cortar, abo_x_reconectar, abo_exonerado, abo_otros, abo_total, ord_asig_inst, ord_asig_corte, ord_asig_rec,ord_asig_reclamo ,ord_asig_otras , ord_asig_total, ord_imp_inst, ord_imp_corte, ord_imp_rec,ord_imp_reclamo ,ord_imp_otras , ord_imp_total, ord_fin_corte,ord_fin_rec , ord_fin_reclamo, ord_fin_otras,ord_fin_total ,ord_fin_inst ) 
values ('$id_cierre' ,'$id_franq' ,'$fecha' ,'$total_ingreso' ,'$total_facturado' ,'$total_nota_credito' ,'$total_x_servicio' ,'$total_x_form_pago' ,'$cant_facturas' ,'$cant_nota_credito' ,'$deuda_act' ,'$deuda_cor' ,'$deuda_xint' ,'$deuda_xcor' ,'$deuda_xrec' ,'$deuda_exo' ,'$deuda_otros' ,'$deuda_total' ,'$abo_activos' ,'$abo_cortados' ,'$abo_x_instalar' ,'$abo_x_cortar' ,'$abo_x_reconectar' ,'$abo_exonerado' ,'$abo_otros' ,'$abo_total' ,'$ord_asig_inst','$ord_asig_corte','$ord_asig_rec','$ord_asig_reclamo','$ord_asig_otras','$ord_asig_total','$ord_imp_inst','$ord_imp_corte','$ord_imp_rec','$ord_imp_reclamo','$ord_imp_otras','$ord_imp_total','$ord_fin_corte','$ord_fin_rec','$ord_fin_reclamo','$ord_fin_otras','$ord_fin_total','$ord_fin_inst')");
*/
			}//while franq
		
		
	
	
?>