<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$deuda = $_GET['deuda'];
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$status_contrato = $_GET['status_contrato'];
if($status_contrato!=''){
	$status="contrato.status_contrato='$status_contrato' and ";
	$statusw=" where contrato.status_contrato='$status_contrato' ";
}

$deuda="(SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro)            FROM contrato_servicio_deuda,contrato,zona,calle,sector          WHERE $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and           contrato_servicio_deuda.id_contrato = contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar and sector.id_zona=zona.id_zona and sector.id_sector=vista_sector.id_sector   and fecha_inst between '$desde' and '$hasta') AS deuda";
$pagado="(SELECT sum(contrato_servicio_pagado.cant_serv::numeric * contrato_servicio_pagado.costo_cobro)            FROM contrato_servicio_pagado,contrato,zona,calle,sector          WHERE $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and           contrato_servicio_pagado.id_contrato = contrato.id_contrato AND contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar and sector.id_zona=zona.id_zona and  sector.id_sector=vista_sector.id_sector   and fecha_inst between '$desde' and '$hasta') AS pagado";
$num_pagado="(SELECT count(contrato_servicio_pagado.id_contrato)            FROM contrato_servicio_pagado,contrato,zona,calle,sector          WHERE $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and           contrato_servicio_pagado.id_contrato = contrato.id_contrato AND contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar and sector.id_zona=zona.id_zona and  sector.id_sector=vista_sector.id_sector   and fecha_inst between '$desde' and '$hasta') AS num_pagado";

		  $num_deuda="(select count(*) from contrato,zona,calle,sector where $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and  sector.id_zona=zona.id_zona and  sector.id_sector=vista_sector.id_sector and (SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) as deuda            FROM contrato_servicio_deuda          WHERE contrato_servicio_deuda.id_contrato = contrato.id_contrato and fecha_inst between '$desde' and '$hasta' )  > 0 ) as num_deuda";
$t_cli="(SELECT count(*)            FROM contrato,zona,calle,sector          WHERE $status calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and           sector.id_zona=zona.id_zona and  sector.id_sector=vista_sector.id_sector ) as t_cli";

//echo $deuda;

/*
$deuda="(select sum(deuda) from vista_deudacli where vista_deudacli.id_sector=vista_sector.id_sector) as deuda";
$pagado="(select sum(pagado) from vista_deudacli where vista_deudacli.id_sector=vista_sector.id_sector) as pagado";
$num_deuda="(select count(*) from vista_deudacli where vista_deudacli.id_sector=vista_sector.id_sector and deuda>0) as num_deuda";
$t_cli="(select count(*) from vista_deudacli where vista_deudacli.id_sector=vista_sector.id_sector) as t_cli";
*/


$where="select nro_sector,nombre_sector,nombre_zona,$t_cli,$deuda,$num_deuda,$pagado,$num_pagado from vista_sector";


$x->setQuery("*","from vista_sector","","");


//echo $where;
$x->consultas($where);

$x->setQuery("nro_sector,nombre_sector,nombre_zona","vista_sector","","");
$x->setColumnHeader("nro_sector", _("nro sector"));
$x->setColumnHeader("nombre_sector", _("nombre sector"));
$x->setColumnHeader("nombre_zona", _("nombre zona"));

$x->setColumnHeader("deuda", _("deuda"));
$x->setColumnHeader("pagado", _("pagado"));
$x->setColumnHeader("t_cli", _("total clientes"));
$x->setColumnHeader("num_deuda", _("cli con deuda"));
$x->setColumnHeader("num_pagado", _("cli con pago"));

$x->setColumnType('deuda', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('pagado', EyeDataGrid::TYPE_MONTO, '',true);

//$x->hideOrder();
$x->allowFilters();
$x->showRowNumber();

//mostrar resultados por pagina
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

$x->printTable();



$acceso->objeto->ejecutarSql("SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro)   as deuda         FROM contrato_servicio_deuda     WHERE  contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar and fecha_inst between '$desde' and '$hasta'");
	if($row=row($acceso)){
		$deuda=trim($row["deuda"]);
	}
	

$acceso->objeto->ejecutarSql("SELECT sum(contrato_servicio_pagado.cant_serv::numeric * contrato_servicio_pagado.costo_cobro) as pagado           FROM contrato_servicio_pagado ,contrato         WHERE  contrato_servicio_pagado.id_contrato=contrato.id_contrato  and contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar  and fecha_inst between '$desde' and '$hasta'");
	if($row=row($acceso)){
		$pagado=trim($row["pagado"]);
	}
		  
		  
	$acceso->objeto->ejecutarSql("select count(*) as num_deuda from contrato where $status (SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) as deuda FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = contrato.id_contrato and $status  fecha_inst between '$desde' and '$hasta' )  > 0 ");
	if($row=row($acceso)){
		$num_deuda=trim($row["num_deuda"]);
	}
	

$acceso->objeto->ejecutarSql("SELECT count(*)  AS t_cli     FROM contrato $statusw ");
	if($row=row($acceso)){
		$t_cli=trim($row["t_cli"]);
	}
//echo "contrato_servicio_pagado.cant_serv::numeric * contrato_servicio_pagado.costo_cobro) as pagado           FROM contrato_servicio_pagado          WHERE  contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar  and fecha_inst between '$desde' and '$hasta'";	

echo '<div align="right" class="fuenteN">'. _('total deuda').': '.number_format($deuda,2,",",".").'</div>';
echo '<div align="right" class="fuenteN">'. _('total pagado').': '.number_format($pagado,2,",",".").'</div>';

echo '<div align="right" class="fuenteN">'. _('total cliente').': '.$t_cli.'</div>';
echo '<div align="right" class="fuenteN">'. _('total pagado').': '.$num_deuda.'</div>';


?>
