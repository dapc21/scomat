<?php
session_start();
require_once "procesos.php"; 

class mensualidad
{
	function __construct($dat)
	{
	}
	public function cargar_mensualidad($acceso)
	{
		//echo "entro a cargar_mensualidad";
		session_start();
		$ini_u = $_SESSION["ini_u"];
		if($ini_u==''){
			$ini_u = "ZZ";
		}

		$login=$_SESSION["login"];
		$tarifa= array();
		
		$acceso->objeto->ejecutarSql("select *from parametros where id_param='61'");
		$row=row($acceso);
		$mes_a_cargar=trim($row['valor_param']);
		$fec=date("Y-m-01");
		
		if($mes_a_cargar=='POSTERIOR'){
			$fec_prepago=sumames($fec,2);
			$fec_postpago=sumames($fec,1);
		}
		else if($mes_a_cargar=='ACTUAL'){
			$fec_prepago=sumames($fec,1);
			$fec_postpago=$fec;
		}
		else{
			$fec_prepago=$fec;
			$fec_postpago=restames($fec,1);
		}
		
		$acceso->objeto->ejecutarSql("select *from mensualidad where fecha_mens='$fec'"); 
	  	if(!row($acceso)){
	  		//echo "no esta cargado";
			$acceso->objeto->ejecutarSql("select id_mensualidad from mensualidad  where (id_mensualidad ILIKE '$ini_u%') ORDER BY id_mensualidad desc"); 
			$id_mensualidad=$ini_u.verCo($acceso,"id_mensualidad");
			$acceso->objeto->ejecutarSql("insert into mensualidad(id_mensualidad,login,fecha_mens,generada) values ('$id_mensualidad','$login','$fec','AUTOMATICO')");
			/*IDs*/
			$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
			$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);

			$acceso->objeto->ejecutarSql("select *from parametros where id_param='46' and id_franq='1'");
			$row=row($acceso);
			$dig_fact_G=trim($row['valor_param']);

			$acceso->objeto->ejecutarSql("select *from parametros where id_param='52' and id_franq='1'");
			$row=row($acceso);
			$dig_control_G=trim($row['valor_param']);

			$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
			$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
			$id_caja_cob='EA00000001';

			$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='AVISO' and tipo_caja='PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
			$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);

			$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='AVISO' and tipo_caja='PRINCIPAL' ORDER BY nro_control desc LIMIT 1 offset 0 "); 
			$nro_control = verNumero_factura_v4($acceso,"nro_control",$dig_control_G);
			/*IDs*/
			//echo "select id_contrato,nro_contrato,tipo_fact from contrato where status_contrato='ACTIVO' or status_contrato='POR SUSPENDER' or status_contrato='POR CORTAR' order by id_contrato   LIMIT 10000000000 offset 0 ";
		     $contra=lectura($acceso,"select id_contrato,nro_contrato,tipo_fact from contrato where status_contrato='ACTIVO' or status_contrato='POR SUSPENDER' or status_contrato='POR CORTAR' order by id_contrato   LIMIT 10000000000 offset 0 ");
			
			for($j=0;$j<count($contra);$j++){
				$id_contrato=trim($contra[$j]['id_contrato']);
				$nro_contrato=trim($contra[$j]['nro_contrato']);
				$tipo_fact=trim($contra[$j]['tipo_fact']);
				if($tipo_fact=='PREPAGO'){
					$fec=$fec_prepago;
				}else{
					$fec=$fec_postpago;
				}
			//	echo "<br>$id_contrato,$fec,$id_pago,$id_caja_cob,$nro_factura,$nro_control,$dig_fact_G,$dig_control_G,$id_cont_serv";
				$id_cont_serv=agregar_factura_cliente($acceso,$id_contrato,$fec,$id_pago,$id_caja_cob,$nro_factura,$nro_control,$dig_fact_G,$dig_control_G,$id_cont_serv);
				$id_pago=$ini_u.verCodLargoInc($acceso,$id_pago);
				$nro_factura = verNumero_factura_v4Inc($acceso,$nro_factura,$dig_fact_G);
				$nro_control = verNumero_factura_v4Inc($acceso,$nro_control,$dig_control_G);
			}	//for contrato
		}//si no esta cargada
	}//function
}
?>