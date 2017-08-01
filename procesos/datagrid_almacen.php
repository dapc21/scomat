<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult=" status_alm <> 'INTERNO' and id_estatus_reg = 1";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_alm,id_gt,id_enc,codigo_alm,nombre_alm,direccion_alm,descrip_alm,status_alm,encargado,nombre_grupo,id_estatus_reg", "vista_almacen","id_alm","$consult");
$x->hideColumn('id_alm');
$x->hideColumn('id_gt');
$x->hideColumn('id_enc');
$x->hideColumn('id_estatus_reg');
$x->setColumnHeader('id_alm', 'id_alm');
$x->setColumnHeader('id_gt', 'id grupo de trabajo');
$x->setColumnHeader('id_enc', 'id encargado');
$x->setColumnHeader('codigo_alm', 'código');
$x->setColumnHeader('nombre_alm', 'almacen');
$x->setColumnHeader('direccion_alm', 'dirección/ubicación');
$x->setColumnHeader('descrip_alm', 'observación');
$x->setColumnHeader('status_alm', 'estatus');
$x->setColumnHeader('encargado', 'encargado');
$x->setColumnHeader('nombre_grupo', 'grupo de trabajo');
$x->setColumnHeader('id_estatus_reg', 'ID del Estado del Registro');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_alm('%id_alm%')");

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
