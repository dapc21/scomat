<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult = " id_estatus_reg = 1 and codigo_est_ped <> 'COM'";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_ped,id_est_ped,ref_ped,fecha_ped,nombre_est_ped,obser_ped", "vista_pedido","id_ped","$consult");
$x->hideColumn('id_ped');
$x->hideColumn('id_est_ped');
$x->setColumnHeader('id_ped', 'id_ped');
$x->setColumnHeader('id_est_ped', 'id_est_ped');
$x->setColumnHeader('ref_ped', 'referencia');
$x->setColumnHeader('fecha_ped', 'fecha');
$x->setColumnHeader('nombre_est_ped', 'Estatus');
$x->setColumnHeader('obser_ped', 'observación');
$x->addCustomControl(EyeDataGrid::CUSCTRL_TEXT, "mostrarDetallePedido('%id_ped%','%ref_ped%')", EyeDataGrid::TYPE_ONCLICK, 'Ver Detalle');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_ped('%id_ped%')");

//mostrar cantidad de registros personalizados
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
