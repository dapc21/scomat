<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_tse,sistema,ubicacion,abrev_nombre_tse,status_tse", "tipo_sist_equipo","id_tse","");
$x->hideColumn('dato');
$x->hideColumn('id_tse');
$x->setColumnHeader('id_tse', 'id_tse');
$x->setColumnHeader('sistema', 'sistema');
$x->setColumnHeader('ubicacion', 'ubicacion');
$x->setColumnHeader('abrev_nombre_tse', 'Alias');
$x->setColumnHeader('status_tse', 'status');
$x->setColumnHeader('dato', 'dato');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_tse('%id_tse%');window.location.replace('#');");

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
