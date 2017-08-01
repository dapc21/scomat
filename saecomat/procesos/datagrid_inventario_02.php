<?php

require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$valor= $_GET['id_dep'];
$valor=explode("==",$valor);
$id_dep=$valor[0];
$id_fam=$valor[1];
$tipo= $valor[2];
$donde= $valor[3];
$id_inv= $valor[4];
//crea la consulta SQL 
//campos, tabla, campo clave
//ECHO $donde;

$bus="status_fam='ACTIVO' and id_inv='$id_inv'";
$x->showCheckboxes();
	if($tipo=="1" && $id_dep!="0" && $id_fam!="0"){ 	
		$bus=$bus." AND id_dep='$id_dep' AND id_fam='$id_fam'";		
	}else 	if($tipo=="1" && $id_dep!="0"){ 	
		$bus=$bus." AND id_dep='$id_dep'";		
	}else 	if($tipo=="1" && $id_fam!="0"){ 	
		$bus=$bus." AND id_fam='$id_fam'";		
	}else{ 	
		//$bus=$bus." AND id_dep='A0000001'";		
		//$bus=$bus." AND id_dep='Asdff0001'";		
	}
		//$x->setQuery("id_mat,stock,stock as precio,abreviatura,nombre_mat,nombre_dep,nombre_fam,nombre_unidad","vista_materiales","id_mat",$bus."AND status_dep<>'INACTIVO'");
		//antiguo//$x->setQuery("c_uni_sal,id_mat,stock,stock as precio,abreviatura,nombre_mat,nombre_dep,nombre_fam,nombre_unidad","vista_materiales_unid","id_mat",$bus."AND status_dep<>'INACTIVO'");
		//nuevo//
		$x->setQuery("c_uni_sal,c_uni_ent,us_abre,id_mat,id_m,abreviatura,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock as stock_min,stock,stock_min as min","vista_materialesuniinv","id_mat",$bus);


$x->hideColumn('abreviatura');
$x->hideColumn('id_mat');
$x->hideColumn('numero_mat');
$x->hideColumn('id_m');
$x->hideColumn('nombre_dep');
$x->hideColumn('nombre_fam');
$x->hideColumn('c_uni_sal');
$x->hideColumn('c_uni_ent');
$x->hideColumn('nombre_unidad');
$x->hideColumn('us_abre');
//$x->hideColumn('stock_min');
$x->hideColumn('precio');



//$x->setColumnHeader('numero_mat',_("num"));

$x->setColumnHeader('stock',_("stock deposito"));
$x->setColumnHeader('us_abre',_("cant us_abre"));
$x->setColumnHeader('c_uni_ent',_("cant entrante"));
$x->setColumnHeader('c_uni_sal',_("cant saliente"));
$x->setColumnHeader('id_m',_("id_m"));
//$x->hideColumn('cant_ped');
$x->setColumnHeader('precio',_("can real"));
//$x->setColumnHeader('numero_mat', _("#mat"));
$x->setColumnHeader('nombre_mat', _("material"));
$x->setColumnHeader('stock_min',_("ajuste deposito"));
$x->setColumnHeader('min',_("justificacion inventario"));
$x->setColumnHeader('nombre_dep',_("deposito"));
$x->setColumnHeader('nombre_fam',_("familia"));
$x->setColumnHeader('nombre_unidad',_("medida"));

//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setClase("aprobar_inven");

//para permitir filtros
/*$x->setColumnType('%abreviatura%', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('%precio%', EyeDataGrid::TYPE_MONTO);*/
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





///////////////////////////////////////////////VALORES INICIALES DE LA TABLA INVENTARIO PARA VERIFICAR SU FUNCIONAMIENTO
/*require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("*", "inventario","id_inv","");
$x->hideColumn('dato');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@inventario','id_inv=@%id_inv%')");

//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarinventario('%idinventario%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarinventario('%idinventario%')");
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
