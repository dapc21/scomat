<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_serv_sist,id_tse,nombre_serv_sist,codigo_serv_sist,abrev_serv_sist,status_serv_sist", "servicios_sistema","id_serv_sist","");
$x->hideColumn('dato');
$x->hideColumn('id_serv_sist');
$x->setColumnHeader('id_serv_sist', 'id_serv_sist');
$x->setColumnHeader('id_tse', 'id_tse');
$x->setColumnHeader('nombre_serv_sist', 'nombre_serv_sist');
$x->setColumnHeader('codigo_serv_sist', 'codigo_serv_sist');
$x->setColumnHeader('abrev_serv_sist', 'abrev_serv_sist');
$x->setColumnHeader('status_serv_sist', 'status_serv_sist');
$x->setColumnHeader('dato', 'dato');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_serv_sist('%id_serv_sist%');window.location.replace('#');");

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
