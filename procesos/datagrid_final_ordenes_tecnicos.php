<?php session_start();
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

	
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	

$desde=$_GET['desde'];
$hasta=$_GET['hasta'];
$id_gt=$_GET['id_gt'];
$id_franq=$_GET['id_franq'];
$id_tipo_orden=$_GET['id_tipo_orden'];
$id_det_orden=$_GET['id_det_orden'];
$prioridad=$_GET['prioridad'];
$sql="status_orden='IMPRESO' ";
if($desde!='' && $hasta!=''){
	$desde=formatfecha($desde);
	$hasta=formatfecha($hasta);
	$sql=$sql." and fecha_imp between '$desde' and '$hasta'";
}
if($id_gt!='TODOS' && $id_gt!='' ){
	$sql=$sql." and id_gt='$id_gt'";
}
if($id_tipo_orden!='' && $id_tipo_orden!='0'){
	$sql=$sql." and id_tipo_orden='$id_tipo_orden'";
}
if($id_franq!='' && $id_franq!='0'){
	$sql=$sql." and id_franq='$id_franq'";
}
if($id_det_orden!='' && $id_det_orden!='0'){
	$sql=$sql." and id_det_orden='$id_det_orden'";
}
if($prioridad!='' && $prioridad!='0'){
	$sql=$sql." and prioridad='$prioridad'";
}


$x->setQuery("id_orden,contrato_fisico,id_det_orden,id_tipo_orden,detalle_orden,etiqueta,id_contrato,nro_contrato,(apellidocli || ' ' || nombrecli) as nombrecli,nombre_tipo_orden,nombre_det_orden,fecha_imp,nombre_franq,nombre_zona,nombre_sector,etiqueta as precinto","vista_orden","id_orden"," $sql $consult");
$x->setColumnHeader("id_orden", "Nº Orden");
//$x->hideColumn('apellidocli');
//$x->hideColumn('comentario_orden');
$x->hideColumn('id_tipo_orden');
$x->hideColumn('id_det_orden');
$x->hideColumn('nombre_franq');
//$x->hideColumn('nombre_det_orden');
$x->hideColumn('fecha_imp');
$x->hideColumn('etiqueta');
$x->hideColumn('contrato_fisico');
$x->hideColumn('tipo_detalle');
$x->hideColumn('id_contrato');
//$x->hideColumn('detalle_orden');
//$x->hideColumn('nro_contrato');
$x->setColumnHeader("detalle_orden", _("Observacion"));
$x->setColumnHeader("nombre_det_orden", _("detalle orden"));
$x->setColumnHeader("nro_contrato", _("Nº Contrato"));
$x->setColumnHeader("nombrecli", _("Abonado"));
$x->setColumnHeader("nombre_tipo_orden", _("tipo orden"));
$x->setColumnHeader("fecha_orden", _("fecha orden"));
$x->setColumnHeader("fecha_imp", _("fecha impresion"));
$x->setColumnHeader('nombre_zona', _("Zona"));
$x->setColumnHeader('nombre_sector', _("Sector"));

$x->setColumnHeader('nombre_franq', _("franquicia"));
$x->setColumnHeader('comentario_orden', _("Comentario"));
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');

$x->setColumnType('fecha_orden', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setColumnType('fecha_imp', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
//$x->addStandardControl(EyeDataGrid::STDCTRL_VISITA, "agregarComenta('%id_orden%')");

$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "guardarOrdenTec('%id_orden%');");
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
$x->setResultsPerPage(5);

//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_orden_final('%id_orden%');window.location.replace('#');");
//$x->addRowSelect("finOrdenTec('%id_orden%','%tipo_detalle%','%id_contrato%','%nro_contrato%','%nombrecli%','%nombre_tipo_orden%','%nombre_det_orden%','%etiqueta%','%comentario_orden%','%id_det_orden%','%id_tipo_orden%','%contrato_fisico%');window.location.replace('#');");
//$x->showCheckboxes();

//$x->addStandardControl(EyeDataGrid::STDCTRL_FINALIZAR, "finOrdenTec('%id_orden%','%tipo_detalle%','%id_contrato%','%nro_contrato%','%cedula%','%nombre%','%apellido%','%nombre_tipo_orden%','%nombre_det_orden%')");

/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarordenes_tecnicos('%id_orden%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarordenes_tecnicos('%id_orden%')");
*/
$x->printTable();
	
if($modo!='EXCEL'){
echo '
	<div align="LEFT"><input  type="hidden" name="registr" value="'._("finalizar ordenes seleccionadas").'" onclick="finOrdenSel()">&nbsp;</div>
';
}
//echo '<input  type="button" name="registrar" value="IMPRIMIR ORDENES SELECCIONADAS" onclick="imprimir_orden_sel()">'
?>
