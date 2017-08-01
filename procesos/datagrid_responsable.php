<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$consult=" status_res <> 'INTERNO' and id_estatus_reg = 1";
//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_persona,cedula,nombre,apellido,id_res,descrip_res,status_res,id_estatus_reg,id_tipo_res,nombre_tipo_res", "vista_responsable","id_persona","$consult");
$x->hideColumn('id_persona');
$x->hideColumn('id_res');
$x->hideColumn('id_tipo_res');
$x->hideColumn('status_res');
$x->hideColumn('descrip_res');
$x->hideColumn('id_estatus_reg');
$x->setColumnHeader('id_persona', _("ID Per."));
$x->setColumnHeader('id_res', _("ID Resp."));
$x->setColumnHeader('id_tipo_res', _("ID Tipo Resp."));
$x->setColumnHeader('cedula', _("Cédula"));
$x->setColumnHeader('nombre', _("Nombre(s)"));
$x->setColumnHeader('apellido',_("Apellido(s)"));
$x->setColumnHeader('status_res', 'Estatus');
$x->setColumnHeader('descrip_res', 'observación');
$x->setColumnHeader('id_estatus_reg', 'ID del Estado del Registro');
$x->setColumnHeader('nombre_tipo_res', 'Tipo de Responsable');

//para permitir filtros
$x->allowFilters();
//para ir contando las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_res('%id_persona%');");

//mostrar cantidad de registros personalizados
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
