<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_da,punto_da,codigo_da,nota2,(select nro_contrato from contrato where deco_ana.id_contrato=contrato.id_contrato limit 1 ) as nro_contrato,tipo_da,prov_da,status_da,servicio,obser_da", "deco_ana","id_da","status_da=''");
$x->hideColumn('id_da');
$x->setColumnHeader('codigo_da','CODIGO');
$x->setColumnHeader('nota2', "Codigo2");
$x->setColumnHeader('nro_contrato','nro contrato');
$x->setColumnHeader('tipo_da','tipo');
$x->setColumnHeader('prov_da','ESTADO FISICO');
$x->setColumnHeader('status_da','status');
$x->setColumnHeader('obser_da','obserVACION');
$x->setColumnHeader('','');
$x->setColumnHeader('punto_da','CODIFICACION');
$x->setColumnType('status_da', EyeDataGrid::TYPE_CUSTOM);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@deco_ana','id_da=@%id_da%');window.location.replace('#');");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificardeco_ana('%id_da%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminardeco_ana('%id_da%')");
*/

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
