<?php
class motivonotas
{
	private $idmotivonota;
	private $nombremotivonota;
	private $status;
	private $dato;

	function __construct($dat)
	{
		$this->idmotivonota = $dat['idmotivonota'];
		$this->nombremotivonota = $dat['nombremotivonota'];
		$this->status = $dat['status'];
		$this->dato = $dat['dato'];
	}
	public function veridmotivonota(){
		return $this->idmotivonota;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus(){
		return $this->status;
	}
	public function vernombremotivonota(){
		return $this->nombremotivonota;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from motivonotas where idmotivonota='$this->idmotivonota'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into motivonotas(idmotivonota,nombremotivonota,status) values ('$this->idmotivonota','$this->nombremotivonota','$this->status')");
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update motivonotas Set nombremotivonota='$this->nombremotivonota', status='$this->status' Where idmotivonota='$this->idmotivonota'");
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from motivonotas where idmotivonota='$this->idmotivonota'");
	}
}
?>