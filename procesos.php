<?php
/*
//crea la conexion con la base de datos
if (@!file_exists("DataBase/Acceso.php")){
	$fp = fopen("DataBase/Acceso_temp.php","r");
	$id = fopen("DataBase/Acceso.php","w+");
	while($linea= fgets($fp))
	{
		fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
}
*/

require_once("DataBase/Acceso.php");
$acceso=conexion();
require_once("Programador/formulario.php");
require_once "idiomas/config.php";
	global $carpeta_idioma;	
	global $nombre_idioma;
	/*
	putenv('LC_ALL='.$carpeta_idioma);  
    setlocale(LC_ALL, $carpeta_idioma.'.UTF8');  
    bindtextdomain("$nombre_idioma",  "./idiomas");  
    textdomain($nombre_idioma);  
	*/
	/*
	putenv('LC_ALL=en_US');
    setlocale(LC_ALL, 'en_US.UTF8');
    //Establecemos en que  directorio se encuentran las traducciones  
    bindtextdomain("ingles",  "./idiomas	");
    //Elegimos  el dominio (aka tabla o fichero)
    textdomain("ingles");
	*/
//funcion que permite separar los digitos alfabeticos y numericos de una cadena

$acceso->objeto->ejecutarSql("select *from parametros where id_param='5'");
$row=row($acceso);
$nombre_empresa=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='6'");
$row=row($acceso);
$tipo_serv=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='15'");
$row=row($acceso);
$dir_fiscal=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='16'");
$row=row($acceso);
$dir_adic=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='17'");
$row=row($acceso);
$telefonos=trim($row['valor_param']);


		$acceso->objeto->ejecutarSql("select *from parametros where id_param='57' and id_franq='1'");
		$row=row($acceso);
		$logo=trim($row['valor_param']);

		$acceso->objeto->ejecutarSql("select *from parametros where id_param='58' and id_franq='1'");
		$row=row($acceso);
		$ancho_logo=trim($row['valor_param']);

function logo(){
	global $logo;
	return $logo;
}
function ancho_logo(){
	global $ancho_logo;
	return $ancho_logo;
}
		
// where ( ILIKE '$ini_u%') 
function actualizarDeuda($acceso,$id_contrato){
	return;
	/*
					$acceso->objeto->ejecutarSql("select sum(cant_serv * costo_cobro) as deuda from contrato_servicio_deuda where id_contrato='$id_contrato' and status_con_ser='DEUDA'");
					if($fila=row($acceso)){
						$deuda = trim($fila['deuda']);
						//echo "<br>Update contrato Set deuda='$deuda' Where id_contrato='$id_contrato'";
						$acceso->objeto->ejecutarSql("Update contrato Set deuda='$deuda' Where id_contrato='$id_contrato'");
					}
					*/
}
function nombre_empresa(){
	global $nombre_empresa;
	return $nombre_empresa;
}
function tipo_serv(){
	global $tipo_serv;
	return $tipo_serv;
}
function direc_fiscal(){
	global $dir_fiscal;
	return $dir_fiscal;
}
function direc_adicional(){
	global $dir_adic;
	return $dir_adic;
}
function telef_emp(){
	global $telefonos;
	return $telefonos;
}
function separa($s){
	if(is_int($s)){
		return $s+0;
	}
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
function verNumero_abonado($acceso,$valor){
	$row=row($acceso);
	$val=$row[$valor];
	//echo ":$val:<br>";
	$val=substr($val,3,8);
	//echo ":$val:<br>";
	$cont=separa($val);
		$cont++;
		$codigo="$cont";
		if($cont<10)
			$codigo="0".$codigo;
		if($cont<100)
			$codigo="0".$codigo;
		if($cont<1000)
			$codigo="0".$codigo;
		if($cont<10000)
			$codigo="0".$codigo;
		if($cont<100000)
			$codigo="0".$codigo;
		if($cont<100000)
			$codigo="0".$codigo;
		if($cont<1000000)
			$codigo="0".$codigo;
	return $codigo;	
}
//devuelve el incremento del ultimo numero de un campo de 3 digitos
function verCF($acceso,$valor){
	$row=row($acceso);
	$val=$row[$valor];
	$cont=separa($val);
		$cont++;
		
		if($cont<10)
			$cont="0".$cont;
		if($cont<100)
			$cont="0".$cont;
		if($cont<1000)
			$cont="0".$cont;
	return $cont;	
}
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
function verCoo($acceso,$valor){

	$cont = verCodigo($acceso,$valor);
		if($cont<1000)
			$cont="0".$cont;
		if($cont<10000)
			$cont="0".$cont;
		if($cont<100000)
			$cont="0".$cont;
	return $cont;	
}

function verCoo_inc($acceso,$cont){
	$cont=separa($cont);
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
	return $cont;
}
function verCo_inc($cont){
	$cont=separa($cont);
		$cont++;
		if($cont<10)
			$cont="0".$cont;
		if($cont<100)
			$cont="0".$cont;	
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
function verCod_cli($acceso,$ini_u){
	if($ini_u==''){
		session_start();
		$ini_u = $_SESSION["ini_u"];  
	}
	$acceso->objeto->ejecutarSql("select id_persona from persona  where (id_persona ILIKE '$ini_u%')  ORDER BY id_persona desc LIMIT 1 offset 0 "); 
	$cod = $ini_u.verCodLong($acceso,"id_persona");
	do{
		$acceso->objeto->ejecutarSql("select id_persona from persona  where id_persona = '$cod'  ORDER BY id_persona desc LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
			//echo "<br>$cod";
		}
		else{
			$existe=false;
		}
	}while($existe==true);
	do{
		$acceso->objeto->ejecutarSql("select id_persona from cliente  where id_persona = '$cod'  ORDER BY id_persona desc LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		}
		else{
			$existe=false;
		}
	}while($existe==true);
	do{
		$acceso->objeto->ejecutarSql("select id_persona from tecnico  where id_persona = '$cod'  ORDER BY id_persona desc LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		}
		else{
			$existe=false;
		}
	}while($existe==true);
	do{
		$acceso->objeto->ejecutarSql("select id_persona from vendedor  where id_persona = '$cod'  ORDER BY id_persona desc LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		}
		else{
			$existe=false;
		}
	}while($existe==true);
	do{
		$acceso->objeto->ejecutarSql("select id_persona from cobrador  where id_persona = '$cod'  ORDER BY id_persona desc LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		}
		else{
			$existe=false;
		}
	}while($existe==true);
	do{
		$acceso->objeto->ejecutarSql("select id_persona from gerentes_permitidos  where id_persona = '$cod'  ORDER BY id_persona desc LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		}
		else{
			$existe=false;
		}
	}while($existe==true);
	do{
		$acceso->objeto->ejecutarSql("select id_persona from entidad  where id_persona = '$cod'  ORDER BY id_persona desc LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		}
		else{
			$existe=false;
		}
	}while($existe==true);
	do{
		$acceso->objeto->ejecutarSql("select id_persona from persona  where id_persona = '$cod'  ORDER BY id_persona desc LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		}
		else{
			$existe=false;
		}
	}while($existe==true);
	return $cod;	
}

function verCodLongD($acceso,$valor,$ini_u){	
	if($ini_u==''){
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		
	}
	$cod = $ini_u.verCodLong($acceso,$valor);	
	$x=0;
	do{
		
		$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where id_cont_serv = '$cod' ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
			//echo "<br>$cod";
		}
		else{
			$existe=false;
		}
		$x++;
	}while($existe==true);
	return $cod;	
}


function verCodLongP($acceso,$valor,$ini_u){	
	if($ini_u==''){
		session_start();
		$ini_u = $_SESSION["ini_u"];  
	}
	$cod = $ini_u.verCodLong($acceso,$valor);
	do{
		$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado  where id_cont_serv = '$cod' ");
		if($row=row($acceso)){
			$existe=true;
			$cod=$ini_u.verCodLongInc($acceso,$cod);
		}
		else{
			$existe=false;
		}
		$x++;
	}while($existe==true);
	return $cod;	
}

/*
function verCodControl($acceso,$valor){	
	$row=row($acceso);
	$val=trim($row[$valor]);
	//$ini=$val[0];
	$cont=separa($val);
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
		
		
			
	return $cont;	
}
*/
function ver_factura($acceso,$cont){
	$cont=separa($cont);
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
		if($cont<1000000)
			$cont="0".$cont;
	return $cont;	
}

function verNumero_abonado_v4($acceso,$valor,$cant,$serie_correl_G){
	$row=row($acceso);
	$val=trim($row[$valor]);
	
	$num=substr($val,$serie_correl_G,$cant);
//	echo "cant:$cant:<br>";
//	echo "cant:$cant:<br>";
//	echo "val:$val:<br>";
//	echo "num:$num:<br>";
	
	
	$val=$num;
	$cont=separa($val);
//	echo "cont:$cont:<br>";
		$cont++;

		if($cant==0){
			return $cont;
		}
		else {
			//echo"<br>cont:$cont";
			$codigo="$cont";
			if($cont<10 && $cant>1)
				$codigo="0".$codigo;
			if($cont<100 && $cant>2)
				$codigo="0".$codigo;
			if($cont<1000 && $cant>3)
				$codigo="0".$codigo;
			if($cont<10000 && $cant>4)
				$codigo="0".$codigo;
			if($cont<100000 && $cant>5)
				$codigo="0".$codigo;
			if($cont<100000 && $cant>6)
				$codigo="0".$codigo;
			if($cont<1000000 && $cant>7)
				$codigo="0".$codigo;
		}
	//	echo "codigo:$codigo:<br>";

	return $codigo;	
}
function verNumero_factura_v4($acceso,$valor,$cant){
	$row=row($acceso);
	$val=$row[$valor];
	
	$cont=separa($val);
		$cont++;
		$codigo=$cont;
		//echo "<br>con:$cont";
	//	echo "<br>con:$codigo";
		if($cant==0){
			return $cont;
		}
		else {
			//echo"<br>cont:$cont";
			$codigo="$cont";
			if($cont<10 && $cant>1)
				$codigo="0".$codigo;
			if($cont<100 && $cant>2)
				$codigo="0".$codigo;
			if($cont<1000 && $cant>3)
				$codigo="0".$codigo;
			if($cont<10000 && $cant>4)
				$codigo="0".$codigo;
			if($cont<100000 && $cant>5)
				$codigo="0".$codigo;
			if($cont<100000 && $cant>6)
				$codigo="0".$codigo;
			if($cont<1000000 && $cant>7)
				$codigo="0".$codigo;
			if($cont<10000000 && $cant>8)
				$codigo="0".$codigo;
			if($cont<10000000 && $cant>9)
				$codigo="0".$codigo;
		}
		
	return $codigo;	
}

function verNumero_factura_v4Inc($acceso,$valor,$cant){
	$cont=separa($valor);
	$cont++;
	$codigo=$cont;
	if($cant==0){
		return $cont;
	}
	else {
		$codigo="$cont";
		if($cont<10 && $cant>1)
			$codigo="0".$codigo;
		if($cont<100 && $cant>2)
			$codigo="0".$codigo;
		if($cont<1000 && $cant>3)
			$codigo="0".$codigo;
		if($cont<10000 && $cant>4)
			$codigo="0".$codigo;
		if($cont<100000 && $cant>5)
			$codigo="0".$codigo;
		if($cont<100000 && $cant>6)
			$codigo="0".$codigo;
		if($cont<1000000 && $cant>7)
			$codigo="0".$codigo;
		if($cont<10000000 && $cant>8)
			$codigo="0".$codigo;
		if($cont<10000000 && $cant>9)
			$codigo="0".$codigo;
	}
	return $codigo;	
}

function verNumero_recibo_v4($acceso,$valor,$cant){

	$cont=separa($valor);
		$cont++;

		if($cant==0){
			return $cont;
		}
		else {
			//echo"<br>cont:$cont";
			$codigo="$cont";
			if($cont<10 && $cant>1)
				$codigo="0".$codigo;
			if($cont<100 && $cant>2)
				$codigo="0".$codigo;
			if($cont<1000 && $cant>3)
				$codigo="0".$codigo;
			if($cont<10000 && $cant>4)
				$codigo="0".$codigo;
			if($cont<100000 && $cant>5)
				$codigo="0".$codigo;
			if($cont<100000 && $cant>6)
				$codigo="0".$codigo;
			if($cont<1000000 && $cant>7)
				$codigo="0".$codigo;
			if($cont<10000000 && $cant>8)
				$codigo="0".$codigo;
			if($cont<10000000 && $cant>9)
				$codigo="0".$codigo;
		}
		
	return $codigo;	
}


function verNumero_control_v4($acceso,$valor,$cant){
	$row=row($acceso);
	$val=$row[$valor];
	
	$cont=separa($val);
		$cont++;
		$codigo=$cont;
		
		if($cant==0){
			return $cont;
		}
		else {
			//echo"<br>cont:$cont";
			$codigo="$cont";
			if($cont<10 && $cant>1)
				$codigo="0".$codigo;
			if($cont<100 && $cant>2)
				$codigo="0".$codigo;
			if($cont<1000 && $cant>3)
				$codigo="0".$codigo;
			if($cont<10000 && $cant>4)
				$codigo="0".$codigo;
			if($cont<100000 && $cant>5)
				$codigo="0".$codigo;
			if($cont<100000 && $cant>6)
				$codigo="0".$codigo;
			if($cont<1000000 && $cant>7)
				$codigo="0".$codigo;
			if($cont<10000000 && $cant>8)
				$codigo="0".$codigo;
			if($cont<10000000 && $cant>9)
				$codigo="0".$codigo;
		}
		
	return $codigo;	
}

function verCodFact($acceso,$valor){	
	$cont = verCo($acceso,$valor);
		if($cont<100000)
			$cont="0".$cont;
		if($cont<1000000)
			$cont="0".$cont;
		if($cont<10000000)
			$cont="0".$cont;
		if($cont<100000000)
			$cont="0".$cont;
		if($cont<100000000)
			$cont="0".$cont;
			
	return $cont;	
}
function verCodControl($acceso,$valor){	
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

function verCodLargoInc($acceso,$valor){	
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
//retorna una lista o seleccion con todos los perfiles
function perfil($acceso){
	$cad=opcion('',"Selecciones...");
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
		$cadena=$cadena.checkBoxPerfil(trim($row['nombremodulo']),"modulo",trim($row['codigomodulo']),$cont,trim($row['descripcionmodulo']));			
		$cont=$cont+4;
	}	
		$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre('seleccion').' onchange=\'seleccionCheck()\'').fuente('Seleccionar todo'),2,1));
	return $cadena;	
}
//devuelve todos las permisologias de los modulos registrados en checkbox
function checkBoxPerfil($nombre,$name,$valor,$cont,$desc){
	return fila(colspan('<table border="0" width="100%" align="center"><tr><td width="30%">'.input(tipo("checkbox").nombre($name).valor($valor).' onchange=\'asignaCheck('.$cont.')\'').fuente($nombre).'</td><td width="10%">'.input(tipo("checkbox").nombre($name).valor('incluir')).fuente('Incluir').'</td><td width="12%">'.input(tipo("checkbox").nombre($name).valor('modificar')).fuente('Modificar').'</td><td width="10%">'.input(tipo("checkbox").nombre($name).valor('eliminar')).fuente('Eliminar').'</td><td align="left">'.$desc.'</td></tr></table>',5,1));
}
//para hacer la consulta a modulo y llamar a seguridadPerfil
function perfiles($acceso){
	$acceso->objeto->ejecutarSql(sql("modulo ORDER BY nombremodulo"));	
	return seguridadPerfil($acceso);
}
//para hacer la consulta a perfil y llamar a seguridadPerfil
function modulos($acceso){
	$acceso->objeto->ejecutarSql(sql("perfil ORDER BY nombreperfil"));		
	return seguridadPerfil($acceso);
}

function verTecnicos($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from vista_tecnico order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function verPrimerTecnico($acceso){
	
	$acceso->objeto->ejecutarSql("select *from vista_tecnico where status_tec='ACTIVO'");
	if($row=row($acceso))
	{
		return trim($row["id_persona"]);
	}
}
function verDirIp($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select DISTINCT dir_ip from notas order By dir_ip");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["dir_ip"]),trim($row["dir_ip"]));
	}
	return $cad;	
}
function verpaquetebasico($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select id_serv,nombre_servicio from servicios where tipo_costo='COSTO MENSUAL' and tipo_paq='PAQUETE BASICO' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}

function verpaqueteunico($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select id_serv,nombre_servicio from servicios where tipo_costo='COSTO UNICO' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;
}

function verUsuarios($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from usuario where statususuario='ACTIVO' order By login");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["login"]),trim($row["login"]));
	}
	return $cad;
}
function verUsuariosPersona($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	$cad=opcion('',"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from personausuario where statususuario='ACTIVO' $consult order By login");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["login"]),trim($row["login"])." : ".trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function verMotivoNotas($acceso){
	$cad=opcion('',"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from motivonotas order By idmotivonota");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["idmotivonota"]),trim($row["nombremotivonota"]));
	}
	return $cad;	
}
function verMotivoLlamada($acceso){
	$cad=opcion('',"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from motivollamada order By idmotivonota");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["idmotivonota"]),trim($row["nombremotivonota"]));
	}
	return $cad;	
}
function verStatusCont($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from statuscont order By nombrestatus");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["nombrestatus"]),trim($row["nombrestatus"]));
	}
	return $cad;	
}
function verVendedores($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}
	
	$cad=opcion('',"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from vista_vendedor $consult order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function verCob($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}
	$cad=opcion('',_("todos"));
	$acceso->objeto->ejecutarSql("select *from vista_cobrador $consult order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}

function verCobradoresM($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}
	
	$cad='';
	$acceso->objeto->ejecutarSql("select *from vista_cobrador $consult order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}

function verCobradoresListado($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}
	
	$cad=opcion('',_("todos"));
	$acceso->objeto->ejecutarSql("select *from vista_cobrador $consult order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}

function verCobradores($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}
	
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_cobrador $consult order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function verCobradores_cont($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}
	
	$cad='';
	$acceso->objeto->ejecutarSql("select *from vista_cobrador where id_persona='AA00000012' order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function verCobradores_id($acceso,$id_perosna){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" id_franq='$id_f'";
	}
	
	$cad='';
	//echo "select *from vista_cobrador where id_perosna='$id_perosna' $consult order By nombre";
	$acceso->objeto->ejecutarSql("select *from vista_cobrador where id_persona='$id_perosna' $consult order By nombre");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_persona"]),trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}
function traerTOStatus($acceso,$status_contrato){
	$cad=opcion('',_("Seleccione..."));
	
	if($status_contrato!=''){
		$status=explode(";",$status_contrato);
			$valor=$status[0];
			$esta=$esta." and ((tipo_detalle ILIKE '%$valor%')";
			for($i=1;$i<count($status)-1;$i++)
			{
				$valor=$status[$i];
				$esta=$esta." or (tipo_detalle ILIKE '%$valor%')";
			}
			$esta=$esta." )";
		//	echo "$esta";
	}

	$dato=lectura($acceso,"select *from tipo_orden order By nombre_tipo_orden");
	for($i=0;$i<count($dato);$i++){
		$id_tipo_orden=trim($dato[$i]["id_tipo_orden"]);
		//echo "select *from vista_detalleorden where id_tipo_orden='$id_tipo_orden' $esta ";
		$acceso->objeto->ejecutarSql("select *from vista_detalleorden where id_tipo_orden='$id_tipo_orden' $esta ");
		if($row=row($acceso)){
			$cad=$cad.opcion(trim($dato[$i]["id_tipo_orden"]),trim($dato[$i]["nombre_tipo_orden"]));
		}
	}
	return $cad;	
}
function verTipoOrdenFiltro($acceso){
	$cad=opcion('',_("todos"));
	$acceso->objeto->ejecutarSql("select *from tipo_orden order By nombre_tipo_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_orden"]),trim($row["nombre_tipo_orden"]));
	}
	return $cad;	
}
function verTipoResp($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from tipo_resp where status_trl='ACTIVO' order By nombre_trl");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_trl"]),trim($row["nombre_trl"]));
	}
	return $cad;	
}
function verTipoLlamada($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from tipo_llamada where status_tll='ACTIVO' order By nombre_tll");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tll"]),trim($row["nombre_tll"]));
	}
	return $cad;	
}
function verDetalleResp($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from detalle_resp,tipo_resp where detalle_resp.id_trl=tipo_resp.id_trl and status_drl='ACTIVO' order By nombre_drl");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_drl"]),trim($row["nombre_drl"]));
	}
	return $cad;	
}
function verTipoOrdenEst($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from tipo_orden order By nombre_tipo_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_orden"]),trim($row["nombre_tipo_orden"]));
	}
	return $cad;	
}
function verTipoOrden($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from tipo_orden order By nombre_tipo_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_orden"]),trim($row["nombre_tipo_orden"]));
	}
	return $cad;
}
function verTipoOrdenFalla($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from tipo_orden where id_tipo_orden='TIO00005'");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_orden"]),trim($row["nombre_tipo_orden"]));
	}
	return $cad;	
}
function cargarDO($acceso,$id_tipo_orden){
	$cad=opcion('',_("Seleccione..."));
	if($id_tipo_orden!='' && $id_tipo_orden!='0'){
		$where="where id_tipo_orden='$id_tipo_orden'";
	}
	$acceso->objeto->ejecutarSql("select *from detalle_orden $where order By nombre_det_orden");
	
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;	
}
function cargarDO1($acceso,$id_tipo_orden){
	$cad=opcion('',_("todos"));
	if($id_tipo_orden!='' && $id_tipo_orden!='0'){
		$where="where id_tipo_orden='$id_tipo_orden'";
	}
	$acceso->objeto->ejecutarSql("select *from detalle_orden $where order By nombre_det_orden");
	
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;	
}
function cargarDOE($acceso,$id_tipo_orden){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from detalle_orden where id_tipo_orden='$id_tipo_orden' order By nombre_det_orden");
	if($acceso->objeto->registros>1){
		$cad=opcion('TODOS',_("todos"));
	}
	
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;	
}
function verDetalleOrdenEst($acceso){
	$cad=opcion('TODOS',_("todos"));
	$acceso->objeto->ejecutarSql("select *from detalle_orden order By nombre_det_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;	
}
function verDetalleOrdenFiltro($acceso){
	$cad=opcion('',_("todos"));
	$acceso->objeto->ejecutarSql("select *from detalle_orden order By nombre_det_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;
}
function verDetalleOrden($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from detalle_orden order By nombre_det_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;	
}
function respon_info_adic($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select distinct login  from info_adic order By login;");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["login"]),trim($row["login"]));
	}
	return $cad;	
}
function respon_emi($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select distinct login  from ordenes_tecnicos order By login;");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["login"]),trim($row["login"]));
	}
	return $cad;	
}
function respon_imp($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select distinct login_imp  from ordenes_tecnicos order By login_imp;");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["login_imp"]),trim($row["login_imp"]));
	}
	return $cad;	
}
function respon_fin($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select distinct login_fin  from ordenes_tecnicos order By login_fin;");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["login_fin"]),trim($row["login_fin"]));
	}
	return $cad;	
}
function verDetalleOrdenFalla1($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from detalle_orden  where id_tipo_orden='TIO00005' order By nombre_det_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;	
}

function verDetalleOrdenFalla($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from detalle_orden  where id_tipo_orden='TIO00005' order By nombre_det_orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_det_orden"]),trim($row["nombre_det_orden"]));
	}
	return $cad;	
}
function verFranq_esp($acceso,$id_franq){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from franquicia where id_franq='$id_franq'  order by nombre_franq");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_franq"]),trim($row["nombre_franq"]));
	}
	return $cad;	
}
function verFranq($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}

	$acceso->objeto->ejecutarSql("select *from franquicia $consult order by nombre_franq");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_franq"]),trim($row["nombre_franq"]));
	}
	return $cad;
}

function verFranquicia($acceso){
	session_start();

	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$cad='';
		$consult=" where id_franq='$id_f'";
	}
	else{
		$cad=opcion('',_("Seleccione..."));
	}
	$acceso->objeto->ejecutarSql("select *from franquicia $consult  order by nombre_franq");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_franq"]),trim($row["nombre_franq"]));
	}
	return $cad;	
}
function verFranquicia_selec($acceso){
	session_start();

	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from franquicia $consult  order by nombre_franq");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_franq"]),trim($row["nombre_franq"]));
	}
	return $cad;	
}
function verFranquicia_completo($acceso){
	
		$cad=opcion('',_("Todas"));
	
	$acceso->objeto->ejecutarSql("select * from franquicia order by nombre_franq");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_franq"]),trim($row["nombre_franq"]));
	}
	return $cad;	
}
function verGrupoAfinidad($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from grupo_afinidad where status_g_a='ACTIVO' order By id_g_a");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_g_a"]),trim($row["nombre_g_a"]));
	}
	return $cad;	
}
function verGrupoTecnico_rep($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" AND  id_franq='$id_f'";
	}
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select id_gt,nombre_grupo from grupo_trabajo where status_grupo='ACTIVO' $consult order By nombre_grupo");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_gt"]),trim($row["nombre_grupo"]));
	}
	return $cad;	
}
function verGrupoTecnico($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" AND  id_franq='$id_f'";
	}
	$cad='';
	$acceso->objeto->ejecutarSql("select id_gt,nombre_grupo from grupo_trabajo where status_grupo='ACTIVO' $consult order By nombre_grupo");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_gt"]),trim($row["nombre_grupo"]));
	}
	return $cad;	
}
function verGrupoTec($acceso){
	session_start();

	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" and  id_franq='$id_f'";
	}
	
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select id_gt,nombre_grupo from grupo_trabajo where status_grupo='ACTIVO' order By nombre_grupo");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_gt"]),trim($row["nombre_grupo"]));
	}
	return $cad;	
}
function verZona($acceso){

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_zona1 $consult order By nombre_zona");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_zona"]),trim($row["nombre_zona"]));
	}
	return $cad;	
}
function verZona_franquicia($acceso){

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	$cad=opcion('',_("Seleccione..."));
	
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";

		$acceso->objeto->ejecutarSql("select *from vista_zona1 $consult order By nombre_zona");
		while ($row=row($acceso))
		{
			$cad=$cad.opcion(trim($row["id_zona"]),trim($row["nombre_zona"]));
		}
	}

	return $cad;	
}
function verZonaEst($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from zona order By nombre_zona");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_zona"]),trim($row["nombre_zona"]));
	}
	return $cad;	
}
function verCajaAbierta($acceso){
	$fecha= date("Y-m-d");
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_caja where status_caja='Abierta' and status_caja_cob='Abierta' and fecha_caja='$fecha' order By nombre_caja");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_caja_cob"]),trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;
}
function verTipoAlarma($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from tipo_alarma where status_alarma='ACTIVO' order By nombre_alarma");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_alarma"]),trim($row["nombre_alarma"]));
	}
	return $cad;
}
function verCajaActiva($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	$cad=opcion('',_("Seleccione..."));
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	else{
		//$cad=opcion('',_("Su Cuenta no esta asociada a un franquicia"));
		//$consult=" and id_franq='0'";
	}
	
	//echo "select *from caja where status_caja='Activa' $consult order By nombre_caja";
	
	$acceso->objeto->ejecutarSql("select *from caja where status_caja='ACTIVA' $consult order By nombre_caja");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_caja"]),trim($row["nombre_caja"]));
	}
	return $cad;	
}
function cargarZona($acceso,$id_ciudad){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from zona where id_ciudad='$id_ciudad' order By nombre_zona");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_zona"]),trim($row["nombre_zona"]));
	}
	return $cad;	
}
function cargarZona_n($acceso,$dat){
	$id_ciudad = $dat['id_ciudad'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from zona where id_ciudad='$id_ciudad' order By nombre_zona");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_zona"]),trim($row["nombre_zona"]));
	}
	return $cad;	
}
function cargarZona_franq($acceso,$id_franq){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_zona1 where id_franq='$id_franq' order By nombre_zona");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_zona"]),trim($row["nombre_zona"]));
	}
	return $cad;	
}
function verSectorEst($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from sector where id_zona='ZON00001' order By nombre_sector");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_sector"]),trim($row["nombre_sector"]));
	}
	return $cad;	
}
function verSector($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_sector1 $consult order By nombre_sector");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_sector"]),trim($row["nombre_sector"]));
	}
	return $cad;	
}

