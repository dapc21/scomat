<?php
function sql($select){
	return "select * from ".$select;
}

function acceso($acceso,$cadena){	
	$acceso->objeto->ejecutarSql($cadena);	
	return $acceso;
}

function row($acceso){
	if($row=$acceso->objeto->devolverRegistro()){		
		$acceso->objeto->siguienteRegistro();
		return $row;
	}else
		return false;
}

function consulta($tabla,$dato,$codigo,$orde){	
	$select=$tabla." where ".$dato."="."'".$codigo."'".$orde;	
	return $select;	
}

function condicion($tabla,$dato,$codigo,$dato1,$codigo1,$dato2,$codigo2){	
	$select=$tabla." where ".$dato."="."'".$codigo."' and ".$dato1."="."'".$codigo1."' and " .$dato2."="."'".$codigo2."'";	
	return $select;	
}

function separa($s){
	$j=0;	
	$cad='';
	$valor=true;
	for($i=0; $i<strlen($s);$i++){
		if(numero($s[$i])==true){
				break;
		}
	}
	for($j=$i; $j<strlen($s);$j++){
		$cad.=$s[$j];
	}
	$num=0;
	$num+=$cad;
	return $num;
}
//permite saber si una funcion es numero
function numero($s)
{
	$j=0;
	$valor=false;
	for($j=1; $j<10;$j++){
		if($s==$j){
			$valor=true;
		}
	}
	return $valor;
}
function verNumero($acceso,$valor){
	$row=row($acceso);
	$val=$row[$valor];
	$cont=separa($val);
		$cont++;
	return $cont;	
}
//devuelve el incremento del ultimo numero de un campo de 3 digitos
function verCodigo($acceso,$valor){
	$row=row($acceso);
	$val=$row[$valor];
	$cont=separa($val);
		$cont++;
		
		if($cont<10)
			$cont="0".$cont;
		if($cont<100)
			$cont="0".$cont;	
	return $cont;	
}
//devuelve el incremento del ultimo numero de un campo de 5 digitos
function verCo($acceso,$valor){
	
	$cont = verCodigo($acceso,$valor);
		if($cont<1000)
			$cont="0".$cont;
		if($cont<10000)
			$cont="0".$cont;
	return $cont;	
}
//devuelve el incremento del ultimo numero de un campo de 5 digitos
function verCodLong($acceso,$valor){	
	$cont = verCo($acceso,$valor);
		if($cont<100000)
			$cont="0".$cont;
		if($cont<1000000)
			$cont="0".$cont;
		if($cont<10000000)
			$cont="0".$cont;
	return $cont;	
}
function verCodFact($acceso,$valor){	
	$cont = verCo($acceso,$valor);
		if($cont<100000)
			$cont="0".$cont;
		if($cont<1000000)
			$cont="0".$cont;

	return $cont;	
}

function verCodLargo($acceso,$valor){	
	$cont = verCodLong($acceso,$valor);
		if($cont<100000000)
			$cont="0".$cont;
		if($cont<1000000000)
			$cont="0".$cont;
	return $cont;	
}
//retorna una lista o seleccion con todos los perfiles
function perfil($acceso){
	$cad=opcion(0,"Selecciones...");
	$acceso->objeto->ejecutarSql(sql("perfil"));
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["codigoperfil"]),trim($row["nombreperfil"]));		
	}								
	return $cad;	
}
//devuelve todos los modulos registrados en checkbox
function seguridadPerfil($acceso){
	$cadena="";
	$cont=0;
	while ($row=row($acceso))
	{
		$cadena=$cadena.checkBoxPerfil($row[1],"modulo",$row[0],$cont);			
		$cont=$cont+4;
	}	
		$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre('seleccion').' onchange=\'seleccionCheck()\'').fuente('Seleccionar todo'),2,1));
	return $cadena;	
}
//devuelve todos las permisologias de los modulos registrados en checkbox
function checkBoxPerfil($nombre,$name,$valor,$cont){
	return fila(colspan('<table border="0" width="400px" align="CENTER"><tr><td width="150px">'.input(tipo("checkbox").nombre($name).valor($valor).' onchange=\'asignaCheck('.$cont.')\'').fuente($nombre).'</td><td>'.input(tipo("checkbox").nombre($name).valor('incluir')).fuente('Incluir').'</td><td>'.input(tipo("checkbox").nombre($name).valor('modificar')).fuente('Modificar').'</td><td>'.input(tipo("checkbox").nombre($name).valor('eliminar')).fuente('Eliminar').'</td></tr></table>',2,1));
}
//para hacer la consulta a modulo y llamar a seguridadPerfil
function perfiles($acceso){
	$acceso->objeto->ejecutarSql(sql("modulo ORDER BY codigomodulo"));	
	return seguridadPerfil($acceso);
}
//para hacer la consulta a perfil y llamar a seguridadPerfil
function modulos($acceso){
	$acceso->objeto->ejecutarSql(sql("perfil ORDER BY codigoperfil"));		
	return seguridadPerfil($acceso);
}

