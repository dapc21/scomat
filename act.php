		
		<!--DataGrid-->
				<link rel="stylesheet" type="text/css" href="SMS/include/eyedatagrid/table.css">
				<script type="text/javascript" src="SMS/include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
<?php
	require_once "procesos.php"; $ini_u = "YY";


		$acceso->objeto->ejecutarSql("SELECT table_name FROM information_schema.tables  WHERE table_schema='public'");
		while ($row=row($acceso))
		{
			$tabla=trim($row[0]);
	ECHO "<BR>listadoTablas:$tabla:";
			
			$cad=$cad.'<tr><td colspan="2" rowspan="1"><input  type="checkbox" name="tablas" value="'.$tabla.'"><span class="fuente">'.$tabla.'</span></td></tr>';
			//$cad=$cad.fila(colspan(input(tipo("checkbox").nombre("tablas").valor($tabla)).fuente($tabla),2,1));
		}
	
/*
		$dato=lectura($acceso,"select id_contrato from contrato");
		for($i=0;$i<count($dato);$i++)
		{
			$cont=$i;
			$cont++;
			
			if($cont<10)
				$cont="0".$cont;
			if($cont<100)
				$cont="0".$cont;
			
			if($cont<1000)
				$cont="0".$cont;
			if($cont<10000)
				$cont="0".$cont;
			if($cont<100000)
				$cont="0".$cont;	
			
			$cont=$serie.$cont;	
			$id_contrato=trim($dato[$i]['id_contrato']);
			$serie=trim($dato[$i]['serie']);
			$cli_id_persona=trim($dato[$i]['cli_id_persona']);
			echo "Update contrato Set nro_contrato='$cont' where id_contrato='$id_contrato'";
			$acceso->objeto->ejecutarSql("Update contrato Set nro_contrato='$cont' where id_contrato='$id_contrato'");
		}
		*/
	/*
	$dato=lectura($acceso,"
select id_contrato, 
(select sum(costo_cobro) from contrato_servicio_deuda, servicios where contrato_servicio_deuda.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and contrato.id_contrato=contrato_servicio_deuda.id_contrato and fecha_inst between '2013-10-01' and '2013-10-31') as deuda,
(select sum(costo_cobro) from contrato_servicio_pagado, servicios where contrato_servicio_pagado.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_pagado.id_contrato and fecha_inst between '2013-10-01' and '2013-10-31') as pagado_oct,
(select sum(costo_cobro) from contrato_servicio_pagado, servicios where contrato_servicio_pagado.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_pagado.id_contrato and fecha_inst between '2013-11-01' and '2013-11-30') as pagado_nov,
(select sum(costo_cobro) from contrato_servicio_pagado, servicios where contrato_servicio_pagado.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_pagado.id_contrato and fecha_inst between '2013-12-01' and '2013-12-31') as pagado_dic,
(select sum(costo_cobro) from contrato_servicio_pagado, servicios where contrato_servicio_pagado.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_pagado.id_contrato and fecha_inst between '2014-01-01' and '2014-01-31') as pagado_ene,
(select sum(costo_cobro) from contrato_servicio_pagado, servicios where contrato_servicio_pagado.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_pagado.id_contrato and fecha_inst between '2014-02-01' and '2014-02-28') as pagado_feb,

((select sum(costo_cobro) from contrato_servicio_deuda, servicios where contrato_servicio_deuda.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_deuda.id_contrato and fecha_inst between '2013-10-01' and '2013-10-31') +
(select sum(costo_cobro) from contrato_servicio_pagado, servicios where contrato_servicio_pagado.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_pagado.id_contrato and fecha_inst between '2013-10-01' and '2013-10-31')) as total,

(select count(*) from contrato_servicio_pagado , servicios where contrato_servicio_pagado.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_pagado.id_contrato and fecha_inst between '2013-10-01' and '2013-10-31') as cantidad

   from contrato where 
   (select count(*) from contrato_servicio_pagado , servicios where contrato_servicio_pagado.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_pagado.id_contrato and fecha_inst between '2013-10-01' and '2013-10-31')>1 AND 
(select sum(costo_cobro) from contrato_servicio_pagado , servicios where contrato_servicio_pagado.id_serv= servicios.id_serv and tipo_costo='COSTO MENSUAL' and  contrato.id_contrato=contrato_servicio_pagado.id_contrato and fecha_inst between '2013-10-01' and '2013-10-31')=250 order by total");
	$k=1;
		
		for($i=0;$i<count($dato);$i++)
		{
			//echo "<br>$i:$id_contrato";
			$id_contrato=trim($dato[$i]['id_contrato']);
			$pagado_nov=trim($dato[$i]['pagado_nov'])+0;
			$pagado_dic=trim($dato[$i]['pagado_dic'])+0;
			$pagado_ene=trim($dato[$i]['pagado_ene'])+0;
			$pagado_feb=trim($dato[$i]['pagado_feb'])+0;
			
			if($pagado_feb==0){
				$fecha_i='2014-02-01';
			}
			if($pagado_ene==0){
				$fecha_i='2014-01-01';
			}
			if($pagado_dic==0){
				$fecha_i='2013-12-01';
			}
			if($pagado_nov==0){
				$fecha_i='2013-11-01';
			}
			//echo "<br><br>select id_cont_serv,id_pago from  vista_pser where id_contrato='$id_contrato' and fecha_inst between '2013-10-01' and '2013-10-31' and costo_cobro>0 ";
			$acceso->objeto->ejecutarSql("select id_cont_serv,id_pago from  vista_pser where id_contrato='$id_contrato' and fecha_inst between '2013-10-01' and '2013-10-31' and costo_cobro>0; ");
			if($row=row($acceso)){
				$id_cont_serv=trim($row['id_cont_serv']);
				$id_pago=trim($row['id_pago']);
				echo "<br>$k:update contrato_servicio_pagado set fecha_inst='$fecha_i' where id_cont_serv='$id_cont_serv';
				<br>update pagos set obser_pago='FACTURA DE OCTUBRE' where id_pago='$id_pago';
				<br>delete from contrato_servicio_deuda where fecha_inst<'$fecha_i' and  id_contrato='$id_contrato';";
				$k++;
				
				$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where fecha_inst<='$fecha_i' and  id_contrato='$id_contrato';");
				$acceso->objeto->ejecutarSql("update contrato_servicio_pagado set fecha_inst='$fecha_i' where id_cont_serv='$id_cont_serv';");
				$acceso->objeto->ejecutarSql("update pagos set obser_pago='FACTURA DE OCTUBRE' where id_pago='$id_pago';");
			} 
		}
	*/
	
/*
	$dato=lectura($acceso,"select contrato.id_contrato, nro_contrato, (costo_cobro*cant_serv) as deuda,

(select sum(costo_cobro * cant_serv) from contrato_servicio_deuda where fecha_inst='2013-10-01' and contrato_servicio_pagado.id_contrato = contrato_servicio_deuda.id_contrato ) as pagado

 from contrato, contrato_servicio_pagado 
where contrato.id_contrato ilike '' contrato.id_contrato = contrato_servicio_pagado.id_contrato and fecha_inst='2013-10-01' and costo_cobro<>150  order by nro_contrato");
	$k=1;
		
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			$deuda=trim($dato[$i]['deuda'])+0;
			$pagado=trim($dato[$i]['pagado'])+0;
			
			
		//	echo "<br>$k: $nro_contrato : $deuda : $pagado :| $tarifa_ser";
			
			if($deuda+$pagado<>150){
				$costo_cobro=150-$deuda+$pagado;
				echo "<br>$k: $nro_contrato : $deuda : $pagado :  dif $costo_cobro";
				
					$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
					$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
					$id_serv="SER00001";
					$cant_serv=1;
					$fecha_contrato=date("Y-m-01");
					//echo "insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO')";
					$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO')");
					
				$k++;
			}
			if($deuda+$pagado>150){
				$costo_cobro=150-$deuda+$pagado;
				echo "<br>$k: $nro_contrato : $deuda : $pagado : $tarifa_ser: dif $costo_cobro";
				
				$k++;
			}
			
			
			
		}
	
	/*
	$acceso->objeto->ejecutarSql("
	delete from pago_servicio where id_pago='XA0000000013';
delete from detalle_tipopago where id_pago='XA0000000013';
delete from pagos where id_pago='XA0000000013';

delete from pago_servicio where id_pago='XA0000000007';
delete from detalle_tipopago where id_pago='XA0000000007';
delete from pagos where id_pago='XA0000000007';");
		$dato=lectura($acceso,"SELECT id_pago, nro_factura
 FROM vista_pago_cont,estacion_trabajo 
 where vista_pago_cont.id_est=estacion_trabajo.id_est AND  fecha_pago between '2013-09-01' and '2013-09-30' and id_franq='2' order by fecha_pago,nro_factura");
		$cont=835;
		for($i=0;$i<count($dato);$i++)
		{
			$id_pago=trim($dato[$i]['id_pago']);
			//$cont=trim($dato[$i]['nro_factura']);
			
		if($cont<10)
			$cont="0".$cont;
		if($cont<100)
			$cont="0".$cont;	
		if($cont<1000)
			$cont="0".$cont;
		if($cont<10000)
			$cont="0".$cont;
		if($cont<100000)
			$cont="0".$cont;
		if($cont<100000)
			$cont="0".$cont;
		if($cont<1000000)
			$cont="0".$cont;
		if($cont<10000000)
			$cont="0".$cont;
			
			$nro_factura=$cont;
			echo "<br>Update pagos Set nro_factura='$nro_factura' where id_pago='$id_pago'";
			$acceso->objeto->ejecutarSql("Update pagos Set nro_factura='$nro_factura' where id_pago='$id_pago'");
			$cont++;
		}
	*/
	/*
//PADAR A DATOS DE PRUEBA	
	

	$dato=lectura($acceso,"select cli_id_persona,id_contrato,nro_contrato,contrato.id_calle,id_sector,id_zona,id_ciudad,id_mun,id_esta,id_franq from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle AND ID_FRANQ='1' limit 10000000");
		$acceso->objeto->ejecutarSql("delete from orden_grupo");
		$acceso->objeto->ejecutarSql("delete from auditoria");
		$acceso->objeto->ejecutarSql("delete from grupo_ubicacion");
		
		for($i=0;$i<count($dato);$i=$i+2){
			$id_contrato=trim($dato[$i]['id_contrato']);
			$cli_id_persona=trim($dato[$i]['cli_id_persona']);
			$id_calle=trim($dato[$i]['id_calle']);
			$id_sector=trim($dato[$i]['id_sector']);
			$id_zona=trim($dato[$i]['id_zona']);
			$id_ciudad=trim($dato[$i]['id_ciudad']);
			$id_mun=trim($dato[$i]['id_mun']);
			$id_est=trim($dato[$i]['id_est']);
			//echo "<br>$id_contrato";
			
			$dato1=lectura($acceso,"select id_pago from pagos where id_contrato='$id_contrato'");
			for($j=0;$j<count($dato1);$j++){
				$id_pago=trim($dato1[$j]['id_pago']);
					$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$id_pago'");
					//echo "<br>delete from pago_servicio where id_pago='$id_pago';";
					$acceso->objeto->ejecutarSql("delete from pago_servicio where id_pago='$id_pago'");
					//echo "<br>delete from pagos where id_pago='$id_pago';";
				
			
			}
				$acceso->objeto->ejecutarSql("delete from pagos where id_contrato='$id_contrato'");
				
			
			//echo "<br>delete from ordenes_tecnicos where id_contrato='$id_contrato';";
			
			$acceso->objeto->ejecutarSql("delete from notas where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from info_adic where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from info_adic where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from convenio_pago where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_contrato='$id_contrato'");
			
			
			
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_contrato='$id_contrato'");
			echo "<br>$i:delete from contrato where id_contrato='$id_contrato';";
			if(!$acceso->objeto->ejecutarSql("delete from contrato where id_contrato='$id_contrato'")){
				echo "<br>delete from contrato where id_contrato='$id_contrato'";
				echo $cable->objeto->error().'<br>';
			}
			//echo "<br>delete from cliente where id_persona='$cli_id_persona';";
			$acceso->objeto->ejecutarSql("delete from cliente where id_persona='$cli_id_persona'");
			//echo "<br>$i: delete from persona where id_persona='$cli_id_persona';";
			$acceso->objeto->ejecutarSql("delete from persona where id_persona='$cli_id_persona'");
			$acceso->objeto->ejecutarSql("delete from calle where id_calle='$id_calle'");
			$acceso->objeto->ejecutarSql("delete from sector where id_sector='$id_sector'");
			$acceso->objeto->ejecutarSql("delete from zona where id_zona='$id_zona'");
			$acceso->objeto->ejecutarSql("delete from ciudad where id_ciudad='$id_ciudad'");
			$acceso->objeto->ejecutarSql("delete from municipio where id_mun='$id_mun'");
			$acceso->objeto->ejecutarSql("delete from estado where id_est='$id_est'");
		}

	/*
	$dato=lectura($acceso,"select * from contrato_servicio_deuda where fecha_inst='2013-09-01' ");
	$k=1;
		
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			
			
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
				$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
					$id_serv="SER00002";
					$costo_cobro=95;
					$cant_serv=1;
					$fecha_contrato=date("Y-m-d");
					echo "insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO')";
					$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO')");
		}
		*/
