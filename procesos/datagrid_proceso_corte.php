<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$tipo=$_GET['tipo'];
$fecha=date("Y-m-d");
//crea la consulta SQL
//campos, tabla, campo clave
$fecha=date("Y-m-d");
list($ano,$mes)=explode("-",$fecha);
				$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $ano ));
				
				$fec_ini="$ano-$mes-01";
				$fec_fin="$ano-$mes-$ult_dia_mes";
				
$x->setQuery("id_proc,login_proc,fecha_proc,(select count(*) from abo_cortados where abo_cortados.id_proc=proceso_corte.id_proc) AS cant_cort,status_proc,obser_proc", "proceso_corte","id_proc"," fecha_proc between '$fec_ini' and '$fec_fin' ");
$x->hideColumn('id_proc');
$x->setColumnHeader('login_proc', 'Responsable');
$x->setColumnHeader('fecha_proc', 'Fecha');
$x->setColumnHeader('status_proc', 'status_proc');
$x->setColumnHeader('cant_cort', 'Cantidad');
$x->setColumnHeader('obser_proc', 'Observacion');


$x->setColumnType('fecha_asig', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);


//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@asigna_recibo','id_proc=@%id_proc%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarasigna_recibo('%id_proc%')");
//para activar el boton eliminar
*/
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminar_proceso_corte('%id_proc%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimir_proceso_corte('%id_proc%')");

$x->printTable();
?>
