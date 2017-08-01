<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];

$dias = $_GET['monto_dc'];
$mes = $_GET['mes'];

$id_franq = $_GET['id_franq'];

$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];

$where = "select contrato_servicio_deuda.id_cont_serv,vista_contrato_auditoria.id_contrato,vista_contrato_auditoria.nro_contrato,vista_contrato_auditoria.cedula,vista_contrato_auditoria.nombre,vista_contrato_auditoria.apellido ,vista_contrato_auditoria.status_contrato,vista_contrato_auditoria.nombre_zona,vista_contrato_auditoria.nombre_sector,vista_contrato_auditoria.nombre_calle from vista_contrato_auditoria, contrato_servicio_deuda,servicios where  contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato and contrato_servicio_deuda.fecha_inst='$mes' and contrato_servicio_deuda.status_con_ser='DEUDA' and tipo_costo='COSTO MENSUAL' and costo_cobro>0  ";

if($gen_ubi!='GENERAL' || $status_contrato!=''){
	
	$tipo='';
  if($gen_ubi!='GENERAL'){
		if($id_franq!='0'){
			$where=$where. " and (vista_contrato_auditoria.id_franq = '$id_franq')";
			$tipo='id_franq';
		}
		else if($id_zona!='0'){
			$where=$where. " and (vista_contrato_auditoria.id_zona ILIKE '%$id_zona%')";
			$tipo='id_zona';
		}
		else if($id_sector!='0'){
			$where=$where. " and (vista_contrato_auditoria.id_sector ILIKE '%$id_sector%')";
			$tipo='id_sector';
		}
		else if($id_calle!='0'){
			$where=$where. " and (vista_contrato_auditoria.id_calle ILIKE '%$id_calle%')";
			$tipo='id_calle';
		}
		
		if($tipo=='id_franq'){
			if($id_zona!='0'){
				$where=$where. " and (vista_contrato_auditoria.id_zona ILIKE '%$id_zona%')";
			}
			if($id_sector!='0'){
				$where=$where. " and (vista_contrato_auditoria.id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (vista_contrato_auditoria.id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_zona'){
			if($id_sector!='0'){
				$where=$where. " and (vista_contrato_auditoria.id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (vista_contrato_auditoria.id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_sector'){
			if($id_calle!='0'){
				$where=$where. " and (vista_contrato_auditoria.id_calle ILIKE '%$id_calle%')";
			}
			
		}

	
	}
  
  
	if($status_contrato!=''){
		if($id_franq!=''){
			$where=$where. " and (vista_contrato_auditoria.status_contrato ILIKE '%$status_contrato%')";
		}
	}
	//echo "$where";
	
$x->setQuery("*","from vista_contrato_auditoria","","");
	$x->consultas($where);
}
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

$x->setColumnType('costo_dif_men', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('fecha_contrato', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setClase("Rep_totalclientes");

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

;
?>
