<?php
require_once("../procesos.php"); 
$ini_u = $_SESSION["ini_u"]; 
//echo ":::$ini_u:";
 $acceso->objeto->ejecutarSql("select *from deco_ana  where (id_da ILIKE '$ini_u%') ORDER BY id_da desc LIMIT 1 offset 0"); 
 $id_da = $ini_u.verCoo($acceso,"id_da");
 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$id_contrato=$_GET['id_contrato'];
$x->setQuery("id_da,punto_da,codigo_da,nota2,marca_da,modelo_da,tipo_da,servicio,status_da,servicio,obser_da", "deco_ana","id_da","id_contrato='$id_contrato' and id_contrato<>'' ");
$x->hideColumn('id_da');
$x->setColumnHeader('codigo_da', "Codigo");
$x->setColumnHeader('nota2', "Codigo2");
$x->setColumnHeader('marca_da', "Marca");
$x->setColumnHeader('modelo_da', "Modelo");
$x->setColumnHeader('tipo_da', "Tipo");
$x->setColumnHeader('status_da', "Status");
$x->setColumnHeader('servicio', "Servicios");
$x->setColumnHeader('obser_da','obserVACION');
$x->setColumnHeader('punto_da','CODIFICACION');

$x->setColumnType('status_da', EyeDataGrid::TYPE_CUSTOM);
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
		if(trim($row["valor_param"])>0){
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@contrato_servicio','id_cont_serv=@%id_cont_serv%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "conexionPHP('validarExistencia.php','1=@deco_ana','id_da=@%id_da%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminardeco_ana('%id_da%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "resetear_deco('%codigo_da%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarcontrato_servicio('%id_cont_serv%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcontrato_servicio('%id_cont_serv%')");
*/
$x->hideFooter(true);
$x->printTable();

echo '<input  type="hidden" name="id_da" maxlength="8" size="30"onChange="validarciudad()" value="'.$id_da.'">';
?>
