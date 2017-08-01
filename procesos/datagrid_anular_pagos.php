<?php
//require_once("../DataBase/Acceso.php");
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);
$modo=trim($_GET['modo']);
//crea la consulta SQL 
//campos, tabla, campo clave
$id_pago=$_GET['id_pago'];



$x->setQuery("tipo_costo,id_cont_serv,fecha_inst,cant_serv,costo_cobro,status_serv,nombre_servicio,tipo_servicio", "vista_pago_ser","id_cont_serv","id_pago='$id_pago' and status_con_ser='PAGADO'");
$x->hideColumn('tipo_costo');
$x->hideColumn('id_cont_serv');
$x->setColumnHeader('nombre_servicio',_("Servicio"));
$x->setColumnHeader('tipo_servicio', _("Tipo de Servicio"));
$x->setColumnHeader('fecha_inst', _("Fecha"));
$x->setColumnHeader('cant_serv', _("Cantidad"));
$x->setColumnHeader('costo_cobro', _("Monto"));
$x->setColumnHeader('status_serv', _("Total"));
$x->setColumnHeader('', '');

//$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO, '',true);
//para permitir filtros
$x->allowFilters();
//$x->showCheckboxes();
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


$x->setClase("anular_pagos");
if($modo!='EXCEL'){
echo '
<section class="panel">
	<header class="panel-heading">Datos de los Cargos Pagados</header>
		<div class="panel-body">
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<section id="tabla-anular_pagos">
				 ';
}
				$x->printTable();
if($modo!='EXCEL'){
echo'
					</section>
				</div>
		</div>
</section>';
}
?>
