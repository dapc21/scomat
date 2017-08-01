<?php
class Clase
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
		$acceso->objeto->ejecutarSql("select * from Clase where campoClave='$this->campoClave'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirClase($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into Clase(campoClave,dato) values ('$this->campoClave','$this->dato')");			
	}
	public function modificarClase($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Clase Set dato='$this->dato' Where campoClave='$this->campoClave'");	
	}
	public function eliminarClase($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Clase where campoClave='$this->campoClave'");
	}
}
?>