<?php
require_once("../procesos.php"); 
$ini_u = $_SESSION["ini_u"]; 
//echo ":::$ini_u:";
$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
$id_cont_serv= $ini_u.verCodLong($acceso,"id_cont_serv");

require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

//crea la consulta SQL 
//campos, tabla, campo clave
$id_contrato=$_GET['id_contrato'];
$status_cont_ser=$_GET['status_cont_ser'];
if($status_cont_ser==""){
	$where="and (status_con_ser='CONTRATO' or status_con_ser='SUSPENDIDO') ";
}
if($_GET['order']==''){
	$x->setOrder('fecha_inst', 'DESC');
}

$x->setQuery("id_cont_serv,id_serv,id_contrato,tipo_servicio,nombre_servicio,fecha_inst,cant_serv,costo_cobro,(cant_serv * costo_cobro) as total, status_con_ser", "vista_contratoser","id_cont_serv","id_contrato='$id_contrato' $where ");
$x->hideColumn('id_cont_serv');
$x->hideColumn('id_contrato');
$x->hideColumn('id_serv');
$x->setColumnHeader('nombre_servicio',  _("Servicio"));
$x->setColumnHeader('tipo_servicio', _("Tipo Servicio"));
$x->setColumnHeader('cant_serv', _("Cant."));
$x->setColumnHeader('costo_cobro', _("Costo"));
$x->setColumnHeader('total', _("Total"));
$x->setColumnHeader('status_con_ser', _("Estatus"));

$x->setColumnType('total', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

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

$x->printTable();
$acceso->objeto->ejecutarSql("select sum(cant_serv * costo_cobro) as total from contrato_servicio where id_contrato='$id_contrato' and status_con_ser='CONTRATO'");
	$total=0;
	if($row=row($acceso)){
		$total=trim($row["total"])+0;
	}
		
if($modo!='EXCEL'){
	echo'<div class="panel-body">
			<div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="input-group">
					<span id="saldo" class="input-group-addon">TOTAL COSTO MENSUAL SUSCRITO</span>
					<input  class="form-control" type="text" name="monto_pago" id="monto_pago"  value="'.number_format($total,2,",",".").'"  style="color:blue; font-weight:blod;" >
				</div>
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<button class="btn btn-success" type="button" name="mostrar_his_sus" id="mostrar_his_sus" onclick="mostrar_Suscripcion_comp()" ><i class="glyphicon glyphicon-repeat"></i> Mostrar Historial completo</button>
			</div>
		</div>
	';
}

?>
