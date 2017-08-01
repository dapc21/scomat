<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_m,id_mat,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock,stock_min,impresion,observacion", "vista_materiales","","id_dep<>'A0000001' ");
$x->hideColumn('id_m');
$x->hideColumn('id_mat');
$x->hideColumn('id_dep');
$x->setColumnHeader('numero_mat',_("Nº"));
$x->setColumnHeader('nombre_mat',_("Nombre"));
$x->setColumnHeader('nombre_dep',_("Depósito"));
$x->setColumnHeader('nombre_fam',_("Familia"));
$x->setColumnHeader('nombre_unidad',_("Medida"));
$x->setColumnHeader('stock',_("Stock"));
$x->setColumnHeader('stock_min',_("Min"));
$x->setColumnHeader('observacion',_("Observación"));
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
$x->setColumnType('impresion', EyeDataGrid::TYPE_CUSTOM, '');
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@vista_materiales','id_mat=@%id_mat%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmateriales('%id_mat%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmateriales('%id_mat%')");
*/

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
