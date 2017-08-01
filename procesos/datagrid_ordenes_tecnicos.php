<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" AND id_franq='$id_f'";
	}

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_orden,nro_contrato,nombrecli,apellidocli,nombre_tipo_orden,nombre_det_orden,fecha_orden,prioridad,nombre_zona","vista_orden","","status_orden='CREADO' $consult");
$x->hideColumn('nombre_zona');
$x->hideColumn('nombre_det_orden');
$x->hideColumn('fecha_orden');
$x->hideColumn('prioridad');
$x->setColumnHeader("id_orden", _("Nº Orden"));
$x->setColumnHeader("nro_contrato", _("Nº Cont."));
$x->setColumnHeader("nombrecli", _("Nombre"));
$x->setColumnHeader("apellidocli", _("Apellido"));
$x->setColumnHeader("nombre", _("Técnico"));
$x->setColumnHeader("nombre_tipo_orden", _("Tipo de Orden"));
$x->setColumnHeader("nombre_det_orden", _("Detalle de Orden"));
$x->setColumnHeader("fecha_orden", _("Fecha de la Orden"));
$x->setColumnHeader('prioridad', _("Prioridad"));

$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimirOrdenTec('%id_orden%');");
//$x->addStandardControl(EyeDataGrid::STDCTRL_SAVE, "guardarOrdenTec('%id_orden%');");

$x->setColumnType('fecha_orden', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
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
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_ordenes_tecnicos('%id_orden%');window.location.replace('#');");

//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarordenes_tecnicos('%id_orden%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarordenes_tecnicos('%id_orden%')");
*/
$x->printTable();
?>
