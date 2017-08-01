<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult=" status_mot_mov <> 'INTERNO' AND status_mot_mov <> 'SISTEMA' and id_estatus_reg = 1";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_mot_mov,nombre_mot_mov,status_mot_mov,id_tipo_mov,nombre_tipo_mov,id_estatus_reg", "vista_motivo_movimiento","id_mot_mov","$consult");
$x->hideColumn('id_mot_mov');
$x->hideColumn('id_tipo_mov');
$x->hideColumn('id_estatus_reg');
$x->setColumnHeader('id_mot_mov', 'ID del Motivo');
$x->setColumnHeader('nombre_mot_mov', 'Motivo del Movimiento');
$x->setColumnHeader('id_tipo_mov', 'ID del Tipo de Movimiento');
$x->setColumnHeader('nombre_tipo_mov', 'Nombre del Tipo de Movimiento');
$x->setColumnHeader('status_mot_mov', 'Estatus');
$x->setColumnHeader('id_estatus_reg', 'ID del Estado del Registro');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_mot_mov('%id_mot_mov%')");

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
