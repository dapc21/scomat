<?php
require_once "../Clases/persona.php";
class entidad extends Persona
{
	private $id_persona;
	private $id_te;
	private $descrip_ent;
	private $status_ent;

	function __construct($id_persona,$cedula,$nombre,$apellido,$telefono,$id_te,$descrip_ent,$status_ent)
	{
		parent::__construct($id_persona,$cedula,$nombre,$apellido,$telefono);
		$this->id_persona = $id_persona;
		$this->id_te = $id_te;
		$this->descrip_ent = $descrip_ent;
		$this->status_ent = $status_ent;
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
	public function incluirentidad($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from persona where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0){
			parent::modificarPersona($acceso);
		}else{
			parent::incluirPersona($acceso);
		}
			
		return $acceso->objeto->ejecutarSql("insert into entidad(id_persona,id_te,descrip_ent,status_ent) values ('$this->id_persona','$this->id_te','$this->descrip_ent','$this->status_ent')");			
	}
	public function modificarentidad($acceso)
	{
		parent::modificarPersona($acceso);
		return $acceso->objeto->ejecutarSql("Update entidad Set id_te='$this->id_te', descrip_ent='$this->descrip_ent', status_ent='$this->status_ent' Where id_persona='$this->id_persona'");	
	}
	public function eliminarentidad($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from entidad where id_persona='$this->id_persona'");
		return parent::eliminarPersona($acceso);
	}
}
?>