function verUrb($acceso){
	
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from urbanizacion order By nombre_urb");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_urb"]),trim($row["nombre_urb"]));
	}
	return $cad;	
}
function verEstado($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from estado  $consult order By nombre_esta");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_esta"]),trim($row["nombre_esta"]));
	}
	return $cad;	
}

function verMun($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_municipio $consult order By nombre_mun");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_mun"]),trim($row["nombre_mun"]));
	}
	return $cad;	
}
function verCiudad($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_ciudad $consult order By nombre_ciudad");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_ciudad"]),trim($row["nombre_ciudad"]));
	}
	return $cad;	
}
function cargarSectorEst($acceso,$id_zona){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from sector where id_zona='$id_zona' order By nombre_sector");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_sector"]),trim($row["nombre_sector"]));
	}
	return $cad;	
}
function cargarSector($acceso,$id_zona){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from sector where id_zona='$id_zona' order By nombre_sector");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_sector"]),trim($row["nombre_sector"]));
	}
	return $cad;	
}
function cargarSector_n($acceso,$dat){
	$id_zona = $dat['id_zona'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from sector where id_zona='$id_zona' order By nombre_sector");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_sector"]),trim($row["nombre_sector"]));
	}
	return $cad;	
}
function cargarCalle($acceso,$id_sector){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from calle where id_sector='$id_sector'order By nombre_calle");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_calle"]),trim($row["nombre_calle"]));
	}
	return $cad;	
}
function cargarCalle_n($acceso,$dat){
	$id_sector = $dat['id_sector'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from calle where id_sector='$id_sector'order By nombre_calle");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_calle"]),trim($row["nombre_calle"]));
	}
	return $cad;	
}
function cargarCalle_f($acceso,$dat){
	$id_franq = $dat['id_franq'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_calle1 where id_franq='$id_franq'order By nombre_calle");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_calle"]),trim($row["nombre_calle"]));
	}
	return $cad;	
}
function cargarUrb($acceso,$id_sector){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from urbanizacion where id_sector='$id_sector'order By nombre_urb");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["nombre_urb"]),trim($row["nombre_urb"]));
	}
	return $cad;	
}
function cargarUrb_n($acceso,$dat){
	$id_sector = $dat['id_sector'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from urbanizacion where id_sector='$id_sector'order By nombre_urb");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["id_urb"]),trim($row["nombre_urb"]));
	}
	return $cad;
}
function cargarUrb_f($acceso,$dat){
	$id_franq = $dat['id_franq'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_urb where id_franq='$id_franq'order By nombre_urb");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["id_urb"]),trim($row["nombre_urb"]));
	}
	return $cad;
}
function cargarEdif($acceso,$id_sector){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from edificio where id_sector='$id_sector' order By edificio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["edificio"]),trim($row["edificio"]));
	}
	return $cad;
}
function cargarEdif_n($acceso,$dat){
	$id_sector = $dat['id_sector'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from edificio where id_sector='$id_sector' order By edificio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_edif"]),trim($row["edificio"]));
	}
	return $cad;	
}
function cargarEdif_f($acceso,$dat){
	$id_franq = $dat['id_franq'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_edificio where id_franq='$id_franq' order By edificio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_edif"]),trim($row["edificio"]));
	}
	return $cad;	
}
function verBanco($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from banco where tipo_banco='' order By banco");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["banco"]),trim($row["banco"]));
	}
	return $cad;	
}
function verBanco_n($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select * from banco  where id_banco<>'AB003' and id_banco<>'AB004' order By banco");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_banco"]),trim($row["banco"]));
	}
	return $cad;
}
function traerBanco($acceso,$dat){
	$id_tipo_pago = $dat['id_tipo_pago'];
	if($id_tipo_pago=='TPA00009'){
		$where="where id_banco='AB003' or id_banco='AB004'";
	}else{
		$where="where id_banco<>'AB003' and id_banco<>'AB004'";
	}
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select * from banco  $where order By banco");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_banco"]),trim($row["banco"]));
	}
	return $cad;
}

function verBancoEmp($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from banco order By banco");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["banco"]),trim($row["banco"]));
	}
	return $cad;	
}
function verEdif($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_edificio $consult order By edificio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_edif"]),trim($row["edificio"]));
	}
	return $cad;	
	
}
function verPuntoC($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_caja ");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_caja_cob"]),trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"]));
	}
	return $cad;	
}

function verCalleEst($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from calle where id_sector='SEC00001' order By nombre_calle");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_calle"]),trim($row["nombre_calle"]));
	}
	return $cad;	
}

function verCalle($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_calle1 $consult order By nombre_calle");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_calle"]),trim($row["nombre_calle"]));
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
	
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select * from tipo_servicio where status_servicio='Activo' order by tipo_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_servicio"]),trim($row["tipo_servicio"]));
	}
	return $cad;	
}
function cargarServicioMensual($acceso,$id_tipo_servicio){

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select * from vista_tarifa where status_tarifa_ser='ACTIVO' AND  status_serv='Activo' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;
}
function cargarServicioMensual_c_temp($acceso,$dat){
	$id_tipo_servicio = $dat['id_tipo_servicio'];
	$id_contrato = $dat['id_contrato'];

	$id_cant_e='';
	$acceso->objeto->ejecutarSql("select servicios.id_serv,id_cant from contrato_servicio_temp, servicios where contrato_servicio_temp.id_serv = servicios.id_serv and id_contrato='$id_contrato' and id_tipo_servicio='$id_tipo_servicio' AND  status_serv='ACTIVO'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO'");
	if($row=row($acceso)){
		$id_cant_e=trim($row["id_cant"]);
		

		$id_serv=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from servicios where status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE ADICIONAL'  order By nombre_servicio");
		while ($row=row($acceso))
		{
			$id_serv=$id_serv.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
		}
		$id_cant=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from cant_tv where status_cant='ACTIVO' and id_cant='$id_cant_e' and (select count(*) FROM servicios where cant_tv.id_cant=servicios.id_cant AND status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE ADICIONAL')>0 order By cantidad");
		while ($row=row($acceso))
		{
			$id_cant=$id_cant.opcion(trim($row["id_cant"]),trim($row["cantidad"]));
		}

	}else{

		$id_serv=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from servicios where status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO' order By nombre_servicio");
		while ($row=row($acceso))
		{
			$id_serv=$id_serv.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
		}
		$id_cant=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from cant_tv where status_cant='ACTIVO' and (select count(*) FROM servicios where cant_tv.id_cant=servicios.id_cant and  status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO')>0 order By cantidad");
		while ($row=row($acceso))
		{
			$id_cant=$id_cant.opcion(trim($row["id_cant"]),trim($row["cantidad"]));
		}

	}
	$cad["id_cant_e"]=$id_cant_e;
	$cad["id_serv"]=$id_serv;
	$cad["id_cant"]=$id_cant;
	return $cad;	
}
function cargarServicio_n($acceso,$dat){
	$id_tipo_servicio = $dat['id_tipo_servicio'];
	
		$id_serv=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from servicios where status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio' order By nombre_servicio");
		while ($row=row($acceso))
		{
			$id_serv=$id_serv.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
		}
	$cad["id_serv"]=$id_serv;
	$cad["id_cant"]=$id_cant;
	return $cad;	
}
function cargarServicioMensual_c($acceso,$dat){
	$id_tipo_servicio = $dat['id_tipo_servicio'];
	$id_contrato = $dat['id_contrato'];

	$id_cant_e='';
	$acceso->objeto->ejecutarSql("select servicios.id_serv,id_cant from contrato_servicio, servicios where contrato_servicio.id_serv = servicios.id_serv and id_contrato='$id_contrato' and id_tipo_servicio='$id_tipo_servicio' AND  status_serv='ACTIVO'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO'");
	if($row=row($acceso)){
		$id_cant_e=trim($row["id_cant"]);
		

		$id_serv=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from servicios where status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE ADICIONAL' and id_cant='$id_cant_e' order By nombre_servicio");
		while ($row=row($acceso))
		{
			$id_serv=$id_serv.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
		}
		$id_cant=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from cant_tv where status_cant='ACTIVO' and id_cant='$id_cant_e' and (select count(*) FROM servicios where cant_tv.id_cant=servicios.id_cant AND status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE ADICIONAL')>0 order By cantidad");
		while ($row=row($acceso))
		{
			$id_cant=$id_cant.opcion(trim($row["id_cant"]),trim($row["cantidad"]));
		}

	}else{

		$id_serv=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from servicios where status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO' order By nombre_servicio");
		while ($row=row($acceso))
		{
			$id_serv=$id_serv.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
		}
		$id_cant=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from cant_tv where status_cant='ACTIVO' and (select count(*) FROM servicios where cant_tv.id_cant=servicios.id_cant and  status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO')>0 order By cantidad");
		while ($row=row($acceso))
		{
			$id_cant=$id_cant.opcion(trim($row["id_cant"]),trim($row["cantidad"]));
		}

	}
	$cad["id_cant_e"]=$id_cant_e;
	$cad["id_serv"]=$id_serv;
	$cad["id_cant"]=$id_cant;
	return $cad;	
}
function cargar_servicio_tv_temp($acceso,$dat){
	$id_tipo_servicio = $dat['id_tipo_servicio'];
	$id_contrato = $dat['id_contrato'];
	$id_cant = $dat['id_cant'];
//$echo ="select servicios.id_serv from contrato_servicio_temp, servicios where contrato_servicio_temp.id_serv = servicios.id_serv and id_contrato='$id_contrato' and id_tipo_servicio='$id_tipo_servicio' AND  status_serv='ACTIVO'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO'";
	$acceso->objeto->ejecutarSql("select servicios.id_serv from contrato_servicio_temp, servicios where contrato_servicio_temp.id_serv = servicios.id_serv and id_contrato='$id_contrato' and id_tipo_servicio='$id_tipo_servicio' AND  status_serv='ACTIVO'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO'");
	if($row=row($acceso)){
		$echo ="entro";
		$id_serv=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from servicios where status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE ADICIONAL'  order By nombre_servicio");
		while ($row=row($acceso))
		{
			$id_serv=$id_serv.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
		}
	}else{
		$id_serv=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from servicios where status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO' and id_cant='$id_cant' order By nombre_servicio");
		while ($row=row($acceso))
		{
			$id_serv=$id_serv.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
		}
	}
	$cad["id_serv"]=$id_serv;
	$cad["ECHO"]=$echo;
	return $cad;	
}
function cargar_servicio_tv_c($acceso,$dat){
	$id_tipo_servicio = $dat['id_tipo_servicio'];
	$id_contrato = $dat['id_contrato'];
	$id_cant = $dat['id_cant'];
$echo ="select servicios.id_serv from contrato_servicio, servicios where contrato_servicio.id_serv = servicios.id_serv and id_contrato='$id_contrato' and id_tipo_servicio='$id_tipo_servicio' AND  status_serv='ACTIVO'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO'";
	$acceso->objeto->ejecutarSql("select servicios.id_serv from contrato_servicio, servicios where contrato_servicio.id_serv = servicios.id_serv and id_contrato='$id_contrato' and id_tipo_servicio='$id_tipo_servicio' AND  status_serv='ACTIVO'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO'");
	if($row=row($acceso)){
		$echo ="entro";
		$id_serv=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from servicios where status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE ADICIONAL' and id_cant='$id_cant' order By nombre_servicio");
		while ($row=row($acceso))
		{
			$id_serv=$id_serv.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
		}
	}else{
		$id_serv=opcion('',_("Seleccione..."));
		$acceso->objeto->ejecutarSql("select * from servicios where status_serv='ACTIVO' and id_tipo_servicio='$id_tipo_servicio'  and tipo_costo='COSTO MENSUAL' AND tipo_paq='PAQUETE BASICO' and id_cant='$id_cant' order By nombre_servicio");
		while ($row=row($acceso))
		{
			$id_serv=$id_serv.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
		}
	}
	$cad["id_serv"]=$id_serv;
	$cad["ECHO"]=$echo;
	return $cad;	
}
function cargar_servicio_tv($acceso,$id_cant){

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select * from servicios where  status_serv='Activo' and id_cant='$id_cant'  and tipo_costo='COSTO MENSUAL' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServiciosCheck($acceso,$id_franq=''){
	
	if($id_franq==''){
		session_start();
		$id_f = $_SESSION["id_franq"]; 
		if($id_f!='0'){
			$consult=" and id_franq='$id_f'";
		}
	}
	else{
		$consult=" and id_franq='$id_franq'";
	}

	$cad='';
	$acceso->objeto->ejecutarSql("select *from vista_tarifa where status_tarifa_ser='ACTIVO' AND  status_serv='Activo' $consult  and tipo_costo='COSTO MENSUAL' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.'<input  type="checkbox" name="id_serv_dpp" value="'.trim($row["id_serv"]).'"checked>'.trim($row["nombre_servicio"]).'<br>&nbsp;&nbsp;&nbsp;';
	}
	return $cad;	
}
function vercosto_instalacion($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	else{
		$consult=" and id_franq='1'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_tarifa where status_tarifa_ser='ACTIVO' AND  status_serv='ACTIVO'  and tipo_serv='INSTALACION'  order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function cargarServicio($acceso,$id_tipo_servicio){
	
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_tarifa where status_tarifa_ser='ACTIVO' and id_tipo_servicio='$id_tipo_servicio' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServicioMensualCable($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_tarifa where status_tarifa_ser='ACTIVO' AND  status_serv='Activo' and id_tipo_servicio='TSE00001' and tipo_costo='COSTO MENSUAL' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServicioMensual($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	else{
		$consult=" and id_franq='1'";
	}
	
	$cad=opcion('',"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from vista_servicios where status_serv='Activo' and tipo_costo='COSTO MENSUAL'  $consult order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServiciosCostoU($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_tarifa where status_tarifa_ser='ACTIVO' AND status_serv='Activo' and tipo_costo='COSTO UNICO' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServicios_instalacion($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='ACTIVO' and tipo_costo='COSTO UNICO' AND tipo_serv='INSTALACION' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServicios($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='Activo' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;	
}
function verServiciosCable($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from servicios where status_serv='Activo' and id_tipo_servicio='TSE00001' order By nombre_servicio");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_serv"]),trim($row["nombre_servicio"]));
	}
	return $cad;
}
function verTipoPago($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from tipo_pago where status_pago='ACTIVO' order By orden");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_pago"]),trim($row["tipo_pago"]));
	}
	return $cad;	
}

function traer_tipo_pago($acceso,$id_tipo_pago){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from tipo_pago where status_pago='ACTIVO' and id_tipo_pago<>'$id_tipo_pago' order By id_tipo_pago");
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
function lecturaObj($acceso,$sql){
	$acceso->objeto->ejecutarSqlObject($sql);
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
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$date))
		list($dia,$mes,$ano)=explode("/", $date);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$date))
		list($dia,$mes,$ano)=explode("-",$date);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$date))
		list($ano,$mes,$dia)=explode("-",$date);
	//$valor=explode("-",trim($date));
	//$fecha= $valor[2].'/'.$valor[1].'/'.$valor[0];
	$fecha= $dia.'/'.$mes.'/'.$ano;
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
		while($row=row($acceso)){
				$monto=trim($row["monto_acum"]);
				$suma=$suma+$monto;
		}
	return $suma;
}
function calMontoCDCA($acceso,$fecha,$id_f=''){
	session_start();
	if($id_f==''){
		$id_f = $_SESSION["id_franq"];
	}
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	$suma=0;
		 //echo "select *from vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA'";
		$acceso->objeto->ejecutarSql("select sum(monto_acum) as monto_acum from vista_caja where fecha_caja='$fecha'   $consult");
		if($row=row($acceso))
		{
				$monto=trim($row["monto_acum"]);
				$suma=$suma+$monto;
		}
	
	return $monto;
}

function calMontoAcumulado($acceso,$fecha_act,$id_f=''){
	session_start();
	if($id_f==''){
		$id_f = $_SESSION["id_franq"];
	}
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
		list($ano,$mes,$dia)=explode("-",$fecha_act);
		
		$fecha_ini=date("Y-$mes-01");
	
		$acceso->objeto->ejecutarSql("select sum(monto_pago) as monto_pago from pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and  fecha_pago between '$fecha_ini' and '$fecha_act' and status_pago='PAGADO'");
		if($row=row($acceso)){
				$monto=trim($row["monto_pago"]);
		}
	
	return $monto;
}
function calMontoCDCA_est($acceso,$fecha,$id_est){
	session_start();
	$id_f = $_SESSION["id_franq"]; 

	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	
		$acceso->objeto->ejecutarSql("select sum(monto_acum) as monto_acum from vista_caja where id_est='$id_est' and fecha_caja='$fecha' and status_caja_cob='CERRADA'   $consult");
		if($row=row($acceso)){
				$monto=trim($row["monto_acum"]);
		}
	
	return $monto;
}
function formato_m($me){
	$mes=array("01"=>_("Ene"),"02"=>_("Feb"),"03"=>_("Mar"),"04"=>_("Abr"),"05"=>_("May"),"06"=>_("Jun"),"07"=>_("Jul"),"08"=>_("Ago"),"09"=>_("Sep"),"10"=>_("Oct"),"11"=>_("Nov"),"12"=>_("Dic"));
	return strtoupper($mes[$me]);
}
function formato_mes($me){
	$mes=array("01"=>_("Enero"),"02"=>_("Febre"),"03"=>_("Marzo"),"04"=>_("Abril"),"05"=>_("Mayo"),"06"=>_("Junio"),"07"=>_("Julio"),"08"=>_("Agost"),"09"=>_("Septi"),"10"=>_("Octub"),"11"=>_("Novie"),"12"=>_("Dicie"));
	return strtoupper($mes[$me]);
}
function formato_mes_com1($me){
	$mes=array("01"=>_("Enero"),"02"=>_("Febrero"),"03"=>_("Marzo"),"04"=>_("Abril"),"05"=>_("Mayo"),"06"=>_("Junio"),"07"=>_("Julio"),"08"=>_("Agosto"),"09"=>_("Septiembre"),"10"=>_("Octubre"),"11"=>_("Noviembre"),"12"=>_("Diciembre"));
	return $mes[$me];
}
function formato_mes_com($me){
	$mes=array("01"=>_("Enero"),"02"=>_("Febrero"),"03"=>_("Marzo"),"04"=>_("Abril"),"05"=>_("Mayo"),"06"=>_("Junio"),"07"=>_("Julio"),"08"=>_("Agosto"),"09"=>_("Septiembre"),"10"=>_("Octubre"),"11"=>_("Noviembre"),"12"=>_("Diciembre"));
	return strtoupper($mes[$me]);
}

		$formato_anio=array("1970"=>"Mil Novecientos Setenta","1971"=>"Mil Novecientos Setenta y Uno","1972"=>"Mil Novecientos Setenta y Dos","1973"=>"Mil Novecientos Setenta y Tres","1974"=>"Mil Novecientos Setenta y Cuatro","1975"=>"Mil Novecientos Setenta y Cinco","1976"=>"Mil Novecientos Setenta y Seis","1977"=>"Mil Novecientos Setenta y Siete","1978"=>"Mil Novecientos Setenta y Ocho","1979"=>"Mil Novecientos Setenta y Nueve","1980"=>"Mil Novecientos Ochenta","1981"=>"Mil Novecientos Ochenta y Uno","1982"=>"Mil Novecientos Ochenta y Dos","1983"=>"Mil Novecientos Ochenta y Tres","1984"=>"Mil Novecientos Ochenta y Cuatro","1985"=>"Mil Novecientos Ochenta y Cinco","1986"=>"Mil Novecientos Ochenta y Seis","1987"=>"Mil Novecientos Ochenta y Siete","1988"=>"Mil Novecientos Ochenta y Ocho","1989"=>"Mil Novecientos Ochenta y Nueve","1990"=>"Mil Novecientos Noventa","1991"=>"Mil Novecientos Noventa y Uno","1992"=>"Mil Novecientos Noventa y Dos","1993"=>"Mil Novecientos Noventa y Tres","1994"=>"Mil Novecientos Noventa y Cuatro","1995"=>"Mil Novecientos Noventa y Cinco","1996"=>"Mil Novecientos Noventa y Seis","1997"=>"Mil Novecientos Noventa y Siete","1998"=>"Mil Novecientos Noventa y Ocho","1999"=>"Mil Novecientos Noventa y Nueve","2000"=>"Dos Mil","2001"=>"Dos Mil Uno","2002"=>"Dos Mil Dos","2003"=>"Dos Mil Tres","2004"=>"Dos Mil Cuatro","2005"=>"Dos Mil Cinco","2006"=>"Dos Mil Seis","2007"=>"Dos Mil Siete","2008"=>"Dos Mil Ocho","2009"=>"Dos Mil Nueve","2010"=>"Dos Mil Diez","2011"=>"Dos Mil Once","2012"=>"Dos Mil Doce","2013"=>"Dos Mil Trece","2014"=>"Dos Mil Catorce","2015"=>"Dos Mil Quince","2016"=>"Dos Mil Diesiseis","2017"=>"Dos Mil Diesisiete","2018"=>"Dos Mil Diesiocho","2019"=>"Dos Mil Diesinueve","2020"=>"Dos Mil Veinte","2021"=>"Dos Mil Veintiuno","2022"=>"Dos Mil Veintidos","2023"=>"Dos Mil Veintitres","2024"=>"Dos Mil Veinticuatro","2025"=>"Dos Mil Veinticinco","2026"=>"Dos Mil Veintiseis","2027"=>"Dos Mil Veintisiete","2028"=>"Dos Mil Veintiocho","2029"=>"Dos Mil Veintinueve","2030"=>"Dos Mil Treinta");
		
		$formato_dia=array("01"=>"un","02"=>"dos","03"=>"tres","04"=>"cuatro","05"=>"cinco","06"=>"seis","07"=>"siete","08"=>"ocho","09"=>"nueve","10"=>"diez","11"=>"once","12"=>"Doce","13"=>"Chuquiti","14"=>"catorce","15"=>"quince","16"=>"dieciseis","17"=>"diesiciete","18"=>"diesiocho","19"=>"diesinueve","20"=>"veinte","21"=>"veintiun","22"=>"veintidos","23"=>"veintitres","24"=>"veinticuatro","25"=>"veinticinco","26"=>"veintiseis","27"=>"veintisiete","28"=>"veintiocho","29"=>"veintinueve","30"=>"treinta","31"=>"treintiun");
		$formato_hora=array("1"=>" la una","02"=>" las dos","03"=>" las tres","04"=>"las cuatro","05"=>"las cinco","06"=>"la seis","07"=>"la siete","08"=>"las ocho","09"=>"las nueve","10"=>"las diez","11"=>"las once","12"=>"las Doce","13"=>"la Una","14"=>"las Dos","15"=>"las Tres","16"=>"las Cuatro","17"=>"las Cinco","18"=>"las Seis","19"=>"las Siete","20"=>"las Ocho","21"=>"las Nueve","22"=>"las Diez","23"=>"las Once","24"=>"las Doce");
		$formato_minutos=array("1"=>"un minuto","02"=>"dos minutos","03"=>"tres minutos","04"=>"cuatro minutos","05"=>"cinco minutos","06"=>"seis minutos","07"=>"siete minutos","08"=>"ocho minutos","09"=>"nueve minutos","10"=>"diez minutos","11"=>"once minutos","12"=>"Doce minutos","13"=>"Trece minutos","14"=>"catorce minutos","15"=>"quince minutos","16"=>"dieciseis minutos","17"=>"diesiciete minutos","18"=>"diesiocho minutos","19"=>"diesinueve minutos","20"=>"veinte minutos","21"=>"veintiun minutos","22"=>"veintidos minutos","23"=>"veintitres minutos","24"=>"veinticuatro minutos","25"=>"veinticinco minutos","26"=>"veintiseis minutos","27"=>"veintisiete minutos","28"=>"veintiocho minutos","29"=>"veintinueve minutos","30"=>"treinta minutos","31"=>"treintaiun minutos","32"=>"treintaidos minutos","33"=>"treintaitres minutos","34"=>"treintaicuatro minutos","35"=>"treintaicinco minutos","36"=>"treintaiseis minutos","37"=>"treintaisiete minutos","38"=>"treintaiocho minutos","39"=>"treintainueve minutos","40"=>"cuarenta minutos","41"=>"cuarentaiun minutos","42"=>"cuarentaidos minutos","43"=>"cuarentaitres minutos","44"=>"cuarentaicuatro minutos","45"=>"cuarentaicinco minutos","46"=>"cuarentaiseis minutos","47"=>"cuarentaiseiete minutos","48"=>"cuarentaiocho minutos","49"=>"cuarentainueve minutos","50"=>"cincuenta minutos","51"=>"cincuentaiun minutos","52"=>"cincuentaidos minutos","53"=>"cincuentaitres minutos","54"=>"cincuentaicuatro minutos","55"=>"cincuentaicinco minutos","56"=>"cincuentaiseis minutos","57"=>"cincuentaisiete minutos","58"=>"cincuentaiocho minutos","59"=>"cincuentainueve minutos");
		$formato_ampm=array("1"=>"de la mañana","2"=>"de la mañana","3"=>"de la mañana","4"=>"de la mañana","5"=>"de la mañana","6"=>"de la mañana","7"=>"de la mañana","8"=>"de la mañana","9"=>"de la mañana","10"=>"de la mañana","11"=>"de la mañana","12"=>"de la tarde","13"=>"de la tarde","14"=>"de la tarde","15"=>"de la tarde","16"=>"de la tarde","17"=>"de la tarde","18"=>"de la noche","19"=>"de la noche","20"=>"de la noche","21"=>"de la noche","22"=>"de la noche","23"=>"de la noche","24"=>"de la noche");
		$formato_trimes=array("01"=>"primer trimestre","02"=>"primer trimestre","03"=>"primer trimestre","04"=>"segundo trimestre","05"=>"segundo trimestre","06"=>"segundo trimestre","07"=>"tercer trimestre","08"=>"tercer trimestre","09"=>"tercer trimestre","10"=>"cuarto trimestre","11"=>"cuarto trimestre","12"=>"cuarto trimestre");
