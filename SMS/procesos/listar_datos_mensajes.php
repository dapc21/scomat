<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
//require_once "../Clases/sms.php";
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$desde = trim($_GET['desde']);
$hasta = trim($_GET['hasta']);
$deuda = trim($_GET['deuda']);


$id_franq = trim($_GET['id_franq']);


$id_zona = trim($_GET['id_zona']);
$id_sector = trim($_GET['id_sector']);
$id_calle = trim($_GET['id_calle']);
$status_pago = trim($_GET['status_pago']);
$sd = trim($_GET['sd']);
$sms = trim($_GET['sms']);

	if($sd==''){
		$sql=" 
		SELECT id_contrato,nro_contrato,cedula,(nombre || ' ' || apellido) as nombre,telefono,telf_casa,telf_adic,
		( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro)FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$desde' and '$hasta') AS deuda
		
	   
	   FROM vista_contrato
	  WHERE id_contrato<>''
	  ";
	}
	else{
		$sql=" 
		SELECT id_contrato,nro_contrato,cedula,(nombre || ' ' || apellido) as nombre,telefono,telf_casa,telf_adic,
		( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$desde' and '$hasta') AS deuda
		
	   FROM vista_contrato
	  WHERE 
	  ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$desde' and '$hasta')>$deuda 
	  ";
	}
  
	$where=  $sql;
	if($id_franq!='' && $id_franq!='0'){
		$where=$where. " and (id_franq = '$id_franq')";
	}
	if($id_zona!='' && $id_zona!='0'){
		$where=$where. " and (id_zona ILIKE '%$id_zona%')";
	}
	if($id_sector!='' && $id_sector!='0'){
		$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		$tipo='id_sector';
	}
	if($id_calle!='' && $id_calle!='0'){
		$where=$where. " and (id_calle ILIKE '%$id_calle%')";
	}
	else if($status_pago!='' && $status_pago!='0'){
		$where=$where. " and (status_contrato ILIKE '%$status_pago%')";
	}
	
	//echo "$where";
	
$x->setQuery("*","FROM vista_contrato","","");
	$x->consultas($where);



$x->setColumnHeader("cedula", _("cedula"));
$x->setColumnHeader("id_persona", _("deuda"));
$x->setColumnHeader("nro_contrato", _("nro Cont"));
$x->setColumnHeader("nombre", _("cliente"));
$x->setColumnHeader("telf_casa", _("telf. casa"));
$x->setColumnHeader("telf_adic", _("telf adic."));
$x->setColumnHeader("telefono", _("celular"));


$x->hideColumn('apellido');
$x->hideColumn('id_franq');
$x->hideColumn('id_contrato');
$x->setClase("status_contrato");
$x->desde=$desde;
$x->hasta=$hasta;
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
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



  
?>
