<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

$id_contrato = $_GET['id_contrato'];

//,cedula,nombre,apellido,nombre_zona,nombre_sector,nombre_calle
$x->setQuery("id_nota,tipo,fecha,monto_anterior,monto_nota, monto_posterior,servicio,fecha_inst,nombremotivonota,status,login,login_aut","vista_notas","","id_contrato='$id_contrato'");
$x->hideColumn('id_nota');
//$x->hideColumn('status');
$x->hideColumn('login_aut');
$x->setColumnHeader("nro_contrato", "Contrato");
$x->setColumnHeader("comentario",_("Detalle"));
$x->setColumnHeader("nombremotivonota",_("Motivo"));
$x->setColumnHeader("monto_posterior",_("Monto Pos."));
$x->setColumnHeader("monto_anterior",_("Monto Ant."));
$x->setColumnHeader("monto_nota",_("Monto D/C"));
$x->setColumnHeader("hora,",_("Hora"));
$x->setColumnHeader("fecha",_("Fecha D/C"));
$x->setColumnHeader("dir_ip",_("IP Equipo"));
$x->setColumnHeader("tipo",_("Tipo"));
$x->setColumnHeader("generado_por",_("Generado Por"));
$x->setColumnHeader("login",_("Solicitado Por"));
$x->setColumnHeader("login_aut",_("Autorizado Por"));
$x->setColumnHeader("status",_("Estatus"));
$x->setColumnHeader("fecha_inst",_("Fecha Servicio"));


$x->setColumnType('monto_anterior', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_posterior', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_nota', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('fecha', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setClase("Rep_totalclientes");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "reimp_nota_credito('%id_nota%');");

//$x->hideOrder();
//$x->allowFilters();
//$x->showRowNumber();

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
	
if($modo!='EXCEL'){
echo '
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section id="tabla-exoneracion">
	 ';
}
	$x->printTable();
		
if($modo!='EXCEL'){
echo '
		</section>
	</div>
</div>';
}
?>
