<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
$x->showCheckboxes();

//crea la consulta SQL 
//campos, tabla, campo clave
$bus="";
$valor= $_GET['id_dep'];
$stock_min= $_GET['stock_min'];
$valor=explode("==",$valor);
$id_dep=$valor[0];
$id_fam=$valor[1];
$tipo= $valor[2];
$id_prov= $valor[3]; 
if($id_prov!=""){$bus="$id_prov='$id_prov' ";}
//crea la consulta SQL 
//campos, tabla, campo clave
//$bus=$bus."id_dep='A0000001'  AND status_fam='ACTIVO'";
$bus=$bus."id_dep='$id_dep'  AND status_fam='ACTIVO'";
$x->showCheckboxes();
/*
	if($tipo=="1" && $id_dep!="0" && $id_fam!="0"){ 
		$bus=$bus." AND id_dep='$id_dep' AND id_fam='$id_fam'";
	}else 	if($tipo=="1" && $id_dep!="0"){ 
		$bus=$bus." AND id_dep='$id_dep'";
	}else 	if($tipo=="1" && $id_fam!="0"){ 
		$bus=$bus." AND id_fam='$id_fam'";
	}
	*/
	if($tipo=="1" && $id_fam!="0"){ 
		$bus=$bus." AND id_fam='$id_fam'";
	}
	if($tipo=="1" && $stock_min=="true"){ 
		$bus=$bus." AND stock <= (select stock_min from materiales where materiales.id_mat=vista_materiales.id_mat)";
	}


$x->setQuery("id_mat,c_uni_sal,stock_min,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock,stock_min as min","vista_materiales","id_mat",$bus);
//$x->setQuery("id_mat,stock_min,numero_mat,nombre_mat,stock,stock_min as min,nombre_dep,nombre_fam,nombre_unidad", "vista_materiales","id_mat","");
$x->hideColumn('id_mat');
$x->hideColumn('c_uni_sal');

$x->setColumnHeader('numero_mat', _("nro mat"));
$x->setColumnHeader('nombre_mat', _("nombre"));
$x->setColumnHeader('stock',_("stock"));
//$x->setColumnHeader('stock',_("stock"));
$x->setColumnHeader('stock_min',_("cantidad"));
$x->setColumnHeader('min',_("stock min"));
$x->setColumnHeader('nombre_dep',_("deposito"));
$x->setColumnHeader('nombre_fam',_("familia"));
$x->setColumnHeader('nombre_unidad',_("medida"));

//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setClase("pedido");

//para permitir filtros

$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@materiales','id_mat=@%id_mat%')");
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
