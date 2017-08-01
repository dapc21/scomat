<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_mov,id_res,id_tipo_mov,id_alm,ref_mov,fecha_mov,nombre_tipo_mov,mot_mov,responsable", "vista_movimiento","id_mov","");
$x->hideColumn('id_mov');
$x->hideColumn('id_res');
$x->hideColumn('id_tipo_mov');
$x->hideColumn('id_alm');
$x->setColumnHeader('id_mov', 'id_mov');
$x->setColumnHeader('id_res', 'id_res');
$x->setColumnHeader('id_tipo_mov', 'id_tipo_mov');
$x->setColumnHeader('id_alm', 'id_alm');
$x->setColumnHeader('ref_mov', 'Referencia');
$x->setColumnHeader('fecha_mov', 'Fecha');
$x->setColumnHeader('nombre_tipo_mov', 'Tipo');
$x->setColumnHeader('mot_mov', 'Motivo');
$x->setColumnHeader('responsable', 'Responsable');
$x->addCustomControl(EyeDataGrid::CUSCTRL_TEXT, "mostrarDetalleMovimiento('%id_mov%','%ref_mov%')", EyeDataGrid::TYPE_ONCLICK, 'Ver Detalle');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

//$x->addRowSelect("buscar_id_mov('%id_mov%')");
//$x->addRowSelect("mostrarDetalleMovimiento('%id_mov%','%ref_mov%')");

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
