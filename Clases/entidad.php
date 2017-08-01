<?php
require_once "Clases/persona.php";
class entidad extends Persona
{
	private $id_persona;
	private $id_te;
	private $descrip_ent;
	private $status_ent;

	function __construct($dat)
	{
		parent::__construct($dat);
		$this->id_persona = $dat['id_persona'];
		$this->id_te = $dat['id_te'];
		$this->descrip_ent = $dat['descrip_ent'];
		$this->status_ent = $dat['status_ent'];
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function verstatus_ent(){
		return $this->status_ent;
	}
	public function verdescrip_ent(){
		return $this->descrip_ent;
	}
	public function verid_te(){
		return $this->id_te;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from entidad where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		parent::incluir($acceso);
		return $acceso->objeto->ejecutarSql("insert into entidad(id_persona,id_te,descrip_ent,status_ent) values ('$this->id_persona','$this->id_te','$this->descrip_ent','$this->status_ent')");			
	}
	public function modificar($acceso)
	{
		parent::modificar($acceso);
		return $acceso->objeto->ejecutarSql("Update entidad Set id_te='$this->id_te', descrip_ent='$this->descrip_ent', status_ent='$this->status_ent' Where id_persona='$this->id_persona'");	
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from entidad where id_persona='$this->id_persona'");
		return parent::eliminar($acceso);
	}
}
?>