/*	
	 $contra=lectura($acceso,"select id_contrato,nro_contrato from contrato where status_contrato='ACTIVO' or status_contrato='POR SUSPENDER' or status_contrato='POR CORTAR' order by id_contrato   LIMIT 10000000000 offset 0 ");
			$fec=date("Y-m-01");
			for($j=0;$j<count($contra);$j++){
				$id_contrato=trim($contra[$j]['id_contrato']);
				$nro_contrato=trim($contra[$j]['nro_contrato']);
			//	echo "<br>$nro_contrato ";
				$dato=lectura($acceso,"select id_serv,cant_serv,costo_cobro from contrato_servicio where id_contrato='$id_contrato' and (id_serv='AM00005' or id_serv='AM00008' or id_serv='AM00009' or id_serv='AM00010') status_con_ser='CONTRATO'");
				for($i=0;$i<count($dato);$i++){
					$id_serv=trim($dato[$i]['id_serv']);
					$cant_serv=trim($dato[$i]['cant_serv']);
					$costo_cobro=trim($dato[$i]['costo_cobro']);
				//			echo "<br>$id_serv : $costo_cobro";
					$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='$id_serv' and costo_cobro>0 ");
					if(!$row=row($acceso)){
						
						$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='$id_serv' and costo_cobro>0 ");
						if(!$row=row($acceso)){
						
								$fecha=$fec;
								$tarifa_ser=$tarifa[$id_serv];
								$acceso->objeto->ejecutarSql("select tarifa_esp from servicios where id_serv='$id_serv' and tarifa_esp='TRUE' "); 
								if($row=row($acceso)){
									$tarifa_ser=$costo_cobro;
								}
								//echo "<br>$nro_contrato : $id_serv : $tarifa_ser";
								$tar=$tarifa_ser;
								$tarifa_ser= verifica_promocion($acceso,$id_contrato,$id_serv,$fecha,$tarifa_ser);
								if($tar!=$tarifa_ser){
								//	echo "<br>$nro_contrato : $id_serv : $tar : $tarifa_ser";
								}
								$can++;
								echo "<br>:$nro_contrato:$id_serv;";
								//$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser','0','AUTOMATICO')");
						
								$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
							
						} //id pagado
					} //if deuda
					else{
						//echo "<br> select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='$id_serv' and costo_cobro>0 ";
					//	echo "<br> delete from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='$id_serv' and costo_cobro>0 ;";
					}
				} //for contrato_servicio
			}	//for contrato	
			
*/			
	/*
	$dato=lectura($acceso,"select id_contrato from contrato where status_contrato='CORTADO' limit 1000000");
	$k=1;
		
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			
			
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
				$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
					$id_serv="SER00002";
					$costo_cobro=95;
					$cant_serv=1;
					$fecha_contrato=date("Y-m-d");
					echo "insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO')";
					$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO')");
		}
	*/	
	
	/*
	$monto_pago=169;
							$base=($monto_pago/1.12);
							$iva=$monto_pago-$base;
							$base=number_format($base+0, 2, '.', '');
							$iva=number_format($iva+0, 2, '.', '');
							echo ":$base : $iva";
				*/			
	/*
	$i=1;
	$dato=lectura($acceso,"select id_serv,fecha_inst,costo_cobro,id_contrato from deudas_anuladas ");      
		for($i=0;$i<count($dato);$i++)
		{
			$id_serv=trim($dato[$i]['id_serv']);
			$fecha_inst=trim($dato[$i]['fecha_inst']);
			$costo_cobro=trim($dato[$i]['costo_cobro']);
			$id_contrato=trim($dato[$i]['id_contrato']);
			
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_serv='$id_serv' and id_contrato='$id_contrato' and fecha_inst='$fecha_inst' and costo_cobro='$costo_cobro'"); 
			echo "<br>$i: delete from contrato_servicio_deuda where id_serv='$id_serv' and id_contrato='$id_contrato' and fecha_inst='$fecha_inst' and costo_cobro='$costo_cobro'";
				$i++;
				
		}
		*/
	
	/*
	$dato=lectura($acceso,"select id_serv,fecha_inst,costo_cobro,id_contrato from deudas_anuladas ");      
		for($i=0;$i<count($dato);$i++)
		{
			$id_serv=trim($dato[$i]['id_serv']);
			$fecha_inst=trim($dato[$i]['fecha_inst']);
			$costo_cobro=trim($dato[$i]['costo_cobro']);
			$id_contrato=trim($dato[$i]['id_contrato']);
			
		//	echo "<br>delete from contrato_servicio_deuda where id_serv='$id_serv' and id_contrato='$id_contrato' and fecha_inst='$fecha_inst' and costo_cobro='$costo_cobro'";
			$cable->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_serv='$id_serv' and id_contrato='$id_contrato' and fecha_inst='$fecha_inst' and costo_cobro='$costo_cobro'"); 
			$acceso->objeto->ejecutarSql("select fecha_inst,costo_cobro ,id_cont_serv from  contrato_servicio_deuda where id_serv='$id_serv' and id_contrato='$id_contrato' and fecha_inst='$fecha_inst' and costo_cobro='$costo_cobro'"); 
			while($row=row($acceso)){
				$id_cont_serv=trim($row['id_cont_serv']);
				$fecha_inst=trim($row['fecha_inst']);
				$costo_cobro=trim($row['costo_cobro']);
				//echo
				
			 
				echo "<br>$i: $id_contrato: $id_cont_serv: $fecha_inst :$costo_cobro;";
				$i++;
					
			}
		}
	*/
	
	/*
	$cable1=conectar("Postgres",'localhost','postgres','123456','copia_matrix');
	
		$serie='L';
		$num=1576;
		$dato=lectura($acceso,"select id_contrato,nro_contrato from contrato where nro_contrato ='L1576'");
		for($i=0;$i<count($dato);$i++)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			$nro_cont=trim($dato[$i]['nro_contrato']);
			$nro_contrato= $serie.$num;
			echo "<br>$nro_cont: Update contrato Set nro_contrato='$nro_contrato' where id_contrato='$id_contrato'";
			$acceso->objeto->ejecutarSql("Update contrato Set nro_contrato='$nro_contrato' where id_contrato='$id_contrato'");
			$num++;
		}
		*/
	/*
	$k=0;
	$dato=lectura($acceso,"select id_sector from sector where (select count(*) from vista_ubicli where vista_ubicli.id_sector=sector.id_sector )=0 ");      
		for($i=0;$i<count($dato);$i++)
		{
			$id_sector=trim($dato[$i]['id_sector']);
			echo "<br>delete from calle where id_sector='$id_sector';
			<br>delete from urbanizacion where id_sector='$id_sector';
			<br>delete from grupo_ubicacion where id_sector='$id_sector';
			<br>delete from sector where id_sector='$id_sector';
			
			";
			$acceso->objeto->ejecutarSql("delete from calle where id_sector='$id_sector';"); 
			$acceso->objeto->ejecutarSql("delete from urbanizacion where id_sector='$id_sector';");
			$acceso->objeto->ejecutarSql("delete from grupo_ubicacion where id_sector='$id_sector';");
			$acceso->objeto->ejecutarSql("delete from sector where id_sector='$id_sector';");
		}
		
	$k=0;
	$dato=lectura($acceso,"select id_zona from zona where (select count(*) from vista_ubicli where vista_ubicli.id_zona=zona.id_zona )=0 ");      
		for($i=0;$i<count($dato);$i++)
		{
			$id_zona=trim($dato[$i]['id_zona']);
			echo "
			<br>delete from sector where id_zona='$id_zona';
			<br>delete from zona where id_zona='$id_zona';
			
			";
			$acceso->objeto->ejecutarSql("delete from sector where id_zona='$id_zona';");
			$acceso->objeto->ejecutarSql("delete from zona where id_zona='$id_zona';");
		}
		*/
	/*
	$dato=lectura($acceso,"select inicial,login from usuario ;");      
	
	$k=0;
		
		for($i=0;$i<count($dato);$i++)
		{
			$inicial=trim($dato[$i]['inicial']);
			$login=trim($dato[$i]['login']);
			$acceso->objeto->ejecutarSql("update info_adic set login='$login' where (id_inf_a ILIKE '$inicial%')"); 
			
			if($row=row($cable1)){
				$puntos=trim($row['puntos']);
				 
				echo "<br>update contrato set pto='$puntos' where id_contrato='$id_contrato';";
					$k++;
					$acceso->objeto->ejecutarSql("update contrato set pto='$puntos' where id_contrato='$id_contrato'"); 
				
			}
			
		}
	
	/*
	$dato=lectura($acceso,"select distinct fecha_factura,nro_factura from pagos where fecha_factura between '2013-05-01' and '2013-05-31' order by fecha_factura, nro_factura limit 10000000");
	
	$k=0;
		
		for($i=0;$i<count($dato);$i++)
		{
			$nro_factura=trim($dato[$i]['nro_factura']);
		//	ECHO "<br>$k:$nro_factura:";
			if($k!=$nro_factura){
				$k=$nro_factura;
				ECHO "<br>$nro_factura";
				$k++;
			}
			else{
				$k++;
			}
		}
		
	/*
	$dato=lectura($acceso,"select id_pago,nro_factura,monto_pago,fecha_pago,fecha_factura from pagos");
	$k=1;
		
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_pago=trim($dato[$i]['id_pago']);
			$nro_factura=trim($dato[$i]['nro_factura']);
			$monto_pago=trim($dato[$i]['monto_pago']);
			$fecha_pago=trim($dato[$i]['fecha_pago']);
			$fecha_factura=trim($dato[$i]['fecha_factura']);
			
			if($fecha_factura==''){
				$base=$monto_pago/1.12;
				$iva=$monto_pago-$base;
			//	echo "<br>update pagos set fecha_factura='$fecha_pago', por_iva='12', monto_iva='$iva', base_imp='$base'  where id_pago='$id_pago';";
				$acceso->objeto->ejecutarSql("update pagos set fecha_factura='$fecha_pago', por_iva='12', monto_iva='$iva', base_imp='$base'  where id_pago='$id_pago'"); 
			}
			
		}
		
		*/
	/*
	$dato=lectura($acceso,"select id_contrato,nro_contrato from contrato limit 10000000000");
	$k=1;
		
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			$cable1->objeto->ejecutarSql("SELECT  puntos FROM abonados where abocod='$nro_contrato'"); 
			if($row=row($cable1)){
				$puntos=trim($row['puntos']);
				 
				echo "<br>update contrato set pto='$puntos' where id_contrato='$id_contrato';";
					$k++;
					$acceso->objeto->ejecutarSql("update contrato set pto='$puntos' where id_contrato='$id_contrato'"); 
				
			}
			
		}
		/*
	$dato=lectura($acceso,"select id_contrato,nro_contrato from contrato limit 100000000000");
	$k=1;
		
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			$cable1->objeto->ejecutarSql("SELECT  codcob FROM abonados where abocod='$nro_contrato'"); 
			if($row=row($cable1)){
				$codcob=trim($row['codcob']);
				//echo "SELECT  id_persona FROM cobrador where codcob='$codcob'";
				$acceso->objeto->ejecutarSql("SELECT  id_persona FROM cobrador where codcob='$codcob'"); 
				if($row=row($acceso)){
					$id_persona=trim($row['id_persona']);
					//echo "<br>update contrato set cod_id_persona='$id_persona' where id_contrato='$id_contrato';";
					$acceso->objeto->ejecutarSql("update contrato set cod_id_persona='$id_persona' where id_contrato='$id_contrato'"); 
				}
				else{
					echo "<br>$k:a:$nro_contrato";
					$k++;
				}
			}
			else{
					echo "<br>$k:b:$nro_contrato";
					$k++;
			}
				
					
		}
		
	/*
	$dato=lectura($acceso,"select id_contrato from contrato where status_contrato='CORTADO' limit 10");
	$k=1;
		
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			
			
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
				$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
					$id_serv="SER00002";
					$costo_cobro=60;
					$cant_serv=1;
					$fecha_contrato=date("Y-m-d");
					echo "insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO')";
					$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','DEUDA','$costo_cobro','0','AUTOMATICO')");
					
		}
		
	/*
	// para ejecucion 
	
	echo "ESTAN EN CABLE MODEM Y NO ESTAN EN CONTRATO SERVICIO";
	$dato=lectura($acceso,"select codigo_cm,contrato.id_contrato,nro_contrato from cablemodem,contrato where cablemodem.id_contrato=contrato.id_contrato and  status_cm='I'");
	$k=1;
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			$codigo_cm=trim($dato[$i]['codigo_cm']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			
			$acceso->objeto->ejecutarSql("select contrato.id_contrato,nro_contrato from contrato,contrato_servicio where contrato.id_contrato=contrato_servicio.id_contrato  and status_contrato='ACTIVO'  and id_serv='AP00001' and contrato.id_contrato='$id_contrato'"); 
			if(!$row=row($acceso)){
				echo "<tr><td>$k</td><td>$nro_contrato</td><td>$codigo_cm</td></tr>";
				$k++;
				
				$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%') ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
					$id_cont_serv = $ini_u.verCodLong($cable,"id_cont_serv");
					$id_serv="AP00001";
					$costo_cobro=125;
					$cant_serv=1;
					$fecha_contrato=date("Y-m-d");
					if(!$cable->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','CONTRATO','$costo_cobro')")){
						echo "<br>$fallos:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_contrato','$cant_serv','CONTRATO','$costo_cobro')<br>";
						echo $cable->objeto->error().'<br>';
					}
					
			}
		}

	echo '</table>';
	
	//ejecutar
	
	echo "ESTAN EN CABLE MODEM cortado y activo EN CONTRATO SERVICIO";
	$dato=lectura($acceso,"select codigo_cm,contrato.id_contrato,nro_contrato from cablemodem,contrato where cablemodem.id_contrato=contrato.id_contrato and  status_cm<>'I'");
	$k=1;
		for($i=0;$i<count($dato);$i++)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			$codigo_cm=trim($dato[$i]['codigo_cm']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			$acceso->objeto->ejecutarSql("select id_cont_serv from contrato,contrato_servicio where contrato.id_contrato=contrato_servicio.id_contrato  and status_contrato='ACTIVO'  and id_serv='AP00001' and contrato.id_contrato='$id_contrato'"); 
			if($row=row($acceso)){
				$id_cont_serv=trim($row['id_cont_serv']);
				echo "<tr><td>$k</td><td>$nro_contrato</td><td>$codigo_cm</td></tr>";
				$k++;
				if(!$cable->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv'")){
						echo "<br>$fallos:delete from contrato_servicio where id_cont_serv='$id_cont_serv'<br>";
						echo $cable->objeto->error().'<br>';
					}
			}
		}
	
	echo '</table>';
	
	
	$fec=date("2013-04-01");
		//$fec=restames($fec);
		$tarifa= array();
				
			$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
			
			$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
			
					$dato=lectura($acceso,"select id_serv from servicios where tipo_costo='COSTO MENSUAL'");
					for($i=0;$i<count($dato);$i++){
						$id_serv=trim($dato[$i]['id_serv']);
						$acceso->objeto->ejecutarSql("select tarifa_ser from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'  LIMIT 1 offset 0 ");
						$row=row($acceso);
						$tarifa_ser=trim($row['tarifa_ser']);
						$tarifa[trim($dato[$i]['id_serv'])]=$tarifa_ser;
					}
			
		  $acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where fecha_inst='$fec' and id_serv='AP00001';"); 
		     $contra=lectura($acceso,"select id_contrato,nro_contrato from contrato where status_contrato='ACTIVO' OR status_contrato='POR SUSPENDER' order by id_contrato   LIMIT 10000000 offset 0 ");
			$can=1;
			for($j=0;$j<count($contra);$j++){
				$id_contrato=trim($contra[$j]['id_contrato']);
				$nro_contrato=trim($contra[$j]['nro_contrato']);
				//echo "select count(id_cont_serv) as num from contrato_servicio_deuda where  id_contrato='$id_contrato' and fecha_inst='$fec' and costo_cobro>0 and  id_serv='AP00001'";
				$acceso->objeto->ejecutarSql("select count(id_cont_serv) as num from contrato_servicio_deuda where  id_contrato='$id_contrato' and fecha_inst='$fec' and costo_cobro>0 and id_serv='AP00001'");
				$row=row($acceso);
				$num = trim($row['num']);
				if($num==0){
					
					$acceso->objeto->ejecutarSql("select count(id_cont_serv) as num from contrato_servicio_pagado where costo_cobro>0 and id_contrato='$id_contrato' and fecha_inst='$fec' and  id_serv='AP00001'");
					$row=row($acceso);
					$num = trim($row['num']);
					if($num==0){
						
							$dato=lectura($acceso,"select id_serv,cant_serv,costo_cobro from contrato_servicio where id_contrato='$id_contrato' and status_con_ser='CONTRATO' and  id_serv='AP00001' limit 1");
							for($i=0;$i<count($dato);$i++){
								$id_serv=trim($dato[$i]['id_serv']);
								$cant_serv=trim($dato[$i]['cant_serv']);
								$costo_cobro=trim($dato[$i]['costo_cobro']);
								$fecha=$fec;
								
								$tarifa_ser=$tarifa[$id_serv];
								
								echo "<br>$can:$nro_contrato:";
								$can++;
								$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser','0','AUTOMATICO')");
							//	actualizarDeuda($acceso,$id_contrato);
								$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
							}
					}
					else{
						//echo "<br>$can:$nro_contrato:";
						//$can++;
					}
				}
			
		
				
				

		  }
		  
	echo '<table border="1"  align="CENTER" >';
	
	
	*/
