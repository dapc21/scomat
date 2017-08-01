<?php
class Persona
{
	private $idPersona;
	private $cedula;
	private $nombre;
	private $apellido;
	private $dato;

	function __construct($idPersona,$cedula,$nombre,$apellido,$dato)
	{
		$this->idPersona = $idPersona;
		$this->cedula = $cedula;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->dato = $dato;
	}
	public function veridPersona(){
		return $this->idPersona;
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
		$acceso->objeto->ejecutarSql("select * from Persona where idPersona='$this->idPersona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirPersona($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into Persona(idPersona,cedula,nombre,apellido,dato) values ('$this->idPersona','$this->cedula','$this->nombre','$this->apellido','$this->dato')");			
	}
	public function modificarPersona($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Persona Set cedula='$this->cedula', nombre='$this->nombre', apellido='$this->apellido', dato='$this->dato' Where idPersona='$this->idPersona'");	
	}
	public function eliminarPersona($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Persona where idPersona='$this->idPersona'");
	}
}
?>