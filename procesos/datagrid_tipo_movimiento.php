<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult=" status_tipo_mov <> 'INTERNO' and id_estatus_reg = 1";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_tipo_mov,nombre_tipo_mov,descrip_tipo_mov,status_tipo_mov", "tipo_movimiento","id_tipo_mov","$consult");
$x->hideColumn('id_tipo_mov');
$x->setColumnHeader('id_tipo_mov', 'id tipo mov');
$x->setColumnHeader('nombre_tipo_mov', 'tipo de movimiento');
$x->setColumnHeader('descrip_tipo_mov', 'observación');
$x->setColumnHeader('status_tipo_mov', 'estatus');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_tipo_mov('%id_tipo_mov%')");

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
