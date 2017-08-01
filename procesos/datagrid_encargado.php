<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult=" status_enc <> 'INTERNO' and id_estatus_reg = 1";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_enc,id_persona,cedula,nombre,apellido,descrip_enc,status_enc,id_estatus_reg", "vista_encargado","id_persona","$consult");
$x->hideColumn('id_persona');
$x->hideColumn('id_enc');
$x->hideColumn('descrip_enc');
$x->hideColumn('status_enc');
$x->hideColumn('id_estatus_reg');
$x->setColumnHeader('id_persona', 'ID Per.');
$x->setColumnHeader('id_enc', 'ID Enc.');
$x->setColumnHeader('cedula', 'Cédula');
$x->setColumnHeader('nombre', 'Nombre(s)');
$x->setColumnHeader('apellido', 'Apellido(s)');
$x->setColumnHeader('descrip_enc', 'Observación');
$x->setColumnHeader('status_enc', 'Estatus');
$x->setColumnHeader('id_estatus_reg', 'ID del Estado del Registro');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_enc('%id_persona%');");

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
