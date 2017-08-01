<?php
class banco
{
	private $banco;
	private $tipo_banco;
	private $id_banco;

	function __construct($dat)
	{
		$this->banco = $dat['banco'];
		$this->tipo_banco = $dat['tipo_banco'];
		$this->id_banco = $dat['id_banco'];
	}
	public function verbanco(){
		return $this->banco;
	}
	public function verid_banco(){
		return $this->id_banco;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from banco where id_banco='$this->id_banco'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		
		$acceso->objeto->ejecutarSql("insert into banco(id_banco,banco,tipo_banco) values ('$this->id_banco','$this->banco','$this->tipo_banco')");	
		
	}
	public function modificar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("Update banco Set banco='$this->banco', tipo_banco='$this->tipo_banco' where id_banco='$this->id_banco'");

	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from banco where id_banco='$this->id_banco'");

	}
}
?>