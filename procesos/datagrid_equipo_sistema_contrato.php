<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave, condicion
$id_contrato=$_GET['id_contrato'];
$x->setQuery("id_es,codigo_es,nombre_modelo,sistema,status_es,codigo_adic,ver_serv_sist_equipo(id_es) as paquetes", "vista_equipo_sistema","id_es","id_contrato='$id_contrato'");
$x->hideColumn('id_es');
$x->setColumnHeader('id_es', 'id_es');
$x->setColumnHeader('nombre_modelo', 'modelo');
$x->setColumnHeader('id_ues', 'ubicacion');
$x->setColumnHeader('id_contrato', 'id_contrato');
$x->setColumnHeader('codigo_es', 'codigo');
$x->setColumnHeader('tipo_es', 'tipo');
$x->setColumnHeader('status_es', 'status');
$x->setColumnHeader('obser_es', 'observacion');
$x->setColumnHeader('codigo_adic', 'codigo Adic.');
$x->setColumnHeader('estado_fisico', 'estado fisico');
$x->setColumnHeader('dato', 'dato');

$x->setColumnType('status_es', EyeDataGrid::TYPE_COLOR_TERM);

$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "cargar_form_edit_terminal('%id_es%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "editar_terminal('%id_es%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_REFRES, "refrescar_terminal('%id_es%')");


//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila

//$x->addRowSelect("buscar_id_es('%id_es%');window.location.replace('#');");

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
$x->hideFooter(true);

//echo '<button class="btn btn-info" type="button" name="refrescar" onclick="cargar_form_act_contrato()" value=""><i class="glyphicon glyphicon-repeat"></i> refrescar todos los terminales</button>';
$x->printTable();
?>
