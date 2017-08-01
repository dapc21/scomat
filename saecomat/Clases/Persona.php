<?php
class Persona
{
	private $id_persona;
	private $cedula;
	private $nombre;
	private $apellido;
	private $dato;

	function __construct($id_persona,$cedula,$nombre,$apellido,$dato)
	{
		$this->id_persona = $id_persona;
		$this->cedula = $cedula;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->dato = $dato;
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verapellido(){
		return $this->apellido;
	}
	public function vernombre(){
		return $this->nombre;
	}
	public function vercedula(){
		return $this->cedula;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Persona where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirPersona($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into persona(id_persona,cedula,nombre,apellido,dato) values ('$this->id_persona','$this->cedula','$this->nombre','$this->apellido','$this->dato')");			
	}
	public function modificarPersona($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update persona Set cedula='$this->cedula', nombre='$this->nombre', apellido='$this->apellido', dato='$this->dato' Where id_persona='$this->id_persona'");	
	}
	public function eliminarPersona($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from persona where id_persona='$this->id_persona'");
	}
}
?>