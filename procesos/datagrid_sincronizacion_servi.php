<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_sinc,nombre_servidor,fecha_sinc,hora_sin,(oid_final-oid_inicial+1) AS paquetes", "sincronizacion_servi,servidor","id_sinc","sincronizacion_servi.id_servidor=servidor.id_servidor and status_servidor<>'LOCAL' and status_sinc='ACTIVO'");
$x->hideColumn('id_sinc');
$x->setColumnHeader('nombre_servidor', 'Servidor');
$x->setColumnHeader('fecha_sinc', 'Fecha');
$x->setColumnHeader('hora_sin', 'Hora Sinc.');
$x->setColumnHeader('paquetes', 'Paquetes');
$x->setColumnHeader('', '');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@sincronizacion_servi','id_sinc=@%id_sinc%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarsincronizacion_servi('%id_sinc%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarsincronizacion_servi('%id_sinc%')");
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
