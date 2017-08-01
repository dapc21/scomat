<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" id_franq='$id_f'";
	}

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_sector,nro_sector,nombre_sector,nombre_zona,nombre_ciudad,nombre_mun,nombre_esta,nombre_franq", "vista_sector1","id_sector","$consult");
$x->hideColumn('id_sector');
$x->setColumnHeader('nro_sector', _("Hogares"));
$x->setColumnHeader('nombre_sector', _("Sector"));
$x->setColumnHeader('nombre_zona', _("zona"));
$x->setColumnHeader('nombre_ciudad','Ciudad');
$x->setColumnHeader('nombre_mun','Municipio');
$x->setColumnHeader('nombre_esta','Estado');
$x->setColumnHeader('nombre_franq','Franquicia');
$x->setColumnHeader('','');

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

/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarsector('%id_sector%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarsector('%id_sector%')");
*/

//llama al evento al darle click a la fila
$x->addRowSelect("buscar_id_sector('%id_sector%');window.location.replace('#');");


$x->printTable();
//echo "ddhola";
?>
