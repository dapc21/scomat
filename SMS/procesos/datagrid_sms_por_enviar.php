<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$status_sinc=$_GET['status_sinc'];
$sql="";
if($status_sinc!=""){
	$sql="status_sinc='$status_sinc'";
}
$x->setQuery("id_sinc,telefono_sinc,mensaje_sinc", "sms_sinc","id_sinc","$sql");
$x->hideColumn('id_sinc');
$x->setColumnHeader('mensaje_sinc', _("mensaje_sinc"));
$x->setColumnHeader('telefono_sinc', _("telefono_sinc"));

$x->setColumnHeader('mensaje_sms', _("mensaje"));

$x->setColumnType('fecha_sms', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminar_sms_enviar('%id_sinc%')");
$x->allowFilters();
//para ir contanfo las filas
$x->showCheckboxes();
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
//$x->addCustomControl(EyeDataGrid::CUSCTRL_TEXT, "alert('%nombre_caja%\'s been promoted!')", EyeDataGrid::TYPE_ONCLICK, 'Promote Me');
//$x->addRowSelect("conexionPHP_sms('validarExistencia.php','1=@caja','id_caja=@%id_caja%')");

//para que activar el boton modificar
//$x->addStandardControl(EyeDataGrid::STDCTRL_ASIG, "modificarcaja('%pago_comisiones%')");
//para activar el boton eliminar


$x->printTable();
?>
