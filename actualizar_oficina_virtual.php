<?php
	require_once "procesos.php"; $ini_u = "JK"; 
	$cable=conectar("Postgres",'localhost','postgres','123456','oficina_virtual');
	$cable2=conectar("Postgres",'localhost','postgres','123456','oficina_virtual');
	$acceso=conectar("Postgres",'localhost','postgres','123456','saeco_cablehogar');

/*	
	$cable2->objeto->ejecutarSql("delete from  contrato_servicio_deuda;");
	$cable2->objeto->ejecutarSql("delete from  estado_cuenta;");
	$cable2->objeto->ejecutarSql("delete from  cliente;");
*/
	
	$dato=lectura($acceso,"select * from vista_contrato_auditoria  limit 1000000000000 offset 0");
		echo count($dato);;
		for($i=0;$i<count($dato);$i++){
		//$cable->objeto->ejecutarSql("BEGIN;");
		
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
				
				if(!$cable->objeto->ejecutarSql("insert into cliente(id_contrato,cedula,nombre,apellido,telefono,nro_contrato,status_contrato,saldo,nombre_zona,nombre_franq) values ('$id_contrato','$cedula','$nombre','$apellido','$telefono','$nro_contrato','$status_contrato','$saldo','$nombre_zona','$nombre_franq')")){


					echo "<br>insert into cliente(id_contrato,cedula,nombre,apellido,telefono,nro_contrato,status_contrato,saldo,nombre_zona,nombre_franq) values ('$id_contrato','$cedula','$nombre','$apellido','$telefono','$nro_contrato','$status_contrato','$saldo','$nombre_zona','$nombre_franq')<br>".$cable->objeto->error().'<br>';
				}
				else{
				
					$pagos=lectura($acceso,"select * from pagos where id_contrato='$id_contrato'");
					for($k=0;$k<count($pagos);$k++){
						$id_pago=trim($pagos[$k]['id_pago']);
						$fecha_pago=trim($pagos[$k]['fecha_pago']);
						$monto_pago=trim($pagos[$k]['monto_pago']);
						$obser_pago=trim($pagos[$k]['obser_pago']);
						$status_pago=trim($pagos[$k]['status_pago']);
						$nro_factura=trim($pagos[$k]['nro_factura']);
						$id_contrato=trim($pagos[$k]['id_contrato']);
						$fecha_factura=trim($pagos[$k]['fecha_factura']);
						$tipo_doc=trim($pagos[$k]['tipo_doc']);
						$inc=trim($pagos[$k]['inc']);
						
						if(!$cable->objeto->ejecutarSql("insert into estado_cuenta(id_pago,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,fecha_factura,tipo_doc,inc,tipo) values ('$id_pago','$fecha_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$fecha_factura','$tipo_doc','$inc','REAL')")){
							echo "<br>insert into estado_cuenta(id_pago,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,fecha_factura,tipo_doc,inc,tipo) values ('$id_pago','$fecha_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$fecha_factura','$tipo_doc','$inc','REAL')";
							echo '<br>'.$cable->objeto->error().'<br>';
						}
					}
					
					$pagos=lectura($acceso,"select * from vista_contrato_servicio_deuda,servicios where vista_contrato_servicio_deuda.id_serv=servicios.id_serv and id_contrato='$id_contrato';");
					for($k=0;$k<count($pagos);$k++){
						$id_cont_serv=trim($pagos[$k]['id_cont_serv']);
						$id_serv=trim($pagos[$k]['id_serv']);
						$fecha_inst=trim($pagos[$k]['fecha_inst']);
						$cant_serv=trim($pagos[$k]['cant_serv']);
						$status_con_ser=trim($pagos[$k]['status_con_ser']);
						$costo_cobro=trim($pagos[$k]['costo_cobro']);
						$descu=trim($pagos[$k]['descu']);
						$apagar=trim($pagos[$k]['apagar']);
						$id_pago=trim($pagos[$k]['id_pago']);
						$pagado=trim($pagos[$k]['pagado']);
						$inc=trim($pagos[$k]['inc']);
						$nombre_servicio=trim($pagos[$k]['nombre_servicio']);
						
						if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda
							(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago,pagado,apagar,inc,nombre_servicio) values 
							('$id_cont_serv','$id_serv','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','$descu','$id_pago','$pagado','$apagar','$inc','$nombre_servicio')")){
							echo "<br>insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago,pagado,apagar,inc,nombre_servicio) values ('$id_cont_serv','$id_serv','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','$descu','$id_pago','$pagado','$apagar','$inc','$nombre_servicio')";
							echo '<br>'.$cable->objeto->error().'<br>';
						}
								
						
					}

			}

			//$cable->objeto->ejecutarSql("COMMIT;");
		}//from contrato

		/*
		$pagos=lectura($acceso,"select * from cuenta_bancaria");
		for($k=0;$k<count($pagos);$k++){
			$id_cuba=trim($pagos[$k]['id_cuba']);
			$numero_cuba=trim($pagos[$k]['numero_cuba']);
			$banco_cuba=trim($pagos[$k]['banco_cuba']);
			$abrev_cuba=trim($pagos[$k]['abrev_cuba']);
			$status_cuba=trim($pagos[$k]['status_cuba']);
			$titular_cuba=trim($pagos[$k]['desc_cuba']);

			$cable->objeto->ejecutarSql("select * from  cuenta_bancaria where id_cuba='$id_cuba'");
			if($row=row($cable)){
				if(!$cable->objeto->ejecutarSql("update  cuenta_bancaria set numero_cuba='$numero_cuba', banco_cuba='$banco_cuba', abrev_cuba='$abrev_cuba',status_cuba='$status_cuba', titular_cuba='$titular_cuba'  where id_cuba='$id_cuba' ;")){
					echo "<br>update  cuenta_bancaria set numero_cuba='$numero_cuba', banco_cuba='$banco_cuba', abrev_cuba='$abrev_cuba',status_cuba='$status_cuba', titular_cuba='$titular_cuba'  where id_cuba='$id_cuba' ;";
					echo '<br>'.$cable->objeto->error().'<br>';
				}
			}else{
				if(!$cable->objeto->ejecutarSql("insert into cuenta_bancaria (id_cuba,numero_cuba,banco_cuba,abrev_cuba,status_cuba,titular_cuba) values ('$id_cuba','$numero_cuba','$banco_cuba','$abrev_cuba','$status_cuba','$titular_cuba')")){
					echo "<br>";
					echo '<br>'.$cable->objeto->error().'<br>';
				}
			}
		}
		*/
?>