//	echo "select contrato.id_contrato,nro_contrato from contrato,contrato_servicio where contrato.id_contrato=contrato_servicio.id_contrato and status_contrato='ACTIVO' and id_serv='AP00001'";

	/*
	//clientes en contrato servicio y no en cablemodem
	$dato=lectura($acceso,"select contrato.id_contrato,nro_contrato from contrato,contrato_servicio where contrato.id_contrato=contrato_servicio.id_contrato and status_contrato='ACTIVO' and id_serv='AP00001'");
		$k=1;
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			$acceso->objeto->ejecutarSql("select codigo_cm from cablemodem where status_cm='I' and id_contrato='$id_contrato'"); 
			if(!$row=row($acceso)){
				//echo "<br>$k:$nro_contrato";
				echo "<tr><td>$k</td><td>$nro_contrato</td><td>$codigo_cm</td></tr>";
				$k++;
			}
		}
	*/
	/*
	//estan en interfaz que no esta en cablemodem
	$dato=lectura($acceso,"select mac from cablemodem_interfaz where estado='ACTV'");
		$k=1;
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$mac=trim($dato[$i]['mac']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			$acceso->objeto->ejecutarSql("select codigo_cm from cablemodem where status_cm='I' and codigo_cm='$mac'"); 
			if(!$row=row($acceso)){
				//echo "<br>$k:$nro_contrato";
				echo "<tr><td>$k</td><td></td><td>$mac</td></tr>";
				$k++;
			}
		}
	*/
	
	
	/*
	//ESTAN EN CABLE MODEM Y NO ESTAN EN INTERFAZ
	$dato=lectura($acceso,"select codigo_cm,contrato.id_contrato,nro_contrato from cablemodem,contrato where cablemodem.id_contrato=contrato.id_contrato and  status_cm='I'");
	$k=1;
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			$codigo_cm=trim($dato[$i]['codigo_cm']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			
			$acceso->objeto->ejecutarSql("select * from cablemodem_interfaz where mac='$codigo_cm' and estado='ACTV'"); 
			if(!$row=row($acceso)){
				echo "<tr><td>$k</td><td>$nro_contrato</td><td>$codigo_cm</td></tr>";
				$k++;
			}
		}
	
	echo '</table>';
	*/
	/*
	//ESTAN EN CABLE MODEM y contrato_servicio Y NO ESTAN EN INTERFAZ
	$dato=lectura($acceso,"select contrato.id_contrato,nro_contrato,codigo_cm from contrato,contrato_servicio,cablemodem where status_cm='I' and cablemodem.id_contrato=contrato.id_contrato and  contrato.id_contrato=contrato_servicio.id_contrato and status_contrato='ACTIVO' and id_serv='AP00001'");
	$k=1;
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			$codigo_cm=trim($dato[$i]['codigo_cm']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			
			$acceso->objeto->ejecutarSql("select * from cablemodem_interfaz where mac='$codigo_cm' and estado='ACTV'"); 
			if(!$row=row($acceso)){
				echo "<tr><td>$k</td><td>$nro_contrato</td><td>$codigo_cm</td></tr>";
				$k++;
			}
		}
	
	echo '</table>';
	*/
	//ESTAN EN CABLE MODEM y contrato_servicio Y NO ESTAN EN INTERFAZ
	/*
	$dato=lectura($acceso,"select codigo_cm,contrato.id_contrato,nro_contrato from cablemodem,contrato where cablemodem.id_contrato=contrato.id_contrato ");
	$k=1;
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_contrato=trim($dato[$i]['id_contrato']);
			$codigo_cm=trim($dato[$i]['codigo_cm']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			
			$acceso->objeto->ejecutarSql("select * from cablemodem_interfaz where mac='$codigo_cm'"); 
			if(!$row=row($acceso)){
				echo "<tr><td>$k</td><td>$nro_contrato</td><td>$codigo_cm</td></tr>";
				$k++;
			}
		}
	
	echo '</table>';
	*/
	/*
	
	$dato=lectura($acceso,"select id_da,id_contrato from deco_ana limit 10000000");
		$k=1;
		for($i=0;$i<count($dato);$i++)
		{
			//echo "entro";
			$id_da=trim($dato[$i]['id_da']);
			$id_contrato=trim($dato[$i]['id_contrato']);
			$servicio='';
			//echo "select id_serv from contrato_servicio where id_contrato='$id_contrato'";
			$acceso->objeto->ejecutarSql("select id_serv from contrato_servicio where id_contrato='$id_contrato'"); 
			$id_hbo=false;
			$id_adulto=false;
			while($row=row($acceso)){
				$id_serv=trim($row['id_serv']);
				if($id_serv=="SER00001" || $id_serv=="EA00011" || $id_serv=="EA00010"){
					$servicio='BASICO';
				}
				else if($id_serv=="EA00002"){
					$id_hbo=true;
					$servicio='HBO';
					if($id_adulto==true){
						$servicio='TODOS';
					}
				}
				else if($id_serv=="EA00003"){
					$id_adulto=true;
					$servicio='ADULTO';
					if($id_hbo==true){
						$servicio='TODOS';
					}
				}
			}
			if($servicio!=''){
				echo "<br>$k:Update deco_ana Set servicio='$servicio' Where id_da='$id_da'";
				$acceso->objeto->ejecutarSql("Update deco_ana Set servicio='$servicio' Where id_da='$id_da'");
				$k++;
			}
			
		}
		
	
/*
require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


	$contrato=$_GET['contrato'];
	//echo "select c.contrato,suscrip.cedsus,suscrip.nomsus,suscrip.apesus, c.stat,domicili.proref from contrato as c, suscrip,domicili where c.domicil=domicili.codigo and c.suscriptor=suscrip.cedsus and  c.contrato=co.contrato and c.domicil='01010901' order by c.stat LIMIT 100 offset 0 ";
	$dato=lectura($acceso,"
select 
c.contrato, c.stat , c.domicil , c.stat,c.solicit ,c.fechaemi ,c.telefono ,c.fecins ,c.puntos ,c.et_verde ,c.et_roja ,c.et_roja ,c.msg1,c.msg2 ,c.observ ,c.codif
,s.cedsus,s.nomsus,s.apesus ,s.nacsus ,s.telcel ,s.telbeep ,s.email
from contrato as c, suscrip as s
where c.suscriptor=s.cedsus and c.contrato='$contrato'  LIMIT 5 offset 0");

		echo '
		<table border="1" width="100%" align="CENTER" >
		<tr id="fijo">
		<td>NUM</td>
		<td>CODIGO</td>
		<td>CEDULA</td>
		<td>NOMBRE</td>
		<td>APELLIDO</td>
		<td>STATUS</td>
		<td>MUNICIPIO</td>
		<td>ZONA</td>
		<td>SECTOR</td>
		<td>URBA</td>
		<td>CALLE</td>
		<td>VIVIENDA</td>
		<td>NUMERO</td>
		<td>DIRECCION</td>
		</tr>
		';

		for($i=0;$i<count($dato);$i++)
		{
			$domicil=trim($dato[$i]['domicil']);
			$contrato=trim($dato[$i]['contrato']);
			$cedsus=trim($dato[$i]['cedsus']);
			$nomsus=trim($dato[$i]['nomsus']);
			$apesus=trim($dato[$i]['apesus']);
			$stat=trim($dato[$i]['stat']);
			
			//ECHO "<BR>select descrip from sectores where clave='0101$municip$zona' and codigo='$sector' <BR>";
			$acceso->objeto->ejecutarSql("select d.municip, d.ciudad ,d.zona, d.sector, d.urbaniz,d.calle,d.vivienda,d.numero,d.ptoref from domicili as d where d.codigo='$domicil'"); 
			if($row=row($acceso)){
				$ptoref=trim($row['ptoref']);
				$numero=trim($row['numero']);
				
				$municip=trim($row['municip']);
				$ciudad=trim($row['ciudad']);
				$zona=trim($row['zona']);
				$sector=trim($row['sector']);
				$urbaniz=trim($row['urbaniz']);
				$calle=trim($row['calle']);
				$vivienda=trim($row['vivienda']);

				$mun = '';
				$acceso->objeto->ejecutarSql("select descrip from municipi where codigo='$municip' and clave='0101'"); 
				if($row=row($acceso)){
						$mun = trim($row['descrip']);
				}
				$zon = '';
				$acceso->objeto->ejecutarSql("select descrip from zonas where clave='0101$municip' and codigo='$zona' "); 
				if($row=row($acceso)){
						$zon = trim($row['descrip']);
				}
				
				$sec = '';
				$acceso->objeto->ejecutarSql("select descrip from sectores where clave='0101$municip$zona' and codigo='$sector' "); 
				if($row=row($acceso)){
						$sec = trim($row['descrip']);
				}
				$urb = '';
				$acceso->objeto->ejecutarSql("select descrip from urbaniz where clave='0101$municip$zona$sector' and codigo='$urbaniz' "); 
				if($row=row($acceso)){
						$urb = trim($row['descrip']);
				}
				$call = '';
				$acceso->objeto->ejecutarSql("select descrip from calles where clave='0101$municip$zona$sector$urbaniz' and codigo='$calle' "); 
				if($row=row($acceso)){
						$call = trim($row['descrip']);
				}
				$viv = '';
				$acceso->objeto->ejecutarSql("select descrip from vivienda where clave='0101$municip$zona$sector$urbaniz$calle' and codigo='$vivienda' "); 
				if($row=row($acceso)){
					$viv = trim($row['descrip']);
				}
				//beis
					echo '<tr bgcolor="#F6F6F6" > 
					<td>'.$i.'</td>
					<td>'.$contrato.'</td>
					<td>'.$cedsus.'</td>
					<td>'.$nomsus.'</td>
					<td>'.$apesus.'</td>
					<td>'.$stat.'</td>
					<td>'.$mun.'</td>
					<td>'.$zon.'</td>
					<td>'.$sec.'</td>
					<td>'.$urb.'</td>
					<td>'.$call.'</td>
					<td>'.$viv.'</td>
					<td>'.$numero.'</td>
					<td>'.$ptoref.'</td>
					</tr>
					';
				if($stat!='A'){
				
					$acceso->objeto->ejecutarSql("select msg1,msg2 from cont where cont.contrato='$contrato'"); 
					if($row=row($acceso)){
						$msg1=trim($row['msg1']);
						$msg2=trim($row['msg2']);
					
					
					//verde
					echo '<tr bgcolor="#1FB045" > 
						<td colspan="5">'.$msg1.'</td>
						<td colspan="5">'.$msg2.'</td>
						
						
						</tr>
						';
					}
				}
			}
			else{
				if($stat=='A'){
				
					//naranja
					echo '<tr bgcolor="#F47520" > 
						<td colspan="10">ACTIVO SIN DOMICILI</td>
						</tr>
						';
				}
				
				$acceso->objeto->ejecutarSql("select msg1,msg2 from cont where cont.contrato='$contrato'"); 
				if($row=row($acceso)){
					$msg1=trim($row['msg1']);
					$msg2=trim($row['msg2']);
				
				
				
				echo '<tr bgcolor="" > 
					<td>'.$i.'</td>
					<td>'.$contrato.'</td>
					<td>'.$cedsus.'</td>
					<td>'.$nomsus.'</td>
					<td>'.$apesus.'</td>
					<td>'.$stat.'</td>
					<td colspan="3">'.$msg1.'</td>
					<td colspan="3">'.$msg2.'</td>
					
					
					</tr>
					';
				}	
				else{
				//azul
					echo '<tr bgcolor="#D0E0FF" > 
					<td>'.$i.'</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					';
				}
			}

			
		//////////////////////////////////////
							echo '<tr > <td COLSPAN="14">SERVICIOS  SUSCRITOS</td></tr>
							<tr > <td COLSPAN="14">';
	

$x->setQuery("servicio.descrip,sersus.tipo,sersus.costo", "sersus,servicio","","cont='$contrato' and sersus.servicio=servicio.codigo");
$x->allowFilters();
$x->showRowNumber();
$x->setResultsPerPage(100);

$x->printTable();

							echo '<td COLSPAN="14">';
							
							echo '<tr > <td COLSPAN="14">FACTURAS PENDIENTES</td></tr>
							<tr > <td COLSPAN="14">';
	

$x->setQuery("fecha,aviso,periodo,total", "facturas","","contrato='$contrato'");
$x->allowFilters();
$x->showRowNumber();
$x->setResultsPerPage(100);

$x->printTable();

							echo '<td COLSPAN="14">';
							
							echo '<tr > <td COLSPAN="14">HISTORIAL DE PAGOS</td></tr>
							<tr > <td COLSPAN="14">';
	

$x->setQuery("factura,ncontrol,fecha,aviso,periodo,total", "pagos","","contrato='$contrato'");
$x->allowFilters();
$x->showRowNumber();
$x->setResultsPerPage(100);

$x->printTable();

							echo '<td COLSPAN="14">';
							
							echo '<tr > <td COLSPAN="14">HISTORIAL DE ORDENES</td></tr>
							<tr > <td COLSPAN="14">';
	

$x->setQuery("tipord.descrip as tipo_orden, *", "ordenes,tipord","","tipord.codigo=ordenes.tipo and  contrato='$contrato'");
$x->allowFilters();
$x->showRowNumber();
$x->setResultsPerPage(100);

$x->printTable();

							echo '<td COLSPAN="14">';
							
							echo '<tr > <td COLSPAN="14">HISTORIAL DE RECLAMOS</td></tr>
							<tr > <td COLSPAN="14">';

$x->setQuery("*", "reclamo,tiprec","","reclamo.tiprec=tiprec.codigo and contrato='$contrato'");
$x->allowFilters();
$x->showRowNumber();
$x->setResultsPerPage(100);

$x->printTable();

							echo '<td COLSPAN="14">';
							
							echo '<tr > <td COLSPAN="14">CABLE DE INTERNET - EQUIPOS</td></tr>
							<tr > <td COLSPAN="14">';

$x->setQuery("*", "cmodem","","contrato='$contrato'");
$x->allowFilters();
$x->showRowNumber();
$x->setResultsPerPage(100);

$x->printTable();

							echo '<td COLSPAN="14">';

							echo '<tr > <td COLSPAN="14">CABLE MODEMF    OTROS CABLE MODEM</td></tr>
							<tr > <td COLSPAN="14">';

$x->setQuery("*", "cmodemf","","contrato='$contrato'");
$x->allowFilters();
$x->showRowNumber();
$x->setResultsPerPage(100);

$x->printTable();

							echo '<td COLSPAN="14">';
	
							
							echo '<tr > <td COLSPAN="14">DECODIFICADORES CAJAS</td></tr>
							<tr > <td COLSPAN="14">';
	

$x->setQuery("*", "serter","","cont='$contrato'");
$x->allowFilters();
$x->showRowNumber();
$x->setResultsPerPage(100);

$x->printTable();

							echo '<td COLSPAN="14">';
	
							
							echo '<tr > <td COLSPAN="14">DECODIFICADORES CAJAS terminal</td></tr>
							<tr > <td COLSPAN="14">';
	

$x->setQuery("*", "terminal","","contrato='$contrato'");
$x->allowFilters();
$x->showRowNumber();
$x->setResultsPerPage(100);

$x->printTable();
							echo '<td COLSPAN="14">';
	
		//////////////////////////////////////		
			
		
		
		}
		
	echo '</table>
		';
*/
	
	
	/*
	
	$dato=lectura($acceso,"select id_pago,monto_pago from pagos LIMIT 300000000 offset 0 ");
		for($i=0;$i<count($dato);$i++)
		{
			$id_pago=trim($dato[$i]['id_pago']);
			$monto_pago=trim($dato[$i]['monto_pago']);
		//ECHO "<BR>select *from detalle_tipopago where id_pago='$id_pago'";
			$acceso->objeto->ejecutarSql("select *from detalle_tipopago where id_pago='$id_pago'"); 
			if(!row($acceso)){
			//	echo "<br>insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('TPA00001','$id_pago','','','$monto_pago')";
				$cable->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('TPA00001','$id_pago','','','$monto_pago')");
			}
		}
		
		
	/*	
		$fec=date("Y-07-01");
		$tarifa= array();
		$acceso->objeto->ejecutarSql("select *from mensualidad where fecha_mens='$fec'"); 
		  if(!row($acceso)){
			$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
			//$id_cont_serv=$ini_u.verCodLong($acceso,"id_cont_serv");
			$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
			
					$dato=lectura($acceso,"select id_serv from servicios where tipo_costo='COSTO MENSUAL'");
					for($i=0;$i<count($dato);$i++){
						$id_serv=trim($dato[$i]['id_serv']);
						$acceso->objeto->ejecutarSql("select tarifa_ser from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'  LIMIT 1 offset 0 "); 
						$row=row($acceso);
						$tarifa_ser=trim($row['tarifa_ser']);
						$tarifa[trim($dato[$i]['id_serv'])]=$tarifa_ser;
					}

		     $contra=lectura($acceso,"select id_contrato,nro_contrato from contrato where status_contrato='ACTIVO' order by id_contrato   LIMIT 100 offset 0 ");
				
			
			for($j=0;$j<count($contra);$j++){
				$id_contrato=trim($contra[$j]['id_contrato']);
				$nro_contrato=trim($contra[$j]['nro_contrato']);
				echo "<br>$nro_contrato";
			//	echo "<br>select count(id_cont_serv) as num from contrato_servicio_deuda,servicios where servicios.id_serv = contrato_servicio_deuda.id_serv and servicios.tipo_costo ='COSTO MENSUAL' and servicios.tipo_paq = 'PAQUETE BASICO' and  id_contrato='$id_contrato' and fecha_inst='$fec'";
				$acceso->objeto->ejecutarSql("select count(id_cont_serv) as num from contrato_servicio_deuda,servicios where servicios.id_serv = contrato_servicio_deuda.id_serv and servicios.tipo_costo ='COSTO MENSUAL' and servicios.tipo_paq = 'PAQUETE BASICO' and  id_contrato='$id_contrato' and fecha_inst='$fec'");
				$row=row($acceso);
				$num = trim($row['num']);
				if($num==0){
					
					//echo "<br>select count(id_cont_serv) as num from contrato_servicio_pagado,servicios where servicios.id_serv = contrato_servicio_pagado.id_serv and servicios.tipo_costo ='COSTO MENSUAL' and servicios.tipo_paq = 'PAQUETE BASICO' and id_contrato='$id_contrato' and fecha_inst='$fec'";
					$acceso->objeto->ejecutarSql("select count(id_cont_serv) as num from contrato_servicio_pagado,servicios where servicios.id_serv = contrato_servicio_pagado.id_serv and servicios.tipo_costo ='COSTO MENSUAL' and servicios.tipo_paq = 'PAQUETE BASICO' and id_contrato='$id_contrato' and fecha_inst='$fec' ");
					$row=row($acceso);
					$num = trim($row['num']);
					if($num==0){
						
							$dato=lectura($acceso,"select id_serv,cant_serv from contrato_servicio where id_contrato='$id_contrato' and status_con_ser='CONTRATO'");
							for($i=0;$i<count($dato);$i++){
								$id_serv=trim($dato[$i]['id_serv']);
								$cant_serv=trim($dato[$i]['cant_serv']);
								$fecha=$fec;
								
								$tarifa_ser=$tarifa[$id_serv];
								
						//		echo "<br>$j:insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser')";
								$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser')");
								actualizarDeuda($acceso,$id_contrato);
								$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
							}
					}
				}
			}
		}
	*/

	/*	
		//$dato=lectura($acceso,"select cli_id_persona,id_contrato,nro_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and id_franq = '1' and num >14334 limit 10000000");
		$dato=lectura($acceso,"select cli_id_persona,id_contrato,nro_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle ");
		$acceso->objeto->ejecutarSql("delete from orden_grupo");
		$acceso->objeto->ejecutarSql("delete from auditoria");
		
		for($i=0;$i<count($dato);$i=$i+2)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			$cli_id_persona=trim($dato[$i]['cli_id_persona']);
			//echo "<br>$id_contrato";
			
			$dato1=lectura($acceso,"select id_pago from pagos where id_contrato='$id_contrato'");
			for($j=0;$j<count($dato1);$j++){
				$id_pago=trim($dato1[$j]['id_pago']);
					$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$id_pago'");
					//echo "<br>delete from pago_servicio where id_pago='$id_pago';";
					$acceso->objeto->ejecutarSql("delete from pago_servicio where id_pago='$id_pago'");
					//echo "<br>delete from pagos where id_pago='$id_pago';";
				
			
			}
				$acceso->objeto->ejecutarSql("delete from pagos where id_contrato='$id_contrato'");
				
			
			//echo "<br>delete from ordenes_tecnicos where id_contrato='$id_contrato';";
			
			$acceso->objeto->ejecutarSql("delete from notas where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from info_adic where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from info_adic where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from convenio_pago where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_contrato='$id_contrato'");
			
			
			
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_contrato='$id_contrato'");
			//echo "<br>delete from contrato where id_contrato='$id_contrato';";
			if(!$acceso->objeto->ejecutarSql("delete from contrato where id_contrato='$id_contrato'")){
				echo "<br>delete from contrato where id_contrato='$id_contrato'";
				echo $cable->objeto->error().'<br>';
			}
			//echo "<br>delete from cliente where id_persona='$cli_id_persona';";
			$acceso->objeto->ejecutarSql("delete from cliente where id_persona='$cli_id_persona'");
			//echo "<br>$i: delete from persona where id_persona='$cli_id_persona';";
			$acceso->objeto->ejecutarSql("delete from persona where id_persona='$cli_id_persona'");
		}
		
		*/
	/*
					$fecha='2012-01-01';
					$hasta='2012-01-31';
					$cont=0;

					while(comparaFecha($fecha,$hasta)<=0){
						//echo "<br>select sum(monto_pago) as monto from pagos where  fecha_pago = '$fecha';";
						$acceso->objeto->ejecutarSql("select sum(monto_pago) as monto from pagos where  fecha_pago = '$fecha' ");
						$row=row($acceso);
						$monto=trim($row['monto'])+0;
						//if($monto>0){
							echo "<br>$fecha : $monto";
							
							
							require_once "Graficos/Clases/estadisticas.php";
							$est=new estadisticas();
							$est->guardarDatos($acceso,$fecha);
					
						$fecha=sumadia($fecha);
					}
	*/
	/*
	//echo "select cli_id_persona,id_contrato from contrato,calle,sector where contrato.id_calle=calle.id_calle and sector.id_sector=calle.id_sector and sector.id_zona='DA00001'";
	$dato=lectura($acceso,"select cli_id_persona,id_contrato from contrato");
		
		//$acceso->objeto->ejecutarSql("Update cirre_diario set monto_total='4000'");
		//$acceso->objeto->ejecutarSql("Update caja_cobrador Set monto_acum='1000'");

		$acceso->objeto->ejecutarSql("delete from orden_grupo");

		for($i=0;$i<count($dato);$i=$i+2)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			$cli_id_persona=trim($dato[$i]['cli_id_persona']);
			echo "<br>$id_contrato";
			
			$dato1=lectura($acceso,"select id_cont_serv from contrato_servicio_pagado where id_contrato='$id_contrato'");
			for($j=0;$j<count($dato1);$j++){
				$id_cont_serv=trim($dato1[$j]['id_cont_serv']);

				$dato2=lectura($acceso,"select id_pago from pago_servicio where id_cont_serv='$id_cont_serv'");
				for($k=0;$k<count($dato2);$k++){
					$id_pago=trim($dato2[$k]['id_pago']);
					//echo "<br>delete from detalle_tipopago where id_pago='$id_pago';";
					$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$id_pago'");
					//echo "<br>delete from pago_servicio where id_pago='$id_pago';";
					$acceso->objeto->ejecutarSql("delete from pago_servicio where id_pago='$id_pago'");
					//echo "<br>delete from pagos where id_pago='$id_pago';";
					$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
				}
				//echo "<br>delete from contrato_servicio where id_cont_serv='$id_cont_serv';";
				$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv'");
			}
			//echo "<br>delete from ordenes_tecnicos where id_contrato='$id_contrato';";
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_contrato='$id_contrato'");
			//echo "<br>delete from contrato where id_contrato='$id_contrato';";
			$acceso->objeto->ejecutarSql("delete from contrato where id_contrato='$id_contrato'");
			//echo "<br>delete from cliente where id_persona='$cli_id_persona';";
			$acceso->objeto->ejecutarSql("delete from cliente where id_persona='$cli_id_persona'");
			echo "<br>$i: delete from persona where id_persona='$cli_id_persona';";
			$acceso->objeto->ejecutarSql("delete from persona where id_persona='$cli_id_persona'");
		}
*/
	/*
		$dato=lectura($acceso,"select cli_id_persona,id_contrato,nro_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle ");
		for($i=0;$i<count($dato);$i++)
		{
			$cont=$i;
			$cont++;
			
			if($cont<10)
				$cont="0".$cont;
			if($cont<100)
				$cont="0".$cont;
			
			if($cont<1000)
				$cont="0".$cont;
			if($cont<10000)
				$cont="0".$cont;
			if($cont<100000)
				$cont="0".$cont;	
			
			$cont=$serie.$cont;	
			$id_contrato=trim($dato[$i]['id_contrato']);
			$serie=trim($dato[$i]['serie']);
			$cli_id_persona=trim($dato[$i]['cli_id_persona']);
			echo "Update contrato Set nro_contrato='$cont' where id_contrato='$id_contrato'";
			$acceso->objeto->ejecutarSql("Update contrato Set nro_contrato='$cont' where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("Update cliente Set telf_casa='', email='', telf_adic='' where id_persona='$cli_id_persona'");
			
			$acceso->objeto->ejecutarSql("select * from persona where id_persona='$cli_id_persona'");
			$row=row($acceso);
			$cedula=trim($row["cedula"]);
			$telefono=trim($row["telefono"]);
			
			echo "<br>$cedula:$telefono:";
			
			$ced1=substr($cedula , 0,2);
			$ced2=substr($cedula , 2,2);
			$ced3=substr($cedula , 4,2);
			$ced4=substr($cedula , 6,4);
			
			$cedula = "$ced1$ced3$ced2$ced4";
			
			if($telefono!=''){
				if(strlen($telefono==5)){
					$dig=strlen($oper[0]);
				}
				$tel1=substr($telefono , 0,4);
				$tel2=substr($telefono , 4,2);
				$tel3=substr($telefono , 6,3);
				$tel4=substr($telefono , 9,2);
				$telefono = "$tel1$tel3$tel2$tel4";
			}
			echo "<br>$cedula:$telefono:";
			//echo "Update persona Set cedula='$cedula', telefono='$telefono' where id_persona='$cli_id_persona';";
			$acceso->objeto->ejecutarSql("Update persona Set cedula='$cedula', telefono='$telefono' where id_persona='$cli_id_persona'");
		}
		
	/*
		$cont=7495;
		$dato=lectura($acceso,"select nro_contrato, id_contrato from contrato order by id_contrato LIMIT 20000000 offset 2961 ");
		for($i=0;$i<count($dato);$i++)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			$cont++;
			echo "<br>Update contrato Set nro_contrato='$cont' where id_contrato='$id_contrato'";
			$acceso->objeto->ejecutarSql("Update contrato Set nro_contrato='$cont' where id_contrato='$id_contrato'");
		
		}
		
	*/	
	/*
	$cable->objeto->ejecutarSql("select id_contrato from contrato order by id_contrato asc");
	$i=0;
	$j=0;
	$fec=date("2012-09-01");
		while($row=row($cable)){
				$id_contrato=trim($row['id_contrato']);
						
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='SER00001'");
				$row1=row($acceso);
				$id_cont_serv = trim($row1['id_cont_serv']);
				if($acceso->objeto->registros >1){
					$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec'");
				}		
				
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='SER00003'");
				$row1=row($acceso);
				$id_cont_serv = trim($row1['id_cont_serv']);
				if($acceso->objeto->registros >1){
					$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec'");
				}
				
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='CA00001'");
				$row1=row($acceso);
				$id_cont_serv = trim($row1['id_cont_serv']);
				if($acceso->objeto->registros >1){
					$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec'");
				}
		}
	/*
	$cable->objeto->ejecutarSql("select id_pago from pagos where fecha_pago >= '2012-02-27' and fecha_pago <= '2012-02-29' order by fecha_pago, nro_factura LIMIT 100 offset 241 ");
	$i=0;
	$j=0;
		while($row=row($cable)){
			
				$id_pago=trim($row['id_pago']);
					ECHO "<BR>Update pagos Set id_caja_cob='XZ00000001' Where id_pago='$id_pago'";
					$acceso->objeto->ejecutarSql("  Update pagos Set id_caja_cob='XZ00000001' Where id_pago='$id_pago'");
			
		}
		
	*/
	/*
	$cable2->objeto->ejecutarSql("select id_contrato,cli_id_persona,nro_contrato,cedula,nombre,apellido from vista_contrato where  status_contrato='CORTADO' order by id_contrato asc  LIMIT 10000 offset 0");
	$i=0;
	$j=0;
		while($row=row($cable2)){
			
				$id_contrato=trim($row['id_contrato']);
				$id_persona=trim($row['cli_id_persona']);
				$nro_contrato=trim($row['nro_contrato']);
				$cedula=trim($row['cedula']);
				$nombre=trim($row['apellido'])." ".trim($row['nombre']);
				//ECHO "<BR>$j:$nro_contrato; $fecha_final;  $cedula; $nombre; <BR>select *from ordenes_tecnicos where id_contrato='$id_contrato' where id_det_orden='DEO00010'";
				
				$cable->objeto->ejecutarSql("select *from ordenes_tecnicos where id_contrato='$id_contrato' and id_det_orden='DEO00010' AND fecha_final<'2011-06-01' ORDER BY fecha_final DESC");
				if($row1=row($cable)){
					$fecha_final=trim($row1['fecha_final']);
					ECHO "<BR>$j:$nro_contrato; $fecha_final;  $cedula; $nombre; ";
					$j++;
					
					$cable->objeto->ejecutarSql("select id_pago from pagos where id_contrato='$id_contrato'");
					WHILE($row2=row($cable)){
							//$id_pago=trim($row2['id_pago']);
							$id_pago=trim($row2['id_pago']);
							$acceso->objeto->ejecutarSql("delete from pago_servicio where id_pago='$id_pago'");
							$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$id_pago'");
							$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
						
					}
					$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato'");
					$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_contrato='$id_contrato'");
					$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_contrato='$id_contrato'");
					
					$cable->objeto->ejecutarSql("select id_orden from ordenes_tecnicos where id_contrato='$id_contrato'");
					WHILE($row2=row($cable)){
							$id_orden=trim($row2['id_orden']);
							$acceso->objeto->ejecutarSql("delete from orden_grupo where id_orden='$id_orden'");
					}
					$acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_contrato='$id_contrato'");
					$acceso->objeto->ejecutarSql("delete from sms where id_contrato='$id_contrato'");
					$acceso->objeto->ejecutarSql("delete from contrato where id_contrato='$id_contrato'");
					$acceso->objeto->ejecutarSql("delete from cliente where id_persona='$id_persona'");
					$acceso->objeto->ejecutarSql("delete from persona where id_persona='$id_persona'");
				}
		}
		*/
		/*	
				$dato1=lectura($acceso,"select nro_contrato as contrato from contrato,contrato_servicio_deuda where contrato.id_contrato=contrato_servicio_deuda.id_contrato and fecha_inst='2012-01-01'  AND (id_serv='SER00001' or id_serv='BM00009' or id_serv='BM00008')  LIMIT 10000 offset 0");
				$dato=lectura($cable2,"select contrato as nro_contrato from alvey1 where year='2012' and mes='01' and cancelado='NO'  LIMIT 10000 offset 0");
					for($i=0;$i<count($dato);$i++){
						$nro_contrato=trim($dato[$i]['nro_contrato']);
					//	echo "<br>$k:$nro_contrato";
						$exi=false;
						for($j=0;$j<count($dato1);$j++){
							$contrato=trim($dato1[$j]['contrato']);
							//echo "<br>$k:$contrato";
							if($nro_contrato==$contrato){
								
								$exi=true;
								break;
							}
						}
						if($exi==false){
							echo "<br>$k:$nro_contrato";
							$k++;
						}
						else{
							//echo "<br>Nexixte$k:$nro_contrato";
						}
					}
	*/
	/*
				$dato=lectura($acceso,"select nro_contrato from contrato,contrato_servicio_deuda where contrato.id_contrato=contrato_servicio_deuda.id_contrato and fecha_inst='2012-01-01'  AND (id_serv='SER00001' or id_serv='BM00009' or id_serv='BM00008')  LIMIT 10000 offset 0");
				$dato1=lectura($cable2,"select contrato from alvey1 where year='2012' and mes='01' and cancelado='NO'  LIMIT 10000 offset 0");
					for($i=0;$i<count($dato);$i++){
						$nro_contrato=trim($dato[$i]['nro_contrato']);
					//	echo "<br>$k:$nro_contrato";
						$exi=false;
						for($j=0;$j<count($dato1);$j++){
							$contrato=trim($dato1[$j]['contrato']);
							//echo "<br>$k:$contrato";
							if($nro_contrato==$contrato){
								
								$exi=true;
								break;
							}
						}
						if($exi==false){
							echo "<br>$k:$nro_contrato";
							$k++;
						}
						else{
							//echo "<br>Nexixte$k:$nro_contrato";
						}
					}
					
					*/
					
					

	/*
	//ELIMINAR DEUDAS REPETIDAS CON LOS PAGOS
	$cable->objeto->ejecutarSql("select id_contrato from contrato order by id_contrato asc");
	$i=0;
	$j=0;
		while($row=row($cable)){
			
				$id_contrato=trim($row['id_contrato']);
				//ECHO "<BR>$id_contrato;";
				$fec=date("2012-01-01");
						
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='SER00001'");
				$row1=row($acceso);
				$id_cont_serv = trim($row1['id_cont_serv']);
				//echo "<br>:".$acceso->objeto->registros.":";
				if($acceso->objeto->registros == 2){
					ECHO "<BR>delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'";
					$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec'");
				}
		}
	*/
	
	/*
	//ELIMINAR ULTIMOS 10 REGISTROS DE CADA CLIENTE
		
		//echo "<br>select id_pago from pagos where fecha_pago< '2011-01-01' ORDER BY id_pago  LIMIT 1 offset 0;";
		$cable->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato order by id_contrato LIMIT 10000 offset 0;");
	$i=0;
	$j=0;
		while($row=row($cable)){
				$id_contrato=trim($row['id_contrato']);
				$nro_contrato=trim($row['nro_contrato']);
				
				$cable2->objeto->ejecutarSql("select fecha_inst from contrato_servicio_pagado where id_contrato='$id_contrato' and id_serv='SER00001' ORDER BY fecha_inst DESC LIMIT 1 offset 0");
				if($row2=row($cable2)){
					//$id_pago=trim($row2['id_pago']);
					$fecha_inst=trim($row2['fecha_inst']);
				//	echo "<br>$fecha_inst";

					$cable1->objeto->ejecutarSql("select id_cont_serv,fecha_inst,id_serv,costo_cobro from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst<'$fecha_inst'");
					while($row1=row($cable1)){
						$costo_cobro = trim($row1['costo_cobro']);
						$id_serv = trim($row1['id_serv']);
						$id_cont_serv = trim($row1['id_cont_serv']);
						$fecha_inst=trim($row2['fecha_inst']);
						echo "<br><br>$i:$id_contrato:$nro_contrato:";
						echo "<br>$fecha_inst:$id_serv:$costo_cobro";
						echo "<br>delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'";
						$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'");
						$i++;
					//	echo "<br>delete from contrato_servicio_pagado where id_cont_serv='$id_cont_serv';";
					//	$acceso->objeto->ejecutarSql("delete from pago_servicio where id_cont_serv='$id_cont_serv' and id_pago='$id_pago'");
						//$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_cont_serv='$id_cont_serv'");
					}
				//	echo "<br>delete from detalle_tipopago where id_pago='$id_pago';";
				//	echo "<br>delete from pagos where id_pago='$id_pago';";
					//$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$id_pago'");
					//$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
				}
		}
		*/
	/*
	$cable->objeto->ejecutarSql("select distinct costo_cobro from contrato_servicio_deuda where fecha_inst >= '2011-01-01'");
	$i=0;
	$j=0;
		while($row=row($cable)){
				$costo_cobro=trim($row['costo_cobro']);
				echo "<br>$i:$costo_cobro:";
				$cable2->objeto->ejecutarSql("select contrato from alvey1 where (impuesto+monto12)='21' and cancelado='NO' LIMIT 2 offset 0");
				while($row2=row($cable2)){
					$contrato=trim($row2['contrato']);
					echo "<:$contrato:";
					
				}
		}

		*/
	/*
	//ELIMINAR DEUDAS REPETIDAS CON LOS PAGOS
	$cable->objeto->ejecutarSql("select id_contrato from contrato order by id_contrato asc LIMIT 10000 offset 0");
	$i=0;
	$j=0;
		while($row=row($cable)){
			
				$id_contrato=trim($row['id_contrato']);
				$fec=date("2011-07-01");
						
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='SER00001'");
				$row1=row($acceso);
				$id_cont_serv = trim($row1['id_cont_serv']);
				//echo "<br>:".$acceso->objeto->registros.":";
				if($acceso->objeto->registros == 1){
										//echo "<br>select contrato_servicio_pagado.id_cont_serv from contrato_servicio_pagado,pago_servicio, pagos where pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv AND pagos.id_contrato='$id_contrato' and contrato_servicio_pagado.fecha_inst='$fec' and (contrato_servicio_pagado.id_serv='SER00001' or contrato_servicio_pagado.id_serv='SER00005')";
					$acceso->objeto->ejecutarSql("select contrato_servicio_pagado.id_cont_serv from contrato_servicio_pagado,pago_servicio, pagos where pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv AND pagos.id_contrato='$id_contrato' and contrato_servicio_pagado.fecha_inst='$fec' and (contrato_servicio_pagado.id_serv='SER00001' or contrato_servicio_pagado.id_serv='SER00005')");
					if($acceso->objeto->registros == 1){
						if($row1=row($acceso)){
							$id_cont_serv = trim($row1['id_cont_serv']);
							
							echo "<br>pagado $id_cont_serv:$id_contrato:delete from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec'";	
							$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec'");
						}
					}
				}
		}
	
	/*
	//ELIMINAR DEUDAS REPETIDAS CON LOS PAGOS
	$cable->objeto->ejecutarSql("select id_contrato from contrato order by id_contrato");
	$i=0;
	$j=0;
		while($row=row($cable)){
			
				$id_contrato=trim($row['id_contrato']);
				$fec=date("2011-07-01");
						
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='SER00001'");
				$row1=row($acceso);
				$id_cont_serv = trim($row1['id_cont_serv']);
				//echo "<br>:".$acceso->objeto->registros.":";
				if($acceso->objeto->registros == 2){
					
					
					echo "<br>$id_cont_serv:$id_contrato";			
					$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'");
					
					$cable1->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='SER00003'");
					//echo "<br>cant:".$cable1->objeto->registros.":";
					if($cable1->objeto->registros == 2){
						$row1=row($cable1);
						$id_cont_serv = trim($row1['id_cont_serv']);
						echo "<br>ce $id_cont_serv:$id_contratov:";		
						$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'");

					}
				}
				else if($acceso->objeto->registros == 1){
					//echo "<br>reg:".$acceso->objeto->registros.":";
					$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado where id_contrato='$id_contrato' and fecha_inst='$fec' and (id_serv='SER00001' or id_serv='SER00005')");
					if($acceso->objeto->registros == 1){
						if($row1=row($acceso)){
							$id_cont_serv = trim($row1['id_cont_serv']);
							
							
							
							$cable1->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec'");
							while($row1=row($cable1)){
								$id_cont_serv = trim($row1['id_cont_serv']);
								echo "<br>pagado $id_cont_serv:$id_contrato";	
								$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'");
							}
						}
					}
				}
		}
		*/
		
		/*
		//ELIMINAR ULTIMOS 10 REGISTROS DE CADA CLIENTE
		
		//echo "<br>select id_pago from pagos where fecha_pago< '2011-01-01' ORDER BY id_pago  LIMIT 1 offset 0;";
		$cable->objeto->ejecutarSql("select id_contrato from contrato order by id_contrato LIMIT 10000 offset 0;");
	$i=0;
	$j=0;
		while($row=row($cable)){
				$id_contrato=trim($row['id_contrato']);
				echo "<br>$id_contrato<br>";
				$cable2->objeto->ejecutarSql("select id_pago,fecha_pago from pagos where id_contrato='$id_contrato' ORDER BY fecha_pago DESC LIMIT 500 offset 3");
				while($row2=row($cable2)){
					$id_pago=trim($row2['id_pago']);
					$fecha_pago=trim($row2['fecha_pago']);
					echo "$id_pago : ";

					$cable1->objeto->ejecutarSql("select id_cont_serv from pago_servicio where id_pago='$id_pago'");
					while($row1=row($cable1)){
						$id_cont_serv = trim($row1['id_cont_serv']);
					//	echo "<br>delete from pago_servicio where id_cont_serv='$id_cont_serv' and id_pago='$id_pago';";
					//	echo "<br>delete from contrato_servicio_pagado where id_cont_serv='$id_cont_serv';";
						$acceso->objeto->ejecutarSql("delete from pago_servicio where id_cont_serv='$id_cont_serv' and id_pago='$id_pago'");
						$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_cont_serv='$id_cont_serv'");
					}
				//	echo "<br>delete from detalle_tipopago where id_pago='$id_pago';";
				//	echo "<br>delete from pagos where id_pago='$id_pago';";
					$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$id_pago'");
					$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
				}
		}
*/
	/*	
		//ACTUALIZADAS ID DE DEUDAS QUE CHOQUE CON EL ID DE PAGADOS
	
	$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda order by id_cont_serv asc");
	$i=0;
	$j=0;
		while($row=row($acceso)){
			
				$id_cont_ser=trim($row['id_cont_serv']);
				$id_cont_serv="P".trim($row['id_cont_serv']);
//echo "<br>$j:$i:$id_cont_serv = $id_cont_serv_d    Update contrato_servicio_deuda Set id_cont_serv='$id_cont_serv_n' Where id_cont_serv='$id_cont_ser'";
						
				$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado where id_cont_serv='$id_cont_serv' ");
					if($fila=row($cable)){
						$id_cont_serv_d = trim($fila['id_cont_serv']);
						
						$cable->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
						$id_cont_serv_n=verCodLongD($cable,"id_cont_serv",$ini_u);
						
						echo "<br>$j:$i:$id_cont_serv = $id_cont_serv_d    Update contrato_servicio_deuda Set id_cont_serv='$id_cont_serv_n' Where id_cont_serv='$id_cont_ser'";
						$i++;
						
						
					//	$cable->objeto->ejecutarSql("Update contrato_servicio_deuda Set id_cont_serv='$id_cont_serv_n' Where id_cont_serv='$id_cont_ser'");
					}
				$j++;
		}
		*/
		
	/*
	$cable->objeto->ejecutarSql("SELECT con FROM contrato");
	$i=0;
	$j=0;
		while($row=row($cable)){
			$id_contrato=trim($row['con']);
			$cont=trim($row['con']);
			
			if($cont<10)
				$cont="0".$cont;
			if($cont<100)
				$cont="0".$cont;
			if($cont<1000)
				$cont="0".$cont;
			if($cont<10000)
				$cont="0".$cont;
			if($cont<100000)
				$cont="0".$cont;	
			
			
			echo "<br>Update contrato Set con='$cont' where con='$id_contrato'";
			$cable1->objeto->ejecutarSql("Update contrato Set con='$cont' where con='$id_contrato'");
		}
		/*
	$login=$_SESSION["login"];
		$fec=date("Y-m-01");
		$tarifa= array();
		
			$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
			//$id_cont_serv=$ini_u.verCodLong($acceso,"id_cont_serv");
			$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
			
					$dato=lectura($acceso,"select id_serv from servicios where tipo_costo='COSTO MENSUAL'");
					for($i=0;$i<count($dato);$i++){
						$id_serv=trim($dato[$i]['id_serv']);
						$acceso->objeto->ejecutarSql("select tarifa_ser from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'  LIMIT 1 offset 0 "); 
						$row=row($acceso);
						$tarifa_ser=trim($row['tarifa_ser']);
						$tarifa[trim($dato[$i]['id_serv'])]=$tarifa_ser;
					}

		    $contra=lectura($acceso,"select id_contrato from contrato where status_contrato='ACTIVO'order by id_contrato ");
				
			
			for($j=0;$j<count($contra);$j++){
				$id_contrato=trim($contra[$j]['id_contrato']);
				$acceso->objeto->ejecutarSql("select count(id_cont_serv) as num from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='SER00001'");
				$row=row($acceso);
				$num = trim($row['num']);
				if($num==0){
					
					$acceso->objeto->ejecutarSql("select count(id_cont_serv) as num from contrato_servicio_pagado where id_contrato='$id_contrato' and fecha_inst='$fec' and id_serv='SER00001'");
					$row=row($acceso);
					$num = trim($row['num']);
					if($num==0){
						
							$dato=lectura($acceso,"select id_serv,cant_serv from contrato_servicio where id_contrato='$id_contrato' and status_con_ser='CONTRATO'");
							for($i=0;$i<count($dato);$i++){
								$id_serv=trim($dato[$i]['id_serv']);
								$cant_serv=trim($dato[$i]['cant_serv']);
								$fecha=$fec;
								
								$tarifa_ser=$tarifa[$id_serv];
								
								echo "<br>$j:insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser')";
								$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser')");
								actualizarDeuda($acceso,$id_contrato);
								$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
							
							}
					}
				}
			}
				*/
			//	$acceso->objeto->ejecutarSql("select id_mensualidad from mensualidad  where (id_mensualidad ILIKE '$ini_u%') ORDER BY id_mensualidad desc"); 
			//	$id_mensualidad=$ini_u.verCo($acceso,"id_mensualidad");
							
				//echo "insert into mensualidad(id_mensualidad,login,fecha_mens,generada) values ('$id_mensualidad','$login','$fec','AUTOMATICO')";
			//	$acceso->objeto->ejecutarSql("insert into mensualidad(id_mensualidad,login,fecha_mens,generada) values ('$id_mensualidad','$login','$fec','AUTOMATICO')");
		//  }
		  
		  
		
