<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$tipo = $_GET['tipo'];
$nro_recibo = $_GET['nro_recibo'];

$gen_fec = $_GET['gen_fec'];
$id_cobrador = $_GET['id_cobrador'];
$login = $_GET['login'];
$status_pago = $_GET['status_pago'];
$idmotivonota = $_GET['idmotivonota'];
$dir_ip = $_GET['dir_ip'];

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];




$where= "SELECT nro_recibo ,(nombre || ' ' || apellido) as cobrador,fecha_asig, (select fecha_rec from recibe_recibo where vista_recibos.id_rec=recibe_recibo.id_rec ) as fecha_rec,status_pago,login_asig,tipo,obser as observacion FROM vista_recibos where (id_asig ILIKE '%0%') ";
  
	if($gen_fec!='GENERAL'){
			$where=$where. " and fecha_asig between '$desde' and '$hasta'";
	}
	if($id_cobrador!=''){
			$where=$where. " and (id_cobrador ILIKE '%$id_cobrador%')";
	}
	if($login!=''){
			$where=$where. " and (login_asig ILIKE '%$login%')";
	}
	if($status_pago!=''){
			$where=$where. " and (status_pago ILIKE '%$status_pago%')";
	}
	if($nro_recibo!=''){
			$where=$where. " and (nro_recibo ILIKE '%$nro_recibo%')";
	}
	if($tipo!=''){
			$where=$where. " and (tipo ILIKE '%$tipo%')";
	}
	
//	echo $where;

	
//,cedula,nombre,apellido,nombre_zona,nombre_sector,nombre_calle
$x->setQuery("id_nota,nro_contrato,login,generado_por,tipo,dir_ip,fecha,hora,monto_anterior,monto_posterior,nombremotivonota,comentario","FROM vista_recibos","","");
	$x->consultas($where);


$x->setColumnHeader('nro_recibo', 'Nro Factura');
$x->setColumnHeader('cobrador', 'Cobrador');
$x->setColumnHeader('fecha_asig', 'Fecha Asig');
$x->setColumnHeader('fecha_rec', 'Fecha Rec');
$x->setColumnHeader('desde', 'Fact. Desde');
$x->setColumnHeader('hasta', 'Hasta');
$x->setColumnHeader('cantidad', 'Cantidad');
$x->setColumnHeader('obser_asig', 'Observacion');
$x->setColumnHeader('status_pago', 'Status Fact.');
$x->setColumnHeader('login_asig', 'Asignado por');


$x->setColumnType('fecha_asig', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_rec', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

//$x->hideOrder();
//$x->allowFilters();
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
