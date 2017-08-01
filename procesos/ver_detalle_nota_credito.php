<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="border-head"><h3>DETALLE DE SERVICIOS</h3></div>
	
	<section class="panel">
<?php
$id_pago=$_POST['archivo'];
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);
//echo "HOLA COMO ESTAS:$id_pago";

//echo $id_pago;
//$id_pago=$_GET['id_pago'];
//echo$id_pago;
$x->setQuery("nombre_servicio,fecha_inst,cant_serv,costo_cobro_fact,costo_cobro as total","vista_pago_ser","","id_pago='$id_pago'");

$x->setColumnHeader("tipo_servicio", _("tipo servicio"));
$x->setColumnHeader("nombre_servicio", _("nombre servicio"));
$x->setColumnHeader("fecha_inst", _("fecha cargo"));
$x->setColumnHeader("cant_serv", _("cant"));
$x->setColumnHeader("costo_cobro_fact", _("Costo Cargo Factura"));
$x->setColumnHeader("total", _("Nota Credito"));

$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_MES, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('total', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('descu', EyeDataGrid::TYPE_MONTO, '',true);
$x->hideOrder();
//$x->allowFilters();
$x->setClase("historialpago");
//$x->showRowNumber();


$x->hideFooter(true);
$x->printTable();


$acceso->objeto->ejecutarSql("select * from vista_notas_cd where id_pago='$id_pago' ");
	if($row=row($acceso)){
		$comentario_sol=trim($row["comentario_sol"]);
		$nombremotivonota=trim($row["nombremotivonota"]);
		$login_sol=trim($row["login_sol"]);
		$fecha_sol=formatofecha($row["fecha_sol"]);
		$hora_sol=trim($row["hora_sol"]);
		$login_aut=trim($row["login_aut"]);
		$fecha_aut=formatofecha($row["fecha_aut"]);
		$hora_aut=trim($row["hora_aut"]);
		$nombremotivonota=trim($row["nombremotivonota"]);
	}
?>
		
	</section>	
	<div class="border-head"><h3>Motivo de Nota de credito</h3></div>
	<section class="panel">
	
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Solicitado por</label>
				<input disabled class="form-control" type="text" name="login_sol" maxlength="15" size="10"onChange="" value="<?php echo $login_sol;?>">
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Fecha y hora</label>
				<input disabled class="form-control" type="text" name="fecha_sol" maxlength="15" size="10"onChange="" value="<?php echo $fecha_sol." ".$hora_sol;?>">
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>autorizado por</label>
				<input disabled class="form-control" type="text" name="login_sol" maxlength="15" size="10"onChange="" value="<?php echo $login_aut;?>">
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<label>Fecha y hora</label>
				<input disabled class="form-control" type="text" name="fecha_sol" maxlength="15" size="10"onChange="" value="<?php echo $fecha_aut." ".$hora_aut;?>">
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Motivo</label>
				<input disabled class="form-control" type="text" name="cedula" maxlength="15" size="10"onChange="" value="<?php echo $nombremotivonota;?>">
			</div>
			<div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<label>Observación</label>
			<textarea disabled class="form-control" name="obser_pago" cols="1" rows="1" ><?php echo $comentario_sol;?></textarea>
			</div>
			
	</section>	 
</div> 
