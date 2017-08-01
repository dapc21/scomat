<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_pd,id_cuba,id_contrato,monto_dep,fecha_reg,fecha_dep,numero_ref,status_pd,tipo_dt,telefono", "soporte_pago","id_pd","");
$x->hideColumn('dato');
$x->hideColumn('id_pd');
$x->setColumnHeader('id_pd', 'id_pd');
$x->setColumnHeader('id_cuba', 'id_cuba');
$x->setColumnHeader('id_contrato', 'id_contrato');
$x->setColumnHeader('monto_dep', 'monto_dep');
$x->setColumnHeader('fecha_reg', 'fecha_reg');
$x->setColumnHeader('fecha_dep', 'fecha_dep');
$x->setColumnHeader('numero_ref', 'numero_ref');
$x->setColumnHeader('status_pd', 'status_pd');
$x->setColumnHeader('tipo_dt', 'tipo_dt');
$x->setColumnHeader('telefono', 'telefono');
$x->setColumnHeader('dato', 'dato');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_pd('%id_pd%')");

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
