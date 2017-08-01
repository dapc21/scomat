<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];

$desde = formatfecha($_GET['desde']);
$hasta = formatfecha($_GET['hasta']);
$id_det_orden = $_GET['id_det_orden'];
$id_tipo_orden = $_GET['id_tipo_orden'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];


if($gen_ubi!='GENERAL' || $gen_fec!='GENERAL' || $status_contrato!='' || $id_tipo_orden!='0'){
	$where= "SELECT id_contrato,id_orden,nro_contrato,(nombrecli || ' ' || apellidocli) as nombrecli,nombre_sector,nombre_det_orden,fecha_final,status_orden from vista_orden where (id_contrato ILIKE '%0%')";
	$tipo='';
  if($gen_ubi!='GENERAL'){
		if($id_franq!='0'){
			$where=$where. " and (id_franq = '$id_franq')";
			$tipo='id_franq';
		}
		else if($id_zona!='0'){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
			$tipo='id_zona';
		}
		else if($id_sector!='0'){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
			$tipo='id_sector';
		}
		else if($id_calle!='0'){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			$tipo='id_calle';
		}
		
		if($tipo=='id_franq'){
			if($id_zona!='0'){
				$where=$where. " and (id_zona ILIKE '%$id_zona%')";
			}
			if($id_sector!='0'){
				$where=$where. " and (id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			}

		}
		else if($tipo=='id_zona'){
			if($id_sector!='0'){
				$where=$where. " and (id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_sector'){
			if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			}
			
		}

	
	}
  
  
	if($gen_fec!='GENERAL'){
		if($id_franq!=''){
			$where=$where. " and fecha_final between '$desde' and '$hasta'";
			$tipo='id_franq';
		}
		
	
	}
	
	if($status_contrato!=''){
			$where=$where. " and (status_orden ILIKE '%$status_contrato%')";
		
	}
	
	if($id_tipo_orden!='0'){
			$where=$where. " and (id_tipo_orden ILIKE '%$id_tipo_orden%') and (id_det_orden ILIKE '%$id_det_orden%') ";
	}
	//echo ":$where:";
	
}



$x->setQuery("*","from vista_orden","","");

$x->consultas($where."and id_det_orden='DEO00010' order by id_orden");

//$x->setQuery("id_contrato,id_orden,fecha_final,nombre_tipo_orden,nombre_det_orden,status_orden,apellido","vista_orden","","");
$x->setColumnHeader("id_orden", _("orden"));
$x->setColumnHeader("fecha_final", _("fecha final"));

$x->setColumnHeader("nombre_det_orden", _("detalle"));
$x->setColumnHeader("status_orden", _("status orden"));
$x->setColumnHeader("nro_contrato", _("contrato"));
$x->setColumnHeader("nombrecli", _("cliente"));
$x->setColumnHeader("nombre_sector", _("sector"));

$x->setColumnType('fecha_final', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);

$x->hideColumn('id_contrato');
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "respRefActCont('%id_contrato%')");
$x->hideOrder();
//$x->allowFilters();
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

ECHO '<span class="fuente">'. _('corte de servicios').'</span>';
$x->printTable();


$x->consultas($where."and id_det_orden='DEO00003' order by id_orden");

ECHO '<br><span class="fuente">'. _('reconexiones').'</span>';
$x->printTable();


$x->consultas($where."and id_det_orden='DEO00001' order by id_orden");

ECHO '<br><span class="fuente">'. _('instalaciones nuevas').'</span>';
$x->printTable();




	echo '
<div align="center">
					<input  type="button" name="registrar" value="'. _('imprimir reporte').'" onclick="ImprimirRep_ORDENESTECNICOSC()">&nbsp;
					</div>
';
?>
