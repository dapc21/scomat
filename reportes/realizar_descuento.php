<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$motivo = $_GET['motivo'];
$comentario = $_GET['comentario'];
$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];

$monto_dc = $_GET['monto_dc'];
$mes = $_GET['mes'];

$id_franq = $_GET['id_franq'];

$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];

$where = "select costo_cobro,nombre_servicio ,fecha_inst , contrato_servicio_deuda.id_cont_serv,vista_contrato.id_contrato,vista_contrato.nro_contrato,vista_contrato.cedula,vista_contrato.nombre,vista_contrato.apellido ,vista_contrato.status_contrato,vista_contrato.nombre_zona,vista_contrato.nombre_sector,vista_contrato.nombre_calle from vista_contrato, contrato_servicio_deuda,servicios where  contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato and contrato_servicio_deuda.fecha_inst='$mes' and contrato_servicio_deuda.status_con_ser='DEUDA' and tipo_costo='COSTO MENSUAL' and costo_cobro>0 ";


	
	$tipo='';
  if($gen_ubi!='GENERAL'){
		if($id_franq!='0'){
			$where=$where. " and (vista_contrato.id_franq = '$id_franq')";
			$tipo='id_franq';
		}
		else if($id_zona!='0'){
			$where=$where. " and (vista_contrato.id_zona ILIKE '%$id_zona%')";
			$tipo='id_zona';
		}
		else if($id_sector!='0'){
			$where=$where. " and (vista_contrato.id_sector ILIKE '%$id_sector%')";
			$tipo='id_sector';
		}
		else if($id_calle!='0'){
			$where=$where. " and (vista_contrato.id_calle ILIKE '%$id_calle%')";
			$tipo='id_calle';
		}
		
		if($tipo=='id_franq'){
			if($id_zona!='0'){
				$where=$where. " and (vista_contrato.id_zona ILIKE '%$id_zona%')";
			}
			if($id_sector!='0'){
				$where=$where. " and (vista_contrato.id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (vista_contrato.id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_zona'){
			if($id_sector!='0'){
				$where=$where. " and (vista_contrato.id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (vista_contrato.id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_sector'){
			if($id_calle!='0'){
				$where=$where. " and (vista_contrato.id_calle ILIKE '%$id_calle%')";
			}
			
		}

	
	}
	if($status_contrato!=''){
		if($id_franq!=''){
			$where=$where. " and (vista_contrato.status_contrato ILIKE '%$status_contrato%')";
		}
	}
	
$desc=($tarifa_ser/30)*$dias;
$desc=number_format($desc, 1, '.', '');
$desc=$monto_dc;
//echo ":$tarifa_ser:$dias=$desc:";
$dato=lectura($acceso,$where);
		require_once "../Clases/notas.php";
		require_once "../Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$tipo="NOTA DE CREDITO";
		for($i=0;$i<count($dato);$i++)
		{
			$obj_trans->begin($acceso);
			$monto_dc=$monto_dc+0;
			
			$id_cont_serv=trim($dato[$i]['id_cont_serv']);
			$monto_anterior=trim($dato[$i]['costo_cobro'])+0;
			$id_contrato=trim($dato[$i]['id_contrato']);
			$fecha_inst=trim($dato[$i]['fecha_inst']);
			$nombre_servicio=trim($dato[$i]['nombre_servicio']);
			$monto_posterior=$monto_anterior-$monto_dc;
			if($obj_trans->valida_nota_dc($acceso,$tipo,$monto_dc,$monto_anterior,$monto_posterior)){
				$objeto=new notas();
				$generado_por='USUARIO';
				$objeto->confirmar_notas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$motivo,$comentario,$generado_por,$id_contrato,$monto_dc,$nombre_servicio,$fecha_inst);
				
				$obj_trans->commit($acceso);
				
			}
			else{
				$obj_trans->rollback($acceso);
			}
	
			echo "<br>$i:".trim($dato[$i]['nro_contrato'])."  ".trim($dato[$i]['apellido'])."  ".trim($dato[$i]['nombre'])."";
				
			
		}

		
		/*
function ActualizarDeudaDC($acceso,$id_cont_serv,$monto_dc,$monto_posterior,$motivo,$comentario,$tipo){
	require_once "Clases/trans_pago.php";
	$obj_trans=new trans_pago();
	$obj_trans->begin($acceso);
	$monto_dc=$monto_dc+0;
	$monto_posterior=$monto_posterior+0;

	$acceso->objeto->ejecutarSql("select costo_cobro,id_contrato,nombre_servicio,fecha_inst from contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and id_cont_serv='$id_cont_serv'");
	if($row=row($acceso)){
		$monto_anterior=trim($row["costo_cobro"])+0;
		$id_contrato=trim($row["id_contrato"]);
		$nombre_servicio=trim($row["nombre_servicio"]);
		$fecha_inst=trim($row["fecha_inst"]);
	}
	if($obj_trans->valida_nota_dc($acceso,$tipo,$monto_dc,$monto_anterior,$monto_posterior)){
		require_once "Clases/notas.php";
		$objeto=new notas();
		$generado_por='USUARIO';
		$objeto->solicitar_notas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$motivo,$comentario,$generado_por,$id_contrato,$monto_dc,$nombre_servicio,$fecha_inst);
		
		$obj_trans->commit($acceso);
		
	}
	else{
		$obj_trans->rollback($acceso);
	}
	
	
}
*/
?>
