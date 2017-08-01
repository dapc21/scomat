<?php

require_once "procesos.php"; $ini_u = "YA"; 

	$acceso=conectar("Postgres",'localhost','postgres','123456','prueba');
	$acceso1=conectar("Postgres",'localhost','postgres','123456','saeco_cablehogar');
	/*
	$acceso1->objeto->ejecutarSql("select id_contrato from contrato limit 1000000000000");
	while($row=row($acceso1)){
		$id_contrato=trim($row['id_contrato']);
		$acceso->objeto->ejecutarSql("insert into contrato(id_contrato) values ('$id_contrato')");
	}			
	*/
	
	

	$acceso1->objeto->ejecutarSql("select * from pagos limit 100000000000000");
	while($row=row($acceso1)){
		$id_pago=trim($row['id_pago']);
		$id_contrato=trim($row['id_contrato']);
		$fecha_pago=trim($row['fecha_pago']);
		$monto_pago=trim($row['monto_pago']);
		$obser_pago=trim($row['obser_pago']);
		$status_pago=trim($row['status_pago']);
		$nro_factura=trim($row['nro_factura']);
		$id_contrato=trim($row['id_contrato']);
		$nro_control=trim($row['nro_control']);
		$tipo_doc=trim($row['tipo_doc']);
		$acceso->objeto->ejecutarSql("insert into pagos(id_pago,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,tipo_doc) 
				values ('$id_pago','$fecha_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$nro_control','$tipo_doc')");
	}			
	
/*
			$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
			$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
			
			$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and tipo_doc='PAGOS' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
			$nro_factura = verNumero_factura_v4($acceso,"nro_factura",8);		

		//$dato=lectura($acceso,"select nro_contrato,id_contrato from contrato order by id_contrato limit 10000000000;");
		$dato=lectura($acceso,"select nro_contrato,id_contrato from contrato order by id_contrato limit 1000000 offset 18364");
		for($i=0;$i<count($dato);$i++){
			$acceso->objeto->ejecutarSql("BEGIN;");
			$id_contrato=trim($dato[$i]['id_contrato']);
			$nro_contrato=trim($dato[$i]['nro_contrato']);
			
			echo "<br>$nro_contrato;";
			$acceso1->objeto->ejecutarSql("select facnrofact,ctanrocomp,ctaimpgrab ,ctatipcomp,ctacoment,ctafecha from ctacte where id_contrato='$id_contrato'");
			while($row=row($acceso1)){
				$facnrofact=trim($row['facnrofact']);
				$ctanrocomp=trim($row['ctanrocomp']);
				$ctaimpgrab=trim($row['ctaimpgrab']);
				$ctatipcomp=trim($row['ctatipcomp']);
				$ctacoment=trim($row['ctacoment']);
				$ctacoment=trim($row['ctacoment']);
				$ctafecha=trim($row['ctafecha']);
				if($ctatipcomp=='FAC'){
					$tipo_doc="FACTURA";
					$status_pago="GENERADA";
				}
				else if($ctatipcomp=='PAG' OR $ctatipcomp=='REC'){
					$tipo_doc="PAGO";
					$status_pago="PAGADO";
				}
				else if($ctatipcomp=='NC'){
					$tipo_doc="NOTA CREDITO";
					$status_pago="GENERADA";
				}
				else if($ctatipcomp=='ND'){
					$tipo_doc="NOTA DEBITO";
					$status_pago="GENERADA";
				}
				else if($ctatipcomp=='ACO'){
					$status_pago="GENERADA";
				}
			

	
				$nro_factura=$facnrofact;
				$nro_control=$ctanrocomp;
				$id_caja_cob="EA00000001";
				$fecha_pago=$ctafecha;
				$hora_pago=date("H:i:s");
				$monto_pago=abs($ctaimpgrab);
				
				$obser_pago=$ctacoment;
				
				
				$por_iva=12;
				$desc_pago=0;
				$base_imp=$monto_pago/1.12;
				$monto_iva=$base_imp*0.12;
				$fecha_factura=$fecha_pago;
				$impresion="SI";
				
				$monto_reten=0;
				$islr=0;
				
				$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,monto_iva,base_imp,monto_reten,islr,fecha_factura,impresion,tipo_doc) 
				values ('$id_pago','$id_caja_cob','$fecha_pago','$hora_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$nro_control','$desc_pago','$por_iva','$monto_iva','$base_imp','$monto_reten','$islr','$fecha_factura','$impresion','$tipo_doc')");
					
					
				$id_pago=$ini_u.verCodLongInc_pago($acceso,$id_pago);
				
			}

			$acceso->objeto->ejecutarSql("COMMIT;");
		}

/*

	$dato=lectura($acceso,"select * from vista_contrato_auditoria where costo_dif_men=1  ORDER BY ID_CONTRATO LIMIT 5000000");
		//	echo count($dato);
		for($i=0;$i<count($dato);$i++){
			$acceso->objeto->ejecutarSql("BEGIN;");
			$id_contrato=trim($dato[$i]['id_contrato']);
			
			$cli_id_persona=trim($dato[$i]['cli_id_persona']);
			//echo "<br>$i:$id_contrato";
			$dato1=lectura($acceso,"select id_orden from ordenes_tecnicos where id_contrato='$id_contrato'");
			for($j=0;$j<count($dato1);$j++){
				$id_orden=trim($dato1[$j]['id_orden']);
				$acceso->objeto->ejecutarSql("delete from orden_grupo where id_orden='$id_orden'");
			}
			
			$dato1=lectura($acceso,"select id_pago from pagos where id_contrato='$id_contrato'");
			for($j=0;$j<count($dato1);$j++){
				$id_pago=trim($dato1[$j]['id_pago']);
					$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$id_pago'");
					//echo "<br>delete from pago_servicio where id_pago='$id_pago';";
				//	$acceso->objeto->ejecutarSql("delete from pago_servicio where id_pago='$id_pago'");
					//echo "<br>delete from pagos where id_pago='$id_pago';";

			}
			
				$acceso->objeto->ejecutarSql("delete from pagos where id_contrato='$id_contrato'");
				$acceso->objeto->ejecutarSql("delete from abo_cortados where id_contrato='$id_contrato'");
				$acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_contrato='$id_contrato'");
				
			
			//echo "<br>delete from ordenes_tecnicos where id_contrato='$id_contrato';";
			
			$acceso->objeto->ejecutarSql("delete from notas where id_contrato='$id_contrato'");
			
			
			$acceso->objeto->ejecutarSql("delete from ctacte where id_contrato='$id_contrato'");
			
			$acceso->objeto->ejecutarSql("delete from recuperado where id_contrato='$id_contrato'");
			//$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_contrato='$id_contrato'");
			$acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_contrato='$id_contrato'");
		//	echo "<br>delete from contrato where id_contrato='$id_contrato'";
			if(!$acceso->objeto->ejecutarSql("delete from contrato where id_contrato='$id_contrato'")){
				echo "<br>delete from contrato where id_contrato='$id_contrato'";
				echo $acceso->objeto->error().'<br>';
			}
			$acceso->objeto->ejecutarSql("delete from cliente where id_persona='$cli_id_persona'");
		
			$acceso->objeto->ejecutarSql("delete from persona where id_persona='$cli_id_persona'");
			$acceso->objeto->ejecutarSql("COMMIT;");
		}

	/*
	$dato=lectura($acceso,"select id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle ORDER by nombre_franq,status_contrato,fecha_contrato limit 100000000");
		
		for($i=0;$i<count($dato);$i=$i+3)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			//echo "<br>update  contrato set costo_dif_men=0 where id_contrato='$id_contrato';";
			$acceso->objeto->ejecutarSql("update  contrato set costo_dif_men=0 where id_contrato='$id_contrato'");
		}
	*/	
	/*
		$dato=lectura($acceso,"select id_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and costo_dif_men=0 ORDER by nombre_franq,status_contrato,fecha_contrato limit 100000000");
		
		for($i=0;$i<count($dato);$i=$i+9)
		{
			$id_contrato=trim($dato[$i]['id_contrato']);
			//echo "<br>update  contrato set costo_dif_men=0 where id_contrato='$id_contrato';";
			$acceso->objeto->ejecutarSql("update  contrato set costo_dif_men=1 where id_contrato='$id_contrato'");
		}
		*/
		
		/*
		
		--select count(*) from contrato where  costo_dif_men='1' and (select count(*) from vista_ubica where vista_ubica.id_calle=contrato.id_calle and ( nombre_zona='JOSE MARTI' or nombre_zona='ARAGUANEY' or nombre_zona='AGUAS CALIENTES' or nombre_zona='FUNDACION CAP' or nombre_zona='KM 12 JUNQUITO' or nombre_zona='LUIS HURTADO' or nombre_zona='BUENA VISTA' or nombre_zona='LA CRUZ' or nombre_zona='SAN AGUSTIN'))>0
--UPDATE CONTRATO set costo_dif_men='1' where (select count(*) from vista_ubica where vista_ubica.id_calle=contrato.id_calle and ( nombre_zona='JOSE MARTI' or nombre_zona='ARAGUANEY' or nombre_zona='AGUAS CALIENTES' or nombre_zona='FUNDACION CAP' or nombre_zona='KM 12 JUNQUITO' or nombre_zona='LUIS HURTADO' or nombre_zona='BUENA VISTA' or nombre_zona='LA CRUZ' or nombre_zona='SAN AGUSTIN'))>0

--select * from ctacte limit 10;
--select count(*) from contrato where status_contrato='ACTIVO' and costo_dif_men='0' AND (select sum(costo_cobro) from contrato_servicio where contrato_servicio.id_contrato=contrato.id_contrato )<250 
--UPDATE CONTRATO set costo_dif_men='1' where status_contrato='ACTIVO' and costo_dif_men='0' AND (select sum(costo_cobro) from contrato_servicio where contrato_servicio.id_contrato=contrato.id_contrato )<250 
--UPDATE CONTRATO set costo_dif_men='1';

--select count(*) from contrato where costo_dif_men='0';
--select count(*) from contrato where status_contrato='ACTIVO' and costo_dif_men='0' ;
--select status_contrato,count(*) from contrato where  costo_dif_men='0' group by status_contrato;


--select count(*) as cant,(select sum(ctaimpgrab) from ctacte where ctacte.id_contrato = contrato.id_contrato and ctatipcomp='FAC' AND ctafecha BETWEEN '2014-11-01' and '2014-11-30') as monto from contrato where status_contrato='ACTIVO' and costo_dif_men='0';


select count(*) as cant, sum(ctaimpgrab) as monto
from contrato 
join ctacte on ctacte.id_contrato = contrato.id_contrato
where status_contrato='ACTIVO' and costo_dif_men='0' and ctatipcomp='FAC' AND ctafecha BETWEEN '2014-05-01' and '2014-05-31' ;


/*

select count(a.*) as cant, sum(b.ctaimpgrab) as monto
from contrato a
join ctacte b on b.id_contrato = a.id_contrato
where a.status_contrato='ACTIVO' and a.costo_dif_men='0' and b.ctacoment = 'NOVIEMBRE/2014';
*/
/*
select sum(b.ctaimpgrab) as monto
from contrato a
left join ctacte b on b.id_contrato = a.id_contrato
where a.status_contrato='ACTIVO' and a.costo_dif_men='0' and ctatipcomp='NC' AND ctafecha BETWEEN '2014-09-01' and '2014-09-30' ;
*/







		
		
?>		

