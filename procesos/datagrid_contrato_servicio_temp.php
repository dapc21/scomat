<?php
require_once("../procesos.php"); 
$ini_u = $_SESSION["ini_u"]; 
//echo ":::$ini_u:";
$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_temp  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
$id_cont_serv= $ini_u.verCodLong($acceso,"id_cont_serv");

require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);


$id_contrato=$_GET['id_contrato'];
$x->setQuery("id_cont_serv,id_serv,id_contrato,tipo_servicio,nombre_servicio,tipo_paq,cant_serv,costo_cobro,(cant_serv * costo_cobro) as total", "vista_cont_serv_temp","id_cont_serv","id_contrato='$id_contrato' and status_con_ser='CONTRATO'");
$x->hideColumn('id_cont_serv');
$x->hideColumn('id_contrato');
$x->hideColumn('id_serv');
$x->setColumnHeader('nombre_servicio',  _("Servicio"));
$x->setColumnHeader('tipo_servicio', _("Tipo Servicio"));
$x->setColumnHeader('cant_serv', _("Cant."));
$x->setColumnHeader('costo_cobro', _("Costo"));
$x->setColumnHeader('total', _("Total"));
$x->setColumnHeader('tipo_paq', _("TIPO PAQUETE"));

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
//$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "conexionPHP('validarExistencia.php','1=@contrato_servicio','id_cont_serv=@%id_cont_serv%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcontrato_servicio_temp('%id_cont_serv%','%id_serv%','%id_contrato%')");
//$x->addRowSelect("eliminarcontrato_servicio_temp('%id_cont_serv%','%id_serv%','%id_contrato%')");
$x->hideFooter(true);
$x->printTable();

	
if($modo!='EXCEL'){
	$acceso->objeto->ejecutarSql("select count(*) as cont_serv from contrato_servicio_temp, servicios where contrato_servicio_temp.id_serv = servicios.id_serv and id_contrato='$id_contrato' AND  status_serv='ACTIVO'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO'");
	if($row=row($acceso)){
		$cont_serv=trim($row["cont_serv"]);
	}
echo '<input  type="hidden" value="'.$cont_serv.'" name="cont_serv" id="cont_serv">	';
echo '<input  type="hidden" value="'.$id_cont_serv.'" name="id_cont_serv" id="id_cont_serv">	';
}
$acceso->objeto->ejecutarSql("select sum(cant_serv * costo_cobro) as total from contrato_servicio_temp where id_contrato='$id_contrato' and status_con_ser='CONTRATO'");
	$total=0;
	if($row=row($acceso)){
		$total=trim($row["total"])+0;
	}
	
if($modo!='EXCEL'){	
//echo '<div align="right" class="fuente">'._("total costo mensual suscrito").': <span class="fuenteN">'.number_format($total,2,",",".").'</span></div>';
}

?>

<div align="right">
	<div class="form-group col-lg-4 col-md-5 col-sm-6 col-xs-12">
		<div class="input-group">
			<span id="saldo" class="input-group-addon">TOTAL SUSCRIPCION</span>
			<input class="form-control" style="#000000; font-weight:blod; font-size:14; "  readonly type="text" name="saldo1" id="saldo1"  value="<?php echo number_format($total,2,",","."); ?>" onChange="">
			<span id="saldo" class="input-group-addon">Bs</span>
		</div>
	</div>
</div>
