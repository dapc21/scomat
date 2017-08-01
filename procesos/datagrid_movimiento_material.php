<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$idMov = $_GET["idMov"];
$consult=" id_estatus_reg = 1 and id_mov='$idMov'";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_mov_mat,id_stock,id_res,id_tipo_mov,id_mat,id_alm_mov,id_gt,id_enc,ref_mov,mot_mov,nombre_tipo_mov,cant_mov_mat,nombre_uni_sal,nombre_uni_ent,nombre_mat,stock,stock_min,nombre_alm,codigo_mat,desc_mov_mat", "vista_movimiento_material","id_mov_mat","$consult");
$x->hideColumn('id_mov_mat');
$x->hideColumn('id_stock');
$x->hideColumn('id_res');
$x->hideColumn('id_tipo_mov');
$x->hideColumn('id_mat');
$x->hideColumn('id_alm_mov');
$x->hideColumn('id_gt');
$x->hideColumn('id_enc');
$x->hideColumn('ref_mov');
$x->hideColumn('mot_mov');
$x->hideColumn('cant_mov_mat');
$x->hideColumn('nombre_uni_sal');
$x->hideColumn('nombre_mat');
$x->hideColumn('nombre_uni_ent');
$x->hideColumn('nombre_tipo_mov');
$x->hideColumn('nombre_alm');
$x->hideColumn('codigo_mat');
$x->hideColumn('stock_min');
$x->hideColumn('stock');
$x->setColumnHeader('id_mov_mat', 'id Mov. Mat.');
$x->setColumnHeader('id_stock', 'id stock');
$x->setColumnHeader('id_res', 'id resp.');
$x->setColumnHeader('id_tipo_mov', 'id Tipo Mov.');
$x->setColumnHeader('id_mat', 'id material');
$x->setColumnHeader('id_alm_mov', 'id almacén');
$x->setColumnHeader('id_mot_mov', 'id Mot. Mov.');
$x->setColumnHeader('id_gt', 'id grupo');
$x->setColumnHeader('id_enc', 'id encargado');
$x->setColumnHeader('ref_mov', 'Referencia');
$x->setColumnHeader('mot_mov', 'Motivo del Movimiento');
$x->setColumnHeader('cant_mov_mat', 'Cantidad');
$x->setColumnHeader('nombre_uni_sal', 'Uni. de Medida');
$x->setColumnHeader('nombre_mat', 'material');
$x->setColumnHeader('stock', 'stock');
$x->setColumnHeader('stock_min', 'stock min.');
$x->setColumnHeader('nombre_uni_ent', 'Unidad de Medida Ent.');
$x->setColumnHeader('nombre_tipo_mov', 'Tipo');
$x->setColumnHeader('nombre_alm', 'almacén');
$x->setColumnHeader('codigo_mat', 'cod. material');
$x->setColumnHeader('desc_mov_mat', 'Descripción');

//para permitir filtros
$x->allowFilters();
$x->hideFooter(true);
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
//$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

//$x->addRowSelect("buscar_id_mov_mat('%id_mov_mat%')");

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
