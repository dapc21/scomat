<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
//$x->showCheckboxes();

//crea la consulta SQL 
//campos, tabla, campo clave
$referencia= $_GET['referencia'];
$valor= $_GET['id_dep'];
$valor=explode("==",$valor);
$id_dep=$valor[0];
$id_mov=$valor[1];
/*$nom=$valor[2];
$num=$valor[3];
$tipo= $valor[4];*/
//crea la consulta SQL 
//campos, tabla, campo clave
//$x->showCheckboxes();
$bus="";


if($id_dep!=''  && $id_dep!="0" ){
	$bus=$bus."id_dep='$id_dep' ";
}else {
	$bus=$bus."id_dep='AMALOJAJA'";
}
if($id_mov!='' ){
//	if($bus){$bus=$bus." and ";}
	$bus=" id_mov='$id_mov' ";
}
/*
if($referencia!='' && $id_dep!="0"){
	$bus="id_dep='$id_dep' and referencia='$referencia'";
}
*/

		//$x->setQuery("id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock,stock_min as min,stock_min","vista_materiales","id_mat",$bus);
		$x->setQuery("c_uni_sal,c_uni_ent,abreviatura,us_abre,id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock_min,cant_mov as stock,stock_min as min","vista_movimiento_mov_mat_uni","id_mat",$bus);
		//$x->setQuery("c_uni_sal,id_mat,stock,stock as precio,abreviatura,nombre_mat,nombre_dep,nombre_fam,nombre_unidad","vista_materiales_unid","id_mat",$bus);


//$x->setQuery("id_mat,stock_min,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock", "vista_materiales","id_mat","");
$x->hideColumn('id_mat');
$x->hideColumn('numero_mat');
$x->hideColumn('id_m');
$x->hideColumn('c_uni_sal');
$x->hideColumn('c_uni_ent');
$x->hideColumn('nombre_unidad');
$x->hideColumn('abreviatura');
$x->hideColumn('us_abre');
$x->hideColumn('nombre_fam');
$x->hideColumn('nombre_dep');
$x->hideColumn('stock_min');

$x->setClase("movimiento");
//$x->setColumnHeader('numero_mat',_("num"));
$x->setColumnHeader('nombre_mat',_("nombre"));
$x->setColumnHeader('nombre_dep',_("deposito"));
$x->setColumnHeader('nombre_fam',_("familia"));
$x->setColumnHeader('nombre_unidad',_("medida"));
$x->setColumnHeader('nombre_mat', _("nombre"));
$x->setColumnHeader('stock',_("cantidad"));
$x->setColumnHeader('min',_("stock min"));
//$x->setColumnHeader('stock_min',_("cantidad"));
$x->setColumnHeader('abreviatura',_("abreviatura "));
$x->setColumnHeader('us_abre',_("cant us_abre"));
$x->setColumnHeader('c_uni_ent',_("cant entrante"));
$x->setColumnHeader('c_uni_sal',_("cant saliente"));
$x->setColumnHeader('id_m',_("id_m"));

//$x->setColumnHeader('nombre Columna', 'Titulo Columna');


//para permitir filtros

$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
//$x->addRowSelect("valida_mov_mta_new('%id_mat%')");

//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "valida_mov_mta_new02('%id_mat%');mod_mov_mat()");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminar_mov_mta_new('%id_mat%','%id_m%')");



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
