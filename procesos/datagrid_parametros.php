<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_param,id_franq,parametro,valor_param,obser_param", "parametros","id_param","");
//$x->hideColumn('id_param');
$x->setColumnHeader('id_param', _("Nº"));
$x->setColumnHeader('parametro', _("Parámetro"));
$x->setColumnHeader('valor_param', _("Valor"));
$x->setColumnHeader('obser_param', _("Observación"));
$x->setColumnHeader('id_franq', _("Franquicia"));

if(!isset($_GET['order'])){
	$x->setOrder('id_param', 'ORDER_ASC');
}

$x->setColumnType('fecha_param', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas

//mostrar resultados por pagina
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

//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_param('%id_param%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarparametros('%id_param%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarparametros('%id_param%')");
*/
$x->printTable();
?>
