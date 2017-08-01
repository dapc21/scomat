<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_serv,nombre_servicio,tarifa_ser,tipo_servicio,tipo_costo,status_serv,tipo_paq,tipo_serv,tarifa_esp,nombre_paq,cantidad", "vista_servicios","id_serv","");
$x->hideColumn('id_serv');
$x->setColumnHeader('nombre_servicio', _("Nombre del Servicio"));
$x->setColumnHeader('status_serv', _("Estatus"));
$x->setColumnHeader('tipo_costo', _("Tipo de Costo"));
$x->setColumnHeader('tipo_servicio', _("Tipo de Servicio"));
$x->setColumnHeader('tipo_paq', _("Tipo de Paquete"));
$x->setColumnHeader('nombre_franq',  _("Franquicia"));
$x->setColumnHeader('tipo_serv',  _("Clasif."));
$x->setColumnHeader('tarifa_esp',  _("Tarifa esp."));
$x->setColumnHeader('cantidad',  _("tv"));
$x->setColumnHeader('nombre_paq',  _("paquete"));
$x->setColumnHeader('tarifa_ser',  _("tarifa"));

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
$x->addRowSelect("buscar_id_serv('%id_serv%');window.location.replace('#');window.location.replace('#');");
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@servicios','id_serv=@%id_serv%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarservicios('%id_serv%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarservicios('%id_serv%')");
*/
$x->printTable();
?>