function sumames($fecha,$meses=1){
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
		list($dia,$mes,$ano)=explode("/", $fecha);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
		list($dia,$mes,$ano)=explode("-",$fecha);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
		list($ano,$mes,$dia)=explode("-",$fecha);
	$suma_mes = mktime ( 0, 0, 0, date("$mes") + $meses, date("$dia"), date("$ano") );
	return date ("Y-m-d", $suma_mes);
}
function restames($fecha,$meses=1){
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
		list($dia,$mes,$ano)=explode("/", $fecha);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
		list($dia,$mes,$ano)=explode("-",$fecha);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
		list($ano,$mes,$dia)=explode("-",$fecha);
	$suma_mes = mktime ( 0, 0, 0, date("$mes") - $meses, date("$dia"), date("$ano") );
	return date ("Y-m-d", $suma_mes);
}

function sumaanio($fecha){
//$fecha = "2010-01-08";
$enunmes = explode ( "-", $fecha );
$sumaunmes = mktime ( 0, 0, 0, date("$enunmes[1]"), date("$enunmes[2]"), date("$enunmes[0]")+1 );
return date ("Y-m-d", $sumaunmes);
}





function sumadia($fecha)
{
	$ndias=1;
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
		list($dia,$mes,$ano)=explode("/", $fecha);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
		list($dia,$mes,$ano)=explode("-",$fecha);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
		list($ano,$mes,$dia)=explode("-",$fecha);
	
	
        $nueva = mktime(0,0,0, $mes,$dia,$ano) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("Y-m-d",$nueva);
      return ($nuevafecha);  
}
function restadia($fecha,$ndias)
{
if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
	list($dia,$mes,$ano)=explode("/", $fecha);
if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
	list($dia,$mes,$ano)=explode("-",$fecha);
if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
	list($ano,$mes,$dia)=explode("-",$fecha);
	
	
        $nueva = mktime(0,0,0, $mes,$dia,$ano) - $ndias * 24 * 60 * 60;
        $nuevafecha=date("Y-m-d",$nueva);
      return ($nuevafecha);  
}

function verMesCorte(){
	$fecha = date("Y-m-01");
	$cad='';
	for($i=0;$i<24;$i++){
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
	//return strtoupper(utf8_decode($valor));
	return strtoupper($valor);
}
function costoContrato($acceso){
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='1'");
		if($row=row($acceso)){
				return trim($row["valor_param"]);
		}
}
function comparaFecha($fecha,$fecha1){
	$fec=explode("-",$fecha);
	$fec1=explode("-",$fecha1);
	if($fec[0]>$fec1[0])
	{
		return 1;
	}
	else if($fec[0]<$fec1[0])
	{
		return -1;
	}
	else 
	{
		if($fec[1]>$fec1[1])
		{
			return 1;
		}
		else if($fec[1]<$fec1[1])
		{
			return -1;
		}
		else 
		{
			if($fec[2]>$fec1[2])
			{
				return 1;
			}
			else if($fec[2]<$fec1[2])
			{
				return -1;
			}
			else 
			{
				return 0;
			}
		}
	}
}

function dl_file($cad){
$file="reporte.rtf";
$back = fopen($file,"w");
fwrite($back,$cad);
fclose($back);



  if (!is_file($file)) { die("<b>404 File not found!</b>"); }
  $len = filesize($file);
  $filename = basename($file);
  $file_extension = strtolower(substr(strrchr($filename,"."),1));
  $ctype="application/force-download";
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: public");
  header("Content-Description: File Transfer");
  header("Content-Type: $ctype");
  $header="Content-Disposition: attachment; filename=".$filename.";";
  header($header );
  header("Content-Transfer-Encoding: binary");
  header("Content-Length: ".$len);
  @readfile($file);
  exit;
}

function verCajaPrincipal($acceso){
	$cad=" tipo_caja='PRINCIPAL' ";
	return $cad;
}

function verCajaInicialPrincipal($acceso){
	$cad=" tipo_caja='PRINCIPAL' ";
}
function verFormatos($acceso){
	$cad=opcion('',"Seleccione...");
	$acceso->objeto->ejecutarSql("select *from formato_sms order By nombre_form");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["id_form"]),trim($row["nombre_form"]));
	}
	return $cad;	
}
function dia_diferencia($fecha,$fecha2){

if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
	list($dia1,$mes1,$ano1)=explode("/", $fecha);
if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
	list($dia1,$mes1,$ano1)=explode("-",$fecha);
if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
	list($ano1,$mes1,$dia1)=explode("-",$fecha);
	
if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
	list($dia2,$mes2,$ano2)=explode("/", $fecha2);
if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
	list($dia2,$mes2,$ano2)=explode("-",$fecha2);
if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
	list($ano2,$mes2,$dia2)=explode("-",$fecha2);

$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);

$segundos_diferencia = $timestamp1 - $timestamp2;

$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

$dias_diferencia = abs($dias_diferencia);

$dias_diferencia = floor($dias_diferencia);

return $dias_diferencia; 

}
//echo ':'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_ADDR"].':';

function verTarifa($acceso,$fecha,$id_serv){
	$acceso->objeto->ejecutarSql("select tarifa_ser,fecha_tar_ser,tipo_costo from vista_tarifa where id_serv='$id_serv' and tipo_costo='COSTO MENSUAL' order by fecha_tar_ser desc limit 1"); 
	if($row=row($acceso)){
		$tarifa_ser=trim($row['tarifa_ser']);
		$fecha_tar_ser=trim($row['fecha_tar_ser']);
		//	echo "<br>:$fecha_tar_ser,$fecha <=";
			if(comparaFecha($fecha_tar_ser,$fecha)<=0){
				return $tarifa_ser;
			}
	}
	$acceso->objeto->ejecutarSql("select tarifa_ser,fecha_tar_ser,tipo_costo from vista_tarifa where id_serv='$id_serv' and tipo_costo='COSTO MENSUAL' order by fecha_tar_ser asc limit 1"); 
	if($row=row($acceso)){
		$tarifa_ser=trim($row['tarifa_ser']);
		$fecha_tar_ser=trim($row['fecha_tar_ser']);
		//echo "<br>:$fecha_tar_ser,$fecha >=";
			if(comparaFecha($fecha_tar_ser,$fecha)>=0){
				return $tarifa_ser;
			}
	}

		$acceso->objeto->ejecutarSql("select tarifa_ser,fecha_tar_ser,tipo_costo from vista_tarifa where id_serv='$id_serv' and tipo_costo='COSTO MENSUAL' order by fecha_tar_ser asc"); 
		while($row=row($acceso)){
			$tarifa=trim($row['tarifa_ser']);
			$fecha_tar_ser=trim($row['fecha_tar_ser']);
			$tipo_costo=trim($row['tipo_costo']);
			//echo "<br>:$fecha_tar_ser,$fecha <=while";
			if(comparaFecha($fecha_tar_ser,$fecha)<=0){
				$tarifa_ser=$tarifa;
				
			}
		}
	
	return $tarifa_ser;
}

function ver_tarifa_contrato_servicio($acceso,$fecha,$id_serv,$id_contrato){

	$tarifa=lectura($acceso,"select cant_serv,costo_cobro,fecha_inst from contrato_servicio where id_contrato='$id_contrato' and id_serv='$id_serv' order by fecha_inst");
	$ult=count($tarifa);
	if(comparaFecha($tarifa[$ult-1]['fecha_inst'],$fecha)<=0){
		return $tarifa[$ult-1];
	}
	if(comparaFecha($tarifa[0]['fecha_inst'],$fecha)>=0){
		return $tarifa[0];
	}
	$tarifa_ser=array();
	for($i=0;$i<count($tarifa);$i++){
		if(comparaFecha($tarifa[$i]['fecha_inst'],$fecha)<=0){
			$tarifa_ser = $tarifa[$i];
		}
	}
	return $tarifa_ser;
/*
	$acceso->objeto->ejecutarSql("select tarifa_ser,fecha_tar_ser,tipo_costo from vista_tarifa where id_serv='$id_serv' and tipo_costo='COSTO MENSUAL' order by fecha_tar_ser desc limit 1"); 
	if($row=row($acceso)){
		$tarifa_ser=trim($row['tarifa_ser']);
		$fecha_tar_ser=trim($row['fecha_tar_ser']);
		//	echo "<br>:$fecha_tar_ser,$fecha <=";
			if(comparaFecha($fecha_tar_ser,$fecha)<=0){
				$tarifa_ser = $tarifa;
			}
	}
	$acceso->objeto->ejecutarSql("select tarifa_ser,fecha_tar_ser,tipo_costo from vista_tarifa where id_serv='$id_serv' and tipo_costo='COSTO MENSUAL' order by fecha_tar_ser asc limit 1"); 
	if($row=row($acceso)){
		$tarifa_ser=trim($row['tarifa_ser']);
		$fecha_tar_ser=trim($row['fecha_tar_ser']);
		//echo "<br>:$fecha_tar_ser,$fecha >=";
			if(comparaFecha($fecha_tar_ser,$fecha)>=0){
				return $tarifa_ser;
			}
	}

		$acceso->objeto->ejecutarSql("select tarifa_ser,fecha_tar_ser,tipo_costo from vista_tarifa where id_serv='$id_serv' and tipo_costo='COSTO MENSUAL' order by fecha_tar_ser asc"); 
		while($row=row($acceso)){
			$tarifa=trim($row['tarifa_ser']);
			$fecha_tar_ser=trim($row['fecha_tar_ser']);
			$tipo_costo=trim($row['tipo_costo']);
			//echo "<br>:$fecha_tar_ser,$fecha <=while";
			if(comparaFecha($fecha_tar_ser,$fecha)<=0){
				$tarifa_ser=$tarifa;
				
			}
		}
	
	return $tarifa_ser;
*/
}

function verTarifa1($acceso,$fecha,$id_contrato){
 $acceso->objeto->ejecutarSql("select id_serv from contrato_servicio where id_contrato='$id_contrato' LIMIT 1 offset 0"); 
if($row=row($acceso)){
   $id_serv=trim($row['id_serv']);
   
	$acceso->objeto->ejecutarSql("select tarifa_ser,fecha_tar_ser,tipo_costo from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'"); 
	if($row=row($acceso)){
		$tarifa_ser=trim($row['tarifa_ser']);
		$fecha_tar_ser=trim($row['fecha_tar_ser']);
		$tipo_costo=trim($row['tipo_costo']);
		if(comparaFecha($fecha_tar_ser,$fecha)>0 && $tipo_costo=="COSTO MENSUAL"){
			$acceso->objeto->ejecutarSql("select tarifa_ser,fecha_tar_ser from vista_tarifa where id_serv='$id_serv' and fecha_tar_ser>='$fecha' order by fecha_tar_ser  LIMIT 1 offset 0 "); 
			if($row=row($acceso)){
				$tarifa_ser=trim($row['tarifa_ser']);
				
			}
		}
	}
}
	return $tarifa_ser;
}
///////////////////////////////////////////////////unicable
function ver_pais($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from pais where status_pais='ACTIVO' order By nombre_pais");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_franq"]),trim($row["nombre_pais"]));
	}
	return $cad;
}
function ver_ciudad($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_ciudad where status_ciudad='ACTIVO' $consult order By nombre_ciudad");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_ciudad"]),trim($row["nombre_ciudad"]));
	}
	return $cad;	
}

function ver_municipio($acceso){
	
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from vista_municipio where status_mun='ACTIVO' $consult order By nombre_mun");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_mun"]),trim($row["nombre_mun"]));
	}
	return $cad;	
}


function traer_pais($acceso,$id_esta){
	
	$acceso->objeto->ejecutarSql("select *from estado where id_esta='$id_esta'");
	if($row=row($acceso)){
		return "=@".trim($row["id_franq"]);
	}
}

function traer_estado($acceso,$id_mun){
	$acceso->objeto->ejecutarSql("select *from vista_municipio where id_mun='$id_mun'");
	if($row=row($acceso)){
		return "=@".trim($row["id_esta"])."=@".trim($row["id_franq"]);
	}
}

function traer_estado_n($acceso,$dat){
	$id_mun = $dat['id_mun'];
	$acceso->objeto->ejecutarSql("select *from municipio where id_mun='$id_mun'");
	if($row=row($acceso)){
		$cad['id_esta']=trim($row["id_esta"]);
	}
	return $cad;
}

function traer_tipo_resp($acceso,$dat){
	$id_drl = $dat['id_drl'];
	$acceso->objeto->ejecutarSql("select *from detalle_resp where id_drl='$id_drl'");
	if($row=row($acceso)){
		$cad['id_trl']=trim($row["id_trl"]);
	}
	return $cad;
}

function traer_municipio($acceso,$id_ciudad){
	$acceso->objeto->ejecutarSql("select *from vista_ciudad where id_ciudad='$id_ciudad'");
	if($row=row($acceso)){
		return "=@".trim($row["id_mun"])."=@".trim($row["id_esta"])."=@".trim($row["id_franq"]);
	}
}
function traer_municipio_n($acceso,$dat){
	$id_ciudad = $dat['id_ciudad'];
	$acceso->objeto->ejecutarSql("select *from vista_ciudad where id_ciudad='$id_ciudad'");
	if($row=row($acceso)){
		$cad['id_mun']=trim($row["id_mun"]);
		$cad['id_esta']=trim($row["id_esta"]);
	}
	return $cad;
}
function traer_ciudad($acceso,$id_zona){
	$acceso->objeto->ejecutarSql("select *from vista_zona1 where id_zona='$id_zona'");
	if($row=row($acceso)){
		return "=@".trim($row["id_ciudad"])."=@".trim($row["id_mun"])."=@".trim($row["id_esta"])."=@".trim($row["id_franq"]);
	}
}

function traer_ciudad_n($acceso,$dat){
	$id_zona = $dat['id_zona'];
	$acceso->objeto->ejecutarSql("select *from vista_zona1 where id_zona='$id_zona'");
	if($row=row($acceso)){
		$cad['id_ciudad']=trim($row["id_ciudad"]);
		$cad['id_mun']=trim($row["id_mun"]);
		$cad['id_esta']=trim($row["id_esta"]);
		
	}
	return $cad;
}

function traerZona($acceso,$id_sector){
	$acceso->objeto->ejecutarSql("select *from vista_sector1 where id_sector='$id_sector'");
	if($row=row($acceso)){
		return "=@".trim($row["id_zona"])."=@".trim($row["id_ciudad"])."=@".trim($row["id_mun"])."=@".trim($row["id_esta"])."=@".trim($row["id_franq"]);
	}
}

function traerZona_n($acceso,$dat){
	$id_sector = $dat['id_sector'];
	$acceso->objeto->ejecutarSql("select *from vista_sector1 where id_sector='$id_sector'");
	if($row=row($acceso)){
		$cad['id_zona']=trim($row["id_zona"]);
		$cad['id_ciudad']=trim($row["id_ciudad"]);
		$cad['id_mun']=trim($row["id_mun"]);
		$cad['id_esta']=trim($row["id_esta"]);
		
	}
	return $cad;
}

function cargar_datos_sector($acceso,$dat){
	$id_sector = $dat['id_sector'];
	$acceso->objeto->ejecutarSql("select *from vista_sector1 where id_sector='$id_sector'");
	if($row=row($acceso)){
		$cad['id_zona']=trim($row["id_zona"]);
		$cad['id_ciudad']=trim($row["id_ciudad"]);
		$cad['id_mun']=trim($row["id_mun"]);
		$cad['id_esta']=trim($row["id_esta"]);
		$cad['id_franq']=trim($row["id_franq"]);
	}
	$cad['id_calle']=cargarCalle_n($acceso,$dat);
	$cad['id_urb']=cargarUrb_n($acceso,$dat);
	$cad['id_edif']=cargarEdif_n($acceso,$dat);
	return $cad;
}

function traerSector($acceso,$id_calle){
	$acceso->objeto->ejecutarSql("select *from vista_calle1 where id_calle='$id_calle'");
	if($row=row($acceso)){
		return "=@".trim($row["id_sector"])."=@".trim($row["id_zona"])."=@".trim($row["id_ciudad"])."=@".trim($row["id_mun"])."=@".trim($row["id_esta"])."=@".trim($row["id_franq"]);
	}
}
function traerSector_n($acceso,$dat){
	$id_calle = $dat['id_calle'];
	$acceso->objeto->ejecutarSql("select *from vista_calle1 where id_calle='$id_calle'");
	if($row=row($acceso)){
		$cad['id_sector']=trim($row["id_sector"]);
		$cad['id_zona']=trim($row["id_zona"]);
		$cad['id_ciudad']=trim($row["id_ciudad"]);
		$cad['id_mun']=trim($row["id_mun"]);
		$cad['id_esta']=trim($row["id_esta"]);
		$cad['id_franq']=trim($row["id_franq"]);
		
	}
	return $cad;
}
function traerSectorUrb($acceso,$id_urb){
	$acceso->objeto->ejecutarSql("select *from vista_urb where nombre_urb='$id_urb'");
	if($row=row($acceso)){
		return "=@".trim($row["id_sector"])."=@".trim($row["id_zona"])."=@".trim($row["id_ciudad"])."=@".trim($row["id_mun"])."=@".trim($row["id_esta"])."=@".trim($row["id_franq"]);
	}
}
function traerSectorUrb_n($acceso,$dat){
	$id_urb = $dat['id_urb'];
	$acceso->objeto->ejecutarSql("select *from vista_urb where id_urb='$id_urb'");
	if($row=row($acceso)){
		$cad['id_sector']=trim($row["id_sector"]);
		$cad['id_zona']=trim($row["id_zona"]);
		$cad['id_ciudad']=trim($row["id_ciudad"]);
		$cad['id_mun']=trim($row["id_mun"]);
		$cad['id_esta']=trim($row["id_esta"]);
		$cad['id_franq']=trim($row["id_franq"]);
	}
	return $cad;
}
function traerSectorEdif_n($acceso,$dat){
	$id_edif = $dat['id_edif'];
	$acceso->objeto->ejecutarSql("select *from vista_edificio where id_edif='$id_edif'");
	if($row=row($acceso)){
		$cad['id_sector']=trim($row["id_sector"]);
		$cad['id_zona']=trim($row["id_zona"]);
		$cad['id_ciudad']=trim($row["id_ciudad"]);
		$cad['id_mun']=trim($row["id_mun"]);
		$cad['id_esta']=trim($row["id_esta"]);
		$cad['id_franq']=trim($row["id_franq"]);
	}
	return $cad;
}
function traerCalle($acceso,$edificio){
	$acceso->objeto->ejecutarSql("select *from vista_edificio where edificio='$edificio'");
	if($row=row($acceso)){
		return "=@".trim($row["id_sector"])."=@".trim($row["id_zona"])."=@".trim($row["id_franq"])."=@".trim($row["id_calle"]);
	}
}
function traerCalle_n($acceso,$dat){
	$edificio = $dat['edificio'];
	$acceso->objeto->ejecutarSql("select *from vista_edificio where edificio='$edificio'");
	if($row=row($acceso)){
		$cad['id_sector']=trim($row["id_sector"]);
		$cad['id_zona']=trim($row["id_zona"]);
		$cad['id_ciudad']=trim($row["id_ciudad"]);
		$cad['id_mun']=trim($row["id_mun"]);
		$cad['id_esta']=trim($row["id_esta"]);
	}
	return $cad;
}
function cargar_ciudad($acceso,$id_mun){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from ciudad where id_mun='$id_mun' and status_ciudad='ACTIVO' order By nombre_ciudad");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_ciudad"]),trim($row["nombre_ciudad"]));
	}
	return $cad;	
}

function cargar_ciudad_n($acceso,$dat){
	$id_mun = $dat['id_mun'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from ciudad where id_mun='$id_mun' and status_ciudad='ACTIVO' order By nombre_ciudad");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_ciudad"]),trim($row["nombre_ciudad"]));
	}
	return $cad;
}
function cargar_municipio($acceso,$id_esta){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from municipio where id_esta='$id_esta' and status_mun='ACTIVO' order By nombre_mun");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_mun"]),trim($row["nombre_mun"]));
	}
	return $cad;
}
function cargar_municipio_n($acceso,$dat){
	$id_esta = $dat['id_esta'];
	$cad=opcion('',_("Seleccione..."));
	//$cad=$cad. "select *from municipio where id_esta='$id_esta' and status_mun='ACTIVO' order By nombre_mun";
	$acceso->objeto->ejecutarSql("select *from municipio where id_esta='$id_esta' and status_mun='ACTIVO' order By nombre_mun");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_mun"]),trim($row["nombre_mun"]));
	}
	return $cad;
}
function cargarubicacion($acceso,$dat){
	$id_franq = $dat['id_franq'];
	if($id_franq!='' && $id_franq!='0'){
		$cad['id_esta']=cargar_estado_f($acceso,$dat);
		$cad['id_mun']=cargar_municipio_f($acceso,$dat);
		$cad['id_ciudad']=cargar_ciudad_f($acceso,$dat);
		$cad['id_zona']=cargar_zona_f($acceso,$dat);
		$cad['id_sector']=cargar_sector_f($acceso,$dat);
		$cad['id_calle']=cargarCalle_f($acceso,$dat);
		$cad['id_edif']=cargarEdif_f($acceso,$dat);
		$cad['id_urb']=cargarUrb_f($acceso,$dat);
	}else{
		$cad['id_esta']=verEstado($acceso);
		$cad['id_mun']=verMun($acceso);
		$cad['id_ciudad']=verCiudad($acceso);
		$cad['id_zona']=verZona($acceso);
		$cad['id_sector']=verSector($acceso);
		$cad['id_calle']=verCalle($acceso);
		$cad['id_edif']=verEdif($acceso);
		$cad['id_urb']=verUrb($acceso);
	}
	return $cad;	
}

function cargar_sector_f($acceso,$dat){
	$id_franq = $dat['id_franq'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select id_sector,nombre_sector from vista_sector1 where id_franq='$id_franq' group by id_sector,nombre_sector order By nombre_sector");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_sector"]),trim($row["nombre_sector"]));
	}
	return $cad;
}
function cargar_zona_f($acceso,$dat){
	$id_franq = $dat['id_franq'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select id_zona,nombre_zona from vista_sector1 where id_franq='$id_franq' group by id_zona,nombre_zona order By nombre_zona");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_zona"]),trim($row["nombre_zona"]));
	}
	return $cad;	
}
function cargar_ciudad_f($acceso,$dat){
	$id_franq = $dat['id_franq'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select id_ciudad,nombre_ciudad from vista_sector1 where id_franq='$id_franq' group by id_ciudad,nombre_ciudad order By nombre_ciudad");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_ciudad"]),trim($row["nombre_ciudad"]));
	}
	return $cad;
}
function cargar_municipio_f($acceso,$dat){
	$id_franq = $dat['id_franq'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select id_mun,nombre_mun from vista_sector1 where id_franq='$id_franq' group by id_mun,nombre_mun order By nombre_mun");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_mun"]),trim($row["nombre_mun"]));
	}
	return $cad;	
}
function cargar_estado_f($acceso,$dat){
	$id_franq = $dat['id_franq'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select id_esta,nombre_esta from vista_sector1 where id_franq='$id_franq' group by id_esta,nombre_esta order By nombre_esta");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_esta"]),trim($row["nombre_esta"]));
	}
	return $cad;	
}
function cargar_estado($acceso,$id_franq){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from estado where id_franq='$id_franq' and status_esta='ACTIVO' order By nombre_esta");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_esta"]),trim($row["nombre_esta"]));
	}
	return $cad;	
}


function cargar_detalle_resp($acceso,$dat){
	$id_trl = $dat['id_trl'];

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from detalle_resp where id_trl='$id_trl' and status_drl='ACTIVO' order By nombre_drl");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_drl"]),trim($row["nombre_drl"]));
	}
	return $cad;	
}

function ver_estado($acceso){
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}

	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from estado where status_esta='ACTIVO' $consult order By nombre_esta");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_esta"]),trim($row["nombre_esta"]));
	}
	return $cad;	
}

