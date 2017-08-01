<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

/*

select id_franq,nombre_franq,

--(select sum(deuda) from vista_deudacli,zona where vista_deudacli.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq) as deuda

(SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) 
           FROM contrato_servicio_deuda,contrato,zona,calle,sector
          WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          contrato_servicio_deuda.id_contrato = contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar and sector.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq ) AS deuda,

--(select sum(pagado) from vista_deudacli,zona where vista_deudacli.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq) as pagado

(SELECT sum(contrato_servicio_pagado.cant_serv::numeric * contrato_servicio_pagado.costo_cobro) 
           FROM contrato_servicio_pagado,contrato,zona,calle,sector
          WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          contrato_servicio_pagado.id_contrato = contrato.id_contrato AND contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar and sector.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq ) AS pagado,

          

--(select count(*) from vista_deudacli,zona where vista_deudacli.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq) as t_cli

(SELECT count(*) 
           FROM contrato,zona,calle,sector
          WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          sector.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq ) as t_cli,


--(select count(*) from vista_deudacli,zona where vista_deudacli.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq and deuda>0) as num_deuda 

(select count(*) from contrato,zona,calle,sector where calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and  sector.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq and 
(SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) as deuda 
           FROM contrato_servicio_deuda
          WHERE contrato_servicio_deuda.id_contrato = contrato.id_contrato )  > 0 ) as num_deuda

          

from franquicia

*/

/*

--SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) AS sum FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar
--SELECT sum(contrato_servicio_pagado.cant_serv::numeric * contrato_servicio_pagado.costo_cobro) AS sum FROM contrato_servicio_pagado WHERE contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar
--select count(DISTINCT id_contrato) FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar
select count(DISTINCT id_contrato where sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro)>0)) FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar

*/
/*
$deuda="(select sum(deuda) from vista_deudacli,zona where vista_deudacli.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq) as deuda";
$pagado="(select sum(pagado) from vista_deudacli,zona where vista_deudacli.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq) as pagado";
$num_deuda="(select count(*) from vista_deudacli,zona where vista_deudacli.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq and deuda>0) as num_deuda";
$t_cli="(select count(*) from vista_deudacli,zona where vista_deudacli.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq) as t_cli";
*/

$deuda="(SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) 
           FROM contrato_servicio_deuda,contrato,zona,calle,sector
          WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          contrato_servicio_deuda.id_contrato = contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar and sector.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq ) AS deuda";
$pagado="(SELECT sum(contrato_servicio_pagado.cant_serv::numeric * contrato_servicio_pagado.costo_cobro) 
           FROM contrato_servicio_pagado,contrato,zona,calle,sector
          WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          contrato_servicio_pagado.id_contrato = contrato.id_contrato AND contrato_servicio_pagado.status_con_ser = 'PAGADO'::bpchar and sector.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq ) AS pagado";
$num_deuda="(select count(*) from contrato,zona,calle,sector where calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and  sector.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq and 
(SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) as deuda 
           FROM contrato_servicio_deuda
          WHERE contrato_servicio_deuda.id_contrato = contrato.id_contrato )  > 0 ) as num_deuda";
$t_cli="(SELECT count(*) 
           FROM contrato,zona,calle,sector
          WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector and 
          sector.id_zona=zona.id_zona and zona.id_franq=franquicia.id_franq ) as t_cli";



$where="select id_franq,nombre_franq,$deuda,$pagado,$t_cli,$num_deuda from franquicia";
//echo ":$where:<br>";

$x->setQuery("*","from franquicia","","");

$x->consultas($where);

$x->setQuery("id_franq,nombre_franq","vista_zona","","");
$x->setColumnHeader("id_franq", _("nro franquicia"));
$x->setColumnHeader("nombre_franq", _("nombre franquicia"));
$x->setColumnHeader("deuda", _("deuda"));
$x->setColumnHeader("pagado", _("pagado"));
$x->setColumnHeader("t_cli", _("Total Clientes"));
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
