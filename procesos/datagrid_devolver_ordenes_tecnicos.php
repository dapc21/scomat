<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_orden,nro_contrato,nombrecli,nombre_det_orden,fecha_orden,nombre_zona,comentario_orden,num_visitas","vista_orden","id_orden","status_orden='DEVUELTA'");
$x->hideColumn('nombre_zona');
$x->setColumnHeader("id_orden", _("Nº Orden"));
$x->setColumnHeader("nro_contrato", _("Nº Contrato"));
$x->setColumnHeader("nombrecli", _("Abonado"));
$x->setColumnHeader("nombre", _("Técnico"));
$x->setColumnHeader("nombre_tipo_orden", _("Tipo de Orden"));
$x->setColumnHeader("nombre_det_orden", _("Detalle de Orden"));
$x->setColumnHeader("fecha_orden", _("Fecha de Orden"));
$x->setColumnHeader('comentario_orden', _("Comentario"));
$x->setColumnHeader("num_visitas", "Nº Visitas");

//$x->addRowSelect("sel_grupo_aut('%nombre_zona%')");
/*
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "sel_grupo_aut('%nombre_zona%');imprimirOrdenTec('%id_orden%');");
$x->addStandardControl(EyeDataGrid::STDCTRL_SAVE, "sel_grupo_aut('%nombre_zona%');guardarOrdenTec('%id_orden%');");
*/
$x->addStandardControl(EyeDataGrid::STDCTRL_VISITA, "agregarComenta('%id_orden%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimirOrdenTec('%id_orden%');");
$x->addStandardControl(EyeDataGrid::STDCTRL_SAVE, "guardarOrdenTec('%id_orden%');");

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

$x->printTable();
	
if($modo!='EXCEL'){
echo '<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-warning" type="button" name="registrar" value="'._("imprimir ordenes seleccionadas").'" onclick="imprimir_orden_sel();"><i class="glyphicon glyphicon-print"></i> Imprimir Órdenes</button>
			<button class="btn btn-success" type="button" name="registrar" value="GUARDAR ORDENES SELECCIONADAS" onclick="guardar_orden_sel();"><i class="glyphicon glyphicon-repeat"></i> Guardar Órdenes</button>
		</div>
		
		</div>
	
	 </section>';
}
?>