function agregar_mes($acceso,$id_contrato){
	$ini_u = $_SESSION["ini_u"];
	//$mes_a=date("Y")."-".date("m")+1;
	//	$mes_a.=."-01";
	
	$fechaSig=date("Y-m-01"); 
	//$fechaSig=restames($fechaSig);
	
		//echo "select id_serv from contrato_servicio where id_contrato='$id_contrato' order by status_con_ser";
				$acceso->objeto->ejecutarSql("select id_serv from contrato_servicio where id_contrato='$id_contrato' order by status_con_ser"); 
				if($row=row($acceso)){
					$id_serv=trim($row['id_serv']);
				}
				
				
	//echo " : select fecha_inst from servicios, contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst>='$fechaSig' and status_con_ser<>'CONTRATO' and tipo_costo='COSTO MENSUAL'  and contrato_servicio_deuda.id_serv='$id_serv' and costo_cobro>0 order by fecha_inst desc ";
	$acceso->objeto->ejecutarSql("select fecha_inst from servicios, contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst>='$fechaSig' and status_con_ser<>'CONTRATO' and tipo_costo='COSTO MENSUAL'  and contrato_servicio_deuda.id_serv='$id_serv' and costo_cobro>0 order by fecha_inst desc ");
	if($row=row($acceso)){
			$fecha_inst_deuda=trim($row["fecha_inst"]);
			$fecha=$fecha_inst_deuda;
			//echo "<br>DEUDA:$fecha_inst_deuda,$fechaSig";
		if(comparaFecha($fecha_inst_deuda,$fechaSig)>0){
			$fechaSig=$fecha_inst_deuda;
		}
	}
	
	//echo " : select fecha_inst from servicios, contrato_servicio_pagado where id_contrato='$id_contrato' and fecha_inst>='$fechaSig' and status_con_ser<>'CONTRATO' and tipo_costo='COSTO MENSUAL' and contrato_servicio_pagado.id_serv='$id_serv' and costo_cobro>0 order by fecha_inst desc ";
	$acceso->objeto->ejecutarSql("select fecha_inst from servicios, contrato_servicio_pagado where id_contrato='$id_contrato' and fecha_inst>='$fechaSig' and status_con_ser<>'CONTRATO' and tipo_costo='COSTO MENSUAL' and contrato_servicio_pagado.id_serv='$id_serv' and costo_cobro>0 order by fecha_inst desc ");
	
	if($row=row($acceso)){
			$fecha_inst_pagado=trim($row["fecha_inst"]);
			$fecha=$fecha_inst_pagado;
			//echo "<br>PAGADO:$fecha_inst_pagado,$fechaSig";
		if(comparaFecha($fecha_inst_pagado,$fechaSig)>0){
			$fechaSig=$fecha_inst_pagado;
		}
	}
	
	
	//echo "<br>$fecha_inst_pagado,$fechaSig";
	
	if($fecha==''){
		$fechaSig=date("Y-m-01");
	//	$fechaSig=sumames(date("Y-m-01"));
	}
	else{
			$fec = explode ( "-", $fechaSig );
			$mes=$fec[1];
			$anio=$fec[0];
			//echo "$anio"."-$mes"."-01:";
			$fechaSig=sumames("$anio"."-$mes"."-01");
	}
		//echo "<br>FECHA_SIG:$fechaSig:";
			$dato=lectura($acceso,"select id_serv,cant_serv,costo_cobro from vista_contratoser where id_contrato='$id_contrato' and status_con_ser='CONTRATO'");
			//echo "select id_serv,cant_serv from vista_contratoser where id_contrato='$id_contrato' and status_con_ser='CONTRATO'";
				$sum_d=0;
			for($i=0;$i<count($dato);$i++){
				$id_serv=trim($dato[$i]['id_serv']);
				$cant_serv=trim($dato[$i]['cant_serv']);
				$costo_cobro=trim($dato[$i]['costo_cobro']);
				
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fechaSig' and id_serv='$id_serv' and costo_cobro>0 ");
					if(!$row=row($acceso)){
						$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_pagado where id_contrato='$id_contrato' and fecha_inst='$fechaSig' and id_serv='$id_serv' and costo_cobro>0 ");
						if(!$row=row($acceso)){
						
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
				//$id_cont_serv=$ini_u.verCodLong($acceso,"id_cont_serv");
				$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
				
				$fecha=$fechaSig;
				
				$acceso->objeto->ejecutarSql("select tarifa_ser from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'"); 
				if($row=row($acceso)){
					$tarifa_ser=trim($row['tarifa_ser']);
				}
				$acceso->objeto->ejecutarSql("select tarifa_esp from servicios where id_serv='$id_serv' and tarifa_esp='TRUE' "); 
				if($row=row($acceso)){
					$tarifa_ser=$costo_cobro;
				}
								
								$tar=$tarifa_ser;
								$tarifa_ser= verifica_promocion($acceso,$id_contrato,$id_serv,$fecha,$tarifa_ser);
								if($tar!=$tarifa_ser){
								//	echo "<br>$nro_contrato : $id_serv : $tar : $tarifa_ser";
								}
								
								
				//$sum_d=$sum_d+$tarifa_ser;
				
				$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser','0','AUTOMATICO')");

				//actualizarDeuda($acceso,$id_contrato);
				/*
				require_once "Clases/auditoria.php";
				$objeto=new auditoria("Registra Cargo",$id_cont_serv,"Registrado por un Usuario a $tarifa_ser");
				$objeto->incluirauditoria($acceso);
				*/
				}
				}
			}
}

function sumames_cant($fecha,$meses){
//$fecha = "2010-01-08";
$enunmes = explode ( "-", $fecha );
$sumaunmes = mktime ( 0, 0, 0, date("$enunmes[1]") + $meses, date("$enunmes[2]"), date("$enunmes[0]") );
return date ("Y-m-d", $sumaunmes);
}

function verPromocionesActivas($acceso){
	$cad=opcion('',_("Seleccione..."));
	$fecha=date("Y-m-d");
	$acceso->objeto->ejecutarSql("select *from promocion where status_promo='ACTIVO' and  inicio_promo<='$fecha' and fin_promo>='$fecha' order By nombre_promo");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_promo"]),trim($row["nombre_promo"]));
	}
	return $cad;	
}
function verifica_promocion($acceso,$id_contrato,$id_serv,$fecha,$tarifa_ser){
	
	$acceso->objeto->ejecutarSql("select tipo_promo,descuento_promo from vista_promocion,promo_serv where vista_promocion.id_promo=promo_serv.id_promo and id_contrato='$id_contrato' and id_serv='$id_serv' and  inicio_promo<='$fecha' and fin_promo>='$fecha'  and status_promo='ACTIVO' and status_promo_con='ACTIVO'");
	if($row=row($acceso))
	{
		$tipo_promo=trim($row["tipo_promo"]);
		$descuento_promo=trim($row["descuento_promo"]);
		if($tipo_promo=="PORCENTAJE DESCUENTO"){
			$descuento=($tarifa_ser*$descuento_promo)/100;
			$tarifa_ser = $tarifa_ser-$descuento;
		}
		else if($tipo_promo=="MONTO DESCUENTO"){
			$tarifa_ser = $tarifa_ser-$descuento_promo;
		}
		else if($tipo_promo=="MONTO FIJO"){
			$tarifa_ser = $descuento_promo;
		}
	}
	if($tarifa_ser>=0){
		return $tarifa_ser;
	}
	else{
		return 0;
	}
}

function verPromocionesActivasR($acceso){
	$cad=opcion('',_("Seleccione..."));
	$cad=$cad.opcion('',_("Todas las promociones"));
	$fecha=date("Y-m-d");
	$acceso->objeto->ejecutarSql("select *from promocion where status_promo='ACTIVO' and  inicio_promo<='$fecha' and fin_promo>='$fecha' order By nombre_promo");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_promo"]),trim($row["nombre_promo"]));
	}
	return $cad;	
}

function verServidorTodo($acceso){
	$cad=opcion('',_("Todos"));
	$acceso->objeto->ejecutarSql("select *from servidor where status_ser='ACTIVO' order By nombre_servidor");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_servidor"]),trim($row["nombre_servidor"]));
	}
	return $cad;	
}

function verServidor($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from servidor where status_ser='ACTIVO' order By nombre_servidor");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_servidor"]),trim($row["nombre_servidor"]));
	}
	return $cad;	
}

function ajusta_cargo_pago($acceso,$id_contrato,$monto_pago){
	$acceso1=conexion();
	$resto=$monto_pago;
	$id_select='';
	$i=0;
	if($monto_pago>0){
		while($monto_pago>0){
			$id_select='';
			$monto_pago=$resto;
		//	echo "<br>select id_cont_serv,((cant_serv * costo_cobro)- descu+0 ) as costo,fecha_inst from vista_contratodeu where id_contrato='$id_contrato' and status_con_ser='DEUDA' and costo_cobro>0 order by fecha_inst,inc";
			$acceso1->objeto->ejecutarSql("select id_cont_serv,((cant_serv * costo_cobro)- descu+0 ) as costo,fecha_inst,inc from vista_contratodeu where id_contrato='$id_contrato' and status_con_ser='DEUDA' and costo_cobro>0 order by fecha_inst,inc");

			while($row=row($acceso1)){
				$id_cont_serv=trim($row['id_cont_serv']);
				$fecha_inst=trim($row['fecha_inst']);
				$costo=trim($row['costo'])+0;
			//	echo "<br>$fecha_inst:$monto_pago >= $costo:";
				if($monto_pago>=$costo){
					$id_select=$id_select."=@$id_cont_serv";
					$monto_pago=$monto_pago-$costo;
				}
				else if($monto_pago>0){
					
					$dif=$costo-$monto_pago;
					
					//echo "Update contrato_servicio_deuda Set costo_cobro='$monto_pago', descu='0',cant_serv='1' where id_cont_serv='$id_cont_serv'";
					$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set costo_cobro='$monto_pago', descu='0',cant_serv='1' where id_cont_serv='$id_cont_serv'");
					$id_select=$id_select."=@$id_cont_serv";
					
					$acceso->objeto->ejecutarSql("select * from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'");
					$cad='';
					if($row=row($acceso)){
						$id_serv = trim($row["id_serv"]);
						$id_contrato = trim($row["id_contrato"]);
						$fecha_inst = trim($row["fecha_inst"]);
						$cant_serv = trim($row["cant_serv"]);
						$status_con_ser = trim($row["status_con_ser"]);
						$costo_cob = trim($row["costo_cobro"]);
						
						$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
						$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
						
						//echo "insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','Deuda','$dif','0','AUTOMATICO')";
						$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','Deuda','$dif','0','AUTOMATICO')");
					}
					$monto_pago=0;
				}
			}
			if($monto_pago>0){
				agregar_mes($acceso,$id_contrato);
			}
			if($i==50){
				break;
			}
			$i++;
		}
	}
	return $id_select;	
}

function ajusta_cargo_pago_factura($acceso,$id_contrato,$monto_pago){
$acceso1=conexion();
		
	$acceso1->objeto->ejecutarSql("update contrato_servicio_deuda set apagar=0 where (select count(*) from pagos where contrato_servicio_deuda.id_pago=pagos.id_pago and id_contrato='$id_contrato')>0 ");

		$acceso->objeto->ejecutarSql("select id_pago from  pagos where status_pago='DEUDA' AND pagos.id_contrato='$id_contrato'  AND tipo_doc='ABONO'");
		while($row=row($acceso)){
			$id_pago=trim($row['id_pago']);
			$acceso1->objeto->ejecutarSql("select contrato_servicio_deuda.id_pago from pago_factura,contrato_servicio_deuda where pago_factura.id_cont_serv=contrato_servicio_deuda.id_cont_serv and contrato_servicio_deuda.id_pago='$id_pago'");
			if(!$row=row($acceso1)){
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
	return $id_select;
}

function verEstacionTrabajo($acceso){
	session_start();
	$cad=opcion('',_("Todas"));
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		
		$consult=" and id_franq='$id_f'";
	}
	//echo "select estacion_trabajo.id_est,id_franq,mac_est,nombre_est from estacion_trabajo,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and estacion_trabajo.id_est=caja_cobrador.id_est $consult group by estacion_trabajo.id_est,id_franq,mac_est,nombre_est order by id_franq, nombre_est";
	$acceso->objeto->ejecutarSql("select estacion_trabajo.id_est,id_franq,mac_est,nombre_est from estacion_trabajo,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and estacion_trabajo.id_est=caja_cobrador.id_est $consult group by estacion_trabajo.id_est,id_franq,mac_est,nombre_est order by id_franq, nombre_est");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_est"]),trim($row["mac_est"])." => ".trim($row["nombre_est"]));
	}
	return $cad;	
}


function traer_equipo_fiscal($acceso,$id_franq){
	if($id_franq!='0'){
		$cad='';
		$consult=" and id_franq='$id_franq'";
	}
	else{
		
	}
	$cad=opcion('',_("Todas"));
	$acceso->objeto->ejecutarSql("select estacion_trabajo.id_est,id_franq,mac_est,nombre_est from estacion_trabajo,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and estacion_trabajo.id_est=caja_cobrador.id_est $consult group by estacion_trabajo.id_est,id_franq,mac_est,nombre_est order by id_franq, nombre_est");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_est"]),trim($row["mac_est"])." => ".trim($row["nombre_est"]));
	}
	return $cad;	
}
function combinar_cargos($acceso,$id_contrato){
	
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='61'");
		$row=row($acceso);
		$mes_a_cargar=trim($row['valor_param']);
		$fecha=date("Y-m-01");
		
		if($mes_a_cargar=='POSTERIOR'){
			$fecha=sumames($fecha);
			$fecha=sumames($fecha);
		}
		else if($mes_a_cargar=='ACTUAL'){
			$fecha=sumames($fecha);
		}
		
		//ECHO ":$fecha:";		
	
	$id_serv_fraccion='ZZZ00001';
	$acceso1=conexion();
	$acceso2=conexion();
	//echo "<br><br>select fecha_inst,count(*) as cant from contrato_servicio_deuda where id_contrato='$id_contrato' group by fecha_inst";
	$acceso1->objeto->ejecutarSql("select fecha_inst,count(*) as cant from contrato_servicio_deuda where id_contrato='$id_contrato' group by fecha_inst");
	while ($row=row($acceso1))
	{
		$fecha_inst=trim($row["fecha_inst"]);
		$cant=trim($row["cant"])+0;
		if($cant>1){
		//	echo "<br>select id_cont_serv from contrato_servicio_deuda where id_contrato='$id_contrato'  and fecha_inst='$fecha_inst' <br>";
			$acceso2->objeto->ejecutarSql("select id_cont_serv,id_serv from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst='$fecha_inst' and id_serv<>'$id_serv_fraccion'");
			$row=row($acceso2);
			$id_cont_serv=trim($row["id_cont_serv"]);
			$id_serv=trim($row["id_serv"]);
		
		//	echo "<br>select id_cont_serv,costo_cobro from contrato_servicio_deuda where id_contrato='$id_contrato' and id_cont_serv<>'$id_cont_serv' and (id_serv='$id_serv' or id_serv='$id_serv_fraccion') and fecha_inst='$fecha_inst' <br>";
			$acceso2->objeto->ejecutarSql("select id_cont_serv,costo_cobro from contrato_servicio_deuda where id_contrato='$id_contrato' and id_cont_serv<>'$id_cont_serv' and (id_serv='$id_serv' or id_serv='$id_serv_fraccion') and fecha_inst='$fecha_inst' ");
			while($row=row($acceso2))
			{
				$id_cont_serv1=trim($row["id_cont_serv"]);
				$costo_cobro1=trim($row["costo_cobro"]);
				//echo "<br>update contrato_servicio_deuda set costo_cobro=(costo_cobro + $costo_cobro1) where id_cont_serv='$id_cont_serv'";
				$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set costo_cobro=(costo_cobro + $costo_cobro1) where id_cont_serv='$id_cont_serv'");
				//echo "<br>delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv1'";
				$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv1'");
			}
		}
	}
	
	//echo "<br><br>delete from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst>='$fecha'  and (select count(*) from vista_tarifa where contrato_servicio_deuda.id_serv=vista_tarifa.id_serv and contrato_servicio_deuda.costo_cobro=tarifa_ser and status_tarifa_ser='ACTIVO')>0 and (select count(*) from servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and tipo_costo='COSTO MENSUAL'";
	$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_contrato='$id_contrato' and fecha_inst>='$fecha'  and (select count(*) from vista_tarifa where contrato_servicio_deuda.id_serv=vista_tarifa.id_serv and contrato_servicio_deuda.costo_cobro=tarifa_ser and status_tarifa_ser='ACTIVO')>0 and (select count(*) from servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and tipo_costo='COSTO MENSUAL')>0
	
	");
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
function agregar_aviso_unico_cargar_deuda($acceso,$id_contrato){
	session_start();
	$ini_u = $_SESSION["ini_u"];
	if($ini_u==''){
		$ini_u = "XH"; 
	}

	$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
	$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
				
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='46' and id_franq='1'");
	$row=row($acceso);
	$dig_fact_G=trim($row['valor_param']);
		
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='52' and id_franq='1'");
	$row=row($acceso);
	$dig_control_G=trim($row['valor_param']);
		
	$acceso->objeto->ejecutarSql("select nombre_servicio from servicios where id_serv='$id_serv'");
	$row=row($acceso);
	$nombre_servicio=trim($row['nombre_servicio']);
	
	
	
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	$id_caja_cob='EA00000001';
	$fecha_pago=date("Y-m-d");
	$fecha=date("Y-m-d");
	
	$monto_pago=0;
	//list($ano,$mes,$dia)=explode("-",$fecha);
	$mes_letra=formato_mes_com1($mes);
	$obser_pago="CARGOS VARIOS";
	$status_pago="GENERADA";
	
	
		$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='AVISO' and tipo_caja='PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 ");
		$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
	
		$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='AVISO' and tipo_caja='PRINCIPAL' ORDER BY nro_control desc LIMIT 1 offset 0 "); 
		$nro_control = verNumero_factura_v4($acceso,"nro_control",$dig_fact_G);
		
	$por_iva=12;
	$desc_pago=0;
	$fecha_factura=$fecha;
	$impresion="NO";
	$tipo_doc="AVISO";
	$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc)
	values ('$id_pago','$id_caja_cob','now()','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$nro_control','$desc_pago','$por_iva','$fecha_factura','$impresion','$tipo_doc')");
	$acceso1=conexion();
	$acceso1->objeto->ejecutarSql("select * from cargar_deuda where id_contrato='$id_contrato' ");
	while($row=row($acceso1)){
		$id_cd= trim($row["id_cd"]);
		$id_serv= trim($row["id_serv"]);
		$cant_serv= trim($row["cantidad"]);
		$tarifa_ser= trim($row["costo"]);
		$tarifa_ser= verifica_promocion($acceso,$id_contrato,$id_serv,$fecha,$tarifa_ser);

		$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago) values ('$id_cont_serv','$id_serv','$fecha','$cant_serv','DEUDA','$tarifa_ser','0','$id_pago')");
		$acceso->objeto->ejecutarSql("delete from cargar_deuda where id_cd='$id_cd'");
		$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
	}
	$monto_pago=actualizar_monto_pago($acceso,$id_pago);
	if($monto_pago==0){
		$acceso->objeto->ejecutarSql("delete from pagos  id_pago='$id_pago'");
	}else{
		asignar_pago_adelantado($acceso,$id_contrato);
	}
	valida_documento($acceso,$id_pago,"AVISO",'UNICO');
}

function agregar_factura_unico_cargar_deuda($acceso,$id_contrato){
	session_start();
	$ini_u = $_SESSION["ini_u"];
	if($ini_u==''){
		$ini_u = "XH"; 
	}

	$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
	$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
				
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='46' and id_franq='1'");
	$row=row($acceso);
	$dig_fact_G=trim($row['valor_param']);
		
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='52' and id_franq='1'");
	$row=row($acceso);
	$dig_control_G=trim($row['valor_param']);
		
	$acceso->objeto->ejecutarSql("select nombre_servicio from servicios where id_serv='$id_serv'");
	$row=row($acceso);
	$nombre_servicio=trim($row['nombre_servicio']);
	
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	$id_caja_cob='EA00000001';
	$fecha_pago=date("Y-m-d");
	$fecha=date("Y-m-d");
	
	$monto_pago=0;
	//list($ano,$mes,$dia)=explode("-",$fecha);
	$mes_letra=formato_mes_com1($mes);
	$obser_pago="CARGOS VARIOS";
	$status_pago="GENERADA";
	
	
		$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='FACTURA' and tipo_caja='PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 ");
		$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
	
		$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='FACTURA' and tipo_caja='PRINCIPAL' ORDER BY nro_control desc LIMIT 1 offset 0 "); 
		$nro_control = verNumero_factura_v4($acceso,"nro_control",$dig_fact_G);
		
	$por_iva=12;
	$desc_pago=0;
	$fecha_factura=$fecha;
	$impresion="NO";
	$tipo_doc="FACTURA";
	$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc)
	values ('$id_pago','$id_caja_cob','now()','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$nro_control','$desc_pago','$por_iva','$fecha_factura','$impresion','$tipo_doc')");
	$acceso1=conexion();
	$acceso1->objeto->ejecutarSql("select * from cargar_deuda where id_contrato='$id_contrato' ");
	while($row=row($acceso1)){
		$id_cd= trim($row["id_cd"]);
		$id_serv= trim($row["id_serv"]);
		$cant_serv= trim($row["cantidad"]);
		$tarifa_ser= trim($row["costo"]);
		$tarifa_ser= verifica_promocion($acceso,$id_contrato,$id_serv,$fecha,$tarifa_ser);

		$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago) values ('$id_cont_serv','$id_serv','$fecha','$cant_serv','DEUDA','$tarifa_ser','0','$id_pago')");
		$acceso->objeto->ejecutarSql("delete from cargar_deuda where id_cd='$id_cd'");
		$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
	}
	$monto_pago=actualizar_monto_pago($acceso,$id_pago);
	if($monto_pago==0){
		$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
	}else{
		asignar_pago_adelantado($acceso,$id_contrato);
	}
	valida_documento($acceso,$id_pago,"FACTURA",'UNICO');
}
function agregar_aviso_unico_cliente($acceso,$id_contrato,$fecha,$id_serv,$costo){
	session_start();
	$ini_u = $_SESSION["ini_u"];
	if($ini_u==''){
		$ini_u = "XH"; 
	}

	$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
	$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
				
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='46' and id_franq='1'");
	$row=row($acceso);
	$dig_fact_G=trim($row['valor_param']);
		
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='52' and id_franq='1'");
	$row=row($acceso);
	$dig_control_G=trim($row['valor_param']);
		
	$acceso->objeto->ejecutarSql("select nombre_servicio from servicios where id_serv='$id_serv'");
	$row=row($acceso);
	$nombre_servicio=trim($row['nombre_servicio']);
	
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	$id_caja_cob='EA00000001';
	$fecha_pago=date("Y-m-d");
	
	$monto_pago=0;
	//list($ano,$mes,$dia)=explode("-",$fecha);
	$mes_letra=formato_mes_com1($mes);
	$obser_pago="CARGOS VARIOS";
	$status_pago="GENERADA";
	
	
		$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='AVISO' and tipo_caja='PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 ");
		$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
	
		$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='AVISO' and tipo_caja='PRINCIPAL' ORDER BY nro_control desc LIMIT 1 offset 0 "); 
		$nro_control = verNumero_factura_v4($acceso,"nro_control",$dig_fact_G);
	$por_iva=12;
	$desc_pago=0;
	$fecha_factura=$fecha;
	$impresion="NO";
	$tipo_doc="AVISO";

		$cant_serv= 1;
		$tarifa_ser= $costo;
		$tarifa_ser= verifica_promocion($acceso,$id_contrato,$id_serv,$fecha,$tarifa_ser);

		$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago) values ('$id_cont_serv','$id_serv','$fecha','$cant_serv','DEUDA','$tarifa_ser','0','$id_pago')");
		$acceso->objeto->ejecutarSql("delete from cargar_deuda where id_cd='$id_cd'");
		$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);

	$monto_pago=actualizar_monto_pago($acceso,$id_pago);
	if($monto_pago==0){
		$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
	}else{
		asignar_pago_adelantado($acceso,$id_contrato);
	}
	valida_documento($acceso,$id_pago,"AVISO",'UNICO');
}
function valida_documento($acceso,$id_pago,$tipo_doc,$tipo_costo){
	if($tipo_doc=='PAGO'){
		$monto_pago=0;
		$monto_tp=0;
		$costo_cobro=0;
		$acceso->objeto->ejecutarSql("select monto_pago,id_contrato from pagos where id_pago='$id_pago' and tipo_doc='PAGO' ");
		if($row=row($acceso)){
			$monto_pago=trim($row['monto_pago'])+0;
			$id_contrato=trim($row['id_contrato']);
			$acceso->objeto->ejecutarSql("select sum(monto_tp) as monto_tp from detalle_tipopago where id_pago='$id_pago'");
			if($row=row($acceso)){
				$monto_tp=trim($row['monto_tp'])+0;
			}
			$acceso->objeto->ejecutarSql("select sum(costo_cobro_serv) as costo_cobro from pago_factura where id_pago='$id_pago'");
			if($row=row($acceso)){
				$costo_cobro=trim($row['costo_cobro'])+0;
			}
		}
		$monto_pago=number_format($monto_pago+0, 1, '.', '');
		$monto_tp=number_format($monto_tp+0, 1, '.', '');
		$costo_cobro=number_format($costo_cobro+0, 1, '.', '');
		
		if($monto_pago==$monto_tp && $monto_pago==$costo_cobro){
			return true;
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>DIFERENCIA EN MONTO: <br>Factura: $monto_pago <br>Servicio: $costo_cobro <br>Tipo Pago: $monto_tp<br>";
			return false;
		}
	}
	else if($tipo_doc=='AVISO' || $tipo_doc=='FACTURA'){
		$monto_pago=0;
		$costo_cobro=0;
		$acceso->objeto->ejecutarSql("select monto_pago,id_contrato from pagos where id_pago='$id_pago' and (tipo_doc='AVISO' or tipo_doc='FACTURA')");
		if($row=row($acceso)){
			$monto_pago=trim($row['monto_pago'])+0;
			$id_contrato=trim($row['id_contrato']);
			
			$acceso->objeto->ejecutarSql("select sum((cant_serv*costo_cobro)-descu) as costo_cobro from contrato_servicio_deuda where id_pago='$id_pago'");
			if($row=row($acceso)){
				$costo_cobro=trim($row['costo_cobro'])+0;
			}
		}
		$monto_pago=number_format($monto_pago+0, 1, '.', '');
		$costo_cobro=number_format($costo_cobro+0, 1, '.', '');
		
		if($monto_pago==$costo_cobro){
			return true;
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>DIFERENCIA EN MONTO: <br>Factura: $monto_pago <br>Servicio: $costo_cobro";
			return false;
		}
	}
	return false;
}

function agregar_aviso_cliente_solo($acceso,$id_contrato,$fecha){
	session_start();
	$ini_u = $_SESSION["ini_u"];
	if($ini_u==''){
		$ini_u = "ZZ";
	}

	$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
	$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
				
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='46' and id_franq='1'");
	$row=row($acceso);
	$dig_fact_G=trim($row['valor_param']);
		
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='52' and id_franq='1'");
	$row=row($acceso);
	$dig_control_G=trim($row['valor_param']);

	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	$id_caja_cob='EA00000001';

	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='AVISO' and tipo_caja='PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);

	$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='AVISO' and tipo_caja='PRINCIPAL' ORDER BY nro_control desc LIMIT 1 offset 0 "); 
	$nro_control = verNumero_factura_v4($acceso,"nro_control",$dig_fact_G);
	agregar_aviso_cliente($acceso,$id_contrato,$fecha,$id_pago,$id_caja_cob,$nro_factura,$nro_control,$dig_fact_G,$dig_control_G,$id_cont_serv);
	return $id_pago;
}

