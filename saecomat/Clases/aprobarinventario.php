<?php
class aprobarinventario
{
	private $campoClave;
	private $dato;

	function __construct($campoClave,$dato)
	{
		$this->campoClave = $campoClave;
		$this->dato = $dato;
	}
	public function vercampoClave(){
		return $this->campoClave;
	}
	public function verdato(){
		return $this->dato;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from aprobarinventario where campoClave='$this->campoClave'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluiraprobarinventario($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into aprobarinventario(campoClave,dato) values ('$this->campoClave','$this->dato')");			
	}
	public function modificaraprobarinventario($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update aprobarinventario Set dato='$this->dato' Where campoClave='$this->campoClave'");	
	}
	public function eliminaraprobarinventario($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from aprobarinventario where campoClave='$this->campoClave'");
	}
}
?>