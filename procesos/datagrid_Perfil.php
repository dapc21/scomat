<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("codigoperfil,nombreperfil,statusperfil","perfil","","");
$x->setColumnHeader("codigoperfil", _("Código"));
$x->setColumnHeader("nombreperfil", _("Nombre del Perfil"));
$x->setColumnHeader("statusperfil", _("Estatus perfil"));

//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@perfil','codigoperfil=@%codigoperfil%');conexionPHP('informacion.php','TraerModulo','%codigoperfil%');");


$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "conexionPHP('validarExistencia.php','1=@perfil','codigoperfil=@%codigoperfil%');conexionPHP('informacion.php','TraerModulo','%codigoperfil%');window.location.replace('#');");
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "conexionPHP('informacion.php','TraerModulo','%codigoperfil%');window.location.replace('#');");
//para activar el boton eliminar
//$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarpromocion('%id_promo%')");


//$x->hideOrder();
$x->allowFilters();
//$x->showRowNumber();

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

$x->printTable();
?>
