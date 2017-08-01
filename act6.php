<?php
	require_once "procesos.php"; $ini_u = "JK"; 
	$cable=conectar("Postgres",'localhost','postgres','123456','oficina_virtual');
	$cable2=conectar("Postgres",'localhost','postgres','123456','oficina_virtual');
	$acceso=conectar("Postgres",'localhost','postgres','123456','saeco_cablehogar');

	$dato=lectura($acceso,"select * from vista_contrato_auditoria  limit 10 offset 1000");
		echo count($dato);;
		for($i=0;$i<count($dato);$i++){
		$cable2->objeto->ejecutarSql("BEGIN;");
		
			$id_contrato=trim($dato[$i]['id_contrato']);
			$cedula=trim($dato[$i]['cedula']);
			$nombre=trim($dato[$i]['nombre']);
			$apellido=trim($dato[$i]['apellido']);
			$telefono=trim($dato[$i]['telefono']);
			$telf_casa=trim($dato[$i]['telf_casa']);
			$email=trim($dato[$i]['email']);

				$nro_contrato=trim($dato[$i]['nro_contrato']);
				$status_contrato=trim($dato[$i]['status_contrato']);
				$direc_adicional=trim($dato[$i]['direc_adicional']);
				$numero_casa=trim($dato[$i]['numero_casa']);
				$nombre_franq=trim($dato[$i]['nombre_franq']);
				$nombre_zona=trim($dato[$i]['nombre_zona']);
				$saldo=trim($dato[$i]['saldo'])+0;
				
				if(!$cable2->objeto->ejecutarSql("insert into cliente(id_contrato,cedula,nombre,apellido,telefono,nro_contrato,status_contrato,saldo,nombre_zona,nombre_franq) values ('$id_contrato','$cedula','$nombre','$apellido','$telefono','$nro_contrato','$status_contrato','$saldo','$nombre_zona','$nombre_franq')")){


					echo "<br>insert into cliente(id_contrato,cedula,nombre,apellido,telefono,nro_contrato,status_contrato,saldo,nombre_zona,nombre_franq) values ('$id_contrato','$cedula','$nombre','$apellido','$telefono','$nro_contrato','$status_contrato','$saldo','$nombre_zona','$nombre_franq')<br>".$cable2->objeto->error().'<br>';
				}
				else{
				/*
					$pagos=lectura($acceso,"select * from pagos where id_contrato='$id_contrato'");
				for($k=0;$k<count($pagos);$k++){
				$id_pago=trim($pagos[$k]['id_pago']);
				$id_caja_cob=trim($pagos[$k]['id_caja_cob']);
				$fecha_pago=trim($pagos[$k]['fecha_pago']);
				$hora_pago=trim($pagos[$k]['hora_pago']);
				$monto_pago=trim($pagos[$k]['monto_pago']);
				$obser_pago=trim($pagos[$k]['obser_pago']);
				$status_pago=trim($pagos[$k]['status_pago']);
				$nro_factura=trim($pagos[$k]['nro_factura']);
				$id_contrato=trim($pagos[$k]['id_contrato']);
				$nota_credito=trim($pagos[$k]['nota_credito']);
				$cont=trim($pagos[$k]['cont']);
				$nro_control=trim($pagos[$k]['nro_control']);
				$inc=trim($pagos[$k]['inc']);
				$desc_pago=trim($pagos[$k]['desc_pago']);
				$por_iva=trim($pagos[$k]['por_iva']);
				$monto_iva=trim($pagos[$k]['monto_iva']);
				$por_reten=trim($pagos[$k]['por_reten']);
				$monto_reten=trim($pagos[$k]['monto_reten']);
				$base_imp=trim($pagos[$k]['base_imp']);
				$islr=trim($pagos[$k]['islr']);
				$n_credito=trim($pagos[$k]['n_credito']);
				$fecha_factura=trim($pagos[$k]['fecha_factura']);
				$comision=trim($pagos[$k]['comision']);

				if(!$cable2->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,monto_iva,por_reten,monto_reten,base_imp,islr,fecha_factura,comision) values ('$id_pago_G','$id_caja_cob','$fecha_pago','$hora_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato_G','$nro_control','$desc_pago','$por_iva','$monto_iva','$por_reten','$monto_reten','$base_imp','$islr','$fecha_factura','$costo_dif_men')")){
					echo "<br>insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,monto_iva,por_reten,monto_reten,base_imp,islr,fecha_factura) values ('$id_pago_G','$id_caja_cob','$fecha_pago','$hora_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato_G','$nro_control','$desc_pago','$por_iva','$monto_iva','$por_reten','$monto_reten','$base_imp','$islr','$fecha_factura')";
					echo '<br>'.$cable2->objeto->error().'<br>';
				}
				*/
			}
			$cable2->objeto->ejecutarSql("COMMIT;");
		}//from contrato

?>