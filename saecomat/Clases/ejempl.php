<?php
class ejempl
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
		$acceso->objeto->ejecutarSql("select * from ejempl where campoClave='$this->campoClave'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirejempl($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into ejempl(campoClave,dato) values ('$this->campoClave','$this->dato')");			
	}
	public function modificarejempl($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update ejempl Set dato='$this->dato' Where campoClave='$this->campoClave'");	
	}
	public function eliminarejempl($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from ejempl where campoClave='$this->campoClave'");
	}
}
?>