//	$cable->objeto->ejecutarSql("Update pagos Set fecha_pago='2008-01-01' Where fecha_pago < '2008-01-01'");
	/*

	$acceso->objeto->ejecutarSql("select id_pago from pagos order by id_pago");

		while($row=row($acceso)){
			
				$id_pago=trim($row['id_pago']);
				//echo "<br>select sum(cant_serv * costo_cobro) as deuda from pago_servicio,contrato_servicio_pagado where pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv and pago_servicio.id_pago='$id_pago'";
				$cable->objeto->ejecutarSql("select sum(cant_serv * costo_cobro) as deuda from pago_servicio,contrato_servicio_pagado where pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv and pago_servicio.id_pago='$id_pago'");
					if($fila=row($cable)){
						$deuda = trim($fila['deuda']);
						
						echo "<br>Update pagos Set monto_pago='$deuda' Where id_pago='$id_pago'";
						$cable->objeto->ejecutarSql("Update pagos Set monto_pago='$deuda' Where id_pago='$id_pago'");
					}
		}
	*/
	/*
		$acceso->objeto->ejecutarSql("select id_persona,telefono from persona");

		while($row=row($acceso)){
			
				$id_persona=trim($row['id_persona']);
				$telefono=trim($row['telefono']);
				
				if(strlen($telefono)==10){
					$telf="0".$telefono;
					echo "<br>Update persona Set telefono='$telf' Where id_persona='$id_persona'";
					$cable->objeto->ejecutarSql("Update persona Set telefono='$telf' Where id_persona='$id_persona'");
				}
		}
		*/
		/*
	//ACTUALIZAR LA DEUDA
		$acceso->objeto->ejecutarSql("select id_contrato,nro_contrato from contrato order by id_contrato  desc LIMIT 10000 offset 0");
		echo "hola";
		while($row=row($acceso)){
			echo "hola";
				$id_contrato=trim($row['id_contrato']);
				$nro_contrato=trim($row['nro_contrato']);
				
					//echo "<br>select sum(cant_serv * costo_cobro) as deuda from contrato_servicio_deuda where id_contrato='$id_contrato' and status_con_ser='DEUDA'";
					
					$cable->objeto->ejecutarSql("select sum(cant_serv * costo_cobro) as deuda from contrato_servicio_deuda where id_contrato='$id_contrato' and status_con_ser='DEUDA'");
					if($fila=row($cable)){
						$deuda = trim($fila['deuda']);
						if($deuda=='')
							$deuda=0;
						echo "<br>$nro_contrato:Update contrato Set deuda='$deuda' Where id_contrato='$id_contrato'";
						$cable->objeto->ejecutarSql("Update contrato Set deuda='$deuda' Where id_contrato='$id_contrato'");
					}
		}
		*/
