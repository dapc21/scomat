<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_mat=$_GET['id_mat'];
if($id_mat!=""){
$where=" and id_mat='$id_mat'";
}
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_ent_sal,numero_mat,nombre_mat,cant_existencia,cant_ent_sal,fecha_ent_sal,tipo_ent_sal", "vista_materiales","id_ent_sal","tipo_ent_sal='ENTRADA' $where");
$x->hideColumn('id_ent_sal');
$x->setColumnHeader('numero_mat','Nro Material');
$x->setColumnHeader('nombre_mat','Nombre');
$x->setColumnHeader('cant_existencia','Stock');
$x->setColumnHeader('tipo_ent_sal','Tipo');
$x->setColumnHeader('fecha_ent_sal','Fecha');
$x->setColumnHeader('cant_ent_sal','Cant. Ent-Sal');
$x->setColumnHeader('','');

$x->setColumnType('fecha_ent_sal', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(100);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@vista_materiales','id_ent_sal=@%id_ent_sal%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarent_sal_mat('%observacion%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarent_sal_mat('%observacion%')");
*/
$x->printTable();
?>
