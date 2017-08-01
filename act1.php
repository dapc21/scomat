<?php
include_once "procesos.php"; 

$acceso=conexion();
	$cable=conexion();
	$cable1=conexion();

$dias_a_cobrar=12;
$fecha='2015-05-01';
list($ano,$mes,$dia)=explode("-",$fecha);
$mes_inst=date ("Y-m",mktime(0,0,0, $mes,$dia,$ano));

$id_contrato='XH00000823';
echo "select id_pago from pagos where id_contrato='$id_contrato' and TO_CHAR(fecha_factura,'YYYY-MM') ='$mes_inst' and  monto_pago>0 and (tipo_doc='AVISO' or tipo_doc='FACTURA') ";
$acceso->objeto->ejecutarSql("select id_pago from pagos where id_contrato='$id_contrato' and TO_CHAR(fecha_factura,'YYYY-MM') ='$mes_inst' and  monto_pago>0 and (tipo_doc='AVISO' or tipo_doc='FACTURA') "); 
		if(!$row=row($acceso)){
		}


//verificar si tiene cargado el aviso mensual para este mes



//verifica_caja_virtual($acceso);
	//registrar_pago_virtual($acceso);

//agregar_aviso_unico_cliente($acceso,'XH00027593','2015-04-22','"AB00055"',600);

/*
$cable->objeto->ejecutarSql("Update inicial_id Set status='DISPONIBLE';");
$cable->objeto->ejecutarSql("delete from usuario_inicial;");

	$dato=lectura($cable1,"select login from usuario");
	$servi=lectura($cable1,"select id_servidor from servidor  where status_ser='ACTIVO'");
	$k=1;
		for($i=0;$i<count($dato);$i++)
		{
			$login=$dato[$i]['login'];
			for($j=0;$j<count($servi);$j++)
			{	
				$id_servidor=$servi[$j]['id_servidor'];
				$acceso->objeto->ejecutarSql("select id_inicial_id,inicial from inicial_id  where id_servidor='$id_servidor' and status='DISPONIBLE' ORDER BY id_inicial_id");
				if($row=row($acceso)){
					$inicial=trim($row['inicial']);
					$id_inicial_id=trim($row['id_inicial_id']);
					//echo "<br>$i: insert into usuario_inicial(login,id_servidor,inicial) values ('$login','$id_servidor','$inicial');";
					$cable->objeto->ejecutarSql("insert into usuario_inicial(login,id_servidor,inicial) values ('$login','$id_servidor','$inicial');");
					$cable->objeto->ejecutarSql("Update inicial_id Set status='ASIGNADO' Where id_inicial_id='$id_inicial_id';");
				}
			}
		}
	

**/
	/*
	$ini_u = "XH"; 
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	
	$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
	$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
			
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and tipo_doc='PAGOS' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",8);
	
	//CODIGO PARA AGREGAR PAGOS ADELANTADO
	$contra=lectura($acceso,"select * from deudalanto where costo_cobro<0");	
	//$monto_pago=500;
	$aux=0;
	for($j=0;$j<count($contra);$j++){
		$id_contrato=trim($contra[$j]['id_contrato']);
		$monto_pago=trim($contra[$j]['costo_cobro']);
		$monto_pago=($monto_pago)*(-1);
		echo "<br>:$id_contrato: $monto_pago";
		registrar_deppagodeposito($acceso,$id_contrato,$monto_pago,$id_pago,$nro_factura);
		
		$id_pago=$ini_u.verCodLargoInc($acceso,$id_pago);
		$nro_factura = verNumero_factura_v4Inc($acceso,$nro_factura,8);
		$aux=$aux+1;
	}
	echo "<br>toatl:".$aux;
*/
	//CODIGO PARA AGREGAR DEUDA
	//function agregar_deuda()
	//{
	/*	$contra=lectura($acceso,"select * from deudalanto where costo_cobro>0");	
		
		$fec='2015-03-27';
		$id_caja_cob='EA00000001';
		$nro_control='';
		$dig_fact_G=8;
		$dig_control_G=8;
		$aux=0;
		$id_serv='AB00001';
		for($j=0;$j<count($contra);$j++){
			$id_contrato=trim($contra[$j]['id_contrato']);
			$monto_pago=trim($contra[$j]['costo_cobro']);
			//$monto_pago=trim($contra[$j]['costo_cobro']);
			echo "<br>:$id_contrato: $monto_pago";
			
			$id_cont_serv=agregar_aviso_cliente_unico($acceso,$id_contrato,$fec,$id_pago,$id_serv,$monto_pago,$id_caja_cob,$nro_factura,$nro_control,$dig_fact_G,$dig_control_G,$id_cont_serv);
			$id_pago=$ini_u.verCodLargoInc($acceso,$id_pago);
			$nro_factura = verNumero_factura_v4Inc($acceso,$nro_factura,8);
			$aux=$aux+1;
			
		}
		echo "<br>toatl:".$aux;
	//}
	*/
	/*
	function registrar_deppagodeposito($acceso,$id_contrato,$monto_pago,$id_pago,$nro_factura)
	{
		require_once "Clases/pagos.php";
		$dat = array();
		$detalle_tipopago = array();
		$pago_factura = array();

		$detalle_tipopago[0]['id_pago']=$id_pago;
		$detalle_tipopago[0]['id_tipo_pago']="TPA00001";
		$detalle_tipopago[0]['monto_tp']=$monto_pago;
		$detalle_tipopago[0]['id_banco']='';
		$detalle_tipopago[0]['refer_tp']='';
		$detalle_tipopago[0]['id_banco']='';

		$dat['id_pago']=$id_pago;
		$dat['id_caja_cob']='EA00000001';
		$dat['monto_pago']=$monto_pago;
		$dat['obser_pago']="pago en lotes";
		$dat['status_pago']="PAGADO";
		$dat['nro_factura']=$nro_factura;
		$dat['id_contrato']=$id_contrato;
		$dat['nro_control']='';
		$dat['desc_pago']=0;
		$dat['por_iva']=12;
		$dat['n_credito']='';
		$dat['impresion']='SI';
		$dat['detalle_tipopago']=$detalle_tipopago;
		
		$id_select = ajusta_cargo_pago_factura($acceso,$id_contrato,$monto_pago);
		$cargo=explode("=@",$id_select);
		$indice=0;

		for($j=1;$j<count($cargo);$j++)
		{
			$id_cont_serv=$cargo[$j];
			$pago_factura[$indice]['id_pago']=$id_pago;
			$pago_factura[$indice]['id_cont_serv']=$id_cont_serv;
			$indice++;
		}

		$dat['pago_factura']=$pago_factura;

		$obj_pago=new pagos($dat);
		$obj_pago->incluir($acceso);

	}
	
	*/
?>