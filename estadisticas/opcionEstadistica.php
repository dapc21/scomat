<?php
require_once "../procesos.php";
require_once "meses.php";

$cadena = $_POST['opcion'];
$valor=explode("=@",$cadena);
$opc = $valor[0];
switch($opc)
{
	case 'ingresoDeuda':
		
		$anioPago = array();
		$total_ing = array();
		$total_deu = array();
		$data = array();
		
		$acceso->objeto->ejecutarSql("SELECT distinct extract(year from fecha_c) as anio FROM cierre_historico order by anio");
		$row=row($acceso);
		$anioPago = trim($row["anio"])+0;
		$cantAnio = count($row); 
		
		for($i = 0; $i <= $cantAnio; $i++){	

			$fec_ini="$anioPago-01-01";
			$fec_fin="$anioPago-12-31";
			
			$acceso->objeto->ejecutarSql("SELECT SUM(total_ingreso) AS total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$total_ing = trim($row["total"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(deuda_total) as deuda FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$total_deu = trim($row["deuda"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro) as deuda_act FROM contrato_servicio_deuda where fecha_inst between '$fec_ini' and '$fec_fin' and status_con_ser='DEUDA'");
			$row=row($acceso);
			$deuda_actual = trim($row["deuda_act"])+0;
			
			$data[$i]= array('total_ingreso' => $total_ing, 'total_deuda' => $total_deu, 'deuda_actual' => $deuda_actual, 'anio_pago' => $anioPago);
			
			$anioPago = $anioPago+1;
		}
		
		echo json_encode($data);

	break;
	
	case 'ingresoDeudaParam':
		
		$anio = array();
		$data = array();
		$fecha_i = $_POST['fecha_i'];
		$fecha_f = $_POST['fecha_f'];
		$franquicia = $_POST['franquicia'];
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		//Año		
		for($j = $fecha_i; $j <= $fecha_f; $j++){	
			$anio[] = $j;
		}
		
		$cantAnio = count($anio);
		
		for($i = 0; $i < $cantAnio; $i++){	

			$fec_ini = $anio[$i]."-01-01";
			$fec_fin = $anio[$i]."-12-31";
			
			$acceso->objeto->ejecutarSql("SELECT SUM(total_ingreso) AS total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$total_ing = trim($row["total"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(deuda_total) as deuda FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$total_deu = trim($row["deuda"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro) as deuda_act FROM contrato_servicio_deuda where fecha_inst between '$fec_ini' and '$fec_fin' and status_con_ser='DEUDA'");
			$row=row($acceso);
			$deuda_actual = trim($row["deuda_act"])+0;
			
			
			$data[$i]= array('total_ingreso' => $total_ing, 'total_deuda' => $total_deu, 'deuda_actual' => $deuda_actual, 'anio_pago' => $anio[$i]);
			
		}
		
		echo json_encode($data);

	break;
	
	case 'ingresoDeudaParamMes':
		
		$mes = array();
		$data = array();
		$anio = $_POST['fecha_f'];
		$anioc = $anio+0;
		$franquicia = $_POST['franquicia'];
		$anio_actual = date("Y");
		$mes_actual = date("n"); //1 al 12
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		for($i = 0; $i <= 11; $i++){
			$j = $i+1;
			if($anioc == $anio_actual && $j > $mes_actual){
				break;
			}
			else{

				if($j < 10) $mes = "0".$j;
				else $mes = "$j";
				
				$fec_ini = $anio."-".$mes."-01";
				//obtenemos el ultimo dia del mes
				$acceso->objeto->ejecutarSql("select extract (day from (select date_trunc('month', DATE '$fec_ini') + interval '1 month') - interval '1 day') as ultimo");
				$row=row($acceso);
				$ultimo_dia = trim($row["ultimo"]);
				$fec_fin = $anio."-".$mes."-".$ultimo_dia;
				
				$acceso->objeto->ejecutarSql("SELECT SUM(total_ingreso) AS total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$total_ing = trim($row["total"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(deuda_act) as deuda FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$total_deu = trim($row["deuda"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro) as deuda_act FROM contrato_servicio_deuda where fecha_inst between '$fec_ini' and '$fec_fin' and status_con_ser='DEUDA'");
				$row=row($acceso);
				$deuda_actual = trim($row["deuda_act"])+0;
				
				$mes = nombreMes($mes);
				$data[$i]= array('total_ingreso' => $total_ing, 'total_deuda' => $total_deu, 'deuda_actual' => $deuda_actual, 'mes' => $mes, 'anio' => $anio);
				
			}
			
		}
		
		echo json_encode($data);

	break;
	
	case 'abo':
		
		$anio = array();
		$data = array();
		
		//Año
		$acceso->objeto->ejecutarSql("SELECT distinct extract(year from fecha_c) as anio FROM cierre_historico order by anio");
		$row=row($acceso);
		$anio = trim($row["anio"])+0;
		$cantAnio = count($row); 
		
		for($i = 0; $i <= $cantAnio; $i++){	

			$fec_ini="$anio-01-01";
			$fec_fin="$anio-12-31";
			
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_activos) AS activos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$activos = trim($row["activos"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_cortados) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$cortados = trim($row["cortados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_x_instalar) as xinstalar FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$xinstalar = trim($row["xinstalar"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_x_cortar) as xcortar FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$xcortar = trim($row["xcortar"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_x_reconectar) as xreconectar FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$xreconectar = trim($row["xreconectar"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_exonerado) as exonerado FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$exonerado = trim($row["exonerado"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_otros) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$otros = trim($row["otros"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$total = trim($row["total"])+0;
			
			$data[$i]= array('activos' => $activos, 'cortados' => $cortados, 'xinstalar' => $xinstalar, 'xcortar' => $xcortar, 'xreconectar' => $xreconectar, 'exonerado' => $exonerado, 'otros' => $otros, 'total' => $total, 'anio' => $anio);
			
			$anio = $anio+1;
		}
		
		echo json_encode($data);

	break;
	
	case 'aboParam':
		
		$anio = array();
		$data = array();
		$fecha_i = $_POST['fecha_i'];
		$fecha_f = $_POST['fecha_f'];
		$franquicia = $_POST['franquicia'];
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		//Año		
		for($j = $fecha_i; $j <= $fecha_f; $j++){	
			$anio[] = $j;
		}
		
		$cantAnio = count($anio);
		
		for($i = 0; $i < $cantAnio; $i++){	

			$fec_ini = $anio[$i]."-01-01";
			$fec_fin = $anio[$i]."-12-31";
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_activos) AS activos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$activos = trim($row["activos"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_cortados) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$cortados = trim($row["cortados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_x_instalar) as xinstalar FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$xinstalar = trim($row["xinstalar"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_x_cortar) as xcortar FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$xcortar = trim($row["xcortar"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_x_reconectar) as xreconectar FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$xreconectar = trim($row["xreconectar"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_exonerado) as exonerado FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$exonerado = trim($row["exonerado"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_otros) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$otros = trim($row["otros"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(abo_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$total = trim($row["total"])+0;
			
			
			$data[$i]= array('activos' => $activos, 'cortados' => $cortados, 'xinstalar' => $xinstalar, 'xcortar' => $xcortar, 'xreconectar' => $xreconectar, 'exonerado' => $exonerado, 'otros' => $otros, 'total' => $total, 'anio' => $anio[$i]);
			
		}
		
		echo json_encode($data);

	break;
	
	case 'aboParamMes':
		
		$mes = array();
		$data = array();
		$anio = $_POST['fecha_f'];
		$anioc = $anio+0;
		$franquicia = $_POST['franquicia'];
		$anio_actual = date("Y");
		$mes_actual = date("n"); //1 al 12
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		for($i = 0; $i <= 11; $i++){
			$j = $i+1;
			if($anioc == $anio_actual && $j > $mes_actual){
				break;
			}
			else{

				if($j < 10) $mes = "0".$j;
				else $mes = "$j";
				
				$fec_ini = $anio."-".$mes."-01";
				//obtenemos el ultimo dia del mes
				$acceso->objeto->ejecutarSql("select extract (day from (select date_trunc('month', DATE '$fec_ini') + interval '1 month') - interval '1 day') as ultimo");
				$row=row($acceso);
				$ultimo_dia = trim($row["ultimo"]);
				$fec_fin = $anio."-".$mes."-".$ultimo_dia;
				
				$acceso->objeto->ejecutarSql("SELECT sum(abo_activos) AS activos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$activos = trim($row["activos"])+0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(abo_cortados) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$cortados = trim($row["cortados"])+0;
				/*
				$acceso->objeto->ejecutarSql("SELECT sum(abo_x_instalar) as xinstalar FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$xinstalar = trim($row["xinstalar"])+0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(abo_x_cortar) as xcortar FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$xcortar = trim($row["xcortar"])+0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(abo_x_reconectar) as xreconectar FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$xreconectar = trim($row["xreconectar"])+0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(abo_exonerado) as exonerado FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$exonerado = trim($row["exonerado"])+0;
				
				$acceso->objeto->ejecutarSql("SELECT sum(abo_otros) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$otros = trim($row["otros"])+0;
				*/
				$acceso->objeto->ejecutarSql("SELECT sum(abo_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$total = trim($row["total"])+0;
				
				$mes = nombreMes($mes);
				$data[$i]= array('activos' => $activos, 'cortados' => $cortados, 'total' => $total, 'mes' => $mes, 'anio' => $anio);
				//$data[$i]= array('activos' => $activos, 'cortados' => $cortados, 'xinstalar' => $xinstalar, 'xcortar' => $xcortar, 'xreconectar' => $xreconectar, 'exonerado' => $exonerado, 'otros' => $otros, 'total' => $total, 'mes' => $mes, 'anio' => $anio);
				
			}
			
		}
		
		echo json_encode($data);

	break;
	
	case 'ordAsig':
		
		$anio = array();
		$data = array();
		
		//Año
		$acceso->objeto->ejecutarSql("SELECT distinct extract(year from fecha_c) as anio FROM cierre_historico order by anio");
		$row=row($acceso);
		$anio = trim($row["anio"])+0;
		$cantAnio = count($row); 
		
		for($i = 0; $i <= $cantAnio; $i++){	

			$fec_ini="$anio-01-01";
			$fec_fin="$anio-12-31";
			
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_inst) AS instaladas FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$instaladas = trim($row["instaladas"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_corte) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$cortados = trim($row["cortados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_rec) as reconectados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$reconectados = trim($row["reconectados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_reclamo) as reclamos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$reclamos = trim($row["reclamos"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_otras) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$otros = trim($row["otros"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$total = trim($row["total"])+0;
			
			$data[$i]= array('instaladas' => $instaladas, 'cortados' => $cortados, 'reconectados' => $reconectados, 'reclamos' => $reclamos, 'otros' => $otros, 'total' => $total, 'anio' => $anio);
			
			$anio = $anio+1;
		}
		
		echo json_encode($data);

	break;
	
	case 'ordAsigParam':
		
		$anio = array();
		$data = array();
		$fecha_i = $_POST['fecha_i'];
		$fecha_f = $_POST['fecha_f'];
		$franquicia = $_POST['franquicia'];
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		//Año		
		for($j = $fecha_i; $j <= $fecha_f; $j++){	
			$anio[] = $j;
		}
		
		$cantAnio = count($anio);
		
		for($i = 0; $i < $cantAnio; $i++){	

			$fec_ini = $anio[$i]."-01-01";
			$fec_fin = $anio[$i]."-12-31";
			
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_inst) AS instaladas FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$instaladas = trim($row["instaladas"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_corte) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$cortados = trim($row["cortados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_rec) as reconectados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$reconectados = trim($row["reconectados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_reclamo) as reclamos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$reclamos = trim($row["reclamos"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_otras) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$otros = trim($row["otros"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$total = trim($row["total"])+0;
			
			$data[$i]= array('instaladas' => $instaladas, 'cortados' => $cortados, 'reconectados' => $reconectados, 'reclamos' => $reclamos, 'otros' => $otros, 'total' => $total, 'anio' => $anio[$i]);
			
		}
		
		echo json_encode($data);

	break;
	
	case 'ordAsigParamMes':
		
		$mes = array();
		$data = array();
		$anio = $_POST['fecha_f'];
		$anioc = $anio+0;
		$franquicia = $_POST['franquicia'];
		$anio_actual = date("Y");
		$mes_actual = date("n"); //1 al 12
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		for($i = 0; $i <= 11; $i++){
			$j = $i+1;
			if($anioc == $anio_actual && $j > $mes_actual){
				break;
			}
			else{

				if($j < 10) $mes = "0".$j;
				else $mes = "$j";
				
				$fec_ini = $anio."-".$mes."-01";
				//obtenemos el ultimo dia del mes
				$acceso->objeto->ejecutarSql("select extract (day from (select date_trunc('month', DATE '$fec_ini') + interval '1 month') - interval '1 day') as ultimo");
				$row=row($acceso);
				$ultimo_dia = trim($row["ultimo"]);
				$fec_fin = $anio."-".$mes."-".$ultimo_dia;
				
				$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_inst) AS instaladas FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$instaladas = trim($row["instaladas"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_corte) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$cortados = trim($row["cortados"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_rec) as reconectados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$reconectados = trim($row["reconectados"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_reclamo) as reclamos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$reclamos = trim($row["reclamos"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_otras) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$otros = trim($row["otros"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_asig_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$total = trim($row["total"])+0;
				
				$mes = nombreMes($mes);
				$data[$i]= array('instaladas' => $instaladas, 'cortados' => $cortados, 'reconectados' => $reconectados, 'reclamos' => $reclamos, 'otros' => $otros, 'total' => $total, 'mes' => $mes, 'anio' => $anio);
				
			}
			
		}
		
		echo json_encode($data);

	break;
	
	case 'ordImp':
		
		$anio = array();
		$data = array();
		
		//Año
		$acceso->objeto->ejecutarSql("SELECT distinct extract(year from fecha_c) as anio FROM cierre_historico order by anio");
		$row=row($acceso);
		$anio = trim($row["anio"])+0;
		$cantAnio = count($row); 
		
		for($i = 0; $i <= $cantAnio; $i++){	

			$fec_ini="$anio-01-01";
			$fec_fin="$anio-12-31";
			
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_inst) AS instaladas FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$instaladas = trim($row["instaladas"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_corte) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$cortados = trim($row["cortados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_rec) as reconectados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$reconectados = trim($row["reconectados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_reclamo) as reclamos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$reclamos = trim($row["reclamos"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_otras) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$otros = trim($row["otros"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$total = trim($row["total"])+0;
			
			$data[$i]= array('instaladas' => $instaladas, 'cortados' => $cortados, 'reconectados' => $reconectados, 'reclamos' => $reclamos, 'otros' => $otros, 'total' => $total, 'anio' => $anio);
			
			$anio = $anio+1;
		}
		
		echo json_encode($data);

	break;
	
	case 'ordImpParam':
		
		$anio = array();
		$data = array();
		$fecha_i = $_POST['fecha_i'];
		$fecha_f = $_POST['fecha_f'];
		$franquicia = $_POST['franquicia'];
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		//Año		
		for($j = $fecha_i; $j <= $fecha_f; $j++){	
			$anio[] = $j;
		}
		
		$cantAnio = count($anio);
		
		for($i = 0; $i < $cantAnio; $i++){	

			$fec_ini = $anio[$i]."-01-01";
			$fec_fin = $anio[$i]."-12-31";
			
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_inst) AS instaladas FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$instaladas = trim($row["instaladas"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_corte) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$cortados = trim($row["cortados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_rec) as reconectados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$reconectados = trim($row["reconectados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_reclamo) as reclamos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$reclamos = trim($row["reclamos"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_otras) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$otros = trim($row["otros"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$total = trim($row["total"])+0;
			
			$data[$i]= array('instaladas' => $instaladas, 'cortados' => $cortados, 'reconectados' => $reconectados, 'reclamos' => $reclamos, 'otros' => $otros, 'total' => $total, 'anio' => $anio[$i]);
			
		}
		
		echo json_encode($data);

	break;
	
	case 'ordImpParamMes':
		
		$mes = array();
		$data = array();
		$anio = $_POST['fecha_f'];
		$anioc = $anio+0;
		$franquicia = $_POST['franquicia'];
		$anio_actual = date("Y");
		$mes_actual = date("n"); //1 al 12
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		for($i = 0; $i <= 11; $i++){
			$j = $i+1;
			if($anioc == $anio_actual && $j > $mes_actual){
				break;
			}
			else{

				if($j < 10) $mes = "0".$j;
				else $mes = "$j";
				
				$fec_ini = $anio."-".$mes."-01";
				//obtenemos el ultimo dia del mes
				$acceso->objeto->ejecutarSql("select extract (day from (select date_trunc('month', DATE '$fec_ini') + interval '1 month') - interval '1 day') as ultimo");
				$row=row($acceso);
				$ultimo_dia = trim($row["ultimo"]);
				$fec_fin = $anio."-".$mes."-".$ultimo_dia;
				
				$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_inst) AS instaladas FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$instaladas = trim($row["instaladas"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_corte) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$cortados = trim($row["cortados"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_rec) as reconectados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$reconectados = trim($row["reconectados"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_reclamo) as reclamos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$reclamos = trim($row["reclamos"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_otras) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$otros = trim($row["otros"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_imp_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$total = trim($row["total"])+0;
				
				$mes = nombreMes($mes);
				$data[$i]= array('instaladas' => $instaladas, 'cortados' => $cortados, 'reconectados' => $reconectados, 'reclamos' => $reclamos, 'otros' => $otros, 'total' => $total, 'mes' => $mes, 'anio' => $anio);
				
			}
			
		}
		
		echo json_encode($data);

	break;
	
	case 'ordFin':
		
		$anio = array();
		$data = array();
		
		//Año
		$acceso->objeto->ejecutarSql("SELECT distinct extract(year from fecha_c) as anio FROM cierre_historico order by anio");
		$row=row($acceso);
		$anio = trim($row["anio"])+0;
		$cantAnio = count($row); 
		
		for($i = 0; $i <= $cantAnio; $i++){	

			$fec_ini="$anio-01-01";
			$fec_fin="$anio-12-31";
			
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_inst) AS instaladas FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$instaladas = trim($row["instaladas"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_corte) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$cortados = trim($row["cortados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_rec) as reconectados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$reconectados = trim($row["reconectados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_reclamo) as reclamos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$reclamos = trim($row["reclamos"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_otras) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$otros = trim($row["otros"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin'");
			$row=row($acceso);
			$total = trim($row["total"])+0;
			
			$data[$i]= array('instaladas' => $instaladas, 'cortados' => $cortados, 'reconectados' => $reconectados, 'reclamos' => $reclamos, 'otros' => $otros, 'total' => $total, 'anio' => $anio);
			
			$anio = $anio+1;
		}
		
		echo json_encode($data);

	break;
	
	case 'ordFinParam':
		
		$anio = array();
		$data = array();
		$fecha_i = $_POST['fecha_i'];
		$fecha_f = $_POST['fecha_f'];
		$franquicia = $_POST['franquicia'];
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		//Año		
		for($j = $fecha_i; $j <= $fecha_f; $j++){	
			$anio[] = $j;
		}
		
		$cantAnio = count($anio);
		
		for($i = 0; $i < $cantAnio; $i++){	

			$fec_ini = $anio[$i]."-01-01";
			$fec_fin = $anio[$i]."-12-31";
			
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_inst) AS instaladas FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$instaladas = trim($row["instaladas"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_corte) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$cortados = trim($row["cortados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_rec) as reconectados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$reconectados = trim($row["reconectados"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_reclamo) as reclamos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$reclamos = trim($row["reclamos"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_otras) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$otros = trim($row["otros"])+0;
			
			$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
			$row=row($acceso);
			$total = trim($row["total"])+0;
			
			$data[$i]= array('instaladas' => $instaladas, 'cortados' => $cortados, 'reconectados' => $reconectados, 'reclamos' => $reclamos, 'otros' => $otros, 'total' => $total, 'anio' => $anio[$i]);
			
		}
		
		echo json_encode($data);

	break;
	
	case 'ordFinParamMes':
		
		$mes = array();
		$data = array();
		$anio = $_POST['fecha_f'];
		$anioc = $anio+0;
		$franquicia = $_POST['franquicia'];
		$anio_actual = date("Y");
		$mes_actual = date("n"); //1 al 12
		
		if($franquicia == 0) $c_franquicia = "";
		else $c_franquicia = " and id_franq='$franquicia'"; 
		
		for($i = 0; $i <= 11; $i++){
			$j = $i+1;
			if($anioc == $anio_actual && $j > $mes_actual){
				break;
			}
			else{

				if($j < 10) $mes = "0".$j;
				else $mes = "$j";
				
				$fec_ini = $anio."-".$mes."-01";
				//obtenemos el ultimo dia del mes
				$acceso->objeto->ejecutarSql("select extract (day from (select date_trunc('month', DATE '$fec_ini') + interval '1 month') - interval '1 day') as ultimo");
				$row=row($acceso);
				$ultimo_dia = trim($row["ultimo"]);
				$fec_fin = $anio."-".$mes."-".$ultimo_dia;
				
				$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_inst) AS instaladas FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$instaladas = trim($row["instaladas"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_corte) as cortados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$cortados = trim($row["cortados"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_rec) as reconectados FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$reconectados = trim($row["reconectados"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_reclamo) as reclamos FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$reclamos = trim($row["reclamos"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_otras) as otros FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$otros = trim($row["otros"])+0;

				$acceso->objeto->ejecutarSql("SELECT sum(ord_fin_total) as total FROM cierre_historico where fecha_c between '$fec_ini' and '$fec_fin' $c_franquicia");
				$row=row($acceso);
				$total = trim($row["total"])+0;
				
				$mes = nombreMes($mes);
				$data[$i]= array('instaladas' => $instaladas, 'cortados' => $cortados, 'reconectados' => $reconectados, 'reclamos' => $reclamos, 'otros' => $otros, 'total' => $total, 'mes' => $mes, 'anio' => $anio);
				
			}
			
		}
		
		echo json_encode($data);

	break;

	case 'llamada_asig_resp':
		$desde=$valor[1];
		$hasta=$valor[2];
		$desde=formatfecha($desde);
		$hasta=formatfecha($hasta);
		//echo ":$desde:$hasta:";
		$data = array();
		
		$where="select  distinct (nombre || ' ' || apellido) as responsable,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all )) as total ,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='LLAMADO')) as llamadas_real,
sum((SELECT count(*) as cant FROM  asig_lla_cli,llamadas,detalle_resp where asig_lla_cli.id_lla=llamadas.id_lla and asig_lla_cli.id_all=asigna_llamada.id_all and llamadas.id_drl=detalle_resp.id_drl AND status_lc='LLAMADO' and id_trl='BG001')) as llamadas_atend,
sum((SELECT count(*) as cant FROM  asig_lla_cli,llamadas,detalle_resp where asig_lla_cli.id_lla=llamadas.id_lla and asig_lla_cli.id_all=asigna_llamada.id_all and llamadas.id_drl=detalle_resp.id_drl AND status_lc='LLAMADO' and id_trl='BG002')) as llamadas_no_atend,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='REGISTRADO')) as por_llamar,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as moroso ,
sum((SELECT count(*) as cant FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as pagado ,
sum(((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0) - 
(SELECT count(*) as cant FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0))) as pendiente ,
sum((SELECT sum(deuda) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all )) as deuda_moroso ,
sum((SELECT sum(monto_pago)  FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as monto_pagado,
sum(((SELECT sum(deuda) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all ) -
(SELECT sum(monto_pago)  FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0))) as monto_pendiente
from asigna_llamada,personausuario where asigna_llamada.login_resp=personausuario.login and fecha_all between '$desde' and '$hasta'  group by responsable";


		//PAGOS
		$acceso->objeto->ejecutarSql($where);
		$i=0;
		while($row=row($acceso)){
			$responsable = trim($row["responsable"]);
			$total = trim($row["total"])+0;
			$moroso = trim($row["moroso"])+0;
			$pagado = trim($row["pagado"])+0;
			$pendiente = trim($row["pendiente"])+0;
			$llamadas_real = trim($row["llamadas_real"])+0;
			$llamadas_atend = trim($row["llamadas_atend"])+0;
			$llamadas_no_atend = trim($row["llamadas_no_atend"])+0;
			$por_llamar = trim($row["por_llamar"])+0;
			$deuda_moroso = trim($row["deuda_moroso"])+0;
			$monto_pagado = trim($row["monto_pagado"])+0;
			$monto_pendiente = trim($row["monto_pendiente"])+0;
			$data[$i]= array('responsable' => $responsable, 
							'total' => $total, 
							'moroso' => $moroso, 
							'pagado' => $pagado, 
							'pendiente' => $pendiente,
							'llamadas_real' => $llamadas_real,
							'llamadas_atend' => $llamadas_atend,
							'llamadas_no_atend' => $llamadas_no_atend,
							'por_llamar' => $por_llamar,
							'deuda_moroso' => $deuda_moroso,
							'monto_pagado' => $monto_pagado,
							'monto_pendiente' => $monto_pendiente
							
							);
			$i++;
		}
		echo json_encode($data);


	break;
	case 'llamada_asig_ubic':
		$desde=$valor[1];
		$hasta=$valor[2];
		$desde=formatfecha($desde);
		$hasta=formatfecha($hasta);
		//echo ":$desde:$hasta:";
		$data = array();
		
		$where="select  distinct ubica_all,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all )) as total ,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='LLAMADO')) as llamadas_real,
sum((SELECT count(*) as cant FROM  asig_lla_cli,llamadas,detalle_resp where asig_lla_cli.id_lla=llamadas.id_lla and asig_lla_cli.id_all=asigna_llamada.id_all and llamadas.id_drl=detalle_resp.id_drl AND status_lc='LLAMADO' and id_trl='BG001')) as llamadas_atend,
sum((SELECT count(*) as cant FROM  asig_lla_cli,llamadas,detalle_resp where asig_lla_cli.id_lla=llamadas.id_lla and asig_lla_cli.id_all=asigna_llamada.id_all and llamadas.id_drl=detalle_resp.id_drl AND status_lc='LLAMADO' and id_trl='BG002')) as llamadas_no_atend,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='REGISTRADO')) as por_llamar,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as moroso ,
sum((SELECT count(*) as cant FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as pagado ,
sum(((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0) - 
(SELECT count(*) as cant FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0))) as pendiente ,
sum((SELECT sum(deuda) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all )) as deuda_moroso ,
sum((SELECT sum(monto_pago)  FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as monto_pagado,
sum(((SELECT sum(deuda) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all ) -
(SELECT sum(monto_pago)  FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0))) as monto_pendiente
from asigna_llamada where fecha_all between '$desde' and '$hasta'  group by ubica_all";


		//PAGOS
		$acceso->objeto->ejecutarSql($where);
		$i=0;
		while($row=row($acceso)){
			$responsable = trim($row["ubica_all"]);
			$total = trim($row["total"])+0;
			$moroso = trim($row["moroso"])+0;
			$pagado = trim($row["pagado"])+0;
			$pendiente = trim($row["pendiente"])+0;
			$llamadas_real = trim($row["llamadas_real"])+0;
			$llamadas_atend = trim($row["llamadas_atend"])+0;
			$llamadas_no_atend = trim($row["llamadas_no_atend"])+0;
			$por_llamar = trim($row["por_llamar"])+0;
			$deuda_moroso = trim($row["deuda_moroso"])+0;
			$monto_pagado = trim($row["monto_pagado"])+0;
			$monto_pendiente = trim($row["monto_pendiente"])+0;
			$data[$i]= array('responsable' => $responsable, 
							'total' => $total, 
							'moroso' => $moroso, 
							'pagado' => $pagado, 
							'pendiente' => $pendiente,
							'llamadas_real' => $llamadas_real,
							'llamadas_atend' => $llamadas_atend,
							'llamadas_no_atend' => $llamadas_no_atend,
							'por_llamar' => $por_llamar,
							'deuda_moroso' => $deuda_moroso,
							'monto_pagado' => $monto_pagado,
							'monto_pendiente' => $monto_pendiente
							
							);
			$i++;
		}
		echo json_encode($data);


	break;
	default:
		//echo titulo("El contenido de ".$clase." no esta Construdio Disculpe las molestias");
}

?>