function verTecnicos($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from vista_tecnico order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function verVendedores($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from vista_vendedor order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function verCobradores($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from vista_cobrador order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function traerTOStatus($acceso,$status_contrato){
	$cad=opcion(0,"Seleccione...");
	$dato=lectura($acceso,"select *from tipo_orden order By nombre_tipo_orden");
	for($i=0;$i<count($dato);$i++){
		$id_tipo_orden=trim($dato[$i]["id_tipo_orden"]);
		$acceso->objeto->ejecutarSql("select *from vista_detalleorden where tipo_detalle='$status_contrato' and id_tipo_orden='$id_tipo_orden'");
		if($row=row($acceso))
		{
			$cad=$cad.opcion(trim($dato[$i]["id_tipo_orden"]),trim($dato[$i]["nombre_tipo_orden"]));
		}
	}
	return $cad;	
}
function verTipoOrden($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from tipo_orden order By nombre_tipo_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_orden"]),trim($row["nombre_tipo_orden"]));
	}
	return $cad;	
}
function cargarDO($acceso,$id_tipo_orden){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from detalle_orden where id_tipo_orden='$id_tipo_orden' order By nombre_det_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;	
}
function verDetalleOrden($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from detalle_orden order By nombre_det_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;	
}
function verFranquicia($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from franquicia");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_franq"]),trim($row["nombre_franq"]));
	}
	return $cad;	
}
function verZona($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from zona order By nro_zona");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_zona"]),trim($row["nro_zona"])." => ".trim($row["nombre_zona"]));
	}
	return $cad;	
}
function verCajaAbierta($acceso){
	$fecha= date("Y-m-d");
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from vista_caja where status_caja='Abierta' and status_caja_cob='Abierta' and fecha_caja='$fecha' order By nombre_caja");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_caja_cob"]),trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function verCajaActiva($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from caja where status_caja='Activa' order By nombre_caja");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_caja"]),trim($row["nombre_caja"]));
	}
	return $cad;	
}
function cargarZona($acceso,$id_franq){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from zona where id_franq='$id_franq' order By nro_zona");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_zona"]),trim($row["nro_zona"])." => ".trim($row["nombre_zona"]));
	}
	return $cad;	
}
function verSector($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from sector order By nro_sector");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_sector"]),trim($row["nro_sector"])." => ".trim($row["nombre_sector"]));
	}
	return $cad;	
}
function cargarSector($acceso,$id_zona){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from sector where id_zona='$id_zona' order By nro_sector");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_sector"]),trim($row["nro_sector"])." => ".trim($row["nombre_sector"]));
	}
	return $cad;	
}
function cargarEdif($acceso,$id_calle){
	$cad=opcion('',"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from edificio where id_calle='$id_calle' order By edificio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["edificio"]),trim($row["edificio"]));
	}
	return $cad;	
}
function verBanco($acceso){
	$cad=opcion('',"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from banco order By banco");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["banco"]),trim($row["banco"]));
	}
	return $cad;	
}
function verEdif($acceso){
	$cad=opcion('',"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from edificio order By edificio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["edificio"]),trim($row["edificio"]));
	}
	return $cad;	
}

