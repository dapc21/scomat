<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_gt,nombre_grupo,fecha_creacion,id_zona,nro_tecnico,nro_sector,status_grupo,nombre_franq", "vista_grupo","id_gt","status_grupo='ACTIVO' $consult");
$x->hideColumn('id_gt');
$x->hideColumn('id_zona');
$x->hideColumn('status_grupo');
$x->hideColumn('nro_sector');
$x->setColumnHeader('nombre_grupo', _("Grupo"));
$x->setColumnHeader('fecha_creacion', _("Fecha Creación"));
$x->setColumnHeader('status_grupo', _("Estatus"));
$x->setColumnHeader('nro_tecnico', _("Técnicos"));
$x->setColumnHeader('id_zona', _("Organizado Por"));
$x->setColumnHeader('nro_sector', _("Sector"));
$x->setColumnHeader('nombre_franq','Franquicia');

$x->setColumnType('fecha_creacion', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros
$x->hideOrder();
//$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
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
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@grupo_trabajo','id_gt=@%id_gt%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "conexionPHP('validarExistencia.php','1=@grupo_trabajo','id_gt=@%id_gt%');window.location.replace('#');");
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminargrupo_trabajo('%id_gt%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimirGrupoTrabajo('%id_gt%');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificargrupo_trabajo('%id_gt%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminargrupo_trabajo('%id_gt%')");
*/
$x->printTable();
?>
