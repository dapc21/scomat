<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_es=trim($_GET["id_es"]);
if($id_es!=''){
	$where = "id_es='$id_es'";
}
//crea la consulta SQL 
//campos, tabla, campo clave, condicion

if($_GET['order']==''){
	$x->setOrder('fecha', 'DESC');
}
$x->setQuery("id_inte,sistema,nombre_com_int,codigo_es,status,fecha,fecha_ejec,login,errmsg", "vista_interfaz_equipo","id_inte","$where");
$x->hideColumn('dato');
$x->hideColumn('id_inte');
$x->setColumnHeader('nombre_com_int', 'comando');
$x->setColumnHeader('id_com_int', 'comando');
$x->setColumnHeader('codigo_es', 'equipo');
$x->setColumnHeader('status', 'status');
$x->setColumnHeader('fecha', 'fecha emis.');
$x->setColumnHeader('fecha_ejec', 'fecha ejec.');
$x->setColumnHeader('login', 'login');
$x->setColumnHeader('errmsg', 'errmsg');
$x->setColumnHeader('cad_env', 'cad_env');
$x->setColumnHeader('cad_rec', 'cad_rec');
$x->setColumnHeader('dato', 'dato');

$x->setColumnType('fecha', EyeDataGrid::TYPE_DATE, 'd/m/Y H:m:s',true);
$x->setColumnType('fecha_ejec', EyeDataGrid::TYPE_DATE, 'd/m/Y H:m:s',true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_inte('%id_inte%');window.location.replace('#');");

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
