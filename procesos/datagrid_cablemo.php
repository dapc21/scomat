<?php
require_once("../procesos.php"); 
$ini_u = $_SESSION["ini_u"]; 


 $acceso->objeto->ejecutarSql("select *from cablemodem  where (id_cm ILIKE '$ini_u%') ORDER BY id_cm desc LIMIT 1 offset 0"); 
 $id_cm = $ini_u.verCoo($acceso,"id_cm");
 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

//crea la consulta SQL 
//campos, tabla, campo clave
$id_contrato=$_GET['id_contrato'];
$x->setQuery("id_cm,codigo_cm,marca_cm,modelo_cm,status_cm", "cablemodem","id_cm","id_contrato='$id_contrato' ");
$x->hideColumn('id_cm');
$x->setColumnHeader('codigo_cm', "Codigo");
$x->setColumnHeader('marca_cm', "Marca");
$x->setColumnHeader('modelo_cm', "Modelo");
$x->setColumnHeader('tipo_cm', "Tipo");
$x->setColumnHeader('status_cm', "Status");


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
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@contrato_servicio','id_cont_serv=@%id_cont_serv%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "conexionPHP('validarExistencia.php','1=@cablemodem','id_cm=@%id_cm%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcablemodem('%id_cm%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarcontrato_servicio('%id_cont_serv%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcontrato_servicio('%id_cont_serv%')");
*/
$x->hideFooter(true);
$x->printTable();
	
if($modo!='EXCEL'){
echo '<input  type="hidden" name="id_cm" maxlength="8" size="30"onChange="validarciudad()" value="'.$id_cm.'">';
}
?>
