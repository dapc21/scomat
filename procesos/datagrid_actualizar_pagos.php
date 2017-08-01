<?php
//require_once("../DataBase/Acceso.php");
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
$modo=trim($_GET['modo']);
//crea la consulta SQL 
//campos, tabla, campo clave
$id_contrato=$_GET['id_contrato'];

if(!isset($_GET['order'])){
	$x->setOrder('fecha_inst', 'ORDER_ASC');
}
 //and costo_cobro>0
$x->setQuery("tipo_costo,id_cont_serv,costo_dif_men,fecha_inst,cant_serv,costo_cobro,status_serv,nombre_servicio,tipo_servicio", "vista_contratodeu","id_cont_serv","id_contrato='$id_contrato' and status_con_ser='DEUDA' and costo_cobro>0");
$x->hideColumn('id_cont_serv');
$x->hideColumn('costo_dif_men');
$x->hideColumn('tipo_costo');
$x->setColumnHeader('nombre_servicio', _("Servicio"));
$x->setColumnHeader('tipo_servicio', _("Tipo Servicio"));
$x->setColumnHeader('fecha_inst', _("Fecha"));
$x->setColumnHeader('cant_serv', _("Cant."));
$x->setColumnHeader('costo_cobro', _("Monto"));
$x->setColumnHeader('status_serv', _("Total"));
$x->setColumnHeader('', '');

//$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
//$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_HREF, "javascript:ActualizarDeuda('%id_cont_serv%')");
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_HREF, "javascript:ajaxVentana_AD('Act_datos','%id_cont_serv%')");
//$x->setColumnType('cant_serv', EyeDataGrid::TYPE_HREF, "javascript:ActualizarCampo('contrato_servicio','cant_serv','%cant_serv%','%id_cont_serv%','isInteger')");

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

$x->setClase("Actualizar_Pagos");
if($modo!='EXCEL'){
echo '
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section id="tabla-cargos">
	 ';
}
		$x->printTable();

$fecha=date("Y-m-01");

$acceso->objeto->ejecutarSql("select sum((costo_cobro*cant_serv)-descu) as deuda from contrato_servicio_deuda where id_contrato='$id_contrato' and status_con_ser='DEUDA' ");
	$deuda=0;
	if($row=row($acceso)){
		$deuda_total=trim($row["deuda"]);
	}
if($modo!='EXCEL'){	
echo'
		</section>
	</div>
	


<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section class="panel">
		<div class="text-btn" align="left">
			<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
			<div class="input-group">
				<span id="saldo" class="input-group-addon">TOTAL CARGOS</span>
				<input class="form-control" style="font-size:100%: color: #000000; font-weight:bold; text-align:right;" readonly type="text" name="saldo1" id="saldo1" maxlength="10" size="10" value="'.number_format($deuda_total+0, 2, ',', '.').'" onChange="">
				<span id="moneda" class="input-group-addon">BsF</span>
			</div>
			</div>
		</div>
		</section>
	</div>
';
echo '
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section class="panel">
		<div class="text-btn" align="center">
			<button class="btn btn-info" type="button" name="registrar" value="'. _('estado de cuenta').'" onclick="GuardarRep_historial_deuda(\''.$id_contrato.'\')"><i class="glyphicon glyphicon-ok"></i> Estado de Cuenta</button>
			<button class="btn btn-info" type="button" name="registrar" value="'. _('aviso de cobro').'" onclick="Guardar_aviso_cobro(\''.$id_contrato.'\')"><i class="glyphicon glyphicon-ok"></i> Aviso de Cobro</button>
			<button class="btn btn-info" type="button" name="registrar" value="'. _('aviso de suspension').'" onclick="Guardar_aviso_susp(\''.$id_contrato.'\')"><i class="glyphicon glyphicon-ok"></i> Aviso de Suspensión</button>
			<button class="btn btn-info" type="button" name="registrar" value="'. _('referencia comercial').'" onclick="referencia_comercial(\''.$id_contrato.'\')"><i class="glyphicon glyphicon-ok"></i> Referencia Comercial</button>
		</div>
		</section>
	</div>

</div>';
}
$acceso->objeto->ejecutarSql("select * from convenio_pago where id_contrato='$id_contrato' and status_conv='ACTIVO'");
if($row=$acceso->objeto->devolverRegistro()){
$fecha_conv = formatofecha(trim($row['fecha_conv']));	
$obser_conv = trim($row['obser_conv']);

	
$x->setQuery("fecha_ven, fecha_inst as periodo,nombre_servicio,costo_cobro as deuda ", "vista_convenio","","id_contrato='$id_contrato' and status_conv='ACTIVO' and status_con_ser='DEUDA'  ");
$x->setColumnHeader('nombre_servicio', _("servicio"));
$x->setColumnHeader('periodo', _("fecha cargo"));
$x->setColumnHeader('fecha_ven', _("fecha plazo"));
$x->setColumnHeader('deuda', _("deuda"));
$x->setColumnType('periodo', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_ven', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->showRowNumber();

$x->setResultsPerPage(20);
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@conv_con','id_conv_cont=@%id_conv_cont%');window.location.replace('#');");

$x->printTable();
?>

	</fieldset>
  </td>		
 </tr>
 
<?php 
}
	
?>