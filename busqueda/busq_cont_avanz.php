<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
session_start();
$id_f = $_SESSION["id_franq"]; 
if($id_f!='0'){
			$consult=" and id_franq='$id_f'";
}
			
$cedula = $_GET['cedula'];
$contrato_fisico = $_GET['contrato_fisico'];
$nombre = utf8_encode($_GET['nombre']);
$apellido = utf8_encode($_GET['apellido']);
$nro_contrato = $_GET['nro_contrato'];
$etiqueta = $_GET['etiqueta'];
$fecha_contrato_d = $_GET['fecha_contrato_d'];
$fecha_contrato_h = $_GET['fecha_contrato_h'];
$metodo = $_GET['metodo'];

$id_franq = $_GET['id_franq'];
$id_esta = $_GET['id_esta'];
$id_mun = $_GET['id_mun'];
$id_ciudad = $_GET['id_ciudad'];
$id_urb = $_GET['id_urb'];
$id_edif = $_GET['id_edif'];
$tipo_fact = $_GET['tipo_fact'];
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
	$where= "SELECT color,id_contrato,nro_contrato,cedula,(nombre || ' ' || apellido) as  cliente,
	saldo,
	nombre_zona,nombre_sector,nombre_calle,numero_casa,status_contrato,telefono,etiqueta,postel,direc_adicional FROM vista_contrato_auditoria where id_contrato<>'' $consult ";
	
		if($id_persona!='0' && $id_persona!=''){
			$where=$where. "and (id_persona = '$id_persona')";
		}
		if($id_g_a!='0' && $id_g_a!=''){
			$where=$where. "and (id_g_a = '$id_g_a%')";
		}
		if($status_contrato!='0' && $status_contrato!=''){
			$where=$where. "and (status_contrato = '$status_contrato')";
		}
		if($postel!=''){
			$where=$where. "and (postel ILIKE '%$postel%')";
		}
		if($cod_id_persona!='0' && $cod_id_persona!=''){
			$where=$where. "and (cod_id_persona = '$cod_id_persona')";
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
		if($tipo_fact!=''){
			$where=$where. " and (tipo_fact ILIKE '%$tipo_fact%')";
		}
		if($fecha_contrato_d!='' && $fecha_contrato_h!=''){
			$where=$where. " and fecha_contrato  between '$fecha_contrato_d' and '$fecha_contrato_h' ";
		}
		if($id_franq!='0' && $id_franq!=''){
			$where=$where. "and (id_franq = '$id_franq')";
		}
		if($id_esta!='' && $id_esta!='0'){
			$where=$where. " and (id_esta ='$id_esta')";
		}
		if($id_mun!='' && $id_mun!='0'){
			$where=$where. " and (id_mun ='$id_mun')";
		}
		if($id_ciudad!='' && $id_ciudad!='0'){
			$where=$where. " and (id_ciudad ='$id_ciudad')";
		}
		if($id_zona!='' && $id_zona!='0'){
			$where=$where. " and (id_zona ='$id_zona')";
		}
		if($id_sector!='' && $id_sector!='0'){
			$where=$where. " and (id_sector ='$id_sector')";
		}
		if($id_calle!='' && $id_calle!='0'){
			$where=$where. " and (id_calle ='$id_calle')";
		}
		if($id_urb!='' && $id_urb!='0'){
			$where=$where. " and (id_urb ='$id_urb')";
		}
		if($id_edif!='' && $id_edif!='0'){
			$where=$where. " and (id_edif = '$id_edif')";
		}
		if($numero_casa!=''){
			$where=$where. " and (numero_casa ILIKE '%$numero_casa%')";
		}
		if($telefono!=''){
			$where=$where. " and (telefono ILIKE '%$telefono%' or telf_casa ILIKE '%$telefono%' or telf_adic ILIKE '%$telefono%')";
		}
		
		if($telf_casa!=''){
			$where=$where. " and (telefono ILIKE '%$telf_casa%' or telf_casa ILIKE '%$telf_casa%' or telf_adic ILIKE '%$telf_casa%')";
		}
	

$x->setQuery("color,id_contrato,cedula,nro_contrato,nombre,apellido,etiqueta,nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono,status_contrato,direc_adicional","FROM vista_contrato_auditoria","id_contrato","");	//echo $where;
	
	$x->consultas($where);



$x->hideColumn('id_contrato');
$x->hideColumn('numero_casa');
$x->hideColumn('postel');
$x->hideColumn('color');
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

$x->setColumnType('status_contrato', EyeDataGrid::TYPE_COLOR);

//$x->hideOrder();
//$x->allowFilters();

$x->addRowSelect("buscar_id_contrato_busqueda('%id_contrato%')");

//$x->showRowNumber();

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
		   $x->setResultsPerPage(20);
		}
	}
}

$x->printTable();
?>
