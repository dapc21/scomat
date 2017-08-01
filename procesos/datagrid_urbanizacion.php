<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" id_franq='$id_f'";
	}

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_urb,nombre_urb,nombre_sector,nombre_zona,nombre_ciudad,nombre_mun,nombre_esta", "vista_urb","id_urb","$consult");
$x->hideColumn('id_urb');

$x->setColumnHeader('nro_calle', _("Nº Calle"));
$x->setColumnHeader('nombre_urb', _("Urbanización"));
$x->setColumnHeader('nombre_sector', _("Sector"));
$x->setColumnHeader('nombre_zona', _("Zona"));
$x->setColumnHeader('nombre_ciudad','Ciudad');
$x->setColumnHeader('nombre_mun','Municipio');
$x->setColumnHeader('nombre_esta','Estado');
$x->setColumnHeader('nombre_franq','Franquicia');

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
$x->addRowSelect("buscar_id_urb('%id_urb%');window.location.replace('#');");

/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarcalle('%id_urb%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcalle('%id_urb%')");
*/
$x->printTable();
?>
