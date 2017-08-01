<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require_once "../Clases/sms.php";


$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];
$status_pago = $_GET['status_pago'];
$sd = $_GET['sd'];
$sms = $_GET['sms'];

//echo ":$status_pago:";

if($id_franq!='' || $id_zona!='' || $id_sector!='' || $id_calle!=''  || $status_pago!=''){
	//,nombre_franq 
	if($sd==''){
		$sql=" 
		SELECT id_contrato,nro_contrato,cedula,apellido,nombre,telefono,telf_casa,telf_adic	
	   
	   FROM vista_contrato
	  WHERE 
	  ";
	}
	else{
		$sql=" 
		SELECT id_contrato,nro_contrato,cedula,apellido,nombre,telefono,telf_casa,telf_adic	
	   FROM vista_contrato
	  WHERE 
	  ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda WHERE contrato_servicio_deuda.id_contrato = vista_contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '$desde' and '$hasta')>0
	   and 
	  ";
	}
  
	//echo $sql;
	$where=  $sql;
	$tipo='';
	if($id_franq!=''){
		$where=$where. "(id_franq = '$id_franq')";
		$tipo='id_franq';
	}
	else if($id_zona!=''){
		$where=$where. "(id_zona ILIKE '%$id_zona%')";
		$tipo='id_zona';
	}
	else if($id_sector!=''){
		$where=$where. "(id_sector ILIKE '%$id_sector%')";
		$tipo='id_sector';
	}
	else if($id_calle!=''){
		$where=$where. "(id_calle ILIKE '%$id_calle%')";
		$tipo='id_calle';
	}
	else if($status_pago!=''){
		$where=$where. "(status_contrato ILIKE '%$status_pago%')";
		$tipo='status_pago';
	}
	
	if($tipo=='id_franq'){
		if($id_zona!=''){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
		}
		if($id_sector!=''){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		if($status_pago!=''){
			$where=$where. " and (status_contrato ILIKE '%$status_pago%')";
		}
		
	}
	else if($tipo=='id_zona'){
		if($id_sector!=''){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		if($status_pago!=''){
			$where=$where. " and (status_contrato ILIKE '%$status_pago%')";
		}
	}
	else if($tipo=='id_sector'){
		if($id_calle!=''){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		if($status_pago!=''){
			$where=$where. " and (status_contrato ILIKE '%$status_pago%')";
		}
		
	}
	else if($tipo=='id_calle'){
		if($status_pago!=''){
			$where=$where. " and (status_contrato ILIKE '%$status_pago%')";
		}
		
	}
	
}





	$objeto=new sms();
	$acce=conexion();
	$cable=conexion();
  $acceso->objeto->ejecutarSql($where);
	$i=0;
	
	
   
   echo '
			<table border="0" width="100%" align="CENTER" >
				<tr>
					<td >
						<span class="fuenteN">Nro</span>
					</td>
					<td >
						<span class="fuenteN">nro abonado</span>
					</td>
					<td >
						<span class="fuenteN">Nombre</span>
					</td>
					<td >
						<span class="fuenteN">Telefonos</span>
					</td>
				</tr>
   ';
   
	while($row=row($acceso)){
		$id_contrato=trim($row["id_contrato"]);
		$nro_contrato=trim($row["nro_contrato"]);
		$nombre=trim($row["nombre"])." ".trim($row["apellido"]);
		
		$telefono=trim($row["telefono"]);
		$telf_casa=trim($row["telf_casa"]);
		$telf_adic=trim($row["telf_adic"]);
		$num_telef='';
		
					if(strlen($telefono)==11 || strlen($telf_casa)==11 || strlen($telf_adic)==11){
						if(strlen($telefono)==11){
							$num_telef=$telefono;
							if(strlen($telf_casa)==11){
								$num_telef=$num_telef.';'.$telf_casa;
							}
							if(strlen($telf_adic)==11){
								$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else if(strlen($telf_casa)==11){
							$num_telef=$telf_casa;
							if(strlen($telf_adic)==11){
								$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else if(strlen($telf_adic)==11){
							$num_telef=$telf_adic;
						}
					}
					
		if($num_telef!="" && $num_telef!="00000000000"){
			$i++;
			
						$mensaje=$sms;
						//echo "<br>:$id_contrato:$mensaje:";
						$dato=$objeto->obtenerSmsCon($cable,$id_contrato);
						$mensaje=$objeto->obtenerMensajeSms($cable,$dato,$mensaje);
						//echo "::$mensaje:";
						$mensaje=strtoupper(utf8_decode($mensaje));
			
			$objeto->EnviarSMSUnico($acce,$num_telef,$mensaje,$id_contrato);
			
			echo '
				<tr>
					<td >
						<span class="fuente">'.$i.'</span>
					</td>
					<td >
						<span class="fuente">'.$nro_contrato.'</span>
					</td>
					<td >
						<span class="fuente">'.$nombre.'</span>
					</td>
					<td >
						<span class="fuente">'.$num_telef.'</span>
					</td>
				</tr>
		';
		}
	}

?>
