<?php
require_once "Clases/persona.php";
class responsable extends Persona
{
	private $id_res;
	private $id_persona;
	private $id_tipo_res;
	private $descrip_res;
	private $status_res;

	function __construct($dat)
	{
		parent::__construct($dat);
		$this->id_res = $dat['id_res'];
		$this->id_persona = $dat['id_persona'];
		$this->id_tipo_res = $dat['id_tipo_res'];
		$this->descrip_res = $dat['descrip_res'];
		$this->status_res = $dat['status_res'];
	}
	public function verid_res(){
		return $this->id_res;
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function verstatus_res(){
		return $this->status_res;
	}
	public function verdescrip_res(){
		return $this->descrip_res;
	}
	public function verid_tipo_res(){
		return $this->id_tipo_res;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from responsable where id_persona='$this->id_persona' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		parent::incluir($acceso);
		return $acceso->objeto->ejecutarSql("insert into responsable(id_res,id_tipo_res,id_persona,descrip_res,status_res) values ('$this->id_res','$this->id_tipo_res','$this->id_persona','$this->descrip_res','$this->status_res')");			
	}
	public function modificar($acceso)
	{
		parent::modificar($acceso);
		return $acceso->objeto->ejecutarSql("update responsable set id_tipo_res='$this->id_tipo_res', descrip_res='$this->descrip_res', status_res='$this->status_res' where id_res='$this->id_res'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update responsable set id_estatus_reg = 2 where id_res='$this->id_res'");
	}
}
?>