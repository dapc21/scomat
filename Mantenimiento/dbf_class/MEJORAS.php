	if(!$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser')")){
					$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
					$id_cont_serv=verCodLongD($acceso,"id_cont_serv","OO");
					$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser')");
				}
				
				
				
				
	
function verCodLongD($acceso,$valor,$ini_u){	
	$cod = $ini_u.verCodLong($acceso,$valor);	
	//echo "<br>$cod<br>";
	$x=0;
	
	do{
		
		$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '%$cod%') ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		//	echo "<br>$cod";
		}
		else{
			$existe=false;
		}
		$x++;
	}while($existe==true);
	
	
	do{
		
		$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado  where (id_cont_serv ILIKE '%$cod%') ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		//	echo "<br>$cod";
		}
		else{
			$existe=false;
		}
		$x++;
	}while($existe==true);
	
	return $cod;	
}
