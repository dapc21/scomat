<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult=" id_estatus_reg = 1 and nombre_est_inv <> 'FINALIZADO'";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_inv,id_mot_inv,id_est_inv,id_alm,ref_inv,fecha_inv,nombre_alm,nombre_est_inv,nombre_mot_inv,obser_inv", "vista_inventario","id_inv","$consult");
$x->hideColumn('id_inv');
$x->hideColumn('id_mot_inv');
$x->hideColumn('id_est_inv');
$x->hideColumn('id_alm');
$x->setColumnHeader('id_inv', 'id_inv');
$x->setColumnHeader('id_mot_inv', 'motivo');
$x->setColumnHeader('id_est_inv', 'estatus');
$x->setColumnHeader('id_alm', 'almacen');
$x->setColumnHeader('ref_inv', 'Referencia');
$x->setColumnHeader('fecha_inv', 'Fecha');
$x->setColumnHeader('nombre_alm', 'Almacén');
$x->setColumnHeader('nombre_est_inv', 'Estatus');
$x->setColumnHeader('nombre_mot_inv', 'Motivo');
$x->setColumnHeader('obser_inv', 'Observación');
$x->addCustomControl(EyeDataGrid::CUSCTRL_TEXT, "mostrarDetalleInventario('%id_inv%','%ref_inv%')", EyeDataGrid::TYPE_ONCLICK, 'Ver Detalle');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_inv('%id_inv%')");

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
