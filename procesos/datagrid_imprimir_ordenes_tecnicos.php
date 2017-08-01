<?php
session_start();
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
$sql="status_orden='CREADO' ";
if($desde!='' && $hasta!=''){
	$desde=formatfecha($desde);
	$hasta=formatfecha($hasta);
	$sql=$sql." and fecha_orden between '$desde' and '$hasta'";
}
if($id_gt!='TODOS' && $id_gt!='' && $id_gt!='0'){
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

$x->setQuery("id_orden,nro_contrato,(nombrecli || ' ' || apellidocli) as nombrecli,nombre_tipo_orden,nombre_det_orden,detalle_orden,fecha_orden,prioridad,nombre_franq,nombre_zona,nombre_sector,etiqueta as precinto,postel as poste","vista_orden","id_orden"," $sql $consult");
//$x->hideColumn('detalle_orden');
$x->hideColumn('nombre_tipo_orden');
//$x->hideColumn('fecha_orden');
$x->hideColumn('prioridad');
$x->hideColumn('nombre_franq');
$x->setColumnHeader("id_orden", _("Nº Orden"));
$x->setColumnHeader("id_orden", _("Nº Orden"));
$x->setColumnHeader("nro_contrato", _("Nº Cont."));
$x->setColumnHeader("nombrecli", _("Abonado"));
$x->setColumnHeader("nombre", _("Técnico"));
$x->setColumnHeader("detalle_orden", _("Observacion"));
$x->setColumnHeader("nombre_tipo_orden", _("Tipo de Orden"));
$x->setColumnHeader("nombre_det_orden", _("Detalle de orden"));
$x->setColumnHeader("fecha_orden", _("Fecha de la Orden"));
$x->setColumnHeader('prioridad', _("Prioridad"));
$x->setColumnHeader('nombre_zona', _("Zona"));
$x->setColumnHeader('nombre_sector', _("Sector"));
$x->setColumnHeader('nombre_franq', _("Franquicia"));
//$x->addRowSelect("sel_grupo_aut('%nombre_zona%')");
/*
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "sel_grupo_aut('%nombre_zona%');imprimirOrdenTec('%id_orden%');");
$x->addStandardControl(EyeDataGrid::STDCTRL_SAVE, "sel_grupo_aut('%nombre_zona%');guardarOrdenTec('%id_orden%');");
*/
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimirOrdenTec('%id_orden%');");
$x->addStandardControl(EyeDataGrid::STDCTRL_SAVE, "guardarOrdenTec('%id_orden%');");
//$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimirOrdenTec('%id_orden%');");
//$x->addRowSelect("imprimirOrdenTec('%id_orden%');");
$x->setColumnType('fecha_orden', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
//para permitir filtros
$x->allowFilters();
$x->showCheckboxes();
//$x->setClase("datagrid_imprimir_ordenes_tecnicos");
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
//$x->addRowSelect("buscar_id_ordenes_tecnicos('%id_orden%')");

//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@ordenes_tecnicos','id_orden=@%id_orden%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarordenes_tecnicos('%id_orden%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarordenes_tecnicos('%id_orden%')");

<div align="center"><input  type="button" name="regisdftrar" value="'._("imprimir ordenes seleccionadas").'" onclick="imprimir_orden_sel()"> &nbsp;
*/
$x->printTable();
	
if($modo!='EXCEL'){
echo '

	  <div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left">
			<button class="btn btn-success" type="button" name="registrar" value="'._("imprimir ordenes seleccionadas").'" onclick="guardar_orden_sel()"><i class="glyphicon glyphicon-print"></i> Imprimir Órdenes Seleccionadas</button>
			<button class="btn btn-success" type="button" name="registrar" value="'._("imprimir en listado de corte").'" onclick="guardar_orden_sel_corte()"><i class="glyphicon glyphicon-print"></i> Imprimir en Listado de Corte</button>
		</div>
		
		</div>';
}
?>
