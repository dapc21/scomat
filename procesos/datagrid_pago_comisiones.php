<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_comi,nombre,apellido,fecha_comi,fecha_desde,fecha_hasta,porcent_aplic,monto_comi,status_comi", "vista_comisiones","id_comi","");
$x->hideColumn('id_comi');
$x->setColumnHeader('nombre', _("nombre"));
$x->setColumnHeader('apellido', _("apellido"));
$x->setColumnHeader('fecha_comi', _("fecha"));
$x->setColumnHeader('fecha_desde', _("desde"));
$x->setColumnHeader('fecha_hasta', _("hasta"));
$x->setColumnHeader('porcent_aplic', _("porcentaje"));
$x->setColumnHeader('monto_comi', _("monto"));
$x->setColumnHeader('status_comi', _("status"));

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

$x->setColumnType('fecha_comi', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setColumnType('fecha_desde', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setColumnType('fecha_hasta', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@pago_comisiones','id_comi=@%id_comi%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarpago_comisiones('%id_comi%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarpago_comisiones('%id_comi%')");
*/
$x->printTable();
?>