function verCalle($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from calle order By nro_calle");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_calle"]),trim($row["nro_calle"])." => ".trim($row["nombre_calle"]));
	}
	return $cad;	
}
function cargarTipoSer($acceso,$id_franq){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from tipo_servicio where status_servicio='Activo' and id_franq='$id_franq'");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_servicio"]),trim($row["tipo_servicio"]));
	}
	return $cad;	
}
function verTipoSer($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from tipo_servicio where status_servicio='Activo'  and id_franq='1'");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_servicio"]),trim($row["tipo_servicio"]));
	}
	return $cad;	
}
function cargarServicioMensual($acceso,$id_tipo_servicio){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='Activo' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function cargarServicio($acceso,$id_tipo_servicio){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='Activo' and id_tipo_servicio='$id_tipo_servicio'order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServicioMensualCable($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='Activo' and id_tipo_servicio='TSE00001' and tipo_costo='COSTO MENSUAL' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServicioMensual($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='Activo' and tipo_costo='COSTO MENSUAL' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServiciosCostoU($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='Activo' and tipo_costo='COSTO UNICO' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServicios($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='Activo' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServiciosCable($acceso){
	$cad=opcion(0,"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='Activo' and id_tipo_servicio='TSE00001' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verTipoPago($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from tipo_pago where status_pago='Activo' order By id_tipo_pago");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_pago"]),trim($row["tipo_pago"]));
	}
	return $cad;	
}
function lectura($acceso,$sql){
	$acceso->objeto->ejecutarSql($sql);
	$i=0;
	$datoPaq=array();
	while($row=row($acceso)){
		$datoPaq[$i]=$row;
		$i++;
	}
	return $datoPaq;
}
function formatofecha($date)
{
	$valor=explode("-",trim($date));
	$fecha= $valor[2].'/'.$valor[1].'/'.$valor[0];
	return $fecha;
}

function formatfecha($date)
{
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$date))
		list($dia,$mes,$ano)=explode("/", $date);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$date))
		list($dia,$mes,$ano)=explode("-",$date);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$date))
		list($ano,$mes,$dia)=explode("-",$date);
	
	
	//$valor=explode("/",trim($date));
	$fecha= $ano.'-'.$mes.'-'.$dia;
	return $fecha;
}
function calMontoCD($acceso,$fecha){
	//$fecha= date("Y-m-d");
	$suma=0;
		 //echo "select *from vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA'";
		$acceso->objeto->ejecutarSql("select *from vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA'");
		while($row=row($acceso))
		{
				$monto=trim($row["monto_acum"]);
				$suma=$suma+$monto;
			
		}
	
	return $suma;
}

