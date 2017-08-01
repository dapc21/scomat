<?php
class otros_datos
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
		$acceso->objeto->ejecutarSql("select * from otros_datos where campoClave='$this->campoClave'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirotros_datos($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into otros_datos(campoClave,dato) values ('$this->campoClave','$this->dato')");			
	}
	public function modificarotros_datos($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update otros_datos Set dato='$this->dato' Where campoClave='$this->campoClave'");	
	}
	public function eliminarotros_datos($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from otros_datos where campoClave='$this->campoClave'");
	}
}
?>