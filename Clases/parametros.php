<?php
class parametros
{
	private $id_param;
	private $id_franq;
	private $fecha_param;
	private $parametro;
	private $obser_param;
	private $valor_param;

	function __construct($dat)
	{
		$this->id_param = $dat['id_param'];
		$this->id_franq = $dat['id_franq'];
		$this->fecha_param = $dat['fecha_param'];
		$this->parametro = $dat['parametro'];
		$this->obser_param = $dat['obser_param'];
		$this->valor_param = $dat['valor_param'];
	}
	public function verid_param(){
		return $this->id_param;
	}
	public function vervalor_param(){
		return $this->valor_param;
	}
	public function verobser_param(){
		return $this->obser_param;
	}
	public function verparametro(){
		return $this->parametro;
	}
	public function verfecha_param(){
		return $this->fecha_param;
	}
	public function verid_franq(){
		return $this->id_franq;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from parametros where id_param='$this->id_param'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into parametros(id_param,id_franq,fecha_param,parametro,obser_param,valor_param) values ('$this->id_param','$this->id_franq','$this->fecha_param','$this->parametro','$this->obser_param','$this->valor_param')");			
	}
	public function modificar($acceso)
	{
		if($this->id_param=='20'){
			$this->oculta_par($acceso);
		}
		return $acceso->objeto->ejecutarSql("Update parametros Set id_franq='$this->id_franq', fecha_param='$this->fecha_param', parametro='$this->parametro', obser_param='$this->obser_param', valor_param='$this->valor_param' Where id_param='$this->id_param'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from parametros where id_param='$this->id_param'");
	}
	public function oculta_par($acceso)
	{
		copy("index.php","copia");		
		$fp = fopen("copia","r");		
		$id = fopen("index.php","w+");
		//echo ":$this->valor_param:";
		while ($linea= fgets($fp))
		{
			
			
			if($this->valor_param=='1'){
				$linea = str_replace('/* //ini_conf mat','//ini conf mat',$linea);
				$linea = str_replace('*/ //fin_conf mat','//fin conf mat',$linea);
				if(strstr($linea,'/* //ini_conf mat')){
					//echo ":$linea:";
					$linea = '//ini conf mat
';
					
				}
				if(strstr($linea,'*/ //fin_conf mat')){
					$linea = '//fin conf mat
';
				}
			}
			else {
				if(strstr($linea,'//ini conf mat')){
					//echo ":$linea:";
					$linea = '/* //ini_conf mat
';
					
				}
				if(strstr($linea,'//fin conf mat')){
					$linea = '*/ //fin_conf mat
';
				}
				
			}
			
			fwrite($id,$linea);
		}
		fclose ($id);
		fclose ($fp);
		unlink('copia');
	}
}
?>