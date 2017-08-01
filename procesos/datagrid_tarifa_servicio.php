<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);



$id_serv = $_GET['id_serv'];
$id_cant = $_GET['id_cant'];
$id_paq = $_GET['id_paq'];
$tarifa_esp = $_GET['tarifa_esp'];
$tipo_serv = $_GET['tipo_serv'];
$tipo_paq = $_GET['tipo_paq'];
$tipo_costo = $_GET['tipo_costo'];
$id_tipo_servicio = $_GET['id_tipo_servicio'];
if($id_tipo_servicio!=''){
			$where=$where. "and (id_tipo_servicio = '$id_tipo_servicio')";
}
if($tipo_costo!=''){
			$where=$where. "and (tipo_costo = '$tipo_costo')";
}
if($tipo_paq!=''){
			$where=$where. "and (tipo_paq = '$tipo_paq')";
}
if($tipo_serv!=''){
			$where=$where. "and (tipo_serv = '$tipo_serv')";
}
if($tarifa_esp!=''){
			$where=$where. "and (tarifa_esp = '$tarifa_esp')";
}
if($id_paq!=''){
			$where=$where. "and (id_paq = '$id_paq')";
}
if($id_cant!=''){
			$where=$where. "and (id_cant = '$id_cant')";
}
if($id_serv!=''){
			$where=$where. "and (id_serv = '$id_serv')";
}

//crea la consulta SQL 
//campos, tabla, campo clave
//status_tarifa_ser='ACTIVO' and

if($_GET['order']==''){
	$x->setOrder('nombre_servicio', 'ASC');
}

$x->setQuery("nombre_servicio,tarifa_ser,id_serv,fecha_tar_ser,tipo_servicio,tipo_costo,tipo_paq,nombre_paq", "vista_servicios","id_serv"," status_serv='ACTIVO' $where ");
$x->hideColumn('id_tar_ser');
$x->setColumnHeader('id_serv', _("Nueva Tarifa"));
$x->setColumnHeader('nombre_servicio', _("Nombre del Servicio"));
$x->setColumnHeader('tarifa_ser', _("Tarifa Actual"));
$x->setColumnHeader('fecha_tar_ser', _("Fecha Act"));
$x->setColumnHeader('tipo_servicio', _("Tipo de Servicio"));
$x->setColumnHeader('tipo_costo', _("tipo costo"));
$x->setColumnHeader('tipo_paq', _("tipo paquete"));
$x->setColumnHeader('nombre_paq', _("paquete"));

$x->setColumnType('fecha_tar_ser', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
$x->showCheckboxes();
//maximo resultados permitidos por paginas

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$x->setResultsPerPage(1000);
}
$x->setClase("tarifa_servicio");

//llama al evento al darle click a la fila
//$x->addRowSelect("buscar_id_tar_ser('%id_tar_ser%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificartarifa_servicio('%id_tar_ser%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminartarifa_servicio('%id_tar_ser%')");
*/
$x->printTable();
?>
