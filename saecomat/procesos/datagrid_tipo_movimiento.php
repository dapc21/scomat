<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_tm,nombre_tm,tipo_ent_sal,uso_tm,status_tm", "tipo_movimiento","id_tm","status_tm<>'INTERNO'");
$x->hideColumn('dato');
$x->hideColumn('id_tm');
$x->setColumnHeader('nombre_tm', _('nombre'));
$x->setColumnHeader('tipo_ent_sal', _('tipo'));
$x->setColumnHeader('uso_tm', _('uso'));
$x->hideColumn('status_tm');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP_mat('validarExistencia.php','1=@tipo_movimiento','id_tm=@%id_tm%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificartipo_movimiento('%id_tm%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminartipo_movimiento('%id_tm%')");
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
