<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);


	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and franquicia.id_franq='$id_f'";
	}

	
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_caja,nombre_caja,descripcion_caja,status_caja,franquicia.nombre_franq, caja_externa AS tipo_caja", "caja,franquicia","id_caja","caja.id_franq=franquicia.id_franq $consult");
$x->hideColumn('id_caja');
$x->setColumnHeader('id_caja', _("Nº de Caja"));
$x->setColumnHeader('nombre_caja', _("Caja"));
$x->setColumnHeader('descripcion_caja',_("Descripcion"));
$x->setColumnHeader('status_caja',_("Estatus"));
$x->setColumnHeader('nombre_franq',_("Franquicia"));
$x->setColumnHeader('tipo_caja',_("Tipo"));

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas

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
		if(trim($row["valor_param"])>0){
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}


$x->addRowSelect("buscar_id_caja('%id_caja%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarcaja('%pago_comisiones%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcaja('%pago_comisiones%')");
*/
$x->printTable();

$yx = new EyeDataGrid($db);
	
if($modo!='EXCEL'){
ECHO "<header class='panel-heading'>Datos de las Puntos de Cobro Abiertos</header>";
}

$yx->setQuery("id_caja_cob,id_caja,nombre_caja,apellido,nombre_est,monto_acum,nombre,fecha_caja,apertura_caja,cierre_caja,
(select (sum(pagos.monto_pago)-sum(pagos.desc_pago))  from pagos where pagos.id_caja_cob=vista_caja.id_caja_cob and status_pago='PAGADO') as total
","vista_caja","","status_caja_cob='ABIERTA' ");
$yx->hideColumn('id_caja_cob');
$yx->hideColumn('apellido');
$yx->setColumnHeader("id_caja", _("Nº de Caja"));
$yx->setColumnHeader("nombre_caja", _("Punto de Cobro"));
$yx->setColumnHeader("nombre_est", _("Estacion"));
$yx->setColumnHeader("monto_acum", _("Monto"));
$yx->setColumnHeader("nombre", _("Cobrador"));
$yx->setColumnHeader("fecha_caja", _("Fecha"));
$yx->setColumnHeader("apertura_caja", _("Hora de Apertura"));
$yx->setColumnHeader("cierre_caja", _("Hora de Cierre"));

$yx->setColumnType('fecha_caja', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$yx->setClase("CierreDiario");
//$yx->addRowSelect("ImprimirRep_detcob('%id_caja_cob%')");
//$yx->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "ImprimirRep_detcob('%id_caja_cob%')");
$yx->addStandardControl(EyeDataGrid::STDCTRL_SAVE, "GuardarRep_detcob('%id_caja_cob%')");
$yx->hideOrder();
//$yx->showRowNumber();

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $yx->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $yx->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$yx->printTable();				




?>
