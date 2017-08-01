<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$idInv = $_GET["idInv"];
$consult=" id_estatus_reg = 1 and id_inv='$idInv'";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_inv_mat,id_stock,id_inv,cant_sist,cant_real,nombre_uni_sal,nombre_mat", "vista_inventario_material","id_inv_mat","$consult");
$x->hideColumn('id_inv_mat');
$x->hideColumn('id_stock');
$x->hideColumn('id_inv');
$x->hideColumn('cant_real');
$x->setColumnHeader('id_inv_mat', 'id_inv_mat');
$x->setColumnHeader('id_stock', 'id_stock');
$x->setColumnHeader('id_inv', 'id_inv');
$x->setColumnHeader('cant_sist', 'Cantidad Sistema');
$x->setColumnHeader('cant_real', 'Cantidad Real');
$x->setColumnHeader('nombre_uni_sal', 'Uni. de Medida');
$x->setColumnHeader('nombre_mat', 'Material');

//para permitir filtros
$x->allowFilters();
$x->hideFooter(true);
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
//$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

//$x->addRowSelect("buscar_id_inv_mat('%id_inv_mat%')");

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