function formato_mes($me){
	$mes=array("01"=>"Enero","02"=>"Febre","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agost","09"=>"Septi","10"=>"Octub","11"=>"Novie","12"=>"Dicie");
	return strtoupper($mes[$me]);
}
function formato_mes_com($me){
	$mes=array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
	return strtoupper($mes[$me]);
}

		$formato_anio=array("1970"=>"Mil Novecientos Setenta","1971"=>"Mil Novecientos Setenta y Uno","1972"=>"Mil Novecientos Setenta y Dos","1973"=>"Mil Novecientos Setenta y Tres","1974"=>"Mil Novecientos Setenta y Cuatro","1975"=>"Mil Novecientos Setenta y Cinco","1976"=>"Mil Novecientos Setenta y Seis","1977"=>"Mil Novecientos Setenta y Siete","1978"=>"Mil Novecientos Setenta y Ocho","1979"=>"Mil Novecientos Setenta y Nueve","1980"=>"Mil Novecientos Ochenta","1981"=>"Mil Novecientos Ochenta y Uno","1982"=>"Mil Novecientos Ochenta y Dos","1983"=>"Mil Novecientos Ochenta y Tres","1984"=>"Mil Novecientos Ochenta y Cuatro","1985"=>"Mil Novecientos Ochenta y Cinco","1986"=>"Mil Novecientos Ochenta y Seis","1987"=>"Mil Novecientos Ochenta y Siete","1988"=>"Mil Novecientos Ochenta y Ocho","1989"=>"Mil Novecientos Ochenta y Nueve","1990"=>"Mil Novecientos Noventa","1991"=>"Mil Novecientos Noventa y Uno","1992"=>"Mil Novecientos Noventa y Dos","1993"=>"Mil Novecientos Noventa y Tres","1994"=>"Mil Novecientos Noventa y Cuatro","1995"=>"Mil Novecientos Noventa y Cinco","1996"=>"Mil Novecientos Noventa y Seis","1997"=>"Mil Novecientos Noventa y Siete","1998"=>"Mil Novecientos Noventa y Ocho","1999"=>"Mil Novecientos Noventa y Nueve","2000"=>"Dos Mil","2001"=>"Dos Mil Uno","2002"=>"Dos Mil Dos","2003"=>"Dos Mil Tres","2004"=>"Dos Mil Cuatro","2005"=>"Dos Mil Cinco","2006"=>"Dos Mil Seis","2007"=>"Dos Mil Siete","2008"=>"Dos Mil Ocho","2009"=>"Dos Mil Nueve","2010"=>"Dos Mil Diez","2011"=>"Dos Mil Once","2012"=>"Dos Mil Doce","2013"=>"Dos Mil Trece","2014"=>"Dos Mil Catorce","2015"=>"Dos Mil Quince","2016"=>"Dos Mil Diesiseis","2017"=>"Dos Mil Diesisiete","2018"=>"Dos Mil Diesiocho","2019"=>"Dos Mil Diesinueve","2020"=>"Dos Mil Veinte","2021"=>"Dos Mil Veintiuno","2022"=>"Dos Mil Veintidos","2023"=>"Dos Mil Veintitres","2024"=>"Dos Mil Veinticuatro","2025"=>"Dos Mil Veinticinco","2026"=>"Dos Mil Veintiseis","2027"=>"Dos Mil Veintisiete","2028"=>"Dos Mil Veintiocho","2029"=>"Dos Mil Veintinueve","2030"=>"Dos Mil Treinta");
		
		$formato_dia=array("01"=>"un","02"=>"dos","03"=>"tres","04"=>"cuatro","05"=>"cinco","06"=>"seis","07"=>"siete","08"=>"ocho","09"=>"nueve","10"=>"diez","11"=>"once","12"=>"Doce","13"=>"Chuquiti","14"=>"catorce","15"=>"quince","16"=>"dieciseis","17"=>"diesiciete","18"=>"diesiocho","19"=>"diesinueve","20"=>"veinte","21"=>"veintiun","22"=>"veintidos","23"=>"veintitres","24"=>"veinticuatro","25"=>"veinticinco","26"=>"veintiseis","27"=>"veintisiete","28"=>"veintiocho","29"=>"veintinueve","30"=>"treinta","31"=>"treintiun");
		$formato_hora=array("1"=>" la una","02"=>" las dos","03"=>" las tres","04"=>"las cuatro","05"=>"las cinco","06"=>"la seis","07"=>"la siete","08"=>"las ocho","09"=>"las nueve","10"=>"las diez","11"=>"las once","12"=>"las Doce","13"=>"la Una","14"=>"las Dos","15"=>"las Tres","16"=>"las Cuatro","17"=>"las Cinco","18"=>"las Seis","19"=>"las Siete","20"=>"las Ocho","21"=>"las Nueve","22"=>"las Diez","23"=>"las Once","24"=>"las Doce");
		$formato_minutos=array("1"=>"un minuto","02"=>"dos minutos","03"=>"tres minutos","04"=>"cuatro minutos","05"=>"cinco minutos","06"=>"seis minutos","07"=>"siete minutos","08"=>"ocho minutos","09"=>"nueve minutos","10"=>"diez minutos","11"=>"once minutos","12"=>"Doce minutos","13"=>"Trece minutos","14"=>"catorce minutos","15"=>"quince minutos","16"=>"dieciseis minutos","17"=>"diesiciete minutos","18"=>"diesiocho minutos","19"=>"diesinueve minutos","20"=>"veinte minutos","21"=>"veintiun minutos","22"=>"veintidos minutos","23"=>"veintitres minutos","24"=>"veinticuatro minutos","25"=>"veinticinco minutos","26"=>"veintiseis minutos","27"=>"veintisiete minutos","28"=>"veintiocho minutos","29"=>"veintinueve minutos","30"=>"treinta minutos","31"=>"treintaiun minutos","32"=>"treintaidos minutos","33"=>"treintaitres minutos","34"=>"treintaicuatro minutos","35"=>"treintaicinco minutos","36"=>"treintaiseis minutos","37"=>"treintaisiete minutos","38"=>"treintaiocho minutos","39"=>"treintainueve minutos","40"=>"cuarenta minutos","41"=>"cuarentaiun minutos","42"=>"cuarentaidos minutos","43"=>"cuarentaitres minutos","44"=>"cuarentaicuatro minutos","45"=>"cuarentaicinco minutos","46"=>"cuarentaiseis minutos","47"=>"cuarentaiseiete minutos","48"=>"cuarentaiocho minutos","49"=>"cuarentainueve minutos","50"=>"cincuenta minutos","51"=>"cincuentaiun minutos","52"=>"cincuentaidos minutos","53"=>"cincuentaitres minutos","54"=>"cincuentaicuatro minutos","55"=>"cincuentaicinco minutos","56"=>"cincuentaiseis minutos","57"=>"cincuentaisiete minutos","58"=>"cincuentaiocho minutos","59"=>"cincuentainueve minutos");
		$formato_ampm=array("1"=>"de la mañana","2"=>"de la mañana","3"=>"de la mañana","4"=>"de la mañana","5"=>"de la mañana","6"=>"de la mañana","7"=>"de la mañana","8"=>"de la mañana","9"=>"de la mañana","10"=>"de la mañana","11"=>"de la mañana","12"=>"de la tarde","13"=>"de la tarde","14"=>"de la tarde","15"=>"de la tarde","16"=>"de la tarde","17"=>"de la tarde","18"=>"de la noche","19"=>"de la noche","20"=>"de la noche","21"=>"de la noche","22"=>"de la noche","23"=>"de la noche","24"=>"de la noche");
		$formato_trimes=array("01"=>"primer trimestre","02"=>"primer trimestre","03"=>"primer trimestre","04"=>"segundo trimestre","05"=>"segundo trimestre","06"=>"segundo trimestre","07"=>"tercer trimestre","08"=>"tercer trimestre","09"=>"tercer trimestre","10"=>"cuarto trimestre","11"=>"cuarto trimestre","12"=>"cuarto trimestre");
