<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
/*
$deuda="(select sum(deuda) from vista_deudacli where vista_deudacli.id_zona=vista_zona.id_zona) as deuda";
$pagado="(select sum(pagado) from vista_deudacli where vista_deudacli.id_zona=vista_zona.id_zona) as pagado";
$num_deuda="(select count(*) from vista_deudacli where vista_deudacli.id_zona=vista_zona.id_zona and deuda>0) as num_deuda";
$t_cli="(select count(*) from vista_deudacli where vista_deudacli.id_zona=vista_zona.id_zona) as t_cli";
*/
$deuda="(SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) 
           FROM contrato_servicio_deuda,contrato,zona,calle,sector
          WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          contrato_servicio_deuda.id_contrato = contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar 
		  and sector.id_zona=zona.id_zona and zona.id_zona=vista_zona.id_zona ) AS deuda";
		$pagado="(SELECT sum(contrato_servicio_pagado.cant_serv::numeric * contrato_servicio_pagado.costo_cobro) 
		           FROM contrato_servicio_pagado,contrato,zona,calle,sector
		          WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
		          contrato_servicio_pagado.id_contrato = contrato.id_contrato AND contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar and sector.id_zona=zona.id_zona and zona.id_zona=vista_zona.id_zona ) AS pagado";
		$num_deuda="(select count(*) from contrato,zona,calle,sector where calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and  sector.id_zona=zona.id_zona and zona.id_zona=vista_zona.id_zona and 
				(SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) as deuda 
		           FROM contrato_servicio_deuda
		          WHERE contrato_servicio_deuda.id_contrato = contrato.id_contrato )  > 0 ) as num_deuda";
		$t_cli="(SELECT count(*) 
		           FROM contrato,zona,calle,sector
		          WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
		          sector.id_zona=zona.id_zona and zona.id_zona=vista_zona.id_zona ) as t_cli";
				  

$where="
select nro_zona,nombre_zona,nombre_franq,$deuda,$pagado,$t_cli,$num_deuda from vista_zona
";
//echo $where;
$x->setQuery("*","from vista_zona","","");

$x->consultas($where);

$x->setQuery("nro_zona,nombre_zona,nombre_franq","vista_zona","","");
$x->setColumnHeader("nro_zona", _("nro zona"));
$x->setColumnHeader("nombre_zona", _("nombre zona"));
$x->setColumnHeader("nombre_franq", _("franquicia"));
$x->setColumnHeader("deuda", _("deuda"));
$x->setColumnHeader("pagado", _("pagado"));
$x->setColumnHeader("t_cli", _("total clientes"));
$x->setColumnHeader("num_deuda", _("con deuda"));


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
?>
