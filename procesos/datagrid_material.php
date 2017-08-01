<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult=" id_estatus_reg = 1";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_mat,id_fam,codigo_mat,nombre_mat,cant_uni_ent,id_uni,nombre_uni_ent,cant_uni_sal,uni_id_uni,nombre_uni_sal,impreso,id_estatus_reg", "vista_material","id_mat","$consult");
$x->hideColumn('id_mat');
$x->hideColumn('id_fam');
$x->hideColumn('id_uni');
$x->hideColumn('uni_id_uni');
$x->hideColumn('id_estatus_reg');
$x->setColumnHeader('id_mat', 'id_mat');
$x->setColumnHeader('id_fam', 'id familia');
$x->setColumnHeader('codigo_mat', 'código del material');
$x->setColumnHeader('nombre_mat', 'nombre del material');
$x->setColumnHeader('cant_uni_ent', 'cantidad (entrada)');
$x->setColumnHeader('id_uni', 'ID uni. medida (entrada)');
$x->setColumnHeader('nombre_uni_ent', 'uni. medida (entrada)');
$x->setColumnHeader('cant_uni_sal', 'cantidad (salida)');
$x->setColumnHeader('uni_id_uni', 'ID uni. de medida (salida)');
$x->setColumnHeader('nombre_uni_sal', 'uni. de medida (salida)');
$x->setColumnHeader('impreso', 'para impresión');
$x->setColumnType('impreso', EyeDataGrid::TYPE_ARRAY, array('f' => 'No', 't' => 'Si'));
$x->setColumnHeader('id_estatus_reg', 'para impresión', 'ID del Estado del Registro');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_mat('%id_mat%')");

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
