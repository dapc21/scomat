<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_es,codigo_es,codigo_adic,(nombre || ' ' || apellido) as cliente ,nombre_modelo,sistema,status_es,estado_fisico,ver_serv_sist_equipo(id_es) as paquetes", "vista_equipo_sistema","id_es","");
$x->hideColumn('dato');
$x->hideColumn('id_es');
$x->setColumnHeader('id_es', 'id_es');
$x->setColumnHeader('nombre_modelo', 'modelo');
$x->setColumnHeader('id_ues', 'ubicacion');
$x->setColumnHeader('id_contrato', 'id_contrato');
$x->setColumnHeader('codigo_es', 'codigo');
$x->setColumnHeader('tipo_es', 'tipo');
$x->setColumnHeader('status_es', 'status');
$x->setColumnHeader('obser_es', 'observacion');
$x->setColumnHeader('codigo_adic', 'codigo Adic.');
$x->setColumnHeader('estado_fisico', 'estado fisico');
$x->setColumnHeader('dato', 'dato');
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_es('%id_es%');window.location.replace('#');");

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
