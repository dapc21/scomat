<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
$where="select nombre_sector ";
$fecha=date("Y-m-01");

$fecha=restames($fecha);
$fecha=restames($fecha);
$fecha=restames($fecha);
$fecha=restames($fecha);

for($i=0;$i<5;$i++){
	$fec = explode ( "-", $fecha );
	$mes=$fec[1];
	$mes_letra=formato_mes($mes);
	$where=$where.",(select count(*) from contrato,contrato_servicio_deuda where contrato.id_contrato=contrato_servicio_deuda.id_contrato fecha_inst='$fecha'  and costo_cobro>0 limit 10 and contrato.cod_id_persona=cobrador.id_persona) as $mes_letra ";
	$fecha=sumames($fecha);
}


$where=$where.",id_sector from cobrador";
$fechaSig=date("Y-m-01"); 

$x->setQuery("*","cobrador","","");


//echo $where;
$x->setQuery("*","from cobrador","","");

$x->consultas($where);

$x->setColumnHeader("nombre_sector", _("nombre sector"));

$x->allowFilters();
$x->showRowNumber();
		   $x->setResultsPerPage(1000);
$x->printTable();


?>
