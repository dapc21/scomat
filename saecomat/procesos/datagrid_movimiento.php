<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
//$x->showCheckboxes();

//crea la consulta SQL 
//campos, tabla, campo clave
$valor= $_GET['id_dep'];
$valor=explode("==",$valor);
$id_dep=$valor[0];
$id_fam=$valor[1];
$nom=$valor[2];
$num=$valor[3];
$tipo= $valor[4];
//crea la consulta SQL 
//campos, tabla, campo clave
//$x->showCheckboxes();
$bus="status_fam='ACTIVO' AND status_dep<>'INACTIVO'";


if($id_dep  && $id_dep!="0" ){
	$bus=$bus." and id_dep='$id_dep' ";
}else {
	$bus=$bus." AND id_dep='AMALOJAJA'";
}
if($id_fam  && $id_fam!="0" ){
	$bus=$bus." and id_fam='$id_fam' ";
}
if($nom  && $nom!="0" ){
	$bus=$bus." and nombre_mat like '%$nom%' ";
}
if($num){
	$bus=$bus." and numero_mat='$num' ";
}

	/*if($tipo=="1" && $id_dep!="0" && $id_fam!="0"){ 	
		$bus=$bus." AND id_dep='$id_dep' AND id_fam='$id_fam'";		
	}else 	if($tipo=="1" && $id_dep!="0"){ 	
		$bus=$bus." AND id_dep='$id_dep'";		
	}else 	if($tipo=="1" && $id_fam!="0"){ 	
		$bus=$bus." AND id_fam='$id_fam' AND id_dep='AMALOJAJA'";		
	}else{ 	
		//$bus=$bus." AND id_dep='A0000001'";		
		$bus=$bus." AND id_dep='AMALOJAJA'";		
	}*/
		//$x->setQuery("id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock,stock_min as min,stock_min","vista_materiales","id_mat",$bus);
		$x->setQuery("c_uni_sal,c_uni_ent,abreviatura,us_abre,id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock_min,stock,stock_min as min","vista_materiales_unid","id_mat",$bus);
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
$x->setColumnHeader('nombre_mat',_("Nombre"));
$x->setColumnHeader('nombre_dep',_("Depósito"));
$x->setColumnHeader('nombre_fam',_("Familia"));
$x->setColumnHeader('nombre_unidad',_("Medida"));
$x->setColumnHeader('stock',_("Stock deposito"));
$x->setColumnHeader('min',_("Stock Min"));
$x->setColumnHeader('abreviatura',_("Abrev."));
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
$x->addRowSelect("valida_mov_mta_new('%id_mat%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmateriales('%id_mat%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmateriales('%id_mat%')");*/



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
