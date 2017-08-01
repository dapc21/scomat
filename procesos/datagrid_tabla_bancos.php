<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave


$fecha_tb = $_GET['fecha_desde_ctb'];
$fecha_desde_ctb = formatfecha($_GET['fecha_desde_ctb']);
$fecha_hasta_ctb = formatfecha($_GET['fecha_hasta_ctb']);
$id_cuba = $_GET['id_cuba'];
$referencia_tb = $_GET['referencia_tb'];
$monto_tb = $_GET['monto_tb'];
$descrip_tb = $_GET['descrip_tb'];
$status_tb = $_GET['status_tb'];

$where='';
		if($fecha_tb!=''){
			$where=$where. " and fecha_tb between '$fecha_desde_ctb' and '$fecha_hasta_ctb'";
		}

		if($id_cuba!='' && $id_cuba!='0'){
			$where=$where. " and (cuenta_bancaria.id_cuba = '$id_cuba')";
		}
		if($referencia_tb!=''){
			$where=$where. " and (referencia_tb ='$referencia_tb')";
		}
		if($descrip_tb!=''){
			$where=$where. " and (descrip_tb ilike '%$descrip_tb%')";
		}
		if($monto_tb!=''){
			$where=$where. " and (monto_tb='$monto_tb')";
		}
		if($status_tb!='' && $status_tb!='0'){
			$where=$where. " and (status_tb = '$status_tb')";
		}

	//	echo $where;
if($_GET['order']==''){
	$x->setOrder('id_tb', 'DESC');
}
$x->setQuery("abrev_cuba,id_tb,fecha_tb,referencia_tb , descrip_tb, monto_tb, status_tb", "tabla_bancos,carga_tabla_banco, cuenta_bancaria","id_tb","tabla_bancos.id_ctb=carga_tabla_banco.id_ctb and carga_tabla_banco.id_cuba=cuenta_bancaria.id_cuba $where");
$x->hideColumn('dato');
$x->setColumnHeader('fecha_tb', 'fecha');
$x->setColumnHeader('referencia_tb', 'referencia');
$x->setColumnHeader('descrip_tb', 'descripcion');
$x->setColumnHeader('monto_tb', 'monto');
$x->setColumnHeader('status_tb', 'status');
$x->setColumnHeader('abrev_cuba', 'Cuenta Bancaria');
$x->setColumnHeader('', '');
$x->setColumnHeader('', '');

$x->setColumnType('fecha_tb', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas

if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0){
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
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@tabla_bancos','id_tb=@%id_tb%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificartabla_bancos('%id_tb%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminartabla_bancos('%id_tb%')");
*/
$x->printTable();
?>
