<?php

require_once("../procesos.php");

//echo ":".$_SESSION["autenticacion"].":".$_SESSION["ini_u"].":";
if($_SESSION["autenticacion"]!="On"){
	
	if($clase=='Manejador')
		echo Manejador();
	else
		echo "SecurityFalse";
}
else{


$tipo=$_GET['tipo'];

require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

$x->allowFilters();
//$x->showRowNumber();

if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

	switch($tipo)
	{
		case cliente_con_repedito:
			$sql="
			select nro_contrato,cedula,nombre, apellido from vista_contrato where (select count(*) from contrato where contrato.cli_id_persona=vista_contrato.cli_id_persona )>1
			";

			$x->setQuery("*","from contrato","","");
			$x->consultas($sql);
			$x->printTable();
			break;
			
		
		case cliente_con_saldo_negativo_boxi:
			$sql="select nombre_franq, nro_contrato,cedula,nombre, apellido, (select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato_auditoria.id_contrato and costo_cobro<0) as saldo

 from vista_contrato_auditoria where 
(select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato_auditoria.id_contrato and costo_cobro<0)<0
			";
			$x->setQuery("*","from contrato_servicio_deuda","","");
			$x->consultas($sql);
			$x->printTable();
			break;
		
		case clientes_sin_cargo_suscrito:
			$sql="select nro_contrato,cedula,nombre, apellido, (select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato.id_contrato and costo_cobro<0) as saldo

 from vista_contrato where 
(select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato.id_contrato and costo_cobro<0)<0
			";
			$x->setQuery("*","from vista_contrato","","");
			$x->consultas($sql);
			$x->printTable();
			break;
		
		case clientes_con_doble_reconexion:
			$sql="select nro_contrato from contrato where status_contrato='ACTIVO' AND 
(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato  and id_serv='SER00002') > 1
			";
			$x->setQuery("*","from contrato_servicio_deuda","","");
			$x->consultas($sql);
			$x->printTable();
			break;
		
		case clientes_activos_sin_suscripcion_activa:
			$sql="select nro_contrato from contrato where status_contrato='ACTIVO' AND 
(select count(*) from contrato_servicio, servicios where contrato_servicio.id_serv = servicios.id_serv and contrato_servicio.id_contrato=contrato.id_contrato  and tipo_costo='COSTO MENSUAL' and tipo_paq='PAQUETE BASICO' and status_con_ser='CONTRATO') =0
			";
			$x->setQuery("*","from contrato_servicio","","");
			$x->consultas($sql);
			$x->printTable();
			break;
		
		case clientes_sin_suscripcion_mensual:
			$sql="select nro_contrato from contrato where status_contrato='ACTIVO' AND 
(select count(*) from contrato_servicio, servicios where contrato_servicio.id_serv = servicios.id_serv and contrato_servicio.id_contrato=contrato.id_contrato  and tipo_costo='COSTO MENSUAL') =0
			";
			$x->setQuery("*","from contrato_servicio","","");
			$x->consultas($sql);
			$x->printTable();
			break;
		
		case clientes_por_generar_deuda:
			$sql="select nombre_franq,nombre_servicio,id_franq,servicios.id_serv, sum(cant_serv) as cantidad , sum(cant_serv*costo_cobro)as monto, (sum(cant_serv*costo_cobro)/sum(cant_serv)) AS TARIFA  from contrato_servicio,servicios,vista_contrato_auditoria where contrato_servicio.id_contrato=vista_contrato_auditoria.id_contrato and contrato_servicio.id_serv=servicios.id_serv and tipo_costo='COSTO MENSUAL' and status_con_ser='CONTRATO' and (status_contrato='ACTIVO' or status_contrato='POR SUSPENDER' or status_contrato='POR CORTAR') group by nombre_franq,nombre_servicio,id_franq,servicios.id_serv
			";
			$x->setQuery("*","from contrato_servicio","","");
			$x->consultas($sql);
			$x->printTable();
			break;
		
		case clientes_con_deuda_por_pagar:
			$fecha=restames(date("Y-m-01"));
			
			$sql="
select nombre_franq,   count((select count(*) from  contrato_servicio_deuda  where vista_contrato_auditoria.id_contrato= contrato_servicio_deuda.id_contrato and  fecha_inst='$fecha'  group by  contrato_servicio_deuda.id_contrato )) as cant_deuda,  sum((select sum(cant_serv*costo_cobro) from  contrato_servicio_deuda  where vista_contrato_auditoria.id_contrato= contrato_servicio_deuda.id_contrato and  fecha_inst='$fecha') ) as deuda,   count((select count(*) from  contrato_servicio_pagado where vista_contrato_auditoria.id_contrato= contrato_servicio_pagado.id_contrato and  fecha_inst='$fecha'  group by  contrato_servicio_pagado.id_contrato) ) as cant_pagado,  sum((select sum(cant_serv*costo_cobro) from  contrato_servicio_pagado where vista_contrato_auditoria.id_contrato= contrato_servicio_pagado.id_contrato and  fecha_inst='$fecha') ) as pagado    from vista_contrato_auditoria where status_contrato='ACTIVO' or status_contrato='POR SUSPENDER' or status_contrato='POR CORTAR' group by nombre_franq
			";
			$x->setQuery("*","from  contrato_servicio_deuda","","");
			$x->consultas($sql);
			$x->printTable();
			break;
		
		case deuda_mayor_a_tarifa_mensual:
			$dato=lectura($acceso,"select id_serv from servicios where tipo_costo='COSTO MENSUAL'");
					for($i=0;$i<count($dato);$i++){
						$id_serv=trim($dato[$i]['id_serv']);
						$acceso->objeto->ejecutarSql("select tarifa_ser from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'  LIMIT 1 offset 0 "); 
						$row=row($acceso);
						$tarifa_ser=trim($row['tarifa_ser']);
						$tarifa[trim($dato[$i]['id_serv'])]=$tarifa_ser;
					}
					
					echo '
		<table>
		<tr id="fijo">
		<td>CONTRATO</td>
		<td>SERVICIO</td>
		<td>TARIFA</td>
		<td>DEUDA</td></tr>';
					
					$fecha_inst='2014-03-01';
					
					$dato=lectura($acceso,"select id_serv,nombre_servicio from servicios where tipo_costo='COSTO MENSUAL' and tarifa_esp<>'TRUE'");
					for($i=0;$i<count($dato);$i++){
						$id_serv=trim($dato[$i]['id_serv']);
						$nombre_servicio=trim($dato[$i]['nombre_servicio']);
						$tarifa_ser=$tarifa[$id_serv];
						$acceso->objeto->ejecutarSql("select nro_contrato,
						(select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst='$fecha_inst' and id_serv='$id_serv') as deuda
						from contrato where status_contrato='ACTIVO' AND 
(select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and fecha_inst='$fecha_inst' and id_serv='$id_serv') > $tarifa_ser"); 
						while($row=row($acceso)){
							$nro_contrato = trim($row['nro_contrato']);
							$deuda = trim($row['deuda']);
							echo "
							<tr >
								<td>$nro_contrato</td>
								<td>$nombre_servicio</td>
								<td>$tarifa_ser</td>
								<td>$deuda</td>
							</tr>";
						}
					}
					
		echo '</table>
		';
		
		
			break;
			
			
			
		default:
			echo titulo("El contenido de ".$tipo." no esta Construdio Disculpe las molestias");
	}
}

?>