/*
	$dato=lectura($acceso,"select DISTINCT id_pago,id_contrato from vista_pser order by id_pago");
		for($i=0;$i<count($dato);$i++)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			$id_pago=trim($dato[$i]['id_pago']);
			echo "<br>$i:Update pagos Set id_contrato='$id_contrato' where id_pago='$id_pago';";
			//$acceso->objeto->ejecutarSql("Update pagos Set id_contrato='$id_contrato' where id_pago='$id_pago'");
		}

	/*	
		$dato=lectura($acceso,"select id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv, status_con_ser,costo_cobro from contrato_servicio order by id_cont_serv");
		for($i=0;$i<count($dato);$i++){
			$id_contrato=trim($dato[$i]['id_contrato']);
			$id_cont_serv=trim($dato[$i]['id_cont_serv']);
			$id_serv=trim($dato[$i]['id_serv']);
			$fecha_inst=trim($dato[$i]['fecha_inst']);
			$cant_serv=trim($dato[$i]['cant_serv']);
			$status_con_ser=trim($dato[$i]['status_con_ser']);
			$costo_cobro=trim($dato[$i]['costo_cobro']);
			
			echo "<br>$i:insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro');";
			if($status_con_ser=="PAGADO"){
				$acceso->objeto->ejecutarSql("insert into contrato_servicio_pagado(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro')");
				$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv'");
			}
			else if($status_con_ser=="DEUDA"){
				$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro')");
				$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv'");
			}
		}
		
	*/	
