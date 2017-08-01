<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
session_start();
$id_f = $_SESSION["id_franq"]; 
if($id_f!='0'){
			//$consult=" and id_franq='$id_f'";
}
			
$cedula = $_GET['cedula'];
$contrato_fisico = $_GET['contrato_fisico'];
$nombre = utf8_encode($_GET['nombre']);
$apellido = utf8_encode($_GET['apellido']);
$nro_contrato = $_GET['nro_contrato'];
$etiqueta = $_GET['etiqueta'];
$fecha_contrato = $_GET['fecha_contrato'];
$metodo = $_GET['metodo'];

$id_franq = $_GET['id_franq'];
$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];
$numero_casa = $_GET['numero_casa'];
$telefono = $_GET['telefono'];
$telf_casa = $_GET['telf_casa'];

$postel = $_GET['postel'];
$cod_id_persona = $_GET['cod_id_persona'];
$id_persona = $_GET['id_persona'];
$id_g_a = $_GET['id_g_a'];
$status_contrato = $_GET['status_contrato'];
//echo ":$metodo:";

$fecha_act=date("Y-m-01");
	//$where= "SELECT id_contrato,nro_contrato,cedula,(nombre || ' ' || apellido) as  nombre,contrato_fisico,etiqueta,nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono,status_contrato,postel FROM vista_contrato where id_contrato<>'' $consult ";
	$where= "SELECT id_contrato,nro_contrato,cedula,(nombre || ' ' || apellido) as  cliente,
	( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda WHERE  contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst <= '$fecha_act') AS deuda,
	nombre_zona,nombre_sector,nombre_calle,numero_casa,status_contrato,telefono,etiqueta,postel,direc_adicional FROM vista_contrato_auditoria where id_contrato<>'' $consult ";
	
		if($id_persona!='0' && $id_persona!=''){
			$where=$where. "and (id_persona ILIKE '%$id_persona%')";
		}
		if($id_g_a!='0' && $id_g_a!=''){
			$where=$where. "and (id_g_a ILIKE '%$id_g_a%')";
		}
		if($status_contrato!='0' && $status_contrato!=''){
			$where=$where. "and (status_contrato ILIKE '%$status_contrato%')";
		}
		if($id_franq!='0' && $id_franq!=''){
			$where=$where. "and (id_franq = '$id_franq')";
		}
		if($postel!=''){
			$where=$where. "and (postel ILIKE '%$postel%')";
		}
		if($cod_id_persona!='0' && $cod_id_persona!=''){
			$where=$where. "and (cod_id_persona ILIKE '%$cod_id_persona%')";
		}
		if($cedula!=''){
			$where=$where. "and (cedula ILIKE '%$cedula%')";
		}
		if($nombre!=''){
			$where=$where. " and (nombre ILIKE '%$nombre%')";
		}
		if($apellido!=''){
			$where=$where. " and (apellido ILIKE '%$apellido%')";
		}
		if($nro_contrato!=''){
			$where=$where. " and (nro_contrato ILIKE '%$nro_contrato%')";
		}
		if($contrato_fisico!=''){
			$where=$where. " and (contrato_fisico ILIKE '%$contrato_fisico%')";
		}
		if($etiqueta!=''){
			$where=$where. " and (etiqueta ILIKE '%$etiqueta%')";
		}
		if($fecha_contrato!=''){
			$where=$where. " and fecha_contrato ='%$fecha_contrato%'";
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
		if($numero_casa!=''){
			$where=$where. " and (numero_casa ILIKE '%$numero_casa%')";
		}
		if($telefono!=''){
			$where=$where. " and (telefono ILIKE '%$telefono%')";
		}
		if($telf_casa!=''){
			$where=$where. " and (telf_casa ILIKE '%$telf_casa%')";
		}
	
	//echo $where;
	

$x->setQuery("id_contrato,cedula,nro_contrato,nombre,apellido,etiqueta,nombre_zona,nombre_sector,nombre_calle,numero_casa,numero_casa,telefono,status_contrato,direc_adicional","FROM contrato_servicio_deuda","id_contrato","");
$x->consultas($where);

$x->hideColumn('id_contrato');
$x->setColumnHeader("cedula", "Cedula");
$x->setColumnHeader("nombre", "Nombre");
$x->setColumnHeader("apellido", "Apellido");
$x->setColumnHeader("nro_contrato", "Nro Cont.");
$x->setColumnHeader("etiqueta", "Precinto");
$x->setColumnHeader("fecha_contrato", "Fecha Cont.");
$x->setColumnHeader("direc_adicional", "Referencia");
$x->setColumnHeader("direc_adicional", "Referencia");

$x->setColumnHeader("nombre_zona", "Zona");
$x->setColumnHeader("nombre_sector", "Sector");
$x->setColumnHeader("nombre_calle", "Calle");
$x->setColumnHeader("numero_casa", "Nro Casa");
$x->setColumnHeader("telefono", "Celular");
$x->setColumnHeader("status_contrato", "Status");

//$x->hideOrder();
//$x->allowFilters();

$x->addRowSelect("respBuscarContAvanz1('%id_contrato%')");

$x->setResultsPerPage(10);
$x->ocultar_foot("1");

$x->printTable();
?>