function sumames($fecha){
//$fecha = "2010-01-08";
$enunmes = explode ( "-", $fecha );
$sumaunmes = mktime ( 0, 0, 0, date("$enunmes[1]") + 1, date("$enunmes[2]"), date("$enunmes[0]") );
return date ("Y-m-d", $sumaunmes);
}

function verMesCorte(){
	$fecha = date("Y-m-d");
	$cad='';
	for($i=0;$i<10;$i++){
		$enunmes = explode ( "-", $fecha );
		$sumaunmes = mktime ( 0, 0, 0, date("$enunmes[1]") - $i, date("$enunmes[2]"), date("$enunmes[0]") );
		$fechaAnt=date ("Y-m-d", $sumaunmes);
		$fec = explode ( "-",$fechaAnt );
			$mes=$fec[1];
			$anio=$fec[0];
			$f_mes=formato_mes_com($mes);
			
			$cad=$cad."<option value='$anio-$mes-01'>$f_mes $anio</option>";
	}
	return $cad;
}
function utf8_d($valor){
	return strtoupper(utf8_decode($valor));
}
function costoContrato($acceso){
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='1'");
		if($row=row($acceso)){
				return trim($row["valor_param"]);
		}
}

function verCodLongInc($acceso,$valor){	
	$cont=separa($valor);
	$cont++;
		if($cont<10)
			$cont="0".$cont;
		if($cont<100)
			$cont="0".$cont;
		if($cont<1000)
			$cont="0".$cont;
		if($cont<10000)
			$cont="0".$cont;
		if($cont<100000)
			$cont="0".$cont;
		if($cont<1000000)
			$cont="0".$cont;
		if($cont<10000000)
			$cont="0".$cont;
	return $cont;	
}

function verCodLongInc_pago($acceso,$valor){	
	$cont=separa($valor);
	$cont++;
		if($cont<10)
			$cont="0".$cont;
		if($cont<100)
			$cont="0".$cont;
		if($cont<1000)
			$cont="0".$cont;
		if($cont<10000)
			$cont="0".$cont;
		if($cont<100000)
			$cont="0".$cont;
		if($cont<1000000)
			$cont="0".$cont;
		if($cont<10000000)
			$cont="0".$cont;
		if($cont<100000000)
			$cont="0".$cont;
		if($cont<1000000000)
			$cont="0".$cont;
	return $cont;	
}

?>