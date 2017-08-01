<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_banco,banco,tipo_banco", "banco","id_banco","");
$x->hideColumn('id_banco');
$x->setColumnHeader('banco',_("Banco"));
$x->setColumnHeader('tipo_banco',' Tipo de Banco');

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
$x->addRowSelect("buscar_id_banco('%id_banco%');window.location.replace('#');");
//$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "buscar_id_banco('%id_banco%')");

$x->printTable();
?>
