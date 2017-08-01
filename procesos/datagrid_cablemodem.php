<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

//crea la consulta SQL 
//campos, tabla, campo clave
$status_cm=$_GET['status'];
$filtro=$_GET['filter'];
$x->filter=false;

$where= "id_cm<>''";

if($status_cm!=''){
	$where= $where." and status_cm='$status_cm'";
}


if($filtro!=''){
	$valor=explode(":",$filtro);
	$fil=trim($valor[0]);
	$nro_contrato=$valor[1];
	if($fil=="nro_contrato"){
		$where =$where." and (select nro_contrato from  contrato where contrato.id_contrato=cablemodem.id_contrato) ilike '%$nro_contrato%'";
	}else{
		$where =$where." and $fil ilike '%$nro_contrato%'";
	}
}
  
$x->setQuery("
id_cm, codigo_cm,nota3,status_cm,(select nro_contrato from  contrato where contrato.id_contrato=cablemodem.id_contrato) as nro_contrato,marca_cm,modelo_cm", "cablemodem","id_cm"," $where");
$x->hideColumn('id_cm');

$x->hideColumn('prov_cm');
$x->hideColumn('fecha_act_cm');
$x->hideColumn('id_contrato');

$x->setColumnHeader('marca_cm','marca');
$x->setColumnHeader('modelo_cm','modelo');
$x->setColumnHeader('codigo_cm','MAC');
$x->setColumnHeader('nota3','direccion IP');
$x->setColumnHeader('nota1','Ubicacion');
$x->setColumnHeader('nota2','estado fisico');
$x->setColumnHeader('status_cm','status');


//$x->setColumnHeader('','');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@cablemodem','id_cm=@%id_cm%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarcablemodem('%id_cm%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcablemodem('%id_cm%')");
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