function agregar_factura_cliente_solo($acceso,$id_contrato,$fecha){
	session_start();
	$ini_u = $_SESSION["ini_u"];
	if($ini_u==''){
		$ini_u = "ZZ";
	}

	$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
	$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
				
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='46' and id_franq='1'");
	$row=row($acceso);
	$dig_fact_G=trim($row['valor_param']);
		
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='52' and id_franq='1'");
	$row=row($acceso);
	$dig_control_G=trim($row['valor_param']);

	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	$id_caja_cob='EA00000001';

	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='FACTURA' and tipo_caja='PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);

	$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='FACTURA' and tipo_caja='PRINCIPAL' ORDER BY nro_control desc LIMIT 1 offset 0 "); 
	$nro_control = verNumero_factura_v4($acceso,"nro_control",$dig_fact_G);
	agregar_factura_cliente($acceso,$id_contrato,$fecha,$id_pago,$id_caja_cob,$nro_factura,$nro_control,$dig_fact_G,$dig_control_G,$id_cont_serv);
}

function agregar_aviso_cliente_unico($acceso,$id_contrato,$fecha,$id_pago,$id_serv,$costo,$id_caja_cob,$nro_factura,$nro_control,$dig_fact_G,$dig_control_G,$id_cont_serv){
	session_start();
	$ini_u = $_SESSION["ini_u"];
	if($ini_u==''){
		$ini_u = "ZZ";
	}

	
	$fecha_pago=date("Y-m-d");
	
	$monto_pago=0;
	list($ano,$mes,$dia)=explode("-",$fecha);
	$mes_letra=formato_mes_com1($mes);
	$obser_pago="AVISO $mes_letra $ano";
	$status_pago="GENERADA";

	$por_iva=12;
	$desc_pago=0;
	$fecha_factura=$fecha;
	$impresion="NO";
	$tipo_doc="AVISO";
	
	$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc)
	values ('$id_pago','$id_caja_cob','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$nro_control','$desc_pago','$por_iva','$fecha_factura','$impresion','$tipo_doc')");
		

		$cant_serv= 1;
		$tarifa_ser= $costo;
		$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago) values ('$id_cont_serv','$id_serv','$fecha','$cant_serv','DEUDA','$tarifa_ser','0','$id_pago')");
		$acceso->objeto->ejecutarSql("delete from cargar_deuda where id_cd='$id_cd'");
		$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);

	
	$monto_pago=actualizar_monto_pago($acceso,$id_pago);
	//echo ":$monto_pago:";
	if($monto_pago==0){
		$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
	}else{
		asignar_pago_adelantado($acceso,$id_contrato);
	}

	valida_documento($acceso,$id_pago,"AVISO",'MENSUAL');
	return $id_cont_serv;
}

function agregar_aviso_cliente($acceso,$id_contrato,$fecha,$id_pago,$id_caja_cob,$nro_factura,$nro_control,$dig_fact_G,$dig_control_G,$id_cont_serv){
	session_start();
	$ini_u = $_SESSION["ini_u"];
	if($ini_u==''){
		$ini_u = "ZZ";
	}
	$fecha_pago=date("Y-m-d");
	
	$monto_pago=0;
	list($ano,$mes,$dia)=explode("-",$fecha);
	$mes_letra=formato_mes_com1($mes);
	$obser_pago="AVISO $mes_letra $ano";
	$status_pago="GENERADA";
	
	$por_iva=12;
	$desc_pago=0;
	$fecha_factura=$fecha;
	$impresion="NO";
	$tipo_doc="AVISO";
	
	if(!$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc)
	values ('$id_pago','$id_caja_cob','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$nro_control','$desc_pago','$por_iva','$fecha_factura','$impresion','$tipo_doc')")){
		}

	$dato=lectura($acceso,"select id_serv from contrato_servicio where id_contrato='$id_contrato' and status_con_ser='CONTRATO'");

	$mes_inst=date ("Y-m",mktime(0,0,0, $mes,$dia,$ano));
	for($i=0;$i<count($dato);$i++){
		$id_serv=trim($dato[$i]['id_serv']);
		$tarifa=array();

		$acceso->objeto->ejecutarSql("select id_pago from pagos where id_contrato='$id_contrato' and TO_CHAR(fecha_factura,'YYYY-MM') ='$mes_inst' and  monto_pago>0 and (tipo_doc='AVISO' or tipo_doc='FACTURA')");
		if(!$row=row($acceso)){
					$tarifa=ver_tarifa_contrato_servicio($acceso,$fecha,$id_serv,$id_contrato);
					$cant_serv=$tarifa['cant_serv'];
					$tarifa_ser=$tarifa['costo_cobro'];
					//$tarifa_ser= verifica_promocion($acceso,$id_contrato,$id_serv,$fecha,$tarifa_ser);
					$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago) values ('$id_cont_serv','$id_serv','$fecha','$cant_serv','DEUDA','$tarifa_ser','0','$id_pago')");
					$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
		}
	}//ind contrato
	
	$monto_pago=actualizar_monto_pago($acceso,$id_pago);
	//echo ":$monto_pago:";
	if($monto_pago==0){
		$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
	}else{
		asignar_pago_adelantado($acceso,$id_contrato);
	}

	valida_documento($acceso,$id_pago,"AVISO",'MENSUAL');
	return $id_cont_serv;
}

function agregar_factura_cliente($acceso,$id_contrato,$fecha,$id_pago,$id_caja_cob,$nro_factura,$nro_control,$dig_fact_G,$dig_control_G,$id_cont_serv){
	session_start();
	$ini_u = $_SESSION["ini_u"];
	if($ini_u==''){
		$ini_u = "ZZ";
	}
	
	$fecha_pago=date("Y-m-d");
	
	$monto_pago=0;
	list($ano,$mes,$dia)=explode("-",$fecha);
	$mes_letra=formato_mes_com1($mes);
	$obser_pago="FACTURA $mes_letra $ano";
	$status_pago="GENERADA";
	
	$por_iva=12;
	$desc_pago=0;
	$fecha_factura=$fecha;
	$impresion="NO";
	$tipo_doc="FACTURA";
	
	if(!$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc)
	values ('$id_pago','$id_caja_cob','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$nro_control','$desc_pago','$por_iva','$fecha_factura','$impresion','$tipo_doc')")){
		}

	$dato=lectura($acceso,"select id_serv from contrato_servicio where id_contrato='$id_contrato' and status_con_ser='CONTRATO'");

	$mes_inst=date ("Y-m",mktime(0,0,0, $mes,$dia,$ano));
	for($i=0;$i<count($dato);$i++){
		$id_serv=trim($dato[$i]['id_serv']);
		$tarifa=array();
		//echo "select id_pago from pagos where id_contrato='$id_contrato' and TO_CHAR(fecha_factura,'YYYY-MM') ='$mes_inst' and  monto_pago>0 and (tipo_doc='AVISO' or tipo_doc='FACTURA')";
		$acceso->objeto->ejecutarSql("select id_pago from pagos where id_contrato='$id_contrato' and TO_CHAR(fecha_factura,'YYYY-MM') ='$mes_inst' and  monto_pago>0 and (tipo_doc='AVISO' or tipo_doc='FACTURA')");
		if(!$row=row($acceso)){
					$tarifa=ver_tarifa_contrato_servicio($acceso,$fecha,$id_serv,$id_contrato);
					$cant_serv=$tarifa['cant_serv'];
					$tarifa_ser=$tarifa['costo_cobro'];
					//$tarifa_ser= verifica_promocion($acceso,$id_contrato,$id_serv,$fecha,$tarifa_ser);
					$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago) values ('$id_cont_serv','$id_serv','$fecha','$cant_serv','DEUDA','$tarifa_ser','0','$id_pago')");
					$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
		}
		/*else{
			echo "Aviso tiene una factura cargada para este mes";
		}*/
	}//ind contrato
	
	$monto_pago=actualizar_monto_pago($acceso,$id_pago);
	//echo ":$monto_pago:";
	if($monto_pago==0){
		$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
	}else{
		asignar_pago_adelantado($acceso,$id_contrato);
	}

	valida_documento($acceso,$id_pago,"FACTURA",'MENSUAL');
	return $id_cont_serv;
}

function asignar_pago_adelantado($acceso,$id_contrato){
	//echo "<br><br><br>entro a regular<br>";
	$cable=conexion();
	$acceso1=conexion();
	$cable->objeto->ejecutarSql("select id_pago,costo_cobro,id_cont_serv from vista_pago_ser where id_contrato='$id_contrato' and id_serv='ZZZ00001'");
	while($row=row($cable)){
	
		$id_pago=trim($row['id_pago']);
		$id_cont_serv_deuda=trim($row['id_cont_serv']);
		$monto_pago=trim($row['costo_cobro'])+0;
		
		//echo "<br>:$id_pago:$monto_pago:$id_cont_serv_deuda";
		//echo "<br>:select tipo_costo,id_cont_serv,(((cant_serv * costo_cobro)-descu) - pagado ) as costo from vista_contratodeu where id_contrato='$id_contrato' and status_con_ser='DEUDA' and costo_cobro>0 order by  tipo_serv ,fecha_inst:<br>";
		
		
		
		
		$acceso1->objeto->ejecutarSql("select tipo_costo,id_cont_serv,(((cant_serv * costo_cobro)-descu) - pagado ) as costo from vista_contratodeu where id_contrato='$id_contrato' and status_con_ser='DEUDA' and (((cant_serv * costo_cobro)-descu) - pagado )>0 order by  tipo_serv ,fecha_inst");
		while($row=row($acceso1)){
			$id_cont_serv=trim($row['id_cont_serv']);
			$tipo_costo=trim($row['tipo_costo']);
			$costo=trim($row['costo'])+0;
			//echo "<br>id_cont_serv:$id_cont_serv:costo:$costo<br>";
			if($monto_pago>=$costo){
				$id_select=$id_select."=@$id_cont_serv";
				$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set apagar=0, pagado=pagado+'$costo' where id_cont_serv='$id_cont_serv'");
				$acceso->objeto->ejecutarSql("insert into pago_factura(id_pago,id_cont_serv,costo_cobro_serv) values ('$id_pago','$id_cont_serv','$costo')");
				$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set status_con_ser='PAGADO'  where id_cont_serv='$id_cont_serv' and ((cant_serv * costo_cobro)-descu)=pagado");
				$monto_pago=$monto_pago-$costo;
			}
			else if($monto_pago>0){
				$id_select=$id_select."=@$id_cont_serv";
				$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set apagar=0, pagado=pagado+'$monto_pago'  where id_cont_serv='$id_cont_serv'");
				
				$cable->objeto->ejecutarSql("select costo_cobro_serv from pago_factura where id_pago='$id_pago' and id_cont_serv='$id_cont_serv'");
				if($row=row($cable)){
					$costo_cobro_serv1=trim($row['costo_cobro_serv'])+0;
					//echo "<BR>ENTRO ACT<BR>update  pago_factura set costo_cobro_serv=costo_cobro_serv+$costo_cobro_serv1 where id_pago='$id_pago' and id_cont_serv='$id_cont_serv';";
					$acceso->objeto->ejecutarSql("update  pago_factura set costo_cobro_serv=costo_cobro_serv+$costo_cobro_serv1 where id_pago='$id_pago' and id_cont_serv='$id_cont_serv'");
				}
				else{
					$acceso->objeto->ejecutarSql("insert into pago_factura(id_pago,id_cont_serv,costo_cobro_serv) values ('$id_pago','$id_cont_serv','$monto_pago')");
				}
				$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set status_con_ser='PAGADO'  where id_cont_serv='$id_cont_serv' and ((cant_serv * costo_cobro)-descu)=pagado");
				$monto_pago=0;
			}
		}
		$acceso->objeto->ejecutarSql("select id_pago  from contrato_servicio_deuda where id_cont_serv='$id_cont_serv_deuda'");
		$row=row($acceso);
		$id_pago_ade=trim($row['id_pago']);
			//echo "<br>:$monto_pago:<br>";
		if($monto_pago>0){
			$acceso->objeto->ejecutarSql("update pago_factura set costo_cobro_serv=$monto_pago where id_cont_serv='$id_cont_serv_deuda' ");
			$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set costo_cobro=$monto_pago, pagado=$monto_pago where id_cont_serv='$id_cont_serv_deuda'");
			
			actualizar_monto_pago($acceso,$id_pago_ade);
		}else{
			
			$acceso->objeto->ejecutarSql("delete from pago_factura where id_cont_serv='$id_cont_serv_deuda'");
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_deuda where id_cont_serv='$id_cont_serv_deuda'");
			//echo "delete from pagos where id_pago='$id_pago_ade'<br><br>";
			$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago_ade'");
		}

	}//while inicial
}


function actualizar_monto_pago($acceso,$id_pago){
	$acceso->objeto->ejecutarSql("select sum((cant_serv*costo_cobro)-descu) as monto_pago, sum(descu) as  desc_pago from contrato_servicio_deuda where id_pago='$id_pago'");
	$row=row($acceso);
	$monto_pago=trim($row['monto_pago'])+0;
	$desc_pago=trim($row['desc_pago'])+0;
	$acceso->objeto->ejecutarSql("update pagos set monto_pago='$monto_pago' , desc_pago='$desc_pago' where id_pago='$id_pago'");
	return  $monto_pago;
}

function agregar_abono($acceso,$id_contrato,$monto_pago){
	
	if($ini_u==''){
		$ini_u = "ZZ";  
	}
	$fecha=date("Y-m-d");
	$id_serv='ZZZ00001';
			
	$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
	$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
				
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='46' and id_franq='1'");
	$row=row($acceso);
	$dig_fact_G=trim($row['valor_param']);
		
	$acceso->objeto->ejecutarSql("select *from parametros where id_param='52' and id_franq='1'");
	$row=row($acceso);
	$dig_control_G=trim($row['valor_param']);
	
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	$id_caja_cob='EA00000001';
	$fecha_pago=date("Y-m-d");
	
	$monto_pago=$monto_pago;
	list($ano,$mes,$dia)=explode("-",$fecha);
	$mes_letra=formato_mes_com1($mes);
	$obser_pago="ABONO $mes_letra $ano";
	$status_pago="DEUDA";
	
	
		$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='ABONO' and tipo_caja='PRINCIPAL' ORDER BY nro_factura desc LIMIT 1 offset 0 "); 
		$nro_factura = verNumero_factura_v4($acceso,"nro_factura",$dig_fact_G);
	
		$acceso->objeto->ejecutarSql("select nro_control,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago<>'ANULADO' and tipo_doc='ABONO' and tipo_caja='PRINCIPAL' ORDER BY nro_control desc LIMIT 1 offset 0 "); 
		$nro_control = verNumero_factura_v4($acceso,"nro_control",$dig_fact_G);

	$por_iva=12;
	$desc_pago=0;
	$monto_iva=0;
	$base_imp=0;
	$fecha_factura=$fecha;
	$impresion="NO";
	$tipo_doc="ABONO";
	$monto_reten=0;
	$islr=0;
	if(!$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc) 
	values ('$id_pago','$id_caja_cob','now()','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$nro_control','$desc_pago','$por_iva','$fecha_factura','$impresion','$tipo_doc')")){
			
		}

	
		$id_serv=$id_serv;
		$cant_serv=1;
		$costo_cobro=$monto_pago;
		
					$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago,apagar) values ('$id_cont_serv','$id_serv','$fecha','$cant_serv','Deuda','$costo_cobro','0','$id_pago','$costo_cobro')");
	$monto_pago=actualizar_monto_pago($acceso,$id_pago);
	if($monto_pago==0){
		$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$id_pago'");
	}
	return $id_cont_serv;
}




function verEstacionT($acceso){
	session_start();
	$cad=opcion('',_("Seleccione..."));
	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		
		$consult=" and nom_comp='$id_f'";
	}
	else{
	//	$consult=" and nom_comp='0'";
	}
	// echo "select id_est,mac_est,nombre_est,id_franq from estacion_trabajo  $consult order by nombre_est";
	$acceso->objeto->ejecutarSql("select id_est,mac_est,nombre_est from estacion_trabajo WHERE status_est='IMPRESORAFISCAL' $consult order by nombre_est");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_est"]),trim($row["mac_est"])." => ".trim($row["nombre_est"]));
	}
	return $cad;	
}


function limpiar($array)
{
	$arreglo= array();
	foreach ($array as $key => $value)
	{
			$arreglo[$key] = trim($value);
	}/*
	while ($valor = current($array)) {
	        $arreglo[key($array)] = trim($valor);
	    next($array);
	}*/
    return $arreglo; 
}
function limpiar_entrada($array)
{
	$arreglo= array();
	foreach ($array as $key => $value)
	{
		if(is_array ($value)==false && is_object ($value)==false){
			$arreglo[$key] = addslashes($value);
		}else{
			$arreglo[$key] = $value;
		}
	}
    return $arreglo; 
}
function ver_paquete($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from paquete where status_paq='ACTIVO' order by nombre_paq");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_paq"]),trim($row["nombre_paq"]));
	}
	return $cad;
}
function ver_cant_tv($acceso){
	$cad='';
	$acceso->objeto->ejecutarSql("select *from cant_tv where status_cant='ACTIVO' order by cantidad");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_cant"]),trim($row["cantidad"]));
	}
	return $cad;
}

function ver_tipo_sist_equipo($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from tipo_sist_equipo where status_tse='ACTIVO' order by sistema,ubicacion");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tse"]),trim($row["sistema"])." ".trim($row["ubicacion"]));
	}
	return $cad;	
}

function ver_comando_interfaz($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from comandos_interfaz where status_com_int='ACTIVO' order by nombre_com_int");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_com_int"]),trim($row["nombre_com_int"]));
	}
	return $cad;	
}

function cargar_comandos_interfaz($acceso,$dat){
	$id_tse = $dat['id_tse'];
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from comandos_interfaz where status_com_int='ACTIVO' and id_tse='$id_tse' order by nombre_com_int");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_com_int"]),trim($row["nombre_com_int"]));
	}
	return $cad;	
}

function traer_comandos_interfaz($acceso,$dat){
	$id_com_int = $dat['id_com_int'];
	$acceso->objeto->ejecutarSql("select id_tse from comandos_interfaz where id_com_int='$id_com_int' ");
	if($row=row($acceso))
	{
		$cad['id_tse']=trim($row["id_tse"]);
	}
	return $cad;	
}

function cargar_marca_modelo($acceso,$dat){
	$id_tse = $dat['id_tse'];
	$cad['id_marca']=cargar_marca($acceso,$id_tse);
	$cad['id_modelo']=cargar_modelo($acceso,$id_tse);
	
	return $cad;	
}


function cargar_marca($acceso,$id_tse){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select distinct marca.id_marca,nombre_marca from marca,modelo where marca.id_marca=modelo.id_marca and  id_tse='$id_tse' and status_marca='ACTIVO' order By nombre_marca");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_marca"]),trim($row["nombre_marca"]));
	}
	return $cad;	
}
function ver_marca($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from marca where status_marca='ACTIVO' order By nombre_marca");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_marca"]),trim($row["nombre_marca"]));
	}
	return $cad;	
}

function ver_ubicacion_equipo_sist($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from ubicacion_equipo_sis where status_ues='ACTIVO' order By nombre_ues");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_ues"]),trim($row["nombre_ues"]));
	}
	return $cad;	
}

function ver_marca_m($acceso,$tipo_modelo){
	$cad=opcion('',_("Seleccione..."));

	$acceso->objeto->ejecutarSql("select distinct id_marca,nombre_marca from vista_modelo where tipo_modelo='$tipo_modelo' and   status_marca='ACTIVO' order By nombre_marca");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["id_marca"]),trim($row["nombre_marca"]));
	}
	return $cad;
}
function ver_modelo($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from modelo where  status_modelo='ACTIVO' order By nombre_modelo");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["id_modelo"]),trim($row["nombre_modelo"]));
	}
	return $cad;	
}
function verEmpresas($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from empresa  order By razon_social_emp");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["id_emp"]),trim($row["razon_social_emp"]));
	}
	return $cad;	
}
function verGrupoFranq($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from grupo_franq where status_gf='ACTIVO' order By nombre_gf");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["id_gf"]),trim($row["nombre_gf"]));
	}
	return $cad;	
}
function cargar_modelo($acceso,$id_tse){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from modelo where  id_tse='$id_tse' and  status_modelo='ACTIVO' order By nombre_modelo");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["id_modelo"]),trim($row["nombre_modelo"]));
	}
	return $cad;	
}
function cargar_modelo_m($acceso,$id_marca){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from modelo where  id_marca='$id_marca' and  status_modelo='ACTIVO' order By nombre_modelo");
	while ($row=row($acceso)){
		$cad=$cad.opcion(trim($row["id_modelo"]),trim($row["nombre_modelo"]));
	}
	return $cad;	
}

function verifica_cedula($acceso,$dat){
	$cedula = $dat['cedula'];
	//echo "select id_persona,nombre,apellido from persona where cedula='$cedula'";
	$acceso->objeto->ejecutarSql("select id_persona,nombre,apellido from persona where cedula='$cedula'");
	$cad='';
	$dat['existe']=false;
	if($row=row($acceso)){
		$dat['existe']=true;
		$id_persona=trim($row["id_persona"]);
		$dat['tipo']="EMPLEADO";
		$id_persona=trim($row["id_persona"]);
		$dat['id_persona']=$id_persona;
		$dat['nombre']=trim($row["apellido"])." ".trim($row["nombre"]);	
		//echo "select id_persona from cliente where id_persona='$id_persona'";
		$acceso->objeto->ejecutarSql("select id_persona from cliente where id_persona='$id_persona'");
		if($row=row($acceso)){
			$dat['tipo']="CLIENTE";
			
		}
		
	}
	return $dat;
}

function traer_numero_abonado($acceso,$dat){
	$id_franq = $dat['id_franq'];
		
$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_franq'");
$row=row($acceso);
$serie=trim($row['serie']);
		

$acceso->objeto->ejecutarSql("select *from parametros where id_param='43' and id_franq='1'");
$row=row($acceso);
$dig_cont_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='44' and id_franq='1'");
$row=row($acceso);
$serie_correl_G=trim($row['valor_param']);
		
			$acceso->objeto->ejecutarSql("select nro_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle AND id_franq='$id_franq'  ORDER BY num desc  LIMIT 1 offset 0 ");
			if($serie_correl_G!='0' && $serie_correl_G!=''){
				$nro_abonado= $serie.verNumero_abonado_v4($acceso,"nro_contrato",$dig_cont_G,$serie_correl_G);
			}else{
				$nro_abonado= verNumero_abonado_v4($acceso,"nro_contrato",$dig_cont_G,$serie_correl_G);
			}
			$acceso->objeto->ejecutarSql("select * from contrato where nro_contrato='$nro_contrato' ");
			if($row=row($acceso)){
				$nro_abonado= '';
			}
	$dat['nro_abonado']=$nro_abonado;
	return $dat;
}
function traer_numero_abonado_zona($acceso,$dat){

	$id_zona = $dat['id_zona'];
		
$acceso->objeto->ejecutarSql("select n_zona from zona where id_zona='$id_zona'");
$row=row($acceso);
$serie=trim($row['n_zona']);
		

$acceso->objeto->ejecutarSql("select *from parametros where id_param='43' and id_franq='1'");
$row=row($acceso);
$dig_cont_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='44' and id_franq='1'");
$row=row($acceso);
$serie_correl_G=trim($row['valor_param']);
			echo "select nro_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle AND id_zona='$id_zona'  ORDER BY num desc  LIMIT 1 offset 0 ";

			$acceso->objeto->ejecutarSql("select nro_contrato from function __construct($foo = null) {
				$this->foo = $foo;
			}trato,vista_ubica where contrato.id_calle=vista_ubica.id_calle AND id_zona='$id_zona'  ORDER BY num desc  LIMIT 1 offset 0 ");
			if($serie_correl_G!='0' && $serie_correl_G!=''){
				$nro_abonado= $serie.verNumero_abonado_v4($acceso,"nro_contrato",$dig_cont_G,$serie_correl_G);
			}else{
				$nro_abonado= verNumero_abonado_v4($acceso,"nro_contrato",$dig_cont_G,$serie_correl_G);
			}
			$acceso->objeto->ejecutarSql("select * from contrato where nro_contrato='$nro_contrato' ");
			if($row=row($acceso)){
				$nro_abonado= '';
			}
	$dat['nro_abonado']=$nro_abonado;
	return $dat;
}
function traer_numero_contrato($acceso,$dat){
	$id_persona = $dat['id_persona'];
	$acceso->objeto->ejecutarSql("select nro_recibo from vista_recibos where id_persona='$id_persona' and tipo='CONTRATO' and  status_pago='RECIBIDO' order by nro_recibo");
		$dat["existe"]=false;
		if($row=row($acceso)){
			$dat["existe"]=true;
			$dat["contrato_fisico"]=$inicial.trim($row['nro_recibo']);
		}
	return $dat;
}
function traer_costo_servicio($acceso,$dat){
	$id_serv = $dat['id_serv'];
	$acceso->objeto->ejecutarSql("select tarifa_ser,tarifa_esp from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'");
	$cad='';
	if($row=row($acceso)){
		$dat["costo_cobro"]=trim($row['tarifa_ser']);
		$dat["tarifa_esp"]=trim($row['tarifa_esp']);
	}
	return $dat;
}

function cargardetalle_tipopago($acceso,$dat){
	$id_pago = $dat['id_pago'];
	$dat=lecturaObj($acceso,"select *from detalle_tipopago_temp where id_pago='$id_pago'");
	return $dat;
}