/*
		$dato=lectura($acceso,"select id_cont_serv,id_pago from pago_servicio order by id_cont_serv");
		for($i=0;$i<count($dato);$i++){
			$id_cont_serv=trim($dato[$i]['id_cont_serv']);
			$id_pago=trim($dato[$i]['id_pago']);
			$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado where id_cont_serv='$id_cont_serv'");
			if($acceso->objeto->registros<=0){
				$acceso->objeto->ejecutarSql("select status_pago from pagos where id_pago='$id_pago'");
				$row=row($acceso);
				$status_pago=trim($row['status_pago']);
				echo "<br>$i:".$id_cont_serv.":$id_pago:$status_pago";
				//$acceso->objeto->ejecutarSql("delete from pago_servicio where id_cont_serv='$id_cont_serv' and id_pago='$id_pago'");
			}
		}

/*
		$dato=lectura($acceso,"select id_cont_serv from contrato_servicio where status_con_ser='PAGADO' or status_con_ser='DEUDA'");
		for($i=0;$i<count($dato);$i++){
			$id_cont_serv=trim($dato[$i]['id_cont_serv']);
			
			$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv'");
		}
		
*/		
/*
$dato=lectura($acceso,"select cli_id_persona,id_contrato from contrato");
		
		$acceso->objeto->ejecutarSql("Update cirre_diario set monto_total='4000'");
		$acceso->objeto->ejecutarSql("Update caja_cobrador Set monto_acum='1000'");
		
		$acceso->objeto->ejecutarSql("delete from orden_grupo");
		
		for($i=0;$i<count($dato)/2;$i++)
		{
			
			$id_contrato=trim($dato[$i]['id_contrato']);
			$cli_id_persona=trim($dato[$i]['cli_id_persona']);
			
			$dato1=lectura($acceso,"select id_cont_serv from contrato_servicio where id_contrato='$id_contrato'");
			for($j=0;$j<count($dato1);$j++){
				$id_cont_serv=trim($dato1[$j]['id_cont_serv']);
				
				$dato2=lectura($acceso,"select id_pago from pago_servicio where id_cont_serv='$id_cont_serv'");
				for($k=0;$k<count($dato2);$k++){
					$id_pago=trim($dato2[$k]['id_pago']);
					//echo "<br>delete from detalle_tipopago where id_pago='$id_pago';";
					$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$id_pago'");
					//echo "<br>delete from pago_servicio where id_pago='$id_pago';";
					$acceso->objeto->ejecutarSql("delete from pago_servicio where id_pago='$id_pago'");
					//echo "<br>delete from pagos where id_pago='$id_pago';";
					$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
				}
				//echo "<br>delete from contrato_servicio where id_cont_serv='$id_cont_serv';";
				$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv'");
			}
			//echo "<br>delete from ordenes_tecnicos where id_contrato='$id_contrato';";
			$acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_contrato='$id_contrato'");
			//echo "<br>delete from contrato where id_contrato='$id_contrato';";
			$acceso->objeto->ejecutarSql("delete from contrato where id_contrato='$id_contrato'");
			//echo "<br>delete from cliente where id_persona='$cli_id_persona';";
			$acceso->objeto->ejecutarSql("delete from cliente where id_persona='$cli_id_persona'");
			echo "<br>$i: delete from persona where id_persona='$cli_id_persona';";
			$acceso->objeto->ejecutarSql("delete from persona where id_persona='$cli_id_persona'");
		}

*/

		
		/*

		$dato=lectura($acceso,"select cli_id_persona,id_contrato,nro_contrato from contrato");
		for($i=0;$i<count($dato);$i++)
		{
			$cont=$i;
			$cont++;
			
			if($cont<10)
				$cont="0".$cont;
			if($cont<100)
				$cont="0".$cont;
			if($cont<1000)
				$cont="0".$cont;
			if($cont<10000)
				$cont="0".$cont;
			if($cont<100000)
				$cont="0".$cont;	
			
			$id_contrato=trim($dato[$i]['id_contrato']);
			$cli_id_persona=trim($dato[$i]['cli_id_persona']);
			echo "Update contrato Set nro_contrato='$cont' where id_contrato='$id_contrato'";
			$acceso->objeto->ejecutarSql("Update contrato Set nro_contrato='$cont' where id_contrato='$id_contrato'");
		//	$acceso->objeto->ejecutarSql("Update cliente Set telf_casa='', email='', telf_adic='' where id_persona='$cli_id_persona'");
			
			$acceso->objeto->ejecutarSql("select * from persona where id_persona='$cli_id_persona'");
			$row=row($acceso);
			$cedula=trim($row["cedula"]);
			$telefono=trim($row["telefono"]);
			
			echo "<br>$cedula:$telefono:";
			
			$ced1=substr($cedula , 0,2);
			$ced2=substr($cedula , 2,2);
			$ced3=substr($cedula , 4,2);
			$ced4=substr($cedula , 6,4);
			
			$cedula = "$ced1$ced3$ced2$ced4";
			
			
			if($telefono!=''){
				if(strlen($telefono==5)){
					$dig=strlen($oper[0]);
				}
				$tel1=substr($telefono , 0,4);
				$tel2=substr($telefono , 4,2);
				$tel3=substr($telefono , 6,3);
				$tel4=substr($telefono , 9,2);
				$telefono = "$tel1$tel3$tel2$tel4";
			}
			echo "<br>$cedula:$telefono:";
			*/
			//echo "Update persona Set cedula='$cedula', telefono='$telefono' where id_persona='$cli_id_persona';";
		//	$acceso->objeto->ejecutarSql("Update persona Set cedula='$cedula', telefono='$telefono' where id_persona='$cli_id_persona'");
		//}
		
		
		/*
		$dato=lectura($acceso,"select login from usuario");
		for($i=0;$i<count($dato);$i++)
		{
			$login=trim($dato[$i]['login']);
			echo "<br>delete from usuario where login='$login'";
			$acceso->objeto->ejecutarSql("delete from usuario where login='$login'");
		}
		
		$dato=lectura($acceso,"select id_persona from vendedor");
		for($i=0;$i<count($dato);$i++)
		{
			$id_persona=trim($dato[$i]['id_persona']);
			echo "<br>delete from vendedor where id_persona='$id_persona'";
			$acceso->objeto->ejecutarSql("delete from vendedor where id_persona='$id_persona'");
		}
		
		$dato=lectura($acceso,"select id_persona from tecnico");
		for($i=0;$i<count($dato);$i++)
		{
			$id_persona=trim($dato[$i]['id_persona']);
			echo "<br>delete from tecnico where id_persona='$id_persona'";
			$acceso->objeto->ejecutarSql("delete from tecnico where id_persona='$id_persona'");
		}
		
		$dato=lectura($acceso,"select id_persona from cobrador");
		for($i=0;$i<count($dato);$i++)
		{
			$id_persona=trim($dato[$i]['id_persona']);
			echo "<br>delete from cobrador where id_persona='$id_persona'";
			$acceso->objeto->ejecutarSql("delete from cobrador where id_persona='$id_persona'");
		}
		
		$dato=lectura($acceso,"select id_persona from persona");
		for($i=0;$i<count($dato);$i++)
		{
			$id_persona=trim($dato[$i]['id_persona']);
			echo "<br>delete from persona where id_persona='$id_persona'";
			$acceso->objeto->ejecutarSql("delete from persona where id_persona='$id_persona'");
		}
		*/
