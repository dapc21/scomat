<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_confc,nombre_franq, fecha_confc, porc_acord, descuento_conf,tipo_e_p ,empresa_confc ,represen_confc  ", "vista_confcomision","id_confc","");
$x->hideColumn('id_confc');
$x->setColumnHeader('nombre_franq', 'Franquicia');
$x->setColumnHeader('fecha_confc', 'fecha');
$x->setColumnHeader('porc_acord', 'porcentaje');
$x->setColumnHeader('descuento_conf', 'descuento');
$x->setColumnHeader('tipo_e_p', 'tipo');
$x->setColumnHeader('empresa_confc', 'empresa');
$x->setColumnHeader('represen_confc', 'representante');
$x->setColumnHeader('', '');
$x->setColumnType('fecha_confc', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('porc_acord', EyeDataGrid::TYPE_PERCENT);

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@conf_comision','id_confc=@%id_confc%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarconf_comision('%id_confc%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarconf_comision('%id_confc%')");
*/
$x->printTable();
?>
