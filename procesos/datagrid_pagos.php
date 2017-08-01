<?php
//require_once("../DataBase/Acceso.php");
session_start();
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

$id_serv_fraccion='ZZZ00001';
$acceso1=conexion();
$id_contrato=$_GET['id_contrato'];
$monto_pago_comp=$_GET['monto_pago']+0;
$monto_pago=$_GET['monto_pago']+0;

$fec=date("Y-m-01");

require_once "../Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);

		$acceso1->objeto->ejecutarSql("update contrato_servicio_deuda set apagar=0 where (select count(*) from pagos where contrato_servicio_deuda.id_pago=pagos.id_pago and id_contrato='$id_contrato')>0 ");

		//echo "select id_cont_serv from contrato_servicio_deuda where (select count(*) from pagos where pagos.id_pago=contrato_servicio_deuda.id_pago and status_pago='DEUDA' AND pagos.id_contrato='$id_contrato'  AND tipo_doc='ABONO')>0";

		$acceso->objeto->ejecutarSql("select id_pago from  pagos where status_pago='DEUDA' AND pagos.id_contrato='$id_contrato'  AND tipo_doc='ABONO'");
		while($row=row($acceso)){
			$id_pago=trim($row['id_pago']);

			//echo "<br>select * from pago_factura where id_cont_serv='$id_cont_serv'";
			$acceso1->objeto->ejecutarSql("select contrato_servicio_deuda.id_pago from pago_factura,contrato_servicio_deuda where pago_factura.id_cont_serv=contrato_servicio_deuda.id_cont_serv and contrato_servicio_deuda.id_pago='$id_pago'");
			if(!$row=row($acceso1)){
				//echo "delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'";
				$acceso1->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_pago='$id_pago'");
				$acceso1->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
			}
		}
if($monto_pago==0){
	$acceso1->objeto->ejecutarSql("update contrato_servicio_deuda set apagar=(((cant_serv * costo_cobro)-descu)-pagado) where (select count(*) from pagos where contrato_servicio_deuda.id_pago=pagos.id_pago and id_contrato='$id_contrato')>0");
}
else if($monto_pago>0){
		$id_select='';
		
		
		$acceso1->objeto->ejecutarSql("select tipo_costo,id_cont_serv,(((cant_serv * costo_cobro)-descu) - pagado ) as costo from vista_contratodeu where id_contrato='$id_contrato' and status_con_ser='DEUDA' and costo_cobro>0 order by  tipo_serv ,fecha_inst");
		while($row=row($acceso1)){
			$id_cont_serv=trim($row['id_cont_serv']);
			$tipo_costo=trim($row['tipo_costo']);
			$costo=trim($row['costo'])+0;
			//echo "<BR>costo:$costo ";
			//echo "<BR>monto_pago:$monto_pago ";
			
			if($monto_pago>=$costo){
				$id_select=$id_select."=@$id_cont_serv";
				$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set apagar='$costo' where id_cont_serv='$id_cont_serv'");
				$monto_pago=$monto_pago-$costo;
			}
			else if($monto_pago>0){
				$id_select=$id_select."=@$id_cont_serv";
				$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set apagar='$monto_pago' where id_cont_serv='$id_cont_serv'");
				$monto_pago=0;
			}
		}
	
		if($monto_pago>0){
			$id_cont_serv=agregar_abono($acceso,$id_contrato,$monto_pago);
			$id_select=$id_select."=@$id_cont_serv";
		}
}

	$fec=date("Y-m-01");
	$fec_act=date("Y-m-d");
	
	
	
$obj_trans->commit($acceso);



//echo $id_select;
	
if($modo!='EXCEL'){
echo '<input  type="hidden" name="desc_pago" value="'.$des.'">';
echo '<input  type="hidden" name="id_select" value="'.$id_select.'">';
}
if($_GET['order']==''){
	$x->setOrder('fecha_inst', 'ASC');
}
$x->setQuery("tipo_costo,id_cont_serv,nombre_servicio,tipo_doc,fecha_inst,(((cant_serv * costo_cobro)- descu+0 )-pagado) as deuda, apagar", "vista_contratodeu","id_cont_serv","id_contrato='$id_contrato' and status_con_ser='DEUDA' and costo_cobro>0 ");
$x->hideColumn('tipo_costo');
$x->hideColumn('id_cont_serv');
$x->hideColumn('costo_dif_men');
$x->setColumnHeader('apagar', _("a pagar"));
$x->setColumnHeader('nombre_servicio', _("Servicio"));
$x->setColumnHeader('tipo_servicio', _("Tipo Servicio"));
$x->setColumnHeader('fecha_inst', _("Fecha"));
$x->setColumnHeader('cant_serv', _("Cant."));
$x->setColumnHeader('costo_cobro', _("costo"));
$x->setColumnHeader('tipo_doc', _("tipo"));
$x->setColumnHeader('subtotal', _("Sub-total"));
$x->setColumnHeader('total', _("Total"));
$x->setColumnHeader('descu', 'Desc.');

//$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "fraccionarCargo('%id_cont_serv%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "editar_desc('%descu%','%id_cont_serv%')");


//$x->setColumnType('fecha_inst', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('costo_cobro', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('subtotal', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('total', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('desc', EyeDataGrid::TYPE_MONTO);
$x->setColumnType('tipo_doc', EyeDataGrid::TYPE_DOC);
//para permitir filtros
$x->allowFilters();
$acceso->objeto->ejecutarSql("select *from parametros where id_param='38'");
$row=row($acceso);
$habilita=trim($row['valor_param']);
if($habilita=='1'){
	$x->showCheckboxes();
}
else {
	$x->showCheckboxes(true,'disabled');
}
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

$x->hideFooter(true);

$x->setClase("Pagos");

	
if($modo!='EXCEL'){

}
		$x->printTable();

	
	
if($modo!='EXCEL'){	
	$fecha=date("Y-m-01");
		$acceso->objeto->ejecutarSql("select sum(((cant_serv * costo_cobro)- descu+0 )-pagado) as deuda from vista_contrato_servicio_deuda where id_contrato='$id_contrato' and status_con_ser='DEUDA' and id_serv<>'ZZZ00001'");
		$deuda=0;
		if($row=row($acceso)){
			$deuda_total=trim($row["deuda"]);
		}
		//ECHO "select sum(((cant_serv * costo_cobro)- descu+0 )-pagado) as abono from contrato_servicio_deuda where id_contrato='$id_contrato' and id_serv='ZZZ00001'";
		$acceso->objeto->ejecutarSql("select sum(((cant_serv * costo_cobro)- descu)) as abono from vista_contrato_servicio_deuda where id_contrato='$id_contrato'  and status_con_ser='PAGADO' and id_serv='ZZZ00001'");
		$deuda=0;
		if($row=row($acceso)){
			$abono=trim($row["abono"]);
		}
		echo'
		<input type="hidden" name="sald" id="sald" maxlength="10" size="10" value="'.number_format($deuda_total-$abono+0, 2, '.', '').'" >
					

';
	/*
	echo'
		



		<div class="text-btn" align="left">
			<div class="form-group col-lg-5 col-md-6 col-sm-8 col-xs-12">
				<div class="input-group">
					<span id="saldo" class="input-group-addon">TOTAL CARGOS</span>
					<input class="form-control" style="font-size:100%: color: #000000; font-weight:bold; text-align:center;" readonly type="text" name="saldo1" id="saldo1" maxlength="10" size="10" value="'.number_format($deuda_total+0, 2, ',', '.').'" onChange="">
					<span id="moneda" class="input-group-addon">BsF</span>
				</div>
			
			</div>
		</div>

';
*/
}
?>