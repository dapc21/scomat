
function getdatos1(){
	exec('ipconfig/all > mac.txt');
	$fp = fopen("mac.txt","r");		
	$ubi=false;
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'Adaptador Ethernet Conexión de área local') || strstr($linea,'Ethernet adapter Local Area Connection:')){
			$ubi=true;
		}
		if($ubi==true){
			if(strstr($linea,'Descripción') || strstr($linea,'Description')){
				$valor=explode(":",$linea);
				$nom_mac=trim($valor[1]);
			}
			if(strstr($linea,'Dirección física') || strstr($linea,'Physical Address')){
				$valor=explode(":",$linea);
				$mac=trim($valor[1]);
				break;
			}
		}
	}
	fclose ($fp);
	unlink('mac.txt');
	$nom_server=$_SERVER["SERVER_NAME"];
	$ip=$_SERVER["SERVER_ADDR"];
	$valor=explode(".",$ip);
	
	$ip_server=$valor[0].".".$valor[1].".".$valor[2].".";
	return array($nom_mac,$mac,$nom_server,$ip_server);
}

	
	function zend_encoder($string){
		global $key; 
		$enc = "";
		global $iv; 
		$enc=@mcrypt_cbc (MCRYPT_TripleDES, $key, $string, MCRYPT_ENCRYPT); 
		return base64_encode($enc); 
		
	}
	$key=$_SESSION["mensualidad"];
	function zend_enc($string,$acceso){
		$id_seg=strtoupper(md5('1'));
		$acceso->objeto->ejecutarSql("select firma_seg from contrato_ser where id_seg='$id_seg'");	
		$row=$acceso->objeto->devolverRegistro();	
		$key=trim($row['firma_seg']);
		$enc=@mcrypt_cbc (MCRYPT_TripleDES, $key, $string, MCRYPT_ENCRYPT); 
		return base64_encode($enc); 
	}
	function zend_dec($string,$acceso){
		$id_seg=strtoupper(md5('1'));
		$acceso->objeto->ejecutarSql("select firma_seg from contrato_ser where id_seg='$id_seg'");	
		$row=$acceso->objeto->devolverRegistro();	
		$key=trim($row['firma_seg']);
		$string = trim(base64_decode($string));  
		$dec = @mcrypt_cbc (MCRYPT_TripleDES, $key, $string, MCRYPT_DECRYPT); 
				return trim($dec); 
	}
	
	function nivel1(){
		$refer=$_SERVER["HTTP_REFERER"];
		nivel2();
		if(strstr($refer,'http://server/SAECO/index.html')){
			if(nivel2()){			
				return true;
			}
			else{
				return false;
			}
		}
		return false;
	}
	function nivel2(){
		$ruta=$_SERVER["SCRIPT_FILENAME"];
		$fp = fopen($ruta,"r");		
		$ubi=false;
		while ($linea= fgets($fp))
		{
			if(strstr($linea,'echo') || strstr($linea,'print')){
				return false;
			}
		}
		fclose ($fp);
		return true;
	}
	function traerContrato_ser($acceso,$acceso1){
		$id_seg=strtoupper(md5('1'));
			$acceso->objeto->ejecutarSql1("select llave_dec,limite_reg, licencia_seg, fecha_lic, hora_lic, empresa_aut, version_sis, acerca_de, status_seg  from contrato_ser where llave_dec!=''");	
		if($row=$acceso->objeto->devolverRegistro()){	
			$num = count($row);
			for($i=0;$i<$num;$i++){
				echo '=@'.zend_dec(trim($row[$i]),$acceso1);
			}
		}
		else{
			echo "false";
		}
	}
	function verificamen($acceso){
		$datos=getdatos1();
		$campo = md5($datos[0].$datos[1].$datos[2].$datos[3]);
		$id_seg=strtoupper(md5('1'));
		$_SESSION["mensualidad"]=$campo;
	
	}
	
	
	function zend_decoder($string){
		if(nivel1()){
		global $key; 
		echo "$key";
		global $iv; 
		$string = trim(base64_decode($string));  
		$dec = @mcrypt_cbc (MCRYPT_TripleDES, $key, $string, MCRYPT_DECRYPT); 
				return trim($dec); 
		}
		else{
			echo "Acceso no autorizado a estos datos. (CEDESOFT BOLIVAR. 0424-8106551 / 0293-4177351 E-mail: saeco.ve@gmail.com)";
		}
	}
