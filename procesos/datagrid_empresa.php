<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$x->setQuery("id_emp,rif_emp,razon_social_emp,nombre_comercial_emp,telefono_emp,direccion_emp", "empresa","id_emp","");
$x->hideColumn('dato');
$x->hideColumn('id_emp');
$x->setColumnHeader('id_emp', 'id_emp');
$x->setColumnHeader('rif_emp', 'rif');
$x->setColumnHeader('razon_social_emp', 'razon social');
$x->setColumnHeader('nombre_comercial_emp', 'nombre comercial');
$x->setColumnHeader('telefono_emp', 'telefonos');
$x->setColumnHeader('correo_emp', 'correo');
$x->setColumnHeader('logo_emp', 'logo');
$x->setColumnHeader('infor_adic_emp', 'informacion adicional');
$x->setColumnHeader('direccion_emp', 'direccion');
$x->setColumnHeader('obsrv_emp', 'observacion');
$x->setColumnHeader('dato', 'dato');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

$x->addRowSelect("buscar_id_emp('%id_emp%');window.location.replace('#');");

//mostrar cantidad de registros personalizados
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
