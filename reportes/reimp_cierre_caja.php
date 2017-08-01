<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_persona=$_GET['id_persona'];
if($id_persona!='0' && $id_persona!=''){
		$id_persona_b=" id_persona='$id_persona' and ";
	}
$fecha=$_GET['desde'];
$id_f=$_GET['id_f'];
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
$fecha=formatfecha($fecha);
//echo "select id_caja_cob,nombre_caja,apellido,monto_acum,nombre,fecha_caja,apertura_caja,cierre_caja from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='CERRADA'";
$x->setQuery("id_caja_cob,nombre_caja,apellido,monto_acum,nombre,fecha_caja,apertura_caja,cierre_caja","vista_caja","","$id_persona_b fecha_caja='$fecha' and status_caja_cob='CERRADA' $consult");
$x->hideColumn('id_caja_cob');
$x->hideColumn('apellido');
$x->setColumnHeader("nombre_caja", _("Punto de Cobro"));
$x->setColumnHeader("monto_acum", _("Monto"));
$x->setColumnHeader("nombre", _("Cobrador"));
$x->setColumnHeader("fecha_caja", _("Fecha"));
$x->setColumnHeader("apertura_caja", _("Hora Apertura"));
$x->setColumnHeader("cierre_caja", _("Hora Cierre"));

$x->setClase("CierreDiario");
$x->setColumnType('fecha_caja', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//$x->addRowSelect("ImprimirRep_detcob('%id_caja_cob%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "ReImprimirRep_detcob('%id_caja_cob%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "ImprimirRep_detcob('%id_caja_cob%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "GuardarRep_detcob('%id_caja_cob%')");
$x->hideOrder();
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
<section class="panel">
		<header class="panel-heading">Datos de las Estaciones de Trabajo</header>
		<div class="panel-body">
			<div id="datagrid" class="data"></div>	
		</div> <!-- FIN DEL PANEL --> 

</section>
<?php


$x_est = new EyeDataGrid($db);

$x_est->setQuery("id_cierre,nombre_est,reporte_z,fecha_cierre,hora_cierre,monto_total","estacion_trabajo,cirre_diario_et",""," estacion_trabajo.id_est=cirre_diario_et.id_est and fecha_cierre='$fecha' $consult ");
$x_est->hideColumn('id_cierre');
$x_est->hideColumn('apellido');
$x_est->setColumnHeader("nombre_est", _("Estación de Trabajo"));
$x_est->setColumnHeader("reporte_z", _("Reporte Z"));
$x_est->setColumnHeader("hora_cierre", _("Hora"));
$x_est->setColumnHeader("fecha_cierre", _("Fecha"));
$x_est->setColumnHeader("apertura_caja", _("Hora Apertura"));
$x_est->setColumnHeader("cierre_caja", _("Hora Cierre"));
$x_est->setColumnHeader("monto_total", _("TOTAL"));

$x_est->setColumnType('fecha_caja', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x_est->setClase("CierreDiario");
//$x_est->addRowSelect("ImprimirRep_detcob('%id_caja_cob%')");
//$x_est->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "ImprimirRep_detcob('%id_caja_cob%')");
$x_est->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "ImprimirRep_CierreEquipo('%id_cierre%')");
$x_est->hideOrder();
$x_est->showRowNumber();

$x_est->setResultsPerPage(10);	

$x_est->printTable();				

?>