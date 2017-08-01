<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

/*
$x->setQuery("id_caja_cob,nombre_caja,fecha_caja,apertura_caja,nombre,apellido,status_caja", "vista_caja","id_caja_cob","");
$x->hideColumn('id_caja_cob');
$x->setColumnHeader('nombre_caja', 'Punto de Cobro');
$x->setColumnHeader('fecha_caja', 'Fecha');
$x->setColumnHeader('apertura_caja', 'Hora Apert.');
$x->setColumnHeader('nombre','Nombre Cob.');
$x->setColumnHeader('apellido','Apellido Cob.');
$x->setColumnHeader('status_caja', 'Status');
*/

$id_caja_cob=$_GET['id_caja_cob'];
$fecha=date("Y-m-d");
$x->setQuery("nro_contrato,nro_factura,cedulacli,nombrecli,apellidocli,monto_pago,fecha_pago,hora_pago", "vista_pago_cont","id_caja_cob","id_caja_cob='$id_caja_cob' and fecha_pago='$fecha'");

$x->setColumnHeader('nro_contrato', _("nro cont."));
$x->setColumnHeader('nro_factura', _("nro fact."));
$x->setColumnHeader('monto_pago', _("montos"));
$x->setColumnHeader('fecha_pago', _("fecha"));
$x->setColumnHeader('hora_pago', _("hora"));
$x->setColumnHeader('cedulacli', _("cedula"));
$x->setColumnHeader('nombrecli', _("nombre"));
$x->setColumnHeader('apellidocli', _("apellido"));

$x->setColumnType('fecha_pago', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
//crea la consulta SQL 
//campos, tabla, campo clave


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
$x->addRowSelect("buscar_id_caja_cob('%id_caja_cob%');window.location.replace('#');");

$x->printTable();
	
if($modo!='EXCEL'){
echo '<div align="center"><input  type="button" name="imprimir" value="'._("imprimir detalles cobro").'" onclick="imprimirdetallecobro()">&nbsp;</div>';
}
?>
