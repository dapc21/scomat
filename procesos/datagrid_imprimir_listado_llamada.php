<?php
session_start();
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();

	$id_f = $_SESSION["id_franq"];
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	$perfil=$_SESSION["perfil"];
	$login=$_SESSION["login"];
	
	if($perfil!='PERF001'){
		$sql= " and personausuario.login='$login' ";
	}
$x->setQuery("id_all,fecha_all,login_enc,(nombre || ' ' || apellido) as responsable,ubica_all,
(SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='REGISTRADO') as por_llamar,
(SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='LLAMADO') as llamadas,
(SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all ) as total 
,obser_all
","asigna_llamada,personausuario","id_all","asigna_llamada.login_resp=personausuario.login AND status_all='registrado' $consult $sql");
$x->hideColumn('id_all');
$x->setColumnHeader("ubica_all", _("Ubicacion"));
$x->setColumnHeader('fecha_all', _("Fecha"));
$x->setColumnHeader('login_enc', _("Asignado por"));
$x->setColumnHeader('obser_all', _("Observacion"));
$x->setColumnHeader('nombre_franq', _("Franquicia"));

$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "ver_det_listado_llamada('%id_all%');");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimir_listado_llamada('%id_all%');");

$x->setColumnType('fecha_all', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);

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
