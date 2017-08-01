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
	$where=$where.",(select count(*) from contrato,calle,contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and contrato.id_calle=calle.id_calle and  contrato.id_contrato=contrato_servicio_deuda.id_contrato and contrato.status_contrato='ACTIVO'
	and
	 (tipo_paq='PAQUETE BASICO') 
	 and fecha_inst='$fecha' and sector.id_sector=calle.id_sector and costo_cobro>0 ) as $mes_letra ";
	$fecha=sumames($fecha);
}


$where=$where.",id_sector from sector  limit 2";
$fechaSig=date("Y-m-01"); 



$x->setQuery("*","from contrato","","");

//echo $where;
$x->consultas($where);

$x->setColumnHeader("nombre_sector", _("nombre sector"));

$x->allowFilters();
$x->showRowNumber();
		   $x->setResultsPerPage(1000);
$x->printTable();


?>