function validarcontrato_control($acceso,$dat){
	$nro_recibo = $dat['nro_recibo'];
	$id_persona = $dat['id_persona'];

	$acceso->objeto->ejecutarSql("select *from vista_recibos where id_persona='$id_persona' and  nro_recibo='$nro_recibo' and status_pago='RECIBIDO' and tipo='CONTRATO'");
		if($row=row($acceso)){
			$cad["existe"]=false;
		}else{
			$cad["existe"]=true;
		}
	return $cad;
}
function traer_serv_sist_paq($acceso,$dat){
	$id_serv = $dat['id_serv'];
	$i=0;
	//echo "select *from serv_sist_paq where id_serv='$id_serv'";
	$acceso->objeto->ejecutarSql("select *from serv_sist_paq where id_serv='$id_serv'");
	while($row=row($acceso)){
		$cad[$i]['id_serv_sist']=trim($row['id_serv_sist']);
		$i++;
	}
	return $cad;
}
function traer_serv_sist_equipo($acceso,$dat){
	$id_es = $dat['id_es'];
	$i=0;
	//echo "select *from serv_sist_paq where id_serv='$id_serv'";
	$acceso->objeto->ejecutarSql("select *from serv_sist_equipo where id_es='$id_es'");
	while($row=row($acceso)){
		$cad[$i]['id_serv_sist']=trim($row['id_serv_sist']);
		$i++;
	}
	return $cad;
}
function traer_servicio_franquicia($acceso,$dat){
	$id_serv = $dat['id_serv'];
	$i=0;
	$acceso->objeto->ejecutarSql("select *from servicio_franquicia where id_serv='$id_serv'");
	while($row=row($acceso)){
		$cad[$i]['id_franq']=trim($row['id_franq']);
		$i++;
	}
	return $cad;
}
function traer_costo_ser($acceso,$dat){
	$id_serv = $dat['id_serv'];
	$id_contrato = $dat['id_contrato'];
	$acceso->objeto->ejecutarSql("select tarifa_ser from tarifa_servicio where id_serv='$id_serv' and status_tarifa_ser='ACTIVO' LIMIT 1 offset 0 ");
	$cad='';
	if($row=row($acceso)){
		$cad['tarifa_ser']=trim($row["tarifa_ser"]);
	}
		$cad['aviso']='';
		$mes=date("Y-m");
		$acceso->objeto->ejecutarSql("select nombre_servicio, fecha_inst,(cant_serv*costo_cobro) as costo from pagos,contrato_servicio_deuda,servicios where pagos.id_pago=contrato_servicio_deuda.id_pago and contrato_servicio_deuda.id_serv=servicios.id_serv and id_contrato='$id_contrato' and TO_CHAR(fecha_inst,'YYYY-MM') ='$mes' and servicios.id_serv='$id_serv' and costo_cobro>0 and status_con_ser='DEUDA' ");
		if($row=row($acceso)){
			$nombre_servicio= trim($row["nombre_servicio"]);
			$fecha_inst= trim($row["fecha_inst"]);
			$costo= trim($row["costo"]);
			$cad['aviso']="AVISO: este cliente ya tiene como deuda este servicio para este mes\nServicio: $nombre_servicio \nFecha: $fecha_inst \nCosto: $costo";
		}
		$acceso->objeto->ejecutarSql("select nombre_servicio, fecha_inst,(cant_serv*costo_cobro) as costo from pagos,contrato_servicio_deuda,servicios where pagos.id_pago=contrato_servicio_deuda.id_pago and contrato_servicio_deuda.id_serv=servicios.id_serv and id_contrato='$id_contrato' and TO_CHAR(fecha_inst,'YYYY-MM') ='$mes' and servicios.id_serv='$id_serv' and costo_cobro>0 and status_con_ser='PAGADO' ");
		if($row=row($acceso)){
			$nombre_servicio= trim($row["nombre_servicio"]);
			$fecha_inst= trim($row["fecha_inst"]);
			$costo= trim($row["costo"]);
			$cad['aviso']="AVISO: este cliente tiene como deuda este servicio para este mes\nServicio: $nombre_servicio \nFecha: $fecha_inst \nCosto: $costo";
		}
	return $cad;
}
function eliminar_cargar_deuda_contrato($acceso,$dat){
	$id_contrato = $dat['id_contrato'];
	$acceso->objeto->ejecutarSql("delete from cargar_deuda where id_contrato='$id_contrato'; ");
	return $dat;
}

function c_nro_factura_nc($acceso,$dat){
	$nro_factura = $dat['nro_factura'];

	$acceso->objeto->ejecutarSql("select n_credito,impresion,id_pago,pagos.nro_factura,pagos.nro_control ,nro_contrato,fecha_pago,nombre,apellido,monto_pago,status_pago from pagos,contrato,persona where pagos.id_contrato=contrato.id_contrato and contrato.cli_id_persona=persona.id_persona and pagos.nro_factura='$nro_factura' and tipo_doc='FACTURA'");
	$cad='';
	$cadena='';
	while($row=row($acceso)){
		$n_credito=trim($row["n_credito"]);
		if($n_credito!=''){
			$cad=$cad. "<tbody><tr style=\"cursor: pointer;\" onclick=\"alerta('Error esta Facturata ya posee Nota de Credito')\" ><td class=\"numeric\">".trim($row["id_pago"])."</td><td class=\"numeric\">".trim($row["nro_factura"])."</td><td class=\"numeric\">".trim($row["nro_control"])."</td><td class=\"numeric\">".trim($row["monto_pago"])."</td><td class=\"numeric\">".formatofecha(trim($row["fecha_pago"]))."</td><td>".trim($row["status_pago"])."</td><td class=\"numeric\">".trim($row["nro_contrato"])."</td><td>".trim($row["nombre"])."  ".trim($row["apellido"])."</td><td>".trim($row["impresion"])."</td></tr></tbody>";
		}
		else{
			$cad=$cad. "<tbody><tr style=\"cursor: pointer;\" onclick=\"traer_id_pago_nc('".trim($row["id_pago"])."')\" ><td class=\"numeric\">".trim($row["id_pago"])."</td><td class=\"numeric\">".trim($row["nro_factura"])."</td><td class=\"numeric\">".trim($row["nro_control"])."</td><td class=\"numeric\">".trim($row["monto_pago"])."</td><td class=\"numeric\">".formatofecha(trim($row["fecha_pago"]))."</td><td>".trim($row["status_pago"])."</td><td class=\"numeric\">".trim($row["nro_contrato"])."</td><td>".trim($row["nombre"])."  ".trim($row["apellido"])."</td><td>".trim($row["impresion"])."</td></tr></tbody>";
		}
	}
	if($cad!=''){
	
		$cadena=$cadena. '
		<section class="panel">

			
		<header class="panel-heading">Datos de la Factura Fiscal</header>
			<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			';
				$cadena=$cadena. '<table class="table table-hovered table-condensed">';
				$cadena=$cadena. '<thead><tr class="titulo-tabla"><th class="numeric">ID PAGO</th><th class="numeric">FACTURA</th><th class="numeric">CONTROL</th><th class="numeric">MONTO</th><th class="numeric">FECHA FACTURA</th><th>ESTATUS FACTURA</th> <th class="numeric">Nº ABONADO</th> <th>CLIENTE</th><th>IMPRESION</th></thead>';
				$cadena=$cadena. $cad;
				$cadena=$cadena. '</table>';
		$cadena=$cadena. '
			</div>
			</div>
		</section>
		';
	}
	//echo "entro";
	echo $cadena;
	return $cadena;
}
function c_nro_factura_nd($acceso,$dat){
	$nro_factura = $dat['nro_factura'];
	$acceso->objeto->ejecutarSql("select n_credito,impresion,id_pago,pagos.nro_factura,pagos.nro_control ,nro_contrato,fecha_pago,nombre,apellido,monto_pago,status_pago from pagos,contrato,persona where pagos.id_contrato=contrato.id_contrato and contrato.cli_id_persona=persona.id_persona and pagos.nro_factura='$nro_factura' and tipo_doc='FACTURA'");
	$cad='';
	$BR='';

	while($row=row($acceso)){
		$n_credito=trim($row["n_credito"]);
			$cad=$cad. "<tbody><tr style=\"cursor: pointer;\" onclick=\"traer_id_pago_nc('".trim($row["id_pago"])."')\" ><td class=\"numeric\">".trim($row["id_pago"])."</td><td class=\"numeric\">".trim($row["nro_factura"])."</td><td class=\"numeric\">".trim($row["nro_control"])."</td><td class=\"numeric\">".trim($row["monto_pago"])."</td><td class=\"numeric\">".formatofecha(trim($row["fecha_pago"]))."</td><td>".trim($row["status_pago"])."</td><td class=\"numeric\">".trim($row["nro_contrato"])."</td><td>".trim($row["nombre"])."  ".trim($row["apellido"])."</td><td>".trim($row["impresion"])."</td></tr></tbody>";
	//	}
	}
	if($cad!=''){
	
		echo '
		<section class="panel">

		<header class="panel-heading">Datos de la Factura Fiscal</header>
			
			<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			';
				echo '<table class="table table-hovered table-condensed">';
				echo '<thead><tr class="titulo-tabla"><th class="numeric">ID PAGO</th><th class="numeric">FACTURA</th><th class="numeric">CONTROL</th><th class="numeric">MONTO</th><th class="numeric">FECHA FACTURA</th><th>ESTATUS FACTURA</th> <th class="numeric">Nº ABONADO</th> <th>CLIENTE</th><th>IMPRESION</th></thead>';
				echo $cad;
				echo '</table>';
		echo '
			</div>
			</div>
	
		</section>
		';
	}	
}



function traeinfoFactura_nc($acceso,$id_pago){
	
	
	$acceso->objeto->ejecutarSql("select *from vista_pago_cont where id_pago='$id_pago' AND TIPO_DOC='FACTURA' LIMIT 1 offset 0 ");
	$cad='';
	if($row=row($acceso)){
		$id_contrato=trim($row["id_contrato"]);
		$nro_contrato=trim($row["nro_contrato"]);
		$cedula=trim($row["cedulacli"]);
		$cliente=trim($row["nombrecli"])." ".trim($row["apellidocli"]);
		$nro_factura=trim($row["nro_factura"]);
		$nro_control=trim($row["nro_control"]);
		$fecha_pago=formatofecha(trim($row["fecha_pago"]));
		$monto_pago=trim($row["monto_pago"])+0;
		
		
		echo '
		<section class="panel">

		<header class="panel-heading">Datos de la Factura Fiscal</header>
			
			<div class="panel-body">
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Nro Contrato</label>
					<input disabled type="hidden" name="id_contrato" maxlength="15" size="10"onChange="" value="'.$id_contrato.'">
					<input disabled class="form-control" type="text" name="nro_contrato" maxlength="15" size="10"onChange="" value="'.$nro_contrato.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Cedula</label>
					<input disabled class="form-control" type="text" name="cedula" maxlength="15" size="10"onChange="" value="'.$cedula.'">
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>Cliente</label>
					<input disabled class="form-control" type="text" name="cliente" maxlength="15" size="10"onChange="" value="'.$cliente.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Nro Factura</label>
					<input disabled class="form-control" type="text" name="nro_facturaA" maxlength="15" size="10"onChange="" value="'.$nro_factura.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Nro Control</label>
					<input disabled class="form-control" type="text" name="nro_controlA" maxlength="15" size="10"onChange="" value="'.$nro_control.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Fecha</label>
					<input disabled class="form-control" type="text" name="fecha_pago" maxlength="15" size="10"onChange="" value="'.$fecha_pago.'">
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Total</label>
					<input disabled class="form-control" type="text" name="monto_factura" maxlength="15" size="10"onChange="" value="'.$monto_pago.'">
				</div>
			</div>
	
		</section>
		';
	}
	
}


function cargar_serv_sist_equipo($acceso,$dat){
	$id_tse = $dat['id_tse'];
	$cad='';
	$acceso1=conexion();
	$acceso1->objeto->ejecutarSql("select *from tipo_sist_equipo where id_tse='$id_tse'");
						$i=1;
						while ($row1=row($acceso1))
						{
							$id_tse=trim($row1["id_tse"]);
							$sistema=trim($row1["sistema"]);
							$ubicacion=trim($row1["ubicacion"]);

							$cad=$cad. '<br><div style="width:220px; display: inline-block;" ><input  type="checkbox" name="tipo_sistema" value="" id="'.$id_tse.'ts" onclick="activacheckf_ts(\''.$id_tse.'\')">
							<label><header class="panel-heading">Interfaz '.$sistema.' '.$ubicacion.'</header></label></div>';
						
							$acceso->objeto->ejecutarSql("select *from servicios_sistema WHERE status_serv_sist='ACTIVO' and id_tse='$id_tse' order By abrev_serv_sist");
							$i=1;
							while ($row=row($acceso))
							{
								if($i==5){
								//	echo "<br>";
									$i=0;
								}
								$i++;

								$cad=$cad. '<div style="width:110px; display: inline-block;" ><input  type="checkbox" name="servicio" id="'.$id_tse.trim($row["id_serv_sist"]).'ts" value="'.trim($row["id_serv_sist"]).'">
						<label> '.trim($row["abrev_serv_sist"]).'</label></div>';
							}
						}
	return $cad;
}
function cargar_serv_sist_equipo_contrato($acceso,$dat){
	$id_tse = $dat['id_tse'];
	$id_contrato = $dat['id_contrato'];
	$id_es = $dat['id_es'];
	$cad='';
	$acceso1=conexion();
	$acceso2=conexion();
	$acceso1->objeto->ejecutarSql("select *from tipo_sist_equipo where id_tse='$id_tse'");
						$i=1;
						while ($row1=row($acceso1))
						{
							$id_tse=trim($row1["id_tse"]);
							$sistema=trim($row1["sistema"]);
							$ubicacion=trim($row1["ubicacion"]);

							$cad=$cad. '<br><div style="width:220px; display: inline-block;" ><input  type="checkbox" name="servicio" value="" id="'.$id_tse.'ts" onclick="activacheckf_ts_f3(\''.$id_tse.'\')">
							<label><header class="panel-heading">Interfaz '.$sistema.' '.$ubicacion.'</header></label></div>';
						
							$acceso->objeto->ejecutarSql("select *from servicios_sistema WHERE status_serv_sist='ACTIVO' and id_tse='$id_tse' order By abrev_serv_sist");
							$i=1;
							while ($row=row($acceso))
							{
								$id_serv_sist=trim($row["id_serv_sist"]);

								if($i==5){
								//	echo "<br>";
									$i=0;
								}
								$acceso2->objeto->ejecutarSql("select *from vista_cont_serv_sist_paq where id_contrato='$id_contrato' and id_serv_sist='$id_serv_sist' ");
								if (row($acceso2))
								{
									$i++;
									$checked='';
									$acceso2->objeto->ejecutarSql("select *from serv_sist_equipo where id_es='$id_es' and id_serv_sist='$id_serv_sist'");
									if(row($acceso2)){
										$checked=' checked';
									}
									$cad=$cad. '<div style="width:110px; display: inline-block;" ><input  type="checkbox" name="servicio" id="'.$id_tse.trim($row["id_serv_sist"]).'ts" value="'.trim($row["id_serv_sist"]).'" '.$checked.'>
							<label> '.trim($row["abrev_serv_sist"]).'</label></div>';
								}
							}
						}
	return $cad;	
}
function refrescar_terminales_todos($acceso,$dat){
	$id_contrato = $dat['id_contrato'];
	$status = "FALSE";
	$fecha = date("Y-m-d");
	session_start();
	$ini_u = $_SESSION["ini_u"];  
	$login = strtoupper(trim($_SESSION["login"]));

	$acceso->objeto->ejecutarSql("select *from interfaz_equipos  where (id_inte ILIKE '$ini_u%') ORDER BY id_inte desc"); 
	 $id_inte=$ini_u.verCoo($acceso,"id_inte");
	$cad='';
	$acceso1=conexion();
	$acceso1->objeto->ejecutarSql("select *from vista_equipo_sistema where id_contrato='$id_contrato'");
	while ($row1=row($acceso1))
	{
		$id_es=trim($row1["id_es"]);
		$id_tse=trim($row1["id_tse"]);
		$acceso->objeto->ejecutarSql("select *from comandos_interfaz WHERE status_com_int='ACTIVO' and id_tse='$id_tse' and tipo_com='REFRESCAR' ");
		if ($row=row($acceso))
		{
			$id_com_int=trim($row["id_com_int"]);
			$acceso->objeto->ejecutarSql("insert into interfaz_equipos(id_inte,id_com_int,id_es,status,fecha,login) values ('$id_inte','$id_com_int','$id_es','$status','now()','$login')");
			 $id_inte=$ini_u.verCoo_inc($acceso,$id_inte);
		}
	}
	return $cad;
}
function refrescar_terminal($acceso,$dat){
	$id_es = $dat['id_es'];
	$status = "FALSE";
	$fecha = date("Y-m-d");
	session_start();
	$ini_u = $_SESSION["ini_u"];
	$login = strtoupper(trim($_SESSION["login"]));
	$acceso->objeto->ejecutarSql("select *from interfaz_equipos  where (id_inte ILIKE '$ini_u%') ORDER BY id_inte desc"); 
	 $id_inte=$ini_u.verCoo($acceso,"id_inte");
	$cad='';
	$acceso1=conexion();
	$acceso1->objeto->ejecutarSql("select *from vista_equipo_sistema where id_es='$id_es'");
	if ($row1=row($acceso1))
	{
		$id_es=trim($row1["id_es"]);
		$id_tse=trim($row1["id_tse"]);
		//echo "select *from comandos_interfaz WHERE status_com_int='ACTIVO' and id_tse='$id_tse' and tipo_com='REFRESCAR' ";
		$acceso->objeto->ejecutarSql("select *from comandos_interfaz WHERE status_com_int='ACTIVO' and id_tse='$id_tse' and tipo_com='REFRESCAR' ");
		if ($row=row($acceso))
		{
			$id_com_int=trim($row["id_com_int"]);
			$acceso->objeto->ejecutarSql("insert into interfaz_equipos(id_inte,id_com_int,id_es,status,fecha,login) values ('$id_inte','$id_com_int','$id_es','$status','now()','$login')");
			 $id_inte=$ini_u.verCoo_inc($acceso,$id_inte);
		}
	}
	return $cad;
}
function autorizar_notas_sel($acceso,$dat){

  $pagos = $dat['pagos'];

    


  session_start();
  $login_aut = strtoupper(trim($_SESSION["login"]));
  $fecha_aut = date("Y-m-d");
  $hora_aut = date("H:i:s");
  $dir_ip_aut = $_SERVER['REMOTE_ADDR'];

  for ($i=0; $i < count($pagos); $i++){
    $id_pago=trim($pagos[$i]['id_pago']);
    $acceso1=conexion();
    $acceso1->objeto->ejecutarSql("select *from pago_factura where id_pago='$id_pago'");
    while ($row1=row($acceso1))
    {
      $id_cont_serv=trim($row1["id_cont_serv"]);
      $apagar=trim($row1["costo_cobro_serv"]);

      $acceso->objeto->ejecutarSql("update contrato_servicio_deuda set pagado=pagado+$apagar , apagar=0 where id_cont_serv='$id_cont_serv'");
      $acceso->objeto->ejecutarSql("update contrato_servicio_deuda set status_con_ser='PAGADO'  where id_cont_serv='$id_cont_serv' and ((cant_serv * costo_cobro)-descu)=pagado");
    }
    $acceso->objeto->ejecutarSql("Update pagos Set status_pago='PAGADO' Where id_pago='$id_pago'");

    $acceso1->objeto->ejecutarSql("select *from notas_cd where id_pago='$id_pago'");
    if ($row1=row($acceso1))
    {
      $id_nota=trim($row1["id_nota"]);
      $acceso->objeto->ejecutarSql("Update notas_cd Set status='AUTORIZADO', dir_ip_aut='$dir_ip_aut',login_aut='$login_aut', fecha_aut='$fecha_aut',hora_aut='$hora_aut' where id_nota='$id_nota'");
    }
    
  }

  return $cad;  
}
function negar_notas_sel($acceso,$dat){

  $pagos = $dat['pagos'];

    


  session_start();
  $login_aut = strtoupper(trim($_SESSION["login"]));
  $fecha_aut = date("Y-m-d");
  $hora_aut = date("H:i:s");
  $dir_ip_aut = $_SERVER['REMOTE_ADDR'];

  for ($i=0; $i < count($pagos); $i++){
    $id_pago=trim($pagos[$i]['id_pago']);

    $acceso1=conexion();
    $acceso->objeto->ejecutarSql("Update pagos Set status_pago='NEGADO' Where id_pago='$id_pago'");

    $acceso1->objeto->ejecutarSql("select *from notas_cd where id_pago='$id_pago'");
    if ($row1=row($acceso1))
    {
      $id_nota=trim($row1["id_nota"]);
      //echo "Update notas_cd Set status='NEGADO',login_aut='$login_aut', fecha_aut='$fecha_aut',hora_aut='$hora_aut' where id_nota='$id_nota'";
      $acceso->objeto->ejecutarSql("Update notas_cd Set status='NEGADO',dir_ip_aut='$dir_ip_aut', login_aut='$login_aut', fecha_aut='$fecha_aut',hora_aut='$hora_aut' where id_nota='$id_nota'");
    }
  }
  return $cad;
}

function traer_equipo_sistema_add($acceso,$dat){
	$codigo_es = $dat['codigo_es'];

	$i=0;
	//echo "select *from serv_sist_paq where id_serv='$id_serv'";
	$acceso->objeto->ejecutarSql("select *from serv_sist_equipo where id_es='$id_es'");
	while($row=row($acceso)){
		$cad[$i]['id_serv_sist']=trim($row['id_serv_sist']);
		$i++;
	}
	return $cad;
}

///////////////////////////////////////////////////CONCILIACION BANCARIA///////////////////////////////////////////////
///////////////////////////////////////////////////CONCILIACION BANCARIA///////////////////////////////////////////////
///////////////////////////////////////////////////CONCILIACION BANCARIA///////////////////////////////////////////////



function verTipoPago_df($acceso,$tipo_tp){
	$cad=opcion(0,_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from tipo_pago_df where status_pago='ACTIVO' and tipo_tp='$tipo_tp' order By tipo_pago");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tipo_pago"]),trim($row["tipo_pago"]));
	}
	return $cad;	
}

function ver_pagos_pendientes($acceso){
	$cad=opcion(0,_("Seleccione..."));
	session_start();
	$id_franq = $_SESSION["id_franq"]; 
	if($id_franq!='0'){
	
		$consult="  and id_franq='$id_franq' ";
	}
	
	//$id_franq = $_SESSION["id_franq"]; 
	$acceso->objeto->ejecutarSql("select id_df_tp,fecha_df,monto_df_tp, tipo_pago,nombre_est from vista_pagopendiente where status_df_tp='REGISTRADO' $consult order By fecha_df asc ");
	//$acceso->objeto->ejecutarSql("select id_df_tp,fecha_df,monto_df_tp, tipo_pago,nombre_est from vista_pagopendiente  order By fecha_df asc ");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_df_tp"]),formatofecha(trim($row["fecha_df"]))." => ".trim($row["monto_df_tp"])." => ".trim($row["tipo_pago"])." => ".trim($row["nombre_est"]));
	}
	return $cad;	
}

function cargar_todos_pagos_pend($acceso){
	$cad=opcion(0,_("Seleccione..."));
	session_start();
	$id_franq = $_SESSION["id_franq"]; 
	if($id_franq!='0'){
	
		$consult="  and id_franq='$id_franq' ";
	}
	
	$acceso->objeto->ejecutarSql("select id_df_tp,fecha_df,monto_df_tp, tipo_pago,nombre_est from vista_pagopendiente  order By fecha_df asc ");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_df_tp"]),formatofecha(trim($row["fecha_df"]))." => ".trim($row["monto_df_tp"])." => ".trim($row["tipo_pago"])." => ".trim($row["nombre_est"]));
	}
	return $cad;	
}