/*
$k=1;
	//Update pagos Set fecha_pago='2011-05-06' Where fecha_pago='2011-05-07';
	//Update caja_cobrador Set fecha_pago='2011-05-06' Where fecha_pago='2011-05-07';
	
		$dato=lectura($acceso,"select *from pagos where fecha_pago='2011-05-07'");
		
		
		for($i=0;$i<count($dato);$i=$i+2)
		{
			
			$id_pago=trim($dato[$i]['id_pago']);
			
			$id_p=separa($id_pago);
			$id_p="CC00000".$id_p;
			$acceso->objeto->ejecutarSql("Update pago_servicio Set id_pago='$id_p' Where id_pago='$id_pago'");
			$acceso->objeto->ejecutarSql("Update detalle_tipopago Set id_pago='$id_p' Where id_pago='$id_pago'");
			$acceso->objeto->ejecutarSql("Update pagos Set id_pago='$id_p' Where id_pago='$id_pago'");
			$id_caja_cob=trim($dato[$i]['id_caja_cob']);
			
			$fecha_pago=trim($dato[$i]['fecha_pago']);
			$nro_factura=trim($dato[$i]['nro_factura']);

			echo "<br>$k:$id_pago : $id_caja_cob : $fecha_pago : $nro_factura:$id_p";
				$k++;
		}
/*
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
	
	$k=1;
	for($j=01;$j<=05;$j++){
		$ult_dia_mes=date("t",mktime( 0, 0, 0, $j, 1, 2011 ));
			
			$fec_ini="2011-$j-01";
			$fec_fin="2011-$j-$ult_dia_mes";
		//select *from contrato_servicio where status_con_ser<>'CONTRATO' and id_serv='SER00001' and fecha_inst between '2011-01-01' and '2011-01-31' and (select count(id_cont_serv) from contrato_servicio as cs where status_con_ser<>'CONTRATO' and id_serv='SER00001' and fecha_inst between '2011-01-01' and '2011-01-31' and contrato_servicio.id_contrato = cs.id_contrato)=2 order by id_contrato,fecha_inst,id_cont_serv
		$dato=lectura($acceso,"select *from contrato_servicio where status_con_ser<>'CONTRATO' and id_serv='SER00001' and fecha_inst between '$fec_ini' and '$fec_fin' and (select count(id_cont_serv) from contrato_servicio as cs where status_con_ser<>'CONTRATO' and id_serv='SER00001' and fecha_inst between '$fec_ini' and '$fec_fin' and contrato_servicio.id_contrato = cs.id_contrato)=2  order by id_contrato,fecha_inst,id_cont_serv");
		//echo "<br><br>select *from contrato_servicio where status_con_ser<>'CONTRATO' and id_serv='SER00001' and fecha_inst between '$fec_ini' and '$fec_fin' and (select count(id_cont_serv) from contrato_servicio as cs where status_con_ser<>'CONTRATO' and id_serv='SER00001' and fecha_inst between '$fec_ini' and '$fec_fin' and contrato_servicio.id_contrato = cs.id_contrato)=2  order by id_contrato,fecha_inst,id_cont_serv";
		
		
		for($i=0;$i<count($dato);$i=$i+2)
		{
			
			$id_contrato=trim($dato[$i]['id_contrato']);
			$id_cont_serv=trim($dato[$i]['id_cont_serv']);
			
			$fecha_inst=trim($dato[$i]['fecha_inst']);
			$costo_cobro=trim($dato[$i]['costo_cobro']);
			$status_con_ser=trim($dato[$i]['status_con_ser']);
			
			
			//echo "<br>$k:$id_cont_serv : $id_contrato : $fecha_inst : $costo_cobro : $status_con_ser";
			//	$k++;
			
			if($costo_cobro==0 || trim($dato[$i+1]['costo_cobro'])==0){
				
			}
			else{
			
					$acceso->objeto->ejecutarSql("select nro_contrato from contrato where id_contrato='$id_contrato'");
					$row=row($acceso);
					$nro_contrato=trim($row["nro_contrato"]);
		
					echo "<br>$k :$nro_contrato : $fecha_inst : $costo_cobro : $status_con_ser";
					$id_contrato=trim($dato[$i+1]['id_contrato']);
					$id_cont_serv=trim($dato[$i+1]['id_cont_serv']);
					
					$fecha_inst=trim($dato[$i+1]['fecha_inst']);
					$costo_cobro=trim($dato[$i+1]['costo_cobro']);
					$status_con_ser=trim($dato[$i+1]['status_con_ser']);
					
					echo "<br>$k :$nro_contrato : $fecha_inst : $costo_cobro : $status_con_ser";
					$k++;
			
				
				if($status_con_ser=='DEUDA' && trim($dato[$i+1]['status_con_ser'])=='DEUDA'){
					$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv'");	
				}
				else if($status_con_ser=='PAGADO' && trim($dato[$i+1]['status_con_ser'])=='DEUDA'){
					$id_cont_serv=trim($dato[$i+1]['id_cont_serv']);
					$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv'");
				}
				else if($status_con_ser=='DEUDA' && trim($dato[$i+1]['status_con_ser'])=='PAGADO'){
					$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv'");
				}
				else if($status_con_ser=='PAGADO' && trim($dato[$i+1]['status_con_ser'])=='PAGADO'){
				
					
					$acceso->objeto->ejecutarSql("select nro_contrato from contrato where id_contrato='$id_contrato'");
					$row=row($acceso);
					$nro_contrato=trim($row["nro_contrato"]);
		
					echo "<br>$k :$nro_contrato : $fecha_inst : $costo_cobro : $status_con_ser";
					$id_contrato=trim($dato[$i+1]['id_contrato']);
					$id_cont_serv=trim($dato[$i+1]['id_cont_serv']);
					
					$fecha_inst=trim($dato[$i+1]['fecha_inst']);
					$costo_cobro=trim($dato[$i+1]['costo_cobro']);
					$status_con_ser=trim($dato[$i+1]['status_con_ser']);
					
					echo "<br>$k :$nro_contrato : $fecha_inst : $costo_cobro : $status_con_ser";
					$k++;
					
					
				}
				
			}
		}
	}
*/


