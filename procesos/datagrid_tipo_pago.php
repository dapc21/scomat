<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("*", "tipo_pago","id_tipo_pago","");
$x->hideColumn('id_tipo_pago');
$x->setColumnHeader('tipo_pago', _("Tipo de Pago"));
$x->setColumnHeader('status_pago', _("Estatus"));
$x->setColumnHeader('abrev_tp', _("Abreviatura"));

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

//$x->addRowSelect("buscar_id_tipo_pago('%id_tipo_pago%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "buscar_id_tipo_pago('%id_tipo_pago%')");
$x->printTable();
?>
