<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_mov_e,id_es,ubic_ant,ubic_post,login,fecha,motivo", "movimiento_equipo","id_mov_e","");
$x->hideColumn('dato');
$x->hideColumn('id_mov_e');
$x->setColumnHeader('id_mov_e', 'id_mov_e');
$x->setColumnHeader('id_es', 'equipo');
$x->setColumnHeader('ubic_ant', 'ubic_ant');
$x->setColumnHeader('ubic_post', 'ubic_post');
$x->setColumnHeader('login', 'login');
$x->setColumnHeader('fecha', 'fecha');
$x->setColumnHeader('motivo', 'motivo');
$x->setColumnHeader('dato', 'dato');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_mov_e('%id_mov_e%');window.location.replace('#');");

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