function vercuenta_bancaria($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from cuenta_bancaria where status_cuba='ACTIVO' order By abrev_cuba");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_cuba"]),trim($row["abrev_cuba"]). "   &nbsp; &nbsp; &nbsp; &nbsp;   =>   &nbsp; &nbsp; &nbsp;    ". trim($row["desc_cuba"]));
	}
	return $cad;
}
function vercuenta_bancaria_punto($acceso){
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select *from cuenta_bancaria where status_cuba='ACTIVO' and conc_franq='SI' order By abrev_cuba");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_cuba"]),trim($row["abrev_cuba"]). "   &nbsp; &nbsp; &nbsp; &nbsp;   =>   &nbsp; &nbsp; &nbsp;    ". trim($row["desc_cuba"]));
	}
	return $cad;
}
function conciliar_pago_franq($acceso,$id_dbf=""){
	//echo "ENTRO A CONCILIAR $id_dbf";
	
		
	$acceso1=conexion();
	
	$acceso2=conexion();
	
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		if($ini_u==''){
			$ini_u ="AA";
		}
	
	$login = $_SESSION["login"]; 
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	
	$sql_id_dbf="";
	if($id_dbf!=''){
		$sql_id_dbf=" and id_dbf='$id_dbf'";
	}
	//ECHO " select  *from detalle_tipopago_df,cuenta_bancaria  where detalle_tipopago_df.id_cuba=cuenta_bancaria.id_cuba and  status_dbf='REGISTRADO' $sql_id_dbf";
	$acceso2->objeto->ejecutarSql(" select  *from detalle_tipopago_df,cuenta_bancaria  where detalle_tipopago_df.id_cuba=cuenta_bancaria.id_cuba and  status_dbf='REGISTRADO' $sql_id_dbf");
	while($row=row($acceso2)){
			$conciliado=false;
			$id_df_tp=trim($row["id_df_tp"]);
			$id_tipo_pago=trim($row["id_tipo_pago"]);
			$banco_cuba=trim($row["banco_cuba"]);
			$id_dbf=trim($row["id_dbf"]);
			$fecha_dep=trim($row["fecha_dbf"]);
			$fecha_dep_hasta=sumadia($fecha_dep);
			$id_cuba=trim($row["id_cuba"]);
			$numero_ref=trim($row["refer_dbf"]);
			$comision_pv=trim($row["comision_pv"])+0;
			$comision_pv_c=trim($row["comision_pv_c"])+0;
			
			$monto_dep=trim($row["monto_dbf"])+0;
			$monto_dep1=$monto_dep-2;
			$monto_dep2=$monto_dep+2;
			$margen=100;
			$sql_monto=" and monto_tb>='$monto_dep1'  and monto_tb<='$monto_dep2' ";
			if(($id_tipo_pago=='AA000002' || $id_tipo_pago=='BJ000001') && $comision_pv>0){
				$por_com=100-$comision_pv;
				$monto_deposito=($monto_dep*$por_com)/100;
				$monto_deposito1=$monto_deposito-$margen;
				$monto_deposito2=$monto_deposito+$margen;
			//	//ECHO "<br>$por_com:$comision_pv:$monto_dep : $monto_deposito1 : $monto_deposito2";
				
				$sql_monto=" and ((monto_tb>='$monto_dep1'  and monto_tb<='$monto_dep2') or (monto_tb>='$monto_deposito1'  and monto_tb<='$monto_deposito2')) ";
			}
			else if(($id_tipo_pago=='AA000003') && $comision_pv_c>0){
				$por_com=100-$comision_pv_c;
				$monto_deposito=($monto_dep*$por_com)/100;
				$monto_deposito1=$monto_deposito-$margen;
				$monto_deposito2=$monto_deposito+$margen;
			//	//ECHO "<br>$por_com:$comision_pv:$monto_dep : $monto_deposito1 : $monto_deposito2";
				
				$sql_monto=" and ((monto_tb>='$monto_dep1'  and monto_tb<='$monto_dep2') or (monto_tb>='$monto_deposito1'  and monto_tb<='$monto_deposito2')) ";
			}
			////ECHO ":$id_tipo_pago:";
			
					if($numero_ref=='76'){
						//ECHO "<br>id_tipo_pago:$id_tipo_pago:$banco_cuba:$fecha_dep<br>";
					}
					
			if(($id_tipo_pago=='AA000003')){
					
				if($banco_cuba=='BANCO SOFITASA'){
					$palabra_clave='NC';
					$numero_ref=$numero_ref+0;
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb  ilike '%$numero_ref%' ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				} else if($banco_cuba=='EXTERIOR'){
					$palabra_clave='MC DEPOS.ELECTRONIC CCC TDC';
					$numero_ref=$numero_ref+0;
					
					$codigo="$numero_ref";
					if($numero_ref<10)
						$codigo="0".$codigo;
					if($numero_ref<100)
						$codigo="0".$codigo;
					if($numero_ref<1000)
						$codigo="0".$codigo;
					if($numero_ref<10000)
						$codigo="0".$codigo;
					if($numero_ref<100000)
						$codigo="0".$codigo;
					if($numero_ref<1000000)
						$codigo="0".$codigo;
					
					$numero_ref=$codigo;
					
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb  ilike '%$numero_ref%' ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				} else if($banco_cuba=='BANESCO'){
					if($numero_ref=='76'){
						//ECHO "<br>entro a banesco";
					}
					$palabra_clave='TDC';
					$numero_ref=$numero_ref+0;
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb='$numero_ref' ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				} else if($banco_cuba=='FONDO COMUN'){
					$palabra_clave='AB.LOTE';
					$numero_ref=$numero_ref+0;
					$codigo="$numero_ref";
					if($numero_ref<10)
						$codigo="0".$codigo;
					if($numero_ref<100)
						$codigo="0".$codigo;
					if($numero_ref<1000)
						$codigo="0".$codigo;
					
					$palabra_clave="AB.LOTE $codigo";
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				}
			}
			if(($id_tipo_pago=='AA000002' || $id_tipo_pago=='BJ000001')){
					if($numero_ref=='76'){
						//ECHO "<br>entro a debito";
					}
				if($banco_cuba=='BANCO SOFITASA'){
					$palabra_clave='NC';
					$numero_ref=$numero_ref+0;
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb  ilike '%$numero_ref%' ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				} else if($banco_cuba=='EXTERIOR'){
					$palabra_clave='MC DEPOS.ELECTRONI CCC MDS.C';
					$numero_ref=$numero_ref+0;
					
					$codigo="$numero_ref";
					if($numero_ref<10)
						$codigo="0".$codigo;
					if($numero_ref<100)
						$codigo="0".$codigo;
					if($numero_ref<1000)
						$codigo="0".$codigo;
					if($numero_ref<10000)
						$codigo="0".$codigo;
					if($numero_ref<100000)
						$codigo="0".$codigo;
					if($numero_ref<1000000)
						$codigo="0".$codigo;
					
					$numero_ref=$codigo;
					
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb  ilike '%$numero_ref%' ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				} else if($banco_cuba=='BANESCO'){
					if($numero_ref=='76'){
						//ECHO "<br>entro a banesco";
					}
					$palabra_clave='TDB CAPIT.';
					$numero_ref=$numero_ref+0;
					if($numero_ref=='76'){
						//ECHO "<br>comision:$comision_pv <br> select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb='$numero_ref' ";
					}
				//	//ECHO "<br><br> select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb='$numero_ref' ";
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb='$numero_ref' ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				} else if($banco_cuba=='FONDO COMUN'){
					$palabra_clave='AB.LOTE';
					$numero_ref=$numero_ref+0;
					$codigo="$numero_ref";
					if($numero_ref<10)
						$codigo="0".$codigo;
					if($numero_ref<100)
						$codigo="0".$codigo;
					if($numero_ref<1000)
						$codigo="0".$codigo;
					
					$palabra_clave="AB.LOTE $codigo";
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb between '$fecha_dep' and '$fecha_dep_hasta' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				}
			}
			else if($id_tipo_pago=='BJ000002'){
				
				$fecha_hasta=sumadia($fecha_dep);
				$fecha_hasta=sumadia($fecha_hasta);
				$fecha_hasta=sumadia($fecha_hasta);
				$fecha_hasta=sumadia($fecha_hasta);
				$fecha_hasta=sumadia($fecha_hasta);
				$fecha_hasta=sumadia($fecha_hasta);
				$fecha_hasta=sumadia($fecha_hasta);
				$fecha_d= "and fecha_tb between '$fecha_dep' and '$fecha_hasta'";
				
				//echo "PANAMERICANA";
				if($banco_cuba=='PROVINCIAL'){
					$palabra_clave='SRV.';
					$numero_ref=$numero_ref+0;
			//	echo " select * from vista_tablabancos where id_cuba='$id_cuba' $fecha_d and descrip_tb ilike '$palabra_clave%'  and descrip_tb ilike '%$numero_ref%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') ";
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' $fecha_d and descrip_tb ilike '$palabra_clave%'  and descrip_tb ilike '%$numero_ref%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	

						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				} else if($banco_cuba=='BANESCO'){
					$palabra_clave='DEP PLANILLA';
					$numero_ref=$numero_ref+0;
					if($numero_ref=='76'){
						//ECHO "<br>entro a banesco no debito";
					}
					//echo "<br><br> select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb='$fecha_dep' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb='$numero_ref'";
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb='$fecha_dep' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb='$numero_ref' ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
					}
				} 
			}//panamericana

			
			
			$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb='$fecha_dep' and referencia_tb='$numero_ref' $sql_monto  AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') ");
				if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						$acceso->objeto->ejecutarSql("update detalle_tipopago_df set status_dbf='CONCILIADO', id_tb='$id_tb'  where id_dbf='$id_dbf' ");	
						$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='FRANQUICIA' where id_tb='$id_tb'");	
						
						$acceso->objeto->ejecutarSql("update deposito_franq_tp set status_df_tp='CONCILIADO'  where id_df_tp='$id_df_tp' and status_df_tp<>'CONCILIADO' and (select sum(monto_dbf) from detalle_tipopago_df where detalle_tipopago_df.id_df_tp=deposito_franq_tp.id_df_tp and status_dbf='CONCILIADO' )>= (monto_df_tp-$margen) ");	
						$acceso->objeto->ejecutarSql(" select * from deposito_franq_tp where id_df_tp='$id_df_tp'");
						if($row=row($acceso)){
							$id_df=trim($row["id_df"]);
							$acceso->objeto->ejecutarSql("update deposito_franq set status_df='PAGADO'  where id_df='$id_df' and (select sum(monto_df_tp) from deposito_franq_tp where deposito_franq_tp.id_df=deposito_franq.id_df and status_df_tp='CONCILIADO' )>= (monto_z -$margen) ");	
						}
				}
	}
	
}

function conciliar_pago_franq_semejante_fecha($acceso,$id_dbf=""){
	
	$acceso1=conexion();
	
	$acceso2=conexion();
	
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		if($ini_u==''){
			$ini_u ="AA";
		}
	
	$login = $_SESSION["login"]; 
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	
	$sql_id_dbf="";
	if($id_dbf!=''){
		$sql_id_dbf=" and id_dbf='$id_dbf'";
	}
	//ECHO " select  *from detalle_tipopago_df,cuenta_bancaria  where detalle_tipopago_df.id_cuba=cuenta_bancaria.id_cuba and  status_dbf='REGISTRADO'";
	$acceso2->objeto->ejecutarSql(" select  *from detalle_tipopago_df,cuenta_bancaria  where detalle_tipopago_df.id_cuba=cuenta_bancaria.id_cuba and  status_dbf='REGISTRADO' $sql_id_dbf");
	while($row=row($acceso2)){
			$conciliado=false;
			$id_df_tp=trim($row["id_df_tp"]);
			$id_tipo_pago=trim($row["id_tipo_pago"]);
			$banco_cuba=trim($row["banco_cuba"]);
			$id_dbf=trim($row["id_dbf"]);
			$fecha_dep=trim($row["fecha_dbf"]);
			$fecha_dep_hasta=sumadia($fecha_dep);
			$id_cuba=trim($row["id_cuba"]);
			$numero_ref=trim($row["refer_dbf"]);
			$comision_pv=trim($row["comision_pv"])+0;
			
			$monto_dep=trim($row["monto_dbf"])+0;
			$monto_dep1=$monto_dep-2;
			$monto_dep2=$monto_dep+2;
			$margen=100;
			$sql_monto=" and monto_tb>='$monto_dep1'  and monto_tb<='$monto_dep2' ";
			if(($id_tipo_pago=='AA000002' || $id_tipo_pago=='BJ000001') && $comision_pv>0){
				$por_com=100-$comision_pv;
				$monto_deposito=($monto_dep*$por_com)/100;
				$monto_deposito1=$monto_deposito-$margen;
				$monto_deposito2=$monto_deposito+$margen;
			//	echo "<br>$por_com:$comision_pv:$monto_dep : $monto_deposito1 : $monto_deposito2";
				
				$sql_monto=" and ((monto_tb>='$monto_dep1'  and monto_tb<='$monto_dep2') or (monto_tb>='$monto_deposito1'  and monto_tb<='$monto_deposito2')) ";
			}
			
			if(($id_tipo_pago=='AA000002' || $id_tipo_pago=='BJ000001')){
				
				if($banco_cuba=='BANCO SOFITASA'){
					$palabra_clave='NC';
					$numero_ref=$numero_ref+0;
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and  descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb  ilike '%$numero_ref%' ");
					if($row1=row($acceso)){
						$fecha_tb=formatofecha(trim($row1["fecha_tb"]));
						$referencia_tb=trim($row1["referencia_tb"]);
						$monto_tb=trim($row1["monto_tb"]);
						$descrip_tb=trim($row1["descrip_tb"]);
						Echo "\n<BR>REGISTROS SIMILAR:
						<BR>Banco: $banco_cuba 
						<BR>Fecha: $fecha_tb 
						<BR>Referencia: $referencia_tb 
						<BR>Monto: $monto_tb 
						";
					}
				} else if($banco_cuba=='EXTERIOR'){
					$palabra_clave='MC DEPOS.ELECTRONI CCC MDS.C';
					$numero_ref=$numero_ref+0;
					
					$codigo="$numero_ref";
					if($numero_ref<10)
						$codigo="0".$codigo;
					if($numero_ref<100)
						$codigo="0".$codigo;
					if($numero_ref<1000)
						$codigo="0".$codigo;
					if($numero_ref<10000)
						$codigo="0".$codigo;
					if($numero_ref<100000)
						$codigo="0".$codigo;
					if($numero_ref<1000000)
						$codigo="0".$codigo;
					
					$numero_ref=$codigo;
					
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba'  and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb  ilike '%$numero_ref%' ");
					if($row1=row($acceso)){
						$fecha_tb=formatofecha(trim($row1["fecha_tb"]));
						$referencia_tb=trim($row1["referencia_tb"]);
						$monto_tb=trim($row1["monto_tb"]);
						$descrip_tb=trim($row1["descrip_tb"]);
						Echo "\n<BR>REGISTROS SIMILAR:
						<BR>Banco: $banco_cuba 
						<BR>Fecha: $fecha_tb 
						<BR>Referencia: $referencia_tb 
						<BR>Monto: $monto_tb 
						";
					}
				} else if($banco_cuba=='BANESCO'){
					$palabra_clave='TDB CAPIT.';
					$numero_ref=$numero_ref+0;
				//	echo "<br><br> select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb='$fecha_dep' and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb='$numero_ref' ";
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba'  and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') AND referencia_tb='$numero_ref' ");
					if($row1=row($acceso)){
						$fecha_tb=formatofecha(trim($row1["fecha_tb"]));
						$referencia_tb=trim($row1["referencia_tb"]);
						$monto_tb=trim($row1["monto_tb"]);
						$descrip_tb=trim($row1["descrip_tb"]);
						Echo "\n<BR>REGISTROS SIMILAR:
						<BR>Banco: $banco_cuba 
						<BR>Fecha: $fecha_tb 
						<BR>Referencia: $referencia_tb 
						<BR>Monto: $monto_tb
						";
					}
				} else if($banco_cuba=='FONDO COMUN'){
					$palabra_clave='AB.LOTE';
					$numero_ref=$numero_ref+0;
					$codigo="$numero_ref";
					if($numero_ref<10)
						$codigo="0".$codigo;
					if($numero_ref<100)
						$codigo="0".$codigo;
					if($numero_ref<1000)
						$codigo="0".$codigo;
					
					$palabra_clave="AB.LOTE $codigo";
					
					$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba'  and descrip_tb ilike '$palabra_clave%' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') ");
					if($row=row($acceso)){
						$id_tb=trim($row["id_tb"]);
						if($row1=row($acceso)){
						$fecha_tb=formatofecha(trim($row1["fecha_tb"]));
						$referencia_tb=trim($row1["referencia_tb"]);
						$monto_tb=trim($row1["monto_tb"]);
						$descrip_tb=trim($row1["descrip_tb"]);
						
						Echo "\n<BR>REGISTROS SIMILAR:
						<BR>Banco: $banco_cuba 
						<BR>Fecha: $fecha_tb 
						<BR>Referencia: $referencia_tb 
						<BR>Monto: $monto_tb 
						";
					}
					}
				}
			}
			else{

			$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba'  and referencia_tb='$numero_ref' $sql_monto  AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') ");
				if($row1=row($acceso)){
						$fecha_tb=formatofecha(trim($row1["fecha_tb"]));
						$referencia_tb=trim($row1["referencia_tb"]);
						$monto_tb=trim($row1["monto_tb"]);
						$descrip_tb=trim($row1["descrip_tb"]);
						Echo "\n<BR>REGISTROS SIMILAR:
						<BR>Banco: $banco_cuba 
						<BR>Fecha: $fecha_tb 
						<BR>Referencia: $referencia_tb 
						<BR>Monto: $monto_tb 
						";
					}
			}
	}
}
function conciliar_pago_cli($acceso,$id_pd=''){
	//return;
	
	$acceso1=conexion();
	$acceso2=conexion();
		session_start();
		$ini_u = $_SESSION["ini_u"];
		if($ini_u==''){
			$ini_u ="AA";
		}
	$login = $_SESSION["login"];
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	$palabra_clave='REC. INT. CARGO CUENTA';

	$sql_id_pd="";
	if($id_pd!=''){
		$sql_id_pd=" and id_pd='$id_pd'";
	}
	$resp=false;
	//ECHO "select  *from pagodeposito where status_pd='REGISTRADO' $sql_id_pd ";
	$acceso2->objeto->ejecutarSql("select * from pagodeposito where status_pd='REGISTRADO' $sql_id_pd");
		while($row=row($acceso2)){
			$id_pd=trim($row["id_pd"]);
			$id_tipo_pago=trim($row["id_tipo_pago"]);
			$fecha_dep=trim($row["fecha_dep"]);
			$id_cuba=trim($row["banco"]);
			$numero_ref=trim($row["numero_ref"]);
			$monto_dep=trim($row["monto_dep"])+0;
			
			$monto_dep1=$monto_dep-1;
			$monto_dep2=$monto_dep+1;
			$sql_monto=" and monto_tb>='$monto_dep1'  and monto_tb<='$monto_dep2' ";

			//echo" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb='$fecha_dep' and referencia_tb='$numero_ref' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO')";
			$acceso->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and fecha_tb='$fecha_dep' and referencia_tb='$numero_ref' $sql_monto AND (Status_tb='REGISTRADO' or Status_tb='NO RELACIONADO') ");
			if($row=row($acceso)){
					$id_tb=trim($row["id_tb"]);
					$acceso->objeto->ejecutarSql("update pagodeposito set status_pd='CONFIRMADO' ,fecha_conf='$fecha', hora_conf='$hora',login_conf='$login', id_tb='$id_tb'  where id_pd='$id_pd' ");
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='CLIENTES' where id_tb='$id_tb'");	
				$resp=true;
			}else{
				//$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='NO RELACIONADO', tipo_tb='CLIENTES' where id_tb='$id_tb'");	
			}
		}
	return $resp;
}

