<?php
require_once "Clases/persona.php";
class encargado extends Persona
{
	private $id_enc;
	private $id_persona;
	private $descrip_enc;
	private $status_enc;

	function __construct($dat)
	{
		parent::__construct($dat);
		$this->id_enc = $dat['id_enc'];
		$this->id_persona = $dat['id_persona'];
		$this->descrip_enc = $dat['descrip_enc'];
		$this->status_enc = $dat['status_enc'];
	}
	public function verid_enc(){
		return $this->id_enc;
	}
	public function verstatus_enc(){
		return $this->status_enc;
	}
	public function verdescrip_enc(){
		return $this->descrip_enc;
	}
	public function verid_persona(){
		return $this->id_persona;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from encargado where id_persona='$this->id_persona' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		parent::incluir($acceso);
		return $acceso->objeto->ejecutarSql("insert into encargado(id_enc,id_persona,descrip_enc,status_enc) values ('$this->id_enc','$this->id_persona','$this->descrip_enc','$this->status_enc')");			
	}
	public function modificar($acceso)
	{
		parent::modificar($acceso);
		return $acceso->objeto->ejecutarSql("update encargado set descrip_enc='$this->descrip_enc', status_enc='$this->status_enc' where id_enc='$this->id_enc'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update encargado set id_estatus_reg = 2 where id_enc='$this->id_enc'");
	}
}
?>