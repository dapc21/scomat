<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("status_contrato,nombrestatus,abrev,penet,tipo_sta,color,status", "statuscont","status_contrato","");
$x->hideColumn('dato');
$x->hideColumn('status_contrato');
$x->setColumnHeader('status_contrato', 'status_contrato');
$x->setColumnHeader('nombrestatus', 'nombre status');
$x->setColumnHeader('abrev', 'alias corto');
$x->setColumnHeader('penet', 'penet ');
$x->setColumnHeader('tipo_sta', 'tipo');
$x->setColumnHeader('status', 'status');
$x->setColumnHeader('dato', 'dato');

$x->setColumnType('status', EyeDataGrid::TYPE_BACK_COLOR);

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_status_contrato('%status_contrato%');window.location.replace('#');");

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