function identificar_pago_cli($acceso){
	
	$acceso1=conexion();
	//echo "select id_cuba,banco_cuba from cuenta_bancaria where conc_cliente='SI' and status_cuba='ACTIVO'";
	$acceso1->objeto->ejecutarSql("select id_cuba,banco_cuba from cuenta_bancaria where conc_cliente='SI' and status_cuba='ACTIVO'");
	while ($row=row($acceso1))
	{
		$id_cuba=trim($row["id_cuba"]);
		$banco_cuba=trim($row["banco_cuba"]);
		
			if($banco_cuba=='BANESCO'){
				identificar_pago_cli_banesco($acceso,$id_cuba,$abrev_cuba);
			}else if($banco_cuba=='PROVINCIAL'){
				identificar_pago_cli_provincial($acceso,$id_cuba,$abrev_cuba);
			}  else if($banco_cuba=='EXTERIOR'){
				identificar_pago_cli_exterior($acceso,$id_cuba,$abrev_cuba);
			} else if($banco_cuba=='MERCANTIL'){
				identificar_pago_cli_mercantil($acceso,$id_cuba,$abrev_cuba);
			} else if($banco_cuba=='BOD'){
				identificar_pago_cli_bod($acceso,$id_cuba,$abrev_cuba);
			} else if($banco_cuba=='FONDO COMUN'){
				identificar_pago_cli_bfc($acceso,$id_cuba,$abrev_cuba);
			}

	}
	echo "IDENTIFICACION COMPLETADA CON EXITO";
}
function identificar_pago_cli_mercantil($acceso,$id_cuba,$abrev_cuba){
	//echo "entro a mercantil";
	$acceso2=conexion();
	
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		if($ini_u==''){
			$ini_u ="AA";
		}
	$acceso->objeto->ejecutarSql("select *from pagodeposito  where (id_pd ILIKE '$ini_u%') ORDER BY id_pd desc"); 
	$id_pd = $ini_u.verCoo($acceso,"id_pd");
	$login = $_SESSION["login"]; 
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	
	$palabra_clave='DEPOSITO EN EFECTIVO';
	$palabra_clave1='DEPO-FACIL ELECTRONICO';
	//ECHO " select * from vista_tablabancos where id_cuba='$id_cuba' and descrip_tb ilike 'REC. INT. CARGO CUENTA%'";
	$acceso2->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and (descrip_tb ilike '$palabra_clave%' or descrip_tb ilike '$palabra_clave1%' )AND (Status_tb='REGISTRADO' or status_tb='NO RELACIONADO')order by id_tb ");
		while($row=row($acceso2)){
			$abrev_cuba=trim($row["abrev_cuba"]);
			$id_tb=trim($row["id_tb"]);
			//echo "<br>$abrev_cuba:";
			$fecha_tb=trim($row["fecha_tb"]);
			$referencia_tb=trim($row["referencia_tb"]);
			$monto_tb=trim($row["monto_tb"]);
			$descrip_tb=trim($row["descrip_tb"]);
			$valor=explode($palabra_clave,$descrip_tb);
			$ini=substr($referencia_tb, 0, 3);
			$nro_contrato='00000000000000000000000000';
			//echo "<br>:$referencia_tb:";
			//if($ini=='000'){
				//$nro_contrato=	$ano=substr($referencia_tb, 3, 8);
				$nro_contrato=	$referencia_tb;
				if(strlen($nro_contrato)!=8 && strlen($nro_contrato)!=7){
					continue;
			}
			//	echo "<br>nro_contrato:$nro_contrato:";
			//}
			//echo "<br>$referencia_tb: select * from contrato where nro_contrato ilike '%$nro_contrato%' ";
			$acceso->objeto->ejecutarSql(" select * from contrato where nro_contrato ilike '%$nro_contrato%' ");
			if($row=row($acceso)){
				$id_contrato=trim($row["id_contrato"]);
				$acceso->objeto->ejecutarSql("insert into pagodeposito(id_pd,id_contrato,fecha_reg,hora_reg,login_reg,fecha_dep,banco,numero_ref,status_pd,tipo_dt,monto_dep,obser_p,id_tb,fecha_conf,hora_conf,login_conf) values 
				('$id_pd','$id_contrato','$fecha','$hora','$login','$fecha_tb','$id_cuba','$referencia_tb','CONFIRMADO','DEPOSITO','$monto_tb','$descrip_tb','$id_tb','$fecha','$hora','$login')");	
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='CLIENTES' where id_tb='$id_tb'");	
				$id_pd=$ini_u.verCoo_inc($acceso,$id_pd);
				
			}else{
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='NO RELACIONADO', tipo_tb='CLIENTES' where id_tb='$id_tb'");	
			}
		}
	return $cad;	
}

function identificar_pago_cli_bfc($acceso,$id_cuba,$abrev_cuba){
	
	$acceso2=conexion();
	
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		if($ini_u==''){
			$ini_u ="AA";
		}
	$acceso->objeto->ejecutarSql("select *from pagodeposito  where (id_pd ILIKE '$ini_u%') ORDER BY id_pd desc"); 
	$id_pd = $ini_u.verCoo($acceso,"id_pd");
	$login = $_SESSION["login"]; 
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	
	$palabra_clave='';
	//ECHO " select * from vista_tablabancos where id_cuba='$id_cuba' and descrip_tb ilike 'REC. INT. CARGO CUENTA%'";
	$acceso2->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' AND (Status_tb='REGISTRADO' or status_tb='NO RELACIONADO')");
		while($row=row($acceso2)){
			$id_tb=trim($row["id_tb"]);
			$fecha_tb=trim($row["fecha_tb"]);
			$referencia_tb=trim($row["referencia_tb"]);
			$monto_tb=trim($row["monto_tb"]);
			$descrip_tb=trim($row["descrip_tb"]);
			$nro_contrato=trim($row["referencia_tb"])+0;
			$cont=$nro_contrato;

			if($cont<10)
				$nro_contrato="0".$nro_contrato;
			if($cont<100)
				$nro_contrato="0".$nro_contrato;	
			if($cont<1000)
				$nro_contrato="0".$nro_contrato;
			if($cont<10000)
				$nro_contrato="0".$nro_contrato;
			if($cont<100000)
				$nro_contrato="0".$nro_contrato;
			if($cont<1000000)
				$nro_contrato="0".$nro_contrato;
			if($cont<10000000)
				$nro_contrato="0".$nro_contrato;

			//echo "<br>:$cont:$nro_contrato:";
			//ECHO "<BR>:$nro_contrato";
			if(strlen($nro_contrato)!=8){
					continue;
			}
				
		//$valor=explode($palabra_clave,$descrip_tb);
			//$nro_contrato=$referencia_tb;
		//	echo " select * from contrato where nro_contrato ilike '%$nro_contrato%' ;";
			$acceso->objeto->ejecutarSql(" select * from contrato where nro_contrato ilike '%$nro_contrato%' ");
			if($row=row($acceso)){
				$id_contrato=trim($row["id_contrato"]);
				$acceso->objeto->ejecutarSql("insert into pagodeposito(id_pd,id_contrato,fecha_reg,hora_reg,login_reg,fecha_dep,banco,numero_ref,status_pd,tipo_dt,monto_dep,obser_p,id_tb,fecha_conf,hora_conf,login_conf) values 
				('$id_pd','$id_contrato','$fecha','$hora','$login','$fecha_tb','$id_cuba','$referencia_tb','CONFIRMADO','DEPOSITO','$monto_tb','$descrip_tb','$id_tb','$fecha','$hora','$login')");	
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='CLIENTES' where id_tb='$id_tb'");	
				$id_pd=$ini_u.verCoo_inc($acceso,$id_pd);
			}else{
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='NO RELACIONADO', tipo_tb='CLIENTES' where id_tb='$id_tb'");
			}
			
		//echo "\n nro_contrato:$nro_contrato \n id_contrato:$id_contrato";
		}
	return $cad;	
}

function identificar_pago_cli_bod($acceso,$id_cuba,$abrev_cuba){
	
	$acceso2=conexion();
	
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		if($ini_u==''){
			$ini_u ="AA";
		}
	$acceso->objeto->ejecutarSql("select *from pagodeposito  where (id_pd ILIKE '$ini_u%') ORDER BY id_pd desc"); 
	$id_pd = $ini_u.verCoo($acceso,"id_pd");
	$login = $_SESSION["login"]; 
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	
	$palabra_clave='';
	//ECHO " select * from vista_tablabancos where id_cuba='$id_cuba' and descrip_tb ilike 'REC. INT. CARGO CUENTA%'";
	$acceso2->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' AND (Status_tb='REGISTRADO' or status_tb='NO RELACIONADO')");
		while($row=row($acceso2)){
			$id_tb=trim($row["id_tb"]);
			$fecha_tb=trim($row["fecha_tb"]);
			$referencia_tb=trim($row["referencia_tb"]);
			$monto_tb=trim($row["monto_tb"]);
			$descrip_tb=trim($row["descrip_tb"]);
			$nro_contrato=substr($descrip_tb, -8, 8);
			//ECHO "<BR>:$nro_contrato";
			if(strlen($nro_contrato)!=8){
					continue;
			}
				
		//$valor=explode($palabra_clave,$descrip_tb);
			//$nro_contrato=$referencia_tb;
		//	echo " select * from contrato where nro_contrato ilike '%$nro_contrato%' ;";
			$acceso->objeto->ejecutarSql(" select * from contrato where nro_contrato ilike '%$nro_contrato%' ");
			if($row=row($acceso)){
				$id_contrato=trim($row["id_contrato"]);
				$acceso->objeto->ejecutarSql("insert into pagodeposito(id_pd,id_contrato,fecha_reg,hora_reg,login_reg,fecha_dep,banco,numero_ref,status_pd,tipo_dt,monto_dep,obser_p,id_tb,fecha_conf,hora_conf,login_conf) values 
				('$id_pd','$id_contrato','$fecha','$hora','$login','$fecha_tb','$id_cuba','$referencia_tb','CONFIRMADO','DEPOSITO','$monto_tb','$descrip_tb','$id_tb','$fecha','$hora','$login')");	
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='CLIENTES' where id_tb='$id_tb'");	
				$id_pd=$ini_u.verCoo_inc($acceso,$id_pd);
			}else{
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='NO RELACIONADO', tipo_tb='CLIENTES' where id_tb='$id_tb'");	
			}
			
		//echo "\n nro_contrato:$nro_contrato \n id_contrato:$id_contrato";
		}
	return $cad;	
}
function identificar_pago_cli_exterior($acceso,$id_cuba,$abrev_cuba){
	
	$acceso2=conexion();
	
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		if($ini_u==''){
			$ini_u ="AA";
		}
	$acceso->objeto->ejecutarSql("select *from pagodeposito  where (id_pd ILIKE '$ini_u%') ORDER BY id_pd desc"); 
	$id_pd = $ini_u.verCoo($acceso,"id_pd");
	$login = $_SESSION["login"]; 
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	
	$palabra_clave='DP DEP.CTA.CTE.';
	//ECHO " select * from vista_tablabancos where id_cuba='$id_cuba' and descrip_tb ilike 'REC. INT. CARGO CUENTA%'";
	$acceso2->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and descrip_tb ilike '$palabra_clave%' AND (Status_tb='REGISTRADO' or status_tb='NO RELACIONADO')");
		while($row=row($acceso2)){
			$id_tb=trim($row["id_tb"]);
			$fecha_tb=trim($row["fecha_tb"]);
			$referencia_tb=trim($row["referencia_tb"]);
			$monto_tb=trim($row["monto_tb"]);
			$descrip_tb=trim($row["descrip_tb"]);
			$valor=explode($palabra_clave,$descrip_tb);
			$nro_contrato=$referencia_tb;
			if(strlen($nro_contrato)!=8 && strlen($nro_contrato)!=7){
					continue;
			}
			$acceso->objeto->ejecutarSql(" select * from contrato where nro_contrato ilike '%$nro_contrato%' ");
			if($row=row($acceso)){
				$id_contrato=trim($row["id_contrato"]);
				$acceso->objeto->ejecutarSql("insert into pagodeposito(id_pd,id_contrato,fecha_reg,hora_reg,login_reg,fecha_dep,banco,numero_ref,status_pd,tipo_dt,monto_dep,obser_p,id_tb,fecha_conf,hora_conf,login_conf) values 
				('$id_pd','$id_contrato','$fecha','$hora','$login','$fecha_tb','$id_cuba','$referencia_tb','CONFIRMADO','DEPOSITO','$monto_tb','$descrip_tb','$id_tb','$fecha','$hora','$login')");	
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='CLIENTES' where id_tb='$id_tb'");	
				$id_pd=$ini_u.verCoo_inc($acceso,$id_pd);
			}else{
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='NO RELACIONADO', tipo_tb='CLIENTES' where id_tb='$id_tb'");	
			}
			
		//echo "\n nro_contrato:$nro_contrato \n id_contrato:$id_contrato";
		}
	return $cad;	
}
function identificar_pago_cli_provincial($acceso,$id_cuba,$abrev_cuba){
	
	$acceso2=conexion();
	
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		if($ini_u==''){
			$ini_u ="AA";
		}
	$acceso->objeto->ejecutarSql("select *from pagodeposito  where (id_pd ILIKE '$ini_u%') ORDER BY id_pd desc"); 
	$id_pd = $ini_u.verCoo($acceso,"id_pd");
	$login = $_SESSION["login"];
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	
	$palabra_clave='SRV.';
	//ECHO " select * from vista_tablabancos where id_cuba='$id_cuba' and descrip_tb ilike 'REC. INT. CARGO CUENTA%'";
	$acceso2->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and descrip_tb ilike '$palabra_clave%' AND (Status_tb='REGISTRADO' or status_tb='NO RELACIONADO')");
		while($row=row($acceso2)){
			$id_tb=trim($row["id_tb"]);
			$fecha_tb=trim($row["fecha_tb"]);
			$referencia_tb=trim($row["referencia_tb"]);
			$monto_tb=trim($row["monto_tb"]);
			$descrip_tb=trim($row["descrip_tb"]);
			$valor=explode($palabra_clave,$descrip_tb);
			$valor=explode("V",trim($valor[1]));
			$nro_contrato=trim($valor[0]);
			$valor=explode("E",$nro_contrato);
			$nro_contrato=trim($valor[0]);
			if(strlen($nro_contrato)!=8){
					continue;
			}
			//echo "<br>:$nro_contrato:";
			$acceso->objeto->ejecutarSql(" select * from contrato where nro_contrato ilike '%$nro_contrato%' ");
			if($row=row($acceso)){
				$id_contrato=trim($row["id_contrato"]);
			//	echo "<br>:$entro:";
				$acceso->objeto->ejecutarSql("insert into pagodeposito(id_pd,id_contrato,fecha_reg,hora_reg,login_reg,fecha_dep,banco,numero_ref,status_pd,tipo_dt,monto_dep,obser_p,id_tb,fecha_conf,hora_conf,login_conf) values 
				('$id_pd','$id_contrato','$fecha','$hora','$login','$fecha_tb','$id_cuba','$referencia_tb','CONFIRMADO','DEPOSITO','$monto_tb','$descrip_tb','$id_tb','$fecha','$hora','$login')");	
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='CLIENTES' where id_tb='$id_tb'");	
				$id_pd=$ini_u.verCoo_inc($acceso,$id_pd);
			}else{
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='NO RELACIONADO', tipo_tb='CLIENTES' where id_tb='$id_tb'");	
			}
		//echo "\n nro_contrato:$nro_contrato \n id_contrato:$id_contrato";
		}
	return $cad;	
}
function identificar_pago_cli_banesco($acceso,$id_cuba,$abrev_cuba){
	
	$acceso2=conexion();
	
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		if($ini_u==''){
			$ini_u ="AA";
		}
	$acceso->objeto->ejecutarSql("select *from pagodeposito  where (id_pd ILIKE '$ini_u%') ORDER BY id_pd desc"); 
	$id_pd = $ini_u.verCoo($acceso,"id_pd");
	$login = $_SESSION["login"]; 
	$fecha= date("Y-m-d");
	$hora= date("H:i:s");
	$palabra_clave='REC. INT. CARGO CUENTA';	
	//ECHO " select * from vista_tablabancos where id_cuba='$id_cuba' and descrip_tb ilike '$palabra_clave%' AND Status_tb='REGISTRADO'";
	$acceso2->objeto->ejecutarSql(" select * from vista_tablabancos where id_cuba='$id_cuba' and descrip_tb ilike '$palabra_clave%' AND (Status_tb='REGISTRADO' or status_tb='NO RELACIONADO')");
		while($row=row($acceso2)){
			$id_tb=trim($row["id_tb"]);
			$fecha_tb=trim($row["fecha_tb"]);
			$referencia_tb=trim($row["referencia_tb"]);
			$monto_tb=trim($row["monto_tb"]);
			$descrip_tb=trim($row["descrip_tb"]);
			$valor=explode("$palabra_clave",$descrip_tb);
			$nro_contrato=trim($valor[1]);
		//	ECHO "<BR>:$nro_contrato:";
			if(strlen($nro_contrato)!=8){
					continue;
			}
		//	ECHO ":PASO:";
			$acceso->objeto->ejecutarSql(" select * from contrato where nro_contrato ilike '%$nro_contrato%' ");
			if($row=row($acceso)){
				$id_contrato=trim($row["id_contrato"]);
			//	ECHO ":$id_contrato:";
				$acceso->objeto->ejecutarSql("insert into pagodeposito(id_pd,id_contrato,fecha_reg,hora_reg,login_reg,fecha_dep,banco,numero_ref,status_pd,tipo_dt,monto_dep,obser_p,id_tb,fecha_conf,hora_conf,login_conf) values 
				('$id_pd','$id_contrato','$fecha','$hora','$login','$fecha_tb','$id_cuba','$referencia_tb','CONFIRMADO','DEPOSITO','$monto_tb','$descrip_tb','$id_tb','$fecha','$hora','$login')");	
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='CONCILIADO' , tipo_tb='CLIENTES' where id_tb='$id_tb'");	
				$id_pd=$ini_u.verCoo_inc($acceso,$id_pd);
			}else{
				$acceso->objeto->ejecutarSql("update tabla_bancos set status_tb='NO RELACIONADO', tipo_tb='CLIENTES' where id_tb='$id_tb'");	
			}
			
		//echo "\n nro_contrato:$nro_contrato \n id_contrato:$id_contrato";
		}
	return $cad;	
}

function trae_mes_num($me){
	$mes=array("ENE"=>"01","FEB"=>"02","MAR"=>"03","ABR"=>"04","MAY"=>"05","JUN"=>"06","JUL"=>"07","AGO"=>"08","SEP"=>"09","OCT"=>"10","NOV"=>"11","DIC"=>"12");
	return strtoupper($mes[$me]);
}

///////////////////////////////////////////////////CONCILIACION BANCARIA///////////////////////////////////////////////
///////////////////////////////////////////////////CONCILIACION BANCARIA///////////////////////////////////////////////
///////////////////////////////////////////////////CONCILIACION BANCARIA///////////////////////////////////////////////


/*VERIFICAR SI LA CAJA VIRTUAL ESTA ABIERTA SI ABRIRLA Y DEVOLVER EL ID_CAJA_COB*/
function verifica_caja_virtual($acceso,$id_pd=''){
	$ini_u = 'AA';
	$fecha= date("Y-m-d");
	$id_caja='BB001';
	$id_persona='BB00000001';
	$id_est='BB001';
	$apertura_caja=date("H:i:s");
	$status_caja='ABIRTA';
	$acceso->objeto->ejecutarSql(" select id_caja_cob from caja_cobrador where fecha_caja='$fecha' and id_caja='$id_caja' and id_persona='$id_persona' and id_est='$id_est'");
	if($row=row($acceso)){
		$id_caja_cob=trim($row["id_caja_cob"]);
	}else{
		$acceso->objeto->ejecutarSql("select * from caja_cobrador  where (id_caja_cob ILIKE '$ini_u%') ORDER BY id_caja_cob desc"); 
		$id_caja_cob = $ini_u.verCodLong($acceso,"id_caja_cob");

		$acceso->objeto->ejecutarSql("insert into caja_cobrador(id_caja_cob,id_caja,id_persona,fecha_caja,apertura_caja,status_caja,id_est,fecha_sugerida) values ('$id_caja_cob','$id_caja','$id_persona','$fecha','$apertura_caja','$status_caja','$id_est','$fecha')");
		$acceso->objeto->ejecutarSql("Update caja Set status_caja='Abierta' Where id_caja='$id_caja'");
	}
	return $id_caja_cob;
}
/*para registrar los pagos virtuales*/
function registrar_pago_virtual($acceso)
{
	$acceso1=conexion();
	$ini_u = 'AA';
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and  pagos.id_caja_cob=caja_cobrador.id_caja_cob and tipo_doc='PAGO' ORDER BY nro_factura desc LIMIT 1 offset 0 ");
	$nro_factura = verNumero_factura_v4($acceso,"nro_factura",8);
	$id_caja_cob=verifica_caja_virtual($acceso);
	$acceso->objeto->ejecutarSql("select id_tp from detalle_tipopago_temp  where (id_tp ILIKE '$ini_u%')  ORDER BY id_tp desc LIMIT 1 offset 0 "); 
	$id_tp= $ini_u.verCoo($acceso,"id_tp");

	$fecha_proc= date("Y-m-d");

  require_once "Clases/pagos.php";
  $dat = array();
  $detalle_tipopago = array();
  $pago_factura = array();

  $sql_id_pd="";
	if($id_pd!=''){
		$sql_id_pd=" and id_pd='$id_pd'";
	}

  $acceso1->objeto->ejecutarSql(" select * from pagodeposito where status_pd='CONFIRMADO' $sql_id_pd ;");
  while($row=row($acceso1)){
	$id_pd=trim($row["id_pd"]);
	//echo "<br>id_pd:$id_pd";
	$monto_pago=trim($row["monto_dep"]);
	$monto_tp=trim($row["monto_dep"]);
	$id_banco=trim($row["banco"]);
	$numero_ref=trim($row["numero_ref"]);
	$id_contrato=trim($row["id_contrato"]);

	$detalle_tipopago[0]['id_pago']=$id_pago;
	$detalle_tipopago[0]['id_tipo_pago']="TPA00003";
	$detalle_tipopago[0]['monto_tp']=$monto_tp;
	$detalle_tipopago[0]['id_banco']=$id_banco;
	$detalle_tipopago[0]['refer_tp']=$numero_ref;
	$detalle_tipopago[0]['lote_tp']=$id_pd;

	$dat['id_pago']=$id_pago;
	$dat['id_caja_cob']=$id_caja_cob;
	$dat['monto_pago']=$monto_pago;
	$dat['obser_pago']="pago en lotes";
	$dat['status_pago']="PAGADO";
	$dat['nro_factura']=$nro_factura;
	$dat['id_contrato']=$id_contrato;
	$dat['nro_control']='';
	$dat['desc_pago']=0;
	$dat['por_iva']=12;
	$dat['n_credito']='';
	$dat['impresion']='SI';
	$dat['detalle_tipopago']=$detalle_tipopago;
	
	$id_select = ajusta_cargo_pago_factura($acceso,$id_contrato,$monto_pago);
	$cargo=explode("=@",$id_select);
	$indice=0;

	for($j=1;$j<count($cargo);$j++)
	{
		$id_cont_serv=$cargo[$j];
		$pago_factura[$indice]['id_pago']=$id_pago;
		$pago_factura[$indice]['id_cont_serv']=$id_cont_serv;
		$indice++;
	}
	$dat['pago_factura']=$pago_factura;

	//echo "<br>id_pago:$id_pago";

	$obj_pago=new pagos($dat);
	$obj_pago->incluir($acceso);

	$id_pago=$ini_u.verCodLargoInc($acceso,$id_pago);
	$id_tp=$ini_u.verCoo_inc($acceso,$id_tp);
	$nro_factura = verNumero_factura_v4Inc($acceso,$nro_factura,8);
//ECHO "<br>Update pagodeposito Set  fecha_proc='$fecha_proc', status_pd='PROCESADO' Where id_pd='$id_pd'";
	$acceso->objeto->ejecutarSql("Update pagodeposito Set  fecha_proc='$fecha_proc', status_pd='PROCESADO' Where id_pd='$id_pd'");
  }//if  pagodeposito
}

function actualizar_datos_oficina_virtual($acceso,$cable,$id_contrato='')
{
	$sql_id_contrato="";
	if($id_contrato!=''){
		$sql_id_contrato=" where id_contrato='$id_contrato'";
	}
	$dato=lectura($acceso,"select * from vista_contrato_auditoria $sql_id_contrato limit 1 offset 0");
		
		for($i=0;$i<count($dato);$i++){
		
		
			$id_contrato=trim($dato[$i]['id_contrato']);
			$cedula=trim($dato[$i]['cedula']);
			$nombre=trim($dato[$i]['nombre']);
			$apellido=trim($dato[$i]['apellido']);
			$telefono=trim($dato[$i]['telefono']);
			$telf_casa=trim($dato[$i]['telf_casa']);
			$email=trim($dato[$i]['email']);

				$nro_contrato=trim($dato[$i]['nro_contrato']);
				$status_contrato=trim($dato[$i]['status_contrato']);
				$direc_adicional=trim($dato[$i]['direc_adicional']);
				$numero_casa=trim($dato[$i]['numero_casa']);
				$nombre_franq=trim($dato[$i]['nombre_franq']);
				$nombre_zona=trim($dato[$i]['nombre_zona']);
				$saldo=trim($dato[$i]['saldo'])+0;
				//echo "<br>insert into cliente(id_contrato,cedula,nombre,apellido,telefono,nro_contrato,status_contrato,saldo,nombre_zona,nombre_franq) values ('$id_contrato','$cedula','$nombre','$apellido','$telefono','$nro_contrato','$status_contrato','$saldo','$nombre_zona','$nombre_franq');";
			$cable->objeto->ejecutarSql("select id_contrato from cliente where id_contrato='$id_contrato'");
			if(!$row=row($cable)){
		
				if(!$cable->objeto->ejecutarSql("insert into cliente(id_contrato,cedula,nombre,apellido,telefono,nro_contrato,status_contrato,saldo,nombre_zona,nombre_franq) values ('$id_contrato','$cedula','$nombre','$apellido','$telefono','$nro_contrato','$status_contrato','$saldo','$nombre_zona','$nombre_franq')")){

					echo "<br>insert into cliente(id_contrato,cedula,nombre,apellido,telefono,nro_contrato,status_contrato,saldo,nombre_zona,nombre_franq) values ('$id_contrato','$cedula','$nombre','$apellido','$telefono','$nro_contrato','$status_contrato','$saldo','$nombre_zona','$nombre_franq')<br>".$cable->objeto->error().'<br>';
				}
			}
			else{
				if(!$cable->objeto->ejecutarSql("update cliente set cedula='$cedula',nombre='$nombre',apellido='$apellido',telefono='$telefono',nro_contrato='$nro_contrato',status_contrato='$status_contrato',saldo='$saldo',nombre_zona='$nombre_zona',nombre_franq='$nombre_franq' where id_contrato='$id_contrato' ")){

					echo "<br>update cliente set cedula='$cedula',nombre='$nombre',apellido='$apellido',telefono='$telefono',nro_contrato='$nro_contrato',status_contrato='$status_contrato',saldo='$saldo',nombre_zona='$nombre_zona',nombre_franq='$nombre_franq' where id_contrato='$id_contrato'<br>".$cable->objeto->error().'<br>';
				}
			}
				$cable->objeto->ejecutarSql("delete from  contrato_servicio_deuda;");
				$cable->objeto->ejecutarSql("delete from  estado_cuenta;");
				//echo "select * from pagos where id_contrato='$id_contrato'";
					$pagos=lectura($acceso,"select * from pagos where id_contrato='$id_contrato'");
					for($k=0;$k<count($pagos);$k++){
						$id_pago=trim($pagos[$k]['id_pago']);
						$fecha_pago=trim($pagos[$k]['fecha_pago']);
						$monto_pago=trim($pagos[$k]['monto_pago']);
						$obser_pago=trim($pagos[$k]['obser_pago']);
						$status_pago=trim($pagos[$k]['status_pago']);
						$nro_factura=trim($pagos[$k]['nro_factura']);
						$id_contrato=trim($pagos[$k]['id_contrato']);
						$fecha_factura=trim($pagos[$k]['fecha_factura']);
						$tipo_doc=trim($pagos[$k]['tipo_doc']);
						$inc=trim($pagos[$k]['inc']);
						
						if(!$cable->objeto->ejecutarSql("insert into estado_cuenta(id_pago,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,fecha_factura,tipo_doc,inc,tipo) values ('$id_pago','$fecha_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$fecha_factura','$tipo_doc','$inc','REAL')")){
							echo "<br>insert into estado_cuenta(id_pago,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,fecha_factura,tipo_doc,inc,tipo) values ('$id_pago','$fecha_pago','$monto_pago','$obser_pago','$status_pago','$nro_factura','$id_contrato','$fecha_factura','$tipo_doc','$inc','REAL')";
							echo '<br>'.$cable->objeto->error().'<br>';
						}
					}

					$cable->objeto->ejecutarSql("select update_saldo(id_contrato) from cliente where id_contrato='$id_contrato';");
					
					$pagos=lectura($acceso,"select * from vista_contrato_servicio_deuda,servicios where vista_contrato_servicio_deuda.id_serv=servicios.id_serv and id_contrato='$id_contrato';");
					for($k=0;$k<count($pagos);$k++){
						$id_cont_serv=trim($pagos[$k]['id_cont_serv']);
						$id_serv=trim($pagos[$k]['id_serv']);
						$fecha_inst=trim($pagos[$k]['fecha_inst']);
						$cant_serv=trim($pagos[$k]['cant_serv']);
						$status_con_ser=trim($pagos[$k]['status_con_ser']);
						$costo_cobro=trim($pagos[$k]['costo_cobro']);
						$descu=trim($pagos[$k]['descu']);
						$apagar=trim($pagos[$k]['apagar']);
						$id_pago=trim($pagos[$k]['id_pago']);
						$pagado=trim($pagos[$k]['pagado']);
						$inc=trim($pagos[$k]['inc']);
						$nombre_servicio=trim($pagos[$k]['nombre_servicio']);
						
						if(!$cable->objeto->ejecutarSql("insert into contrato_servicio_deuda
							(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago,pagado,apagar,inc,nombre_servicio) values 
							('$id_cont_serv','$id_serv','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','$descu','$id_pago','$pagado','$apagar','$inc','$nombre_servicio')")){
							echo "<br>insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago,pagado,apagar,inc,nombre_servicio) values ('$id_cont_serv','$id_serv','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','$descu','$id_pago','$pagado','$apagar','$inc','$nombre_servicio')";
							echo '<br>'.$cable->objeto->error().'<br>';
						}
					}
		} //from contrato
}//function

function valida_fact_c($acceso,$dat){ // arreglo de parametros recibidos
	$desde = $dat['desde'];
	$hasta = $dat['hasta'];
	$cantidad = $dat['cantidad'];

	$acceso->objeto->ejecutarSql("select *from parametros where id_param='36' and id_franq='1'");
	$row=row($acceso);
	$dig_cont_fisico_G=trim($row['valor_param']);
			
	$cad='';
	$nro_factura=$desde;
	for($i=0;$i<$cantidad;$i++){
		$acceso->objeto->ejecutarSql("select *from recibos where nro_recibo='$nro_factura' and tipo='CONTRATO'");
		if($row=row($acceso)){
			$cad=$cad."$nro_factura; ";
		}
		$nro_factura=$serie.verNumero_recibo_v4($acceso,$nro_factura,$dig_cont_fisico_G);
	}
	// Retorno de variables hacia js
	$dato['recibos']=$cad;	
	return $dato;
	
}

function cargar_cob_ven($acceso,$dat){
	$tipo = $dat['tipo'];
	if($tipo=="FACTURA"){
		return verCobradores($acceso);//linea 905
	}else{
		return verVendedores($acceso);
	}
}
function verBancosMat($acceso){
    $cad='<option value="0">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from banco order By banco");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_banco"]).'">'.trim($row["banco"]).'</option>';
    }
    return $cad;   
}

/**Nuevo desarrollo de Materiales**/
function id_unico(){
	//echo "<br>:".uniqid();
	//echo "<br>:".strtoupper(uniqid('',true));
	//echo "<br>:".strtoupper(uniqid('',true));
	$cad=strtoupper(uniqid('',true));
	$cad=str_replace(".", "",$cad);
	$cad=substr($cad, 0,20);
	return $cad;
}
function verTipoEntidad($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from tipo_entidad  where status_te='ACTIVO'  order By nombre_te");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_te"]).'">'.trim($row["nombre_te"]).'</option>';
    }
    return $cad;   
}
function verTipoResponsable($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from tipo_responsable where status_tipo_res = 'ACTIVO' and id_estatus_reg = 1 order By nombre_tipo_res");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_tipo_res"]).'">'.trim($row["nombre_tipo_res"]).'</option>';
    }
    return $cad;   
}
function verTipoMovimiento($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from tipo_movimiento where status_tipo_mov <> 'INACTIVO' and id_estatus_reg = 1 order By nombre_tipo_mov");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_tipo_mov"]).'">'.trim($row["nombre_tipo_mov"]).'</option>';
    }
    return $cad;   
}
function verGrupoTecTrabajo($acceso){
	session_start();

	$id_f = $_SESSION["id_franq"]; 
	if($id_f!='0'){
		$consult=" and  id_franq='$id_f'";
	}
	
	$cad=opcion('',_("Seleccione..."));
	$acceso->objeto->ejecutarSql("select id_gt, nombre_grupo from grupo_trabajo where status_grupo='ACTIVO' order By nombre_grupo");
	while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_gt"]),trim($row["nombre_grupo"]));
	}
	return $cad;	
}
function verEncargadoAlmacen($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from vista_encargado where status_enc = 'ACTIVO' and id_estatus_reg = 1 order by nombre");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_enc"]).'">'.trim($row["nombre"]).' '.trim($row["apellido"]).'</option>';
    }
    return $cad;   
}
function verFamiliaMaterial($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from familia where status_fam = 'ACTIVO' and id_estatus_reg = 1 order by nombre_fam");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_fam"]).'">'.trim($row["nombre_fam"]).'</option>';
    }
    return $cad;   
}
function verUnidadMaterial($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from unidad_medida where status_uni = 'ACTIVO' and id_estatus_reg = 1 order by nombre_uni");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_uni"]).'">'.trim($row["nombre_uni"]).'</option>';
    }
    return $cad;   
}
function verAlmacenStock($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from almacen where status_alm = 'ACTIVO' and id_estatus_reg = 1 order by nombre_alm");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_alm"]).'">'.trim($row["nombre_alm"]).'</option>';
    }
    return $cad;   
}
function verMaterialStock($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from vista_material where id_estatus_reg = 1 order by nombre_mat");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_mat"]).'">'.trim($row["nombre_mat"]).' (CODIGO: '.trim($row["codigo_mat"]).')</option>';
    }
    return $cad;   
}
function verMotivoMovimiento($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from vista_motivo_movimiento where status_mot_mov <> 'INACTIVO' AND status_mot_mov <> 'SISTEMA' AND id_estatus_reg = 1 order By nombre_tipo_mov,nombre_mot_mov");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_mot_mov"]).'">'.trim($row["nombre_mot_mov"]).' - '.trim($row["nombre_tipo_mov"]).'</option>';
    }
    return $cad;   
}
function verResponsableMovimiento($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from vista_responsable where status_res = 'ACTIVO' AND id_estatus_reg = 1 order by nombre");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_res"]).'">'.trim($row["nombre"]).' '.trim($row["apellido"]).'</option>';
    }
    return $cad;   
}
function verMotivoMovimientoStock($acceso,$idDep){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from vista_motivo_movimiento where id_tipo_mov ='$idDep' AND status_mot_mov <> 'INACTIVO' AND status_mot_mov <> 'SISTEMA' AND id_estatus_reg = 1 order By nombre_tipo_mov,nombre_mot_mov");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_mot_mov"]).'">'.trim($row["nombre_mot_mov"]).'</option>';
    }
    return $cad;   
}
function verMotivoInventario($acceso){
    $cad='<option value="">Seleccione...</option>';
    $acceso->objeto->ejecutarSql("select * from motivo_inventario where status_mot_inv <> 'INACTIVO' and id_estatus_reg = 1 order by nombre_mot_inv");
    while ($row=row($acceso))
    {
        $cad=$cad.'<option value="'.trim($row["id_mot_inv"]).'">'.trim($row["nombre_mot_inv"]).'</option>';
    }
    return $cad;   
}

?>