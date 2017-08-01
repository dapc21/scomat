<?php
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
class contrato_ser
{
	private $id_seg;
	private $firma_seg;
	private $llave_enc;
	private $llave_dec;
	private $licencia_seg;
	private $limite_reg;
	private $fecha_lic;
	private $hora_lic;
	private $empresa_aut;
	private $version_sis;
	private $acerca_de;
	private $status_seg;
	private $campo_seg1;
	private $campo_seg2;
	private $campo_seg3;
	private $campo_seg4;
	private $campo_seg5;
	private $campo_seg6;
	private $campo_seg7;
	private $dato;

	function __construct($id_seg,$firma_seg,$llave_enc,$llave_dec,$licencia_seg,$limite_reg,$fecha_lic,$hora_lic,$empresa_aut,$version_sis,$acerca_de,$status_seg,$campo_seg1,$campo_seg2,$campo_seg3,$campo_seg4,$campo_seg5,$campo_seg6,$campo_seg7,$dato)
	{
		$this->id_seg = strtoupper($id_seg);
		$this->firma_seg = $firma_seg;
		$this->llave_enc = $llave_enc;
		$this->llave_dec = $llave_dec;
		$this->licencia_seg = $licencia_seg;
		$this->limite_reg = $limite_reg;
		$this->fecha_lic = $fecha_lic;
		$this->hora_lic = $hora_lic;
		$this->empresa_aut = $empresa_aut;
		$this->version_sis = $version_sis;
		$this->acerca_de = $acerca_de;
		$this->status_seg = $status_seg;
		$this->campo_seg1 = $campo_seg1;
		$this->campo_seg2 = $campo_seg2;
		$this->campo_seg3 = $campo_seg3;
		$this->campo_seg4 = $campo_seg4;
		$this->campo_seg5 = $campo_seg5;
		$this->campo_seg6 = $campo_seg6;
		$this->campo_seg7 = $campo_seg7;
		$this->dato = $dato;
	}
	public function verid_seg(){
		return $this->id_seg;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vercampo_seg7(){
		return $this->campo_seg7;
	}
	public function vercampo_seg6(){
		return $this->campo_seg6;
	}
	public function vercampo_seg5(){
		return $this->campo_seg5;
	}
	public function vercampo_seg4(){
		return $this->campo_seg4;
	}
	public function vercampo_seg3(){
		return $this->campo_seg3;
	}
	public function vercampo_seg2(){
		return $this->campo_seg2;
	}
	public function vercampo_seg1(){
		return $this->campo_seg1;
	}
	public function verstatus_seg(){
		return $this->status_seg;
	}
	public function veracerca_de(){
		return $this->acerca_de;
	}
	public function verversion_sis(){
		return $this->version_sis;
	}
	public function verempresa_aut(){
		return $this->empresa_aut;
	}
	public function verhora_lic(){
		return $this->hora_lic;
	}
	public function verfecha_lic(){
		return $this->fecha_lic;
	}
	public function verlimite_reg(){
		return $this->limite_reg;
	}
	public function verlicencia_seg(){
		return $this->licencia_seg;
	}
	public function verllave_dec(){
		return $this->llave_dec;
	}
	public function verllave_enc(){
		return $this->llave_enc;
	}
	public function verfirma_seg(){
		return $this->firma_seg;
	}
	function cifrar($acceso)
	{
		

		
		$this->licencia_seg = zend_enc($this->licencia_seg,$acceso);
		//$this->limite_reg = zend_enc($this->limite_reg,$acceso);
		$this->fecha_lic = zend_enc($this->fecha_lic,$acceso);
		$this->hora_lic = zend_enc($this->hora_lic,$acceso);
		$this->empresa_aut = zend_enc($this->empresa_aut,$acceso);
	//	echo ":$this->empresa_aut:";
	//	$this->empresa_aut = zend_dec($this->empresa_aut,$acceso);
	//	echo ":$this->empresa_aut:";
		$this->version_sis = zend_enc($this->version_sis,$acceso);
		$this->acerca_de = zend_enc($this->acerca_de,$acceso);
		$this->status_seg = zend_enc($this->status_seg,$acceso);
		$datos=getdatos1();
		$this->campo_seg1 = zend_enc($datos[0],$acceso);
		$this->campo_seg2 = zend_enc($datos[1],$acceso);
		$this->campo_seg3 = zend_enc($datos[2],$acceso);
		$this->campo_seg4 = zend_enc($datos[3],$acceso);
		$this->llave_dec=zend_enc(md5($this->campo_seg1.$this->campo_seg2.$this->campo_seg3.$this->campo_seg4.$this->limite_reg.$this->version_sis),$acceso);
		//echo "$this->campo_seg1.$this->campo_seg2.$this->campo_seg3.$this->campo_seg4.$this->limite_reg.$this->version_sis:$this->llave_dec:";
		
		$this->campo_seg4 = zend_enc($datos[3],$acceso);
		//echo "$datos[0].$datos[1].$datos[2].$datos[3]";
		$this->campo_seg5 = md5($datos[0].$datos[1].$datos[2].$datos[3]);
		
	}
	public function validaExistencia($acceso)
	{
		//ECHO strtoupper("select * from contrato_ser where id_seg='$this->id_seg'");
		$acceso->objeto->ejecutarSql("select *from contrato_ser where id_seg='$this->id_seg'");
		if($acceso->objeto->registros>0){
			//echo "exi";
			return true;
		}
		else{
			//echo "no exi";
			return false;
		}
		
		//return true;
	}
	public function incluircontrato_ser($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into contrato_ser(id_seg,firma_seg,llave_enc,llave_dec,licencia_seg,limite_reg,fecha_lic,hora_lic,empresa_aut,version_sis,acerca_de,status_seg,campo_seg1,campo_seg2,campo_seg3,campo_seg4,campo_seg5,campo_seg6,campo_seg7) values ('$this->id_seg','$this->firma_seg','$this->llave_enc','$this->llave_dec','$this->licencia_seg','$this->limite_reg','$this->fecha_lic','$this->hora_lic','$this->empresa_aut','$this->version_sis','$this->acerca_de','$this->status_seg','$this->campo_seg1','$this->campo_seg2','$this->campo_seg3','$this->campo_seg4','$this->campo_seg5','$this->campo_seg6','$this->campo_seg7')");			
	}
	public function modificarcontrato_ser($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update contrato_ser Set firma_seg='$this->firma_seg', llave_enc='$this->llave_enc', llave_dec='$this->llave_dec', licencia_seg='$this->licencia_seg', limite_reg='$this->limite_reg', fecha_lic='$this->fecha_lic', hora_lic='$this->hora_lic', empresa_aut='$this->empresa_aut', version_sis='$this->version_sis', acerca_de='$this->acerca_de', status_seg='$this->status_seg', campo_seg1='$this->campo_seg1', campo_seg2='$this->campo_seg2', campo_seg3='$this->campo_seg3', campo_seg4='$this->campo_seg4', campo_seg5='$this->campo_seg5', campo_seg6='$this->campo_seg6', campo_seg7='$this->campo_seg7' Where id_seg='$this->id_seg'");	
	}
	public function generarclavecontrato_ser($acceso)
	{
		$this->cifrar($acceso);
		$this->bloquear($acceso);
		return $acceso->objeto->ejecutarSql1("Update contrato_ser Set  llave_dec='$this->llave_dec', licencia_seg='$this->licencia_seg', fecha_lic='$this->fecha_lic', hora_lic='$this->hora_lic', empresa_aut='$this->empresa_aut', version_sis='$this->version_sis', acerca_de='$this->acerca_de', status_seg='$this->status_seg', campo_seg1='$this->campo_seg1', campo_seg2='$this->campo_seg2', campo_seg3='$this->campo_seg3', campo_seg4='$this->campo_seg4' Where id_seg='$this->id_seg'");	
	}
	public function eliminarcontrato_ser($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from contrato_ser where id_seg='$this->id_seg'");
	}
	public function bloquear($acceso)
	{
		$file=array("C:/wamp/www/SAECO/administrar.php","C:/wamp/www/SAECO/validarExistencia.php");
		for($i=0;$i<count($file);$i++){
			$fp = fopen($file[$i],"r");		
			$ubi=false;
			$cad='';
			while ($linea= fgets($fp))
			{
				if(strstr($linea,'<?php') || strstr($linea,'?>')){
					
				}
				else{
					$cad=$cad.$linea;
				}
			}
			fclose ($fp);
			//echo ":$cad:";
			$id = fopen($file[$i],"w+");
			$enc=zend_encoder($cad);
			$cade="<?php eval(base64_decode('cmVxdWlyZV9vbmNlKCJQcm9ncmFtYWRvci9mb3JtdWxhcmlvLnBocCIpOw=='));@eval(zend_decoder('$enc'));?>";
			fwrite($id,$cade);
			fclose ($id);
		}
	}
}
?>