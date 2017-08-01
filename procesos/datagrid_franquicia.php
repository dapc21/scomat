<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_franq,serie,nombre_franq,nombre_gf,razon_social_emp,direccion_franq", "vista_franq","id_franq","");
$x->hideColumn('id_franq');
$x->setColumnHeader('serie', _("serie"));
$x->setColumnHeader('nombre_franq', _("Franquicia"));
$x->setColumnHeader('nombre_gf', _("Grupo"));
$x->setColumnHeader('razon_social_emp', _("Razon Social"));
$x->setColumnHeader('direccion_franq', 'Direccion');

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
$x->addRowSelect("buscar_id_franq('%id_franq%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarfranquicia('%id_franq%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarfranquicia('%id_franq%')");
*/
$x->printTable();
?>
