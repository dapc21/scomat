<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

$deuda = $_GET['deuda'];
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$tipo = $_GET['tipo'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];



$x->setQuery("nro_contrato,cedula,apellido,nombre,status_contrato,id_persona,nombre_calle,nombre_sector,nombre_zona,nombre_franq","FROM vista_contrato","id_cont_serv","status_contrato='ACTIVO'");


if($id_franq!='' || $id_zona!='' || $id_sector!='' || $id_calle!=''){
	//,nombre_franq 
	
	/*
	SELECT id_contrato,nro_contrato,id_franq,apellido,nombre,status_contrato, 
getdeuda(vista_contrato.id_contrato,'2006-01-01','2011-10-01') as deuda
,nombre_calle,nombre_sector,nombre_zona 
FROM vista_contrato WHERE vista_contrato.status_contrato = 'ACTIVO'::bpchar and 
getdeuda(vista_contrato.id_contrato,'2006-01-01','2011-10-01') > 0 
and (id_franq = '1%') and (id_zona ILIKE '%0%') and (id_sector ILIKE '%0%') and (id_calle ILIKE '%0%');
	*/
	/*$sql=" 
	SELECT id_cont_serv,nro_contrato,id_franq,apellido,nombre,status_contrato, sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) as deuda
	 
	,nombre_calle,nombre_sector,nombre_zona
   
   FROM vista_contrato, contrato_servicio_deuda
  WHERE vista_contrato.status_contrato = 'ACTIVO'::bpchar and 
  sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) > $deuda
   and 
  ";
  */
  $sql=" 
	SELECT id_cont_serv, nro_contrato,id_franq,apellido,nombre,status_contrato, contrato_servicio_deuda.costo_cobro as deuda
	 
	,nombre_calle,nombre_sector,nombre_zona
   
   FROM vista_contrato, contrato_servicio_deuda
  WHERE vista_contrato.status_contrato = 'ACTIVO'::bpchar  and  fecha_inst='$hasta'  AND (id_serv='SER00001' or id_serv='BM00009' or id_serv='BM00008') AND 
  contrato_servicio_deuda.id_contrato=vista_contrato.id_contrato 
   and 
  ";
  
	
	//$where= "SELECT id_contrato,nro_contrato,id_franq,apellido,nombre,status_contrato,id_persona,nombre_calle,nombre_sector,nombre_zona,nombre_franq FROM vista_contrato where status_contrato='ACTIVO' and ";
	$where=  $sql;
	$tipo='';
	if($id_franq!=''){
		$where=$where. "(id_franq = '$id_franq')";
		$tipo='id_franq';
	}
	else if($id_zona!=''){
		$where=$where. "(id_zona ILIKE '%$id_zona%')";
		$tipo='id_zona';
	}
	else if($id_sector!=''){
		$where=$where. "(id_sector ILIKE '%$id_sector%')";
		$tipo='id_sector';
	}
	else if($id_calle!=''){
		$where=$where. "(id_calle ILIKE '%$id_calle%')";
		$tipo='id_calle';
	}
	
	if($tipo=='id_franq'){
		if($id_zona!=''){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
		}
		if($id_sector!=''){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		
	}
	else if($tipo=='id_zona'){
		if($id_sector!=''){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
	}
	else if($tipo=='id_sector'){
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		
	}
	$where=$where.' order by id_zona,id_sector,nombre_calle';
	
	$x->consultas($where);
}


//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("nro_contrato,cedula,apellido,nombre,status_contrato,id_persona,nombre_calle,nombre_sector,nombre_zona,nombre_franq","vista_contrato","id_cont_serv","status_contrato='ACTIVO'");
$x->setColumnHeader("cedula", "Cedula");
$x->setColumnHeader("id_persona", "Deuda");
$x->setColumnHeader("nro_contrato", "Nro Cont");
$x->setColumnHeader("nombre", "Cliente");
$x->setColumnHeader("status_contrato", "Status");
$x->setColumnHeader('nombre_calle','Nombre Calle');
$x->setColumnHeader('nombre_sector','Sector');
$x->setColumnHeader('nombre_zona','Zona');
$x->setColumnHeader('nombre_franq','Franquicia');

$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimir_fact_lotes('%id_cont_serv%','$deuda');");

$x->hideColumn('apellido');
$x->hideColumn('id_franq');
$x->hideColumn('id_contrato');
//$x->hideColumn('id_cont_serv');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setClase("status_contrato");
$x->desde=$desde;
$x->hasta=$hasta;
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
$x->showCheckboxes();
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
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@status_contrato','status_contrato=@%status_contrato%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarstatus_contrato('%status_contrato%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarstatus_contrato('%status_contrato%')");
*/
$x->printTable();
?>
