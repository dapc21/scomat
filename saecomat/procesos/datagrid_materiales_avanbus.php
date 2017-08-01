<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
//$id_dep=$_GET["id_dep"];
//crea la consulta SQL 
//campos, tabla, campo clave
//echo $id_dep;

$valor= $_GET['id_dep'];//'id_dep','id_fam','id_unidad','uni_id_unidad','numero_mat','nombre_mat'
$valor=explode("==",$valor);
$id_dep=$valor[0];
$id_fam=$valor[1];
$id_unidad= $valor[2];
$uni_id_unidad= $valor[3];
$numero_mat= $valor[4];
$nombre_mat= $valor[5];
//crea la consulta SQL 
//campos, tabla, campo clave
$x->showCheckboxes();
$bus="";
	/*if($id_dep && $id_dep!="0"){ 	
		$bus=$bus."id_dep='$id_dep'";		
	}*/
	if($id_fam && $id_fam!="0"){ 	
		//if($bus!=""){$bus=$bus." and ";	}
		$bus=$bus."id_fam='$id_fam'";	
	}
	if($id_unidad && $id_unidad!="0"){ 	
		if($bus!=""){$bus=$bus." and ";	}	
		$bus=$bus."id_unidad='$id_unidad'";			
	}
	if($uni_id_unidad && $uni_id_unidad!="0"){ 	
		if($bus!=""){$bus=$bus." and ";	}	
		$bus=$bus."us_id='$uni_id_unidad'";		
	}
	if($numero_mat){
		if($bus!=""){$bus=$bus." and ";	}	
		$bus=$bus."numero_mat='$numero_mat' ";	
	}
	if($nombre_mat){ 	
		if($bus!=""){$bus=$bus." and ";	}	
		$bus=$bus."nombre_mat LIKE '%$nombre_mat%' ";	
	}
	//echo $bus;


$x->setQuery("id_m,numero_mat,nombre_mat,nombre_fam,nombre_unidad,us_nombre", "vista_matpadre_und","id_m",$bus);
$x->hideColumn('id_m');
$x->hideColumn('id_mat');
$x->hideColumn('id_dep');
$x->setColumnHeader('numero_mat',_("num"));
$x->setColumnHeader('nombre_mat',_("nombre"));
$x->setColumnHeader('nombre_fam',_("familia"));
$x->setColumnHeader('nombre_unidad',_("entrante"));
$x->setColumnHeader('us_nombre',_("saliente"));
//$x->setColumnHeader('stock_min',_("min"));
//$x->setColumnHeader('observacion',_("observacion"));
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');

//para permitir filtros
//$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(2000);
//llama al evento al darle click a la fila

$x->addRowSelect("valida_mat_t('%id_m%')");
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@vista_materiales','id_m=@%id_m%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmateriales('%id_mat%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmateriales('%id_mat%')");
*/
/*
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
*/
$x->printTable();
?>
