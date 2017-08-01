<?php
session_start();
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	$id_f = $_SESSION["id_franq"]; 	
	if($id_f!='0'){
		$consult=" and franquicia.id_franq='$id_f'";
	}

$x->setQuery("id_tc,nombre_franq,nombre_grupo,fecha_tc as fecha,
(SELECT count(*) as cant FROM  orden_tabla_cortes,ordenes_tecnicos where orden_tabla_cortes.id_orden=ordenes_tecnicos.id_orden  AND status_orden='IMPRESO'  and id_tc=tabla_cortes.id_tc) as impresa ,
(SELECT count(*) as cant FROM  orden_tabla_cortes,ordenes_tecnicos where orden_tabla_cortes.id_orden=ordenes_tecnicos.id_orden  AND status_orden='CANCELADA'  and id_tc=tabla_cortes.id_tc) as cancelada ,
(SELECT count(*) as cant FROM  orden_tabla_cortes,ordenes_tecnicos where orden_tabla_cortes.id_orden=ordenes_tecnicos.id_orden  AND status_orden='FINALIZADO'  and id_tc=tabla_cortes.id_tc) as finalizado 
","tabla_cortes,grupo_trabajo,franquicia","id_tc","tabla_cortes.id_gt=grupo_trabajo.id_gt and tabla_cortes.id_franq=franquicia.id_franq $consult");
$x->hideColumn('id_tc');

$x->setColumnHeader('nombre_grupo', _("Grupo de Trabajo"));
$x->setColumnHeader('nombre_franq', _("Franquicia"));

$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimir_listado_corte('%id_tc%');");

$x->setColumnType('fecha_tc', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);

//para permitir filtros
$x->allowFilters();


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
