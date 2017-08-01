<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$deuda="(select sum(deuda) from vista_deudacli where vista_deudacli.id_calle=vista_calle.id_calle) as deuda";
$pagado="(select sum(pagado) from vista_deudacli where vista_deudacli.id_calle=vista_calle.id_calle) as pagado";
$num_deuda="(select count(*) from vista_deudacli where vista_deudacli.id_calle=vista_calle.id_calle and deuda>0) as num_deuda";
$t_cli="(select count(*) from vista_deudacli where vista_deudacli.id_calle=vista_calle.id_calle) as t_cli";

$where="
select nro_calle,nombre_calle,nombre_sector,nombre_zona,$deuda,$pagado,$t_cli,$num_deuda from vista_calle
";

$x->setQuery("*","from vista_calle","","");

$x->consultas($where);



$x->setColumnHeader("nro_calle", _("nro calle"));
$x->setColumnHeader("nombre_calle", _("nombre calle"));
$x->setColumnHeader("nombre_sector", _("nombre sector"));
$x->setColumnHeader("nombre_zona", _("nombre zona"));

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
