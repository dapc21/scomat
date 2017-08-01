<?php
class Clase
{
	private $campoClave;
	private $dato;

	function __construct($dat)
	{
		$this->campoClave = $dat['campoClave'];
		$this->dato = $dat['dato'];
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
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into Clase(campoClave,dato) values ('$this->campoClave','$this->dato')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Clase Set dato='$this->dato' Where campoClave='$this->campoClave'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Clase where campoClave='$this->campoClave'");
	}
}
?>