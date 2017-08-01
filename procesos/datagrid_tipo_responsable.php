<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult=" status_tipo_res <> 'INTERNO' and id_estatus_reg = 1";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_tipo_res,nombre_tipo_res,status_tipo_res,id_estatus_reg", "tipo_responsable","id_tipo_res","$consult");
$x->hideColumn('id_tipo_res');
$x->hideColumn('id_estatus_reg');
$x->setColumnHeader('id_tipo_res', 'id_tipo_res');
$x->setColumnHeader('nombre_tipo_res', 'tipo de responsable');
$x->setColumnHeader('status_tipo_res', 'estatus');
$x->setColumnHeader('id_estatus_reg', 'ID del Estado del Registro');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_tipo_res('%id_tipo_res%')");

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
