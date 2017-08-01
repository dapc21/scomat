<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];
$sd = trim($_GET['sd']);

$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];

if($id_franq!='' || $id_zona!='' || $id_sector!='' || $id_calle!=''){
	$sql=" 
	SELECT id_contrato,direc_adicional,nro_contrato,id_franq,apellido,nombre,status_contrato,
	( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro)FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$desde' and '$hasta') AS deuda
	,nombre_calle,nombre_sector,nombre_zona
   
   FROM vista_contrato
  WHERE vista_contrato.status_contrato = 'ACTIVO'::bpchar and 
  ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$desde' and '$hasta')>0
   and 
  ";
	$where=  $sql;
		//$where= "SELECT id_contrato,nro_contrato,id_franq,apellido,nombre,status_contrato,id_persona,nombre_calle,nombre_sector,nombre_zona,nombre_franq FROM vista_contrato where status_contrato='ACTIVO' and ";
	$tipo='';
	if($id_franq!=''){
		$where=$where. "(id_franq = '$id_franq')";
		$tipo='id_franq';
	}
	else if($id_zona!=''){
		$where=$where. "(id_zona ILIKE '%$id_zona%')";
		$tipo='id_zona';
	}
	else if($id_sector!=''){
		$where=$where. "(id_sector ILIKE '%$id_sector%')";
		$tipo='id_sector';
	}
	else if($id_calle!=''){
		$where=$where. "(id_calle ILIKE '%$id_calle%')";
		$tipo='id_calle';
	}
	
	if($tipo=='id_franq'){
		if($id_zona!=''){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
		}
		if($id_sector!=''){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		
	}
	else if($tipo=='id_zona'){
		if($id_sector!=''){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		
	}
	else if($tipo=='id_sector'){
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		
	}
	//echo $where;
	//$x->consultas($where);
	
	
	$acceso->objeto->ejecutarSql("select id_persona from vista_orden order By id_orden desc  LIMIT 1 offset 0");
		if($row=row($acceso))
		{
			$tecnico=trim($row["id_persona"]);
		}
		else{
			$acceso->objeto->ejecutarSql("select *from vista_tecnico  LIMIT 1 offset 0");
			if($row=row($acceso))
			{
				$tecnico=trim($row["id_persona"]);
			}
		}
		
		
	//echo "true";
}
	

?>
