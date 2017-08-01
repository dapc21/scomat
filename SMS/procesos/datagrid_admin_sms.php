<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

					$tipo_sms=$_GET['tipo_sms'];
					$desde=$_GET['desde'];
					$hasta=$_GET['hasta'];
					$sql=" id_sms<>'0' ";
					if($tipo_sms=='SIN LEER'){
						$sql=$sql." and tipo_sms='DELIVER' and status_sms='UNREAD'";
					}
					else if($tipo_sms=='LEIDOS'){
						$sql=$sql." and tipo_sms='DELIVER' and status_sms='READ'";
					}
					else if($tipo_sms=='RECIBIDOS'){
						$sql=$sql." and tipo_sms='DELIVER'";
					}
					else if($tipo_sms=='ENVIADOS'){
						$sql=$sql." and tipo_sms='SUBMIT' and status_sms='SENT'";
					}
					if($desde!='' && $hasta!=''){
						$desde=formatfecha($_GET['desde']);
						$hasta=formatfecha($_GET['hasta']);
						$sql=$sql." and fecha_sms between '$desde' and '$hasta' ";
					}

						
$x->setQuery("id_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms", "sms","id_sms","$sql");
$x->hideColumn('id_sms');
$x->setColumnHeader('fecha_sms', _("fecha"));
$x->setColumnHeader('mensaje_sms', _("mensaje"));
$x->setColumnHeader('telefono_sms', _("telefono"));
$x->setColumnHeader('hora_sms', _("hora"));


$x->setColumnType('fecha_sms', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros
//$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminar_sms_enviar('%id_sms%')");
$x->allowFilters();
//para ir contanfo las filas
$x->showCheckboxes();

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
