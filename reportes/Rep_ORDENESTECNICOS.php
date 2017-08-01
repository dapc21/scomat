<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];
$status_orden = $_GET['status_orden'];

$desde = formatfecha($_GET['desde']);
$hasta = formatfecha($_GET['hasta']);
$por_fecha = $_GET['por_fecha'];


$id_det_orden = $_GET['id_det_orden'];
$id_tipo_orden = $_GET['id_tipo_orden'];

$id_franq = $_GET['id_franq'];
$id_g_a = $_GET['id_g_a'];
$id_esta = $_GET['id_esta'];
$id_mun = $_GET['id_mun'];
$id_ciudad = $_GET['id_ciudad'];
$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$urbanizacion = $_GET['urbanizacion'];
$id_calle = $_GET['id_calle'];

$login_emi = $_GET['login_emi'];
$login_imp = $_GET['login_imp'];
$login_final = $_GET['login_final'];
$id_gt = $_GET['id_gt'];




	$where= "SELECT id_contrato,id_orden,nro_contrato,(nombrecli || ' ' || apellidocli) as cliente, fecha_orden,fecha_imp,fecha_cierre,fecha_final,nombre_tipo_orden,nombre_det_orden,nombre_grupo,status_orden,login_emi,login_imp,login_fin from vista_orden where (id_contrato <> '')";
	
$x->setColumnHeader("id_orden", _("nro orden"));
$x->setColumnHeader("fecha_orden", _("fecha emision"));
$x->setColumnHeader("fecha_imp", _("fecha impre"));
$x->setColumnHeader("fecha_cierre", _("fecha cierre"));
$x->setColumnHeader("fecha_final", _("fecha final"));
$x->setColumnHeader("nombre_tipo_orden", _("tipo orden"));
$x->setColumnHeader("nombre_det_orden", _("detalle orden"));
$x->setColumnHeader("status_orden", _("status orden"));
$x->setColumnHeader("nro_contrato", _("nro cont"));
$x->setColumnHeader("apellido", _("tecnico"));
$x->setColumnHeader("nombre_grupo", _("grupo trabajo"));
$x->setColumnType('fecha_orden', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setColumnType('fecha_imp', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setColumnType('fecha_cierre', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setColumnType('fecha_final', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);

$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "guardarOrdenTec_directa('%id_orden%')");

	$tipo='';
  if($gen_ubi!='GENERAL'){
		if($id_franq!='' && $id_franq!='0'){
			$where=$where. " and (id_franq = '$id_franq')";
		}
		if($id_esta!='' && $id_esta!='0'){
			$where=$where. " and (id_esta ILIKE '%$id_esta%')";
		}
		if($id_mun!='' && $id_mun!='0'){
			$where=$where. " and (id_mun ILIKE '%$id_mun%')";
		}
		if($id_ciudad!='' && $id_ciudad!='0'){
			$where=$where. " and (id_ciudad ILIKE '%$id_ciudad%')";
		}
		if($id_zona!='' && $id_zona!='0'){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
		}
		if($id_sector!='' && $id_sector!='0'){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!='' && $id_calle!='0'){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		if($urbanizacion!='' && $urbanizacion!='0'){
			$where=$where. " and (urbanizacion = '$urbanizacion')";
		}
	}
  
  
	if($gen_fec!='GENERAL'){
		
			$where=$where. " and $por_fecha between '$desde' and '$hasta'";
		
	
	}
	
	if($status_orden!='' && $status_orden!='0'){
			$where=$where. " and (status_orden ILIKE '%$status_orden%')";
		
	}
	if($status_contrato!='' && $status_contrato!='0'){
		$where=$where. " and (status_contrato ILIKE '%$status_contrato%')";
	}
	
	if($id_tipo_orden!='0'){
			$where=$where. " and (id_tipo_orden ILIKE '%$id_tipo_orden%') and (id_det_orden ILIKE '%$id_det_orden%') ";
	}
	
	if($login_emi!='' && $login_emi!='0'){
		$where=$where. " and (login_emi ILIKE '%$login_emi%')";
	}
	if($login_imp!='' && $login_imp!='0'){
		$where=$where. " and (login_imp ILIKE '%$login_imp%')";
	}
	if($login_final!='' && $login_final!='0'){
		$where=$where. " and (login_fin ILIKE '%$login_final%')";
	}
	if($id_gt!='' && $id_gt!='0'){
		$where=$where. " and (id_gt ILIKE '%$id_gt%')";
	}
	
//	echo ":$where:";
$x->setQuery("*","from vista_orden","","");

	$x->consultas($where);





$x->hideColumn('id_contrato');
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "respRefActCont('%id_contrato%')");
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




	echo '
<div align="center">
					
					</div>
';
?>
