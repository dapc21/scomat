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
$status=$_GET['status'];
$where="";
if($status!='TODOS'){
	$where= "status_da='$status'";
}
$x->setQuery("id_da,punto_da,codigo_da,nota2,(select nro_contrato from contrato where deco_ana.id_contrato=contrato.id_contrato limit 1 ) as nro_contrato,tipo_da,prov_da,status_da,obser_da", "deco_ana","id_da","$where");
$x->hideColumn('id_da');
$x->setColumnHeader('codigo_da','CODIGO');
$x->setColumnHeader('nota2', "Codigo2");
$x->setColumnHeader('nro_contrato','nro contrato');
$x->setColumnHeader('punto_da','CODIFICACION');
$x->setColumnHeader('tipo_da','tipo');
$x->setColumnHeader('prov_da','ESTADO FISICO');
$x->setColumnHeader('status_da','status');
$x->setColumnHeader('obser_da','obserVACION');
$x->setColumnHeader('','');

$x->setColumnType('status_da', EyeDataGrid::TYPE_CUSTOM);
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@deco_ana','id_da=@%id_da%');window.location.replace('#');");

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
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@deco_ana','id_da=@%id_da%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "conexionPHP('validarExistencia.php','1=@deco_ana','id_da=@%id_da%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminardeco_ana('%id_da%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarcontrato_servicio('%id_cont_serv%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcontrato_servicio('%id_cont_serv%')");
*/
$x->printTable();

?>
