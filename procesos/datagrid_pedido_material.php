<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$idPed = $_GET["idPed"];
$consult = " id_estatus_reg = 1 and id_ped='$idPed'";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_ped_mat,id_stock,id_ped,cant_ped_mat,nombre_uni_sal,nombre_mat,nombre_alm", "vista_pedido_material","id_ped_mat","$consult");
$x->hideColumn('id_ped_mat');
$x->hideColumn('id_stock');
$x->hideColumn('id_ped');
$x->setColumnHeader('id_ped_mat', 'id_ped_mat');
$x->setColumnHeader('id_stock', 'id_stock');
$x->setColumnHeader('id_ped', 'id_ped');
$x->setColumnHeader('cant_ped_mat', 'Cantidad Solicitada');
$x->setColumnHeader('nombre_uni_sal', 'Uni. de Medida');
$x->setColumnHeader('nombre_mat', 'Material');
$x->setColumnHeader('nombre_alm', 'Almacén');

//para permitir filtros
$x->allowFilters();
$x->hideFooter(true);
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
//$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

//$x->addRowSelect("buscar_id_ped_mat('%id_ped_mat%')");

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