/*
		$k=1;
		$dato=lectura($acceso,"select *from pagos where id_pago ILIKE '%CB%' and fecha_pago='2011-05-03' order by id_pago");
		
		
		for($i=0;$i<count($dato);$i=$i+2)
		{
			
			$id_pago=trim($dato[$i]['id_pago']);
			
			$id_p=separa($id_pago);
			$id_p="CC00000".$id_p;
			$acceso->objeto->ejecutarSql("Update pago_servicio Set id_pago='$id_p' Where id_pago='$id_pago'");
			$acceso->objeto->ejecutarSql("Update detalle_tipopago Set id_pago='$id_p' Where id_pago='$id_pago'");
			$acceso->objeto->ejecutarSql("Update pagos Set id_pago='$id_p' Where id_pago='$id_pago'");
			$id_caja_cob=trim($dato[$i]['id_caja_cob']);
			
			$fecha_pago=trim($dato[$i]['fecha_pago']);
			$nro_factura=trim($dato[$i]['nro_factura']);

			echo "<br>$k:$id_pago : $id_caja_cob : $fecha_pago : $nro_factura:$id_p";
				$k++;
		}
*/


/*
		$dato=lectura($acceso,"select contrato_servicio.id_contrato, contrato_servicio.fecha_inst from contrato_servicio,contrato where contrato.id_contrato=contrato_servicio.id_contrato and id_serv='SER00002' and (status_con_ser='DEUDA' or status_con_ser='PAGADO') and status_contrato='CORTADO'");
		$tecnico='TEC00001';
		$j=1;
		$suma=0;
		for($i=0;$i<count($dato);$i++)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			$fecha_inst=trim($dato[$i]['fecha_inst']);

			
			
				
				
						$id_det_orden='DEO00010';
						$acceso->objeto->ejecutarSql("select *from ordenes_tecnicos ORDER BY id_orden desc LIMIT 1 offset 0 "); 
						$id_orden=verNumero($acceso,"id_orden");
					//	echo "<br>$i:: insert into ordenes_tecnicos(id_orden,id_persona,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$tecnico','$id_det_orden','$fecha_inst','$fecha_inst','','','FINALIZADO','$id_contrato','NORMAL')";
					//	$acceso->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,id_persona,id_det_orden,fecha_orden,fecha_final,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad) values ('$id_orden','$tecnico','$id_det_orden','$fecha_inst','$fecha_inst','','','FINALIZADO','$id_contrato','NORMAL')");
				
			
		}
		
		$dato=lectura($acceso,"select contrato_servicio.id_cont_serv, contrato_servicio.costo_cobro,contrato_servicio.fecha_inst from contrato_servicio,contrato where contrato.id_contrato=contrato_servicio.id_contrato and id_serv='SER00001' and status_con_ser='DEUDA' and  costo_cobro>'0' and costo_cobro<'80' and fecha_inst>'2010-12-22'");
		
		for($i=0;$i<count($dato);$i++)
		{
			$id_cont_serv=trim($dato[$i]['id_cont_serv']);
			$suma+=trim($dato[$i]['costo_cobro']);
		//	echo "<br>$i:Update contrato_servicio Set costo_cobro='100' Where id_cont_serv='$id_cont_serv'";
		//	$acceso->objeto->ejecutarSql("Update contrato_servicio Set costo_cobro='100' Where id_cont_serv='$id_cont_serv'");
		}
		*/
//	echo "Finalizado";


/*
		$dato=lectura($acceso,"
		SELECT id_contrato,nro_contrato,id_franq,cedula,apellido,nombre,status_contrato,etiqueta,telefono,
	( SELECT sum(contrato_servicio.cant_serv::numeric * contrato_servicio.costo_cobro)FROM contrato_servicio WHERE contrato_servicio.id_contrato = vista_contrato.id_contrato AND contrato_servicio.status_con_ser = 'DEUDA'::bpchar  ) AS deuda
	
 
   FROM vista_contrato
  WHERE vista_contrato.status_contrato = 'CORTADO'::bpchar and 
  ( SELECT sum(contrato_servicio.cant_serv::numeric * contrato_servicio.costo_cobro) FROM contrato_servicio WHERE contrato_servicio.id_contrato = vista_contrato.id_contrato AND contrato_servicio.status_con_ser = 'DEUDA'::bpchar  )=40
		");
		for($i=0;$i<count($dato);$i++)
		{
				$id_contrato=trim($dato[$i]['id_contrato']);
				$nro_contrato=trim($dato[$i]['nro_contrato']);
				$cedula=trim($dato[$i]['cedula']);
				$apellido=trim($dato[$i]['apellido']);
				
				$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_contrato='$id_contrato' and id_serv='SER00002'");
				$acceso->objeto->ejecutarSql("Update contrato Set status_contrato='ACTIVO' Where id_contrato='$id_contrato'");	
				echo "<br>$i: CONTRATO: $nro_contrato : CEDULA: $cedula : $apellido";
		}
		*/
	//echo date("H:i:s");
//	phpinfo();
/*
$dato=lectura($acceso,"SELECT id_pago , nro_factura FROM pagos WHERE id_caja_cob='AC00000054' order by nro_factura");
		$num_factura='222852';
		for($i=0;$i<count($dato);$i++)
		{
				$nro_factura=trim($dato[$i]['nro_factura']);
				$id_pago=trim($dato[$i]['id_pago']);
				echo "<br>$i:$nro_factura : ";
				$num_factura++;
				echo "$num_factura:";
				//$id_pago_act=str_replace("CB","CA",$id_pago);
				
				$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '%CA%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
				$id_pago_act = "CA".verCodLargo($acceso,"id_pago");
	
				echo " : $id_pago : $id_pago_act";
		/*		
				echo "<br>SELECT *from pago_servicio where id_pago='$id_pago'";
				$dato1=lectura($acceso,"SELECT *from pago_servicio where id_pago='$id_pago'");
				
				
				echo "<br>: delete from pago_servicio where id_pago='$id_pago': ";
				$acceso->objeto->ejecutarSql("delete from pago_servicio where id_pago='$id_pago'");
				
				
				echo "<br>Update pagos Set nro_factura='$num_factura', id_pago='$id_pago_act' Where id_pago='$id_pago'";
				
				$acceso->objeto->ejecutarSql("Update pagos Set nro_factura='$num_factura', id_pago='$id_pago_act' Where id_pago='$id_pago'");	
				
				
			
			for($j=0;$j<count($dato1);$j++)
			{
				$id_cont_serv=trim($dato1[$j]['id_cont_serv']);
				echo "<br>insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago_act','$id_cont_serv')";
				$acceso->objeto->ejecutarSql("insert into pago_servicio(id_pago,id_cont_serv) values ('$id_pago_act','$id_cont_serv')");			
			}
				//$acceso->objeto->ejecutarSql("Update pago_servicio Set id_pago='$id_pago_act' Where id_pago='$id_pago'");	
				echo "<br>Update detalle_tipopago Set id_pago='$id_pago_act' Where id_pago='$id_pago'<br>";
				$acceso->objeto->ejecutarSql("Update detalle_tipopago Set id_pago='$id_pago_act' Where id_pago='$id_pago'");	
*/
		//}
		
		//select nro_contrato, status_con_ser, cant_serv, costo_cobro, tipo_costo,tarifa_ser from vista_contratoser WHERE fecha_inst>='2011-02-01' and status_con_ser<>'CONTRATO' and costo_cobro < 100 and id_serv='SER00001'
?>