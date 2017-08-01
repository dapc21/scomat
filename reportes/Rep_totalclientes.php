<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];

$x->setQuery("id_contrato,nro_contrato,cedula,nombre,apellido,fecha_contrato,status_contrato,etiqueta,telefono, deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa","FROM vista_contrato","","");

if($gen_ubi!='GENERAL' || $gen_fec!='GENERAL' || $status_contrato!=''){
	$where= "SELECT id_contrato,nro_contrato,cedula,nombre,apellido,fecha_contrato,status_contrato,etiqueta,telefono, deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa,direc_adicional FROM vista_contrato where (id_contrato ILIKE '%0%') ";
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
			$where=$where. " and fecha_contrato between '$desde' and '$hasta'";
			$tipo='id_franq';
		}
		
	
	}
	
	if($status_contrato!=''){
		if($id_franq!=''){
			$where=$where. " and (status_contrato ILIKE '%$status_contrato%')";
		}
		
		
	}
	echo ":$where:";
	$x->consultas($where);
}
$x->setQuery("id_contrato,nro_contrato,cedula,nombre,apellido,fecha_contrato,status_contrato,etiqueta,telefono, deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa","vista_contrato","","");
$x->hideColumn('id_contrato');
$x->setColumnHeader("nro_contrato", _("contrato"));
$x->setColumnHeader("cedula", _("cedula"));
$x->setColumnHeader("nombre", _("nombre"));
$x->setColumnHeader("apellido", _("apellido"));
$x->setColumnHeader("fecha_contrato", _("fecha cont"));
$x->setColumnHeader("status_contrato", _("status"));
$x->setColumnHeader("etiqueta", _("precinto"));
$x->setColumnHeader("telefono", _("telefono"));
$x->setColumnHeader("deuda", _("total deuda"));
$x->setColumnHeader("nombre_zona", _("zona"));
$x->setColumnHeader("nombre_sector", _("sector"));
$x->setColumnHeader("nombre_calle", _("calle"));
$x->setColumnHeader("numero_casa", _("nro casa"));

$x->hideColumn('direc_adicional');
$x->setColumnHeader('direc_adicional','Referencia');

$x->setColumnType('costo_dif_men', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('fecha_contrato', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setClase("Rep_totalclientes");

//$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "respRefActCont('%id_contrato%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "respRefActCont('%id_contrato%')");

//$x->hideOrder();
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

$x->printTable();

echo '
<div align="center">
					<input  type="button" name="registrar" value="'. _('imprimir').'" onclick="ImprimirRep_totalclientes()">&nbsp;
					<input  type="button" name="registrar" value="'. _('guardar').'" onclick="GuardarRep_totalclientes()">&nbsp;
					</div>
';
?>
