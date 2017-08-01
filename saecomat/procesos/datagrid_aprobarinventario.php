<?php


require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
//$x->showCheckboxes();
/*inventario
(
  id_inv character(8) NOT NULL,
  id_motivo character(5),
  fecha_inv date,
  hora_inv time without time zone,
  obser_inv character varying(1000),
  tipo_inv character(15),
  id_dep character(8),
  id_fam character(5),
  status_inv character(20),
  CONSTRAINT pk_inventario P*/
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_inv,id_motivo,num_inv,fecha_inv,status_inv,nombre_dep", "inventario,deposito","id_inv","inventario.id_dep=deposito.id_dep and status_inv<>'AJUSTADO'");
//$x->hideColumn('id_dep');
$x->hideColumn('id_inv');

$x->setColumnHeader('id_inv', _("Inventario"));
$x->setColumnHeader('id_motivo', _("Motivo"));
$x->setColumnHeader('num_inv', _("Inventario"));
$x->setColumnHeader('fecha_inv',_("Fecha Inv"));
$x->setColumnHeader('status_inv', _("Estatus"));
$x->setColumnHeader('nombre_dep', _("Depósito"));

//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setClase("aprobarinventario");

$x->setColumnType('fecha_inv', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros

$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
//
$x->addRowSelect("cargarDatosInventario('%id_inv%','%id_dep%','%id_fam%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmateriales('%id_mat%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmateriales('%id_mat%')");*/







/*
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("*", "aprobarinventario","campoClave","");
$x->hideColumn('dato');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@aprobarinventario','campoClave=@%campoClave%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificaraprobarinventario('%campoClave%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminaraprobarinventario('%campoClave%')");
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
