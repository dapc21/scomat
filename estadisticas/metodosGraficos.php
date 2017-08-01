<?php  
$mes_letra=array("1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre","01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre");
$dias_num=array("1"=>"01","2"=>"02","3"=>"03","4"=>"04","5"=>"05","6"=>"06","7"=>"07","8"=>"08","9"=>"09","10"=>"10","11"=>"11","12"=>"12","01"=>"01","02"=>"02","03"=>"03","04"=>"04","05"=>"05","06"=>"06","07"=>"07","08"=>"08","09"=>"09");
//require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];  

function ver_meses($acceso,$anio){
	$meses = array();
	$fec_ini="$anio-01-01";
	$fec_fin="$anio-12-31";
	$acceso->objeto->ejecutarSql("SELECT fecha_pago FROM pagos where fecha_pago between '$fec_ini' and '$fec_fin' ORDER BY fecha_pago asc LIMIT 1 offset 0");
	$row=row($acceso);
	$fecha_inicio = trim($row["fecha_pago"]);
	$valor=explode("-",$fecha_inicio);
	$meses[0]=$valor[1]+0;
	//echo "<br>ini:$meses[0]:";

	$acceso->objeto->ejecutarSql("SELECT fecha_pago FROM pagos where fecha_pago between '$fec_ini' and '$fec_fin' ORDER BY fecha_pago desc LIMIT 1 offset 0");
	$row=row($acceso);
	$fecha_fin = trim($row["fecha_pago"]);
	$valor=explode("-",$fecha_fin);
	$meses[1]=$valor[1]+0;
	//echo "<br>fin:$meses[1]:";
	return $meses;	
}


function ver_anios_asc($acceso){

	$meses = array();
	
	$acceso->objeto->ejecutarSql("SELECT distinct extract(year from fecha_c) as anio FROM cierre_historico order by anio asc");
	$row=row($acceso);
	$fecha_inicio = trim($row["anio"]);
	$meses[0]=$fecha_inicio;
	
	$acceso->objeto->ejecutarSql("SELECT distinct extract(year from fecha_c) as anio FROM cierre_historico order by anio desc");
	$row=row($acceso);
	$fecha_fin = trim($row["anio"]);
	$meses[1]=$fecha_fin;
	
	return $meses;
}

function verAniosAsc($acceso){
	$cad='';
	$valor=ver_anios_asc($acceso);
	$inicio=$valor[0];
	$fin=$valor[1];
	
	for($i=$inicio;$i<=$fin;$i++){
		$cad.='<option value="'.$i.'">'.$i.'</option>';
	}

	return $cad;	
}

function ver_anios_desc($acceso){
	
	$meses = array();
	
	$acceso->objeto->ejecutarSql("SELECT distinct extract(year from fecha_c) as anio FROM cierre_historico order by anio asc");
	$row=row($acceso);
	$fecha_inicio = trim($row["anio"]);
	$meses[0]=$fecha_inicio;
	
	$acceso->objeto->ejecutarSql("SELECT distinct extract(year from fecha_c) as anio FROM cierre_historico order by anio desc");
	$row=row($acceso);
	$fecha_fin = trim($row["anio"]);
	$meses[1]=$fecha_fin;
	
	return $meses;
}

function verAniosDesc($acceso){
	$cad='';
	$valor=ver_anios_desc($acceso);
	$inicio=$valor[0];
	$fin=$valor[1];
	
	for($i=$fin;$i>=$inicio;$i--){
		$cad.='<option value="'.$i.'">'.$i.'</option>';
	}

	return $cad;	
}

function rango_doble($data,$data1){
	$rango = array();
	sort($data);
	sort($data1);
	
	$va1=$data[0];
	$va2=$data1[0];
	if($va1<$va2){
		$val="$va1";
	}
	else{
		$val="$va2";
	}
	
	$pri=$val[0];
	$v_u=valor_unidad($val);
	$red=valor_rango($val);
	//echo "<br>unidad:$v_u:$red:$pri";
	if($pri>4){
		$rango[0]=$red-($v_u*2);
	}
	else if($pri==1){
		$rango[0]=$red-(($v_u/10)*3);
	}
	else{
		$rango[0]=$red-$v_u;
	}
	
	if($rango[0]<100){
		$rango[0]=0;
	}
	
	//$rango[0]=0;
	
	$num=count($data)-1;
	$va1="$data[$num]";
	
	$num=count($data1)-1;
	$va2="$data1[$num]";
	
	if($va1>$va2){
		$val="$va1";
	}
	else{
		$val="$va2";
	}
	$pri=$val[0];
	$v_u=valor_unidad($val);
	$red=valor_rango($val);
	//echo "<br>unidad:$v_u:$red:$pri";
	if($pri>4){
		$rango[1]=$red+($v_u*2);
	}
	else{
		$rango[1]=$red+$v_u;
	}
	
	if($rango[1]>20 && $rango[1]<200){
		$rango[1]=200;
	}
	

	return $rango;
}
function rango($data){
	$rango = array();
	sort($data);
	$val="$data[0]";
	
	$pri=$val[0];
	$v_u=valor_unidad($val);
	$red=valor_rango($val);
	//echo "<br>unidad:$v_u:$red:$pri";
	if($pri>4){
		$rango[0]=$red-($v_u*2);
	}
	else{
		$rango[0]=$red-$v_u;
	}
	//$rango[0]=0;
	
	$num=count($data)-1;
	$val="$data[$num]";
	$pri=$val[0];
	$v_u=valor_unidad($val);
	$red=valor_rango($val);
	//echo "<br>unidad:$v_u:$red:$pri";
	if($pri>4){
		$rango[1]=$red+($v_u*2);
	}
	else{
		$rango[1]=$red+$v_u;
	}
	return $rango;
}

function valor_rango($val){
	$valor=explode(".",$val);
	$val=$valor[0];
	
	$pri=$val[0];
	for($i=1;$i<strlen($val);$i++){
		$pri=$pri*10;
	}
	return $pri;
}

function valor_unidad($val){
	$valor=explode(".",$val);
	$val=$valor[0];
	
	$pri=1;
	for($i=1;$i<strlen($val);$i++){
		$pri=$pri*10;
	}
	return $pri;
}
function verCant($acceso,$sql){
	$acceso->objeto->ejecutarSql($sql);
	$row=row($acceso);
	$total = trim($row["total"])+0;
	
	//echo "<br>$total:$sql";
	return $total;
}
function verCli_a($acceso,$anio){
	$suma=0;
	for($i=1;$i<=12;$i++){
		$fec_ini="$anio-0$i-01";
		//
		$suma+=verCant($acceso,"select count(DISTINCT id_contrato) as total from contrato_servicio where id_serv='SER00001' and fecha_inst = '$fec_ini'");
		echo "<br>$suma:";
		echo "select count(DISTINCT id_contrato) as total from contrato_servicio where id_serv='SER00001' and fecha_inst = '$fec_ini'";
	}
	
}


?>